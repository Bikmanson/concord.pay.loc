<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="<?= get_field('favicon', 'option') ?>"/>
    <?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
<section class="b-page">
    <header class="b-header">
        <div class="b-header__container">
            <div class="b-header__inner">
                <a href="<?= get_home_url() ?>" class="b-header__logo">
                    <img src="<?= get_field('header_logo', 'option') ?>" alt="<?= get_bloginfo('name') ?> logo" loading="lazy">
                </a>
                <div class="b-header-menu b-header__menu">
                    <?php wp_nav_menu([
                        'theme_location' => 'header-menu',
                        'container' => 'ul',
                    ]) ?>
                </div>
                <div class="b-header__buttons">
                    <?php
                    $connect_btn = get_field('connect_btn', 'option');
                    $login_btn = get_field('login_btn', 'option');
                    ?>
                    <a href="<?= $connect_btn['link'] ?>"
                       class="b-button b-button_xs b-button_blue b-header__button"><?= $connect_btn['text'] ?></a>
                    <a href="<?= $login_btn['link'] ?>"
                       class="b-button b-button_xs b-button_blue-outline b-header__button"><?= $login_btn['text'] ?></a>
                </div>
                <?php
                $languages = icl_get_languages();
                $activeLang = '';
                if (empty($languages)) {
                    global $sitepress;
                    $activeLang = $sitepress->get_default_language();
                } else {
                    foreach ($languages as $index => $lang) {
                        if ($lang['active']) {
                            $activeLang = strtoupper($lang['code']);
                            unset($languages[$index]);
                            break;
                        }
                    }
                    if ($activeLang === '') {
                        $activeLang = strtoupper($languages[0]);
                        unset($languages[0]);
                    }
                }
                ?>
                <div class="b-header-lang b-header__lang">
                    <div class="b-header-lang__current">
                        <?= $activeLang ?>
                    </div>
                    <div class="b-header-lang__list">
                        <?php foreach ($languages as $lang): ?>
                            <a href="<?= $lang['url'] ?>" class="b-header-lang__item">
                                <?= strtoupper($lang['code']) ?>
                            </a>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="b-header__mobile-menu-trigger" data-mobile-menu-trigger>
                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <line x1="2" x2="22" y1="5" y2="5" stroke-width="2" stroke="white"></line>
                        <line x1="2" x2="22" y1="12" y2="12" stroke-width="2" stroke="white"></line>
                        <line x1="2" x2="22" y1="19" y2="19" stroke-width="2" stroke="white"></line>
                    </svg>
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M29.2804 31.64L31.6404 29.28L22.3604 20L31.6404 10.72L29.2804 8.35999L20.0004 17.64L10.7204 8.35999L8.36035 10.72L17.6404 20L8.36035 29.28L10.7204 31.64L20.0004 22.36L29.2804 31.64Z"
                              fill="#0039D1"/>
                    </svg>

                </div>
            </div>
        </div>
    </header>

    <div class="b-mobile-menu" data-mobile-menu-content>
        <div class="b-mobile-menu__inner">
            <div class="b-mobile-menu__main">
                <div class="b-mobile-menu__list">
                    <?php wp_nav_menu([
                        'theme_location' => 'mobile-menu',
                        'container' => 'ul',
                        'walker' => new Arrow_Walker_Nav_Menu(), // custom editing: added i tag - arrow for children
                    ]) ?>

                </div>
            </div>
            <div class="b-mobile-menu__footer">
                <div class="b-button b-button_blue b-button_xs b-mobile-menu__button">
                    Підключити
                </div>
            </div>
        </div>
    </div>

    <main class="b-main b-page__main">