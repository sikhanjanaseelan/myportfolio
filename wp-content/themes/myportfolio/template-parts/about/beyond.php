<?php
/**
 * About page beyond the code section.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$interests = array(
	array(
		'label' => __( 'Reading', 'myportfolio' ),
		'icon'  => 'book',
	),
	array(
		'label' => __( 'Music', 'myportfolio' ),
		'icon'  => 'music',
	),
	array(
		'label' => __( 'Narration', 'myportfolio' ),
		'icon'  => 'voice',
	),
	array(
		'label' => __( 'Storytelling', 'myportfolio' ),
		'icon'  => 'story',
	),
	array(
		'label' => __( 'Cooking', 'myportfolio' ),
		'icon'  => 'cook',
	),
	array(
		'label' => __( 'Learning', 'myportfolio' ),
		'icon'  => 'learn',
	),
);
?>

<section
	class="about-beyond"
	aria-labelledby="about-beyond-title"
>
	<div class="about-beyond__panel">

		<header class="about-beyond__header">

			<p class="about-beyond__eyebrow">
				<?php esc_html_e( 'Beyond the Code', 'myportfolio' ); ?>
			</p>

			<h2
				id="about-beyond-title"
				class="about-beyond__title"
			>
				<?php esc_html_e( 'A Little More About Me', 'myportfolio' ); ?>
			</h2>

		</header>

		<div class="about-beyond__copy">

			<p>
				<?php
				esc_html_e(
					'Outside development, I’m a mother of two and someone who loves stories, creativity and continuous learning.',
					'myportfolio'
				);
				?>
			</p>

			<p>
				<?php
				esc_html_e(
					'I enjoy reading, music, narration, storytelling and cooking. These interests keep me curious, patient and connected to the human side of the products I build.',
					'myportfolio'
				);
				?>
			</p>

		</div>

		<div class="about-beyond__interests">

			<?php foreach ( $interests as $interest ) : ?>

				<div class="about-interest">

					<span
						class="about-interest__icon"
						aria-hidden="true"
					>
						<?php
						switch ( $interest['icon'] ) {

							case 'book':
								echo '▤';
								break;

							case 'music':
								echo '♪';
								break;

							case 'voice':
								echo '◉';
								break;

							case 'story':
								echo '✦';
								break;

							case 'cook':
								echo '⌁';
								break;

							default:
								echo '↗';
								break;
						}
						?>
					</span>

					<span class="about-interest__label">
						<?php echo esc_html( $interest['label'] ); ?>
					</span>

				</div>

			<?php endforeach; ?>

		</div>

		<div class="about-beyond__quote">

			<span aria-hidden="true">“</span>

			<p>
				<?php
				esc_html_e(
					'I believe small steps, consistent learning and meaningful work can create a lasting impact.',
					'myportfolio'
				);
				?>
			</p>

		</div>

	</div>
</section>