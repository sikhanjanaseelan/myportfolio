<?php
/**
 * Plugin activator.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Handles plugin activation.
 */
final class MyPortfolio_Core_Activator {

	/**
	 * Run activation tasks.
	 *
	 * @return void
	 */
	public static function activate(): void {

		/*
		 * Future tasks:
		 *
		 * - Create default options.
		 * - Flush rewrite rules.
		 * - Run database migrations.
		 */

		flush_rewrite_rules();
	}
}