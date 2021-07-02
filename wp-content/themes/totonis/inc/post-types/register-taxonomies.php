<?php
function tot_register_taxonomies()
{
//    tot_register_taxonomy('taxonomy', ['service'], [
//        'labels' => tot_taxonomies_labels_ru('категории', 'категория', 'категории', 'категорию', 'категорий', 'категории'),
//    ]);
}
add_action('init', 'tot_register_taxonomies');

function tot_register_taxonomy($taxonomy, $object_type, $args = [])
{
    $defaultArgs = [
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
    ];
    register_taxonomy($taxonomy, $object_type, array_merge($defaultArgs, $args));
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
function tot_taxonomies_labels_ru($nom_pl, $nom_s, $acc_pl, $acc_s, $gen_pl, $gen_s, $gender = 'f')
{
    $new_acc_s = 'новую';
    $parent_s = 'Родительская';
    if ($gender == 'm') {
        $new_acc_s = 'новый';
        $parent_s = 'Родительский';
    } elseif ($gender == 'n') {
        $new_acc_s = 'новое';
        $parent_s = 'Родительское';
    }
    return [
        'name' => tot_mb_ucfirst($nom_pl),
        'singular_name' => tot_mb_ucfirst($nom_s),
        'search_items' => 'Поиск ' . $gen_s,
        'all_items' => 'Все ' . $nom_pl,
        'parent_item' => $parent_s . ' ' . $nom_s,
        'parent_item_colon' => $parent_s . ' ' . $nom_s . ':',
        'edit_item' => 'Изменить ' . $acc_s,
        'update_item' => 'Обновить ' . $acc_s,
        'add_new_item' => 'Добавить ' . $new_acc_s . ' ' . $acc_s,
        'view_item' => 'Просмотреть ' . $acc_s,
        'new_item_name' => 'Название ' . $new_acc_s . ' ' . $gen_s,
        'add_or_remove_items' => 'Добавить или удалить ' . $acc_pl,
        'choose_from_most_used' => 'Выберите из часто используемых ' . $acc_pl,
        'popular_items' => 'Популярные ' . $nom_pl,
        'not_found' => $gen_pl . ' не найдено.',
        'no_terms' => $gen_pl . ' нет',
    ];
}
