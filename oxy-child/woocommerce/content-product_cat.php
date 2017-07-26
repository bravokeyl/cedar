<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce_loop;

// Store loop count we're currently on


$GLOBALS['woocm_subcat_loop']++;


?>
<div class="span<?php
	if( ($GLOBALS['woocm_subcat_loop'] - 1 ) % 6 == 0 )
		echo ' span-first-child';
	?>">

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>    
            <div class="image">
            <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
            <?php
                do_action( 'woocommerce_before_subcategory_title', $category );
            ?>
            </a></div>
            <div class="name subcatname"><a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>"><?php echo $category->name; ?><?php if ( $category->count > 0 ) : ?> (<?php echo $category->count; ?>)
<?php endif; ?></a></div>
	
		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			//do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	<?php //do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>