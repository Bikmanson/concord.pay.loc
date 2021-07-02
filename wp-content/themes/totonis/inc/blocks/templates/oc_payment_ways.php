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
$top_description = get_field('top_description');
$left_block = get_field('left_block');
$right_block = get_field('right_block');
$bottom_description = get_field('bottom_description');
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
    <section class="b-section b-section_oc-payment-ways">
        <?php if ($left_bg_img): ?>
            <div class="b-section__bottom-left-background"
                 style="background-image: url('<?= $left_bg_img ?>')"></div>
        <?php endif ?>
        <div class="b-section__container">
            <div class="b-oc-payment-ways">
                <div class="b-oc-payment-ways__inner">
                    <h2 class="b-title-h3 b-title-h3_c-green b-oc-payment-ways__title">
                        <?= $title ?>
                    </h2>
                    <?php if ($top_description): ?>
                        <div class="b-test-md b-text-md_c-blue b-oc-payment-ways__description">
                            <?= $top_description ?>
                        </div>
                    <?php endif ?>
                    <div class="b-oc-payment-ways__list">
                        <div class="b-oc-payment-ways__row">
                            <div class="b-col b-col_6 b-col_sm-12 b-oc-payment-ways__col">
                                <div class="b-border-card b-border-card_bc-blue">
                                    <div class="b-border-card__inner">
                                        <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-border-card__title">
                                            <?= $left_block['title'] ?>
                                        </div>
                                        <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-border-card__description">
                                            <?= $left_block['content'] ?>
                                        </div>
                                        <?php if (isset($left_block['logo_list']) && !empty($left_block['logo_list'])): ?>
                                            <div class="b-border-card__logos">
                                                <?php foreach ($left_block['logo_list'] as $logo): ?>
                                                    <a href="<?= $logo['link'] ?: '#' ?>" class="b-border-card__logo">
                                                        <img src="<?= $logo['img'] ?>" alt="Mastercard logo" loading="lazy">
                                                    </a>
                                                <?php endforeach ?>
                                            </div>div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <div class="b-col b-col_6 b-col_sm-12 b-oc-payment-ways__col">
                                <div class="b-border-card b-border-card_bc-blue">
                                    <div class="b-border-card__inner">
                                        <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-border-card__title">
                                            <?= $right_block['title'] ?>
                                        </div>
                                        <div class="b-text-sm b-text-sm_c-blue b-border-card__description">
                                            <ol>
                                                <?php foreach ($right_block['items'] as $item): ?>
                                                    <li>
                                                        <?= $item['text'] ?>
                                                    </li>
                                                <?php endforeach ?>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($bottom_description): ?>
                        <div class="b-test-md b-text-md_c-green b-oc-payment-ways__description">
                            <?= $bottom_description ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
