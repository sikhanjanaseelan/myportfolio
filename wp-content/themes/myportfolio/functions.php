<?php
/**
 * MyPortfolio theme functions.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

/**
 * Set up theme defaults and register WordPress features.
 */
function myportfolio_setup(): void {

    add_theme_support( 'title-tag' );

    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'automatic-feed-links' );

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'myportfolio' ),
            'footer'  => __( 'Footer Menu', 'myportfolio' ),
        )
    );
}
add_action( 'after_setup_theme', 'myportfolio_setup' );

/**
 * Load frontend styles and scripts.
 */
function myportfolio_enqueue_assets(): void {

    wp_enqueue_style(
        'myportfolio-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'myportfolio_enqueue_assets' );