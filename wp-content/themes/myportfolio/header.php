<?php
/**
 * Document header.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main-content">
	<?php esc_html_e( 'Skip to content', 'myportfolio' ); ?>
</a>

<?php
get_template_part(
	'template-parts/global/site-header'
);