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
$cards = get_field('cards');
?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div class="b-block-preview__title">
            <?= $title ?>
        </div>
    </div>
<?php else: ?>
    <div class="b-section b-section__container">
        <div class="b-industry-functions">
            <h2 class="b-title-h3 b-title-h3_c-green b-title-h3_ta-center b-industry-functions__title">
                <?= $title ?>
            </h2>
            <div class="b-industry-functions__list">
                <div class="b-group-slider">
                    <div class="b-group-slider__list" data-group-slider-list="industry-functions">
                        <?php foreach ($cards as $card): ?>
                            <div class="b-group-slider__item">
                                <div class="b-col b-col_12">
                                    <div class="b-card-left">
                                        <div class="b-card-left__inner">
                                            <div class="b-text-md b-text-md_c-blue b-card-left__title">
                                                <?= $card['title'] ?>
                                            </div>
                                            <?php if (isset($card['content'])): ?>
                                                <div class="b-text-sm b-text-sm_c-blue b-card-left__description">
                                                    <?= $card['content'] ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="b-group-slider__arrow b-group-slider__arrow_prev"
                         data-group-slider-arrow-prev="industry-functions"></div>
                    <div class="b-group-slider__arrow b-group-slider__arrow_next"
                         data-group-slider-arrow-next="industry-functions"></div>
                </div>
            </div>

            <div class="b-industry-functions__slider">
                <div class="b-slider">
                    <div class="b-slider__inner">
                        <div class="b-slider__list" data-slider-list="industry-functions"
                             data-slider-slide-to-show="1">
                            <?php foreach ($cards as $card): ?>
                                <div class="b-slider__item">
                                    <div class="b-gray-card">
                                        <div class="b-gray-card__inner">
                                            <div class="b-text-md b-text-md_ta-center b-text-md_c-blue b-gray-card__title">
                                                <?= $card['title'] ?>
                                            </div>
                                            <?php if (isset($card['content'])): ?>
                                                <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-gray-card__description">
                                                    <?= $card['content'] ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="b-slider__arrow b-slider__arrow_prev"
                             data-slider-arrow-prev="industry-functions">
                            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.40321 15L1.59766 8L8.40321 1" stroke="white" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>
                        <div class="b-slider__arrow b-slider__arrow_next"
                             data-slider-arrow-next="industry-functions">
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
<?php endif ?>
