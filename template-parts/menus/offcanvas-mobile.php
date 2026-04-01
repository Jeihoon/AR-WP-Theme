<?php
/**
 * Off-canvas mobile menu with logo in header
 */
?>
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title"><?php bloginfo( 'name' ); ?></h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <?php
            wp_nav_menu( [
                'theme_location' => 'mobile',
                'container'      => false,
                'menu_class'     => 'navbar-nav',
                'depth'          => 2,
            ] );
        ?>
        <?php dynamic_sidebar( 'header-search' ); ?>
    </div>
</div>
