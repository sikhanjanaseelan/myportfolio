<?php
/**
 * Plugin class autoloader.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Loads MyPortfolio Core classes automatically.
 */
final class MyPortfolio_Core_Autoloader {

	/**
	 * Register the autoloader.
	 *
	 * @return void
	 */
	public static function register(): void {
		spl_autoload_register( array( __CLASS__, 'autoload' ) );
	}

	/**
	 * Load a matching plugin class.
	 *
	 * @param string $class_name Requested class name.
	 * @return void
	 */
	public static function autoload( string $class_name ): void {

		if ( 0 !== strpos( $class_name, 'MyPortfolio_Core_' ) ) {
			return;
		}

		$file_name = strtolower(
			str_replace(
				array( 'MyPortfolio_Core_', '_' ),
				array( '', '-' ),
				$class_name
			)
		);

		$possible_files = array(
			MYPORTFOLIO_CORE_PATH . 'includes/class-' . $file_name . '.php',
			MYPORTFOLIO_CORE_PATH . 'admin/class-' . $file_name . '.php',
			MYPORTFOLIO_CORE_PATH . 'public/class-' . $file_name . '.php',
		);

		foreach ( $possible_files as $file_path ) {
			if ( file_exists( $file_path ) ) {
				require_once $file_path;
				return;
			}
		}
	}
}

MyPortfolio_Core_Autoloader::register();