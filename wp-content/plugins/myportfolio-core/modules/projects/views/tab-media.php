<?php
/**
 * Project editor Media tab.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

$gallery_value = (string) get_post_meta(
	$post->ID,
	'_mpc_project_gallery',
	true
);

$gallery_ids = array_filter(
	array_map(
		'absint',
		explode( ',', $gallery_value )
	)
);

$video_url = (string) get_post_meta(
	$post->ID,
	'_mpc_project_video_url',
	true
);
?>

<section
	class="mpc-project-panel"
	data-mpc-panel="media"
	hidden
>

	<header class="mpc-project-panel__header">

		<h3>
			<?php esc_html_e( 'Project Media', 'myportfolio-core' ); ?>
		</h3>

		<p>
			<?php
			esc_html_e(
				'Create an ordered gallery and add optional project video content.',
				'myportfolio-core'
			);
			?>
		</p>

	</header>

	<div class="mpc-project-media">

		<section class="mpc-project-media__section">

			<div class="mpc-project-media__heading">

				<div>

					<h4 class="mpc-project-media__title">
						<?php esc_html_e( 'Project Gallery', 'myportfolio-core' ); ?>
					</h4>

					<p class="mpc-project-media__description">
						<?php
						esc_html_e(
							'Choose multiple images, drag them to change their order, or remove individual images.',
							'myportfolio-core'
						);
						?>
					</p>

				</div>

				<button
					class="mpc-button mpc-button--primary mpc-project-gallery-add"
					type="button"
				>
					<span
						class="dashicons dashicons-plus-alt2"
						aria-hidden="true"
					></span>

					<?php esc_html_e( 'Add Images', 'myportfolio-core' ); ?>
				</button>

			</div>

			<input
				class="mpc-project-gallery-value"
				type="hidden"
				name="mpc_project_gallery"
				value="<?php echo esc_attr( implode( ',', $gallery_ids ) ); ?>"
			>

			<div
				class="mpc-project-gallery <?php echo $gallery_ids ? '' : 'is-empty'; ?>"
				data-empty-text="<?php esc_attr_e( 'No gallery images have been selected.', 'myportfolio-core' ); ?>"
			>

				<?php foreach ( $gallery_ids as $attachment_id ) : ?>

					<?php
					$image = wp_get_attachment_image_src(
						$attachment_id,
						'medium'
					);

					if ( ! $image ) {
						continue;
					}
					?>

					<article
						class="mpc-project-gallery__item"
						data-attachment-id="<?php echo esc_attr( $attachment_id ); ?>"
					>

						<div class="mpc-project-gallery__image">

							<img
								src="<?php echo esc_url( $image[0] ); ?>"
								alt=""
							>

						</div>

						<div class="mpc-project-gallery__toolbar">

							<span
								class="mpc-project-gallery__handle"
								title="<?php esc_attr_e( 'Drag to reorder', 'myportfolio-core' ); ?>"
								aria-hidden="true"
							>
								<span class="dashicons dashicons-move"></span>
							</span>

							<button
								class="mpc-project-gallery__remove"
								type="button"
								aria-label="<?php esc_attr_e( 'Remove image', 'myportfolio-core' ); ?>"
							>
								<span
									class="dashicons dashicons-no-alt"
									aria-hidden="true"
								></span>
							</button>

						</div>

					</article>

				<?php endforeach; ?>

			</div>

			<div class="mpc-project-gallery-empty">

				<span
					class="mpc-project-gallery-empty__icon"
					aria-hidden="true"
				>
					<span class="dashicons dashicons-format-gallery"></span>
				</span>

				<h5 class="mpc-project-gallery-empty__title">
					<?php esc_html_e( 'No gallery images yet', 'myportfolio-core' ); ?>
				</h5>

				<p class="mpc-project-gallery-empty__description">
					<?php
					esc_html_e(
						'Select screenshots, mockups or project photographs from the WordPress Media Library.',
						'myportfolio-core'
					);
					?>
				</p>

				<button
					class="mpc-button mpc-button--secondary mpc-project-gallery-add"
					type="button"
				>
					<span
						class="dashicons dashicons-format-gallery"
						aria-hidden="true"
					></span>

					<?php esc_html_e( 'Choose Images', 'myportfolio-core' ); ?>
				</button>

			</div>

		</section>

		<section class="mpc-project-media__section">

			<div class="mpc-form-field">

				<label
					class="mpc-form-label"
					for="mpc-project-video-url"
				>
					<?php esc_html_e( 'Project Video URL', 'myportfolio-core' ); ?>
				</label>

				<input
					id="mpc-project-video-url"
					class="mpc-input"
					type="url"
					name="mpc_project_video_url"
					value="<?php echo esc_url( $video_url ); ?>"
					placeholder="https://www.youtube.com/watch?v=..."
				>

				<p class="mpc-form-description">
					<?php
					esc_html_e(
						'Optional YouTube, Vimeo or externally hosted project video.',
						'myportfolio-core'
					);
					?>
				</p>

			</div>

		</section>

	</div>

</section>