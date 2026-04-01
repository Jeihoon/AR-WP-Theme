<?php
/**
 * template-parts/headers/header-desktop.php
 *
 * Desktop header – solid background, sticky on scroll.
 * Displays site logo, primary menu, and the search icon/overlay.
 * Visible on large screens only (hidden on mobile).
 */
?>
<header class="ar-header-desktop d-none d-lg-block">
  <div class="container d-flex align-items-center py-3">

    <!-- Brand / Logo hard-left -->
    <div class="ar-brand me-auto">
      <a href="<?php echo esc_url( home_url() ); ?>"
         class="site-logo d-inline-flex align-items-center">

        <?php
          // Default logo (visible before scroll)
          $default_logo = \ARTheme\LogoSwitcher\ar_get_logo( 'default' );
          if ( $default_logo ) {
            echo $default_logo;
          } else {
            echo '<span class="site-title fw-bold">' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
          }

          // Sticky logo (visible after scroll)
          echo \ARTheme\LogoSwitcher\ar_get_logo( 'sticky' );
        ?>

      </a>
    </div>

    <!-- Primary desktop menu -->
    <nav>
      <?php
        wp_nav_menu( [
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'ar-menu d-flex gap-4',
          'fallback_cb'    => false,
        ] );
      ?>
    </nav>

    <!-- Search icon & overlay -->
    <div class="ms-4">
      <?php get_template_part( 'template-parts/searchform' ); ?>
    </div>

  </div>
</header>
