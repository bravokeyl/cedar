<?php
/**
 * @package sellya Sport
 * @subpackage sellya_sport
 */
global $smof_data, $woocommerce, $current_user;

$prefix =  isset($_SERVER['HTTPS'])?'https:':'http:';

?><!DOCTYPE html>
<!--[if IE 7]><html class="ie7 no-js"  dir="ltr" <?php language_attributes( 'html' ) ?>><![endif]-->
<!--[if lte IE 8]><html class="ie8 no-js"  dir="ltr" <?php language_attributes( 'html' ) ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie no-js" dir="ltr" <?php language_attributes( 'html' ) ?>><!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<meta name="description" content="<?php bloginfo('description')?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<link href="<?php echo esc_url($smof_data->oxy_general_settings['oxy_favicon']) ?>" rel="icon" />

<script> document.createElement('header'); document.createElement('section'); document.createElement('article'); document.createElement('aside'); document.createElement('nav'); document.createElement('footer'); </script>

<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo SWPF_THEME_URI; ?>/css/ie8.css" />
<![endif]-->
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo SWPF_THEME_URI; ?>/css/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo SWPF_THEME_URI; ?>/css/ie6.css" />

<![endif]-->


<?php wp_head(); ?>
</head>
<body <?php body_class();?>>

<?php
if(isset($smof_data->oxy_widgets_settings['oxy_facebook_likebox_status'])
        && $smof_data->oxy_widgets_settings['oxy_facebook_likebox_status'] == 1){

    $pos = $smof_data->oxy_widgets_settings['oxy_facebook_likebox_position'];
?>
<div id="fb-root"></div>
<script type="text/javascript">(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=138572636257025&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="facebook_<?php echo esc_attr($pos)?> hide-for-small">
<div id="facebook_icon"></div>
<div class="facebook_box">
  <div class="fb-like-box" data-href="<?php echo esc_url($smof_data->oxy_widgets_settings['oxy_facebook_likebox_id'])?>" data-width="237" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
</div>
</div>
<!--facebook_right-->

<?php
}

if(isset($smof_data->oxy_widgets_settings['oxy_twitter_block_status'])
        && $smof_data->oxy_widgets_settings['oxy_twitter_block_status'] == 1){

    $pos = $smof_data->oxy_widgets_settings['oxy_twitter_block_position'];
?>

<div class="twitter_<?php echo esc_attr($pos);?> hide-for-small">
<div id="twitter_icon"></div>
<div class="twitter_box">
    <p><a class="twitter-timeline"  href="https://twitter.com/<?php echo esc_url($smof_data->oxy_widgets_settings['oxy_twitter_block_user'])?>" data-chrome="noheader nofooter noborders noscrollbar transparent" data-tweet-limit="<?php echo esc_attr($smof_data->oxy_widgets_settings['oxy_twitter_block_tweets'])?>"  data-widget-id="<?php echo esc_attr($smof_data->oxy_widgets_settings['oxy_twitter_block_widget_id'])?>" data-theme="light" data-related="twitterapi,twitter" data-aria-polite="assertive"><?php _e('Tweets by','oxy')?> <?php echo esc_html($smof_data->oxy_widgets_settings['oxy_twitter_block_user'])?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>

</div>
</div>
<!-- twitter_right -->

<?php
}

if(isset($smof_data->oxy_widgets_settings['oxy_video_box_status'])
        && $smof_data->oxy_widgets_settings['oxy_video_box_status'] == 1){

    $pos = $smof_data->oxy_widgets_settings['oxy_video_box_position'];
?>

<div class="video_box_<?php echo esc_attr($pos)?> hide-for-small">
<div id="video_box_icon"></div>
<div class="video_box">
<?php print $smof_data->oxy_widgets_settings['oxy_video_box_content1']?>


</div>
</div>
<!-- .video_box_right -->
<?php
}

if(isset($smof_data->oxy_widgets_settings['oxy_custom_box_status'])
        && $smof_data->oxy_widgets_settings['oxy_custom_box_status'] == 1){

    $pos = $smof_data->oxy_widgets_settings['oxy_custom_box_position'];
?>

<div class="custom_box_<?php echo esc_attr($pos)?> hide-for-small">
<div id="custom_box_icon"></div>
<div class="custom_box">

 <?php
 print get_option('oxy_custom_box_content1');
 ?>

</div>
</div>
<!--.custom_box_right-->

<?php
}
?>

<div class="wrapper">
	<section id="top-line">
		<div class="row">

			<div class="large-5 medium-5 small-12 columns">
                            <div id="top-custom" class="hide-for-medium-down">
                              <?php
                              print get_option('oxy_top_bar_custom_text');
                              ?>
                            </div>
			</div>

			<div class="large-7 medium-7 small-12 columns">
                                <?php
//                                $topmenu = oxy_nav_menu_items('topnav');

                                $menuid = get_nav_menu_locations();
                                if(isset($menuid['topnav'])){
                                    $menu = wp_get_nav_menu_object($menuid['topnav']);
                                    $topmenu = wp_get_nav_menu_items($menu);

                                    if(!empty($topmenu)){
                                    ?>
                                    <div class="my-account hide-for-medium-down">

                                            <div class="lc_dropdown">
                                                    <div id="my-account" class="dropdown_l">
                                                            <div class="arrow"> </div>

                                                            <div class="selected_l"><?php echo isset($topmenu[0]->title) ? $topmenu[0]->title : ''?></div>
                                                               <ul class="options_l">
                                                                       <?php foreach($topmenu as $menu):?>
                                                                      <li><a href="<?php echo esc_url($menu->url)?>"><?php print $menu->title?></a></li>
                                                                      <?php endforeach;?>

                                                               </ul>
                                                    </div>

                                            </div>

                                    </div>
                                <?php }}?>
                                <?php
                                   wp_nav_menu( array( 'theme_location' => 'topnavhor', 'fallback_cb'=>'' , 'container_id' => 'top-menu', 'container_class'=>'', 'menu_class' => '') );
                                ?>
                                <?php if(isset($smof_data->oxy_general_settings['oxy_login_link_header_status'])
                                        && $smof_data->oxy_general_settings['oxy_login_link_header_status'] == 1){?>
                                <div id="welcome">
                                    <?php
                                        if(!is_user_logged_in()){
                                                printf(__('<a href="%s">login</a>'),wp_login_url(get_permalink()),wp_login_url());
                                        }
                                        else{
                                                get_currentuserinfo();
                                                if(isset($current_user->user_login) && !empty($current_user->user_login))
                                                        printf(__('<a href="%s">%s</a> ( <a href="%s">logout</a> )'),admin_url(),$current_user->user_login,wp_logout_url(get_permalink()));
                                        }
                                    ?>
				</div>
                                        <?php }?>
			</div>

		</div>
	</section>
    <!-- top-line-->

<header id="header">
	<div id="t-header" class="row">
                <?php get_template_part('swpf/header-area');?>
		<div class="large-4 medium-4 columns">

                    <?php
                    if(isset(Oxy_header_area::$sds_header_section[0]))
                        echo Oxy_header_area::$sds_header_section[0];
                    ?>

		</div>

		<div class="large-4 medium-4 columns">
                    <?php
                    if(isset(Oxy_header_area::$sds_header_section[1]))
                        echo Oxy_header_area::$sds_header_section[1];
                    ?>

		</div>

		<div class="large-4 medium-4 columns">
                    <?php
                    if($smof_data->oxy_general_settings['oxy_enable_shop'] == 1 && function_exists('WC')){
                    ?>
                    <div id="cart">
                        <div class="heading">
                            <h5><?php _e('Shopping Cart','oxy')?></h5>
                            <a href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'oxy'); ?>">
                              <div id="cart-icon">&nbsp;</div>
                              <?php echo ybt_header_cart();?>
                            </a>
                        </div>
                        <div class="content">
                            <?php ybt_header_carts();?>
                        </div>
                    </div><!--#cart -->
                    <?php
                    }
                    if(isset(Oxy_header_area::$sds_header_section[2]))
                        echo Oxy_header_area::$sds_header_section[2];
                    ?>

		</div>
	</div><!--#t-header-->

	<div class="row">
                <div id="mobile-menu" class="large-12 medium-12 show-for-small-only">
                    <a href="#" class="mobile_menu_trigger"><?php _e('MENU','oxy')?></a>
		<?php
			wp_nav_menu( array( 'theme_location' => 'primary', 'container_id' => '', 'container_class'=>'mobile-nav', 'menu_class' => 'nav', 'walker'=>new Main_nav_menu_walker) );
		?>
		</div>

		<div class="large-12 medium-12 columns show-for-medium-up">
		<?php
			wp_nav_menu( array( 'theme_location' => 'primary', 'container_id' => 'menu', 'container_class'=>'', 'menu_class' => 'nav clearfix', 'walker'=>new Main_nav_menu_walker ) );
		?>
		</div>
	</div>

</header>

<div class="row" id="notification">

</div>
