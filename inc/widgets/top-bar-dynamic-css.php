<?php
// inc/widgets/top-bar-dynamic-css.php
if ( ! defined( 'ABSPATH' ) ) exit;

function ar_top_bar_column_visibility_css() {
    $show1 = get_theme_mod( 'top_bar_1_show_mobile', 'yes' );
    $show2 = get_theme_mod( 'top_bar_2_show_mobile', 'yes' );
    $show3 = get_theme_mod( 'top_bar_3_show_mobile', 'yes' );
    ?>
    <style>
    @media (max-width: 991.98px) {
      .top-bar .col-12.col-md-4:nth-child(1) { display: <?php echo $show1 === 'yes' ? 'flex' : 'none'; ?>; }
      .top-bar .col-12.col-md-4:nth-child(2) { display: <?php echo $show2 === 'yes' ? 'flex' : 'none'; ?>; }
      .top-bar .col-12.col-md-4:nth-child(3) { display: <?php echo $show3 === 'yes' ? 'flex' : 'none'; ?>; }
    }
    </style>
    <?php
}
add_action( 'wp_head', 'ar_top_bar_column_visibility_css' );
