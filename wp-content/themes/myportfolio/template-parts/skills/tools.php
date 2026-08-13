<?php
/**
 * Skills page - Other Tools & Technologies.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$tools = array(
	'jQuery',
	'Bootstrap',
	'Elementor',
	'WooCommerce',
	'ACF',
	'GitHub',
	'Postman',
	'Figma',
	'Docker',
);
?>

<section
	class="skills-tools"
	aria-labelledby="skills-tools-title"
>
	<div class="container container--wide">

		<h2
			id="skills-tools-title"
			class="skills-tools__title"
	>
			<?php esc_html_e( 'Other Tools & Technologies', 'myportfolio' ); ?>
		</h2>

		<div class="skills-tools__list">

			<?php foreach ( $tools as $tool ) : ?>

				<span class="skills-tools__tag">
					<?php echo esc_html( $tool ); ?>
				</span>

			<?php endforeach; ?>

		</div>

	</div>
</section>