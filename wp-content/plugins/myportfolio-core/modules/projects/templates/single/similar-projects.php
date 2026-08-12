<?php
/**
 * Single Project similar projects.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

$related_args = array(
	'post_type'           => MPC_Project_CPT::POST_TYPE,
	'post_status'         => 'publish',
	'posts_per_page'      => 3,
	'post__not_in'        => array( $project_id ),
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
	'orderby'             => array(
		'menu_order' => 'ASC',
		'date'       => 'DESC',
	),
);

if ( $categories ) {

	$related_args['tax_query'] = array(
		array(
			'taxonomy' => 'project_category',
			'field'    => 'term_id',
			'terms'    => wp_list_pluck(
				$categories,
				'term_id'
			),
		),
	);
}

$similar_projects = new WP_Query(
	$related_args
);

/*
 * Fall back to latest projects if there are
 * no projects in the same category.
 */
if (
	! $similar_projects->have_posts()
	&& isset( $related_args['tax_query'] )
) {

	unset(
		$related_args['tax_query']
	);

	$similar_projects = new WP_Query(
		$related_args
	);
}

if ( ! $similar_projects->have_posts() ) {

	wp_reset_postdata();

	return;
}
?>

<section class="mpc-project-detail__similar">

	<div class="mpc-project-detail__container">

		<header class="mpc-project-detail__similar-header">

			<div>

				<span>
					<?php esc_html_e( 'More selected work', 'myportfolio-core' ); ?>
				</span>

				<h2>
					<?php esc_html_e( 'Similar Projects', 'myportfolio-core' ); ?>
				</h2>

			</div>

			<?php if ( $archive_url ) : ?>

				<a href="<?php echo esc_url( $archive_url ); ?>">

					<?php esc_html_e( 'View all projects', 'myportfolio-core' ); ?>

					<span aria-hidden="true">→</span>

				</a>

			<?php endif; ?>

		</header>

		<div class="mpc-project-detail__similar-grid">

			<?php while ( $similar_projects->have_posts() ) : ?>

				<?php
				$similar_projects->the_post();

				$similar_id = get_the_ID();

				$similar_image_id = get_post_thumbnail_id(
					$similar_id
				);

				if ( ! $similar_image_id ) {

					$similar_gallery_value = (string) get_post_meta(
						$similar_id,
						'_mpc_project_gallery',
						true
					);

					$similar_gallery_ids = array_values(
						array_filter(
							array_map(
								'absint',
								explode(
									',',
									$similar_gallery_value
								)
							)
						)
					);

					if ( $similar_gallery_ids ) {

						$similar_image_id = (int) reset(
							$similar_gallery_ids
						);
					}
				}

				$similar_categories = get_the_terms(
					$similar_id,
					'project_category'
				);

				$similar_categories = is_wp_error(
					$similar_categories
				)
					? array()
					: (array) $similar_categories;
				?>

				<article class="mpc-project-detail__similar-card">

					<a
						class="mpc-project-detail__similar-media"
						href="<?php the_permalink(); ?>"
						aria-label="<?php echo esc_attr( get_the_title() ); ?>"
					>

						<?php if ( $similar_image_id ) : ?>

							<?php
							echo wp_get_attachment_image(
								$similar_image_id,
								'large',
								false,
								array(
									'class'   => 'mpc-project-detail__similar-image',
									'loading' => 'lazy',
									'alt'     => get_the_title(),
								)
							);
							?>

						<?php else : ?>

							<span
								class="mpc-project-detail__similar-placeholder"
								aria-hidden="true"
							></span>

						<?php endif; ?>

					</a>

					<div class="mpc-project-detail__similar-body">

						<?php if ( $similar_categories ) : ?>

							<span class="mpc-project-detail__similar-category">

								<?php echo esc_html( $similar_categories[0]->name ); ?>

							</span>

						<?php endif; ?>

						<h3>

							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>

						</h3>

						<a
							class="mpc-project-detail__similar-link"
							href="<?php the_permalink(); ?>"
						>

							<?php esc_html_e( 'View Case Study', 'myportfolio-core' ); ?>

							<span aria-hidden="true">→</span>

						</a>

					</div>

				</article>

			<?php endwhile; ?>

		</div>

	</div>

</section>

<?php
wp_reset_postdata();