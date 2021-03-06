<?php

class WPML_TM_MCS_Term_Custom_Field_Settings_Menu extends WPML_TM_MCS_Custom_Field_Settings_Menu {

	/**
	 * @return string
	 */
	protected function get_meta_type() {
		return WPML_Custom_Field_Setting_Query_Factory::TYPE_TERMMETA;
	}

	/**
	 * @param string $key
	 *
	 * @return WPML_Term_Custom_Field_Setting
	 */
	protected function get_setting( $key ) {
		return $this->settings_factory->term_meta_setting( $key );
	}

	/**
	 * @return string
	 */
	protected function get_title() {
		return __( 'Custom Term Meta Translation', 'wpml-translation-management' );
	}

	/**
	 * @return string
	 */
	protected function kind_shorthand() {
		return 'tcf';
	}

	/**
	 * @return string
	 */
	public function get_no_data_message() {
		return __( 'No term meta found. It is possible that they will only show up here after you add/create them.', 'wpml-translation-management' );
	}

	/**
	 * @param string $id
	 *
	 * @return string
	 */
	public function get_column_header( $id ) {
		$header = $id;
		if('name' === $id) {
			$header = __( 'Term Meta', 'wpml-translation-management' );
		}
		return $header;
	}

}