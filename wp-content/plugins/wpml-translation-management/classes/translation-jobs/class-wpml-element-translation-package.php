<?php

/**
 * Class WPML_Element_Translation_Package
 *
 * @package wpml-core
 */
class WPML_Element_Translation_Package extends WPML_Translation_Job_Helper {

	/** @var WPML_WP_API $wp_api */
	private $wp_api;

	public function __construct( WPML_WP_API $wp_api = null ) {
		global $sitepress;
		if ( $wp_api ) {
			$this->wp_api = $wp_api;
		} else {
			$this->wp_api = $sitepress->get_wp_api();
		}
	}

	/**
	 * create translation package
	 *
	 * @param object|int $post
	 *
	 * @return array
	 */
	public function create_translation_package( $post ) {
		global $sitepress;

		$package = array();
		$post    = is_numeric( $post ) ? get_post( $post ) : $post;
		if ( apply_filters( 'wpml_is_external', false, $post ) ) {
			/** @var stdClass $post */
			$post_contents = (array) $post->string_data;
			$original_id   = isset( $post->post_id ) ? $post->post_id : $post->ID;
			$type          = 'external';

			if ( isset( $post->title ) ) {
				$package['title'] = apply_filters( 'wpml_tm_external_translation_job_title', $post->title, $original_id );
			}

			if ( empty( $package['title'] ) ) {
				$package['title'] = sprintf(
					__( 'External package ID: %d', 'wpml-translation-management' ),
					$original_id
				);
			}

		} else {
			$home_url         = get_home_url();
			$package['url']   = htmlentities( $home_url . '?' . ( $post->post_type === 'page' ? 'page_id' : 'p' ) . '=' . ( $post->ID ) );
			$package['title'] = $post->post_title;

			$post_contents = array(
				'title'   => $post->post_title,
				'body'    => $post->post_content,
				'excerpt' => $post->post_excerpt
			);

			if ( wpml_get_setting_filter( false, 'translated_document_page_url' ) === 'translate' ) {
				$post_contents['URL'] = $post->post_name;
			}

			$original_id             = $post->ID;

			$custom_fields_to_translate = array_keys(
				$this->get_tm_setting( array( 'custom_fields_translation' ) ),
				WPML_TRANSLATE_CUSTOM_FIELD
			);

			if ( ! empty( $custom_fields_to_translate ) ) {
				$package = $this->add_custom_field_contents(
					$package,
					$post,
					$custom_fields_to_translate,
					$this->get_tm_setting( array( 'custom_fields_encoding' ) )
				);
			}

			foreach ( (array) $sitepress->get_translatable_taxonomies( false, $post->post_type ) as $taxonomy ) {
				$terms = get_the_terms( $post->ID, $taxonomy );
				if ( is_array( $terms ) ) {
					foreach ( $terms as $term ) {
						$post_contents[ 't_' . $term->term_taxonomy_id ] = $term->name;
					}
				}
			}
			$type = 'post';
		}
		$package['contents']['original_id'] = array(
			'translate' => 0,
			'data'      => $original_id,
		);
		$package['type']                    = $type;

		foreach ( $post_contents as $key => $entry ) {
			$package['contents'][ $key ] = array(
				'translate' => 1,
				'data'      => base64_encode( $entry ),
				'format'    => 'base64',
			);
		}

		return apply_filters( 'wpml_tm_translation_job_data', $package, $post );
	}

	/**
	 * @param array $translation_package
	 * @param array $prev_translation
	 * @param int $job_id
	 */
	public function save_package_to_job( array $translation_package, $job_id, $prev_translation ) {
		global $wpdb;

		$show = $wpdb->hide_errors();

		foreach ( $translation_package['contents'] as $field => $value ) {
			$job_translate = array(
				'job_id'                => $job_id,
				'content_id'            => 0,
				'field_type'            => $field,
				'field_wrap_tag'        => isset( $value['wrap_tag'] ) ? $value['wrap_tag'] : '',
				'field_format'          => isset( $value['format'] ) ? $value['format'] : '',
				'field_translate'       => $value['translate'],
				'field_data'            => $value['data'],
				'field_data_translated' => '',
				'field_finished'        => 0,
			);

			if ( array_key_exists( $field, $prev_translation ) ) {
				$job_translate['field_data_translated'] = $prev_translation[ $field ]->get_translation();
				$job_translate['field_finished']        = $prev_translation[ $field ]->is_finished( $value['data'] );
			}

			$job_translate = $this->filter_non_translatable_fields( $job_translate );

			$wpdb->insert( $wpdb->prefix . 'icl_translate', $job_translate );
		}

		$wpdb->show_errors( $show );
	}

	/**
	 * @param array $job_translate
	 *
	 * @return mixed|void
	 */
	private function filter_non_translatable_fields( $job_translate ) {

		if ( $job_translate['field_translate'] ) {
			$data = $job_translate['field_data'];
			if ( 'base64' === $job_translate['field_format'] ) {
				$data = base64_decode( $data );
			}
			$is_translatable = ! WPML_String_Functions::is_not_translatable( $data ) && apply_filters( 'wpml_translation_job_post_meta_value_translated', 1, $job_translate['field_type'] );
			$is_translatable = (bool) apply_filters( 'wpml_tm_job_field_is_translatable', $is_translatable, $job_translate );
			if ( ! $is_translatable ) {
				$job_translate['field_translate']       = 0;
				$job_translate['field_data_translated'] = $job_translate['field_data'];
				$job_translate['field_finished']        = 1;
			}
		}

		return $job_translate;
	}

	/**
	 * @param object $job
	 * @param int    $post_id
	 * @param array  $fields
	 */
	function save_job_custom_fields( $job, $post_id, $fields ) {
		$field_names = array();

		foreach ( $fields as $field_name => $val ) {
			if ( '' === (string) $field_name ) {
				continue;
			}

			// find it in the translation.
			foreach ( $job->elements as $el_data ) {
				if (
					strpos( $el_data->field_data, (string) $field_name ) === 0
					&& 1 === preg_match( '/field-(.*?)-name/U', $el_data->field_type, $match )
					&& 1 === preg_match( '/field-' . $field_name . '-[0-9].*?-name/', $el_data->field_type )
				) {
					$field_names[ $field_name ] = isset( $field_names[ $field_name ] )
						? $field_names[ $field_name ] : array();

					$field_id_string   = $match[1];
					$field_translation = false;
					foreach ( $job->elements as $v ) {
						if ( $v->field_type === 'field-' . $field_id_string ) {
							$field_translation = $this->decode_field_data(
								$v->field_data_translated,
								$v->field_format
							);
						}
						if ( $v->field_type === 'field-' . $field_id_string . '-type' ) {
							$field_type = $v->field_data;
							break;
						}
					}
					if ( false !== $field_translation && isset( $field_type ) && 'custom_field' === $field_type ) {
						$field_translation = str_replace( '&#0A;', "\n", $field_translation );
						// always decode html entities  eg decode &amp; to &.
						$field_translation = html_entity_decode( $field_translation );
						$field_id_string   = $this->remove_field_name_from_start( $field_name, $field_id_string );
						$meta_keys         = explode( '-', $field_id_string );
						$meta_keys         = array_map( array( 'WPML_TM_Field_Type_Encoding', 'decode_hyphen' ), $meta_keys );
						$field_names       = $this->insert_under_keys(
							array_merge( array( $field_name ), $meta_keys ), $field_names, $field_translation
						);
					}
				}
			}
		}

		$this->save_custom_field_values( $field_names, $post_id );
	}

	/**
	 * Remove the field from the start of the string.
	 *
	 * @param string $field_name The field to remove.
	 * @param string $field_id_string The full field identifier.
	 * @return string
	 */
	private function remove_field_name_from_start( $field_name, $field_id_string ) {
		return preg_replace( '#' . $field_name . '-?#', '', $field_id_string, 1 );
	}

	/**
	 * Inserts an element into an array, nested by keys.
	 * Input ['a', 'b'] for the keys, an empty array for $array and $x for the value would lead to
	 * [ 'a' => ['b' => $x ] ] being returned.
	 *
	 * @param array $keys indexes ordered from highest to lowest level
	 * @param array $array array into which the value is to be inserted
	 * @param mixed $value to be inserted
	 *
	 * @return array
	 */
	private function insert_under_keys( $keys, $array, $value ) {
		$array[ $keys[0] ] = count( $keys ) === 1
			? $value
			: $this->insert_under_keys(
				array_slice( $keys, 1 ),
				( isset( $array[ $keys[0] ] ) ? $array[ $keys[0] ] : array() ),
				$value );

		return $array;
	}

	/**
	 * @param array $fields_in_job
	 * @param int   $post_id
	 */
	private function save_custom_field_values( $fields_in_job, $post_id ) {
		$encodings = $this->get_tm_setting( array( 'custom_fields_encoding' ) );
		foreach ( $fields_in_job as $name => $contents ) {
			$this->wp_api->delete_post_meta( $post_id, $name );

			$contents = (array) $contents;
			$single   = count( $contents ) === 1;
			$encoding = isset( $encodings[ $name ] ) ? $encodings[ $name ] : '';

			foreach ( $contents as $index => $value ) {

				if ( $encoding ) {
					$value = WPML_Encoding::encode( $value, $encoding );
				}

				$value = apply_filters( 'wpml_encode_custom_field', $value, $name );
				$value = $this->prevent_strip_slash_on_json( $value, $encoding );

				$this->wp_api->add_post_meta( $post_id, $name, $value, $single );
			}
		}
	}

	/**
	 * The core function `add_post_meta` always performs
	 * a `stripslashes_deep` on the value. We need to escape
	 * once more before to call the function.
	 *
	 * @param string $value
	 * @param string $encoding
	 *
	 * @return string
	 */
	private function prevent_strip_slash_on_json( $value, $encoding ) {
		if ( in_array( 'json', explode( ',', $encoding ) ) ) {
			$value = wp_slash( $value );
		}

		return $value;
	}

	/**
	 * @param array $package
	 * @param object $post
	 * @param array $fields_to_translate
	 * @param array $fields_encoding
	 *
	 * @return array
	 */
	private function add_custom_field_contents( $package, $post, $fields_to_translate, $fields_encoding ) {
		foreach ( $fields_to_translate as $key ) {
			$encoding             = isset( $fields_encoding[ $key ] ) ? $fields_encoding[ $key ] : '';
			$custom_fields_values = array_values( array_filter( get_post_meta( $post->ID, $key ) ) );
			foreach ( $custom_fields_values as $index => $custom_field_val ) {
				$custom_field_val = apply_filters( 'wpml_decode_custom_field', $custom_field_val, $key );
				$package          = $this->add_single_field_content( $package, $key, array( $index ), $custom_field_val, $encoding );
			}
		}

		return $package;
	}

	/**
	 * For array valued custom fields cf is given in the form field-{$field_name}-join('-', $indicies)
	 *
	 * @param array $package
	 * @param string $key
	 * @param array $custom_field_index
	 * @param array|stdClass|string $custom_field_val
	 * @param string $encoding
	 *
	 * @return array
	 */
	private function add_single_field_content( $package, $key, $custom_field_index, $custom_field_val, $encoding ) {
		if ( $encoding && is_scalar( $custom_field_val ) ) {
			$custom_field_val = WPML_Encoding::decode( $custom_field_val, $encoding );
			$encoding = '';
		}
		if ( is_scalar( $custom_field_val ) ) {
			list( $cf, $key_index ) = WPML_TM_Field_Type_Encoding::encode($key, $custom_field_index );
			$package['contents'][ $cf ] = array(
				'translate' => 1,
				'data'      => base64_encode( $custom_field_val ),
				'format'    => 'base64',
			);
			$package['contents'][ $cf . '-name' ] = array(
				'translate' => 0,
				'data'      => $key_index,
			);
			$package['contents'][ $cf . '-type' ] = array(
				'translate' => 0,
				'data'      => 'custom_field',
			);

		} else {
			foreach ( (array) $custom_field_val as $ind => $value ) {
				$package = $this->add_single_field_content(
					$package,
					$key,
					array_merge( $custom_field_index, array( $ind ) ),
					$value,
					$encoding
				);
			}
		}

		return $package;
	}
}
