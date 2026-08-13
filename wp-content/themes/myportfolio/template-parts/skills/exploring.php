<?php
/**
 * Skills page - Always Exploring.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$learning_stats = array(
	array(
		'value' => '10+',
		'label' => __( 'Technologies', 'myportfolio' ),
		'icon'  => 'learn',
	),
	array(
		'value' => '500+',
		'label' => __( 'Hours of Learning', 'myportfolio' ),
		'icon'  => 'time',
	),
	array(
		'value' => '3+',
		'label' => __( 'Years of Growth', 'myportfolio' ),
		'icon'  => 'growth',
	),
);
?>

<section class="skills-exploring">

	<div class="container container--wide">

		<div class="skills-exploring__panel">

			<div class="skills-exploring__intro">

				<p class="skills-exploring__eyebrow">
					<?php esc_html_e( 'Always Exploring', 'myportfolio' ); ?>
				</p>

				<h2 class="skills-exploring__title">
					<?php esc_html_e( 'Learning is part of the work.', 'myportfolio' ); ?>
				</h2>

				<p class="skills-exploring__description">
					<?php
					esc_html_e(
						'I love learning new tools and improving my craft to build better products, faster.',
						'myportfolio'
					);
					?>
				</p>

				<blockquote class="skills-exploring__quote">

					<span
						class="skills-exploring__quote-mark"
						aria-hidden="true"
					>
						“
					</span>

					<p>
						<?php
						esc_html_e(
							'A small fact about me — every year, I probably invest more in learning new tools and technologies than I do in cosmetics. Curiosity is one expense I never regret.',
							'myportfolio'
						);
						?>
					</p>

				</blockquote>

			</div>

			<div class="skills-exploring__stats">

				<?php foreach ( $learning_stats as $stat ) : ?>

					<div class="skills-exploring__stat">

						<div
							class="skills-exploring__stat-icon"
							aria-hidden="true"
						>

							<?php if ( 'learn' === $stat['icon'] ) : ?>

								<svg
									viewBox="0 0 24 24"
									fill="none"
									stroke="currentColor"
									stroke-width="1.7"
									stroke-linecap="round"
									stroke-linejoin="round"
								>
									<path d="m3 10 9-5 9 5-9 5-9-5z"></path>
									<path d="M7 12v4c3 2 7 2 10 0v-4"></path>
								</svg>

							<?php elseif ( 'time' === $stat['icon'] ) : ?>

								<svg
									viewBox="0 0 24 24"
									fill="none"
									stroke="currentColor"
									stroke-width="1.7"
									stroke-linecap="round"
									stroke-linejoin="round"
								>
									<circle
										cx="12"
										cy="12"
										r="8"
									></circle>

									<path d="M12 8v5l3 2"></path>
								</svg>

							<?php else : ?>

								<svg
									viewBox="0 0 24 24"
									fill="none"
									stroke="currentColor"
									stroke-width="1.7"
									stroke-linecap="round"
									stroke-linejoin="round"
								>
									<circle
										cx="12"
										cy="8"
										r="4"
									></circle>

									<path d="m8.5 12.5-2 8 5.5-3 5.5 3-2-8"></path>
								</svg>

							<?php endif; ?>

						</div>

						<strong>
							<?php echo esc_html( $stat['value'] ); ?>
						</strong>

						<span>
							<?php echo esc_html( $stat['label'] ); ?>
						</span>

					</div>

				<?php endforeach; ?>

			</div>

			<div
				class="skills-exploring__plant"
				aria-hidden="true"
			>
				<span class="skills-exploring__leaf skills-exploring__leaf--1"></span>
				<span class="skills-exploring__leaf skills-exploring__leaf--2"></span>
				<span class="skills-exploring__leaf skills-exploring__leaf--3"></span>
				<span class="skills-exploring__leaf skills-exploring__leaf--4"></span>

				<span class="skills-exploring__pot"></span>
			</div>

		</div>

	</div>

</section>