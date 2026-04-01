<?php
// inc/editor-dynamic-colors.php

// Dynamically inject Customizer accent color into block editor
add_action( 'enqueue_block_editor_assets', function() {
    $accent    = get_theme_mod( 'ar_accent', '#0d6efd' );
    $secondary = get_theme_mod( 'ar_secondary', '#6c757d' );

    $custom_css = "
      :root {
        --ar-accent: {$accent};
        --ar-secondary: {$secondary};
      }
      .wp-block-button .wp-block-button__link {
        background-color: var(--ar-accent) !important;
        border-color:     var(--ar-accent) !important;
        color: #fff !important;
      }
      .wp-block-button.is-style-outline .wp-block-button__link {
        background-color: transparent !important;
        border: 1px solid var(--ar-accent) !important;
        color: var(--ar-accent) !important;
      }
      h1, h2, h3, h4, h5, h6 {
        color: var(--ar-heading, #222) !important;
      }
    ";
    wp_add_inline_style( 'wp-edit-blocks', $custom_css );
});
