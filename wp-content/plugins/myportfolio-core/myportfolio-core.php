<?php
/**
 * Plugin Name: MyPortfolio Core
 * Plugin URI:  https://example.com/
 * Description: Core portfolio functionality for projects, experience, education, skills, testimonials, settings, and reusable admin tools.
 * Version:     0.1.0
 * Author:      Sikha Njanaseelan
 * Text Domain: myportfolio-core
 * Domain Path: /languages
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/*
 * Plugin constants.
 */
define( 'MYPORTFOLIO_CORE_VERSION', '0.1.0' );
define( 'MYPORTFOLIO_CORE_FILE', __FILE__ );
define( 'MYPORTFOLIO_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'MYPORTFOLIO_CORE_URL', plugin_dir_url( __FILE__ ) );
define( 'MYPORTFOLIO_CORE_BASENAME', plugin_basename( __FILE__ ) );

/*
 * Load the plugin autoloader.
 */
require_once MYPORTFOLIO_CORE_PATH . 'includes/class-autoloader.php';

/*
 * Register activation and deactivation hooks.
 */
register_activation_hook(
	MYPORTFOLIO_CORE_FILE,
	array( 'MyPortfolio_Core_Activator', 'activate' )
);

register_deactivation_hook(
	MYPORTFOLIO_CORE_FILE,
	array( 'MyPortfolio_Core_Deactivator', 'deactivate' )
);

/**
 * Start the plugin.
 *
 * @return void
 */
function myportfolio_core_run(): void {

	$plugin = new MyPortfolio_Core_Plugin();
	$plugin->run();
}

myportfolio_core_run();