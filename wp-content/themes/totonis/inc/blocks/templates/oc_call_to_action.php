<?php
/**
 * Testimonial Block Template.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var int|string $post_id The post ID this block is saved to.
 */

$title = get_field('title');
$btn = get_field('btn');
?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div class="b-block-preview__title">
            <?= $title ?>
        </div>
    </div>
<?php else: ?>
        <section class="b-section b-section_bgc-light">
            <div class="b-section__container">
                <div class="b-oc-cta">
                    <div class="b-oc-cta__inner">
                        <h3 class="b-title-h3 b-title-h3_c-green b-oc-cta__title">
                            <?= $title ?>
                        </h3>
                        <div class="b-oc-cta__buttons">
                            <a href="<?= $btn['link'] ?: '#' ?>" class="b-button b-button_green b-button_sm b-oc-cta__button">
                                <?= $btn['text'] ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php endif ?>
