<?php
/**
 * Projects module bootstrap.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Initialises the Projects module.
 */
final class MPC_Projects {

	/**
	 * Initialise the module.
	 *
	 * @return void
	 */
	public static function init(): void {

		self::includes();

		add_filter(
			'template_include',
			array( __CLASS__, 'load_project_template' )
		);

		add_action(
			'wp_enqueue_scripts',
			array( __CLASS__, 'enqueue_public_assets' )
		);
	}

	/**
	 * Load Project module classes.
	 *
	 * @return void
	 */
	private static function includes(): void {

		require_once __DIR__ . '/class-project-cpt.php';
		require_once __DIR__ . '/class-project-taxonomies.php';
		require_once __DIR__ . '/class-project-meta.php';
		require_once __DIR__ . '/class-project-save.php';
		require_once __DIR__ . '/class-project-columns.php';
		require_once __DIR__ . '/class-project-admin.php';
		require_once __DIR__ . '/class-project-assets.php';

		MPC_Project_CPT::init();
		MPC_Project_Taxonomies::init();
		MPC_Project_Meta::init();
		MPC_Project_Save::init();
		MPC_Project_Columns::init();
		MPC_Project_Admin::init();
		MPC_Project_Assets::init();
	}

	/**
	 * Load frontend Project templates.
	 *
	 * The active theme can override these by creating:
	 *
	 * myportfolio-core/archive-project.php
	 * myportfolio-core/single-project.php
	 *
	 * @param string $template Current WordPress template.
	 * @return string
	 */
	public static function load_project_template(
		string $template
	): string {

		if (
			is_post_type_archive(
				MPC_Project_CPT::POST_TYPE
			)
		) {

			$theme_template = locate_template(
				'myportfolio-core/archive-project.php'
			);

			if ( $theme_template ) {
				return $theme_template;
			}

			$plugin_template = __DIR__
				. '/templates/archive-project.php';

			if ( file_exists( $plugin_template ) ) {
				return $plugin_template;
			}
		}

		if (
			is_singular(
				MPC_Project_CPT::POST_TYPE
			)
		) {

			$theme_template = locate_template(
				'myportfolio-core/single-project.php'
			);

			if ( $theme_template ) {
				return $theme_template;
			}

			$plugin_template = __DIR__
				. '/templates/single-project.php';

			if ( file_exists( $plugin_template ) ) {
				return $plugin_template;
			}
		}

		return $template;
	}

	/**
	 * Load Project frontend assets.
	 *
	 * @return void
	 */
	public static function enqueue_public_assets(): void {

		if (
			! is_post_type_archive(
				MPC_Project_CPT::POST_TYPE
			)
			&& ! is_singular(
				MPC_Project_CPT::POST_TYPE
			)
		) {
			return;
		}

		self::enqueue_style(
			'myportfolio-core-projects',
			'public/assets/css/projects.css'
		);

		if (
			! is_singular(
				MPC_Project_CPT::POST_TYPE
			)
		) {
			return;
		}

		$single_styles = array(
			'base',
			'hero',
			'story',
			'screenshots',
			'details',
			'slider',
			'similar-projects',
			'cta',
			'responsive',
		);

		$dependency = 'myportfolio-core-projects';

		foreach ( $single_styles as $style_name ) {

			$handle = 'myportfolio-core-project-'
				. $style_name;

			self::enqueue_style(
				$handle,
				'public/assets/css/single-project/'
					. $style_name
					. '.css',
				array( $dependency )
			);

			$dependency = $handle;
		}

		$js_file = MYPORTFOLIO_CORE_PATH
			. 'public/assets/js/single-project.js';

		wp_enqueue_script(
			'myportfolio-core-single-project',
			MYPORTFOLIO_CORE_URL
				. 'public/assets/js/single-project.js',
			array(),
			file_exists( $js_file )
				? (string) filemtime( $js_file )
				: MYPORTFOLIO_CORE_VERSION,
			true
		);
	}

	/**
	 * Enqueue one plugin stylesheet.
	 *
	 * @param string        $handle        WordPress style handle.
	 * @param string        $relative_path File path relative to plugin root.
	 * @param array<string> $dependencies  Style dependencies.
	 * @return void
	 */
	private static function enqueue_style(
		string $handle,
		string $relative_path,
		array $dependencies = array()
	): void {

		$file_path = MYPORTFOLIO_CORE_PATH
			. $relative_path;

		wp_enqueue_style(
			$handle,
			MYPORTFOLIO_CORE_URL
				. $relative_path,
			$dependencies,
			file_exists( $file_path )
				? (string) filemtime( $file_path )
				: MYPORTFOLIO_CORE_VERSION
		);
	}
}