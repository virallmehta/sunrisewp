<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

// Remove default content wrapper output 
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Remove default WooCommerce breadcrumbs 
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Move rating output 
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 );

// Remove default thumbnail output 
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// Remove default sale flash output
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

// Add Shipping Calculator to after cart action 
//add_action( 'woocommerce_after_cart_table', 'woocommerce_shipping_calculator', 10 );

// Remove totals from cart collaterals
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
    
// Remove default product item link 
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

// Remove review meta 
remove_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );

//remove_action( 'woocommerce_after_shop_loop_item', 'yith_add_quick_view_button' , 15 );
//remove_action( 'yith_wcwl_table_after_product_name', 'yith_add_quick_view_button', 15, 0 );

// REMOVE WOOCOMMERCE PRETTYPHOTO STYLES/SCRIPTS
function ss_remove_woo_lightbox_js() {
    wp_dequeue_script( 'prettyPhoto' );
    wp_dequeue_script( 'prettyPhoto-init' );
}
add_action( 'wp_enqueue_scripts', 'ss_remove_woo_lightbox_js', 99 );

function ss_remove_woo_lightbox_css() {
    wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
}
add_action( 'wp_enqueue_styles', 'ss_remove_woo_lightbox_css', 99 );

if ( ! function_exists( 'ss_woo_product_badge' ) ) {
    function ss_woo_product_badge() {
    	global $product, $post, $ss_theme_options;
    	$postdate 		= get_the_time( 'Y-m-d' );			// Post date
    	$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
    	$newness 		= $ss_theme_options['new_badge']; 	// Newness in days
    ?>
	    <div class="badge-wrap">
		    <?php

		    	if ( ss_is_out_of_stock() ) {

		    		echo apply_filters( 'woocommerce_sold_out_flash', '<span class="out-of-stock-badge">' . __( 'Sold out', SS_DOMAIN ) . '</span>', $post, $product);

		    	} else if ($product->is_on_sale()) {

		    		echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'Sale', SS_DOMAIN ).'</span>', $post, $product);

		    	} else if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {

		    		// If the product was published within the newness time frame display the new badge
		    		echo '<span class="wc-new-badge">' . __( 'New', SS_DOMAIN ) . '</span>';

		    	} else if ( $product->get_price() != "" && $product->get_price() == 0 ) {
		    		echo '<span class="free-badge">' . __( 'Free', SS_DOMAIN ) . '</span>';

		    	}
		    ?>
	    </div>
    <?php }
    //add_action( 'woocommerce_before_shop_loop_item_title', 'ss_woo_product_badge', 10 );
}

if ( !function_exists( 'ss_template_loop_product_thumbnail' ) ) {
    function ss_template_loop_product_thumbnail() {
        global $product, $post;

        $size = 'post-thumbnail-gird';

        $thumb_width  = 220;
        $thumb_height = 320;
        
        $image = '';
        echo '<figure class="products-img">';
        ss_woo_product_badge(); 
        if ( has_post_thumbnail() ) {
            $thumb   = get_post_thumbnail_id();
            $img_url = wp_get_attachment_url( $thumb,'full'); // Get img URL
            
            $image = aq_resize( $img_url, $thumb_width, $thumb_height, true, true, true);

            echo '<a href="' . esc_url( get_permalink( $product->get_id() ) ) . '" >';
            echo '<img src="' . esc_url( $image ) . '" width="' . $thumb_width . '" height="' . $thumb_height . '" />';
            echo '</a>';
        } else {
        
            //$placeholder_image = 'http://artooz.dev/wp-content/uploads/2017/11/placeholder.jpg';  // ss_woocommerce_placeholder_img_src();
            $placeholder_image = ss_woocommerce_placeholder_img_src();
           //ss_theme_debug($no_thumb);

           echo '<a href="' . esc_url( get_permalink( $product->get_id() ) ) . '" >';
           echo '<img src="' . esc_url( $placeholder_image ) . '" width="' . $thumb_width . '" height="' . $thumb_height . '" />';

           echo '</a>';
        }
        echo '</figure>';
    }
    //add_action( 'woocommerce_before_shop_loop_item', 'ss_template_loop_product_thumbnail', 10 );
}

if (  !function_exists( 'woocommerce_template_loop_product_title' ) ) {
    function woocommerce_template_loop_product_title() {
        global $product, $post;
        echo '<h3 class="products-title text-center"><a href=' . esc_url(get_the_permalink()) . '>' . esc_html(get_the_title()) . '</a></h3>';
        echo $product->get_categories( ', ', '<span class="posted_in text-center">', '</span>' );
    }
}

if ( !function_exists( 'ss_woocommerce_placeholder_img_src' ) ) {
    function ss_woocommerce_placeholder_img_src() {

        return apply_filters( 'woocommerce_placeholder_img_src', get_template_directory_uri() . '/images/placeholder-shop.jpg' );
    }
}

if ( !function_exists( 'ss_get_image_size' ) ) {
    function ss_get_image_size( $name ) {
        global $_wp_additional_image_sizes;

        if ( isset( $_wp_additional_image_sizes[$name] ) )
            return $_wp_additional_image_sizes[$name];

        return false;
    }
}

if ( !function_exists( 'ss_product_actions_price' ) ) {
    function ss_product_actions_price() {
        global $product;
        echo '<a class="price-link text-center" href="'.get_permalink( $product->id ).'">';
        wc_get_template( 'loop/price.php' );
        echo '</a>';
    }
   // add_action( 'woocommerce_after_shop_loop_item', 'ss_product_actions_price', 0 );
}

function ss_is_out_of_stock() {
    global $post;
    $post_id      = $post->ID;
    $stock_status = ss_get_post_meta( $post_id, '_stock_status', true );
    if ( $stock_status == 'outofstock' ) {
        return true;
    } else {
        return false;
    }
}

if (!function_exists('ss_get_catalog_mode')) {
    function ss_get_catalog_mode() {
        $enable_catalog_mode = false;
        // Catalog Mode
        if ( isset( $ss_theme_options['enable_catalog_mode'] ) ) {
            $enable_catalog_mode = $ss_theme_options['enable_catalog_mode'];
        }
        if ( isset( $_GET['catalog_mode'] ) ) {
            $enable_catalog_mode = $_GET['catalog_mode'];
        }

        return $enable_catalog_mode;
    }
}

// SHOW PRODUCTS COUNT URL PARAMETER
if ( !function_exists('ss_product_shop_count') ) {
    function ss_product_shop_count() {
        global $ss_theme_options;
        $default_count = $products_per_page = $ss_theme_options['products_per_page'];;

        $count = isset($_GET['show_products']) ? $_GET['show_products'] : $default_count;

        if ( $count === 'all' ) {
            $count = -1;
        } else if ( !is_numeric($count) ) {
            $count = $default_count;
        }

        return $count;
    }   
    add_filter( 'loop_shop_per_page', 'ss_product_shop_count'); 
}

// CROSS SELLS COLUMNS
add_filter( 'woocommerce_cross_sells_columns', create_function( '$cross_sells_cols', 'return 4;' ) );

if ( !function_exists( 'ss_woo_welcome_link' ) ) {
    function ss_woo_welcome_link() {
        $woo_output = '<nav >' . "\n";
        $woo_output .= '<ul class="menu">' . "\n";
        if ( is_user_logged_in() ) {
            $current_user = wp_get_current_user();
            get_currentuserinfo();
            $woo_output .= '<li class="welcome-message">' . __( "Welcome", SS_DOMAIN ) . " " . $current_user->display_name . '</li>' . "\n";
        } else {
            $woo_output .= '<li class="welcome-message">' . __( "Welcome", SS_DOMAIN ) . '</li>' . "\n";
        }

        return $woo_output;
    }
}

if ( !function_exists( 'ss_woo_account_links' )) {
    function ss_woo_account_links() {
        $login_url         = wp_login_url();
        $logout_url        = wp_logout_url( home_url() );
        $my_account_link   = get_admin_url();
        $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
        if ( $myaccount_page_id ) {
            $my_account_link = get_permalink( $myaccount_page_id );
            $logout_url      = wp_logout_url( get_permalink( $myaccount_page_id ) );
            $login_url       = get_permalink( $myaccount_page_id );
            if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
                $logout_url = str_replace( 'http:', 'https:', $logout_url );
                $login_url  = str_replace( 'http:', 'https:', $login_url );
            }
        }
        $login_url       = apply_filters( 'ss_header_login_url', $login_url );
        $my_account_link = apply_filters( 'ss_header_myaccount_url', $my_account_link );
        $links_output  = '<div class="extra-links">' . "\n";
        $links_output .= '<nav class="std-menu">' . "\n";
        $links_output .= '<ul class="menu">' . "\n";
        
        // Login / Logout
        if ( is_user_logged_in() ) {
            $links_output .= '<li class="parent account-item"><a href="#">' . "\n";
            $links_output .= '<ul class="sub-menu">' . "\n";

            $links_output .= '<li><a href="' . $logout_url . '">' . __( "Sign Out", SS_DOMAIN  ) . '</a></li>' . "\n";
            $links_output .= '<li><a href="' . $my_account_link . '" class="admin-link">' . __( "My Account", SS_DOMAIN ) . '</a></li>' . "\n";
            $links_output .= '</ul>' . "\n";
            $links_output .= '</li>' . "\n";
        } else {
            $links_output .= '<li class="parent account-item"><a href="' . $login_url . '">' .
            apply_filters( 'ss_header_cart_icon', '<i class="fa fa-user" aria-hidden="true"></i>' ) .
             '</a></li>' . "\n";
        }

        $links_output .= '</ul>' . "\n";
        $links_output .= '</nav>' . "\n";
        $links_output .= '</div>' . "\n";

        return $links_output;
    }
}

if( !function_exists( 'ss_woo_cart_links()' )) {
    function ss_woo_cart_links() {
        
        $links_output  = '<div class="extra-links">' . "\n";
        $links_output .= '<nav class="std-menu cart-link">' . "\n";
        $links_output .= '<ul class="menu">' . "\n";

        $links_output .= ss_get_cart();

        $links_output .= '</ul>' . "\n";
        $links_output .= '</nav>' . "\n";
        $links_output .= '</div>' . "\n";

        return $links_output;
    }
}

if ( !function_exists( 'ss_get_currency_switcher' ) ) {
    function ss_get_currency_switcher() {
        $currency_switch_output = "";
        if ( class_exists('WCML_Multi_Currency') ) {
            $currency_code = get_option('woocommerce_currency');
            $currency_switch_output .= '<li class="parent currency-switch-item">';
            $currency_switch_output .= '<span class="current-currency">' . get_woocommerce_currency_symbol() . '</span>';
            $currency_switch_output .= do_shortcode('[currency_switcher switcher_style="list" format="%code% (%symbol%)"]');
            $currency_switch_output .= '</li>';
            return $currency_switch_output;
        } else {
            $currency_switch_output = '<li><span class="current-currency">&times;</span><ul class="sub-menu"><li><span>WPML + WooCommerce Multilingual plugins are required for this functionality.</span></li></ul></li>';
            return $currency_switch_output;
        }
    }
}

if ( ! function_exists( 'ss_language_flags' ) ) {
    function ss_language_flags() {

        $language_output = "";

        if ( function_exists( 'pll_the_languages' ) ) {
            $languages = pll_the_languages(array('raw' =>1 ));
            if ( !empty( $languages ) ) {
                foreach( $languages as $l ) {
                    $language_output .= '<li>';
                    if ( $l['flag'] ) {
                        if ( !$l['current_lang'] ) {
                            $language_output .= '<a href="'.$l['url'].'"><img src="'.$l['flag'].'" height="12" alt="'.$l['slug'].'" width="18" /><span class="language name">'.$l['name'].'</span></a>'."\n";
                        } else {
                            $language_output .= '<div class="current-language"><img src="'.$l['flag'].'" height="12" alt="'.$l['slug'].'" width="18" /><span class="language name">'.$l['name'].'</span></div>'."\n";
                        }
                    }
                    $language_output .= '</li>';
                 }
            }
        } else if ( function_exists( 'icl_get_languages' ) ) {
            global $sitepress_settings;
            $languages = icl_get_languages( 'skip_missing=0&orderby=code' );
            if ( ! empty( $languages ) ) {
                foreach ( $languages as $l ) {
                    $name = $l['translated_name'];
                    if ( $sitepress_settings['icl_lso_native_lang'] ) {
                        $name = $l['native_name'];
                    }
                    $language_output .= '<li>';
                    if ( $l['country_flag_url'] ) {
                        if ( ! $l['active'] ) {
                            $language_output .= '<a href="' . $l['url'] . '"><img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" /><span class="language name">' . $name . '</span></a>' . "\n";
                        } else {
                            $language_output .= '<div class="current-language"><img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" /><span class="language name">' . $name . '</span></div>' . "\n";
                        }
                    }
                    $language_output .= '</li>';
                }
            }
        } else {
            //echo '<li><div>No languages set.</div></li>';
            $flags_url = get_template_directory_uri() . '/images/flags';
            $language_output .= '<li><a href="#">DEMO - EXAMPLE PURPOSES</a></li><li><a href="#"><span class="language name">German</span></a></li><li><div class="current-language"><span class="language name">English</span></div></li><li><a href="#"><span class="language name">Spanish</span></a></li><li><a href="#"><span class="language name">French</span></a></li>' . "\n";
        }

        return $language_output;
    }
}

if ( !function_exists( 'ss_get_cart' ) ) {
    function ss_get_cart() {

        $cart_output = "";

        // Check if WooCommerce is active
        if ( ss_woocommerce_activated() ) {

            global $woocommerce;

            $cart_total =  WC()->cart->get_cart_total();

            $cart_count          = $woocommerce->cart->cart_contents_count;
            $cart_count_text     = ss_product_items_text( $cart_count );
            $cart_count_text_alt = ss_product_items_text( $cart_count, true );
            $view_cart_icon      = apply_filters( 'ss_view_cart_icon', '<i class="fa fa-shopping-basket" aria-hidden="true"></i>
' );
            $checkout_icon       = apply_filters( 'ss_checkout_icon', '<i class="fa fa-money" aria-hidden="true"></i>
' );
            $go_to_shop_icon     = apply_filters( 'ss_go_to_shop_icon', '<i class="fa fa-shopping-basket" aria-hidden="true"></i>' );

            $cart_output .= '<li class="parent shopping-bag-item"><a class="cart-contents" href="' . $woocommerce->cart->get_cart_url() . '" title="' . __( "View your shopping cart", SS_DOMAIN ) . '">'. apply_filters( 'ss_header_cart_icon', '<i class="fa fa-shopping-basket" aria-hidden="true"></i> ' ) . '<span class="cart-text">' . __( "Cart", SS_DOMAIN ) . '</span>' . $cart_total . '<span class="num-items">' . $cart_count_text_alt . '</span></a>';

            $cart_output .= '<ul class="sub-menu">';
            $cart_output .= '<li>';
            $cart_output .= '<div class="shopping-bag">';
            $cart_output .= '<div class="loading-overlay"><i class="artooz-icon-loader"></i></div>';

            if ( $cart_count != "0" ) {

                    $cart_output .= '<div class="bag-header">' . $cart_count_text . ' ' . __( 'in the cart', SS_DOMAIN ) . '</div>';

                    $cart_output .= '<div class="bag-contents">';

                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

                        $_product            = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                        
                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                        
                            $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                            $product_title       = $_product->get_title();
                            $product_short_title = ( strlen( $product_title ) > 25 ) ? substr( $product_title, 0, 22 ) . '...' : $product_title;
                            
                            $cart_output .= '<div class="bag-product clearfix">';
                            $cart_output .= '<figure><a class="bag-product-img" href="' . get_permalink( $cart_item['product_id'] ) . '">' . $_product->get_image() . '</a></figure>';
                            $cart_output .= '<div class="bag-product-details">';
                            $cart_output .= '<div class="bag-product-title"><a href="' . get_permalink( $cart_item['product_id'] ) . '">' . apply_filters( 'woocommerce_cart_widget_product_title', $product_short_title, $_product ) . '</a></div>';
                            $cart_output .= '<div class="bag-product-price">' . __( "Unit Price:", SS_DOMAIN ) . '
                            ' . $product_price . '</div>';
                            $cart_output .= '<div class="bag-product-quantity">' . __( 'Quantity:', SS_DOMAIN ) . ' ' . apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ) . '</div>';
                            $cart_output .= '</div>';
                            $cart_output .= apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                                        '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                        esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                                        __( 'Remove this item', SS_DOMAIN ),
                                                        esc_attr( $product_id ),
                                                        esc_attr( $_product->get_sku() )
                                                    ), $cart_item_key );
                            $cart_output .= '</div>';
                        }
                    }

                    $cart_output .= '</div>';

                    $cart_output .= '<div class="bag-total">';
                    $cart_output .= '<span class="total-title">' . __( "Total", SS_DOMAIN ) . '</span>';
                    $cart_output .= '<span class="total-amount">' .  WC()->cart->get_cart_total() . '</span>';
                    $cart_output .= '</div>';

                    $cart_output .= '<div class="bag-buttons">';

                    $cart_output .= '<a class="sf-button standard sf-icon-reveal bag-button" href="' . esc_url( $woocommerce->cart->get_cart_url() ) . '">'.$view_cart_icon.'<span class="text">' . __( 'View cart', SS_DOMAIN ) . '</span></a>';

                    $cart_output .= '<a class="sf-button standard sf-icon-reveal checkout-button" href="' . esc_url( $woocommerce->cart->get_checkout_url() ) . '">'.$checkout_icon.'<span class="text">' . __( 'Checkout', SS_DOMAIN ) . '</span></a>';

                    $cart_output .= '</div>';

                } else {

                    $cart_output .= '<div class="bag-empty">' . __( 'Your cart is empty.', SS_DOMAIN ) . '</div>';

                }

                $cart_output .= '</div>';
                $cart_output .= '</li>';
                $cart_output .= '</ul>';
                $cart_output .= '</li>';
        }

        return $cart_output;
    }
}

if ( ! function_exists( 'ss_woo_header_add_to_cart_fragment' ) ) {
    function ss_woo_header_add_to_cart_fragment( $fragments ) {
        global $woocommerce, $ss_theme_options;

        ob_start();

        $cart_total = WC()->cart->get_cart_total();

        $cart_count          = $woocommerce->cart->cart_contents_count;
        $cart_count_text     = ss_product_items_text( $cart_count );
        $cart_count_text_alt = ss_product_items_text( $cart_count, true );
         $view_cart_icon      = apply_filters( 'ar_view_cart_icon', '<i class="fa fa-shopping-basket" aria-hidden="true"></i>
' );
        $checkout_icon       = apply_filters( 'ar_checkout_icon', '<i class="fa fa-money" aria-hidden="true"></i>
' );
        $go_to_shop_icon     = apply_filters( 'ar_go_to_shop_icon', '<i class="fa fa-shopping-basket" aria-hidden="true"></i>' );

        $extra_class         = "";
        
        if ( $cart_count != "0" ) {
            $extra_class .= "cart-not-empty ";
        }
        
        ?>

        <li class="parent shopping-bag-item <?php echo $extra_class; ?>">

                <a class="cart-contents" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"
                   title="<?php _e( 'View your shopping cart', SS_DOMAIN ); ?>">
                   <?php echo apply_filters( 'ss_header_cart_icon', '<i class="fa fa-shopping-basket" aria-hidden="true"></i>' ); ?><span class="cart-text"><?php _e( "Cart", SS_DOMAIN ); ?></span><?php echo $cart_total; ?><span class="num-items cart-count-enabled"><?php echo $cart_count_text_alt; ?></span></a>


            <ul class="sub-menu">
                <li>

                    <div class="shopping-bag" data-empty-bag-txt="<?php _e( 'Your cart is empty.', SS_DOMAIN ); ?>" data-singular-item-txt="<?php _e( 'item in the cart', SS_DOMAIN ); ?>" data-multiple-item-txt="<?php _e( 'items in the cart', SS_DOMAIN ); ?>">

                      <div class="loading-overlay"><i class="artooz-icon-loader"></i></div>

                        <?php if ( $cart_count != "0" ) { ?>

                            <div
                                class="bag-header"><?php echo $cart_count_text; ?> <?php _e( 'in the cart', SS_DOMAIN ); ?></div>

                            <div class="bag-contents">

                                <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { ?>
                                
                                    <?php
                                    $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                    $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                    ?>

                                    <?php  
                                    
                                    $variation_id_class = '';
                                    
                                    if ( $cart_item['variation_id'] > 0 )
                                         $variation_id_class = ' product-var-id-' .  $cart_item['variation_id']; 
                                     
                                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                        
                                        $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                                        $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                        $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                        $product_title       = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                                        $product_short_title = ( strlen( $product_title ) > 25 ) ? substr( $product_title, 0, 22 ) . '...' : $product_title;
                                    ?>

                                            <div class="bag-product clearfix  product-id-<?php echo $cart_item['product_id']; ?>">

                                            <figure>
                                                <a class="bag-product-img" href="<?php echo esc_url( $product_permalink ); ?>">
                                                    <?php echo $_product->get_image(); ?>
                                                </a>
                                            </figure>

                                            <div class="bag-product-details">
                                                <div class="bag-product-title">
                                                    <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
                                                        <?php echo apply_filters( 'woocommerce_cart_widget_product_title', $product_title, $_product ); ?></a>
                                                </div>
                                                <div
                                                    class="bag-product-price"><?php _e( "Unit Price:", SS_DOMAIN ); ?> <?php echo $product_price; ?></div>
                                                <div
                                                    class="bag-product-quantity"><?php _e( 'Quantity:', SS_DOMAIN ); ?> <?php echo $cart_item['quantity']; ?></div>
                                            </div>

                                            <?php
                                            echo  apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                                    '<a href="%s" class="remove remove-product" title="%s" data-ajaxurl="'.admin_url( 'admin-ajax.php' ).'" data-product-qty="'. $cart_item['quantity'] .'"  data-product-id="%s" data-product_sku="%s">&times;</a>',
                                                    esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                                    __( 'Remove this item', SS_DOMAIN ),
                                                    esc_attr( $product_id ),
                                                    esc_attr( $_product->get_sku() )
                                                ), $cart_item_key );
                                            ?>

                                        </div>

                                    <?php } ?>

                                <?php } ?>

                            </div>

                            <div class="bag-total">
                                <?php if ( class_exists( 'Woocommerce_German_Market' ) ) { ?>
                                <span class="total-title"><?php _e( "Total incl. tax", SS_DOMAIN ); ?></span>
                                <?php } else { ?>
                                <span class="total-title"><?php _e( "Total", SS_DOMAIN ); ?></span>
                                <?php } ?>
                                <span class="total-amount"><?php echo WC()->cart->get_cart_total(); ?></span>
                            </div>

                            <div class="bag-buttons">

                                <a class="sf-button standard sf-icon-reveal bag-button" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>">
                                    <?php echo $view_cart_icon; ?>
                                    <span class="text"><?php _e( 'View cart', SS_DOMAIN ); ?></span>
                                </a>

                                <a class="sf-button standard sf-icon-reveal checkout-button" href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>">
                                    <?php echo $checkout_icon; ?>
                                    <span class="text"><?php _e( 'Checkout', SS_DOMAIN ); ?></span>
                                </a>

                            </div>

                        <?php } else { ?>

                            <div class="bag-empty"><?php _e( 'Your cart is empty.', SS_DOMAIN ); ?></div>

                        <?php } ?>

                    </div>
                </li>
            </ul>
        </li>

        <?php

        $fragments['.shopping-bag-item'] = ob_get_clean();

        return $fragments;

    }

    add_filter( 'add_to_cart_fragments', 'ss_woo_header_add_to_cart_fragment' );
}

if ( ! function_exists( 'ss_product_items_text' ) ) {
    function ss_product_items_text( $count, $alt = false ) {
        $product_item_text = "";

        if ( $alt == true ) {
            return number_format_i18n( $count );
        } else {
            if ( $count > 1 ) {
                $product_item_text = str_replace( '%', number_format_i18n( $count ), __( '% items', SS_DOMAIN ) );
            } elseif ( $count == 0 ) {
                $product_item_text = __( '0 items', SS_DOMAIN );
            } else {
                $product_item_text = __( '1 item', SS_DOMAIN );
            }

            return $product_item_text;
        }
    }
}

if ( ! function_exists( 'ss_shop_layout_opts' ) ) {
    function ss_shop_layout_opts() {

        global $ss_theme_options;
        $product_multi_masonry = $ss_theme_options['product_multi_masonry'];
        $product_display_type = $ss_theme_options['product_display_type'];
        if (isset($_GET['product_display'])) {
            $product_display_type = $_GET['product_display'];
        }

    ?>
        <div class="shop-layout-opts" data-display-type="<?php echo $product_display_type; ?>">
            <a href="#" class="layout-opt" data-layout="list" title="<?php _e("List Layout", SS_DOMAIN); ?>"><i class="fa fa-list" aria-hidden="true"></i></a>
            <a href="#" class="layout-opt" data-layout="grid" title="<?php _e("Grid Layout", SS_DOMAIN); ?>"><i class="fa fa-th" aria-hidden="true"></i></a>
        </div>
    <?php }
    add_action( 'woocommerce_before_shop_loop', 'ss_shop_layout_opts', 10 );
}

//remove_action( 'woocommerce_after_shop_loop_item', array("YITH_WCQV_Frontend", 'yith_add_quick_view_button'), 15 );
//remove_action( 'yith_wcwl_table_after_product_name', array('YITH_WCQV_Frontend', 'yith_add_quick_view_button'), 15, 0 );
function ss_add_quick_view_button() {
    global $product;

    $product_id = $product->get_id();
    $label = '<i class="fa fa-search"></i>';
    $html = '<div class="qview">';
    $html .= '<a href="#" class="button yith-wcqv-button" data-product_id="' . $product_id . '">' . $label . '</a>';
    $html .= '</div>';
    echo $html;
}
add_action( 'woocommerce_after_shop_loop_item', 'ss_add_quick_view_button', 15 );
add_action( 'yith_wcwl_table_after_product_name', 'ss_add_quick_view_button', 15, 0 );


function ss_custom_sales_price( $price, $product ) {
    $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
    return $price . sprintf( __(' Save %s', 'woocommerce' ), $percentage . '%' );
}
add_filter( 'woocommerce_sale_price_html', 'ss_custom_sales_price', 10, 2 );

/* SINGLE PRODUCT
    ================================================== */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

if ( !function_exists( 'ss_product_price_rating' ) ) {
    function ss_product_price_rating() {
        global $post, $product, $wpdb;
        // Catalog Mode
        $ss_catalog_mode = ss_get_catalog_mode();
        ?>
        <div class="product-price-wrap clearfix">
            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

                <h3 class="price"><?php echo $product->get_price_html(); ?></h3>
                
                <meta itemprop="price" content="<?php echo esc_attr($product->get_price()); ?>" />
                <meta itemprop="priceCurrency" content="<?php echo esc_attr(get_woocommerce_currency()); ?>" />
                <div class="stock-availability">
                    Aavailability: <span class="<?php echo $product->is_in_stock() ? 'in-stock' : 'out-stock'; ?>"> <?php echo $product->is_in_stock() ? 'In Stock' : 'Out Of Stock'; ?></span>
                </div>

            </div>
            
            <?php if ( 'open' == $post->comment_status && $rating_html = $product->get_rating_html() ) : ?>
                <?php echo $rating_html; ?>
             <?php endif; ?>
            
        </div>
        <?php
    }
    add_action( 'woocommerce_single_product_summary', 'ss_product_price_rating', 10 );
}

function ss_remove_reviews_tab($tabs) {
    
    $product_reviews_pos = "default";
    
    if ( $product_reviews_pos == "default" ) {
        unset($tabs['reviews']);
    }
    
    return $tabs;
}
//add_filter( 'woocommerce_product_tabs', 'ss_remove_reviews_tab', 98);

/* RELATED PRODUCTS */
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
//add_action( 'sf_after_single_product_reviews', 'woocommerce_output_related_products', 20);

/* UPSELL PRODUCTS */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_upsell_display', 60 );

if ( !function_exists( 'ss_single_product_image_html' ) ) {
    function ss_single_product_image_html( $html, $post_ID ) {
    
        if ( version_compare( WC_VERSION, '2.7', '>=' ) ) { 
            return $html;
        }
        
        $video_url          = get_post_meta( $post_ID, '_video_url', true );
        $image_caption      = $image_alt = $image_title = $caption_html = "";
        $image_id           = get_post_thumbnail_id();
        $image_meta         = ss_get_attachment_meta( $image_id );
        
        if ( isset($image_meta) ) {
            $image_caption      = esc_attr( $image_meta['caption'] );
            $image_title        = esc_attr( $image_meta['title'] );
            $image_alt          = esc_attr( $image_meta['alt'] );
        }
        $image_link         = wp_get_attachment_url( $image_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
        $image              = get_the_post_thumbnail( $post_ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
            'title' => $image_title,
            'alt'   => $image_title,
            'class' => 'product-slider-image',
            'data-zoom-image' => $image_link
        ) );                            

        $thumb_image = wp_get_attachment_image_url( $image_id, apply_filters('single_product_large_thumbnail_size', 'shop_thumbnail') );

        if ( $image_caption != "" ) {
            $caption_html = '<div class="img-caption">' . $image_caption . '</div>';
        }
    
        if ( $video_url != '' ) {
            return '<div class="video-wrap" data-thumb="' . $thumb_image . '">' . $html . '</div>';
        } else {
            return sprintf( '<li itemprop="image" data-thumb="%s">%s%s<a href="%s" itemprop="image" class="woocommerce-main-image zoom lightbox" data-rel="ilightbox[product]" data-caption="%s" title="%s" alt="%s"><i class="fa-search-plus"></i></a></li>', $thumb_image, $caption_html, $image, $image_link, $image_caption, $image_title, $image_alt );
        }
    }
    add_filter('woocommerce_single_product_image_html', 'ss_single_product_image_html', 15, 2);
}

if ( ! function_exists( 'ss_single_product_image_thumbnail_html' ) ) {
    function ss_single_product_image_thumbnail_html( $html, $attachment_id, $post_ID = '', $image_class = '' ) {
    
        if ( version_compare( WC_VERSION, '2.7', '>=' ) ) { 
            return $html;
        }
        
        $image_caption = $image_alt = $image_title = $caption_html = "";
        $image_id = $attachment_id;
        $image_meta = sf_get_attachment_meta( $image_id );
        
        if ( isset($image_meta) ) {
            $image_caption      = esc_attr( $image_meta['caption'] );
            $image_title        = esc_attr( $image_meta['title'] );
            $image_alt          = esc_attr( $image_meta['alt'] );
        }
        
        $image_link  = wp_get_attachment_url( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
        $thumb_image = wp_get_attachment_image_url( $attachment_id, apply_filters('single_product_large_thumbnail_size', 'shop_thumbnail') );
        $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), false, array(
            'title' => $image_title,
            'alt'   => $image_title,
            'class' => 'product-slider-image',
            'data-zoom-image' => $image_link
        ) );
    
        if ( $image_caption != "" ) {
            $caption_html = '<div class="img-caption">' . $image_caption . '</div>';
        }
        return '<li itemprop="image" data-thumb="'.$thumb_image.'">' . $image . '' . $caption_html . '<a href="'.$image_link.'" itemprop="image" class="woocommerce-main-image zoom lightbox" data-rel="ilightbox[product]" data-caption="'.$image_caption.'" title="'.$image_title.'" alt="'.$image_alt.'"><i class="fa-search-plus"></i></a></li>';
    }
    add_filter('woocommerce_single_product_image_thumbnail_html', 'ss_single_product_image_thumbnail_html', 15, 4);
}

/**
* custom_woocommerce_template_loop_add_to_cart
*/
if ( ! function_exists('ss_woocommerce_product_add_to_cart_text')) {
    function ss_woocommerce_product_add_to_cart_text() {
        global $product;
        $product_type = $product->product_type;
        switch ( $product_type ) {
            case 'external':
                return __( 'Buy Now', 'woocommerce' );
                break;
            case 'grouped':
                return __( 'View products', 'woocommerce' );
                break;
            case 'simple':
                return __( 'Buy Now', 'woocommerce' );
                break;
            case 'variable':
                return __( 'Select options', 'woocommerce' );
                break;
            default:
                return __( 'Read more', 'woocommerce' );
        }
    }
    add_filter( 'woocommerce_product_add_to_cart_text' , 'ss_woocommerce_product_add_to_cart_text' );
}

remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 ); 
add_action( 'woocommerce_proceed_to_checkout', 'ss_woocommerce_custom_checkout_button_text', 20 );

function ss_woocommerce_custom_checkout_button_text() {
    $checkout_url = WC()->cart->get_checkout_url();
  ?>
       <a href="<?php echo $checkout_url; ?>" class="checkout-button button alt wc-forward"><?php  _e( 'Check Out', 'woocommerce' ); ?></a> 
  <?php
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'ss_woocommerce_custom_cart_button_text' );
function ss_woocommerce_custom_cart_button_text() {
        return __( 'Buy Now', 'woocommerce' );
}

// /*View Cart*/
// function ss_woocomerce_text_view_cart_strings( $translated_text, $text, $domain ) {
//     switch ( $translated_text ) {
//         case 'View Cart' :
//             $translated_text = __( 'Check Out', 'woocommerce' );
//             break;
//     }
//     return $translated_text;
// }
// add_filter( 'gettext', 'ss_woocommerce_text_view_cart_strings', 20, 3 );

class ss_product_widget extends WP_Widget {

    function __construct() {
        $widget_ops  = array(
            'classname'   => 'widget-woocommerce-product',
            'description' => __('Artooz widget that shows WooCommerce all type product (Latest, Feature, On Sale, Up Sale).', SS_DOMAIN)
        );
        parent::__construct( 'woocommerce-product-widget', 'Artooz Product Widget', $widget_ops );
    }

    function widget( $args, $instance ) {

        $title          = isset( $instance['title']) ? $instance['title'] : 'Latest Products';
        $product_type   = isset( $instance['type']) ? $instance['type'] : 'latest_product';
        $product_number = isset( $instance['number']) ? $instance['number'] : 4;

        $product_args =   '';
        
        if ($product_type == 'latest_product') {
            $product_args = array(
                'post_type' => 'product',
                'posts_per_page' => $product_number
            );
        } elseif ($product_type == 'upsell_product') {
            $product_args = array(
                'post_type'         => 'product',
                'posts_per_page'    => 10,
                'meta_key'          => 'total_sales',
                'orderby'           => 'meta_value_num',
                'posts_per_page'    => $product_number
            );
        } elseif ($product_type == 'feature_product') {
            $product_args = array(
                'post_type'        => 'product',
                'posts_per_page'   => $product_number,
                'tax_query'        => array(
                    array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                        'operator' => 'IN'
                    )   
                ),
            );
        } elseif ($product_type == 'on_sale') {
            $product_args = array(
            'post_type'      => 'product',
            '   '     => array(
                'relation' => 'OR',
                array( // Simple products type
                    'key'           => '_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                ),
                array( // Variable products type
                    'key'           => '_min_variation_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            ));
        } elseif ($product_type == 'popular_product') {
            $product_args = array(
                'post_type'         => 'product',
                'posts_per_page'    => 10,
                'meta_key'          => '_custom_product_checkbox_product_popular',
                'orderby'           => 'meta_value_num',
                'posts_per_page'    => $product_number
            );
        } elseif ($product_type == 'product_week') {
            $product_args = array(
                'post_type'         => 'product',
                'posts_per_page'    => 10,
                'meta_key'          => '_custom_product_checkbox_product_week',
                'orderby'           => 'meta_value_num',
                'posts_per_page'    => $product_number
            );
        }
        echo $before_widget; 
        ?>
        <div class="woocommerce <?php echo $product_type; ?>">
            <div class="widget-woocommerce-container">
                <div class="row">
                    <?php if (!empty($title)) { ?>
                    <div class="widget_title">
                        <h4><?php echo $title ?></h4>
                    </div>
                    <?php } ?>
                    <div class="widget-product products product-grid">
                        <?php
                            wp_reset_query();                   
                            $query = new WP_Query($product_args);
                            if ( $query->have_posts() ) { 
                                while ( $query->have_posts() ) { 
                                    $query->the_post();
                        
                                    wc_get_template_part( 'content', 'product-widgets' );
                                }
                            }
                            wp_reset_query(); 
                        ?>                    
                    </div>
                </div>
            </div>
        </div>
        <?php         
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title']  = strip_tags( $new_instance['title'] );
        $instance['type'] = strip_tags($new_instance['type']);
        $instance['number'] = strip_tags( $new_instance['number'] );  // absint()

        return $instance;
    }

    function form( $instance ) {

        $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Products';
        $count = isset( $instance['number'] ) ? esc_attr( $instance['number'] ) : 4;
        $type  = isset( $instance['type'] ) ? esc_attr( $instance['type'] ) : 'latest_product';

        $types = array( 'latest_product', 'feature_product', 'on_sale', 'up_sell', 'popular_product', 'product_week');
        $type_names = array(
            'latest_product'    => __('Latest Product', SS_DOMAIN),
            'feature_product'   => __('Featured Product', SS_DOMAIN),
            'on_sale'           => __('On Sale', SS_DOMAIN),
            'up_sell'           => __('Up Sell', SS_DOMAIN),
            'popular_product'   => __('Popular Product', SS_DOMAIN),
            'product_week'      => __('Product of Week', SS_DOMAIN),
        );

        ?>
        <p>
            <label><?php _e( 'Title', SS_DOMAIN ); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"
                   class="widefat" type="text"/>
        </p>

        <p>
            <label><?php _e('Product Type', SS_DOMAIN); ?>:</label>
            <select name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'type' )); ?>" class="widefat">
                    <?php foreach($types as $type_item) : ?>
                        <option value="<?php echo esc_attr($type_item); ?>"<?php if($type == $type_item) echo ' selected="selected"'; ?>><?php echo esc_html($type_names[$type_item]); ?></option>
                    <?php endforeach; ?>'
            </select>
        </p>
        
        <p>
            <label><?php _e( 'Number', SS_DOMAIN ); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>"
                   class="widefat" type="text"/>
        </p>
    <?php }

}
add_action( 'widgets_init', 'ss_load_product_widgets' );

function ss_load_product_widgets() {
    register_widget( 'ss_product_widget' );
}

/* WOO SHIPPING CALC BEFORE
    ================================================== */
if ( ! function_exists('ss_cart_shipping_calc_before')){
    function ss_cart_shipping_calc_before() {
        echo '<div class="shipping-calc-wrap">';
        echo '<h4 class="lined-heading">'.__( 'Shipping Calculator', SS_DOMAIN ).'</h4>';
    }
    add_action( 'woocommerce_before_shipping_calculator', 'ss_cart_shipping_calc_before' );
}


/* WOO SHIPPING CALC AFTER
================================================== */
if ( ! function_exists('artoox_cart_shipping_calc_after')){
    function ss_cart_shipping_calc_after() {
        echo '</div>';
    }
    add_action( 'woocommerce_after_shipping_calculator', 'ss_cart_shipping_calc_after' );
}

// Disable gateway based on country
function ss_payment_gateway_disable_country( $available_gateways ) {
    global $woocommerce;
    if ( isset( $available_gateways['paypal'] ) && $woocommerce->customer->get_country() == 'IN' ) {   
        unset( $available_gateways['paypal'] );
    }
    return $available_gateways;
}
//add_filter( 'woocommerce_available_payment_gateways', 'ss_payment_gateway_disable_country' );


// Display Fields
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');

// Save Fields
add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save');


function woocommerce_product_custom_fields()
{
    global $woocommerce, $post;
    echo '<div class="product_custom_field">';

    woocommerce_wp_checkbox(
        array(
            'id' => '_custom_product_checkbox_product_popular',
            'label' => __('Popular Product'),
        )
    );

    woocommerce_wp_checkbox(
        array(
            'id' => '_custom_product_checkbox_product_week',
            'label' => __('Product of Week'),
        )
    );

    echo '</div>';

}

function woocommerce_product_custom_fields_save($post_id)
{
    $woocommerce_custom_product_checkbox_product_popular = $_POST['_custom_product_checkbox_product_popular'];
    if (!empty($woocommerce_custom_product_checkbox_product_popular))
        update_post_meta($post_id, '_custom_product_checkbox_product_popular', esc_attr($woocommerce_custom_product_checkbox_product_popular));

   $woocommerce_custom_product_checkbox_product_week = $_POST['_custom_product_checkbox_product_week'];
    if (!empty($woocommerce_custom_product_checkbox_product_week))
        update_post_meta($post_id, '_custom_product_checkbox_product_week', esc_attr($woocommerce_custom_product_checkbox_product_week));

}

if ( ! function_exists( 'ss_wishlist_button' ) ) {
    function ss_wishlist_button($extra_class = "") {

        global $product, $yith_wcwl;
        $product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;

        if ( class_exists( 'YITH_WCWL_UI' ) ) {
            $product_type = $product->product_type;
            $tooltip      = __("Add to wishlist", SS_DOMAIN);

            //Check Wishlist version
            if ( version_compare( get_option('yith_wcwl_version'), "2.0" ) >= 0 ) {
                $url = YITH_WCWL()->get_wishlist_url();
                $default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

                if ( ! empty( $default_wishlists ) ) {
                    $default_wishlist = $default_wishlists[0]['ID'];
                }
                else {
                    $default_wishlist = false;
                }

                $exists = YITH_WCWL()->is_product_in_wishlist( $product_id , $default_wishlist);
            }
            else {
                $url = $yith_wcwl->get_wishlist_url();
                $exists = $yith_wcwl->is_product_in_wishlist( $product_id );
            }

            if ( $exists ) {
                $tooltip  = __("View wishlist", SS_DOMAIN);
            }

            $classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist"';
            
            $html = '<div class="yith-wcwl-divide"></div>';
            $html .= '<div class="yith-wcwl-add-to-wishlist '.$extra_class.'" data-toggle="tooltip" data-placement="top" title="'.$tooltip.'">';
            $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row

            $html .= $exists ? ' hide" style="display:none;"' : ' show"';
            $html .= '><a href="' . htmlspecialchars( $yith_wcwl->get_addtowishlist_url() ) . '" rel="nofollow" data-ajaxurl="' . admin_url( 'admin-ajax.php' ). '" data-product-id="' . $product_id . '" data-product-type="' . $product_type . '" ' . $classes . ' >';

            $html .= apply_filters('ar_add_to_wishlist_icon', '<i class="fa fa-heart"></i>');
            $html .= '</a></div>';

            $html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><span class="feedback">' . __( 'Product added to wishlist.', SS_DOMAIN ) . '</span> <a href="' . $url . '" rel="nofollow">';
            $html .= apply_filters('ar_added_to_wishlist_icon', '<i class="fa fa-check"></i>');
            $html .= '</a></div>';
            $html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . $url . '">';
            $html .= apply_filters('ar_added_to_wishlist_icon', '<i class="fa fa-check"></i>');
            $html .= '</a></div>';
            $html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';

            $html .= '</div>';

            return $html;
        }
    }

    add_action( 'woocommerce_after_add_to_cart_button', 'ss_wishlist_button', 10 );
}