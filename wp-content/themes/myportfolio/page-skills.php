<?php
/**
 * Skills page template.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main
	id="primary"
	class="site-main skills-page"
>

	<?php
	get_template_part(
		'template-parts/skills/hero'
	);

	get_template_part(
		'template-parts/skills/core-skills'
	);

	get_template_part(
		'template-parts/skills/tools'
	);

	get_template_part(
		'template-parts/skills/exploring'
	);
	?>

</main>

<?php
get_footer();