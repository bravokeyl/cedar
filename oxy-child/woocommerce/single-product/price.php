<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $product, $smof_data;
?>
<div style = "padding:0;" itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="pb-price">

	<!-- <p itemprop="price" class="price"><?php echo $product->get_price_html(); ?></p>

	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />-->
        
        <?php
       /*  if(isset($smof_data->oxy_general_settings['oxy_product_save_percent_status']) 
                && $smof_data->oxy_general_settings['oxy_product_save_percent_status'] == 1)
        oxy_deduction_percent();?> */
		?>
		<h1 class="product_title entry-title"><?php the_title(); ?></h1>

</div>