<?php
/**
 * Fullscreen search overlay with slide-down animation
 *
 * @package AR_Theme
 */
?>
<div class="ar-search-wrapper">
  <button type="button" class="ar-search-icon" aria-label="Open search">
    <i class="fas fa-search"></i>
  </button>

  <div class="ar-search-overlay">
    <button type="button" class="ar-search-close" aria-label="Close search">
      <i class="fas fa-times"></i>
    </button>

    <form role="search"
          method="get"
          class="ar-search-form-fullscreen"
          action="<?php echo esc_url( home_url( '/' ) ); ?>">
<input id="ar-search-field"
       type="search"
       name="s"
       autocomplete="off"
       class="ar-search-input"
       placeholder="<?php esc_attr_e( 'Search', 'ar-theme' ); ?>"
       value="" />


      <button type="submit"
              class="ar-search-submit-fullscreen"
              aria-label="<?php esc_attr_e( 'Search', 'ar-theme' ); ?>">
        <i class="fas fa-search"></i>
      </button>

      <div class="ar-live-search-results" aria-live="polite"></div>
    </form>
  </div>
</div>

