<?php
// inc/mime-types.php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * Allow SVG uploads.
 */
function ar_allow_svg_uploads( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'ar_allow_svg_uploads' );
