<?php
/**
 * Services page CTA.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="services-cta">

	<div class="container container--wide">

		<div class="services-cta__panel">

			<div class="services-cta__content">

				<h2>
					<?php esc_html_e( 'Have a project in mind?', 'myportfolio' ); ?>
				</h2>

				<p>
					<?php esc_html_e( 'Let’s build something reliable together.', 'myportfolio' ); ?>
				</p>

				<div class="services-cta__benefits">

					<span>
						<strong>✓</strong>
						<?php esc_html_e( 'Practical Delivery', 'myportfolio' ); ?>
					</span>

					<span>
						<strong>✓</strong>
						<?php esc_html_e( 'Clean & Scalable Code', 'myportfolio' ); ?>
					</span>

					<span>
						<strong>✓</strong>
						<?php esc_html_e( 'Clear Documentation', 'myportfolio' ); ?>
					</span>

					<span>
						<strong>✓</strong>
						<?php esc_html_e( 'Reliable Support', 'myportfolio' ); ?>
					</span>

				</div>

			</div>

			<a
	class="button button--accent services-cta__button"
	href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
>
	<span>
		<?php esc_html_e( 'Let’s Talk', 'myportfolio' ); ?>
	</span>

	<span
		class="button__icon"
		aria-hidden="true"
	>
		→
	</span>
</a>

			<div
				class="services-cta__plant"
				aria-hidden="true"
			>
				<span class="services-cta__leaf services-cta__leaf--1"></span>
				<span class="services-cta__leaf services-cta__leaf--2"></span>
				<span class="services-cta__leaf services-cta__leaf--3"></span>
				<span class="services-cta__leaf services-cta__leaf--4"></span>
				<span class="services-cta__pot"></span>
			</div>

		</div>

	</div>

</section>