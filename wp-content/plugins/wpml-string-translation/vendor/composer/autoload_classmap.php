<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'IWPML_ST_Rewrite_Rule_Filter' => $baseDir . '/classes/slug-translation/iwpml-st-rewrite-rule-filter.php',
    'IWPML_ST_String_Scanner' => $baseDir . '/classes/strings-scanning/iwpml-st-string-scanner.php',
    'IWPML_ST_Translations_File' => $baseDir . '/classes/translations-file-scan/translations-file/iwpml-st-translations-file.php',
    'IWPML_St_Upgrade_Command' => $baseDir . '/classes/upgrade/interface-iwpml_st_upgrade_command.php',
    'WPML\\ST\\Actions' => $baseDir . '/classes/actions/Actions.php',
    'WPML\\ST\\Container\\Config' => $baseDir . '/classes/container/Config.php',
    'WPML\\ST\\DB\\Mappers\\StringsRetrieve' => $baseDir . '/classes/db-mappers/StringsRetrieve.php',
    'WPML\\ST\\Gettext\\AutoRegisterSettings' => $baseDir . '/classes/gettext-hooks/AutoRegisterSettings.php',
    'WPML\\ST\\Gettext\\Filters\\IFilter' => $baseDir . '/classes/gettext-hooks/filters/IFilter.php',
    'WPML\\ST\\Gettext\\Filters\\StringHighlighting' => $baseDir . '/classes/gettext-hooks/filters/StringHighlighting.php',
    'WPML\\ST\\Gettext\\Filters\\StringTracking' => $baseDir . '/classes/gettext-hooks/filters/StringTracking.php',
    'WPML\\ST\\Gettext\\Filters\\StringTranslation' => $baseDir . '/classes/gettext-hooks/filters/StringTranslation.php',
    'WPML\\ST\\Gettext\\Hooks' => $baseDir . '/classes/gettext-hooks/Hooks.php',
    'WPML\\ST\\Gettext\\HooksFactory' => $baseDir . '/classes/gettext-hooks/HooksFactory.php',
    'WPML\\ST\\Gettext\\Settings' => $baseDir . '/classes/gettext-hooks/Settings.php',
    'WPML\\ST\\MO\\File\\Builder' => $baseDir . '/classes/MO/File/Builder.php',
    'WPML\\ST\\MO\\File\\Generator' => $baseDir . '/classes/MO/File/Generator.php',
    'WPML\\ST\\MO\\File\\MOFactory' => $baseDir . '/classes/MO/File/MOFactory.php',
    'WPML\\ST\\MO\\File\\Manager' => $baseDir . '/classes/MO/File/Manager.php',
    'WPML\\ST\\MO\\File\\ManagerFactory' => $baseDir . '/classes/MO/File/ManagerFactory.php',
    'WPML\\ST\\MO\\File\\makeDir' => $baseDir . '/classes/MO/File/makeDir.php',
    'WPML\\ST\\MO\\Generate\\DomainsAndLanguagesRepository' => $baseDir . '/classes/MO/Generate/DomainsAndLanguagesRepository.php',
    'WPML\\ST\\MO\\Generate\\MissingMOFile' => $baseDir . '/classes/MO/Generate/GenerateMissingMOFile.php',
    'WPML\\ST\\MO\\Generate\\MultiSite\\Condition' => $baseDir . '/classes/MO/Generate/MultiSite/Condition.php',
    'WPML\\ST\\MO\\Generate\\MultiSite\\Executor' => $baseDir . '/classes/MO/Generate/MultiSite/Executor.php',
    'WPML\\ST\\MO\\Generate\\Process\\MultiSiteProcess' => $baseDir . '/classes/MO/Generate/Process/MultiSiteProcess.php',
    'WPML\\ST\\MO\\Generate\\Process\\Process' => $baseDir . '/classes/MO/Generate/Process/Process.php',
    'WPML\\ST\\MO\\Generate\\Process\\ProcessFactory' => $baseDir . '/classes/MO/Generate/Process/ProcessFactory.php',
    'WPML\\ST\\MO\\Generate\\Process\\SingleSiteProcess' => $baseDir . '/classes/MO/Generate/Process/SingleSiteProcess.php',
    'WPML\\ST\\MO\\Generate\\Process\\Status' => $baseDir . '/classes/MO/Generate/Process/Status.php',
    'WPML\\ST\\MO\\Generate\\Process\\SubSiteValidator' => $baseDir . '/classes/MO/Generate/Process/SubSiteValidator.php',
    'WPML\\ST\\MO\\Generate\\StringsRetrieveMOOriginals' => $baseDir . '/classes/MO/Generate/StringsRetrieveMOOriginals.php',
    'WPML\\ST\\MO\\Hooks\\CustomTextDomains' => $baseDir . '/classes/MO/Hooks/CustomTextDomains.php',
    'WPML\\ST\\MO\\Hooks\\Factory' => $baseDir . '/classes/MO/Hooks/Factory.php',
    'WPML\\ST\\MO\\Hooks\\LanguageSwitch' => $baseDir . '/classes/MO/Hooks/LanguageSwitch.php',
    'WPML\\ST\\MO\\Hooks\\LoadMissingMOFiles' => $baseDir . '/classes/MO/Hooks/LoadMissingMOFiles.php',
    'WPML\\ST\\MO\\Hooks\\LoadTextDomain' => $baseDir . '/classes/MO/Hooks/LoadTextDomain.php',
    'WPML\\ST\\MO\\JustInTime\\DefaultMO' => $baseDir . '/classes/MO/JustInTime/DefaultMO.php',
    'WPML\\ST\\MO\\JustInTime\\MO' => $baseDir . '/classes/MO/JustInTime/MO.php',
    'WPML\\ST\\MO\\JustInTime\\MOFactory' => $baseDir . '/classes/MO/JustInTime/MOFactory.php',
    'WPML\\ST\\MO\\LoadedMODictionary' => $baseDir . '/classes/MO/LoadedMODictionary.php',
    'WPML\\ST\\MO\\Plural' => $baseDir . '/classes/MO/Plural.php',
    'WPML\\ST\\MO\\Scan\\UI\\Factory' => $baseDir . '/classes/translations-file-scan/UI/Factory.php',
    'WPML\\ST\\MO\\Scan\\UI\\Model' => $baseDir . '/classes/translations-file-scan/UI/Model.php',
    'WPML\\ST\\MO\\Scan\\UI\\UI' => $baseDir . '/classes/translations-file-scan/UI/UI.php',
    'WPML\\ST\\MO\\WPLocaleProxy' => $baseDir . '/classes/MO/WPLocaleProxy.php',
    'WPML\\ST\\Package\\Domains' => $baseDir . '/classes/package/class-domains.php',
    'WPML\\ST\\Rest\\Base' => $baseDir . '/classes/API/rest/Base.php',
    'WPML\\ST\\Rest\\FactoryLoader' => $baseDir . '/classes/API/rest/FactoryLoader.php',
    'WPML\\ST\\Rest\\MO\\Import' => $baseDir . '/classes/API/rest/mo/Import.php',
    'WPML\\ST\\Rest\\MO\\PreGenerate' => $baseDir . '/classes/API/rest/mo/PreGenerate.php',
    'WPML\\ST\\Rest\\Settings' => $baseDir . '/classes/API/rest/settings/Settings.php',
    'WPML\\ST\\SlugTranslation\\Hooks\\Hooks' => $baseDir . '/classes/slug-translation/RewriteRules/Hooks.php',
    'WPML\\ST\\SlugTranslation\\Hooks\\HooksFactory' => $baseDir . '/classes/slug-translation/RewriteRules/HooksFactory.php',
    'WPML\\ST\\StringsFilter\\Provider' => $baseDir . '/classes/filters/strings-filter/Provider.php',
    'WPML\\ST\\StringsFilter\\QueryBuilder' => $baseDir . '/classes/filters/strings-filter/QueryBuilder.php',
    'WPML\\ST\\StringsFilter\\StringEntity' => $baseDir . '/classes/filters/strings-filter/StringEntity.php',
    'WPML\\ST\\StringsFilter\\TranslationEntity' => $baseDir . '/classes/filters/strings-filter/TranslationEntity.php',
    'WPML\\ST\\StringsFilter\\TranslationReceiver' => $baseDir . '/classes/filters/strings-filter/TranslationReceiver.php',
    'WPML\\ST\\StringsFilter\\Translations' => $baseDir . '/classes/filters/strings-filter/Translations.php',
    'WPML\\ST\\StringsFilter\\TranslationsObjectStorage' => $baseDir . '/classes/filters/strings-filter/TranslationsObjectStorage.php',
    'WPML\\ST\\StringsFilter\\Translator' => $baseDir . '/classes/filters/strings-filter/Translator.php',
    'WPML\\ST\\TranslateWpmlString' => $baseDir . '/classes/TranslateWpmlString.php',
    'WPML\\ST\\TranslationFile\\Builder' => $baseDir . '/classes/translation-files/Builder.php',
    'WPML\\ST\\TranslationFile\\Domains' => $baseDir . '/classes/translation-files/Domains.php',
    'WPML\\ST\\TranslationFile\\DomainsLocalesMapper' => $baseDir . '/classes/translation-files/DomainsLocalesMapper.php',
    'WPML\\ST\\TranslationFile\\EntryQueries' => $baseDir . '/classes/translations-file-scan/EntryQueries.php',
    'WPML\\ST\\TranslationFile\\Hooks' => $baseDir . '/classes/translation-files/Hooks.php',
    'WPML\\ST\\TranslationFile\\Manager' => $baseDir . '/classes/translation-files/Manager.php',
    'WPML\\ST\\TranslationFile\\QueueFilter' => $baseDir . '/classes/translations-file-scan/QueueFilter.php',
    'WPML\\ST\\TranslationFile\\StringEntity' => $baseDir . '/classes/translation-files/StringEntity.php',
    'WPML\\ST\\TranslationFile\\StringsRetrieve' => $baseDir . '/classes/translation-files/StringsRetrieve.php',
    'WPML\\ST\\TranslationFile\\UpdateHooks' => $baseDir . '/classes/translation-files/UpdateHooks.php',
    'WPML\\ST\\TranslationFile\\UpdateHooksFactory' => $baseDir . '/classes/translation-files/UpdateHooksFactory.php',
    'WPML\\ST\\Troubleshooting\\AjaxFactory' => $baseDir . '/classes/Troubleshooting/AjaxFactory.php',
    'WPML\\ST\\Troubleshooting\\BackendHooks' => $baseDir . '/classes/Troubleshooting/BackendHooks.php',
    'WPML\\ST\\Troubleshooting\\Cleanup\\Database' => $baseDir . '/classes/Troubleshooting/Cleanup/Database.php',
    'WPML\\ST\\Troubleshooting\\RequestHandle' => $baseDir . '/classes/Troubleshooting/RequestHandle.php',
    'WPML\\ST\\Utils\\LanguageResolution' => $baseDir . '/classes/utilities/LanguageResolution.php',
    'WPML_Admin_Notifier' => $baseDir . '/classes/class-wpml-admin-notifier.php',
    'WPML_Admin_Text_Configuration' => $baseDir . '/inc/admin-texts/wpml-admin-text-configuration.php',
    'WPML_Admin_Text_Functionality' => $baseDir . '/inc/admin-texts/wpml-admin-text-functionality.class.php',
    'WPML_Admin_Text_Import' => $baseDir . '/inc/admin-texts/wpml-admin-text-import.class.php',
    'WPML_Admin_Texts' => $baseDir . '/inc/admin-texts/wpml-admin-texts.class.php',
    'WPML_Autoregister_Save_Strings' => $baseDir . '/classes/filters/autoregister/class-wpml-autoregister-save-strings.php',
    'WPML_Change_String_Domain_Language_Dialog' => $baseDir . '/classes/string-translation-ui/class-wpml-change-string-domain-language-dialog.php',
    'WPML_Change_String_Language_Select' => $baseDir . '/classes/string-translation-ui/class-wpml-change-string-language-select.php',
    'WPML_Core_Version_Check' => $vendorDir . '/wpml-shared/wpml-lib-dependencies/src/dependencies/class-wpml-core-version-check.php',
    'WPML_Dependencies' => $vendorDir . '/wpml-shared/wpml-lib-dependencies/src/dependencies/class-wpml-dependencies.php',
    'WPML_Displayed_String_Filter' => $baseDir . '/classes/filters/strings-filter/class-wpml-displayed-string-filter.php',
    'WPML_File_Name_Converter' => $baseDir . '/classes/strings-scanning/class-wpml-file-name-converter.php',
    'WPML_Language_Of_Domain' => $baseDir . '/classes/class-wpml-language-of-domain.php',
    'WPML_Localization' => $baseDir . '/inc/wpml-localization.class.php',
    'WPML_PO_Import' => $baseDir . '/inc/gettext/wpml-po-import.class.php',
    'WPML_PO_Import_Strings' => $baseDir . '/classes/po-import/class-wpml-po-import-strings.php',
    'WPML_PO_Import_Strings_Scripts' => $baseDir . '/classes/po-import/class-wpml-po-import-strings-scripts.php',
    'WPML_PO_Parser' => $baseDir . '/inc/gettext/wpml-po-parser.class.php',
    'WPML_Package' => $baseDir . '/inc/package-translation/inc/wpml-package.class.php',
    'WPML_Package_Admin_Lang_Switcher' => $baseDir . '/inc/package-translation/inc/wpml-package-admin-lang-switcher.class.php',
    'WPML_Package_Exception' => $baseDir . '/inc/package-translation/inc/wpml-package-translation-exception.class.php',
    'WPML_Package_Helper' => $baseDir . '/inc/package-translation/inc/wpml-package-translation-helper.class.php',
    'WPML_Package_ST' => $baseDir . '/inc/package-translation/inc/wpml-package-translation-st.class.php',
    'WPML_Package_TM' => $baseDir . '/inc/package-translation/inc/wpml-package-translation-tm.class.php',
    'WPML_Package_TM_Jobs' => $baseDir . '/inc/package-translation/inc/wpml-package-translation-tm-jobs.class.php',
    'WPML_Package_Translation' => $baseDir . '/inc/package-translation/inc/wpml-package-translation.class.php',
    'WPML_Package_Translation_HTML_Packages' => $baseDir . '/inc/package-translation/inc/wpml-package-translation-html-packages.class.php',
    'WPML_Package_Translation_Metabox' => $baseDir . '/inc/package-translation/inc/wpml-package-translation-metabox.class.php',
    'WPML_Package_Translation_Schema' => $baseDir . '/inc/package-translation/inc/wpml-package-translation-schema.class.php',
    'WPML_Package_Translation_UI' => $baseDir . '/inc/package-translation/inc/wpml-package-translation-ui.class.php',
    'WPML_Plugin_String_Scanner' => $baseDir . '/inc/gettext/wpml-plugin-string-scanner.class.php',
    'WPML_Post_Slug_Translation_Records' => $baseDir . '/classes/slug-translation/post/wpml-post-slug-translation-records.php',
    'WPML_Register_String_Filter' => $baseDir . '/classes/filters/strings-filter/class-wpml-register-string-filter.php',
    'WPML_Rewrite_Rule_Filter' => $baseDir . '/classes/slug-translation/class-wpml-rewrite-rule-filter.php',
    'WPML_Rewrite_Rule_Filter_Factory' => $baseDir . '/classes/slug-translation/wpml-rewrite-rule-filter-factory.php',
    'WPML_ST_Admin_Blog_Option' => $baseDir . '/classes/admin-texts/class-wpml-st-admin-blog-option.php',
    'WPML_ST_Admin_Option_Translation' => $baseDir . '/classes/admin-texts/class-wpml-st-admin-option-translation.php',
    'WPML_ST_Admin_String' => $baseDir . '/classes/class-wpml-st-admin-string.php',
    'WPML_ST_Blog_Name_And_Description_Hooks' => $baseDir . '/classes/filters/class-wpml-st-blog-name-and-description-hooks.php',
    'WPML_ST_Bulk_Strings_Insert' => $baseDir . '/classes/db-mappers/class-wpml-st-bulk-strings-insert.php',
    'WPML_ST_Bulk_Strings_Insert_Exception' => $baseDir . '/classes/db-mappers/class-wpml-st-bulk-strings-insert.php',
    'WPML_ST_Bulk_Update_Strings_Status' => $baseDir . '/classes/db-mappers/class-wpml-st-bulk-update-strings-status.php',
    'WPML_ST_DB_Mappers_String_Positions' => $baseDir . '/classes/db-mappers/class-wpml-st-db-mappers-string-positions.php',
    'WPML_ST_DB_Mappers_Strings' => $baseDir . '/classes/db-mappers/class-wpml-st-db-mappers-strings.php',
    'WPML_ST_DB_Troubleshooting' => $baseDir . '/classes/menus/class-wpml-st-db-troubleshooting.php',
    'WPML_ST_Element_Slug_Translation_UI' => $baseDir . '/classes/slug-translation/wpml-st-element-slug-translation-ui.php',
    'WPML_ST_Element_Slug_Translation_UI_Model' => $baseDir . '/classes/slug-translation/wpml-st-element-slug-translation-ui-model.php',
    'WPML_ST_File_Hashing' => $baseDir . '/classes/strings-scanning/class-wpml-st-file-hashing.php',
    'WPML_ST_ICL_String_Translations' => $baseDir . '/classes/records/class-wpml-st-icl-string-translations.php',
    'WPML_ST_ICL_Strings' => $baseDir . '/classes/records/class-wpml-st-icl-strings.php',
    'WPML_ST_Initialize' => $baseDir . '/classes/class-wpml-st-initialize.php',
    'WPML_ST_JED_Domain' => $baseDir . '/classes/translation-files/jed/wpml-st-jed-domain.php',
    'WPML_ST_JED_File_Builder' => $baseDir . '/classes/translation-files/jed/wpml-st-jed-file-builder.php',
    'WPML_ST_JED_File_Manager' => $baseDir . '/classes/translation-files/jed/wpml-st-jed-file-manager.php',
    'WPML_ST_MO_Downloader' => $baseDir . '/inc/auto-download-locales.php',
    'WPML_ST_Models_String' => $baseDir . '/classes/db-mappers/class-wpml-st-models-string.php',
    'WPML_ST_Models_String_Translation' => $baseDir . '/classes/db-mappers/class-wpml-st-models-string-translation.php',
    'WPML_ST_Package_Cleanup' => $baseDir . '/classes/package-translation/class-wpml-st-package-cleanup.php',
    'WPML_ST_Package_Factory' => $baseDir . '/inc/package-translation/inc/wpml-package-factory.class.php',
    'WPML_ST_Package_Storage' => $baseDir . '/classes/package-translation/class-wpml-st-package-storage.php',
    'WPML_ST_Plugin_Localization_UI' => $baseDir . '/classes/menus/theme-plugin-localization-ui/strategy/class-wpml-st-plugin-localization-ui.php',
    'WPML_ST_Plugin_Localization_UI_Factory' => $baseDir . '/classes/menus/theme-plugin-localization-ui/factory/class-wpml-st-plugin-localization-ui-factory.php',
    'WPML_ST_Plugin_Localization_Utils' => $baseDir . '/classes/menus/theme-plugin-localization-ui/class-st-plugin-localization-ui-utils.php',
    'WPML_ST_Plugin_String_Scanner_Factory' => $baseDir . '/classes/strings-scanning/factory/class-wpml-st-plugin-string-scanner-factory.php',
    'WPML_ST_Post_Slug_Translation_Settings' => $baseDir . '/classes/slug-translation/post/wpml-st-post-slug-translation-settings.php',
    'WPML_ST_Privacy_Content' => $baseDir . '/classes/privacy/class-wpml-st-privacy-content.php',
    'WPML_ST_Privacy_Content_Factory' => $baseDir . '/classes/privacy/class-wpml-st-privacy-content-factory.php',
    'WPML_ST_Records' => $baseDir . '/classes/records/class-wpml-st-records.php',
    'WPML_ST_Relative_Translation_Status' => $baseDir . '/classes/string-translation-status/class-wpml-st-relative-translation-status.php',
    'WPML_ST_Remote_String_Translation_Factory' => $baseDir . '/classes/actions/class-wpml-st-remote-string-translation-factory.php',
    'WPML_ST_Repair_Strings_Schema' => $baseDir . '/classes/upgrade/repair-schema/wpml-st-repair-strings-schema.php',
    'WPML_ST_Reset' => $baseDir . '/classes/class-wpml-st-reset.php',
    'WPML_ST_Scan_Dir' => $baseDir . '/classes/utilities/wpml-st-scan-dir.php',
    'WPML_ST_Script_Translations_Hooks' => $baseDir . '/classes/translation-files/jed/wpml-st-script-translations-hooks.php',
    'WPML_ST_Script_Translations_Hooks_Factory' => $baseDir . '/classes/translation-files/jed/wpml-st-script-translations-hooks-factory.php',
    'WPML_ST_Settings' => $baseDir . '/classes/class-wpml-st-settings.php',
    'WPML_ST_Slug' => $baseDir . '/classes/slug-translation/wpml-st-slug.php',
    'WPML_ST_Slug_Custom_Type' => $baseDir . '/classes/slug-translation/custom-types/wpml-st-slug-custom-type.php',
    'WPML_ST_Slug_Custom_Type_Factory' => $baseDir . '/classes/slug-translation/custom-types/wpml-st-slug-custom-type-factory.php',
    'WPML_ST_Slug_New_Match' => $baseDir . '/classes/slug-translation/new-match-finder/wpml-st-slug-new-match.php',
    'WPML_ST_Slug_New_Match_Finder' => $baseDir . '/classes/slug-translation/new-match-finder/wpml-st-slug-new-match-finder.php',
    'WPML_ST_Slug_Translation_API' => $baseDir . '/classes/slug-translation/wpml-st-slug-translation-api.php',
    'WPML_ST_Slug_Translation_Custom_Types_Repository' => $baseDir . '/classes/slug-translation/custom-types/wpml-st-slug-translation-custom-types-repository.php',
    'WPML_ST_Slug_Translation_Post_Custom_Types_Repository' => $baseDir . '/classes/slug-translation/custom-types/wpml-st-slug-translation-post-custom-types-repository.php',
    'WPML_ST_Slug_Translation_Settings' => $baseDir . '/classes/slug-translation/wpml-st-slug-translation-settings.php',
    'WPML_ST_Slug_Translation_Settings_Factory' => $baseDir . '/classes/slug-translation/wpml-st-slug-translation-settings-factory.php',
    'WPML_ST_Slug_Translation_Strings_Sync' => $baseDir . '/classes/slug-translation/wpml-st-slug-translation-strings-sync.php',
    'WPML_ST_Slug_Translation_Taxonomy_Custom_Types_Repository' => $baseDir . '/classes/slug-translation/custom-types/wpml-st-slug-translation-taxonomy-custom-types-repository.php',
    'WPML_ST_Slug_Translation_UI_Factory' => $baseDir . '/classes/slug-translation/wpml-st-slug-translation-ui-factory.php',
    'WPML_ST_Slug_Translation_UI_Save' => $baseDir . '/classes/slug-translation/wpml-st-slug-translation-ui-save.php',
    'WPML_ST_Slug_Translations' => $baseDir . '/classes/slug-translation/custom-types/wpml-st-slug-translations.php',
    'WPML_ST_String' => $baseDir . '/classes/class-wpml-st-string.php',
    'WPML_ST_String_Dependencies_Builder' => $baseDir . '/classes/utilities/string-dependencies/wpml-st-string-dependencies-builder.php',
    'WPML_ST_String_Dependencies_Node' => $baseDir . '/classes/utilities/string-dependencies/wpml-st-string-dependencies-node.php',
    'WPML_ST_String_Dependencies_Records' => $baseDir . '/classes/utilities/string-dependencies/wpml-st-string-dependencies-records.php',
    'WPML_ST_String_Factory' => $baseDir . '/classes/class-wpml-st-string-factory.php',
    'WPML_ST_String_Positions' => $baseDir . '/classes/string-tracking/class-wpml-st-string-positions.php',
    'WPML_ST_String_Positions_In_Page' => $baseDir . '/classes/string-tracking/class-wpml-st-string-positions-in-page.php',
    'WPML_ST_String_Positions_In_Source' => $baseDir . '/classes/string-tracking/class-wpml-st-string-positions-in-source.php',
    'WPML_ST_String_Statuses' => $baseDir . '/classes/class-wpml-st-string-statuses.php',
    'WPML_ST_String_Tracking_AJAX' => $baseDir . '/classes/string-tracking/class-wpml-st-string-tracking-ajax.php',
    'WPML_ST_String_Tracking_AJAX_Factory' => $baseDir . '/classes/string-tracking/class-wpml-st-string-tracking-ajax-factory.php',
    'WPML_ST_String_Translation_AJAX_Hooks_Factory' => $baseDir . '/classes/string-translation/class-wpml-st-string-translation-ajax-hooks-factory.php',
    'WPML_ST_String_Translation_Priority_AJAX' => $baseDir . '/classes/string-translation/class-wpml-st-string-translation-priority-ajax.php',
    'WPML_ST_String_Update' => $baseDir . '/inc/wpml-st-string-update.class.php',
    'WPML_ST_Strings' => $baseDir . '/classes/class-wpml-st-strings.php',
    'WPML_ST_Strings_Stats' => $baseDir . '/classes/strings-scanning/class-wpml-st-strings-stats.php',
    'WPML_ST_Support_Info' => $baseDir . '/classes/support/class-wpml-st-support-info.php',
    'WPML_ST_Support_Info_Filter' => $baseDir . '/classes/support/class-wpml-st-support-info-filter.php',
    'WPML_ST_TM_Jobs' => $baseDir . '/classes/wpml-tm/class-wpml-st-tm-jobs.php',
    'WPML_ST_Tax_Slug_Translation_Settings' => $baseDir . '/classes/slug-translation/taxonomy/wpml-st-tax-slug-translation-settings.php',
    'WPML_ST_Taxonomy_Labels_Translation' => $baseDir . '/classes/filters/class-wpml-st-taxonomy-labels-translation.php',
    'WPML_ST_Taxonomy_Labels_Translation_Factory' => $baseDir . '/classes/filters/class-wpml-st-taxonomy-labels-translation-factory.php',
    'WPML_ST_Taxonomy_Strings' => $baseDir . '/classes/filters/taxonomy-strings/wpml-st-taxonomy-strings.php',
    'WPML_ST_Term_Link_Filter' => $baseDir . '/classes/slug-translation/taxonomy/wpml-st-term-link-filter.php',
    'WPML_ST_Theme_Localization_UI' => $baseDir . '/classes/menus/theme-plugin-localization-ui/strategy/class-wpml-st-theme-localization-ui.php',
    'WPML_ST_Theme_Localization_UI_Factory' => $baseDir . '/classes/menus/theme-plugin-localization-ui/factory/class-wpml-st-theme-localization-ui-factory.php',
    'WPML_ST_Theme_Localization_Utils' => $baseDir . '/classes/menus/theme-plugin-localization-ui/class-st-theme-localization-ui-utils.php',
    'WPML_ST_Theme_Plugin_Hooks' => $baseDir . '/classes/strings-scanning/class-wpml-st-theme-plugin-hooks.php',
    'WPML_ST_Theme_Plugin_Hooks_Factory' => $baseDir . '/classes/strings-scanning/factory/class-st-theme-plugin-hooks-factory.php',
    'WPML_ST_Theme_Plugin_Localization_Options_Settings' => $baseDir . '/classes/menus/theme-plugin-localization-ui/class-wpml-st-theme-plugin-localization-options-settings.php',
    'WPML_ST_Theme_Plugin_Localization_Options_Settings_Factory' => $baseDir . '/classes/menus/theme-plugin-localization-ui/factory/class-wpml-st-theme-plugin-localization-options-settings-factory.php',
    'WPML_ST_Theme_Plugin_Localization_Options_UI' => $baseDir . '/classes/menus/theme-plugin-localization-ui/class-st-theme-plugin-localization-options-ui.php',
    'WPML_ST_Theme_Plugin_Localization_Options_UI_Factory' => $baseDir . '/classes/menus/theme-plugin-localization-ui/factory/class-wpml-st-theme-plugin-localization-options-ui-factory.php',
    'WPML_ST_Theme_Plugin_Localization_Resources' => $baseDir . '/classes/menus/theme-plugin-localization-ui/class-wpml-st-theme-plugin-localization-resources.php',
    'WPML_ST_Theme_Plugin_Localization_Resources_Factory' => $baseDir . '/classes/menus/theme-plugin-localization-ui/factory/class-wpml-st-theme-plugin-localization-resources-factory.php',
    'WPML_ST_Theme_Plugin_Scan_Dir_Ajax' => $baseDir . '/classes/strings-scanning/wpml-st-theme-plugin-scan-dir-ajax.php',
    'WPML_ST_Theme_Plugin_Scan_Dir_Ajax_Factory' => $baseDir . '/classes/strings-scanning/factory/class-wpml-st-theme-plugin-scan-dir-ajax-factory.php',
    'WPML_ST_Theme_Plugin_Scan_Files_Ajax' => $baseDir . '/classes/strings-scanning/class-wpml-st-theme-plugin-scan-files-ajax.php',
    'WPML_ST_Theme_Plugin_Scan_Files_Ajax_Factory' => $baseDir . '/classes/strings-scanning/factory/class-wpml-st-theme-plugin-scan-files-ajax-factory.php',
    'WPML_ST_Theme_String_Scanner_Factory' => $baseDir . '/classes/strings-scanning/factory/class-wpml-st-theme-string-scanner-factory.php',
    'WPML_ST_Themes_And_Plugins_Settings' => $baseDir . '/classes/strings-scanning/class-wpml-themes-and-plugins-settings.php',
    'WPML_ST_Themes_And_Plugins_Updates' => $baseDir . '/classes/strings-scanning/class-wpml-themes-and-plugins-updates.php',
    'WPML_ST_Translation_Memory' => $baseDir . '/classes/translation-memory/class-wpml-st-translation-memory.php',
    'WPML_ST_Translation_Memory_Factory' => $baseDir . '/classes/translation-memory/class-wpml-st-translation-memory-factory.php',
    'WPML_ST_Translation_Memory_Records' => $baseDir . '/classes/translation-memory/class-wpml-st-translation-memory-records.php',
    'WPML_ST_Translation_Memory_Settings_UI' => $baseDir . '/classes/translation-memory/class-wpml-st-translation-memory-settings-ui.php',
    'WPML_ST_Translations_File_Component_Details' => $baseDir . '/classes/translations-file-scan/components/wpml-st-translations-file-component-details.php',
    'WPML_ST_Translations_File_Component_Stats_Update_Hooks' => $baseDir . '/classes/translations-file-scan/wpml-st-translations-file-component-stats-update-hooks.php',
    'WPML_ST_Translations_File_Components_Find' => $baseDir . '/classes/translations-file-scan/components/wpml-st-translations-file-components-find.php',
    'WPML_ST_Translations_File_Components_Find_Plugin' => $baseDir . '/classes/translations-file-scan/components/wpml-st-translations-file-components-find-plugin.php',
    'WPML_ST_Translations_File_Components_Find_Theme' => $baseDir . '/classes/translations-file-scan/components/wpml-st-translations-file-components-find-theme.php',
    'WPML_ST_Translations_File_Dictionary' => $baseDir . '/classes/translations-file-scan/wpml-st-translations-file-dictionary.php',
    'WPML_ST_Translations_File_Dictionary_Storage' => $baseDir . '/classes/translations-file-scan/dictionary/class-st-translations-file-dictionary-storage.php',
    'WPML_ST_Translations_File_Dictionary_Storage_Table' => $baseDir . '/classes/translations-file-scan/dictionary/class-st-translations-file-dicionary-storage-table.php',
    'WPML_ST_Translations_File_Entry' => $baseDir . '/classes/translations-file-scan/wpml-st-translations-file-entry.php',
    'WPML_ST_Translations_File_JED' => $baseDir . '/classes/translations-file-scan/translations-file/wpml-st-translations-file-jed.php',
    'WPML_ST_Translations_File_Locale' => $baseDir . '/classes/translations-file-scan/translations-file/wpml-st-translations-file-locale.php',
    'WPML_ST_Translations_File_MO' => $baseDir . '/classes/translations-file-scan/translations-file/wpml-st-translations-file-mo.php',
    'WPML_ST_Translations_File_Queue' => $baseDir . '/classes/translations-file-scan/wpml-st-translations-file-queue.php',
    'WPML_ST_Translations_File_Registration' => $baseDir . '/classes/translations-file-scan/wpml-st-translations-file-registration.php',
    'WPML_ST_Translations_File_Scan' => $baseDir . '/classes/translations-file-scan/wpml-st-translations-file-scan.php',
    'WPML_ST_Translations_File_Scan_Charset_Validation' => $baseDir . '/classes/translations-file-scan/charset-validation/wpml-st-translations-file-scan-charset-validation.php',
    'WPML_ST_Translations_File_Scan_Db_Charset_Filter_Factory' => $baseDir . '/classes/translations-file-scan/charset-validation/wpml-st-translations-file-scan-db-charset-validation-factory.php',
    'WPML_ST_Translations_File_Scan_Db_Charset_Validation' => $baseDir . '/classes/translations-file-scan/charset-validation/wpml-st-translations-file-scan-db-charset-validation.php',
    'WPML_ST_Translations_File_Scan_Db_Table_List' => $baseDir . '/classes/translations-file-scan/charset-validation/wpml-st-translations-file-scan-db-table-list.php',
    'WPML_ST_Translations_File_Scan_Factory' => $baseDir . '/classes/translations-file-scan/wpml-st-translations-file-scan-factory.php',
    'WPML_ST_Translations_File_Scan_Storage' => $baseDir . '/classes/translations-file-scan/wpml-st-translations-file-scan-storage.php',
    'WPML_ST_Translations_File_Scan_UI_Block' => $baseDir . '/classes/translations-file-scan/wpml-st-translations-file-scan-ui-block.php',
    'WPML_ST_Translations_File_String_Status_Update' => $baseDir . '/classes/translations-file-scan/wpml-st-translations-file-string-status-update.php',
    'WPML_ST_Translations_File_Translation' => $baseDir . '/classes/translations-file-scan/wpml-st-translations-file-translation.php',
    'WPML_ST_Translations_File_Unicode_Characters_Filter' => $baseDir . '/classes/translations-file-scan/wpml-st-translations-file-unicode-characters-filter.php',
    'WPML_ST_Update_File_Hash_Ajax' => $baseDir . '/classes/strings-scanning/class-wpml-st-update-file-hash-ajax.php',
    'WPML_ST_Update_File_Hash_Ajax_Factory' => $baseDir . '/classes/strings-scanning/factory/class-st-update-file-hash-ajax-factory.php',
    'WPML_ST_Upgrade' => $baseDir . '/classes/upgrade/class-wpml-st-upgrade.php',
    'WPML_ST_Upgrade_Command_Factory' => $baseDir . '/classes/upgrade/class-wpml-st-upgrade-command-factory.php',
    'WPML_ST_Upgrade_Command_Not_Found_Exception' => $baseDir . '/classes/upgrade/class-wpml-st-upgrade-command-not-found-exception.php',
    'WPML_ST_Upgrade_DB_Longtext_String_Value' => $baseDir . '/classes/upgrade/class-wpml-st-upgrade-db-longtext-string-value.php',
    'WPML_ST_Upgrade_DB_String_Name_Index' => $baseDir . '/classes/upgrade/class-wpml-st-upgrade-db-string-name-index.php',
    'WPML_ST_Upgrade_DB_String_Packages' => $baseDir . '/classes/upgrade/class-wpml-st-upgrade-db-string-packages.php',
    'WPML_ST_Upgrade_DB_String_Packages_Word_Count' => $baseDir . '/classes/upgrade/class-wpml-st-upgrade-db-string-packages-word-count.php',
    'WPML_ST_Upgrade_DB_Strings_Add_Translation_Priority_Field' => $baseDir . '/classes/upgrade/class-wpml-st-upgrade-db-strings-add-translation-priority-field.php',
    'WPML_ST_Upgrade_Db_Cache_Command' => $baseDir . '/classes/upgrade/class-wpml-st-upgrade-db-cache-command.php',
    'WPML_ST_Upgrade_Display_Strings_Scan_Notices' => $baseDir . '/classes/upgrade/class-wpml-st-upgrade-display-strings-scan-notices.php',
    'WPML_ST_Upgrade_MO_Scanning' => $baseDir . '/classes/upgrade/class-wpml-st-upgrade-mo-scanning.php',
    'WPML_ST_Upgrade_Migrate_Originals' => $baseDir . '/classes/upgrade/class-wpml-st-upgrade-migrate-originals.php',
    'WPML_ST_Upgrade_String_Index' => $baseDir . '/classes/upgrade/class-wpml-st-upgrade-string-index.php',
    'WPML_ST_User_Fields' => $baseDir . '/classes/class-wpml-st-user-fields.php',
    'WPML_ST_Verify_Dependencies' => $baseDir . '/classes/class-wpml-st-verify-dependencies.php',
    'WPML_ST_WCML_Taxonomy_Labels_Translation' => $baseDir . '/classes/filters/class-wpml-st-wcml-taxonomy-labels-translation.php',
    'WPML_ST_WP_Loaded_Action' => $baseDir . '/classes/actions/class-wpml-st-wp-loaded-action.php',
    'WPML_ST_Word_Count_Package_Records' => $baseDir . '/classes/db-mappers/wpml-st-word-count-package-records.php',
    'WPML_ST_Word_Count_String_Records' => $baseDir . '/classes/db-mappers/wpml-st-word-count-string-records.php',
    'WPML_Slug_Translation' => $baseDir . '/classes/slug-translation/class-wpml-slug-translation.php',
    'WPML_Slug_Translation_Factory' => $baseDir . '/classes/slug-translation/wpml-slug-translation-factory.php',
    'WPML_Slug_Translation_Records' => $baseDir . '/classes/slug-translation/class-wpml-slug-translation-records.php',
    'WPML_Slug_Translation_Records_Factory' => $baseDir . '/classes/slug-translation/wpml-slug-translation-records-factory.php',
    'WPML_String_Scanner' => $baseDir . '/inc/gettext/wpml-string-scanner.class.php',
    'WPML_String_Shortcode' => $baseDir . '/classes/wpml-string-shortcode.php',
    'WPML_String_Translation' => $baseDir . '/inc/wpml-string-translation.class.php',
    'WPML_String_Translation_MO_Import' => $baseDir . '/inc/gettext/wpml-string-translation-mo-import.class.php',
    'WPML_String_Translation_Table' => $baseDir . '/classes/string-translation-ui/class-wpml-string-translation-table.php',
    'WPML_Strings_Translation_Priority' => $baseDir . '/classes/string-translation/class-wpml-strings-translation-priority.php',
    'WPML_TM_Filters' => $baseDir . '/classes/filters/class-wpml-tm-filters.php',
    'WPML_TM_Widget_Filter' => $baseDir . '/classes/filters/class-wpml-tm-widget-filter.php',
    'WPML_Tax_Slug_Translation_Records' => $baseDir . '/classes/slug-translation/taxonomy/wpml-tax-slug-translation-records.php',
    'WPML_Theme_String_Scanner' => $baseDir . '/inc/gettext/wpml-theme-string-scanner.class.php',
    'WPML_Translation_Priority_Select' => $baseDir . '/classes/string-translation-ui/class-wpml-translation-priority-select.php',
    'WP_Widget_Text_Icl' => $baseDir . '/classes/widgets/wp-widget-text-icl.php',
);
