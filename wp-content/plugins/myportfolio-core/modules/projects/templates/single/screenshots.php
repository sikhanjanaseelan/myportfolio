<?php
/**
 * Single Project screenshots.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

if ( ! $gallery_ids ) {
	return;
}
?>

<div class="mpc-project-detail__container">

	<section
		id="screenshots"
		class="mpc-project-detail__screenshots"
	>

		<header class="mpc-project-detail__section-header">

			<h2>
				<?php esc_html_e( 'Project Screenshots', 'myportfolio-core' ); ?>
			</h2>

		</header>

		<div class="mpc-project-detail__screenshot-grid">

			<?php foreach ( $gallery_ids as $gallery_id ) : ?>

				<?php
				$full_url = wp_get_attachment_image_url(
					$gallery_id,
					'full'
				);

				if ( ! $full_url ) {
					continue;
				}
				?>

				<a
					href="<?php echo esc_url( $full_url ); ?>"
					target="_blank"
					rel="noopener noreferrer"
				>

					<?php
					echo wp_get_attachment_image(
						$gallery_id,
						'large',
						false,
						array(
							'class'   => 'mpc-project-detail__screenshot-image',
							'loading' => 'lazy',
							'alt'     => '',
						)
					);
					?>

				</a>

			<?php endforeach; ?>

		</div>

	</section>

</div>