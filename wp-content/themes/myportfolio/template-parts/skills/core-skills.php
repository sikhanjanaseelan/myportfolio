<?php
/**
 * Skills page core skills.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$core_skills = array(
	array(
		'name'        => 'PHP',
		'icon'        => 'php',
		'description' => __( 'Core PHP, OOPs, MVC, Composer', 'myportfolio' ),
	),
	array(
		'name'        => 'WordPress',
		'icon'        => 'wordpress',
		'description' => __( 'Custom Themes, Plugins, WP-CLI', 'myportfolio' ),
	),
	array(
		'name'        => 'Laravel',
		'icon'        => 'laravel',
		'description' => __( 'MVC, Eloquent, Migration, Queues', 'myportfolio' ),
	),
	array(
		'name'        => 'JavaScript',
		'icon'        => 'javascript',
		'description' => __( 'ES6+, AJAX, DOM Manipulation', 'myportfolio' ),
	),
	array(
		'name'        => 'MySQL',
		'icon'        => 'mysql',
		'description' => __( 'Database Design, Query Optimization', 'myportfolio' ),
	),
	array(
		'name'        => 'HTML5',
		'icon'        => 'html',
		'description' => __( 'Semantic Markup, Accessibility', 'myportfolio' ),
	),
	array(
		'name'        => 'CSS3',
		'icon'        => 'css',
		'description' => __( 'Flexbox, Grid, Responsive Design', 'myportfolio' ),
	),
	array(
		'name'        => 'REST API',
		'icon'        => 'api',
		'description' => __( 'Integrating & Designing JSON APIs', 'myportfolio' ),
	),
	array(
		'name'        => 'Git',
		'icon'        => 'git',
		'description' => __( 'Version Control, Collaboration', 'myportfolio' ),
	),
	array(
		'name'        => 'Linux / cPanel',
		'icon'        => 'linux',
		'description' => __( 'Server Deployment, Troubleshooting', 'myportfolio' ),
	),
);
?>

<section
	class="skills-core"
	aria-labelledby="skills-core-title"
>
	<div class="container container--wide">

		<header class="skills-core__header">
			<h2
				id="skills-core-title"
				class="skills-core__title"
			>
				<?php esc_html_e( 'Core Skills', 'myportfolio' ); ?>
			</h2>
		</header>

		<div class="skills-core__grid">

			<?php foreach ( $core_skills as $skill ) : ?>

				<article class="skill-card">

					<div
						class="skill-card__icon skill-card__icon--<?php echo esc_attr( $skill['icon'] ); ?>"
						aria-hidden="true"
					>
						<?php
						switch ( $skill['icon'] ) {

							case 'php':
								echo 'PHP';
								break;

							case 'wordpress':
								echo 'W';
								break;

							case 'laravel':
								echo 'L';
								break;

							case 'javascript':
								echo 'JS';
								break;

							case 'mysql':
								echo 'DB';
								break;

							case 'html':
								echo '5';
								break;

							case 'css':
								echo '3';
								break;

							case 'api':
								echo 'API';
								break;

							case 'git':
								echo '◆';
								break;

							default:
								echo '⌘';
								break;
						}
						?>
					</div>

					<h3 class="skill-card__title">
						<?php echo esc_html( $skill['name'] ); ?>
					</h3>

					<p class="skill-card__description">
						<?php echo esc_html( $skill['description'] ); ?>
					</p>

				</article>

			<?php endforeach; ?>

		</div>

	</div>
</section>