<?php
/**
 * Core plugin loader.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main plugin class.
 */
final class MyPortfolio_Core_Plugin {

	/**
	 * Initialise plugin.
	 *
	 * @return void
	 */
	public function run(): void {

		if ( is_admin() ) {
			$admin_assets = new MyPortfolio_Core_Admin_Assets();
			$admin_assets->register();
		}
	}
}