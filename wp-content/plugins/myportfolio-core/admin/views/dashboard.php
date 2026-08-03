<?php
/**
 * Dashboard view.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="wrap myportfolio-core-admin">

	<header class="mpc-dashboard-header">

		<div class="mpc-dashboard-header__content">

			<h1 class="mpc-dashboard-title">
				<?php esc_html_e( 'MyPortfolio Core', 'myportfolio-core' ); ?>
			</h1>

			<p class="mpc-dashboard-description">
				<?php
				esc_html_e(
					'Manage your professional portfolio through a modern, modular dashboard.',
					'myportfolio-core'
				);
				?>
			</p>

		</div>

		<div class="mpc-dashboard-version">

			<span class="mpc-version-badge">

				<?php
				echo esc_html(
					sprintf(
						__( 'Version %s', 'myportfolio-core' ),
						MYPORTFOLIO_CORE_VERSION
					)
				);
				?>

			</span>

		</div>

	</header>

	<section class="mpc-dashboard-section">

		<h2>
			<?php esc_html_e( 'Statistics', 'myportfolio-core' ); ?>
		</h2>

		<div class="mpc-dashboard-stats">

			<div class="mpc-stat-card">
				<span class="mpc-stat-card__value">0</span>
				<span class="mpc-stat-card__label">Projects</span>
			</div>

			<div class="mpc-stat-card">
				<span class="mpc-stat-card__value">0</span>
				<span class="mpc-stat-card__label">Experience</span>
			</div>

			<div class="mpc-stat-card">
				<span class="mpc-stat-card__value">0</span>
				<span class="mpc-stat-card__label">Education</span>
			</div>

			<div class="mpc-stat-card">
				<span class="mpc-stat-card__value">0</span>
				<span class="mpc-stat-card__label">Skills</span>
			</div>

		</div>

	</section>

	<section class="mpc-dashboard-grid">

		<div class="mpc-dashboard-card">

			<h3><?php esc_html_e( 'Quick Actions', 'myportfolio-core' ); ?></h3>

			<ul>

				<li>Add Project</li>

				<li>Add Experience</li>

				<li>Add Education</li>

				<li>Settings</li>

			</ul>

		</div>

		<div class="mpc-dashboard-card">

			<h3><?php esc_html_e( 'System Status', 'myportfolio-core' ); ?></h3>

			<ul>

				<li>✔ Plugin Active</li>

				<li>✔ Assets Loaded</li>

				<li>✔ Dashboard Ready</li>

				<li>
					<?php
					echo esc_html(
						sprintf(
							__( 'Version %s', 'myportfolio-core' ),
							MYPORTFOLIO_CORE_VERSION
						)
					);
					?>
				</li>

			</ul>

		</div>

		<div class="mpc-dashboard-card">

			<h3><?php esc_html_e( 'Recent Activity', 'myportfolio-core' ); ?></h3>

			<p>

				<?php esc_html_e( 'No activity yet.', 'myportfolio-core' ); ?>

			</p>

		</div>

	</section>

</div>