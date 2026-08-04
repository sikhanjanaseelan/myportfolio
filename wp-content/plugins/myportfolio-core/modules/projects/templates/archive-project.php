<?php
/**
 * Projects archive template.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

get_header();

$archive_url = get_post_type_archive_link(
	MPC_Project_CPT::POST_TYPE
);

$project_categories = get_terms(
	array(
		'taxonomy'   => 'project_category',
		'hide_empty' => true,
	)
);
?>

<main
	id="primary"
	class="mpc-projects-archive"
>

	<section class="mpc-projects-hero">

		<div class="mpc-projects-container">

			<span class="mpc-projects-eyebrow">
				<?php esc_html_e( 'Selected Work', 'myportfolio-core' ); ?>
			</span>

			<h1 class="mpc-projects-title">
				<?php esc_html_e( 'Projects built with purpose.', 'myportfolio-core' ); ?>
			</h1>

			<p class="mpc-projects-intro">
				<?php
				esc_html_e(
					'A selection of WordPress platforms, custom web applications and digital experiences focused on usability, performance and maintainable development.',
					'myportfolio-core'
				);
				?>
			</p>

		</div>

	</section>

	<?php
	if (
		$project_categories
		&& ! is_wp_error( $project_categories )
	) :
		?>

		<section class="mpc-projects-filters">

			<div class="mpc-projects-container">

				<div
					class="mpc-projects-filter-list"
					aria-label="<?php esc_attr_e( 'Project categories', 'myportfolio-core' ); ?>"
				>

					<?php if ( $archive_url ) : ?>

						<a
							class="mpc-projects-filter is-active"
							href="<?php echo esc_url( $archive_url ); ?>"
						>
							<?php esc_html_e( 'All Projects', 'myportfolio-core' ); ?>
						</a>

					<?php endif; ?>

					<?php foreach ( $project_categories as $filter_category ) : ?>

						<?php
						$category_link = get_term_link(
							$filter_category
						);

						if ( is_wp_error( $category_link ) ) {
							continue;
						}
						?>

						<a
							class="mpc-projects-filter"
							href="<?php echo esc_url( $category_link ); ?>"
						>
							<?php echo esc_html( $filter_category->name ); ?>
						</a>

					<?php endforeach; ?>

				</div>

			</div>

		</section>

	<?php endif; ?>

	<section class="mpc-projects-content">

		<div class="mpc-projects-container">

			<?php if ( have_posts() ) : ?>

				<div class="mpc-projects-grid">

					<?php while ( have_posts() ) : ?>

						<?php
						the_post();

						$project_id = get_the_ID();

						/*
						 * Card image priority:
						 *
						 * 1. Featured image.
						 * 2. First gallery image.
						 * 3. Placeholder.
						 */
						$card_image_id = get_post_thumbnail_id(
							$project_id
						);

						if ( ! $card_image_id ) {

							$gallery_value = (string) get_post_meta(
								$project_id,
								'_mpc_project_gallery',
								true
							);

							$gallery_ids = array_filter(
								array_map(
									'absint',
									explode(
										',',
										$gallery_value
									)
								)
							);

							if ( ! empty( $gallery_ids ) ) {
								$card_image_id = (int) reset(
									$gallery_ids
								);
							}
						}

						/*
						 * Project metadata.
						 */
						$client = (string) get_post_meta(
							$project_id,
							'_mpc_project_client',
							true
						);

						$year = (string) get_post_meta(
							$project_id,
							'_mpc_project_year',
							true
						);

						$status = (string) get_post_meta(
							$project_id,
							'_mpc_project_status',
							true
						);

						/*
						 * Project taxonomies.
						 */
						$categories = get_the_terms(
							$project_id,
							'project_category'
						);

						$project_types = get_the_terms(
							$project_id,
							'project_type'
						);

						$technologies = get_the_terms(
							$project_id,
							'technology'
						);
						?>

						<article
							id="post-<?php the_ID(); ?>"
							<?php post_class( 'mpc-project-card' ); ?>
						>

							<a
								class="mpc-project-card__media"
								href="<?php the_permalink(); ?>"
								aria-label="<?php echo esc_attr( get_the_title() ); ?>"
							>

								<?php if ( $card_image_id ) : ?>

									<?php
									echo wp_get_attachment_image(
										$card_image_id,
										'large',
										false,
										array(
											'class'   => 'mpc-project-card__image',
											'loading' => 'lazy',
											'alt'     => get_the_title(),
										)
									);
									?>

								<?php else : ?>

									<span class="mpc-project-card__placeholder">

										<span
											class="dashicons dashicons-portfolio"
											aria-hidden="true"
										></span>

									</span>

								<?php endif; ?>

								<?php if ( $status ) : ?>

									<span class="mpc-project-card__status">

										<?php
										echo esc_html(
											ucwords(
												str_replace(
													'-',
													' ',
													$status
												)
											)
										);
										?>

									</span>

								<?php endif; ?>

							</a>

							<div class="mpc-project-card__body">

								<?php
								if (
									(
										$categories
										&& ! is_wp_error( $categories )
									)
									||
									(
										$project_types
										&& ! is_wp_error( $project_types )
									)
								) :
									?>

									<div class="mpc-project-card__taxonomies">

										<?php
										if (
											$categories
											&& ! is_wp_error( $categories )
										) :
											?>

											<div class="mpc-project-card__categories">

												<?php foreach ( $categories as $category ) : ?>

													<span class="mpc-project-card__category">
														<?php echo esc_html( $category->name ); ?>
													</span>

												<?php endforeach; ?>

											</div>

										<?php endif; ?>

										<?php
										if (
											$project_types
											&& ! is_wp_error( $project_types )
										) :
											?>

											<div class="mpc-project-card__types">

												<?php foreach ( $project_types as $project_type ) : ?>

													<span class="mpc-project-card__type">
														<?php echo esc_html( $project_type->name ); ?>
													</span>

												<?php endforeach; ?>

											</div>

										<?php endif; ?>

									</div>

								<?php endif; ?>

								<h2 class="mpc-project-card__title">

									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>

								</h2>

								<?php if ( $client || $year ) : ?>

									<div class="mpc-project-card__meta">

										<?php if ( $client ) : ?>

											<span>

												<strong>
													<?php esc_html_e( 'Client', 'myportfolio-core' ); ?>
												</strong>

												<?php echo esc_html( $client ); ?>

											</span>

										<?php endif; ?>

										<?php if ( $year ) : ?>

											<span>

												<strong>
													<?php esc_html_e( 'Year', 'myportfolio-core' ); ?>
												</strong>

												<?php echo esc_html( $year ); ?>

											</span>

										<?php endif; ?>

									</div>

								<?php endif; ?>

								<div class="mpc-project-card__excerpt">

									<?php
									if ( has_excerpt() ) {

										the_excerpt();

									} else {

										echo wp_kses_post(
											wpautop(
												wp_trim_words(
													wp_strip_all_tags(
														get_the_content()
													),
													24
												)
											)
										);
									}
									?>

								</div>

								<?php
								if (
									$technologies
									&& ! is_wp_error( $technologies )
								) :
									?>

									<div class="mpc-project-card__technologies">

										<?php
										foreach (
											array_slice(
												$technologies,
												0,
												5
											)
											as $technology
										) :
											?>

											<span class="mpc-project-card__technology">
												<?php echo esc_html( $technology->name ); ?>
											</span>

										<?php endforeach; ?>

									</div>

								<?php endif; ?>

								<a
									class="mpc-project-card__link"
									href="<?php the_permalink(); ?>"
								>
									<?php esc_html_e( 'View Case Study', 'myportfolio-core' ); ?>

									<span aria-hidden="true">→</span>
								</a>

							</div>

						</article>

					<?php endwhile; ?>

				</div>

				<nav
					class="mpc-projects-pagination"
					aria-label="<?php esc_attr_e( 'Projects pagination', 'myportfolio-core' ); ?>"
				>

					<?php
					the_posts_pagination(
						array(
							'mid_size'  => 1,
							'prev_text' => __(
								'Previous',
								'myportfolio-core'
							),
							'next_text' => __(
								'Next',
								'myportfolio-core'
							),
						)
					);
					?>

				</nav>

			<?php else : ?>

				<div class="mpc-projects-empty">

					<span
						class="mpc-projects-empty__icon"
						aria-hidden="true"
					>
						<span class="dashicons dashicons-portfolio"></span>
					</span>

					<h2>
						<?php esc_html_e( 'No projects published yet', 'myportfolio-core' ); ?>
					</h2>

					<p>
						<?php
						esc_html_e(
							'Published portfolio projects will appear here.',
							'myportfolio-core'
						);
						?>
					</p>

				</div>

			<?php endif; ?>

		</div>

	</section>

</main>

<?php
get_footer();