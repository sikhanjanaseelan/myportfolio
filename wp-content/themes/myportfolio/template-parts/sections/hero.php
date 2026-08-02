<?php
/**
 * Homepage hero section.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$defaults = array(
    'availability' => '',
    'eyebrow'      => '',
    'title'        => '',
    'description'  => '',
);

$data = wp_parse_args( $args ?? array(), $defaults );
?>

<section class="hero">

    <div class="hero__background hero__background--one" aria-hidden="true"></div>
    <div class="hero__background hero__background--two" aria-hidden="true"></div>

    <div class="container container--wide">

        <div class="hero__layout">

            <div class="hero__content">

                <?php if ( $data['availability'] ) : ?>

                    <span class="badge badge--success badge--dot hero__availability">
                        <?php echo esc_html( $data['availability'] ); ?>
                    </span>

                <?php endif; ?>

                <?php if ( $data['eyebrow'] ) : ?>

                    <p class="hero__eyebrow">
                        <?php echo esc_html( $data['eyebrow'] ); ?>
                    </p>

                <?php endif; ?>

                <?php if ( $data['title'] ) : ?>

                    <h1 class="hero__title">
                        <?php echo esc_html( $data['title'] ); ?>
                    </h1>

                <?php endif; ?>

                <?php if ( $data['description'] ) : ?>

                    <p class="hero__description">
                        <?php echo esc_html( $data['description'] ); ?>
                    </p>

                <?php endif; ?>

                <div class="hero__actions">

                    <a
                        class="button button--primary button--large"
                        href="#"
                    >
                        <span aria-hidden="true">↓</span>
                        <span><?php esc_html_e( 'Download CV', 'myportfolio' ); ?></span>
                    </a>

                    <a
                        class="button button--secondary button--large"
                        href="#featured-projects"
                    >
                        <span><?php esc_html_e( 'View Projects', 'myportfolio' ); ?></span>
                        <span aria-hidden="true">→</span>
                    </a>

                </div>

                <nav
                    class="hero__socials"
                    aria-label="<?php esc_attr_e( 'Professional profiles', 'myportfolio' ); ?>"
                >

                    <a class="hero__social-link" href="#" target="_blank" rel="noopener noreferrer">
                        <span class="hero__social-icon" aria-hidden="true">GH</span>
                        <span>GitHub</span>
                    </a>

                    <a class="hero__social-link" href="#" target="_blank" rel="noopener noreferrer">
                        <span class="hero__social-icon" aria-hidden="true">in</span>
                        <span>LinkedIn</span>
                    </a>

                    <a class="hero__social-link" href="mailto:hello@example.com">
                        <span class="hero__social-icon" aria-hidden="true">@</span>
                        <span>Email</span>
                    </a>

                </nav>

                <div class="hero__capabilities">

                    <div class="hero-capability">
                        <span class="hero-capability__icon" aria-hidden="true">&lt;/&gt;</span>

                        <div>
                            <strong>Custom Theme</strong>
                            <span>Development</span>
                            <small>Clean & reusable</small>
                        </div>
                    </div>

                    <div class="hero-capability">
                        <span class="hero-capability__icon" aria-hidden="true">⌘</span>

                        <div>
                            <strong>Plugin</strong>
                            <span>Development</span>
                            <small>Powerful & modular</small>
                        </div>
                    </div>

                    <div class="hero-capability">
                        <span class="hero-capability__icon" aria-hidden="true">API</span>

                        <div>
                            <strong>REST</strong>
                            <span>APIs</span>
                            <small>Secure & scalable</small>
                        </div>
                    </div>

                    <div class="hero-capability">
                        <span class="hero-capability__icon" aria-hidden="true">✦</span>

                        <div>
                            <strong>AI Assisted</strong>
                            <span>Development</span>
                            <small>Smarter workflows</small>
                        </div>
                    </div>

                </div>

            </div>

            <div class="hero__visual">

                <?php
                get_template_part(
                    'template-parts/components/code-window',
                    null,
                    array(
                        'filename' => 'portfolio-framework.php',
                        'status'   => 'PHP',
                    )
                );
                ?>

            </div>

        </div>

        

    </div>

</section>