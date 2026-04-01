<?php
/**
 * Transparent header – same markup as desktop,
 * plus sticky + mobile controls.
 */
?>
<header class="ar-header-desktop ar-header-transparent">
	<div class="container d-flex align-items-center py-3">

		<!-- Brand / Logo -->
		<div class="ar-brand me-auto">
			<a href="<?php echo esc_url( home_url() ); ?>"
			   class="site-logo d-inline-flex align-items-center">

				<?php
					$logo  = \ARTheme\LogoSwitcher\ar_get_logo( 'transparent' );
					if ( ! $logo ) {                                // fallback
						$logo = \ARTheme\LogoSwitcher\ar_get_logo( 'default' );
					}
					echo $logo;                                     // visible before scroll
					echo \ARTheme\LogoSwitcher\ar_get_logo( 'sticky' ); // shows after scroll
				?>

			</a>
		</div>

		<!-- Primary desktop menu -->
		<nav class="d-none d-lg-block">
			<?php
				wp_nav_menu( [
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'ar-menu d-flex gap-4',
					'fallback_cb'    => false,
				] );
			?>
		</nav>

		<!-- Search widget (optional) -->
		<div class="ms-4 d-none d-lg-block">
			<?php dynamic_sidebar( 'header-search' ); ?>
		</div>

		<!-- Mobile hamburger -->
		<button id="ar-mobile-toggle"
				class="ar-hamburger d-lg-none ms-2"
				aria-label="<?php esc_attr_e( 'Open menu', 'ar-theme' ); ?>">
			<span></span><span></span><span></span>
		</button>
	</div>

	<?php get_template_part( 'template-parts/menus/mobile', 'overlay' ); ?>
</header>
