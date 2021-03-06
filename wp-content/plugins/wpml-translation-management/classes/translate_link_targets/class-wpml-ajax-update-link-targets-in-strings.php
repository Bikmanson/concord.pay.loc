<?php

class WPML_Ajax_Update_Link_Targets_In_Strings extends WPML_Ajax_Update_Link_Targets_In_Content {

	private $wp_api;
	private $pro_translation;
	public function __construct( WPML_Translate_Link_Target_Global_State $translate_link_target_global_state, &$wpdb, $wp_api, $pro_translation, $post_data ) {
		$this->wp_api = $wp_api;
		$this->pro_translation = $pro_translation;
		parent::__construct( $translate_link_target_global_state, $wpdb, $post_data );
	}

	protected function create_translate_link_target() {
		return new WPML_Translate_Link_Targets_In_Strings_Global( $this->translate_link_target_global_state, $this->wpdb, $this->wp_api, $this->pro_translation );
	}
}
