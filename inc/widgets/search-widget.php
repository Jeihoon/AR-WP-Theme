<?php
/**
 * Custom Search Widget for AR Theme (with live AJAX results)
 *
 * @package AR_Theme
 */

class AR_Search_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'ar_search_widget',
            __( 'AR Theme Search', 'ar-theme' ),
            [
                'description' => __( 'Live AJAX search field for AR Theme', 'ar-theme' ),
            ]
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        // Load the shared search form partial
        get_template_part( 'template-parts/searchform' );

        echo $args['after_widget'];
    }
}

// Register the widget
add_action( 'widgets_init', function() {
    register_widget( 'AR_Search_Widget' );
} );
