<?php
add_theme_support('menus');

register_nav_menus([
    'header-menu' => __('Меню у шапці'),
    'mobile-menu' => __('Меню для мобільної версії'),
    'footer-menu' => __('Меню у підвалі'),
    'footer-first' => __('Підвал: Перше'),
    'footer-second' => __('Підвал: Друге'),
    'footer-third' => __('Підвал: Третє'),
]);

//wp_nav_menu add class active to current menu item
function special_nav_class($classes, $item)
{
    $classes = [];
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active ';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

class Arrow_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );

        // Default class.
        $classes = array( 'sub-menu' );

        /**
         * Filters the CSS class(es) applied to a menu list element.
         *
         * @since 4.8.0
         *
         * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
         * @param stdClass $args    An object of `wp_nav_menu()` arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $output .= "{$n}{$indent}<i></i><ul$class_names>{$n}";
    }
}