<?php
// Register Full Width Column style for core/columns
add_action('init', function () {
    register_block_style('core/columns', [
        'name'  => 'full-width-column',
        'label' => __('Full Width Column', 'ar-theme'),
        'style_handle' => 'ar-theme-full-width-column-style',
    ]);
});

// Enqueue style for frontend and editor
add_action('enqueue_block_assets', function () {
    wp_enqueue_style(
        'ar-theme-full-width-column-style',
        get_template_directory_uri() . '/inc/layout/settings/full-width-column.css',
        [],
        filemtime(get_template_directory() . '/inc/layout/settings/full-width-column.css')
    );
});
