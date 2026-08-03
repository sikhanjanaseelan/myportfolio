<?php
/**
 * Project admin assets.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Loads Project module admin assets.
 */
final class MPC_Project_Assets {

	/**
	 * Register WordPress hooks.
	 *
	 * @return void
	 */
	public static function init(): void {

		add_action(
			'admin_enqueue_scripts',
			array( __CLASS__, 'enqueue_assets' )
		);
	}

	/**
	 * Enqueue Project module assets.
	 *
	 * @param string $hook_suffix Current admin page hook.
	 * @return void
	 */
	public static function enqueue_assets(
		string $hook_suffix
	): void {

		unset( $hook_suffix );

		if ( ! self::is_project_screen() ) {
			return;
		}

		$css_file = MYPORTFOLIO_CORE_PATH
			. 'modules/projects/assets/css/projects-admin.css';

		$js_file = MYPORTFOLIO_CORE_PATH
			. 'modules/projects/assets/js/projects-admin.js';

		wp_enqueue_media();

		wp_enqueue_script( 'jquery-ui-sortable' );

		wp_enqueue_style(
			'myportfolio-core-projects-admin',
			MYPORTFOLIO_CORE_URL
				. 'modules/projects/assets/css/projects-admin.css',
			array( 'myportfolio-core-admin' ),
			file_exists( $css_file )
				? (string) filemtime( $css_file )
				: MYPORTFOLIO_CORE_VERSION
		);

		wp_enqueue_script(
			'myportfolio-core-projects-admin',
			MYPORTFOLIO_CORE_URL
				. 'modules/projects/assets/js/projects-admin.js',
			array(
				'jquery',
				'jquery-ui-sortable',
			),
			file_exists( $js_file )
				? (string) filemtime( $js_file )
				: MYPORTFOLIO_CORE_VERSION,
			true
		);

		wp_localize_script(
			'myportfolio-core-projects-admin',
			'myportfolioCoreProjects',
			array(
				'mediaTitle'  => __(
					'Select Project Gallery Images',
					'myportfolio-core'
				),
				'mediaButton' => __(
					'Use Selected Images',
					'myportfolio-core'
				),
				'removeText'  => __(
					'Remove image',
					'myportfolio-core'
				),
				'dragText'    => __(
					'Drag to reorder',
					'myportfolio-core'
				),
				'ogMediaTitle'  => __(
	'Select Social Preview Image',
	'myportfolio-core'
),
'ogMediaButton' => __(
	'Use This Image',
	'myportfolio-core'
),
			)
		);
	}

	/**
	 * Determine whether the current screen belongs to Projects.
	 *
	 * @return bool
	 */
	private static function is_project_screen(): bool {

		$screen = get_current_screen();

		if ( ! $screen ) {
			return false;
		}

		if (
			MPC_Project_CPT::POST_TYPE
			=== $screen->post_type
		) {
			return true;
		}

		$project_taxonomies = array(
			'project_category',
			'technology',
			'project_type',
		);

		return in_array(
			(string) $screen->taxonomy,
			$project_taxonomies,
			true
		);
	}
}