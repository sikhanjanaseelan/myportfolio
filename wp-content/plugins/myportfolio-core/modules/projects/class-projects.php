<?php
/**
 * Projects Module Bootstrap
 *
 * @package MyPortfolioCore
 */

defined( 'ABSPATH' ) || exit;

class MPC_Projects {

    /**
     * Initialize module.
     */
    public static function init() {

        self::includes();

    }

    /**
     * Load module classes.
     */
    private static function includes() {

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

}