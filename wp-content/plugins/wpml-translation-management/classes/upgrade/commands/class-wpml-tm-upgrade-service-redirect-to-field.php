<?php

class WPML_TM_Upgrade_Service_Redirect_To_Field implements IWPML_Upgrade_Command {
	/** @var bool $result */
	private $result = true;

	/** @var WPML_TM_Translation_Services_Refresh */
	private $service_refresh;

	public function __construct( $args ) {
		if ( isset( $args[0] ) && $args[0] instanceof WPML_TM_Translation_Services_Refresh ) {
			$this->service_refresh = $args[0];
		}
	}

	/**
	 * Add the default terms for Translation Priority taxonomy
	 *
	 * @return bool
	 */
	private function run() {
		$this->result = $this->get_service_refresh()->refresh_services();

		return $this->result;
	}


	public function run_admin() {
		return $this->run();
	}

	public function run_ajax() {

	}

	public function run_frontend() {

	}

	/** @return bool */
	public function get_results() {
		return $this->result;
	}

	private function get_service_refresh() {
		if ( ! $this->service_refresh ) {
			$factory               = new WPML_TM_Translation_Services_Refresh_Services_Factory();
			$this->service_refresh = $factory->create_an_instance();
		}

		return $this->service_refresh;
	}
}