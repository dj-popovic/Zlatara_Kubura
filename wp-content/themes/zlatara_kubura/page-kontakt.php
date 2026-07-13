<?php
/**
 * Template Name: Kontakt
 */
get_header(); ?>

<main class="contact-page"
      style="background-image:url('<?php echo esc_url(get_field('contact_bg')['url']); ?>');">

    <div class="contact-overlay"></div>

    <section class="contact-wrapper">

        <div class="contact-card">

            <!-- NASLOV -->
            <div class="contact-header">
                <h1><?php the_field('contact_title'); ?></h1>
                <p><?php the_field('contact_text'); ?></p>
            </div>

            <!-- FORMA -->
            <div class="contact-form">
                <?php echo do_shortcode('[contact-form-7 id="7d66f8b" title="Kontakt forma"]'); ?>
            </div>

            <!-- INFO + MAPA -->
            <div class="contact-bottom">

                <div class="contact-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d175.55440748266255!2d19.388031!3d45.250411!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475b7a154f750ac3%3A0x1cbaa1d26929811e!2sKubura!5e0!3m2!1sen!2srs!4v1766615760156!5m2!1sen!2srs" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>


                <div class="contact-info">
                    <div class="contact-info-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>
                            Adresa:<br>
                            <strong><?php the_field('contact_address'); ?></strong>
                        </p>
                    </div>

                    <div class="contact-info-item">
                        <i class="fa-solid fa-phone"></i>
                        <p>
                            Telefon:<br>
                            <strong><?php the_field('contact_phone'); ?></strong>
                        </p>
                    </div>

                    <div class="contact-info-item">
                        <i class="fa-solid fa-envelope"></i>
                        <p>
                            Email:<br>
                            <strong><?php the_field('contact_email'); ?></strong>
                        </p>
                    </div>
                </div>


            </div>

        </div>

    </section>

</main>

<?php get_footer(); ?>
