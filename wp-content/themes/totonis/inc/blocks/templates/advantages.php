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
$title = get_field('title');
$items = get_field('items');
$btn = get_field('btn');
$form = get_field('form');
$formUniqNum = rand(0, 1000);
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
    <section class="b-section b-section_home-advantages">
        <?php if ($top_right_bg_img): ?>
            <div class="b-section__top-right-h-center-background"
                 style="background-image: url(<?= $top_right_bg_img ?>)"></div>
        <?php endif ?>
        <div class="b-section__container">
            <div class="b-advantages">
                <div class="b-advantages__inner">
                    <h2 class="b-title-h2 b-title-h2_c-green b-advantages__title">
                        <?= $title ?>
                    </h2>
                    <div class="b-advantages__list">
                        <div class="b-advantages__row">
                            <?php foreach ($items as $item): ?>
                                <div class="b-col b-col_6 b-col_sm-12 b-advantages__col">
                                    <div class="b-card">
                                        <div class="b-card__inner">
                                            <div class="b-card__icons">
                                                <div class="b-card__icons-row">
                                                    <div class="b-card__icon">
                                                        <?= file_get_contents(str_replace('concord.pay.loc', 'concord-nginx', $item['icon'])) ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="b-text-md b-text-md_ta-center b-text-md_c-blue b-card__title">
                                                <?= $item['title'] ?>
                                            </div>
                                            <?php if (isset($item['text'])): ?>
                                                <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-card__description">
                                                    <?= $item['text'] ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                            <div class="b-col b-col_12 b-col_d-flex b-col_jc-center b-advantages__col">
                                <div class="b-button b-button_green b-button_sm b-advantages__button"
                                   data-modal-trigger="questions-<?= $formUniqNum ?>">
                                    <?= $btn ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="b-modal b-modal_xs" data-modal-content="questions-<?= $formUniqNum ?>">
        <div class="b-modal__overlay" data-modal-trigger="questions-<?= $formUniqNum ?>"></div>
        <div class="b-modal__inner">
            <div class="b-modal__header">
                <div class="b-title-h2 b-title-h2_c-blue b-title-h2_fw-700 b-modal__title">
                    <?= $form['title'] ?>
                </div>
                <div class="b-modal__close" data-modal-trigger="questions-<?= $formUniqNum ?>">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M29.2804 31.64L31.6404 29.28L22.3604 20L31.6404 10.72L29.2804 8.35999L20.0004 17.64L10.7204 8.35999L8.36035 10.72L17.6404 20L8.36035 29.28L10.7204 31.64L20.0004 22.36L29.2804 31.64Z"
                              fill="#0039D1"/>
                    </svg>

                </div>
            </div>
            <div class="b-modal__main">
                <div class="b-form">
                    <?= do_shortcode("[contact-form-7 id='{$form['form']}' title='{$form['title']}']") ?>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
