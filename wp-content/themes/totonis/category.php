<?php get_header(); ?>

    <div class="b-section">
        <div class="b-section__container">
            <div class="b-breadcrumbs">
                <?php TotView::breadcrumbs(); ?>
            </div>
        </div>
    </div>
    <!-- -->
    <div class="b-section">
        <div class="b-section__container">
            <div class="b-category">
                <div class="b-category__inner">
                    <h1 class="b-title-h1 b-title-h1_c-blue b-category__title">
                        <?= get_the_category()[0]->name ?>
                    </h1>
                    <div class="b-category__row">
                        <?php if (have_posts()): ?>
                            <?php $is_revert = true ?>
                            <?php while (have_posts()): the_post() ?>
                                <?php $is_revert = !$is_revert ?>
                                <div class="b-col b-col_12 b-category__col">
                                    <div class="b-category-card <?= $is_revert ? 'b-category-card_revert' : '' ?>">
                                        <div class="b-category-card__inner">
                                            <a href="<?= get_the_permalink() ?>" class="b-category-card__image">
                                                <div class="b-category-card__image-inner"
                                                     style="background-image: url('<?= get_the_post_thumbnail_url() ?>')"></div>
                                            </a>
                                            <div class="b-category-card__content">
                                                <a href="<?= get_the_permalink() ?>" class="b-category-card__title">
                                                    <?= get_the_title() ?>
                                                </a>
                                                <div class="b-category-card__meta">
                                                    <?= get_the_date('d-m-Y') ?>
                                                </div>
                                                <div class="b-category-card__description">
                                                    <?= get_field('description') ?>
                                                </div>
                                                <a href="<?= get_the_permalink() ?>" class="b-category-card__trigger">
                                                    <?= get_field('read_more_btn', 'option') ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif ?>
                    </div>
                    <div class="b-category__row">
                        <div class="b-col b-col_12 b-category__col"></div>
                        <div class="b-col b-col_12 b-category__col">
                            <div class="b-category__pagination">
                                <div class="b-pagination">
                                    <?= tot_paginate_links(['prev_next' => true]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $posts = new WP_Query([
    'post_type' => 'post',
    'orderby' => 'date',
    'order' => 'DESC',
    'tax_query' => [
        'taxonomy' => 'category',
        'field' => 'name',
        'terms' => get_the_category()[0]->name
    ]
]) ?>
    <div class="b-section b-section_bgc-light">
        <div class="b-section__container">
            <div class="b-category-list">
                <div class="b-category-list__inner">
                    <div class="b-title-h3 b-title-h3_c-green b-category-list__title">
                        <?= get_field('category_new_articles_title', 'option') ?>
                    </div>
                    <div class="b-category-list__list">
                        <div class="b-group-slider">
                            <div class="b-group-slider__list" data-slide-to-show="4"
                                 data-group-slider-list="blog-new-articles">
                                <?php while ($posts->have_posts()): $posts->the_post() ?>
                                    <div class="b-group-slider__item">
                                        <div class="b-col b-col_12">
                                            <div class="b-text-card b-text-card_bgc-white">
                                                <div class="b-text-card__inner">
                                                    <a href="<?= get_the_permalink() ?>" class="b-text-card__title">
                                                        <?= get_the_title() ?>
                                                    </a>
                                                    <a href="<?= get_the_permalink() ?>" class="b-text-card__trigger">
                                                        <?= get_field('read_more_btn', 'option') ?>
                                                    </a>
                                                </div>
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
                    <div class="b-category-list__slider">
                        <div class="b-slider">
                            <div class="b-slider__inner">
                                <div class="b-slider__list" data-slider-list="blog-new-articles"
                                     data-slider-slide-to-show="1">
                                    <?php while ($posts->have_posts()): $posts->the_post() ?>
                                        <div class="b-slider__item">
                                            <div class="b-text-card b-text-card_bgc-white">
                                                <div class="b-text-card__inner">
                                                    <a href="<?= get_the_permalink() ?>" class="b-text-card__title">
                                                        <?= get_the_title() ?>
                                                    </a>
                                                    <a href="<?= get_the_permalink() ?>" class="b-text-card__trigger">
                                                        <?= get_field('read_more_btn', 'option') ?>
                                                    </a>
                                                </div>
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

<?php get_footer(); ?>