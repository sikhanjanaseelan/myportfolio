<?php
/**
 * Project editor SEO tab.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

$seo_title = (string) get_post_meta(
	$post->ID,
	'_mpc_project_seo_title',
	true
);

$seo_description = (string) get_post_meta(
	$post->ID,
	'_mpc_project_seo_description',
	true
);

$canonical_url = (string) get_post_meta(
	$post->ID,
	'_mpc_project_canonical_url',
	true
);

$robots = (string) get_post_meta(
	$post->ID,
	'_mpc_project_robots',
	true
);

$og_image_id = absint(
	get_post_meta(
		$post->ID,
		'_mpc_project_og_image_id',
		true
	)
);

$og_image_url = $og_image_id
	? wp_get_attachment_image_url( $og_image_id, 'medium' )
	: '';

if ( ! $robots ) {
	$robots = 'index-follow';
}
?>

<section
	class="mpc-project-panel"
	data-mpc-panel="seo"
	hidden
>

	<header class="mpc-project-panel__header">

		<h3>
			<?php esc_html_e( 'Search Engine Optimisation', 'myportfolio-core' ); ?>
		</h3>

		<p>
			<?php
			esc_html_e(
				'Control the project title, description, canonical address and social preview.',
				'myportfolio-core'
			);
			?>
		</p>

	</header>

	<div class="mpc-project-seo">

		<section class="mpc-project-seo__section">

			<div class="mpc-form-grid">

				<div class="mpc-form-field mpc-form-field--full">

					<label
						class="mpc-form-label"
						for="mpc-project-seo-title"
					>
						<?php esc_html_e( 'SEO Title', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-seo-title"
						class="mpc-input"
						type="text"
						name="mpc_project_seo_title"
						value="<?php echo esc_attr( $seo_title ); ?>"
						maxlength="60"
						placeholder="<?php esc_attr_e( 'Project title for search results', 'myportfolio-core' ); ?>"
					>

					<div class="mpc-project-character-count">
						<span data-mpc-count-for="mpc-project-seo-title">
							<?php echo esc_html( strlen( $seo_title ) ); ?>
						</span>
						<span>/ 60</span>
					</div>

				</div>

				<div class="mpc-form-field mpc-form-field--full">

					<label
						class="mpc-form-label"
						for="mpc-project-seo-description"
					>
						<?php esc_html_e( 'Meta Description', 'myportfolio-core' ); ?>
					</label>

					<textarea
						id="mpc-project-seo-description"
						class="mpc-textarea"
						name="mpc_project_seo_description"
						rows="4"
						maxlength="160"
						placeholder="<?php esc_attr_e( 'A concise description of the project for search engines.', 'myportfolio-core' ); ?>"
					><?php echo esc_textarea( $seo_description ); ?></textarea>

					<div class="mpc-project-character-count">
						<span data-mpc-count-for="mpc-project-seo-description">
							<?php echo esc_html( strlen( $seo_description ) ); ?>
						</span>
						<span>/ 160</span>
					</div>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-canonical-url"
					>
						<?php esc_html_e( 'Canonical URL', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-canonical-url"
						class="mpc-input"
						type="url"
						name="mpc_project_canonical_url"
						value="<?php echo esc_url( $canonical_url ); ?>"
						placeholder="https://example.com/project/project-name"
					>

					<p class="mpc-form-description">
						<?php
						esc_html_e(
							'Leave empty to use the normal WordPress project URL.',
							'myportfolio-core'
						);
						?>
					</p>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-robots"
					>
						<?php esc_html_e( 'Search Visibility', 'myportfolio-core' ); ?>
					</label>

					<select
						id="mpc-project-robots"
						class="mpc-select"
						name="mpc_project_robots"
					>

						<option
							value="index-follow"
							<?php selected( $robots, 'index-follow' ); ?>
						>
							<?php esc_html_e( 'Index and follow links', 'myportfolio-core' ); ?>
						</option>

						<option
							value="noindex-follow"
							<?php selected( $robots, 'noindex-follow' ); ?>
						>
							<?php esc_html_e( 'Do not index, follow links', 'myportfolio-core' ); ?>
						</option>

						<option
							value="index-nofollow"
							<?php selected( $robots, 'index-nofollow' ); ?>
						>
							<?php esc_html_e( 'Index, do not follow links', 'myportfolio-core' ); ?>
						</option>

						<option
							value="noindex-nofollow"
							<?php selected( $robots, 'noindex-nofollow' ); ?>
						>
							<?php esc_html_e( 'Do not index or follow links', 'myportfolio-core' ); ?>
						</option>

					</select>

				</div>

			</div>

		</section>

		<section class="mpc-project-seo__section">

			<div class="mpc-project-seo__heading">

				<div>

					<h4 class="mpc-project-seo__title">
						<?php esc_html_e( 'Social Preview Image', 'myportfolio-core' ); ?>
					</h4>

					<p class="mpc-project-seo__description">
						<?php
						esc_html_e(
							'Choose an image for LinkedIn, Facebook and other social previews.',
							'myportfolio-core'
						);
						?>
					</p>

				</div>

			</div>

			<input
				class="mpc-project-og-image-value"
				type="hidden"
				name="mpc_project_og_image_id"
				value="<?php echo esc_attr( $og_image_id ); ?>"
			>

			<div
				class="mpc-project-og-image <?php echo $og_image_url ? 'has-image' : 'is-empty'; ?>"
			>

				<div class="mpc-project-og-image__preview">

					<?php if ( $og_image_url ) : ?>

						<img
							src="<?php echo esc_url( $og_image_url ); ?>"
							alt=""
						>

					<?php endif; ?>

				</div>

				<div class="mpc-project-og-image__empty">

					<span
						class="mpc-project-og-image__icon"
						aria-hidden="true"
					>
						<span class="dashicons dashicons-format-image"></span>
					</span>

					<p>
						<?php esc_html_e( 'No social image selected.', 'myportfolio-core' ); ?>
					</p>

				</div>

				<div class="mpc-project-og-image__actions">

					<button
						class="mpc-button mpc-button--secondary mpc-project-og-image-select"
						type="button"
					>
						<span
							class="dashicons dashicons-format-image"
							aria-hidden="true"
						></span>

						<?php esc_html_e( 'Choose Image', 'myportfolio-core' ); ?>
					</button>

					<button
						class="mpc-button mpc-button--ghost mpc-project-og-image-remove"
						type="button"
						<?php echo $og_image_url ? '' : 'hidden'; ?>
					>
						<span
							class="dashicons dashicons-trash"
							aria-hidden="true"
						></span>

						<?php esc_html_e( 'Remove', 'myportfolio-core' ); ?>
					</button>

				</div>

			</div>

		</section>

		<section class="mpc-project-seo-preview">

			<span class="mpc-project-seo-preview__label">
				<?php esc_html_e( 'Search Preview', 'myportfolio-core' ); ?>
			</span>

			<div class="mpc-project-seo-preview__content">

				<span class="mpc-project-seo-preview__url">
					<?php
					echo esc_html(
						$canonical_url
							? $canonical_url
							: home_url( '/project/project-name/' )
					);
					?>
				</span>

				<h4
					class="mpc-project-seo-preview__title"
					data-mpc-seo-preview-title
				>
					<?php
					echo esc_html(
						$seo_title
							? $seo_title
							: __( 'Project SEO title preview', 'myportfolio-core' )
					);
					?>
				</h4>

				<p
					class="mpc-project-seo-preview__description"
					data-mpc-seo-preview-description
				>
					<?php
					echo esc_html(
						$seo_description
							? $seo_description
							: __(
								'Your project meta description will appear here.',
								'myportfolio-core'
							)
					);
					?>
				</p>

			</div>

		</section>

	</div>

</section>