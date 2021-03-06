<?php

abstract class WPML_TM_Email_View {

	const FOOTER_TEMPLATE = 'email-footer.twig';
	const HEADER_TEMPLATE = 'email-header.twig';

	/** @var WPML_Twig_Template $template_service */
	protected $template_service;

	public function __construct( WPML_Twig_Template $template_service ) {
		$this->template_service = $template_service;
	}

	/**
	 * @param string $username
	 *
	 * @return string
	 */
	public function render_header( $username = '' ) {
		$model = array(
			'greetings' => sprintf( __( 'Dear %s,', 'wpml-translation-management' ), $username ),
		);

		return $this->template_service->show( $model, self::HEADER_TEMPLATE );
	}

	/**
	 * @param string $username
	 *
	 * @return string
	 */
	public function render_casual_header( $first_name = '' ) {
		$model = array(
			'greetings' => sprintf( __( 'Hi %s,', 'wpml-translation-management' ), $first_name ),
		);

		return $this->template_service->show( $model, self::HEADER_TEMPLATE );
	}

	/**
	 * @param string $bottom_text
	 *
	 * @return string
	 */
	protected function render_email_footer( $bottom_text = '' ) {
		$site_url = get_bloginfo( 'url' );

		$model = array(
			'bottom_text' => $bottom_text,
			'wpml_footer' => sprintf(
				esc_html__( 'Generated by WPML plugin, running on %s.', 'wpml-translation-management' ),
				'<a href="' . $site_url .'" style="color: #ffffff;">' . $site_url . '</a>'
			),
		);

		return $this->template_service->show( $model, self::FOOTER_TEMPLATE );
	}
}
