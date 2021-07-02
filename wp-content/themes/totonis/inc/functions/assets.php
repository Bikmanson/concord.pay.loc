<?php

if (!is_admin()) {

    add_action('init', function () {
        // jquery
        wp_deregister_script('jquery');
        wp_register_script('jquery', MARKUP_URL . '/lib/jquery-3.3.1.min.js', false, '3.3.1');
        wp_enqueue_script('jquery');
    });

    add_action('wp_enqueue_scripts', function () {
        // styles
        wp_enqueue_style('googleapis', 'https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap');
        wp_enqueue_style('fancybox', MARKUP_URL . '/lib/fancybox/jquery.fancybox.min.css');
        wp_enqueue_style('slick', MARKUP_URL . '/lib/slick-slider/slick.css');
        wp_enqueue_style('main', MARKUP_URL . '/css/main.css');
        wp_enqueue_style('custom', ASSETS_URL . '/custom.css');

        // scripts
        wp_enqueue_script('fancybox', MARKUP_URL . '/lib/fancybox/jquery.fancybox.min.js', [], get_bloginfo('version'), true);
        wp_enqueue_script('slick', MARKUP_URL . '/lib/slick-slider/slick.min.js', [], get_bloginfo('version'), true);
        wp_enqueue_script('main', MARKUP_URL . '/js/main.js', [], get_bloginfo('version'), true);
    });
}

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('admin-custom', ASSETS_URL . '/admin-custom.css');
});

add_filter('the_content', function($content){
    $content = str_replace('<blockquote>', '<div class="b-quote b-article__content-block">', $content);
    $content = str_replace('</blockquote>', '</div>', $content);
    return $content;
});

add_filter( 'the_content', 'do_shortcode', 11 );

//add_filter('style_loader_tag', function ($html, $handle) {
//    if ($handle === 'fontawesome') {
//        return str_replace("media='all'", "media='all' integrity=\"sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU\"
//          crossorigin=\"anonymous\"", $html);
//    }
//    return $html;
//}, 10, 2);

//add_filter('wpcf7_autop_or_not', '__return_false');