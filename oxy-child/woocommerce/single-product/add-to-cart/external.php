<?php
/**
 * External product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $smof_data;
 
//if($smof_data['sellya_shop_status'] != 0):
?>
<?php do_action('woocommerce_before_add_to_cart_button'); ?>

<p class="cart"><a href="<?php echo $product_url; ?>" rel="nofollow" class="single_add_to_cart_button button alt"><?php echo $button_text; ?></a></p>

<?php 
	do_action('woocommerce_after_add_to_cart_button'); 
//endif;
?>