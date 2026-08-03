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

		add_filter(
			'manage_edit-' . MPC_Project_CPT::POST_TYPE . '_sortable_columns',
			array( __CLASS__, 'register_sortable_columns' )
		);

		add_action(
			'pre_get_posts',
			array( __CLASS__, 'apply_column_sorting' )
		);
	}

	/**
	 * Register custom columns.
	 *
	 * @param array<string, string> $columns Existing columns.
	 * @return array<string, string>
	 */
	public static function register_columns( array $columns ): array {

		$updated_columns = array();

		if ( isset( $columns['cb'] ) ) {
			$updated_columns['cb'] = $columns['cb'];
		}

		$updated_columns['project_thumbnail'] = __(
			'Image',
			'myportfolio-core'
		);

		$updated_columns['title'] = __(
			'Project',
			'myportfolio-core'
		);

		$updated_columns['project_category'] = __(
			'Category',
			'myportfolio-core'
		);

		$updated_columns['technology'] = __(
			'Technologies',
			'myportfolio-core'
		);

		$updated_columns['project_status'] = __(
			'Status',
			'myportfolio-core'
		);

		$updated_columns['project_featured'] = __(
			'Featured',
			'myportfolio-core'
		);

		$updated_columns['project_order'] = __(
			'Order',
			'myportfolio-core'
		);

		$updated_columns['date'] = __(
			'Date',
			'myportfolio-core'
		);

		return $updated_columns;
	}

	/**
	 * Register sortable columns.
	 *
	 * @param array<string, string> $columns Existing sortable columns.
	 * @return array<string, string>
	 */
	public static function register_sortable_columns(
		array $columns
	): array {

		$columns['project_status']   = 'project_status';
		$columns['project_featured'] = 'project_featured';
		$columns['project_order']    = 'project_order';

		return $columns;
	}

	/**
	 * Render custom column values.
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
				self::render_terms(
					$post_id,
					'project_category'
				);
				break;

			case 'technology':
				self::render_terms(
					$post_id,
					'technology'
				);
				break;

			case 'project_status':
				self::render_status( $post_id );
				break;

			case 'project_featured':
				self::render_featured( $post_id );
				break;

			case 'project_order':
				self::render_order( $post_id );
				break;
		}
	}

	/**
	 * Apply sorting to custom columns.
	 *
	 * @param WP_Query $query Current query.
	 * @return void
	 */
	public static function apply_column_sorting(
		WP_Query $query
	): void {

		if (
			! is_admin()
			|| ! $query->is_main_query()
		) {
			return;
		}

		$post_type = $query->get( 'post_type' );

		if ( MPC_Project_CPT::POST_TYPE !== $post_type ) {
			return;
		}

		$orderby = $query->get( 'orderby' );

		switch ( $orderby ) {

			case 'project_status':
				$query->set(
					'meta_key',
					'_mpc_project_status'
				);

				$query->set(
					'orderby',
					'meta_value'
				);
				break;

			case 'project_featured':
				$query->set(
					'meta_key',
					'_mpc_project_featured'
				);

				$query->set(
					'orderby',
					'meta_value_num'
				);
				break;

			case 'project_order':
				$query->set(
					'meta_key',
					'_mpc_project_sort_order'
				);

				$query->set(
					'orderby',
					'meta_value_num'
				);
				break;
		}
	}

	/**
	 * Render the project thumbnail.
	 *
	 * @param int $post_id Project post ID.
	 * @return void
	 */
	private static function render_thumbnail(
		int $post_id
	): void {

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

		$terms = get_the_terms(
			$post_id,
			$taxonomy
		);

		if (
			! $terms
			|| is_wp_error( $terms )
		) {
			self::render_empty_value();
			return;
		}

		echo '<div class="mpc-project-list-terms">';

		foreach ( $terms as $term ) {

			echo '<span class="mpc-project-list-term">';
			echo esc_html( $term->name );
			echo '</span>';
		}

		echo '</div>';
	}

	/**
	 * Render project status.
	 *
	 * @param int $post_id Project post ID.
	 * @return void
	 */
	private static function render_status(
		int $post_id
	): void {

		$status = (string) get_post_meta(
			$post_id,
			'_mpc_project_status',
			true
		);

		$statuses = array(
			'completed' => array(
				'label' => __(
					'Completed',
					'myportfolio-core'
				),
				'class' => 'is-completed',
			),
			'in-progress' => array(
				'label' => __(
					'In Progress',
					'myportfolio-core'
				),
				'class' => 'is-progress',
			),
			'maintenance' => array(
				'label' => __(
					'Maintenance',
					'myportfolio-core'
				),
				'class' => 'is-maintenance',
			),
			'archived' => array(
				'label' => __(
					'Archived',
					'myportfolio-core'
				),
				'class' => 'is-archived',
			),
		);

		if (
			'' === $status
			|| ! isset( $statuses[ $status ] )
		) {
			self::render_empty_value();
			return;
		}

		$status_data = $statuses[ $status ];

		printf(
			'<span class="mpc-project-status %1$s">%2$s</span>',
			esc_attr( $status_data['class'] ),
			esc_html( $status_data['label'] )
		);
	}

	/**
	 * Render featured value.
	 *
	 * @param int $post_id Project post ID.
	 * @return void
	 */
	private static function render_featured(
		int $post_id
	): void {

		$is_featured = (bool) get_post_meta(
			$post_id,
			'_mpc_project_featured',
			true
		);

		if ( ! $is_featured ) {

			echo '<span class="mpc-project-featured is-disabled">';
			echo '<span class="dashicons dashicons-star-empty" aria-hidden="true"></span>';
			echo '<span class="screen-reader-text">';
			esc_html_e(
				'Not featured',
				'myportfolio-core'
			);
			echo '</span>';
			echo '</span>';

			return;
		}

		echo '<span class="mpc-project-featured is-featured">';
		echo '<span class="dashicons dashicons-star-filled" aria-hidden="true"></span>';
		echo '<span class="screen-reader-text">';
		esc_html_e(
			'Featured project',
			'myportfolio-core'
		);
		echo '</span>';
		echo '</span>';
	}

	/**
	 * Render display order.
	 *
	 * @param int $post_id Project post ID.
	 * @return void
	 */
	private static function render_order(
		int $post_id
	): void {

		$order = get_post_meta(
			$post_id,
			'_mpc_project_sort_order',
			true
		);

		if ( '' === $order ) {
			echo '0';
			return;
		}

		echo esc_html( (string) absint( $order ) );
	}

	/**
	 * Render empty table value.
	 *
	 * @return void
	 */
	private static function render_empty_value(): void {

		echo '<span class="mpc-project-list-empty">';
		esc_html_e( '—', 'myportfolio-core' );
		echo '</span>';
	}
}