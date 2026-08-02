<?php
/**
 * Site footer.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;
?>

<footer class="site-footer">

    <div class="container site-footer__inner">

        <div class="site-footer__content">

            <p>
                <?php
                printf(
                    esc_html__( '© %1$s %2$s. All rights reserved.', 'myportfolio' ),
                    esc_html( gmdate( 'Y' ) ),
                    esc_html( get_bloginfo( 'name' ) )
                );
                ?>
            </p>

        </div>

        <nav
            class="footer-navigation"
            aria-label="<?php esc_attr_e( 'Footer navigation', 'myportfolio' ); ?>"
        >

            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'footer-navigation__menu',
                    'fallback_cb'    => false,
                )
            );
            ?>

        </nav>

    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>