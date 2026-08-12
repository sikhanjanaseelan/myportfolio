<?php
/**
 * Single Project hero and image slider.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="mpc-project-detail__container">

	<nav
		class="mpc-project-detail__breadcrumb"
		aria-label="<?php esc_attr_e( 'Breadcrumb', 'myportfolio-core' ); ?>"
	>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php esc_html_e( 'Home', 'myportfolio-core' ); ?>
		</a>

		<span aria-hidden="true">›</span>

		<?php if ( $archive_url ) : ?>

			<a href="<?php echo esc_url( $archive_url ); ?>">
				<?php esc_html_e( 'Projects', 'myportfolio-core' ); ?>
			</a>

			<span aria-hidden="true">›</span>

		<?php endif; ?>

		<span><?php the_title(); ?></span>

	</nav>

	<section class="mpc-project-detail__hero">

		<div class="mpc-project-detail__hero-copy">

			<?php if ( $primary_category ) : ?>

				<span class="mpc-project-detail__eyebrow">
					<?php echo esc_html( $primary_category ); ?>
				</span>

			<?php endif; ?>

			<h1 class="mpc-project-detail__title">
				<?php the_title(); ?>
			</h1>

			<?php if ( has_excerpt() ) : ?>

				<div class="mpc-project-detail__excerpt">
					<?php the_excerpt(); ?>
				</div>

			<?php endif; ?>

			<?php if ( $technologies ) : ?>

				<div class="mpc-project-detail__tags">

					<?php
					foreach (
						array_slice( $technologies, 0, 5 )
						as $technology
					) :
						?>

						<span>
							<?php echo esc_html( $technology->name ); ?>
						</span>

					<?php endforeach; ?>

				</div>

			<?php endif; ?>

			<?php if ( $live_url || $github_url || $case_url ) : ?>

				<div class="mpc-project-detail__actions">

					<?php if ( $live_url ) : ?>

						<a
							class="mpc-project-detail__button mpc-project-detail__button--primary"
							href="<?php echo esc_url( $live_url ); ?>"
							target="_blank"
							rel="noopener noreferrer"
						>
							<?php esc_html_e( 'Live Website', 'myportfolio-core' ); ?>

							<span aria-hidden="true">↗</span>
						</a>

					<?php endif; ?>

					<?php if ( $github_url ) : ?>

						<a
							class="mpc-project-detail__button"
							href="<?php echo esc_url( $github_url ); ?>"
							target="_blank"
							rel="noopener noreferrer"
						>
							<?php esc_html_e( 'GitHub', 'myportfolio-core' ); ?>
						</a>

					<?php endif; ?>

					<?php if ( $case_url ) : ?>

						<a
							class="mpc-project-detail__button"
							href="<?php echo esc_url( $case_url ); ?>"
							target="_blank"
							rel="noopener noreferrer"
						>
							<?php esc_html_e( 'Case Study', 'myportfolio-core' ); ?>
						</a>

					<?php endif; ?>

				</div>

			<?php endif; ?>

			<div class="mpc-project-detail__meta-card">

				<?php if ( $duration ) : ?>

					<div class="mpc-project-detail__meta-item">

						<span
							class="mpc-project-detail__meta-icon"
							aria-hidden="true"
						>
							◷
						</span>

						<small>
							<?php esc_html_e( 'Duration', 'myportfolio-core' ); ?>
						</small>

						<strong>
							<?php echo esc_html( $duration ); ?>
						</strong>

					</div>

				<?php endif; ?>

				<?php if ( $project_type ) : ?>

					<div class="mpc-project-detail__meta-item">

						<span
							class="mpc-project-detail__meta-icon"
							aria-hidden="true"
						>
							&lt;/&gt;
						</span>

						<small>
							<?php esc_html_e( 'Type', 'myportfolio-core' ); ?>
						</small>

						<strong>
							<?php echo esc_html( $project_type ); ?>
						</strong>

					</div>

				<?php endif; ?>

				<?php if ( $client ) : ?>

					<div class="mpc-project-detail__meta-item">

						<span
							class="mpc-project-detail__meta-icon"
							aria-hidden="true"
						>
							◎
						</span>

						<small>
							<?php esc_html_e( 'Client', 'myportfolio-core' ); ?>
						</small>

						<strong>
							<?php echo esc_html( $client ); ?>
						</strong>

					</div>

				<?php endif; ?>

				<?php if ( $year ) : ?>

					<div class="mpc-project-detail__meta-item">

						<span
							class="mpc-project-detail__meta-icon"
							aria-hidden="true"
						>
							◉
						</span>

						<small>
							<?php esc_html_e( 'Year', 'myportfolio-core' ); ?>
						</small>

						<strong>
							<?php echo esc_html( $year ); ?>
						</strong>

					</div>

				<?php endif; ?>

			</div>

		</div>

		<div
			class="mpc-project-detail__visual"
			data-mpc-project-slider
			tabindex="0"
			aria-label="<?php esc_attr_e( 'Project image gallery', 'myportfolio-core' ); ?>"
		>

			<?php if ( $slider_image_ids ) : ?>

				<div class="mpc-project-detail__slider-stage">

					<figure class="mpc-project-detail__frame">

						<?php
						$initial_image_id = (int) $slider_image_ids[0];

						$initial_image_url = wp_get_attachment_image_url(
							$initial_image_id,
							'full'
						);

						$initial_image_alt = get_post_meta(
							$initial_image_id,
							'_wp_attachment_image_alt',
							true
						);

						if ( ! $initial_image_alt ) {
							$initial_image_alt = get_the_title();
						}
						?>

						<img
							class="mpc-project-detail__hero-image"
							src="<?php echo esc_url( $initial_image_url ); ?>"
							alt="<?php echo esc_attr( $initial_image_alt ); ?>"
							data-mpc-slider-image
							loading="eager"
						>

						<?php if ( count( $slider_image_ids ) > 1 ) : ?>

							<div class="mpc-project-detail__slider-controls">

								<span
									class="mpc-project-detail__slider-counter"
									data-mpc-slider-counter
									aria-live="polite"
								>
									1 / <?php echo esc_html( count( $slider_image_ids ) ); ?>
								</span>

								<button
									class="mpc-project-detail__slider-button"
									type="button"
									data-mpc-slider-prev
									aria-label="<?php esc_attr_e( 'Previous project image', 'myportfolio-core' ); ?>"
								>
									<span aria-hidden="true">‹</span>
								</button>

								<button
									class="mpc-project-detail__slider-button"
									type="button"
									data-mpc-slider-next
									aria-label="<?php esc_attr_e( 'Next project image', 'myportfolio-core' ); ?>"
								>
									<span aria-hidden="true">›</span>
								</button>

							</div>

						<?php endif; ?>

					</figure>

				</div>

				<?php if ( count( $slider_image_ids ) > 1 ) : ?>

					<div
						class="mpc-project-detail__thumbs"
						role="tablist"
						aria-label="<?php esc_attr_e( 'Choose project image', 'myportfolio-core' ); ?>"
					>

						<?php
						foreach (
							$slider_image_ids
							as $image_index => $slider_image_id
						) :
							?>

							<?php
							$full_url = wp_get_attachment_image_url(
								$slider_image_id,
								'full'
							);

							$slider_alt = get_post_meta(
								$slider_image_id,
								'_wp_attachment_image_alt',
								true
							);

							if ( ! $slider_alt ) {
								$slider_alt = sprintf(
									/* translators: %d: image number. */
									__(
										'Project image %d',
										'myportfolio-core'
									),
									$image_index + 1
								);
							}

							if ( ! $full_url ) {
								continue;
							}
							?>

							<button
								class="mpc-project-detail__thumb<?php echo 0 === $image_index ? ' is-active' : ''; ?>"
								type="button"
								role="tab"
								aria-selected="<?php echo 0 === $image_index ? 'true' : 'false'; ?>"
								data-mpc-slider-thumb
								data-index="<?php echo esc_attr( $image_index ); ?>"
								data-full-src="<?php echo esc_url( $full_url ); ?>"
								data-alt="<?php echo esc_attr( $slider_alt ); ?>"
							>

								<?php
								echo wp_get_attachment_image(
									$slider_image_id,
									'medium',
									false,
									array(
										'class'   => 'mpc-project-detail__thumb-image',
										'loading' => 'lazy',
										'alt'     => '',
									)
								);
								?>

							</button>

						<?php endforeach; ?>

					</div>

				<?php endif; ?>

			<?php endif; ?>

		</div>

	</section>

</div>