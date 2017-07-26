<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table shop_table_responsive cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-remove">&nbsp;</th>
			<th class="product-thumbnail">&nbsp;</th>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-price"><?php _e( 'Unit Price', 'woocommerce' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		$hassan = 0;
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$hassan++;
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					<td class="product-remove">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
						?>
					</td>

					<td class="product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail;
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
							}
						?>
					</td>

					<td class="product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
						<?php
							if ( ! $product_permalink ) {
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
							} else {
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
							}

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

							// Backorder notification
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
							}
						?>
					</td>

					<td class="product-price" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
					</td>

					<td class="product-quantity" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
						<?php
							// if ( $_product->is_sold_individually() ) {
							// 	$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							// } else {
							// 	$product_quantity = woocommerce_quantity_input( array(
							// 		'input_name'  => "cart[{$cart_item_key}][qty]",
							// 		'input_value' => $cart_item['quantity'],
							// 		'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
							// 		'min_value'   => '0'
							// 	), $_product, false );
							// }
							//
							// echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
						?>
						<input type = "hidden" id = "aspk_prod_id_<?php echo $hassan; ?>" value = "<?php echo $product_id; ?>"/>
						<select id = "quantity_custum_<?php  echo $hassan; ?>" name = "cart[<?php echo $cart_item_key?>][qty]" onchange = "quantity_change(<?php echo $hassan; ?>);">
							<option value = "10" <?php selected( 10, $cart_item['quantity']); ?>>10</option>
							<option value = "20" <?php selected( 20, $cart_item['quantity']); ?>>20</option>
							<option value = "30" <?php selected( 30, $cart_item['quantity']); ?>>30</option>
							<option value = "40" <?php selected( 40, $cart_item['quantity']); ?>>40</option>
							<option value = "50" <?php selected( 50, $cart_item['quantity']); ?>>50</option>
							<option value = "75" <?php selected( 75, $cart_item['quantity']); ?>>75</option>
							<option value = "100" <?php selected( 100, $cart_item['quantity']); ?>>100</option>
						  <option value = "125" <?php selected( 125, $cart_item['quantity']); ?>>125</option>
							<option value = "150" <?php selected( 150, $cart_item['quantity']); ?>>150</option>
							<option value = "175" <?php selected( 175, $cart_item['quantity']); ?>>175</option>
							<option value = "200" <?php selected( 200, $cart_item['quantity']); ?>>200</option>
						</select>
					</td>

					<td class="product-subtotal" data-title="<?php _e( 'Total', 'woocommerce' ); ?>" id="subtotal_<?php echo $hassan; ?>">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</td>
				</tr>
				<?php $hassan_count = count(WC()->cart->get_cart()); ?>
				<script>
				var carditems;
				jQuery( document ).ready(function() {
					jQuery('.cart-collaterals').hide();
					var quant_s;
					for(quant_s = 1; quant_s <= <?php echo $hassan_count; ?>; quant_s++){
						quantity_change(quant_s);
						var pro_id = jQuery('#aspk_prod_id_'+quant_s).val();
						jQuery('#page_'+pro_id).val(0);
					}
					jQuery('.includes_tax').hide();
				});

				function quantity_change(id){
					var val_quantity = jQuery('#quantity_custum_'+id).val();
					//var index = jQuery('#quantity_custum_'+id+' option:selected').index();
					var prod_id = jQuery('#aspk_prod_id_'+id).val();
					var data = {
						'action':'cart_quantity_val',
						'qty':val_quantity,
						'prod_id':prod_id,

					};
					var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' );?>';
					jQuery.post(ajaxurl, data, function(response) {
						obj = JSON.parse(response);
						console.log(response);
						if(obj.st == 'ok'){
							//var each_value = each_value.replace("€","");
							var tot_value = val_quantity * obj.unit_price;
							var tot_fix_val = parseFloat(tot_value);
							var tot_fix_val_round = tot_fix_val.toFixed(2);
							var fixunit_price = parseFloat(obj.unit_price);
							var fixunit_price_round = fixunit_price.toFixed(2);
							jQuery('#quantity_custum_'+id).parent().parent().find('.product-price').find('.amount').html('€'+fixunit_price_round);
							jQuery( "#subtotal_"+id ).html('€'+tot_fix_val_round);
							//////////////////////////////////////////////////
							var p;
							var tot=0;
							var sum;
							var carditems = [];
							jQuery('.sum').each(function(){
							p = jQuery(this).html();
							 sum = p.replace("€","");
							  carditems.push(sum);
							});
							carditems.forEach(function(element, index, array){
							  tot = tot + parseFloat(element);

							});
							tot = tot.toFixed(2);
							jQuery('.cart-total strong span').html('€'+tot);
						}else{
							// nothing
						}
					});


				}
			</script>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions">

				<?php if ( wc_coupons_enabled() ) { ?>
					<div class="coupon">

						<label for="coupon_code"><?php _e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'woocommerce' ); ?>" />

						<?php do_action( 'woocommerce_cart_coupon' ); ?>
					</div>
				<?php } ?>

				<input type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />

				<?php do_action( 'woocommerce_cart_actions' );
							do_action( 'woocommerce_proceed_to_checkout' );
				?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>
<?php //woocommerce_cart_totals();?>

<div class="cart-collaterals">

	<?php //do_action( 'woocommerce_cart_collaterals' ); ?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
