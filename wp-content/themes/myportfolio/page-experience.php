<?php
/**
 * Experience page template.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main
	id="primary"
	class="site-main experience-page"
>

	<section class="experience-page__intro">

		<div class="container container--wide">

			<nav
				class="experience-page__breadcrumb"
				aria-label="<?php esc_attr_e( 'Breadcrumb', 'myportfolio' ); ?>"
			>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php esc_html_e( 'Home', 'myportfolio' ); ?>
				</a>

				<span aria-hidden="true">›</span>

				<span>
					<?php esc_html_e( 'Experience', 'myportfolio' ); ?>
				</span>
			</nav>

			<header class="experience-page__header">

				<h1>
					<?php esc_html_e( 'Experience', 'myportfolio' ); ?>
				</h1>

				<p>
					<?php
					esc_html_e(
						'My professional journey and the places where I’ve learned, contributed and grown.',
						'myportfolio'
					);
					?>
				</p>

			</header>

		</div>

	</section>

	<section class="experience-content">

		<div class="container container--wide">

			<div class="experience-content__grid">

				<?php
				get_template_part(
					'template-parts/experience/timeline'
				);

				get_template_part(
					'template-parts/experience/achievements'
				);
				?>

			</div>

		</div>

	</section>

</main>

<?php
get_footer();