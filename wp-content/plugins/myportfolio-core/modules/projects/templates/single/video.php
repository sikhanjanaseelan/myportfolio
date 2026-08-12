<?php
/**
 * Single Project video.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

if ( ! $video_url ) {
	return;
}
?>

<div class="mpc-project-detail__container">

	<section class="mpc-project-detail__video">

		<?php
		$video_embed = wp_oembed_get(
			$video_url
		);

		if ( $video_embed ) {

			echo wp_kses_post(
				$video_embed
			);

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

	</section>

</div>