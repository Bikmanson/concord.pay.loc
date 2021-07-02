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
$left_bottom_img = get_field('left_bottom_img');
$right_top_img = get_field('right_top_img');
$items = get_field('items');
?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div class="b-block-preview__title">
            <?= $title ?>
        </div>
    </div>
<?php else: ?>
    <section class="b-section b-section_bgc-light b-section_industry-advantages">
        <?php if ($right_top_img): ?>
            <div class="b-section__industry-advantages-background-1"
                 style="background-image: url('<?= $right_top_img ?>')"></div>
        <?php endif ?>
        <?php if ($left_bottom_img): ?>
            <div class="b-section__industry-advantages-background-2"
                 style="background-image: url('<?= $left_bottom_img ?>')"></div>
        <?php endif ?>
        <div class="b-section__container">
            <div class="b-industry-advantages">
                <div class="b-industry-advantages__inner">
                    <h2 class="b-title-h2 b-title-h2_c-green b-industry-advantages__title">
                        <?= $title ?>
                    </h2>
                    <div class="b-industry-advantages__list">
                        <div class="b-advantages__row">
                            <?php foreach ($items as $item): ?>
                                <div class="b-col b-col_6 b-col_sm-12 b-advantages__col">
                                    <div class="b-card">
                                        <div class="b-card__inner">
                                            <div class="b-card__icons">
                                                <div class="b-card__icons-row">
                                                    <div class="b-card__icon">
                                                        <?= file_get_contents(str_replace('concord.pay.loc', 'concord-nginx', $item['img'])) ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="b-text-md b-text-md_ta-center b-text-md_c-blue b-card__title">
                                                <?= $item['title'] ?>
                                            </div>
                                            <?php if (isset($item['content'])): ?>
                                                <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-card__description">
                                                    <?= $item['content'] ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>

                    <div class="b-industry-advantages__slider">
                        <div class="b-slider">
                            <div class="b-slider__inner">
                                <div class="b-slider__list" data-slider-list="industry-advantages"
                                     data-slider-slide-to-show="1">
                                    <?php foreach ($items as $item): ?>
                                        <div class="b-slider__item">
                                            <div class="b-card">
                                                <div class="b-card__inner">
                                                    <div class="b-card__icons">
                                                        <div class="b-card__icons-row">
                                                            <div class="b-card__icon">
                                                                <?= file_get_contents(str_replace('concord.pay.loc', 'concord-nginx', $item['img'])) ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="b-text-md b-text-md_ta-center b-text-md_c-blue b-card__title">
                                                        <?= $item['title'] ?>
                                                    </div>
                                                    <?php if (isset($item['content'])): ?>
                                                        <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-card__description">
                                                            <?= $item['content'] ?>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="b-slider__arrow b-slider__arrow_prev"
                                     data-slider-arrow-prev="industry-advantages">
                                    <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.40321 15L1.59766 8L8.40321 1" stroke="white" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                </div>
                                <div class="b-slider__arrow b-slider__arrow_next"
                                     data-slider-arrow-next="industry-advantages">
                                    <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.59679 1L8.40234 8L1.59679 15" stroke="white" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
