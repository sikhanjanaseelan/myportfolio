<?php
/**
 * About page skills and technologies.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$core_skills = array(
	array(
		'name'  => 'PHP',
		'icon'  => 'PHP',
		'class' => 'php',
	),
	array(
		'name'  => 'WordPress',
		'icon'  => 'W',
		'class' => 'wordpress',
	),
	array(
		'name'  => 'Laravel',
		'icon'  => 'L',
		'class' => 'laravel',
	),
	array(
		'name'  => 'JavaScript',
		'icon'  => 'JS',
		'class' => 'javascript',
	),
	array(
		'name'  => 'MySQL',
		'icon'  => 'DB',
		'class' => 'mysql',
	),
	array(
		'name'  => 'HTML5',
		'icon'  => '5',
		'class' => 'html',
	),
	array(
		'name'  => 'CSS3',
		'icon'  => '3',
		'class' => 'css',
	),
	array(
		'name'  => 'REST API',
		'icon'  => 'API',
		'class' => 'api',
	),
	array(
		'name'  => 'Git',
		'icon'  => '◆',
		'class' => 'git',
	),
	array(
		'name'  => 'Linux / cPanel',
		'icon'  => '⌘',
		'class' => 'linux',
	),
);

$other_tools = array(
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
	class="about-skills"
	aria-labelledby="about-skills-title"
>

	<div class="about-skills__panel">

		<header class="about-skills__header">

			<h2
				id="about-skills-title"
				class="about-skills__title"
			>
				<?php esc_html_e( 'Skills & Technologies', 'myportfolio' ); ?>
			</h2>

			<p class="about-skills__intro">
				<?php
				esc_html_e(
					'A combination of technical expertise, tools and best practices to build modern web solutions.',
					'myportfolio'
				);
				?>
			</p>

		</header>

		<div class="about-skills__grid">

			<?php foreach ( $core_skills as $skill ) : ?>

				<article class="about-skill-card">

					<span
						class="about-skill-card__icon about-skill-card__icon--<?php echo esc_attr( $skill['class'] ); ?>"
						aria-hidden="true"
					>
						<?php echo esc_html( $skill['icon'] ); ?>
					</span>

					<strong>
						<?php echo esc_html( $skill['name'] ); ?>
					</strong>

				</article>

			<?php endforeach; ?>

		</div>

		<div class="about-skills__other">

			<h3>
				<?php esc_html_e( 'Other Tools & Technologies', 'myportfolio' ); ?>
			</h3>

			<div class="about-skills__tags">

				<?php foreach ( $other_tools as $tool ) : ?>

					<span>
						<?php echo esc_html( $tool ); ?>
					</span>

				<?php endforeach; ?>

			</div>

		</div>

	</div>

</section>