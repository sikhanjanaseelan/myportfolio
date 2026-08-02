<?php
/**
 * Main fallback template.
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

<main class="site-main">

    <div style="max-width: 900px; margin: 100px auto; padding: 40px;">

        <p>MyPortfolio Theme</p>

        <h1>
            <?php bloginfo( 'name' ); ?>
        </h1>

        <p>
            The custom WordPress theme is active and working correctly.
        </p>

    </div>

</main>

<?php wp_footer(); ?>

</body>
</html>