<?php
/*
Plugin Name: Agile Baby Thankyou
Plugin URI:
Description: Specially created to work with oxy child theme. It creates the desired end result
Author: Agile Solutions PK
Version: 1.2
Author URI: http://agilesolutionspk.com
*/

if ( !class_exists( 'Agile_Baby_Thankyou' )){

	class Agile_Baby_Thankyou{

		function __construct(){
			// stub code for deleted
			register_activation_hook( __FILE__, array($this, 'install') );
			register_deactivation_hook( __FILE__, array($this, 'de_activate') );
			add_action('admin_menu', array(&$this,'admin_menu'));
			add_action('init', array(&$this, 'fe_init'));
			add_action('wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts'));
			add_action('admin_enqueue_scripts', array(&$this, 'wp_enqueue_scripts'));
			add_action( 'wp_ajax_nopriv_cart_quantity_val', array(&$this,'cart_quantity_val' ));
			add_action( 'wp_ajax_cart_quantity_val', array(&$this,'cart_quantity_val' ));
			add_filter( 'woocommerce_get_price', array(&$this,'custom_product_price_return' ) ,99 ,2);
			add_filter( 'woocommerce_add_cart_item', array(&$this,'woocommerce_add_cart_item' ) ,20 ,3);
		}

		function woocommerce_add_cart_item($cart_item_data,$itt,$cart_item_key){
			$items = WC()->cart->get_cart();
      if ( empty($items) ) {
				$cart_item_data['quantity'] =  10;
      } else {
				foreach($items as $item => $values) {
					if($cart_item_data['product_id'] == $values['product_id']){
							if($values['quantity'] >= 10) {
								$cart_item_data['quantity'] = $values['quantity'];
							} else {
								$cart_item_data['quantity'] = 10;
							}
							// wp_die($cart_item_data['product_id']);
					} else {
						$cart_item_data['quantity'] =  10;
					}
        }
        // wp_die(0);
      }
			return $cart_item_data;
		}

		function custom_product_price_return( $price, $product ) {
			$prod_id = $product->id;
			 if(isset($_SESSION['_aspk_prod_custm_price'.$prod_id])){
				$price = $_SESSION['_aspk_prod_custm_price'.$prod_id];
			}
			return $price;
		}

		function cart_quantity_val(){
			$prod_id = $_POST['prod_id'];
			$get_category = get_the_terms( $prod_id,'product_cat');
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
			$qty = $_POST['qty'];
			$unit_price = $price[$qty];
			$_SESSION['_aspk_prod_custm_price'.$prod_id] = $unit_price;
			if(isset($unit_price)){
				$ret = array('st' => 'ok','unit_price'=>$unit_price);
			}else{
				$ret = array('st' => 'error','unit_price'=>'');
			}
			echo json_encode($ret);
			exit;
		}

		function install(){

		}



		function de_activate(){

		}


		function admin_menu(){
			add_options_page( 'Set Category Price', 'Set Category Price', 'manage_options', 'aspk_set_cat_price', array(&$this,'options_page_set_category_price'));
		}

		function aspk_get_all_categories(){
			global $wpdb;

			$sql = "SELECT `slug` FROM {$wpdb->prefix}terms WHERE `slug` LIKE 'price_%'";
			$categories = $wpdb->get_col($sql);
			return $categories;
		}

		function set_category_price( $categories,$category_price ){
			$arr = array();
			$arr = get_option('_aspk_cat_price');
			$arr[$categories] = $category_price;
			update_option('_aspk_cat_price',$arr);
		}

		function options_page_set_category_price(){
			if( isset( $_POST['btn_set_price'] ) ){
				$categ_name = $_POST['categories'];
				//$category_price = $_POST['category_price'];
				//$this->set_category_price($categories,$category_price);
			}
			$categories = $this->aspk_get_all_categories();
			if( isset( $_POST['aspk_submit_single_card'] ) ){
				$sinlge_card = $_POST['aspk_price_single_card'];
				update_option('_aspk_single_cat_price',$sinlge_card);
			}
			$qtn_unit_price = array();
			if( isset( $_POST['submit_qtn_price'] ) ){
				//$unit_price_item = $_POST['unit_price'];
				$qtn_unit_price[$_POST['qtn_10']] = $_POST['unit_price_10'];
				$qtn_unit_price[$_POST['qtn_20']] = $_POST['unit_price_20'];
				$qtn_unit_price[$_POST['qtn_30']] = $_POST['unit_price_30'];
				$qtn_unit_price[$_POST['qtn_40']] = $_POST['unit_price_40'];
				$qtn_unit_price[$_POST['qtn_50']] = $_POST['unit_price_50'];
				$qtn_unit_price[$_POST['qtn_75']] = $_POST['unit_price_75'];
				$qtn_unit_price[$_POST['qtn_100']] = $_POST['unit_price_100'];
				$qtn_unit_price[$_POST['qtn_125']] = $_POST['unit_price_125'];
				$qtn_unit_price[$_POST['qtn_150']] = $_POST['unit_price_150'];
				$qtn_unit_price[$_POST['qtn_175']] = $_POST['unit_price_175'];
				$qtn_unit_price[$_POST['qtn_200']] = $_POST['unit_price_200'];
				$qtn_unit_price['agile_single_price'] = $_POST['aspk_price_single_card'];
				$n_categories = $_POST['catg_name'];
				if( count( $qtn_unit_price ) != 12 ){
					?>
						<script>
							jQuery('#error_div').dialog();
							jQuery('#error_div').html('Please Set All Prices');
						</script>
					<?php return;
				}else{
					$arr = get_option('_aspk_cat_price');
					$arr[$n_categories] = $qtn_unit_price;
					update_option('_aspk_cat_price',$arr);
				}
			}
			?>
				<div style="margin-top:1em;float:left;background-color:white;padding: 1em;padding-left: 3em;">
					<h1>Set Category Prices</h1>

					<div style = "clear:left;">
						<div id = "error_div"></div>
						<form method = "POST">
							<div style="clear:left;float:left;">
								<div style="float:left;width:18em;">
									<select name = "categories" id = "c">
										<?php
											if(!empty($categories)){
												foreach($categories as $category) { ?>
													<option <?php if($categ_name == $category){ echo "selected";}elseif($n_categories == $category){echo "selected";} ?> value = "<?php echo $category;?>"><?php echo $category;?></option>
													<?php
												}
											}
										?>
									</select>
								</div>
								<div style="float:left;width:7em;">
									<input type = "submit" class = "button button-primary" name = "btn_set_price" value = "Get Price" />
								</div>
							</div>
						</form>
					</div>
					<?php if( isset( $_POST['btn_set_price'] ) || isset( $_POST['submit_qtn_price'] )){ ?>
						<?php $set_price = get_option('_aspk_cat_price',null);
							if(isset($categ_name)){
								if(isset($set_price[$categ_name])){
									$price = $set_price[$categ_name];
								}
							}elseif(isset($n_categories)){
								$price = $set_price[$n_categories];
							}
						?>
						<div style = "clear:left;float:left;margin-top:1em;">
							<form action = "" method = "POST">
								<input type = "hidden" name = "catg_name" value = "<?php if(!empty($categ_name)){ echo $categ_name; }else{ echo $n_categories;}  ?>" />
								<div style = "clear:left;float:left;">
									<div style = "float:left;width:12em;"><b>Set single card price</b></div>
									<div style = "float:left;width:10em;">
										<input type = "text" name = "aspk_price_single_card" value = "<?php if(!empty($price)) echo $price['agile_single_price'];    ?>"   />
									</div>
								</div>
								<div style = "clear:left;float:left;margin-top:1em;">
									<div style = "float:left;width:10em;">Quantity</div>
									<div style = "float:left;width:10em;">Price Per Item</div>
								</div>
								<div style = "clear:left;float:left;">
									<div style = "float:left;width:10em;">10</div>
									<div style = "float:left;width:10em;">
										<input type = "hidden" name = "qtn_10" value = "10" />
										<input required type = "text" name= "unit_price_10" placeholder = "Set Price Per Item" value = "<?php if(!empty($price)) echo $price[10];  ?>"/>
									</div>
								</div>
								<div style = "clear:left;float:left;">
									<div style = "float:left;width:10em;">20</div>
									<div style = "float:left;width:10em;">
										<input type = "hidden" name = "qtn_20" value = "20" />
										<input required type = "text" name= "unit_price_20" placeholder = "Set Price Per Item" value = "<?php if(!empty($price)) echo $price[20]; ?>"/>
									</div>
								</div>
								<div style = "clear:left;float:left;">
									<div style = "float:left;width:10em;">30</div>
									<div style = "float:left;width:10em;">
										<input type = "hidden" name = "qtn_30" value = "30" />
										<input required type = "text" name= "unit_price_30" placeholder = "Set Price Per Item" value = "<?php if(!empty($price)) echo $price[30]; ?>" />
									</div>
								</div>
								<div style = "clear:left;float:left;">
									<div style = "float:left;width:10em;">40</div>
									<div style = "float:left;width:10em;">
										<input type = "hidden" name = "qtn_40" value = "40" />
										<input required type = "text" name= "unit_price_40" placeholder = "Set Price Per Item" value = "<?php if(!empty($price)) echo $price[40]; ?>" />
									</div>
								</div>
								<div style = "clear:left;float:left;">
									<div style = "float:left;width:10em;">50</div>
									<div style = "float:left;width:10em;">
										<input type = "hidden" name = "qtn_50" value = "50" />
										<input required type = "text" name= "unit_price_50" placeholder = "Set Price Per Item" value = "<?php if(!empty($price)) echo $price[50]; ?>" />
									</div>
								</div>
								<div style = "clear:left;float:left;">
									<div style = "float:left;width:10em;">75</div>
									<div style = "float:left;width:10em;">
										<input type = "hidden" name = "qtn_75" value = "75" />
										<input required type = "text" name = "unit_price_75" placeholder = "Set Price Per Item" value = "<?php if(!empty($price)) echo $price[75]; ?>" />
									</div>
								</div>
								<div style = "clear:left;float:left;">
									<div style = "float:left;width:10em;">100</div>
									<div style = "float:left;width:10em;">
										<input type = "hidden" name = "qtn_100" value = "100" />
										<input required type = "text" name = "unit_price_100" placeholder = "Set Price Per Item" value = "<?php if(!empty($price)) echo $price[100]; ?>" />
									</div>
								</div>
								<div style = "clear:left;float:left;">
									<div style = "float:left;width:10em;">125</div>
									<div style = "float:left;width:10em;">
										<input type = "hidden" name = "qtn_125" value = "125" />
										<input required type = "text" name= "unit_price_125" placeholder = "Set Price Per Item" value = "<?php if(!empty($price)) echo $price[125]; ?>" />
									</div>
								</div>
								<div style = "clear:left;float:left;">
									<div style = "float:left;width:10em;">150</div>
									<div style = "float:left;width:10em;">
										<input type = "hidden" name = "qtn_150" value = "150" />
										<input required type = "text" name= "unit_price_150" placeholder = "Set Price Per Item" value = "<?php if(!empty($price)) echo $price[150]; ?>" />
									</div>
								</div>
								<div style = "clear:left;float:left;">
									<div style = "float:left;width:10em;">175</div>
									<div style = "float:left;width:10em;">
										<input type = "hidden" name = "qtn_175" value = "175" />
										<input required type = "text" name= "unit_price_175" placeholder = "Set Price Per Item" value = "<?php if(!empty($price)) echo $price[175]; ?>" />
									</div>
								</div>
								<div style = "clear:left;float:left;">
									<div style = "float:left;width:10em;">200</div>
									<div style = "float:left;width:10em;">
										<input type = "hidden" name = "qtn_200" value = "200" />
										<input required type = "text" name= "unit_price_200" placeholder = "Set Price Per Item" value = "<?php if(!empty($price)) echo $price[200]; ?>" />
									</div>
								</div>

								<div style="float:left;clear:left;">
									<div style="float:left;width:10em;">
										<input type = "submit" name = "submit_qtn_price" value = "Save Price" class = "button button-primary" value = "<?php if(!empty($price)) echo $price[19]; ?>" />
									</div>
								</div>
							</form>
						</div>
					<?php } ?>
				</div>

			<?php
		}

		function fe_init(){
			$this->start_session();
		}

		function wp_enqueue_scripts(){
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-slider');
			wp_enqueue_script('jquery-ui-dialog');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-resizable');
			wp_enqueue_script('jquery.ui.widget', plugins_url('baby-thankyoucards/js/jquery.ui.widget.js') );
			wp_enqueue_script('jquery.iframe-transport', plugins_url('baby-thankyoucards/js/jquery.iframe-transport.js') );
			wp_enqueue_script('jquery-fileupload', plugins_url('baby-thankyoucards/js/jquery.fileupload.js') );
			wp_enqueue_script('tw-bs', plugins_url('js/bootstrap.min_.js', __FILE__),array('jquery','jquery-ui-core'),'4.5',true );
			wp_enqueue_script('aspk-text-image-creater', plugins_url('baby-thankyoucards/js/html2canvas.js'),true );
			wp_enqueue_style( 'tw-bs', plugins_url('css/tw-bs.3.1.1.css', __FILE__) );
			wp_enqueue_style( 'baby_thankyoucards', plugins_url('css/style.css', __FILE__) );
			wp_enqueue_style( 'gf-fonts', 'http://fonts.googleapis.com/css?family=Pacifico|Indie+Flower|Pinyon+Script|Playfair+Display|Dancing+Script|Open+Sans|Playball|Josefin+Sans|Lora|PT+Serif|Clicker+Script|Pinyon+Script-regular|Pinyon+Script-cursive|Josefine Sans|Josefine Sans|PT+Serif|Raleway|Indie+Flower|Great+Vibes' );
		}

		function start_session(){
			if(! session_id()){
				session_start();
			}
		}

	} //class ends
}//if class ends

$agile_bt =new Agile_Baby_Thankyou();
