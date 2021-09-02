<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
$tooltip_text = "";
?>
<?php if ( ! $product->is_in_stock() ) : ?>
	<div class="add-to-cart-wrap" data-toggle="tooltip" data-placement="top" title="<?php _e("Sold out", SS_DOMAIN); ?>">
		<a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product_id ) ); ?>" class="button product_type_soldout"><i class="fa fa-shopping-cart"></i><span><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Out of stock', SS_DOMAIN ) ); ?></span></a>
	</div>
	<?php echo artooz_wishlist_button(); ?>
<?php else: ?>
	<?php
		echo apply_filters( 'woocommerce_loop_add_to_cart_link',
		sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="button active %s">%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $quantity ) ? $quantity : 1 ),
			esc_attr( $product->get_id() ),
			esc_attr( $product->get_sku() ),
			esc_attr( isset( $class ) ? $class : '' ),
			'<i class="fa fa-shopping-cart"></i> ' 
		),
	$product );
	?>
	
	<?php echo artooz_wishlist_button(); ?>

<?php endif; ?>
