<?php
/**
 * Project editor Display tab.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;
?>

<section
	class="mpc-project-panel"
	data-mpc-panel="display"
	hidden
>

	<header class="mpc-project-panel__header">

		<h3>
			<?php esc_html_e( 'Display Settings', 'myportfolio-core' ); ?>
		</h3>

		<p>
			<?php
			esc_html_e(
				'Control whether this project is featured and how it is ordered on the frontend.',
				'myportfolio-core'
			);
			?>
		</p>

	</header>

	<div class="mpc-form-grid">

		<div class="mpc-form-field">

			<label class="mpc-switch">

				<input
					class="mpc-switch__input"
					type="checkbox"
					name="mpc_project_featured"
					value="1"
					<?php checked( $is_featured ); ?>
				>

				<span
					class="mpc-switch__control"
					aria-hidden="true"
				></span>

				<span class="mpc-switch__text">
					<?php esc_html_e( 'Featured Project', 'myportfolio-core' ); ?>
				</span>

			</label>

			<p class="mpc-form-description">
				<?php
				esc_html_e(
					'Show this project in the homepage Featured Projects section.',
					'myportfolio-core'
				);
				?>
			</p>

		</div>

		<div class="mpc-form-field">

			<label
				class="mpc-form-label"
				for="mpc-project-sort-order"
			>
				<?php esc_html_e( 'Display Order', 'myportfolio-core' ); ?>
			</label>

			<input
				id="mpc-project-sort-order"
				class="mpc-input"
				type="number"
				name="mpc_project_sort_order"
				value="<?php echo esc_attr( $sort_order ); ?>"
				min="0"
				step="1"
				placeholder="0"
			>

			<p class="mpc-form-description">
				<?php
				esc_html_e(
					'Projects with lower numbers appear first.',
					'myportfolio-core'
				);
				?>
			</p>

		</div>

	</div>

</section>