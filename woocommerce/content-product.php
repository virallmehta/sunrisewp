<?php
	/**
	 * The template for displaying product content within loops.
	 *
	 * Override this template by copying it to yourtheme/woocommerce/content-product.php
	 *
	 * @author 		WooThemes
	 * @package 	WooCommerce/Templates
	 * @version     2.6.1
	 */

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $woocommerce, $post, $product, $woocommerce_loop, $ss_theme_options;

	$product_layout = $ss_theme_options['product_display_layout'];

	$figure_class = 'animated-overlay';

	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) )
		$woocommerce_loop['loop'] = 0;

	// Store column count for displaying the grid
	if ( is_shop() || is_product_category() || is_product_tag() ) {
		$product_display_columns = $ss_theme_options['product_display_columns'];

		// COLUMNS GET VARIABLE
		if (isset($_GET['product_columns'])) {
			$product_display_columns = $_GET['product_columns'];
		}
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $product_display_columns );
	}

	if ( empty( $woocommerce_loop['columns'] ) ) {
		$product_display_columns = $ss_theme_options['product_display_columns'];

		// COLUMNS GET VARIABLE
		if (isset($_GET['product_columns'])) {
			$product_display_columns = $_GET['product_columns'];
		}
		
		if ( $product_display_columns != "" ) {
			$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $product_display_columns );
		} else {
			$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
		}
	}

	// Ensure visibility
	if ( ! $product || ! $product->is_visible() )
		return;

	// Increase loop count
	$woocommerce_loop['loop']++;

	// Extra post classes
	$classes = array();
	// if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	// 	$classes[] = 'first';
	// if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	// 	$classes[] = 'last';

	$width = $thumb_width = $thumb_height = "";

	if ($woocommerce_loop['columns'] == 4) {
			$classes[] = 'col-sm-3';
			$width = 'col-sm-3';
	} else if ($woocommerce_loop['columns'] == 3) {
			$classes[] = 'col-sm-4';
			$width = 'col-sm-4';
	} else if ($woocommerce_loop['columns'] == 2) {
			$classes[] = 'col-sm-6';
			$width = 'col-sm-6';
	} else if ($woocommerce_loop['columns'] == 1) {
			$classes[] = 'col-sm-12';
			$width = 'col-sm-12';
	}
	// $columns = 12/$woocommerce_loop['columns'];

	// if ($woocommerce_loop['columns'] == 4) {
	// 		$classes[] = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-'.$columns.' grid';
	// 		$width = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-'.$columns.' grid';
	// } else if ($woocommerce_loop['columns'] == 3) {
	// 		$classes[] = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-'.$columns.' grid';
	// 		$width = 'col-xs-12 col-sm-12 col-md-4 col-lg-4';
	// } else if ($woocommerce_loop['columns'] == 2) {
	// 		$classes[] = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-'.$columns.' grid';
	// 		$width = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-'.$columns.' grid';
	// } else if ($woocommerce_loop['columns'] == 1) {
	// 		$classes[] = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-'.$columns.' grid';
	// 		$width = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-'.$columns.' grid';
	// }

	// if ($woocommerce_loop['columns'] == 4) {
	// 		$classes[] = 'col-xs-12 col-sm-12 col-md-3 col-lg-3';
	// 		$width = 'col-xs-12 col-sm-12 col-md-3 col-lg-3';
	// } else if ($woocommerce_loop['columns'] == 3) {
	// 		$classes[] = 'col-xs-12 col-sm-12 col-md-4 col-lg-4';
	// 		$width = 'col-xs-12 col-sm-12 col-md-4 col-lg-4';
	// } else if ($woocommerce_loop['columns'] == 2) {
	// 		$classes[] = 'col-xs-12 col-sm-12 col-sm-6';
	// 		$width = 'col-xs-12 col-sm-12 col-md-6 col-lg-6';
	// } else if ($woocommerce_loop['columns'] == 1) {
	// 		$classes[] = 'col-xs-12 col-sm-12 col-sm-12';
	// 		$width = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
	// }
	?>
	<div <?php post_class( $classes ); ?> >
		<div class="inner-wrap">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<figure class="<?php echo esc_attr($figure_class); ?>">
        	<?php ss_woo_product_badge(); ?>

        	<?php 
        	echo '<div class="img-wrap first-image">';
			woocommerce_template_loop_product_thumbnail();
			echo '</div>';
			?>

			<?php if (!$product_layout != 'standard') { ?>
			<div class="cart-overlay">
				<div class="shop-actions clearfix">
					<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
				</div>
			</div>
			<?php } ?>

		</figure>
		
		<div class="product-details">
			<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

			<?php
			/**
			 * woocommerce_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );
			?>

			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>

		<?php if ($product_layout == 'standard') { ?>
		<div class="product-actions">
			<div class="button-wrap">
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
		</div>
		<?php } ?>
		</div>
	</div>