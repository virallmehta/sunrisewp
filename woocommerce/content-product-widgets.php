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
			$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
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

	$columns = 12/4;

	$classes[] = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-'.$columns.' grid';
	$width = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-'.$columns.' grid';

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

			<div class="cart-overlay">
				<div class="shop-actions clearfix">
					<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
					<?php // echo ss_add_quick_view_button(); ?>
				</div>
			</div>

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
		</div>
	</div>