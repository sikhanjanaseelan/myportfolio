<?php
/**
 * Plugin deactivator.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Handles plugin deactivation.
 */
final class MyPortfolio_Core_Deactivator {

	/**
	 * Run deactivation tasks.
	 *
	 * @return void
	 */
	public static function deactivate(): void {

		/*
		 * Future tasks:
		 *
		 * - Clear scheduled events.
		 * - Flush rewrite rules.
		 */

		flush_rewrite_rules();
	}
}