<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package AR_Theme
 */

get_header();
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <main class="col-12 col-md-8 text-center ar-404-page">

      <h1 class="ar-404-title">
        <?php esc_html_e( "Oops! That page can't be found.", 'ar-theme' ); ?>
      </h1>

      <p class="ar-404-message mb-4">
        <?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search or go back home?', 'ar-theme' ); ?>
      </p>

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

      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
         class="ar-btn-readmore mt-4">
        <?php esc_html_e( 'Return to Home', 'ar-theme' ); ?>
        <i class="fas fa-arrow-right" aria-hidden="true"></i>
      </a>

    </main>
  </div>
</div>

<?php
get_footer();
