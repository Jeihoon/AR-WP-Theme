<?php
/**
 * Adaptive Above-Footer + Three-Column Footer for AR Theme.
 */

// ─── Above-Footer Columns 1–3 ───
$above_sidebars = [
    'above-footer-col-1',
    'above-footer-col-2',
    'above-footer-col-3',
];
$active_above = array_filter( $above_sidebars, 'is_active_sidebar' );
$count_above  = count( $active_above );

if ( $count_above ) :
    // Compute Bootstrap column width (12 / active widgets)
    $col_above = max( 1, min( 12, intval( 12 / $count_above ) ) );
    ?>
    <div class="above-footer-area">
      <div class="container">
        <div class="row gy-4">
          <?php foreach ( $active_above as $id ) : ?>
            <div class="col-12 col-md-<?php echo esc_attr( $col_above ); ?>">
              <div class="widget-content">
                <?php dynamic_sidebar( $id ); ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
<?php
endif;

// ─── Main Footer Columns 1–3 ───
$footer_sidebars = [
    'footer-col-1',
    'footer-col-2',
    'footer-col-3',
];
$active_columns = array_filter( $footer_sidebars, 'is_active_sidebar' );
$col_count      = count( $active_columns );
if ( ! $col_count ) {
    return; // nothing to show
}
$col_md = max( 1, min( 12, intval( 12 / $col_count ) ) );
?>
<footer class="ar-footer bg-light pt-5">
  <div class="container">
    <div class="row gy-4 mb-4">
      <?php foreach ( $active_columns as $id ) : ?>
        <div class="col-12 col-md-<?php echo esc_attr( $col_md ); ?>">
          <?php dynamic_sidebar( $id ); ?>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center small pb-4">
      &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>.
    </div>
  </div>
</footer>
