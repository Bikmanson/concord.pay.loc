<?php
/**
 * Testimonial Block Template.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var int|string $post_id The post ID this block is saved to.
 */

$head = get_field('head');
$rows = get_field('rows');
?>

<div class="b-content b-content_c-blue b-article__content-block">
    <table>
        <?php if ($head): ?>
            <tr>
                <?php foreach ($head['columns'] as $column): ?>
                    <th><?= $column['text'] ?></th>
                <?php endforeach ?>
            </tr>
        <?php endif ?>
        <?php foreach ($rows as $row): ?>
            <tr>
                <?php foreach ($row['columns'] as $column): ?>
                    <td><?= $column['text'] ?></td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
    </table>
</div>
