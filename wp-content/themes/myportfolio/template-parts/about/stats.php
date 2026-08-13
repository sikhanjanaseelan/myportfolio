<?php
/**
 * About page statistics.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$stats = array(
	array(
		'value' => '3+',
		'label' => __( 'Years Experience', 'myportfolio' ),
	),
	array(
		'value' => '10+',
		'label' => __( 'Projects Participation', 'myportfolio' ),
	),
	array(
		'value' => '10+',
		'label' => __( 'Technologies', 'myportfolio' ),
	),
	array(
		'value' => '100%',
		'label' => __( 'Curious Mindset', 'myportfolio' ),
	),
);
?>

<section
	class="about-stats"
	aria-label="<?php esc_attr_e( 'Professional statistics', 'myportfolio' ); ?>"
>
	<div class="about-stats__grid">

		<?php foreach ( $stats as $stat ) : ?>

			<div class="about-stat">

				<strong>
					<?php echo esc_html( $stat['value'] ); ?>
				</strong>

				<span>
					<?php echo esc_html( $stat['label'] ); ?>
				</span>

			</div>

		<?php endforeach; ?>

	</div>
</section>