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
    </div>
<?php else: ?>
    <section class="b-section b-section_bgc-light">
        <div class="b-section__container">
            <div class="b-gp-how-it-work">
                <div class="b-gp-how-it-work__inner">
                    <h2 class="b-title-h3 b-title-h3_c-blue b-gp-how-it-work__title">
                        <?= $title ?>
                    </h2>
                    <div class="b-gp-how-it-work__row b-gp-how-it-work__row_jc-center">
                        <?php foreach ($items as $item): ?>
                            <div class="b-col b-col_6 b-col_lg-8 b-col_md-10 b-col_sm-12 b-gp-how-it-work__col">
                                <div class="b-card b-card_border b-card_bc-blue">
                                    <div class="b-card__inner b-card__inner_d-flex b-card__inner_fd-column b-card__inner_jc-between b-card__inner_padding">
                                        <div class="b-text-sm b-text-sm_ta-center b-text-sm_c-blue b-card__description">
                                            <?= $item['content'] ?>
                                        </div>
                                        <?php if (isset($item['logos'])): ?>
                                            <div class="b-card__logos">
                                                <?php foreach ($item['logos'] as $logo): ?>
                                                    <a href="<?= $logo['link'] ?: '#' ?>" class="b-card__logo">
                                                        <img src="<?= $logo['img'] ?>" alt="logo" loading="lazy">
                                                    </a>
                                                <?php endforeach ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
