<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

   <header id="masthead" class="site-header">
    <div class="header-inner">

        <!-- LEFT SIDE MOBILE BURGER -->
        <button class="burger" id="burgerBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- DESKTOP MENU -->
        <nav class="desktop-menu">
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => '',
                    'menu_class' => 'nav-links',
                ));
            ?>
        </nav>

        <!-- MOBILE MENU -->
        <nav class="main-menu" id="mobileMenu">
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => '',
                    'menu_class' => 'nav-links',
                ));
            ?>
        </nav>

        <div class="menu-overlay" id="menuOverlay"></div>

        <!-- CENTERED LOGO -->
        <div class="nav-logo">
            <?php 
            $logo = get_field('site_logo', 'option');
            if ($logo) : ?>
                <img src="<?php echo esc_url($logo['url']); ?>" alt="Logo" style="height:50px; width:auto;">
            <?php endif; ?>
        </div>

    </div>
</header>