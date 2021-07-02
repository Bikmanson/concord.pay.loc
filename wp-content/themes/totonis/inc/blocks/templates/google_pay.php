<?php
/**
 * Testimonial Block Template.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var int|string $post_id The post ID this block is saved to.
 */

$top_right_bg_img = get_field('top_right_bg_img');
$logo = get_field('logo');
$description = get_field('description');
$items = get_field('items');
$btn = get_field('btn');
?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div class="b-block-preview__title">
            <?= $description ?>
        </div>
        <!--        <ul>-->
        <!--            --><?php //foreach ($items as $item): ?>
        <!--                <li>--><? //= $item[''] ?><!--</li>-->
        <!--            --><?php //endforeach ?>
        <!--        </ul>-->
    </div>
<?php else: ?>
    <section class="b-section b-section_gp-cover">
        <?php if ($top_right_bg_img): ?>
            <div class="b-section__top-right-background"
                 style="background-image: url('<?= $top_right_bg_img ?>')"></div>
        <?php endif ?>
        <div class="b-section__container">
            <div class="b-gp-cover">
                <div class="b-gp-cover__inner">
                    <div class="b-gp-cover__row">
                        <div class="b-col b-col_6 b-col_sm-12 b-gp-cover__col">
                            <a href="<?= $logo['link'] ?>" target="_blank" class="b-gp-cover__logo">
                                <img src="<?= $logo['img'] ?>" alt="Google play logo" loading="lazy">
                            </a>
                            <div class="b-text-md b-text-md_c-blue b-gp-cover__description">
                                <?= $description ?>
                            </div>
                        </div>
                        <div class="b-col b-col_6 b-col_d-sm-none b-gp-cover__col"></div>
                        <?php if ($items && !empty($items)): ?>
                            <?php foreach ($items as $item): ?>
                                <div class="b-col b-col_6 b-col_sm-12 b-gp-cover__col">
                                    <div class="b-gray-card">
                                        <div class="b-gray-card__inner">
                                            <div class="b-gray-card__icons">
                                                <div class="b-gray-card__icons-row">
                                                    <?php if (isset($item['icons']) && !empty($item['icons'])): ?>
                                                        <?php foreach ($item['icons'] as $icon): ?>
                                                            <div class="b-gray-card__icon">
                                                                <?= file_get_contents(str_replace('concord.pay.loc', 'concord-nginx', $icon)) ?>

                                                            </div>
                                                        <?php endforeach ?>
                                                    <? endif ?>
                                                </div>
                                            </div>
                                            <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-gray-card__description">
                                                <?= $item['content'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <? endif ?>
                        <div class="b-col b-col_12 b-col_d-flex b-col_jc-center b-gp-cover__col">
                            <a href="<?= $btn['link'] ?>" target="_blank"
                               class="b-button b-button_sm b-button_green">
                                <?= $btn['text'] ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
