<?php
/**
 * Standard theme header wrapper.
 * Loads the correct header partials (desktop + mobile) or
 * a special transparent header when we’re on the front page.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<?php
// Helper class so CSS can style the transparent header after scroll
$body_classes = is_front_page() ? 'front-page' : '';
?>
<body <?php body_class( $body_classes ); ?>>

<?php
// ───────── Top Bar driven by Customizer ─────────
if ( get_theme_mod( 'top_bar_1_text' ) || get_theme_mod( 'top_bar_2_text' ) || get_theme_mod( 'top_bar_3_text' ) ) :
  echo '<div class="top-bar py-2"><div class="container"><div class="row align-items-center">';
  for ( $i = 1; $i <= 3; $i++ ) {
    $icon        = get_theme_mod( "top_bar_{$i}_icon" );
    $text        = get_theme_mod( "top_bar_{$i}_text", '' );
    $show_mobile = get_theme_mod( "top_bar_{$i}_show_mobile", 'yes' );

    // Column classes: 3 across, optionally hide on mobile
    $classes = 'col-12 col-md-4 d-flex align-items-center';
    if ( 'no' === $show_mobile ) {
      $classes .= ' d-none d-md-flex';
    }

    echo "<div class=\"{$classes} top-bar-col\">";
      if ( $icon ) {
        echo '<i class="' . esc_attr( $icon ) . ' me-2" aria-hidden="true"></i>';
      }
      echo esc_html( $text );
    echo '</div>';
  }
  echo '</div></div></div>';
endif;

// ───────── Header Partials ─────────
if ( is_front_page() ) {
  // transparent header on homepage
  get_template_part( 'template-parts/headers/header', 'transparent' );
} else {
  // mobile + desktop headers elsewhere
  get_template_part( 'template-parts/headers/header', 'mobile' );
  get_template_part( 'template-parts/headers/header', 'desktop' );
}
?>
