<?php
/**
 * Project admin editor customisation.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Controls the Project editor workspace.
 */
final class MPC_Project_Admin {

	/**
	 * Register WordPress hooks.
	 *
	 * @return void
	 */
	public static function init(): void {

		add_action(
			'add_meta_boxes',
			array( __CLASS__, 'register_workspace' ),
			20
		);

		add_filter(
			'admin_body_class',
			array( __CLASS__, 'add_editor_body_class' )
		);
	}

	/**
	 * Register the custom Project Workspace.
	 *
	 * @return void
	 */
	public static function register_workspace(): void {

		remove_meta_box(
			'mpc-project-details',
			MPC_Project_CPT::POST_TYPE,
			'normal'
		);

		remove_meta_box(
			'mpc-project-links',
			MPC_Project_CPT::POST_TYPE,
			'normal'
		);

		remove_meta_box(
			'mpc-project-display',
			MPC_Project_CPT::POST_TYPE,
			'side'
		);

		add_meta_box(
			'mpc-project-workspace',
			__( 'Project Workspace', 'myportfolio-core' ),
			array( __CLASS__, 'render_workspace' ),
			MPC_Project_CPT::POST_TYPE,
			'normal',
			'high'
		);
	}

	/**
	 * Render the custom Project Workspace.
	 *
	 * @param WP_Post $post Current project.
	 * @return void
	 */
	public static function render_workspace(
		WP_Post $post
	): void {

		$view_path = __DIR__
			. '/views/project-editor.php';

		if ( ! file_exists( $view_path ) ) {
			echo '<p>';

			esc_html_e(
				'The Project editor view could not be loaded.',
				'myportfolio-core'
			);

			echo '</p>';

			return;
		}

		require $view_path;
	}

	/**
	 * Add the Project editor body class.
	 *
	 * @param string $classes Existing body classes.
	 * @return string
	 */
	public static function add_editor_body_class(
		string $classes
	): string {

		$screen = get_current_screen();

		if (
			! $screen
			|| MPC_Project_CPT::POST_TYPE
				!== $screen->post_type
			|| ! in_array(
				$screen->base,
				array( 'post', 'post-new' ),
				true
			)
		) {
			return $classes;
		}

		return $classes . ' mpc-project-editor-screen';
	}
}