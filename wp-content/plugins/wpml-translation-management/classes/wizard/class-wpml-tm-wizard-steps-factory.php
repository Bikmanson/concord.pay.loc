<?php

class WPML_TM_Wizard_Steps_Factory implements IWPML_AJAX_Action_Loader {

	/**
	 * @return IWPML_Action|WPML_TM_Wizard_Steps
	 */
	public function create() {
		global $wpdb, $sitepress;

		$wp_roles = wp_roles();

		return new WPML_TM_Wizard_Steps(
			new WPML_Translation_Manager_Records( $wpdb, new WPML_WP_User_Query_Factory(), $wp_roles ),
			new WPML_Translator_Records( $wpdb, new WPML_WP_User_Query_Factory(), $wp_roles ),
			new WPML_TM_Translation_Services_Admin_Section_Factory(),
			new WPML_Language_Pair_Records( $wpdb, new WPML_Language_Records( $wpdb ) ),
			$sitepress
		);
	}
}
