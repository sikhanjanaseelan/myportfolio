<?php
/**
 * Skills page hero.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="skills-hero">

	<div class="container container--wide">

		<nav
			class="skills-hero__breadcrumb"
			aria-label="<?php esc_attr_e( 'Breadcrumb', 'myportfolio' ); ?>"
		>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php esc_html_e( 'Home', 'myportfolio' ); ?>
			</a>

			<span aria-hidden="true">›</span>

			<span>
				<?php esc_html_e( 'Skills', 'myportfolio' ); ?>
			</span>
		</nav>

		<header class="skills-hero__header">

			<h1 class="skills-hero__title">
				<?php esc_html_e( 'Skills & Technologies', 'myportfolio' ); ?>
			</h1>

			<p class="skills-hero__description">
				<?php
				esc_html_e(
					'A combination of technical expertise, tools and best practices to build modern web solutions.',
					'myportfolio'
				);
				?>
			</p>

		</header>

	</div>

</section>