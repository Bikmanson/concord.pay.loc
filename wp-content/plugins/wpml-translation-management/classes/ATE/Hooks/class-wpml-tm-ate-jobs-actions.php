<?php

use WPML\TM\ATE\JobRecords;

/**
 * @author OnTheGo Systems
 */
class WPML_TM_ATE_Jobs_Actions implements IWPML_Action {
	const RESPONSE_ATE_NOT_ACTIVE_ERROR = 403;
	const RESPONSE_ATE_DUPLICATED_SOURCE_ID = 417;
	const RESPONSE_ATE_UNEXPECTED_ERROR = 500;

	const RESPONSE_ATE_ERROR_NOTICE_ID = 'ate-update-error';
	const RESPONSE_ATE_ERROR_NOTICE_GROUP = 'default';

	/**
	 * @var WPML_TM_ATE_API
	 */
	private $ate_api;
	/**
	 * @var WPML_TM_ATE_Jobs
	 */
	private $ate_jobs;

	/**
	 * @var WPML_TM_AMS_Translator_Activation_Records
	 */
	private $translator_activation_records;

	/** @var bool */
	private $is_second_attempt_to_get_jobs_data = false;
	/**
	 * @var SitePress
	 */
	private $sitepress;
	/**
	 * @var WPML_Current_Screen
	 */
	private $current_screen;

	/** @var array */
	private $trid_original_element_map = array();

	/** @var WPML_TM_ATE_Jobs_Sync_Script_Loader */
	private $job_sync_script_loader;

	/**
	 * WPML_TM_ATE_Jobs_Actions constructor.
	 *
	 * @param \WPML_TM_ATE_API                           $ate_api
	 * @param \WPML_TM_ATE_Jobs                          $ate_jobs
	 * @param \SitePress                                 $sitepress
	 * @param \WPML_Current_Screen                       $current_screen
	 * @param \WPML_TM_AMS_Translator_Activation_Records $translator_activation_records
	 * @param WPML_TM_ATE_Jobs_Sync_Script_Loader        $job_sync_script_loader
	 */
	public function __construct(
		WPML_TM_ATE_API $ate_api,
		WPML_TM_ATE_Jobs $ate_jobs,
		SitePress $sitepress,
		WPML_Current_Screen $current_screen,
		WPML_TM_AMS_Translator_Activation_Records $translator_activation_records,
		WPML_TM_ATE_Jobs_Sync_Script_Loader $job_sync_script_loader

	) {
		$this->ate_api                       = $ate_api;
		$this->ate_jobs                      = $ate_jobs;
		$this->sitepress                     = $sitepress;
		$this->current_screen                = $current_screen;
		$this->translator_activation_records = $translator_activation_records;
		$this->job_sync_script_loader        = $job_sync_script_loader;
	}

	public function add_hooks() {
		add_action( 'wpml_added_translation_job', array( $this, 'added_translation_job' ), 10, 2 );
		add_action( 'wpml_added_translation_jobs', array( $this, 'added_translation_jobs' ) );
		add_action( 'admin_notices', array( $this, 'handle_messages' ) );
		add_action( 'current_screen', array( $this, 'update_jobs_on_current_screen' ) );
		add_action( 'wp', array( $this, 'update_jobs_on_current_screen' ) );

		add_filter( 'wpml_tm_ate_jobs_data', array( $this, 'get_ate_jobs_data_filter' ), 10, 2 );
		add_filter( 'wpml_tm_ate_jobs_editor_url', array( $this, 'get_editor_url' ), 10, 3 );
	}

	public function handle_messages() {
		if ( $this->current_screen->id_ends_with( WPML_TM_FOLDER . '/menu/translations-queue') ) {

			if ( array_key_exists( 'message', $_GET ) ) {
				if ( array_key_exists( 'ate_job_id', $_GET ) ) {
					$ate_job_id = filter_var( $_GET['ate_job_id'], FILTER_SANITIZE_NUMBER_INT );

					$this->resign_job_on_error( $ate_job_id );
				}
				$message = filter_var( $_GET['message'], FILTER_SANITIZE_STRING );
				?>

				<div class="error notice-error notice otgs-notice">
					<p><?php echo $message; ?></p>
				</div>

				<?php
			}
		}
	}

	/**
	 * @param int $job_id
	 * @param string $translation_service
	 *
	 * @throws \InvalidArgumentException
	 * @throws \RuntimeException
	 */
	public function added_translation_job( $job_id, $translation_service ) {
		$this->added_translation_jobs( array( $translation_service => array( $job_id ) ) );
	}

	/**
	 * @param array $jobs
	 *
	 * @return bool|void
	 * @throws \InvalidArgumentException
	 * @throws \RuntimeException
	 */
	public function added_translation_jobs( array $jobs ) {
		if ( ! $jobs || ! array_key_exists( 'local', $jobs ) || ! $jobs['local'] ) {
			return;
		}

		/** @var array $job_ids */
		$job_ids        = $jobs['local'];
		$jobs           = [];
		$rid_to_job_map = [];
		foreach ( $job_ids as $job_id ) {
			$rid                    = wpml_tm_get_records()->icl_translate_job_by_job_id( $job_id )->rid();
			$rid_to_job_map[ $rid ] = $job_id;
			$jobs[]                 = wpml_tm_create_ATE_job_creation_model( $job_id, $rid );
		}
		$response = $this->create_jobs( $jobs );

		try {
			$this->check_response_error( $response );
		} catch ( RuntimeException $ex ) {
			do_action( 'wpml_tm_basket_add_message', 'error', $ex->getMessage() );

			return;
		}

		$has_valid_response = $response && isset( $response->jobs );
		$response_jobs      = null;
		if ( $has_valid_response ) {
			$response_jobs = $response->jobs;
		}

		if ( $response_jobs ) {
			if ( is_object( $response_jobs ) ) {
				$response_jobs = json_decode( wp_json_encode( $response_jobs, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES ), true );
			}

			$response_jobs = $this->map_response_jobs( $response_jobs, $rid_to_job_map );

			$this->ate_jobs->warm_cache( array_keys( $response_jobs ) );

			foreach ( $response_jobs as $wpml_job_id => $ate_job_id ) {
				$this->ate_jobs->store( $wpml_job_id, array( JobRecords::FIELD_ATE_JOB_ID => $ate_job_id ) );
				wpml_tm_load_old_jobs_editor()->set( $wpml_job_id, WPML_TM_Editors::ATE );
			}

			$message = __( '%1$s jobs added to the Advanced Translation Editor.', 'wpml-translation-management' );
			$this->add_message( 'updated', sprintf( $message, count( $response_jobs ) ), 'wpml_tm_ate_create_job' );
		} else {
			$this->add_message(
				'error',
				__( 'Jobs could not be created in Advanced Translation Editor. Please try again or contact the WPML support for help.',
					'wpml-translation-management' ), 'wpml_tm_ate_create_job' );
		}
	}

	private function map_response_jobs( $responseJobs, $rid_to_job_id_map ) {
		$result = [];
		foreach ( $responseJobs as $rid => $ate_job_id ) {
			if ( isset( $rid_to_job_id_map[ $rid ] ) ) {
				$result[ $rid_to_job_id_map[ $rid ] ] = $ate_job_id;
			}
		}

		return $result;
	}

	/**
	 * @param string      $type
	 * @param string      $message
	 * @param string|null $id
	 */
	private function add_message( $type, $message, $id = null ) {
		do_action( 'wpml_tm_basket_add_message', $type, $message, $id );
	}

	/**
	 * @param WPML_TM_ATE_Models_Job_Create[] $jobs
	 *
	 * @return mixed
	 * @throws \InvalidArgumentException
	 */
	private function create_jobs( array $jobs ) {
		$params = json_decode( wp_json_encode( array( 'jobs' => $jobs ) ), true );

		return $this->ate_api->create_jobs( $params );
	}

	/**
	 * After implementation of wpmltm-3211 and wpmltm-3391, we should not find missing ATE IDs anymore.
	 * Some code below seems dead but we'll keep it for now in case we are missing a specific context.
	 *
	 * @link https://onthegosystems.myjetbrains.com/youtrack/issue/wpmltm-3211
	 * @link https://onthegosystems.myjetbrains.com/youtrack/issue/wpmltm-3391
	 */
	private function get_ate_jobs_data( array $translation_jobs ) {
		$ate_jobs_data      = array();
		$skip_getting_data  = false;
		$ate_jobs_to_create = array();

		$this->ate_jobs->warm_cache( wpml_collect( $translation_jobs )->pluck( 'job_id' )->toArray() );

		foreach ( $translation_jobs as $translation_job ) {
			if ( $this->is_ate_translation_job( $translation_job ) ) {
				$ate_job_id = $this->get_ate_job_id( $translation_job->job_id );
				// Start of possibly dead code.
				if ( ! $ate_job_id ) {
					$ate_jobs_to_create[] = $translation_job->job_id;
					$skip_getting_data    = true;
				}
				// End of possibly dead code.

				if ( ! $skip_getting_data ) {
					$ate_jobs_data[ $translation_job->job_id ] = [ 'ate_job_id' => $ate_job_id ];
				}
			}
		}

		// Start of possibly dead code.
		if (
			! $this->is_second_attempt_to_get_jobs_data &&
			$ate_jobs_to_create &&
			$this->added_translation_jobs( array( 'local' => $ate_jobs_to_create ) )
		) {
			$ate_jobs_data                            = $this->get_ate_jobs_data( $translation_jobs );
			$this->is_second_attempt_to_get_jobs_data = true;
		}
		// End of possibly dead code.

		return $ate_jobs_data;
	}

	/**
	 * @param string $default_url
	 * @param int $job_id
	 * @param null|string $return_url
	 *
	 * @return string
	 * @throws \InvalidArgumentException
	 */
	public function get_editor_url( $default_url, $job_id, $return_url = null ) {
		if ( $this->translator_activation_records->is_current_user_activated() ) {
			$ate_job_id = $this->ate_jobs->get_ate_job_id( $job_id );
			if ( $ate_job_id ) {
				if ( ! $return_url ) {
					$return_url = add_query_arg(
						array(
							'page'           => WPML_TM_FOLDER . '/menu/translations-queue.php',
							'ate-return-job' => $job_id,
						),
						admin_url( '/admin.php' ) );
				}
				$ate_job_url = $this->ate_api->get_editor_url( $ate_job_id, $return_url );
				if ( $ate_job_url && ! is_wp_error( $ate_job_url ) ) {
					return $ate_job_url;
				}
			}
		}

		return $default_url;
	}

	/**
	 * @param $ignore
	 * @param array $translation_jobs
	 *
	 * @return array
	 */
	public function get_ate_jobs_data_filter( $ignore, array $translation_jobs ) {
		return $this->get_ate_jobs_data( $translation_jobs );
	}

	private function get_ate_job_id( $job_id ) {
		return $this->ate_jobs->get_ate_job_id( $job_id );
	}

	public function update_jobs_on_current_screen() {
		$load_ate_jobs_synchronization = $this->is_edit_list_page_of_a_translatable_type() ||
		                                 $this->is_edit_page_of_a_translatable_type() ||
		                                 WPML_TM_Page::is_dashboard() ||
		                                 WPML_TM_Page::is_translation_queue();

		if ( apply_filters( 'wpml_tm_load_ate_jobs_synchronization', $load_ate_jobs_synchronization ) ) {
			$this->job_sync_script_loader->load();
		}
	}

	/**
	 * @param string $message
	 */
	private function add_update_error_notice( $message ) {
		$error_log = new WPML_TM_ATE_API_Error();
		$error_log->log( $message );
	}

	/**
	 * @todo: Remove this method in favor of the new SYNC/DOWNLOAD process.
	 *
	 * @param bool           $updated
	 * @param array|stdClass $translation_jobs
	 * @param bool           $ignore_errors
	 *
	 * @throws \RuntimeException
	 *
	 * @return int[] Returns an array of WPML job IDs that translation was applied (XLIFF updated)
	 */
	public function update_jobs( $updated, $translation_jobs, $ignore_errors = false ) {
		/**
		 * We should only expect an array of objects.
		 * However, this method can be called by an action and a known issue may cause to pass a single object instead
		 *
		 * @see https://developer.wordpress.org/reference/functions/do_action/#comment-2371
		 */
		if ( is_object( $translation_jobs ) ) {
			if ( isset( $translation_jobs->job_id ) ) {
				$translation_jobs = array( $translation_jobs );
			} else {
				$translation_jobs = null;
			}
		}

		$jobs_with_translation_applied = array();

		if ( $translation_jobs ) {
			$ate_jobs_data = $this->get_ate_jobs_data( $translation_jobs );

			if ( ! $ate_jobs_data ) {
				return array();
			}

			$job_ids_map = array();
			foreach ( $translation_jobs as $translation_job ) {
				if ( $this->is_ate_translation_job( $translation_job ) ) {
					$ate_job_id = null;
					if ( isset( $ate_jobs_data[ $translation_job->job_id ]['ate_job_id'] ) ) {
						$ate_job_id                 = $ate_jobs_data[ $translation_job->job_id ]['ate_job_id'];
						$job_ids_map[ $ate_job_id ] = $translation_job->job_id;
					}
				}
			}

			if ( $job_ids_map ) {
				$ate_job_ids = array_keys( $job_ids_map );
				$response    = $this->ate_api->get_jobs( $ate_job_ids );

				try {
					$this->check_response_error( $response );
				} catch( RuntimeException $e ){
					$this->add_update_error_notice( $e->getMessage() );
				}

				$processed = json_decode( wp_json_encode( $response ), true );

				if ( $processed ) {
					foreach ( $processed as $ate_job_id => $ate_job_data ) {
						if ( array_key_exists( $ate_job_id, $job_ids_map ) ) {
							$wpml_job_id = (int) $job_ids_map[ $ate_job_id ];

							if ( $this->is_delivered_job_being_edited( $wpml_job_id, $ate_job_data ) ) {
								continue;
							}

							try {
								$is_translations_applied = $this->maybe_apply_translation( $ate_job_data );
							} catch ( Exception $e ) {
								if ( ! $ignore_errors ) {
									throw new RuntimeException( $e->getMessage(), $e->getCode() );
								}

								continue;
							}

							if ( $is_translations_applied ) {
								$this->ate_jobs->store( $wpml_job_id, $ate_job_data );

								if ( $this->must_acknowledge_ATE( $ate_job_data ) ) {
									$this->confirm_received_job( $ate_job_id, $ignore_errors );
								}

								$jobs_with_translation_applied[] = $wpml_job_id;
							} else {
								$this->ate_jobs->store( $wpml_job_id, $ate_job_data );

								if ( isset( $ate_job_data['status_id'] ) ) {
									$this->ate_jobs->set_wpml_status_from_ate( $wpml_job_id, (int) $ate_job_data['status_id'] );
								}
							}
						}
					}
				}
			}
		}

		return $jobs_with_translation_applied;
	}

	/**
	 * This situation happens when a job was delivered
	 * and the translator is editing the job but he did not
	 * click on the "Redeliver" button yet.
	 *
	 * @param int   $wpml_job_id
	 * @param array $ate_job_data
	 *
	 * @return bool
	 */
	private function is_delivered_job_being_edited( $wpml_job_id, array $ate_job_data ) {
		return isset( $ate_job_data['status_id'] )
			   && WPML_TM_ATE_AMS_Endpoints::ATE_JOB_STATUS_DELIVERED === $ate_job_data['status_id']
			   && $this->ate_jobs->is_editing_job( $wpml_job_id );
	}

	/**
	 * If we have an XLIFF URL, we will fetch the remote file
	 * and try to apply it.
	 *
	 * @param array $ate_job_data
	 *
	 * @return bool
	 * @throws Requests_Exception
	 */
	private function maybe_apply_translation( array $ate_job_data ) {
		if ( isset( $ate_job_data['translated_xliff'] ) ) {
			$xliff_content = $this->ate_api->get_remote_xliff_content( $ate_job_data['translated_xliff'] );

			if ( $xliff_content ) {
				return $this->ate_jobs->apply( $xliff_content );
			}
		}

		return false;
	}

	/**
	 * @param $ate_job_id
	 * @param $ignore_errors
	 *
	 * @return bool
	 */
	private function confirm_received_job( $ate_job_id, $ignore_errors ) {
		$confirmation_response = $this->ate_api->confirm_received_job( $ate_job_id );
		try {
			$this->check_response_error( $confirmation_response );

			return true;
		} catch ( Exception $ex ) {
			if ( ! $ignore_errors ) {
				throw new $ex;
			}

			return false;
		}
	}

	/**
	 * @param mixed $response
	 *
	 * @throws \RuntimeException
	 */
	protected function check_response_error( $response ) {
		if ( is_wp_error( $response ) ) {
			$code    = 0;
			$message = $response->get_error_message();
			if ( $response->error_data && is_array( $response->error_data ) ) {
				foreach ( $response->error_data as $http_code => $error_data ) {
					$code    = $error_data[0]['status'];
					$message = '';

					switch ( (int) $code ) {
						case self::RESPONSE_ATE_NOT_ACTIVE_ERROR:
							$wp_admin_url = admin_url( 'admin.php' );
							$mcsetup_page = add_query_arg( array(
								'page' => WPML_TM_FOLDER . WPML_Translation_Management::PAGE_SLUG_SETTINGS,
								'sm'   => 'mcsetup',
							), $wp_admin_url );
							$mcsetup_page .= '#ml-content-setup-sec-1';

							$resend_link = '<a href="' . $mcsetup_page . '">'
							               . esc_html__( 'Resend that email', 'wpml-translation-management' )
							               . '</a>';
							$message     .= '<p>'
							                . esc_html__( 'WPML cannot send these documents to translation because the Advanced Translation Editor is not fully set-up yet.', 'wpml-translation-management' )
							                . '</p><p>'
							                . esc_html__( 'Please open the confirmation email that you received and click on the link inside it to confirm your email.', 'wpml-translation-management' )
							                . '</p><p>'
							                . $resend_link
							                . '</p>';
							break;
						case self::RESPONSE_ATE_DUPLICATED_SOURCE_ID:
						case self::RESPONSE_ATE_UNEXPECTED_ERROR:
						default:
							$message = '<p>'
							           . __( 'Advanced Translation Editor error:', 'wpml-translation-management' )
							           . '</p><p>'
							           . $error_data[0]['message']
							           . '</p>';
					}

					$message = '<p>' . $message . '</p>';
				}
			}
			/** @var WP_Error $response */
			throw new RuntimeException( $message, $code );
		}
	}

	/**
	 * @param $ate_job_id
	 */
	private function resign_job_on_error( $ate_job_id ) {
		$job_id = $this->ate_jobs->get_wpml_job_id( $ate_job_id );
		if ( $job_id ) {
			wpml_load_core_tm()->resign_translator( $job_id );
		}
	}

	/**
	 * @param $translation_job
	 *
	 * @return bool
	 */
	private function is_ate_translation_job( $translation_job ) {
		return 'local' === $translation_job->translation_service
			   && WPML_TM_Editors::ATE === $translation_job->editor;
	}

	/**
	 * @param $post
	 *
	 * @return array|null|WP_Post
	 */
	private function get_wp_post( $post ) {
		if ( ! $post instanceof WP_Post ) {
			if ( isset( $post->ID ) ) {
				$post = get_post( $post->ID );
			} else {
				$post = null;
			}
		}

		return $post;
	}

	/**
	 * @return bool
	 */
	private function is_edit_list_page_of_a_translatable_type() {
		return $this->current_screen->is_edit_posts_list()
		       && $this->sitepress->is_translated_post_type( $this->current_screen->get_post_type() );
	}

	/**
	 * @return bool
	 */
	private function is_edit_page_of_a_translatable_type() {
		return $this->current_screen->is_edit_post()
		       && $this->sitepress->is_translated_post_type( $this->current_screen->get_post_type() );
	}

	/**
	 * @param int    $trid
	 * @param string $element_type
	 *
	 * @return mixed
	 */
	private function get_original_element( $trid, $element_type ) {
		if ( ! array_key_exists( $trid, $this->trid_original_element_map ) ) {
			$element_translation = $this->sitepress->get_original_element_translation( $trid, $element_type );
			if ( $element_translation ) {
				$this->trid_original_element_map[ $trid ] = $element_translation;

				return $element_translation;
			}
		}

		return $this->trid_original_element_map[ $trid ];
	}

	/**
	 * @param $job_status
	 *
	 * @return bool
	 */
	private function must_acknowledge_ATE( $job_status ) {
		return $job_status['status_id'] === WPML_TM_ATE_AMS_Endpoints::ATE_JOB_STATUS_DELIVERING;
	}
}
