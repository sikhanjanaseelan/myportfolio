<?php
/**
 * Reusable developer code window.
 *
 * @package MyPortfolio
 */

defined( 'ABSPATH' ) || exit;

$defaults = array(
    'filename' => 'functions.php',
    'status'   => 'PHP',
);

$data = wp_parse_args( $args ?? array(), $defaults );
?>

<div class="code-window">

    <div class="code-window__topbar">

        <div class="code-window__controls" aria-hidden="true">
            <span class="code-window__control code-window__control--red"></span>
            <span class="code-window__control code-window__control--yellow"></span>
            <span class="code-window__control code-window__control--green"></span>
        </div>

        <div class="code-window__tabs">

            <span class="code-window__tab code-window__tab--active">
                <?php echo esc_html( $data['filename'] ); ?>
            </span>

        </div>

        <span class="code-window__status">
            <?php echo esc_html( $data['status'] ); ?>
        </span>

    </div>

    <div class="code-window__workspace">

        <aside class="code-window__sidebar" aria-hidden="true">
            <span class="code-window__sidebar-icon">⌂</span>
            <span class="code-window__sidebar-icon">□</span>
            <span class="code-window__sidebar-icon code-window__sidebar-icon--active">&lt;/&gt;</span>
            <span class="code-window__sidebar-icon">◉</span>
            <span class="code-window__sidebar-icon">⌁</span>
        </aside>

        <div class="code-window__editor">

            <code class="code-window__code">

                <span class="code-window__line-number">1</span>
                <span class="code-window__line"><span class="code-token--php">&lt;?php</span></span>

                <span class="code-window__line-number">2</span>
                <span class="code-window__line"></span>

                <span class="code-window__line-number">3</span>
                <span class="code-window__line"><span class="code-token--keyword">function</span> <span class="code-token--function">build_solution</span>( <span class="code-token--variable">$idea</span> ) {</span>

                <span class="code-window__line-number">4</span>
                <span class="code-window__line">    <span class="code-token--variable">$plan</span> <span class="code-token--operator">=</span> <span class="code-token--function">analyse</span>( <span class="code-token--variable">$idea</span> );</span>

                <span class="code-window__line-number">5</span>
                <span class="code-window__line">    <span class="code-token--variable">$design</span> <span class="code-token--operator">=</span> <span class="code-token--function">architect</span>( <span class="code-token--variable">$plan</span> );</span>

                <span class="code-window__line-number">6</span>
                <span class="code-window__line">    <span class="code-token--variable">$product</span> <span class="code-token--operator">=</span> <span class="code-token--function">develop</span>( <span class="code-token--variable">$design</span> );</span>

                <span class="code-window__line-number">7</span>
                <span class="code-window__line">    <span class="code-token--variable">$result</span> <span class="code-token--operator">=</span> <span class="code-token--function">optimize</span>( <span class="code-token--variable">$product</span> );</span>

                <span class="code-window__line-number">8</span>
                <span class="code-window__line"></span>

                <span class="code-window__line-number">9</span>
                <span class="code-window__line">    <span class="code-token--keyword">return</span> <span class="code-token--variable">$result</span>;</span>

                <span class="code-window__line-number">10</span>
                <span class="code-window__line">}</span>

                <span class="code-window__line-number">11</span>
                <span class="code-window__line"></span>

                <span class="code-window__line-number">12</span>
                <span class="code-window__line"><span class="code-token--comment">// Building maintainable digital products.</span></span>

            </code>

        </div>

    </div>

    <div class="code-window__footer">

        <span class="code-window__technology">
            <span class="code-window__technology-mark">PHP</span>
            PHP
        </span>

        <span class="code-window__technology">
            <span class="code-window__technology-mark">L</span>
            Laravel
        </span>

        <span class="code-window__technology">
            <span class="code-window__technology-mark">W</span>
            WordPress
        </span>

        <span class="code-window__technology">
            <span class="code-window__technology-mark">API</span>
            REST API
        </span>

    </div>

</div>