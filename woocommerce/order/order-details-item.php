<?php
/**
 * Order Item Details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
											
	<td class="product-name">
		<?php
			$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image() );

			if ( ! $product->is_visible() )
				echo $thumbnail;
			else
				printf( '<a href="%s" class="product-thumb">%s</a>', $product->get_permalink(), $thumbnail );
		?>
		<?php
			$is_visible = $product && $product->is_visible();
			
			if ( $is_visible ) {
				echo '<div class="product-details">';
			}
			
			echo apply_filters( 'woocommerce_order_item_name', $is_visible ? sprintf( '<a href="%s" class="product-name-link">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ) : $item['name'], $item, $is_visible );
			echo apply_filters( 'woocommerce_order_item_quantity_html', '<span class="product-quantity">' . sprintf( __('Qty: %s', AR_DOMAIN) , $item['qty'] ) . '</span>', $item );
			
			if ( $is_visible ) {
				echo '</div>';
			}
			
			do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order );

			$order->display_item_meta( $item );
			$order->display_item_downloads( $item );

			do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order );
		?>
	</td>
	<td class="product-total">
		<?php echo $order->get_formatted_line_subtotal( $item ); ?>
	</td>
</tr>
<?php if ( $order->has_status( array( 'completed', 'processing' ) ) && ( $purchase_note = get_post_meta( $product->id, '_purchase_note', true ) ) ) : ?>
<tr class="product-purchase-note">
	<td colspan="3"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
</tr>
<?php endif; ?>
