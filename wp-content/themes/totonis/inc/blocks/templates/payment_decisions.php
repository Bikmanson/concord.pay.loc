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
            <div class="b-payment-decisions">
                <div class="b-payment-decisions__inner">
                    <h2 class="b-title-h2 b-title-h2_c-green b-payment-decisions__title">
                        <?= $title ?>
                    </h2>
                </div>
                <div class="b-payment-decisions__list">
                    <div class="b-payment-decisions__row">
                        <?php foreach ($items as $item): ?>
                            <div class="b-col b-col_4 b-col_lg-6 b-col_sm-12 b-payment-decisions__col">
                                <div class="b-icon-card">
                                    <div class="b-icon-card__inner">
                                        <div class="b-icon-card__icon">
                                            <?= file_get_contents(str_replace('concord.pay.loc', 'concord-nginx', $item['icon'])) ?>

                                        </div>
                                        <div class="b-icon-card__main">
                                            <div class="b-icon-card__title b-icon-card__title_c-blue">
                                                <?= $item['title'] ?>
                                            </div>
                                            <?php if (isset($item['items'])): ?>
                                                <div class="b-icon-card__description b-icon-card__description_c-blue">
                                                    <ul>
                                                        <?php foreach ($item['items'] as $text): ?>
                                                            <li><?= $text['text'] ?></li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>

                <div class="b-payment-decisions__slider">
                    <div class="b-slider">
                        <div class="b-slider__inner">
                            <div class="b-slider__list" data-slider-list="payment-decisions"
                                 data-slider-slide-to-show="1">
                                <?php foreach ($items as $item): ?>
                                    <div class="b-slider__item">
                                        <div class="b-gray-card">
                                            <div class="b-gray-card__inner">
                                                <div class="b-gray-card__icons">
                                                    <div class="b-gray-card__icons-row">
                                                        <div class="b-gray-card__icon">
                                                            <?= file_get_contents(str_replace('concord.pay.loc', 'concord-nginx', $item['icon'])) ?>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="b-text-md b-text-md_ta-center b-text-md_c-blue b-gray-card__title">
                                                    <?= $item['title'] ?>
                                                </div>
                                                <?php if (isset($item['items'])): ?>
                                                    <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-gray-card__description">
                                                        <ul>
                                                            <?php foreach ($item['items'] as $text): ?>
                                                                <li><?= $text['text'] ?></li>
                                                            <?php endforeach ?>
                                                        </ul>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <div class="b-slider__arrow b-slider__arrow_prev"
                                 data-slider-arrow-prev="payment-decisions">
                                <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.40321 15L1.59766 8L8.40321 1" stroke="white" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </div>
                            <div class="b-slider__arrow b-slider__arrow_next"
                                 data-slider-arrow-next="payment-decisions">
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
    </section>
<?php endif ?>
