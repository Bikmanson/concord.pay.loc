<?php
/**
 * Testimonial Block Template.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var int|string $post_id The post ID this block is saved to.
 */

$title = get_field('');
?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div class="b-block-preview__title">
            <?= $title ?>
        </div>
<!--        <ul>-->
<!--            --><?php //foreach ($items as $item): ?>
<!--                <li>--><?//= $item[''] ?><!--</li>-->
<!--            --><?php //endforeach ?>
<!--        </ul>-->
    </div>
<?php else: ?>
    <?php foreach ($items as $item): ?>
        <?= $item[''] ?>
    <?php endforeach ?>
<?php endif ?>
