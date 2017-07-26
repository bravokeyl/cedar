<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product, $smof_data;

$design = (int)$smof_data->oxy_general_settings['oxy_layout_product_page'];
$leftcolimg_style = array(8,9,10);
$imagewrap_class = '';

switch($design){    
    case 1:
        $imagewrap_class = 'large-6 medium-6 small-12';
        break;
    case 2:
        $imagewrap_class = 'large-4 medium-4 small-12';
        break;
    case 3:
        $imagewrap_class = 'large-7 medium-7 small-12';
        break;
    case 4:
        $imagewrap_class = 'large-12 medium-12 small-12';
        break;
    case 5:
        $imagewrap_class = 'large-4 medium-4 small-12';
        break;
    case 6:
        $imagewrap_class = 'large-3 medium-3 small-12';
        break;
    case 7:
        $imagewrap_class = 'large-5 medium-5 small-12';
        break;
    case 8:
        $imagewrap_class = 'large-6 medium-6 small-12';
        break;
    case 9:
        $imagewrap_class = 'large-4 medium-4 small-12';
        break;
    case 10:
        $imagewrap_class = 'large-4 medium-4 small-12';
        break;
    
}

if(in_array($design, $leftcolimg_style)){
?>

<div class="product-left-image-additional large-1 medium-1 small-3 columns">
	<div class="image-additional-left">
	<?php do_action('woocommerce_product_thumbnails'); ?>
        </div>
</div>
<?php
}
?>
<div class="product-left <?php echo $imagewrap_class?> columns">
    <div class="image images">
        <?php do_action('oxy_product_sale_icon')?>
        <?php 

        $attach_id = get_post_thumbnail_id($product->id);
        //$image_title =  esc_attr( get_the_title( $attach_id ) );
        $image_title =  esc_attr( get_the_title( $product->id ) );
        $image_url = wp_get_attachment_image_src($attach_id,'full');
        $image_url = $image_url[0];
        $imageclass = '';
        $datarel = "data-rel='prettyPhoto'";
        $zoomcb = "jQuery(this).parent().prev().trigger('click'); return false;";
        if($smof_data->oxy_general_settings['oxy_product_zoom_type'] == 1) {             
            $imageclass = "cloud-zoom";
            $datarel .= " id='zoom1' rel=\"adjustX: -1, adjustY:-1, tint:'#ffffff',tintOpacity:0.1\"";
            $zoomcb = "jQuery(this).parent().prev().children('.cloud-zoom').trigger('click'); return false;";
        }

        ?>			
            <a href="<?php echo $image_url; ?>" <?php echo $datarel; ?> class="<?php echo $imageclass?>" title="<?php echo $image_title; ?>">
                <img src="<?php echo $image_url; ?>" title="<?php echo $image_title; ?>" alt="<?php echo $image_title; ?>" id="image" />
            </a>
            <!--<div class="zoom-b">
                <a id="zoom-cb" onclick="<?php echo $zoomcb;?>"><?php _e('Zoom','oxy')?></a>        
            </div>-->

    </div>
    <?php
    if(!in_array($design, $leftcolimg_style)){
    ?>
    <div class="image-additional">
            <?php do_action('woocommerce_product_thumbnails'); ?>
    </div>
    <?php
    }
    ?>
</div>
