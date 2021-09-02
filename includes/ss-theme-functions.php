<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

/*
 *  ss_head_meta()
 *  ss_seo_meta()
 *  ss_social_meta()
 *  ss_google_tracking()
 *  ss_html5_ie_scripts()
 *  ss_get_post_meta()
 *  ss_generate_css_properties()
 *  ss_get_template()
 *  ss_get_header_layout()
 *  ss_get_footer_layout()
 *  ss_custom_excerpt_length()
 *  ss_custom_excerpt_more()
 *  ss_custom_excerpt()
 *  ss_content()
 *  ss_get_the_content_with_formatting()
 *  ss_get_the_content_with_formatting()
 *  ss_excerpt()
 *  ss_set_layout()
 *  ss_set_sidebar()
 *  ss_is_sidebar_active()
 *  ss_get_dynamic_sidebar()
 *  ss_get_all_sidebars()
 *  ss_logo()
 *  ss_get_number_comment()
 *  ss_comment()
 *  ss_comment_form_fields()
 *  ss_comment_form()
 *  ss_post_comments()
 *  ss_body_class()
 *  ss_get_category_list()
 *  ss_round_num()
 *  ss_page_nav()
 */

if ( ! function_exists( 'ss_head_meta' ) ) {
	function ss_head_meta() {
		global $ss_theme_options;
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10">

        <!-- SEO -->
        

        <!--// PINGBACK & FAVICON //-->
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

        <?php 
        if ( isset( $ss_theme_options['option_favicon']['url'] ) ) {
	        $custom_favion_logo = $ss_theme_options['option_favicon']['url'];
	    ?>
	    	<link rel="shortcut icon" href="<?php echo esc_url($custom_favion_logo ); ?>" />
	    <?php
	    }
	}
	add_action( 'wp_head', 'ss_head_meta', 0 );
}

if ( ! function_exists('ss_seo_meta') ) {
    function ss_seo_meta() {
        global $post, $ss_theme_options;

        $meta_keyword = ss_get_post_meta( $post->ID, "ar_seo_keyword", true );
        $meta_description = ss_get_post_meta( $post->ID, "ar_seo_description", true );
        $meta_robots_index = ss_get_post_meta( $post->ID, "ar_seo_meta_robots_index", true );
        $meta_robots_follow = ss_get_post_meta( $post->ID, "ar_seo_meta_robots_follow", true );
        $meta_canonical = ss_get_post_meta( $post->ID, "ar_seo_meta_canonical_url", true);

        $meta_robots = array();
        
        if(! $meta_robots_index || $meta_robots_index == 1)
            $meta_robots[] = 'index';
        else
            $meta_robots[] = 'noindex';
        
        if(! $meta_robots_follow || $meta_robots_follow == 1)
            $meta_robots[] = 'follow';
        else
            $meta_robots[] = 'nofollow';
        ?>
        <?php if($meta_description): ?>
        <meta name="description" content="<?php echo esc_attr($meta_description); ?>">
        <?php endif; ?>
        <?php if($meta_keyword): ?>
        <meta name="keywords" content="<?php echo esc_attr($meta_keyword); ?>">
        <?php endif; ?>
        <meta name="robots" content="<?php echo implode(',', $meta_robots); ?>">
        <?php if($meta_canonical): ?>
        <link rel="canonical" href="<?php echo esc_attr( $meta_canonical ); ?>" />
        <?php endif; ?>

    <?php }

}

if ( ! function_exists( 'ss_social_meta' ) ) {
    function ss_social_meta() {
        global $post, $ss_theme_options;

        $logo = array();
        if ( isset( $ss_theme_options['logo_upload'] ) ) {
            $logo = $ss_theme_options['logo_upload'];
        }

        $title             = strip_tags( get_the_title() );
        $permalink         = get_permalink();
        $site_name         = get_bloginfo( 'name' );

        $post_object = get_post($post->ID);

        $excerpt           = $post_object->post_excerpt;
        $content           = $post_object->post_content;

        $twitter_author    = $ss_theme_options['twitter_author_username'];
        $googleplus_author = $ss_theme_options['googleplus_author'];

        if ( $excerpt != "" ) {
            $excerpt = strip_tags( trim( preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $excerpt ) ) );
        } else {
            $excerpt = strip_tags( trim( preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $content ) ) );
        }

        if ( function_exists( 'is_product' ) && is_product() ) {
            $product_description       = ss_get_post_meta( $post->ID, 'ar_product_description', true );
            $product_short_description = ss_get_post_meta( $post->ID, 'ar_product_short_description', true );
            if ( $product_description != "" ) {
                $excerpt = strip_tags( $product_description );
            } else if ( $product_short_description != "" ) {
                $excerpt = strip_tags( $product_short_description );
            }
        }

        $image_url = "";
        if ( has_post_thumbnail( $post->ID ) ) {
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            $image_url = esc_attr( $thumbnail[0] );
        } else if ( isset( $logo['url'] ) && $logo['url'] != "" ) {
            $image_url = $logo['url'];
        }

        echo "" . "\n";
        echo '<!-- Facebook Meta -->' . "\n";
        echo '<meta property="og:title" content="' . $title . ' - ' . $site_name . '"/>' . "\n";
        echo '<meta property="og:type" content="article"/>' . "\n";
        echo '<meta property="og:url" content="' . $permalink . '"/>' . "\n";
        echo '<meta property="og:site_name" content="' . $site_name . '"/>' . "\n";
        echo '<meta property="og:description" content="' . $excerpt . '">' . "\n";
        if ( $image_url != "" ) {
            echo '<meta property="og:image" content="' . $image_url . '"/>' . "\n";
        }
        if ( function_exists( 'is_product' ) && is_product() ) {
            $product = new WC_Product( $post->ID );
            $product_price = method_exists( $product, 'get_price' ) ? $product->get_price() : $product->price;
            echo '<meta property="og:price:amount" content="' . $product_price . '" />' . "\n";
            echo '<meta property="og:price:currency" content="' . get_woocommerce_currency() . '" />' . "\n";
        }

        echo "" . "\n";
        echo '<!-- Twitter Card data -->' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . $title . '">' . "\n";
        echo '<meta name="twitter:description" content="' . $excerpt . '">' . "\n";
        if ( $twitter_author != "" ) {
            echo '<meta name="twitter:site" content="@' . $twitter_author . '">' . "\n";
            echo '<meta name="twitter:creator" content="@' . $twitter_author . '">' . "\n";
        }
        if ( $image_url != "" ) {
            echo '<meta property="twitter:image:src" content="' . $image_url . '"/>' . "\n";
        }
        if ( function_exists( 'is_product' ) && is_product() ) {
            $product = new WC_Product( $post->ID );
            $product_price = method_exists( $product, 'get_price' ) ? $product->get_price() : $product->price;
            echo '<meta name="twitter:data1" content="' . $product_price . '">' . "\n";
            echo '<meta name="twitter:label1" content="Price">' . "\n";
        }
        echo "" . "\n";

        echo "" . "\n";
        if ( $googleplus_author != "" ) {
            echo '<!-- Google Authorship and Publisher Markup -->' . "\n";
            echo '<link rel="author" href="https://plus.google.com/' . $googleplus_author . '/posts"/>' . "\n";
            echo '<link rel="publisher" href="https://plus.google.com/' . $googleplus_author . '"/>' . "\n";
        }
    }

    //add_action( 'wp_head', 'ss_social_meta', 5 );
}

if ( !function_exists( 'ss_google_tracking' ) ) {
    function ss_google_tracking() {
    	global $ss_theme_options;
        if ( $ss_theme_options['google_analytics'] != "" ) {
            echo $ss_theme_options['google_analytics'];
        }
    }

    //add_action( 'wp_head', 'ss_google_tracking', 90 );
}

/* REQUIRED IE8 COMPATIBILITY SCRIPTS  */
if (!function_exists('ss_html5_ie_scripts')) {
    function ss_html5_ie_scripts() {
        $theme_url = get_template_directory_uri();
        $ie_scripts = '';

        $ie_scripts .= '<!--[if lt IE 9]>';
        $ie_scripts .= '<script data-cfasync="false" src="'.$theme_url.'/js/respond.js"></script>';
        $ie_scripts .= '<script data-cfasync="false" src="'.$theme_url.'/js/html5shiv.js"></script>';
        $ie_scripts .= '<![endif]-->';
        echo $ie_scripts;
    }
    add_action('wp_head', 'ss_html5_ie_scripts');
}

if ( !function_exists( 'ss_get_post_meta' ) ) {
    function ss_get_post_meta( $id, $key = "", $single = false ) {

        $GLOBALS['ar_post_meta'] = isset( $GLOBALS['ar_post_meta'] ) ? $GLOBALS['ar_post_meta'] : array();
        if ( ! isset( $id ) ) {
            return;
        }
        if ( ! is_array( $id ) ) {
            if ( ! isset( $GLOBALS['ar_post_meta'][ $id ] ) ) {
                $GLOBALS['ar_post_meta'][ $id ] = get_post_meta( $id );
            }
            if ( ! empty( $key ) && isset( $GLOBALS['ar_post_meta'][ $id ][ $key ] ) && ! empty( $GLOBALS['ar_post_meta'][ $id ][ $key ] ) ) {
                if ( $single ) {
                    return maybe_unserialize( $GLOBALS['ar_post_meta'][ $id ][ $key ][0] );
                } else {
                    return array_map( 'maybe_unserialize', $GLOBALS['ar_post_meta'][ $id ][ $key ] );
                }
            }

            if ( $single ) {
                return '';
            } else {
                return array();
            }

        }

        return get_post_meta( $id, $key, $single );
    }
}

if ( !function_exists( 'ss_get_post_details' ) ) {
    function ss_get_post_details( $postID, $recent_post = false ) {

    	global $ss_theme_options;
    	$single_author = $ss_theme_options['single_author'];

   		$post_details = $comments = "";
    	$post_author  = get_the_author();
    	$num_comments = get_comments_number();
		if ( $num_comments == 0 ) {
			$comments = __('No Comments', SS_DOMAIN);
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __(' Comments', SS_DOMAIN);
		} else {
			$comments = __('1 Comment', SS_DOMAIN);
		}

    	if ( !$single_author && comments_open() ) {
    	    $post_details .= '<div class="blog-item-details"><span class="author">' . sprintf( __( 'By <a href="%2$s" rel="author" itemprop="author">%1$s</a>', SS_DOMAIN ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '</span>';
    	    if ( $recent_post ) {
    	    $post_details .= ' / <span>'. $comments .'</span>';
    	    }
    	    $post_details .= '</div>';
    	} else if ( $single_author && comments_open() ) {
    	    $post_details .= '<div class="blog-item-details"><span>'. $comments .'</span></div>';
    	} else {
    	    $post_details .= '<div class="blog-item-details"><span class="author">' . sprintf( __( 'By <a href="%2$s" rel="author" itemprop="author">%1$s</a>', SS_DOMAIN ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '</span></div>';
    	}

    	return $post_details;
    }
}

if ( !function_exists( 'ss_generate_css_properties' ) ) {
	function ss_generate_css_properties($rules, $indent = 0) {
		$css = '';
		$prefix = str_repeat('  ', $indent);

		foreach ($rules as $key => $value) {
			if (is_array($value)) {
				$selector = $key;
				$properties = $value;

				$css .= $prefix . "$selector {\n";
				$css .= $prefix .ss_generate_css_properties($properties, $indent + 1);
				$css .= $prefix . "}\n";
			} else {
				$property = $key;
				$css .= $prefix . "$property: $value;\n";
			}
		}
		return $css;
	}
}

if ( !function_exists( 'ss_get_template' ) ) {
    function ss_get_template( $template ) {
       include( locate_template( '/template-parts/' . $template . '.php', false, false ) );
    }
}
    
if ( !function_exists( 'ss_get_header_layout' ) ) {
    function ss_get_header_layout( $template ) {
        include( locate_template( '/template-parts/header/' . $template . '.php' ) );
    }
}

if ( !function_exists( 'ss_get_footer_layout' ) ) {
    function ss_get_footer_layout( $template ) {
        include( locate_template( '/template-parts/footer/' . $template . '.php' ) );
    }
}

if ( !function_exists( 'ss_custom_excerpt_length' ) ) {
    function ss_custom_excerpt_length( $length ) {
        return 60;
    }
    add_filter('excerpt_length', 'ss_custom_excerpt_length');
}
if ( !function_exists( 'ss_custom_excerpt_more' ) ) {
    function ss_custom_excerpt_more( $more ) {
        global $post;
        return '<div class="read-more"><a href="'. get_permalink($post->ID) . '" class="btn btn-danger active" role="button"><i class="fa fa-arrow-right" aria-hidden="true"></i>
 read more</a></div>';
    }
    add_filter('excerpt_more', 'ss_custom_excerpt_more');
}
if ( !function_exists( 'ss_custom_excerpt' ) ) {
    function ss_custom_excerpt( $custom_content, $limit ) {
        //$content = wp_trim_words( $custom_content, $limit );
        $content = $custom_content; // This is needed to keep formatting
        $content = preg_replace( '/\[.+\]/', '', $content );
        $content = apply_filters( 'the_content', $content );
        $content = str_replace( ']]>', ']]&gt;', $content );

        return $content;
    }
}

function ss_content( $limit ) {
    $content = wp_trim_words( get_the_content(), $limit );
    $content = preg_replace( '/\[.+\]/', '', $content );
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );

    return $content;
}

function ss_excerpt( $limit ) {
    global $post;
    $excerpt = "";
    $custom_excerpt = ss_get_post_meta( $post->ID, 'ss_custom_excerpt', true );
    
    if ( $custom_excerpt != "" ) {
        $excerpt = wp_trim_words( $custom_excerpt, $limit );
    } else {
        $excerpt = wp_trim_words( get_the_excerpt(), $limit );
    }
    $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

    return '<p>' . $excerpt . '</p>';
}

function ss_get_the_content_with_formatting() {
    $content = get_the_content();
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );

    return $content;
}

if ( !function_exists( 'ss_set_layout' ) ) {
    function ss_set_layout( $template, $type = "" ) {
            global $post, $ss_theme_options;
            $sidebar_var           = ss_set_sidebar($type);

            $sidebar_config        = $sidebar_var['config'];
            $left_sidebar          = $sidebar_var['left'];
            $right_sidebar         = $sidebar_var['right'];
            $page_wrap_class       = $sidebar_var['page_wrap_class'];
            $remove_bottom_spacing = $remove_top_spacing = $sidebar_progress_menu = "";
            
            $cont_width = $sidebar_width = "";
            $cont_width = apply_filters("ss_base_layout_cont_width", "col-sm-8");
            $sidebar_width = apply_filters("ss_base_layout_cont_width_sidebar", "col-sm-4");
            ?>
        <div class="inner-page-wrap <?php echo esc_attr($page_wrap_class); ?> clearfix"><!-- Inner Page Wrapp -->
            <!-- OPEN page -->
            <?php if ( $sidebar_config == "left-sidebar" ) { ?>
                <div class="<?php echo esc_attr($cont_width); ?> right clearfix">
            <?php } else if ($sidebar_config == "right-sidebar") { ?>
                <div class="<?php echo esc_attr($cont_width); ?> clearfix">
            <?php } else { ?>
                <div class="clearfix">
            <?php } ?>

                <div class="page-content hfeed clearfix">
                    <?php ss_get_template( $template, $type ); ?>
                </div>

                <!-- CLOSE page -->
                </div>

            <?php if ( $sidebar_config == "left-sidebar" ) { ?>

                <aside class="sidebar left-sidebar <?php echo esc_attr($sidebar_width); ?>">

                    <div class="sidebar-widget-wrap">
                        <?php dynamic_sidebar( $left_sidebar ); ?>
                    </div>

                </aside>

            <?php } else if ( $sidebar_config == "right-sidebar" ) { ?>

                <aside class="sidebar right-sidebar <?php echo esc_attr($sidebar_width); ?>">

                    <div class="sidebar-widget-wrap">
                        <?php dynamic_sidebar( $right_sidebar ); ?>
                    </div>

                </aside>

            <?php } ?>
            
        </div><!-- /Inner Page Wrap -->
        <?php
    }
}

if ( !function_exists( 'ss_set_sidebar' ) ) {
    function ss_set_sidebar($type) {
        global $post, $ss_theme_options;

        // DEFAULT SIDEBAR CONFIG FOR PAGES
        $default_sidebar_config = $ss_theme_options['default_sidebar_config'];
        $default_left_sidebar   = $ss_theme_options['default_left_sidebar'];
        $default_right_sidebar  = $ss_theme_options['default_right_sidebar'];

        // DEFAULT SIDEBAR CONFIG FOR POST
        $default_post_sidebar_config    = $ss_theme_options['default_post_sidebar_config'];
        $default_post_left_sidebar      = $ss_theme_options['default_post_left_sidebar'];
        $default_post_right_sidebar     = $ss_theme_options['default_post_right_sidebar'];
        $default_post_sidebar_flag      = false;

        $sidebar_config = $left_sidebar = $right_sidebar = "";

        // ARCHIVE / CATEGORY SIDEBAR CONFIG
        if ( is_search() || is_archive() || is_author() || is_category() || is_home() || is_404() ) {
            if ( isset($ss_theme_options['archive_sidebar_config'] ) ) {
                $default_sidebar_config = $ss_theme_options['archive_sidebar_config'];
                $default_left_sidebar   = $ss_theme_options['archive_sidebar_left'];
                $default_right_sidebar  = $ss_theme_options['archive_sidebar_right'];
            }
        }

        // CURRENT POST/PAGE SIDEBAR CONFIG
        if ( $post && is_singular() ) {
            $sidebar_config = ss_get_post_meta( $post->ID, 'ss_sidebar_config', true );
            $left_sidebar   = ss_get_post_meta( $post->ID, 'ss_left_sidebar', true );
            $right_sidebar  = ss_get_post_meta( $post->ID, 'ss_right_sidebar', true );
        }

        if ( $post && is_singular( 'post' ) ) {
            if ($sidebar_config == 'no-sidebars') {
                if (isset($default_post_sidebar_config )) { 
                    $sidebar_config = $default_post_sidebar_config;
                    $left_sidebar   = $default_post_left_sidebar;
                    $right_sidebar  = $default_post_right_sidebar;
                    $default_post_sidebar_flag = true;
                }
            }
            //ss_theme_debug($right_sidebar); 
        }

        // DEFAULTS
        if ( $sidebar_config == "" ) {
            $sidebar_config = $default_sidebar_config;
        }
        if ( $left_sidebar == "" ) {
            $left_sidebar = $default_left_sidebar;
        }
        if ( $right_sidebar == "" ) {
            $right_sidebar = $default_right_sidebar;
        }
    

        // PAGE WRAP CLASS
        $page_wrap_class = '';
        if ( $sidebar_config == "left-sidebar" ) {
            $page_wrap_class = 'has-left-sidebar has-one-sidebar row';
        } else if ( $sidebar_config == "right-sidebar" ) {
            $page_wrap_class = 'has-right-sidebar has-one-sidebar row';
        } else if ( $sidebar_config == "both-sidebars" ) {
            $page_wrap_class = 'has-both-sidebars row';
        } else {
            $page_wrap_class = 'has-no-sidebar';
        }

        // RETURN
        $sidebar_var                    = array();
        $sidebar_var['config']          = $sidebar_config;
        $sidebar_var['left']            = strtolower($left_sidebar);
        $sidebar_var['right']           = strtolower($right_sidebar);
        $sidebar_var['page_wrap_class'] = $page_wrap_class;

        return $sidebar_var;
    }
}

if ( !function_exists( 'ss_is_sidebar_active' ) ) {
    function ss_is_sidebar_active( $index ) {
        global $wp_registered_sidebars;
        $widgetcolums = wp_get_sidebars_widgets();
        if (isset($widgetcolums[$index]) && $widgetcolums[$index]) {
            return true;
        } else {
            return false;
        }
    }
}

if ( !function_exists('ss_get_dynamic_sidebar') ) {
    function ss_get_dynamic_sidebar( $index ) {
        $sidebar_contents = "";
        ob_start();
        dynamic_sidebar($index);
        $sidebar_contents = ob_get_clean();
        return $sidebar_contents;
    }
}

if ( !function_exists('ss_get_all_sidebars') ) {
    function ss_get_all_sidebars() {
        global $wp_registered_sidebars;

        $list_sidebar = array();
        foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar )  {
            $list_sidebar[ucwords( $sidebar['id'] )] = ucwords( $sidebar['name'] ); 
        }

        return $list_sidebar;
    }
}


if ( ! function_exists( 'ss_logo' ) ) {
    function ss_logo( $logo_class, $logo_id = "logo" ) {
        global $post, $ss_theme_options;
        $alt_logo = array();

        $logo_url = $ss_theme_options['option_custom_logo'];
        $logo_margin = $ss_theme_options['logo_margin'];
        $logo_dimensions = $ss_theme_options['logo_dimensions'];
        $logo_width = $logo_dimensions['width'];
        $logo_height = $logo_dimensions['height'];

        //ss_theme_debug( $logo_margin);

        $css_heading_print = array( $logo_id => array( 
            'margin'            => '',
        ) );
        //echo "<style type='text/css'> \n" . ss_generate_css_properties( $css_heading_print ) . "</style>\n";

        $logo_output         = "";
        $logo_alt            = get_bloginfo( 'name' );
        $logo_tagline        = get_bloginfo( 'description' );
        $logo_link_url       = apply_filters( 'ss_logo_link_url', home_url() );

        /* LOGO OUTPUT
        ================================================== */
        $logo_output .= '<div id="' . $logo_id . '" class="' . $logo_class . '">' . "\n";
        $logo_output .= '<a href="' . $logo_link_url . '">' . "\n";

        $logo_output .= '<img class="standard" src="' . $logo_url['url'] . '" alt="' . $logo_alt . '" width="'. $logo_width .'" height="' . $logo_height . '" />' . "\n";

        $logo_output .= '</a>' . "\n";
        $logo_output .= '</div>' . "\n";


        // LOGO RETURN
        return $logo_output;
    }
}

if ( ! function_exists( 'ss_get_number_comment' ) ){
    function ss_get_number_comment()
    {
        global $post;
        $num_comments   = get_comments_number(); // get_comments_number returns only a numeric value
        $comments       = '';
        $write_comments = '';
        if (comments_open())
        {
            if ($num_comments == 0)
            {
                $comments = __('No comments', SS_DOMAIN);
            }
            elseif ($num_comments > 1)
            {
                $comments = $num_comments . __(' comments', SS_DOMAIN);
            }
            else
            {
                $comments = $num_comments . __(' comment', SS_DOMAIN);
            }
            //$write_comments = '<a href="' . esc_url( get_comments_link() )  . '">' . $comments . '</a>';
            $write_comments = $comments;
        }
        else
        {
            $write_comments = __('Comments are off for this post.', SS_DOMAIN);
        }
        echo '<i class="fa fa-comments-o"></i>&nbsp;'.$write_comments;
    }
    add_filter('ss_number_comment', 'ss_get_number_comment');
}

if( ! function_exists( 'ss_comment' ) ) {
    function ss_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="item-comment-<?php comment_ID() ?>">
            <div class="item-comment-wrap" id="comment-body comment-<?php comment_ID(); ?>">
                    <div class="comment-avtar">
                        <?php echo get_avatar($comment, $size = '100'); ?>
                    </div>
                    <div class="comment-content">
                        <div class="comment-meta">
                           <?php printf( '<span class="comment-author">%1$s</span> <span class="comment-date">%2$s</span>',
                                get_comment_author_link(),
                                human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) . ' ' . __( "ago", SS_DOMAIN )
                            ); ?>
                            
                        </div>  
                        <div class="comment-meta-actions">
                            <?php edit_comment_link( __( ' (Edit)', SS_DOMAIN ),'  ','' ); ?>
                            <?php if ( $args['type'] == 'all' || get_comment_type() == 'comment' ) :
                                comment_reply_link( array_merge( $args, array(
                                    'reply_text' => __( 'Reply', SS_DOMAIN ),
                                    'login_text' => __( 'Log in to reply.', SS_DOMAIN ),
                                    'depth'      => $depth,
                                    'before'     => '<span class="comment-reply">',
                                    'after'      => '</span>'
                                ) ) );
                            endif; ?>
                        </div>
                        <?php if ($comment->comment_approved == '0') {  ?>
                                <p style="font-style:italic;"><?php _e('Your comment is awaiting moderation.',SS_DOMAIN) ?></p>
                                <br />
                        <?php } ?>
                        <div class="comment-body">
                            <p><?php comment_text() ?></p>
                        </div> 
                    </div>
            </div>
    <?php       
    }
}

if( ! function_exists( 'ss_comment_form_fields' ) ) {
    function ss_comment_form_fields( $fields ) {
        $commenter = wp_get_current_commenter();
        $req       = get_option( 'require_name_email' );
        $aria_req  = ( $req ? " aria-required='true'" : '' );
        $html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
        $fields    = array(
            'author' => '<div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group comment-form-author">
                                <input class="form-control" placeholder="' . esc_attr( __( 'Name', SS_DOMAIN ) . ( $req ? ' *' : '' ) ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
                            </div>
                        </div>',
            'email'  => '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group comment-form-email">
                            <input class="form-control" placeholder="' . esc_attr( __( 'E-mail', SS_DOMAIN ) . ( $req ? ' *' : '' ) ) . '" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
                        </div>
                    </div>',
            'url'    => '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group comment-form-url">
                            <input class="form-control" placeholder="' . esc_attr( __( 'Website', SS_DOMAIN ) ) . '" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
                        </div>
                    </div></div>'
        );

        return $fields;
    }
    add_filter( 'comment_form_default_fields', 'ss_comment_form_fields' );
}

if( ! function_exists( 'ss_comment_form' ) ) {
    function ss_comment_form( $args ) {
        $args['comment_field'] = '
            <div class="row">
            <div class="form-group textarea-comment col-xs-12 ">
                <textarea name="comment" id="comment" cols="45" rows="8" aria-required="true" required="required" tabindex="4" class="form-control textarea-comment" placeholder="' . __( 'Comment...', SS_DOMAIN ) . '"></textarea>
            </div></div>';
        return $args;
    }
    add_filter( 'comment_form_defaults', 'ss_comment_form' );
}

if ( ! function_exists( 'ss_post_comments' ) ) {
    function ss_post_comments() {

        if ( comments_open() ) {
            ?>
            <div class="<?php echo $comments_wrap_class; ?>">
                <div id="comment-area" class="<?php echo $comments_class; ?>">
                    <?php comments_template( '', true ); ?>
                </div>
            </div>
        <?php
        }
    }
}
add_action( 'ss_post_after_article', 'ss_post_comments', 20 );

if ( !function_exists('ss_body_class')) {
    function ss_body_class() {
        global $post, $ss_theme_options, $ss_catalog_mode;

        $page_class = "";

        $page_class = $ss_theme_options['page_layout'];

        // Shop page check
        $shop_page = false;
        if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
            $shop_page = true;
            $page_class .= " woocommerce woocommerce-page";
        }

        if ( $shop_page ) {
            if ( isset($ss_theme_options['woo_page_header']) ) {
                $page_header_type = $ss_theme_options['woo_page_header'];
            }
        }

        // Catalog Mode
        if ( isset( $ss_theme_options['enable_catalog_mode'] ) ) {
            $enable_catalog_mode = $ss_theme_options['enable_catalog_mode'];

            if ( isset( $_GET['catalog_mode'] ) ) {
                $enable_catalog_mode = $_GET['catalog_mode'];
            }

            if ( $enable_catalog_mode ) {
                $ss_catalog_mode = true;
                $page_class .= " catalog-mode ";
            }
        }

        // if ( $ss_theme_options['default_show_page_heading'] == '1') {
        //     $page_class .= " has_page_heading";
        // }

        // if ( isset($ss_theme_options['default_sidebar_config']) ) {
        //     $page_class .= " has_" . $ss_theme_options['default_sidebar_config'];
        // }

        if ( $post && is_singular( 'post' ) ) {
            if ( isset($ss_theme_options['default_post_sidebar_config']) ) {
                $page_class .= " has_" . $ss_theme_options['default_post_sidebar_config'];
            }
        }

        if ( !$shop_page ) {
        if ( is_search() || is_archive() || is_author() || is_category() || is_home() || is_404() ) {
            if (isset($ss_theme_options['archive_sidebar_config'])) {
                $page_class .= " has_archive_" . $ss_theme_options['archive_sidebar_config'];
            }

            if ( isset($ss_theme_options['archive_display_type'])) {
                $page_class .= " has_archive_" . $ss_theme_options['archive_display_type'];
            }

        }
        }

        if ( $post && is_singular( 'portfolio' ) ) {
            if ( isset($ss_theme_options['portfolio_archive_display_type'])) {
                $page_class .= " has_portfolio_" . $ss_theme_options['portfolio_archive_display_type'];
            }
        }

        if ( $shop_page ) {
            if ( isset($ss_theme_options['product_display_layout'])) {
                $page_class .= " has_product_" . $ss_theme_options['product_display_layout'];
            }

            if ( isset($ss_theme_options['woo_sidebar_config'])) {
                $page_class .= " has_product_" . $ss_theme_options['woo_sidebar_config'];
            }

            if ( isset($ss_theme_options['default_product_sidebar_config'])) {
                $page_class .= " has_product_" . $ss_theme_options['default_product_sidebar_config'];
            }

            if ( isset($ss_theme_options['woo_show_page_heading'])) {
                $page_class .= " has_product_" . $ss_theme_options['woo_show_page_heading'];
            }
        }

        if ( is_product() ) {
            $page_class .= " woocommerce woocommerce-page";
        }

        $classes[] = $page_class;

        return $classes;
    }
    //add_filter( 'body_class', 'ss_body_class' );
}

function ss_add_mce_button() {
    // check user permissions
    if ( !current_user_can( 'edit_posts' ) &&  !current_user_can( 'edit_pages' ) ) {
               return;
    }
   // check if WYSIWYG is enabled
   if ( 'true' == get_user_option( 'rich_editing' ) ) {
       add_filter( 'mce_external_plugins', 'ss_add_tinymce_plugin' );
       add_filter( 'mce_buttons', 'ss_register_mce_button' );
   }
}
add_action('admin_head', 'ss_add_mce_button');

// register new button in the editor
function ss_register_mce_button( $buttons ) {
    array_push( $buttons, 'ss_mce_button' );
    return $buttons;
}

// declare a script for the new button
// the script will insert the shortcode on the click event
function ss_add_tinymce_plugin( $plugin_array ) {
    $plugin_array['ss_mce_button'] = get_template_directory_uri() .'/js/artooz-mce-button.js';
    return $plugin_array;
}

if ( ! function_exists( 'ss_get_category_list' ) ) {
    function ss_get_category_list( $category_name, $filter = 0, $category_child = "", $frontend_display = false ) {

        if ( !$frontend_display && !is_admin() ) {
            return;
        }

        if ( $category_name == "product-category" ) {
            $category_name = "product_cat";
        }

        if ( ! $filter ) {

            $get_category  = get_categories( array( 'taxonomy' => $category_name ) );
            $category_list = array();

            foreach ( $get_category as $category ) {
                if ( isset( $category->slug ) ) {
                    $category_list[] = $category->slug;
                }
            }

            return $category_list;

        } else if ( $category_child != "" && $category_child != "All" ) {

            $childcategory = get_term_by( 'slug', $category_child, $category_name );
            $get_category  = get_categories( array(
                    'taxonomy' => $category_name,
                    'child_of' => $childcategory->term_id
                ) );
            $category_list = array();

            foreach ( $get_category as $category ) {
                if ( isset( $category->cat_name ) ) {
                    $category_list[] = $category->slug;
                }
            }

            return $category_list;

        } else {

            $get_category  = get_categories( array( 'taxonomy' => $category_name ) );
            $category_list = array();

            foreach ( $get_category as $category ) {
                if ( isset( $category->cat_name ) ) {
                    $category_list[] = $category->cat_name;
                }
            }

            return $category_list;
        }
    }
}

if ( ! function_exists( 'ss_round_num' ) ) {
    function ss_round_num($num, $to_nearest) {
       /*Round fractions down (http://php.net/manual/en/function.floor.php)*/
       return floor($num/$to_nearest)*$to_nearest;
    }
}

if ( ! function_exists( 'ss_page_nav' ) ) {
    /* Function that performs a Boxed Style Numbered Pagination (also called Page Navigation).
       Function is largely based on Version 2.4 of the WP-PageNavi plugin */
    function ss_page_nav() {
        global $wp_query, $paged;
       // wp_reset_query();
        global $wpdb, $paged;
        $query = $wp_query;
        $pagenavi_options = array();
        //$pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%:');
        $pagenavi_options['pages_text'] = ('');
        $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
        $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
        $pagenavi_options['first_text'] = ('First Page');
        $pagenavi_options['last_text'] = ('Last Page');
        $pagenavi_options['next_text'] = __("<i class='fa fa-angle-right'></i>", SS_DOMAIN);
        $pagenavi_options['prev_text'] = __("<i class='fa fa-angle-left'></i>", SS_DOMAIN);
        $pagenavi_options['dotright_text'] = '...';
        $pagenavi_options['dotleft_text'] = '...';
        $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
        $pagenavi_options['always_show'] = 0;
        $pagenavi_options['num_larger_page_numbers'] = 0;
        $pagenavi_options['larger_page_numbers_multiple'] = 5;
     
        $output = "";
        
        //If NOT a single Post is being displayed
        /*http://codex.wordpress.org/Function_Reference/is_single)*/
        if (!is_single()) {
            $request = $query->request;
            //intval — Get the integer value of a variable
            /*http://php.net/manual/en/function.intval.php*/
            $posts_per_page = intval(get_query_var('posts_per_page'));
            //Retrieve variable in the WP_Query class.
            /*http://codex.wordpress.org/Function_Reference/get_query_var*/
            if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
            } elseif ( get_query_var('page') ) {
            $paged = get_query_var('page');
            } else {
            $paged = 1;
            }
            $numposts = $query->found_posts;
            $max_page = $query->max_num_pages;
     
            //empty — Determine whether a variable is empty
            /*http://php.net/manual/en/function.empty.php*/
            if(empty($paged) || $paged == 0) {
                $paged = 1;
            }
     
            $pages_to_show = intval($pagenavi_options['num_pages']);
            $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
            $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
            $pages_to_show_minus_1 = $pages_to_show - 1;
            $half_page_start = floor($pages_to_show_minus_1/2);
            //ceil — Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
            $half_page_end = ceil($pages_to_show_minus_1/2);
            $start_page = $paged - $half_page_start;
     
            if($start_page <= 0) {
                $start_page = 1;
            }
     
            $end_page = $paged + $half_page_end;
            if(($end_page - $start_page) != $pages_to_show_minus_1) {
                $end_page = $start_page + $pages_to_show_minus_1;
            }
            if($end_page > $max_page) {
                $start_page = $max_page - $pages_to_show_minus_1;
                $end_page = $max_page;
            }
            if($start_page <= 0) {
                $start_page = 1;
            }
     
            $larger_per_page = $larger_page_to_show*$larger_page_multiple;
            //ss_round_num() custom function - Rounds To The Nearest Value.
            $larger_start_page_start = (ss_round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
            $larger_start_page_end = ss_round_num($start_page, 10) + $larger_page_multiple;
            $larger_end_page_start = ss_round_num($end_page, 10) + $larger_page_multiple;
            $larger_end_page_end = ss_round_num($end_page, 10) + ($larger_per_page);
     
            if($larger_start_page_end - $larger_page_multiple == $start_page) {
                $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
                $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
            }
            if($larger_start_page_start <= 0) {
                $larger_start_page_start = $larger_page_multiple;
            }
            if($larger_start_page_end > $max_page) {
                $larger_start_page_end = $max_page;
            }
            if($larger_end_page_end > $max_page) {
                $larger_end_page_end = $max_page;
            }
            if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
                /*http://php.net/manual/en/function.str-replace.php */
                /*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
                $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
                $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
                $output .= '<ul class="pagenavi">'."\n";
     
                if(!empty($pages_text)) {
                    $output .= '<li><span class="pages">'.$pages_text.'</span></li>';
                }
                //Displays a link to the previous post which exists in chronological order from the current post.
                /*http://codex.wordpress.org/Function_Reference/previous_post_link*/
                if ($paged > 1) {
                $output .= '<li class="prev">' . get_previous_posts_link($pagenavi_options['prev_text']) . '</li>';
                }
                
                if ($start_page >= 2 && $pages_to_show < $max_page) {
                    $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
                    //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
                    /*http://codex.wordpress.org/Data_Validation*/
                    //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.
                    $output .= '<li><a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a></li>';
                    if(!empty($pagenavi_options['dotleft_text'])) {
                        $output .= '<li><span class="expand">'.$pagenavi_options['dotleft_text'].'</span></li>';
                    }
                }
     
                if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
                    for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
                        $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                        $output .= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
                    }
                }
     
                for($i = $start_page; $i  <= $end_page; $i++) {
                    if($i == $paged) {
                        $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
                        $output .= '<li><span class="current">'.$current_page_text.'</span></li>';
                    } else {
                        $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                        $output .= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
                    }
                }
     
                if ($end_page < $max_page) {
                    if(!empty($pagenavi_options['dotright_text'])) {
                        $output .= '<li><span class="expand">'.$pagenavi_options['dotright_text'].'</span></li>';
                    }
                    $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
                    $output .= '<li><a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a></li>';
                }
                $output .= '<li class="next">' . get_next_posts_link($pagenavi_options['next_text'], $max_page) . '</li>';
     
                if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
                    for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
                        $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                        $output .= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
                    }
                }
                $output .= '</ul>' ."\n";
            }
        }
        
        return $output;
    }   
}

if ( !function_exists( 'ss_pagination2' ) ) {
    function ss_pagination2() {
        
        $prev_arrow = is_rtl() ? '<' : '<';
        $next_arrow = is_rtl() ? '>' : '>';
        
        global $wp_query;
        $total = $wp_query->max_num_pages;
        $big = 999999999; // need an unlikely integer
        if( $total > 1 )  {
             if( !$current_page = get_query_var('paged') )
                 $current_page = 1;
             if( get_option('permalink_structure') ) {
                 $format = 'page/%#%/';
             } else {
                 $format = '&paged=%#%';
             }
            return paginate_links(array(
                'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'        => $format,
                'current'       => max( 1, get_query_var('paged') ),
                'total'         => $total,
                'mid_size'      => 3,
                'type'          => 'list',
                'prev_text'     => $prev_arrow,
                'next_text'     => $next_arrow,
             ) );
        }
    }
}

if ( ! function_exists( 'ss_pagination' ) ):
function ss_pagination($pagination_id, $pagination_class  = '' , $max_show_number = 2 , $query = '') {
    global $wp_query;

    // echo '<pre>';
    // var_dump($wp_query);
    // echo '</pre>';

    if($query == '') $query = $wp_query;

    if ( $query->max_num_pages > 1 ) {
        // get the current page
        $paged = 1;
        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        }
        
        ?>
        <nav class="navigation post-navigation" role="navigation">
        <div id="<?php echo $pagination_id; ?>" class="nav-links pagination <?php echo $pagination_class; ?>">
            <ul>
            <?php
                $max_number = $query->max_num_pages;
                //prev button
                if($paged > 1){
                    echo '<li><a href="'. get_pagenum_link($paged-1) .'"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
</a></li>';
                    if($paged - $max_show_number > 1) echo '<li><a href="'. get_pagenum_link(1) .'">1</a></li>';
                }
                
                if($paged - $max_show_number > 2) echo  '<li><span>...</span></li>';
                
                for($k= $paged - $max_show_number; $k <= ($paged+$max_show_number) & $k <= $max_number; $k++){
                    if($k < 1) continue;
                    if($k == $paged) 
                        echo '<li><span class="disabled">'.$k.'</span></li>';
                    else
                        echo '<li><a href="'.get_pagenum_link( $k).'">'.$k.'</a></li>';
                }
                if($paged + $max_show_number < $max_number) {
                     if($paged + $max_show_number < ($max_number-1)) echo  '<li><span>...</span></li>';
                     echo '<li><a href="'.get_pagenum_link( $max_number ).'">'.$max_number.'</a></li>';
                }
                //next button
                if($paged < $max_number) echo '<li><a href="'.get_pagenum_link($paged+1).'"> <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>';
                
            ?>
            </ul>
         </div>
         </nav>
        <?php
    }
}
endif;

/*
  Name: Facebook Page Likes count
    Version : 1
    Author: Linesh Jose
    Url: http://lineshjose.com
    Email: lineshjose@gmail.com
    Donate:  http://bit.ly/donate-linesh
    github: https://github.com/lineshjose
    Copyright: Copyright (c) 2012 LineshJose.com
    
    Note: This script is free; you can redistribute it and/or modify  it under the terms of the GNU General Public License as published by 
        the Free Software Foundation; either version 2 of the License, or (at your option) any later version.This script is distributed in the hope 
        that it will be useful,    but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
        See the  GNU General Public License for more details.
-----------------------------------------------------------
    This php function returns your Facebook Page Likes count
    
    $value: your Facebook page username or ID
    
    Usage: 
            <p>Likes: <strong><?php echo fb_count('LineshJoseDotCom');?></strong></p> // User name
            <p>Likes: <strong><?php echo fb_count('114877608587606');?></strong></p> // Profile ID 
    
*/
function fb_count($value='') 
{ 
     if($value){
         $url='http://api.facebook.com/method/fql.query?query=SELECT fan_count FROM page WHERE';
         if(is_numeric($value)) { $qry=' page_id="'.$value.'"';} //If value is a page ID
         else {$qry=' username="'.$value.'"';} //If value is not a ID. 
         $xml = @simplexml_load_file($url.$qry) or die ("invalid operation");
         $fb_count = $xml->page->fan_count;
         return $fb_count;
    }else{
        return '0';
    }
}
