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
$tabs = get_field('tabs');
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
    <script>
        // make images clickable for viewing
        $(document).ready(() => {
            $(document).find('.b-tabs__content img').map((index, img) => {
                let aNode = "<a href=\"" + $(img).attr('src') + "\" data-fancybox=\"" + index + "\">" + $(img).parent().html() + "</a>"
                $(img).parent().html(aNode);
            })
        })
    </script>
    <section class="b-section">
        <div class="b-section__container">
            <div class="b-oc-tabs-section">
                <div class="b-oc-tabs-section__inner">
                    <h2 class="b-title-h3 b-title-h3_c-blue b-oc-tabs-section__title">
                        <?= $title ?>
                    </h2>
                    <div class="b-oc-tabs-section__tabs-block">
                        <div class="b-tabs" data-tab="cms">
                            <div class="b-tabs__inner">
                                <div class="b-tabs__triggers">
                                    <?php foreach ($tabs as $tab): ?>
                                        <div class="b-tabs__trigger" data-tab-trigger>
                                            <?= $tab['title'] ?>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="b-tabs__contents">
                                    <?php foreach ($tabs as $tab): ?>
                                        <div class="b-tabs__content" data-tab-content>
                                            <div class="b-tab-content">
                                                <div class="b-text-sm b-text-sm_c-green b-text-sm_ta-center b-text-sm_fw-700 b-tab-content__title">
                                                    <?= $tab['content']['title'] ?>
                                                </div>
                                                <div class="b-text-sm b-text-sm_c-blue b-tab-content__main">
                                                    <?= $tab['content']['content'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="b-oc-tabs-section__accordion-block">
                        <div class="b-accordion" data-accordion="cms">
                            <div class="b-accordion__list">
                                <?php foreach ($tabs as $tab): ?>
                                    <div class="b-accordion__item">
                                        <div class="b-accordion__item-trigger" data-accordion-trigger>
                                            <?= $tab['title'] ?>
                                        </div>
                                        <div class="b-accordion__item-content" data-accordion-content>
                                            <div class="b-tab-content">
                                                <div class="b-text-sm b-text-sm_c-green b-text-sm_ta-center b-text-sm_fw-700 b-tab-content__title">
                                                    <?= $tab['content']['title'] ?>
                                                </div>
                                                <div class="b-text-sm b-text-sm_c-blue b-tab-content__main">
                                                    <?= $tab['content']['content'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
