<?php
/**
 * Testimonial Block Template.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var int|string $post_id The post ID this block is saved to.
 */

$img = get_field('img');
$alt = get_field('alt');
?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div class="b-block-preview__title">
            <img src="<?= $img ?>" alt="<?= $alt ?>" loading="lazy">
        </div>
    </div>
<?php else: ?>
    <div class="b-content b-article__content-block">
        <img src="<?= $img ?>" alt="<?= $alt ?>" loading="lazy">
    </div>
<?php endif ?>
