<?php
    if ( ! function_exists( 'ss_page_heading' ) ) {
        function ss_page_heading() {

            global $wp_query, $post, $ss_theme_options;
            $post_id            = get_the_ID();
            $css_heading_print  = $css_fancy_style = $css_heading_text_color = array();
            $show_page_header   = true;
            $show_breadcrumb    = true;
            $show_page_title    = "";
            $shop_page          = false;

            $page_title_height      = 100;
            $heading_img_width      = 0;
            $heading_img_height     = 0;
            $page_title_text_align  = "left";

            $default_page_header = $default_page_background_color = $default_page_heading_text_align = $default_page_headinge_image = $default_page_heading_style ='';

            $page_title = $page_subtitle = $page_title_style = $page_title_image = $pag_title_image_url = $page_heading_el_class = $page_heading_wrap_el_class = $page_title_text_align = $page_default_theme_setting = "";

            $default_page_header                = $ss_theme_options['default_show_page_heading'];
            $default_page_background_color      = $ss_theme_options['default_page_heading_background_color'];
            $default_page_heading_text_align    = $ss_theme_options['default_page_heading_text_align'];
            $default_page_heading_style         = $ss_theme_options['default_page_heading_style'];
            $default_page_heading_image         = $ss_theme_options['default_page_heading_image'];
            $default_page_text_color            = $ss_theme_options['default_page_heading_text_color'];

            $default_page_breadcrumb = $ss_theme_options['breadcrumb_in_heading'];

            if ($default_page_header != '1') {
                $show_page_header = false; 
            }

            if ($default_page_breadcrumb != "1") {
                $show_breadcrumb = false;
            }

            // Shop page check
            if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
                $shop_page = true;
            }

            if ( is_front_page() && is_home() ) {
              // Default homepage
            } elseif ( is_front_page() ) {
              // static homepage
            } elseif ( is_home() ) {
              // blog page
            } elseif ( $post && is_singular() ) {
                $show_page_title       = ss_get_post_meta( $post->ID, 'ss_page_title', true ); // Flag
                $remove_breadcrumbs    = ss_get_post_meta( $post->ID, 'ss_no_breadcrumbs', true ); // Flag
                $page_default_theme_setting = ss_get_post_meta( $post->ID, 'ss_page_default_theme_setting', true ); // Flag
 
                if ($page_default_theme_setting == true ) {
                    $page_title_text_align = $default_page_heading_text_align; 
                    $page_heading_bg       = $default_page_background_color;
                    $page_title_style      = $default_page_heading_style;
                    $page_title_image      = $default_page_heading_image ;
                    $page_heading_text     = $default_page_text_color;
                } else {
                    $page_title_style      = ss_get_post_meta( $post->ID, 'ss_page_title_style', true ); //Standard or Image
                    $page_title_image      = rwmb_meta( 'ss_page_title_image', 'type=image&size=full' );

                    $page_title_text_align = ss_get_post_meta( $post->ID, 'ss_page_title_text_align', true );
                    $page_title_height     = strval( ss_get_post_meta( $post->ID, 'ss_page_title_height', true ) );
                    $page_heading_bg       = ss_get_post_meta( $post->ID, 'ss_page_title_bg_color', true );
                    $page_heading_text     = ss_get_post_meta( $post->ID, 'ss_page_title_text_color', true );
                }
                
                $page_title            = ss_get_post_meta( $post->ID, 'ss_page_title_one', true );  // Custom Page Title 
                $page_subtitle         = ss_get_post_meta( $post->ID, 'ss_page_subtitle', true ); // Page Subtitle 

            } elseif ( $shop_page ) {
                $show_page_title       = $ss_theme_options['woo_show_page_heading']; // Flag 
                $page_title_text_align = $ss_theme_options['woo_page_heading_text_align']; 
                $page_heading_bg       = $ss_theme_options['woo_page_heading_background_color'];
                $page_title_style      = $ss_theme_options['woo_page_heading_style'];
                $page_title_image      = $ss_theme_options['woo_page_heading_image'];
                $page_heading_text     = $ss_theme_options['woo_page_heading_text_color'];
                //ss_theme_debug($ss_theme_options['woo_page_heading_text_color']);
            } else {
                $show_page_title       = $default_page_header; // Flag 
                $page_title_text_align = $default_page_heading_text_align; 
                $page_heading_bg       = $default_page_background_color;
                $page_title_style      = $default_page_heading_style;
                $page_title_image      = $default_page_heading_image ;
                $page_heading_text     = $default_page_text_color;
            }


            if ( $page_title == '' ) {

                if (is_front_page() && !is_home() ) {
                    $page_title = '';
                    $show_page_header = false;
                } elseif ( is_home() && get_option('page_for_posts') ) { 
                    //$page_title = apply_filters('the_title',get_page( get_option('page_for_posts') )->post_title);
                    $page_title = '';
                    $show_page_header = false;
                } else {
                    if ( is_page() || is_single() ) {

                        if ($show_page_title == '0') {
                            $page_title = get_the_title();
                          
                        } else {
                            $page_title = '';
                            
                            $show_page_header = false;
                        }

                    } elseif ( ss_woocommerce_activated() && is_woocommerce() ) {
                        if ( !is_product() ) {
                            
                            $shop_page_id = wc_get_page_id( 'shop' );
                            $shop_title   = get_the_title( $shop_page_id );

                            $page_title = sprintf( __('%s', SS_DOMAIN), '<span>' . $shop_title . '</span>' );
                        }
                    } elseif ( is_search() ) {
                        $page_title = sprintf( __( 'Search Results for: %s', SS_DOMAIN ), '<span>' . get_search_query() . '</span>' );
                    }  else if ( is_tax() ) {   
                            global $wp_query;
                            $term = $wp_query->get_queried_object();
                            $page_title = sprintf( __('%', SS_DOMAIN), '<span>' . $term->name . '</span>');
                    } else if ( is_category() ) {
                            $page_title = sprintf( __( '%s', SS_DOMAIN ), '<span>' . single_cat_title( '', false ) . '</span>' );
                    } elseif ( is_archive() ) {
                        if ( is_tag() ) {
                            $page_title = sprintf( __( 'Tag Archives: %s', SS_DOMAIN ), '<span>' . single_tag_title( '', false ) . '</span>' );
                        } elseif ( is_author() ) {
                            the_post();
                            $page_title = sprintf( __( 'Author Archives: %s', SS_DOMAIN ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
                            rewind_posts();
                        } elseif ( is_day() ) {
                            $page_title = sprintf( __( 'Daily Archives: %s', SS_DOMAIN ), '<span>' . get_the_date() . '</span>' );
                        } elseif ( is_month() ) {
                            $page_title = sprintf( __( 'Monthly Archives: %s', SS_DOMAIN ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
                        } elseif ( is_year() ) {
                            $page_title = sprintf( __( 'Yearly Archives: %s', SS_DOMAIN ), '<span>' . get_the_date( 'Y' ) . '</span>' );
                        } elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) {
                            $page_title = __( 'Archives:', SS_DOMAIN );
                        } else {
                            $page_title = sprintf( __('%s', SS_DOMAIN), '<span>' . post_type_archive_title( ' ', false ) . '</span>' );
                        }
                    } elseif ( is_404() ) {
                        $page_title = __( '404 Page not found', SS_DOMAIN );
                    }
                }

            }

            if ( $page_title_style == "fancy" ) {
                $page_title_image_url = $page_title_image['url'];
                $heading_img_width = isset($page_title_image['width']) ? $page_title_image['width'] : 0;
                $heading_img_height = isset($page_title_image['height']) ? $page_title_image['height'] : 0;
           }

            $page_title_height .= 'px';
            if ( $page_title_style != 'fancy' ) {
                $css_heading_print = array( '.page-heading' => array( 
                    'background-color'  => $page_heading_bg,
                    'height'            => $page_title_height,
                ) );
            } else {
                $css_heading_print = array( '.page-heading' => array(
                    'height'            => $page_title_height,
                ));
            }

            $css_heading_text_color = array( '.page-heading h1' => array(
                    'color'             => $page_heading_text,
            ));

            if ($page_title_style == 'fancy') {
                $css_fancy_style = array( '.fancy-heading' => array( 
                        'background-image' => 'url("' . esc_url($page_title_image_url) . '")' ,
                        'background-size'  => '' . $heading_img_width . 'px ' . $heading_img_height . 'px cover'
                ));
            }
            
            if ( $show_page_header == true ) {
                echo "<style type='text/css'> \n" . ss_generate_css_properties( array_merge( $css_fancy_style, $css_heading_print, $css_heading_text_color )) . "</style>\n";
            }
            ?>
            <?php if ( $show_page_header == true ) { ?>
                <?php if ( $page_title_style == "fancy" ) { ?>
                    <div class="page-heading fancy-heading clearfix">
                <?php } else { ?>
                    <div class="page-heading clearfix">
                <?php } ?>
                        <div class="container  <?php echo 'text-' . esc_attr($page_title_text_align); ?>">
                            <div class="heading-text" >
                                <h1 class="entry-title"><?php echo $page_title; ?></h1>
                                <?php if ( $page_subtitle ) { ?>
                                <h3 class="sub-title"><?php echo $page_subtitle; ?></h3>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if ( !$remove_breadcrumbs && $breadcrumb_in_heading ) {
                            echo ss_breadcrumbs();
                        } ?>
                    </div>
            <?php } ?>
        <?php 
        }

        add_action( 'ss_main_container_start', 'ss_page_heading', 5 );
    }
   
?>
