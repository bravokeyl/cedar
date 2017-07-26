<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $smof_data;
if(!isset($smof_data->oxy_general_settings)) return;

get_header(); 


$design = (int)$smof_data->oxy_general_settings['oxy_product_page_sidebar_layout']; // will related to admin panel. Temporarily set for development.
$leftbar = $rightbar = $main = '';

switch ($design){    
    case 1:
        $rightbar = 'hidesidebar';
        $main = 'large-9 medium-9';
        break;
    case 2:
        $leftbar = 'hidesidebar';
        $main = 'large-9 medium-9';
        break;
    
    case 4:        
        $main = 'large-6 medium-6';
        break;
    
    default:
        $leftbar = $rightbar = 'hidesidebar';
        $main = 'large-12 medium-12';
        break;
    
}        
?>
<section id="midsection" class="container">
	<div class="row">
    
		<?php 
        
//        $class = ($smof_data['sellya_product_page_design'] == 1) ? 'span12' : 'span9 single-with-sidebar';
//        
//        if($smof_data['sellya_product_page_design'] != 1 and $smof_data['sellya_product_page_design'] != 3 ):
//    
//            get_leftbar('left'); 
//        
//        endif;
        
    
                
                
        ?>
        <aside id="column-left" class="large-3 medium-3 columns hide-for-small <?php echo $leftbar?>">
        <?php get_sidebar('shop'); ?>
        </aside>
        <div id="content" class="<?php echo $main?> columns">        
            <?php while ( have_posts() ) : the_post(); ?>
                <?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
    
            <?php endwhile; // end of the loop. ?>
        
            <?php
                /**
                 * woocommerce_after_main_content hook
                 *
                 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                 */
                do_action('woocommerce_after_main_content');
            ?>
        
            <?php
                /**
                 * woocommerce_sidebar hook
                 *
                 * @hooked woocommerce_get_sidebar - 10
                 */
                //do_action('woocommerce_sidebar');
            ?>
        
        </div>
        <aside id="column-right" class="large-3 medium-3 columns hide-for-small <?php echo $rightbar?>">
        <?php get_sidebar('shop-right'); ?>
        </aside> 
           
        <?php 
//		if($smof_data['sellya_product_page_design'] != 1 and $smof_data['sellya_product_page_design'] != 2 ):
//
//            get_leftbar('left'); 
//        
//        endif;
		?>
        
	</div>
</section>

<?php get_footer(); ?>