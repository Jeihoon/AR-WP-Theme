<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_ajax_ar_live_search', 'ar_live_search_callback' );
add_action( 'wp_ajax_nopriv_ar_live_search', 'ar_live_search_callback' );

function ar_live_search_callback() {
    check_ajax_referer( 'ar_live_search', 'nonce' );

    $term = isset( $_POST['term'] ) ? sanitize_text_field( wp_unslash( $_POST['term'] ) ) : '';
    if ( empty( $term ) ) {
        wp_send_json_success( [] );
    }

    $q = new WP_Query( [
        's'                   => $term,
        'posts_per_page'      => 5,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
    ] );

    $results = [];
    if ( $q->have_posts() ) {
        while ( $q->have_posts() ) {
            $q->the_post();
            $results[] = [
                'title' => get_the_title(),
                'url'   => get_permalink(),
            ];
        }
        wp_reset_postdata();
    }

    wp_send_json_success( $results );
}
