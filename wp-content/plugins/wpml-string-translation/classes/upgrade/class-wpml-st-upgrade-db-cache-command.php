<?php

class WPML_ST_Upgrade_Db_Cache_Command implements IWPML_St_Upgrade_Command {
	/** @var WPDB $wpdb */
	private $wpdb;

	/**
	 * @var string
	 */
	private $icl_string_pages_sql_prototype = '
	CREATE TABLE IF NOT EXISTS `%sicl_string_pages` (
	  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	  `string_id` bigint(20) unsigned NOT NULL,
	  `url_id` bigint(20) unsigned NOT NULL,
	  PRIMARY KEY (`id`),
	  KEY `string_to_url_id` (`url_id`),
	  INDEX ( `string_id` )
		)
	';

	/**
	 * @var string
	 */
	private $icl_string_urls_sql_prototype = '
	CREATE TABLE IF NOT EXISTS `%sicl_string_urls` (
	  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	  `language` varchar(7) %s DEFAULT NULL,
	  `url` varchar(255) DEFAULT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `string_string_lang_url` (`language`,`url`(191))
	)
	';

	/**
	 * @param WPDB $wpdb
	 */
	public function __construct( $wpdb ) {
		$this->wpdb = $wpdb;
	}


	public function run() {
		$this->wpdb->query( "DROP TABLE IF EXISTS `{$this->wpdb->prefix}icl_string_pages`" );
		$this->wpdb->query( "DROP TABLE IF EXISTS `{$this->wpdb->prefix}icl_string_urls`" );

		$charset_collate = $this->get_charset_collate();
		$language_charset_and_collation   = $this->get_language_charset_and_collation();

		$icl_string_urls_sql = sprintf( $this->icl_string_urls_sql_prototype, $this->wpdb->prefix, $language_charset_and_collation );
		$icl_string_urls_sql .= $charset_collate;

		$result = $this->wpdb->query( $icl_string_urls_sql );

		if ( $result ) {
			$icl_string_pages_sql = sprintf( $this->icl_string_pages_sql_prototype, $this->wpdb->prefix );
			$icl_string_pages_sql .= $charset_collate;
			$result = $this->wpdb->query( $icl_string_pages_sql );
		}

		return false !== $result;
	}

	public function run_ajax() {
		return $this->run();
	}

	public function run_frontend() {
	}

	/**
	 * @return string
	 */
	public static function get_command_id() {
		return __CLASS__ . '_2.4.2_2';
	}


	/**
	 * @return string
	 */
	private function get_charset_collate() {
		$charset_collate = '';
		if ( method_exists( $this->wpdb, 'has_cap' ) && $this->wpdb->has_cap( 'collation' ) ) {
			$charset_collate = $this->wpdb->get_charset_collate();
		}

		return $charset_collate;
	}

	private function get_language_charset_and_collation() {
		$column_data = $this->wpdb->get_results( "SELECT * FROM INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='{$this->wpdb->prefix}icl_strings' AND TABLE_SCHEMA='{$this->wpdb->dbname}' " );
		foreach ( $column_data as $column ) {
			if ( 'language' === $column->COLUMN_NAME ) {
				return 'CHARACTER SET ' . $column->CHARACTER_SET_NAME . ' COLLATE ' . $column->COLLATION_NAME;
			}
		}

		return '';
	}

}