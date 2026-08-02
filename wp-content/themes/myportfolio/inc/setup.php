<?php
/**
 * Theme setup and feature registration.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme features.
 */
function myportfolio_setup(): void {

    load_theme_textdomain(
        'myportfolio',
        get_template_directory() . '/languages'
    );

    add_theme_support( 'title-tag' );

    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'automatic-feed-links' );

    add_theme_support( 'responsive-embeds' );

    add_theme_support( 'align-wide' );

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

    add_theme_support(
        'custom-logo',
        array(
            'height'      => 80,
            'width'       => 260,
            'flex-height' => true,
            'flex-width'  => true,
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