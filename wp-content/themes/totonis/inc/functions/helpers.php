<?php
function tot_phone_tel($phone)
{
    return preg_replace("/[^+0-9]/", '', $phone);
}

function tot_cf7($form_id, $html_class = '')
{
    $html_class_attr = $html_class ? ' html_class="' . $html_class . '"' : '';
    return do_shortcode('[contact-form-7 id="' . $form_id . '"' . $html_class_attr . ']');
}

//excerpt
function the_excerpt_max_charlength($charlength, $postfix = '[...]')
{
    $excerpt = get_the_excerpt();
    $charlength++;

    if (mb_strlen($excerpt) > $charlength) {
        $subex = mb_substr($excerpt, 0, $charlength - 5);
        $exwords = explode(' ', $subex);
        $excut = -(mb_strlen($exwords[count($exwords) - 1]));
        if ($excut < 0) {
            echo mb_substr($subex, 0, $excut);
        } else {
            echo $subex;
        }
        echo $postfix;
    } else {
        echo $excerpt;
    }
}

//pagination
function tot_paginate_links($args = '')
{
    $template = 'a'; //li

    $pagination_item_class = 'b-pagination__item';
    $pagination_item_disabled_class = 'b-pagination__arrow_disable';
    $pagination_item_active_class = 'b-pagination__item b-pagination__item_active';
    $pagination_item_dots_class = 'b-pagination__item b-pagination__item_disable';

    $pagination_item_template = $template === 'li' ? '<li {class}><a {href}>{text}</a></li>' : '<a {class} {href}>{text}</a>';
    $pagination_item_not_link_template = $template === 'li' ? '<li {attributes}><a>{text}</a></li>' : '<span {attributes}>{text}</span>';
//---------------------------------------------------------------

    global $wp_query, $wp_rewrite;

    // Setting up default values based on the current URL.
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $url_parts = explode('?', $pagenum_link);

    // Get max pages and current page out of the current query, if available.
    $total = isset($wp_query->max_num_pages) ? $wp_query->max_num_pages : 1;
    $current = get_query_var('paged') ? intval(get_query_var('paged')) : 1;

    // Append the format placeholder to the base URL.
    $pagenum_link = trailingslashit($url_parts[0]) . '%_%';

    // URL base depends on permalink settings.
    $format = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';

    $defaults = array(
        'base' => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
        'format' => $format, // ?page=%#% : %#% is replaced by the page number
        'total' => $total,
        'current' => $current,
        'aria_current' => 'page',
        'show_all' => false,
        'prev_next' => false,
        'prev_text' => '<i class="fas fa-angle-left"></i>',
        'next_text' => '<i class="fas fa-angle-right"></i>',
        'end_size' => 1,
        'mid_size' => 2,
        'type' => 'plain',
        'add_args' => array(), // array of query args to add
        'add_fragment' => '',
        'before_page_number' => '',
        'after_page_number' => '',
    );

    $args = wp_parse_args($args, $defaults);

    if (!is_array($args['add_args'])) {
        $args['add_args'] = array();
    }

    // Merge additional query vars found in the original URL into 'add_args' array.
    if (isset($url_parts[1])) {
        // Find the format argument.
        $format = explode('?', str_replace('%_%', $args['format'], $args['base']));
        $format_query = isset($format[1]) ? $format[1] : '';
        wp_parse_str($format_query, $format_args);

        // Find the query args of the requested URL.
        wp_parse_str($url_parts[1], $url_query_args);

        // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
        foreach ($format_args as $format_arg => $format_arg_value) {
            unset($url_query_args[$format_arg]);
        }

        $args['add_args'] = array_merge($args['add_args'], urlencode_deep($url_query_args));
    }

    // Who knows what else people pass in $args
    $total = (int)$args['total'];
    if ($total < 2) {
        return;
    }
    $current = (int)$args['current'];
    $end_size = (int)$args['end_size']; // Out of bounds?  Make it the default.
    if ($end_size < 1) {
        $end_size = 1;
    }
    $mid_size = (int)$args['mid_size'];
    if ($mid_size < 0) {
        $mid_size = 2;
    }
    $add_args = $args['add_args'];
    $r = '';
    $page_links = array();
    $dots = false;

    if ($args['prev_next'] && $current) :
        $link = str_replace('%_%', 2 == $current ? '' : $args['format'], $args['base']);
        $link = str_replace('%#%', $current - 1, $link);
        if ($add_args)
            $link = add_query_arg($add_args, $link);
        $link .= $args['add_fragment'];

        /**
         * Filters the paginated links for the given archive pages.
         *
         * @param string $link The paginated link URL.
         * @since 3.0.0
         *
         */
        if (1 < $current) {
            $page_links[] = str_replace(['{class}', '{href}', '{text}'], [
                'class="' . $pagination_item_class . '"',
                'href="' . esc_url(apply_filters('paginate_links', $link)) . '"',
                $args['prev_text']
            ], $pagination_item_template);
        } else {
            $page_links[] = str_replace(['{attributes}', '{text}'], [
                'class="' . $pagination_item_class . ' ' . $pagination_item_disabled_class . '"',
                $args['prev_text']
            ], $pagination_item_not_link_template);
        }
    endif;
    for ($n = 1; $n <= $total; $n++) :
        if ($n == $current) :
            $page_links[] = str_replace(['{attributes}', '{text}'], [
                "aria-current='" . esc_attr($args['aria_current']) . "' class='" . $pagination_item_class . " " . $pagination_item_active_class . "'",
                $args['before_page_number'] . number_format_i18n($n) . $args['after_page_number']
            ], $pagination_item_not_link_template);
            $dots = true;
        else :
            if ($args['show_all'] || ($n <= $end_size || ($current && $n >= $current - $mid_size && $n <= $current + $mid_size) || $n > $total - $end_size)) :
                $link = str_replace('%_%', 1 == $n ? '' : $args['format'], $args['base']);
                $link = str_replace('%#%', $n, $link);
                if ($add_args)
                    $link = add_query_arg($add_args, $link);
                $link .= $args['add_fragment'];

                /** This filter is documented in wp-includes/general-template.php */
                $page_links[] = str_replace(['{class}', '{href}', '{text}'], [
                    'class="' . $pagination_item_class . '"',
                    'href="' . esc_url(apply_filters('paginate_links', $link)) . '"',
                    $args['before_page_number'] . number_format_i18n($n) . $args['after_page_number']
                ], $pagination_item_template);
                $dots = true;
            elseif ($dots && !$args['show_all']) :
                $page_links[] = str_replace(['{attributes}', '{text}'], [
                    'class="page-numbers dots ' . $pagination_item_dots_class . '"',
                    __('&hellip;')
                ], $pagination_item_not_link_template);
                $dots = false;
            endif;
        endif;
    endfor;
    if ($args['prev_next'] && $current) :
        $link = str_replace('%_%', $args['format'], $args['base']);
        $link = str_replace('%#%', $current + 1, $link);
        if ($add_args)
            $link = add_query_arg($add_args, $link);
        $link .= $args['add_fragment'];

        /** This filter is documented in wp-includes/general-template.php */
        if ($current < $total) {
            $page_links[] = str_replace(['{class}', '{href}', '{text}'], [
                'class="' . $pagination_item_class . '"',
                'href="' . esc_url(apply_filters('paginate_links', $link)) . '"',
                $args['next_text']
            ], $pagination_item_template);
        } else {
            $page_links[] = $page_links[] = str_replace(['{attributes}', '{text}'], [
                'class="' . $pagination_item_class . ' ' . $pagination_item_disabled_class . '"',
                $args['next_text']
            ], $pagination_item_not_link_template);
        }
    endif;
    switch ($args['type']) {
        case 'array' :
            return $page_links;

        case 'list' :
            $r .= "<ul class='page-numbers'>\n\t<li>";
            $r .= join("</li>\n\t<li>", $page_links);
            $r .= "</li>\n</ul>\n";
            break;

        default :
            $r = join("\n", $page_links);
            break;
    }

    if ($args['prev_next']) {
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        preg_match('/\d+/', $url, $page);
        $prevDisabled = '';
        $nextDisabled = '';
        if (!empty($page)) {
            $nextUrl = $_SERVER['REQUEST_SCHEME'] . '://' . str_replace($page[0], $page[0] + 1, $url);
            $prevUrl = $_SERVER['REQUEST_SCHEME'] . '://' . str_replace($page[0], $page[0] - 1, $url);
            if ($page[0] >= $wp_query->max_num_pages) $nextDisabled = 'b-pagination__arrow_disable';
        } else {
            $nextUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $url . 'page/2/';
            $prevUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $url . 'page/#/';
            $prevDisabled = 'b-pagination__arrow_disable';
        }

        $r = "<a href=\"$prevUrl\" class=\"b-pagination__arrow b-pagination__arrow_prev $prevDisabled\"></a>" . $r;
        $r = $r . "<a href=\"$nextUrl\" class=\"b-pagination__arrow b-pagination__arrow_next $nextDisabled\"></a>";
    }

    return $r;
}