<?php
/**
 * Engineering capabilities dashboard card.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$capabilities = array(
	array(
		'icon'  => 'code',
		'title' => 'Custom WordPress Development',
	),
	array(
		'icon'  => 'gauge',
		'title' => 'Performance Optimization',
	),
	array(
		'icon'  => 'blocks',
		'title' => 'Reusable Components',
	),
	array(
		'icon'  => 'accessibility',
		'title' => 'Accessibility (WCAG)',
	),
	array(
		'icon'  => 'plugin',
		'title' => 'Custom Plugin Development',
	),
	array(
		'icon'  => 'shield',
		'title' => 'Security Best Practices',
	),
	array(
		'icon'  => 'api',
		'title' => 'REST API Integration',
	),
	array(
		'icon'  => 'sparkles',
		'title' => 'AI-Assisted Development',
	),
);
?>

<article class="dashboard-card dashboard-card--capabilities">

	<header class="dashboard-card__header">

		<p class="dashboard-card__eyebrow">
			<?php esc_html_e( 'Engineering Capabilities', 'myportfolio' ); ?>
		</p>

	</header>

	<div class="capabilities-card__grid">

		<?php foreach ( $capabilities as $capability ) : ?>

			<div class="capabilities-card__item">

				<span class="capabilities-card__icon" aria-hidden="true">

					<?php
					get_template_part(
						'template-parts/icons/' . $capability['icon']
					);
					?>

				</span>

				<span class="capabilities-card__title">
					<?php echo esc_html( $capability['title'] ); ?>
				</span>

			</div>

		<?php endforeach; ?>

	</div>

</article>