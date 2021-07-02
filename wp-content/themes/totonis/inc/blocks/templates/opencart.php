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
$title = get_field('title');
$description = get_field('description');
$left_card = get_field('left_card');
$right_card = get_field('right_card');
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
    <section class="b-section b-section_op-cover">
        <?php if ($top_right_bg_img): ?>
            <div class="b-section__top-right-background"
                 style="background-image: url('<?= $top_right_bg_img ?>')"></div>
        <?php endif ?>
        <div class="b-section__container">
            <div class="b-oc-cover">
                <div class="b-oc-cover__inner">
                    <a href="<?= $logo['link'] ?>" class="b-oc-cover__logo">
                        <img src="<?= $logo['img'] ?>" alt="Opencart logo" loading="lazy">
                    </a>
                    <h1 class="b-text-md b-text-md_c-blue b-oc-cover__small-title">
                        <?= $title ?>
                    </h1>
                    <div class="b-text-md b-text-md_c-blue b-oc-cover__description">
                        <?= $description ?>
                    </div>
                    <div class="b-oc-cover__row">
                        <div class="b-col b-col_6 b-col_sm-12 b-oc-cover__col">
                            <div class="b-gray-card">
                                <div class="b-gray-card__inner">
                                    <?php if (isset($left_card['icons']) && !empty($left_card['icons'])): ?>
                                        <div class="b-gray-card__icons">
                                            <div class="b-gray-card__icons-row">
                                                <?php foreach ($left_card['icons'] as $icon): ?>
                                                    <div class="b-gray-card__icon">
                                                        <?= file_get_contents(str_replace('concord.pay.loc', 'concord-nginx', $icon)) ?>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-gray-card__description">
                                        <?= $left_card['content'] ?>
                                    </div>
                                    <?php if (isset($left_card['logo_list']) && !empty($left_card['logo_list'])): ?>
                                        <div class="b-gray-card__logos">
                                            <?php foreach ($left_card['logo_list'] as $logo): ?>
                                                <a href="<?= $logo['link'] ?: '#' ?>" class="b-gray-card__logo">
                                                    <img src="<?= $logo['img'] ?>" alt="Mastercard logo" loading="lazy">
                                                </a>
                                            <?php endforeach ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="b-col b-col_6 b-col_sm-12 b-oc-cover__col">
                            <div class="b-oc-cover__column">
                                <div class="b-col b-col_12 b-oc-cover__col">
                                    <div class="b-gray-card">
                                        <div class="b-gray-card__inner">
                                            <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-gray-card__description">
                                                <?= $right_card['top_content'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="b-col b-col_12 b-oc-cover__col">
                                    <div class="b-gray-card">
                                        <div class="b-gray-card__inner">
                                            <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-gray-card__description">
                                                <?= $right_card['bottom_content'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
