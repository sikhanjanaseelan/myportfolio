<?php
/**
 * Admin asset loader.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Loads MyPortfolio Core admin styles and scripts.
 */
final class MyPortfolio_Core_Admin_Assets {

	/**
	 * Register WordPress hooks.
	 *
	 * @return void
	 */
	public function register(): void {
		add_action(
			'admin_enqueue_scripts',
			array( $this, 'enqueue_assets' )
		);
	}

	/**
	 * Load the shared admin design system.
	 *
	 * @param string $hook_suffix Current admin hook.
	 * @return void
	 */
	public function enqueue_assets( string $hook_suffix ): void {

		unset( $hook_suffix );

		if ( ! $this->is_myportfolio_screen() ) {
			return;
		}

		$css_path = MYPORTFOLIO_CORE_PATH
			. 'admin/assets/css/admin.css';

		$js_path = MYPORTFOLIO_CORE_PATH
			. 'admin/assets/js/admin.js';

		wp_enqueue_style(
			'myportfolio-core-admin',
			MYPORTFOLIO_CORE_URL
				. 'admin/assets/css/admin.css',
			array(),
			file_exists( $css_path )
				? (string) filemtime( $css_path )
				: MYPORTFOLIO_CORE_VERSION
		);

		wp_enqueue_script(
			'myportfolio-core-admin',
			MYPORTFOLIO_CORE_URL
				. 'admin/assets/js/admin.js',
			array(),
			file_exists( $js_path )
				? (string) filemtime( $js_path )
				: MYPORTFOLIO_CORE_VERSION,
			true
		);

		wp_localize_script(
			'myportfolio-core-admin',
			'myportfolioCoreAdmin',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce(
					'myportfolio_core_admin'
				),
				'version' => MYPORTFOLIO_CORE_VERSION,
			)
		);
	}

	/**
	 * Check whether the current screen belongs to the plugin.
	 *
	 * @return bool
	 */
	private function is_myportfolio_screen(): bool {

		if ( ! is_admin() ) {
			return false;
		}

		$page = isset( $_GET['page'] )
			? sanitize_key(
				wp_unslash( $_GET['page'] )
			)
			: '';

		if ( 0 === strpos( $page, 'myportfolio-core' ) ) {
			return true;
		}

		$screen = get_current_screen();

		if ( ! $screen ) {
			return false;
		}

		if (
			isset( $screen->post_type )
			&& 'portfolio_project' === $screen->post_type
		) {
			return true;
		}

		$project_taxonomies = array(
			'project_category',
			'technology',
			'project_type',
		);

		if (
			isset( $screen->taxonomy )
			&& in_array(
				$screen->taxonomy,
				$project_taxonomies,
				true
			)
		) {
			return true;
		}

		return false !== strpos(
			(string) $screen->id,
			'myportfolio-core'
		);
	}
}