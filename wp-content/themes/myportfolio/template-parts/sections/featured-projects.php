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
	'eyebrow'      => __( 'Featured Projects', 'myportfolio' ),
	'title'        => '',
	'description'  => '',
	'action_label' => __( 'View All Projects', 'myportfolio' ),
	'action_url'   => home_url( '/projects/' ),
	'show_action'  => true,
	'limit'        => 5,
);

$data = wp_parse_args( $args ?? array(), $defaults );

/**
 * Temporary project data.
 *
 * This will later be replaced by a WP_Query connected to the
 * MyPortfolio Core project custom post type.
 */
$projects = array(
	array(
		'title'        => 'MyPortfolio Framework',
		'description'  => 'A modular WordPress developer portfolio with reusable components, responsive layouts and accessible frontend architecture.',
		'image_url'    => 'https://placehold.co/800x460/f7ead9/203f31?text=MyPortfolio+Framework',
		'image_alt'    => 'MyPortfolio framework website preview',
		'project_url'  => '#',
		'live_url'     => '#',
		'github_url'   => '#',
		'case_url'     => '#',
		'type'         => 'Developer Portfolio',
		'technologies' => array(
			'WordPress',
			'PHP',
			'JavaScript',
		),
		'variant'      => 'compact',
	),
	array(
		'title'        => 'Assisi Nursing School',
		'description'  => 'A custom nursing-school website with faculty, events, testimonials, galleries and reusable content modules.',
		'image_url'    => 'https://placehold.co/800x460/e8f0eb/203f31?text=Assisi+Nursing+School',
		'image_alt'    => 'Assisi Nursing School website preview',
		'project_url'  => '#',
		'live_url'     => '#',
		'github_url'   => '#',
		'case_url'     => '#',
		'type'         => 'Education',
		'technologies' => array(
			'WordPress',
			'PHP',
			'Custom Plugin',
		),
		'variant'      => 'compact',
	),
	array(
		'title'        => 'Crest Global Edu',
		'description'  => 'A modern education consultancy platform designed around clear programmes, enquiries and responsive content presentation.',
		'image_url'    => 'https://placehold.co/800x460/e5edf7/243f68?text=Crest+Global+Edu',
		'image_alt'    => 'Crest Global Edu website preview',
		'project_url'  => '#',
		'live_url'     => '#',
		'github_url'   => '#',
		'case_url'     => '#',
		'type'         => 'Education Platform',
		'technologies' => array(
			'WordPress',
			'PHP',
			'MySQL',
		),
		'variant'      => 'compact',
	),
	array(
		'title'        => 'Pran Fertility',
		'description'  => 'A healthcare website focused on trust, treatment information, lead generation and mobile-friendly patient experiences.',
		'image_url'    => 'https://placehold.co/800x460/f7e5e5/772b3a?text=Pran+Fertility',
		'image_alt'    => 'Pran Fertility healthcare website preview',
		'project_url'  => '#',
		'live_url'     => '#',
		'github_url'   => '',
		'case_url'     => '#',
		'type'         => 'Healthcare',
		'technologies' => array(
			'WordPress',
			'REST API',
			'Custom Theme',
		),
		'variant'      => 'compact',
	),
	array(
		'title'        => 'Greshma Portfolio',
		'description'  => 'A content-rich personal portfolio with projects, events, editorials, galleries and a custom WordPress administration system.',
		'image_url'    => 'https://placehold.co/800x460/eee8f7/4e3f70?text=Greshma+Portfolio',
		'image_alt'    => 'Greshma personal portfolio website preview',
		'project_url'  => '#',
		'live_url'     => '#',
		'github_url'   => '#',
		'case_url'     => '#',
		'type'         => 'Portfolio',
		'technologies' => array(
			'WordPress',
			'PHP',
			'Custom CPTs',
		),
		'variant'      => 'compact',
	),
);

$project_limit = absint( $data['limit'] );

if ( $project_limit > 0 ) {
	$projects = array_slice( $projects, 0, $project_limit );
}

$section_has_heading = (
	! empty( $data['eyebrow'] )
	|| ! empty( $data['title'] )
	|| ! empty( $data['description'] )
	|| (
		! empty( $data['show_action'] )
		&& ! empty( $data['action_label'] )
		&& ! empty( $data['action_url'] )
	)
);
?>

<section
	id="featured-projects"
	class="featured-projects section section--surface"
	aria-labelledby="featured-projects-title"
>
	<div class="container container--wide">

		<?php if ( $section_has_heading ) : ?>

			<header class="featured-projects__header">

				<div class="featured-projects__heading-content">

					<?php if ( $data['eyebrow'] ) : ?>

						<p class="featured-projects__eyebrow">
							<span aria-hidden="true"></span>

							<?php echo esc_html( $data['eyebrow'] ); ?>
						</p>

					<?php endif; ?>

					<?php if ( $data['title'] ) : ?>

						<h2
							id="featured-projects-title"
							class="featured-projects__title"
						>
							<?php echo esc_html( $data['title'] ); ?>
						</h2>

					<?php else : ?>

						<h2
							id="featured-projects-title"
							class="screen-reader-text"
						>
							<?php esc_html_e( 'Featured Projects', 'myportfolio' ); ?>
						</h2>

					<?php endif; ?>

					<?php if ( $data['description'] ) : ?>

						<p class="featured-projects__description">
							<?php echo esc_html( $data['description'] ); ?>
						</p>

					<?php endif; ?>

				</div>

				<?php
				if (
					$data['show_action']
					&& $data['action_label']
					&& $data['action_url']
				) :
					?>

					<a
						class="featured-projects__view-all"
						href="<?php echo esc_url( $data['action_url'] ); ?>"
					>
						<span>
							<?php echo esc_html( $data['action_label'] ); ?>
						</span>

						<span aria-hidden="true">→</span>
					</a>

				<?php endif; ?>

			</header>

		<?php endif; ?>

		<?php if ( $projects ) : ?>

			<div
				class="featured-projects__viewport"
				aria-label="<?php esc_attr_e( 'Featured project list', 'myportfolio' ); ?>"
			>
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