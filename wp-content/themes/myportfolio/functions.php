<?php
/**
 * MyPortfolio theme functions.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$myportfolio_includes = array(
    '/inc/setup.php',
    '/inc/enqueue.php',
);

foreach ( $myportfolio_includes as $myportfolio_file ) {
    require_once get_template_directory() . $myportfolio_file;
}