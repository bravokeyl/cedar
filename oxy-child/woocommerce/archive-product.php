<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header();

global $smof_data;

if(!isset($smof_data->oxy_general_settings)) return;
    


$design = (int) $smof_data->oxy_general_settings['oxy_shop_page_display_style']; // will related to admin panel. Temporarily set for development.

if(isset($_GET['oxy_page_layout']) && is_numeric($_GET['oxy_page_layout'])){
    $design = $_GET['oxy_page_layout'];
    
    switch ($design){            
        case 1:            
        case 2:        
            $cols = 4;
            break;
        case 4:        
            $cols = 3;
            break;
        default:        
            $cols = 6;
            break; 
    }
}


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


$colclass = '';

if(!isset($cols))
    $cols = (int)$smof_data->oxy_general_settings['oxy_layout_pb_noc'];

switch ($cols){            
    case 3:        
        $colclass = 'large-4 medium-4 small-6 columns';
        break;    
    case 4:        
        $colclass = 'large-3 medium-4 small-6 columns';
        break;
    case 6:        
        $colclass = 'large-2 medium-3 small-6 columns';
        break;
    default:        
        $colclass = 'large-6 medium-6 small-6 columns';
        break; 
}
?>
<script type="text/javascript"><!--

    jQuery(function($) {

        "use strict";
        
        var colclass = '<?php echo $colclass?>';

        var centered = '<?php 
        if($smof_data->oxy_general_settings['oxy_category_prod_align'] == 2){
            echo 'centered'; 
        }?>';

        $.display = function(view) {

            if (view == 'list') {

                $('.product-grid').attr('class', 'product-list');

                $('.product-list > ul > li').each(function(index, element) {

                    var element = $(this);
                    
                    element.removeClass(colclass).addClass('large-12 medium-12');
                    
                    if(centered != '')
                        element.removeClass(centered);
                    
//                    var htmls = '<div class="row">';
                    var htmls = '';

                    var image = element.find('.image').html();

                    if (image != undefined) {
                        htmls += '<div class="image">' + image + '</div>';
                    }

                    htmls += '<div class="large-6 medium-6 columns">';
                    if(element.find('.name').length > 0)
                        htmls += '<div class="name">' + element.find('.name').html() + '</div>';                    
                    if(element.find('.product_box_brand').length > 0)
                        htmls += '<div class="product_box_brand">' + element.find('.product_box_brand').html() + '</div>';

                    var rating = element.find('div.rating').html();

                    if (rating != undefined) {
                        htmls += '<div class="rating">' + rating + '</div>';
                    }
                    else {

                        if (element.find('div.star-rating').length > 0) {

                            var rating = element.find('div.star-rating').html();

                            var rattitle = element.find('div.star-rating').attr('title');

                            htmls += '<div class="star-rating" title="' + rattitle + '">' + rating + '</div>';
                        }
                    }

                    htmls += '  <div class="description">' + element.find('.description').html() + '</div>';
                    //html += '  <div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
                    //html += '  <div class="compare">' + $(element).find('.compare').html() + '</div>';			

                    htmls += '</div>';



                    htmls += '<div class="large-3 medium-3 columns">';
                    var price = element.find('.price').html();

                    if (price != null) {
                        htmls += '<div class="price">' + price + '</div>';
                    }
                    htmls += '  <div class="cart">' + element.find('.cart').html() + '</div>';
                    htmls += '</div>';

                    //htmls += '</div>';
                    htmls += '</div>';

                    element.html(htmls);
                });

                //$('.display').html('<?php _e('Display:', 'oxy') ?>&nbsp;<img src="<?php echo get_template_directory_uri(); ?>/image/icon_list.png" alt="List" title="List" />&nbsp;<img onclick="jQuery.display(\'grid\');" src="<?php echo get_template_directory_uri(); ?>/image/icon_grid.png" alt="Grid" title="Grid" />');

                $.cookie('display', 'list');
                
            } else {
                
                $('.product-list').attr('class', 'product-grid');

                $('.product-grid > ul > li').each(function(index, element) {
                    var html = '';
                    
                    element = $(this);
                    //alert(colclass);
                    //element.removeClass('large-12 medium-12').addClass(colclass);
                    
                    element.attr('class',colclass);
                    if(centered != '')
                    element.addClass(centered);
                    
                    
                    html += '<div class="pbox">';

                    var element = $(this);

                    var image = element.find('.image').html();

                    if (image != undefined) {

                        html += '<div class="image">' + image + '</div>';
                    }
                    

                    var rating = element.find('div.rating').html();

                    if (rating != undefined) {
                        html += '<div class="rating hidden-phone hidden-tablet">' + rating + '</div>';
                    }
                    if(element.find('.name').length > 0)
                        html += '<div class="name">' + element.find('.name').html() + '</div>';
                    if(element.find('.product_box_brand').length > 0)
                        html += '<div class="product_box_brand">' + element.find('.product_box_brand').html() + '</div>';

                    if (rating == undefined) {

                        if (element.find('div.star-rating').length > 0) {

                            var rating = element.find('div.star-rating').html();

                            var rattitle = element.find('div.star-rating').attr('title');

                            html += '<div class="star-rating" title="' + rattitle + '">' + rating + '</div>';
                        }
                    }
                    html += '<div class="description">' + $(element).find('.description').html() + '</div>';
                    var price = element.find('.price').html();

                    if (price != null) {
                        html += '<div class="price">' + price + '</div>';
                    }

                    html += '<div class="cart">' + element.find('.cart').html() + '</div>';
                    //html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
                    //html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';
                    html += '</div>';

                    element.html(html);
                });

                //$('.display').html('<?php _e('Display:', 'oxy') ?>&nbsp;<img src="<?php echo get_template_directory_uri(); ?>/image/icon_list.png" alt="List" title="List" onclick="jQuery.display(\'list\');"/>&nbsp;<img src="<?php echo get_template_directory_uri(); ?>/image/icon_grid.png" alt="Grid" title="Grid"/>');	

                $.cookie('display', 'grid');
            }
        }

        $('a.list-trigger').click(function() {
            $.display('list');
        });
        $('a.grid-trigger').click(function() {
            $.display('grid');
        });

        var view = '<?php echo $smof_data->oxy_general_settings['oxy_category_prod_display']?>';        
        view = $.cookie('display') !== undefined ? $.cookie('display') : view;
        
        if (view) {
            $.display(view);
        } else {
            $.display('grid');
        }



    });
//--></script> 



<section id="midsection" class="container">
    <div class="row">
        <?php if($leftbar == ''){?>
        <aside id="column-left" class="large-3 medium-3 columns hide-for-small <?php echo $leftbar?>">
        <?php get_leftbar('shop'); ?>
        </aside>  
        <?php } ?>
        <section class="<?php echo $main?> columns" id="content">
            <div class="row-fluid">                
                <h1 class="page-title">
                
<?php if (is_search()) : ?>
    <?php
    printf(__('Search Results: &ldquo;%s&rdquo;', 'woocommerce'), get_search_query());
    if (get_query_var('paged'))
        printf(__('&nbsp;&ndash; Page %s', 'woocommerce'), get_query_var('paged'));
    ?>
                    <?php elseif (is_tax()) : ?>
                        <?php echo single_term_title("", false); ?>
                    <?php else : ?>
                        <?php
                        $shop_page = get_post(wc_get_page_id('shop'));
                        if(!empty($shop_page) && !is_wp_error($shop_page))
                        echo apply_filters('the_title', ( $shop_page_title = get_option('woocommerce_shop_page_title') ) ? $shop_page_title : $shop_page->post_title );
                        ?>
                    <?php endif; ?>
                </h1>
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
                </div>
                    <?php
                    $slug = get_query_var('term');
                    $taxonomy = get_query_var('taxonomy');

                    if (!empty($taxonomy) && !empty($slug) && $smof_data->oxy_general_settings['oxy_cat_subcategories_status'] == 1):
                        if(is_numeric($slug))
                            $pterm = get_term($slug, $taxonomy);
                        else
                            $pterm = get_term_by('slug', $slug, $taxonomy);
                        
                        
                        $terms = get_terms($taxonomy, array('hide_empty'=>false, 'parent'=>$pterm->term_id));
                        
                        if (!empty($terms)):
                            ?>
           
                        <div class="category-list">                            
                            <?php foreach($terms as $term){
                                $link = get_term_link($term,$taxonomy);
                                
                                $thumbnail_id = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);
                                $image = wc_placeholder_img_src();
                                if(!empty($thumbnail_id)){
                                    $image = wp_get_attachment_image_src($thumbnail_id, 'full');
                                    $image = $image[0];
                                }
                                $term_title = "{$term->name}";
                                $term_title .= " ({$term->count})";
                                ?>
                            <div class="large-2 medium-2 small-6 columns">
                                <div class="image"><a href="<?php echo $link;?>"><img alt="<?php echo $term_title?>" src="<?php echo $image;?>"></a></div>
                                <div class="name subcatname"><a href="<?php echo $link?>"><?php echo $term_title?></a></div>
                            </div>
                            <?php }?>
                            
                        </div>
        <?php
    endif;

endif;

do_action('woocommerce_archive_description');
?>

                <?php
                if (get_option('woocommerce_category_archive_display') == 'both' and get_query_var('taxonomy')):

                    $parent_cat = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

                    if ($parent_cat->parent == 0):
                        ?>

                   
                    <?php endif;
                endif; ?>

                <div class="category-list">

                <?php
                if (!isset($GLOBALS['woocm_subcat_loop']))
                    $GLOBALS['woocm_subcat_loop'] = 0;
                ?>            
                    <?php woocommerce_product_subcategories(); ?>
                </div>

                    <?php if (is_tax()) : ?>            
                        <?php do_action('woocommerce_taxonomy_archive_description'); ?>               
                    <?php elseif (!empty($shop_page) && is_object($shop_page)) : ?>
    <?php do_action('woocommerce_product_archive_description', $shop_page); ?>
                <?php endif; ?>


                <!--div class="product-filter">
                        <div class="display">Display:&nbsp;
                                <a href="#" class="switch_thumb">Switch Thumb</a>
                        </div>				
                </div-->
                <!-- <div class="product-filter"> -->

                    <!-- <div class="sort">       -->
                        <?php
                        /**
                         * woocommerce_pagination hook
                         *
                         * @hooked woocommerce_pagination - 10
                         * @hooked woocommerce_catalog_ordering - 20
                         */
                       // do_action('woocommerce_pagination');
                        ?>
                        <?php //do_action('woocommerce_before_shop_loop'); ?>
                    <!-- </div> -->
                    
                <!-- </div> -->


<?php if (have_posts()) : ?>

    
                    <div class="product-grid">

                        <ul class="products">

                    <?php 
                     while (have_posts()) : the_post();
                    woocommerce_get_template_part('content', 'product'); 
                    endwhile; // end of the loop.  ?>

                        </ul>

                    </div>


    <?php do_action('woocommerce_after_shop_loop'); ?>

<?php else : ?>

                    <?php if (!woocommerce_product_subcategories(array('before' => '<ul class="productsbbbnb">', 'after' => '</ul>'))) : ?>

                        <p><?php _e('No products found which match your selection.', 'woocommerce'); ?></p>

                    <?php endif; ?>

<?php endif; ?>

                <div class="clear"></div>



<?php
/**
 * woocommerce_after_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>
            </div>
        </section>
        <?php if($rightbar == ''){?>
        <aside id="column-right" class="large-3 medium-3 columns hide-for-small <?php echo $rightbar?>">
        <?php get_leftbar('shop-right'); ?>
        </aside> 
        <?php } ?>
    </div>
</section>

        <?php get_footer('shop'); ?>