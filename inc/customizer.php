<?php
/**
 * AR Theme – Customizer (colors) + Loader controls/output (robust hide)
 * Drop in functions.php or /customizer/customizer.php
 */

/* ------------------------------- */
/* COLORS (your original block)    */
/* ------------------------------- */
add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'ar_colors', [
        'title'    => __( 'AR Theme Colors', 'ar-theme' ),
        'priority' => 30,
    ] );

    // Primary accent color
    $wp_customize->add_setting( 'ar_accent', [
        'default'           => '#0d6efd',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'ar_accent',
        [
            'section' => 'ar_colors',
            'label'   => __( 'Primary Accent Color', 'ar-theme' ),
        ]
    ) );

    // Secondary color
    $wp_customize->add_setting( 'ar_secondary', [
        'default'           => '#6c757d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'ar_secondary',
        [
            'section' => 'ar_colors',
            'label'   => __( 'Secondary Color', 'ar-theme' ),
        ]
    ) );

    // Paragraph text color
    $wp_customize->add_setting( 'ar_paragraph', [
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'ar_paragraph',
        [
            'section' => 'ar_colors',
            'label'   => __( 'Paragraph Text Color', 'ar-theme' ),
        ]
    ) );

    // Heading color
    $wp_customize->add_setting( 'ar_heading', [
        'default'           => '#222222',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'ar_heading',
        [
            'section' => 'ar_colors',
            'label'   => __( 'Heading Color', 'ar-theme' ),
        ]
    ) );

    // Menu underline color
    $wp_customize->add_setting( 'ar_menu_underline', [
        'default'           => '#0d6efd',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'ar_menu_underline',
        [
            'section' => 'ar_colors',
            'label'   => __( 'Menu Underline Color', 'ar-theme' ),
        ]
    ) );

    // Footer background color
    $wp_customize->add_setting( 'ar_footer_bg', [
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'ar_footer_bg',
        [
            'section' => 'ar_colors',
            'label'   => __( 'Footer Background Color', 'ar-theme' ),
        ]
    ) );

    // Footer title color
    $wp_customize->add_setting( 'ar_footer_title', [
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'ar_footer_title',
        [
            'section' => 'ar_colors',
            'label'   => __( 'Footer Widget Title Color', 'ar-theme' ),
        ]
    ) );

    // Footer text/link color
    $wp_customize->add_setting( 'ar_footer_text', [
        'default'           => '#555555',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'ar_footer_text',
        [
            'section' => 'ar_colors',
            'label'   => __( 'Footer Text Color', 'ar-theme' ),
        ]
    ) );

    // Page background color
    $wp_customize->add_setting( 'ar_page_bg', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'ar_page_bg',
        [
            'section' => 'ar_colors',
            'label'   => __( 'Page Background Color', 'ar-theme' ),
        ]
    ) );
} );

/* ------------------------------- */
/* LOADER: Customizer controls     */
/* ------------------------------- */
add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'ar_loader', [
        'title'       => __( 'Loader', 'ar-theme' ),
        'priority'    => 25,
        'description' => __( 'Control the page preloader overlay.', 'ar-theme' ),
    ] );

    // Enable/Disable
    $wp_customize->add_setting( 'ar_loader_enable', [
        'default'           => 1,
        'sanitize_callback' => function( $v ){ return (int) ( $v ? 1 : 0 ); },
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'ar_loader_enable', [
        'type'    => 'checkbox',
        'section' => 'ar_loader',
        'label'   => __( 'Enable Loader', 'ar-theme' ),
    ] );

    // Background color
    $wp_customize->add_setting( 'ar_loader_bg', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'ar_loader_bg',
        [
            'section' => 'ar_loader',
            'label'   => __( 'Loader Background', 'ar-theme' ),
        ]
    ) );

    // Spinner color
    $wp_customize->add_setting( 'ar_loader_spinner', [
        'default'           => '#0d6efd',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'ar_loader_spinner',
        [
            'section' => 'ar_loader',
            'label'   => __( 'Spinner Color', 'ar-theme' ),
        ]
    ) );

    // Hide delay (ms)
    $wp_customize->add_setting( 'ar_loader_delay', [
        'default'           => 600,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'ar_loader_delay', [
        'type'        => 'number',
        'section'     => 'ar_loader',
        'label'       => __( 'Hide Delay (ms)', 'ar-theme' ),
        'input_attrs' => [ 'min' => 0, 'max' => 5000, 'step' => 50 ],
    ] );
} );

/* ------------------------------- */
/* LOADER: Markup                  */
/* ------------------------------- */
function ar_render_loader_markup() {
    if ( ! get_theme_mod( 'ar_loader_enable', 1 ) ) { return; } ?>
    <div id="ar-page-loader" class="ar-loader" aria-hidden="true">
        <div class="ar-loader-spinner" role="status" aria-label="<?php esc_attr_e( 'Loading', 'ar-theme' ); ?>"></div>
    </div>
<?php }
add_action( 'wp_body_open', 'ar_render_loader_markup' );

/* Fallback if theme lacks wp_body_open */
add_action( 'wp_footer', function(){
    if( ! get_theme_mod( 'ar_loader_enable', 1 ) ) return;
    if ( ! did_action('wp_body_open') ) ar_render_loader_markup();
}, 5 );

/* ------------------------------- */
/* LOADER: CSS + ROBUST JS         */
/* ------------------------------- */
add_action( 'wp_head', function () {
    if ( ! get_theme_mod( 'ar_loader_enable', 1 ) ) { return; }

    $bg    = sanitize_hex_color( get_theme_mod( 'ar_loader_bg', '#ffffff' ) ) ?: '#ffffff';
    $spin  = sanitize_hex_color( get_theme_mod( 'ar_loader_spinner', '#0d6efd' ) ) ?: '#0d6efd';
    $delay = absint( get_theme_mod( 'ar_loader_delay', 600 ) );
    ?>
    <style id="ar-loader-css">
      :root{
        --ar-loader-bg: <?php echo esc_html( $bg ); ?>;
        --ar-loader-spinner: <?php echo esc_html( $spin ); ?>;
      }
      #ar-page-loader.ar-loader{
        position: fixed; inset: 0;
        display: flex; align-items: center; justify-content: center;
        background: var(--ar-loader-bg, #ffffff) !important;
        z-index: 2147483647;
        opacity: 1; visibility: visible;
        transition: opacity .4s ease, visibility .4s step-end;
      }
      #ar-page-loader.ar-loader.hide{ opacity: 0; visibility: hidden; }
      #ar-page-loader .ar-loader-spinner{
        width: 46px; height: 46px;
        border-radius: 50%;
        border: 3px solid rgba(0,0,0,.08);
        border-top-color: var(--ar-loader-spinner, #0d6efd) !important;
        animation: arSpin .8s linear infinite;
      }
      @keyframes arSpin { to { transform: rotate(360deg); } }
    </style>
    <script id="ar-loader-js">
      (function(){
        var delay   = <?php echo (int) $delay; ?>;
        function closeLoader(){
          var nodes = document.querySelectorAll('#ar-page-loader');
          if(!nodes.length) return;
          nodes.forEach(function(loader){
            loader.classList.add('hide');
            setTimeout(function(){
              if(loader && loader.parentNode){ loader.parentNode.removeChild(loader); }
            }, 500);
          });
        }

        // If load already fired (e.g., Customizer selective refresh)
        if (document.readyState === 'complete') {
          setTimeout(closeLoader, delay);
        } else {
          window.addEventListener('load', function(){ setTimeout(closeLoader, delay); }, { once:true });
        }

        // BFCache restore (back/forward cache)
        window.addEventListener('pageshow', function(e){
          if (e.persisted) { setTimeout(closeLoader, 50); }
        });

        // Absolute failsafe in case load never fires
        setTimeout(closeLoader, Math.max(delay + 2000, 2500));
      })();
    </script>
    <?php
} );
