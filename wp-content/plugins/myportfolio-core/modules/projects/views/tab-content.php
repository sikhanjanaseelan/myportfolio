<?php
/**
 * Project editor Content tab.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

$challenge = (string) get_post_meta(
	$post->ID,
	'_mpc_project_challenge',
	true
);

$solution = (string) get_post_meta(
	$post->ID,
	'_mpc_project_solution',
	true
);

$outcome = (string) get_post_meta(
	$post->ID,
	'_mpc_project_outcome',
	true
);

$features = get_post_meta(
	$post->ID,
	'_mpc_project_features',
	true
);

$statistics = get_post_meta(
	$post->ID,
	'_mpc_project_statistics',
	true
);

$testimonial_quote = (string) get_post_meta(
	$post->ID,
	'_mpc_project_testimonial_quote',
	true
);

$testimonial_name = (string) get_post_meta(
	$post->ID,
	'_mpc_project_testimonial_name',
	true
);

$testimonial_position = (string) get_post_meta(
	$post->ID,
	'_mpc_project_testimonial_position',
	true
);

$testimonial_company = (string) get_post_meta(
	$post->ID,
	'_mpc_project_testimonial_company',
	true
);

$testimonial_rating = absint(
	get_post_meta(
		$post->ID,
		'_mpc_project_testimonial_rating',
		true
	)
);

$testimonial_photo_id = absint(
	get_post_meta(
		$post->ID,
		'_mpc_project_testimonial_photo_id',
		true
	)
);

$case_study_pdf_id = absint(
	get_post_meta(
		$post->ID,
		'_mpc_project_case_study_pdf_id',
		true
	)
);

$testimonial_photo_url = $testimonial_photo_id
	? wp_get_attachment_image_url( $testimonial_photo_id, 'thumbnail' )
	: '';

$case_study_pdf_url = $case_study_pdf_id
	? wp_get_attachment_url( $case_study_pdf_id )
	: '';

if ( ! is_array( $features ) ) {
	$features = array();
}

if ( ! is_array( $statistics ) ) {
	$statistics = array();
}

if ( $testimonial_rating < 1 || $testimonial_rating > 5 ) {
	$testimonial_rating = 5;
}
?>

<section
	class="mpc-project-panel"
	data-mpc-panel="content"
	hidden
>

	<header class="mpc-project-panel__header">

		<h3>
			<?php esc_html_e( 'Project Content', 'myportfolio-core' ); ?>
		</h3>

		<p>
			<?php
			esc_html_e(
				'Create the structured case-study content shown on the single project page.',
				'myportfolio-core'
			);
			?>
		</p>

	</header>

	<div class="mpc-project-content">

		<section class="mpc-project-content__section">

			<div class="mpc-project-content__heading">

				<span
					class="mpc-project-content__icon"
					aria-hidden="true"
				>
					<span class="dashicons dashicons-lightbulb"></span>
				</span>

				<div>

					<h4 class="mpc-project-content__title">
						<?php esc_html_e( 'Challenge, Solution and Outcome', 'myportfolio-core' ); ?>
					</h4>

					<p class="mpc-project-content__description">
						<?php
						esc_html_e(
							'Explain the project problem, your approach and the final result.',
							'myportfolio-core'
						);
						?>
					</p>

				</div>

			</div>

			<div class="mpc-form-grid mpc-form-grid--single">

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-challenge"
					>
						<?php esc_html_e( 'Challenge', 'myportfolio-core' ); ?>
					</label>

					<textarea
						id="mpc-project-challenge"
						class="mpc-textarea"
						name="mpc_project_challenge"
						rows="7"
						placeholder="<?php esc_attr_e( 'What problem or limitation was the client facing?', 'myportfolio-core' ); ?>"
					><?php echo esc_textarea( $challenge ); ?></textarea>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-solution"
					>
						<?php esc_html_e( 'Solution', 'myportfolio-core' ); ?>
					</label>

					<textarea
						id="mpc-project-solution"
						class="mpc-textarea"
						name="mpc_project_solution"
						rows="7"
						placeholder="<?php esc_attr_e( 'Describe the solution, architecture and development approach.', 'myportfolio-core' ); ?>"
					><?php echo esc_textarea( $solution ); ?></textarea>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-outcome"
					>
						<?php esc_html_e( 'Outcome', 'myportfolio-core' ); ?>
					</label>

					<textarea
						id="mpc-project-outcome"
						class="mpc-textarea"
						name="mpc_project_outcome"
						rows="7"
						placeholder="<?php esc_attr_e( 'Describe the result, impact and measurable improvements.', 'myportfolio-core' ); ?>"
					><?php echo esc_textarea( $outcome ); ?></textarea>

				</div>

			</div>

		</section>

		<section class="mpc-project-content__section">

			<div class="mpc-project-content__heading mpc-project-content__heading--actions">

				<div class="mpc-project-content__heading-main">

					<span
						class="mpc-project-content__icon"
						aria-hidden="true"
					>
						<span class="dashicons dashicons-yes-alt"></span>
					</span>

					<div>

						<h4 class="mpc-project-content__title">
							<?php esc_html_e( 'Key Features', 'myportfolio-core' ); ?>
						</h4>

						<p class="mpc-project-content__description">
							<?php
							esc_html_e(
								'Add the most important functionality delivered in this project.',
								'myportfolio-core'
							);
							?>
						</p>

					</div>

				</div>

				<button
					class="mpc-button mpc-button--secondary"
					type="button"
					data-mpc-add-feature
				>
					<span
						class="dashicons dashicons-plus-alt2"
						aria-hidden="true"
					></span>

					<?php esc_html_e( 'Add Feature', 'myportfolio-core' ); ?>
				</button>

			</div>

			<div
				class="mpc-project-repeater"
				data-mpc-features
			>

				<?php foreach ( $features as $index => $feature ) : ?>

					<?php
					$feature_title = isset( $feature['title'] )
						? (string) $feature['title']
						: '';

					$feature_icon = isset( $feature['icon'] )
						? (string) $feature['icon']
						: 'yes-alt';
					?>

					<div
						class="mpc-project-repeater__item"
						data-mpc-feature-item
					>

						<span
							class="mpc-project-repeater__handle"
							aria-hidden="true"
						>
							<span class="dashicons dashicons-move"></span>
						</span>

						<div class="mpc-project-repeater__fields">

							<div class="mpc-form-field">

								<label class="mpc-form-label">
									<?php esc_html_e( 'Icon', 'myportfolio-core' ); ?>
								</label>

								<input
									class="mpc-input"
									type="text"
									name="mpc_project_features[<?php echo esc_attr( $index ); ?>][icon]"
									value="<?php echo esc_attr( $feature_icon ); ?>"
									placeholder="yes-alt"
								>

							</div>

							<div class="mpc-form-field">

								<label class="mpc-form-label">
									<?php esc_html_e( 'Feature', 'myportfolio-core' ); ?>
								</label>

								<input
									class="mpc-input"
									type="text"
									name="mpc_project_features[<?php echo esc_attr( $index ); ?>][title]"
									value="<?php echo esc_attr( $feature_title ); ?>"
									placeholder="<?php esc_attr_e( 'Appointment booking', 'myportfolio-core' ); ?>"
								>

							</div>

						</div>

						<button
							class="mpc-project-repeater__remove"
							type="button"
							data-mpc-remove-item
							aria-label="<?php esc_attr_e( 'Remove feature', 'myportfolio-core' ); ?>"
						>
							<span
								class="dashicons dashicons-trash"
								aria-hidden="true"
							></span>
						</button>

					</div>

				<?php endforeach; ?>

			</div>

			<div
				class="mpc-project-repeater-empty"
				data-mpc-features-empty
				<?php echo $features ? 'hidden' : ''; ?>
			>
				<?php esc_html_e( 'No features added yet.', 'myportfolio-core' ); ?>
			</div>

		</section>

		<section class="mpc-project-content__section">

			<div class="mpc-project-content__heading mpc-project-content__heading--actions">

				<div class="mpc-project-content__heading-main">

					<span
						class="mpc-project-content__icon"
						aria-hidden="true"
					>
						<span class="dashicons dashicons-chart-bar"></span>
					</span>

					<div>

						<h4 class="mpc-project-content__title">
							<?php esc_html_e( 'Project Statistics', 'myportfolio-core' ); ?>
						</h4>

						<p class="mpc-project-content__description">
							<?php
							esc_html_e(
								'Add measurable results such as performance gains, users or conversions.',
								'myportfolio-core'
							);
							?>
						</p>

					</div>

				</div>

				<button
					class="mpc-button mpc-button--secondary"
					type="button"
					data-mpc-add-statistic
				>
					<span
						class="dashicons dashicons-plus-alt2"
						aria-hidden="true"
					></span>

					<?php esc_html_e( 'Add Statistic', 'myportfolio-core' ); ?>
				</button>

			</div>

			<div
				class="mpc-project-repeater"
				data-mpc-statistics
			>

				<?php foreach ( $statistics as $index => $statistic ) : ?>

					<?php
					$statistic_icon = isset( $statistic['icon'] )
						? (string) $statistic['icon']
						: 'chart-bar';

					$statistic_value = isset( $statistic['value'] )
						? (string) $statistic['value']
						: '';

					$statistic_label = isset( $statistic['label'] )
						? (string) $statistic['label']
						: '';
					?>

					<div
						class="mpc-project-repeater__item"
						data-mpc-statistic-item
					>

						<span
							class="mpc-project-repeater__handle"
							aria-hidden="true"
						>
							<span class="dashicons dashicons-move"></span>
						</span>

						<div class="mpc-project-repeater__fields mpc-project-repeater__fields--3">

							<div class="mpc-form-field">

								<label class="mpc-form-label">
									<?php esc_html_e( 'Icon', 'myportfolio-core' ); ?>
								</label>

								<input
									class="mpc-input"
									type="text"
									name="mpc_project_statistics[<?php echo esc_attr( $index ); ?>][icon]"
									value="<?php echo esc_attr( $statistic_icon ); ?>"
									placeholder="chart-bar"
								>

							</div>

							<div class="mpc-form-field">

								<label class="mpc-form-label">
									<?php esc_html_e( 'Value', 'myportfolio-core' ); ?>
								</label>

								<input
									class="mpc-input"
									type="text"
									name="mpc_project_statistics[<?php echo esc_attr( $index ); ?>][value]"
									value="<?php echo esc_attr( $statistic_value ); ?>"
									placeholder="+60%"
								>

							</div>

							<div class="mpc-form-field">

								<label class="mpc-form-label">
									<?php esc_html_e( 'Label', 'myportfolio-core' ); ?>
								</label>

								<input
									class="mpc-input"
									type="text"
									name="mpc_project_statistics[<?php echo esc_attr( $index ); ?>][label]"
									value="<?php echo esc_attr( $statistic_label ); ?>"
									placeholder="<?php esc_attr_e( 'Online enquiries', 'myportfolio-core' ); ?>"
								>

							</div>

						</div>

						<button
							class="mpc-project-repeater__remove"
							type="button"
							data-mpc-remove-item
							aria-label="<?php esc_attr_e( 'Remove statistic', 'myportfolio-core' ); ?>"
						>
							<span
								class="dashicons dashicons-trash"
								aria-hidden="true"
							></span>
						</button>

					</div>

				<?php endforeach; ?>

			</div>

			<div
				class="mpc-project-repeater-empty"
				data-mpc-statistics-empty
				<?php echo $statistics ? 'hidden' : ''; ?>
			>
				<?php esc_html_e( 'No statistics added yet.', 'myportfolio-core' ); ?>
			</div>

		</section>

		<section class="mpc-project-content__section">

			<div class="mpc-project-content__heading">

				<span
					class="mpc-project-content__icon"
					aria-hidden="true"
				>
					<span class="dashicons dashicons-format-quote"></span>
				</span>

				<div>

					<h4 class="mpc-project-content__title">
						<?php esc_html_e( 'Client Testimonial', 'myportfolio-core' ); ?>
					</h4>

					<p class="mpc-project-content__description">
						<?php
						esc_html_e(
							'Add an optional client quote and attribution.',
							'myportfolio-core'
						);
						?>
					</p>

				</div>

			</div>

			<div class="mpc-form-grid">

				<div class="mpc-form-field mpc-form-field--full">

					<label
						class="mpc-form-label"
						for="mpc-project-testimonial-quote"
					>
						<?php esc_html_e( 'Quote', 'myportfolio-core' ); ?>
					</label>

					<textarea
						id="mpc-project-testimonial-quote"
						class="mpc-textarea"
						name="mpc_project_testimonial_quote"
						rows="5"
						placeholder="<?php esc_attr_e( 'What did the client say about the work?', 'myportfolio-core' ); ?>"
					><?php echo esc_textarea( $testimonial_quote ); ?></textarea>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-testimonial-name"
					>
						<?php esc_html_e( 'Client Name', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-testimonial-name"
						class="mpc-input"
						type="text"
						name="mpc_project_testimonial_name"
						value="<?php echo esc_attr( $testimonial_name ); ?>"
					>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-testimonial-position"
					>
						<?php esc_html_e( 'Position', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-testimonial-position"
						class="mpc-input"
						type="text"
						name="mpc_project_testimonial_position"
						value="<?php echo esc_attr( $testimonial_position ); ?>"
					>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-testimonial-company"
					>
						<?php esc_html_e( 'Company', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-testimonial-company"
						class="mpc-input"
						type="text"
						name="mpc_project_testimonial_company"
						value="<?php echo esc_attr( $testimonial_company ); ?>"
					>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-testimonial-rating"
					>
						<?php esc_html_e( 'Rating', 'myportfolio-core' ); ?>
					</label>

					<select
						id="mpc-project-testimonial-rating"
						class="mpc-select"
						name="mpc_project_testimonial_rating"
					>
						<?php for ( $rating = 5; $rating >= 1; $rating-- ) : ?>

							<option
								value="<?php echo esc_attr( $rating ); ?>"
								<?php selected( $testimonial_rating, $rating ); ?>
							>
								<?php
								printf(
									esc_html(
										_n(
											'%d star',
											'%d stars',
											$rating,
											'myportfolio-core'
										)
									),
									esc_html( $rating )
								);
								?>
							</option>

						<?php endfor; ?>
					</select>

				</div>

			</div>

			<div class="mpc-project-content__media-grid">

				<div class="mpc-project-content__media-field">

					<h5>
						<?php esc_html_e( 'Client Photo', 'myportfolio-core' ); ?>
					</h5>

					<input
						type="hidden"
						class="mpc-project-testimonial-photo-value"
						name="mpc_project_testimonial_photo_id"
						value="<?php echo esc_attr( $testimonial_photo_id ); ?>"
					>

					<div
						class="mpc-project-content__media-preview"
						data-mpc-testimonial-photo-preview
					>

						<?php if ( $testimonial_photo_url ) : ?>

							<img
								src="<?php echo esc_url( $testimonial_photo_url ); ?>"
								alt=""
							>

						<?php else : ?>

							<span class="dashicons dashicons-admin-users"></span>

						<?php endif; ?>

					</div>

					<div class="mpc-project-content__media-actions">

						<button
							class="mpc-button mpc-button--secondary"
							type="button"
							data-mpc-select-testimonial-photo
						>
							<?php esc_html_e( 'Choose Photo', 'myportfolio-core' ); ?>
						</button>

						<button
							class="mpc-button mpc-button--ghost"
							type="button"
							data-mpc-remove-testimonial-photo
							<?php echo $testimonial_photo_id ? '' : 'hidden'; ?>
						>
							<?php esc_html_e( 'Remove', 'myportfolio-core' ); ?>
						</button>

					</div>

				</div>

				<div class="mpc-project-content__media-field">

					<h5>
						<?php esc_html_e( 'Case Study PDF', 'myportfolio-core' ); ?>
					</h5>

					<input
						type="hidden"
						class="mpc-project-pdf-value"
						name="mpc_project_case_study_pdf_id"
						value="<?php echo esc_attr( $case_study_pdf_id ); ?>"
					>

					<div
						class="mpc-project-content__file-preview"
						data-mpc-pdf-preview
					>

						<span
							class="dashicons dashicons-media-document"
							aria-hidden="true"
						></span>

						<span>
							<?php
							echo $case_study_pdf_url
								? esc_html( wp_basename( $case_study_pdf_url ) )
								: esc_html__(
									'No PDF selected',
									'myportfolio-core'
								);
							?>
						</span>

					</div>

					<div class="mpc-project-content__media-actions">

						<button
							class="mpc-button mpc-button--secondary"
							type="button"
							data-mpc-select-pdf
						>
							<?php esc_html_e( 'Choose PDF', 'myportfolio-core' ); ?>
						</button>

						<button
							class="mpc-button mpc-button--ghost"
							type="button"
							data-mpc-remove-pdf
							<?php echo $case_study_pdf_id ? '' : 'hidden'; ?>
						>
							<?php esc_html_e( 'Remove', 'myportfolio-core' ); ?>
						</button>

					</div>

				</div>

			</div>

		</section>

	</div>

</section>