<?php
/**
 * About page hero.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$about_image = get_template_directory_uri()
	. '/assets/images/about/about-photo.png';
?>

<section class="about-hero">

	<div class="container container--wide">

		<nav
			class="about-hero__breadcrumb"
			aria-label="<?php esc_attr_e( 'Breadcrumb', 'myportfolio' ); ?>"
		>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php esc_html_e( 'Home', 'myportfolio' ); ?>
			</a>

			<span aria-hidden="true">›</span>

			<span>
				<?php esc_html_e( 'About', 'myportfolio' ); ?>
			</span>
		</nav>

		<div class="about-hero__grid">

			<div class="about-hero__content">

				<p class="about-hero__eyebrow">
					<?php esc_html_e( 'About Me', 'myportfolio' ); ?>
				</p>

				<h1 class="about-hero__title">
					<?php esc_html_e( 'About Me', 'myportfolio' ); ?>
				</h1>

				<p class="about-hero__lead">
					<?php
					esc_html_e(
						'Passionate developer. Problem solver. Lifelong learner.',
						'myportfolio'
					);
					?>
				</p>

				<div class="about-hero__intro">

					<p>
						<?php
						esc_html_e(
							'I’m Sikha Njanaseelan, a PHP and WordPress developer with a strong focus on building scalable, secure and user-friendly web applications.',
							'myportfolio'
						);
						?>
					</p>

					<p>
						<?php
						esc_html_e(
							'I enjoy turning ideas into digital products that make a real impact. Clean code, performance and accessibility are at the heart of everything I build.',
							'myportfolio'
						);
						?>
					</p>

				</div>

				<div class="about-hero__values">

					<article class="about-value-card">

						<div class="about-value-card__icon">
							<span aria-hidden="true">✓</span>
						</div>

						<h3>
							<?php esc_html_e( 'Quality First', 'myportfolio' ); ?>
						</h3>

						<p>
							<?php
							esc_html_e(
								'Writing clean, maintainable and scalable code.',
								'myportfolio'
							);
							?>
						</p>

					</article>

					<article class="about-value-card">

						<div class="about-value-card__icon about-value-card__icon--accent">
							<span aria-hidden="true">◎</span>
						</div>

						<h3>
							<?php esc_html_e( 'User Focused', 'myportfolio' ); ?>
						</h3>

						<p>
							<?php
							esc_html_e(
								'Building accessible and user-friendly experiences.',
								'myportfolio'
							);
							?>
						</p>

					</article>

					<article class="about-value-card">

						<div class="about-value-card__icon">
							<span aria-hidden="true">↗</span>
						</div>

						<h3>
							<?php esc_html_e( 'Always Learning', 'myportfolio' ); ?>
						</h3>

						<p>
							<?php
							esc_html_e(
								'Exploring new technologies and improving every day.',
								'myportfolio'
							);
							?>
						</p>

					</article>

					<article class="about-value-card">

						<div class="about-value-card__icon about-value-card__icon--accent">
							<span aria-hidden="true">◉</span>
						</div>

						<h3>
							<?php esc_html_e( 'Impact Driven', 'myportfolio' ); ?>
						</h3>

						<p>
							<?php
							esc_html_e(
								'Creating solutions that solve real problems.',
								'myportfolio'
							);
							?>
						</p>

					</article>

				</div>

			</div>

			<div class="about-hero__visual">

				<div class="about-hero__image-wrap">

					<img
						class="about-hero__image"
						src="<?php echo esc_url( $about_image ); ?>"
						alt="<?php esc_attr_e( 'Sikha Njanaseelan working at a laptop', 'myportfolio' ); ?>"
					>

					<div
						class="about-hero__dots"
						aria-hidden="true"
					>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
					</div>

				</div>

			</div>

		</div>

	</div>

</section>