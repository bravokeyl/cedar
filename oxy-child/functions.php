<?php
function woocommerce_result_count() {
	return;
}

add_action('oxy_product_sale_icon','gema75_show_product_loop_new_badge',10);

remove_action( 'woocommerce_single_product_summary', 'gema75_show_product_loop_new_badge' , 30 );
//remove_action('woocommerce_before_shop_loop','hook_oxy_grid_list_trigger',11);
//remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

function ybt_header_cart() {?>
	<div id="cart-total" class="ybt-cart-total">
		<?php echo sprintf(_n('%d item', '%d items', WC()->cart->cart_contents_count, 'oxy'), WC()->cart->cart_contents_count);?> - <?php echo WC()->cart->get_cart_total(); ?>
	</div>
<?php }

function ybt_header_carts(){?>
	<div class="hola">
		<?php get_template_part('woocommerce/cart/mini','cart'); ?>
	</div>
<?php }

add_filter( 'woocommerce_add_to_cart_fragments', 'ybt_cart_fragment_update' );
function ybt_cart_fragment_update( $fragments ) {
	global $woocommerce;
	ob_start();
	ybt_header_cart();
	$fragments['div.ybt-cart-total'] = ob_get_clean();

	ob_start();
	ybt_header_carts();
	$fragments['div.hola'] = ob_get_clean();
	return $fragments;
}

add_filter('body_class','bk_query_class');
function bk_query_class($c) {
	if(!is_product()){
		return $c;
	}
	if(isset($_GET['start_customizing'])){
		$c[] = 'bk-customizing';
	} else {
		$c[] = 'bk-not-customizing';
	}

	return $c;
}

add_filter('jpeg_quality', function($arg){ return 100; });

//add_action('wp_enqueue_scripts', 'bk_fpd_custom_script');
function bk_fpd_custom_script(){
	wp_enqueue_script('bk-fpd',get_theme_file_uri('bk-fpd.js'),array(),'1.0.0',true);
}

add_action('woocommerce_before_add_to_cart_form','bk_before_add_to_cart_form');
function bk_before_add_to_cart_form(){?>
	<div class="bk-before-cart-form">
		Please check carefully your text (spellings, dates, etc) before proceeding. You will receive a proof for final checking of your order from us within 24 hrs (via email).
	</div>
<?php }
