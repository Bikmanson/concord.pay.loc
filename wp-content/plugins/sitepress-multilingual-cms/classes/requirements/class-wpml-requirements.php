<?php
/**
 * @author OnTheGo Systems
 */
class WPML_Requirements {
	private $active_plugins       = array();
	private $disabled_plugins     = array();
	private $missing_requirements = array();

	private $plugins = array(
		'wpml-media-translation'     => array(
			'version' => '2.1.24',
			'name'    => 'WPML Media Translation',
		),
		'wpml-string-translation'     => array(
			'version' => '2.5.2',
			'name'    => 'WPML String Translation',
		),
		'wpml-translation-management' => array(
			'version' => '2.2.7',
			'name'    => 'WPML Translation Management',
		),
		'woocommerce-multilingual'    => array(
			'version' => '4.7.0',
			'name'    => 'WooCommerce Multilingual',
			'url'     => 'https://wpml.org/download/woocommerce-multilingual/',
		),
		'gravityforms-multilingual'   => array(
			'name' => 'GravityForms Multilingual',
			'url'  => 'https://wpml.org/download/gravityforms-multilingual/',
		),
		'buddypress-multilingual'     => array(
			'name' => 'BuddyPress Multilingual',
			'url'  => 'https://wpml.org/download/buddypress-multilingual/',
		),
		'wp-seo-multilingual'     => array(
			'name' => 'Yoast SEO Multilingual',
			'url'  => 'https://wpml.org/download/yoast-seo-multilingual/',
		),
	);

	private $modules = array(
		WPML_Integrations::SCOPE_WP_CORE => array(
			'url'                => 'https://wpml.org/?page_id=2909360&utm_source=wpmlplugin&utm_campaign=gutenberg&utm_medium=translation-editor&utm_term=translating-content-created-using-gutenberg-editor',
			'requirements_class' => 'WPML_Integration_Requirements_Block_Editor',
		),
		'page-builders' => array(
			'url'          => 'https://wpml.org/?page_id=1129854',
			'requirements' => array(
				'wpml-string-translation',
				'wpml-translation-management',
			),
		),
		'woocommerce'   => array(
			'url'          => '#',
			'requirements' => array(
				'woocommerce-multilingual',
				'wpml-translation-management',
				'wpml-string-translation',
			),
		),
		'gravityforms'  => array(
			'url'          => '#',
			'requirements' => array(
				'gravityforms-multilingual',
				'wpml-string-translation',
				'wpml-translation-management',
			),
		),
		'buddypress'    => array(
			'url'          => '#',
			'requirements' => array(
				'buddypress-multilingual',
			),
		),
		'bb-plugin'    => array(
			'url'          => '#',
			'requirements' => array(
				'wpml-string-translation',
			),
		),
		'elementor-plugin'    => array(
			'url'          => '#',
			'requirements' => array(
				'wpml-string-translation',
			),
		),
		'wordpress-seo'	=> array(
			'url'          => '#',
			'requirements' => array(
				'wp-seo-multilingual',
			)
		),
	);

	/**
	 * WPML_Requirements constructor.
	 */
	public function __construct() {
		if ( function_exists( 'get_plugins' ) ) {
			$installed_plugins = get_plugins();
			foreach ( $installed_plugins as $plugin_file => $plugin_data ) {
				$plugin_slug = $this->get_plugin_slug( $plugin_data );
				if ( is_plugin_active( $plugin_file ) ) {
					$this->active_plugins[ $plugin_slug ] = $plugin_data;
				} else {
					$this->disabled_plugins[ $plugin_slug ] = $plugin_file;
				}
			}
		}
	}

	public function is_plugin_active( $plugin_slug ) {
		return array_key_exists( $plugin_slug, $this->active_plugins );
	}

	/**
	 * @param array $plugin_data
	 *
	 * @return string|null
	 */
	public function get_plugin_slug( array $plugin_data ) {
		$plugin_slug = null;
		if ( array_key_exists( 'Plugin Slug', $plugin_data ) && $plugin_data['Plugin Slug'] ) {
			$plugin_slug = $plugin_data['Plugin Slug'];
		} elseif ( array_key_exists( 'TextDomain', $plugin_data ) && $plugin_data['TextDomain'] ) {
			$plugin_slug = $plugin_data['TextDomain'];
		} elseif ( array_key_exists( 'Name', $plugin_data ) && $plugin_data['Name'] ) {
			$plugin_slug = $plugin_data['Name'];
		}

		return $plugin_slug;
	}

	/**
	 * @return array
	 */
	public function get_missing_requirements() {
		return $this->missing_requirements;
	}

	/**
	 * @param string $type
	 * @param string $slug
	 *
	 * @return array
	 */
	public function get_requirements( $type, $slug ) {
		$missing_plugins = $this->get_missing_plugins_for_type( $type, $slug );

		$requirements = array();

		if ( $missing_plugins ) {
			foreach ( $this->get_components_requirements_by_type( $type, $slug ) as $plugin_slug ) {
				$requirement            = $this->get_plugin_data( $plugin_slug );
				$requirement['missing'] = false;
				if ( in_array( $plugin_slug, $missing_plugins, true ) ) {
					$requirement['missing'] = true;

					if ( array_key_exists( $plugin_slug, $this->disabled_plugins ) ) {
						$requirement['disabled']         = true;
						$requirement['plugin_file']      = $this->disabled_plugins[ $plugin_slug ];
						$requirement['activation_nonce'] = wp_create_nonce( 'activate_' . $this->disabled_plugins[ $plugin_slug ] );
					}

					$this->missing_requirements[] = $requirement;
				}
				$requirements[] = $requirement;
			}
		}

		return $requirements;
	}

	/**
	 * @param string $slug
	 *
	 * @return array
	 */
	function get_plugin_data( $slug ) {
		if ( array_key_exists( $slug, $this->plugins ) ) {
			return $this->plugins[ $slug ];
		}

		return array();
	}

	/**
	 * @param string $type
	 * @param string $slug
	 *
	 * @return array
	 */
	private function get_missing_plugins_for_type( $type, $slug ) {
		$requirements_keys   = $this->get_components_requirements_by_type( $type, $slug );
		$active_plugins_keys = array_keys( $this->active_plugins );

		return array_diff( $requirements_keys, $active_plugins_keys );
	}

	/**
	 * @return array
	 */
	private function get_components() {
		return apply_filters( 'wpml_requirements_components', $this->modules );
	}

	/**
	 * @param string $type
	 * @param string $slug
	 *
	 * @return array
	 */
	private function get_components_by_type( $type, $slug ) {
		$components = $this->get_components();
		if ( array_key_exists( $type, $components ) ) {
			return $components[ $type ];
		}
		if ( array_key_exists( $slug, $components ) ) {
			return $components[ $slug ];
		}

		return array();
	}

	/**
	 * @param string $type
	 * @param string $slug
	 *
	 * @return array
	 */
	private function get_components_requirements_by_type( $type, $slug ) {
		$components_requirements = $this->get_components_by_type( $type, $slug );
		$requirements = array();

		if ( array_key_exists( 'requirements', $components_requirements ) ) {
			$requirements = $components_requirements['requirements'];
		} elseif ( array_key_exists( 'requirements_class', $components_requirements ) ) {
			try {
				$class = $components_requirements['requirements_class'];
				/** @var IWPML_Integration_Requirements_Module $requirement_module */
				$requirement_module = new $class( $this );
				$requirements = $requirement_module->get_requirements();
			} catch ( Exception $e ) {}
		}

		return $requirements;
	}
}
