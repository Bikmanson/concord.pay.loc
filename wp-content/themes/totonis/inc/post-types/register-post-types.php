<?php
//post types
function tot_register_post_types()
{
//    tot_register_post_type('service', [
//        'labels' => tot_post_type_labels_ru('услуги', 'услуга', 'услуги', 'услугу', 'услуг', 'услуги', 'f'),
//    ]);
}
add_action('init', 'tot_register_post_types');

function tot_register_post_type($name, $args)
{
    $defaultArgs = [
        'public' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
    ];
    register_post_type($name, array_merge($defaultArgs, $args));
}

/**
 * Все слова с начинаются со строчной буквы (например, "услуги")
 * @param $nom_pl string им.п., мн.ч.
 * @param $nom_s string им.п., ед.ч.
 * @param $acc_pl string вин.п., мн.ч.
 * @param $acc_s string вин.п., ед.ч.
 * @param $gen_pl string род.п., мн.ч.
 * @param $gen_s string род.п., ед.ч.
 * @param $gender string f - ж.р., m - м.р., n - ср.р.
 * @return array
 */
function tot_post_type_labels_ru($nom_pl, $nom_s, $acc_pl, $acc_s, $gen_pl, $gen_s, $gender = 'f')
{
    $new_acc_s = 'новую';
    $new_nom_s = 'новая';
    if ($gender == 'm') {
        $new_acc_s = 'новый';
        $new_nom_s = 'новый';
    } elseif ($gender == 'n') {
        $new_acc_s = 'новое';
        $new_nom_s = 'новое';
    }
    return [
        'name' => tot_mb_ucfirst($nom_pl),
        'singular_name' => tot_mb_ucfirst($nom_s),
        'add_new' => 'Добавить ' . $new_acc_s,
        'add_new_item' => 'Добавить ' . $acc_s,
        'edit_item' => 'Редактировать ' . $acc_s,
        'new_item' => tot_mb_ucfirst($new_nom_s) . ' ' . $nom_s,
        'view_item' => 'Просмотреть ' . $acc_s,
        'search_items' => 'Поиск ' . $acc_pl,
        'parent_item_colon' => '',
        'all_items' => 'Все ' . $nom_pl,
        'archives' => 'Архивы ' . $gen_pl,
        'insert_into_item' => 'Вставить в ' . $acc_s,
        'uploaded_to_this_item' => 'Загруженные для этой ' . $gen_s,
        'featured_image' => 'Миниатюра ' . $gen_s,
        'filter_items_list' => 'Фильтровать список ' . $gen_pl,
        'items_list_navigation' => 'Навигация по списку ' . $gen_pl,
        'items_list' => 'Список ' . $gen_pl,
        'name_admin_bar' => tot_mb_ucfirst($acc_s), // пункте "добавить"
    ];
}