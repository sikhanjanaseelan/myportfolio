<?php
/**
 * Reusable site footer.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;
?>

<footer class="site-footer">

	<div class="container container--wide">

		<div class="site-footer__main">

			<div class="site-footer__brand">

				<a
					class="site-footer__brand-link"
					href="<?php echo esc_url( home_url( '/' ) ); ?>"
				>
					<span class="site-footer__brand-mark" aria-hidden="true">
						&lt;/&gt;
					</span>

					<span>
						<strong><?php bloginfo( 'name' ); ?></strong>

						<small><?php bloginfo( 'description' ); ?></small>
					</span>
				</a>

				<p class="site-footer__description">
					<?php
					esc_html_e(
						'Building clean, modular and scalable digital products with PHP, WordPress and modern development practices.',
						'myportfolio'
					);
					?>
				</p>

			</div>

			<div class="site-footer__column">

				<h2 class="site-footer__heading">
					<?php esc_html_e( 'Explore', 'myportfolio' ); ?>
				</h2>

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

			<div class="site-footer__column">

				<h2 class="site-footer__heading">
					<?php esc_html_e( 'Connect', 'myportfolio' ); ?>
				</h2>

				<div class="site-footer__socials">

					<a href="#" target="_blank" rel="noopener noreferrer">
						GitHub
					</a>

					<a href="#" target="_blank" rel="noopener noreferrer">
						LinkedIn
					</a>

					<a href="mailto:hello@example.com">
						Email
					</a>

				</div>

			</div>

			<div class="site-footer__column">

				<h2 class="site-footer__heading">
					<?php esc_html_e( 'Availability', 'myportfolio' ); ?>
				</h2>

				<p class="site-footer__availability">
					<span aria-hidden="true"></span>

					<?php
					esc_html_e(
						'Available for full-time, remote and selected freelance opportunities.',
						'myportfolio'
					);
					?>
				</p>

			</div>

		</div>

		<div class="site-footer__bottom">

			<p>
				<?php
				printf(
					esc_html__( '© %1$s %2$s. All rights reserved.', 'myportfolio' ),
					esc_html( gmdate( 'Y' ) ),
					esc_html( get_bloginfo( 'name' ) )
				);
				?>
			</p>

			<p>
				<?php esc_html_e( 'Built with WordPress, PHP and reusable components.', 'myportfolio' ); ?>
			</p>

		</div>

	</div>

</footer>