<?php

class TotView
{
    public static function breadcrumbs()
    {
        echo self::render('layout/breadcrumbs');
    }

    public static function render($viewName, $data = array())
    {
        $filePath = get_template_directory() . "/inc/views/$viewName.php";
        if ($viewName && file_exists($filePath)) {
            extract($data);
            ob_start();
            require $filePath;
            return ob_get_clean();
        } else {
            throw new \Exception("View $viewName not found!");
        }
    }
}