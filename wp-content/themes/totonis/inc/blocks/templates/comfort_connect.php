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
$description = get_field('description');
$first_content = get_field('first_content');
$logo_list = get_field('logo_list');
$second_content = get_field('second_content');
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
    <section class="b-section b-section_comfort-connect">
        <?php if ($left_bg_img): ?>
            <div class="b-section__top-left-background"
                 style="background-image: url(<?= $left_bg_img ?>)"></div>
        <?php endif ?>
        <div class="b-section__container">
            <div class="b-comfort-connect">
                <div class="b-comfort-connect__inner">
                    <div class="b-comfort-connect__row">
                        <div class="b-col b-col_6 b-col_d-sm-none b-comfort-connect__col"></div>
                        <div class="b-col b-col_6 b-col_sm-12 b-comfort-connect__col">
                            <h2 class="b-title-h2 b-title-h2_c-green b-comfort-connect__title">
                                <?= $title ?>
                            </h2>
                            <?php if ($description): ?>
                                <div class="b-text-md b-text-md_c-green b-comfort-connect__description">
                                    <?= $description ?>
                                </div>
                            <?php endif ?>
                            <?php if ($first_content): ?>
                                <div class="b-comfort-connect__content-block">
                                    <?php if (isset($first_content['title'])): ?>
                                        <div class="b-text-md b-text-md_fw-700 b-text-md_c-blue b-comfort-connect__content-block-title">
                                            <?= $first_content['title'] ?>
                                        </div>
                                    <?php endif ?>
                                    <div class="b-text-sm b-text-sm_c-blue b-comfort-connect__content-block-text">
                                        <?= $first_content['content'] ?>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="b-comfort-connect__logos-list">
                                <?php foreach ($logo_list as $item): ?>
                                    <a href="<?= isset($item['link']) ? $item['link'] : '#' ?>"
                                       class="b-comfort-connect__logos-item">
                                        <img src="<?= $item['img'] ?>" alt="Opencart logo">
                                    </a>
                                <?php endforeach ?>
                            </div>
                            <?php if ($second_content): ?>
                                <div class="b-comfort-connect__content-block">
                                    <?php if (isset($second_content['title'])): ?>
                                        <div class="b-text-md b-text-md_fw-700 b-text-md_c-blue b-comfort-connect__content-block-title">
                                            <?= $second_content['title'] ?>
                                        </div>
                                    <?php endif ?>
                                    <div class="b-text-sm b-text-sm_c-blue b-comfort-connect__content-block-text">
                                        <?= $second_content['content'] ?>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
