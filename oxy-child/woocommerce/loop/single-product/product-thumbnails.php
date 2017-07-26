<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $post, $woocommerce, $product, $smof_data;

$ia = (int)$smof_data->oxy_general_settings['oxy_layout_product_page'];
	
	$attachments = $product->get_gallery_attachment_ids();	
	if (!empty($attachments)) {
		$loop = 0;
                if ( has_post_thumbnail($product->id) ) {
                    $attachment_id = get_post_thumbnail_id($product->id);
                    $image = wp_get_attachment_image_src($attachment_id,'full');			
                    $image = $image[0];		
                    $image_url = wp_get_attachment_image_src($attachment_id,'thumbnail');			
                    $image_url = $image_url[0];			
//                    $image_title = esc_attr( get_the_title( $attachment_id ) );
                    $image_title = esc_attr( get_the_title( $product->id ) );

                    //$image_data = " data-rel='prettyPhoto[product-gallery]'"; 
                    $image_data = ""; 
                    $class = "zoom ";

                    if($smof_data->oxy_general_settings['oxy_product_zoom_type'] == 1) { 
                        $image_data = ' rel="useZoom: \'zoom1\', smallImage: \''.$image.'\' "';
                        $class = 'cloud-zoom-gallery ';
                    } 

                    echo "<img style = 'cursor: pointer;' src='$image_url' alt='$image_title' />";
					/* echo "<a class='{$class}ia{$ia}'{$image_data} href='{$image}' title='{$image_title}'>
                        <img src='$image_url' alt='$image_title' /></a>"; */
                }
		foreach ( $attachments as $c=>$attachment_id ) {

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;
			
			$image = wp_get_attachment_image_src($attachment_id,'full');			
			$image = $image[0];		
			$image_url = wp_get_attachment_image_src($attachment_id,'thumbnail');			
			$image_url = $image_url[0];			
			$image_title = esc_attr( get_the_title( $attachment_id ) );
                        
                        //$image_data = " data-rel='prettyPhoto[product-gallery]'"; 
						$image_data = " ";
                        $class = "zoom ";
                                
                        if($smof_data->oxy_general_settings['oxy_product_zoom_type'] == 1) { 
                            $image_data = ' rel="useZoom: \'zoom1\', smallImage: \''.$image.'\' "';
                            $class = 'cloud-zoom-gallery ';
                        } 
                          
                        /* echo "<a class='{$class}ia{$ia}'{$image_data} href='{$image}' title='{$image_title}'>
                            <img src='$image_url' alt='$image_title' /></a>"; */
						echo "<img style = 'cursor: pointer;' src='$image_url' alt='$image_title' />";
			$loop++;

		}

	}
	elseif ( has_post_thumbnail($product->id) ) {
		
		$attachment_id = get_post_thumbnail_id($product->id);		
		$image_link = wp_get_attachment_url( $attachment_id );

		if ( ! $image_link )
			continue;		
		$image = wp_get_attachment_image_src($attachment_id,'full');		
		$image = $image[0];		
		$image_url = wp_get_attachment_image_src($attachment_id,'thumbnail');		
		$image_url = $image_url[0];		
		$image_title = esc_attr( get_the_title( $attachment_id ) );			
		//echo '<a class="cloud-zoom-gallery" rel="useZoom: \'zoom1\', smallImage: \''.$image.'\' " href="'.$image.'" title="'.$image_title.'"><img src="'.$image_url.'" alt="'.$image_title.'" /></a>';
			
		echo "<a class='colorbox ia{$ia}' rel='colorbox' href='$image' title='$image_title'>
                    <img src='$image_url' alt='$image_title' /></a>";
		
	} ?>
	<script>
		jQuery(document).ready(function(){
			jQuery('.image-additional').children().removeClass('ia3');
			jQuery('.image-additional img').css('width','120px');
			jQuery('.image-additional img').addClass('rep_img');
			
			jQuery('.rep_img').click(function(){
				var img_src = jQuery(this).attr('src');
				var y =  img_src.replace("-150x150", '')
				jQuery('#image').attr('src',y);
			 });
			jQuery('#product-information').hide();
		});
	</script>
