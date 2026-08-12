<?php
/**
 * Single Project technologies, features and testimonial.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

if (
	! $technologies
	&& ! $features
	&& ! $testimonial_quote
) {
	return;
}
?>

<div class="mpc-project-detail__container">

	<section class="mpc-project-detail__bottom-grid">

		<?php if ( $technologies ) : ?>

			<article
				id="technologies"
				class="mpc-project-detail__bottom-card"
			>

				<h2>
					<?php esc_html_e( 'Technologies Used', 'myportfolio-core' ); ?>
				</h2>

				<div class="mpc-project-detail__technology-list">

					<?php foreach ( $technologies as $technology ) : ?>

						<span>
							<?php echo esc_html( $technology->name ); ?>
						</span>

					<?php endforeach; ?>

				</div>

			</article>

		<?php endif; ?>

		<?php if ( $features ) : ?>

			<article
				id="features"
				class="mpc-project-detail__bottom-card"
			>

				<h2>
					<?php esc_html_e( 'Key Features Implemented', 'myportfolio-core' ); ?>
				</h2>

				<ul class="mpc-project-detail__feature-list">

					<?php foreach ( $features as $feature ) : ?>

						<?php
						$feature_title = isset( $feature['title'] )
							? (string) $feature['title']
							: '';

						if ( '' === $feature_title ) {
							continue;
						}
						?>

						<li>

							<span aria-hidden="true">✓</span>

							<?php echo esc_html( $feature_title ); ?>

						</li>

					<?php endforeach; ?>

				</ul>

			</article>

		<?php endif; ?>

		<?php if ( $testimonial_quote ) : ?>

			<article
				id="testimonial"
				class="mpc-project-detail__bottom-card mpc-project-detail__testimonial"
			>

				<span
					class="mpc-project-detail__quote-mark"
					aria-hidden="true"
				>
					“
				</span>

				<blockquote>
					<?php echo esc_html( $testimonial_quote ); ?>
				</blockquote>

				<div class="mpc-project-detail__testimonial-person">

					<?php if ( $testimonial_photo_id ) : ?>

						<?php
						echo wp_get_attachment_image(
							$testimonial_photo_id,
							'thumbnail',
							false,
							array(
								'class' => 'mpc-project-detail__testimonial-photo',
								'alt'   => $testimonial_name,
							)
						);
						?>

					<?php endif; ?>

					<div>

						<?php if ( $testimonial_name ) : ?>

							<strong>
								<?php echo esc_html( $testimonial_name ); ?>
							</strong>

						<?php endif; ?>

						<?php if ( $testimonial_position || $testimonial_company ) : ?>

							<small>

								<?php
								echo esc_html(
									implode(
										', ',
										array_filter(
											array(
												$testimonial_position,
												$testimonial_company,
											)
										)
									)
								);
								?>

							</small>

						<?php endif; ?>

					</div>

				</div>

				<?php if ( $testimonial_rating ) : ?>

					<div
						class="mpc-project-detail__stars"
						aria-label="<?php echo esc_attr( sprintf( __( '%d out of 5 stars', 'myportfolio-core' ), min( 5, $testimonial_rating ) ) ); ?>"
					>

						<?php
						echo esc_html(
							str_repeat(
								'★',
								min( 5, $testimonial_rating )
							)
						);
						?>

					</div>

				<?php endif; ?>

			</article>

		<?php endif; ?>

	</section>

</div>