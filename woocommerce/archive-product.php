<?php
	/**
	 * The Template for displaying product archives, including the main shop page which is a post type archive.
	 *
	 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
	 *
	 * @author 		WooThemes
	 * @package 	WooCommerce/Templates
	 * @version     2.0.0
	 */

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $ss_theme_options;

	$sidebar_config = $ss_theme_options['woo_sidebar_config'];
	$left_sidebar 	= $ss_theme_options['woo_left_sidebar'];
	$right_sidebar 	= $ss_theme_options['woo_right_sidebar'];
	$product_display_columns = $ss_theme_options['product_display_columns'];
	$product_display_type = $ss_theme_options['product_display_layout'];

	$width = "";

	if ($product_display_columns == "4") {
		$width = 'col-sm-3';
	} else if ($product_display_columns == "3") {
		$width = 'col-sm-4';
	} else if ($product_display_columns == "2") {
		$width = 'col-sm-6';
	} else if ($product_display_columns == "1") {
		$width = 'col-sm-12';
	}

	$page_class = $content_class = $cont_width = $sidebar_width = $cont_push = $sidebar_pull = '';
	$page_wrap_class = "woocommerce-shop-page ";

	$cont_width = "col-sm-9";
	$cont_push = "col-sm-push-3";
	$sidebar_width = "col-sm-3";
	$sidebar_pull = "col-sm-pull-9";

	if ($sidebar_config == "left-sidebar") {
		$page_wrap_class .= 'has-left-sidebar has-one-sidebar row';
		$page_class = $cont_width ." ".$cont_push." clearfix";
		$content_class = "clearfix";
	} else if ($sidebar_config == "right-sidebar") {
		$page_wrap_class .= 'has-right-sidebar has-one-sidebar row';
		$page_class = $cont_width . " clearfix";
		$content_class = "clearfix";
	} else {
		$page_wrap_class .= 'has-no-sidebar';
		$page_class = "row clearfix";
		$content_class = "col-sm-12 clearfix";
	}

	$content_class .= ' product-type-'. $product_display_type;

	get_header( 'shop' ); 
?>
	<div class="container">
		<?php
			/**
			 * woocommerce_before_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			do_action('woocommerce_before_main_content');
		?>
		<div class="inner-page-wrap <?php echo esc_attr($page_wrap_class); ?> clearfix" data-shopcolumns="<?php echo esc_attr($product_display_columns); ?>">

			
				
			

			<!-- OPEN section -->
			<section class="<?php echo esc_attr($page_class); ?>">
				<div class="shop-filter-wrap">
						<div class="col-sm-12">
							<?php
							/**
							 * woocommerce_before_shop_loop hook
							 *
							 * @hooked ss_shop_layout_opts - 10
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );
							?>
						</div>
					</div>
				<!-- OPEN .page-content -->
				<div class="page-content <?php echo esc_attr($content_class); ?>">
					<?php do_action( 'woocommerce_archive_description' ); ?>

					

					<?php if ( have_posts() ) : ?>
						<!-- LOOP START -->
						<?php woocommerce_product_loop_start(); ?>
						<?php woocommerce_product_subcategories(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>


						<!-- LOOP END -->
						<?php woocommerce_product_loop_end(); ?>


						<?php
						/**
						 * woocommerce_after_shop_loop hook
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
						?>

					<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

						<div class="no-products-wrap container">
							<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
						</div>

					<?php endif; ?>

				<!-- CLOSE .page-content -->
				</div>

			<!-- CLOSE section -->
			</section>

			<?php if ($sidebar_config == "left-sidebar") { ?>

			<aside class="sidebar left-sidebar <?php echo esc_attr($sidebar_width); ?> <?php echo esc_attr($sidebar_pull); ?>">

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
<?php get_footer( 'shop' ); ?>