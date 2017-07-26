<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

global $smof_data, $product;

if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs">
		<ul class="tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
                            
				<li class="<?php echo $key ?>_tab">
                                    <a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>

			<?php endforeach; ?>
            <?php
			if($smof_data->oxy_general_settings['oxy_product_custom_tab_1_status'] == '1' ) :
			?>
            <li class="custom_tab hidden-phone">
                <a href="#tab-custom"><?php echo get_option('oxy_product_custom_tab_1_title1')?></a>
            </li>
            <?php endif; ?>
		</ul>
        
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<div class="panel entry-content" id="tab-<?php echo $key ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>

		<?php endforeach; ?>
        <?php
		if($smof_data->oxy_general_settings['oxy_product_custom_tab_1_status'] == '1' ) :
		?>
        
			<div class="panel entry-content hidden-phone" id="tab-custom">
				<div id="customs">               
				<?php echo get_option('oxy_product_custom_tab_1_content1'); ?>
				</div>
			</div>
		<?php endif; ?>
        
	</div>

<?php endif; ?>