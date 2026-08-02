<?php
/**
 * Theme asset loading.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue frontend styles and scripts.
 */
function myportfolio_enqueue_assets(): void {

    $theme = wp_get_theme();

    wp_enqueue_style(
        'myportfolio-style',
        get_stylesheet_uri(),
        array(),
        $theme->get( 'Version' )
    );

    wp_enqueue_style(
        'myportfolio-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array( 'myportfolio-style' ),
        $theme->get( 'Version' )
    );

    wp_enqueue_script(
        'myportfolio-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        $theme->get( 'Version' ),
        true
    );
    wp_script_add_data(
	'myportfolio-main',
	'type',
	'module'
);
}
add_action( 'wp_enqueue_scripts', 'myportfolio_enqueue_assets' );