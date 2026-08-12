<?php
/**
 * Featured Projects homepage section.
 *
 * Displays projects managed by the MyPortfolio Core
 * Projects module.
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
	'limit'        => 6,
);

$data = wp_parse_args(
	$args ?? array(),
	$defaults
);

/*
 * Limit.
 */
$project_limit = absint(
	$data['limit']
);

if ( $project_limit < 1 ) {
	$project_limit = 5;
}

/*
 * Project CPT.
 *
 * Keep the theme safe if MyPortfolio Core
 * is temporarily disabled.
 */
$project_post_type = 'portfolio_project';

$projects = array();

if (
	post_type_exists(
		$project_post_type
	)
) {

	/*
	 * First try to retrieve projects explicitly
	 * marked as Featured.
	 */
	$featured_query = new WP_Query(
		array(
			'post_type'           => $project_post_type,
			'post_status'         => 'publish',
			'posts_per_page'      => $project_limit,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,

			/*
			 * Display order first.
			 * Newest project used as fallback.
			 */
			'orderby' => array(
				'menu_order' => 'ASC',
				'date'       => 'DESC',
			),

			/*
			 * Featured project flag from
			 * MyPortfolio Core.
			 */
			'meta_query' => array(
				array(
					'key'     => '_mpc_project_featured',
					'value'   => '1',
					'compare' => '=',
				),
			),
		)
	);

	/*
	 * If there are no projects marked Featured yet,
	 * show latest published projects.
	 *
	 * This prevents the homepage from becoming empty
	 * while project data is being prepared.
	 */
	if (
		! $featured_query->have_posts()
	) {

		$featured_query = new WP_Query(
			array(
				'post_type'           => $project_post_type,
				'post_status'         => 'publish',
				'posts_per_page'      => $project_limit,
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
				'orderby'             => array(
					'menu_order' => 'ASC',
					'date'       => 'DESC',
				),
			)
		);
	}

	/*
	 * Convert WordPress posts into the same
	 * data structure expected by card-project.php.
	 *
	 * This allows us to keep the existing card
	 * design completely unchanged.
	 */
	if (
		$featured_query->have_posts()
	) {

		while (
			$featured_query->have_posts()
		) {

			$featured_query->the_post();

			$project_id = get_the_ID();

			/* ------------------------------------------
			 * Project URLs
			 * --------------------------------------- */

			$project_url = get_permalink(
				$project_id
			);

			$live_url = (string) get_post_meta(
				$project_id,
				'_mpc_project_live_url',
				true
			);

			$github_url = (string) get_post_meta(
				$project_id,
				'_mpc_project_github_url',
				true
			);

			$case_url = (string) get_post_meta(
				$project_id,
				'_mpc_project_case_url',
				true
			);

			/*
			 * The internal single-project page is
			 * our default case-study URL.
			 */
			if ( ! $case_url ) {
				$case_url = $project_url;
			}

			/* ------------------------------------------
			 * Description
			 * --------------------------------------- */

			$description = get_the_excerpt(
				$project_id
			);

			if ( ! $description ) {

				$description = wp_trim_words(
					wp_strip_all_tags(
						get_post_field(
							'post_content',
							$project_id
						)
					),
					24,
					'…'
				);
			}

			/* ------------------------------------------
			 * Featured image
			 * --------------------------------------- */

			$image_id = get_post_thumbnail_id(
				$project_id
			);

			/*
			 * Gallery fallback.
			 */
			if ( ! $image_id ) {

				$gallery_value = (string) get_post_meta(
					$project_id,
					'_mpc_project_gallery',
					true
				);

				$gallery_ids = array_values(
					array_filter(
						array_map(
							'absint',
							explode(
								',',
								$gallery_value
							)
						)
					)
				);

				if ( $gallery_ids ) {

					$image_id = (int) reset(
						$gallery_ids
					);
				}
			}

			$image_url = '';

			$image_alt = get_the_title(
				$project_id
			);

			if ( $image_id ) {

				$image_url = wp_get_attachment_image_url(
					$image_id,
					'large'
				);

				$attachment_alt = get_post_meta(
					$image_id,
					'_wp_attachment_image_alt',
					true
				);

				if ( $attachment_alt ) {
					$image_alt = $attachment_alt;
				}
			}

			/* ------------------------------------------
			 * Project type
			 * --------------------------------------- */

			$type = '';

			if (
				taxonomy_exists(
					'project_type'
				)
			) {

				$type_terms = get_the_terms(
					$project_id,
					'project_type'
				);

				if (
					$type_terms
					&& ! is_wp_error(
						$type_terms
					)
				) {

					$type = implode(
						' · ',
						wp_list_pluck(
							$type_terms,
							'name'
						)
					);
				}
			}

			/*
			 * Category fallback if project type
			 * has not been assigned.
			 */
			if (
				! $type
				&& taxonomy_exists(
					'project_category'
				)
			) {

				$category_terms = get_the_terms(
					$project_id,
					'project_category'
				);

				if (
					$category_terms
					&& ! is_wp_error(
						$category_terms
					)
				) {

					$type = $category_terms[0]->name;
				}
			}

			/* ------------------------------------------
			 * Technologies
			 * --------------------------------------- */

			$technologies = array();

			if (
				taxonomy_exists(
					'technology'
				)
			) {

				$technology_terms = get_the_terms(
					$project_id,
					'technology'
				);

				if (
					$technology_terms
					&& ! is_wp_error(
						$technology_terms
					)
				) {

					$technologies = wp_list_pluck(
						$technology_terms,
						'name'
					);

					/*
					 * Keep homepage cards compact.
					 */
					$technologies = array_slice(
						$technologies,
						0,
						3
					);
				}
			}

			/* ------------------------------------------
			 * Build existing card data
			 * --------------------------------------- */

			$projects[] = array(
				'title'        => get_the_title(
					$project_id
				),
				'description'  => $description,
				'image_url'    => $image_url,
				'image_alt'    => $image_alt,
				'project_url'  => $project_url,
				'live_url'     => $live_url,
				'github_url'   => $github_url,
				'case_url'     => $case_url,
				'type'         => $type,
				'technologies' => $technologies,
				'variant'      => 'compact',
			);
		}

		wp_reset_postdata();
	}
}

/*
 * Section heading visibility.
 */
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

							<?php
							echo esc_html(
								$data['eyebrow']
							);
							?>

						</p>

					<?php endif; ?>

					<?php if ( $data['title'] ) : ?>

						<h2
							id="featured-projects-title"
							class="featured-projects__title"
						>
							<?php
							echo esc_html(
								$data['title']
							);
							?>
						</h2>

					<?php else : ?>

						<h2
							id="featured-projects-title"
							class="screen-reader-text"
						>
							<?php
							esc_html_e(
								'Featured Projects',
								'myportfolio'
							);
							?>
						</h2>

					<?php endif; ?>

					<?php if ( $data['description'] ) : ?>

						<p class="featured-projects__description">

							<?php
							echo esc_html(
								$data['description']
							);
							?>

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
							<?php
							echo esc_html(
								$data['action_label']
							);
							?>
						</span>

						<span aria-hidden="true">
							→
						</span>

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
					<?php
					esc_html_e(
						'Projects are coming soon.',
						'myportfolio'
					);
					?>
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