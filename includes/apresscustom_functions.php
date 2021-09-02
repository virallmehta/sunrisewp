<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; }
// Current Page ID
if( !function_exists('apress_current_page_id') ){
	function apress_current_page_id() {
		global $apress_data, $woocommerce; 
		if ((is_front_page() && is_home()) ||
		(get_option('page_for_posts') && is_archive() && !is_post_type_archive()) && !(is_tax('product_cat') || is_tax('product_tag')) || (get_option('page_for_posts') && is_search()) || is_tag() || is_archive() ) {
		//echo 'Default homepage';
		$cur_id = get_option( 'page_for_posts' );
		} elseif ( is_front_page() ) {
		//echo 'static homepage';
		$cur_id = get_the_ID();
		} elseif ( is_home() ) {  	
		//echo 'blog page';
		$cur_id = get_option( 'page_for_posts' );
		} else {
		//echo 'everything else';
		$cur_id = get_the_ID();
		}
		return $cur_id;
	}
}
// Header layout 
if( !function_exists('apress_header') ){
	function apress_header() {
		global $apress_data, $post; 
		$c_pageID = apress_current_page_id();
		$header_position = isset($apress_data["header_position"]) ? $apress_data["header_position"] : 'Top';
		$header_type = isset($apress_data["header_layout"]) ? $apress_data["header_layout"] : 'v1';
		
		$page_slider_pos  = get_post_meta($c_pageID, 'zt_page_slider_pos', true ); 
		$page_slider_type = get_post_meta($c_pageID, 'zt_page_slider_type', true ); 
		
		$enable_onepage = isset($apress_data["enable_onepage"]) ? $apress_data["enable_onepage"] : 'off';
		
		$onepage_home = $enable_onepage == 'on' ? 'onepage_home' : '';
				
		$custom_header_dragdrop = isset($apress_data["custom_header_dragdrop"]) ? $apress_data["custom_header_dragdrop"] : 'preset';	
		$left_right_slider_screen = isset($apress_data["left_right_slider_screen"]) ? $apress_data["left_right_slider_screen"] : 'full_screen_slider';
		
		if($page_slider_type == 'rev'){
			if($page_slider_pos == 'below' || $page_slider_pos == 'default' || $page_slider_pos == ''){			
				$zt_slider_pos = 'below';
			}elseif($page_slider_pos == 'above'){
				$zt_slider_pos = 'above';
			}elseif($page_slider_pos == 'from_top'){
				$zt_slider_pos = 'from_top';
			}
		}else{$zt_slider_pos = '';}
		
		// Show/Hide header
		$header_display = '';
		if ( (is_front_page() && is_home()) ||  is_home() ) {
			$cur_id = get_option( 'page_for_posts' );
			$header_display = get_post_meta( $c_pageID, 'zt_header_display', true );
		}elseif(is_page() || is_single()){
			$header_display = get_post_meta( $c_pageID, 'zt_header_display', true ); 
		}
		
		// Header Postition Top
		if($header_position == 'Top'){ 		
				//Above Banner Aera 
				if($zt_slider_pos == 'above' ){ 
					echo '<div id="'.$onepage_home.'" class="banner">';
					if( is_search() ) {
						$c_pageID = '';
					}
					if( ! is_search() ) {
						// Slider
						apress_slider( $c_pageID );
					}
					echo '</div>';
				}
				
				// Individual Page Header Show/Hide Condition Start
				if($header_display == 'yes'){
					if($custom_header_dragdrop == 'custom'){
						get_template_part('framework/headers/custom_header');  
					}else{									
						if($header_type == 'v1'){
							get_template_part('framework/headers/preset_header/header1');  
						}elseif($header_type == 'v2') {
							get_template_part('framework/headers/preset_header/header2'); 
						}elseif($header_type == 'v3') {
							get_template_part('framework/headers/preset_header/header3'); 
						}elseif($header_type == 'v4') {
							get_template_part('framework/headers/preset_header/header4');
						}elseif($header_type == 'v5') { 
							get_template_part('framework/headers/preset_header/header5'); 
						}elseif($header_type == 'v6') { 
							get_template_part('framework/headers/preset_header/header6'); 
						}elseif($header_type == 'v7') { 
							get_template_part('framework/headers/preset_header/header7');
						}elseif($header_type == 'v8') {
							get_template_part('framework/headers/preset_header/header8');
						}
					}
				}elseif($header_display == 'no'){
						echo '';	
				}else{
					if($custom_header_dragdrop == 'custom'){
						get_template_part('framework/headers/custom_header');  
					}else{					
						if($header_type == 'v1'){
							get_template_part('framework/headers/preset_header/header1');  
						}elseif($header_type == 'v2') {
							get_template_part('framework/headers/preset_header/header2'); 
						}elseif($header_type == 'v3') {
							get_template_part('framework/headers/preset_header/header3'); 
						}elseif($header_type == 'v4') {
							get_template_part('framework/headers/preset_header/header4');
						}elseif($header_type == 'v5') { 
							get_template_part('framework/headers/preset_header/header5'); 
						}elseif($header_type == 'v6') { 
							get_template_part('framework/headers/preset_header/header6'); 
						}elseif($header_type == 'v7') { 
							get_template_part('framework/headers/preset_header/header7');
						}elseif($header_type == 'v8') {
							get_template_part('framework/headers/preset_header/header8');
						}
					}
				} 
				//Below Banner Aera 
				if($zt_slider_pos == 'below' || $zt_slider_pos == 'from_top' ){ 
					echo '<div id="'.$onepage_home.'" class="banner">';
					apress_slider( $c_pageID );
					echo '</div>';
				}
			}elseif($header_position == 'Left'){			
				 // Individual Page Header Show/Hide Condition Start
				if ( (is_front_page() && is_home()) ||  is_home() ) {
					$header_display = get_post_meta( $c_pageID, 'zt_header_display', true );
				 }elseif(is_page() || is_single('zt_portfolio')|| is_single('post')){
					 $header_display = get_post_meta( $c_pageID, 'zt_header_display', true ); 
					 }
				if($header_display == 'yes'){
					get_template_part('framework/headers/vertical_left_header'); 
				 
				}elseif($header_display == 'no'){
					echo '';
				}else{
					get_template_part('framework/headers/vertical_left_header'); 
					
				 // Individual Page Header Show/Hide Condition End
				}
				//If full_screen_slider
				if($left_right_slider_screen == 'full_screen_slider'){ 
					echo '<div id="'.$onepage_home.'" class="banner">';
						apress_slider( $c_pageID );
					echo '</div>';
				}
			}elseif($header_position == 'Right'){
			
				// Individual Page Header Show/Hide Condition Start
				if ( (is_front_page() && is_home()) ||  is_home() ) {
					$header_display = get_post_meta( $c_pageID, 'zt_header_display', true );
				}elseif(is_page() || is_single('zt_portfolio')|| is_single('post')){
					$header_display = get_post_meta( $c_pageID, 'zt_header_display', true ); 
				}
				if(isset($header_display) == 'yes'){				
					get_template_part('framework/headers/vertical_right_header');				
				}elseif($header_display == 'no'){
					echo '';
				}else{
					get_template_part('framework/headers/vertical_right_header');
					// Individual Page Header Show/Hide Condition End
				}
				 //If full_screen_slider
				if($left_right_slider_screen == 'full_screen_slider'){ 
				echo '<div id="'.$onepage_home.'" class="banner">';
					apress_slider( $c_pageID );
				echo '</div>';
				} 
		}
	}
}
/**
 * Place a cart icon with number of items and total cost in the menu bar.
 *
 * Source: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */
 
if( !function_exists('apress_mobile_woocommerce') ){
	function apress_mobile_woocommerce() {
			global $woocommerce;				
			if ( class_exists( 'WooCommerce' ) ) {	
					
			$viewing_cart = __('View your shopping cart', 'apress');
			$start_shopping = __('Start shopping', 'apress');
			$cart_url = wc_get_cart_url();
			$shop_page_url = esc_url(get_permalink( wc_get_page_id( 'shop' ) ) );
			$cart_contents_count = $woocommerce->cart->cart_contents_count;
			$cart_contents = sprintf(_n('%d', '%d', $cart_contents_count, 'apress'), $cart_contents_count);
			$cart_total = $woocommerce->cart->get_cart_total();
			
			
			if ($cart_contents_count == 0) {
				$mob_menu_item = '<li><a class="wcmenucart-contents" href="'. esc_url($shop_page_url) .'" title="'. esc_html($start_shopping) .'">';
			} else {
				$mob_menu_item = '<li><a class="wcmenucart-contents" href="'. esc_url($cart_url) .'" title="'. esc_html($viewing_cart) .'">';
			}
			$mob_menu_item .= '<i class="fa fa-shopping-cart"></i> ';
			
			$mob_menu_item .= $cart_contents;
			$mob_menu_item .= '</a></li>';
			
			echo $mob_menu_item; 
			}
				
		}
}


/**
 * Get related posts, filtered by same category which are assigned to $post_id
 */
if( ! function_exists( 'apress_get_related_posts' ) ) {
	function apress_get_related_posts( $post_id, $number_posts = 4 ) {
		$query = new WP_Query();
		$args = '';
		if( $number_posts == 0 ) {
			return $query;
		}
		
		$args = wp_parse_args( $args, array(
			'category__in'   => wp_get_post_categories( $post_id ),
			'ignore_sticky_posts' => 0,
			'meta_key'    => '_thumbnail_id',
			'posts_per_page'  => $number_posts,
			'post__not_in'   => array( $post_id ),
		));
		$query = new WP_Query( $args );
		return $query;
	}
}
/**
 * Get related portfolio items, filtered by same taxonomy category which are assigned to $post_id
 */
if( ! function_exists( 'apress_get_related_portfolio' ) ) {
	function apress_get_related_portfolio( $post_id, $number_posts = 4 ) {
		$query = new WP_Query();

		$args = '';

		if( $number_posts == 0 ) {
			return $query;
		}

		$item_cats = get_the_terms( $post_id, 'catportfolio' );
		
		$item_array = array();
		if( $item_cats ) {
			foreach( $item_cats as $item_cat ) {
				$item_array[] = $item_cat->term_id;
			}
		}

		if( ! empty( $item_array ) ) {
			$args = wp_parse_args( $args, array(
				'ignore_sticky_posts' => 0,
				'meta_key' => '_thumbnail_id',
				'posts_per_page' => 4,
				'post__not_in' => array( $post_id ),
				'post_type' => 'zt_portfolio',
				'tax_query' => array(
					array(
						'field' => 'id',
						'taxonomy' => 'catportfolio',
						'terms' => $item_array,
					)
				)
			));

			$query = new WP_Query( $args );
		}

		return $query;
	}
}

/**
 * Get related Team items, filtered by same taxonomy category which are assigned to $post_id
 */
if( ! function_exists( 'apress_get_related_team' ) ) {
	function apress_get_related_team( $post_id, $number_posts = 4 ) {
		$query = new WP_Query();

		$args = '';

		if( $number_posts == 0 ) {
			return $query;
		}

		$item_cats = get_the_terms( $post_id, 'catteam' );
		
		$item_array = array();
		if( $item_cats ) {
			foreach( $item_cats as $item_cat ) {
				$item_array[] = $item_cat->term_id;
			}
		}

		if( ! empty( $item_array ) ) {
			$args = wp_parse_args( $args, array(
				'ignore_sticky_posts' => 0,
				'meta_key' => '_thumbnail_id',
				'posts_per_page' => 4,
				'post__not_in' => array( $post_id ),
				'post_type' => 'zt_team',
				'tax_query' => array(
					array(
						'field' => 'id',
						'taxonomy' => 'catteam',
						'terms' => $item_array,
					)
				)
			));

			$query = new WP_Query( $args );
		}

		return $query;
	}
}



function apress_slider_name( $name ) {
	$type = '';
	
	switch( $name ) {
		case 'rev':
			$type = 'revslider';
			break;
	}

	return $type;
}

function apress_get_slider_type( $post_id ) {
	$get_slider_type = get_post_meta($post_id, 'zt_page_slider_type', true);
	return $get_slider_type;
}

function apress_get_slider( $post_id, $type ) {
	$type = apress_slider_name( $type );
	if( $type ) {
		$get_slider = get_post_meta( $post_id, 'zt_' . $type, true );

		return $get_slider;
	} else {
		return false;
	}
}

function apress_slider( $post_id ) {
	$slider_type = apress_get_slider_type( $post_id );
	$slider = apress_get_slider( $post_id, $slider_type );

	if( $slider ) {
		$slider_name = apress_slider_name( $slider_type );
		
		$function = 'apress_' . $slider_name;

		$function( $slider );
	}
}

function apress_revslider( $name ) {
	if( function_exists('putRevSlider') ) {
	   putRevSlider( $name );
	}
}

/**
 * Title Bar
 */
if( ! function_exists( 'apress_current_page_title_bar' ) ) {
	function apress_current_page_title_bar( $post_id ) {
	global $apress_data;
	
	$primary_color = isset($apress_data['primary_color']) ? $apress_data['primary_color'] : '#549ffc';
	
	// Parallax Title Area Start
	
	if ( is_front_page() && is_home() ) {
		// Default homepage
		$cur_id = get_option( 'page_for_posts' );
	} elseif ( is_front_page() ) {
		// static homepage
		$cur_id = get_the_ID();
	} elseif ( is_home() ) {
		// blog page
		$cur_id = get_option( 'page_for_posts' );
	} else {
		//everything else
		$cur_id = get_the_ID();
	}
	
	$titlebar_parallax_bg = get_post_meta( $cur_id, 'zt_titlebar_parallax_bg', true ); 
	
	$page_titlebar_bg_img = get_post_meta( $cur_id, 'zt_titlebar_bg_img', true );
	$page_titlebar_bg_color = get_post_meta( $cur_id, 'zt_titlebar_bg_color', true );
	
	if(isset($apress_data['page_title_bg']['background-image']) && !empty($apress_data['page_title_bg']['background-image'])) {
		$admin_titlebar_bg_img = $apress_data['page_title_bg']["background-image"];
	}else{
		$admin_titlebar_bg_img = '';
		}
	
	if(isset($apress_data['page_title_bg']['background-color']) && !empty($apress_data['page_title_bg']['background-color'])) {
		$admin_titlebar_bg_color = $apress_data['page_title_bg']["background-color"];
	}else{
		$admin_titlebar_bg_color = $primary_color;
		}
	
	$image_url = $bg_color = '';
	
	if($page_titlebar_bg_img || $page_titlebar_bg_color){
			if($page_titlebar_bg_img){
				$image_url = $page_titlebar_bg_img;
			}
			if($page_titlebar_bg_color){
				$bg_color = $page_titlebar_bg_color;
			}
			
	}else{		
			if($admin_titlebar_bg_img){
				$image_url = $admin_titlebar_bg_img;
			}
			if($admin_titlebar_bg_color){
				$bg_color = $admin_titlebar_bg_color;
			}
	}
				
	$page_title_bar = isset($apress_data["page_title_bar"]) ? $apress_data["page_title_bar"] : 'on';
	$blog_show_page_title_bar = isset($apress_data["blog_show_page_title_bar"]) ? $apress_data["blog_show_page_title_bar"] : 'on';
	$blog_post_title = isset($apress_data["blog_post_title"]) ? $apress_data["blog_post_title"] : 'on';
	$page_titlebar_show_hide = get_post_meta( $cur_id, 'zt_titlebar_show_hide', true ); 		
	$breadcrumb_show = isset($apress_data["breadcrumb_show"]) ? $apress_data["breadcrumb_show"] : 'on';
	$single_post_title_bar = isset($apress_data["single_post_title_bar"]) ? $apress_data["single_post_title_bar"] : 'off';	 
	$page_title_bg_parallax = isset($apress_data["page_title_bg_parallax"]) ? $apress_data["page_title_bg_parallax"] : 'off';	
  
	//TitleBar Show/hide
		$title = '';
		if( ! $title ) {
			if ( is_front_page() && is_home() ) {
				//echo 'Default homepage';
				if($blog_show_page_title_bar == 'on'){
						$title = isset($apress_data['blog_title']) ? $apress_data['blog_title'] : 'Blog';
				}				
			} elseif ( is_front_page() ) {
			//echo 'static homepage';
				if($page_titlebar_show_hide == 'default' || $page_titlebar_show_hide == ''){
					if($page_title_bar == 'on'){
						$title =  get_the_title( $cur_id );
					} 
				}elseif($page_titlebar_show_hide=='show'){
						$title =  get_the_title( $cur_id );
					}
				
			} elseif ( is_home() ) {  	
				//echo 'blog page';
					if($page_titlebar_show_hide=='default' || $page_titlebar_show_hide==''){
							if($blog_show_page_title_bar == 'on'){
								if(isset($apress_data['blog_title'])){
									$title = $apress_data['blog_title'];
								}else{
									$title = get_the_title( $cur_id );
									}
							} 
						}elseif($page_titlebar_show_hide=='show'){
							$title =  get_the_title( $cur_id );
						}
			
			} elseif ( is_singular( 'post' ) ) {
				
				if($page_titlebar_show_hide == 'default' || $page_titlebar_show_hide == ''){					
					if($single_post_title_bar == 'on'){					
						$title = get_the_title( $cur_id );
					} 
				}elseif($page_titlebar_show_hide=='show'){
					$title =  get_the_title( $cur_id );
				}else{
					$title =  get_the_title( $cur_id );
				}
					
			} else {							
				if($page_titlebar_show_hide == 'default' || $page_titlebar_show_hide == ''){
					if($page_title_bar == 'on'){					
						$title = get_the_title( $cur_id );
					} 
				}elseif($page_titlebar_show_hide == 'show'){
					$title =  get_the_title( $cur_id );
				}
			}
		
		if( is_search() ) {
			if($page_title_bar == 'on'){					
					$title = __('Search results for:', 'apress') . get_search_query();
			}
			
		}
		
		if( is_404() ) {
			if($page_title_bar == 'on'){					
					$title = __('Error 404 Page', 'apress');
			}
			
		}
		if( is_archive() ) {
			if($page_title_bar == 'on'){
				if ( is_day() ) {
					$title = __( 'Daily Archives:', 'apress' ) . get_the_date();
				} else if ( is_month() ) {
					$title = __( 'Monthly Archives:', 'apress' ) . get_the_date( _x( 'F Y', 'monthly archives date format', 'apress' ) ) ;
				} elseif ( is_year() ) {
					$title = __( 'Yearly Archives:', 'apress' ) . get_the_date( _x( 'Y', 'yearly archives date format', 'apress' ) ) ;
				} elseif ( is_author() ) {
					$curauth = get_user_by( 'id', get_query_var( 'author' ) );
					$title = $curauth->nickname;
				} elseif( is_post_type_archive() ) {				
					$title = post_type_archive_title( '', false );
			
				} else {
					$title = single_cat_title( '', false );
				}
			}
		}
		
			if( class_exists( 'Woocommerce' ) && is_woocommerce() && ( is_product() || is_shop() ) && ! is_search() ) {
				if( ! is_product() ) {
					if($page_title_bar == 'on'){
					$title = woocommerce_page_title( false );
					}
				}
			}
		}
	
		if($title){ 
		?>
		<div class="pagetitle_parallax_section <?php echo $apress_data["page_titlebar_style"];?>">
		  <div class="pagetitle_parallax" data-parallax="<?php if($titlebar_parallax_bg == 'No'){echo '';}else if($titlebar_parallax_bg == 'Yes'){echo esc_url($image_url);}else{ if($page_title_bg_parallax == 'on'){echo esc_url($image_url); } } ?>" style="background:<?php echo esc_attr($bg_color);?> url(<?php echo esc_url($image_url);?>);">
			  <div class="zolo-container">
              <div class="pagetitle_parallax_content_box">
              <div class="pagetitle_parallax_content">
				<h1 class="entry-title"><?php echo esc_html($title);?></h1>
				<?php if($breadcrumb_show == 'on'):?>
				<?php if (function_exists('apress_breadcrumbs')) apress_breadcrumbs(); ?>
				<?php endif; ?>
			  </div>
              </div>
			</div>
			<div class="overlay-dot"></div>
		  </div>
		</div>
		<!--Parallax Title Area End--> 
		<?php
		}	
		ob_start();
		$secondary_content = ob_get_contents();
		ob_get_clean();
	}
}
// Show Number of featured images
if( ! function_exists( 'apress_archive_thumbnail_video' ) ) {
	function apress_archive_thumbnail_video() {
		global $apress_data, $post;
		$admin_lightbox_style = isset($apress_data["lightbox_style"]) ? $apress_data["lightbox_style"] : 'lightbox-none';
		include get_template_directory().'/framework/variables/variables-archive.php';
		include get_template_directory().'/framework/variables/variables-post-loop.php';
		if( has_post_thumbnail() || $post_video ){
			if (!$format_quote && !$format_audio){
				echo '<div class="posttype_gallery_slider">';				  
				//zolo_zilla_likes
				if( function_exists('zolo_zilla_likes') ){ 
					echo '<span class="zolo_zilla_likes_box"> ';
					zolo_zilla_likes();
					echo '</span>';
				}
				
				echo '<ul class="post_slickslider posttype_gallery">';
					if($post_video){
					echo '<li class="posttype_slide">';
					echo '<div class="zolo_fluid_video_wrapper"> ';
					echo wp_kses($post_video,array('iframe'=>array(
											'src'             => array(),
											'height'          => array(),
											'width'           => array(),
											'frameborder'     => array(),
											'allowfullscreen' => array(),
								)
						));
					echo '</div>';
					echo '</li>';
					}   
					if ( has_post_thumbnail() ) {
						$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $blog_archive_layout_thumb); 					
						echo '<li class="posttype_slide"><img src="'.esc_url($attachment_image[0]).'"  alt="'.esc_attr( get_bloginfo( 'name' ) ).'"/>';
						if($image_rollover_icons_show_hide == 'show' || $image_rollover_icons_show_hide == ''){							
							echo'<span class="overlay"></span> <span class="zolo_blog_icons"> <span class="icons_center">';							
							echo sprintf( '<a class="zolo_blog_icon blog_zoom_icon" href="%s" rel="prettyPhoto[gallery%s]"><i class="fa fa-search-plus"></i></a>', esc_url($attachment_image[0]), get_the_ID());
							echo '<a class="zolo_blog_icon blog_link_icon" href="'.esc_url(get_permalink( $post->ID)).'"> <i class="fa fa-link"></i> </a> </span>';
							echo '</span>';	
						}
						echo '</li>';
					}
				if( apress_number_of_featured_images() > 0 && class_exists( 'kdMultipleFeaturedImages' )){
					
					$i = 2;
					while($i <= 5): 
					$attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
					if($attachment_new_id){
					$attachment_image = wp_get_attachment_image_src($attachment_new_id, $blog_archive_layout_thumb);
					echo '<li class="posttype_slide"><img src="'.esc_url($attachment_image[0]).'" alt="'.get_post_meta($attachment_new_id, '_wp_attachment_image_alt', true).'"/>';
					if($image_rollover_icons_show_hide == 'show'  || $image_rollover_icons_show_hide == ''){
						echo '<span class="overlay"></span> <span class="zolo_blog_icons"> <span class="icons_center">';						
						echo sprintf( '<a class="zolo_blog_icon blog_zoom_icon" href="%s" rel="prettyPhoto[gallery%s]"><i class="fa fa-search-plus"></i></a>', esc_url($attachment_image[0]), get_the_ID());
						echo '<a class="zolo_blog_icon blog_link_icon" href="'.esc_url(get_permalink( $post->ID)).'"><i class="fa fa-link"></i></a>';
						echo '</span> </span>';
					}
					echo '</li>';
					} $i++; endwhile; 
				}
				echo '</ul>';
				echo '</div>';				 
				//Post Thumbnail End 
				}			
			}
		}
}
// Show Number of featured images
if( ! function_exists( 'apress_catportfolio_thumbnail_video' ) ) {
	function apress_catportfolio_thumbnail_video() {
		global $apress_data, $post;
		if(!is_object($post)) return;
		include get_template_directory().'/framework/variables/variables-portfolio-archive.php';
		include get_template_directory().'/framework/variables/variables-post-loop.php';
		if( has_post_thumbnail() || $post_video ){				
			  echo '<div class="posttype_gallery_slider">';				  
					//zolo_zilla_likes
					if( function_exists('zolo_zilla_likes') ){ 
						echo '<span class="zolo_zilla_likes_box"> ';
							zolo_zilla_likes();
						echo '</span>';
					}
										
				echo '<ul class="post_slickslider posttype_gallery '.esc_attr($portfolio_hover_effects).'">';
				  if($post_video){
				  echo '<li class="posttype_slide">';
					echo '<div class="zolo_fluid_video_wrapper"> ';
					echo wp_kses($post_video,array('iframe'=>array(
																	'src'             => array(),
																	'height'          => array(),
																	'width'           => array(),
																	'frameborder'     => array(),
																	'allowfullscreen' => array(),
																)
															));
					echo '</div>';
				  echo '</li>';
				 }   
					if ( has_post_thumbnail() ) {
					$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $blog_layout_thumb); 						
				  echo '<li class="posttype_slide"><img src="'.esc_url($attachment_image[0]).'"  alt="'.esc_attr( get_bloginfo( 'name' ) ).'"/>';
					if($image_rollover_icons_show_hide == 'show' || $image_rollover_icons_show_hide == ''){
					echo'<span class="overlay"></span> <span class="zolo_blog_icons"> <span class="icons_center">';					
					echo sprintf( '<a class="zolo_blog_icon blog_zoom_icon" href="%s" rel="prettyPhoto[gallery%s]"><i class="fa fa-search-plus"></i></a>', esc_url($attachment_image[0]), get_the_ID());
					echo '<a class="zolo_blog_icon blog_link_icon" href="'.esc_url(get_permalink( $post->ID)).'"> <i class="fa fa-link"></i> </a> </span>';
					echo '</span>';
					}
				  echo '</li>';
				  }
				 if( apress_number_of_featured_images() > 0 && class_exists( 'kdMultipleFeaturedImages' )){
				  
					$i = 2;
					while($i <= 5): 
					$attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'zt_portfolio');
					if($attachment_new_id){
				  $attachment_image = wp_get_attachment_image_src($attachment_new_id, $blog_archive_layout_thumb);
				  echo '<li class="posttype_slide"><img src="'.esc_url($attachment_image[0]).'" alt="'.get_post_meta($attachment_new_id, '_wp_attachment_image_alt', true).'"/>';
					if($image_rollover_icons_show_hide == 'show'  || $image_rollover_icons_show_hide == ''){
					echo '<span class="overlay"></span> <span class="zolo_blog_icons"> <span class="icons_center">';
					echo sprintf( '<a class="zolo_blog_icon blog_zoom_icon" href="%s" rel="prettyPhoto[gallery%s]"><i class="fa fa-search-plus"></i></a>', esc_url($attachment_image[0]), get_the_ID());
					echo '<a class="zolo_blog_icon blog_link_icon" href="'.esc_url(get_permalink( $post->ID)).'"><i class="fa fa-link"></i></a>';
					echo '</span> </span>';
					}
				  echo '</li>';
				  } $i++; endwhile; 
				  }
				echo '</ul>';
			  echo '</div>';				 
			  //Post Thumbnail End 	
			}
		}
}

// Show Number of featured images
if( ! function_exists( 'apress_single_layout_thumbnail_video' ) ) {
	function apress_single_layout_thumbnail_video() {
		global $apress_data, $post;
		if(!is_object($post)) return;
		include get_template_directory().'/framework/variables/variables-blog.php';
		include get_template_directory().'/framework/variables/variables-post-loop.php';		
		$page_single_post_layout = get_post_meta( $post->ID , 'zt_single_post_layout_style', true );
		$admin_single_post_layout_style = isset($apress_data['single_post_layout_style']) ? $apress_data['single_post_layout_style'] : 'layout_style1';
		
		if($page_single_post_layout == 'default' || $page_single_post_layout == ''){
			$single_post_layout_value = $admin_single_post_layout_style;
		}else{
			$single_post_layout_value = $page_single_post_layout;
		}
		if(is_single()){
			if($single_post_layout_value == 'layout_style1' || $single_post_layout_value == 'layout_style3'){
				$layout_classes = '';
			}else{
				$layout_classes = 'margin0';
				}
		}else{
			$layout_classes = '';
		}
		if(is_page()){
			$flex_slider_classes = 'page_slickslider';
			}else{
				$flex_slider_classes = '';
				}	
		if( has_post_thumbnail() || $post_video ){
				  echo '<div class="posttype_gallery_slider '.esc_attr($layout_classes.''.$flex_slider_classes).'">';				  
						if((is_single() && $single_post_layout_value == 'layout_style1') || (is_front_page() || is_home())){
							//zolo_zilla_likes
							if( function_exists('zolo_zilla_likes') ){ 
								echo '<span class="zolo_zilla_likes_box"> ';
									zolo_zilla_likes();
								echo '</span>';
							}
						}
					echo '<ul class="post_slickslider posttype_gallery">';
					  if($post_video){
					  echo '<li class="posttype_slide">';
						echo '<div class="zolo_fluid_video_wrapper"> ';
							echo wp_kses($post_video,array('iframe'=>array(
																		'src'             => array(),
																		'height'          => array(),
																		'width'           => array(),
																		'frameborder'     => array(),
																		'allowfullscreen' => array(),
																	)
																));
                        echo '</div>';
					  echo '</li>';
					 }   
						if ( has_post_thumbnail() ) {
							if (is_singular('post') || is_page()) {
								$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'apress_thumb_blog_large'); 
								echo '<li class="posttype_slide"><img src="'.esc_url($attachment_image[0]).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" /> </li>';	
							}else{
								$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $blog_layout_thumb); 						
								echo '<li class="posttype_slide"><img src="'.esc_url($attachment_image[0]).'"  alt="'.esc_attr( get_bloginfo( 'name' ) ).'" />';
								if($image_rollover_icons_show_hide == 'show' || $image_rollover_icons_show_hide == ''){
								echo'<span class="overlay"></span> <span class="zolo_blog_icons"> <span class="icons_center">';
																
								echo sprintf( '<a class="zolo_blog_icon blog_zoom_icon" href="%s" rel="prettyPhoto[gallery%s]"><i class="fa fa-search-plus"></i></a>', esc_url($attachment_image[0]), get_the_ID());
								echo '<a class="zolo_blog_icon blog_link_icon" href="'.esc_url(get_permalink( $post->ID)).'"> <i class="fa fa-link"></i> </a> </span>';
								echo '</span>';
								
								
						
						 	}
						}
					  echo '</li>';
					  }
                     if( apress_number_of_featured_images() > 0 && class_exists( 'kdMultipleFeaturedImages' ) ){
					  	$post_type = get_post_type( get_the_ID() );
						$i = 2;
						while($i <= 5): 
						$attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, $post_type);						
						if($attachment_new_id){
							if (is_singular('post') || is_page()) {
								$attachment_image = wp_get_attachment_image_src($attachment_new_id, 'apress_thumb_blog_large');
								echo '<li class="posttype_slide">';
								echo '<img src="'.esc_url($attachment_image[0]).'" alt="'.get_post_meta($attachment_new_id, '_wp_attachment_image_alt', true).'" />';
								echo '</li>';
							}else{
								$attachment_image = wp_get_attachment_image_src($attachment_new_id, $blog_layout_thumb);
								echo '<li class="posttype_slide"><img src="'.esc_url($attachment_image[0]).'" alt="'.get_post_meta($attachment_new_id, '_wp_attachment_image_alt', true).'"/>';
								if($image_rollover_icons_show_hide == 'show'  || $image_rollover_icons_show_hide == ''){
									echo '<span class="overlay"></span> <span class="zolo_blog_icons"> <span class="icons_center">';																	
									echo sprintf( '<a class="zolo_blog_icon blog_zoom_icon" href="%s" rel="prettyPhoto[gallery%s]"><i class="fa fa-search-plus"></i></a>', esc_url($attachment_image[0]), get_the_ID());
									echo '<a class="zolo_blog_icon blog_link_icon" href="'.esc_url(get_permalink( $post->ID)).'"><i class="fa fa-link"></i></a>';
									echo '</span> </span>';
									}
								echo '</li>';
							}
					  	} 
					  $i++; endwhile; 
					  }
					echo '</ul>';
					if(is_single()){
					if($single_post_layout_value == 'layout_style4'){
						echo '<div class="post_title_caption">';
						echo '<div class="zolo-container">';
						$post_title_position = 'below';
						if($post_title_position == 'below'){
							apress_entry_meta($post_meta,$format_quote, $post_title_alignment,$post_title_position);
						}
						echo '</div>';
						echo '</div>';
					}
					}
				  echo '</div>';				 
				  //Post Thumbnail End 
			}
		}
}

// Show Number of featured images
if( ! function_exists( 'apress_number_of_featured_images' ) ) {
	function apress_number_of_featured_images() {
		global $apress_data, $post;
		if(!is_object($post)) return;
		$number_of_images = 0;
		if(class_exists( 'kdMultipleFeaturedImages' )){
		
			if( has_post_thumbnail() && get_post_meta( $post->ID, 'zt_show_first_featured_image', true ) != 'yes' ) {
				$number_of_images++;
			}
		
			for( $i = 2; $i <= 5; $i++ ) {
				$attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, $post->post_type );
		
				if( $attachment_new_id ) {
					$number_of_images++;
				}
			}
		}
		return $number_of_images;
	}
}

// Display navigation to next/previous set of posts when applicable.
if ( ! function_exists( 'apress_paging_nav' ) ) {
	function apress_paging_nav() {
		global $wp_query;
	
		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 )
			return;
		?>
	
	<nav class="navigation paging-navigation">
	  <h1 class="screen-reader-text">
		<?php _e( 'Posts navigation', 'apress' ); ?>
	  </h1>
	  <div class="nav-links">
		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous">
		  <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'apress' ) ); ?>
		</div>
		<?php endif; ?>
		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next">
		  <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'apress' ) ); ?>
		</div>
		<?php endif; ?>
	  </div>
	  <!-- .nav-links --> 
	</nav>
	<!-- .navigation -->
	<?php
	}
}

if ( ! function_exists( 'apress_single_page_nav' ) ) {
	//Display navigation to next/previous post when applicable.
	function apress_single_page_nav() {
		
		global $post, $apress_data;
		if(!is_object($post)) return;
		
		if(is_singular( 'zt_portfolio' )){
			$posttype = 'portfolio';
		}else{
			$posttype = 'post';
		}
		
		$posttype_pagination_show_hide = get_post_meta( $post->ID , 'zt_post_pagination', true );
		if($posttype_pagination_show_hide == 'yes'){
				$single_posttype_navigation_style = get_post_meta( $post->ID , 'zt_navigation_style', true );
			}else{
				$single_posttype_navigation_style = isset($apress_data[$posttype.'_navigation_style']) ? $apress_data[$posttype.'_navigation_style'] : 'style1';
				}
		
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );
		
		if ( ! $next && ! $previous )
		return;	
			
		$pagination = 'navigation_'.$single_posttype_navigation_style;
		
		echo '<nav class="navigation post-navigation '.$pagination.'" role="navigation">';
		
		if($single_posttype_navigation_style == 'style1'){
			
			echo '<div class="nav-links">';			
			previous_post_link( '%link', __( '<span class=\'meta-nav post-meta-nav\'><i class=\'fa fa-long-arrow-left\'></i> Previous</span><span class=\'post-meta-nav-title\'>%title</span>', 'apress' ) );
			next_post_link( '%link', __('<span class=\'meta-nav post-meta-nav\'>Next <i class=\'fa fa-long-arrow-right\'></i></span><span class=\'post-meta-nav-title\'>%title</span>','apress' ) );
			
			echo '</div>';
			
		}elseif($single_posttype_navigation_style == 'style2'){
			$previous_post = get_previous_post();
			$next_post = get_next_post();
			
			if(empty($next_post) && $previous_post){
				$only_class = 'previous_only';
			}else if($next_post && empty($previous_post)){
				$only_class = 'next_only';
			}else{
				$only_class = '';
			}
			
			if($apress_data[$posttype.'_navigation_button_link_source'] == 'page'){
				$posttype__navigation_button_link = get_page_link($apress_data[$posttype.'_navigation_page_select']);
			}else if($apress_data[$posttype.'_navigation_button_link_source'] == 'url'){
				$posttype__navigation_button_link = $apress_data[$posttype.'_navigation_page_url'];
			}else{
				$posttype__navigation_button_link = '';
			}
			
			echo '<div class="nav-links '.$only_class.'">';
			previous_post_link( '%link', _x('<i class="fa fa-angle-left" aria-hidden="true"></i>', 'Previous post link', 'apress' ) );
			
			echo $portfolio_parent_link = ($single_posttype_navigation_style == 'style2') ? '<a href="'.esc_url($posttype__navigation_button_link).'"><i class="fa fa-th"></i></a>' : '';
			
			next_post_link( '%link', _x('<i class="fa fa-angle-right" aria-hidden="true"></i>', 'Next post link', 'apress' ) );
			echo '</div>';
			
		}elseif($single_posttype_navigation_style == 'style3'){
			
			echo '<div class="nav-links">';
			$previous_post = get_previous_post();
			$next_post = get_next_post();
			
			if(!empty($previous_post)) {
				$previous_post_id = $previous_post->ID;
				$post_thumbnail_id = get_post_thumbnail_id($previous_post_id);
				
				if ( has_post_thumbnail() ) {
					$attachment_image_src = wp_get_attachment_image_src($post_thumbnail_id,'thumbnail');
					$attachment_image = $attachment_image_src[0];
				}else{
					$attachment_image = '';
				}
				
				$prev_attachment_image = $attachment_image ? '<img src='.esc_url($attachment_image).' alt="'.esc_attr( get_bloginfo( 'name' ) ).'">': '';
				
				echo '<a href="'.esc_url(get_permalink($previous_post_id)).'" class="pagination_button previous_button">
				<div class="pagination_icon"><i class="fa fa-angle-left"></i></div>
				<div class="pagination_thumb_area">
				<div class="pagination_thumb">'.$prev_attachment_image.'</div>
				<div class="pagination_caption"><span class="title">'.esc_attr($previous_post->post_title).'</span></div></div></a>';
			}
			
			
			if(!empty($next_post)) {
				$next_post_id = $next_post->ID;   
				$post_thumbnail_id = get_post_thumbnail_id($next_post_id);
				
				if ( has_post_thumbnail() ) {
					$attachment_image_src = wp_get_attachment_image_src($post_thumbnail_id,'thumbnail');
					$attachment_image = $attachment_image_src[0];
				}else{
					$attachment_image = '';
				}
				
				$next_attachment_image = $attachment_image ? '<img src='.esc_url($attachment_image).' alt="'.esc_attr( get_bloginfo( 'name' ) ).'">': '';
				
				echo '<a href="'.esc_url(get_permalink($next_post_id)).'" class="pagination_button next_button">
				<div class="pagination_icon"><i class="fa fa-angle-right"></i></div>
				<div class="pagination_thumb_area">
				<div class="pagination_thumb">'.$next_attachment_image.'</div>
				<div class="pagination_caption"><span class="title">'.esc_attr($next_post->post_title).'</span></div></div></a>'; 
			}
			echo '</div>';
			
		}else{
			
			$next_post = get_next_post();
			$previous_post = get_previous_post();
			if(empty($next_post) && $previous_post){
				$only_class = 'previous_only';
			}else if($next_post && empty($previous_post)){
				$only_class = 'next_only';
			}else{
				$only_class = '';
			}
			echo '<div class="nav-links '.$only_class.'">';
			if(!empty($previous_post)) {
				$previous_post_id = $previous_post->ID;
				$post_thumbnail_id = get_post_thumbnail_id($previous_post_id);
				
				if ( has_post_thumbnail() ) {
					$attachment_image_src = wp_get_attachment_image_src($post_thumbnail_id,'full');
					$attachment_image = $attachment_image_src[0];
				}else{
					$attachment_image = '';
				}
				echo '<a href="'.esc_url(get_permalink($previous_post_id)).'" class="pagination_button previous_button">
				<div class="pagination_bg" style="background-image: url('.$attachment_image.');"></div>
				<div class="pagination_caption"><span class="pagination_caption_box"><span class="pagination_icon"><i class="fa fa-angle-left"></i></span><span class="title">'.esc_attr($previous_post->post_title).'</span></span></div></a>';
			}
			
			if(!empty($next_post)) {
				$next_post_id = $next_post->ID;			
				$post_thumbnail_id = get_post_thumbnail_id($next_post_id);
				
				if ( has_post_thumbnail() ) {
					$attachment_image_src = wp_get_attachment_image_src($post_thumbnail_id,'full');
					$attachment_image = $attachment_image_src[0];
				}else{
					$attachment_image = '';
				}
				echo '<a href="'.esc_url(get_permalink($next_post_id)).'" class="pagination_button next_button">
				<div class="pagination_bg" style="background-image: url('.$attachment_image.');"></div>
				<div class="pagination_caption"><span class="pagination_caption_box"><span class="title">'.esc_attr($next_post->post_title).'</span><span class="pagination_icon"><i class="fa fa-angle-right"></i></span></span></div></a>';	
			}
			
		}
		echo '</div>';				
		echo '</nav>';
		
	}
}

if ( ! function_exists( 'apress_entry_date' ) ) {
//Print HTML with date information for current post.
	function apress_entry_date( $echo = true ) {
	
		global $apress_data;        
		
		if($apress_data["blog_layout"] == 'small' || $apress_data["blog_layout"] == 'medium' || $apress_data["blog_layout"] == 'large'){
				$icon = 'show';
			}else{
				$icon = 'hide';
				}
				
		if ( has_post_format( array( 'chat', 'status' ) ) )
			$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'apress' );
		else
			$format_prefix = '%2$s';
	
		if($icon == 'show'){ 
		
		$date = sprintf( '<li><span class="date updated"><span class="meta_label"><i class="fa fa-clock-o"></i></span><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span></li>',
			esc_url( get_permalink() ),
			esc_attr( sprintf( __( 'Permalink to %s', 'apress' ), the_title_attribute( 'echo=0' ) ) ),
			esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
		);
		}else{
			
			$date = sprintf( '<li><span class="date updated"><span class="meta_label">Published:</span><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span></li>',
			esc_url( get_permalink() ),
			esc_attr( sprintf( __( 'Permalink to %s', 'apress' ), the_title_attribute( 'echo=0' ) ) ),
			esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
		);
			}
			
		if ( $echo ){echo $date;}
		
		return $date;
	
	}
}

if ( ! function_exists( 'apress_entry_meta' ) ) {
	//Print HTML with date information for current post.
	function apress_entry_meta( $post_meta,$format_quote, $post_title_alignment,$post_title_position) {
		global $apress_data; 
		
		$post_category_position = isset($apress_data['post_category_position']) ? $apress_data['post_category_position'] : 'above';
		$post_category_design = isset($apress_data['post_category_design']) ? $apress_data['post_category_design'] : 'box';
		
		
		//if not quote Start
		if (!$format_quote){
			echo '<div class="post_title_area '.$post_title_alignment.' title_position_'.$post_title_position.'">';
			
			// categories list
			if($post_category_position == 'above'){
				if($post_category_design == 'rounded' || $post_category_design == 'box'){
					$categories_list = get_the_category_list( __( '&nbsp;', 'apress' ) );
				}else{
					$categories_list = get_the_category_list( __( ' / ', 'apress' ) );
				}
				if ( $categories_list ) {
					echo '<div class="postcategory_area postcategory_above">';
					if($post_title_alignment == 'right' || $post_title_alignment == 'center'){
							if($post_category_design == 'image'){echo '<img class="category_design_img category_left" src="'.esc_url($apress_data['blog_category_design_img']['url']).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'"/>';}
						}
					echo '<span class="categories-links above '.esc_attr($post_category_design).'">';
					echo $categories_list;
					echo '</span>';
					if($post_title_alignment == 'left' || $post_title_alignment == 'center'){
							if($post_category_design == 'image'){echo '<img class="category_design_img category_right" src="'.esc_url($apress_data['blog_category_design_img']['url']).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'"/>';}
						}
					echo '</div>';
				}
			}
			
			// Post title
			$post_title_separator_show = isset($apress_data['post_title_separator_show_hide']) ? $apress_data['post_title_separator_show_hide'] : 'hide';
			$blog_post_title = isset($apress_data["blog_post_title"]) ? $apress_data["blog_post_title"] : 'on';
			
			if ( is_single() ) {
			if($blog_post_title == 'on'){
				printf(	'<h1 class="entry-title">%s</h1>', get_the_title() );
				if($post_title_separator_show == 'show'){echo '<div class="post_title_separator"><img src="'.esc_url($apress_data['post_title_separator_img']['url']).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'"/></div>';}
			}
			}else{
			printf(	'<h2 class="entry-title"><a href="%s" title="%s">%s</a></h2>', esc_url(get_permalink()), the_title_attribute( 'echo=0' ), get_the_title() );
			if($post_title_separator_show == 'show'){echo '<div class="post_title_separator"><img src="'.esc_url($apress_data['post_title_separator_img']['url']).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'"/></div>';}
			}
			
			// Post Meta
			if($post_meta == true){
				echo '<ul class="entry_meta_list">';	
				$format_prefix = '%2$s';
				$date = sprintf( '<li><span class="date updated"><span class="meta_label"></span><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span></li>',
				esc_url( get_permalink() ),
				esc_attr( sprintf( __( 'Permalink to %s', 'apress' ), the_title_attribute( 'echo=0' ) ) ),
				esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
				);
				echo $date;	
				
				if($post_category_position == 'below'){
						$categories_list = get_the_category_list( __( ' / ', 'apress' ) );
					if ( $categories_list ) {
						echo '<li class="categories-links">';
						echo $categories_list;
						echo '</li>';
					}
				}
				
				printf( '<li><span class="author-list author vcard"><span class="meta_label">'.__('By','apress').' </span><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></li>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'apress' ), get_the_author() ) ),
				get_the_author()
				); 
				
				if ( comments_open() && ! is_single() ) : 
					echo '<li><span class="comments-link">';					
					comments_popup_link( __( '0 Comments', 'apress' ), __( '1 Comment', 'apress' ), __( '% Comments', 'apress' ),__( 'comments-link', 'apress' ), __( 'Comments are off for this post', 'apress' ) );
					echo '</span></li>';
				endif; 
				echo '</ul>';
			}
			echo '</div>';
		}
		
	}
}


if ( ! function_exists( 'apress_tags' ) ) {
	function apress_tags() {

	// Get Tags for posts.
	$tags_list = get_the_tag_list( '');
	
		if ( $tags_list ) {
		$html = '<div class="zolo_post_tags"><h5 class="tag_title">'.__("Tags:", "apress").'</h5><ul class="single_tag_list">';
		$html .= "<li>".$tags_list."</li>";
		$html .= '</ul></div>';
		echo $html;
		}
	}
}

//Shortcode functions
if ( ! function_exists( 'apcore_shortcodes_entry_meta' ) ) {
	function apcore_shortcodes_entry_meta($posttitlealignment,$posttitleposition, $titleseparatorimg1, $posttitleseparatorshowhide, $categoryposition, $categorydesign, $categorydesignimg1, $postmetashowhide ) {
	echo '<div class="post_title_area '.$posttitlealignment.' title_position_'.$posttitleposition.'">';
	//Categories Name
	if($categoryposition == 'above'){

	if($categorydesign == 'rounded' || $categorydesign == 'box'){
		$categories_list = get_the_category_list(' ');
	}else{
		$categories_list = get_the_category_list( __( ' / ', 'apress' ) );
		}
		
	if ( $categories_list ) {
		echo '<div class="postcategory_area postcategory_above">';
		if($posttitlealignment == 'right' || $posttitlealignment == 'center'){
			if($categorydesign == 'image'){echo '<img class="category_design_img category_left" src="'.esc_url($categorydesignimg1).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'"/>';}}
			
		echo '<span class="categories-links  '.esc_attr($categorydesign).'">';
		echo $categories_list;
		echo '</span>';
		
		if($posttitlealignment == 'left' || $posttitlealignment == 'center'){
			if($categorydesign == 'image'){echo '<img class="category_design_img category_right" src="'.esc_url($categorydesignimg1).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'"/>';}}
			
		echo '</div>';
		} 
	}
	
	//Title
	printf(	'<h2 class="entry-title"><a href="%s" title="%s">%s</a></h2>', esc_url(get_permalink()), the_title_attribute( 'echo=0' ), get_the_title() );
	if($posttitleseparatorshowhide == 'show'){echo '<div class="post_title_separator"><img src="'.esc_url($titleseparatorimg1).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'"/></div>';}
		
	
	if($postmetashowhide == 'show'){
	echo '<ul class="entry_meta_list">';	
	//Posted Date
	$format_prefix = '%2$s';
	$date = sprintf( '<li><span class="date updated"><span class="meta_label"></span><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span></li>',
	esc_url( get_permalink() ),
	esc_attr( sprintf( __( 'Permalink to %s', 'apress' ), the_title_attribute( 'echo=0' ) ) ),
	esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);
	echo $date;	
	
	//Categories Name
	if($categoryposition == 'below'){
	$categories_list = get_the_category_list( __( ' / ', 'apress' ) );
	if ( $categories_list ) {
		echo '<li class="categories-links">';
		echo $categories_list;
		echo '</li>';
	}
	}
	
	//Author Name
	printf( '<li><span class="author-list vcard author"><span class="meta_label">'.__('By','apress').' </span><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></li>',
	esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	esc_attr( sprintf( __( 'View all posts by %s', 'apress' ), get_the_author() ) ),
	get_the_author()
	); 
	
	if ( comments_open() && ! is_single() ) : 
	echo '<li><span class="comments-link">';
	comments_popup_link( __( '0 Comments', 'apress' ), __( '1 Comment', 'apress' ), __( '% Comments', 'apress' ),__( 'comments-link', 'apress' ), __( 'Comments are off for this post', 'apress' ) );
	echo '</span></li>';
	endif; 
	echo '</ul>';
	}
		
	echo '</div>';
		

	}
}

if ( ! function_exists( 'apcore_shortcodes_entry_meta_for_shortcode' ) ) {
	function apcore_shortcodes_entry_meta_for_shortcode( $show_date = 1, $show_cat = 1, $show_tag = 1, $show_author = 1, $show_comment = 1, $show_likes = 1 , $show_avatar = 1 ,$categorydesign = '', $posttitlealignment = '', $categorydesignimg1 = '') {
		if(1 == $show_cat){
			if($categorydesign == 'rounded' || $categorydesign == 'box'){
				$categories_list = get_the_category_list( __( '&nbsp;', 'apress' ) );
			}else{
				$categories_list = get_the_category_list( __( ' / ', 'apress' ) );
				}
				
			if ( $categories_list ) {
				echo '<div class="postcategory_area">';
				if($posttitlealignment == 'right' || $posttitlealignment == 'center'){
					if($categorydesign == 'image'){echo '<img class="category_design_img category_left" src="'.esc_url($categorydesignimg1).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'"/>';}}
					
				echo '<span class="categories-links  '.esc_attr($categorydesign).'">';
				echo $categories_list;
				echo '</span>';
				
				if($posttitlealignment == 'left' || $posttitlealignment == 'center'){
					if($categorydesign == 'image'){echo '<img class="category_design_img category_right" src="'.esc_url($categorydesignimg1).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'"/>';}}
				echo '</div>';
			} 
		}
		
		if(1 == $show_author || 1 == $show_comment || 1 == $show_likes || 1 == $show_date || 1 == $show_tag){
			echo '<div class="apress_postmeta_area"><ul class="apress_postmeta">';
		}
		
		if(1 == $show_date){
			//Posted Date
			$format_prefix = '%2$s';
			$date = sprintf( '<li><span class="date updated"><span class="meta_label"></span><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span></li>',
			esc_url( get_permalink() ),
			esc_attr( sprintf( __( 'Permalink to %s', 'apress' ), the_title_attribute( 'echo=0' ) ) ),
			esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
			);
			echo $date;	
		}
		
		if(1 == $show_author){
			//Author Name
			if(1 == $show_avatar){
				printf( '<li class="author-list vcard author"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%4$s %3$s</a></li>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'apress' ), get_the_author() ) ),
				get_the_author(),
				get_avatar(get_the_author_meta( 'ID' ), 20)
				); 
			}else{
				printf( '<li class="author-list vcard author">'.__('By','apress').' <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></li>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'apress' ), get_the_author() ) ),
				get_the_author()
				); 
				}
		}
	
		if( 1 == $show_tag ){
			$tags_list = get_the_tag_list( '', ', ' );
			if ( $tags_list ) {
				printf( '<li class="tags-links"><strong>%1$s </strong>%2$s</li>',
				_x( 'Tagged : ', 'Used before tag names.', 'apress' ),
				$tags_list
			);
			}
		}
	
		if(1 == $show_comment){
			//Comments
			if ( comments_open() && ! is_single() ) { 
			echo '<li class="comments-link">';
			comments_popup_link( '<i class="fa fa-comment-o"></i> 0', '<i class="fa fa-comment-o"></i> 1 ', '<i class="fa fa-comment-o"></i> % ', 'comments-link', __( 'Comments are off for this post', 'apress' )); 
			echo '</li>';
			};
		}
		
		if(1 == $show_likes){
			//Likes
			if( function_exists('zolo_zilla_likes') ){ 
				echo '<li class="zolo_zilla_likes_list"> ';
				zolo_zilla_likes();
				echo '</li>';
			}
		}
		
		if(1 == $show_author || 1 == $show_comment || 1 == $show_likes || 1 == $show_date || 1 == $show_tag){
			echo '</ul></div>';
		}
	}
}

// Blog Pagination
if ( !function_exists( 'apress_pagination' ) ) {
	function apress_pagination() {
		
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
			echo paginate_links(array(
				'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'		=> $format,
				'current'		=> max( 1, get_query_var('paged') ),
				'total' 		=> $total,
				'mid_size'		=> 3,
				'type' 			=> 'list',
				'prev_text'		=> $prev_arrow,
				'next_text'		=> $next_arrow,
			 ) );
		}
	}
}

// Portfolio Pagination
if ( !function_exists( 'apress_portfolio_pagination' ) ) {
	function apress_portfolio_pagination($pages = '', $range = 2){ 
	
		 $showitems = ($range * 2)+1;  
		 global $paged;
		 if(empty($paged)) $paged = 1;
		 if($pages == '')
		 {
			 global $wp_query;
			 $pages = $wp_query->max_num_pages;
			 if(!$pages){
				 $pages = 1;
			 }
		 }  
		 if(1 != $pages){
			 echo "<ul class='page-numbers'>";
			 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."' class='navigation_first'>&laquo;</a></li>";
			 if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."' class='navigation_prev'>&lt;</a></li>";
			 for ($i=1; $i <= $pages; $i++){
				 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
					 echo ($paged == $i)? "<li><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
				 }
			 }
			 if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."' class='navigation_next'>&gt;</a></li>"; 
			 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."' class='navigation_last'>&raquo;</a></li>";
			 echo "</ul>\n";
		 }
	}
}
// Topbar Section
if ( !function_exists( 'apress_topbar_section' ) ) {
	function apress_topbar_section($key) {
	
	global $apress_data, $woocommerce;
	$top_search_design = $apress_data["search_design"];
	$sticky_header_button_color_scheme = isset($apress_data["sticky_header_special_button_color_scheme"]) ? $apress_data["sticky_header_special_button_color_scheme"] : 'default';
	$sticky_header_button2_color_scheme = isset($apress_data["sticky_header_special_button2_color_scheme"]) ? $apress_data["sticky_header_special_button2_color_scheme"] : 'default';
	
	switch($key) {
		
			case 'tagline': 		
				// Header Tagline
				echo '<li class="top-tagline">'.$apress_data["header_tagline"].'</li>';
			break;
		
			case 'cart': 
				// Woocommerce Cart
				if ( class_exists( 'WooCommerce' ) ) {				
					echo '<li class="shopping_cart"><div class="shopping-cart-wrapper">'.apress_tiny_cart().'</div></li>';	
				}
			break;
		
			case 'multilingual':
				// Multilingual
				if($apress_data["multilingual_code"]){ 
					echo '<li class="zolo_multilingual_code">'.apress_execute_text_php($apress_data["multilingual_code"]).'</li>';		
				}	
			break;  
			
			case 'socialinks': 		
				// Header Social	
				get_template_part('framework/social_icons');	
			break; 
			
			case 'email': 
				// Header Email
				if($apress_data["header_email"]){
					echo '<li class="top-mail"><i class="fa fa-envelope mail-icon"></i><a href="mailto:'.$apress_data["header_email"].'">'.$apress_data["header_email"].'</a></li>';		
				}
			break; 
			
			case 'phoneno': 
				// Header Phone Number
				if($apress_data["header_phone_number"]){
					echo '<li class="top-phone"><i class="fa fa-phone mail-icon"></i><a href="tel:'.$apress_data["header_phone_number"].'">'.$apress_data["header_phone_number"].'</a></li>';	
				}
			break; 
			
			case 'faxno': 
				if($apress_data["header_fax_number"]){
				// Header Fax Number
					echo '<li class="top-fax"><i class="fa fa-fax"></i><a href="tel:'.$apress_data["header_fax_number"].'">'.$apress_data["header_fax_number"].'</a></li>';		
				}
			break;
			
			case 'topmenu': 
				// Top Menu
				echo  '<li class="zolo-top-menu">';
				wp_nav_menu( array( 'theme_location' => 'top-nav', 'menu_class' => 'top-menu', 'depth' => 2, 'link_before' => '<span class="menu-text">', 'link_after' => '</span>', ) );
				echo '</li>';	
			break; 
		   
			case 'extendedsidebar': 
				// Extended Sidebar Option		
					echo '<li class="zolo_extended_sidebar"><span class="extended_sidebar_button" ><span class="zolo_small_bars"></span></span></li>';			
			break;
			
			case 'text1':
				// Header Ad Area
				if($apress_data["header_html_text1"]){ 
					echo '<li class="header_htmltext header_html_text1">'.apress_execute_text_php($apress_data["header_html_text1"]).'</li>';		
				}
			break;
			
			case 'text2':
				// Header Ad Area
				if($apress_data["header_html_text2"]){ 
					echo '<li class="header_htmltext header_html_text2">'.apress_execute_text_php($apress_data["header_html_text2"]).'</li>';		
				}
			break;
			
			case 'text3':
				// Header Ad Area
				if($apress_data["header_html_text3"]){ 
					echo '<li class="header_htmltext header_html_text3">'.apress_execute_text_php($apress_data["header_html_text3"]).'</li>';		
				}
			break;
			
			case 'working_hours':
				// Header Working Hours Area
				if($apress_data["header_working_hours"]){ 
					echo '<li class="header_working_hours"><i class="fa fa-clock-o"></i>'.$apress_data["header_working_hours"].'</li>';		
				}
			break;
			
			case 'address':
				// Header Address
				if($apress_data["header_address"]){ 
					echo '<li class="header_address"><i class="fa fa-map-marker"></i>'.$apress_data["header_address"].'</li>';		
				}
			break;
			
			case 'special_button': 
				// Header Special Button
				if($apress_data["special_button_text"]){
					if($apress_data["special_button_bg_option"] == 'color'){
				$special_button_hover_style = isset($apress_data["special_button_hover_style"]) ? $apress_data["special_button_hover_style"] : 'button_hover_style_default';
					}else{$special_button_hover_style = 'button_hover_style_gradient';}
				echo '<li class="special_button_area '.$special_button_hover_style.' color_scheme_'.$sticky_header_button_color_scheme.'"><a target="'.$apress_data["special_button_link_target"].'" href="'.$apress_data["special_button_link_url"].'" class="special_button"><span class="special_button_text">'.$apress_data["special_button_text"].'</span></a></li>';
				}
			break;
			
			case 'special_button2': 
				// Header Special Button
				if($apress_data["special_button2_text"]){
					if($apress_data["special_button2_bg_option"] == 'color'){
				$special_button2_hover_style = isset($apress_data["special_button2_hover_style"]) ? $apress_data["special_button2_hover_style"] : 'button_hover_style_default';
					}else{$special_button2_hover_style = 'button_hover_style_gradient';}
				echo '<li class="special_button_area '.$special_button2_hover_style.' color_scheme_'.$sticky_header_button2_color_scheme.'"><a target="'.$apress_data["special_button2_link_target"].'" href="'.$apress_data["special_button2_link_url"].'" class="special_button2"><span class="special_button_text">'.$apress_data["special_button2_text"].'</span></a></li>';
				}
			break;
			
			case 'separator': 
				// Header Special Button
				echo '<li class="element_separator"><span class="element_separator_bar '.$apress_data["element_separator"].'"></span></li>';
			break;
			case 'search': 
				// Header Search
				echo '<li class="zolo-search-menu"><div class="zolo_navbar_search '.$top_search_design.'"><span class="'.$top_search_design.' nav_search-icon"></span>';
				if($top_search_design == 'default_search_but'){
					echo '<div class="nav_search_form_area">';
					get_search_form();
					echo '</div>';
				}
				echo '</div></li>';
			break;
		}
	}
}
// Header Section
if ( !function_exists( 'apress_header_section' ) ) {
	function apress_header_section($key) {
				
	global $apress_data, $woocommerce;		
	$sticky_header_button_color_scheme = isset($apress_data["sticky_header_special_button_color_scheme"]) ? $apress_data["sticky_header_special_button_color_scheme"] : 'default';
	$sticky_header_button2_color_scheme = isset($apress_data["sticky_header_special_button2_color_scheme"]) ? $apress_data["sticky_header_special_button2_color_scheme"] : 'default';
	
		switch($key) {		
			case 'logo': 		
				// Header Logo
				apress_header_logo();
				
			break;
			
			case 'tagline': 		
				// Header Tagline
				echo '<li class="top-tagline">'.$apress_data["header_tagline"].'</li>';
			break;
		
			case 'cart': 
				// Woocommerce Cart
				if ( class_exists( 'WooCommerce' ) ) {				
					echo '<li class="shopping_cart"><div class="shopping-cart-wrapper">'.apress_tiny_cart().'</div></li>';	
				}
			break;
		
			case 'multilingual': 		
				// Multilingual
				if($apress_data["multilingual_code"]){ 
					echo '<li class="zolo_multilingual_code">'.apress_execute_text_php($apress_data["multilingual_code"]).'</li>';		
				}	
			break;  
			
			case 'socialinks': 		
				// Header Social	
				get_template_part('framework/social_icons');			
					
			break; 
			
			case 'email': 
				// Header Email
				echo '<li class="top-mail"><i class="fa fa-envelope mail-icon"></i><a href="mailto:'.$apress_data["header_email"].'">'.$apress_data["header_email"].'</a></li>';		
			break; 
			
			case 'phoneno': 
				// Header Phone Number
				echo '<li class="top-phone"><i class="fa fa-phone mail-icon"></i><a href="tel:'.$apress_data["header_phone_number"].'">'.$apress_data["header_phone_number"].'</a></li>';			
			break; 
			
			case 'faxno': 
				// Header Fax Number
				echo '<li class="top-fax"><i class="fa fa-fax"></i><a href="tel:'.$apress_data["header_fax_number"].'">'.$apress_data["header_fax_number"].'</a></li>';		
			break;
			
			case 'extendedmenu': 
				// Extended Option		
					echo '<li class="zolo-small-menu"><span class="'.esc_attr($apress_data["menu_action_change"]).'" ><span class="zolo_small_bars"></span></span>';
					if($apress_data["menu_action_change"] == 'vertical_menu' || $apress_data["menu_action_change"] == 'horizontal_menu'){?>
					<div class="<?php echo esc_attr($apress_data["menu_action_change"]).'_area';?>">
							<div class="menu-main-container-box zolo-navigation">
								<?php	
								wp_nav_menu(  
										array(  
										'theme_location'  => 'primary-nav', 
										'container'       => false, 			        
										'container_id'    => 'main-nav',  
										'container_class' => '',  
										'menu_class' => 'nav zolo-navbar-nav',
										'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										'menu_id'         => 'primary' ,
										'depth'  			=> 1,
										'fallback_cb'       => 'ZOLOCoreFrontendWalker::fallback',
										'link_before'    	=> '<span class="menu-text">',
										'link_after'    	=> '</span>',
										'walker' 			=> new ZOLOCoreFrontendWalker()
										)
									);  
								?>
							</div>
							
						  </div>
			<?php }
			echo '</li>';
			break;
			
			case 'extendedsidebar': 
				// Extended Sidebar Option		
					echo '<li class="zolo_extended_sidebar"><span class="extended_sidebar_button" ><span class="zolo_small_bars"></span></span></li>';			
			break;
			
			case 'menu': 
				// Main Menu
				apress_preset_custom_top_header_main_menu();
			break; 
			
			case 'ad_area':
				// Header Ad Area
				if($apress_data["header_ad_section"]){ 
					echo '<li class="header_right_img">'.$apress_data["header_ad_section"].'</li>';		
				}
			break;
			
			case 'text1':
				// Header Ad Area
				if($apress_data["header_html_text1"]){ 
					echo '<li class="header_htmltext header_html_text1">'.apress_execute_text_php($apress_data["header_html_text1"]).'</li>';		
				}
			break;
			
			case 'text2':
				// Header Ad Area
				if($apress_data["header_html_text2"]){ 
					echo '<li class="header_htmltext header_html_text2">'.apress_execute_text_php($apress_data["header_html_text2"]).'</li>';		
				}
			break;
			
			case 'text3':
				// Header Ad Area
				if($apress_data["header_html_text3"]){ 
					echo '<li class="header_htmltext header_html_text3">'.apress_execute_text_php($apress_data["header_html_text3"]).'</li>';		
				}
			break;
			
			case 'working_hours':
				// Header Ad Area
				if($apress_data["header_working_hours"]){ 
					echo '<li class="header_working_hours"><i class="fa fa-clock-o"></i>'.$apress_data["header_working_hours"].'</li>';		
				}
			break;
			
			case 'address':
				// Header Address
				if($apress_data["header_address"]){ 
					echo '<li class="header_address"><i class="fa fa-map-marker"></i>'.$apress_data["header_address"].'</li>';		
				}
			break;
			
			case 'special_button':
				// Header Special Button
				if($apress_data["special_button_text"]){
				if($apress_data["special_button_bg_option"] == 'color'){
					$special_button_hover_style = isset($apress_data["special_button_hover_style"]) ? $apress_data["special_button_hover_style"] : 'button_hover_style_default';
					}else{$special_button_hover_style = 'button_hover_style_gradient';}
					
				echo '<li class="special_button_area '.$special_button_hover_style.' color_scheme_'.$sticky_header_button_color_scheme.'"><a target="'.$apress_data["special_button_link_target"].'" href="'.esc_url($apress_data["special_button_link_url"]).'" class="special_button"><span class="special_button_text">'.$apress_data["special_button_text"].'</span></a></li>';
				}
			break;
			
			case 'special_button2': 
				// Header Special Button
				if($apress_data["special_button2_text"]){
					if($apress_data["special_button2_bg_option"] == 'color'){
				$special_button2_hover_style = isset($apress_data["special_button2_hover_style"]) ? $apress_data["special_button2_hover_style"] : 'button_hover_style_default';
					}else{$special_button2_hover_style = 'button_hover_style_gradient';}
				echo '<li class="special_button_area '.$special_button2_hover_style.' color_scheme_'.$sticky_header_button2_color_scheme.'"><a target="'.$apress_data["special_button2_link_target"].'" href="'.$apress_data["special_button2_link_url"].'" class="special_button2"><span class="special_button_text">'.$apress_data["special_button2_text"].'</span></a></li>';
				}
			break;
			
			case 'separator': 
				// Header Special Button
				echo '<li class="element_separator"><span class="element_separator_bar '.esc_attr($apress_data["element_separator"]).'"></span></li>';
			break;
			
			case 'search': 
				// Header Search
					echo '<li class="zolo-search-menu">
					<div class="zolo_navbar_search '.esc_attr($apress_data["search_design"]).'"><span class="nav_'.esc_attr($apress_data["search_design"]).' nav_search-icon"></span>';
					if($apress_data["search_design"] == 'default_search_but'){
						echo '<div class="nav_search_form_area">';
						get_search_form();
						echo '</div>';
					}
					echo '</div></li>';
			break; 
		}
		
	}
}
// Vertical Header Section
if ( !function_exists( 'apress_vertical_header_section' ) ) {
	function apress_vertical_header_section($key) {	   
	global $apress_data, $woocommerce;
	
		switch($key) {		
			case 'logo': 		
				// Header Logo
				apress_header_logo();
				
			break;
			
			case 'tagline': 		
				// Header Tagline
				echo '<li class="top-tagline">'.$apress_data["header_tagline"].'</li>';
			break;
		
	
			break;
			
			case 'socialinks': 		
				// Header Social	
				get_template_part('framework/social_icons');
					
			break; 
			
			case 'email': 
				// Header Email
				echo '<li class="top-mail"><i class="fa fa-envelope mail-icon"></i><a href="mailto:'.$apress_data["header_email"].'">'.$apress_data["header_email"].'</a></li>';		
			break; 
			
			case 'phoneno':
				// Header Phone Number
				echo '<li class="top-phone"><i class="fa fa-phone mail-icon"></i><a href="tel:'.$apress_data["header_phone_number"].'">'.$apress_data["header_phone_number"].'</a></li>';			
			break; 
			
			case 'faxno': 
				// Header Fax Number
				echo '<li class="top-fax"><i class="fa fa-fax"></i><a href="tel:'.$apress_data["header_fax_number"].'">'.$apress_data["header_fax_number"].'</a></li>';		
			break;
			
			case 'menu': 
				// Menu
				get_template_part('framework/headers/vertical_header_menu');
				
			break; 
			
			case 'ad_area':
				// Header Ad Area
				if($apress_data["header_ad_section"]){
					echo '<li class="header_right_img">'.$apress_data["header_ad_section"].'</li>';		
				}
			break;
		}
	}
}
// Preset Custom Top Header Main Menu
if ( !function_exists( 'apress_preset_custom_top_header_main_menu' ) ) {
		function apress_preset_custom_top_header_main_menu(){		
		global $apress_data;
		
		$header_main_menu = isset($apress_data["main_menu_design"]) ? $apress_data["main_menu_design"] : 'menu1';
		$dropdown_loading = isset($apress_data["dropdown_loading"]) ? $apress_data["dropdown_loading"] : 'dropdown_loading_fade';
		
		if($header_main_menu == 'menu1'){
		
			$menu_design_name = 'menu_hover_design_none'; 
			$menu_hover_styles = '';
		
		}elseif($header_main_menu == 'menu2'){  
		
			$menu_design_name = 'menu_hover_design2';
			$menu_hover_styles = '';
		
		}elseif($header_main_menu == 'menu3'){  
		
			$menu_design_name = 'menu_hover_design3';
			$menu_hover_styles = '';
		
		}elseif($header_main_menu == 'menu4'){  
		
			$menu_design_name = 'menu_hover_design4';
			$menu_hover_styles = '';
		
		}elseif($header_main_menu == 'menu4'){  
		
			$menu_design_name = 'menu_hover_design4';
			$menu_hover_styles = '';
		
		}elseif($header_main_menu == 'menu_hover_style1'){  
		
			$menu_design_name = 'menu_hover_design_none'; 
			$menu_hover_styles = 'menu_hover_styles menu_hover_style1';
		
		}elseif($header_main_menu == 'menu_hover_style2'){  
		
			$menu_design_name = 'menu_hover_design_none'; 
			$menu_hover_styles = 'menu_hover_styles menu_hover_style2';
		
		}elseif($header_main_menu == 'menu_hover_style3'){  
		
			$menu_design_name = 'menu_hover_design_none'; 
			$menu_hover_styles = 'menu_hover_styles menu_hover_style3';
		
		}elseif($header_main_menu == 'menu_hover_style4'){  
		
			$menu_design_name = 'menu_hover_design_none'; 
			$menu_hover_styles = 'menu_hover_styles menu_hover_style4';
		
		}else{
			$menu_design_name = '';
			$menu_hover_styles = ''; 
		} 
		
		echo '<li><div class="navigation '.esc_attr($header_main_menu) .' '.esc_attr($dropdown_loading).' '.esc_attr($menu_hover_styles).'">';
		echo '<nav id="site-navigation" class="zolo-navigation main-navigation" role="navigation">';
		wp_nav_menu(  
			array(  
				'theme_location'  => 'primary-nav', 
				'container'       => false,            
				'container_id'    => 'main-nav',  
				'container_class' => '',  
				'menu_class' => 'nav zolo-navbar-nav '.esc_attr($menu_design_name),
				'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'menu_id'         => 'primary' ,
				'fallback_cb'       => 'ZOLOCoreFrontendWalker::fallback',
				'link_before'    	=> '<span class="menu-text">',
				'link_after'    	=> '</span>',
				'walker'    => new ZOLOCoreFrontendWalker()
			)
		);  
		echo '</nav>';
		echo '</div></li>';
	}
}
// Expanded Search
if ( !function_exists( 'apress_expanded_search' ) ) {
	function apress_expanded_search ($layout ){
		global $apress_data;
		$top_search_design = isset($apress_data["search_design"]) ? $apress_data["search_design"] : 'full_screen_search_but';
		if (in_array("Search", $layout))
		{
			if($top_search_design == 'expanded_search_but'){
				echo '<div class="zolo_navbar_search expanded_search_but"><div class="nav_search_form_area">';
				echo '<span id="nav_expanded_search_but" class="nav_search-icon expanded_close_button"></span>';
				get_search_form();
				echo '</div></div>';
			}
		}
	}
}
// Header Logo
if ( !function_exists( 'apress_header_logo' ) ) {
	function apress_header_logo(){
		global $apress_data , $post;	
		if(!is_object($post)) return;
		$header_sticky_opt = isset($apress_data["header_sticky_opt"]) ? $apress_data["header_sticky_opt"] : 'on';
		$header_layout = isset($apress_data['header_layout']) ? $apress_data['header_layout'] : 'v1';			
		$middle_menu_break_point = $header_layout == 'v8' ? 'zolo-middle-logo-menu-logo' : '';
		$logo_url = isset($apress_data['logo']['url']) ? $apress_data['logo']['url'] : '';
		$logo_retina_url = isset($apress_data['logo_retina']['url']) ? $apress_data['logo_retina']['url'] : '';

		$page_full_screen_rows = get_post_meta($post->ID, 'zt_full_screen_rows', true ); 
		$fullpage_scroll_logo_showhide = isset($apress_data["fullpage_scroll_logo_showhide"]) ? $apress_data["fullpage_scroll_logo_showhide"] : 'on';
		$fullpage_scroll_light_logo = isset($apress_data['fullpage_scroll_light_logo']['url']) ? $apress_data['fullpage_scroll_light_logo']['url'] : '';
		$retina_fullpage_scroll_light_logo = isset($apress_data['retina_fullpage_scroll_light_logo']['url']) ? $apress_data['retina_fullpage_scroll_light_logo']['url'] : '';
		$fullpage_scroll_dark_logo = isset($apress_data['fullpage_scroll_dark_logo']['url']) ? $apress_data['fullpage_scroll_dark_logo']['url'] : '';
		$retina_fullpage_scroll_dark_logo = isset($apress_data['retina_fullpage_scroll_dark_logo']['url']) ? $apress_data['retina_fullpage_scroll_dark_logo']['url'] : '';
		
		
		
		if($logo_url){
			echo '<li class="'.$middle_menu_break_point.'">';
			echo '<div class="logo-box"><a href="'.esc_url( home_url( '/' ) ).'">';
			
			if($page_full_screen_rows == 'on' && $fullpage_scroll_logo_showhide == 'on'){
				echo '<img src="'.esc_url($fullpage_scroll_dark_logo).'" srcset="'.esc_url($fullpage_scroll_dark_logo).' 1x, '.esc_url($retina_fullpage_scroll_dark_logo).' 2x" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" class="logo fullpage_scroll_dark_logo" />';
				echo '<img src="'.esc_url($fullpage_scroll_light_logo).'" srcset="'.esc_url($fullpage_scroll_light_logo).' 1x, '.esc_url($retina_fullpage_scroll_light_logo).' 2x" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" class="logo fullpage_scroll_light_logo" />';
				
			}else{
				
				echo '<img src="'.esc_url($logo_url).'" srcset="'.esc_url($logo_url).' 1x, '.esc_url($logo_retina_url).' 2x" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" class="logo" />';
			}
				
			echo '</a></div>';
			
			//sticky Header Logo
			if($header_sticky_opt == 'on'){
				echo '<div class="logo-box sticky_logo"> <a href="'.esc_url( home_url( '/' ) ).'">';
				if($apress_data['sticky_header_logo_showhide'] == 'on' && $apress_data['sticky_logo']['url'] !== ''){             
						
					echo '<img src="'.esc_url($apress_data['sticky_logo']['url']).'" srcset="'.esc_url($apress_data['sticky_logo']['url']).' 1x, '.esc_url($apress_data['retina_sticky_logo']['url']).' 2x" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" class="logo" />'; 
						
				}else{ 
					echo '<img src="'.esc_url($logo_url).'" srcset="'.esc_url($logo_url).' 1x, '.esc_url($logo_retina_url).' 2x" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" class="logo" />';          
				}
			echo '</a></div>';
			}
			echo '</li>';
		}else{
			echo '<li class="'.$middle_menu_break_point.'">';
		   	echo '<div class="logo_text">';
			if ( is_front_page() ) :
            	echo '<h1 class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">'.esc_attr( get_bloginfo( 'name' ) ).'</a></h1>';
            else :
            	echo '<p class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">'.esc_attr( get_bloginfo( 'name' ) ).'</a></p>';
			endif;
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : 
				echo '<p class="site-description">'.$description.'</p>';
			endif; 
		   	echo '</div>';
		   	echo '</li>';
			}	
			
			
			
			
	}
}

if ( !function_exists( 'apress_mobile_menu' ) ) {
	function apress_mobile_menu(){
	global $apress_data;	
	$menu_action_1 = $menu_action_2 = '';	

	$custom_header_dragdrop = isset($apress_data['custom_header_dragdrop']) ? $apress_data['custom_header_dragdrop'] : 'preset';
	$section2_show_hide = isset($apress_data['section2_show_hide']) ? $apress_data['section2_show_hide'] : 'on';
	$section3_show_hide = isset($apress_data['section3_show_hide']) ? $apress_data['section3_show_hide'] : 'on';
	
	if($section2_show_hide == 'on'){
		$section_two = $apress_data['header_section_two']['Section Two'];
		
		if(array_key_exists("menu", $section_two) && !array_key_exists("extendedmenu", $section_two)){
				if(!array_key_exists("extendedmenu", $section_two)){
					if($apress_data['menu_action_change'] == 'fullscreen_menu_open_button'){
						$menu_action_1 = 'menu';	
					}
				}
			}else{
				 if(array_key_exists("menu", $section_two) && array_key_exists("extendedmenu", $section_two)){
					$menu_action_1 =  'no_menu';
				}else{
					$menu_action_1 =  'menu_there';
					}
		}
	}
	
	if($section3_show_hide == 'on'){
		$section_three = $apress_data['header_section_three']['Section Three'];
		
		if(array_key_exists("menu", $section_three) && !array_key_exists("extendedmenu", $section_three)){
				if(!array_key_exists("extendedmenu", $section_three)){
					if($apress_data['menu_action_change'] == 'fullscreen_menu_open_button'){
						$menu_action_2 = 'menu';	
					}
				}
			}else{
				 if(array_key_exists("menu", $section_three) && array_key_exists("extendedmenu", $section_three)){
					$menu_action_2 =  'no_menu';
				}else{
					$menu_action_2 =  'menu_there';
					}
		}
	}

	
	if( $custom_header_dragdrop == 'custom' && ($menu_action_1 == 'menu_there' || $menu_action_2 == 'menu_there')){			
			
		}else{
			if( $apress_data['menu_action_change'] == 'fullscreen_menu_open_button' ){
			echo '<nav id="site-navigation" class="zolo-navigation main-navigation" role="navigation" style="display:none;">';
						wp_nav_menu(  
						array(  
							'theme_location'  => 'primary-nav', 
							'container'       => false,            
							'container_id'    => 'main-nav',  
							'container_class' => '',  
							'menu_class' => 'nav zolo-navbar-nav ',
							'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'menu_id'         => 'primary' ,
							'fallback_cb'       => 'ZOLOCoreFrontendWalker::fallback',
							'link_before'    	=> '<span class="menu-text">',
							'link_after'    	=> '</span>',
							'walker'    => new ZOLOCoreFrontendWalker()
						)
					);  
						echo '</nav>';
			}
			
			}
	
	}
}


// Social Sharing
if ( !function_exists( 'apress_social_sharing' ) ) {
	function apress_social_sharing(){
		global $post, $apress_data;
		$social_share_style = isset($apress_data['social_share_style']) ? $apress_data['social_share_style'] : 'default';
		$sharing_facebook = isset($apress_data['sharing_facebook']) ? $apress_data['sharing_facebook'] : 'on';
		$sharing_twitter = isset($apress_data['sharing_twitter']) ? $apress_data['sharing_twitter'] : 'on';
		$sharing_linkedin = isset($apress_data['sharing_linkedin']) ? $apress_data['sharing_linkedin'] : 'on';
		$sharing_tumblr = isset($apress_data['sharing_tumblr']) ? $apress_data['sharing_tumblr'] : 'on';
		$sharing_google = isset($apress_data['sharing_google']) ? $apress_data['sharing_google'] : 'on';
		$sharing_pinterest = isset($apress_data['sharing_pinterest']) ? $apress_data['sharing_pinterest'] : 'on';
		$sharing_email = isset($apress_data['sharing_email']) ? $apress_data['sharing_email'] : 'on';
		?>
		<ul class="social-networks <?php echo 'social_share_style_'.$social_share_style;?>">
			<?php if($sharing_facebook == 'on'): ?>
			<li class="facebook"> <a href="http://www.facebook.com/sharer.php?s=100&p&#91;url&#93;=<?php esc_url(the_permalink()); ?>&p&#91;title&#93;=<?php esc_attr(the_title()); ?>" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a></li>
			<?php endif; ?>
			<?php if($sharing_twitter == 'on'): ?>
			<li class="twitter"> <a href="http://twitter.com/home?status=<?php esc_attr(the_title()); ?> <?php esc_url(the_permalink()); ?>" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a></li>
			<?php endif; ?>
			<?php if($sharing_linkedin == 'on'): ?>
			<li class="linkedin"> <a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php esc_url(the_permalink()); ?>&amp;title=<?php esc_attr(the_title()); ?>" target="_blank" rel="nofollow"><i class="fa fa-linkedin"></i></a> </li>
			<?php endif; ?>
			<?php if($sharing_tumblr == 'on'): ?>
			<li class="tumblr"> <a href="http://www.tumblr.com/share/link?url=<?php echo urlencode(esc_url(get_permalink())); ?>&amp;name=<?php echo urlencode($post->post_title); ?>&amp;description=<?php echo urlencode(esc_attr(get_the_excerpt())); ?>" target="_blank" rel="nofollow"> <i class="fa fa-tumblr"></i> </a></li>
			<?php endif; ?>
			<?php if($sharing_google == 'on'): ?>
			<li class="google"> <a href="https://plus.google.com/share?url=<?php esc_url(the_permalink()); ?>" onclick="javascript:window.open(this.href,
			'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" rel="nofollow"> <i class="fa fa-google-plus"></i> </a></li>
			<?php endif; ?>
			<?php if($sharing_pinterest == 'on'): ?>
			<li class="pinterest">
			<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
			<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(esc_url(get_permalink())); ?>&amp;description=<?php echo urlencode($post->post_title); ?>&amp;media=<?php echo urlencode($full_image[0]); ?>" target="_blank" rel="nofollow"> <i class="fa fa-pinterest"></i> </a> </li>
			<?php endif; ?>
			<?php if($sharing_email == 'on'): ?>
			<li class="email"> <a href="mailto:?subject=<?php esc_attr(the_title()); ?>&amp;body=<?php esc_url(the_permalink()); ?>"> <i class="fa fa-envelope-o"></i> </a></li>
			<?php endif; ?>
		</ul>
<?php }
}

// Comment	
if ( !function_exists( 'apress_comment' ) ) {	
	function apress_comment( $comment, $args, $depth ) {
		$add_below = ''; ?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
					
					<div class="comment-author vcard">
							<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>						
						</div>
					<div class="comment-content">
					<?php
						/* translators: %s: comment author link */
						printf( '<h4 class="fn">%s</h4>', get_comment_author_link( $comment ) );?>
					<?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>'
						) ) );
					?>
					<footer class="comment-meta">
					<!-- .comment-author -->
						<div class="comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php
										/* translators: 1: comment date, 2: comment time */
										printf( __( '%1$s at %2$s','apress' ), get_comment_date( '', $comment ), get_comment_time() );
									?>
								</time>
							</a>
							<?php edit_comment_link( __( 'Edit', 'apress' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .comment-metadata -->
	
						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'apress' ); ?></p>
						<?php endif; ?>
					</footer>
						<?php comment_text(); ?>
					</div><!-- .comment-content -->
	
					
				</article>
		<?php
	}
}
// Post Sidebar Class
if ( !function_exists( 'apress_sidebar_and_class' ) ) {	
	function apress_sidebar_and_class($sidebar_class, $sidebar, $post_type){			
		global $post, $apress_data;		
		if(!is_object($post)) return;
		$zolo_sidebar_position = get_post_meta( $post->ID , 'zt_sidebar_position', true );
		$zolo_sidebar_left_position = get_post_meta( $post->ID , 'zt_sidebar_left_position', true );
		$zolo_sidebar_right_position = get_post_meta( $post->ID , 'zt_sidebar_right_position', true );
		
		if($post_type == 'post'){			
			$admin_sidebar_position = isset($apress_data["blogposts_sidebar_position"]) ? $apress_data["blogposts_sidebar_position"] : 'left';
			$admin_left_sidebar = isset($apress_data["blogposts_left_sidebar"]) ? $apress_data["blogposts_left_sidebar"] : 'sidebar';
			$admin_right_sidebar = isset($apress_data["blogposts_right_sidebar"]) ? $apress_data["blogposts_right_sidebar"] : '';		
			
		}else if($post_type == 'testimonial'){
			
			$admin_sidebar_position = isset($apress_data["testimonial_sidebar_position"]) ? $apress_data["testimonial_sidebar_position"] : 'left';
			$admin_left_sidebar = isset($apress_data["testimonial_left_sidebar"]) ? $apress_data["testimonial_left_sidebar"] : 'sidebar';
			$admin_right_sidebar = isset($apress_data["testimonial_right_sidebar"]) ? $apress_data["testimonial_right_sidebar"] : '';
		}else if($post_type == 'team'){
			
			$admin_sidebar_position = isset($apress_data["team_sidebar_position"]) ? $apress_data["team_sidebar_position"] : 'left';
			$admin_left_sidebar = isset($apress_data["team_left_sidebar"]) ? $apress_data["team_left_sidebar"] : 'sidebar';
			$admin_right_sidebar = isset($apress_data["team_right_sidebar"]) ? $apress_data["team_right_sidebar"] : '';
		}else{		
			$admin_sidebar_position = isset($apress_data["portfolioposts_sidebar_position"]) ? $apress_data["portfolioposts_sidebar_position"] : 'left';
			$admin_left_sidebar = isset($apress_data["portfolioposts_left_sidebar"]) ? $apress_data["portfolioposts_left_sidebar"] : 'sidebar';
			$admin_right_sidebar = isset($apress_data["portfolioposts_right_sidebar"]) ? $apress_data["portfolioposts_right_sidebar"] : '';
		}
		
			
		if($sidebar_class == 'show'){
			if($zolo_sidebar_position == 'default' || $zolo_sidebar_position == ''){
				
				if($admin_sidebar_position == 'left'){			
					$sidebar_position_class = 'hassidebar left';					
				}elseif($admin_sidebar_position == 'right'){			
					$sidebar_position_class = 'hassidebar right';					
				}elseif($admin_sidebar_position == 'both'){			
					$sidebar_position_class = 'hassidebar double_sidebars';					
				}elseif($admin_sidebar_position == 'none'){			
					$sidebar_position_class = 'nosidebars';				
				}  
				
			}else{	
			
				if($zolo_sidebar_position == 'left'){			
					$sidebar_position_class = 'hassidebar left';		
				}elseif($zolo_sidebar_position == 'right'){			
					$sidebar_position_class = 'hassidebar right';		
				}elseif($zolo_sidebar_position == 'both'){			
					$sidebar_position_class = 'hassidebar double_sidebars';		
				}elseif($zolo_sidebar_position == 'none'){			
					$sidebar_position_class = 'nosidebars';		
				}  
			}
			echo esc_attr($sidebar_position_class);
		}
			
			
		if($sidebar == 'show'){
			//Single Post sidebar
			if($zolo_sidebar_position == 'default' || $zolo_sidebar_position == ''){
				if($admin_sidebar_position != 'none' || $admin_sidebar_position != ''){
					if($admin_sidebar_position == 'left' || $admin_sidebar_position == 'both'){
						echo '<div class="sidebar sidebar_container_1 left" role="complementary"><div class="widget-area">';
						if(function_exists('generated_dynamic_sidebar')){
							generated_dynamic_sidebar($admin_left_sidebar ); 
						}else{
							dynamic_sidebar($admin_left_sidebar);
						}
						echo '</div></div>';	
					}
					if($admin_sidebar_position == 'right' || $admin_sidebar_position == 'both'){
						echo '<div class="sidebar sidebar_container_2 right" role="complementary"><div class="widget-area">';
							generated_dynamic_sidebar($admin_right_sidebar);
						echo '</div></div>';	
					}	
				}
			}else{
				if($zolo_sidebar_position == 'left' || $zolo_sidebar_position == 'both'){
					echo '<div class="sidebar sidebar_container_1 left" role="complementary"><div class="widget-area">';
						generated_dynamic_sidebar($zolo_sidebar_left_position ); 
					echo '</div></div>';
				}
				if($zolo_sidebar_position == 'right' || $zolo_sidebar_position == 'both'){
					echo '<div class="sidebar sidebar_container_2 right" role="complementary"><div class="widget-area">';
						generated_dynamic_sidebar($zolo_sidebar_right_position ); 
					echo '</div></div>';
				}	
				
			}
		}
			
	}
}

// Page Sidebar Class
if ( !function_exists( 'apress_page_sidebar_class' ) ) {
	function apress_page_sidebar_class($sidebar_class, $sidebar){
		global $apress_data, $post;
		if(!is_object($post)) return;
		$page_sidebar_position = get_post_meta( $post->ID , 'zt_sidebar_position', true );	
		$page_left_sidebar = get_post_meta( $post->ID , 'zt_sidebar_left_position', true );	
		$page_right_sidebar = get_post_meta( $post->ID , 'zt_sidebar_right_position', true );		
		$admin_page_sidebar_position = isset($apress_data["page_sidebar_position"]) ? $apress_data["page_sidebar_position"] : 'left';
		$admin_page_left_sidebar = isset($apress_data["page_left_sidebar"]) ? $apress_data["page_left_sidebar"] : 'sidebar';
		$admin_page_right_sidebar = isset($apress_data["page_right_sidebar"]) ? $apress_data["page_right_sidebar"] : ''; 
		
		if($sidebar_class == 'show'){
			// Sidebar class
			if($page_sidebar_position == 'default' || $page_sidebar_position == ''){		
				if($admin_page_sidebar_position == 'left'){			
					$sidebar_position_class = 'hassidebar left';					
				}elseif($admin_page_sidebar_position == 'right'){			
					$sidebar_position_class = 'hassidebar right';					
				}elseif($admin_page_sidebar_position == 'both'){			
					$sidebar_position_class = 'hassidebar double_sidebars';					
				}elseif($admin_page_sidebar_position == 'none'){			
					$sidebar_position_class = 'nosidebars';				
				}
			}else{		
				if($page_sidebar_position == 'left'){			
					$sidebar_position_class = 'hassidebar left';		
				}elseif($page_sidebar_position == 'right'){			
					$sidebar_position_class = 'hassidebar right';		
				}elseif($page_sidebar_position == 'both'){			
					$sidebar_position_class = 'hassidebar double_sidebars';		
				}elseif($page_sidebar_position == 'none'){			
					$sidebar_position_class = 'nosidebars';		
				}  
			}
			return $sidebar_position_class;
		}
		
		if($sidebar == 'show'){			
			if($page_sidebar_position == 'default' || $page_sidebar_position == ''){
				if($admin_page_sidebar_position != 'none' || $admin_page_sidebar_position != ''){
						if($admin_page_sidebar_position == 'left' || $admin_page_sidebar_position == 'both'){
								echo '<div class="sidebar sidebar_container_1 left" role="complementary"><div class="widget-area">';
								if(function_exists('generated_dynamic_sidebar')){
									generated_dynamic_sidebar($admin_page_left_sidebar ); 
								}else{
									dynamic_sidebar( $admin_page_left_sidebar );
								}
			
								echo '</div></div>';	
							}
						if($admin_page_sidebar_position == 'right' || $admin_page_sidebar_position == 'both'){
								echo '<div class="sidebar sidebar_container_2 right" role="complementary"><div class="widget-area">';
								generated_dynamic_sidebar($admin_page_right_sidebar);
								echo '</div></div>';	
							}	
					}
			}else{
				if($page_sidebar_position == 'left' || $page_sidebar_position == 'both'){
						echo '<div class="sidebar sidebar_container_1 left" role="complementary"><div class="widget-area">';
						if(function_exists('generated_dynamic_sidebar')){
							generated_dynamic_sidebar($page_left_sidebar ); 
						}else{
							dynamic_sidebar( $page_left_sidebar );
						}
						echo '</div></div>';
					}
				if($page_sidebar_position == 'right' || $page_sidebar_position == 'both'){
						echo '<div class="sidebar sidebar_container_2 right" role="complementary"><div class="widget-area">';
						generated_dynamic_sidebar($page_right_sidebar ); 
						echo '</div></div>';
					}	
				
			}  			
			
		}		
		
	}
}
// Page Sidebar Class
if ( !function_exists( 'apress_archive_sidebar_class' ) ) {
	function apress_archive_sidebar_class($sidebar_class, $sidebar){
		global $apress_data, $post;
		if(is_tax( 'catportfolio' ) || is_post_type_archive('zt_portfolio')){
			$archive_sidebar_position = isset($apress_data["portfolio_archive_sidebar_position"]) ? $apress_data["portfolio_archive_sidebar_position"] : 'left';
			$archive_left_sidebar = isset($apress_data["portfolio_archive_left_sidebar"]) ? $apress_data["portfolio_archive_left_sidebar"] : 'sidebar';
			$archive_right_sidebar = isset($apress_data["portfolio_archive_right_sidebar"]) ? $apress_data["portfolio_archive_right_sidebar"] : ''; 
		}else{
			$archive_sidebar_position = isset($apress_data["blog_archive_sidebar_position"]) ? $apress_data["blog_archive_sidebar_position"] : 'left';
			$archive_left_sidebar = isset($apress_data["blog_archive_left_sidebar"]) ? $apress_data["blog_archive_left_sidebar"] : 'sidebar';
			$archive_right_sidebar = isset($apress_data["blog_archive_right_sidebar"]) ? $apress_data["blog_archive_right_sidebar"] : ''; 
			
			}
		if($sidebar_class == 'show'){
			//Sidebar Show/Hide Condition Class
			if($archive_sidebar_position == 'left'){				
				$sidebar_position_class = 'hassidebar left';			
			}elseif($archive_sidebar_position == 'right'){				
				$sidebar_position_class = 'hassidebar right';			
			}elseif($archive_sidebar_position == 'both'){				
				$sidebar_position_class = 'hassidebar double_sidebars';			
			}elseif($archive_sidebar_position == 'none'){				
				$sidebar_position_class = 'nosidebars';
			}else{					
				$sidebar_position_class = '';				
				}
			return $sidebar_position_class;	
			}
		
		if($sidebar == 'show'){
			if($archive_sidebar_position != 'none'){
				if(($archive_sidebar_position == 'left' || $archive_sidebar_position == 'both')){ 				
					echo '<div class="sidebar sidebar_container_1 left" role="complementary"><div class="widget-area">';				
					if(function_exists('generated_dynamic_sidebar')){
						generated_dynamic_sidebar($archive_left_sidebar ); 
					}else{
						dynamic_sidebar( $archive_left_sidebar );
					}
					echo '</div></div>';
				}
				if($archive_sidebar_position == 'right' || $archive_sidebar_position == 'both'){	
					echo '<div class="sidebar sidebar_container_2 right" role="complementary"><div class="widget-area">';
					generated_dynamic_sidebar($archive_right_sidebar ); 
					echo '</div></div>';
						
				}
			}
		}		
		
	}
}

// Page Sidebar Class
if ( !function_exists( 'apress_search_sidebar_class' ) ) {
	function apress_search_sidebar_class($sidebar_class, $sidebar){
		global $apress_data, $post;
		
		$searchpage_sidebar_position = isset($apress_data["searchpage_sidebar_position"]) ? $apress_data["searchpage_sidebar_position"] : 'left';
		$searchpage_left_sidebar = isset($apress_data["searchpage_left_sidebar"]) ? $apress_data["searchpage_left_sidebar"] : 'sidebar';
		$searchpage_right_sidebar = isset($apress_data["searchpage_right_sidebar"]) ? $apress_data["searchpage_right_sidebar"] : '';
		$sidebar_position_class = '';
		
		
		if($sidebar_class == 'show'){
			if($searchpage_sidebar_position == 'left'){			
				$sidebar_position_class = 'hassidebar left';					
			}else if($searchpage_sidebar_position == 'right'){			
				$sidebar_position_class = 'hassidebar right';					
			}else if($searchpage_sidebar_position == 'both'){			
				$sidebar_position_class = 'hassidebar double_sidebars';					
			}else if($searchpage_sidebar_position == 'none'){			
				$sidebar_position_class = 'nosidebars';				
			}
			return $sidebar_position_class;
		}
		
		if($sidebar == 'show'){
			if($searchpage_sidebar_position != 'none' || $searchpage_sidebar_position != ''){
				if($searchpage_sidebar_position == 'left' || $searchpage_sidebar_position == 'both'){
						echo '<div class="sidebar sidebar_container_1 left" role="complementary"><div class="widget-area">';
						if(function_exists('generated_dynamic_sidebar')){
							generated_dynamic_sidebar($searchpage_left_sidebar ); 
						}else{
							dynamic_sidebar( $searchpage_left_sidebar );
						}
						echo '</div></div>';	
					}
				if($searchpage_sidebar_position == 'right' || $searchpage_sidebar_position == 'both'){
						echo '<div class="sidebar sidebar_container_2 right" role="complementary"><div class="widget-area">';
						generated_dynamic_sidebar($searchpage_right_sidebar);
						echo '</div></div>';	
					}	
				}			
			}		
		
	}
}

// Apress Author Info
if ( !function_exists( 'apress_author_info' ) ) {
function apress_author_info(){
	global $post, $apress_data;
	if(!is_object($post)) return;
	$post_author_info = isset($apress_data["post_author_info"]) ? $apress_data["post_author_info"] : 'on';
	$social_sharing_box = isset($apress_data["social_sharing_box"]) ? $apress_data["social_sharing_box"] : 'on';
	
	if( ( $post_author_info == 'on' && get_post_meta($post->ID, 'zt_author_info', true ) != 'no' ) ||  ( $social_sharing_box == 'off' && get_post_meta($post->ID, 'zt_share_box', true) == 'yes' ) ): ?>
            <?php if(get_the_author_meta('description') != "") : ?>
           	<div class="about-author">
            <div class="about-author-container">
              <div class="avatar"> <?php echo get_avatar(get_the_author_meta('email'), '72'); ?> </div>
              <div class="description">
              <h4><?php the_author_posts_link(); ?></h4>               
					<?php echo get_the_author_meta('description') ?>				
              </div>
            </div>
          </div>
          <?php endif;
		 endif;
	}
}

// Apress Portfolio Details
if ( !function_exists( 'apress_portfolio_details' ) ) {
	function apress_portfolio_details(){
	global $post, $apress_data;
	if(!is_object($post)) return;
	include get_template_directory().'/framework/variables/variables-portfolio-layout.php';
	$output = '';
		$output .= '<ul class="project-details-list">';
		if($portfolio_client_name){
			$output .= '<li><strong>'.__('Client: ', 'apress').'</strong> '.esc_html($portfolio_client_name).'</li>';
		}
		if(get_the_term_list($post->ID, 'catportfolio', '', '<br />', '')){
			$output .= '<li><strong>'. __('Tasks: ', 'apress').'</strong>'.get_the_term_list($post->ID, 'catportfolio', '', ', ', '').'</li>';
		}
		if($portfolio_skills){
			$output .= '<li><strong>'.__('Skills: ', 'apress').'</strong> '.esc_html($portfolio_skills).'</li>';
		}
		if($portfolio_duration){
			$output .= '<li><strong>'.__('Duration: ', 'apress').'</strong> '.esc_html($portfolio_duration).'</li>';
		}
		if($portfolio_website_url_text){
			$output .= '<li><a href="'.esc_url($portfolio_website_url).'" target="'.$link_icon_target.'" class="launch_button"><span>'.$portfolio_website_url_text.'</span></a></li>';
		}
		$output .= '</ul>';
		
		echo $output;
	}
}

//Color Scheme for shortcode
if ( !function_exists( 'apcore_shortcodes_background_color_scheme' ) ) {
function apcore_shortcodes_background_color_scheme($key){
global $apress_data;

$primary_color_option = isset($apress_data["primary_color_option"]) ? $apress_data["primary_color_option"] : 'color';
if($primary_color_option == 'gradient'){
	
		$primary_gradient_color_from = isset($apress_data["primary_gradient"]["from"]) ? $apress_data["primary_gradient"]["from"] : '#5295ea';
		$primary_gradient_color_to = isset($apress_data["primary_gradient"]["to"]) ? $apress_data["primary_gradient"]["to"] : '#8b79db';
		
		$primary_color_bg = 'background:'.$primary_gradient_color_from.';
background: -moz-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$primary_gradient_color_from.'), color-stop(100%, '.$primary_gradient_color_to.'));
background: -webkit-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
background: -o-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
background: -ms-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
background: linear-gradient(90deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$primary_gradient_color_from.', endColorstr='.$primary_gradient_color_to.',GradientType=1 );';
		
	}else{
		$primary_color = isset($apress_data["primary_color"]) ? $apress_data["primary_color"] : '#549ffc';	
		$primary_color_bg = 'background:'.$primary_color.';';	
	}
	
	if( $key == 'default_button_color_scheme'){
			$key = isset($apress_data["button_color_scheme"]) ? $apress_data["button_color_scheme"] : 'primary_color_scheme';
		}else{
			$key = $key;
			}

	switch($key) {
		case 'primary_color_scheme': 
		//Color Scheme 1
			$output = $primary_color_bg;
			return $output;		
	
		break;
		
		case 'color_scheme1': 		
		//Color Scheme 1
			$color_scheme_1 = isset($apress_data["color_scheme_1"]) ? $apress_data["color_scheme_1"] : '#2e00af';
			$output = 'background:'.$color_scheme_1.';';
			return $output;
			
		break;
		
		case 'color_scheme2': 		
		//Color Scheme 2
			$color_scheme_2 = isset($apress_data["color_scheme_2"]) ? $apress_data["color_scheme_2"] : '#8b79db';
			$output = 'background:'.$color_scheme_2.';';
			return $output;
			
		break;
		
		case 'gradient_scheme1': 
		//Gradient Scheme 1
			$gradient_scheme_1_from = isset($apress_data["gradient_scheme_1"]["from"]) ? $apress_data["gradient_scheme_1"]["from"] : '#3452ff';
			$gradient_scheme_1_to = isset($apress_data["gradient_scheme_1"]["to"]) ? $apress_data["gradient_scheme_1"]["to"] : '#ff1053';
			
			$output = 'background:'.$gradient_scheme_1_from.';
	background: -moz-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$gradient_scheme_1_from.'), color-stop(100%, '.$gradient_scheme_1_to.'));
	background: -webkit-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	background: -o-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	background: linear-gradient(90deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$gradient_scheme_1_from.', endColorstr='.$gradient_scheme_1_to.',GradientType=1 );';
				
			return $output;
			
			
		break;
		
		case 'gradient_scheme2': 		
		//Gradient Scheme 2
			$gradient_scheme_2_from = isset($apress_data["gradient_scheme_2"]["from"]) ? $apress_data["gradient_scheme_2"]["from"] : '#452998';
			$gradient_scheme_2_to = isset($apress_data["gradient_scheme_2"]["to"]) ? $apress_data["gradient_scheme_2"]["to"] : '#8601a8';
			
			$output = 'background:'.$gradient_scheme_2_from.';
	background: -moz-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$gradient_scheme_2_from.'), color-stop(100%, '.$gradient_scheme_2_to.'));
	background: -webkit-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	background: -o-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	background: linear-gradient(90deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$gradient_scheme_2_from.', endColorstr='.$gradient_scheme_2_to.',GradientType=1 );';
				
			return $output;
			
		break;
		
		case 'gradient_scheme3': 
			
			//Gradient Scheme 2
			$gradient_scheme_3_from = isset($apress_data["gradient_scheme_3"]["from"]) ? $apress_data["gradient_scheme_3"]["from"] : '#452998';
			$gradient_scheme_3_to = isset($apress_data["gradient_scheme_3"]["to"]) ? $apress_data["gradient_scheme_3"]["to"] : '#8601a8';
			
			$output = 'background:'.$gradient_scheme_3_from.';
	background: -moz-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$gradient_scheme_3_from.'), color-stop(100%, '.$gradient_scheme_3_to.'));
	background: -webkit-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	background: -o-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	background: linear-gradient(90deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$gradient_scheme_3_from.', endColorstr='.$gradient_scheme_3_to.',GradientType=1 );';
				
			return $output;
			
		break;
	}

}
}

//Color Scheme for shortcode Text
if ( !function_exists( 'apcore_shortcodes_text_color_scheme' ) ) {
function apcore_shortcodes_text_color_scheme($key){
global $apress_data;

$primary_color_option = isset($apress_data["primary_color_option"]) ? $apress_data["primary_color_option"] : 'color';
if($primary_color_option == 'gradient'){
	
		$primary_gradient_color_from = isset($apress_data["primary_gradient"]["from"]) ? $apress_data["primary_gradient"]["from"] : '#5295ea';
		$primary_gradient_color_to = isset($apress_data["primary_gradient"]["to"]) ? $apress_data["primary_gradient"]["to"] : '#8b79db';
		
		if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/(?i)msie|trident|edge/",$_SERVER['HTTP_USER_AGENT'])) {
			$primary_color_bg = 'color:'.$primary_gradient_color_from.';';
		}else{
		$primary_color_bg = 'background:'.$primary_gradient_color_from.';
			background: -moz-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$primary_gradient_color_from.'), color-stop(100%, '.$primary_gradient_color_to.'));
			background: -webkit-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			background: -o-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			background: -ms-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			background: linear-gradient(90deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$primary_gradient_color_from.', endColorstr='.$primary_gradient_color_to.',GradientType=1 );
			color: transparent;-webkit-background-clip: text;background-clip: text;';
		}
		
	}else{
		$primary_color = isset($apress_data["primary_color"]) ? $apress_data["primary_color"] : '#549ffc';	
		$primary_color_bg = 'color:'.$primary_color.';';	
	}
	
	if( $key == 'default_button_color_scheme'){
			$key = isset($apress_data["button_color_scheme"]) ? $apress_data["button_color_scheme"] : 'primary_color_scheme';
		}else{
			$key = $key;
			}

	switch($key) {
		case 'primary_color_scheme': 
		//Color Scheme 1
			$output = $primary_color_bg;
			return $output;		
	
		break;
		
		case 'color_scheme1': 		
		//Color Scheme 1
			$color_scheme_1 = isset($apress_data["color_scheme_1"]) ? $apress_data["color_scheme_1"] : '#2e00af';
			$output = 'color:'.$color_scheme_1.';';
			return $output;
			
		break;
		
		case 'color_scheme2': 		
		//Color Scheme 2
			$color_scheme_2 = isset($apress_data["color_scheme_2"]) ? $apress_data["color_scheme_2"] : '#8b79db';
			$output = 'color:'.$color_scheme_2.';';
			return $output;
			
		break;
		
		case 'gradient_scheme1': 
		//Gradient Scheme 1
			$gradient_scheme_1_from = isset($apress_data["gradient_scheme_1"]["from"]) ? $apress_data["gradient_scheme_1"]["from"] : '#3452ff';
			$gradient_scheme_1_to = isset($apress_data["gradient_scheme_1"]["to"]) ? $apress_data["gradient_scheme_1"]["to"] : '#ff1053';
			
			if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/(?i)msie|trident|edge/",$_SERVER['HTTP_USER_AGENT'])) {
				$output = 'color:'.$gradient_scheme_1_from.';';
			}else{
			$output = 'background:'.$gradient_scheme_1_from.';
	background: -moz-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$gradient_scheme_1_from.'), color-stop(100%, '.$gradient_scheme_1_to.'));
	background: -webkit-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	background: -o-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	background: linear-gradient(90deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$gradient_scheme_1_from.', endColorstr='.$gradient_scheme_1_to.',GradientType=1 ); color: transparent;-webkit-background-clip: text;background-clip: text;';	
			}
			return $output;
			
			
		break;
		
		case 'gradient_scheme2': 		
		//Gradient Scheme 2
			$gradient_scheme_2_from = isset($apress_data["gradient_scheme_2"]["from"]) ? $apress_data["gradient_scheme_2"]["from"] : '#452998';
			$gradient_scheme_2_to = isset($apress_data["gradient_scheme_2"]["to"]) ? $apress_data["gradient_scheme_2"]["to"] : '#8601a8';
			if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/(?i)msie|trident|edge/",$_SERVER['HTTP_USER_AGENT'])) {
				$output = 'color:'.$gradient_scheme_2_from.';';
			}else{
			$output = 'background:'.$gradient_scheme_2_from.';
	background: -moz-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$gradient_scheme_2_from.'), color-stop(100%, '.$gradient_scheme_2_to.'));
	background: -webkit-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	background: -o-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	background: linear-gradient(90deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$gradient_scheme_2_from.', endColorstr='.$gradient_scheme_2_to.',GradientType=1 ); color: transparent;-webkit-background-clip: text;background-clip: text;';	
			}
			return $output;
			
		break;
		
		case 'gradient_scheme3': 
			
			//Gradient Scheme 2
			$gradient_scheme_3_from = isset($apress_data["gradient_scheme_3"]["from"]) ? $apress_data["gradient_scheme_3"]["from"] : '#452998';
			$gradient_scheme_3_to = isset($apress_data["gradient_scheme_3"]["to"]) ? $apress_data["gradient_scheme_3"]["to"] : '#8601a8';
			if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/(?i)msie|trident|edge/",$_SERVER['HTTP_USER_AGENT'])) {
				$output = 'color:'.$gradient_scheme_2_from.';';
			}else{
			$output = 'background:'.$gradient_scheme_3_from.';
	background: -moz-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$gradient_scheme_3_from.'), color-stop(100%, '.$gradient_scheme_3_to.'));
	background: -webkit-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	background: -o-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	background: linear-gradient(90deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$gradient_scheme_3_from.', endColorstr='.$gradient_scheme_3_to.',GradientType=1 ); color: transparent;-webkit-background-clip: text;background-clip: text;';	
			}
			return $output;
			
		break;
	}

}
}


//Color Scheme for shortcode Border
if ( !function_exists( 'apcore_shortcodes_border_color_scheme' ) ) {
function apcore_shortcodes_border_color_scheme($key){
global $apress_data;

$primary_color_option = isset($apress_data["primary_color_option"]) ? $apress_data["primary_color_option"] : 'color';
if($primary_color_option == 'gradient'){
	
		$primary_gradient_color_from = isset($apress_data["primary_gradient"]["from"]) ? $apress_data["primary_gradient"]["from"] : '#5295ea';
		$primary_gradient_color_to = isset($apress_data["primary_gradient"]["to"]) ? $apress_data["primary_gradient"]["to"] : '#8b79db';
		
		$primary_color_bg = '
-moz-border-image: -moz-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
-webkit-border-image: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$primary_gradient_color_from.'), color-stop(100%, '.$primary_gradient_color_to.'));
-webkit-border-image: -webkit-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
-o-border-image: -o-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
-ms-border-image: -ms-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
border-image: linear-gradient(90deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$primary_gradient_color_from.', endColorstr='.$primary_gradient_color_to.',GradientType=1 );border-image-slice:1;';
		
	}else{
		$primary_color = isset($apress_data["primary_color"]) ? $apress_data["primary_color"] : '#549ffc';	
		$primary_color_bg = 'border-color:'.$primary_color.';';	
	}
	
	if( $key == 'default_button_color_scheme'){
			$key = isset($apress_data["button_color_scheme"]) ? $apress_data["button_color_scheme"] : 'primary_color_scheme';
		}else{
			$key = $key;
			}

	switch($key) {
		case 'primary_color_scheme': 
		//Color Scheme 1
			$output = $primary_color_bg;
			return $output;		
	
		break;
		
		case 'color_scheme1': 		
		//Color Scheme 1
			$color_scheme_1 = isset($apress_data["color_scheme_1"]) ? $apress_data["color_scheme_1"] : '#2e00af';
			$output = 'border-color:'.$color_scheme_1.';';
			return $output;
			
		break;
		
		case 'color_scheme2': 		
		//Color Scheme 2
			$color_scheme_2 = isset($apress_data["color_scheme_2"]) ? $apress_data["color_scheme_2"] : '#8b79db';
			$output = 'border-color:'.$color_scheme_2.';';
			return $output;
			
		break;
		
		case 'gradient_scheme1': 
		//Gradient Scheme 1
			$gradient_scheme_1_from = isset($apress_data["gradient_scheme_1"]["from"]) ? $apress_data["gradient_scheme_1"]["from"] : '#3452ff';
			$gradient_scheme_1_to = isset($apress_data["gradient_scheme_1"]["to"]) ? $apress_data["gradient_scheme_1"]["to"] : '#ff1053';
			
			$output = '
	-moz-border-image: -moz-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	-webkit-border-image: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$gradient_scheme_1_from.'), color-stop(100%, '.$gradient_scheme_1_to.'));
	-webkit-border-image: -webkit-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	-o-border-image: -o-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	-ms-border-image: -ms-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	border-image: linear-gradient(90deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$gradient_scheme_1_from.', endColorstr='.$gradient_scheme_1_to.',GradientType=1 ); 		border-image-slice:1;';	
				
			return $output;
			
			
		break;
		
		case 'gradient_scheme2': 		
		//Gradient Scheme 2
			$gradient_scheme_2_from = isset($apress_data["gradient_scheme_2"]["from"]) ? $apress_data["gradient_scheme_2"]["from"] : '#452998';
			$gradient_scheme_2_to = isset($apress_data["gradient_scheme_2"]["to"]) ? $apress_data["gradient_scheme_2"]["to"] : '#8601a8';
			
			$output = '
	-moz-border-image: -moz-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	-webkit-border-image: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$gradient_scheme_2_from.'), color-stop(100%, '.$gradient_scheme_2_to.'));
	-webkit-border-image: -webkit-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	-o-border-image: -o-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	-ms-border-image: -ms-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	border-image: linear-gradient(90deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$gradient_scheme_2_from.', endColorstr='.$gradient_scheme_2_to.',GradientType=1 ); border-image-slice:1;';	
				
			return $output;
			
		break;
		
		case 'gradient_scheme3': 
			
			//Gradient Scheme 2
			$gradient_scheme_3_from = isset($apress_data["gradient_scheme_3"]["from"]) ? $apress_data["gradient_scheme_3"]["from"] : '#452998';
			$gradient_scheme_3_to = isset($apress_data["gradient_scheme_3"]["to"]) ? $apress_data["gradient_scheme_3"]["to"] : '#8601a8';
			
			$output = '
	-moz-border-image: -moz-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	-webkit-border-image: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$gradient_scheme_3_from.'), color-stop(100%, '.$gradient_scheme_3_to.'));
	-webkit-border-image: -webkit-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	-o-border-image: -o-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	-ms-border-image: -ms-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	border-image: linear-gradient(90deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$gradient_scheme_3_from.', endColorstr='.$gradient_scheme_3_to.',GradientType=1 ); border-image-slice:1;';	
				
			return $output;
			
		break;
	}

}
}


//Color Scheme for theme Option
if ( !function_exists( 'apress_theme_button_background_color_scheme' ) ) {
function apress_theme_button_background_color_scheme(){
global $apress_data;

$key = isset($apress_data["button_color_scheme"]) ? $apress_data["button_color_scheme"] : 'primary_color_scheme';

$primary_color_option = isset($apress_data["primary_color_option"]) ? $apress_data["primary_color_option"] : 'color';
if($primary_color_option == 'gradient'){
	
		$primary_gradient_color_from = isset($apress_data["primary_gradient"]["from"]) ? $apress_data["primary_gradient"]["from"] : '#5295ea';
		$primary_gradient_color_to = isset($apress_data["primary_gradient"]["to"]) ? $apress_data["primary_gradient"]["to"] : '#8b79db';
		
		$primary_color_bg = 'background:'.$primary_gradient_color_from.';
background: -moz-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$primary_gradient_color_from.'), color-stop(100%, '.$primary_gradient_color_to.'));
background: -webkit-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
background: -o-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
background: -ms-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
background: linear-gradient(90deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$primary_gradient_color_from.', endColorstr='.$primary_gradient_color_to.',GradientType=1 );';
		
	}else{
		$primary_color = isset($apress_data["primary_color"]) ? $apress_data["primary_color"] : '#549ffc';	
		$primary_color_bg = 'background:'.$primary_color.';';	
	}
	

	switch($key) {
		case 'primary_color_scheme': 
		//Color Scheme 1
			$output = $primary_color_bg;
			return $output;		
	
		break;
		
		case 'color_scheme1': 		
		//Color Scheme 1
			$color_scheme_1 = isset($apress_data["color_scheme_1"]) ? $apress_data["color_scheme_1"] : '#2e00af';
			$output = 'background:'.$color_scheme_1.';';
			return $output;
			
		break;
		
		case 'color_scheme2': 		
		//Color Scheme 2
			$color_scheme_2 = isset($apress_data["color_scheme_2"]) ? $apress_data["color_scheme_2"] : '#8b79db';
			$output = 'background:'.$color_scheme_2.';';
			return $output;
			
		break;
		
		case 'gradient_scheme1': 
		//Gradient Scheme 1
			$gradient_scheme_1_from = isset($apress_data["gradient_scheme_1"]["from"]) ? $apress_data["gradient_scheme_1"]["from"] : '#3452ff';
			$gradient_scheme_1_to = isset($apress_data["gradient_scheme_1"]["to"]) ? $apress_data["gradient_scheme_1"]["to"] : '#ff1053';
			
			$output = 'background:'.$gradient_scheme_1_from.';
	background: -moz-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$gradient_scheme_1_from.'), color-stop(100%, '.$gradient_scheme_1_to.'));
	background: -webkit-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	background: -o-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	background: linear-gradient(90deg, '.$gradient_scheme_1_from.' 0%, '.$gradient_scheme_1_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$gradient_scheme_1_from.', endColorstr='.$gradient_scheme_1_to.',GradientType=1 );';
				
			return $output;
			
			
		break;
		
		case 'gradient_scheme2': 		
		//Gradient Scheme 2
			$gradient_scheme_2_from = isset($apress_data["gradient_scheme_2"]["from"]) ? $apress_data["gradient_scheme_2"]["from"] : '#452998';
			$gradient_scheme_2_to = isset($apress_data["gradient_scheme_2"]["to"]) ? $apress_data["gradient_scheme_2"]["to"] : '#8601a8';
			
			$output = 'background:'.$gradient_scheme_2_from.';
	background: -moz-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$gradient_scheme_2_from.'), color-stop(100%, '.$gradient_scheme_2_to.'));
	background: -webkit-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	background: -o-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	background: linear-gradient(90deg, '.$gradient_scheme_2_from.' 0%, '.$gradient_scheme_2_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$gradient_scheme_2_from.', endColorstr='.$gradient_scheme_2_to.',GradientType=1 );';
				
			return $output;
			
		break;
		
		case 'gradient_scheme3': 
			
			//Gradient Scheme 2
			$gradient_scheme_3_from = isset($apress_data["gradient_scheme_3"]["from"]) ? $apress_data["gradient_scheme_3"]["from"] : '#452998';
			$gradient_scheme_3_to = isset($apress_data["gradient_scheme_3"]["to"]) ? $apress_data["gradient_scheme_3"]["to"] : '#8601a8';
			
			$output = 'background:'.$gradient_scheme_3_from.';
	background: -moz-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$gradient_scheme_3_from.'), color-stop(100%, '.$gradient_scheme_3_to.'));
	background: -webkit-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	background: -o-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	background: linear-gradient(90deg, '.$gradient_scheme_3_from.' 0%, '.$gradient_scheme_3_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$gradient_scheme_3_from.', endColorstr='.$gradient_scheme_3_to.',GradientType=1 );';
				
			return $output;
			
		break;
	}
}
}


//Primary Color for background
if ( !function_exists( 'apress_theme_primary_background_color' ) ) {
	function apress_theme_primary_background_color(){
	global $apress_data;
	
	$primary_color_option = isset($apress_data["primary_color_option"]) ? $apress_data["primary_color_option"] : 'color';
	
		if($primary_color_option == 'gradient'){
			$primary_gradient_color_from = isset($apress_data["primary_gradient"]["from"]) ? $apress_data["primary_gradient"]["from"] : '#5295ea';
			$primary_gradient_color_to = isset($apress_data["primary_gradient"]["to"]) ? $apress_data["primary_gradient"]["to"] : '#8b79db';
			
			$primary_color_bg = 'background:'.$primary_gradient_color_from.';
			background: -moz-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$primary_gradient_color_from.'), color-stop(100%, '.$primary_gradient_color_to.'));
			background: -webkit-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			background: -o-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			background: -ms-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			background: linear-gradient(90deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$primary_gradient_color_from.', endColorstr='.$primary_gradient_color_to.',GradientType=1 );';		
		}else{
			$primary_color = isset($apress_data["primary_color"]) ? $apress_data["primary_color"] : '#549ffc';	
			$primary_color_bg = 'background:'.$primary_color.';';	
		}
		
	return $primary_color_bg;
		
		
	}
}

//Primary Color for Text 
if ( !function_exists( 'apress_theme_primary_text_color' ) ) {
	function apress_theme_primary_text_color(){
	global $apress_data;
	
	$primary_color_option = isset($apress_data["primary_color_option"]) ? $apress_data["primary_color_option"] : 'color';
	
		if($primary_color_option == 'gradient'){
			$primary_gradient_color_from = isset($apress_data["primary_gradient"]["from"]) ? $apress_data["primary_gradient"]["from"] : '#5295ea';
			$primary_gradient_color_to = isset($apress_data["primary_gradient"]["to"]) ? $apress_data["primary_gradient"]["to"] : '#8b79db';
			
			if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/(?i)msie|trident|edge/",$_SERVER['HTTP_USER_AGENT'])) {
				$primary_text_color = 'color:'.$primary_gradient_color_from.';';
			}else{
			$primary_text_color = 'background:'.$primary_gradient_color_from.';
			background: -moz-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$primary_gradient_color_from.'), color-stop(100%, '.$primary_gradient_color_to.'));
			background: -webkit-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			background: -o-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			background: -ms-linear-gradient(0deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			background: linear-gradient(90deg, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$primary_gradient_color_from.', endColorstr='.$primary_gradient_color_to.',GradientType=1 );
			-webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;';	
			}
		}else{
			$primary_color = isset($apress_data["primary_color"]) ? $apress_data["primary_color"] : '#549ffc';	
			$primary_text_color = 'color:'.$primary_color.';';	
		}
		
	return $primary_text_color;
		
		
	}
}

//Primary Color for Border
if ( !function_exists( 'apress_theme_primary_border_color' ) ) {
function apress_theme_primary_border_color(){
global $apress_data;

$primary_color_option = isset($apress_data["primary_color_option"]) ? $apress_data["primary_color_option"] : 'color';
if($primary_color_option == 'gradient'){
	
		$primary_gradient_color_from = isset($apress_data["primary_gradient"]["from"]) ? $apress_data["primary_gradient"]["from"] : '#5295ea';
		$primary_gradient_color_to = isset($apress_data["primary_gradient"]["to"]) ? $apress_data["primary_gradient"]["to"] : '#8b79db';
		
		$primary_border_color = '
								-moz-border-image: -moz-linear-gradient(left, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
								-webkit-border-image: -webkit-linear-gradient(left, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
								-o-border-image: -o-linear-gradient(left, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
								-ms-border-image: -ms-linear-gradient(left, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
								border-image: linear-gradient(to right, '.$primary_gradient_color_from.' 0%, '.$primary_gradient_color_to.' 100%);
								border-image-slice:1;';
		
	}else{
		$primary_color = isset($apress_data["primary_color"]) ? $apress_data["primary_color"] : '#549ffc';	
		$primary_border_color = 'border-color:'.$primary_color.';';	
	}
	return $primary_border_color;
}
}

//Link Color for Text 
if ( !function_exists( 'apress_theme_link_text_color' ) ) {
	function apress_theme_link_text_color(){
	global $apress_data;
	
	$body_link_hover_color_option = isset($apress_data["body_link_hover_color_option"]) ? $apress_data["body_link_hover_color_option"] : 'color';
	
	if($body_link_hover_color_option == 'gradient'){
			$link_hover_gradient_from = isset($apress_data["link_hover_gradient"]["from"]) ? $apress_data["link_hover_gradient"]["from"] : '#5295ea';
			$link_hover_gradient_to = isset($apress_data["link_hover_gradient"]["to"]) ? $apress_data["link_hover_gradient"]["to"] : '#8b79db';
		
		if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/(?i)msie|trident|edge/",$_SERVER['HTTP_USER_AGENT'])) {
			//Internet Explorer Code
			$output = 'color: '.$link_hover_gradient_from.';';
		}else{
			//Other Browser Code
			$output = 'background:'.$link_hover_gradient_from.';
						background: -moz-linear-gradient(0deg, '.$link_hover_gradient_from.' 0%, '.$link_hover_gradient_to.' 100%);
						background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$link_hover_gradient_from.'), color-stop(100%, '.$link_hover_gradient_to.'));
						background: -webkit-linear-gradient(0deg, '.$link_hover_gradient_from.' 0%, '.$link_hover_gradient_to.' 100%);
						background: -o-linear-gradient(0deg, '.$link_hover_gradient_from.' 0%, '.$link_hover_gradient_to.' 100%);
						background: -ms-linear-gradient(0deg, '.$link_hover_gradient_from.' 0%, '.$link_hover_gradient_to.' 100%);
						background: linear-gradient(90deg, '.$link_hover_gradient_from.' 0%, '.$link_hover_gradient_to.' 100%);
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$link_hover_gradient_from.', endColorstr='.$link_hover_gradient_to.',GradientType=1 );
						color: transparent;-webkit-background-clip: text;background-clip: text;';		
		}
	}else{
			$body_link_hover_color = isset($apress_data["body_link_hover_color"]) ? $apress_data["body_link_hover_color"] : '#333333';
			$output = 'color:'.$body_link_hover_color.';';
	}
		
	return $output;
	}
}

//Link Color for Border
if ( !function_exists( 'apress_theme_link_border_color' ) ) {
function apress_theme_link_border_color(){
global $apress_data;

$body_link_hover_color_option = isset($apress_data["body_link_hover_color_option"]) ? $apress_data["body_link_hover_color_option"] : 'color';
if($body_link_hover_color_option == 'gradient'){
	
		$link_hover_gradient_from = isset($apress_data["link_hover_gradient"]["from"]) ? $apress_data["link_hover_gradient"]["from"] : '#5295ea';
		$link_hover_gradient_to = isset($apress_data["link_hover_gradient"]["to"]) ? $apress_data["link_hover_gradient"]["to"] : '#8b79db';
		
		$output = '-moz-border-image: -moz-linear-gradient(left, '.$link_hover_gradient_from.' 0%, '.$link_hover_gradient_to.' 100%);
				-webkit-border-image: -webkit-linear-gradient(left, '.$link_hover_gradient_from.' 0%, '.$link_hover_gradient_to.' 100%);
				-o-border-image: -o-linear-gradient(left, '.$link_hover_gradient_from.' 0%, '.$link_hover_gradient_to.' 100%);
				-ms-border-image: -ms-linear-gradient(left, '.$link_hover_gradient_from.' 0%, '.$link_hover_gradient_to.' 100%);
				border-image: linear-gradient(to right, '.$link_hover_gradient_from.' 0%, '.$link_hover_gradient_to.' 100%);
				border-image-slice:1;';
		
	}else{
		$body_link_hover_color = isset($apress_data["body_link_hover_color"]) ? $apress_data["body_link_hover_color"] : '#333333';
		$output = 'border-color:'.$body_link_hover_color.';';	
	}
	return $output;
}
}


//Sticky Header Font Hover Color
if ( !function_exists( 'apress_theme_sticky_header_hover_color' ) ) {
	function apress_theme_sticky_header_hover_color(){
	global $apress_data;
	
	$sticky_header_font_hover_color_option = isset($apress_data["sticky_header_font_hover_color_option"]) ? $apress_data["sticky_header_font_hover_color_option"] : 'color';
	
	if($sticky_header_font_hover_color_option == 'gradient'){
			$sticky_header_hover_gradient_from = isset($apress_data["sticky_header_font_hover_gradient"]["from"]) ? $apress_data["sticky_header_font_hover_gradient"]["from"] : '#5295ea';
			$sticky_header_hover_gradient_to = isset($apress_data["sticky_header_font_hover_gradient"]["to"]) ? $apress_data["sticky_header_font_hover_gradient"]["to"] : '#8b79db';
		
		if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/(?i)msie|trident|edge/",$_SERVER['HTTP_USER_AGENT'])) {
			//Internet Explorer Code
			$output = 'color: '.$sticky_header_hover_gradient_from.';';
		}else{
			//Other Browser Code
			$output = 'background:'.$sticky_header_hover_gradient_from.';
						background: -moz-linear-gradient(0deg, '.$sticky_header_hover_gradient_from.' 0%, '.$sticky_header_hover_gradient_to.' 100%);
						background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$sticky_header_hover_gradient_from.'), color-stop(100%, '.$sticky_header_hover_gradient_to.'));
						background: -webkit-linear-gradient(0deg, '.$sticky_header_hover_gradient_from.' 0%, '.$sticky_header_hover_gradient_to.' 100%);
						background: -o-linear-gradient(0deg, '.$sticky_header_hover_gradient_from.' 0%, '.$sticky_header_hover_gradient_to.' 100%);
						background: -ms-linear-gradient(0deg, '.$sticky_header_hover_gradient_from.' 0%, '.$sticky_header_hover_gradient_to.' 100%);
						background: linear-gradient(90deg, '.$sticky_header_hover_gradient_from.' 0%, '.$sticky_header_hover_gradient_to.' 100%);
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$sticky_header_hover_gradient_from.', endColorstr='.$sticky_header_hover_gradient_to.',GradientType=1 );
						color: transparent;-webkit-background-clip: text;background-clip: text;';		
		}
	}else{
			$sticky_header_font_hover_color = isset($apress_data["sticky_header_font_hover_color"]) ? $apress_data["sticky_header_font_hover_color"] : '#999999';
			$output = 'color:'.$sticky_header_font_hover_color.';';
	}
		
	return $output;
	}
}


//Main Menu Font Hover Color
if ( !function_exists( 'apress_theme_main_menu_hover_color' ) ) {
	function apress_theme_main_menu_hover_color(){
	global $apress_data;
	
	$menu_first_level_hover_color_option = isset($apress_data["menu_first_level_hover_color_option"]) ? $apress_data["menu_first_level_hover_color_option"] : 'color';
	
	if($menu_first_level_hover_color_option == 'gradient'){
			$menu_first_level_hover_gradient_from = isset($apress_data["menu_first_level_hover_gradient"]["from"]) ? $apress_data["menu_first_level_hover_gradient"]["from"] : '#5295ea';
			$menu_first_level_hover_gradient_to = isset($apress_data["menu_first_level_hover_gradient"]["to"]) ? $apress_data["menu_first_level_hover_gradient"]["to"] : '#8b79db';
		
		if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/(?i)msie|trident|edge/",$_SERVER['HTTP_USER_AGENT'])) {
			//Internet Explorer Code
			$output = 'color: '.$menu_first_level_hover_gradient_from.';';
		}else{
			//Other Browser Code
			$output = 'background:'.$menu_first_level_hover_gradient_from.';
						background: -moz-linear-gradient(0deg, '.$menu_first_level_hover_gradient_from.' 0%, '.$menu_first_level_hover_gradient_to.' 100%);
						background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$menu_first_level_hover_gradient_from.'), color-stop(100%, '.$menu_first_level_hover_gradient_to.'));
						background: -webkit-linear-gradient(0deg, '.$menu_first_level_hover_gradient_from.' 0%, '.$menu_first_level_hover_gradient_to.' 100%);
						background: -o-linear-gradient(0deg, '.$menu_first_level_hover_gradient_from.' 0%, '.$menu_first_level_hover_gradient_to.' 100%);
						background: -ms-linear-gradient(0deg, '.$menu_first_level_hover_gradient_from.' 0%, '.$menu_first_level_hover_gradient_to.' 100%);
						background: linear-gradient(90deg, '.$menu_first_level_hover_gradient_from.' 0%, '.$menu_first_level_hover_gradient_to.' 100%);
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$menu_first_level_hover_gradient_from.', endColorstr='.$menu_first_level_hover_gradient_to.',GradientType=1 );
						color: transparent;-webkit-background-clip: text;background-clip: text;';		
		}
	}else{
			$menu_first_level_hover_color = isset($apress_data["menu_first_level_hover_color"]) ? $apress_data["menu_first_level_hover_color"] : '#999999';
			$output = 'color:'.$menu_first_level_hover_color.';';
	}
		
	return $output;
	}
}

//Menu Font Hover Color - Sublevels
if ( !function_exists( 'apress_theme_submenu_hover_color' ) ) {
	function apress_theme_submenu_hover_color(){
	global $apress_data;
	
	$submenu_font_hover_color_option = isset($apress_data["submenu_font_hover_color_option"]) ? $apress_data["submenu_font_hover_color_option"] : 'color';
	
	if($submenu_font_hover_color_option == 'gradient'){
			$submenu_font_hover_gradient_from = isset($apress_data["submenu_font_hover_gradient"]["from"]) ? $apress_data["submenu_font_hover_gradient"]["from"] : '#5295ea';
			$submenu_font_hover_gradient_to = isset($apress_data["submenu_font_hover_gradient"]["to"]) ? $apress_data["submenu_font_hover_gradient"]["to"] : '#8b79db';
		
		if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/(?i)msie|trident|edge/",$_SERVER['HTTP_USER_AGENT'])) {
			//Internet Explorer Code
			$output = 'color: '.$submenu_font_hover_gradient_from.';';
		}else{
			//Other Browser Code
			$output = 'background:'.$submenu_font_hover_gradient_from.';
						background: -moz-linear-gradient(0deg, '.$submenu_font_hover_gradient_from.' 0%, '.$submenu_font_hover_gradient_to.' 100%);
						background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$submenu_font_hover_gradient_from.'), color-stop(100%, '.$submenu_font_hover_gradient_to.'));
						background: -webkit-linear-gradient(0deg, '.$submenu_font_hover_gradient_from.' 0%, '.$submenu_font_hover_gradient_to.' 100%);
						background: -o-linear-gradient(0deg, '.$submenu_font_hover_gradient_from.' 0%, '.$submenu_font_hover_gradient_to.' 100%);
						background: -ms-linear-gradient(0deg, '.$submenu_font_hover_gradient_from.' 0%, '.$submenu_font_hover_gradient_to.' 100%);
						background: linear-gradient(90deg, '.$submenu_font_hover_gradient_from.' 0%, '.$submenu_font_hover_gradient_to.' 100%);
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$submenu_font_hover_gradient_from.', endColorstr='.$submenu_font_hover_gradient_to.',GradientType=1 );
						color: transparent;-webkit-background-clip: text;background-clip: text;';		
		}
	}else{
			$submenu_font_hover_color = isset($apress_data["submenu_font_hover_color"]) ? $apress_data["submenu_font_hover_color"] : '#999999';
			$output = 'color:'.$submenu_font_hover_color.';';
	}
		
	return $output;
	}
}




//Pre Loader background
if ( !function_exists( 'apress_theme_preloader_bg_color' ) ) {
function apress_theme_preloader_bg_color(){
global $apress_data;

	$preloader_bg_color_option = isset($apress_data["preloader_bg_color_option"]) ? $apress_data["preloader_bg_color_option"] : 'color';
	if($preloader_bg_color_option == 'gradient'){
		
			$preloader_bg_gradient_color_from = isset($apress_data["preloader_bg_gradient"]["from"]) ? $apress_data["preloader_bg_gradient"]["from"] : '#5295ea';
			$preloader_bg_gradient_color_to = isset($apress_data["preloader_bg_gradient"]["to"]) ? $apress_data["preloader_bg_gradient"]["to"] : '#8b79db';
			
			$output = 'background:'.$preloader_bg_gradient_color_from.';
	background: -moz-linear-gradient(0deg, '.$preloader_bg_gradient_color_from.' 0%, '.$preloader_bg_gradient_color_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$preloader_bg_gradient_color_from.'), color-stop(100%, '.$preloader_bg_gradient_color_to.'));
	background: -webkit-linear-gradient(0deg, '.$preloader_bg_gradient_color_from.' 0%, '.$preloader_bg_gradient_color_to.' 100%);
	background: -o-linear-gradient(0deg, '.$preloader_bg_gradient_color_from.' 0%, '.$preloader_bg_gradient_color_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$preloader_bg_gradient_color_from.' 0%, '.$preloader_bg_gradient_color_to.' 100%);
	background: linear-gradient(90deg, '.$preloader_bg_gradient_color_from.' 0%, '.$preloader_bg_gradient_color_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$preloader_bg_gradient_color_from.', endColorstr='.$preloader_bg_gradient_color_to.',GradientType=1 );';		
		}else{
			$preloader_bg_color = isset($apress_data["preloader_bg_color"]) ? $apress_data["preloader_bg_color"] : '#ffffff';	
			$output = 'background:'.$preloader_bg_color.';';	
		}
		return $output;
	}
}

//Header TopBar background
if ( !function_exists( 'apress_theme_header_top_bg_color' ) ) {
function apress_theme_header_top_bg_color(){
global $apress_data;

	$header_top_bg_color_option = isset($apress_data["header_top_bg_color_option"]) ? $apress_data["header_top_bg_color_option"] : 'color';
	if($header_top_bg_color_option == 'gradient'){
		
			$header_top_bg_gradient_color_from = isset($apress_data["header_top_bg_gradient"]["from"]) ? $apress_data["header_top_bg_gradient"]["from"] : '#5295ea';
			$header_top_bg_gradient_color_to = isset($apress_data["header_top_bg_gradient"]["to"]) ? $apress_data["header_top_bg_gradient"]["to"] : '#8b79db';
			
			$output = 'background:'.$header_top_bg_gradient_color_from.';
	background: -moz-linear-gradient(0deg, '.$header_top_bg_gradient_color_from.' 0%, '.$header_top_bg_gradient_color_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$header_top_bg_gradient_color_from.'), color-stop(100%, '.$header_top_bg_gradient_color_to.'));
	background: -webkit-linear-gradient(0deg, '.$header_top_bg_gradient_color_from.' 0%, '.$header_top_bg_gradient_color_to.' 100%);
	background: -o-linear-gradient(0deg, '.$header_top_bg_gradient_color_from.' 0%, '.$header_top_bg_gradient_color_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$header_top_bg_gradient_color_from.' 0%, '.$header_top_bg_gradient_color_to.' 100%);
	background: linear-gradient(90deg, '.$header_top_bg_gradient_color_from.' 0%, '.$header_top_bg_gradient_color_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$header_top_bg_gradient_color_from.', endColorstr='.$header_top_bg_gradient_color_to.',GradientType=1 );';		
		}else{
			$header_top_bg_color = isset($apress_data["header_top_bg_color"]) ? $apress_data["header_top_bg_color"] : 'rgba(255,255,255,0.0)';	
			$output = 'background:'.$header_top_bg_color.';';	
		}
		return $output;
	}
}
//Header Section Two background
if ( !function_exists( 'apress_theme_section2_header_bg_color' ) ) {
function apress_theme_section2_header_bg_color(){
global $apress_data;

	$section2_header_bg_color_option = isset($apress_data["section2_header_bg_color_option"]) ? $apress_data["section2_header_bg_color_option"] : 'color';
	if($section2_header_bg_color_option == 'gradient'){
		
		$section2_header_bg_gradient_color_from = isset($apress_data["section2_header_bg_gradient"]["from"]) ? $apress_data["section2_header_bg_gradient"]["from"] : '#5295ea';
		$section2_header_bg_gradient_color_to = isset($apress_data["section2_header_bg_gradient"]["to"]) ? $apress_data["section2_header_bg_gradient"]["to"] : '#8b79db';
			
			$output = 'background:'.$section2_header_bg_gradient_color_from.';
	background: -moz-linear-gradient(0deg, '.$section2_header_bg_gradient_color_from.' 0%, '.$section2_header_bg_gradient_color_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$section2_header_bg_gradient_color_from.'), color-stop(100%, '.$section2_header_bg_gradient_color_to.'));
	background: -webkit-linear-gradient(0deg, '.$section2_header_bg_gradient_color_from.' 0%, '.$section2_header_bg_gradient_color_to.' 100%);
	background: -o-linear-gradient(0deg, '.$section2_header_bg_gradient_color_from.' 0%, '.$section2_header_bg_gradient_color_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$section2_header_bg_gradient_color_from.' 0%, '.$section2_header_bg_gradient_color_to.' 100%);
	background: linear-gradient(90deg, '.$section2_header_bg_gradient_color_from.' 0%, '.$section2_header_bg_gradient_color_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$section2_header_bg_gradient_color_from.', endColorstr='.$section2_header_bg_gradient_color_to.',GradientType=1 );';		
		}else{
			$header_bg_color = isset($apress_data["header_bg_color"]) ? $apress_data["header_bg_color"] : 'rgba(255,255,255,0.0)';
			$output = 'background-color:'.$header_bg_color.';';	
		}
		return $output;
	}
}
//Header Section Three background
if ( !function_exists( 'apress_theme_section3_header_bg_color' ) ) {
function apress_theme_section3_header_bg_color(){
global $apress_data;

	$section3_header_bg_color_option = isset($apress_data["section3_header_bg_color_option"]) ? $apress_data["section3_header_bg_color_option"] : 'color';
	if($section3_header_bg_color_option == 'gradient'){
		
		$section3_header_bg_gradient_color_from = isset($apress_data["section3_header_bg_gradient"]["from"]) ? $apress_data["section3_header_bg_gradient"]["from"] : '#5295ea';
		$section3_header_bg_gradient_color_to = isset($apress_data["section3_header_bg_gradient"]["to"]) ? $apress_data["section3_header_bg_gradient"]["to"] : '#8b79db';
			
			$output = 'background:'.$section3_header_bg_gradient_color_from.';
	background: -moz-linear-gradient(0deg, '.$section3_header_bg_gradient_color_from.' 0%, '.$section3_header_bg_gradient_color_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$section3_header_bg_gradient_color_from.'), color-stop(100%, '.$section3_header_bg_gradient_color_to.'));
	background: -webkit-linear-gradient(0deg, '.$section3_header_bg_gradient_color_from.' 0%, '.$section3_header_bg_gradient_color_to.' 100%);
	background: -o-linear-gradient(0deg, '.$section3_header_bg_gradient_color_from.' 0%, '.$section3_header_bg_gradient_color_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$section3_header_bg_gradient_color_from.' 0%, '.$section3_header_bg_gradient_color_to.' 100%);
	background: linear-gradient(90deg, '.$section3_header_bg_gradient_color_from.' 0%, '.$section3_header_bg_gradient_color_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$section3_header_bg_gradient_color_from.', endColorstr='.$section3_header_bg_gradient_color_to.',GradientType=1 );';		
		}else{
			$navbar_bg_color = isset($apress_data["navbar_bg_color"]) ? $apress_data["navbar_bg_color"] : 'rgba(255,255,255,0.0)';
			$output = 'background-color:'.$navbar_bg_color.';';	
		}
		return $output;
	}
}

//Sticky Header background
if ( !function_exists( 'apress_theme_sticky_header_bg_color' ) ) {
function apress_theme_sticky_header_bg_color(){
global $apress_data;

	$sticky_header_bg_color_option = isset($apress_data["sticky_header_bg_color_option"]) ? $apress_data["sticky_header_bg_color_option"] : 'color';
	if($sticky_header_bg_color_option == 'gradient'){
		
		$sticky_header_bg_gradient_color_from = isset($apress_data["sticky_header_bg_gradient"]["from"]) ? $apress_data["sticky_header_bg_gradient"]["from"] : '#5295ea';
		$sticky_header_bg_gradient_color_to = isset($apress_data["sticky_header_bg_gradient"]["to"]) ? $apress_data["sticky_header_bg_gradient"]["to"] : '#8b79db';
			
			$output = 'background:'.$sticky_header_bg_gradient_color_from.';
	background: -moz-linear-gradient(0deg, '.$sticky_header_bg_gradient_color_from.' 0%, '.$sticky_header_bg_gradient_color_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$sticky_header_bg_gradient_color_from.'), color-stop(100%, '.$sticky_header_bg_gradient_color_to.'));
	background: -webkit-linear-gradient(0deg, '.$sticky_header_bg_gradient_color_from.' 0%, '.$sticky_header_bg_gradient_color_to.' 100%);
	background: -o-linear-gradient(0deg, '.$sticky_header_bg_gradient_color_from.' 0%, '.$sticky_header_bg_gradient_color_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$sticky_header_bg_gradient_color_from.' 0%, '.$sticky_header_bg_gradient_color_to.' 100%);
	background: linear-gradient(90deg, '.$sticky_header_bg_gradient_color_from.' 0%, '.$sticky_header_bg_gradient_color_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$sticky_header_bg_gradient_color_from.', endColorstr='.$sticky_header_bg_gradient_color_to.',GradientType=1 );';		
		}else{
			$header_sticky_bg_color = isset($apress_data["header_sticky_bg_color"]) ? $apress_data["header_sticky_bg_color"] : '#ffffff';
			$output = 'background:'.$header_sticky_bg_color.';';
		}
		return $output;
	}
}

//Mobile Header background
if ( !function_exists( 'apress_theme_mobile_header_bg_color' ) ) {
function apress_theme_mobile_header_bg_color(){
global $apress_data;

	$mobile_header_bg_color_option = isset($apress_data["mobile_header_bg_color_option"]) ? $apress_data["mobile_header_bg_color_option"] : 'color';
	if($mobile_header_bg_color_option == 'gradient'){
		
		$mobile_header_bg_gradient_color_from = isset($apress_data["mobile_header_bg_gradient"]["from"]) ? $apress_data["mobile_header_bg_gradient"]["from"] : '#5295ea';
		$mobile_header_bg_gradient_color_to = isset($apress_data["mobile_header_bg_gradient"]["to"]) ? $apress_data["mobile_header_bg_gradient"]["to"] : '#8b79db';
			
			$output = 'background:'.$mobile_header_bg_gradient_color_from.';
	background: -moz-linear-gradient(0deg, '.$mobile_header_bg_gradient_color_from.' 0%, '.$mobile_header_bg_gradient_color_to.' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%, '.$mobile_header_bg_gradient_color_from.'), color-stop(100%, '.$mobile_header_bg_gradient_color_to.'));
	background: -webkit-linear-gradient(0deg, '.$mobile_header_bg_gradient_color_from.' 0%, '.$mobile_header_bg_gradient_color_to.' 100%);
	background: -o-linear-gradient(0deg, '.$mobile_header_bg_gradient_color_from.' 0%, '.$mobile_header_bg_gradient_color_to.' 100%);
	background: -ms-linear-gradient(0deg, '.$mobile_header_bg_gradient_color_from.' 0%, '.$mobile_header_bg_gradient_color_to.' 100%);
	background: linear-gradient(90deg, '.$mobile_header_bg_gradient_color_from.' 0%, '.$mobile_header_bg_gradient_color_to.' 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$mobile_header_bg_gradient_color_from.', endColorstr='.$mobile_header_bg_gradient_color_to.',GradientType=1 );';		
		}else{
			$mobile_header_background_color = isset($apress_data["mobile_header_background_color"]) ? $apress_data["mobile_header_background_color"] : '#ffffff';
			$output = 'background:'.$mobile_header_background_color.';';
		}
		return $output;
	}
}


/*****************************************************
  PhotoSwipe Gallery Markup
*****************************************************/
if (!function_exists('apress_photoswipe_wrapper')) {
	
	function apress_photoswipe_wrapper( $atts ) { 
	global $apress_data;
	$lightbox_style = isset($apress_data["lightbox_style"]) ? $apress_data["lightbox_style"] : 'lightbox-none';		
	if($lightbox_style == 'photo-swipe-gallery'){
	echo '<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">		
		<div class="pswp__bg"></div>		
		<div class="pswp__scroll-wrap">		
			<div class="pswp__container">
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
			</div>		
			<div class="pswp__ui pswp__ui--hidden">		
				<div class="pswp__top-bar">		
					<!--  Controls are self-explanatory. Order can be changed. -->		
					<div class="pswp__counter"></div>		
					<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>		
					<button class="pswp__button pswp__button--share" title="Share"></button>		
					<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>		
					<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>		
					<div class="pswp__preloader">
						<div class="pswp__preloader__icn">
						  <div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						  </div>
						</div>
					</div>
				</div>		
				<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
					<div class="pswp__share-tooltip"></div> 
				</div>		
				<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
				</button>		
				<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
				</button>		
				<div class="pswp__caption">
					<div class="pswp__caption__center"></div>
				</div>		
			</div>		
		</div>		
		</div>
	' ;
	}
}
add_action('wp_footer','apress_photoswipe_wrapper');
}

/*****************************************************
  Apress Theme Option PHP Shortcode
*****************************************************/
function apress_execute_text_php($html){
	if(strpos($html,"<"."?php")!==false){
		ob_start();
		eval("?".">".$html);
		$html=ob_get_contents();
		ob_end_clean();
	}
	return $html;
}

// Helper Function ---------------------------------------

if( ! function_exists( 'apcore_action' ) ) :
	function apcore_action() {

		$args   = func_get_args();

		if( !isset( $args[0] ) || empty( $args[0] ) ) {
			return;
		}

		$action = 'apcore_' . $args[0];
		
		unset( $args[0] );

		do_action_ref_array( $action, $args );
	}
endif;
