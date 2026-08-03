<?php
/**
 * Project metadata fields.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers Project metaboxes and renders their fields.
 */
final class MPC_Project_Meta {

	/**
	 * Nonce action.
	 */
	public const NONCE_ACTION = 'mpc_save_project_details';

	/**
	 * Nonce field name.
	 */
	public const NONCE_NAME = 'mpc_project_details_nonce';

	/**
	 * Register WordPress hooks.
	 *
	 * @return void
	 */
	public static function init(): void {

		add_action(
			'add_meta_boxes',
			array( __CLASS__, 'register_meta_boxes' )
		);
	}

	/**
	 * Register Project metaboxes.
	 *
	 * @return void
	 */
	public static function register_meta_boxes(): void {

		add_meta_box(
			'mpc-project-details',
			__( 'Project Details', 'myportfolio-core' ),
			array( __CLASS__, 'render_project_details' ),
			MPC_Project_CPT::POST_TYPE,
			'normal',
			'high'
		);

		add_meta_box(
			'mpc-project-links',
			__( 'Project Links', 'myportfolio-core' ),
			array( __CLASS__, 'render_project_links' ),
			MPC_Project_CPT::POST_TYPE,
			'normal',
			'default'
		);

		add_meta_box(
			'mpc-project-display',
			__( 'Display Settings', 'myportfolio-core' ),
			array( __CLASS__, 'render_display_settings' ),
			MPC_Project_CPT::POST_TYPE,
			'side',
			'default'
		);
	}

	/**
	 * Render the Project Details metabox.
	 *
	 * @param WP_Post $post Current Project post.
	 * @return void
	 */
	public static function render_project_details( WP_Post $post ): void {

		wp_nonce_field(
			self::NONCE_ACTION,
			self::NONCE_NAME
		);

		$client   = get_post_meta( $post->ID, '_mpc_project_client', true );
		$role     = get_post_meta( $post->ID, '_mpc_project_role', true );
		$industry = get_post_meta( $post->ID, '_mpc_project_industry', true );
		$duration = get_post_meta( $post->ID, '_mpc_project_duration', true );
		$year     = get_post_meta( $post->ID, '_mpc_project_year', true );
		$status   = get_post_meta( $post->ID, '_mpc_project_status', true );

		if ( ! $status ) {
			$status = 'completed';
		}
		?>

		<div class="mpc-project-metabox">

			<div class="mpc-form-grid">

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-client"
					>
						<?php esc_html_e( 'Client', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-client"
						class="mpc-input"
						type="text"
						name="mpc_project_client"
						value="<?php echo esc_attr( $client ); ?>"
						placeholder="<?php esc_attr_e( 'Client or organisation name', 'myportfolio-core' ); ?>"
					>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-role"
					>
						<?php esc_html_e( 'Your Role', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-role"
						class="mpc-input"
						type="text"
						name="mpc_project_role"
						value="<?php echo esc_attr( $role ); ?>"
						placeholder="<?php esc_attr_e( 'WordPress Developer', 'myportfolio-core' ); ?>"
					>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-industry"
					>
						<?php esc_html_e( 'Industry', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-industry"
						class="mpc-input"
						type="text"
						name="mpc_project_industry"
						value="<?php echo esc_attr( $industry ); ?>"
						placeholder="<?php esc_attr_e( 'Healthcare, Education, E-commerce…', 'myportfolio-core' ); ?>"
					>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-duration"
					>
						<?php esc_html_e( 'Duration', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-duration"
						class="mpc-input"
						type="text"
						name="mpc_project_duration"
						value="<?php echo esc_attr( $duration ); ?>"
						placeholder="<?php esc_attr_e( '6 weeks', 'myportfolio-core' ); ?>"
					>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-year"
					>
						<?php esc_html_e( 'Project Year', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-year"
						class="mpc-input"
						type="number"
						name="mpc_project_year"
						value="<?php echo esc_attr( $year ); ?>"
						min="2000"
						max="2100"
						step="1"
						placeholder="<?php echo esc_attr( gmdate( 'Y' ) ); ?>"
					>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-status"
					>
						<?php esc_html_e( 'Project Status', 'myportfolio-core' ); ?>
					</label>

					<select
						id="mpc-project-status"
						class="mpc-select"
						name="mpc_project_status"
					>
						<option
							value="completed"
							<?php selected( $status, 'completed' ); ?>
						>
							<?php esc_html_e( 'Completed', 'myportfolio-core' ); ?>
						</option>

						<option
							value="in-progress"
							<?php selected( $status, 'in-progress' ); ?>
						>
							<?php esc_html_e( 'In Progress', 'myportfolio-core' ); ?>
						</option>

						<option
							value="maintenance"
							<?php selected( $status, 'maintenance' ); ?>
						>
							<?php esc_html_e( 'Maintenance', 'myportfolio-core' ); ?>
						</option>

						<option
							value="archived"
							<?php selected( $status, 'archived' ); ?>
						>
							<?php esc_html_e( 'Archived', 'myportfolio-core' ); ?>
						</option>
					</select>

				</div>

			</div>

		</div>

		<?php
	}

	/**
	 * Render Project Links metabox.
	 *
	 * @param WP_Post $post Current Project post.
	 * @return void
	 */
	public static function render_project_links( WP_Post $post ): void {

		$live_url   = get_post_meta( $post->ID, '_mpc_project_live_url', true );
		$github_url = get_post_meta( $post->ID, '_mpc_project_github_url', true );
		$case_url   = get_post_meta( $post->ID, '_mpc_project_case_url', true );
		?>

		<div class="mpc-project-metabox">

			<div class="mpc-form-grid">

				<div class="mpc-form-field mpc-form-field--full">

					<label
						class="mpc-form-label"
						for="mpc-project-live-url"
					>
						<?php esc_html_e( 'Live Project URL', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-live-url"
						class="mpc-input"
						type="url"
						name="mpc_project_live_url"
						value="<?php echo esc_url( $live_url ); ?>"
						placeholder="https://example.com"
					>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-github-url"
					>
						<?php esc_html_e( 'GitHub URL', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-github-url"
						class="mpc-input"
						type="url"
						name="mpc_project_github_url"
						value="<?php echo esc_url( $github_url ); ?>"
						placeholder="https://github.com/username/project"
					>

				</div>

				<div class="mpc-form-field">

					<label
						class="mpc-form-label"
						for="mpc-project-case-url"
					>
						<?php esc_html_e( 'External Case Study URL', 'myportfolio-core' ); ?>
					</label>

					<input
						id="mpc-project-case-url"
						class="mpc-input"
						type="url"
						name="mpc_project_case_url"
						value="<?php echo esc_url( $case_url ); ?>"
						placeholder="https://example.com/case-study"
					>

					<p class="mpc-form-description">
						<?php
						esc_html_e(
							'Leave empty to use the project’s WordPress single page.',
							'myportfolio-core'
						);
						?>
					</p>

				</div>

			</div>

		</div>

		<?php
	}

	/**
	 * Render Display Settings metabox.
	 *
	 * @param WP_Post $post Current Project post.
	 * @return void
	 */
	public static function render_display_settings( WP_Post $post ): void {

		$is_featured = (bool) get_post_meta(
			$post->ID,
			'_mpc_project_featured',
			true
		);

		$sort_order = get_post_meta(
			$post->ID,
			'_mpc_project_sort_order',
			true
		);
		?>

		<div class="mpc-project-metabox">

			<div class="mpc-form-field">

				<label class="mpc-switch">

					<input
						class="mpc-switch__input"
						type="checkbox"
						name="mpc_project_featured"
						value="1"
						<?php checked( $is_featured ); ?>
					>

					<span
						class="mpc-switch__control"
						aria-hidden="true"
					></span>

					<span class="mpc-switch__text">
						<?php esc_html_e( 'Featured Project', 'myportfolio-core' ); ?>
					</span>

				</label>

				<p class="mpc-form-description">
					<?php
					esc_html_e(
						'Display this project in the homepage Featured Projects section.',
						'myportfolio-core'
					);
					?>
				</p>

			</div>

			<div class="mpc-form-field mpc-project-field-spacing">

				<label
					class="mpc-form-label"
					for="mpc-project-sort-order"
				>
					<?php esc_html_e( 'Display Order', 'myportfolio-core' ); ?>
				</label>

				<input
					id="mpc-project-sort-order"
					class="mpc-input"
					type="number"
					name="mpc_project_sort_order"
					value="<?php echo esc_attr( $sort_order ); ?>"
					min="0"
					step="1"
					placeholder="0"
				>

				<p class="mpc-form-description">
					<?php
					esc_html_e(
						'Lower numbers appear first.',
						'myportfolio-core'
					);
					?>
				</p>

			</div>

		</div>

		<?php
	}
}