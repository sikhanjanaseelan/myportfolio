<?php
/**
 * Project editor Media tab.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;
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
				'Manage project images, screenshots, gallery items and video content.',
				'myportfolio-core'
			);
			?>
		</p>

	</header>

	<div class="mpc-empty-state mpc-empty-state--compact">

		<span
			class="mpc-empty-state__icon"
			aria-hidden="true"
		>
			<span class="dashicons dashicons-format-gallery"></span>
		</span>

		<h4 class="mpc-empty-state__title">
			<?php esc_html_e( 'Media manager coming next', 'myportfolio-core' ); ?>
		</h4>

		<p class="mpc-empty-state__description">
			<?php
			esc_html_e(
				'The next step will add gallery selection, previews, ordering and image removal.',
				'myportfolio-core'
			);
			?>
		</p>

	</div>

</section>