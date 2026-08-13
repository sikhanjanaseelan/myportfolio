<?php
/**
 * Experience achievements.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$achievements = array(
	__(
		'Developed 10+ WordPress websites with custom functionality',
		'myportfolio'
	),
	__(
		'Built custom plugins and themes from scratch',
		'myportfolio'
	),
	__(
		'Integrated third-party APIs and payment gateways',
		'myportfolio'
	),
	__(
		'Optimized websites for speed, SEO and security',
		'myportfolio'
	),
	__(
		'Prepared project case studies, technical documentation and development handover materials',
		'myportfolio'
	),
	__(
		'Collaborated with clients and teams to deliver quality solutions',
		'myportfolio'
	),
	__(
		'Followed best practices and maintained clean, structured code',
		'myportfolio'
	),
);
?>

<section
	class="experience-achievements"
	aria-labelledby="experience-achievements-title"
>

	<div class="experience-card">

		<header class="experience-card__header">

			<span
				class="experience-card__header-icon experience-card__header-icon--green"
				aria-hidden="true"
			>
				✓
			</span>

			<h2 id="experience-achievements-title">
				<?php esc_html_e( 'What I’ve Done', 'myportfolio' ); ?>
			</h2>

		</header>

		<ul class="experience-achievements__list">

			<?php foreach ( $achievements as $achievement ) : ?>

				<li>

					<span
						class="experience-achievements__check"
						aria-hidden="true"
					>
						✓
					</span>

					<span>
						<?php echo esc_html( $achievement ); ?>
					</span>

				</li>

			<?php endforeach; ?>

		</ul>

	</div>

</section>