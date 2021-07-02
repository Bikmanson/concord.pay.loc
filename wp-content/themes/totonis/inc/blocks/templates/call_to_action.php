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
$form = get_field('form');
$formUniqNum = rand(0, 1000);
?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div class="b-block-preview__title">
            <?= $title ?>
        </div>
    </div>
<?php else: ?>
    <div class="b-section b-section_bgc-light">
        <div class="b-section__container">
            <div class="b-industry-cta">
                <h3 class="b-title-h3 b-title-h3_ta-center b-title-h3_c-blue b-industry-cta__title">
                    <?= $title ?>
                </h3>
                <div class="b-industry-cta__buttons">
                    <div class="b-button b-button_xs b-button_blue b-industry-cta__button" data-modal-trigger="industry-questions-<?= $formUniqNum ?>">
                        <?= $btn ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="b-modal b-modal_xs" data-modal-content="industry-questions-<?= $formUniqNum ?>">
        <div class="b-modal__overlay" data-modal-trigger="industry-questions-<?= $formUniqNum ?>"></div>
        <div class="b-modal__inner">
            <div class="b-modal__header">
                <div class="b-title-h2 b-title-h2_c-blue b-title-h2_fw-700 b-modal__title">
                    <?= $form['title'] ?>
                </div>
                <div class="b-modal__close" data-modal-trigger="industry-questions-<?= $formUniqNum ?>">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M29.2804 31.64L31.6404 29.28L22.3604 20L31.6404 10.72L29.2804 8.35999L20.0004 17.64L10.7204 8.35999L8.36035 10.72L17.6404 20L8.36035 29.28L10.7204 31.64L20.0004 22.36L29.2804 31.64Z"
                              fill="#0039D1"/>
                    </svg>

                </div>
            </div>
            <div class="b-modal__main">
                <div class="b-form">
                    <?= do_shortcode("[contact-form-7 id='{$form['form']}' title='{$form['title']}']") ?>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
