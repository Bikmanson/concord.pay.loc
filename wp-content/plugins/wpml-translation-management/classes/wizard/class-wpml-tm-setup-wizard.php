<?php

class WPML_TM_Setup_Wizard extends WPML_Wizard {

	const INITIAL_STEP = 'tm_who_will_translate';

	/**
	 * @var WPML_TM_MCS_ATE_Strings
	 */
	private $scripts_factory;

	/**
	 * WPML_TM_Wizard_For_Manager constructor.
	 *
	 * @param WPML_TM_Scripts_Factory $mcs_ate
	 */
	public function __construct( WPML_TM_Scripts_Factory $mcs_ate ) {
		parent::__construct();

		$this->scripts_factory = $mcs_ate;
	}

	protected function initialize_steps() {
		$this->add_step(
			'tm_who_will_translate',
			__( 'Who will translate this site?', 'wpml-translation-management' )
		);
		$this->add_step(
			'tm_translation_editor',
			__( 'What translation tool do you want to use?', 'wpml-translation-management' )
		);
		$this->add_step(
			'tm_summary',
			__( 'Summary', 'wpml-translation-management' )
		);
		$this->set_current_step( get_option( WPML_TM_Wizard_Options::CURRENT_STEP, self::INITIAL_STEP ) );
	}

	protected function enqueue_scripts() {

		wp_register_script( 'wpml-tm-wizard', WPML_TM_URL . '/dist/js/wizard/app.js', array(
			'wpml-wizard',
			//Real dependency - wpml-tm-wizard uses otgsPopoverTooltip.initialize() from OTGS-UI
			OTGS_Assets_Handles::POPOVER_TOOLTIP
			), WPML_TM_VERSION, true );

		wp_localize_script(
			'wpml-tm-wizard',
			'WPML_TM_wizard',
			array(
				'strings' =>
					array(
						'deactivate'    => __( 'Deactivate', 'wpml-translation-management' ),
						'documentation' => __( 'Documentation', 'wpml-translation-management' ),
					)
			)
		);

		$this->scripts_factory->localize_script( 'wpml-tm-wizard' );
		$this->scripts_factory->register_otgs_notices();


		wp_enqueue_script( 'wpml-tm-wizard' );
		wp_enqueue_style(  OTGS_Assets_Handles::POPOVER_TOOLTIP  );

		wp_enqueue_script( 'wpml-select-2', ICL_PLUGIN_URL . '/lib/select2/select2.min.js', array( 'jquery' ), ICL_SITEPRESS_VERSION, true );

		wp_enqueue_script( 'wpml-tm-translation-roles-select2',
			WPML_TM_URL . '/res/js/translation-roles-select2.js',
			array(),
			WPML_TM_VERSION );

		wp_enqueue_script( 'wpml-tm-set-translation-roles',
			WPML_TM_URL . '/res/js/set-translation-role.js',
			array( 'underscore' ),
			WPML_TM_VERSION );

		wp_register_style( 'wpml-tm-wizard', WPML_TM_URL . '/res/css/wpml-tm-wizard.css' );
		wp_enqueue_style( 'wpml-tm-wizard' );

		wp_enqueue_style(
			'wpml-tm-ts-admin-section',
			WPML_TM_URL . '/res/css/admin-sections/translation-services.css',
			array(),
			WPML_TM_VERSION
		);

		wp_enqueue_script(
			'wpml-tm-ts-admin-section',
			WPML_TM_URL . '/res/js/translation-services.js',
			array(),
			WPML_TM_VERSION
		);


	}

}