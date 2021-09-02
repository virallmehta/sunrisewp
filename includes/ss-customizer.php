<?php

/**
 * Theme Customizer
 *
 */
add_action( 'customize_register', 'ss_customize_register' );
function ss_customize_register( $wp_customize ) {
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->remove_section('colors');

    $wp_customize->add_section( 'general_color_section', array(
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => __( 'General Color', SS_DOMAIN ),
        'description'       => __( 'These colours are used throughout the theme to give your site consistent styling, these would likely be colours from your identity colour scheme.', SS_DOMAIN ),
        'priority'          => 10,
    ) );

    $wp_customize->add_setting( 'general_background_color', array(	
    	'default' 	=> '#ffffff',
    	'transport'	=> 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'general_text_color', array(    
        'default'   => '#101010',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );    

    $wp_customize->add_setting( 'general_link_color', array(    
        'default'   => '#e50000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'general_link_hover_color', array(    
        'default'   => '#930000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    // $wp_customize->add_setting( 'general_h1_color', array(    
    //     'default'   => '#1d1d1d',
    //     'transport' => 'postMessage',
    //     'sanitize_callback' => 'sanitize_hex_color',
    // ) );

    // $wp_customize->add_setting( 'general_h2_color', array(    
    //     'default'   => '#1d1d1d',
    //     'transport' => 'postMessage',
    //     'sanitize_callback' => 'sanitize_hex_color',
    // ) );

    // $wp_customize->add_setting( 'general_h3_color', array(    
    //     'default'   => '#1d1d1d',
    //     'transport' => 'postMessage',
    //     'sanitize_callback' => 'sanitize_hex_color',
    // ) );

    // $wp_customize->add_setting( 'general_h4_color', array(    
    //     'default'   => '#1d1d1d',
    //     'transport' => 'postMessage',
    //     'sanitize_callback' => 'sanitize_hex_color',
    // ) );

    // $wp_customize->add_setting( 'general_h5_color', array(    
    //     'default'   => '#1d1d1d',
    //     'transport' => 'postMessage',
    //     'sanitize_callback' => 'sanitize_hex_color',
    // ) );

    // $wp_customize->add_setting( 'general_h6_color', array(    
    //     'default'   => '#1d1d1d',
    //     'transport' => 'postMessage',
    //     'sanitize_callback' => 'sanitize_hex_color',
    // ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_background_color', array(
		'label'   => __( 'Background Color', SS_DOMAIN ),
		'section' => 'general_color_section',
		'settings'   => 'general_background_color',
	) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_text_color', array(
        'label'   => __( 'Text Color', SS_DOMAIN ),
        'section' => 'general_color_section',
        'settings'   => 'general_text_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_link_color', array(
        'label'   => __( 'Link Color', SS_DOMAIN ),
        'section' => 'general_color_section',
        'settings'   => 'general_link_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_link_hover_color', array(
        'label'   => __( 'Link Hover Color', SS_DOMAIN ),
        'section' => 'general_color_section',
        'settings'   => 'general_link_hover_color',
    ) ) );

    // $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_h1_color', array(
    //     'label'   => __( 'H1 Color', SS_DOMAIN ),
    //     'section' => 'general_color_section',
    //     'settings'   => 'general_h1_color',
    // ) ) );

    // $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_h2_color', array(
    //     'label'   => __( 'H2 Color', SS_DOMAIN ),
    //     'section' => 'general_color_section',
    //     'settings'   => 'general_h2_color',
    // ) ) );

    // $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_h3_color', array(
    //     'label'   => __( 'H3 Color', SS_DOMAIN ),
    //     'section' => 'general_color_section',
    //     'settings'   => 'general_h3_color',
    // ) ) );

    // $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_h4_color', array(
    //     'label'   => __( 'H4 Color', SS_DOMAIN ),
    //     'section' => 'general_color_section',
    //     'settings'   => 'general_h4_color',
    // ) ) );

    // $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_h5_color', array(
    //     'label'   => __( 'H5 Color', SS_DOMAIN ),
    //     'section' => 'general_color_section',
    //     'settings'   => 'general_h5_color',
    // ) ) );

    // $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_h6_color', array(
    //     'label'   => __( 'H6 Color', SS_DOMAIN ),
    //     'section' => 'general_color_section',
    //     'settings'   => 'general_h6_color',
    // ) ) );

    $wp_customize->add_section( 'topbar_color_section', array(
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => __( 'Topbar Color', SS_DOMAIN ),
        'description'       => __( 'These colours are used throughout the theme to give your site consistent styling, these would likely be colours from your identity colour scheme.', SS_DOMAIN ),
        'priority'          => 11,
    ) );


    $wp_customize->add_setting( 'topbar_background_color', array(    
        'default'   => '#ffffff',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'topbar_text_color', array(    
        'default'   => '#1e1e1e',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'topbar_link_color', array(    
        'default'   => '#1e1e1e',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'topbar_link_hover_color', array(    
        'default'   => '#000000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_background_color', array(
        'label'   => __( 'Topbar Background Color', SS_DOMAIN ),
        'section' => 'topbar_color_section',
        'settings'   => 'topbar_background_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_text_color', array(
        'label'   => __( 'Topbar text Color', SS_DOMAIN ),
        'section' => 'topbar_color_section',
        'settings'   => 'topbar_text_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_link_color', array(
        'label'   => __( 'Topbar link Color', SS_DOMAIN ),
        'section' => 'topbar_color_section',
        'settings'   => 'topbar_link_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_link_hover_color', array(
        'label'   => __( 'Topbar Link Hover Color', SS_DOMAIN ),
        'section' => 'topbar_color_section',
        'settings'   => 'topbar_link_hover_color',
    ) ) );

    $wp_customize->add_section( 'header_color_section', array(
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => __( 'Header Color', SS_DOMAIN ),
        'description'       => __( 'These colours are used throughout the theme to give your site consistent styling, these would likely be colours from your identity colour scheme.', SS_DOMAIN ),
        'priority'          => 12,
    ) );


    $wp_customize->add_setting( 'header_background_color', array(    
        'default'   => '#ffffff',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    // $wp_customize->add_setting( 'header_background_image', array(
    //     'transport' => 'postMessage',
    // ) );

    $wp_customize->add_setting( 'header_text_color', array(    
        'default'   => '#ffffff',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'header_link_color', array(    
        'default'   => '#000000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'header_link_hover_color', array(    
        'default'   => '#000000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
        'label'   => __( 'Header Background Color', SS_DOMAIN ),
        'section' => 'header_color_section',
        'settings'   => 'header_background_color',
    ) ) );

    // $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_background_image', array(
    //     'label'    => __( 'Upload background image ', SS_DOMAIN ),
    //     'section'  => 'header_color_section',
    //     'settings' => 'header_background_image',
    // ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_text_color', array(
        'label'   => __( 'Header Text Color', SS_DOMAIN ),
        'section' => 'header_color_section',
        'settings'   => 'header_text_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_link_color', array(
        'label'   => __( 'Header link Color', SS_DOMAIN ),
        'section' => 'header_color_section',
        'settings'   => 'header_link_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_link_hover_color', array(
        'label'   => __( 'Header Link Hover Color', SS_DOMAIN ),
        'section' => 'header_color_section',
        'settings'   => 'header_link_hover_color',
    ) ) );

    $wp_customize->add_section( 'footer_color_section', array(
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => __( 'Footer Color', SS_DOMAIN ),
        'description'       => __( 'These colours are used throughout the theme to give your site consistent styling, these would likely be colours from your identity colour scheme.', SS_DOMAIN ),
        'priority'          => 14,
    ) );

    $wp_customize->add_setting( 'footer_background_color', array(    
        'default'   => '#191919',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'footer_text_color', array(    
        'default'   => '#ffffff',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'footer_link_color', array(    
        'default'   => '#ffffff',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'footer_link_hover_color', array(    
        'default'   => '#9e9e9e',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'footer_copyright_background_color', array(    
        'default'   => '#ffffff',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'footer_copyright_text_color', array(    
        'default'   => '#000000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'footer_copyright_link_color', array(    
        'default'   => '#000000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'footer_copyright_link_hover_color', array(    
        'default'   => '#000000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background_color', array(
        'label'   => __( 'Footer Background Color', SS_DOMAIN ),
        'section' => 'footer_color_section',
        'settings'   => 'footer_background_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
        'label'   => __( 'Footer Text Color', SS_DOMAIN ),
        'section' => 'footer_color_section',
        'settings'   => 'footer_text_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_link_color', array(
        'label'   => __( 'Footer link Color', SS_DOMAIN ),
        'section' => 'footer_color_section',
        'settings'   => 'footer_link_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_link_hover_color', array(
        'label'   => __( 'Footer Link Hover Color', SS_DOMAIN ),
        'section' => 'footer_color_section',
        'settings'   => 'footer_link_hover_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_copyright_background_color', array(
        'label'   => __( 'Copyright Background Color', SS_DOMAIN ),
        'section' => 'footer_color_section',
        'settings'   => 'footer_copyright_background_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_copyright_text_color', array(
        'label'   => __( 'Copyright Text Color', SS_DOMAIN ),
        'section' => 'footer_color_section',
        'settings'   => 'footer_copyright_text_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_copyright_link_color', array(
        'label'   => __( 'Copyright link Color', SS_DOMAIN ),
        'section' => 'footer_color_section',
        'settings'   => 'footer_copyright_link_color',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_copyright_link_hover_color', array(
        'label'   => __( 'Copyright Link Hover Color', SS_DOMAIN ),
        'section' => 'footer_color_section',
        'settings'   => 'footer_copyright_link_hover_color',
    ) ) );

}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
add_action( 'customize_preview_init', 'ss_customize_preview' );
function ss_customize_preview() {
    wp_enqueue_script( 'ss-customizer', get_template_directory_uri() . '/js/ss-customizer.js', array('jquery', 'customize-preview'), '', true);
} 

?>