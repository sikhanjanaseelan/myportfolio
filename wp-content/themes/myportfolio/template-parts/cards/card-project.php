<?php
/**
 * Reusable project card.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$defaults = array(
    'title'        => '',
    'description'  => '',
    'image_url'    => '',
    'image_alt'    => '',
    'project_url'  => '#',
    'live_url'     => '',
    'github_url'   => '',
    'case_url'     => '',
    'type'         => '',
    'technologies' => array(),
    'variant'      => 'default',
);

$data = wp_parse_args( $args ?? array(), $defaults );

$allowed_variants = array(
    'default',
    'featured',
    'compact',
);

$variant = in_array(
    $data['variant'],
    $allowed_variants,
    true
) ? $data['variant'] : 'default';

$card_classes = array(
    'project-card',
    'project-card--' . $variant,
);
?>

<article class="<?php echo esc_attr( implode( ' ', $card_classes ) ); ?>">

    <div class="project-card__media">

        <?php if ( $data['image_url'] ) : ?>

            <img
                class="project-card__image"
                src="<?php echo esc_url( $data['image_url'] ); ?>"
                alt="<?php echo esc_attr( $data['image_alt'] ); ?>"
                loading="lazy"
            >

        <?php endif; ?>

        <?php if ( $data['type'] ) : ?>

            <span class="project-card__type badge badge--accent">
                <?php echo esc_html( $data['type'] ); ?>
            </span>

        <?php endif; ?>

    </div>

    <div class="project-card__body">

        <?php if ( $data['title'] ) : ?>

            <h3 class="project-card__title">

                <a href="<?php echo esc_url( $data['project_url'] ); ?>">
                    <?php echo esc_html( $data['title'] ); ?>
                </a>

            </h3>

        <?php endif; ?>

        <?php if ( $data['description'] ) : ?>

            <p class="project-card__description">
                <?php echo esc_html( $data['description'] ); ?>
            </p>

        <?php endif; ?>

        <?php if ( $data['technologies'] ) : ?>

            <div
                class="project-card__technologies"
                aria-label="<?php esc_attr_e( 'Technologies used', 'myportfolio' ); ?>"
            >

                <?php foreach ( $data['technologies'] as $technology ) : ?>

                    <span class="badge badge--soft">
                        <?php echo esc_html( $technology ); ?>
                    </span>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

        <div class="project-card__actions">

            <?php if ( $data['live_url'] ) : ?>

                <a
                    class="project-card__action"
                    href="<?php echo esc_url( $data['live_url'] ); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <span aria-hidden="true">↗</span>
                    <span><?php esc_html_e( 'Live', 'myportfolio' ); ?></span>
                </a>

            <?php endif; ?>

            <?php if ( $data['github_url'] ) : ?>

                <a
                    class="project-card__action"
                    href="<?php echo esc_url( $data['github_url'] ); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <span aria-hidden="true">&lt;/&gt;</span>
                    <span><?php esc_html_e( 'GitHub', 'myportfolio' ); ?></span>
                </a>

            <?php endif; ?>

            <?php if ( $data['case_url'] ) : ?>

                <a
                    class="project-card__action project-card__action--case-study"
                    href="<?php echo esc_url( $data['case_url'] ); ?>"
                >
                    <span><?php esc_html_e( 'Case Study', 'myportfolio' ); ?></span>
                    <span aria-hidden="true">→</span>
                </a>

            <?php endif; ?>

        </div>

    </div>

</article>