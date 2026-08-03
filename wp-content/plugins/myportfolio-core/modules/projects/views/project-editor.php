<?php
/**
 * Project editor workspace.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

wp_nonce_field(
	MPC_Project_Meta::NONCE_ACTION,
	MPC_Project_Meta::NONCE_NAME
);

$client      = get_post_meta( $post->ID, '_mpc_project_client', true );
$role        = get_post_meta( $post->ID, '_mpc_project_role', true );
$industry    = get_post_meta( $post->ID, '_mpc_project_industry', true );
$duration    = get_post_meta( $post->ID, '_mpc_project_duration', true );
$year        = get_post_meta( $post->ID, '_mpc_project_year', true );
$status      = get_post_meta( $post->ID, '_mpc_project_status', true );
$live_url    = get_post_meta( $post->ID, '_mpc_project_live_url', true );
$github_url  = get_post_meta( $post->ID, '_mpc_project_github_url', true );
$case_url    = get_post_meta( $post->ID, '_mpc_project_case_url', true );
$is_featured = (bool) get_post_meta(
	$post->ID,
	'_mpc_project_featured',
	true
);
$sort_order = get_post_meta(
	$post->ID,
	'_mpc_project_sort_order',
	true
);

if ( ! $status ) {
	$status = 'completed';
}
?>

<div class="mpc-project-workspace">

	<nav
		class="mpc-project-tabs"
		aria-label="<?php esc_attr_e( 'Project editor sections', 'myportfolio-core' ); ?>"
	>

		<button
			class="mpc-project-tab is-active"
			type="button"
			data-mpc-tab="overview"
			aria-selected="true"
		>
			<span class="dashicons dashicons-portfolio"></span>
			<?php esc_html_e( 'Overview', 'myportfolio-core' ); ?>
		</button>

		<button
			class="mpc-project-tab"
			type="button"
			data-mpc-tab="media"
			aria-selected="false"
		>
			<span class="dashicons dashicons-format-gallery"></span>
			<?php esc_html_e( 'Media', 'myportfolio-core' ); ?>
		</button>

		<button
			class="mpc-project-tab"
			type="button"
			data-mpc-tab="links"
			aria-selected="false"
		>
			<span class="dashicons dashicons-admin-links"></span>
			<?php esc_html_e( 'Links', 'myportfolio-core' ); ?>
		</button>

		<button
			class="mpc-project-tab"
			type="button"
			data-mpc-tab="seo"
			aria-selected="false"
		>
			<span class="dashicons dashicons-search"></span>
			<?php esc_html_e( 'SEO', 'myportfolio-core' ); ?>
		</button>

		<button
			class="mpc-project-tab"
			type="button"
			data-mpc-tab="display"
			aria-selected="false"
		>
			<span class="dashicons dashicons-visibility"></span>
			<?php esc_html_e( 'Display', 'myportfolio-core' ); ?>
		</button>

	</nav>

	<div class="mpc-project-panels">

		<section
			class="mpc-project-panel is-active"
			data-mpc-panel="overview"
		>

			<header class="mpc-project-panel__header">
				<h3><?php esc_html_e( 'Project Overview', 'myportfolio-core' ); ?></h3>
				<p>
					<?php esc_html_e( 'Add the core professional details for this project.', 'myportfolio-core' ); ?>
				</p>
			</header>

			<div class="mpc-form-grid">

				<div class="mpc-form-field">
					<label class="mpc-form-label" for="mpc-project-client">
						<?php esc_html_e( 'Client', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-client"
						class="mpc-input"
						type="text"
						name="mpc_project_client"
						value="<?php echo esc_attr( $client ); ?>"
					>
				</div>

				<div class="mpc-form-field">
					<label class="mpc-form-label" for="mpc-project-role">
						<?php esc_html_e( 'Your Role', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-role"
						class="mpc-input"
						type="text"
						name="mpc_project_role"
						value="<?php echo esc_attr( $role ); ?>"
					>
				</div>

				<div class="mpc-form-field">
					<label class="mpc-form-label" for="mpc-project-industry">
						<?php esc_html_e( 'Industry', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-industry"
						class="mpc-input"
						type="text"
						name="mpc_project_industry"
						value="<?php echo esc_attr( $industry ); ?>"
					>
				</div>

				<div class="mpc-form-field">
					<label class="mpc-form-label" for="mpc-project-duration">
						<?php esc_html_e( 'Duration', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-duration"
						class="mpc-input"
						type="text"
						name="mpc_project_duration"
						value="<?php echo esc_attr( $duration ); ?>"
					>
				</div>

				<div class="mpc-form-field">
					<label class="mpc-form-label" for="mpc-project-year">
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
					>
				</div>

				<div class="mpc-form-field">
					<label class="mpc-form-label" for="mpc-project-status">
						<?php esc_html_e( 'Status', 'myportfolio-core' ); ?>
					</label>

					<select
						id="mpc-project-status"
						class="mpc-select"
						name="mpc_project_status"
					>
						<option value="completed" <?php selected( $status, 'completed' ); ?>>
							<?php esc_html_e( 'Completed', 'myportfolio-core' ); ?>
						</option>

						<option value="in-progress" <?php selected( $status, 'in-progress' ); ?>>
							<?php esc_html_e( 'In Progress', 'myportfolio-core' ); ?>
						</option>

						<option value="maintenance" <?php selected( $status, 'maintenance' ); ?>>
							<?php esc_html_e( 'Maintenance', 'myportfolio-core' ); ?>
						</option>

						<option value="archived" <?php selected( $status, 'archived' ); ?>>
							<?php esc_html_e( 'Archived', 'myportfolio-core' ); ?>
						</option>
					</select>
				</div>

			</div>

		</section>

		<section
			class="mpc-project-panel"
			data-mpc-panel="media"
			hidden
		>
			<header class="mpc-project-panel__header">
				<h3><?php esc_html_e( 'Project Media', 'myportfolio-core' ); ?></h3>
				<p><?php esc_html_e( 'Gallery controls will be added in the next step.', 'myportfolio-core' ); ?></p>
			</header>
		</section>

		<section
			class="mpc-project-panel"
			data-mpc-panel="links"
			hidden
		>
			<header class="mpc-project-panel__header">
				<h3><?php esc_html_e( 'Project Links', 'myportfolio-core' ); ?></h3>
			</header>

			<div class="mpc-form-grid">

				<div class="mpc-form-field mpc-form-field--full">
					<label class="mpc-form-label" for="mpc-project-live-url">
						<?php esc_html_e( 'Live URL', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-live-url"
						class="mpc-input"
						type="url"
						name="mpc_project_live_url"
						value="<?php echo esc_url( $live_url ); ?>"
					>
				</div>

				<div class="mpc-form-field">
					<label class="mpc-form-label" for="mpc-project-github-url">
						<?php esc_html_e( 'GitHub URL', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-github-url"
						class="mpc-input"
						type="url"
						name="mpc_project_github_url"
						value="<?php echo esc_url( $github_url ); ?>"
					>
				</div>

				<div class="mpc-form-field">
					<label class="mpc-form-label" for="mpc-project-case-url">
						<?php esc_html_e( 'Case Study URL', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-case-url"
						class="mpc-input"
						type="url"
						name="mpc_project_case_url"
						value="<?php echo esc_url( $case_url ); ?>"
					>
				</div>

			</div>
		</section>

		<section
			class="mpc-project-panel"
			data-mpc-panel="seo"
			hidden
		>
			<header class="mpc-project-panel__header">
				<h3><?php esc_html_e( 'SEO', 'myportfolio-core' ); ?></h3>
				<p><?php esc_html_e( 'SEO fields will be added after the media manager.', 'myportfolio-core' ); ?></p>
			</header>
		</section>

		<section
			class="mpc-project-panel"
			data-mpc-panel="display"
			hidden
		>
			<header class="mpc-project-panel__header">
				<h3><?php esc_html_e( 'Display Settings', 'myportfolio-core' ); ?></h3>
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

						<span class="mpc-switch__control"></span>

						<span class="mpc-switch__text">
							<?php esc_html_e( 'Featured Project', 'myportfolio-core' ); ?>
						</span>
					</label>
				</div>

				<div class="mpc-form-field">
					<label class="mpc-form-label" for="mpc-project-sort-order">
						<?php esc_html_e( 'Display Order', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-sort-order"
						class="mpc-input"
						type="number"
						name="mpc_project_sort_order"
						value="<?php echo esc_attr( $sort_order ); ?>"
						min="0"
					>
				</div>

			</div>
		</section>

	</div>

</div>