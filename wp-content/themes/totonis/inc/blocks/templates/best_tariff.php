<?php
/**
 * Testimonial Block Template.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var int|string $post_id The post ID this block is saved to.
 */

$left_bg_img_large = get_field('left_bg_img_large');
$left_bg_img_small = get_field('left_bg_img_small');
$title = get_field('title');
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
    <section class="b-section">
        <div class="b-section__container">
            <div class="b-best-tariff">
                <div class="b-best-tariff__inner">
                    <div class="b-best-tariff__row b-best-tariff__row_ai-center">
                        <div class="b-col b-col_6 b-col_md-7 b-col_sm-12 b-best-tariff__col">
                            <div class="b-percent-block">
                                <?php if ($left_bg_img_large): ?>
                                    <img src="<?= $left_bg_img_large ?>" alt="icon"
                                         class="b-percent-block__image" draggable="false">
                                    <img src="<?= $left_bg_img_small ?>" alt="icon"
                                         class="b-percent-block__image b-percent-block__image_xs" draggable="false">
                                <?php endif ?>
                                <!--                            <div class="b-percent-block__content">-->
                                <!--                                <div class="b-percent-block__number">-->
                                <!--                                    <span>2,4</span>%-->
                                <!--                                </div>-->
                                <!--                                <div class="b-percent-block__text">-->
                                <!--                                    Найкращий тариф-->
                                <!--                                </div>-->
                                <!--                            </div>-->
                            </div>
                        </div>
                        <div class="b-col b-col_1 b-col_d-md-none b-best-tariff__col"></div>
                        <div class="b-col b-col_5 b-col_sm-12 b-best-tariff__col b-best-tariff__col_md-first">
                            <h3 class="b-title-h3 b-title-h3_c-blue b-best-tariff__title">
                                <?= $title ?>
                            </h3>
                            <a href="<?= $btn['link'] ?: '#' ?>"
                               class="b-button b-button_sm b-button_blue b-best-tariff__button">
                                <?= $btn['text'] ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
