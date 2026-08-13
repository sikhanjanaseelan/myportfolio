<?php
/**
 * Reusable site header.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;
?>

<header class="site-header" data-site-header>

	<div class="container container--wide site-header__inner">

		<div class="site-branding">

			<?php if ( has_custom_logo() ) : ?>

				<div class="site-branding__logo">
					<?php the_custom_logo(); ?>
				</div>

			<?php else : ?>

				<a
					class="site-branding__link"
					href="<?php echo esc_url( home_url( '/' ) ); ?>"
					rel="home"
				>
					<span class="site-branding__mark" aria-hidden="true">
						&lt;/&gt;
					</span>

					<span class="site-branding__text">

						<strong class="site-branding__name">
							<?php bloginfo( 'name' ); ?>
						</strong>

						<span class="site-branding__description">
							<?php bloginfo( 'description' ); ?>
						</span>

					</span>
				</a>

			<?php endif; ?>

		</div>

		<button
			class="mobile-menu-toggle"
			type="button"
			aria-expanded="false"
			aria-controls="primary-navigation"
			data-menu-toggle
		>
			<span class="screen-reader-text">
				<?php esc_html_e( 'Toggle navigation', 'myportfolio' ); ?>
			</span>

			<span class="mobile-menu-toggle__line"></span>
			<span class="mobile-menu-toggle__line"></span>
			<span class="mobile-menu-toggle__line"></span>
		</button>

		<div
			id="primary-navigation"
			class="site-header__navigation"
			data-mobile-navigation
		>

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

		<a
	class="button button--primary site-header__cta"
	href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
>
	<span>
		<?php esc_html_e( 'Let’s Connect', 'myportfolio' ); ?>
	</span>

	<span
		class="button__icon"
		aria-hidden="true"
	>
		→
	</span>
</a>

		</div>

	</div>

</header>