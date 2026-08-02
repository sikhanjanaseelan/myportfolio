<?php
/**
 * Homepage Engineering Capabilities section.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$capabilities = array(

    array(
        'icon'  => '</>',
        'title' => 'Custom WordPress Development',
    ),

    array(
        'icon'  => '⚡',
        'title' => 'Performance Optimization',
    ),

    array(
        'icon'  => '⬢',
        'title' => 'Reusable Components',
    ),

    array(
        'icon'  => '✓',
        'title' => 'Accessibility (WCAG)',
    ),

    array(
        'icon'  => '⚙',
        'title' => 'Custom Plugin Development',
    ),

    array(
        'icon'  => '🛡',
        'title' => 'Security Best Practices',
    ),

    array(
        'icon'  => 'API',
        'title' => 'REST API Integration',
    ),

    array(
        'icon'  => 'AI',
        'title' => 'AI-Assisted Development',
    ),

);

?>

<section class="engineering-capabilities section">

    <div class="container">

        <div class="engineering-capabilities__card">

            <header class="engineering-capabilities__header">

                <p class="engineering-capabilities__eyebrow">
                    Engineering Capabilities
                </p>

            </header>

            <div class="engineering-capabilities__grid">

                <?php foreach ( $capabilities as $capability ) : ?>

                    <article class="engineering-capability">

                        <span class="engineering-capability__icon">
                            <?php echo esc_html( $capability['icon'] ); ?>
                        </span>

                        <span class="engineering-capability__title">
                            <?php echo esc_html( $capability['title'] ); ?>
                        </span>

                    </article>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</section>