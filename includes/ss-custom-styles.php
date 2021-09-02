<?php
if( ! function_exists( 'ss_custom_customizer_css' ) ){
	function ss_custom_customizer_css() {
		global $ss_theme_options;

	    $general_css = array( 'body' => array(
	                'background-color'  => get_theme_mod('general_background_color'),
	                'color'             => get_theme_mod('general_text_color'),
	            ),
	            'a, a:visited'      => array(
	                'color'         => get_theme_mod('general_link_color'),
	            ),
	            'a:hover, a:focus'  => array(
	                'color'         => get_theme_mod('general_link_hover_color'),
	            ),
	            'h1'  => array(
	                'color'         => get_theme_mod('general_h1_color'),
	            ),
	            'h2'  => array(
	                'color'         => get_theme_mod('general_h2_color'),
	            ),
	            'h3'  => array(
	                'color'         => get_theme_mod('general_h3_color'),
	            ),
	            'h4'  => array(
	                'color'         => get_theme_mod('general_h4_color'),
	            ),
	            'h5'  => array(
	                'color'         => get_theme_mod('general_h5_color'),
	            ),
	            'h6'  => array(
	                'color'         => get_theme_mod('general_h6_color'),
	            ),
	        );

	    $topbar_css = array( '#top-header-bar' => array( 
	                'background-color'  => get_theme_mod('topbar_background_color'),
	                'color'             => get_theme_mod('topbar_text_color'),
	            ), 
	            '#top-header-bar a' => array(
	                'color'         => get_theme_mod('topbar_link_color'),
	            ),
	            '#top-header-bar a:hover, #top-header-bar .menu > li > a:hover' => array(
	                'color'         => get_theme_mod('topbar_link_color'),
	            ),
	        );

	    $header_css = array( '#header'  => array(
	                'background-color'  => get_theme_mod('header_background_color'),
	                'color'             => get_theme_mod('header_text_color'),
	            ),
	            '#header a' => array(
	                'color'         => get_theme_mod('header_link_color'),
	            ),
	            '#header a:hover, #header .menu > li > a:hover' => array(
	                'color'         => get_theme_mod('header_link_color'),
	            ),

	        );

	    //$navigation_css, $mobile_css = '';

	    $footer_css = array( '#footer' => array(
	                'background-color'  => get_theme_mod('footer_background_color'),
	                'color'             => get_theme_mod('footer_text_color'),
	            ),
	            '#footer-widgets a, #footer-widgets .menu > li > a' => array(
	                'color'             => get_theme_mod('footer_link_color'),
	            ),
	            '#footer-widgets a:hover, #footer-widgets .menu > li > a:hover' => array(
	                'color'             => get_theme_mod('footer_link_hover_color'),
	            ),
	            '.copyright-social-bar' => array(
	                'background-color'  => get_theme_mod('footer_copyright_background_color'),
	                'color'             => get_theme_mod('footer_copyright_text_color'),
	            ),
	            '.copyright-social-bar a, .copyright-social-bar .menu > li > a' => array(
	                'color' => get_theme_mod('footer_copyright_link_color'),
	            ),
	            '.copyright-social-bar a:hover, .copyright-social-bar .menu > li > a:hover' => array(
	                'color' => get_theme_mod('footer_copyright_link_hover_color'),
	            ),
	        );


	    echo "<style type='text/css'> \n" . ss_generate_css_properties( array_merge( $general_css, $topbar_css, $header_css, $footer_css ) ) . "</style>\n";
	}
	add_action( 'wp_head', 'ss_custom_customizer_css');
}

if( ! function_exists( 'ss_add_slug_body_class' ) ){
	function ss_add_slug_body_class( $classes ) {
	    global $post, $ss_theme_options;
	    
	    if ( isset( $post ) ) {
	        $classes[] = $post->post_type . '-' . $post->post_name;
	    }

	    $classes[] = $ss_theme_options['page_layout'];

	    return $classes;
	}

	add_filter( 'body_class', 'ss_add_slug_body_class' );
}

?>
