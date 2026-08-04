<?php
/**
 * Single Project case-study template.
 *
 * Closely follows the approved single-project reference layout.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$project_id = get_the_ID();

	$get_meta = static function ( string $key ) use ( $project_id ): string {
		return (string) get_post_meta( $project_id, $key, true );
	};

	$client   = $get_meta( '_mpc_project_client' );
	$role     = $get_meta( '_mpc_project_role' );
	$industry = $get_meta( '_mpc_project_industry' );
	$duration = $get_meta( '_mpc_project_duration' );
	$year     = $get_meta( '_mpc_project_year' );
	$status   = $get_meta( '_mpc_project_status' );

	$challenge = $get_meta( '_mpc_project_challenge' );
	$solution  = $get_meta( '_mpc_project_solution' );
	$outcome   = $get_meta( '_mpc_project_outcome' );

	$features   = get_post_meta( $project_id, '_mpc_project_features', true );
	$statistics = get_post_meta( $project_id, '_mpc_project_statistics', true );
	$features   = is_array( $features ) ? $features : array();
	$statistics = is_array( $statistics ) ? $statistics : array();

	$live_url   = $get_meta( '_mpc_project_live_url' );
	$github_url = $get_meta( '_mpc_project_github_url' );
	$case_url   = $get_meta( '_mpc_project_case_url' );
	$video_url  = $get_meta( '_mpc_project_video_url' );

	$gallery_value = $get_meta( '_mpc_project_gallery' );
	$gallery_ids   = array_values(
		array_filter(
			array_map( 'absint', explode( ',', $gallery_value ) )
		)
	);

	$testimonial_quote    = $get_meta( '_mpc_project_testimonial_quote' );
	$testimonial_name     = $get_meta( '_mpc_project_testimonial_name' );
	$testimonial_position = $get_meta( '_mpc_project_testimonial_position' );
	$testimonial_company  = $get_meta( '_mpc_project_testimonial_company' );
	$testimonial_rating   = absint( get_post_meta( $project_id, '_mpc_project_testimonial_rating', true ) );
	$testimonial_photo_id = absint( get_post_meta( $project_id, '_mpc_project_testimonial_photo_id', true ) );

	$pdf_id       = absint( get_post_meta( $project_id, '_mpc_project_case_study_pdf_id', true ) );
	$pdf_url      = $pdf_id ? wp_get_attachment_url( $pdf_id ) : '';
	$pdf_filename = $pdf_url ? wp_basename( $pdf_url ) : '';

	$categories    = get_the_terms( $project_id, 'project_category' );
	$project_types = get_the_terms( $project_id, 'project_type' );
	$technologies  = get_the_terms( $project_id, 'technology' );

	$categories    = is_wp_error( $categories ) ? array() : (array) $categories;
	$project_types = is_wp_error( $project_types ) ? array() : (array) $project_types;
	$technologies  = is_wp_error( $technologies ) ? array() : (array) $technologies;

	$hero_image_id = get_post_thumbnail_id( $project_id );

	if ( ! $hero_image_id && $gallery_ids ) {
		$hero_image_id = (int) reset( $gallery_ids );
	}

	$archive_url      = get_post_type_archive_link( MPC_Project_CPT::POST_TYPE );
	$primary_category = $categories ? $categories[0]->name : '';
	$project_type     = $project_types ? implode( ', ', wp_list_pluck( $project_types, 'name' ) ) : '';

	$section_links = array();

	if ( trim( get_the_content() ) ) {
		$section_links['overview'] = __( 'Overview', 'myportfolio-core' );
	}
	if ( $challenge ) {
		$section_links['challenge'] = __( 'The Challenge', 'myportfolio-core' );
	}
	if ( $solution ) {
		$section_links['solution'] = __( 'Our Solution', 'myportfolio-core' );
	}
	if ( $features ) {
		$section_links['features'] = __( 'Key Features', 'myportfolio-core' );
	}
	if ( $outcome || $statistics ) {
		$section_links['results'] = __( 'Results & Impact', 'myportfolio-core' );
	}
	if ( $technologies ) {
		$section_links['technologies'] = __( 'Technologies Used', 'myportfolio-core' );
	}
	if ( $gallery_ids ) {
		$section_links['screenshots'] = __( 'Screenshots', 'myportfolio-core' );
	}
	if ( $testimonial_quote ) {
		$section_links['testimonial'] = __( 'Testimonial', 'myportfolio-core' );
	}
	?>

	<main id="primary" class="mpc-project-detail">

		<div class="mpc-project-detail__container">

			<nav class="mpc-project-detail__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'myportfolio-core' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'myportfolio-core' ); ?></a>
				<span aria-hidden="true">›</span>
				<?php if ( $archive_url ) : ?>
					<a href="<?php echo esc_url( $archive_url ); ?>"><?php esc_html_e( 'Projects', 'myportfolio-core' ); ?></a>
					<span aria-hidden="true">›</span>
				<?php endif; ?>
				<span><?php the_title(); ?></span>
			</nav>

			<section class="mpc-project-detail__hero">

				<div class="mpc-project-detail__hero-copy">

					<?php if ( $primary_category ) : ?>
						<span class="mpc-project-detail__eyebrow"><?php echo esc_html( $primary_category ); ?></span>
					<?php endif; ?>

					<h1 class="mpc-project-detail__title"><?php the_title(); ?></h1>

					<?php if ( has_excerpt() ) : ?>
						<div class="mpc-project-detail__excerpt"><?php the_excerpt(); ?></div>
					<?php endif; ?>

					<?php if ( $technologies ) : ?>
						<div class="mpc-project-detail__tags">
							<?php foreach ( array_slice( $technologies, 0, 5 ) as $technology ) : ?>
								<span><?php echo esc_html( $technology->name ); ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if ( $live_url || $github_url || $case_url ) : ?>
						<div class="mpc-project-detail__actions">
							<?php if ( $live_url ) : ?>
								<a class="mpc-project-detail__button mpc-project-detail__button--primary" href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener noreferrer">
									<?php esc_html_e( 'Live Website', 'myportfolio-core' ); ?><span aria-hidden="true">↗</span>
								</a>
							<?php endif; ?>
							<?php if ( $github_url ) : ?>
								<a class="mpc-project-detail__button" href="<?php echo esc_url( $github_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'GitHub', 'myportfolio-core' ); ?></a>
							<?php endif; ?>
							<?php if ( $case_url ) : ?>
								<a class="mpc-project-detail__button" href="<?php echo esc_url( $case_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Case Study', 'myportfolio-core' ); ?></a>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<div class="mpc-project-detail__meta-card">
						<?php if ( $duration ) : ?>
							<div class="mpc-project-detail__meta-item"><span class="mpc-project-detail__meta-icon" aria-hidden="true">◷</span><small><?php esc_html_e( 'Duration', 'myportfolio-core' ); ?></small><strong><?php echo esc_html( $duration ); ?></strong></div>
						<?php endif; ?>
						<?php if ( $project_type ) : ?>
							<div class="mpc-project-detail__meta-item"><span class="mpc-project-detail__meta-icon" aria-hidden="true">&lt;/&gt;</span><small><?php esc_html_e( 'Type', 'myportfolio-core' ); ?></small><strong><?php echo esc_html( $project_type ); ?></strong></div>
						<?php endif; ?>
						<?php if ( $client ) : ?>
							<div class="mpc-project-detail__meta-item"><span class="mpc-project-detail__meta-icon" aria-hidden="true">◎</span><small><?php esc_html_e( 'Client', 'myportfolio-core' ); ?></small><strong><?php echo esc_html( $client ); ?></strong></div>
						<?php endif; ?>
						<?php if ( $year ) : ?>
							<div class="mpc-project-detail__meta-item"><span class="mpc-project-detail__meta-icon" aria-hidden="true">◉</span><small><?php esc_html_e( 'Year', 'myportfolio-core' ); ?></small><strong><?php echo esc_html( $year ); ?></strong></div>
						<?php endif; ?>
					</div>

				</div>

				<div class="mpc-project-detail__visual">
					<?php if ( $hero_image_id ) : ?>
						<figure class="mpc-project-detail__frame">
							<?php
							echo wp_get_attachment_image(
								$hero_image_id,
								'full',
								false,
								array(
									'class'   => 'mpc-project-detail__hero-image',
									'loading' => 'eager',
									'alt'     => get_the_title(),
								)
							);
							?>
						</figure>
					<?php endif; ?>

					<?php if ( $gallery_ids ) : ?>
						<div class="mpc-project-detail__thumbs">
							<?php foreach ( array_slice( $gallery_ids, 0, 5 ) as $gallery_id ) : ?>
								<?php $full_url = wp_get_attachment_image_url( $gallery_id, 'full' ); ?>
								<?php if ( ! $full_url ) : continue; endif; ?>
								<a href="<?php echo esc_url( $full_url ); ?>" target="_blank" rel="noopener noreferrer">
									<?php echo wp_get_attachment_image( $gallery_id, 'medium', false, array( 'class' => 'mpc-project-detail__thumb-image', 'loading' => 'lazy', 'alt' => '' ) ); ?>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>

			</section>

			<section class="mpc-project-detail__story-card">
				<aside class="mpc-project-detail__story-sidebar">
					<?php if ( $section_links ) : ?>
						<nav class="mpc-project-detail__story-nav" aria-label="<?php esc_attr_e( 'Case study sections', 'myportfolio-core' ); ?>">
							<?php foreach ( $section_links as $section_id => $section_label ) : ?>
								<a href="#<?php echo esc_attr( $section_id ); ?>"><?php echo esc_html( $section_label ); ?></a>
							<?php endforeach; ?>
						</nav>
					<?php endif; ?>

					<?php if ( $pdf_url ) : ?>
						<div class="mpc-project-detail__pdf">
							<span class="mpc-project-detail__pdf-icon" aria-hidden="true">▧</span>
							<div><strong><?php esc_html_e( 'Project Case Study', 'myportfolio-core' ); ?></strong><small><?php echo esc_html( $pdf_filename ?: __( 'PDF document', 'myportfolio-core' ) ); ?></small></div>
							<a href="<?php echo esc_url( $pdf_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Download PDF', 'myportfolio-core' ); ?><span aria-hidden="true">↓</span></a>
						</div>
					<?php endif; ?>
				</aside>

				<div class="mpc-project-detail__story-content">
					<?php if ( trim( get_the_content() ) ) : ?>
						<section id="overview" class="mpc-project-detail__overview">
							<h2><?php esc_html_e( 'Project Overview', 'myportfolio-core' ); ?></h2>
							<div class="mpc-project-detail__prose"><?php the_content(); ?></div>
						</section>
					<?php endif; ?>

					<div class="mpc-project-detail__columns">
						<?php if ( $challenge ) : ?>
							<article id="challenge" class="mpc-project-detail__story-column"><span class="mpc-project-detail__round-icon mpc-project-detail__round-icon--orange" aria-hidden="true">◫</span><h3><?php esc_html_e( 'The Challenge', 'myportfolio-core' ); ?></h3><div class="mpc-project-detail__prose"><?php echo wp_kses_post( wpautop( $challenge ) ); ?></div></article>
						<?php endif; ?>
						<?php if ( $solution ) : ?>
							<article id="solution" class="mpc-project-detail__story-column"><span class="mpc-project-detail__round-icon mpc-project-detail__round-icon--green" aria-hidden="true">◎</span><h3><?php esc_html_e( 'Our Solution', 'myportfolio-core' ); ?></h3><div class="mpc-project-detail__prose"><?php echo wp_kses_post( wpautop( $solution ) ); ?></div></article>
						<?php endif; ?>
						<?php if ( $outcome ) : ?>
							<article id="results" class="mpc-project-detail__story-column"><span class="mpc-project-detail__round-icon mpc-project-detail__round-icon--pink" aria-hidden="true">⌂</span><h3><?php esc_html_e( 'The Outcome', 'myportfolio-core' ); ?></h3><div class="mpc-project-detail__prose"><?php echo wp_kses_post( wpautop( $outcome ) ); ?></div></article>
						<?php endif; ?>
					</div>

					<?php if ( $statistics ) : ?>
						<div class="mpc-project-detail__stats">
							<?php foreach ( $statistics as $statistic ) : ?>
								<?php $value = isset( $statistic['value'] ) ? (string) $statistic['value'] : ''; $label = isset( $statistic['label'] ) ? (string) $statistic['label'] : ''; if ( '' === $value && '' === $label ) : continue; endif; ?>
								<div class="mpc-project-detail__stat"><span class="mpc-project-detail__stat-icon" aria-hidden="true">↗</span><div><strong><?php echo esc_html( $value ); ?></strong><small><?php echo esc_html( $label ); ?></small></div></div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</section>

			<?php if ( $gallery_ids ) : ?>
				<section id="screenshots" class="mpc-project-detail__screenshots">
					<header class="mpc-project-detail__section-header"><h2><?php esc_html_e( 'Project Screenshots', 'myportfolio-core' ); ?></h2></header>
					<div class="mpc-project-detail__screenshot-grid">
						<?php foreach ( $gallery_ids as $gallery_id ) : ?>
							<?php $full_url = wp_get_attachment_image_url( $gallery_id, 'full' ); ?>
							<?php if ( ! $full_url ) : continue; endif; ?>
							<a href="<?php echo esc_url( $full_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo wp_get_attachment_image( $gallery_id, 'large', false, array( 'class' => 'mpc-project-detail__screenshot-image', 'loading' => 'lazy', 'alt' => '' ) ); ?></a>
						<?php endforeach; ?>
					</div>
				</section>
			<?php endif; ?>

			<section class="mpc-project-detail__bottom-grid">
				<?php if ( $technologies ) : ?>
					<article id="technologies" class="mpc-project-detail__bottom-card"><h2><?php esc_html_e( 'Technologies Used', 'myportfolio-core' ); ?></h2><div class="mpc-project-detail__technology-list"><?php foreach ( $technologies as $technology ) : ?><span><?php echo esc_html( $technology->name ); ?></span><?php endforeach; ?></div></article>
				<?php endif; ?>

				<?php if ( $features ) : ?>
					<article id="features" class="mpc-project-detail__bottom-card"><h2><?php esc_html_e( 'Key Features Implemented', 'myportfolio-core' ); ?></h2><ul class="mpc-project-detail__feature-list"><?php foreach ( $features as $feature ) : ?><?php $feature_title = isset( $feature['title'] ) ? (string) $feature['title'] : ''; if ( '' === $feature_title ) : continue; endif; ?><li><span aria-hidden="true">✓</span><?php echo esc_html( $feature_title ); ?></li><?php endforeach; ?></ul></article>
				<?php endif; ?>

				<?php if ( $testimonial_quote ) : ?>
					<article id="testimonial" class="mpc-project-detail__bottom-card mpc-project-detail__testimonial">
						<span class="mpc-project-detail__quote-mark" aria-hidden="true">“</span><blockquote><?php echo esc_html( $testimonial_quote ); ?></blockquote>
						<div class="mpc-project-detail__testimonial-person">
							<?php if ( $testimonial_photo_id ) : ?><?php echo wp_get_attachment_image( $testimonial_photo_id, 'thumbnail', false, array( 'class' => 'mpc-project-detail__testimonial-photo', 'alt' => $testimonial_name ) ); ?><?php endif; ?>
							<div><?php if ( $testimonial_name ) : ?><strong><?php echo esc_html( $testimonial_name ); ?></strong><?php endif; ?><?php if ( $testimonial_position || $testimonial_company ) : ?><small><?php echo esc_html( implode( ', ', array_filter( array( $testimonial_position, $testimonial_company ) ) ) ); ?></small><?php endif; ?></div>
						</div>
						<?php if ( $testimonial_rating ) : ?><div class="mpc-project-detail__stars"><?php echo esc_html( str_repeat( '★', min( 5, $testimonial_rating ) ) ); ?></div><?php endif; ?>
					</article>
				<?php endif; ?>
			</section>

			<?php if ( $video_url ) : ?>
				<section class="mpc-project-detail__video">
					<?php $video_embed = wp_oembed_get( $video_url ); ?>
					<?php if ( $video_embed ) : echo wp_kses_post( $video_embed ); else : ?><a href="<?php echo esc_url( $video_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Watch Project Video', 'myportfolio-core' ); ?></a><?php endif; ?>
				</section>
			<?php endif; ?>

		</div>

		<section class="mpc-project-detail__cta">
			<div class="mpc-project-detail__container">
				<div class="mpc-project-detail__cta-inner">
					<div><span><?php esc_html_e( 'Have a project in mind?', 'myportfolio-core' ); ?></span><h2><?php esc_html_e( 'Let’s build something amazing together!', 'myportfolio-core' ); ?></h2><p><?php esc_html_e( 'I’m open to new opportunities and interesting projects.', 'myportfolio-core' ); ?></p></div>
					<div class="mpc-project-detail__cta-actions"><a class="mpc-project-detail__cta-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Hire Me', 'myportfolio-core' ); ?><span aria-hidden="true">→</span></a><a class="mpc-project-detail__cta-secondary" href="<?php echo esc_url( home_url( '/resume/' ) ); ?>"><?php esc_html_e( 'Download Resume', 'myportfolio-core' ); ?><span aria-hidden="true">↓</span></a></div>
				</div>
			</div>
		</section>

	</main>

<?php endwhile; ?>

<?php get_footer(); ?>
