<?php
/**
 * Template Name: Pocetna Strana
 */

get_header(); ?>

<main id="primary" class="site-main">

     <!-- Hero Section -->
    <section class="hero-section">
    <div class="hero-container">

        <div class="hero-content">
            <?php if (get_field('hero_title')) : ?>
                <h1 class="hero-title"><?php the_field('hero_title'); ?></h1>
            <?php endif; ?>

            <?php if (get_field('hero_description')) : ?>
                <p class="hero-description"><?php the_field('hero_description'); ?></p>
            <?php endif; ?>

            <?php if (get_field('hero_button_text')) : ?>
                <a href="<?php the_field('hero_button_link'); ?>" class="hero-btn">
                    <?php the_field('hero_button_text'); ?>
                    <span class="btn-circle"><i class="fa-solid fa-angle-right"></i></span>
                </a>
            <?php endif; ?>
        </div>

        <div class="hero-image">
            <?php $hero_image = get_field('hero_image'); ?>
            <?php if ($hero_image) : ?>
                <img src="<?php echo esc_url($hero_image['url']); ?>" alt="">
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CATEGORY SECTION -->
<section class="category-section" id="categories">
    <h2 class="section-title fade-in">Explore by category</h2>

    <div class="category-grid">
        <?php if (have_rows('categories')): ?>
            <?php while (have_rows('categories')): the_row(); 

                $img = get_sub_field('category_image');
                $name = get_sub_field('category_name');
                $link = get_sub_field('category_link');
            ?>
            
            <div class="category-item fade-item"> 
                
                <div class="cat-image-wrap">
                    <?php if ($img): ?>
                        <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
                    <?php endif; ?>
                </div>

                <div class="cat-info">
                    <div class="cat-row">
                        <h3><?php echo esc_html($name); ?></h3>
                        <a href="<?php echo esc_url($link); ?>" class="cat-explore">
                            Explore <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>


            </div>

            <?php endwhile; ?>
        <?php endif; ?>

    </div>
</section>

<!-- HIGHLIGHTED PRODUCTS -->
<section class="highlight-section fade-section">

    <h2 class="highlight-title">Highlighted products</h2>

    <p class="highlight-subtext">
        <?php the_field('highlight_subtext'); ?>
    </p>

    <div class="highlight-slider-wrapper">

        <div class="highlight-slider">

            <!-- Product 1 -->
            <?php $p1 = get_field('product_1_image'); ?>
            <div class="highlight-slide">
                <img src="<?php echo $p1['url']; ?>" alt="">
                <h3><?php the_field('product_1_name'); ?></h3>
                <p class="price"><?php the_field('product_1_price'); ?></p>
            </div>

            <!-- Product 2 -->
            <?php $p2 = get_field('product_2_image'); ?>
            <div class="highlight-slide">
                <img src="<?php echo $p2['url']; ?>" alt="">
                <h3><?php the_field('product_2_name'); ?></h3>
                <p class="price"><?php the_field('product_2_price'); ?></p>
            </div>

            <!-- Product 3 -->
            <?php $p3 = get_field('product_3_image'); ?>
            <div class="highlight-slide">
                <img src="<?php echo $p3['url']; ?>" alt="">
                <h3><?php the_field('product_3_name'); ?></h3>
                <p class="price"><?php the_field('product_3_price'); ?></p>
            </div>

        </div>

        <!-- Arrows -->
        <button class="highlight-prev"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="highlight-next"><i class="fa-solid fa-chevron-right"></i></button>

        <!-- Dots -->
        <div class="highlight-dots"></div>

    </div>

    <!-- ONE BUTTON -->
    <a href="<?php the_field('highlight_button_link'); ?>" class="highlight-more-btn">
        <?php the_field('highlight_button_text'); ?>
        <i class="fa-solid fa-chevron-right"></i>
    </a>

    <!-- BACKGROUND IMAGE UNDER SLIDER -->
    <?php $bg = get_field('highlight_background_image'); ?>
    <div class="highlight-bg">
        <img src="<?php echo $bg['url']; ?>" alt="">
    </div>

</section>

</main>
<?php get_footer();?>