<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop, $wpdb, $post, $smof_data, $yith_wcwl;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibilty
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

//$altimgclass = $smof_data['sellya_product_alt_image_setting'] != 0? ' havealtimg':'';

$colclass = '';
$cols = (int)$smof_data->oxy_general_settings['oxy_layout_pb_noc'];

if(is_product() || !is_shop() || !is_product_category() || !is_taxonomy('brands')){
    $cols = $woocommerce_loop['columns'];
}

switch ($cols){            
    case 3:        
        $colclass = 'large-4 medium-4 small-6';
        break;    
    case 4:        
        $colclass = 'large-3 medium-4 small-6';
        break;
    case 6:        
        $colclass = 'large-2 medium-4 small-6';
        break;
    default:        
        $colclass = 'large-6 medium-4 small-6';
        break; 
}

?>


<li class="<?php echo $colclass?> columns<?php
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo '';
	elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 )
		echo ' clearleft';
        
//        if($smof_data->oxy_general_settings['oxy_category_prod_align'] == 2){
//            echo ' centered'; 
//        }
        
        ?>">
	
            
	 <?php do_action( 'woocommerce_before_shop_loop_item' ); 
         ?>
	<div class="image">
	  <a href="<?php the_permalink(); ?>">
		  <?php
			  /**
			   * woocommerce_before_shop_loop_item_title hook
			   *
			   * @hooked woocommerce_show_product_loop_sale_flash - 10
			   * @hooked woocommerce_template_loop_product_thumbnail - 10
			   */
			  do_action( 'woocommerce_before_shop_loop_item_title' );
		  ?>          	
	  </a>
            <?php
            if($smof_data->oxy_general_settings['oxy_cat_prod_wis_com_status'] == 1){
            ?>
            <div class="flybar"> 
                <?php 
                
                if(isset($yith_wcwl) && is_object($yith_wcwl)){ 
                $classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist wishlist add_to_wishlist_small"';    
              ?>
                <a href="<?php echo esc_url( $yith_wcwl->get_addtowishlist_url() )?>" data-product-id="<?php echo $product->id ?>" data-product-type="<?php echo $product->product_type ?>" <?php echo $classes?>><div><?php _e('Add to Wish List','oxy')?></div></a>
                <a title="<?php _e('Add to Wish List','oxy')?>" class="wishlist-tip"><div><?php _e('Add to Wish List','oxy')?></div></a>
            <?php
            }
            if(class_exists('YITH_Woocompare_Frontend')){
              $oxy_yith_cmp = new YITH_Woocompare_Frontend;
            ?>            
                <a class="compare add_to_compare_small" data-product_id="<?php echo $product->id?>" href="<?php echo $oxy_yith_cmp->add_product_url( $product->id )?>"><div><?php _e('Add to Compare','oxy')?></div></a>
                <a title="<?php _e('Add to Compare','oxy')?>" class="compare-tip"><div><?php _e('Add to Compare','oxy')?></div></a>
            <?php
            }
            ?>
            </div>
            <?php
            }
            ?>
	</div>
    <?php if($smof_data->oxy_general_settings['oxy_category_prod_name_status'] == 1){?>
    <div class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
    <?php } if($smof_data->oxy_general_settings['oxy_category_prod_brand_status'] == 1){?>
    <div class="product_box_brand">
        <?php 
        $brands = wp_get_post_terms($product->id, 'brands');
        if(!empty($brands)){
            $brand = $brands[0];
            $blink = get_term_link($brand,'brands');
        ?>
        <span><?php _e('Size:','oxy')?></span> <a href="<?php echo $blink; ?>"><?php echo $brand->name?></a>
        <?php         
        }
        ?>
    </div>
    <?php }?>
    <div class="description"><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?></div>
    <?php
		  /**
		   * woocommerce_after_shop_loop_item_title hook
		   *
		   * @hooked woocommerce_template_loop_price - 10
		   */
		   do_action( 'woocommerce_after_shop_loop_item_title' );
	  ?>
        
    <div class="cart">
        <?php do_action( 'woocommerce_after_shop_loop_item' );     
    ?></div>	   
    <div class="clear"></div>
	

</li>