<?php
/**
 * Experience timeline.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$experience_items = array(
	array(
		'period'      => '2024 – Present',
		'role'        => __( 'WordPress & Laravel Developer', 'myportfolio' ),
		'company'     => __( 'Finklinz IT Services – Remote', 'myportfolio' ),
		'description' => __(
			'Building custom WordPress solutions, plugin development, API integrations and performance optimizations for clients worldwide.',
			'myportfolio'
		),
	),
	array(
		'period'      => '2019 – 2022',
		'role'        => __( 'PHP Laravel Developer', 'myportfolio' ),
		'company'     => __( 'Extreme Media Solution, Kerala, India', 'myportfolio' ),
		'description' => __(
			'Developed and maintained web applications using Laravel, MySQL and REST APIs.',
			'myportfolio'
		),
	),
	array(
		'period'      => 'Jun 2019 – Aug 2019',
		'role'        => __( 'PHP Developer Intern', 'myportfolio' ),
		'company'     => __( 'MagicClouds Technology, Kerala, India', 'myportfolio' ),
		'description' => __(
			'Worked on real-time projects and gained hands-on experience in PHP development.',
			'myportfolio'
		),
	),
);
?>

<section
	class="experience-timeline"
	aria-labelledby="experience-timeline-title"
>

	<div class="experience-card">

		<header class="experience-card__header">

			<span
				class="experience-card__header-icon"
				aria-hidden="true"
			>
				▣
			</span>

			<h2 id="experience-timeline-title">
				<?php esc_html_e( 'Experience Timeline', 'myportfolio' ); ?>
			</h2>

		</header>

		<div class="experience-timeline__list">

			<?php foreach ( $experience_items as $index => $item ) : ?>

				<article class="experience-timeline__item">

					<div
						class="experience-timeline__marker<?php echo 0 === $index ? ' is-current' : ''; ?>"
						aria-hidden="true"
					></div>

					<div class="experience-timeline__content">

						<p class="experience-timeline__period">
							<?php echo esc_html( $item['period'] ); ?>
						</p>

						<h3>
							<?php echo esc_html( $item['role'] ); ?>
						</h3>

						<p class="experience-timeline__company">
							<?php echo esc_html( $item['company'] ); ?>
						</p>

						<p class="experience-timeline__description">
							<?php echo esc_html( $item['description'] ); ?>
						</p>

					</div>

				</article>

			<?php endforeach; ?>

		</div>

	</div>

</section>