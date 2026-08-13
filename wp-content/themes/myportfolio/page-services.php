<?php
/**
 * Services page template.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main
	id="primary"
	class="site-main services-page"
>

	<section class="services-page__intro">

		<div class="container container--wide">

			<nav
				class="services-page__breadcrumb"
				aria-label="<?php esc_attr_e( 'Breadcrumb', 'myportfolio' ); ?>"
			>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php esc_html_e( 'Home', 'myportfolio' ); ?>
				</a>

				<span aria-hidden="true">›</span>

				<span>
					<?php esc_html_e( 'Services', 'myportfolio' ); ?>
				</span>
			</nav>

			<header class="services-page__header">

				<h1>
					<?php esc_html_e( 'Services I Offer', 'myportfolio' ); ?>
				</h1>

				<p>
					<?php
					esc_html_e(
						'End-to-end web and software support to help ideas move from concept to reliable delivery.',
						'myportfolio'
					);
					?>
				</p>

			</header>

		</div>

	</section>

	<?php
	get_template_part(
		'template-parts/services/services-grid'
	);

	get_template_part(
		'template-parts/services/services-cta'
	);
	?>

</main>

<?php
get_footer();