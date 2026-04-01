<?php
/**
 * Mobile header (hamburger toggles overlay menu + inline search)
 */
?>
<header class="ar-header-mobile d-block d-lg-none">
  <div class="container d-flex align-items-center justify-content-between py-3">

    <!-- Brand / Logo -->
    <div class="ar-brand me-auto">
      <?php
  // Default logo (visible before scroll)
  $default = \ARTheme\LogoSwitcher\ar_get_logo( 'default' );
  // Sticky logo (visible after scroll)
  $sticky  = \ARTheme\LogoSwitcher\ar_get_logo( 'sticky' );

  if ( $default ) {
    echo $default;
  } else {
    // fallback to site title
    echo '<a class="site-title fw-bold" href="' . esc_url( home_url() ) . '">' . get_bloginfo( 'name' ) . '</a>';
  }

  // Always echo sticky version as well
  if ( $sticky ) {
    echo $sticky;
  }
?>

    </div>

    <!-- Hamburger toggler -->
    <button id="ar-mobile-toggle"
            class="ar-hamburger"
            aria-label="<?php esc_attr_e( 'Open menu', 'ar-theme' ); ?>">
      <span></span><span></span><span></span>
    </button>
  </div>

  <?php get_template_part( 'template-parts/menus/mobile', 'overlay' ); ?>
</header>
