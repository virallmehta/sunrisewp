<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

define('SS_DOMAIN', 'sunrise');
define('SS_TEMPLATEDIR_PATH', get_template_directory());
define('SS_INCLUDE_PATH', SS_TEMPLATEDIR_PATH . '/includes');
define('SS_WIDGETS_PATH', SS_INCLUDE_PATH . '/widgets');
define('SS_LOCAL_PATH', get_template_directory_uri());

global $theme_info;

$theme_info = wp_get_theme();
define('SS_THEME_VERSION', ( WP_DEBUG ) ? time() : $theme_info->get( 'Version' ));

require_once( SS_INCLUDE_PATH . '/aqua_resizer.php');

require_once( SS_INCLUDE_PATH . '/ss-plugins.php');

require_once( SS_WIDGETS_PATH . '/widgets.php');
//require_once( SS_WIDGETS_PATH . '/widget-video.php');
//require_once( SS_WIDGETS_PATH . '/widget-facebook-page.php');
// require_once( SS_WIDGETS_PATH . '/widget-twitter.php');
//require_once( SS_WIDGETS_PATH . '/widget-posts-carousel.php');

// Use shortcodes in Widgets
add_filter('widget_text', 'do_shortcode');

require_once( SS_INCLUDE_PATH . '/meta-box/meta-box.php');
require_once( SS_INCLUDE_PATH . '/ss-meta-boxes.php');
require_once( SS_INCLUDE_PATH . '/ss-customizer.php');
require_once( SS_INCLUDE_PATH . '/ss-custom-styles.php');

function ss_theme_debug($args) {
	echo '<pre>';
    var_dump($args);
    echo '</pre>';
}

if (!function_exists('ss_init')) {
	function ss_init() {
	    global $ss_option, $ss_theme_options;
	    
	    load_theme_textdomain('artooz', SS_TEMPLATEDIR_PATH . '/languages'); 

		add_theme_support( 'post-formats', array( 'standard', 'image', 'video' ) );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'menus' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'woocommerce' );

        /* Enable support for HTML5 markup. */
	    add_theme_support('html5', array(
	        'comment-list',
	        'search-form',
	        'comment-form',
	        'gallery',
	    ));

		/* Set the image size by cropping the image */
	    add_image_size( 'post-thumbnail', 250, 250, false );
	    add_image_size( 'post-thumbnail-large', 848, 396, false );           /* blog thumbnail */
	    add_image_size( 'post-thumbnail-large-table', 600, 300, false );     /* blog thumbnail for table */
	    add_image_size( 'post-thumbnail-large-mobile', 400, 200, false );    /* blog thumbnail for mobile */
	    add_image_size( 'post-thumbnail-gird', 292, 162, false );            /* blog thumbnail for grid */
	    add_image_size( 'post-thumbnail-list', 800, 370, false );            /* blog thumbnail for list */
	    add_image_size( 'portfolio-medium', 460, 290, false );
	    add_image_size( 'portfolio-full', 1200, 780, false );

	    add_image_size( 'shop-thumb-1', 520, 625, true );
		add_image_size( 'shop-thumb-1-large', 500, 596, true );
		add_image_size( 'shop-thumb-2', 180, 220, true );
		add_image_size( 'shop-thumb-3', 105, 135, true );
		add_image_size( 'shop-thumb-4', 580, 0 );
		add_image_size( 'shop-thumb-5', 135, 160, true );
		add_image_size( 'shop-thumb-6', 500, 500, array( 'center', 'top' ) );

	    /* CONTENT WIDTH
			================================================== */
			if ( ! isset( $content_width ) ) $content_width = 1170;

	    // Register Custom Navigation Walker

	    // Register Menus 
	    register_nav_menus( array(
	        'primary_menu' 	  => __( 'Primary Menu', SS_DOMAIN ),
	        'mobile_menu'     => __( 'Mobile Menu', SS_DOMAIN ),
	        'footer_menu'     => __( 'Footer Menu', SS_DOMAIN ),
	        'top_menu'		  => __( 'Top Menu', SS_DOMAIN)
    	) );
    
	}
	add_action( 'after_setup_theme', 'ss_init' );
}

if (!function_exists('ss_enqueue_styles')) {
	function ss_enqueue_styles() {
		global $is_IE;

        $upload_dir = wp_upload_dir();

	    wp_register_style('ss-style', get_stylesheet_directory_uri() . '/style.css', array(), SS_THEME_VERSION, 'all');

	    wp_register_style('normalize', SS_LOCAL_PATH . '/css/normalize.css', array(), SS_THEME_VERSION, 'all');
	    wp_register_style('bootstrap', SS_LOCAL_PATH . '/css/bootstrap.min.css', array(), SS_THEME_VERSION, 'all');
	    wp_register_style('fontawesome', SS_LOCAL_PATH .'/css/font-awesome.min.css', array(), SS_THEME_VERSION, 'all');
	    wp_register_style('customfont', SS_LOCAL_PATH . '/fonts/customfont.css', array(), SS_THEME_VERSION, 'all');
	    wp_register_style('easy-pie-chart', SS_LOCAL_PATH . '/css/plugins/jquery.easy-pie-chart.css', array(), SS_THEME_VERSION, 'all');
	    wp_register_style('flexslider', SS_LOCAL_PATH . '/css/flexslider.css', array(), SS_THEME_VERSION, 'all');
	    wp_register_style('woocommerce', SS_LOCAL_PATH . '/css/ss-woocommerce.css', array(), SS_THEME_VERSION, 'all');

	    wp_enqueue_style('normalize');
	    wp_enqueue_style('bootstrap');
	    wp_enqueue_style('fontawesome');
	    wp_enqueue_style('customfont');
		wp_enqueue_style('easy-pie-chart');
		wp_enqueue_style('flexslider');
		wp_enqueue_style('ss-style');

		if (ss_woocommerce_activated()) {
	    	wp_enqueue_style('woocommerce');
	    }

	}
	add_action('wp_enqueue_scripts', 'ss_enqueue_styles');
}

if (!function_exists('shikha_enqueue_scripts')) {
	function ss_enqueue_scripts() {
	    if ( !is_admin() ) {

	    	// Theme Scripts
    		wp_enqueue_script('bootstrap-js', SS_LOCAL_PATH . '/js/bootstrap.min.js', 'jquery', SS_THEME_VERSION, true);
    		wp_enqueue_script('isotope', SS_LOCAL_PATH . '/js/isotope.pkgd.min.js', 'jquery', SS_THEME_VERSION, true);	
    		wp_enqueue_script('jquery-ui', SS_LOCAL_PATH . '/js/jquery-ui-1.11.4.custom.min.js', 'jquery', SS_THEME_VERSION, true);
    		wp_enqueue_script('imagesLoaded', SS_LOCAL_PATH . '/js/imagesloaded.js', 'jquery', SS_THEME_VERSION, true);
    		wp_enqueue_script('infinite-scroll',  SS_LOCAL_PATH . '/js/jquery.infinitescroll.min.js', 'jquery', SS_THEME_VERSION, true);
	    	wp_enqueue_script('smoothscroll', SS_LOCAL_PATH . '/js/sscr.js', 'jquery', SS_THEME_VERSION, true);
	    	wp_enqueue_script('elevateZoom', SS_LOCAL_PATH . '/js/jquery.elevateZoom.min.js', 'jquery', SS_THEME_VERSION, true);
	    	wp_enqueue_script('flexslider', SS_LOCAL_PATH . '/js/jquery.flexslider-min.js', 'jquery', SS_THEME_VERSION, true);
	    	wp_enqueue_script('combinescript', SS_LOCAL_PATH . '/js/combinescripts.js', 'jquery', SS_THEME_VERSION, true);

	    	// jQuery
		    wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-cookie');

	    	wp_enqueue_script('frontend', SS_LOCAL_PATH . '/js/frontend.js', '',SS_THEME_VERSION, true);

	    }
	}
	add_action('wp_enqueue_scripts', 'ss_enqueue_scripts');
}

if ( !function_exists( 'ss_admin_scripts' ) ) {
	function ss_admin_scripts() {
	    wp_register_script('admin-functions', get_template_directory_uri() . '/js/ss-admin.js', 'jquery', '1.0', TRUE);
		wp_enqueue_script('admin-functions');
			
	}
	add_action('admin_enqueue_scripts', 'ss_admin_scripts');
}

if (!function_exists('ss_imagethumb_custom_sizes')) {
	function ss_imagethumb_custom_sizes( $sizes ) {

	    return array_merge( $sizes, array(
	        'post-thumbnail' => __( 'Small Thumb' ),
	        'post-thumbnail-large' => __( 'Blog Thumb Medium' ),
	        'post-thumbnail-large-table' => __( 'Blog Thumb for tablet' ),
	        'post-thumbnail-large-mobile' => __('Blog Thumb for Mobile'),
	        'post-thumbnail-gird' => __('Blog Thumb for Grid'),
	        'post-thumbnail-list' => __('Blog Thumb for List'),
	        'portfolio-medium' => __('Portfolio Medium'),
	        'portfolio-slim' => __('Portfolio Slim'),
	        'portfolio-full' => __('Portfolio Full'),
	    ) );
	}
	add_filter( 'image_size_names_choose', 'ss_imagethumb_custom_sizes' );
}

/* THEME OPTIONS FRAMEWORK                     */
if (!function_exists('ss_include_theme_options')) {
	function ss_include_theme_options() {
		if (!class_exists( 'ReduxFramework' )) {
		    require_once( SS_INCLUDE_PATH . '/options/ReduxCore/framework.php' );
		}
		require_once( SS_INCLUDE_PATH . '/ss-config.php' );
	}
	add_action('init', 'ss_include_theme_options', 10);
}

/* CUSTOM LOGIN LOGO 							*/
if ( ! function_exists( 'ss_custom_login_logo' ) ) {
	function ss_custom_login_logo() {
	    global $ss_theme_options;
	    $custom_logo = "";
	    if ( isset( $ss_theme_options['custom_admin_login_logo']['url'] ) ) {
	        $custom_logo = $ss_theme_options['custom_admin_login_logo']['url'];
	    }
	    if ( $custom_logo ) {
	        echo '<style type="text/css">
		    .login h1 a { background-image:url(' . $custom_logo . ') !important; height: 95px!important; width: 100%!important; background-size: auto!important; }
		</style>';
	    } else {
	        echo '<style type="text/css">
		    .login h1 a { background-image:url(' . get_template_directory_uri() . '/images/custom-login-logo.png) !important; height: 95px!important; width: 100%!important; background-size: auto!important; }
		</style>';
	    }
	}
	add_action( 'login_head', 'ss_custom_login_logo' );
}

if ( ! function_exists( 'ss_woocommerce_activated' ) ) {
    function ss_woocommerce_activated() {
        if ( class_exists( 'woocommerce' ) ) {
            return true;
        } else {
            return false;
        }
    }
}

function is_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

require_once( SS_INCLUDE_PATH . '/ss-theme-functions.php');
require_once( SS_INCLUDE_PATH . '/ss-content-type-functions.php');
require_once( SS_INCLUDE_PATH . '/ss-header.php');
require_once( SS_INCLUDE_PATH . '/ss-footer.php');
require_once( SS_INCLUDE_PATH . '/ss-page-heading.php');
require_once( SS_INCLUDE_PATH . '/ss-shortcodes.php');
require_once( SS_INCLUDE_PATH . '/ss-breadcrumbs.php');


/* ----------------------------------------------------------------------------------- */
/*  WooCommerce INIT 
/* ----------------------------------------------------------------------------------- */
if ( class_exists('Woocommerce') ) {
    //require_once( SS_INCLUDE_PATH . '/ss-woocommerce.php' );
}