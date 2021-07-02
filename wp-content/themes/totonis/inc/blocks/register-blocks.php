<?php
//blocks
function tot_register_blocks()
{
    acf_register_block_type([
        'name' => 'first_screen',
        'title' => __('First screen'),
        'render_template' => 'inc/blocks/templates/first_screen.php',
        'category' => 'totonis_section',
        'icon' => 'format-aside',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'acceptance_payment',
        'title' => __('Acceptance payment'),
        'render_template' => 'inc/blocks/templates/acceptance_payment.php',
        'category' => 'totonis_section',
        'icon' => 'thumbs-up',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'opportunities',
        'title' => __('Opportunities'),
        'render_template' => 'inc/blocks/templates/opportunities.php',
        'category' => 'totonis_section',
        'icon' => 'dashicons-yes-alt',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'comfort_connect',
        'title' => __('Comfort connect'),
        'render_template' => 'inc/blocks/templates/comfort_connect.php',
        'category' => 'totonis_section',
        'icon' => 'dashicons-plugins-checked',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'advantages',
        'title' => __('Advantages'),
        'render_template' => 'inc/blocks/templates/advantages.php',
        'category' => 'totonis_section',
        'icon' => 'star-empty',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'test_pay_system',
        'title' => __('Test pay system'),
        'render_template' => 'inc/blocks/templates/test_pay_system.php',
        'category' => 'totonis_section',
        'icon' => 'admin-settings',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'payment_decisions',
        'title' => __('Payment decisions'),
        'render_template' => 'inc/blocks/templates/payment_decisions.php',
        'category' => 'totonis_section',
        'icon' => 'flag',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'best_tariff',
        'title' => __('Best tariff'),
        'render_template' => 'inc/blocks/templates/best_tariff.php',
        'category' => 'totonis_section',
        'icon' => 'dashboard',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'google_pay',
        'title' => __('Google pay'),
        'render_template' => 'inc/blocks/templates/google_pay.php',
        'category' => 'totonis_section',
        'icon' => 'google',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'gp_how_it_work',
        'title' => __('GP how it work'),
        'render_template' => 'inc/blocks/templates/gp_how_it_work.php',
        'category' => 'totonis_section',
        'icon' => 'testimonial',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'gp_cms',
        'title' => __('GP cms'),
        'render_template' => 'inc/blocks/templates/gp_cms.php',
        'category' => 'totonis_section',
        'icon' => 'money',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'opencart',
        'title' => __('Opencart'),
        'render_template' => 'inc/blocks/templates/opencart.php',
        'category' => 'totonis_section',
        'icon' => 'cart',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'oc_payment_ways',
        'title' => __('OC payment ways'),
        'render_template' => 'inc/blocks/templates/oc_payment_ways.php',
        'category' => 'totonis_section',
        'icon' => 'money-alt',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'oc_instruction',
        'title' => __('OC instruction'),
        'render_template' => 'inc/blocks/templates/oc_instruction.php',
        'category' => 'totonis_section',
        'icon' => 'text-page',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'oc_call_to_action',
        'title' => __('OC call to action'),
        'render_template' => 'inc/blocks/templates/oc_call_to_action.php',
        'category' => 'totonis_section',
        'icon' => 'text-page',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'tabs',
        'title' => __('Tabs'),
        'render_template' => 'inc/blocks/templates/tabs.php',
        'category' => 'totonis_section',
        'icon' => 'table-row-before',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'cover_img',
        'title' => __('Cover image'),
        'render_template' => 'inc/blocks/templates/cover_img.php',
        'category' => 'totonis_section',
        'icon' => 'format-image',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'payment_system',
        'title' => __('Payment system'),
        'render_template' => 'inc/blocks/templates/payment_system.php',
        'category' => 'totonis_section',
        'icon' => 'welcome-widgets-menus',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'industry_advantages',
        'title' => __('Industry advantages'),
        'render_template' => 'inc/blocks/templates/industry_advantages.php',
        'category' => 'totonis_section',
        'icon' => 'editor-ul',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'industry_capabilities',
        'title' => __('Industry capabilities'),
        'render_template' => 'inc/blocks/templates/industry_capabilities.php',
        'category' => 'totonis_section',
        'icon' => 'editor-ul',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'call_to_action',
        'title' => __('Call to action'),
        'render_template' => 'inc/blocks/templates/call_to_action.php',
        'category' => 'totonis_section',
        'icon' => 'megaphone',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'industry_functions',
        'title' => __('Industry functions'),
        'render_template' => 'inc/blocks/templates/industry_functions.php',
        'category' => 'totonis_section',
        'icon' => 'table-row-before',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'payment_modules',
        'title' => __('Payment modules'),
        'render_template' => 'inc/blocks/templates/payment_modules.php',
        'category' => 'totonis_section',
        'icon' => 'admin-settings',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'service_connection',
        'title' => __('Service connection'),
        'render_template' => 'inc/blocks/templates/service_connection.php',
        'category' => 'totonis_section',
        'icon' => 'editor-kitchensink',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'call_to_action_cell',
        'title' => __('Сall to action cell'),
        'render_template' => 'inc/blocks/templates/call_to_action_cell.php',
        'category' => 'totonis_section',
        'icon' => 'button',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'text',
        'title' => __('Text'),
        'render_template' => 'inc/blocks/templates/text.php',
        'category' => 'totonis_section',
        'icon' => 'menu',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'image',
        'title' => __('Image'),
        'render_template' => 'inc/blocks/templates/image.php',
        'category' => 'totonis_section',
        'icon' => 'format-image',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'blog',
        'title' => __('Blog'),
        'render_template' => 'inc/blocks/templates/blog.php',
        'category' => 'totonis_section',
        'icon' => 'list-view',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
    acf_register_block_type([
        'name' => 'table',
        'title' => __('Table'),
        'render_template' => 'inc/blocks/templates/table.php',
        'category' => 'totonis_section',
        'icon' => 'editor-table',
        'mode' => 'auto',
        'supports' => [
            'align' => false,
        ],
    ]);
}

//block categories
function tot_block_categories($categories, $post)
{
    if (in_array($post->post_type, ['page', 'post'])) {
        return array_merge([
            ['slug' => 'totonis_section', 'title' => 'Totonis Blocks'],
        ], $categories);
    }
    return $categories;
}

//allow only acf blocks
function tot_allowed_block_types($allowed_blocks, $post)
{
    $registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
    $blocks = [];
    foreach ($registered_blocks as $key => $block) {
        if (preg_match('/^acf/', $key)) {
            $blocks[] = $key;
        }
    }
    return $blocks;
}


if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'tot_register_blocks');
    add_filter('block_categories', 'tot_block_categories', 10, 2);
    add_filter('allowed_block_types', 'tot_allowed_block_types', 10, 2);
}