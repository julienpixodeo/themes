<?php
//grandconference_themegoods_action();
$is_verified_envato_purchase_code = false;

//Get verified purchase code data
$is_verified_envato_purchase_code = grandconference_is_registered();
	
//Layout styling
$customizer_styling_arr = array( 
	array('id'	=>	'styling1', 'title' => 'Classic Conference'),
	array('id'	=>	'demo2', 'title' => 'Music Event'),
	array('id'	=>	'demo3', 'title' => 'One Page Event'),
	array('id'	=>	'styling2', 'title' => 'Center Align Menu'),
	array('id'	=>	'styling3', 'title' => 'Center Logo With 2 Menus'),
	array('id'	=>	'styling4', 'title' => 'Fullscreen Menu'),
	array('id'	=>	'styling5', 'title' => 'Side Menu'),
	array('id'	=>	'styling6', 'title' => 'Frame'),
	array('id'	=>	'styling7', 'title' => 'Boxed'),
	array('id'	=>	'styling8', 'title' => 'With Top Bar'),
);

$customizer_styling_html = '';

//if verified envato purchase code
if($is_verified_envato_purchase_code)
{
	$wp_nonce = wp_create_nonce('grandconference_import_styling');
	
	$customizer_styling_html.= '
		<div class="tg_notice">
			<span class="dashicons dashicons-warning"></span>
			Activating demo styling will replace all current theme customizer options.
		</div><br style="clear:both;"/>
		<ul id="get_styling_content" class="demo_list">';
		
		foreach($customizer_styling_arr as $customizer_styling)
		{
			$customizer_styling_html.= '
				<li data-styling="'.$customizer_styling['id'].'">
					<div class="item_content_wrapper">
						<div class="item_content">
					    	<div class="item_thumb"><img src="'.get_template_directory_uri().'/cache/demos/customizer/screenshots/'.$customizer_styling['id'].'.jpg" alt=""/></div>
					    	<div class="item_content">
							    <div class="title"><strong>'.$customizer_styling['title'].'</strong></div>
								<div class="import">
								    <input data-styling="'.$customizer_styling['id'].'" data-nonce="'.esc_attr($wp_nonce).'" type="button" value="Activate" class="pp_get_styling_button button-primary"/>
								</div>
							</div>
						</div>
					</div>
			    </li>';
		}
		
		$customizer_styling_html.= '</ul>
	<div class="styling_message"><div class="import_message_success"><span class="tg_loading dashicons dashicons-update"></span>Data is being imported please be patient, don\'t navigate away from this page</div></div>';
}
else
{
	$customizer_styling_html.= '
		<div class="tg_notice">
			<span class="dashicons dashicons-warning" style="color:#FF3B30"></span> 
			<span style="color:#FF3B30">'.GRANDCONFERENCE_THEMENAME.' Demos can only be imported with a valid purchase code</span><br/><br/>
			Please visit <a href="javascript:jQuery(\'#pp_panel_registration_a\').trigger(\'click\');">Product Registration page</a> and enter a valid purchase code to import the full '.GRANDCONFERENCE_THEMENAME.' demos and single pages through Content Builder.
		</div>';
}

//Layout demo importer
$demo_import_options_arr = array( 
	array('id'	=>	'demo1', 'title' => 'Classic Conference', 'demo' => 1),
	array('id'	=>	'demo2', 'title' => 'Music Event', 'demo' => 2),
	array('id'	=>	'demo3', 'title' => 'One Page Event', 'demo' => 3),
);

//Check if Instagram plugin is installed	
if( !function_exists('is_plugin_active') ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

$instagram_widget_settings_notice = '';
$meks_easy_instagram_widget = 'meks-easy-instagram-widget/meks-easy-instagram-widget.php';
$meks_easy_instagram_widget_activated = is_plugin_active($meks_easy_instagram_widget);

if(!$meks_easy_instagram_widget_activated)
{
	$instagram_widget_settings_notice = 'Required plugin "Meks Easy Photo Feed Widget" is required. <a href="'.admin_url("themes.php?page=install-required-plugins").'">Please install the plugin here</a>. or read more detailed instruction about <a href="https://themes.themegoods.com/grandconference/doc/instagram-api-setup/" target="_blank">How to setup the plugin here</a>';
}
else
{
	//Verify Instagram API aurthorization
	$instagram_widget_settings = get_option('meks_instagram_settings');
	
	if(empty($instagram_widget_settings))
	{
		$instagram_widget_settings_notice = 'Please authorize with your Instagram account <a href="'.admin_url("options-general.php?page=meks-instagram").'">here</a>';
	}
	else
	{
		$instagram_widget_settings_notice = esc_html__('Authorized', 'grand-conference');
	}
}

/*
	Begin creating admin options
*/

$getting_started_html = '<div class="one_half">
		<div class="step_icon">
			<a href="'.admin_url("themes.php?page=install-required-plugins").'">
				<span class="dashicons dashicons-admin-plugins"></span>
				<div class="step_title">Install Plugins</div>
			</a>
		</div>
		<div class="step_info">
			Theme has required and recommended plugins in order to build your website using layouts you saw on our demo site. We recommend you to install all plugins first.
		</div>
	</div>';

//Check if Grand grand-conference plugin is installed	
$grandconference_custom_post = 'grandconference-custom-post/grandconference-custom-post.php';

if( !function_exists('is_plugin_active') ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

$grandconference_custom_post_activated = is_plugin_active($grandconference_custom_post);
if($grandconference_custom_post_activated)
{
	$getting_started_html.= '<div class="one_half last">
		<div class="step_icon">
			<a href="'.admin_url("edit-tags.php?taxonomy=scheduleday&post_type=session").'">
				<span class="dashicons dashicons-calendar-alt"></span>
				<div class="step_title">Create Day</div>
			</a>
		</div>
		<div class="step_info">
			First you need to create days for conference or event you have so you can assign sessions to each days of your event.
		</div>
	</div>
	
	<br style="clear:both;"/>
	
	<div class="one_half">
		<div class="step_icon">
			<a href="'.admin_url("post-new.php?post_type=session").'">
				<span class="dashicons dashicons-laptop"></span>
				<div class="step_title">Create Session</div>
			</a>
		</div>
		<div class="step_info">
			'.GRANDCONFERENCE_THEMENAME.' provide advanced session option. Session is using for conference or event session in certain time period. For example keynote session for conference.
		</div>
	</div>
	
	<div class="one_half last">
		<div class="step_icon">
			<a href="'.admin_url("post-new.php?post_type=speaker").'">
				<span class="dashicons dashicons-businessperson"></span>
				<div class="step_title">Create Speaker</div>
			</a>
		</div>
		<div class="step_info">
			'.GRANDCONFERENCE_THEMENAME.' provide advanced speaker option. You can create list of speakers and assign them to each session.
		</div>
	</div>
	
	<div class="one_half">
		<div class="step_icon">
			<a href="'.admin_url("post-new.php?post_type=ticket").'">
				<span class="dashicons dashicons-tickets-alt"></span>
				<div class="step_title">Create Ticket</div>
			</a>
		</div>
		<div class="step_info">
			'.GRANDCONFERENCE_THEMENAME.' provide advanced ticket option. You can create ticket start selling it online using Woocommerce plugin.
		</div>
	</div>';
}
	
$getting_started_html.='<div class="one_half last">
		<div class="step_icon">
			<a href="'.admin_url("post-new.php?post_type=page").'">
				<span class="dashicons dashicons-welcome-add-page"></span>
				<div class="step_title">Create Page</div>
			</a>
		</div>
		<div class="step_info">
			'.GRANDCONFERENCE_THEMENAME.' support standard WordPress page option. You can also use our live content builder to create and organise page contents.
		</div>
	</div>
	
	<div class="one_half">
		<div class="step_icon">
			<a href="'.admin_url("customize.php").'">
				<span class="dashicons dashicons-admin-settings"></span>
				<div class="step_title">Customize Theme</div>
			</a>
		</div>
		<div class="step_info">
			Start customize theme\'s layouts, typography, elements colors using WordPress customize and see your changes in live preview instantly.
		</div>
	</div>
	
	<div class="one_half last">
		<div class="step_icon">
			<a href="javascript:;" onclick="jQuery(\'#pp_panel_demo-content_a\').trigger(\'click\');">
				<span class="dashicons dashicons-database-import"></span>
				<div class="step_title">Import Demo</div>
			</a>
		</div>
		<div class="step_info">
			Upload demo content from our demo site. We recommend you to install all recommended plugins before importing demo contents.
		</div>
	</div>
	
	<br style="clear:both;"/>
	
	<div style="height:30px"></div>
	
	<h1>Support</h1>
	<div class="getting_started_desc">To access our support portal. You first must find your purchased code.</div>
	<div style="height:40px"></div>
	<div class="one_half nomargin">
		<div class="step_icon">
			<a href="https://themegoods.ticksy.com/submit/" target="_blank">
				<span class="dashicons dashicons-testimonial"></span>
				<div class="step_title">Submit a Ticket</div>
			</a>
		</div>
		<div class="step_info">
			We offer excellent support through our ticket system. Please make sure you prepare your purchased code first to access our services.
		</div>
	</div>
	
	<div class="one_half last nomargin">
		<div class="step_icon">
			<a href="https://docs.themegoods.com/grand-conference" target="_blank">
				<span class="dashicons dashicons-book-alt"></span>
				<div class="step_title">Theme Document</div>
			</a>
		</div>
		<div class="step_info">
			This is the place to go find all reference aspects of theme functionalities. Our online documentation is resource for you to start using theme.
		</div>
	</div>
';

//Get product registration

$tutorial_html = '';	

if(!empty($is_verified_envato_purchase_code))
{
	$tutorial_html = '
		<div class="one_third">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/iET4nH1bz2A?si=YUAZo_0cXju_P8dK" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			<div class="themegoods-video-title">How to create website header</div>
		</div>
		
		<div class="one_third">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/hKm3u6T9oT0?si=1JvkZyJaZZh0O1cI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			<div class="themegoods-video-title">How to change website logo image from demo header</div>
		</div>
		
		<div class="one_third last">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/RMCLoOL9XcI?si=53skWuS819SFqnPl" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			<div class="themegoods-video-title">How to create a mobile menu</div>
		</div>
		
		<div class="one_third">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/3WmbVsTOgEE?si=j5iCZZA98rJRi7HU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			<div class="themegoods-video-title">How to create website footer</div>
		</div>
		
		<div class="one_third">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/roFK_WgPSDU?si=XRtWklaMCidhGhsK" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			<div class="themegoods-video-title">How to create a speaker post and page</div>
		</div>
		
		<div class="one_third last">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/0v7GujhmDog?si=RAxKKuK-8nPZQK0C" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			<div class="themegoods-video-title">How to create a single speaker page using Elementor</div>
		</div>
		
		<div class="one_third">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/Ltw-D2iduJI?si=hu4UuZ39UwrnzhFZ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			<div class="themegoods-video-title">How to setup sessions, topics and schedule days</div>
		</div>
		
		<div class="one_third">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/HkxP68OsdQQ?si=JljaKj-Pz2z7hY-u" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			<div class="themegoods-video-title">How to setup event, RSVP and ticket commerce</div>
		</div>
		
		<div class="one_third last">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/q0LxRDnRfPM?si=g2qjH1JbD5bvPsBl" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			<div class="themegoods-video-title">How to translate theme strings</div>
		</div>
	';
}
else
{
	$tutorial_html = '
	<div class="tg_notice">
					<span class="dashicons dashicons-warning" style="color:#FF3B30"></span> 
					<span style="color:#FF3B30">'.GRANDCONFERENCE_THEMENAME.' theme tutorials can only be activated with a valid purchase code</span><br/><br/>
					Please visit <a href="javascript:jQuery(\'#pp_panel_registration_a\').trigger(\'click\');">Product Registration page</a> and enter a valid purchase code to activate this section.
				</div>
		';
}

//if verified envato purchase code
$check_icon = '';
$verification_desc = 'Thank you for choosing '.GRANDCONFERENCE_THEMENAME.'. Your product must be registered to receive many advantage features ex. demos import and support. We are sorry about this extra step but we built the activation system to prevent mass piracy of our themes. This will help us to better serve our paying customers.';

//Check if have any purchase code verification error
$response_html = '';
$purchase_code = '';
$register_button_html = '<input type="submit" name="submit" id="themegoods-envato-code-submit" class="button button-primary button-large" value="Register"/>';

//If already registered
if(!empty($is_verified_envato_purchase_code))
{
	$response_html.= '<br style="clear:both;"/><div class="tg_valid"><span class="dashicons dashicons-yes"></span>Your product is registered.</div>';
	$register_button_html = '<input type="submit" name="submit" id="themegoods-envato-code-unregister" class="button button-primary button-large" value="Unregister"/>';
	$purchase_code = $is_verified_envato_purchase_code;
}

//Displays purchase code verification response
if(isset($_GET['response']) && !empty($_GET['response'])) {
	$response_arr = json_decode(stripcslashes($_GET['response']));
	$purchase_code = '';
	if(isset($_GET['purchase_code']) && !empty($_GET['purchase_code'])) {
		$purchase_code = $_GET['purchase_code'];
	}
	
	if(isset($response_arr->response_code)) {
		if(!$response_arr->response_code) {
			$response_html.= '<br style="clear:both;"/><div class="tg_error"><span class="dashicons dashicons-warning"></span>'.$response_arr->response.'</div>';
		}
	}
	else {
		$response_html.= '<br style="clear:both;"/><div class="tg_error"><span class="dashicons dashicons-warning"></span> We can\'t verify your purchase of '.GRANDCONFERENCE_THEMENAME.' theme. Please make sure you enter correct purchase code. If you are sure you enter correct one. <a href="https://themegoods.ticksy.com" target="_blank">Please open a ticket</a> to us so our support staff can help you. Thank you very much.</div>';
	}
}

$product_registration_html ='
		<h1>Product Registration</h1>
		<div class="getting_started_desc">'.$verification_desc.'</div>
		<br style="clear:both;"/>
		
		<div style="height:10px"></div>
		
		<label for="pp_envato_personal_token">'.$check_icon.'Purchase Code</label>
		<small class="description">Please enter your Purchase Code.</small>';
$product_registration_html.= $register_button_html;

$purchase_code_input_class = '';
if(!empty($is_verified_envato_purchase_code)) {
	$purchase_code_input_class = 'themegoods-verified';
}

$product_registration_html.= '<input name="pp_envato_personal_token" id="pp_envato_personal_token" type="text" value="'.esc_attr($purchase_code).'" class="'.esc_attr($purchase_code_input_class).'"/>
		<input name="themegoods-site-domain" id="themegoods-site-domain" type="hidden" value="'.esc_attr(grandconference_get_site_domain()).'"/>
	';
	
	$product_registration_html.= $response_html;
	
if(isset($_GET['action']) && $_GET['action'] == 'invalid-purchase')
{
	$product_registration_html.='<br style="clear:both;"/><div style="height:20px"></div><div class="tg_error"><span class="dashicons dashicons-warning"></span> We can\'t find your purchase of '.GRANDCONFERENCE_THEMENAME.' theme. Please make sure you enter correct purchase code. If you are sure you enter correct one. <a href="https://themegoods.ticksy.com" target="_blank">Please open a ticket</a> to us so our support staff can help you. Thank you very much.</div>
	
	<br style="clear:both;"/>
	
	<div style="height:10px"></div>';
}

$is_purchase_code_removed = get_option("envato_purchase_code_".ENVATOITEMID."_removed");
   
if($is_purchase_code_removed && empty($is_verified_envato_purchase_code)) {
	$product_registration_html.='<br style="clear:both;"/><div style="height:20px"></div><div class="tg_error"><span class="dashicons dashicons-warning"></span>Your purchase code was unregistered because the registered domain and this website domain are different. In case you want to remove/change registered domain. Please register your account <a href="https://license.themegoods.com/manager/" target="_blank">here</a>
	Then you will be able to manage/remove your purchase code registration\'s domain from there. <br/><br/>If you think the unregistration wasn\'t done correctly. Please <a href="https://themegoods.ticksy.com/submit/" target="_blank">open a ticket</a> or contact us using the contact form on <a href="https://themeforest.net/user/themegoods" target="_blank">this page</a> so we can check it for you. Thank you.</div>';
}

if(!$is_verified_envato_purchase_code)
{
	$product_registration_html.='
	<br style="clear:both;"/>
	<div style="height:10px"></div>
	<h2>How to get Purchase Code</h2>
	<div style="height:5px"></div>
	<ol>
	 <li>You must be logged into the same Envato account that purchased '.GRANDCONFERENCE_THEMENAME.' theme.</li>
	 <li>Hover the mouse over your username at the top right corner of the screen.</li>
							<li>Click "Downloads" from the drop-down menu.</li>
							<li>Find '.GRANDCONFERENCE_THEMENAME.' theme your downloads list</li>
							<li>Click "Download" button and click "License certificate & purchase code" (available as PDF or text file).</li>
	</ol>
	<strong>You can see detailed article and video screencast about "how to find your purchase code" <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">here</a>.</strong><div style="height:10px"></div>
';
}

//If already registered and add a link to license manager
if(!empty($is_verified_envato_purchase_code))
{
	$product_registration_html.='<br style="clear:both;"/><div style="height:20px"></div>
	<div class="one_third grey_bg">
	<h2>Manage Your License</h2>
	<div class="getting_started_desc half_size">To manage all your purchase code registration domain. Please open an account or login on <a href="https://license.themegoods.com/manager/" target="_blank">ThemeGoods License Manager</a>.
	</div>
	</div>
	';
	
	$product_registration_html.='<div class="one_third grey_bg">
	<h2>Auto Update</h2>
	<div class="getting_started_desc half_size">To enable auto update feature. You first must <a href="'.admin_url('themes.php?page=install-required-plugins').'">install Envato Market plugin</a> and enter your Envato account token there.</div>
	</div>
	';

	$product_registration_html.='<div class="one_third blue_bg last">
	<h2>Documentation</h2>
	<div class="getting_started_desc half_size">It is a great starting point to fix some of the most common issues. <a href="https://docs.themegoods.com/grand-conference" target="_blank">Read theme documentation</a>.</div>
	</div>
	';
}

$product_registration_html.='<br style="clear:both;"/><div style="height:30px"></div>
<h2 class="sub-header">Frequently Asked Questions</h2>
<ul class="themegoods_faq">
	<li><a href="https://docs.themegoods.com/docs/grand-conference/faq/my-website-header-footer-and-some-elements-are-missing/" target="_blank">My website header, footer and some elements are missing</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-conference/faq/i-changed-the-logo-image-in-customizer-but-its-not-working-on-the-frontend/" target="_blank">I changed the logo image in customizer but it\'s not working on the frontend</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-conference/faq/header-footer-and-other-custom-post-types-cant-edit-using-elementor/" target="_blank">Header, Footer and other custom post types can\'t edit using Elementor</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-conference/faq/my-changes-within-elementor-pages-post-elements-are-not-working-on-the-frontend/" target="_blank">My changes within Elementor pages/post elements are not working on the frontend</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-conference/faq/imported-demo-websites-menu-items-are-broken/" target="_blank">Imported demo website\'s menu items are broken</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-conference/faq/do-i-need-to-purchase-elementor-pro/" target="_blank">Do I need to purchase Elementor Pro</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-conference/faq/how-to-change-translate-text-within-pages-posts/" target="_blank">How to change/translate text within pages/posts</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-conference/faq/my-page-post-returns-404-not-found/" target="_blank">My page/post returns 404 not found</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-conference/faq/where-is-my-revolution-slider-plugin-purchase-code/" target="_blank">Where is my Revolution Slider plugin purchase code</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-conference/faq/my-website-is-slow/" target="_blank">My website is slow</a></li>
</ul>
';

//Get system info
$has_red_status = false;


//Get memory_limit
$memory_limit = ini_get('memory_limit');
$memory_limit_class = 'tg_valid';
$memory_limit_text = '';
if(intval($memory_limit) < 128)
{
    $memory_limit_class = 'tg_error';
    $has_error = 1;
    $memory_limit_text = '*RECOMMENDED 128M';
    
    $has_red_status = true;
}

$memory_limit_text = '<div class="'.$memory_limit_class.'">'.$memory_limit.' '.$memory_limit_text.'</div>';

//Get post_max_size
$post_max_size = ini_get('post_max_size');
$post_max_size_class = 'tg_valid';
$post_max_size_text = '';
if(intval($post_max_size) < 32)
{
    $post_max_size_class = 'tg_error';
    $has_error = 1;
    $post_max_size_text = '*RECOMMENDED 32M';
    
    $has_red_status = true;
}
$post_max_size_text = '<div class="'.$post_max_size_class.'">'.$post_max_size.' '.$post_max_size_text.'</div>';

//Get max_execution_time
$max_execution_time = ini_get('max_execution_time');
$max_execution_time_class = 'tg_valid';
$max_execution_time_text = '';
if($max_execution_time < 180)
{
    $max_execution_time_class = 'tg_error';
    $has_error = 1;
    $max_execution_time_text = '*RECOMMENDED 180';
    
    $has_red_status = true;
}
$max_execution_time_text = '<div class="'.$max_execution_time_class.'">'.$max_execution_time.' '.$max_execution_time_text.'</div>';

//Get max_input_vars
$max_input_vars = ini_get('max_input_vars');
$max_input_vars_class = 'tg_valid';
$max_input_vars_text = '';
if(intval($max_input_vars) < 2000)
{
    $max_input_vars_class = 'tg_error';
    $has_error = 1;
    $max_input_vars_text = '*RECOMMENDED 2000';
    
    $has_red_status = true;
}
$max_input_vars_text = '<div class="'.$max_input_vars_class.'">'.$max_input_vars.' '.$max_input_vars_text.'</div>';

//Get upload_max_filesize
$upload_max_filesize = ini_get('upload_max_filesize');
$upload_max_filesize_class = 'tg_valid';
$upload_max_filesize_text = '';
if(intval($upload_max_filesize) < 32)
{
    $upload_max_filesize_class = 'tg_error';
    $has_error = 1;
    $upload_max_filesize_text = '*RECOMMENDED 32M';
    
    $has_red_status = true;
}
$upload_max_filesize_text = '<div class="'.$upload_max_filesize_class.'">'.$upload_max_filesize.' '.$upload_max_filesize_text.'</div>';

//Get GD library version
if(function_exists('gd_info'))
{
	$php_gd_arr = gd_info();
}
else
{
	$php_gd_arr['GD Version'] = 'not installed';
}

$system_info_html = '';
if(!$is_verified_envato_purchase_code)
{
	$system_info_html = '<div style="height:20px"></div>
	<div class="tg_notice">
					<span class="dashicons dashicons-warning" style="color:#FF3B30"></span> 
					<span style="color:#FF3B30">'.GRANDCONFERENCE_THEMENAME.' Demos can only be imported with a valid purchase code</span><br/><br/>
					Please visit <a href="javascript:jQuery(\'#pp_panel_registration_a\').trigger(\'click\');">Product Registration page</a> and enter a valid purchase code to import the full '.GRANDCONFERENCE_THEMENAME.' demos and single pages through Elementor.
				</div>
		
		<div style="height:40px"></div>
		';
}
else
{
	$system_info_html = '<table class="widefat" cellspacing="0">
			<thead>
				<tr>
					<th colspan="3">Server Environment</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="title">PHP Version:</td>
					<td class="help"><a href="javascript" title="The version of PHP installed on your hosting server." class="tooltipster">[?]</a></td>
					<td class="value">'.phpversion().'</td>
				</tr>
				<tr>
					<td class="title">WP Memory Limit:</td>
					<td class="help"><a href="javascript" title="The maximum amount of memory (RAM) that your site can use at one time." class="tooltipster">[?]</a></td>
					<td class="value">'.$memory_limit_text.'</td>
				</tr>
				<tr>
					<td class="title">PHP Post Max Size:</td>
					<td class="help"><a href="javascript" title="The largest file size that can be contained in one post." class="tooltipster">[?]</a></td>
					<td class="value">'.$post_max_size_text.'</td>
				</tr>
				<tr>
					<td class="title">PHP Time Limit:</td>
					<td class="help"><a href="javascript" title="The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)" class="tooltipster">[?]</a></td>
					<td class="value">'.$max_execution_time_text.'</td>
				</tr>
				<tr>
					<td class="title">PHP Max Input Vars:</td>
					<td class="help"><a href="javascript" title="The maximum number of variables your server can use for a single function to avoid overloads." class="tooltipster">[?]</a></td>
					<td class="value">'.$max_input_vars_text.'</td>
				</tr>
				<tr>
					<td class="title">Max Upload Size:</td>
					<td class="help"><a href="javascript" title="The largest filesize that can be uploaded to your WordPress installation." class="tooltipster">[?]</a></td>
					<td class="value">'.$upload_max_filesize_text.'</td>
				</tr>
				<tr>
					<td class="title">GD Library:</td>
					<td class="help"><a href="javascript" title="This library help resizing images and improve site loading speed" class="tooltipster">[?]</a></td>
					<td class="value">'.$php_gd_arr['GD Version'].'</td>
				</tr>
			</tbody>
		</table>
		
		<div style="height:20px"></div>';
		
		//Check if required plugins is installed
		$grandconference_custom_post_activated = function_exists('post_type_galleries');
		$ocdi_activated = class_exists('OCDI_Plugin');
		
		if($grandconference_custom_post_activated && $ocdi_activated)
		{
			if($has_red_status)
			{
				$system_info_html.= '<div style="height:20px"></div>
			<div class="tg_notice">
				<span class="dashicons dashicons-warning" style="color:#FF3B30"></span> 
				<span>There are some settings which are below theme recommendation values and it might causes issue importing demo contents.</span>
			</div>';
			
				$import_demo_button_label = 'I understand and want to process demo importing process';
			}
			else
			{
				$import_demo_button_label = 'Begin importing demo process';
			}
			
			$system_info_html.= '<div class="tg_begin_import"><a href="'.admin_url('themes.php?page=tg-one-click-demo-import').'" class="button button-primary button-large">'.$import_demo_button_label.'</a></div>';
		}
		else
		{
			$system_info_html.= '<div style="height:20px"></div>
			<div class="tg_notice">
				<span class="dashicons dashicons-warning" style="color:#FF3B30"></span> 
				<span style="color:#FF3B30">One Click Demo Import, '.GRANDCONFERENCE_THEMENAME.' Custom Post Type plugins required</span><br/><br/>
				Please <a href="'.admin_url("themes.php?page=install-required-plugins").'">install and activate these required plugins.</a> first so demo contents can be imported properly.
			</div>';
		}
}

$api_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

$grandconference_options = grandconference_get_options();

$grandconference_options = array (
 
//Begin admin header
array( 
		"name" => GRANDCONFERENCE_THEMENAME." Options",
		"type" => "title"
),
//End admin header

//Begin second tab "Registration"
array( 	"name" => "Registration",
		"type" => "section",
		"icon" => "dashicons-admin-network",	
),
array( "type" => "open"),

array( "name" => "",
	"desc" => "",
	"id" => GRANDCONFERENCE_SHORTNAME."_registration",
	"type" => "html",
	"html" => $product_registration_html,
),

array( "type" => "close"),
//End second tab "Registration"


//Begin second tab "Home"
array( 	"name" => "Getting-Started",
		"type" => "section",
		"icon" => "dashicons-admin-home",	
),
array( "type" => "open"),

array( "name" => "",
	"desc" => "",
	"id" => GRANDCONFERENCE_SHORTNAME."_home",
	"type" => "html",
	"html" => '
	<h1>Getting Started</h1>
	<div class="getting_started_desc">Welcome to '.GRANDCONFERENCE_THEMENAME.' theme. '.GRANDCONFERENCE_THEMENAME.' is now installed and ready to use! Read below for additional informations. We hope you enjoy using the theme!</div>
	<div style="height:40px"></div>
	'.$getting_started_html.'
	',
),

array( "type" => "close"),
//End second tab "Home"

//Begin second tab "Tutorials"
array( 	"name" => "Tutorials",
		"type" => "section",
		"icon" => "",	
),
array( "type" => "open"),

array( "name" => "",
	"desc" => "",
	"id" => GRANDCONFERENCE_SHORTNAME."_tutorials",
	"type" => "html",
	"html" => '<h1>Tutorials</h1><div style="height:20px"></div>'.$tutorial_html,
),

array( "type" => "close"),
//End second tab "Tutorials"

//Begin second tab "General"
array( 	"name" => "General",
		"type" => "section",
		"icon" => "dashicons-admin-generic",	
),
array( "type" => "open"),

array( "name" => "<h2>Google Maps Setting</h2>API Key",
	"desc" => "Enter Google Maps API Key <a href=\"https://themegoods.ticksy.com/article/7785/\" target=\"_blank\">How to get API Key</a>",
	"id" => GRANDCONFERENCE_SHORTNAME."_googlemap_api_key",
	"type" => "text",
	"std" => ""
),

array( "name" => "Custom Google Maps Style",
	"desc" => "Enter javascript style array of map. You can get sample one from <a href=\"https://snazzymaps.com\" target=\"_blank\">Snazzy Maps</a>",
	"id" => GRANDCONFERENCE_SHORTNAME."_googlemap_style",
	"type" => "textarea",
	"std" => ""
),

array( "name" => "<h2>Custom Sidebar Settings</h2>Add a new sidebar",
	"desc" => "Enter sidebar name",
	"id" => GRANDCONFERENCE_SHORTNAME."_sidebar0",
	"type" => "text",
	"validation" => "text",
	"std" => "",
),

array( "name" => "<h2>Custom Permalink Settings</h2>Gallery Page Slug",
	"desc" => "Enter custom permalink slug for gallery page",
	"id" => GRANDCONFERENCE_SHORTNAME."_permalink_galleries",
	"type" => "text",
	"std" => "galleries"
),

array( "name" => "Gallery Category Page Slug",
	"desc" => "Enter custom permalink slug for gallery category page",
	"id" => GRANDCONFERENCE_SHORTNAME."_permalink_gallerycat",
	"type" => "text",
	"std" => "gallerycat"
),

array( "name" => "Speaker Page Slug",
	"desc" => "Enter custom permalink slug for speaker page",
	"id" => GRANDCONFERENCE_SHORTNAME."_permalink_speaker",
	"type" => "text",
	"std" => "speaker"
),

array( "name" => "Speaker Category Page Slug",
	"desc" => "Enter custom permalink slug for speaker category page",
	"id" => GRANDCONFERENCE_SHORTNAME."_permalink_speakercat",
	"type" => "text",
	"std" => "speakercat"
),

array( "type" => "close"),
//End second tab "General"


//Begin second tab "Styling"
/*array( "name" => "Styling",
	"type" => "section",
	"icon" => "dashicons-art",
),

array( "type" => "open"),

array( "name" => "",
	"desc" => "",
	"id" => GRANDCONFERENCE_SHORTNAME."_get_styling_button",
	"type" => "html",
	"html" => $customizer_styling_html,
),
 
array( "type" => "close"),*/


//Begin fifth tab "Social Profiles"
array( 	"name" => "Social-Profiles",
		"type" => "section",
		"icon" => "dashicons-facebook",
),
array( "type" => "open"),
	
array( "name" => "<h2>Accounts Settings</h2>Facebook page URL",
	"desc" => "Enter full Facebook page URL",
	"id" => GRANDCONFERENCE_SHORTNAME."_facebook_url",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Twitter Username",
	"desc" => "Enter Twitter username",
	"id" => GRANDCONFERENCE_SHORTNAME."_twitter_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Google Plus URL",
	"desc" => "Enter Google Plus URL",
	"id" => GRANDCONFERENCE_SHORTNAME."_google_url",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Flickr Username",
	"desc" => "Enter Flickr username",
	"id" => GRANDCONFERENCE_SHORTNAME."_flickr_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Youtube Profile URL",
	"desc" => "Enter Youtube Profile URL",
	"id" => GRANDCONFERENCE_SHORTNAME."_youtube_url",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Vimeo Username",
	"desc" => "Enter Vimeo username",
	"id" => GRANDCONFERENCE_SHORTNAME."_vimeo_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Tumblr Username",
	"desc" => "Enter Tumblr username",
	"id" => GRANDCONFERENCE_SHORTNAME."_tumblr_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Dribbble Username",
	"desc" => "Enter Dribbble username",
	"id" => GRANDCONFERENCE_SHORTNAME."_dribbble_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Linkedin URL",
	"desc" => "Enter full Linkedin URL",
	"id" => GRANDCONFERENCE_SHORTNAME."_linkedin_url",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Pinterest Username",
	"desc" => "Enter Pinterest username",
	"id" => GRANDCONFERENCE_SHORTNAME."_pinterest_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Instagram Username",
	"desc" => "Enter Instagram username",
	"id" => GRANDCONFERENCE_SHORTNAME."_instagram_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Behance Username",
	"desc" => "Enter Behance username",
	"id" => GRANDCONFERENCE_SHORTNAME."_behance_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "500px Profile URL",
	"desc" => "Enter 500px Profile URL",
	"id" => GRANDCONFERENCE_SHORTNAME."_500px_url",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "<h2>Photo Stream</h2>Photostream Source",
	"desc" => "Select photo stream photo source. It displays before footer area",
	"id" => GRANDCONFERENCE_SHORTNAME."_photostream",
	"type" => "select",
	"options" => array(
		'' => 'Disable Photo Stream',
		'instagram' => 'Instagram',
		'flickr' => 'Flickr',
	),
	"std" => ''
),
/*array( "name" => "Instagram Access Token<br/><a href=\"http://elfsight.com/blog/2016/05/how-to-get-instagram-access-token/\" >How to get your Access Token</a>",
	"desc" => "Enter Instagram Access Token",
	"id" => GRANDCONFERENCE_SHORTNAME."_instagram_access_token",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),*/

array( "name" => "Connect with your Instagram account",
	"desc" => "",
	"id" => GRANDCONFERENCE_SHORTNAME."_instagram_account_notice",
	"type" => "html",
	"html" => "<div class='html_inline_wrapper'>".$instagram_widget_settings_notice."</div>",
),

array( "name" => "Flickr ID",
	"desc" => "Enter Flickr ID. <a href=\"http://idgettr.com/\" target=\"_blank\">Find your Flickr ID here</a>",
	"id" => GRANDCONFERENCE_SHORTNAME."_flickr_id",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "type" => "close"),

//End fifth tab "Social Profiles"


//Begin second tab "Script"
array( "name" => "Script",
	"type" => "section",
	"icon" => "dashicons-format-aside",
),

array( "type" => "open"),

array( "name" => "<h2>CSS Settings</h2>Custom CSS for desktop",
	"desc" => "You can add your custom CSS here",
	"id" => GRANDCONFERENCE_SHORTNAME."_custom_css",
	"type" => "css",
	"std" => "",
	'validation' => '',
),

array( "name" => "Custom CSS for<br/>iPad Portrait View",
	"desc" => "You can add your custom CSS here",
	"id" => GRANDCONFERENCE_SHORTNAME."_custom_css_tablet_portrait",
	"type" => "css",
	"std" => "",
	'validation' => '',
),

array( "name" => "Custom CSS for<br/>iPhone Landscape View",
	"desc" => "You can add your custom CSS here",
	"id" => GRANDCONFERENCE_SHORTNAME."_custom_css_mobile_landscape",
	"type" => "css",
	"std" => "",
	'validation' => '',
),

array( "name" => "Custom CSS for<br/>iPhone Portrait View",
	"desc" => "You can add your custom CSS here",
	"id" => GRANDCONFERENCE_SHORTNAME."_custom_css_mobile_portrait",
	"type" => "css",
	"std" => "",
	'validation' => '',
),

array( "name" => "<h2>Optimisation Settings</h2>Cache theme's custom CSS",
	"desc" => "Cache theme custom CSS code which generate by customizer options to help improving loading speed",
	"id" => GRANDCONFERENCE_SHORTNAME."_advance_cache_custom_css",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Clear Cache",
	"desc" => "Try to clear cache when you enable CSS optimisation and theme went wrong",
	"id" => GRANDCONFERENCE_SHORTNAME."_advance_clear_cache",
	"type" => "html",
	"html" => '<a id="'.GRANDCONFERENCE_SHORTNAME.'_advance_clear_cache" href="'.$api_url.'" class="button">Click here to start clearing cache files</a>',
),
 
array( "type" => "close"),


//Begin second tab "Demo"
array( "name" => "Demo-Content",
	"type" => "section",
	"icon" => "dashicons-download",
),

array( "type" => "open"),

array( "name" => "",
	"desc" => "",
	"id" => GRANDCONFERENCE_SHORTNAME."_import_demo_notice",
	"type" => "html",
	"html" => '<h1>Checklist before Importing Demo</h1><br/><strong>IMPORTANT</strong>: Demo importer can vary in time. The included required plugins need to be installed and activated before you import demo. Please check the Server Environment below to ensure your server meets all requirements for a successful import. <strong>Settings that need attention will be listed in red</strong>.
	',
),
array( "name" => "",
	"desc" => "",
	"id" => GRANDCONFERENCE_SHORTNAME."_import_demo_content",
	"type" => "html",
	"html" => $system_info_html,
),
 
array( "type" => "close"),

array( 	"name" => "Buy-Another-License",
"type" => "section",
"icon" => "",		
),
array( "type" => "open"),

array( "type" => "close"),

);
 
$grandconference_options[] = array( "type" => "close");

grandconference_set_options($grandconference_options);
?>