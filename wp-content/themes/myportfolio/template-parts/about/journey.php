<?php
/**
 * About page journey.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$journey_items = array(
	array(
		'year'        => '2016',
		'title'       => __( 'Started My Journey', 'myportfolio' ),
		'description' => __(
			'Began learning web development and building projects.',
			'myportfolio'
		),
		'icon'        => 'briefcase',
		'variant'     => 'green',
	),

	array(
		'year'        => '2019 – 2021',
		'title'       => __( 'Professional Growth', 'myportfolio' ),
		'description' => __(
			'Worked on multiple projects and grew my skills in PHP and WordPress.',
			'myportfolio'
		),
		'icon'        => 'code',
		'variant'     => 'orange',
	),

	array(
		'year'        => '2022 – Present',
		'title'       => __( 'Independent Developer', 'myportfolio' ),
		'description' => __(
			'Helping businesses build reliable WordPress solutions.',
			'myportfolio'
		),
		'icon'        => 'rocket',
		'variant'     => 'green',
	),

	array(
		'year'        => __( 'Future', 'myportfolio' ),
		'title'       => __( 'Building & Scaling', 'myportfolio' ),
		'description' => __(
			'Continuing to learn, build and collaborate on impactful products.',
			'myportfolio'
		),
		'icon'        => 'star',
		'variant'     => 'orange',
	),
);
?>

<section
	class="about-journey"
	aria-labelledby="about-journey-title"
>

	<div class="about-journey__panel">

		<header class="about-journey__header">

			<h2
				id="about-journey-title"
				class="about-journey__title"
			>
				<?php esc_html_e( 'My Journey', 'myportfolio' ); ?>
			</h2>

		</header>

		<div class="about-journey__timeline">

			<div
				class="about-journey__line"
				aria-hidden="true"
			></div>

			<?php foreach ( $journey_items as $item ) : ?>

				<article class="about-journey__item">

					<div
						class="about-journey__icon about-journey__icon--<?php echo esc_attr( $item['variant'] ); ?>"
						aria-hidden="true"
					>

						<?php if ( 'briefcase' === $item['icon'] ) : ?>

							<svg
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="1.8"
							>
								<rect
									x="3"
									y="7"
									width="18"
									height="13"
									rx="2"
								></rect>

								<path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>

								<path d="M3 12h18"></path>
							</svg>

						<?php elseif ( 'code' === $item['icon'] ) : ?>

							<svg
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="1.8"
							>
								<path d="m8 9-4 3 4 3"></path>
								<path d="m16 9 4 3-4 3"></path>
								<path d="m14 5-4 14"></path>
							</svg>

						<?php elseif ( 'rocket' === $item['icon'] ) : ?>

							<svg
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="1.8"
							>
								<path d="M4.5 16.5c-1.5 1.5-2 4-2 4s2.5-.5 4-2"></path>

								<path d="M9 15l-3-3 6-6c3-3 6.5-3.5 9-3-.5 2.5 0 6-3 9l-6 6-3-3z"></path>

								<path d="M14 7l3 3"></path>
							</svg>

						<?php else : ?>

							<svg
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="1.8"
							>
								<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.2l-5.6 3 1.1-6.2L3 9.6l6.2-.9L12 3z"></path>
							</svg>

						<?php endif; ?>

					</div>

					<p class="about-journey__year">
						<?php echo esc_html( $item['year'] ); ?>
					</p>

					<h3 class="about-journey__item-title">
						<?php echo esc_html( $item['title'] ); ?>
					</h3>

					<p class="about-journey__description">
						<?php echo esc_html( $item['description'] ); ?>
					</p>

				</article>

			<?php endforeach; ?>

		</div>

	</div>

</section>