<?php
/**
 * Minimal site footer.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;
?>

<footer class="site-footer">

	<div class="container container--wide">

		<div class="site-footer__inner">

			<a
				class="site-footer__brand"
				href="<?php echo esc_url( home_url( '/' ) ); ?>"
			>
				<span class="site-footer__brand-mark" aria-hidden="true">
					&lt;/&gt;
				</span>

				<span class="site-footer__brand-name">
					<?php bloginfo( 'name' ); ?>
				</span>
			</a>

			<p class="site-footer__copyright">
				<?php
				printf(
					esc_html__( '© %1$s %2$s. All rights reserved.', 'myportfolio' ),
					esc_html( gmdate( 'Y' ) ),
					esc_html( get_bloginfo( 'name' ) )
				);
				?>
			</p>

			<div class="site-footer__connect">

				<span class="site-footer__connect-label">
					<?php esc_html_e( 'Let’s connect on', 'myportfolio' ); ?>
				</span>

				<nav
					class="site-footer__socials"
					aria-label="<?php esc_attr_e( 'Social profiles', 'myportfolio' ); ?>"
				>
					<a href="#" target="_blank" rel="noopener noreferrer">
						LinkedIn
					</a>

					<a href="#" target="_blank" rel="noopener noreferrer">
						GitHub
					</a>

					<a href="mailto:hello@example.com">
						Email
					</a>
				</nav>

			</div>

			<a
				class="site-footer__back-to-top"
				href="#top"
				aria-label="<?php esc_attr_e( 'Back to top', 'myportfolio' ); ?>"
			>
				↑
			</a>

		</div>

	</div>

</footer>