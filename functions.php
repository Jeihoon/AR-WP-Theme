<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Core theme setup
require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/hero-slides.php';
require get_template_directory() . '/inc/customizer.php';

// Assets & blocks
require get_template_directory() . '/inc/enqueue.php';

// Sidebars & widgets
require get_template_directory() . '/inc/sidebars.php';
require get_template_directory() . '/inc/widgets/search-widget.php';
require get_template_directory() . '/inc/widgets/recent-posts-widget.php';
require get_template_directory() . '/inc/widgets/top-bar-widgets.php';
require get_template_directory() . '/inc/widgets/top-bar-dynamic-css.php';

// Filters
require get_template_directory() . '/inc/filters.php';

// Helpers
require get_template_directory() . '/inc/logo-switcher.php';
require get_template_directory() . '/inc/theme-colors.php';
require get_template_directory() . '/inc/comments-callbacks.php';
require get_template_directory() . '/inc/ajax-search.php';
require get_template_directory() . '/inc/mime-types.php';
require get_template_directory() . '/inc/query-mods.php';
require_once get_template_directory() . '/inc/editor-dynamic-colors.php';

// Disable WordPress emoji conversion
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content', 'wp_staticize_emoji' );
remove_filter( 'the_excerpt', 'wp_staticize_emoji' );
remove_filter( 'comment_text', 'wp_staticize_emoji' );

/**
 * Enqueue Google Fonts: Mona Sans + Roboto
 */
function artheme_enqueue_google_fonts() {
    wp_enqueue_style(
        'artheme-google-fonts',
        'https://fonts.googleapis.com/css2'
        . '?family=Mona+Sans:ital,wght@0,200..900;1,200..900'
        . '&family=Roboto:wght@300;400;500;700'
        . '&display=swap',
        false
    );
}
add_action( 'wp_enqueue_scripts', 'artheme_enqueue_google_fonts' );




