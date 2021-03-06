<?php

class WPML_Translation_Manager_View extends WPML_Twig_Template_Loader implements IWPML_Translation_Roles_View {

	const TEMPLATE_PATH = '/templates/menus/translation-managers';

	public function __construct() {
		parent::__construct( array( WPML_TM_PATH . self::TEMPLATE_PATH ) );
	}

	public function show( $model, $template ) {
		$model['strings'] = self::get_strings();
		$model['dialog']  = self::add_add_translation_manager_dialog();

		return $this->get_template()->show( $model, $template );
	}

	public static function get_strings() {
		return array(
			'title'         => __( 'Translation Managers', 'wpml-translation-management' ),
			'column_name'   => __( 'Name', 'wpml-translation-management' ),
			'edit'          => __( 'Edit user', 'wpml-translation-management' ),
			'remove'        => __( 'Remove Translation Manager', 'wpml-translation-management' ),
			'no_users'      => __( "This site doesn't yet have a Translation Manager.", 'wpml-translation-management' ),
			'placeholder'   => __( 'Search for user', 'wpml-translation-management' ),
			'add_button'    => __( 'Add a Translation Manager', 'wpml-translation-management' ),
			'first_name'    => __( 'First name:', 'wpml-translation-management' ),
			'last_name'     => __( 'Last name:', 'wpml-translation-management' ),
			'email'         => __( 'Email:', 'wpml-translation-management' ),
			'user_name'     => __( 'User name:', 'wpml-translation-management' ),
			'wp_role'       => __( 'WordPress role:', 'wpml-translation-management' ),
			'existing_user' => __( 'Select an existing WordPress user (needs to be an editor or above)', 'wpml-translation-management' ),
			'new_user'      => __( 'Create a new user to be the Translation Manager', 'wpml-translation-management' ),
			'set_user'      => __( 'Set a Translation Manager', 'wpml-translation-management' ),
			'add_user'      => __( 'Add a Translation Manager', 'wpml-translation-management' ),
		);
	}

	public static function add_add_translation_manager_dialog() {
		return array(
			'id'      => 'js-add-translation-manager-dialog',
			'class'   => '',
			'nonce'   => wp_create_nonce( WPML_Translation_Manager_Settings::NONCE_ACTION ),
			'strings' => array(
				'title'         => __( 'Add a Translation Manager', 'wpml-translation-management' ),
				'add_text'      => __( 'Add a Translation Manager', 'wpml-translation-management' ),
				'cancel_text'   => __( 'Cancel', 'wpml-translation-management' ),
				'existing_user' => __( 'Select an existing user and set as Translation Manager', 'wpml-translation-management' ),
				'new_user'      => __( 'Create a new user and set as Translation Manager', 'wpml-translation-management' ),
			),
		);
	}
}
