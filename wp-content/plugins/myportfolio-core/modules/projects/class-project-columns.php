<?php
/**
 * Project admin columns.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Customises the Projects admin list table.
 */
final class MPC_Project_Columns {

	/**
	 * Register WordPress hooks.
	 *
	 * @return void
	 */
	public static function init(): void {

		add_filter(
			'manage_' . MPC_Project_CPT::POST_TYPE . '_posts_columns',
			array( __CLASS__, 'register_columns' )
		);

		add_action(
			'manage_' . MPC_Project_CPT::POST_TYPE . '_posts_custom_column',
			array( __CLASS__, 'render_column' ),
			10,
			2
		);
	}

	/**
	 * Register custom project columns.
	 *
	 * @param array<string, string> $columns Existing columns.
	 * @return array<string, string>
	 */
	public static function register_columns( array $columns ): array {

		$updated_columns = array();

		if ( isset( $columns['cb'] ) ) {
			$updated_columns['cb'] = $columns['cb'];
		}

		$updated_columns['project_thumbnail'] = __( 'Image', 'myportfolio-core' );
		$updated_columns['title']             = __( 'Project', 'myportfolio-core' );
		$updated_columns['project_category']  = __( 'Category', 'myportfolio-core' );
		$updated_columns['technology']        = __( 'Technologies', 'myportfolio-core' );
		$updated_columns['project_type']      = __( 'Type', 'myportfolio-core' );
		$updated_columns['date']              = __( 'Date', 'myportfolio-core' );

		return $updated_columns;
	}

	/**
	 * Render a custom project column.
	 *
	 * @param string $column_name Current column name.
	 * @param int    $post_id     Current post ID.
	 * @return void
	 */
	public static function render_column(
		string $column_name,
		int $post_id
	): void {

		switch ( $column_name ) {

			case 'project_thumbnail':
				self::render_thumbnail( $post_id );
				break;

			case 'project_category':
				self::render_terms( $post_id, 'project_category' );
				break;

			case 'technology':
				self::render_terms( $post_id, 'technology' );
				break;

			case 'project_type':
				self::render_terms( $post_id, 'project_type' );
				break;
		}
	}

	/**
	 * Render the project thumbnail.
	 *
	 * @param int $post_id Project post ID.
	 * @return void
	 */
	private static function render_thumbnail( int $post_id ): void {

		if ( has_post_thumbnail( $post_id ) ) {

			echo get_the_post_thumbnail(
				$post_id,
				array( 64, 48 ),
				array(
					'class' => 'mpc-project-list-thumbnail',
					'alt'   => '',
				)
			);

			return;
		}

		echo '<span class="mpc-project-list-placeholder" aria-hidden="true">';
		echo '<span class="dashicons dashicons-format-image"></span>';
		echo '</span>';
	}

	/**
	 * Render taxonomy terms.
	 *
	 * @param int    $post_id  Project post ID.
	 * @param string $taxonomy Taxonomy name.
	 * @return void
	 */
	private static function render_terms(
		int $post_id,
		string $taxonomy
	): void {

		$terms = get_the_terms( $post_id, $taxonomy );

		if ( ! $terms || is_wp_error( $terms ) ) {

			echo '<span class="mpc-project-list-empty">';
			esc_html_e( '—', 'myportfolio-core' );
			echo '</span>';

			return;
		}

		$term_names = wp_list_pluck( $terms, 'name' );

		echo '<div class="mpc-project-list-terms">';

		foreach ( $term_names as $term_name ) {

			echo '<span class="mpc-project-list-term">';
			echo esc_html( $term_name );
			echo '</span>';
		}

		echo '</div>';
	}
}