<?php

use WPML\TM\ATE\Log\Entry;
use WPML\TM\ATE\Log\ErrorEvents;

/**
 * @author OnTheGo Systems
 */
class WPML_TM_ATE_API {
	private $wp_http;
	private $auth;
	private $endpoints;

	/**
	 * WPML_TM_ATE_API constructor.
	 *
	 * @param WP_Http                    $wp_http
	 * @param WPML_TM_ATE_Authentication $auth
	 * @param WPML_TM_ATE_AMS_Endpoints  $endpoints
	 */
	public function __construct(
		WP_Http $wp_http,
		WPML_TM_ATE_Authentication $auth,
		WPML_TM_ATE_AMS_Endpoints $endpoints
	) {
		$this->wp_http   = $wp_http;
		$this->auth      = $auth;
		$this->endpoints = $endpoints;
	}

	/**
	 * @param array $params
	 *
	 * @see https://bitbucket.org/emartini_crossover/ate/wiki/API/V1/jobs/create
	 *
	 * @return mixed
	 * @throws \InvalidArgumentException
	 */
	public function create_jobs( array $params ) {
		return $this->requestWithLog(
			$this->endpoints->get_ate_jobs(),
			[
				'method' => 'POST',
				'body'   => $params,
			]
		);
	}

	/**
	 * @param int|string|array $ate_job_id
	 *
	 * @return array|WP_Error
	 * @throws \InvalidArgumentException
	 */
	public function confirm_received_job( $ate_job_id ) {
		return $this->requestWithLog( $this->endpoints->get_ate_confirm_job( $ate_job_id ) );
	}

	/**
	 * @param int    $job_id
	 * @param string $return_url
	 *
	 * @return string|WP_Error
	 * @throws \InvalidArgumentException
	 */
	public function get_editor_url( $job_id, $return_url ) {
		$url = $this->endpoints->get_ate_editor();
		$url = str_replace( array(
			                    '{job_id}',
			                    '{translator_email}',
			                    '{return_url}'
		                    ),
		                    array(
			                    $job_id,
			                    urlencode( filter_var( wp_get_current_user()->user_email, FILTER_SANITIZE_URL ) ),
			                    urlencode( filter_var( $return_url, FILTER_SANITIZE_URL ) ),
		                    ),
		                    $url );

		return $this->auth->get_signed_url( 'GET', $url, null );
	}

	/**
	 * @param int $ate_job_id
	 *
	 * @return array|WP_Error
	 * @throws \InvalidArgumentException
	 */
	public function get_job( $ate_job_id ) {
		if ( ! $ate_job_id ) {
			return null;
		}

		return $this->requestWithLog( $this->endpoints->get_ate_jobs( $ate_job_id ) );
	}

	/**
	 * If `$job_ids` is not an empty array,
	 * the `$statuses` parameter will be ignored in ATE's endpoint.
	 *
	 * @see https://bitbucket.org/emartini_crossover/ate/wiki/API/V1/jobs/status
	 *
	 * @param null|array $job_ids
	 * @param null|array $statuses
	 *
	 * @return array|mixed|null|object|WP_Error
	 * @throws \InvalidArgumentException
	 */
	public function get_jobs( $job_ids, $statuses = null ) {
		return $this->requestWithLog( $this->endpoints->get_ate_jobs( $job_ids, $statuses ) );
	}

	/**
	 * @param $wpml_job_ids
	 *
	 * @return array|mixed|object|WP_Error|null
	 */
	public function get_jobs_by_wpml_ids( $wpml_job_ids ) {
		return $this->requestWithLog( $this->endpoints->get_ate_jobs_by_wpml_job_ids( $wpml_job_ids ) );
	}

	/**
	 * @param array $pairs
	 * @see https://bitbucket.org/emartini_crossover/ate/wiki/API/V1/migration/migrate
	 * @return bool
	 */
	public function migrate_source_id( array $pairs ) {
		$verb = 'POST';

		$url = $this->auth->get_signed_url( $verb, $this->endpoints->get_source_id_migration(), $pairs );
		if ( is_wp_error( $url ) ) {
			return $url;
		}

		$result = $this->wp_http->request( $url,
		                                   array(
			                                   'timeout' => 60,
			                                   'method'  => $verb,
			                                   'headers' => $this->json_headers(),
			                                   'body'    => wp_json_encode( $pairs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ),
		                                   ) );

		return $this->get_response_errors( $result ) === null;
	}

	private function get_response( $result ) {
		$errors = $this->get_response_errors( $result );
		if ( is_wp_error( $errors ) ) {
			return $errors;
		}

		return $this->get_response_body( $result );
	}

	private function get_response_body( $result ) {
		if ( is_array( $result ) && array_key_exists( 'body', $result ) && ! is_wp_error( $result ) ) {
			$body = json_decode( $result['body'] );

			if ( isset( $body->authenticated ) && ! (bool) $body->authenticated ) {
				return new WP_Error( 'ate_auth_failed', $body->message );
			}

			return $body;
		}

		return $result;
	}

	private function get_response_errors( $response ) {
		$response_errors = null;
		if ( is_wp_error( $response ) ) {
			$response_errors = $response;
		} elseif ( array_key_exists( 'body', $response ) && $response['response']['code'] >= 400 ) {
			$errors = array();

			$response_body = json_decode( $response['body'], true );

			if ( is_array( $response_body ) && array_key_exists( 'errors', $response_body ) ) {
				$errors = $response_body['errors'];
			}

			$response_errors = new WP_Error( $response['response']['code'], $response['response']['message'], $errors );
		}

		return $response_errors;
	}

	/**
	 * @return array
	 */
	private function json_headers() {
		return array(
			'Accept'       => 'application/json',
			'Content-Type' => 'application/json',
		);
	}

	/**
	 * @param array $args
	 *
	 * @return string
	 */
	private function encode_body_args( array $args ) {
		return wp_json_encode( $args, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES );
	}

	/**
	 * @param string $xliff_url
	 *
	 * @return string
	 * @throws Requests_Exception
	 */
	public function get_remote_xliff_content( $xliff_url ) {
		/** @var \WP_Error|array $response */
		$response = wp_remote_get( $xliff_url );
		if ( is_wp_error( $response ) ) {
			throw new Requests_Exception( $response->get_error_message(), $response->get_error_code() );
		} elseif ( isset( $response['response']['code'] ) && 200 !== (int) $response['response']['code'] ) {
			throw new Requests_Exception( $response['response']['message'], $response['response']['code'] );
		} elseif ( ! isset( $response['body'] ) || ! trim( $response['body'] ) ) {
			throw new Requests_Exception( 'Missing body', 0 );
		}

		return $response['body'];
	}

	public function override_site_id( $site_id ) {
		$this->auth->override_site_id( $site_id);
	}

	public function get_website_id( $site_url ) {
		$signed_url = $this->auth->get_signed_url( 'GET', $this->endpoints->get_websites() );
		if ( is_wp_error( $signed_url ) ) {
			return null;
		}

		$sites = $this->get_response( $this->wp_http->request( $signed_url ) );

		foreach ( $sites as $site ) {
			if ( $site->url === $site_url ) {
				return $site->uuid;
			}
		}

		return null;
	}

	/**
	 * @see https://bitbucket.org/emartini_crossover/ate/wiki/API/V1/sync/all
	 *
	 * @param array $ateJobIds
	 *
	 * @return array|mixed|null|object|WP_Error
	 * @throws \InvalidArgumentException
	 */
	public function sync_all( array $ateJobIds ) {
		return $this->requestWithLog(
			$this->endpoints->get_sync_all(),
			[
				'method' => 'POST',
				'body'   => [ 'ids' => $ateJobIds ],
			]
		);
	}

	/**
	 * @see https://bitbucket.org/emartini_crossover/ate/wiki/API/V1/sync/page
	 *
	 * @param string $token
	 * @param int    $page
	 *
	 * @return array|mixed|null|object|WP_Error
	 * @throws \InvalidArgumentException
	 */
	public function sync_page( $token, $page ) {
		return $this->requestWithLog( $this->endpoints->get_sync_page( $token, $page ) );
	}

	/**
	 * @param string $url
	 * @param array  $requestArgs
	 *
	 * @return array|mixed|object|string|WP_Error|null
	 */
	private function request( $url, array $requestArgs = [] ) {
		$requestArgs = array_merge(
			[
				'timeout' => 60,
				'method'  => 'GET',
				'headers' => $this->json_headers(),
			],
			$requestArgs
		);

		$bodyArgs = isset( $requestArgs['body'] ) && is_array( $requestArgs['body'] )
			? $requestArgs['body'] : null;

		$signedUrl = $this->auth->get_signed_url( $requestArgs['method'], $url, $bodyArgs );

		if ( is_wp_error( $signedUrl ) ) {
			return $signedUrl;
		}

		if ( $bodyArgs ) {
			$requestArgs['body'] = $this->encode_body_args( $bodyArgs );
		}

		$result = $this->wp_http->request( $signedUrl, $requestArgs );

		return $this->get_response( $result );
	}

	/**
	 * @param string $url
	 * @param array  $requestArgs
	 *
	 * @return array|mixed|object|string|WP_Error|null
	 */
	private function requestWithLog( $url, array $requestArgs = [] ) {
		$response = $this->request( $url, $requestArgs );

		if ( is_wp_error( $response ) ) {
			$entry              = new Entry();
			$entry->event       = ErrorEvents::SERVER_ATE;
			$entry->description = $response->get_error_message();
			$entry->extraData   = [
				'url'         => $url,
				'requestArgs' => $requestArgs,
			];

			wpml_tm_ate_ams_log( $entry );
		}

		return $response;
	}
}
