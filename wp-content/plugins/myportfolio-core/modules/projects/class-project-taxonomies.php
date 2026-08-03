<?php
/**
 * Project Taxonomies.
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

final class MPC_Project_Taxonomies {

	public static function init(): void {
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ) );
	}

	public static function register_taxonomies(): void {

		self::register_project_categories();
		self::register_technologies();
		self::register_project_types();

	}

	private static function register_project_categories(): void {

		register_taxonomy(
			'project_category',
			MPC_Project_CPT::POST_TYPE,
			array(
				'labels' => array(
					'name'          => __( 'Categories', 'myportfolio-core' ),
					'singular_name' => __( 'Category', 'myportfolio-core' ),
					'menu_name'     => __( 'Categories', 'myportfolio-core' ),
				),
				'public'            => true,
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'rewrite'           => array(
					'slug' => 'project-category',
				),
			)
		);

	}

	private static function register_technologies(): void {

		register_taxonomy(
			'technology',
			MPC_Project_CPT::POST_TYPE,
			array(
				'labels' => array(
					'name'          => __( 'Technologies', 'myportfolio-core' ),
					'singular_name' => __( 'Technology', 'myportfolio-core' ),
					'menu_name'     => __( 'Technologies', 'myportfolio-core' ),
				),
				'public'            => true,
				'hierarchical'      => false,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'rewrite'           => array(
					'slug' => 'technology',
				),
			)
		);

	}

	private static function register_project_types(): void {

		register_taxonomy(
			'project_type',
			MPC_Project_CPT::POST_TYPE,
			array(
				'labels' => array(
					'name'          => __( 'Project Types', 'myportfolio-core' ),
					'singular_name' => __( 'Project Type', 'myportfolio-core' ),
					'menu_name'     => __( 'Project Types', 'myportfolio-core' ),
				),
				'public'            => true,
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'rewrite'           => array(
					'slug' => 'project-type',
				),
			)
		);

	}
}