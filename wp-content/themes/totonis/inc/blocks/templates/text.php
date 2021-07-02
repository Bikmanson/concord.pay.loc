<?php
/**
 * Testimonial Block Template.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var int|string $post_id The post ID this block is saved to.
 */

$content = get_field('content');
?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div style="overflow: hidden">
            <?= $content ?>
        </div>
    </div>
<?php else: ?>
    <div class="b-content b-content_c-blue b-article__content-block">
        <?= $content ?>
    </div>
<?php endif ?>
