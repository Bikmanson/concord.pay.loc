</main>
<footer class="b-footer">
    <div class="b-footer__container">
        <div class="b-footer__inner">
            <div class="b-footer__row b-footer__row_jc-between">
                <div class="b-col b-col_3 b-col_md-12 b-footer__col">
                    <a href="<?= get_home_url() ?>" class="b-footer__logo">
                        <img src="<?= get_field('footer_logo', 'option') ?>" alt="<?= get_bloginfo('name') ?> logo" loading="lazy">
                    </a>
                    <div class="b-footer__link-list">
                        <?php if ($social = get_field('social', 'option')): ?>
                            <?php foreach ($social as $item): ?>
                                <a href="<?= $item['link'] ?>" target="_blank" class="b-footer__link">
                                    <?= file_get_contents(str_replace('concord.pay.loc', 'concord-nginx', $item['icon'])) ?>

                                </a>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
                <div class="b-col b-col_2 b-col_md-3 b-col_sm-6 b-col_xs-12 b-footer__col">
                    <div class="b-footer-menu b-footer__menu">
                        <div class="b-footer-menu__title">
                            <?= wp_get_nav_menu_object(11)->name ?>
                        </div>
                        <div class="b-footer-menu__list">
                            <?php wp_nav_menu([
                                'theme_location' => 'footer-first',
                                'container' => 'ul'
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="b-col b-col_2 b-col_md-3 b-col_sm-6 b-col_xs-12 b-footer__col">
                    <div class="b-footer-menu b-footer__menu">
                        <div class="b-footer-menu__title">
                            <?= wp_get_nav_menu_object(12)->name ?>
                        </div>
                        <div class="b-footer-menu__list">
                            <?php wp_nav_menu([
                                'theme_location' => 'footer-second',
                                'container' => 'ul'
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="b-col b-col_2 b-col_md-3 b-col_sm-6 b-col_xs-12 b-footer__col">
                    <div class="b-footer-menu b-footer__menu">
                        <div class="b-footer-menu__title">
                            <?= wp_get_nav_menu_object(13)->name ?>
                        </div>
                        <div class="b-footer-menu__list">
                            <?php wp_nav_menu([
                                'theme_location' => 'footer-third',
                                'container' => 'ul'
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="b-col b-col_2 b-col_md-3 b-col_sm-6 b-col_xs-12 b-footer__col">
                    <div class="b-footer-menu b-footer__menu">
                        <div class="b-footer-menu__list">
                            <?php wp_nav_menu([
                                'theme_location' => 'footer-menu',
                                'container' => 'ul'
                            ]) ?>
                        </div>
                    </div>
                    <div class="b-footer-menu b-footer__menu">
                        <?php $contactUs = get_field('contact_us', 'option') ?>
                        <div class="b-footer-menu__title">
                            <?= $contactUs['title'] ?>
                        </div>
                        <div class="b-footer-menu__list">
                            <ul>
                                <li>
                                    <a href="tel:<?= $contactUs['phone'] ?>"><?= $contactUs['phone'] ?></a>
                                </li>
                                <li>
                                    <a href="mailto:<?= $contactUs['email'] ?>"><?= $contactUs['email'] ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="b-footer__copyright">
                <?= get_field('copyright_text', 'option') ?>
            </div>
        </div>
    </div>
</footer>
</section>

<?php wp_footer(); ?>
</body>
</html>