<?php
/**
 * Slide-in overlay used by the mobile header
 *
 * @package AR_Theme
 */
?>
<div id="ar-mobile-overlay"></div>

<nav id="ar-mobile-menu" aria-label="<?php esc_attr_e( 'Mobile menu', 'ar-theme' ); ?>">

    <!-- Logo / Site Title at top -->
    <div class="ar-mobile-brand text-left mb-4">
        <?php
        // Try to print the default Custom Logo; fallback to site title.
        $logo = \ARTheme\LogoSwitcher\ar_get_logo( 'default' );
        if ( $logo ) {
            echo $logo;
        } else {
            echo '<a class="site-title fw-bold" href="' . esc_url( home_url() ) . '">'
                 . esc_html( get_bloginfo( 'name' ) ) .
                 '</a>';
        }
        ?>
    </div>

    <!-- Close button -->
    <button class="ar-close" aria-label="<?php esc_attr_e( 'Close menu', 'ar-theme' ); ?>">&times;</button>

    <!-- Mobile navigation menu -->
    <?php
        wp_nav_menu( [
            'theme_location' => 'mobile',
            'container'      => false,
            'menu_class'     => 'ar-menu-mobile',
            'depth'          => 2,
        ] );
    ?>

    <!-- Search form at bottom of mobile menu -->
      <div class="ar-mobile-menu-search mt-4">
        <form role="search"
              method="get"
              class="ar-search-form-mobile d-flex align-items-center"
              action="<?php echo esc_url( home_url( '/' ) ); ?>">

            <label for="ar-search-field-mobile" class="visually-hidden">
                <?php esc_html_e( 'Search for:', 'ar-theme' ); ?>
            </label>

            <input id="ar-search-field-mobile"
                   type="search"
                   name="s"
                   class="form-control flex-grow-1"
                   placeholder="<?php esc_attr_e( 'Search...', 'ar-theme' ); ?>"
                   value="" />

            <button type="submit"
                    class="btn btn-outline-secondary ms-2"
                    aria-label="<?php esc_attr_e( 'Search', 'ar-theme' ); ?>">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

</nav>
