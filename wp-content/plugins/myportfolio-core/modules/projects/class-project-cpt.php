<?php
/**
 * Register the Portfolio Project custom post type.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Handles Project custom post type registration.
 */
final class MPC_Project_CPT {

	/**
	 * Project post type key.
	 */
	public const POST_TYPE = 'portfolio_project';

	/**
	 * Register WordPress hooks.
	 *
	 * @return void
	 */
	public static function init(): void {
		add_action( 'init', array( __CLASS__, 'register_post_type' ) );
	}

	/**
	 * Register the Portfolio Project post type.
	 *
	 * @return void
	 */
	public static function register_post_type(): void {

		$labels = array(
			'name'                  => __( 'Projects', 'myportfolio-core' ),
			'singular_name'         => __( 'Project', 'myportfolio-core' ),
			'menu_name'             => __( 'Projects', 'myportfolio-core' ),
			'name_admin_bar'        => __( 'Project', 'myportfolio-core' ),
			'add_new'               => __( 'Add New', 'myportfolio-core' ),
			'add_new_item'          => __( 'Add New Project', 'myportfolio-core' ),
			'new_item'              => __( 'New Project', 'myportfolio-core' ),
			'edit_item'             => __( 'Edit Project', 'myportfolio-core' ),
			'view_item'             => __( 'View Project', 'myportfolio-core' ),
			'all_items'             => __( 'All Projects', 'myportfolio-core' ),
			'search_items'          => __( 'Search Projects', 'myportfolio-core' ),
			'parent_item_colon'     => __( 'Parent Projects:', 'myportfolio-core' ),
			'not_found'             => __( 'No projects found.', 'myportfolio-core' ),
			'not_found_in_trash'    => __( 'No projects found in Trash.', 'myportfolio-core' ),
			'featured_image'        => __( 'Project Featured Image', 'myportfolio-core' ),
			'set_featured_image'    => __( 'Set project featured image', 'myportfolio-core' ),
			'remove_featured_image' => __( 'Remove project featured image', 'myportfolio-core' ),
			'use_featured_image'    => __( 'Use as project featured image', 'myportfolio-core' ),
			'archives'              => __( 'Project Archives', 'myportfolio-core' ),
			'insert_into_item'      => __( 'Insert into project', 'myportfolio-core' ),
			'uploaded_to_this_item' => __( 'Uploaded to this project', 'myportfolio-core' ),
			'filter_items_list'     => __( 'Filter projects list', 'myportfolio-core' ),
			'items_list_navigation' => __( 'Projects list navigation', 'myportfolio-core' ),
			'items_list'            => __( 'Projects list', 'myportfolio-core' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Portfolio projects and case studies.', 'myportfolio-core' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'show_in_nav_menus'  => true,
			'show_in_rest'       => true,
			'menu_position'      => 26,
			'menu_icon'          => 'dashicons-portfolio',
			'capability_type'    => 'post',
			'map_meta_cap'       => true,
			'hierarchical'       => false,
			'supports'           => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'revisions',
				'custom-fields',
				'page-attributes',
			),
			'has_archive'        => 'projects',
			'rewrite'            => array(
				'slug'       => 'project',
				'with_front' => false,
			),
			'query_var'          => true,
			'can_export'         => true,
			'delete_with_user'   => false,
			'exclude_from_search'=> false,
		);

		register_post_type(
			self::POST_TYPE,
			$args
		);
	}
}