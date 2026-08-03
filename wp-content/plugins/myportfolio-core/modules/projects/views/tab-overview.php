<?php
/**
 * Project editor Overview tab.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;
?>

<section
	class="mpc-project-panel is-active"
	data-mpc-panel="overview"
>

	<header class="mpc-project-panel__header">

		<h3>
			<?php esc_html_e( 'Project Overview', 'myportfolio-core' ); ?>
		</h3>

		<p>
			<?php
			esc_html_e(
				'Add the main professional and delivery details for this project.',
				'myportfolio-core'
			);
			?>
		</p>

	</header>

	<div class="mpc-form-grid">

		<div class="mpc-form-field">

			<label
				class="mpc-form-label"
				for="mpc-project-client"
			>
				<?php esc_html_e( 'Client', 'myportfolio-core' ); ?>
			</label>

			<input
				id="mpc-project-client"
				class="mpc-input"
				type="text"
				name="mpc_project_client"
				value="<?php echo esc_attr( $client ); ?>"
				placeholder="<?php esc_attr_e( 'Client or organisation name', 'myportfolio-core' ); ?>"
			>

		</div>

		<div class="mpc-form-field">

			<label
				class="mpc-form-label"
				for="mpc-project-role"
			>
				<?php esc_html_e( 'Your Role', 'myportfolio-core' ); ?>
			</label>

			<input
				id="mpc-project-role"
				class="mpc-input"
				type="text"
				name="mpc_project_role"
				value="<?php echo esc_attr( $role ); ?>"
				placeholder="<?php esc_attr_e( 'WordPress Developer', 'myportfolio-core' ); ?>"
			>

		</div>

		<div class="mpc-form-field">

			<label
				class="mpc-form-label"
				for="mpc-project-industry"
			>
				<?php esc_html_e( 'Industry', 'myportfolio-core' ); ?>
			</label>

			<input
				id="mpc-project-industry"
				class="mpc-input"
				type="text"
				name="mpc_project_industry"
				value="<?php echo esc_attr( $industry ); ?>"
				placeholder="<?php esc_attr_e( 'Healthcare, Education, E-commerce...', 'myportfolio-core' ); ?>"
			>

		</div>

		<div class="mpc-form-field">

			<label
				class="mpc-form-label"
				for="mpc-project-duration"
			>
				<?php esc_html_e( 'Duration', 'myportfolio-core' ); ?>
			</label>

			<input
				id="mpc-project-duration"
				class="mpc-input"
				type="text"
				name="mpc_project_duration"
				value="<?php echo esc_attr( $duration ); ?>"
				placeholder="<?php esc_attr_e( '6 weeks', 'myportfolio-core' ); ?>"
			>

		</div>

		<div class="mpc-form-field">

			<label
				class="mpc-form-label"
				for="mpc-project-year"
			>
				<?php esc_html_e( 'Project Year', 'myportfolio-core' ); ?>
			</label>

			<input
				id="mpc-project-year"
				class="mpc-input"
				type="number"
				name="mpc_project_year"
				value="<?php echo esc_attr( $year ); ?>"
				min="2000"
				max="2100"
				step="1"
				placeholder="<?php echo esc_attr( gmdate( 'Y' ) ); ?>"
			>

		</div>

		<div class="mpc-form-field">

			<label
				class="mpc-form-label"
				for="mpc-project-status"
			>
				<?php esc_html_e( 'Project Status', 'myportfolio-core' ); ?>
			</label>

			<select
				id="mpc-project-status"
				class="mpc-select"
				name="mpc_project_status"
			>

				<option
					value="completed"
					<?php selected( $status, 'completed' ); ?>
				>
					<?php esc_html_e( 'Completed', 'myportfolio-core' ); ?>
				</option>

				<option
					value="in-progress"
					<?php selected( $status, 'in-progress' ); ?>
				>
					<?php esc_html_e( 'In Progress', 'myportfolio-core' ); ?>
				</option>

				<option
					value="maintenance"
					<?php selected( $status, 'maintenance' ); ?>
				>
					<?php esc_html_e( 'Maintenance', 'myportfolio-core' ); ?>
				</option>

				<option
					value="archived"
					<?php selected( $status, 'archived' ); ?>
				>
					<?php esc_html_e( 'Archived', 'myportfolio-core' ); ?>
				</option>

			</select>

		</div>

	</div>

</section>