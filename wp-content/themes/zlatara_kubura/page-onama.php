<?php
/**
 * Template Name: O nama
 */
get_header(); ?>

<main id="primary" class="site-main onama-page">

    <!-- ===================== 1. PRIČA ====================== -->
    <section class="onama-container onama-prica">

        <div class="onama-content">
            <h2><?php the_field('naslov_onama'); ?></h2>

            <p><?php the_field('tekst_onama1'); ?></p>
            <p><?php the_field('tekst_onama2'); ?></p>
            <p><?php the_field('tekst_onama3'); ?></p>
        </div>

        <div class="onama-slika">
            <?php $img = get_field('slika_onama'); ?>
            <?php if($img): ?>
                <img src="<?php echo esc_url($img['url']); ?>" alt="">
            <?php endif; ?>
        </div>

    </section>

    <!-- ===================== 2. USLUGE ====================== -->
    <section class="onama-container onama-usluge">

        <h2><?php the_field('naslov_usluge'); ?></h2>

        <div class="usluge-grid">

            <div class="usluga-box">
                <h3><?php the_field('usluga1_naslov'); ?></h3>
                <p><?php the_field('usluga1_tekst'); ?></p>
            </div>

            <div class="usluga-box">
                <h3><?php the_field('usluga2_naslov'); ?></h3>
                <p><?php the_field('usluga2_tekst'); ?></p>
            </div>

            <div class="usluga-box">
                <h3><?php the_field('usluga3_naslov'); ?></h3>
                <p><?php the_field('usluga3_tekst'); ?></p>
            </div>

        </div>

    </section>

    <!-- ===================== 3. ZAKLJUČAK ====================== -->
    <section class="onama-container onama-zakljucak">
        <p><?php the_field('zavrsni_tekst'); ?></p>
    </section>

    <!-- ===================== 4. TRI SLIKE ====================== -->
    <section class="onama-container onama-tri-slike">

        <?php $s1 = get_field('slika_donja_1'); ?>
        <?php $s2 = get_field('slika_donja_2'); ?>
        <?php $s3 = get_field('slika_donja_3'); ?>

        <div class="tri-slike-grid">
            <?php if($s1): ?><img src="<?php echo $s1['url']; ?>" alt=""><?php endif; ?>
            <?php if($s2): ?><img src="<?php echo $s2['url']; ?>" alt=""><?php endif; ?>
            <?php if($s3): ?><img src="<?php echo $s3['url']; ?>" alt=""><?php endif; ?>
        </div>

    </section>

</main>

<?php get_footer(); ?>
