<?php
/**
 * Save Project metadata.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Handles Project metadata persistence.
 */
final class MPC_Project_Save {

	/**
	 * Register WordPress hooks.
	 *
	 * @return void
	 */
	public static function init(): void {

		add_action(
			'save_post_' . MPC_Project_CPT::POST_TYPE,
			array( __CLASS__, 'save_project' ),
			10,
			2
		);
	}

	/**
	 * Save all Project metadata.
	 *
	 * @param int     $post_id Current Project post ID.
	 * @param WP_Post $post    Current Project post object.
	 * @return void
	 */
	public static function save_project(
		int $post_id,
		WP_Post $post
	): void {

		if ( ! self::can_save( $post_id, $post ) ) {
			return;
		}

		/*
		 * Overview.
		 */
		self::save_text_field(
			$post_id,
			'mpc_project_client',
			'_mpc_project_client'
		);

		self::save_text_field(
			$post_id,
			'mpc_project_role',
			'_mpc_project_role'
		);

		self::save_text_field(
			$post_id,
			'mpc_project_industry',
			'_mpc_project_industry'
		);

		self::save_text_field(
			$post_id,
			'mpc_project_duration',
			'_mpc_project_duration'
		);

		self::save_integer_field(
			$post_id,
			'mpc_project_year',
			'_mpc_project_year'
		);

		self::save_select_field(
			$post_id,
			'mpc_project_status',
			'_mpc_project_status',
			array(
				'completed',
				'in-progress',
				'maintenance',
				'archived',
			)
		);

		/*
		 * Project media.
		 */
		self::save_gallery_field(
			$post_id,
			'mpc_project_gallery',
			'_mpc_project_gallery'
		);

		self::save_url_field(
			$post_id,
			'mpc_project_video_url',
			'_mpc_project_video_url'
		);

		/*
		 * Structured case-study content.
		 */
		self::save_textarea_field(
			$post_id,
			'mpc_project_challenge',
			'_mpc_project_challenge'
		);

		self::save_textarea_field(
			$post_id,
			'mpc_project_solution',
			'_mpc_project_solution'
		);

		self::save_textarea_field(
			$post_id,
			'mpc_project_outcome',
			'_mpc_project_outcome'
		);

		self::save_features(
			$post_id,
			'mpc_project_features',
			'_mpc_project_features'
		);

		self::save_statistics(
			$post_id,
			'mpc_project_statistics',
			'_mpc_project_statistics'
		);

		/*
		 * Testimonial.
		 */
		self::save_textarea_field(
			$post_id,
			'mpc_project_testimonial_quote',
			'_mpc_project_testimonial_quote'
		);

		self::save_text_field(
			$post_id,
			'mpc_project_testimonial_name',
			'_mpc_project_testimonial_name'
		);

		self::save_text_field(
			$post_id,
			'mpc_project_testimonial_position',
			'_mpc_project_testimonial_position'
		);

		self::save_text_field(
			$post_id,
			'mpc_project_testimonial_company',
			'_mpc_project_testimonial_company'
		);

		self::save_bounded_integer_field(
			$post_id,
			'mpc_project_testimonial_rating',
			'_mpc_project_testimonial_rating',
			1,
			5
		);

		self::save_attachment_field(
			$post_id,
			'mpc_project_testimonial_photo_id',
			'_mpc_project_testimonial_photo_id',
			'image'
		);

		self::save_attachment_field(
			$post_id,
			'mpc_project_case_study_pdf_id',
			'_mpc_project_case_study_pdf_id',
			'application/pdf'
		);

		/*
		 * Project links.
		 */
		self::save_url_field(
			$post_id,
			'mpc_project_live_url',
			'_mpc_project_live_url'
		);

		self::save_url_field(
			$post_id,
			'mpc_project_github_url',
			'_mpc_project_github_url'
		);

		self::save_url_field(
			$post_id,
			'mpc_project_case_url',
			'_mpc_project_case_url'
		);

		/*
		 * SEO.
		 */
		self::save_text_field(
			$post_id,
			'mpc_project_seo_title',
			'_mpc_project_seo_title'
		);

		self::save_textarea_field(
			$post_id,
			'mpc_project_seo_description',
			'_mpc_project_seo_description'
		);

		self::save_url_field(
			$post_id,
			'mpc_project_canonical_url',
			'_mpc_project_canonical_url'
		);

		self::save_select_field(
			$post_id,
			'mpc_project_robots',
			'_mpc_project_robots',
			array(
				'index-follow',
				'noindex-follow',
				'index-nofollow',
				'noindex-nofollow',
			)
		);

		self::save_attachment_field(
			$post_id,
			'mpc_project_og_image_id',
			'_mpc_project_og_image_id',
			'image'
		);

		/*
		 * Display settings.
		 */
		self::save_integer_field(
			$post_id,
			'mpc_project_sort_order',
			'_mpc_project_sort_order'
		);

		$is_featured = isset( $_POST['mpc_project_featured'] )
			? 1
			: 0;

		update_post_meta(
			$post_id,
			'_mpc_project_featured',
			$is_featured
		);
	}

	/**
	 * Verify whether the current Project can be saved.
	 *
	 * @param int     $post_id Current post ID.
	 * @param WP_Post $post    Current post object.
	 * @return bool
	 */
	private static function can_save(
		int $post_id,
		WP_Post $post
	): bool {

		if ( MPC_Project_CPT::POST_TYPE !== $post->post_type ) {
			return false;
		}

		if (
			! isset( $_POST[ MPC_Project_Meta::NONCE_NAME ] )
			|| ! wp_verify_nonce(
				sanitize_text_field(
					wp_unslash(
						$_POST[ MPC_Project_Meta::NONCE_NAME ]
					)
				),
				MPC_Project_Meta::NONCE_ACTION
			)
		) {
			return false;
		}

		if (
			defined( 'DOING_AUTOSAVE' )
			&& DOING_AUTOSAVE
		) {
			return false;
		}

		if ( wp_is_post_revision( $post_id ) ) {
			return false;
		}

		if ( wp_is_post_autosave( $post_id ) ) {
			return false;
		}

		return current_user_can(
			'edit_post',
			$post_id
		);
	}

	/**
	 * Save a text field.
	 *
	 * @param int    $post_id  Current post ID.
	 * @param string $field    Request field name.
	 * @param string $meta_key Post meta key.
	 * @return void
	 */
	private static function save_text_field(
		int $post_id,
		string $field,
		string $meta_key
	): void {

		if ( ! isset( $_POST[ $field ] ) ) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		$value = sanitize_text_field(
			wp_unslash( $_POST[ $field ] )
		);

		self::update_or_delete(
			$post_id,
			$meta_key,
			$value
		);
	}

	/**
	 * Save a textarea field.
	 *
	 * @param int    $post_id  Current post ID.
	 * @param string $field    Request field name.
	 * @param string $meta_key Post meta key.
	 * @return void
	 */
	private static function save_textarea_field(
		int $post_id,
		string $field,
		string $meta_key
	): void {

		if ( ! isset( $_POST[ $field ] ) ) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		$value = sanitize_textarea_field(
			wp_unslash( $_POST[ $field ] )
		);

		self::update_or_delete(
			$post_id,
			$meta_key,
			$value
		);
	}

	/**
	 * Save a URL field.
	 *
	 * @param int    $post_id  Current post ID.
	 * @param string $field    Request field name.
	 * @param string $meta_key Post meta key.
	 * @return void
	 */
	private static function save_url_field(
		int $post_id,
		string $field,
		string $meta_key
	): void {

		if ( ! isset( $_POST[ $field ] ) ) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		$value = esc_url_raw(
			wp_unslash( $_POST[ $field ] )
		);

		self::update_or_delete(
			$post_id,
			$meta_key,
			$value
		);
	}

	/**
	 * Save an integer field.
	 *
	 * @param int    $post_id  Current post ID.
	 * @param string $field    Request field name.
	 * @param string $meta_key Post meta key.
	 * @return void
	 */
	private static function save_integer_field(
		int $post_id,
		string $field,
		string $meta_key
	): void {

		if (
			! isset( $_POST[ $field ] )
			|| '' === trim(
				(string) wp_unslash( $_POST[ $field ] )
			)
		) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		$value = absint(
			wp_unslash( $_POST[ $field ] )
		);

		update_post_meta(
			$post_id,
			$meta_key,
			$value
		);
	}

	/**
	 * Save an integer restricted to a minimum and maximum value.
	 *
	 * @param int    $post_id  Current post ID.
	 * @param string $field    Request field name.
	 * @param string $meta_key Post meta key.
	 * @param int    $minimum  Minimum permitted value.
	 * @param int    $maximum  Maximum permitted value.
	 * @return void
	 */
	private static function save_bounded_integer_field(
		int $post_id,
		string $field,
		string $meta_key,
		int $minimum,
		int $maximum
	): void {

		if (
			! isset( $_POST[ $field ] )
			|| '' === trim(
				(string) wp_unslash( $_POST[ $field ] )
			)
		) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		$value = absint(
			wp_unslash( $_POST[ $field ] )
		);

		$value = max(
			$minimum,
			min( $maximum, $value )
		);

		update_post_meta(
			$post_id,
			$meta_key,
			$value
		);
	}

	/**
	 * Save a validated select value.
	 *
	 * @param int           $post_id       Current post ID.
	 * @param string        $field         Request field name.
	 * @param string        $meta_key      Post meta key.
	 * @param array<string> $valid_options Allowed values.
	 * @return void
	 */
	private static function save_select_field(
		int $post_id,
		string $field,
		string $meta_key,
		array $valid_options
	): void {

		if ( ! isset( $_POST[ $field ] ) ) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		$value = sanitize_key(
			wp_unslash( $_POST[ $field ] )
		);

		if ( ! in_array( $value, $valid_options, true ) ) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		update_post_meta(
			$post_id,
			$meta_key,
			$value
		);
	}

	/**
	 * Save an ordered attachment gallery.
	 *
	 * @param int    $post_id  Current post ID.
	 * @param string $field    Request field name.
	 * @param string $meta_key Post meta key.
	 * @return void
	 */
	private static function save_gallery_field(
		int $post_id,
		string $field,
		string $meta_key
	): void {

		if ( ! isset( $_POST[ $field ] ) ) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		$raw_value = sanitize_text_field(
			wp_unslash( $_POST[ $field ] )
		);

		$attachment_ids = array_filter(
			array_map(
				'absint',
				explode( ',', $raw_value )
			)
		);

		$attachment_ids = array_values(
			array_unique( $attachment_ids )
		);

		$attachment_ids = array_filter(
			$attachment_ids,
			static function ( int $attachment_id ): bool {

				return (
					'attachment' === get_post_type( $attachment_id )
					&& wp_attachment_is_image( $attachment_id )
				);
			}
		);

		if ( empty( $attachment_ids ) ) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		update_post_meta(
			$post_id,
			$meta_key,
			implode( ',', $attachment_ids )
		);
	}

	/**
	 * Save Project feature repeater data.
	 *
	 * @param int    $post_id  Current post ID.
	 * @param string $field    Request field name.
	 * @param string $meta_key Post meta key.
	 * @return void
	 */
	private static function save_features(
		int $post_id,
		string $field,
		string $meta_key
	): void {

		if (
			! isset( $_POST[ $field ] )
			|| ! is_array( $_POST[ $field ] )
		) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		$raw_features = wp_unslash(
			$_POST[ $field ]
		);

		$features = array();

		foreach ( $raw_features as $raw_feature ) {

			if ( ! is_array( $raw_feature ) ) {
				continue;
			}

			$title = isset( $raw_feature['title'] )
				? sanitize_text_field( $raw_feature['title'] )
				: '';

			$icon = isset( $raw_feature['icon'] )
				? sanitize_html_class( $raw_feature['icon'] )
				: 'yes-alt';

			if ( '' === $title ) {
				continue;
			}

			$features[] = array(
				'icon'  => $icon ?: 'yes-alt',
				'title' => $title,
			);
		}

		if ( empty( $features ) ) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		update_post_meta(
			$post_id,
			$meta_key,
			$features
		);
	}

	/**
	 * Save Project statistics repeater data.
	 *
	 * @param int    $post_id  Current post ID.
	 * @param string $field    Request field name.
	 * @param string $meta_key Post meta key.
	 * @return void
	 */
	private static function save_statistics(
		int $post_id,
		string $field,
		string $meta_key
	): void {

		if (
			! isset( $_POST[ $field ] )
			|| ! is_array( $_POST[ $field ] )
		) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		$raw_statistics = wp_unslash(
			$_POST[ $field ]
		);

		$statistics = array();

		foreach ( $raw_statistics as $raw_statistic ) {

			if ( ! is_array( $raw_statistic ) ) {
				continue;
			}

			$icon = isset( $raw_statistic['icon'] )
				? sanitize_html_class( $raw_statistic['icon'] )
				: 'chart-bar';

			$value = isset( $raw_statistic['value'] )
				? sanitize_text_field( $raw_statistic['value'] )
				: '';

			$label = isset( $raw_statistic['label'] )
				? sanitize_text_field( $raw_statistic['label'] )
				: '';

			if ( '' === $value && '' === $label ) {
				continue;
			}

			$statistics[] = array(
				'icon'  => $icon ?: 'chart-bar',
				'value' => $value,
				'label' => $label,
			);
		}

		if ( empty( $statistics ) ) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		update_post_meta(
			$post_id,
			$meta_key,
			$statistics
		);
	}

	/**
	 * Save and validate an attachment field.
	 *
	 * @param int    $post_id      Current post ID.
	 * @param string $field        Request field name.
	 * @param string $meta_key     Post meta key.
	 * @param string $expected_type Expected attachment type.
	 * @return void
	 */
	private static function save_attachment_field(
		int $post_id,
		string $field,
		string $meta_key,
		string $expected_type
	): void {

		if (
			! isset( $_POST[ $field ] )
			|| '' === trim(
				(string) wp_unslash( $_POST[ $field ] )
			)
		) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		$attachment_id = absint(
			wp_unslash( $_POST[ $field ] )
		);

		if (
			! $attachment_id
			|| 'attachment' !== get_post_type( $attachment_id )
		) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		$mime_type = (string) get_post_mime_type(
			$attachment_id
		);

		$is_valid = false;

		if ( 'image' === $expected_type ) {
			$is_valid = wp_attachment_is_image(
				$attachment_id
			);
		} else {
			$is_valid = $expected_type === $mime_type;
		}

		if ( ! $is_valid ) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		update_post_meta(
			$post_id,
			$meta_key,
			$attachment_id
		);
	}

	/**
	 * Update or delete an optional metadata value.
	 *
	 * @param int    $post_id  Current post ID.
	 * @param string $meta_key Post meta key.
	 * @param string $value    Sanitized value.
	 * @return void
	 */
	private static function update_or_delete(
		int $post_id,
		string $meta_key,
		string $value
	): void {

		if ( '' === $value ) {
			delete_post_meta( $post_id, $meta_key );
			return;
		}

		update_post_meta(
			$post_id,
			$meta_key,
			$value
		);
	}
}