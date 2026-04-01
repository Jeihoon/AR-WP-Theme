<?php
// inc/filters.php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Filter the category count for archives.
 */
function ar_modify_archive_count( $count ) {
    // … your code …
    return $count;
}
add_filter( 'get_archives_link', 'ar_modify_archive_count' );

add_action('init', 'ar_register_full_width_column_style');
function ar_register_full_width_column_style() {
    register_block_style('core/columns', [
        'name'  => 'full-width-column',
        'label' => __('Full Width Column', 'ar-theme'),
        'style_handle' => 'ar-full-width-column-style',
    ]);
}
