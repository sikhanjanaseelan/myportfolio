<?php
/**
 * Project editor Links tab.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;
?>

<section
	class="mpc-project-panel"
	data-mpc-panel="links"
	hidden
>

	<header class="mpc-project-panel__header">

		<h3>
			<?php esc_html_e( 'Project Links', 'myportfolio-core' ); ?>
		</h3>

		<p>
			<?php
			esc_html_e(
				'Connect the project to its live website, source code and external case study.',
				'myportfolio-core'
			);
			?>
		</p>

	</header>

	<div class="mpc-form-grid">

		<div class="mpc-form-field mpc-form-field--full">

			<label
				class="mpc-form-label"
				for="mpc-project-live-url"
			>
				<?php esc_html_e( 'Live Project URL', 'myportfolio-core' ); ?>
			</label>

			<input
				id="mpc-project-live-url"
				class="mpc-input"
				type="url"
				name="mpc_project_live_url"
				value="<?php echo esc_url( $live_url ); ?>"
				placeholder="https://example.com"
			>

		</div>

		<div class="mpc-form-field">

			<label
				class="mpc-form-label"
				for="mpc-project-github-url"
			>
				<?php esc_html_e( 'GitHub URL', 'myportfolio-core' ); ?>
			</label>

			<input
				id="mpc-project-github-url"
				class="mpc-input"
				type="url"
				name="mpc_project_github_url"
				value="<?php echo esc_url( $github_url ); ?>"
				placeholder="https://github.com/username/project"
			>

		</div>

		<div class="mpc-form-field">

			<label
				class="mpc-form-label"
				for="mpc-project-case-url"
			>
				<?php esc_html_e( 'External Case Study URL', 'myportfolio-core' ); ?>
			</label>

			<input
				id="mpc-project-case-url"
				class="mpc-input"
				type="url"
				name="mpc_project_case_url"
				value="<?php echo esc_url( $case_url ); ?>"
				placeholder="https://example.com/case-study"
			>

			<p class="mpc-form-description">
				<?php
				esc_html_e(
					'Leave this empty to use the WordPress single-project page.',
					'myportfolio-core'
				);
				?>
			</p>

		</div>

	</div>

</section>