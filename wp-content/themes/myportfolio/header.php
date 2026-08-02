<?php
/**
 * Site header.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main-content">
    <?php esc_html_e( 'Skip to content', 'myportfolio' ); ?>
</a>

<header class="site-header">

    <div class="container site-header__inner">

        <div class="site-branding">

            <?php if ( has_custom_logo() ) : ?>

                <?php the_custom_logo(); ?>

            <?php else : ?>

                <a
                    class="site-branding__title"
                    href="<?php echo esc_url( home_url( '/' ) ); ?>"
                >
                    <?php bloginfo( 'name' ); ?>
                </a>

            <?php endif; ?>

        </div>

        <nav
            class="primary-navigation"
            aria-label="<?php esc_attr_e( 'Primary navigation', 'myportfolio' ); ?>"
        >

            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'primary-navigation__menu',
                    'fallback_cb'    => false,
                )
            );
            ?>

        </nav>

    </div>

</header>