<?php
/**
 * Template Name: Katalog proizvoda
 */

get_header();

// slug trenutne stranice (ogrlice, narukvice, ...)
$current_cat = get_post_field( 'post_name', get_the_ID() );

// hero slika
$hero_image = get_field( 'hero_image' );
?>

<main id="primary" class="site-main catalog-page">

    <!-- HERO -->
    <section class="catalog-hero"
        <?php if ( $hero_image ) : ?>
            style="background-image: url('<?php echo esc_url( $hero_image['url'] ); ?>');"
        <?php endif; ?>
    >
        <div class="catalog-hero-inner">
            <h1><?php the_title(); ?></h1>
        </div>
    </section>

    <!-- MALA NAVIGACIJA KATEGORIJA -->
    <nav class="catalog-nav">
        <div class="catalog-nav-inner">
            <?php
            $catalog_links = array(
                'ogrlice'   => 'Ogrlice',
                'narukvice' => 'Narukvice',
                'mindjuse'  => 'Minđuše',
                'burme'     => 'Burme',
                'prstenje'  => 'Prstenje',
                'satovi'    => 'Privesci',
            );

            foreach ( $catalog_links as $slug => $label ) :
                $page = get_page_by_path( $slug );
                if ( ! $page ) {
                    continue;
                }
                $active_class = ( $slug === $current_cat ) ? ' active' : '';
                ?>
                <a class="catalog-nav-item<?php echo $active_class; ?>"
                   href="<?php echo esc_url( get_permalink( $page->ID ) ); ?>">
                    <?php echo esc_html( $label ); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </nav>

    <!-- GRID PROIZVODA -->
    <section class="catalog-products">
        <div class="catalog-products-inner">

            <?php
            $visible_limit = 8;  // prvih 8 prikazano, ostalo ide na "Učitaj još"
            $shown_count   = 0;

            if ( have_rows( 'products', 'option' ) ) :
                while ( have_rows( 'products', 'option' ) ) :
                    the_row();

                    $cats = (array) get_sub_field( 'product_categories' );

                    // ako ovaj proizvod nema izabranu trenutnu kategoriju - preskoči
                    if ( ! in_array( $current_cat, $cats, true ) ) {
                        continue;
                    }

                    $img   = get_sub_field( 'product_image' );
                    $name  = get_sub_field( 'product_name' );
                    $desc  = get_sub_field( 'product_desc' );
                    $price = get_sub_field( 'product_price' );

                    $shown_count++;
                    $hidden_class = ( $shown_count > $visible_limit ) ? ' is-hidden' : '';
                    ?>

                    <article class="product-card<?php echo $hidden_class; ?>">
                        <div class="product-card-thumb">
                            <?php if ( $img ) : ?>
                                <img src="<?php echo esc_url( $img['url'] ); ?>"
                                     alt="<?php echo esc_attr( $img['alt'] ); ?>">
                            <?php endif; ?>
                        </div>

                        <div class="product-card-body">
                            <?php if ( $name ) : ?>
                                <h3><?php echo esc_html( $name ); ?></h3>
                            <?php endif; ?>

                            <?php if ( $desc ) : ?>
                                <p class="product-card-desc">
                                    <?php echo esc_html( $desc ); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ( $price ) : ?>
                                <div class="product-card-price-wrap">
                                    <span class="product-card-price">
                                        <?php echo esc_html( $price ); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>

                <?php
                endwhile;
            endif;
            ?>

        </div> <!-- .catalog-products-inner -->

        <?php if ( $shown_count > $visible_limit ) : ?>
            <button class="catalog-load-more" id="catalogLoadMore">
                Učitaj još proizvoda
            </button>
        <?php endif; ?>

    </section>

</main>

<?php
get_footer();
?>