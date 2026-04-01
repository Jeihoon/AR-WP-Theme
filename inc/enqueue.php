<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Theme setup.
 */
add_action( 'after_setup_theme', function() {
    // Enable loading custom editor styles.
    add_theme_support( 'editor-styles' );

    // Allow wide/full alignment for core blocks.
    add_theme_support( 'align-wide' );
});

/**
 * Front-end assets.
 */
add_action( 'wp_enqueue_scripts', function() {
    // 1) Swiper & Hero slider (front page only)
    if ( is_front_page() ) {
        wp_enqueue_style(
            'swiper',
            'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css'
        );
        wp_enqueue_script(
            'swiper',
            'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js',
            [],
            null,
            true
        );
        wp_enqueue_script(
            'hero-swiper',
            get_theme_file_uri( 'assets/js/hero-swiper.js' ),
            [ 'swiper' ],
            null,
            true
        );
    }

    // 2) Core styles
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'
    );
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'
    );
    wp_enqueue_style(
        'ar-main',
        get_theme_file_uri( 'assets/css/main.css' ), 
        [ 'bootstrap' ],
        '1.3'
    );

    // 3) Core scripts
    wp_enqueue_script(
        'ar-main',
        get_theme_file_uri( 'assets/js/main.js' ),
        [],
        '1.2',
        true
    );

    // 4) AJAX live search
    wp_enqueue_script(
        'ar-live-search',
        get_theme_file_uri( 'assets/js/live-search.js' ),
        [ 'jquery' ],
        '1.0',
        true
    );
    wp_localize_script( 'ar-live-search', 'arLiveSearch', [
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'ar_live_search' ),
    ] );

    // 5) Full-width columns style (front-end)
    wp_enqueue_style(
        'ar-full-width-columns-style',
        get_template_directory_uri() . '/inc/layout/settings/full-width.css',
        [],
        filemtime( get_template_directory() . '/inc/layout/settings/full-width.css' )
    );

    // 6) Bootstrap-align overrides (front-end)
    wp_enqueue_style(
        'bootstrap-align',
        get_stylesheet_directory_uri() . '/assets/css/bootstrap-align.css',
        [],
        filemtime( get_stylesheet_directory() . '/assets/css/bootstrap-align.css' )
    );
}, 20 );

/**
 * Admin: enable media uploader on post/page edit screens.
 */
add_action( 'admin_enqueue_scripts', function( $hook ) {
    if ( in_array( $hook, [ 'page.php', 'post.php', 'post-new.php' ], true ) ) {
        wp_enqueue_media();
    }
} );

/**
 * Block editor assets.
 */
add_action( 'enqueue_block_editor_assets', function() {
    // Bootstrap-align overrides in Gutenberg
    wp_enqueue_style(
        'bootstrap-align-editor',
        get_stylesheet_directory_uri() . '/assets/css/bootstrap-align.css',
        [],
        filemtime( get_stylesheet_directory() . '/assets/css/bootstrap-align.css' )
    );

    // Full-width columns style in Gutenberg
    wp_enqueue_style(
        'ar-full-width-columns-style-editor',
        get_template_directory_uri() . '/inc/layout/settings/full-width.css',
        [],
        filemtime( get_template_directory() . '/inc/layout/settings/full-width.css' )
    );
} );
