<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

?>

<?php
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
?>

<?php if ( $product->is_in_stock() ) : 
		$prod_id = $product->id;
		$get_category = get_the_terms( $prod_id,'product_cat');
		foreach($get_category as $get_cat){
			$category_slg = $get_cat->slug;
			if (strpos($category_slg,'price_') !== false) {
				$category_slug = $category_slg;
			}
		}
		$all_price = get_option('_aspk_cat_price');
		if(isset($all_price[$category_slug])){
			$price = $all_price[$category_slug];
		}
		do_action( 'woocommerce_before_add_to_cart_form' ); ?>
	<input type="hidden" id="aspk_img_repl" value="<?php echo plugins_url('/baby-thankyoucards/image/personalize_btn.png'); ?>">
	<form class="cart" method="post" enctype='multipart/form-data'>
	 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	 	<?php
	 		/* if ( ! $product->is_sold_individually() )
	 			woocommerce_quantity_input( array(
	 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
	 			) ); */
	 	?>

	 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>
		<?php if(!empty($price)){ ?>
				<div class="row">
					<div class = "col-md-12">
						<div style="float:left;width:4em;">Quantity</div>
						<div style="float:left;margin-left:2em;width:8em;">Price</div>
						<div style="float:left;margin-left:2em;">Price Per Card</div>
					</div>
				</div>
				
				<?php	
					foreach($price as $k=>$v){  
						if($k == 'agile_single_price') continue;
					?>
						<div class="row" style = "">
							<div class = "col-md-12" style="line-height: 0.4em;">
								<div style="float:left;width:4em;"><?php echo $k;?></div>
								<div style="float:left;margin-left:2em;width:8em;"><?php echo '€'.sprintf("%01.2f", $k*$v);?></div>
								<div style="float:left;margin-left:2em;"><?php echo '€'.sprintf("%01.2f", $v);?></div>
							</div>
						</div><?php 
					} 
				
			}else{ ?>
				<div class="row" style = "">
					<div class = "col-md-12">Prices are not set</div>
				</div><?php 
			
			}?>
		<div class="row">
			<div class="col-md-12" style="margin-top:8px;margin-bottom:8px;">
			  <b>All Prices are VAT inclusive</b>
			</div>
		</div>
		<script>
			jQuery( document ).ready(function() {
				// hide review tab
				jQuery(".woocommerce-tabs ul li.reviews_tab").hide();
				// change text description to need help
				jQuery(".woocommerce-tabs ul li.description_tab a").html('NEED HELP');
				//
				jQuery(".product_meta").hide();
				jQuery('.product_custom_review').hide();
				var x = jQuery("#aspk_img_repl").val();
				jQuery("#fpd-start-customizing-button").removeClass('fpd-blue-btn');
				jQuery("#fpd-start-customizing-button").html('<img src='+x+'  />');
			});
		</script>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
