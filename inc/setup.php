<?php
if ( ! defined( 'ABSPATH' ) ) exit;
add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', [
        'height'      => 100,
        'width'       => 360,
        'flex-width'  => true,
        'flex-height' => true,
    ] );
    register_nav_menus( [
        'primary'       => __( 'Primary Desktop Menu', 'ar-theme' ),
        'mobile'        => __( 'Mobile Menu',          'ar-theme' ),
        'front_primary' => __( 'Front-page Menu',      'ar-theme' ),
    ] );
});
function ar_theme_setup() {
    // Add wide and full alignment support for Gutenberg blocks
    add_theme_support( 'align-wide' );

    // Other theme supports...
}
add_action( 'after_setup_theme', 'ar_theme_setup' );

// Register "Full Width" block style for core/columns
add_action( 'init', function() {
    register_block_style( 'core/columns', [
        'name'  => 'ar-full-width',
        'label' => __( 'Full Width', 'ar-theme' ),
    ]);
});
