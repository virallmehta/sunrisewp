<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$my_account_link     = get_admin_url();
$myaccount_page_id   = get_option( 'woocommerce_myaccount_page_id' );
if ( $myaccount_page_id ) {
    $my_account_link = get_permalink( $myaccount_page_id );
    $logout_url      = wp_logout_url( get_permalink( $myaccount_page_id ) );
    $login_url       = get_permalink( $myaccount_page_id );
    if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
        $logout_url = str_replace( 'http:', 'https:', $logout_url );
        $login_url  = str_replace( 'http:', 'https:', $login_url );
    }
}

if ( $order ) : ?>

<div class="row">

	<div class="col-sm-12">
	<?php if ( $order->has_status( 'failed' ) ) { ?>
		<p class="order-status order-failed"><i class="sf-icon-fail"></i><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', SS_DOMAIN ); ?></p>
	<?php } else { ?>
		<p class="order-status order-success"><i class="sf-icon-success"></i><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', SS_DOMAIN ), $order ); ?></p>
	<?php } ?>
	</div>
				
	<div class="col-sm-9 woo-thankyou-main">

		<?php if ( $order->has_status( 'failed' ) ) : ?>
	
			<p><?php
				if ( is_user_logged_in() )
					_e( 'Please attempt your purchase again or go to your account page.', SS_DOMAIN );
				else
					_e( 'Please attempt your purchase again.', SS_DOMAIN );
			?></p>
	
			<p>
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', SS_DOMAIN ) ?></a>
				<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My Account', SS_DOMAIN ); ?></a>
				<?php endif; ?>
			</p>
	
		<?php else : ?>
			
			<ul class="order_details">
				<li class="order">
					<?php _e( 'Order Number:', SS_DOMAIN ); ?>
					<strong><?php echo $order->get_order_number(); ?></strong>
				</li>
				<li class="date">
					<?php _e( 'Date:', SS_DOMAIN ); ?>
					<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
				</li>
				<li class="total">
					<?php _e( 'Total:', SS_DOMAIN ); ?>
					<strong><?php echo $order->get_formatted_order_total(); ?></strong>
				</li>
				<?php if ( $order->payment_method_title ) : ?>
				<li class="method">
					<?php _e( 'Payment Method:', SS_DOMAIN ); ?>
					<strong><?php echo $order->payment_method_title; ?></strong>
				</li>
				<?php endif; ?>
			</ul>
	
			<div class="clear"></div>
	
		<?php endif; ?>
	
		<?php do_action( 'woocommerce_thankyou', $order->id ); ?>
			
	</div>
	<div class="col-sm-3 woo-thankyou-details">
		<div class="payment-wrap"><?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?></div>
		<a href="<?php echo esc_url($my_account_link); ?>" class="text-center accent"><?php _e( 'Back to my account', SS_DOMAIN ); ?></a>
		<a class="continue-shopping accent" href="<?php echo apply_filters( 'woocommerce_continue_shopping_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php _e('Continue shopping', SS_DOMAIN); ?></a>
	</div>
</div>

<?php else : ?>

	<p class="order-status order-success"><i class="sf-icon-success"></i><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', SS_DOMAIN ), null ); ?></p>

<?php endif; ?>