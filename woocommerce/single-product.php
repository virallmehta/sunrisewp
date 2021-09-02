<?php
	/**
	 * The Template for displaying all single products.
	 *
	 * Override this template by copying it to yourtheme/woocommerce/single-product.php
	 *
	 * @author 		WooThemes
	 * @package 	WooCommerce/Templates
	 * @version     1.6.4
	 */
 
 	global $ss_theme_options;

	$default_sidebar_config = $ss_theme_options['default_product_sidebar_config'];
	$default_left_sidebar = $ss_theme_options['default_product_left_sidebar'];
	$default_right_sidebar = $ss_theme_options['default_product_right_sidebar'];
	
	
	$sidebar_config = ss_get_post_meta($post->ID, 'ar_sidebar_config', true);
	$left_sidebar = ss_get_post_meta($post->ID, 'ar_left_sidebar', true);
	$right_sidebar = ss_get_post_meta($post->ID, 'ar_right_sidebar', true);
	
	if ($sidebar_config == "") {
		$sidebar_config = $default_sidebar_config;
	}
	if ($left_sidebar == "") {
		$left_sidebar = $default_left_sidebar;
	}
	if ($right_sidebar == "") {
		$right_sidebar = $default_right_sidebar;
	}
	
	//sf_set_sidebar_global($sidebar_config);
	
	$page_wrap_class = $cont_width = $sidebar_width = '';
	if ($sidebar_config == "left-sidebar") {
		$page_wrap_class = 'has-left-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "right-sidebar") {
		$page_wrap_class = 'has-right-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "both-sidebars") {
		$page_wrap_class = 'has-both-sidebars';
	} else {
		$page_wrap_class = 'has-no-sidebar';
	}
	
	$cont_width = "col-sm-9";
	$sidebar_width = "col-sm-3";
	
?>
<?php get_header('shop'); ?>

	<?php if (have_posts()) : the_post(); ?>
	<div class="container">
		<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
		?>
		<div class="inner-page-wrap <?php echo esc_attr($page_wrap_class); ?> clearfix">

			<!-- OPEN article -->
			<?php if ($sidebar_config == "left-sidebar") { ?>
			<article class="product-article clearfix <?php echo esc_attr($cont_width); ?>">
			<?php } else if ($sidebar_config == "right-sidebar") { ?>
			<article class="product-article clearfix <?php echo esc_attr($cont_width); ?>">
			<?php } else if ($sidebar_config == "no-sidebars") { ?>
			<article class="product-article">
			<?php } else { ?>
			<article class="product-article clearfix row">
			<?php } ?>

			<?php if ($sidebar_config == "no-sidebars") { ?>
				<div class="page-content col-sm-12 clearfix">
			<?php } else { ?>
				<div class="page-content clearfix">
			<?php } ?>
					<section class="article-body-wrap">
						
						<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
							
					</section>
				</div>

			<!-- CLOSE article -->
			</article>

			<?php if ($sidebar_config == "left-sidebar") { ?>
				
			<aside class="sidebar left-sidebar <?php echo esc_attr($sidebar_width); ?>">
				
				<div class="sidebar-widget-wrap">
					<?php dynamic_sidebar($left_sidebar); ?>
				</div>
				
			</aside>
	
			<?php } else if ($sidebar_config == "right-sidebar") { ?>
			
			<aside class="sidebar right-sidebar <?php echo esc_attr($sidebar_width); ?>">
				
				<div class="sidebar-widget-wrap">
					<?php dynamic_sidebar($right_sidebar); ?>
				</div>
		
			</aside>
			
			<?php } ?>

		</div>

		<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
		?>


	</div>
	<?php endif; ?>
<?php get_footer('shop'); ?>