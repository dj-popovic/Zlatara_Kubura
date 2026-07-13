<?php
/**
 * Zlatara Kubura functions and definitions
 */

if ( ! defined( '_S_VERSION' ) ) {
    define( '_S_VERSION', '1.0.0' );
}

function zlatara_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    
    register_nav_menus(
        array(
            'primary' => esc_html__( 'Primary Menu', 'zlatara' ),
        )
    );
}
add_action( 'after_setup_theme', 'zlatara_setup' );

function zlatara_scripts() {
    wp_enqueue_style( 'zlatara-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_script( 'zlatara-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'zlatara-slider', get_template_directory_uri() . '/js/slider.js', array('jquery'), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'zlatara_scripts' );

function load_fontawesome() {
    wp_enqueue_style('fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'load_fontawesome');

// ACF Options Page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page([
        'page_title' => 'Site Settings',
        'menu_title' => 'Site Settings',
        'menu_slug'  => 'site-settings',
        'capability' => 'edit_posts',
        'redirect'   => false
    ]);
}

function kreiraj_proizvodi_cpt() {

    $labels = array(
        'name' => 'Proizvodi',
        'singular_name' => 'Proizvod',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-admin-customizer',
        'supports' => array('title', 'thumbnail'),
        'has_archive' => false
    );

    register_post_type('proizvod', $args);
}

add_action('init', 'kreiraj_proizvodi_cpt');

if ( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' => 'Katalog proizvoda',
        'menu_title' => 'Katalog proizvoda',
        'menu_slug'  => 'katalog-proizvoda',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ));
}
?>