

<?php
/**
 * Template part for when no posts are found
 *
 * @package AR_Theme
 */
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <main class="col-12 col-md-8 col-lg-6">
    <section class="ar-no-content py-5 text-center">
  <h2><?php esc_html_e( 'Nothing Found', 'ar-theme' ); ?></h2>
  <p><?php esc_html_e( 'It looks like nothing matched your search terms. Give it another try!', 'ar-theme' ); ?></p>
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
</section>
    </main>
  </div>
</div>