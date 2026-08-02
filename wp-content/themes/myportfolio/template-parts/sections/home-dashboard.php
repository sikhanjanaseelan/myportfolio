<?php
/**
 * Homepage dashboard section.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="home-dashboard">

	<div class="container container--wide">

		<div class="home-dashboard__grid">

			<div class="home-dashboard__item home-dashboard__item--capabilities">

				<?php
				get_template_part(
					'template-parts/cards/card-capabilities'
				);
				?>

			</div>

			<div class="home-dashboard__item home-dashboard__item--stack">

				<?php
				get_template_part(
					'template-parts/cards/card-tech-stack'
				);
				?>

			</div>

			<div class="home-dashboard__item home-dashboard__item--experience">

				<?php
				get_template_part(
					'template-parts/cards/card-experience-preview'
				);
				?>

			</div>

			<div class="home-dashboard__item home-dashboard__item--building">

				<?php
				get_template_part(
					'template-parts/cards/card-currently-building'
				);
				?>

			</div>

			<div class="home-dashboard__item home-dashboard__item--testimonial">

				<?php
				get_template_part(
					'template-parts/cards/card-testimonial-preview'
				);
				?>

			</div>

		</div>

	</div>

</section>