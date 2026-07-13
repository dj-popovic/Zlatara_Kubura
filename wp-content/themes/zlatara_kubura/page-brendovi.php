<?php
/**
 * Template Name: Brendovi
 */
get_header(); ?>

<main class="brands-page">

    <!-- HERO SECTION -->
    <section class="brands-hero" 
        style="background-image: url('<?php echo get_field('brands_hero_image')['url']; ?>');">
        
        <div class="brands-hero-inner">
            <h1>Naši saradnici</h1>
        </div>
    </section>

    <!-- INTRO TEXT -->
    <section class="brands-intro container">
        <p><?php the_field('brands_intro_text'); ?></p>
    </section>

    <!-- ======================== NAKIT ========================= -->
    <section class="brands-section container">
        <h2 class="brands-title">Nakit</h2>

        <div class="brands-grid">

        <?php if (have_rows('nakit_brands')): ?>
            <?php while (have_rows('nakit_brands')): the_row(); 
                $logo = get_sub_field('brand_logo');
                $desc = get_sub_field('brand_desc');
            ?>
                <div class="brand-card fade-in">
                    <img src="<?php echo $logo['url']; ?>" alt="">
                    <span class="brand-divider"></span>
                    <p><?php echo $desc; ?></p>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

        </div>
    </section>

    <!-- ================= SATOVI ================== -->
    <section class="brands-section container">
        <h2 class="brands-title">Satovi</h2>

        <!-- RED 1: 4 brenda -->
        <?php if (have_rows('satovi_row_1')): ?>
        <div class="brands-grid grid-4">
            <?php while (have_rows('satovi_row_1')): the_row();
                $logo = get_sub_field('brand_logo');
                $desc = get_sub_field('brand_desc');
            ?>
            <div class="brand-card fade-in">
                <img src="<?php echo $logo['url']; ?>" alt="">
                <span class="brand-divider"></span>
                <p><?php echo $desc; ?></p>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

        <!-- RED 2: 4 brenda -->
        <?php if (have_rows('satovi_row_2')): ?>
        <div class="brands-grid grid-4">
            <?php while (have_rows('satovi_row_2')): the_row();
                $logo = get_sub_field('brand_logo');
                $desc = get_sub_field('brand_desc');
            ?>
            <div class="brand-card fade-in">
                <img src="<?php echo $logo['url']; ?>" alt="">
                <span class="brand-divider"></span>
                <p><?php echo $desc; ?></p>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

        <!-- RED 3: 3 brenda -->
        <?php if (have_rows('satovi_row_3')): ?>
        <div class="brands-grid grid-3">
            <?php while (have_rows('satovi_row_3')): the_row();
                $logo = get_sub_field('brand_logo');
                $desc = get_sub_field('brand_desc');
            ?>
            <div class="brand-card fade-in">
                <img src="<?php echo $logo['url']; ?>" alt="">
                <span class="brand-divider"></span>
                <p><?php echo $desc; ?></p>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

        <!-- RED 4: 2 brenda -->
        <?php if (have_rows('satovi_row_4')): ?>
        <div class="brands-grid grid-2">
            <?php while (have_rows('satovi_row_4')): the_row();
                $logo = get_sub_field('brand_logo');
                $desc = get_sub_field('brand_desc');
            ?>
            <div class="brand-card fade-in">
                <img src="<?php echo $logo['url']; ?>" alt="">
                <span class="brand-divider"></span>
                <p><?php echo $desc; ?></p>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

    </section>


</main>

<?php get_footer(); ?>
