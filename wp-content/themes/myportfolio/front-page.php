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
	

<?php
get_template_part(
	'template-parts/sections/featured-projects',
	null,
	array(
		'eyebrow'      => 'Featured Projects',
		'title'        => '',
		'description'  => '',
		'action_label' => 'View All Projects',
		'action_url'   => home_url( '/projects/' ),
		'show_action'  => true,
		'limit'        => 5,
	)
);
?>

<?php
get_template_part(
    'template-parts/sections/engineering-capabilities'
);
?>
</main>

<?php
get_footer();