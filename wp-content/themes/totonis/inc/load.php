<?php

define('MARKUP_URL', get_template_directory_uri() . '/markup/dist/assets');
define('ASSETS_URL', get_template_directory_uri() . '/assets');

totRequireAllFiles(__DIR__ . '/functions');
totRequireAllFiles(__DIR__ . '/blocks');
totRequireAllFiles(__DIR__ . '/post-types');
totRequireAllFiles(__DIR__ . '/views');
totRequireAllFiles(__DIR__ . '/required-plugins');

//require files
function totRequireAllFiles($dirPath)
{
    foreach (scandir($dirPath) as $filename) {
        $path = "$dirPath/$filename";
        if (is_file($path)) {
            require $path;
        }
    }
}