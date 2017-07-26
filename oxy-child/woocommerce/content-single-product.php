<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

    /*
     * Action for product title
     *
     */
global $smof_data, $product;
if(!isset($smof_data->oxy_general_settings)) return;

    do_action('sds_wc_product_title');
?>
<?php
    do_action('oxy_single_product_prev_next');
?>
<div class="bk-top-product-info">
  <?php
    if(function_exists('get_field')){
      $bk_top_info = get_field( "bk_product_top_info" );
      if( $bk_top_info ) {
        echo $bk_top_info;
      }
    }
  ?>
</div>
<div id="product-top">
    <div class="product-top-1">
        <div class="row">
            <div class="large-9 medium-9 small-12 columns">
                <div class="breadcrumb">
                <?php
                    /**
                     * woocommerce_before_main_content hook
                     *
                     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                     * @hooked woocommerce_breadcrumb - 20
                     */
                    do_action('woocommerce_before_main_content');

                ?>
                </div><!--.breadcrumb -->
            </div>
            <div class="large-3 medium-3 small-12 columns">

            </div>
        </div>
    </div>
</div>



<?php
/**
 * woocommerce_before_single_product hook
 *
 * @hooked woocommerce_show_messages - 10
 */
do_action('woocommerce_before_single_product');

if(isset($_POST['btn_personalize'])){

	do_action('aspk_handle_personalize');
}else{
?>

<div id="product-<?php the_ID(); ?>" <?php post_class('product-info row'); ?>>

            <?php
            /**
             * woocommerce_show_product_images hook
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            do_action('woocommerce_before_single_product_summary');
            ?>

            <?php
            $design = (int)$smof_data->oxy_general_settings['oxy_layout_product_page'];
            $class = '';

            switch($design){
                case 1:
                    $class = 'large-6 medium-6 small-12';
                    break;
                case 2:
                    $class = 'large-8 medium-8 small-12';
                    break;
                case 3:
                    $class = 'large-5 medium-5 small-12';
                    break;
                case 4:
                    $class = 'large-12 medium-12 small-12';
                    break;
                case 5:
                    $class = 'large-5 medium-5 small-12';
                    break;
                case 6:
                    $class = 'large-6 medium-6 small-12';
                    break;
                case 7:
                    $class = 'large-4 medium-4 small-12';
                    break;
                case 8:
                    $class = 'large-5 medium-5 small-12';
                    break;
                case 9:
                    $class = 'large-7 medium-7 small-12';
                    break;
                case 10:
                    $class = 'large-4 medium-4 small-12';
                    break;

            }
            ?>
            <div class="product-buy <?php echo $class?> columns">

            <?php
            /**
             * woocommerce_single_product_summary hook
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             */
            do_action('woocommerce_single_product_summary');
            ?>

            </div>

        <?php if(($design == 5) || ($design == 6) || ($design == 7) || ($design == 10)) { ?>
        <div class="product-right-sm large-3 medium-3 columns hide-for-small">
            <?php
            /**
             * woocommerce_right_sm_product_summary hook
             *
             * @hooked woocommerce_output_related_products - 20
             */
            do_action('woocommerce_right_sm_product_summary');
            get_sidebar('product-right');

            ?>
        </div>
        <?php }?>

    </div><!--.product-info -->


    <section id="product-information">

        <?php
        /**
         * woocommerce_after_single_product_summary hook
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_output_related_products - 20
         */
        do_action('woocommerce_after_single_product_summary');
        ?>
    </section>

<?php do_action('woocommerce_after_single_product'); ?>
<?php } //ends aspk personalize ?>
