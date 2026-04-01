<?php
if ( ! defined( 'ABSPATH' ) ) exit;
add_action( 'widgets_init', function () {
    register_sidebar([
        'name'          => __( 'Header Search', 'ar-theme' ),
        'id'            => 'header-search',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="d-none">',
        'after_title'   => '</h3>',
    ]);
    for ( $i = 1; $i <= 3; $i++ ) {
        register_sidebar([
            'name'          => sprintf( __( 'Above The Footer Column %d', 'ar-theme' ), $i ),
            'id'            => 'above-footer-col-' . $i,
            'description'   => sprintf( __( 'Widget area %d in the Above-Footer section.', 'ar-theme' ), $i ),
            'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title mb-3 fw-semibold">',
            'after_title'   => '</h4>',
        ]);
    }
    for ( $i = 1; $i <= 3; $i++ ) {
        register_sidebar([
            'name'          => sprintf( __( 'Footer Column %d', 'ar-theme' ), $i ),
            'id'            => 'footer-col-' . $i,
            'description'   => sprintf( __( 'Widgets in column %d of the footer.', 'ar-theme' ), $i ),
            'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title mb-3 fw-semibold">',
            'after_title'   => '</h4>',
        ]);
    }
    register_sidebar([
        'name'          => __( 'Blog Sidebar', 'ar-theme' ),
        'id'            => 'blog-sidebar',
        'description'   => __( 'Widgets displayed on the blog posts index page.', 'ar-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title mb-3">',
        'after_title'   => '</h4>',
    ]);
});