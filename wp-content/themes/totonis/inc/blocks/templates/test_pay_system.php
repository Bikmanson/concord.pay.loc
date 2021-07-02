<?php
/**
 * Testimonial Block Template.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var int|string $post_id The post ID this block is saved to.
 */

$left_bg_img = get_field('left_bg_img');
$title = get_field('title');
$text = get_field('text');
$btn = get_field('btn');
?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div class="b-block-preview__title">
            <?= $title ?>
        </div>
        <!--        <ul>-->
        <!--            --><?php //foreach ($items as $item): ?>
        <!--                <li>--><? //= $item[''] ?><!--</li>-->
        <!--            --><?php //endforeach ?>
        <!--        </ul>-->
    </div>
<?php else: ?>
    <section class="b-section b-section_test-pay-system">
        <div class="b-section__container">
            <div class="b-test-pay-system b-test-pay-system_bgc-light">
                <?php if ($left_bg_img): ?>
                    <img src="<?= $left_bg_img ?>"
                         class="b-test-pay-system__background-image" loading="lazy">
                <?php endif ?>
                <div class="b-test-pay-system__inner">
                    <h2 class="b-title-h2 b-title-h2_c-blue b-test-pay-system__title">
                        <?= $title ?>
                    </h2>
                    <?php if ($text): ?>
                        <div class="b-text-md b-text-md_c-blue b-test-pay-system__description">
                            <?= $text ?>
                        </div>
                    <?php endif ?>
                    <div class="b-test-pay-system__buttons">
                        <a href="<?= $btn['link'] ?: '#' ?>"
                           class="b-button b-button_sm b-button_green b-test-pay-system__button">
                            <?= $btn['text'] ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
