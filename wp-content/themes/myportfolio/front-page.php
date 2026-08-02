<?php
/**
 * Front page template.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main-content" class="site-main">

    <?php
    get_template_part(
        'template-parts/sections/hero',
        null,
        array(
            'availability' => 'Available for Full-time • Freelance • Remote',
            'eyebrow'      => 'Hi, I’m',
            'title'        => 'Building scalable PHP & WordPress solutions with modern development practices.',
            'description'  => 'I build custom WordPress themes, plugins, Laravel applications, REST API integrations and AI-assisted development workflows focused on performance, maintainability and user experience.',
        )
    );
    ?>

</main>

<?php
get_footer();