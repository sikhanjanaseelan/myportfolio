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
	 * Initialise the plugin.
	 *
	 * @return void
	 */
	public function run(): void {

		/*
		 * Load the Projects module.
		 *
		 * This must load in both the WordPress admin and frontend
		 * because projects will later appear on the website.
		 */
		require_once MYPORTFOLIO_CORE_PATH . 'modules/projects/class-projects.php';

		MPC_Projects::init();

		/*
		 * Load admin-only functionality.
		 */
		if ( is_admin() ) {

			$admin_assets = new MyPortfolio_Core_Admin_Assets();
			$admin_assets->register();

			$admin_menu = new MyPortfolio_Core_Admin_Menu();
			$admin_menu->register();
		}
	}
}