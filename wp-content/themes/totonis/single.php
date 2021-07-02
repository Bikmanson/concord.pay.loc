<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

        <div class="b-section">
            <div class="b-section__container">
                <div class="b-breadcrumbs" style="max-width: 720px;margin: auto;">
                    <?php TotView::breadcrumbs(); ?>
                </div>
            </div>
        </div>
    <!-- -->
    <div class="b-section">
        <div class="b-section__container">
            <div class="b-article">
                <div class="b-article__inner">
                    <h1 class="b-title-h1 b-title-h1__c-blue b-article__title">
                        <?php the_title() ?>
                    </h1>
                    <div class="b-article__meta">
                        <?php the_date('d-m-Y') ?>
                    </div>
                    <div class="b-article__content">
                        <?php the_content() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $article_recommended_articles = get_field('article_recommended_articles', 'option');
    $recommendedArticles = (new WP_Query([
        'post_type' => 'post',
        'post_count' => $article_recommended_articles['count'],
        'post__not_in' => [get_the_ID()],
        'orderby' => 'date',
        'order'   => 'DESC',
    ]))->get_posts();
    ?>
    <?php if ($recommendedArticles): ?>
        <div class="b-section b-section_bgc-light">
            <div class="b-section__container">
                <div class="b-article-recommend">
                    <div class="b-article-recommend__inner">
                        <div class="b-title-h3 b-title-h3_c-green b-article-recommend__title">
                            <?= $article_recommended_articles['title'] ?>
                        </div>
                        <div class="b-article-recommend__list">
                            <div class="b-group-slider">
                                <div class="b-group-slider__list" data-slide-to-show="4"
                                     data-group-slider-list="blog-new-articles">
                                    <?php foreach ($recommendedArticles as $item): ?>
                                        <?php $categories = get_the_category_list(', ', '', $item) ?>
                                        <div class="b-group-slider__item">
                                            <div class="b-col b-col_12">
                                                <div class="b-image-card-full">
                                                    <div class="b-image-card-full__inner">
                                                        <a href="<?= get_the_permalink($item) ?>" class="b-image-card-full__image"
                                                             style="background-image: url('<?= get_the_post_thumbnail_url($item) ?>')"></a>
                                                        <?php if ($categories): ?>
                                                            <div class="b-badge b-badge_bgc-green b-badge_c-light b-image-card-full__badge">
                                                                <?= $categories ?>
                                                            </div>
                                                        <?php endif ?>
                                                        <a href="<?= get_the_permalink($item) ?>" class="b-image-card-full__title"><?= get_the_title($item) ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="b-group-slider__arrow b-group-slider__arrow_prev"
                                     data-group-slider-arrow-prev="blog-new-articles"></div>
                                <div class="b-group-slider__arrow b-group-slider__arrow_next"
                                     data-group-slider-arrow-next="blog-new-articles"></div>
                            </div>
                        </div>
                        <div class="b-article-recommend__slider">
                            <div class="b-slider">
                                <div class="b-slider__inner">
                                    <div class="b-slider__list" data-slider-list="blog-new-articles"
                                         data-slider-slide-to-show="1">
                                        <?php foreach ($recommendedArticles as $item): ?>
                                            <?php $categories = get_the_category_list(', ', '', $item) ?>
                                            <div class="b-slider__item">
                                                <div class="b-image-card">
                                                    <div class="b-image-card__image"
                                                         style="background-image: url('<?= get_the_post_thumbnail_url($item) ?>')">
                                                        <?php if ($categories): ?>
                                                            <div class="b-badge b-badge_bgc-green b-badge_c-light b-image-card__badge">
                                                                <?= $categories ?>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>
                                                    <a href="<?= get_the_permalink($item) ?>" class="b-image-card__title">
                                                        <?= get_the_title($item) ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
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

<?php $article_call_to_action = get_field('article_call_to_action', 'option') ?>
    <div class="b-section">
        <div class="b-section__container">
            <div class="b-article-cta-section">
                <div class="b-article-cta-section__inner">
                    <h3 class="b-title-h3 b-title-h3_c-blue b-title-h3_ta-center  b-article-cta-section__title">
                        <?= $article_call_to_action['title'] ?>
                    </h3>
                    <a href="<?= $article_call_to_action['btn']['link'] ?>" class="b-button b-button_xs b-button_blue b-article-cta-section__button">
                        <?= $article_call_to_action['btn']['text'] ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php endwhile; ?>

<?php get_footer(); ?>
