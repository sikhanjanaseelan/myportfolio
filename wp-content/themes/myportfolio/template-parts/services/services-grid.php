<?php
/**
 * Services grid.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$services = array(
	array(
		'title'       => __( 'WordPress Development', 'myportfolio' ),
		'description' => __(
			'Custom WordPress websites, themes, plugins, CPTs, ACF, Elementor, WooCommerce and tailored business functionality.',
			'myportfolio'
		),
		'icon'        => 'wordpress',
		'variant'     => 'green',
	),
	array(
		'title'       => __( 'Web Application Development', 'myportfolio' ),
		'description' => __(
			'Robust PHP and Laravel web applications with clean architecture, secure backend logic, databases and scalable workflows.',
			'myportfolio'
		),
		'icon'        => 'webapp',
		'variant'     => 'green',
	),
	array(
		'title'       => __( 'Custom Plugin Development', 'myportfolio' ),
		'description' => __(
			'Secure, lightweight and feature-rich WordPress plugins built around specific business requirements and workflows.',
			'myportfolio'
		),
		'icon'        => 'plugin',
		'variant'     => 'orange',
	),
	array(
		'title'       => __( 'API Integration', 'myportfolio' ),
		'description' => __(
			'Third-party APIs, payment gateways, external platforms and service integrations for smooth and reliable data exchange.',
			'myportfolio'
		),
		'icon'        => 'api',
		'variant'     => 'green',
	),
	array(
		'title'       => __( 'Project Ideation & Feasibility', 'myportfolio' ),
		'description' => __(
			'Shape software ideas, clarify requirements, assess feasibility, identify risks and define a realistic technical direction.',
			'myportfolio'
		),
		'icon'        => 'idea',
		'variant'     => 'orange',
	),
	array(
		'title'       => __( 'Documentation & Handover Preparation', 'myportfolio' ),
		'description' => __(
			'Technical documentation, project case studies, development notes, feature records, process documentation and handover materials.',
			'myportfolio'
		),
		'icon'        => 'document',
		'variant'     => 'green',
	),
	array(
		'title'       => __( 'Manual Testing & Delivery Verification', 'myportfolio' ),
		'description' => __(
			'Functional testing, usability checks, workflow verification, regression checks and release-readiness validation.',
			'myportfolio'
		),
		'icon'        => 'testing',
		'variant'     => 'orange',
	),
	array(
		'title'       => __( 'Independent Software Delivery Support', 'myportfolio' ),
		'description' => __(
			'Act as your technical support person during development by reviewing deliverables, validating workflows, documenting issues and helping coordinate feedback with the development team.',
			'myportfolio'
		),
		'icon'        => 'support',
		'variant'     => 'green',
	),
);
?>

<section
	class="services-grid"
	aria-labelledby="services-grid-title"
>

	<div class="container container--wide">

		<h2
			id="services-grid-title"
			class="screen-reader-text"
		>
			<?php esc_html_e( 'Available Services', 'myportfolio' ); ?>
		</h2>

		<div class="services-grid__list">

			<?php foreach ( $services as $service ) : ?>

				<article class="service-card">

					<div
						class="service-card__icon service-card__icon--<?php echo esc_attr( $service['variant'] ); ?>"
						aria-hidden="true"
					>

						<?php if ( 'wordpress' === $service['icon'] ) : ?>

							<span class="service-card__symbol">W</span>

						<?php elseif ( 'webapp' === $service['icon'] ) : ?>

							<svg
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="1.7"
								stroke-linecap="round"
								stroke-linejoin="round"
							>
								<rect x="3" y="4" width="18" height="16" rx="2"></rect>
								<path d="M3 8h18"></path>
								<path d="m9 13-2 2 2 2"></path>
								<path d="m15 13 2 2-2 2"></path>
							</svg>

						<?php elseif ( 'plugin' === $service['icon'] ) : ?>

							<svg
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="1.7"
							>
								<path d="M8 3v4H5a2 2 0 0 0-2 2v3h4v4H3v3a2 2 0 0 0 2 2h3v-4h4v4h3a2 2 0 0 0 2-2v-3h4v-4h-4V9a2 2 0 0 0-2-2h-3V3H8z"></path>
							</svg>

						<?php elseif ( 'api' === $service['icon'] ) : ?>

							<svg
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="1.7"
								stroke-linecap="round"
							>
								<path d="M8 3v5"></path>
								<path d="M16 3v5"></path>
								<path d="M5 8h14"></path>
								<path d="M7 8v4a5 5 0 0 0 10 0V8"></path>
								<path d="M12 17v4"></path>
							</svg>

						<?php elseif ( 'idea' === $service['icon'] ) : ?>

							<svg
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="1.7"
							>
								<path d="M9 18h6"></path>
								<path d="M10 22h4"></path>
								<path d="M8 14c-1.3-1.1-2-2.5-2-4a6 6 0 1 1 12 0c0 1.5-.7 2.9-2 4-1 .8-1.5 1.6-1.7 2H9.7c-.2-.4-.7-1.2-1.7-2z"></path>
							</svg>

						<?php elseif ( 'document' === $service['icon'] ) : ?>

							<svg
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="1.7"
							>
								<path d="M6 2h8l4 4v16H6z"></path>
								<path d="M14 2v5h5"></path>
								<path d="M9 12h6"></path>
								<path d="M9 16h6"></path>
							</svg>

						<?php elseif ( 'testing' === $service['icon'] ) : ?>

							<svg
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="1.7"
							>
								<rect x="5" y="4" width="14" height="17" rx="2"></rect>
								<path d="M9 4V2h6v2"></path>
								<path d="m9 13 2 2 4-5"></path>
							</svg>

						<?php else : ?>

							<svg
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="1.7"
							>
								<circle cx="12" cy="8" r="4"></circle>
								<path d="M4 21a8 8 0 0 1 16 0"></path>
								<path d="M17 12h4"></path>
								<path d="M19 10v4"></path>
							</svg>

						<?php endif; ?>

					</div>

					<div class="service-card__content">

						<h3>
							<?php echo esc_html( $service['title'] ); ?>
						</h3>

						<p>
							<?php echo esc_html( $service['description'] ); ?>
						</p>

					</div>

				</article>

			<?php endforeach; ?>

		</div>

	</div>

</section>