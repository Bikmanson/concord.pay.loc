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
?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div class="b-block-preview__title">
            <img src="<?= $img ?>" alt="Image" loading="lazy" style="width: 100%; height: auto">
        </div>
    </div>
<?php else: ?>
    <div class="b-industry-cover">
        <div class="b-industry-cover__inner" style="background-image: url('<?= $img ?>')">

        </div>
    </div>
<?php endif ?>
