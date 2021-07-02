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
$right_top_img = get_field('right_top_img');
$marker_list_items = get_field('marker_list_items');
$cards = get_field('cards');
$number_cards = get_field('number_cards');

?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div class="b-block-preview__title">
            <?= $title ?>
        </div>
    </div>
<?php else: ?>
    <section class="b-section b-section_gp-cover">
        <?php if ($right_top_img): ?>
            <div class="b-section__top-right-background-2"
                 style="background-image: url('<?= $right_top_img ?>')"></div>
        <?php endif ?>
        <div class="b-section__container">
            <div class="b-gp-cover">
                <div class="b-gp-cover__inner">
                    <div class="b-gp-cover__row">
                        <div class="b-col b-col_6 b-col_sm-12 b-gp-cover__col">
                            <div class="b-gp-cover__row">
                                <div class="b-col b-col_12 b-gp-cover__col">
                                    <h1 class="b-title-h2 b-title-h2_c-blue">
                                        <?= $title ?>
                                    </h1>
                                </div>
                                <?php if ($marker_list_items): ?>
                                    <div class="b-col b-col_12 b-gp-cover__col">
                                        <div class="b-text-md b-text-md_c-blue b-gp-cover__description">
                                            <div class="b-marker-list">
                                                <ul>
                                                    <?php foreach ($marker_list_items as $item): ?>
                                                        <li>
                                                            <?= $item['text'] ?>
                                                        </li>
                                                    <?php endforeach ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="b-col b-col_6 b-col_d-sm-none b-gp-cover__col"></div>
                        <?php foreach ($cards as $card): ?>
                            <div class="b-col b-col_6 b-col_sm-12 b-gp-cover__col">
                                <div class="b-gray-card">
                                    <div class="b-gray-card__inner">
                                        <div class="b-gray-card__icons">
                                            <div class="b-gray-card__icons-row">
                                                <div class="b-gray-card__icon">
                                                    <?= file_get_contents(str_replace('concord.pay.loc', 'concord-nginx', $card['img'])) ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-gray-card__description">
                                            <?= $card['content'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                        <?php if ($number_cards): ?>
                            <div class="b-col b-col_12 b-gp-cover__col">
                                <div class="b-gp-cover__row">
                                    <div class="b-col b-col_12 b-gp-cover__col">
                                        <h2 class="b-title-h3 b-title-h3_ta-center b-title-h3_c-green">
                                            <?= $number_cards['title'] ?>
                                        </h2>
                                    </div>
                                    <?php foreach ($number_cards['items'] as $index => $item): ?>
                                        <div class="b-col b-col_3 b-col_md-6 b-col_xs-12 b-gp-cover__col">
                                            <div class="b-number-card">
                                                <div class="b-number-card__inner">
                                                    <div class="b-number-card__header">
                                                        <div class="b-number-card__counter">
                                                            <?= $index+1 ?>
                                                        </div>
                                                    </div>
                                                    <div class="b-number-card__main">
                                                        <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-number-card__description">
                                                            <?= $item['text'] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
