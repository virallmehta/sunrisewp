<?php
	/**
	* Product Loop Start
	*
	* @author 		WooThemes
	* @package 	WooCommerce/Templates
	* @version     2.0.0
	*/

	global $artooz_theme_options;

	$product_display_layout = $artooz_theme_options['product_display_layout'];
	
	$list_class = "";
	$list_class = 'product-' .$product_display_layout;

?>

	<div id="products" class="products <?php echo esc_attr($list_class); ?> row clearfix">
