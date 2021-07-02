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
$content = get_field('content');
$btn = get_field('btn');
?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div class="b-block-preview__title">
            <?= $title ?>
        </div>
    </div>
<?php else: ?>
    <div class="b-section">
        <div class="b-section__container">
            <div class="b-industry-payment-system">
                <h1 class="b-title-h2 b-title-h2_c-blue b-industry-payment-system__title">
                    <?= $title ?>
                </h1>
                <div class="b-text-md b-text-md_c-blue b-industry-payment-system__description">
                    <?= $content ?>
                </div>
                <?php if ($btn): ?>
                    <div class="b-industry-payment-system__buttons">
                        <a href="<?= $btn['link'] ?>"
                           class="b-button b-button_sm b-button_green b-industry-payment-system__button">
                            <?= $btn['text'] ?>
                        </a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php endif ?>
