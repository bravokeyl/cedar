<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product;
$pid = $product->id;
$get_category = get_the_terms( $pid,'product_cat');
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
foreach($price as $k=>$v){
	$price_html = $v;
}
if(empty($price_html)){
 $price_html = $product->get_price_html();
 }
 $price_html = sprintf("%01.2f", $price_html);
 $single_price = get_option('_aspk_single_cat_price');
?>

<?php //if ($price_html = $product->get_price_html()) : ?>

	<span class="price"><?php echo 'From €'.$price_html.' '.'each'; ?></span>
	<!--<span class="price"><?php echo 'From €'.$single_price.' '.'each'; ?></span>-->
	<input type="hidden" value="<?php echo 'From €'.$price_html.' '.'each';?>" id="aspk_single_price" >
<?php //endif; ?>
<script>
	jQuery( document ).ready(function() {
		jQuery("ul.product_list_widget > li > .amount").html('');
	});
</script>