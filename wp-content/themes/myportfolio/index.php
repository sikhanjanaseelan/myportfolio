<?php
/**
 * Main fallback template.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main-content" class="site-main">

    <div class="container">

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : ?>

                <?php the_post(); ?>

                <article <?php post_class( 'content-entry' ); ?>>

                    <h1 class="content-entry__title">
                        <?php the_title(); ?>
                    </h1>

                    <div class="content-entry__content">
                        <?php the_content(); ?>
                    </div>

                </article>

            <?php endwhile; ?>

        <?php else : ?>

            <section class="content-empty">

                <h1>
                    <?php esc_html_e( 'Nothing found', 'myportfolio' ); ?>
                </h1>

                <p>
                    <?php esc_html_e( 'No content is currently available.', 'myportfolio' ); ?>
                </p>

            </section>

        <?php endif; ?>

    </div>

</main>

<?php
get_footer();