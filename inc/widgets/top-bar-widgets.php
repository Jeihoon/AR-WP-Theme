<?php
// inc/widgets/top-bar-widgets.php
if ( ! defined( 'ABSPATH' ) ) exit;

function ar_customize_register_top_bar( $wp_customize ) {
    // 1) Section
    $wp_customize->add_section( 'top_bar_settings', [
        'title'       => __( 'Top Bar', 'ar-theme' ),
        'priority'    => 30,
        'description' => __( 'Configure Top Bar icon, text, mobile visibility, and colors.', 'ar-theme' ),
    ] );

    // 2) Icon choices
    $icons = [
        ''                      => __( 'None', 'ar-theme' ),
        'fas fa-headphones'     => __( 'Phone', 'ar-theme' ),
        'fas fa-envelope'       => __( 'Envelope', 'ar-theme' ),
        'fas fa-map-marker-alt' => __( 'Map Marker', 'ar-theme' ),
        'fab fa-facebook-f'     => __( 'Facebook', 'ar-theme' ),
        'fab fa-twitter'        => __( 'Twitter', 'ar-theme' ),
        'fab fa-instagram'      => __( 'Instagram', 'ar-theme' ),
        'fab fa-linkedin-in'    => __( 'LinkedIn', 'ar-theme' ),
    ];

    // 3) Loop for left/center/right
    for ( $i = 1; $i <= 3; $i++ ) {
        // Icon
        $wp_customize->add_setting( "top_bar_{$i}_icon", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ] );
        $wp_customize->add_control( "top_bar_{$i}_icon", [
            'label'   => sprintf( __( 'Column %d Icon', 'ar-theme' ), $i ),
            'section' => 'top_bar_settings',
            'type'    => 'select',
            'choices' => $icons,
        ] );

        // Text
        $wp_customize->add_setting( "top_bar_{$i}_text", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ] );
        $wp_customize->add_control( "top_bar_{$i}_text", [
            'label'   => sprintf( __( 'Column %d Text', 'ar-theme' ), $i ),
            'section' => 'top_bar_settings',
            'type'    => 'text',
        ] );

        // Show on mobile?
        $wp_customize->add_setting( "top_bar_{$i}_show_mobile", [
            'default'           => 'yes',
            'sanitize_callback' => 'sanitize_text_field',
        ] );
        $wp_customize->add_control( "top_bar_{$i}_show_mobile", [
            'label'   => sprintf( __( 'Show Column %d on Mobile?', 'ar-theme' ), $i ),
            'section' => 'top_bar_settings',
            'type'    => 'radio',
            'choices' => [
                'yes' => __( 'Yes', 'ar-theme' ),
                'no'  => __( 'No',  'ar-theme' ),
            ],
        ] );
    }

    // 4) Top-bar background color
    $wp_customize->add_setting( 'ar_topbar_bg', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'ar_topbar_bg',
        [
            'label'   => __( 'Top Bar Background Color', 'ar-theme' ),
            'section' => 'top_bar_settings',
        ]
    ) );

    // 5) Top-bar text color
    $wp_customize->add_setting( 'ar_topbar_text', [
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'ar_topbar_text',
        [
            'label'   => __( 'Top Bar Text Color', 'ar-theme' ),
            'section' => 'top_bar_settings',
        ]
    ) );
}
add_action( 'customize_register', 'ar_customize_register_top_bar' );
