<?php
/**
 * Featured projects homepage section.
 *
 * Temporary project data is used until the MyPortfolio Core plugin
 * provides the portfolio_project custom post type.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$defaults = array(
	'eyebrow'       => __( 'Selected Work', 'myportfolio' ),
	'title'         => __( 'Featured Projects', 'myportfolio' ),
	'description'   => __(
		'A selection of custom WordPress, PHP and Laravel projects focused on maintainability, usability and business value.',
		'myportfolio'
	),
	'action_label'  => __( 'View All Projects', 'myportfolio' ),
	'action_url'    => home_url( '/projects/' ),
	'show_action'   => true,
	'featured_only' => true,
	'limit'         => 3,
);

$data = wp_parse_args( $args ?? array(), $defaults );

/**
 * Temporary project data.
 *
 * This array will later be replaced with a WP_Query for the
 * portfolio_project custom post type.
 */
$projects = array(
	array(
		'title'        => 'MyPortfolio Framework',
		'description'  => 'A reusable WordPress portfolio framework with modular CSS, accessible components, responsive layouts and a custom theme architecture.',
		'image_url'    => 'https://placehold.co/1200x760/f7ead9/203f31?text=MyPortfolio+Framework',
		'image_alt'    => 'MyPortfolio framework project preview',
		'project_url'  => '#',
		'live_url'     => '#',
		'github_url'   => '#',
		'case_url'     => '#',
		'type'         => 'Featured Project',
		'technologies' => array(
			'WordPress',
			'PHP',
			'JavaScript',
			'Modular CSS',
		),
		'variant'      => 'featured',
	),
	array(
		'title'        => 'Healthcare Platform',
		'description'  => 'A custom WordPress healthcare platform with reusable content modules, appointment-focused UX and third-party integrations.',
		'image_url'    => 'https://placehold.co/800x500/f7e5e5/772b3a?text=Healthcare+Platform',
		'image_alt'    => 'Healthcare platform project preview',
		'project_url'  => '#',
		'live_url'     => '#',
		'github_url'   => '#',
		'case_url'     => '#',
		'type'         => 'Healthcare',
		'technologies' => array(
			'WordPress',
			'PHP',
			'REST API',
		),
		'variant'      => 'default',
	),
	array(
		'title'        => 'Education Portal',
		'description'  => 'A responsive education portal with structured content, custom post types and reusable page components.',
		'image_url'    => 'https://placehold.co/800x500/e5edf7/243f68?text=Education+Portal',
		'image_alt'    => 'Education portal project preview',
		'project_url'  => '#',
		'live_url'     => '#',
		'github_url'   => '#',
		'case_url'     => '#',
		'type'         => 'Education',
		'technologies' => array(
			'WordPress',
			'MySQL',
			'Custom Theme',
		),
		'variant'      => 'default',
	),
);

$project_limit = absint( $data['limit'] );

if ( $project_limit > 0 ) {
	$projects = array_slice( $projects, 0, $project_limit );
}
?>

<section
	id="featured-projects"
	class="featured-projects section section--surface"
	aria-labelledby="featured-projects-title"
>
	<div class="container container--wide">

		<header class="section-heading featured-projects__heading">

			<div class="section-heading__content">

				<?php if ( $data['eyebrow'] ) : ?>

					<p class="section-heading__eyebrow">
						<?php echo esc_html( $data['eyebrow'] ); ?>
					</p>

				<?php endif; ?>

				<?php if ( $data['title'] ) : ?>

					<h2
						id="featured-projects-title"
						class="section-heading__title"
					>
						<?php echo esc_html( $data['title'] ); ?>
					</h2>

				<?php endif; ?>

				<?php if ( $data['description'] ) : ?>

					<p class="section-heading__description">
						<?php echo esc_html( $data['description'] ); ?>
					</p>

				<?php endif; ?>

			</div>

			<?php if ( $data['show_action'] && $data['action_label'] && $data['action_url'] ) : ?>

				<div class="section-heading__action">

					<a
						class="button button--secondary"
						href="<?php echo esc_url( $data['action_url'] ); ?>"
					>
						<span>
							<?php echo esc_html( $data['action_label'] ); ?>
						</span>

						<span aria-hidden="true">→</span>
					</a>

				</div>

			<?php endif; ?>

		</header>

		<?php if ( $projects ) : ?>

			<div class="featured-projects__list">

				<?php foreach ( $projects as $project ) : ?>

					<?php
					get_template_part(
						'template-parts/cards/card-project',
						null,
						$project
					);
					?>

				<?php endforeach; ?>

			</div>

		<?php else : ?>

			<div class="featured-projects__empty">

				<h3>
					<?php esc_html_e( 'Projects are coming soon.', 'myportfolio' ); ?>
				</h3>

				<p>
					<?php
					esc_html_e(
						'Featured project case studies are currently being prepared.',
						'myportfolio'
					);
					?>
				</p>

			</div>

		<?php endif; ?>

	</div>
</section>