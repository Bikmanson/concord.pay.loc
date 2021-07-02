<?php
/**
 * Testimonial Block Template.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var int|string $post_id The post ID this block is saved to.
 */

$title = get_field('');
?>

<?php if ($is_preview): ?>
    <div class="b-block-preview">
        <div class="b-block-preview__title">
            Блог
        </div>
    </div>
<?php else: ?>
    <div class="b-section b-section_blog">
        <div class="b-section__blog-background"
            <?php if ($blog_right_bg_img = get_field('blog_right_bg_img', 'option')): ?>
                style="background-image: url('<?= $blog_right_bg_img ?>')"
            <?php endif ?>></div>
        <div class="b-section__container">
            <div class="b-blog">
                <div class="b-blog__inner">
                    <h1 class="b-title-h1 b-title-h1_c-blue b-blog__title">
                        <?= get_field('blog_title', 'option') ?>
                    </h1>
                    <div class="b-blog__category-triggers">
                        <?php foreach (get_categories() as $category): ?>
                            <a href="<?= get_category_link($category) ?>"
                               class="b-blog__category-trigger"><?= $category->cat_name ?></a>
                        <?php endforeach ?>
                    </div>
                    <div class="b-blog__list">
                        <?php
                        $categoryIds = get_terms([
                            'taxonomy' => 'category',
                            'fields' => 'ids'
                        ]);
                        $onePostPerEachCategory = [];
                        foreach ($categoryIds as $id) {
                            $onePostPerEachCategory = array_merge($onePostPerEachCategory, (new WP_Query([
                                'post_type' => 'post',
                                'cat' => $id,
                                'posts_per_page' => 1
                            ]))->get_posts());
                        }
                        $onePostPerEachCategoryIds = [];
                        foreach ($onePostPerEachCategory as $category) {
                            $onePostPerEachCategoryIds[] = $category->ID;
                        }
                        $otherPosts = (new WP_Query([
                            'post_type' => 'post',
                            'posts_per_page ' => -1,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'post__not_in' => $onePostPerEachCategoryIds
                        ]))->get_posts();
                        $posts = array_merge($onePostPerEachCategory, $otherPosts);
                        ?>
                        <?php foreach ($posts as $post): ?>
                            <div class="b-blog__item-box">
                                <div class="b-blog__item">
                                    <div class="b-image-card">
                                        <div class="b-image-card__image"
                                             style="background-image: url('<?= get_the_post_thumbnail_url($post) ?>')">
                                            <div class="b-badge b-badge_bgc-green b-badge_c-light b-image-card__badge">
                                                <?php the_category(', ', '', $post->ID); ?>
                                            </div>
                                        </div>
                                        <a href="<?= get_the_permalink($post) ?>" class="b-image-card__title">
                                            <?= get_the_title($post) ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $blog_call_to_action_title = get_field('blog_call_to_action', 'option')['title'];
    $blog_call_to_action_btn_text = get_field('blog_call_to_action', 'option')['btn']['text'];
    ?>
    <?php if ($blog_call_to_action_title && $blog_call_to_action_btn_text): ?>
        <div class="b-section b-section_blog-cta b-section_bgc-light">
            <div class="b-section__blog-cta-background"
                 style="background-image: url('<?= get_field('blog_call_to_action', 'option')['left_bg_img'] ?>')"></div>
            <div class="b-section__container">
                <div class="b-blog-cta">
                    <div class="b-blog-cta__inner">
                        <div class="b-blog-cta__row">
                            <?php if ($blog_call_to_action_title): ?>
                                <div class="b-col b-col_12 b-blog-cta__col">
                                    <h3 class="b-title-h3 b-title-h3_c-blue b-title-h3_ta-center b-blog-cta__title">
                                        <?= $blog_call_to_action_title ?>
                                    </h3>
                                </div>
                            <?php endif ?>
                            <?php if ($blog_call_to_action_btn_text): ?>
                                <div class="b-col b-col_12 b-blog-cta__col b-col_d-flex b-title-h3_jc-center">
                                    <a href="<?= get_field('blog_call_to_action', 'option')['btn']['link'] ?>"
                                       class="b-button b-button_blue b-button_sm b-blog-cta__button">
                                        <?= $blog_call_to_action_btn_text ?>
                                    </a>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>

    <?php
    $blog_last_articles = get_field('article_recommended_articles', 'option');
    $lastArticles = new WP_Query([
        'post_type' => 'post',
        'post_count' => $blog_last_articles['count'],
        'orderby' => 'date',
        'order' => 'DESC',
    ]);
    ?>
    <?php if ($lastArticles->have_posts()): ?>
        <div class="b-section">
            <div class="b-section__container">
                <div class="b-blog-new-articles">
                    <div class="b-blog-new-articles__inner">
                        <div class="b-title-h3 b-title-h3_c-green b-blog-new-articles__title">
                            <?= $blog_last_articles['title'] ?>
                        </div>
                        <div class="b-blog-new-articles__list">
                            <div class="b-group-slider">
                                <div class="b-group-slider__list" data-slide-to-show="4"
                                     data-group-slider-list="blog-new-articles">
                                    <?php while ($lastArticles->have_posts()): $lastArticles->the_post() ?>
                                        <?php $categories = get_the_category_list(', ', '') ?>
                                        <div class="b-group-slider__item">
                                            <div class="b-col b-col_12">
                                                <div class="b-image-card">
                                                    <div
                                                       class="b-image-card__image"
                                                       style="background-image: url('<?= get_the_post_thumbnail_url() ?>')">
                                                        <?php if ($categories): ?>
                                                            <div class="b-badge b-badge_bgc-green b-badge_c-light b-image-card__badge">
                                                                <?= $categories ?>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>
                                                    <a href="<?= get_the_permalink() ?>" class="b-image-card__title">
                                                        <?= get_the_title() ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endwhile ?>
                                </div>
                                <div class="b-group-slider__arrow b-group-slider__arrow_prev"
                                     data-group-slider-arrow-prev="blog-new-articles"></div>
                                <div class="b-group-slider__arrow b-group-slider__arrow_next"
                                     data-group-slider-arrow-next="blog-new-articles"></div>
                            </div>
                        </div>
                        <div class="b-blog-new-articles__slider">
                            <div class="b-slider">
                                <div class="b-slider__inner">
                                    <div class="b-slider__list" data-slider-list="blog-new-articles"
                                         data-slider-slide-to-show="1">
                                        <?php while ($lastArticles->have_posts()): $lastArticles->the_post() ?>
                                            <div class="b-slider__item">
                                                <div class="b-image-card">
                                                    <div class="b-image-card__image"
                                                         style="background-image: url('<?= get_the_post_thumbnail_url() ?>')">
                                                        <?php if ($categories = get_the_category_list(', ', '')): ?>
                                                            <div class="b-badge b-badge_bgc-green b-badge_c-light b-image-card__badge">
                                                                <?= $categories ?>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>
                                                    <a href="<?= get_the_permalink() ?>" class="b-image-card__title">
                                                        <?= get_the_title() ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endwhile ?>
                                    </div>
                                    <div class="b-slider__arrow b-slider__arrow_prev"
                                         data-slider-arrow-prev="blog-new-articles">
                                        <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.40321 15L1.59766 8L8.40321 1" stroke="white" stroke-width="2"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>

                                    </div>
                                    <div class="b-slider__arrow b-slider__arrow_next"
                                         data-slider-arrow-next="blog-new-articles">
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
        </div>
    <?php endif ?>
<?php endif ?>
