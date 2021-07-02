<?php
//add option pages
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Налаштування теми',
        'menu_title' => 'Налаштування теми',
        'menu_slug' => 'theme-settings',
        'redirect' => false
    ));
}