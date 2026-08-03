<?php
/**
 * Dashboard view.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="wrap myportfolio-core-admin">

	<div class="mpc-dashboard">

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
					printf(
						esc_html__( 'Version %s', 'myportfolio-core' ),
						esc_html( MYPORTFOLIO_CORE_VERSION )
					);
					?>
				</span>

			</div>

		</header>

		<section class="mpc-dashboard-section">

			<div class="mpc-cluster mpc-cluster--between">

				<h2 class="mpc-section-title">
					<?php esc_html_e( 'Portfolio Overview', 'myportfolio-core' ); ?>
				</h2>

				<span class="mpc-badge mpc-badge--primary">
					<?php esc_html_e( 'Dashboard', 'myportfolio-core' ); ?>
				</span>

			</div>

			<div class="mpc-overview-grid">

				<article class="mpc-stat-card">

					<div class="mpc-stat-card__top">

						<div>
							<span class="mpc-stat-card__value">0</span>

							<span class="mpc-stat-card__label">
								<?php esc_html_e( 'Projects', 'myportfolio-core' ); ?>
							</span>
						</div>

						<span class="mpc-stat-card__icon" aria-hidden="true">
							<span class="dashicons dashicons-portfolio"></span>
						</span>

					</div>

					<span class="mpc-stat-card__meta">
						<?php esc_html_e( 'Portfolio projects', 'myportfolio-core' ); ?>
					</span>

				</article>

				<article class="mpc-stat-card">

					<div class="mpc-stat-card__top">

						<div>
							<span class="mpc-stat-card__value">0</span>

							<span class="mpc-stat-card__label">
								<?php esc_html_e( 'Experience', 'myportfolio-core' ); ?>
							</span>
						</div>

						<span class="mpc-stat-card__icon" aria-hidden="true">
							<span class="dashicons dashicons-businessperson"></span>
						</span>

					</div>

					<span class="mpc-stat-card__meta">
						<?php esc_html_e( 'Professional roles', 'myportfolio-core' ); ?>
					</span>

				</article>

				<article class="mpc-stat-card">

					<div class="mpc-stat-card__top">

						<div>
							<span class="mpc-stat-card__value">0</span>

							<span class="mpc-stat-card__label">
								<?php esc_html_e( 'Education', 'myportfolio-core' ); ?>
							</span>
						</div>

						<span class="mpc-stat-card__icon" aria-hidden="true">
							<span class="dashicons dashicons-welcome-learn-more"></span>
						</span>

					</div>

					<span class="mpc-stat-card__meta">
						<?php esc_html_e( 'Academic records', 'myportfolio-core' ); ?>
					</span>

				</article>

				<article class="mpc-stat-card">

					<div class="mpc-stat-card__top">

						<div>
							<span class="mpc-stat-card__value">0</span>

							<span class="mpc-stat-card__label">
								<?php esc_html_e( 'Skills', 'myportfolio-core' ); ?>
							</span>
						</div>

						<span class="mpc-stat-card__icon" aria-hidden="true">
							<span class="dashicons dashicons-admin-tools"></span>
						</span>

					</div>

					<span class="mpc-stat-card__meta">
						<?php esc_html_e( 'Technical capabilities', 'myportfolio-core' ); ?>
					</span>

				</article>

			</div>

		</section>

		<section class="mpc-dashboard-content">

			<div class="mpc-stack">

				<article class="mpc-card">

					<header class="mpc-card__header">

						<div class="mpc-card__heading">

							<h2 class="mpc-card__title">
								<?php esc_html_e( 'Quick Actions', 'myportfolio-core' ); ?>
							</h2>

							<p class="mpc-card__description">
								<?php
								esc_html_e(
									'Create and manage portfolio content.',
									'myportfolio-core'
								);
								?>
							</p>

						</div>

					</header>

					<div class="mpc-card__body">

						<div class="mpc-dashboard-actions">

							<a
								class="mpc-button mpc-button--primary"
								href="<?php echo esc_url( admin_url( 'post-new.php?post_type=portfolio_project' ) ); ?>"
							>
								<span class="dashicons dashicons-plus-alt2" aria-hidden="true"></span>

								<?php esc_html_e( 'Add New Project', 'myportfolio-core' ); ?>
							</a>

							<button class="mpc-button mpc-button--secondary" type="button" disabled>
								<span class="dashicons dashicons-businessperson" aria-hidden="true"></span>

								<?php esc_html_e( 'Add Experience', 'myportfolio-core' ); ?>
							</button>

							<button class="mpc-button mpc-button--secondary" type="button" disabled>
								<span class="dashicons dashicons-welcome-learn-more" aria-hidden="true"></span>

								<?php esc_html_e( 'Add Education', 'myportfolio-core' ); ?>
							</button>

							<button class="mpc-button mpc-button--secondary" type="button" disabled>
								<span class="dashicons dashicons-admin-settings" aria-hidden="true"></span>

								<?php esc_html_e( 'Open Settings', 'myportfolio-core' ); ?>
							</button>

						</div>

					</div>

				</article>

				<article class="mpc-card">

					<header class="mpc-card__header">

						<div class="mpc-card__heading">

							<h2 class="mpc-card__title">
								<?php esc_html_e( 'Recent Activity', 'myportfolio-core' ); ?>
							</h2>

						</div>

					</header>

					<div class="mpc-card__body">

						<div class="mpc-empty-state mpc-empty-state--compact">

							<span class="mpc-empty-state__icon" aria-hidden="true">
								<span class="dashicons dashicons-clock"></span>
							</span>

							<h3 class="mpc-empty-state__title">
								<?php esc_html_e( 'No activity yet', 'myportfolio-core' ); ?>
							</h3>

							<p class="mpc-empty-state__description">
								<?php
								esc_html_e(
									'Your latest portfolio updates will appear here.',
									'myportfolio-core'
								);
								?>
							</p>

						</div>

					</div>

				</article>

			</div>

			<aside class="mpc-stack">

				<article class="mpc-card">

					<header class="mpc-card__header">

						<div class="mpc-card__heading">

							<h2 class="mpc-card__title">
								<?php esc_html_e( 'System Status', 'myportfolio-core' ); ?>
							</h2>

						</div>

						<span class="mpc-badge mpc-badge--success">
							<?php esc_html_e( 'Healthy', 'myportfolio-core' ); ?>
						</span>

					</header>

					<div class="mpc-card__body">

						<ul class="mpc-status-list">

							<li class="mpc-status-item">
								<span class="mpc-status-label">
									<?php esc_html_e( 'Plugin', 'myportfolio-core' ); ?>
								</span>

								<span class="mpc-badge mpc-badge--success">
									<?php esc_html_e( 'Active', 'myportfolio-core' ); ?>
								</span>
							</li>

							<li class="mpc-status-item">
								<span class="mpc-status-label">
									<?php esc_html_e( 'Admin Assets', 'myportfolio-core' ); ?>
								</span>

								<span class="mpc-badge mpc-badge--success">
									<?php esc_html_e( 'Loaded', 'myportfolio-core' ); ?>
								</span>
							</li>

							<li class="mpc-status-item">
								<span class="mpc-status-label">
									<?php esc_html_e( 'Dashboard', 'myportfolio-core' ); ?>
								</span>

								<span class="mpc-badge mpc-badge--success">
									<?php esc_html_e( 'Ready', 'myportfolio-core' ); ?>
								</span>
							</li>

							<li class="mpc-status-item">
								<span class="mpc-status-label">
									<?php esc_html_e( 'Version', 'myportfolio-core' ); ?>
								</span>

								<span class="mpc-status-value">
									<?php echo esc_html( MYPORTFOLIO_CORE_VERSION ); ?>
								</span>
							</li>

						</ul>

					</div>

				</article>

				<article class="mpc-card mpc-card--primary">

					<h2 class="mpc-card__title">
						<?php esc_html_e( 'Next Milestone', 'myportfolio-core' ); ?>
					</h2>

					<p class="mpc-card__description">
						<?php
						esc_html_e(
							'Complete the Projects module and connect it to the portfolio homepage.',
							'myportfolio-core'
						);
						?>
					</p>

				</article>

			</aside>

		</section>

	</div>

</div>