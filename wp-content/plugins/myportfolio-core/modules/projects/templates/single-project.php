<?php
/**
 * Single Project case-study template.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$project_id = get_the_ID();

	/*
	 * Overview.
	 */
	$client = (string) get_post_meta(
		$project_id,
		'_mpc_project_client',
		true
	);

	$role = (string) get_post_meta(
		$project_id,
		'_mpc_project_role',
		true
	);

	$industry = (string) get_post_meta(
		$project_id,
		'_mpc_project_industry',
		true
	);

	$duration = (string) get_post_meta(
		$project_id,
		'_mpc_project_duration',
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
	 * Content.
	 */
	$challenge = (string) get_post_meta(
		$project_id,
		'_mpc_project_challenge',
		true
	);

	$solution = (string) get_post_meta(
		$project_id,
		'_mpc_project_solution',
		true
	);

	$outcome = (string) get_post_meta(
		$project_id,
		'_mpc_project_outcome',
		true
	);

	$features = get_post_meta(
		$project_id,
		'_mpc_project_features',
		true
	);

	$statistics = get_post_meta(
		$project_id,
		'_mpc_project_statistics',
		true
	);

	if ( ! is_array( $features ) ) {
		$features = array();
	}

	if ( ! is_array( $statistics ) ) {
		$statistics = array();
	}

	/*
	 * Links.
	 */
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

	$video_url = (string) get_post_meta(
		$project_id,
		'_mpc_project_video_url',
		true
	);

	/*
	 * Gallery.
	 */
	$gallery_value = (string) get_post_meta(
		$project_id,
		'_mpc_project_gallery',
		true
	);

	$gallery_ids = array_values(
		array_filter(
			array_map(
				'absint',
				explode( ',', $gallery_value )
			)
		)
	);

	/*
	 * Testimonial.
	 */
	$testimonial_quote = (string) get_post_meta(
		$project_id,
		'_mpc_project_testimonial_quote',
		true
	);

	$testimonial_name = (string) get_post_meta(
		$project_id,
		'_mpc_project_testimonial_name',
		true
	);

	$testimonial_position = (string) get_post_meta(
		$project_id,
		'_mpc_project_testimonial_position',
		true
	);

	$testimonial_company = (string) get_post_meta(
		$project_id,
		'_mpc_project_testimonial_company',
		true
	);

	$testimonial_rating = absint(
		get_post_meta(
			$project_id,
			'_mpc_project_testimonial_rating',
			true
		)
	);

	$testimonial_photo_id = absint(
		get_post_meta(
			$project_id,
			'_mpc_project_testimonial_photo_id',
			true
		)
	);

	/*
	 * PDF.
	 */
	$pdf_id = absint(
		get_post_meta(
			$project_id,
			'_mpc_project_case_study_pdf_id',
			true
		)
	);

	$pdf_url = $pdf_id
		? wp_get_attachment_url( $pdf_id )
		: '';

	/*
	 * Taxonomies.
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

	/*
	 * Main project image:
	 *
	 * 1. Featured Image.
	 * 2. First gallery image.
	 */
	$hero_image_id = get_post_thumbnail_id(
		$project_id
	);

	if (
		! $hero_image_id
		&& ! empty( $gallery_ids )
	) {
		$hero_image_id = (int) reset(
			$gallery_ids
		);
	}

	/*
	 * Keep all gallery images in the thumbnail strip,
	 * but avoid duplicating the hero image in the main gallery.
	 */
	$main_gallery_ids = array_values(
		array_filter(
			$gallery_ids,
			static function ( int $attachment_id ) use ( $hero_image_id ): bool {
				return $attachment_id !== $hero_image_id;
			}
		)
	);

	$archive_url = get_post_type_archive_link(
		MPC_Project_CPT::POST_TYPE
	);

	/*
	 * Dynamic section navigation.
	 */
	$navigation_items = array();

	if ( trim( get_the_content() ) ) {
		$navigation_items['overview'] = __(
			'Overview',
			'myportfolio-core'
		);
	}

	if ( $challenge ) {
		$navigation_items['challenge'] = __(
			'Challenge',
			'myportfolio-core'
		);
	}

	if ( $solution ) {
		$navigation_items['solution'] = __(
			'Solution',
			'myportfolio-core'
		);
	}

	if ( $outcome || $statistics ) {
		$navigation_items['results'] = __(
			'Results',
			'myportfolio-core'
		);
	}

	if ( $features ) {
		$navigation_items['features'] = __(
			'Features',
			'myportfolio-core'
		);
	}

	if ( $main_gallery_ids ) {
		$navigation_items['gallery'] = __(
			'Gallery',
			'myportfolio-core'
		);
	}

	if (
		$technologies
		&& ! is_wp_error( $technologies )
	) {
		$navigation_items['technologies'] = __(
			'Technologies',
			'myportfolio-core'
		);
	}

	if ( $testimonial_quote ) {
		$navigation_items['testimonial'] = __(
			'Testimonial',
			'myportfolio-core'
		);
	}

	$section_number = 1;
	?>

	<main
		id="primary"
		class="mpc-case-study"
	>

		<section class="mpc-case-study__hero">

			<div class="mpc-case-study__container">

				<?php if ( $archive_url ) : ?>

					<nav
						class="mpc-case-study__breadcrumb"
						aria-label="<?php esc_attr_e( 'Breadcrumb', 'myportfolio-core' ); ?>"
					>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php esc_html_e( 'Home', 'myportfolio-core' ); ?>
						</a>

						<span aria-hidden="true">/</span>

						<a href="<?php echo esc_url( $archive_url ); ?>">
							<?php esc_html_e( 'Projects', 'myportfolio-core' ); ?>
						</a>

						<span aria-hidden="true">/</span>

						<span>
							<?php the_title(); ?>
						</span>
					</nav>

				<?php endif; ?>

				<div class="mpc-case-study__hero-layout">

					<div class="mpc-case-study__hero-copy">

						<?php
						if (
							$categories
							&& ! is_wp_error( $categories )
						) :
							?>

							<div class="mpc-case-study__category-list">

								<?php foreach ( $categories as $category ) : ?>

									<span class="mpc-case-study__category">
										<?php echo esc_html( $category->name ); ?>
									</span>

								<?php endforeach; ?>

							</div>

						<?php endif; ?>

						<h1 class="mpc-case-study__title">
							<?php the_title(); ?>
						</h1>

						<?php if ( has_excerpt() ) : ?>

							<div class="mpc-case-study__intro">
								<?php the_excerpt(); ?>
							</div>

						<?php endif; ?>

						<?php
						if (
							$technologies
							&& ! is_wp_error( $technologies )
						) :
							?>

							<div class="mpc-case-study__hero-tags">

								<?php foreach ( $technologies as $technology ) : ?>

									<span>
										<?php echo esc_html( $technology->name ); ?>
									</span>

								<?php endforeach; ?>

							</div>

						<?php endif; ?>

						<?php if ( $live_url || $github_url || $case_url || $pdf_url ) : ?>

							<div class="mpc-case-study__hero-actions">

								<?php if ( $live_url ) : ?>

									<a
										class="mpc-case-study__button mpc-case-study__button--primary"
										href="<?php echo esc_url( $live_url ); ?>"
										target="_blank"
										rel="noopener noreferrer"
									>
										<?php esc_html_e( 'Visit Website', 'myportfolio-core' ); ?>

										<span aria-hidden="true">↗</span>
									</a>

								<?php endif; ?>

								<?php if ( $github_url ) : ?>

									<a
										class="mpc-case-study__button mpc-case-study__button--outline"
										href="<?php echo esc_url( $github_url ); ?>"
										target="_blank"
										rel="noopener noreferrer"
									>
										<?php esc_html_e( 'GitHub', 'myportfolio-core' ); ?>
									</a>

								<?php endif; ?>

								<?php if ( $case_url ) : ?>

									<a
										class="mpc-case-study__button mpc-case-study__button--outline"
										href="<?php echo esc_url( $case_url ); ?>"
										target="_blank"
										rel="noopener noreferrer"
									>
										<?php esc_html_e( 'Case Study', 'myportfolio-core' ); ?>
									</a>

								<?php endif; ?>

								<?php if ( $pdf_url ) : ?>

									<a
										class="mpc-case-study__button mpc-case-study__button--outline"
										href="<?php echo esc_url( $pdf_url ); ?>"
										target="_blank"
										rel="noopener noreferrer"
									>
										<?php esc_html_e( 'Download PDF', 'myportfolio-core' ); ?>
									</a>

								<?php endif; ?>

							</div>

						<?php endif; ?>

					</div>

					<div class="mpc-case-study__project-meta">

						<?php if ( $client ) : ?>

							<div class="mpc-case-study__meta-item">
								<span><?php esc_html_e( 'Client', 'myportfolio-core' ); ?></span>
								<strong><?php echo esc_html( $client ); ?></strong>
							</div>

						<?php endif; ?>

						<?php if ( $role ) : ?>

							<div class="mpc-case-study__meta-item">
								<span><?php esc_html_e( 'My Role', 'myportfolio-core' ); ?></span>
								<strong><?php echo esc_html( $role ); ?></strong>
							</div>

						<?php endif; ?>

						<?php if ( $duration ) : ?>

							<div class="mpc-case-study__meta-item">
								<span><?php esc_html_e( 'Duration', 'myportfolio-core' ); ?></span>
								<strong><?php echo esc_html( $duration ); ?></strong>
							</div>

						<?php endif; ?>

						<?php if ( $year ) : ?>

							<div class="mpc-case-study__meta-item">
								<span><?php esc_html_e( 'Year', 'myportfolio-core' ); ?></span>
								<strong><?php echo esc_html( $year ); ?></strong>
							</div>

						<?php endif; ?>

						<?php if ( $industry ) : ?>

							<div class="mpc-case-study__meta-item">
								<span><?php esc_html_e( 'Industry', 'myportfolio-core' ); ?></span>
								<strong><?php echo esc_html( $industry ); ?></strong>
							</div>

						<?php endif; ?>

						<?php
						if (
							$project_types
							&& ! is_wp_error( $project_types )
						) :
							?>

							<div class="mpc-case-study__meta-item">

								<span>
									<?php esc_html_e( 'Project Type', 'myportfolio-core' ); ?>
								</span>

								<strong>
									<?php
									echo esc_html(
										implode(
											', ',
											wp_list_pluck(
												$project_types,
												'name'
											)
										)
									);
									?>
								</strong>

							</div>

						<?php endif; ?>

					</div>

				</div>

			</div>

		</section>

		<?php if ( $hero_image_id ) : ?>

			<section class="mpc-case-study__visual">

				<div class="mpc-case-study__container">

					<figure class="mpc-case-study__main-image">

						<?php
						echo wp_get_attachment_image(
							$hero_image_id,
							'full',
							false,
							array(
								'class'   => 'mpc-case-study__main-image-element',
								'loading' => 'eager',
								'alt'     => get_the_title(),
							)
						);
						?>

					</figure>

					<?php if ( $gallery_ids ) : ?>

						<div class="mpc-case-study__thumbnail-strip">

							<?php foreach ( $gallery_ids as $gallery_id ) : ?>

								<?php
								$full_image_url = wp_get_attachment_image_url(
									$gallery_id,
									'full'
								);

								if ( ! $full_image_url ) {
									continue;
								}
								?>

								<a
									class="mpc-case-study__thumbnail"
									href="<?php echo esc_url( $full_image_url ); ?>"
									target="_blank"
									rel="noopener noreferrer"
								>
									<?php
									echo wp_get_attachment_image(
										$gallery_id,
										'medium',
										false,
										array(
											'class'   => 'mpc-case-study__thumbnail-image',
											'loading' => 'lazy',
											'alt'     => '',
										)
									);
									?>
								</a>

							<?php endforeach; ?>

						</div>

					<?php endif; ?>

				</div>

			</section>

		<?php endif; ?>

		<section class="mpc-case-study__main">

			<div class="mpc-case-study__container">

				<div class="mpc-case-study__main-layout">

					<?php if ( $navigation_items ) : ?>

						<aside class="mpc-case-study__sidebar">

							<div class="mpc-case-study__sidebar-card">

								<span class="mpc-case-study__sidebar-title">
									<?php esc_html_e( 'In this case study', 'myportfolio-core' ); ?>
								</span>

								<nav aria-label="<?php esc_attr_e( 'Case study sections', 'myportfolio-core' ); ?>">

									<?php foreach ( $navigation_items as $item_id => $item_label ) : ?>

										<a href="#<?php echo esc_attr( $item_id ); ?>">
											<span aria-hidden="true"></span>

											<?php echo esc_html( $item_label ); ?>
										</a>

									<?php endforeach; ?>

								</nav>

							</div>

						</aside>

					<?php endif; ?>

					<div class="mpc-case-study__content">

						<?php if ( trim( get_the_content() ) ) : ?>

							<section
								id="overview"
								class="mpc-case-study__section"
							>

								<div class="mpc-case-study__section-heading">

									<span class="mpc-case-study__section-index">
										<?php echo esc_html( str_pad( (string) $section_number, 2, '0', STR_PAD_LEFT ) ); ?>
									</span>

									<h2>
										<?php esc_html_e( 'Project Overview', 'myportfolio-core' ); ?>
									</h2>

								</div>

								<div class="mpc-case-study__prose">
									<?php the_content(); ?>
								</div>

							</section>

							<?php $section_number++; ?>

						<?php endif; ?>

						<?php if ( $challenge ) : ?>

							<section
								id="challenge"
								class="mpc-case-study__section"
							>

								<div class="mpc-case-study__section-heading">

									<span class="mpc-case-study__section-index">
										<?php echo esc_html( str_pad( (string) $section_number, 2, '0', STR_PAD_LEFT ) ); ?>
									</span>

									<h2>
										<?php esc_html_e( 'The Challenge', 'myportfolio-core' ); ?>
									</h2>

								</div>

								<div class="mpc-case-study__prose">
									<?php echo wp_kses_post( wpautop( $challenge ) ); ?>
								</div>

							</section>

							<?php $section_number++; ?>

						<?php endif; ?>

						<?php if ( $solution ) : ?>

							<section
								id="solution"
								class="mpc-case-study__section"
							>

								<div class="mpc-case-study__section-heading">

									<span class="mpc-case-study__section-index">
										<?php echo esc_html( str_pad( (string) $section_number, 2, '0', STR_PAD_LEFT ) ); ?>
									</span>

									<h2>
										<?php esc_html_e( 'The Solution', 'myportfolio-core' ); ?>
									</h2>

								</div>

								<div class="mpc-case-study__prose">
									<?php echo wp_kses_post( wpautop( $solution ) ); ?>
								</div>

							</section>

							<?php $section_number++; ?>

						<?php endif; ?>

						<?php if ( $outcome || $statistics ) : ?>

							<section
								id="results"
								class="mpc-case-study__section"
							>

								<div class="mpc-case-study__section-heading">

									<span class="mpc-case-study__section-index">
										<?php echo esc_html( str_pad( (string) $section_number, 2, '0', STR_PAD_LEFT ) ); ?>
									</span>

									<h2>
										<?php esc_html_e( 'Results and Outcome', 'myportfolio-core' ); ?>
									</h2>

								</div>

								<?php if ( $outcome ) : ?>

									<div class="mpc-case-study__prose">
										<?php echo wp_kses_post( wpautop( $outcome ) ); ?>
									</div>

								<?php endif; ?>

								<?php if ( $statistics ) : ?>

									<div class="mpc-case-study__metrics">

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

											<article class="mpc-case-study__metric">

												<strong>
													<?php echo esc_html( $value ); ?>
												</strong>

												<span>
													<?php echo esc_html( $label ); ?>
												</span>

											</article>

										<?php endforeach; ?>

									</div>

								<?php endif; ?>

							</section>

							<?php $section_number++; ?>

						<?php endif; ?>

						<?php if ( $features ) : ?>

							<section
								id="features"
								class="mpc-case-study__section"
							>

								<div class="mpc-case-study__section-heading">

									<span class="mpc-case-study__section-index">
										<?php echo esc_html( str_pad( (string) $section_number, 2, '0', STR_PAD_LEFT ) ); ?>
									</span>

									<h2>
										<?php esc_html_e( 'Key Features', 'myportfolio-core' ); ?>
									</h2>

								</div>

								<div class="mpc-case-study__feature-grid">

									<?php foreach ( $features as $feature ) : ?>

										<?php
										$feature_title = isset( $feature['title'] )
											? (string) $feature['title']
											: '';

										if ( '' === $feature_title ) {
											continue;
										}
										?>

										<article class="mpc-case-study__feature-card">

											<span
												class="mpc-case-study__feature-icon"
												aria-hidden="true"
											>
												✓
											</span>

											<span>
												<?php echo esc_html( $feature_title ); ?>
											</span>

										</article>

									<?php endforeach; ?>

								</div>

							</section>

							<?php $section_number++; ?>

						<?php endif; ?>

						<?php if ( $main_gallery_ids ) : ?>

							<section
								id="gallery"
								class="mpc-case-study__section"
							>

								<div class="mpc-case-study__section-heading">

									<span class="mpc-case-study__section-index">
										<?php echo esc_html( str_pad( (string) $section_number, 2, '0', STR_PAD_LEFT ) ); ?>
									</span>

									<h2>
										<?php esc_html_e( 'Project Gallery', 'myportfolio-core' ); ?>
									</h2>

								</div>

								<div class="mpc-case-study__gallery">

									<?php foreach ( $main_gallery_ids as $gallery_id ) : ?>

										<?php
										$full_image_url = wp_get_attachment_image_url(
											$gallery_id,
											'full'
										);

										if ( ! $full_image_url ) {
											continue;
										}
										?>

										<a
											class="mpc-case-study__gallery-card"
											href="<?php echo esc_url( $full_image_url ); ?>"
											target="_blank"
											rel="noopener noreferrer"
										>
											<?php
											echo wp_get_attachment_image(
												$gallery_id,
												'large',
												false,
												array(
													'class'   => 'mpc-case-study__gallery-image',
													'loading' => 'lazy',
													'alt'     => '',
												)
											);
											?>
										</a>

									<?php endforeach; ?>

								</div>

							</section>

							<?php $section_number++; ?>

						<?php endif; ?>

						<?php
						if (
							$technologies
							&& ! is_wp_error( $technologies )
						) :
							?>

							<section
								id="technologies"
								class="mpc-case-study__section"
							>

								<div class="mpc-case-study__section-heading">

									<span class="mpc-case-study__section-index">
										<?php echo esc_html( str_pad( (string) $section_number, 2, '0', STR_PAD_LEFT ) ); ?>
									</span>

									<h2>
										<?php esc_html_e( 'Technologies Used', 'myportfolio-core' ); ?>
									</h2>

								</div>

								<div class="mpc-case-study__technology-grid">

									<?php foreach ( $technologies as $technology ) : ?>

										<span>
											<?php echo esc_html( $technology->name ); ?>
										</span>

									<?php endforeach; ?>

								</div>

							</section>

							<?php $section_number++; ?>

						<?php endif; ?>

						<?php if ( $video_url ) : ?>

							<section class="mpc-case-study__section">

								<div class="mpc-case-study__section-heading">

									<span class="mpc-case-study__section-index">
										<?php echo esc_html( str_pad( (string) $section_number, 2, '0', STR_PAD_LEFT ) ); ?>
									</span>

									<h2>
										<?php esc_html_e( 'Project Video', 'myportfolio-core' ); ?>
									</h2>

								</div>

								<div class="mpc-case-study__video">

									<?php
									$video_embed = wp_oembed_get(
										$video_url
									);

									if ( $video_embed ) {
										echo wp_kses_post( $video_embed );
									} else {
										?>

										<a
											href="<?php echo esc_url( $video_url ); ?>"
											target="_blank"
											rel="noopener noreferrer"
										>
											<?php esc_html_e( 'Watch Project Video', 'myportfolio-core' ); ?>
										</a>

										<?php
									}
									?>

								</div>

							</section>

							<?php $section_number++; ?>

						<?php endif; ?>

						<?php if ( $testimonial_quote ) : ?>

							<section
								id="testimonial"
								class="mpc-case-study__section"
							>

								<div class="mpc-case-study__testimonial">

									<div class="mpc-case-study__testimonial-rating">
										<?php
										echo esc_html(
											str_repeat(
												'★',
												max(
													1,
													min(
														5,
														$testimonial_rating
													)
												)
											)
										);
										?>
									</div>

									<blockquote>
										<?php echo esc_html( $testimonial_quote ); ?>
									</blockquote>

									<div class="mpc-case-study__testimonial-person">

										<?php if ( $testimonial_photo_id ) : ?>

											<?php
											echo wp_get_attachment_image(
												$testimonial_photo_id,
												'thumbnail',
												false,
												array(
													'class' => 'mpc-case-study__testimonial-photo',
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

												<span>
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
												</span>

											<?php endif; ?>

										</div>

									</div>

								</div>

							</section>

						<?php endif; ?>

					</div>

				</div>

			</div>

		</section>

		<?php
		$related_term_ids = array();

		if (
			$categories
			&& ! is_wp_error( $categories )
		) {
			$related_term_ids = wp_list_pluck(
				$categories,
				'term_id'
			);
		}

		$related_args = array(
			'post_type'           => MPC_Project_CPT::POST_TYPE,
			'post_status'         => 'publish',
			'posts_per_page'      => 3,
			'post__not_in'        => array( $project_id ),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);

		if ( $related_term_ids ) {
			$related_args['tax_query'] = array(
				array(
					'taxonomy' => 'project_category',
					'field'    => 'term_id',
					'terms'    => $related_term_ids,
				),
			);
		}

		$related_projects = new WP_Query(
			$related_args
		);
		?>

		<?php if ( $related_projects->have_posts() ) : ?>

			<section class="mpc-case-study__related">

				<div class="mpc-case-study__container">

					<header class="mpc-case-study__related-heading">

						<div>
							<span>
								<?php esc_html_e( 'More work', 'myportfolio-core' ); ?>
							</span>

							<h2>
								<?php esc_html_e( 'Related Projects', 'myportfolio-core' ); ?>
							</h2>
						</div>

						<?php if ( $archive_url ) : ?>

							<a href="<?php echo esc_url( $archive_url ); ?>">
								<?php esc_html_e( 'View all projects', 'myportfolio-core' ); ?>

								<span aria-hidden="true">→</span>
							</a>

						<?php endif; ?>

					</header>

					<div class="mpc-case-study__related-grid">

						<?php while ( $related_projects->have_posts() ) : ?>

							<?php
							$related_projects->the_post();

							$related_id = get_the_ID();

							$related_image_id = get_post_thumbnail_id(
								$related_id
							);

							if ( ! $related_image_id ) {

								$related_gallery_value = (string) get_post_meta(
									$related_id,
									'_mpc_project_gallery',
									true
								);

								$related_gallery_ids = array_filter(
									array_map(
										'absint',
										explode(
											',',
											$related_gallery_value
										)
									)
								);

								if ( $related_gallery_ids ) {
									$related_image_id = (int) reset(
										$related_gallery_ids
									);
								}
							}
							?>

							<article class="mpc-case-study__related-card">

								<a
									class="mpc-case-study__related-image-wrap"
									href="<?php the_permalink(); ?>"
								>

									<?php if ( $related_image_id ) : ?>

										<?php
										echo wp_get_attachment_image(
											$related_image_id,
											'large',
											false,
											array(
												'class'   => 'mpc-case-study__related-image',
												'loading' => 'lazy',
												'alt'     => get_the_title(),
											)
										);
										?>

									<?php else : ?>

										<span class="mpc-case-study__related-placeholder"></span>

									<?php endif; ?>

								</a>

								<div class="mpc-case-study__related-card-body">

									<h3>
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</h3>

									<a
										class="mpc-case-study__related-link"
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

		<?php endif; ?>

		<?php wp_reset_postdata(); ?>

		<section class="mpc-case-study__cta">

			<div class="mpc-case-study__container">

				<div class="mpc-case-study__cta-inner">

					<span>
						<?php esc_html_e( 'Have a project in mind?', 'myportfolio-core' ); ?>
					</span>

					<h2>
						<?php esc_html_e( 'Let’s create something meaningful together.', 'myportfolio-core' ); ?>
					</h2>

					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
						<?php esc_html_e( 'Start a Conversation', 'myportfolio-core' ); ?>

						<span aria-hidden="true">→</span>
					</a>

				</div>

			</div>

		</section>

	</main>

<?php endwhile; ?>

<?php
get_footer();