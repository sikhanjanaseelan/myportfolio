<?php
/**
 * Projects archive template.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

get_header();
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
				<?php post_type_archive_title(); ?>
			</h1>

			<p class="mpc-projects-intro">
				<?php
				esc_html_e(
					'A collection of WordPress, web-development and digital-product projects built with a focus on usability, performance and maintainable code.',
					'myportfolio-core'
				);
				?>
			</p>

		</div>

	</section>

	<section class="mpc-projects-content">

		<div class="mpc-projects-container">

			<?php if ( have_posts() ) : ?>

				<div class="mpc-projects-grid">

					<?php while ( have_posts() ) : ?>

						<?php
						the_post();

						$project_id = get_the_ID();

						$client = (string) get_post_meta(
							$project_id,
							'_mpc_project_client',
							true
						);

						$status = (string) get_post_meta(
							$project_id,
							'_mpc_project_status',
							true
						);

						$technologies = get_the_terms(
							$project_id,
							'technology'
						);

						$categories = get_the_terms(
							$project_id,
							'project_category'
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

								<?php if ( has_post_thumbnail() ) : ?>

									<?php
									the_post_thumbnail(
										'large',
										array(
											'class'   => 'mpc-project-card__image',
											'loading' => 'lazy',
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

								<h2 class="mpc-project-card__title">

									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>

								</h2>

								<?php if ( $client ) : ?>

									<p class="mpc-project-card__client">

										<span>
											<?php esc_html_e( 'Client:', 'myportfolio-core' ); ?>
										</span>

										<?php echo esc_html( $client ); ?>

									</p>

								<?php endif; ?>

								<div class="mpc-project-card__excerpt">

									<?php
									if ( has_excerpt() ) {
										the_excerpt();
									} else {
										echo wp_kses_post(
											wpautop(
												wp_trim_words(
													get_the_content(),
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
											array_slice( $technologies, 0, 4 )
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
									<?php esc_html_e( 'View Project', 'myportfolio-core' ); ?>

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

					<h2>
						<?php esc_html_e( 'No projects found', 'myportfolio-core' ); ?>
					</h2>

					<p>
						<?php
						esc_html_e(
							'Projects will appear here after they are published.',
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