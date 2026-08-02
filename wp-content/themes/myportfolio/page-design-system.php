<?php
/**
 * Template Name: Design System Preview
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main-content" class="site-main">

    <section class="section">

        <div class="container">

            <header class="section-heading">

                <div class="section-heading__content">

                    <p class="section-heading__eyebrow">
                        MyPortfolio UI
                    </p>

                    <h1 class="section-heading__title">
                        Design System Preview
                    </h1>

                    <p class="section-heading__description">
                        A visual reference for reusable buttons, badges,
                        headings and responsive grid layouts.
                    </p>

                </div>

                <div class="section-heading__action">

                    <a class="button button--primary" href="#">
                        Primary Action
                    </a>

                </div>

            </header>

            <div class="stack" style="--stack-gap: var(--space-9);">

                <section class="stack">

                    <h2>Buttons</h2>

                    <div class="cluster">

                        <a class="button button--primary" href="#">
                            Primary
                        </a>

                        <a class="button button--accent" href="#">
                            Accent
                        </a>

                        <a class="button button--secondary" href="#">
                            Secondary
                        </a>

                        <a class="button button--outline" href="#">
                            Outline
                        </a>

                        <a class="button button--text" href="#">
                            Text Button
                        </a>

                    </div>

                </section>

                <section class="stack">

                    <h2>Badges</h2>

                    <div class="cluster">

                        <span class="badge">PHP</span>

                        <span class="badge badge--primary">
                            WordPress
                        </span>

                        <span class="badge badge--accent">
                            Laravel
                        </span>

                        <span class="badge badge--success badge--dot">
                            Available
                        </span>

                        <span class="badge badge--soft">
                            REST API
                        </span>

                    </div>

                </section>

                <section class="stack">

                    <h2>Responsive Grid</h2>

                    <div class="grid grid--3">

                        <?php for ( $item = 1; $item <= 3; $item++ ) : ?>

                            <div
                                style="
                                    padding: var(--space-7);
                                    border: 1px solid var(--color-border);
                                    border-radius: var(--radius-md);
                                    background: var(--color-surface);
                                "
                            >
                                <h3>
                                    Component <?php echo esc_html( $item ); ?>
                                </h3>

                                <p>
                                    Reusable responsive grid demonstration.
                                </p>
                            </div>

                        <?php endfor; ?>

                    </div>

                </section>

            </div>

        </div>

    </section>

    <section class="stack" style="--stack-gap: var(--space-6);">

    <header class="section-heading section-heading--compact">

        <div class="section-heading__content">

            <p class="section-heading__eyebrow">
                Portfolio Components
            </p>

            <h2 class="section-heading__title">
                Project Cards
            </h2>

            <p class="section-heading__description">
                Reusable project cards with technology tags,
                live links, GitHub links and case-study actions.
            </p>

        </div>

    </header>

    <div class="grid grid--3">

        <?php
        get_template_part(
            'template-parts/cards/card-project',
            null,
            array(
                'title'        => 'Healthcare Platform',
                'description'  => 'A custom WordPress platform with appointment management, reusable content modules and API integrations.',
                'image_url'    => 'https://placehold.co/800x450/f7e5e5/772b3a?text=Healthcare+Platform',
                'image_alt'    => 'Healthcare platform project preview',
                'project_url'  => '#',
                'live_url'     => '#',
                'github_url'   => '#',
                'case_url'     => '#',
                'type'         => 'Healthcare',
                'technologies' => array(
                    'WordPress',
                    'PHP',
                    'REST API',
                ),
            )
        );

        get_template_part(
            'template-parts/cards/card-project',
            null,
            array(
                'title'        => 'Education Portal',
                'description'  => 'An education website with dynamic content management, custom post types and responsive page components.',
                'image_url'    => 'https://placehold.co/800x450/e5edf7/243f68?text=Education+Portal',
                'image_alt'    => 'Education portal project preview',
                'project_url'  => '#',
                'live_url'     => '#',
                'github_url'   => '#',
                'case_url'     => '#',
                'type'         => 'Education',
                'technologies' => array(
                    'WordPress',
                    'MySQL',
                    'Custom Theme',
                ),
            )
        );

        get_template_part(
            'template-parts/cards/card-project',
            null,
            array(
                'title'        => 'Business Application',
                'description'  => 'A Laravel application with secure authentication, database management and third-party integrations.',
                'image_url'    => 'https://placehold.co/800x450/e8f0eb/203f31?text=Business+Application',
                'image_alt'    => 'Business application project preview',
                'project_url'  => '#',
                'live_url'     => '#',
                'github_url'   => '#',
                'case_url'     => '#',
                'type'         => 'Web Application',
                'technologies' => array(
                    'Laravel',
                    'PHP',
                    'MySQL',
                ),
            )
        );
        ?>

    </div>
<div style="margin-top: var(--space-9);">

    <?php
    get_template_part(
        'template-parts/cards/card-project',
        null,
        array(
            'title'        => 'Featured Portfolio Platform',
            'description'  => 'A reusable portfolio framework with modular CSS, dynamic WordPress content, accessible components and a custom core plugin.',
            'image_url'    => 'https://placehold.co/1000x700/faead8/203f31?text=Featured+Project',
            'image_alt'    => 'Featured portfolio project preview',
            'project_url'  => '#',
            'live_url'     => '#',
            'github_url'   => '#',
            'case_url'     => '#',
            'type'         => 'Featured Project',
            'technologies' => array(
                'PHP',
                'WordPress',
                'JavaScript',
                'Modular CSS',
            ),
            'variant'      => 'featured',
        )
    );
    ?>

</div>
</section>
</main>

<?php
get_footer();