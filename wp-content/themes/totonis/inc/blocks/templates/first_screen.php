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
$btn = get_field('btn');
$right_bg_img = get_field('right_bg_img');
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
    <section class="b-section b-section_home-cover">
        <?php if ($right_bg_img): ?>
            <div class="b-section__top-right-background"
                 style="background-image: url(<?= $right_bg_img ?>)"></div>
        <?php endif ?>
        <div class="b-section__container">
            <div class="b-home-cover">
                <div class="b-home-cover__inner">
                    <div class="b-home-cover__row">
                        <div class="b-col b-col_6 b-col_md-12 b-home-cover__col">
                            <h1 class="b-title-h1 b-title-h1_c-blue b-home-cover__title ">
                                <?= $title ?>
                            </h1>
                            <?php if ($items): ?>
                                <div class="b-marker-list b-marker-list_c-blue b-marker-list_text-md b-home-cover__marker-list">
                                    <ul>
                                        <?php foreach ($items as $item): ?>
                                            <li>
                                                <?= $item['text'] ?>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif ?>
                            <a href="<?= $btn['link'] ?: '#' ?>"
                               class="b-button b-button_sm b-button_green b-hover-cover__button">
                                <?= $btn['text'] ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
