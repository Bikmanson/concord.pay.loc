<?php
/**
 * Testimonial Block Template.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var int|string $post_id The post ID this block is saved to.
 */

$right_bg_img = get_field('right_bg_img');
$title = get_field('title');
$block = get_field('block');
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
    <section class="b-section b-section_op-instruction b-section_bgc-light">
        <?php if ($right_bg_img): ?>
            <div class="b-section__top-right-offset-instruction-background"
                 style="background-image: url('<?= $right_bg_img ?>')"></div>
        <?php endif ?>
        <div class="b-section__container">
            <div class="b-gp-how-it-work">
                <div class="b-gp-how-it-work__inner">
                    <h2 class="b-title-h3 b-title-h3_c-blue b-gp-how-it-work__title">
                        <?= $title ?>
                    </h2>
                    <div class="b-gp-how-it-work__row b-gp-how-it-work__row_jc-center">
                        <div class="b-col b-col_6 b-col_lg-8 b-col_md-10 b-col_sm-12 b-gp-how-it-work__col">
                            <div class="b-card b-card_bgc-white">
                                <div class="b-card__inner b-card__inner_padding">
                                    <div class="b-text-sm b-text-sm_c-blue b-text-sm_ta-center b-card__title">
                                        <?= $block['title'] ?>
                                    </div>
                                    <div class="b-text-sm b-text-sm_c-blue b-card__description">
                                        <ol>
                                            <?php foreach ($block['items'] as $item): ?>
                                                <li><?= $item['text'] ?></li>
                                            <?php endforeach ?>
                                        </ol>
                                    </div>
                                    <?php if ($block['bottom_text']): ?>
                                        <div class="b-text-sm b-text-sm_c-green b-text-sm_ta-center b-card__description">
                                            <?= $block['bottom_text'] ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
