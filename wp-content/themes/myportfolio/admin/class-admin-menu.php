<?php
/**
 * Admin menu.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers the MyPortfolio Core admin menu.
 */
final class MyPortfolio_Core_Admin_Menu {

	/**
	 * Register hooks.
	 *
	 * @return void
	 */
	public function register(): void {
		add_action( 'admin_menu', array( $this, 'register_menu' ) );
	}

	/**
	 * Register plugin menu.
	 *
	 * @return void
	 */
	public function register_menu(): void {

		add_menu_page(
			__( 'MyPortfolio Core', 'myportfolio-core' ),
			__( 'MyPortfolio Core', 'myportfolio-core' ),
			'manage_options',
			'myportfolio-core',
			array( $this, 'dashboard_page' ),
			'dashicons-layout',
			25
		);
	}

	/**
 * Dashboard page callback.
 *
 * @return void
 */
public function dashboard_page(): void {

	$dashboard = new MyPortfolio_Core_Dashboard();
	$dashboard->render();

}
}