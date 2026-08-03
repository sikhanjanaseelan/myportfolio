<?php
/**
 * Project editor SEO tab.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;
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
				'Control how this project appears in search engines and social previews.',
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
			<span class="dashicons dashicons-search"></span>
		</span>

		<h4 class="mpc-empty-state__title">
			<?php esc_html_e( 'SEO fields coming soon', 'myportfolio-core' ); ?>
		</h4>

		<p class="mpc-empty-state__description">
			<?php
			esc_html_e(
				'Meta title, meta description and social-image settings will be added after the media manager.',
				'myportfolio-core'
			);
			?>
		</p>

	</div>

</section>