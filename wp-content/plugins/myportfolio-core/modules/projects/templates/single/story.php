<?php
/**
 * Single Project overview and case-study story.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="mpc-project-detail__container">

	<section class="mpc-project-detail__story-card">

		<aside class="mpc-project-detail__story-sidebar">

			<?php if ( $section_links ) : ?>

				<nav
					class="mpc-project-detail__story-nav"
					aria-label="<?php esc_attr_e( 'Case study sections', 'myportfolio-core' ); ?>"
				>

					<?php foreach ( $section_links as $section_id => $section_label ) : ?>

						<a href="#<?php echo esc_attr( $section_id ); ?>">
							<?php echo esc_html( $section_label ); ?>
						</a>

					<?php endforeach; ?>

				</nav>

			<?php endif; ?>

			<?php if ( $pdf_url ) : ?>

				<div class="mpc-project-detail__pdf">

					<span
						class="mpc-project-detail__pdf-icon"
						aria-hidden="true"
					>
						▧
					</span>

					<div>

						<strong>
							<?php esc_html_e( 'Project Case Study', 'myportfolio-core' ); ?>
						</strong>

						<small>
							<?php
							echo esc_html(
								$pdf_filename ?: __(
									'PDF document',
									'myportfolio-core'
								)
							);
							?>
						</small>

					</div>

					<a
						href="<?php echo esc_url( $pdf_url ); ?>"
						target="_blank"
						rel="noopener noreferrer"
					>
						<?php esc_html_e( 'Download PDF', 'myportfolio-core' ); ?>

						<span aria-hidden="true">↓</span>
					</a>

				</div>

			<?php endif; ?>

		</aside>

		<div class="mpc-project-detail__story-content">

			<?php if ( trim( get_the_content() ) ) : ?>

				<section
					id="overview"
					class="mpc-project-detail__overview"
				>

					<h2>
						<?php esc_html_e( 'Project Overview', 'myportfolio-core' ); ?>
					</h2>

					<div class="mpc-project-detail__prose">
						<?php the_content(); ?>
					</div>

				</section>

			<?php endif; ?>

			<div class="mpc-project-detail__columns">

				<?php if ( $challenge ) : ?>

					<article
						id="challenge"
						class="mpc-project-detail__story-column"
					>

						<span
							class="mpc-project-detail__round-icon mpc-project-detail__round-icon--orange"
							aria-hidden="true"
						>
							◫
						</span>

						<h3>
							<?php esc_html_e( 'The Challenge', 'myportfolio-core' ); ?>
						</h3>

						<div class="mpc-project-detail__prose">
							<?php echo wp_kses_post( wpautop( $challenge ) ); ?>
						</div>

					</article>

				<?php endif; ?>

				<?php if ( $solution ) : ?>

					<article
						id="solution"
						class="mpc-project-detail__story-column"
					>

						<span
							class="mpc-project-detail__round-icon mpc-project-detail__round-icon--green"
							aria-hidden="true"
						>
							◎
						</span>

						<h3>
							<?php esc_html_e( 'Our Solution', 'myportfolio-core' ); ?>
						</h3>

						<div class="mpc-project-detail__prose">
							<?php echo wp_kses_post( wpautop( $solution ) ); ?>
						</div>

					</article>

				<?php endif; ?>

				<?php if ( $outcome ) : ?>

					<article
						id="results"
						class="mpc-project-detail__story-column"
					>

						<span
							class="mpc-project-detail__round-icon mpc-project-detail__round-icon--pink"
							aria-hidden="true"
						>
							⌂
						</span>

						<h3>
							<?php esc_html_e( 'The Outcome', 'myportfolio-core' ); ?>
						</h3>

						<div class="mpc-project-detail__prose">
							<?php echo wp_kses_post( wpautop( $outcome ) ); ?>
						</div>

					</article>

				<?php endif; ?>

			</div>

			<?php if ( $statistics ) : ?>

				<div class="mpc-project-detail__stats">

					<?php foreach ( $statistics as $statistic ) : ?>

						<?php
						$value = isset( $statistic['value'] )
							? (string) $statistic['value']
							: '';

						$label = isset( $statistic['label'] )
							? (string) $statistic['label']
							: '';

						if ( '' === $value && '' === $label ) {
							continue;
						}
						?>

						<div class="mpc-project-detail__stat">

							<span
								class="mpc-project-detail__stat-icon"
								aria-hidden="true"
							>
								↗
							</span>

							<div>

								<strong>
									<?php echo esc_html( $value ); ?>
								</strong>

								<small>
									<?php echo esc_html( $label ); ?>
								</small>

							</div>

						</div>

					<?php endforeach; ?>

				</div>

			<?php endif; ?>

		</div>

	</section>

</div>