<?php
require_once get_template_directory() . "/modules/class-tgm-plugin-activation.php";
add_action( 'tgmpa_register', 'grandconference_require_plugins' );
 
function grandconference_require_plugins() {
 
	$plugins = array(
		array(
			'name'               => 'Grand Conference Theme Custom Post Type',
			'slug'      		 => 'grandconference-custom-post',
			'source'             => 'https://themegoods-assets.b-cdn.net/grandconference-custom-post/grandconference-custom-post-v2.6.2.zip',
			'required'           => true, 
			'version'            => '2.6.2',
		),
		array(
			'name'               => 'Grand Conference Theme Elements for Elementor',
			'slug'               => 'grandconference-elementor',
			'source'             => 'https://themegoods-assets.b-cdn.net/grandconference-elementor/grandconference-elementor-v1.3.zip',
			'required'           => true, 
			'version'            => '1.3',
		),
		array(
			'name'      		 => 'Elementor Page Builder',
			'slug'      		 => 'elementor',
			'required'  		 => true, 
		),
		array(
			'name'      		 => 'The Events Calendar',
			'slug'      		 => 'the-events-calendar',
			'required'  		 => false, 
		),
		array(
			'name'               	=> 'One Click Demo Import',
			'slug'      		   	=> 'one-click-demo-import',
			'required'        		=> true, 
		),
		array(
			'name'               => 'Revolution Slider',
			'slug'               => 'revslider',
			'source'             => 'https://themegoods-assets.b-cdn.net/revslider/revslider-v6.6.20.zip',
			'required'           => true, 
			'version'            => '6.6.20',
		),
		array(
			'name'               => 'Envato Market',
			'slug'               => 'envato-market',
			'source'             => 'https://themegoods-assets.b-cdn.net/envato-market/envato-market-v2.0.11.zip',
			'required'           => true, 
			'version'            => '2.0.11',
		),
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => true, 
		),
		array(
			'name'      => 'MailChimp for WordPress',
			'slug'      => 'mailchimp-for-wp',
			'required'  => true, 
		),
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => true, 
		),
		array(
			'name'      => 'Post Types Order',
			'slug'      => 'post-types-order',
			'required'  => false, 
		),
		array(
			'name'      => 'LoftLoader',
			'slug'      => 'loftloader',
			'required'  => false, 
		),
		array(
			'name'      => 'Extended Google Map for Elementor',
			'slug'      => 'extended-google-map-for-elementor',
			'required'  => false, 
			'source'    => 'https://themegoods-assets.b-cdn.net/extended-google-map-for-elementor/extended-google-map-for-elementor-v1.2.5.zip',
			'version'   => '1.2.5',
		),
	);
	
	//If theme demo site add other plugins
	if(GRANDCONFERENCE_THEMEDEMO)
	{
		$plugins[] = array(
			'name'      => 'Disable Comments',
			'slug'      => 'disable-comments',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Customizer Export/Import',
			'slug'      => 'customizer-export-import',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Display All Image Sizes',
			'slug'      => 'display-all-image-sizes',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Easy Theme and Plugin Upgrades',
			'slug'      => 'easy-theme-and-plugin-upgrades',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Widget Importer & Exporter',
			'slug'      => 'widget-importer-exporter',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Imsanity',
			'slug'      => 'imsanity',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Go Live Update URLs',
			'slug'      => 'go-live-update-urls',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Widget Clone',
			'slug'      => 'widget-clone',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Duplicate Menu',
			'slug'      => 'duplicate-menu',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Menu Exporter',
			'slug'      => 'menu-exporter',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Quick remove menu item',
			'slug'      => 'quick-remove-menu-item',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'WP-Optimize',
			'slug'      => 'wp-optimize',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'WP User Avatar',
			'slug'      => 'wp-user-avatar',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Regenerate post permalinks',
			'slug'      => 'regenerate-post-permalinks',
			'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Duplicate Post',
			'slug'      => 'duplicate-post',
			'required'  => false, 
		);
	}
	
	$config = array(
		'domain'	=> 'grandconference',
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'install-required-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'          => array(
			'page_title'                      => esc_html__('Install Required Plugins', 'grandconference' ),
			'menu_title'                      => esc_html__('Install Plugins', 'grandconference' ),
			'installing'                      => esc_html__('Installing Plugin: %s', 'grandconference' ),
			'oops'                            => esc_html__('Something went wrong with the plugin API.', 'grandconference' ),
			'return'                          => esc_html__('Return to Required Plugins Installer', 'grandconference' ),
			'plugin_activated'                => esc_html__('Plugin activated successfully.', 'grandconference' ),
			'complete'                        => esc_html__('All plugins installed and activated successfully. %s', 'grandconference' ),
			'nag_type'                        => 'update-nag'
		)
	);
 
	tgmpa( $plugins, $config );
}
?>