<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Output CSS variables for theme colors in both front-end and block editor.
 */
function ar_output_theme_color_vars() {
    $colors = [
        'accent'         => get_theme_mod( 'ar_accent',         '#0d6efd' ),
        'secondary'      => get_theme_mod( 'ar_secondary',      '#6c757d' ),
        'paragraph'      => get_theme_mod( 'ar_paragraph',      '#333333' ),
        'heading'        => get_theme_mod( 'ar_heading',        '#222222' ),
        'menu-underline' => get_theme_mod( 'ar_menu_underline', '#0d6efd' ),
        'footer-bg'      => get_theme_mod( 'ar_footer_bg',      '#f8f9fa' ),
        'footer-title'   => get_theme_mod( 'ar_footer_title',   '#333333' ),
        'footer-text'    => get_theme_mod( 'ar_footer_text',    '#555555' ),
        'topbar-bg'      => get_theme_mod( 'ar_topbar_bg',      '#ffffff' ),
        'topbar-text'    => get_theme_mod( 'ar_topbar_text',    '#000000' ),
        // Add this line for page background:
        'page-bg'        => get_theme_mod( 'ar_page_bg',        '#ffffff' ),
    ];

    // Build the CSS variables block.
    $css  = ":root {\n";
    foreach ( $colors as $name => $value ) {
        $css .= "  --ar-{$name}: " . esc_attr( $value ) . ";\n";
    }
    $css .= "}\n";
    // Set the body background
    $css .= "body { background-color: var(--ar-page-bg); }\n";

    // Print on the front-end.
    if ( ! is_admin() ) {
        echo "<style>{$css}</style>\n";
    }
    // Inject into the block editor.
    else {
        wp_add_inline_style( 'wp-block-editor', $css );
    }
}

// Hook for front-end <head>.
add_action( 'wp_head', 'ar_output_theme_color_vars' );

// Hook for Gutenberg editor assets.
add_action( 'enqueue_block_editor_assets', 'ar_output_theme_color_vars' );
