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
$logo_list = get_field('logo_list');
$items_title = get_field('items_title');
$items = get_field('items');
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
            <div class="b-gp-cms">
                <div class="b-gp-cms__inner">
                    <h2 class="b-title-h3 b-title-h3_c-green b-gp-cms__title">
                        <?= $title ?>
                    </h2>
                    <div class="b-gp-cms__list">
                        <div class="b-gp-cms__row b-gp-cms__row_jc-center">
                            <?php foreach ($logo_list as $logo): ?>
                                <a href="<?= $logo['link'] ?: '#' ?>"
                                   class="b-col b-col_3 b-col_sm-6 b-col_d-flex b-col_jc-center b-gp-cms__col">
                                    <img src="<?= $logo['img'] ?>" alt="Opencart logo" loading="lazy">
                                </a>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="b-gray-box b-gp-cms__gray-box">
                        <div class="b-gray-box__inner">
                            <div class="b-title-h3 b-title-h3_c-blue b-title-h3_fw-700 b-gray-box__title">
                                <?= $items_title ?>
                            </div>
                            <div class="b-gray-box__list">
                                <div class="b-gray-box__row">
                                    <?php foreach ($items as $item): ?>
                                        <div class="b-col b-col_6 b-col_sm-12 b-gray-box__col">
                                            <div class="b-card">
                                                <div class="b-card__inner">
                                                    <?php if (isset($item['icon']) && !empty($item['icon'])): ?>
                                                        <div class="b-card__icons">
                                                            <div class="b-card__icons-row">
                                                                <div class="b-card__icon">
                                                                    <?= file_get_contents(str_replace('concord.pay.loc', 'concord-nginx', $item['icon'])) ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                    <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-card__description">
                                                        <?= $item['content'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
