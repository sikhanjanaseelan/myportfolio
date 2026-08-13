<?php
/**
 * About page CTA.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="about-cta">

	<div class="about-cta__inner">

		<div class="about-cta__content">

			<p class="about-cta__eyebrow">
				<?php esc_html_e( 'Let’s Work Together', 'myportfolio' ); ?>
			</p>

			<h2>
				<?php esc_html_e( 'Let’s build something meaningful.', 'myportfolio' ); ?>
			</h2>

			<p class="about-cta__description">
				<?php
				esc_html_e(
					'I’m open to developer roles, collaborations and projects where I can contribute, learn and create real value.',
					'myportfolio'
				);
				?>
			</p>

		</div>

		<div class="about-cta__actions">

<a
	class="button button--primary about-cta__button"
	href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
>
	<span>
		<?php esc_html_e( 'Let’s Connect', 'myportfolio' ); ?>
	</span>

	<span
		class="button__icon"
		aria-hidden="true"
	>
		→
	</span>
</a>

			<a
				class="about-cta__button about-cta__button--secondary"
				href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"
			>
				<?php esc_html_e( 'View Projects', 'myportfolio' ); ?>
			</a>

		</div>

	</div>

</section>