<?php

namespace WPML\ST\MO\Scan\UI;

use WPML\ST\MO\Generate\Process\ProcessFactory;
use WPML_ST_Translations_File_Dictionary_Storage_Table;
use WPML_ST_Translations_File_Dictionary;
use WPML\WP\OptionManager;
use function WPML\Container\make;

class Factory implements \IWPML_Backend_Action_Loader {

	const WPML_VERSION_INTRODUCING_ST_MO_FLOW = '4.3.0';
	const OPTION_GROUP = 'ST-MO';
	const IGNORE_WPML_VERSION = 'ignore-wpml-version';

	/**
	 * @return \IWPML_Action|UI|null
	 * @throws \Auryn\InjectionException
	 */
	public function create() {
		if ( current_user_can( 'manage_options' ) ) {
			global $sitepress;
			$wp_api = $sitepress->get_wp_api();

			$options            = make( OptionManager::class );
			$pre_gen_dissmissed = $options->get( self::OPTION_GROUP, 'pregen-dismissed', false );
			$st_page            = $wp_api->is_core_page( 'theme-localization.php' ) || $wp_api->is_string_translation_page();

			if (
				( $st_page || ( ! $st_page && ! $pre_gen_dissmissed ) )
				&& ( $this->hasTranslationFilesTable() || is_network_admin() )
			) {
				$files_to_import               = $st_page ? $this->getFilesToImport() : wpml_collect( [] );
				$domains_to_pre_generate_count = self::getDomainsToPreGenerateCount();
				if ( $files_to_import->count() || $domains_to_pre_generate_count ) {
					return new UI(
						Model::provider( $files_to_import, $domains_to_pre_generate_count, $st_page, is_network_admin() ),
						$st_page
					);
				}
			}
		}
	}

	/**
	 * @return int
	 * @throws \Auryn\InjectionException
	 */
	private function getFilesToImport() {
		/** @var WPML_ST_Translations_File_Dictionary $file_dictionary */
		$file_dictionary = make(
			WPML_ST_Translations_File_Dictionary::class,
			[ 'storage' => WPML_ST_Translations_File_Dictionary_Storage_Table::class ]
		);

		$file_dictionary->clear_skipped();

		return wpml_collect( $file_dictionary->get_not_imported_files() );
	}

	/**
	 * @return bool
	 */
	private static function isPreGenerationRequired() {
		return self::shouldIgnoreWpmlVersion() || self::wpmlStartVersionBeforeMOFlow();
	}

	/**
	 * @return bool
	 */
	private static function wpmlStartVersionBeforeMOFlow() {
		return version_compare(
			get_option( \WPML_Installation::WPML_START_VERSION_KEY, '0.0.0' ),
			self::WPML_VERSION_INTRODUCING_ST_MO_FLOW,
			'<'
		);
	}

	/**
	 * @return int
	 * @throws \Auryn\InjectionException
	 */
	public static function getDomainsToPreGenerateCount() {
		return self::isPreGenerationRequired() ? make( ProcessFactory::class )->create()->getPagesCount() : 0;
	}

	/**
	 * @return bool
	 * @throws \Auryn\InjectionException
	 */
	private function hasTranslationFilesTable() {
		return make( \WPML_Upgrade_Schema::class )->does_table_exist( 'icl_mo_files_domains' );
	}

	/**
	 * @return bool
	 */
	public static function shouldIgnoreWpmlVersion() {
		return make( OptionManager::class )->get( self::OPTION_GROUP, self::IGNORE_WPML_VERSION, false );
	}

	public static function ignoreWpmlVersion() {
		make( OptionManager::class )->set( self::OPTION_GROUP, self::IGNORE_WPML_VERSION, true );
	}

	public static function clearIgnoreWpmlVersion() {
		make( OptionManager::class )->set( self::OPTION_GROUP, self::IGNORE_WPML_VERSION, false );
	}
}
