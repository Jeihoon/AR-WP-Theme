<?php
/**
 * AR-Theme – Logo Switcher helper
 * Usage: echo \ARTheme\LogoSwitcher\ar_get_logo( 'default' | 'transparent' | 'sticky' );
 */

namespace ARTheme\LogoSwitcher;

/* add two extra logo settings to the Customizer */
add_action( 'customize_register', function ( $c ){

	foreach ( [
		'logo_transparent' => __( 'Transparent Header Logo', 'ar-theme' ),
		'logo_sticky'      => __( 'Sticky Header Logo',      'ar-theme' ),
	] as $id => $label ) {

		$c->add_setting( $id, [ 'type'=>'theme_mod', 'transport'=>'refresh' ] );
		$c->add_control(
			new \WP_Customize_Media_Control(
				$c,
				$id,
				[ 'label'=> $label, 'section'=>'title_tagline', 'mime_type'=>'image' ]
			)
		);
	}
} );

/**
 * Return an <img> tag for the requested context
 * Skips duplicate output if same ID as the default logo.
 */
function ar_get_logo( string $context = 'default' ) : string {

	$ids = [
		'default'     => get_theme_mod( 'custom_logo' ),
		'transparent' => get_theme_mod( 'logo_transparent' ),
		'sticky'      => get_theme_mod( 'logo_sticky' ),
	];

	$id = $ids[ $context ] ?: $ids['default'];
	if ( ! $id ) return '';

	/* avoid duplicates */
	if ( $context !== 'default' && $id === $ids['default'] ) {
		return '';                              /* same image – skip */
	}

	$src = wp_get_attachment_image_url( $id, 'full' );
	if ( ! $src ) return '';

	return sprintf(
		'<img src="%s" alt="%s" class="logo-%s" style="height:64px;">',
		esc_url( $src ),
		esc_attr( get_bloginfo( 'name' ) ),
		esc_attr( $context )
	);
}
