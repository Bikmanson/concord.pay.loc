<?php
/**
 * Testimonial Block Template.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var int|string $post_id The post ID this block is saved to.
 */

$first_title = get_field('first_title');
$second_title = get_field('second_title');
$text = get_field('text');
$logo_list = get_field('logo_list');
?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div class="b-block-preview__title">
            <?= $first_title ?>
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
            <div class="b-acceptance-payments">
                <div class="b-acceptance-payments__inner">
                    <h2 class="b-title-h2 b-title-h2_c-green b-title-h2_ta-center b-acceptance-payments__title">
                        <?= $first_title ?>
                    </h2>
                    <?php if ($second_title): ?>
                        <h3 class="b-title-h3 b-title-h3_c-blue b-title-h3_ta-center b-acceptance-payments__subtitle">
                            <?= $second_title ?>
                        </h3>
                    <?php endif ?>
                    <div class="b-text-md b-text-md_c-blue b-text-md_ta-center b-acceptance-payments__description">
                        <?= $text ?>
                    </div>
                    <?php if (isset($logo_list) && !empty($logo_list)): ?>
                        <div class="b-acceptance-payments__logos-list">
                            <div class="b-acceptance-payments__row b-acceptance-payments__row_jc-center">
                                <?php foreach ($logo_list as $item): ?>
                                    <a href="<?= isset($item['link']) ? $item['link'] : '#' ?>" class="b-col b-col_2 b-col_md-4 b-col_sm-6 b-col_xs-12 b-col_ta-center b-acceptance-payments__col">
                                        <img src="<?= $item['img'] ?>" alt="Mastercard logo">
                                    </a>
                                <?php endforeach ?>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>