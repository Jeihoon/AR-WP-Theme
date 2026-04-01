<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Set 3 posts per page on the main blog index
 */
function ar_theme_posts_per_page( $query ) {
  if ( ! is_admin() && $query->is_main_query() && $query->is_home() ) {
    $query->set( 'posts_per_page', 3 );
  }
}
add_action( 'pre_get_posts', 'ar_theme_posts_per_page' );
