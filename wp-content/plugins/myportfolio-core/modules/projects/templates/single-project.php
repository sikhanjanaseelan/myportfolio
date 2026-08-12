<?php
/**
 * Single Project template bootstrap.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$project_id = get_the_ID();

	/**
	 * Retrieve a Project metadata value.
	 *
	 * @param string $key Metadata key.
	 * @return string
	 */
	$get_meta = static function ( string $key ) use ( $project_id ): string {
		return (string) get_post_meta(
			$project_id,
			$key,
			true
		);
	};

	/*
	 * Overview metadata.
	 */
	$client   = $get_meta( '_mpc_project_client' );
	$role     = $get_meta( '_mpc_project_role' );
	$industry = $get_meta( '_mpc_project_industry' );
	$duration = $get_meta( '_mpc_project_duration' );
	$year     = $get_meta( '_mpc_project_year' );
	$status   = $get_meta( '_mpc_project_status' );

	/*
	 * Structured case-study content.
	 */
	$challenge = $get_meta( '_mpc_project_challenge' );
	$solution  = $get_meta( '_mpc_project_solution' );
	$outcome   = $get_meta( '_mpc_project_outcome' );

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

	$features = is_array( $features )
		? $features
		: array();

	$statistics = is_array( $statistics )
		? $statistics
		: array();

	/*
	 * Project links.
	 */
	$live_url   = $get_meta( '_mpc_project_live_url' );
	$github_url = $get_meta( '_mpc_project_github_url' );
	$case_url   = $get_meta( '_mpc_project_case_url' );
	$video_url  = $get_meta( '_mpc_project_video_url' );

	/*
	 * Gallery.
	 */
	$gallery_value = $get_meta( '_mpc_project_gallery' );

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
	$testimonial_quote = $get_meta(
		'_mpc_project_testimonial_quote'
	);

	$testimonial_name = $get_meta(
		'_mpc_project_testimonial_name'
	);

	$testimonial_position = $get_meta(
		'_mpc_project_testimonial_position'
	);

	$testimonial_company = $get_meta(
		'_mpc_project_testimonial_company'
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
	 * Case-study PDF.
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

	$pdf_filename = $pdf_url
		? wp_basename( $pdf_url )
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

	$categories = is_wp_error( $categories )
		? array()
		: (array) $categories;

	$project_types = is_wp_error( $project_types )
		? array()
		: (array) $project_types;

	$technologies = is_wp_error( $technologies )
		? array()
		: (array) $technologies;

	$primary_category = $categories
		? $categories[0]->name
		: '';

	$project_type = $project_types
		? implode(
			', ',
			wp_list_pluck(
				$project_types,
				'name'
			)
		)
		: '';

	/*
	 * Image slider.
	 *
	 * Featured image appears first, followed by unique
	 * gallery images.
	 */
	$hero_image_id = get_post_thumbnail_id(
		$project_id
	);

	if (
		! $hero_image_id
		&& $gallery_ids
	) {
		$hero_image_id = (int) reset(
			$gallery_ids
		);
	}

	$slider_image_ids = array_values(
		array_unique(
			array_filter(
				array_merge(
					$hero_image_id
						? array( $hero_image_id )
						: array(),
					$gallery_ids
				)
			)
		)
	);

	$archive_url = get_post_type_archive_link(
		MPC_Project_CPT::POST_TYPE
	);

	/*
	 * Dynamic sidebar navigation.
	 */
	$section_links = array();

	if ( trim( get_the_content() ) ) {
		$section_links['overview'] = __(
			'Overview',
			'myportfolio-core'
		);
	}

	if ( $challenge ) {
		$section_links['challenge'] = __(
			'The Challenge',
			'myportfolio-core'
		);
	}

	if ( $solution ) {
		$section_links['solution'] = __(
			'Our Solution',
			'myportfolio-core'
		);
	}

	if ( $features ) {
		$section_links['features'] = __(
			'Key Features',
			'myportfolio-core'
		);
	}

	if ( $outcome || $statistics ) {
		$section_links['results'] = __(
			'Results & Impact',
			'myportfolio-core'
		);
	}

	if ( $technologies ) {
		$section_links['technologies'] = __(
			'Technologies Used',
			'myportfolio-core'
		);
	}

	if ( $gallery_ids ) {
		$section_links['screenshots'] = __(
			'Screenshots',
			'myportfolio-core'
		);
	}

	if ( $testimonial_quote ) {
		$section_links['testimonial'] = __(
			'Testimonial',
			'myportfolio-core'
		);
	}
	?>

	<main
		id="primary"
		class="mpc-project-detail"
	>

		<?php require __DIR__ . '/single/hero.php'; ?>

		<?php require __DIR__ . '/single/story.php'; ?>

		<?php require __DIR__ . '/single/screenshots.php'; ?>

		<?php require __DIR__ . '/single/details.php'; ?>

		<?php require __DIR__ . '/single/video.php'; ?>

		<?php require __DIR__ . '/single/similar-projects.php'; ?>

		<?php require __DIR__ . '/single/cta.php'; ?>

	</main>

<?php endwhile; ?>

<?php
get_footer();