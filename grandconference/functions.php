<?php
/*
Theme Name: Grand Photography Theme
Theme URI: https://themes.themegoods.com/grandconference
Author: ThemeGoods
Author URI: https://themeforest.net/user/ThemeGoods
License: GPLv2
*/

//Setup theme default constant and data
require_once get_template_directory() . "/lib/config.lib.php";

//Setup theme translation
require_once get_template_directory() . "/lib/translation.lib.php";

//Setup theme admin action handler
require_once get_template_directory() . "/lib/admin.action.lib.php";

//Setup theme support and image size handler
require_once get_template_directory() . "/lib/theme.support.lib.php";

//Get custom function
require_once get_template_directory() . "/lib/custom.lib.php";

//Setup menu settings
require_once get_template_directory() . "/lib/menu.lib.php";

//Setup CSS compression related functions
require_once get_template_directory() . "/lib/cssmin.lib.php";

//Setup JS compression related functions
require_once get_template_directory() . "/lib/jsmin.lib.php";

//Setup Sidebar
require_once get_template_directory() . "/lib/sidebar.lib.php";

//Setup theme custom widgets
require_once get_template_directory() . "/lib/widgets.lib.php";

//Setup required plugin activation
require_once get_template_directory() . "/lib/tgm.lib.php";

//Setup theme admin settings
require_once get_template_directory() . "/lib/admin.lib.php";

//Setup theme admin pointers
require_once get_template_directory() . "/lib/admin.pointer.lib.php";

/**
*	Begin Theme Setting Panel
**/ 

function grandconference_add_admin() 
{
	$grandconference_options = grandconference_get_options();
	
	if ( isset($_GET['page']) && $_GET['page'] == 'functions.php' ) {
	 
		$redirect_uri = '';
	 
		if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {
			$retrieved_nonce = $_REQUEST['_wpnonce'];
			if (!wp_verify_nonce($retrieved_nonce, 'grandconference_save_theme_setting' ) ) die();
			
			//check if verify purchase code
			if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Register')
			{
				if(!empty($_REQUEST['pp_envato_personal_token']) && strlen($_REQUEST['pp_envato_personal_token']) == 36) {
					$url = THEMEGOODS_API.'/register-purchase';
					$data = array(
						'purchase_code' => $_REQUEST['pp_envato_personal_token'], 
						'domain' => $_REQUEST['themegoods-site-domain'],
						'item_id' => ENVATOITEMID,
					);
					$data = wp_json_encode( $data );
					$args = array( 
						'method'   	=> 'POST',
						'body'		=> $data,
					);
					//print '<pre>'; var_dump($args); print '</pre>';
					
					$response = wp_remote_post( $url, $args );
					$response_body = wp_remote_retrieve_body( $response );
					$response_obj = json_decode($response_body);
					
					$response_json = urlencode($response_body);
					//print '<pre>'; var_dump($response_body); print '</pre>';
					//print '<pre>'; var_dump("admin.php?page=functions.php&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']); print '</pre>';
					//die;
					
					if(is_bool($response_obj->response_code)) {
						if($response_obj->response_code) {
							$success_message = "Purchase code is registered.";
							
							if(!empty($response_obj->response)) {
								$error_message = $response_obj->response;
							}
							
							grandconference_register_theme($_REQUEST['pp_envato_personal_token']);
							wp_redirect(admin_url()."?page=functions.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
							
							die;
						}
						else {
							$error_message = "Purchase code is invalid.";
							
							wp_redirect(admin_url()."?page=functions.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
							
							die;
						}
					}
					else {
						$error_message = "Purchase code is invalid";
						
						wp_redirect(admin_url()."?page=functions.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
						
						die;
					}
				}
				else {
					$error_message = "Purchase code is invalid";
					wp_redirect(admin_url()."?page=functions.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
					
					die;
				}
			}
			
			//check if unregister purchase code
			if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Unregister')
			{
				if(!empty($_REQUEST['pp_envato_personal_token']) && strlen($_REQUEST['pp_envato_personal_token']) == 36) {
					$url = THEMEGOODS_API.'/unregister-purchase';
					$data = array(
						'purchase_code' => $_REQUEST['pp_envato_personal_token'], 
						'domain' => $_REQUEST['themegoods-site-domain'],
						'item_id' => ENVATOITEMID,
					);
					$data = wp_json_encode( $data );
					$args = array( 
						'method'   	=> 'POST',
						'body'		=> $data,
					);
					$response = wp_remote_post( $url, $args );
					$response_body = wp_remote_retrieve_body( $response );
					$response_obj = json_decode($response_body);
					
					$response_json = urlencode($response_body);
					/*print '<pre>'; var_dump($args); print '</pre>';
					print '<pre>'; var_dump($response_json); print '</pre>';
					die;*/
					if(is_bool($response_obj->response_code)) {
						if($response_obj->response_code) {
							$success_message = "Purchase code is unregistered.";
							
							if(!empty($response_obj->response)) {
								$error_message = $response_obj->response;
							}
							
							grandconference_unregister_theme();
							wp_redirect(admin_url()."?page=functions.php&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
							
							die;
						}
						else {
							$error_message = "Purchase code is invalid.";
							
							wp_redirect(admin_url()."?page=functions.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
							
							die;
						}
					}
					else {
						$error_message = "Purchase code is invalid";
						
						wp_redirect(admin_url()."?page=functions.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
						
						die;
					}
				}
				else {
					$error_message = "Purchase code is invalid";
					wp_redirect(admin_url()."?page=functions.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
					
					die;
				}
			}
	 
			foreach ($grandconference_options as $value) 
			{
				if($value['type'] != 'image' && isset($value['id']) && isset($_REQUEST[ $value['id'] ]))
				{
					update_option( $value['id'], $_REQUEST[ $value['id'] ] );
				}
			}
			
			foreach ($grandconference_options as $value) {
			
				if( isset($value['id']) && isset( $_REQUEST[ $value['id'] ] )) 
				{ 
	
					if($value['id'] != GRANDCONFERENCE_SHORTNAME."_sidebar0" && $value['id'] != GRANDCONFERENCE_SHORTNAME."_ggfont0")
					{
						//if sortable type
						if(is_admin() && $value['type'] == 'sortable')
						{
							$sortable_array = serialize($_REQUEST[ $value['id'] ]);
							
							$sortable_data = $_REQUEST[ $value['id'].'_sort_data'];
							$sortable_data_arr = explode(',', $sortable_data);
							$new_sortable_data = array();
							
							foreach($sortable_data_arr as $key => $sortable_data_item)
							{
								$sortable_data_item_arr = explode('_', $sortable_data_item);
								
								if(isset($sortable_data_item_arr[0]))
								{
									$new_sortable_data[] = $sortable_data_item_arr[0];
								}
							}
							
							update_option( $value['id'], $sortable_array );
							update_option( $value['id'].'_sort_data', serialize($new_sortable_data) );
						}
						elseif(is_admin() && $value['type'] == 'font')
						{
							if(!empty($_REQUEST[ $value['id'] ]))
							{
								update_option( $value['id'], $_REQUEST[ $value['id'] ] );
								update_option( $value['id'].'_value', $_REQUEST[ $value['id'].'_value' ] );
							}
							else
							{
								delete_option( $value['id'] );
								delete_option( $value['id'].'_value' );
							}
						}
						elseif(is_admin())
						{
							if($value['type']=='image')
							{
								update_option( $value['id'], esc_url($_REQUEST[ $value['id'] ])  );
							}
							elseif($value['type']=='textarea')
							{
								if(isset($value['validation']) && !empty($value['validation']))
								{
									update_option( $value['id'], esc_textarea($_REQUEST[ $value['id'] ]) );
								}
								else
								{
									update_option( $value['id'], $_REQUEST[ $value['id'] ] );
								}
							}
							elseif($value['type']=='iphone_checkboxes' OR $value['type']=='jslider')
							{
								update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
							}
							else
							{
								if(isset($value['validation']) && !empty($value['validation']))
								{
									$request_value = $_REQUEST[ $value['id'] ];
									
									//Begin data validation
									switch($value['validation'])
									{
										case 'text':
										default:
											$request_value = sanitize_text_field($request_value);
										
										break;
										
										case 'email':
											$request_value = sanitize_email($request_value);
	
										break;
										
										case 'javascript':
											$request_value = sanitize_text_field($request_value);
	
										break;
										
									}
									update_option( $value['id'], $request_value);
								}
								else
								{
									update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
								}
							}
						}
					}
					elseif(is_admin() && isset($_REQUEST[ $value['id'] ]) && !empty($_REQUEST[ $value['id'] ]))
					{
						if($value['id'] == GRANDCONFERENCE_SHORTNAME."_sidebar0")
						{
							//get last sidebar serialize array
							$current_sidebar = get_option(GRANDCONFERENCE_SHORTNAME."_sidebar");
							$request_value = $_REQUEST[ $value['id'] ];
							$request_value = sanitize_text_field($request_value);
							
							$current_sidebar[ $request_value ] = $request_value;
				
							update_option( GRANDCONFERENCE_SHORTNAME."_sidebar", $current_sidebar );
						}
						elseif($value['id'] == GRANDCONFERENCE_SHORTNAME."_ggfont0")
						{
							//get last ggfonts serialize array
							$current_ggfont = get_option(GRANDCONFERENCE_SHORTNAME."_ggfont");
							$current_ggfont[ $_REQUEST[ $value['id'] ] ] = $_REQUEST[ $value['id'] ];
				
							update_option( GRANDCONFERENCE_SHORTNAME."_ggfont", $current_ggfont );
						}
					}
				} 
				else 
				{ 
					if(is_admin() && isset($value['id']))
					{
						delete_option( $value['id'] );
					}
				} 
			}
			
			//Check writing cache file for theme options
			$advance_cache_custom_css = get_option(GRANDCONFERENCE_SHORTNAME.'_advance_cache_custom_css');
			
			if($advance_cache_custom_css)
			{
				$css_cache_path = GRANDCONFERENCE_THEMEUPLOAD.'/custom-css.css';
				
				if(!file_exists($css_cache_path))
				{
					//Get custom CSS code to cache
					ob_start(); 
					get_template_part("/modules/custom_css");
					$grandconference_custom_css = ob_get_contents(); 
					ob_end_clean();
					
					//Writing cache file
					file_put_contents($css_cache_path, $grandconference_custom_css);
				}
			}
	
			header("Location: admin.php?page=functions.php&saved=true".$redirect_uri.$_REQUEST['current_tab']);
		}  
	} 
	 
	add_menu_page('Theme Setting', 'Theme Setting', 'administrator', 'functions.php', 'grandconference_admin', '', 3);
}

function grandconference_enqueue_admin_page_scripts() 
{
	$current_screen = grandconference_get_current_screen();
	
	wp_enqueue_style('thickbox');
	
	if(property_exists($current_screen, 'base') && $current_screen->base != 'toplevel_page_revslider' && (isset($_GET['page']) && $_GET['page']!= 'tg-one-click-demo-import'))
	{
		wp_enqueue_style('jquery-ui', get_template_directory_uri().'/functions/jquery-ui/css/custom-theme/jquery-ui-1.8.24.custom.css', false, '1.0', 'all');
	}
	
	wp_enqueue_style('grandconference-functions', get_template_directory_uri().'/functions/functions.css', false, GRANDCONFERENCE_THEMEVERSION, 'all');
	
	if(property_exists($current_screen, 'post_type') && ($current_screen->post_type == 'page' OR $current_screen->post_type == 'portfolios'))
	{
		wp_enqueue_style('grandconference-jqueryui', get_template_directory_uri().'/css/jqueryui/custom.css', false, GRANDCONFERENCE_THEMEVERSION, 'all');
	}
	
	wp_enqueue_style('grandconference-colorpicker', get_template_directory_uri().'/functions/colorpicker/css/colorpicker.css', false, GRANDCONFERENCE_THEMEVERSION, 'all');
	wp_enqueue_style('fancybox', get_template_directory_uri().'/js/fancybox/jquery.fancybox.admin.css', false, GRANDCONFERENCE_THEMEVERSION, 'all');
	wp_enqueue_style('switchery', get_template_directory_uri().'/css/switchery.css', false, GRANDCONFERENCE_THEMEVERSION, 'all');
	wp_enqueue_style('timepicker', get_template_directory_uri().'/functions/jquery.timepicker.css', false, GRANDCONFERENCE_THEMEVERSION, 'all');
	wp_enqueue_style("fontawesome", get_template_directory_uri()."/css/font-awesome.min.css", false, GRANDCONFERENCE_THEMEVERSION, "all");
	//wp_enqueue_style("tooltipster", get_template_directory_uri()."/css/tooltipster.css", false, GRANDCONFERENCE_THEMEVERSION, "all");
	
	if(isset($current_screen->base) && $current_screen->base == 'toplevel_page_functions')
	{
		wp_enqueue_style("codemirror", get_template_directory_uri()."/css/codemirror.css", false, GRANDCONFERENCE_THEMEVERSION, "all");
	}
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery-ui-datepicker');
	
	$ap_vars = array(
	    'url' => esc_url(get_home_url('/')),
	    'includes_url' => esc_url(includes_url())
	);
	
	wp_register_script( 'js-wpeditor', get_template_directory_uri() . '/functions/js-wp-editor.js', array( 'jquery' ), '1.1', true );
	wp_localize_script( 'js-wpeditor', 'ap_vars', $ap_vars );
	wp_enqueue_script( 'js-wpeditor' );
	
	wp_enqueue_script('grandconference-colorpicker', get_template_directory_uri().'/functions/colorpicker/js/colorpicker.js', false, GRANDCONFERENCE_THEMEVERSION);
	wp_enqueue_script('eye', get_template_directory_uri().'/functions/colorpicker/js/eye.js', false, GRANDCONFERENCE_THEMEVERSION);
	wp_enqueue_script('utils', get_template_directory_uri().'/functions/colorpicker/js/utils.js', false, GRANDCONFERENCE_THEMEVERSION);
	wp_enqueue_script('switchery', get_template_directory_uri().'/functions/switchery.js', false, GRANDCONFERENCE_THEMEVERSION);
	wp_enqueue_script('fancybox', get_template_directory_uri().'/js/fancybox/jquery.fancybox.admin.js', false, GRANDCONFERENCE_THEMEVERSION);
	wp_enqueue_script('timepicker', get_template_directory_uri().'/functions/jquery.timepicker.js', false, GRANDCONFERENCE_THEMEVERSION);
	//wp_enqueue_script('tooltipster', get_template_directory_uri().'/js/jquery.tooltipster.min.js', false, GRANDCONFERENCE_THEMEVERSION);
	
	if(isset($current_screen->base) && $current_screen->base == 'toplevel_page_functions')
	{
		wp_enqueue_script('codemirror', get_template_directory_uri().'/functions/codemirror.js', false, GRANDCONFERENCE_THEMEVERSION);
		wp_enqueue_script('codemirror-css', get_template_directory_uri().'/functions/css.js', false, GRANDCONFERENCE_THEMEVERSION);
	}
	
	wp_register_script('grandconference-theme-script', get_template_directory_uri().'/functions/theme_script.js', false, GRANDCONFERENCE_THEMEVERSION, true);
	$params = array(
	  	'ajaxurl' => esc_url(admin_url('admin-ajax.php')),
	  	'nonce' => wp_create_nonce( 'wp_rest' ),
		'tgurl' => THEMEGOODS_API,
		'itemid' => ENVATOITEMID,
		'purchaseurl' => THEMEGOODS_PURCHASE_URL,
	);
	wp_localize_script( 'grandconference-theme-script', 'tgAjax', $params );
	wp_enqueue_script( 'grandconference-theme-script' );
}

add_action('admin_enqueue_scripts',	'grandconference_enqueue_admin_page_scripts' );

function grandconference_enqueue_front_page_scripts() 
{
	wp_enqueue_style("grandconference-reset-css", get_template_directory_uri()."/css/reset.css", false, "");
	wp_enqueue_style("grandconference-wordpress-css", get_template_directory_uri()."/css/wordpress.css", false, "");
	wp_enqueue_style("grandconference-animation-css", get_template_directory_uri()."/css/animation.css", false, "", "all");
	wp_enqueue_style("ilightbox", get_template_directory_uri()."/css/ilightbox/ilightbox.css", false, "", "all");
	wp_enqueue_style('grandconference-jqueryui', get_template_directory_uri().'/css/jqueryui/custom.css', false, "", 'all');
	wp_enqueue_style("mediaelement", get_template_directory_uri()."/js/mediaelement/mediaelementplayer.css", false, "", "all");
	wp_enqueue_style("flexslider", get_template_directory_uri()."/js/flexslider/flexslider.css", false, "", "all");
	wp_enqueue_style("tooltipster", get_template_directory_uri()."/css/tooltipster.css", false, "", "all");
	wp_enqueue_style("odometer-theme", get_template_directory_uri()."/css/odometer-theme-minimal.css", false, "", "all");
	wp_enqueue_style("grandconference-screen", get_template_directory_uri().'/css/screen.css', false, "", "all");
	
	//Check menu layout
	$tg_menu_layout = grandconference_menu_layout();
	
	switch($tg_menu_layout)
	{
		case 'leftalign':
			wp_enqueue_style("grandconference-leftalignmenu", get_template_directory_uri().'/css/menus/leftalignmenu.css', false, "", "all");
		break;
		
		case 'hammenufull':
			wp_enqueue_style("grandconference-hammenufull", get_template_directory_uri().'/css/menus/hammenufull.css', false, "", "all");
		break;
		
		case 'centeralogo':
			wp_enqueue_style("grandconference-centeralogo", get_template_directory_uri().'/css/menus/centeralogo.css', false, "", "all");
		break;
	}
	
	//Add Font Awesome Support
	wp_enqueue_style("fontawesome", get_template_directory_uri()."/css/font-awesome.min.css", false, "", "all");
	wp_enqueue_style("themify-icons", get_template_directory_uri()."/css/themify-icons.css", false, GRANDCONFERENCE_THEMEVERSION, "all");
	
	$tg_boxed = get_theme_mod('tg_boxed');
    if(GRANDCONFERENCE_THEMEDEMO && isset($_GET['boxed']) && !empty($_GET['boxed']))
    {
    	$tg_boxed = 1;
    }
    
    if(!empty($tg_boxed) && $tg_menu_layout != 'leftmenu')
    {
    	wp_enqueue_style("grandconference-boxed", get_template_directory_uri().'/css/tg_boxed.css', false, "", "all");
    }
    
    $tg_frame = get_theme_mod('tg_frame');
    if(GRANDCONFERENCE_THEMEDEMO && isset($_GET['frame']) && !empty($_GET['frame']))
    {
	    $tg_frame = 1;
    }
    
    if(!empty($tg_frame))
    {
    	wp_enqueue_style("tg_frame", get_template_directory_uri()."/css/tg_frame.css", false, GRANDCONFERENCE_THEMEVERSION, "all");
    }
    
    //Add custom CSS
    if(GRANDCONFERENCE_THEMEDEMO && isset($_GET['menulayout']) && !empty($_GET['menulayout']))
	{
		wp_enqueue_style("grandconference-script-custom-css", admin_url('admin-ajax.php')."?action=grandconference_custom_css&menulayout=".$_GET['menulayout'], false, "", "all");
	}
	else
	{
		//Check writing cache file for theme options
		$advance_cache_custom_css = get_option(GRANDCONFERENCE_SHORTNAME.'_advance_cache_custom_css');
		
		if($advance_cache_custom_css)
		{
			$css_cache_path = GRANDCONFERENCE_THEMEUPLOAD.'/custom-css.css';
			
			if(!file_exists($css_cache_path))
			{
				//Get custom CSS code to cache
				ob_start(); 
				get_template_part("/modules/custom_css");
				$grandconference_custom_css = ob_get_contents(); 
				ob_end_clean();
				
				//Writing cache file
				file_put_contents($css_cache_path, $grandconference_custom_css);
				
				//Refresh page
				header('Location: '.$_SERVER['REQUEST_URI']);
			}
			
			wp_enqueue_style("grandconference-custom-css", GRANDCONFERENCE_THEMEUPLOADURL."custom-css.css", false, "", "all");
		}
		else {
			wp_enqueue_style("grandconference-script-custom-css", admin_url('admin-ajax.php')."?action=grandconference_custom_css", false, "", "all");	
		}
	}
	
	//If using child theme
	if(is_child_theme())
	{
	    wp_enqueue_style('grandconference-childtheme', get_stylesheet_directory_uri()."/style.css", false, "", "all");
	}
	
	//Enqueue javascripts
	wp_enqueue_script('jquery-ui-core');
	
	$js_path = get_template_directory()."/js/";
	$js_arr = array(
		'requestAnimationFrame' 	=> 'jquery.requestAnimationFrame.js',
		'ilightbox'					=> 'ilightbox.packed.js',
		'easing'					=> 'jquery.easing.js',
	    'waypoints'					=> 'waypoints.min.js',
	    'isotope'					=> 'jquery.isotope.js',
	    'masory'					=> 'jquery.masory.js',
	    'tooltipster'				=> 'jquery.tooltipster.min.js',
	    'jarallax'					=> 'jarallax.js',
	    'sticky-kit'				=> 'jquery.sticky-kit.min.js',
	    'stellar'					=> 'jquery.stellar.min.js',
	    'cookie'					=> 'jquery.cookie.js',
	    'grandconference-custom-plugins'	=> 'custom_plugins.js',
	    'grandconference-custom-script' 	=>'custom.js',
	);
	$js = "";

	foreach($js_arr as $key => $file) {
		if($file != 'jquery.js' && $file != 'jquery-ui.js')
		{
			wp_enqueue_script($key, get_template_directory_uri()."/js/".$file, false, "", true);
		}
	}
	
	//If display photostream
	$pp_photostream = get_option('pp_photostream');
	
	if(!empty($pp_photostream))
	{
		wp_enqueue_script("modernizr", get_template_directory_uri()."/js/modernizr.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		wp_enqueue_script("gridrotator", get_template_directory_uri()."/js/jquery.gridrotator.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		wp_enqueue_script("grandconference-script-footer-gridrotator", admin_url('admin-ajax.php')."?action=grandconference_script_gridrotator&grid=footer_photostream&amp;rows=1", false, GRANDCONFERENCE_THEMEVERSION, true);
	}
	
}
add_action( 'wp_enqueue_scripts', 'grandconference_enqueue_front_page_scripts' );


//Enqueue mobile CSS after all others CSS load
function grandconference_register_mobile_css() 
{
	//Check if enable responsive layout
	//enqueue frontend css files
	wp_enqueue_style('grandconference-script-responsive-css', get_template_directory_uri()."/css/grid.css", false, "", "all");
}
add_action('wp_enqueue_scripts', 'grandconference_register_mobile_css', 99);


function grandconference_admin() 
{ 
	$grandconference_options = grandconference_get_options();
	$i=0;
	
	$pp_font_family = get_option('pp_font_family');
	
	if(function_exists( 'wp_enqueue_media' )){
	    wp_enqueue_media();
	}
	?>
		
		<div id="pp_loading"><span><?php esc_html_e('Updating...', 'grandconference' ); ?></span></div>
		<div id="pp_success"><span><?php esc_html_e('Successfully Update', 'grandconference' ); ?></span></div>
		
		<form id="pp_form" method="post" enctype="multipart/form-data">
		<div class="pp_wrap rm_wrap">
		
		<div class="header_wrap">
			<div style="float:left">
			<?php
				//Display logo in theme setting
				$tg_retina_logo_for_admin = get_theme_mod('tg_retina_logo_for_admin');
				$tg_retina_logo = get_theme_mod('tg_retina_logo', get_template_directory_uri().'/images/logo@2x.png');
				
				if(empty($tg_retina_logo_for_admin))
				{
			?>
			<h2><?php esc_html_e('Theme Setting', 'grandconference' ); ?><span class="pp_version"><?php esc_html_e('Version', 'grandconference' ); ?> <?php echo GRANDCONFERENCE_THEMEVERSION; ?></span></h2>
			<?php
				}
				else if(!empty($tg_retina_logo))
				{
			?>
			<div class="pp_setting_logo_wrapper">
			<?php
					//Get image width and height
			    	$image_id = grandconference_get_image_id($tg_retina_logo);
			    	if(!empty($image_id))
			    	{
			    		$obj_image = wp_get_attachment_image_src($image_id, 'original');
			    		
			    		$image_width = 0;
				    	$image_height = 0;
				    	
				    	if(isset($obj_image[1]))
				    	{
				    		$image_width = intval($obj_image[1]/2);
				    	}
				    	if(isset($obj_image[2]))
				    	{
				    		$image_height = intval($obj_image[2]/2);
				    	}
			    	}
			    	else
			    	{
				    	$image_width = 0;
				    	$image_height = 0;
			    	}
						
					if($image_width > 0 && $image_height > 0)
					{
					?>
					<img src="<?php echo esc_url($tg_retina_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>"/>
					<?php
					}
					else
					{
					?>
	    	    	<img src="<?php echo esc_url($tg_retina_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="158" height ="20"/>
	    	    <?php 
		    	    }
		    	?>
		    	<span class="pp_version"><?php esc_html_e('Version', 'grandconference' ); ?> <?php echo GRANDCONFERENCE_THEMEVERSION; ?></span>
			</div>
			<?php
				}
			?>
			</div>
			<div style="float:right;margin:32px 0 0 0">
				<input id="save_ppsettings" name="save_ppsettings" class="button button-primary button-large" type="submit" value="<?php esc_html_e('Save', 'grandconference' ); ?>" />
				<br/><br/>
				<input type="hidden" name="action" value="save" />
				<input type="hidden" name="current_tab" id="current_tab" value="#pp_panel_registration" />
				<?php wp_nonce_field('grandconference_save_theme_setting'); ?>
			</div>
			<input type="hidden" name="pp_admin_url" id="pp_admin_url" value="<?php echo get_template_directory_uri(); ?>"/>
			<br style="clear:both"/><br/>
	
	<?php
		//Check if theme has new update
	?>
	
		</div>
		
		<div class="pp_wrap">
		<div id="pp_panel">
		<?php 
			foreach ($grandconference_options as $value) {
				
				$active = '';
				
				if($value['type'] == 'section')
				{
					if($value['name'] == 'Registration')
					{
						$active = 'nav-tab-active';
					}
					echo '<a id="pp_panel_'.strtolower($value['name']).'_a" href="#pp_panel_'.strtolower($value['name']).'" class="nav-tab '.esc_attr($active).'">'.str_replace('-', ' ', $value['name']).'</a>';
				}
			}
		?>
		</h2>
		</div>
	
		<div class="rm_opts">
		
	<?php 
	$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	
	foreach ($grandconference_options as $value) {
	switch ( $value['type'] ) {
	 
	case "open":
	?> <?php break;
	 
	case "close":
	?>
		
		</div>
		</div>
	
	
		<?php break;
	 
	case "title":
	?>
		<br />
	
	
	<?php break;
	 
	case 'text':
		
		//if sidebar input then not show default value
		if($value['id'] != GRANDCONFERENCE_SHORTNAME."_sidebar0" && $value['id'] != GRANDCONFERENCE_SHORTNAME."_ggfont0")
		{
			$default_val = get_option( $value['id'] );
		}
		else
		{
			$default_val = '';	
		}
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_text"><label for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label>
		
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		
		<input name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" type="<?php echo esc_attr($value['type']); ?>"
			value="<?php if ($default_val != "") { echo esc_attr(get_option( $value['id'])) ; } else { echo esc_attr($value['std']); } ?>"
			<?php if(!empty($value['size'])) { echo 'style="width:'.intval($value['size']).'"'; } ?> />
		<div class="clearfix"></div>
		
		<?php
		if($value['id'] == GRANDCONFERENCE_SHORTNAME."_sidebar0")
		{
			$current_sidebar = get_option(GRANDCONFERENCE_SHORTNAME."_sidebar");
			
			if(!empty($current_sidebar))
			{
		?>
			<br class="clear"/><br/>
		 	<div class="pp_sortable_wrapper">
			<ul id="current_sidebar" class="rm_list">
	
		<?php
			foreach($current_sidebar as $sidebar)
			{
		?> 
				
				<li id="<?php echo esc_attr($sidebar); ?>"><div class="title"><?php echo esc_html($sidebar); ?></div><a href="<?php echo esc_url($url); ?>" class="sidebar_del" rel="<?php echo esc_attr($sidebar); ?>"><span class="dashicons dashicons-no"></span></a><br style="clear:both"/></li>
		
		<?php
			}
		?>
		
			</ul>
			</div>
			<br style="clear:both"/>
		<?php
			}
		}
		?>
	
		</div>
		<?php
	break;
	
	case 'colorpicker':
	?>
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_text"><label for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
		<input name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" type="text" 
			value="<?php if ( get_option( $value['id'] ) != "" ) { echo stripslashes(get_option( $value['id'])  ); } else { echo esc_attr($value['std']); } ?>"
			<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?>  class="color_picker" readonly/>
		<div id="<?php echo esc_attr($value['id']); ?>_bg" class="colorpicker_bg" onclick="jQuery('#<?php echo esc_js($value['id']); ?>').click()" style="background:<?php if (get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo esc_attr($value['std']); } ?> url(<?php echo get_template_directory_uri(); ?>/functions/images/trigger.png) center no-repeat;">&nbsp;</div>
			<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		
		</div>
		
	<?php
	break;
	 
	case 'textarea':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_textarea"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label>
			
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		
		<textarea id="<?php echo esc_attr($value['id']); ?>" name="<?php echo esc_attr($value['id']); ?>"
			type="<?php echo esc_attr($value['type']); ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo esc_html($value['std']); } ?></textarea>
		
		<div class="clearfix"></div>
	
		</div>
	
		<?php
	break;
	
	case 'css':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_textarea"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label>
			
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		
		<textarea id="<?php echo esc_attr($value['id']); ?>" class="css" name="<?php echo esc_attr($value['id']); ?>"
			type="<?php echo esc_attr($value['type']); ?>"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo esc_html($value['std']); } ?></textarea>
		
		<div class="clearfix"></div>
	
		</div>
	
		<?php
	break;
	 
	case 'select':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_select"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<select name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>">
			<?php foreach ($value['options'] as $key => $option) { ?>
			<option
			<?php if (get_option( $value['id'] ) == $key) { echo 'selected="selected"'; } ?>
				value="<?php echo esc_attr($key); ?>"><?php echo esc_html($option); ?></option>
			<?php } ?>
		</select> <small class="description"><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		</div>
		<?php
	break;
	
	case 'font':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_font"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<div id="<?php echo esc_attr($value['id']); ?>_wrapper" style="float:left;font-size:11px;">
		<select class="pp_font" data-sample="<?php echo esc_attr($value['id']); ?>_sample" data-value="<?php echo esc_attr($value['id']); ?>_value" name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>">
			<option value="" data-family="">---- <?php esc_html_e('Theme Default Font', 'grandconference' ); ?> ----</option>
			<?php 
				foreach ($pp_font_arr as $key => $option) { ?>
			<option
			<?php if (get_option( $value['id'] ) == $option['css-name']) { echo 'selected="selected"'; } ?>
				value="<?php echo esc_attr($option['css-name']); ?>" data-family="<?php echo esc_attr($option['font-name']); ?>"><?php echo esc_html($option['font-name']); ?></option>
			<?php } ?>
		</select> 
		<input type="hidden" id="<?php echo esc_attr($value['id']); ?>_value" name="<?php echo esc_attr($value['id']); ?>_value" value="<?php echo get_option( $value['id'].'_value' ); ?>"/>
		<br/><br/><div id="<?php echo esc_attr($value['id']); ?>_sample" class="pp_sample_text"><?php esc_html_e('Sample Text', 'grandconference' ); ?></div>
		</div>
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		</div>
		<?php
	break;
	 
	case 'radio':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_select"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/><br/>
	
		<div style="margin-top:5px;float:left;<?php if(!empty($value['desc'])) { ?>width:300px<?php } else { ?>width:500px<?php } ?>">
		<?php foreach ($value['options'] as $key => $option) { ?>
		<div style="float:left;<?php if(!empty($value['desc'])) { ?>margin:0 20px 20px 0<?php } ?>">
			<input style="float:left;" id="<?php echo esc_attr($value['id']); ?>" name="<?php echo esc_attr($value['id']); ?>" type="radio"
			<?php if (get_option( $value['id'] ) == $key) { echo 'checked="checked"'; } ?>
				value="<?php echo esc_attr($key); ?>"/><?php echo esc_html($option); ?>
		</div>
		<?php } ?>
		</div>
		
		<?php if(!empty($value['desc'])) { ?>
			<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		<?php } ?>
		<div class="clearfix"></div>
		</div>
		<?php
	break;
	
	case 'sortable':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_select"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<div style="float:left;width:100%;">
		<?php 
		$sortable_array = array();
		if(get_option( $value['id'] ) != 1)
		{
			$sortable_array = unserialize(get_option( $value['id'] ));
		}
		
		$current = 1;
		
		if(!empty($value['options']))
		{
		?>
		<select name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" class="pp_sortable_select">
		<?php
		foreach ($value['options'] as $key => $option) { 
			if($key > 0)
			{
		?>
		<option value="<?php echo esc_attr($key); ?>" data-rel="<?php echo esc_attr($value['id']); ?>_sort" title="<?php echo html_entity_decode($option); ?>"><?php echo html_entity_decode($option); ?></option>
		<?php }
		
				if($current>1 && ($current-1)%3 == 0)
				{
		?>
		
				<br style="clear:both"/>
		
		<?php		
				}
				
				$current++;
			}
		?>
		</select>
		<a class="button pp_sortable_button" data-rel="<?php echo esc_attr($value['id']); ?>" class="button" style="display:inline-block"><?php echo esc_html__('Add', 'grandconference' ); ?></a>
		<?php
		}
		?>
		 
		 <br style="clear:both"/><br/>
		 
		 <div class="pp_sortable_wrapper">
		 <ul id="<?php echo esc_attr($value['id']); ?>_sort" class="pp_sortable" rel="<?php echo esc_attr($value['id']); ?>_sort_data"> 
		 <?php
		 	$sortable_data_array = unserialize(get_option( $value['id'].'_sort_data' ));
	
		 	if(!empty($sortable_data_array))
		 	{
		 		foreach($sortable_data_array as $key => $sortable_data_item)
		 		{
			 		if(!empty($sortable_data_item))
			 		{
		 		
		 ?>
		 		<li id="<?php echo esc_attr($sortable_data_item); ?>_sort" class="ui-state-default"><div class="title"><?php echo esc_html($value['options'][$sortable_data_item]); ?></div><a data-rel="<?php echo esc_attr($value['id']); ?>_sort" href="javascript:;" class="remove"><i class="fa fa-trash"></i></a><br style="clear:both"/></li> 	
		 <?php
		 			}
		 		}
		 	}
		 ?>
		 </ul>
		 
		 </div>
		 
		</div>
		
		<input type="hidden" id="<?php echo esc_attr($value['id']); ?>_sort_data" name="<?php echo esc_attr($value['id']); ?>_sort_data" value="" style="width:100%"/>
		<br style="clear:both"/><br/>
		
		<div class="clearfix"></div>
		</div>
		<?php
	break;
	 
	case "checkbox":
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_checkbox"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
		<input type="checkbox" name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" value="true" <?php echo esc_html($checked); ?> />
	
	
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		</div>
	<?php break; 
	
	case "iphone_checkboxes":
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_checkbox"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label>
	
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
	
		<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
		<input type="checkbox" class="iphone_checkboxes" name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" value="true" <?php echo esc_html($checked); ?> />
	
		<div class="clearfix"></div>
		</div>
	
	<?php break; 
	
	case "html":
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_checkbox"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
	
		<?php echo stripslashes($value['html']); ?>
	
		<div class="clearfix"></div>
		</div>
	
	<?php break; 
	
	case "shortcut":
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_shortcut">
	
		<ul class="pp_shortcut_wrapper">
		<?php 
			$count_shortcut = 1;
			foreach ($value['options'] as $key_shortcut => $option) { ?>
			<li><a href="#<?php echo esc_attr($key_shortcut); ?>" <?php if($count_shortcut==1) { ?>class="active"<?php } ?>><?php echo esc_html($option); ?></a></li>
		<?php $count_shortcut++; } ?>
		</ul>
	
		<div class="clearfix"></div>
		</div>
	
	<?php break; 
		
	case "section":
	
	$i++;
	
	?>
	
		<div id="pp_panel_<?php echo strtolower($value['name']); ?>" class="rm_section">
		<div class="rm_title">
		<h3><img
			src="<?php echo get_template_directory_uri(); ?>/functions/images/trans.png"
			class="inactive" alt=""><?php echo stripslashes($value['name']); ?></h3>
		<span class="submit"><input class="button-primary" name="save<?php echo esc_attr($i); ?>" type="submit"
			value="Save changes" /> </span>
		<div class="clearfix"></div>
		</div>
		<div class="rm_options"><?php break;
	 
	}
	}
	?>
	 	
	 	<div class="clearfix"></div>
	 	</form>
	 	</div>
	</div>
<?php
}

add_action('admin_menu', 'grandconference_add_admin');

/**
*	End Theme Setting Panel
**/ 


//Setup theme custom filters
require_once get_template_directory() . "/lib/theme.filter.lib.php";

//Setup theme Gutenberg compatibility
require_once get_template_directory() . "/lib/gutenberg.lib.php";

//Setup Theme Customizer
require_once get_template_directory() . "/modules/kirki/kirki.php";
require_once get_template_directory() . "/lib/customizer.lib.php";

//Setup page custom fields and action handler
require_once get_template_directory() . "/fields/page.fields.php";

//Setup content builder
require_once get_template_directory() . "/modules/content_builder.php";

// Setup shortcode generator
require_once get_template_directory() . "/modules/shortcode_generator.php";


//Check if Woocommerce is installed	
if(class_exists('Woocommerce'))
{
	//Setup Woocommerce Config
	require_once get_template_directory() . "/modules/woocommerce.php";
}

/**
*	Setup one click importer function
**/
add_action('wp_ajax_grandconference_import_demo_content', 'grandconference_import_demo_content');

function grandconference_import_demo_content() {
	$retrieved_nonce = $_REQUEST['_wpnonce'];
	if (!wp_verify_nonce($retrieved_nonce, 'grandconference_import_demo_content' ) ) die();

	if(is_admin() && isset($_POST['demo']) && !empty($_POST['demo']))
	{
	    if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
	    
	    // Load Importer API
	    require_once ABSPATH . 'wp-admin/includes/import.php';
	
	    if ( ! class_exists( 'WP_Importer' ) ) {
	        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	        if ( file_exists( $class_wp_importer ) )
	        {
	            require_once $class_wp_importer;
	        }
	    }
	
	    if ( ! class_exists( 'WP_Import' ) ) {
	    	$class_wp_importer = get_template_directory() ."/modules/import/wordpress-importer.php";

	        if ( file_exists( $class_wp_importer ) )
	            require_once $class_wp_importer;
	    }
	
	    $import_files = array();
	    $page_on_front ='';
	    $styling_file = '';
	    $import_widget_filepath = '';
	    
	    switch($_POST['demo'])
	    {
		    case 1:
		    default:
			    //Create empty menu first before importing
			    $main_menu_exists = wp_get_nav_menu_object('Main Menu');
			    if(!$main_menu_exists)
			    {
				    $main_menu_id = wp_create_nav_menu('Main Menu');
			    }
			    
			    $top_menu_exists = wp_get_nav_menu_object('Top Bar Menu');
			    if(!$top_menu_exists)
			    {
				    $top_menu_id = wp_create_nav_menu('Top Bar Menu');
			    }
			break;
			
			case 2:
			case 3:
			    //Create empty menu first before importing
			    $main_menu_exists = wp_get_nav_menu_object('Main Menu');
			    if(!$main_menu_exists)
			    {
				    $main_menu_id = wp_create_nav_menu('Main Menu');
			    }
			    
			    $side_menu_exists = wp_get_nav_menu_object('Side Menu');
			    if(!$side_menu_exists)
			    {
				    $side_menu_id = wp_create_nav_menu('Side Menu');
			    }
			break;
	    }

		//Check import selected demo
	    if ( class_exists( 'WP_Import' ) ) 
	    { 
	    	switch($_POST['demo'])
	    	{
		    	case 1:
		    	default:
		    		//Check if install Woocommerce
		    		if(!class_exists('Woocommerce'))
					{
		    			$import_filepath = get_template_directory() ."/cache/demos/xml/demo1/1.xml" ;
		    		}
		    		else
		    		{
			    		$import_filepath = get_template_directory() ."/cache/demos/xml/demo1/1_woo.xml" ;
		    		}
		    		
		    		$styling_file = get_template_directory() . "/cache/demos/xml/demo1/1.dat";
		    		$import_widget_filepath = get_template_directory() ."/cache/demos/xml/demo1/1.wie" ;
		    		
		    		$page_on_front = 350; //Demo Homepage ID
		    		$oldurl = 'https://themes.themegoods.com/grandconference/demo';
		    	break;
		    	
		    	case 2:
		    		$import_filepath = get_template_directory() ."/cache/demos/xml/demo2/2.xml" ;
		    		$styling_file = get_template_directory() . "/cache/demos/xml/demo2/2.dat";
		    		$import_widget_filepath = get_template_directory() ."/cache/demos/xml/demo2/2.wie" ;
		    		
		    		$page_on_front = 259; //Demo Homepage ID
		    		$oldurl = 'https://themes.themegoods.com/grandconference/demo2';
		    	break;
		    	
		    	case 3:
		    		$import_filepath = get_template_directory() ."/cache/demos/xml/demo3/3.xml" ;
		    		$styling_file = get_template_directory() . "/cache/demos/xml/demo3/3.dat";
		    		$import_widget_filepath = get_template_directory() ."/cache/demos/xml/demo3/3.wie" ;
		    		
		    		$page_on_front = 291; //Demo Homepage ID
		    		$oldurl = 'https://themes.themegoods.com/grandconference/demo3';
		    	break;
	    	}
			
			//Run and download demo contents
			$wp_import = new WP_Import();
	        $wp_import->fetch_attachments = true;
	        $wp_import->import($import_filepath);
	        
	        //Remove default Hello World post
	        wp_delete_post(1);
	    }
	    
	    //Setup default front page settings.
	    update_option('show_on_front', 'page');
	    update_option('page_on_front', $page_on_front);
	    
	    //Set default custom menu settings
	    $locations = get_theme_mod('nav_menu_locations');
	    switch($_POST['demo'])
	    {
		    case 1:
		    default:
		    	$locations['primary-menu'] = $main_menu_id;
				$locations['top-menu'] = $top_menu_id;
				$locations['side-menu'] = $main_menu_id;
		    break;
		    
		    case 2:
		    case 3:
		    	$locations['primary-menu'] = $main_menu_id;
				$locations['side-menu'] = $side_menu_id;
				$locations['footer-menu'] = $side_menu_id;
		    break;
	    }
		set_theme_mod( 'nav_menu_locations', $locations );

		if(file_exists($styling_file))
		{
			WP_Filesystem();
			$wp_filesystem = grandconference_get_wp_filesystem();
			$styling_data = $wp_filesystem->get_contents($styling_file);
			$styling_data_arr = unserialize($styling_data);
			
			if(isset($styling_data_arr['mods']) && is_array($styling_data_arr['mods']))
			{	
				// Get menu locations and save to array
				$locations = get_theme_mod('nav_menu_locations');
				$save_menus = array();
				foreach( $locations as $key => $val ) 
				{
					$save_menus[$key] = $val;
				}
			
				//Remove all theme customizer
				remove_theme_mods();
				
				//Re-add the menus
				set_theme_mod('nav_menu_locations', array_map( 'absint', $save_menus ));
			
				foreach($styling_data_arr['mods'] as $key => $styling_mod)
				{
					if(!is_array($styling_mod))
					{
						set_theme_mod( $key, $styling_mod );
					}
				}
			}
		}
		
		//Import widgets
		if(file_exists($import_widget_filepath))
		{
			// Get file contents and decode
			WP_Filesystem();
			$wp_filesystem = grandconference_get_wp_filesystem();
			$data = $wp_filesystem->get_contents($import_widget_filepath);
			$data = json_decode( $data );
		
			// Import the widget data
			// Make results available for display on import/export page
			$widget_import_results = grandconference_import_data( $data );
		}
		
		//Import Revolution Slider if activate
		if(class_exists('RevSlider'))
		{
			$slider_array = array();
			
			switch($_POST['demo'])
	    	{
		    	case 1:
		    	default:
		    		$slider_array = array(
		    			get_template_directory() ."/cache/demos/xml/demo1/home-1-slider.zip",
		    			get_template_directory() ."/cache/demos/xml/demo1/home-2-slider.zip",
		    			get_template_directory() ."/cache/demos/xml/demo1/home-3-slider.zip",
		    			get_template_directory() ."/cache/demos/xml/demo1/home-4-slider.zip",
		    		);
		    	break;
		    	
		    	case 2:
		    		$slider_array = array(
		    			get_template_directory() ."/cache/demos/xml/demo2/demo2-slider.zip",
		    		);
		    	break;
		    	
		    	case 3:
		    		$slider_array = array(
		    			get_template_directory() ."/cache/demos/xml/demo3/demo3-slider.zip",
		    		);
		    	break;
	    	}
	    	
	    	if(!empty($slider_array))
	    	{
		    	require_once ABSPATH . 'wp-admin/includes/file.php';
				$obj_revslider = new RevSlider();
				
				foreach($slider_array as $revslider_filepath)
				{
					$obj_revslider->importSliderFromPost(true,true,$revslider_filepath);
				}
			}
		}
		
		//Change all URLs from demo URL to localhost
		$update_options = array ( 0 => 'content', 1 => 'excerpts', 2 => 'links', 3 => 'attachments', 4 => 'custom', 5 => 'guids', );
		$newurl = esc_url( site_url() ) ;
		grandconference_update_urls($update_options, $oldurl, $newurl);
		
		//Remove unwanted options
		//Remove demo logo
		remove_theme_mod('tg_favicon');
		remove_theme_mod('tg_retina_logo');
		remove_theme_mod('tg_retina_transparent_logo');
		
		//Refresh rewrite rules
		flush_rewrite_rules();
	    
		exit();
	}
}

/**
*	Setup get styling function
**/
add_action('wp_ajax_grandconference_get_styling', 'grandconference_get_styling');

function grandconference_get_styling() {
	$retrieved_nonce = $_REQUEST['_wpnonce'];
	if (!wp_verify_nonce($retrieved_nonce, 'grandconference_import_styling' ) ) die();
	
	if(is_admin() && isset($_POST['styling']) && !empty($_POST['styling']))
	{
		$styling_file = get_template_directory() . "/cache/demos/customizer/settings/".$_POST['styling'].".dat";

		if(file_exists($styling_file))
		{
			WP_Filesystem();
			$wp_filesystem = grandconference_get_wp_filesystem();
			$styling_data = $wp_filesystem->get_contents($styling_file);
			$styling_data_arr = unserialize($styling_data);
			
			if(isset($styling_data_arr['mods']) && is_array($styling_data_arr['mods']))
			{	
				// Get menu locations and save to array
				$locations = get_theme_mod('nav_menu_locations');
				$save_menus = array();
				
				if(!empty($locations) && is_array($locations))
				{
					foreach( $locations as $key => $val ) 
					{
						$save_menus[$key] = $val;
					}
				}
			
				//Remove all theme customizer
				remove_theme_mods();
				
				//Re-add the menus
				set_theme_mod('nav_menu_locations', array_map( 'absint', $save_menus ));
			
				foreach($styling_data_arr['mods'] as $key => $styling_mod)
				{
					if(!is_array($styling_mod))
					{
						set_theme_mod( $key, $styling_mod );
					}
				}
			}
		    
			exit();
		}
	}
}


/**
*	Setup custom CSS function
**/
add_action('wp_ajax_grandconference_custom_css', 'grandconference_custom_css');
add_action('wp_ajax_nopriv_grandconference_custom_css', 'grandconference_custom_css');

function grandconference_custom_css() {
	get_template_part("/modules/custom_css");

	die();
}

/**
*	Setup responsive CSS function
**/
add_action('wp_ajax_grandconference_responsive_css', 'grandconference_responsive_css');
add_action('wp_ajax_nopriv_grandconference_responsive_css', 'grandconference_responsive_css');

function grandconference_responsive_css() {
	get_template_part("/modules/responsive_css");

	die();
}

/**
*	End responsive CSS function
**/


/**
*	Setup custom script function
**/
add_action('wp_ajax_grandconference_script_animate_circle_shortcode', 'grandconference_script_animate_circle_shortcode');
add_action('wp_ajax_nopriv_grandconference_script_animate_circle_shortcode', 'grandconference_script_animate_circle_shortcode');

function grandconference_script_animate_circle_shortcode() {
	get_template_part("/modules/script/script-animate-circle-shortcode");

	die();
}

add_action('wp_ajax_grandconference_script_animate_counter_shortcode', 'grandconference_script_animate_counter_shortcode');
add_action('wp_ajax_nopriv_grandconference_script_animate_counter_shortcode', 'grandconference_script_animate_counter_shortcode');

function grandconference_script_animate_counter_shortcode() {
	get_template_part("/modules/script/script-animate-counter-shortcode");

	die();
}

add_action('wp_ajax_grandconference_script_audio_shortcode', 'grandconference_script_audio_shortcode');
add_action('wp_ajax_nopriv_grandconference_script_audio_shortcode', 'grandconference_script_audio_shortcode');

function grandconference_script_audio_shortcode() {
	get_template_part("/modules/script/script-audio-shortcode");

	die();
}

add_action('wp_ajax_grandconference_script_demo', 'grandconference_script_demo');
add_action('wp_ajax_nopriv_grandconference_script_demo', 'grandconference_script_demo');

function grandconference_script_demo() {
	get_template_part("/modules/script/script-demo");

	die();
}

/**
*	Setup add product to cart function
**/
add_action('wp_ajax_grandconference_add_to_cart', 'grandconference_add_to_cart');
add_action('wp_ajax_nopriv_grandconference_add_to_cart', 'grandconference_add_to_cart');

function grandconference_add_to_cart() {
	if(isset($_GET['product_id']) && !empty($_GET['product_id']) && class_exists('Woocommerce'))
	{
		$woocommerce = grandconference_get_woocommerce();
		$woocommerce->cart->add_to_cart($_GET['product_id']);
	}
	
	die();
}

/**
*	End add product to cart function
**/

add_action('wp_ajax_grandconference_script_gallery_flexslider', 'grandconference_script_gallery_flexslider');
add_action('wp_ajax_nopriv_grandconference_script_gallery_flexslider', 'grandconference_script_gallery_flexslider');

function grandconference_script_gallery_flexslider() {
	get_template_part("/modules/script/script-gallery-flexslider");

	die();
}

add_action('wp_ajax_grandconference_script_gridrotator', 'grandconference_script_gridrotator');
add_action('wp_ajax_nopriv_grandconference_script_gridrotator', 'grandconference_script_gridrotator');

function grandconference_script_gridrotator() {
	get_template_part("/modules/script/script-gridrotator");

	die();
}

add_action('wp_ajax_grandconference_script_jwplayer_shortcode', 'grandconference_script_jwplayer_shortcode');
add_action('wp_ajax_nopriv_grandconference_script_jwplayer_shortcode', 'grandconference_script_jwplayer_shortcode');

function grandconference_script_jwplayer_shortcode() {
	get_template_part("/modules/script/script-jwplayer-shortcode");

	die();
}

add_action('wp_ajax_grandconference_script_map_shortcode', 'grandconference_script_map_shortcode');
add_action('wp_ajax_nopriv_grandconference_script_map_shortcode', 'grandconference_script_map_shortcode');

function grandconference_script_map_shortcode() {
	get_template_part("/modules/script/script-map-shortcode");

	die();
}

add_action('wp_ajax_grandconference_script_self_hosted_video', 'grandconference_script_self_hosted_video');
add_action('wp_ajax_nopriv_grandconference_script_self_hosted_video', 'grandconference_script_self_hosted_video');

function grandconference_script_self_hosted_video() {
	get_template_part("/modules/script/script-self-hosted-video");

	die();
}

add_action('wp_ajax_grandconference_script_slider_flexslider', 'grandconference_script_slider_flexslider');
add_action('wp_ajax_nopriv_grandconference_script_slider_flexslider', 'grandconference_script_slider_flexslider');

function grandconference_script_slider_flexslider() {
	get_template_part("/modules/script/script-slider-flexslider");

	die();
}

add_action('wp_ajax_kirki_dynamic_css', 'kirki_dynamic_css');
add_action('wp_ajax_nopriv_kirki_dynamic_css', 'kirki_dynamic_css');

function kirki_dynamic_css() {
	$kirki = grandconference_get_kirki();

	die();
}

add_action('wp_ajax_grandconference_ajax_search', 'grandconference_ajax_search');
add_action('wp_ajax_nopriv_grandconference_ajax_search', 'grandconference_ajax_search');

function grandconference_ajax_search() {
	get_template_part("/modules/script/script-ajax-search");

	die();
}

add_action('wp_ajax_grandconference_script_custom_countdown', 'grandconference_script_custom_countdown');
add_action('wp_ajax_nopriv_grandconference_script_custom_countdown', 'grandconference_script_custom_countdown');

function grandconference_script_custom_countdown() {
	get_template_part("/modules/script/script-custom-countdown");

	die();
}

add_action('wp_ajax_grandconference_script_custom_session_masonry', 'grandconference_script_custom_session_masonry');
add_action('wp_ajax_nopriv_grandconference_script_custom_session_masonry', 'grandconference_script_custom_session_masonry');

function grandconference_script_custom_session_masonry() {
	get_template_part("/modules/script/script-custom-session-masonry");

	die();
}

add_action('wp_ajax_grandconference_script_custom_session_sidebar', 'grandconference_script_custom_session_sidebar');
add_action('wp_ajax_nopriv_grandconference_script_custom_session_sidebar', 'grandconference_script_custom_session_sidebar');

function grandconference_script_custom_session_sidebar() {
	get_template_part("/modules/script/script-custom-session-sidebar");

	die();
}

add_action('wp_ajax_grandconference_script_custom_session_tab', 'grandconference_script_custom_session_tab');
add_action('wp_ajax_nopriv_grandconference_script_custom_session_tab', 'grandconference_script_custom_session_tab');

function grandconference_script_custom_session_tab() {
	get_template_part("/modules/script/script-custom-session-tab");

	die();
}

add_action('wp_ajax_grandconference_script_testimonials_flexslider', 'grandconference_script_testimonials_flexslider');
add_action('wp_ajax_nopriv_grandconference_script_testimonials_flexslider', 'grandconference_script_testimonials_flexslider');

function grandconference_script_testimonials_flexslider() {
	get_template_part("/modules/script/script-testimonials-flexslider");

	die();
}

/**
*	End custom script function
**/


if(GRANDCONFERENCE_THEMEDEMO)
{
	function grandconference_add_my_query_var( $link ) 
	{
		$arr_params = array();
	    
	    if(isset($_GET['topbar'])) 
		{
			$arr_params['topbar'] = $_GET['topbar'];
		}
		
		if(isset($_GET['menu'])) 
		{
			$arr_params['menu'] = $_GET['menu'];
		}
		
		if(isset($_GET['frame'])) 
		{
			$arr_params['frame'] = $_GET['frame'];
		}
		
		if(isset($_GET['frame_color'])) 
		{
			$arr_params['frame_color'] = $_GET['frame_color'];
		}
		
		if(isset($_GET['boxed'])) 
		{
			$arr_params['boxed'] = $_GET['boxed'];
		}
		
		if(isset($_GET['footer'])) 
		{
			$arr_params['footer'] = $_GET['footer'];
		}
		
		if(isset($_GET['menulayout'])) 
		{
			$arr_params['menulayout'] = $_GET['menulayout'];
		}
		
		$link = add_query_arg( $arr_params, $link );
	    
	    return $link;
	}
	add_filter('category_link','grandconference_add_my_query_var');
	add_filter('page_link','grandconference_add_my_query_var');
	add_filter('post_link','grandconference_add_my_query_var');
	add_filter('term_link','grandconference_add_my_query_var');
	add_filter('tag_link','grandconference_add_my_query_var');
	add_filter('category_link','grandconference_add_my_query_var');
	add_filter('post_type_link','grandconference_add_my_query_var');
	add_filter('attachment_link','grandconference_add_my_query_var');
	add_filter('year_link','grandconference_add_my_query_var');
	add_filter('month_link','grandconference_add_my_query_var');
	add_filter('day_link','grandconference_add_my_query_var');
	add_filter('search_link','grandconference_add_my_query_var');
	add_filter('previous_post_link','grandconference_add_my_query_var');
	add_filter('next_post_link','grandconference_add_my_query_var');
}

//Setup custom settings when theme is activated
if (isset($_GET['activated']) && $_GET['activated'] && is_admin() && current_user_can('manage_options')){
	//Add default contact fields
	$pp_contact_form = get_option('pp_contact_form');
	if(empty($pp_contact_form))
	{
		add_option( 'pp_contact_form', 's:1:"3";' );
	}
	
	$pp_contact_form_sort_data = get_option('pp_contact_form_sort_data');
	if(empty($pp_contact_form_sort_data))
	{
		add_option( 'pp_contact_form_sort_data', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}' );
	}
	
	//Update default Elementor options
	update_option('elementor_disable_color_schemes', 'yes');
	update_option('elementor_disable_typography_schemes', 'yes');
	update_option('elementor_page_title_selector', '#page_caption');
	update_option('elementor_space_between_widgets', 0);
	update_option('elementor_container_width', 1170);
	update_option('elementor_cpt_support', array('post', 'page', 'footer', 'header', 'megamenu', 'fullmenu', 'speaker', 'tribe_events'));
	update_option('elementor_global_image_lightbox', 0);

	wp_safe_redirect(admin_url("admin.php?page=functions.php&activate=true"));
	exit;
}

//Flush the rules and tell it to write htaccess
if (isset($_GET['saved']) && $_GET['saved'] && is_admin() && current_user_can('manage_options')){
	flush_rewrite_rules();
}
?>