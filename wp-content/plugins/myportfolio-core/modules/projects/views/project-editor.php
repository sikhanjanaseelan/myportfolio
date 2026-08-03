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

/*
 * Overview metadata.
 */
$client   = get_post_meta(
	$post->ID,
	'_mpc_project_client',
	true
);

$role = get_post_meta(
	$post->ID,
	'_mpc_project_role',
	true
);

$industry = get_post_meta(
	$post->ID,
	'_mpc_project_industry',
	true
);

$duration = get_post_meta(
	$post->ID,
	'_mpc_project_duration',
	true
);

$year = get_post_meta(
	$post->ID,
	'_mpc_project_year',
	true
);

$status = get_post_meta(
	$post->ID,
	'_mpc_project_status',
	true
);

/*
 * Project links.
 */
$live_url = get_post_meta(
	$post->ID,
	'_mpc_project_live_url',
	true
);

$github_url = get_post_meta(
	$post->ID,
	'_mpc_project_github_url',
	true
);

$case_url = get_post_meta(
	$post->ID,
	'_mpc_project_case_url',
	true
);

/*
 * Display settings.
 */
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
			<span
				class="dashicons dashicons-portfolio"
				aria-hidden="true"
			></span>

			<?php esc_html_e( 'Overview', 'myportfolio-core' ); ?>
		</button>

		<button
			class="mpc-project-tab"
			type="button"
			data-mpc-tab="media"
			aria-selected="false"
			tabindex="-1"
		>
			<span
				class="dashicons dashicons-format-gallery"
				aria-hidden="true"
			></span>

			<?php esc_html_e( 'Media', 'myportfolio-core' ); ?>
		</button>

		<button
			class="mpc-project-tab"
			type="button"
			data-mpc-tab="links"
			aria-selected="false"
			tabindex="-1"
		>
			<span
				class="dashicons dashicons-admin-links"
				aria-hidden="true"
			></span>

			<?php esc_html_e( 'Links', 'myportfolio-core' ); ?>
		</button>

		<button
			class="mpc-project-tab"
			type="button"
			data-mpc-tab="seo"
			aria-selected="false"
			tabindex="-1"
		>
			<span
				class="dashicons dashicons-search"
				aria-hidden="true"
			></span>

			<?php esc_html_e( 'SEO', 'myportfolio-core' ); ?>
		</button>

		<button
			class="mpc-project-tab"
			type="button"
			data-mpc-tab="display"
			aria-selected="false"
			tabindex="-1"
		>
			<span
				class="dashicons dashicons-visibility"
				aria-hidden="true"
			></span>

			<?php esc_html_e( 'Display', 'myportfolio-core' ); ?>
		</button>

	</nav>

	<div class="mpc-project-panels">

		<?php require __DIR__ . '/tab-overview.php'; ?>

		<?php require __DIR__ . '/tab-media.php'; ?>

		<?php require __DIR__ . '/tab-links.php'; ?>

		<?php require __DIR__ . '/tab-seo.php'; ?>

		<?php require __DIR__ . '/tab-display.php'; ?>

	</div>

</div>