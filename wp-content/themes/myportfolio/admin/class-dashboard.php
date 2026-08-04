<?php
/**
 * Admin dashboard renderer.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Renders the MyPortfolio Core dashboard.
 */
final class MyPortfolio_Core_Dashboard {

	/**
	 * Render the dashboard page.
	 *
	 * @return void
	 */
	public function render(): void {

		$view_path = MYPORTFOLIO_CORE_PATH . 'admin/views/dashboard.php';

		if ( ! file_exists( $view_path ) ) {
			wp_die(
				esc_html__(
					'The MyPortfolio Core dashboard view could not be found.',
					'myportfolio-core'
				)
			);
		}

		require $view_path;
	}
}