<?php
/**
 * About page template.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main
	id="primary"
	class="site-main about-page"
>

	<?php
	get_template_part(
		'template-parts/about/hero'
	);
	?>

	<section class="about-content">

		<div class="container container--wide">

			<div class="about-content__grid">

				<div class="about-content__column">

					<?php
					get_template_part(
						'template-parts/about/journey'
					);
					?>

					<?php
					get_template_part(
						'template-parts/about/beyond'
					);
					?>

				</div>

				<div class="about-content__column">

					<?php
					get_template_part(
						'template-parts/about/skills'
					);
					?>

					<?php
					get_template_part(
						'template-parts/about/stats'
					);
					?>

					<?php
					get_template_part(
						'template-parts/about/cta'
					);
					?>

				</div>

			</div>

		</div>

	</section>

</main>

<?php
get_footer();