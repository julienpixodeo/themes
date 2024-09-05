<?php
/**
* Custom Sanitize Functions
**/
function grandconference_sanitize_checkbox( $input ) {
	if(is_bool($input))
	{
		return $input;
	}
	else
	{
		return false;
	}

}

function grandconference_sanitize_slider( $input ) {	if(is_numeric($input))
	{
		return $input;
	}
	else
	{
		return 0;

	}
}

function grandconference_sanitize_html( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/*** Configuration to disable default WordPress customizer tabs
**/

add_action( 'customize_register', 'grandconference_customize_register' );
function grandconference_customize_register( $wp_customize ) {
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
}

/**
 * Configuration sample for the Kirki Customizer
 */
function grandconference_demo_configuration_sample() {

    /**
     * If you need to include Kirki in your theme,
     * then you may want to consider adding the translations here
     * using your textdomain.
     * 
     * If you're using Kirki as a plugin then you can remove these.
     */

    $strings = array(
        'background-color' => esc_html__('Background Color', 'grandconference' ),
        'background-image' => esc_html__('Background Image', 'grandconference' ),
        'no-repeat' => esc_html__('No Repeat', 'grandconference' ),
        'repeat-all' => esc_html__('Repeat All', 'grandconference' ),
        'repeat-x' => esc_html__('Repeat Horizontally', 'grandconference' ),
        'repeat-y' => esc_html__('Repeat Vertically', 'grandconference' ),
        'inherit' => esc_html__('Inherit', 'grandconference' ),
        'background-repeat' => esc_html__('Background Repeat', 'grandconference' ),
        'cover' => esc_html__('Cover', 'grandconference' ),
        'contain' => esc_html__('Contain', 'grandconference' ),
        'background-size' => esc_html__('Background Size', 'grandconference' ),
        'fixed' => esc_html__('Fixed', 'grandconference' ),
        'scroll' => esc_html__('Scroll', 'grandconference' ),
        'background-attachment' => esc_html__('Background Attachment', 'grandconference' ),
        'left-top' => esc_html__('Left Top', 'grandconference' ),
        'left-center' => esc_html__('Left Center', 'grandconference' ),
        'left-bottom' => esc_html__('Left Bottom', 'grandconference' ),
        'right-top' => esc_html__('Right Top', 'grandconference' ),
        'right-center' => esc_html__('Right Center', 'grandconference' ),
        'right-bottom' => esc_html__('Right Bottom', 'grandconference' ),
        'center-top' => esc_html__('Center Top', 'grandconference' ),
        'center-center' => esc_html__('Center Center', 'grandconference' ),
        'center-bottom' => esc_html__('Center Bottom', 'grandconference' ),
        'background-position' => esc_html__('Background Position', 'grandconference' ),
        'background-opacity' => esc_html__('Background Opacity', 'grandconference' ),
        'ON' => esc_html__('ON', 'grandconference' ),
        'OFF' => esc_html__('OFF', 'grandconference' ),
        'all' => esc_html__('All', 'grandconference' ),
        'cyrillic' => esc_html__('Cyrillic', 'grandconference' ),
        'cyrillic-ext' => esc_html__('Cyrillic Extended', 'grandconference' ),
        'devanagari' => esc_html__('Devanagari', 'grandconference' ),
        'greek' => esc_html__('Greek', 'grandconference' ),
        'greek-ext' => esc_html__('Greek Extended', 'grandconference' ),
        'khmer' => esc_html__('Khmer', 'grandconference' ),
        'latin' => esc_html__('Latin', 'grandconference' ),
        'latin-ext' => esc_html__('Latin Extended', 'grandconference' ),
        'vietnamese' => esc_html__('Vietnamese', 'grandconference' ),
    );

    $args = array(
        'textdomain'   => 'grandconference',
    );

    return $args;

}
add_filter( 'kirki/config', 'grandconference_demo_configuration_sample' );

/**
 * Create the customizer panels and sections
 */
function grandconference_add_panels_and_sections( $wp_customize ) {

	/**
     * Add panels
     */
    $wp_customize->add_panel( 'general', array(
        'priority'    => 35,
        'title'       => esc_html__('General', 'grandconference' ),
    ) ); 
    
    $wp_customize->add_panel( 'menu', array(
        'priority'    => 35,
        'title'       => esc_html__('Navigation', 'grandconference' ),
    ) );
    
    $wp_customize->add_panel( 'header', array(
        'priority'    => 39,
        'title'       => esc_html__('Header', 'grandconference' ),
    ) );
    
    $wp_customize->add_panel( 'sidebar', array(
        'priority'    => 43,
        'title'       => esc_html__('Sidebar', 'grandconference' ),
    ) );
    
    $wp_customize->add_panel( 'footer', array(
        'priority'    => 44,
        'title'       => esc_html__('Footer', 'grandconference' ),
    ) );
    
    $wp_customize->add_panel( 'gallery', array(
        'priority'    => 45,
        'title'       => esc_html__('Gallery', 'grandconference' ),
    ) );
    
    $wp_customize->add_panel( 'blog', array(
        'priority'    => 47,
        'title'       => esc_html__('Blog', 'grandconference' ),
    ) );
    
    $wp_customize->add_panel( 'session', array(
        'priority'    => 47,
        'title'       => esc_html__('Session', 'grandconference' ),
    ) );
    
    $wp_customize->add_panel( 'pages', array(
        'priority'    => 49,
        'title'       => __( 'Pages', 'grandconference' ),
    ) );
    
    //Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
		$wp_customize->add_panel( 'shop', array(
	        'priority'    => 48,
	        'title'       => esc_html__('Shop', 'grandconference' ),
	    ) );
	}

    /**
     * Add sections
     */
	$wp_customize->add_section( 'logo_favicon', array(
        'title'       => esc_html__('Site Logo', 'grandconference' ),
        'priority'    => 34,

    ) );
    
    $wp_customize->add_section( 'general_image', array(
        'title'       => esc_html__('Image', 'grandconference' ),
        'panel'		  => 'general',
        'priority'    => 46,

    ) );
    
    $wp_customize->add_section( 'general_typography', array(
        'title'       => esc_html__('Typography', 'grandconference' ),
        'panel'		  => 'general',
        'priority'    => 47,

    ) );
    
    $wp_customize->add_section( 'general_color', array(
        'title'       => esc_html__('Background & Colors', 'grandconference' ),
        'panel'		  => 'general',
        'priority'    => 48,

    ) );
    
    $wp_customize->add_section( 'general_input', array(
        'title'       => esc_html__('Input and Button Elements', 'grandconference' ),
        'panel'		  => 'general',
        'priority'    => 49,

    ) );
    
    $wp_customize->add_section( 'general_sharing', array(
        'title'       => esc_html__('Sharing', 'grandconference' ),
        'panel'		  => 'general',
        'priority'    => 50,

    ) );
    
    $wp_customize->add_section( 'general_mobile', array(
        'title'       => esc_html__('Mobile', 'grandconference' ),
        'panel'		  => 'general',
        'priority'    => 50,

    ) );
    
    $wp_customize->add_section( 'general_frame', array(
        'title'       => esc_html__('Frame', 'grandconference' ),
        'panel'		  => 'general',
        'priority'    => 51,

    ) );
    
    $wp_customize->add_section( 'general_boxed', array(
        'title'       => esc_html__('Boxed Layout', 'grandconference' ),
        'panel'		  => 'general',
        'priority'    => 52,

    ) );

    $wp_customize->add_section( 'menu_general', array(
        'title'       => esc_html__('General', 'grandconference' ),
        'panel'		  => 'menu',
        'priority'    => 36,

    ) );
    
    $wp_customize->add_section( 'menu_typography', array(
        'title'       => esc_html__('Typography', 'grandconference' ),
        'panel'		  => 'menu',
        'priority'    => 36,

    ) );
    
    $wp_customize->add_section( 'menu_color', array(
        'title'       => esc_html__('Colors', 'grandconference' ),
        'panel'		  => 'menu',
        'priority'    => 37,

    ) );
    
    $wp_customize->add_section( 'menu_submenu', array(
        'title'       => esc_html__('Sub Menu', 'grandconference' ),
        'panel'		  => 'menu',
        'priority'    => 38,

    ) );
    
    $wp_customize->add_section( 'menu_megamenu', array(
        'title'       => esc_html__('Mega Menu', 'grandconference' ),
        'panel'		  => 'menu',
        'priority'    => 38,

    ) );
    
    $wp_customize->add_section( 'menu_topbar', array(
        'title'       => esc_html__('Top Bar', 'grandconference' ),
        'panel'		  => 'menu',
        'priority'    => 38,

    ) );
    
    $wp_customize->add_section( 'menu_contact', array(
        'title'       => esc_html__('Contact Info', 'grandconference' ),
        'panel'		  => 'menu',
        'priority'    => 39,

    ) );
    
    $wp_customize->add_section( 'menu_sidemenu', array(
        'title'       => esc_html__('Side Menu', 'grandconference' ),
        'panel'		  => 'menu',
        'priority'    => 39,

    ) );
    
    $wp_customize->add_section( 'menu_fullmenu', array(
        'title'       => esc_html__('Fullscreen Menu', 'grandconference' ),
        'panel'		  => 'menu',
        'priority'    => 39,
    
    ) );
    
    $wp_customize->add_section( 'header_background', array(
        'title'       => esc_html__('Background', 'grandconference' ),
        'panel'		  => 'header',
        'priority'    => 40,

    ) );
    
    $wp_customize->add_section( 'header_title', array(
        'title'       => esc_html__('Page Title', 'grandconference' ),
        'panel'		  => 'header',
        'priority'    => 41,

    ) );
    
    $wp_customize->add_section( 'header_builder_title', array(
        'title'       => esc_html__('Content Builder Header', 'grandconference' ),
        'panel'		  => 'header',
        'priority'    => 41,

    ) );
    
    $wp_customize->add_section( 'header_tagline', array(
        'title'       => esc_html__('Page Tagline & Sub Title', 'grandconference' ),
        'panel'		  => 'header',
        'priority'    => 42,

    ) );
    
    $wp_customize->add_section( 'sidebar_general', array(
        'title'       => esc_html__('General', 'grandconference' ),
        'panel'		  => 'sidebar',
        'priority'    => 42,

    ) );
    
    $wp_customize->add_section( 'sidebar_typography', array(
        'title'       => esc_html__('Typography', 'grandconference' ),
        'panel'		  => 'sidebar',
        'priority'    => 43,

    ) );
    
    $wp_customize->add_section( 'sidebar_color', array(
        'title'       => esc_html__('Colors', 'grandconference' ),
        'panel'		  => 'sidebar',
        'priority'    => 44,

    ) );
    
    $wp_customize->add_section( 'footer_general', array(
        'title'       => esc_html__('General', 'grandconference' ),
        'panel'		  => 'footer',
        'priority'    => 45,

    ) );
    
    $wp_customize->add_section( 'footer_color', array(
        'title'       => esc_html__('Colors', 'grandconference' ),
        'panel'		  => 'footer',
        'priority'    => 46,

    ) );
    
    $wp_customize->add_section( 'footer_copyright', array(
        'title'       => esc_html__('Copyright', 'grandconference' ),
        'panel'		  => 'footer',
        'priority'    => 47,

    ) );
    
    $wp_customize->add_section( 'gallery_general', array(
        'title'       => esc_html__('General', 'grandconference' ),
        'panel'		  => 'gallery',
        'priority'    => 48,

    ) );
    
    $wp_customize->add_section( 'gallery_lightbox', array(
        'title'       => esc_html__('Lightbox', 'grandconference' ),
        'panel'		  => 'gallery',
        'priority'    => 49,

    ) );
    
    $wp_customize->add_section( 'blog_general', array(
        'title'       => esc_html__('General', 'grandconference' ),
        'panel'		  => 'blog',
        'priority'    => 53,

    ) );
    
    $wp_customize->add_section( 'blog_slider', array(
        'title'       => esc_html__('Slider', 'grandconference' ),
        'panel'		  => 'blog',
        'priority'    => 54,

    ) );
    
    $wp_customize->add_section( 'blog_single', array(
        'title'       => esc_html__('Single Post', 'grandconference' ),
        'panel'		  => 'blog',
        'priority'    => 55,

    ) );
    
    $wp_customize->add_section( 'session_general', array(
        'title'       => esc_html__('General', 'grandconference' ),
        'panel'		  => 'session',
        'priority'    => 56,

    ) );
    
    $wp_customize->add_section( 'pages_templates', array(
        'title'       => esc_html__('Templates', 'grandconference' ),
        'panel'		  => 'pages',
        'priority'    => 57,
    
    ) );
    
    //Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
		$wp_customize->add_section( 'shop_layout', array(
	        'title'       => esc_html__('Layout', 'grandconference' ),
	        'panel'		  => 'shop',
	        'priority'    => 55,
	
	    ) );
	    
	    $wp_customize->add_section( 'shop_single', array(
	        'title'       => esc_html__('Single Product', 'grandconference' ),
	        'panel'		  => 'shop',
	        'priority'    => 56,
	
	    ) );
	}

}
add_action( 'customize_register', 'grandconference_add_panels_and_sections' );

/**
 * Register and setting to header section
 */
function grandconference_header_setting( $wp_customize ) {

	//Register Logo Tab Settings
	$wp_customize->add_setting( 'tg_favicon', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
	
    $wp_customize->add_setting( 'tg_retina_logo', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_setting( 'tg_retina_transparent_logo', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    //End Logo Tab Settings
    
    //Register General Tab Settings
    $wp_customize->add_setting( 'tg_enable_right_click', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_enable_dragging', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_body_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_body_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
	$wp_customize->add_setting( 'tg_header_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_header_font_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h1_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h2_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h3_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h4_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h5_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h6_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_content_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_link_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_hover_link_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_h1_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_hr_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_input_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_input_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_input_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_input_focus_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_button_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_button_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_button_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_button_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    //End General Tab Settings
    

    //Register Menu Tab Settings
    $wp_customize->add_setting( 'tg_menu_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_fixed_menu', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_padding', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_font_spacing', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_hover_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_active_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_font_spacing', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_hover_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_hover_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_megamenu_header_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_megamenu_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar_social_link', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_contact_hours', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_contact_number', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_search', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_search_input_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_search_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_spacing', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_hover_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    //End Menu Tab Settings
    
    //Register Header Tab Settings
	$wp_customize->add_setting( 'tg_page_header_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_page_header_padding_top', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_header_padding_bottom', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_font_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_font_spacing', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_bg_height', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_header_builder_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_header_builder_font_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    //End Header Tab Settings
    
    //Register Copyright Tab Settings
    
    $wp_customize->add_setting( 'tg_footer_sidebar', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
	
	$wp_customize->add_setting( 'tg_footer_social_link', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
	$wp_customize->add_setting( 'tg_footer_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_link_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_hover_link_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_social_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_copyright_text', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_html',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_copyright_right_area', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_copyright_totop', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    //End Copyright Tab Settings
    
    
    //Begin Gallery Tab Settings
    $wp_customize->add_setting( 'tg_gallery_sort', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_lightbox_skin', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_lightbox_enable_caption', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_lightbox_thumbnails', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_lightbox_opacity', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_gallery_hover_slide', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_full_autoplay', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_full_slideshow_timer', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_full_slideshow_trans', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_full_slideshow_trans_speed', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_full_image_caption', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_full_nocover', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_full_arrow', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_kenburns_timer', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_kenburns_zoom', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_kenburns_trans', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    //End Gallery Tab Settings
    
    
    //Begin Portfolio Tab Settings
    $wp_customize->add_setting( 'tg_portfolio_filterable', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_filterable_link', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_filterable_sort', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_items', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_next_prev', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_recent', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    //End Portfolio Tab Settings
    
    
    //Begin Blog Tab Settings
    $wp_customize->add_setting( 'tg_blog_display_full', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_archive_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_category_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_tag_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_header_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_feat_content', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_display_tags', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_display_author', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_display_related', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandconference_sanitize_checkbox',
    ) );
    //End Blog Tab Settings
    
    
    //Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
		//Begin Shop Tab Settings
		$wp_customize->add_setting( 'tg_shop_layout', array(
	        'type'           => 'theme_mod',
	        'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'esc_html',
	    ) );
	    
	    $wp_customize->add_setting( 'tg_shop_items', array(
	        'type'           => 'theme_mod',
	        'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'grandconference_sanitize_slider',
	    ) );
	    
	    $wp_customize->add_setting( 'tg_shop_price_font_color', array(
	        'type'           => 'theme_mod',
	        'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    
	    $wp_customize->add_setting( 'tg_shop_related_products', array(
	        'type'           => 'theme_mod',
	        'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'grandconference_sanitize_checkbox',
	    ) );
		//End Shop Tab Settings
	}
    
    
    //Add Live preview
    if ( $wp_customize->is_preview() && ! is_admin() ) {
	    add_action( 'wp_footer', 'grandconference_customize_preview', 21);
	}
}
add_action( 'customize_register', 'grandconference_header_setting' );

/**
 * Create the setting
 */
function grandconference_custom_setting( $controls ) {

	//Default control choices
	$tg_text_transform = array(
	    'none' => 'None',
	    'capitalize' => 'Capitalize',
	    'uppercase' => 'Uppercase',
	    'lowercase' => 'Lowercase',
	);
	
	$tg_text_alignment = array(
	    'left' => 'Left',
	    'center' => 'Center',
	    'right' => 'Right',
	);
	
	$tg_text_vertical_alignment = array(
	    'baseline' => 'Baseline',
	    'center' => 'Center',
	);
	
	$tg_copyright_content = array(
	    'social' => 'Social Icons',
	    'menu' => 'Footer Menu',
	);
    
    $tg_footer_content = array(
        'content' => 'Footer Content',
        'sidebar' => 'Sidebar',
        'hide' => 'Hide Footer Content',
    );
    
    $tg_header_content = array(
        'content' => 'Header Content',
        'menu' => 'General Menu Layout',
    );
	
	$tg_copyright_column = array(
	    '' => 'Hide Footer Sidebar',
	    1 => '1 Column',
	    2 => '2 Column',
	    3 => '3 Column',
	    4 => '4 Column',
	);
	
	$tg_gallery_sort = array(
		'drag' => 'By Drag&drop',
		'post_date' => 'By Newest',
		'post_date_old' => 'By Oldest',
		'rand' => 'By Random',
		'title' => 'By Title',
	);
	
	$tg_session_sort = array(
		'start_time' => 'By Start Time',
		'title' => 'By Title',
		'menu_order' => 'By Default order',
	);
    
    $tg_speaker_sort = array(
        'menu_order' => 'By Drag&drop',
        'post_date' => 'By Newest',
        'post_date_old' => 'By Oldest',
        'rand' => 'By Random',
        'title' => 'By Title',
    );
	
	$tg_portfolio_filterable_sort = array(
		'name' => 'By Name',
		'slug' => 'By Slug',
		'id' => 'By ID',
		'count' => 'By Number of Portfolio',
	);
	
	$tg_blog_layout = array(
		'blog_g' => 'Grid',
		'blog_gs' => 'Grid + Right Siebar',
		'blog_gls' => 'Grid + Left Siebar',
		'blog_r' => 'Right Sidebar',
		'blog_l' => 'Left Sidebar',
		'blog_f' => 'Fullwidth',
	);
	
	$tg_shop_layout = array(
		'fullwidth' => 'Fullwidth',
		'sidebar' => 'With Sidebar',
	);
	
	$tg_slideshow_trans = array(
	    1 => 'Fade',
	    2 => 'Slide Top',
	    3 => 'Slide Right',
	    4 => 'Slide Bottom',
	    5 => 'Slide Left',
	    6 => 'Carousel Right',
	    7 => 'Carousel Left',
	);
	
	$tg_menu_layout = array(
	    'leftalign' => 'Left Align',
	    'centeralign' => 'Center Align',
	    'centeralogo' => 'Center Logo + 2 Menus',
	    'hammenuside' => 'Hamburger Menu + Side Menu',
	    'hammenufull' => 'Hamburger Menu + Fullscreen Menu',
	);
	
	$tg_slider_layout = array(
		'slider' => 'Fullwidth',
		'3cols-slider' => '3 Columns',
	);
	
	$tg_lightbox_skin = array(
		'metro-white' => 'White',
		'metro-black' => 'Black',
		'light' => 'Light',
		'mac' => 'Mac',
		'smooth' => 'Smooth',
	);
	
	$tg_lightbox_thumbnails = array(
		'' => 'No Thumbnail',
		'horizontal' => 'Horizontal Align',
		'vertical' => 'Vertical Align',
	);
	
	$tg_sidemenu_align = array(
		'left' => 'Left',
		'right' => 'Right',
	);
	
	$tg_sidemenu_text_align = array(
		'left' => 'Left',
		'center' => 'Center',
		'right' => 'Right',
	);
	
	$tg_sidemenu_overlay_effect = array(
		'blur' => 'Blur',
		'fade' => 'Fade',
		'no_effect' => 'No Effect',
	);
	
	//Get all categories
	$categories_arr = get_categories();
	$tg_categories_select = array();
	$tg_categories_select[''] = '';
	
	foreach ($categories_arr as $cat) {
		$tg_categories_select[$cat->cat_ID] = $cat->cat_name;
	}
	
	//Get all gallery categories
	$gallery_categories_arr = get_terms('gallerycat', 'hide_empty=0&hierarchical=0&parent=0&orderby=name');
	$tg_gallery_categories_select = array();
	$tg_gallery_categories_select[''] = '';
	
	if(!empty($gallery_categories_arr) && is_array($gallery_categories_arr))
	{
		foreach ($gallery_categories_arr as $gallery_cat) {
			$tg_gallery_categories_select[$gallery_cat->slug] = $gallery_cat->name;
		}
	}
    
    //Get all footer posts
    $args = array(
         'post_type'     => 'footer',
         'post_status'   => array( 'publish' ),
         'numberposts'   => -1,
         'orderby'       => 'title',
         'order'         => 'ASC',
         'suppress_filters'   => false
    );
    $footers = get_posts($args);
    $tg_footers_select = array();
    $tg_footers_select[''] = '';
    
    if(!empty($footers))
    {
        foreach ($footers as $footer)
        {
            $tg_footers_select[$footer->ID] = $footer->post_title;
        }
    }
    
    //Get all header posts
    $args = array(
         'post_type'     => 'header',
         'post_status'   => array( 'publish' ),
         'numberposts'   => -1,
         'orderby'       => 'title',
         'order'         => 'ASC',
         'suppress_filters'   => false
    );
    $headers = get_posts($args);
    $tg_headers_select = array();
    $tg_headers_select[''] = '';
    
    if(!empty($headers))
    {
        foreach ($headers as $header)
        {
            $tg_headers_select[$header->ID] = $header->post_title;
        }
    }
    
    //Get all fullscreen menus
    $args = array(
        'numberposts' => -1,
        'post_type' => array('fullmenu'),
        'post_status'   => array( 'publish' ),
        'orderby'   => 'post_title',
        'order'     => 'ASC',
        'suppress_filters'   => false
    );
    
    $tg_fullmenu_arr = get_posts($args);
    $tg_fullmenu_select = array();
    $tg_fullmenu_select[''] = '';
    
    foreach($tg_fullmenu_arr as $tg_fullmenu)
    {
        $tg_fullmenu_select[$tg_fullmenu->ID] = $tg_fullmenu->post_title;
    }
	
	//Register Logo Tab Settings
	$controls[] = array(
        'type'     => 'image',
        'settings'  => 'tg_retina_logo',
        'label'    => esc_html__('Retina Logo', 'grandconference' ),
        'description' => esc_html__('Retina Ready Image logo. It should be 2x size of normal logo. For example 200x60px logo will displays at 100x30px', 'grandconference' ),
        'section'  => 'logo_favicon',
	    'default'  => get_template_directory_uri().'/images/logo@2x.png',
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'image',
        'settings'  => 'tg_retina_transparent_logo',
        'label'    => esc_html__('Retina Transparent Logo', 'grandconference' ),
        'description' => esc_html__('Retina Ready Image logo for menu transparent page. It should be 2x size of normal logo. For example 200x60px logo will displays at 100x30px. Recommend logo color is white or bright color', 'grandconference' ),
        'section'  => 'logo_favicon',
	    'default'  => get_template_directory_uri().'/images/logo@2x_white.png',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_retina_logo_for_admin',
        'label'    => esc_html__('Display Retina Logo in Theme Setting', 'grandconference' ),
        'description' => esc_html__('Check this to replace theme setting to your logo. It helps branding your site', 'grandconference' ),
        'section'  => 'logo_favicon',
        'default'  => '',
	    'priority' => 4,
    );
    //End Logo Tab Settings
    
    //Register General Tab Settings
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_enable_right_click',
        'label'    => esc_html__('Enable Right Click Protection', 'grandconference' ),
        'description' => esc_html__('Check this to disable right click.', 'grandconference' ),
        'section'  => 'general_image',
        'default'  => '',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_enable_dragging',
        'label'    => esc_html__('Enable Image Dragging Protection', 'grandconference' ),
        'description' => esc_html__('Check this to disable dragging on all images.', 'grandconference' ),
        'section'  => 'general_image',
        'default'  => '',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_body_typography_title',
        'label'    => esc_html__('Body and Content Settings', 'grandconference' ),
        'section'  => 'general_typography',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_body_typography',
        'label'    => esc_html__('Main Content Typography', 'grandconference' ),
        'section'  => 'general_typography',
        'default'  => array(
            'font-family'    => 'Work Sans',
            'variant'        => '400',
            'font-size'      => '15px',
            'line-height'    => '1.7',
            'letter-spacing' => '0',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => 'body, input[type=text], input[type=password], input[type=email], input[type=url], input[type=date], input[type=tel], input.wpcf7-text, .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, select, textarea, .tribe-events-content ol, .tribe-events-content p, .tribe-events-content ul, .tribe-events-event-meta, .tribe-events-meta-group dl span.tribe-address, .tribe-events-meta-group dl span.tribe-address > span, .tribe-events .datepicker .datepicker-switch, .tribe-events .datepicker .day, .tribe-events .datepicker .dow, .tribe-common .tribe-common-h7, .tribe-common .tribe-common-h8, .tribe-events .tribe-events-calendar-list__event-date-tag-weekday, .tribe-common .tribe-common-b2, .tribe-common .tribe-common-b3, .single-tribe_events .tribe-events-c-subscribe-dropdown .tribe-events-c-subscribe-dropdown__list-item, .tribe-events .tribe-events-c-subscribe-dropdown .tribe-events-c-subscribe-dropdown__list-item, .event-tickets .tribe-tickets__commerce-checkout-cart-item-price, .event-tickets .tribe-tickets__commerce-checkout-cart-item-quantity, .event-tickets .tribe-tickets__commerce-checkout-cart-item-subtotal, .tribe-common .tribe-tickets__commerce-checkout-cart-item-price, .tribe-common .tribe-tickets__commerce-checkout-cart-item-quantity, .tribe-common .tribe-tickets__commerce-checkout-cart-item-subtotal, .event-tickets .tribe-tickets__commerce-checkout-cart-footer-quantity, .event-tickets .tribe-tickets__commerce-checkout-cart-footer-total, .tribe-common .tribe-tickets__commerce-checkout-cart-footer-quantity, .tribe-common .tribe-tickets__commerce-checkout-cart-footer-total, .tribe-common .tribe-common-b1',
            ),
        ),
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_header_typography_title',
        'label'    => esc_html__('Header Settings', 'grandconference' ),
        'section'  => 'general_typography',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_header_typography',
        'label'    => esc_html__('Header Typography', 'grandconference' ),
        'section'  => 'general_typography',
        'default'  => array(
            'font-family'    => 'Poppins',
            'variant'        => '700',
            'line-height'    => '1.5',
            'letter-spacing' => '0px',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => 'h1, h2, h3, h4, h5, h6, h7, .post_quote_title, label, strong[itemprop="author"], #page_content_wrapper .posts.blog li a, .page_content_wrapper .posts.blog li a, .readmore, .page_tagline, #gallery_caption .tg_caption .tg_desc, #filter_selected, #autocomplete li strong, blockquote, .sidebar_widget li.widget_products, #copyright, #footer_menu li a, #footer ul.sidebar_widget li ul.posts.blog li a, .woocommerce-page table.cart th, table.shop_table thead tr th, .woocommerce-page div.product .woocommerce-tabs ul.tabs li a, .woocommerce ul.products li.product .price, .tribe-events-single-event-title, .tribe-events .tribe-events-header__title h1.tribe-events-header__title-text, .tribe-events .tribe-events-header__title h2.tribe-events-header__title-text, .tribe-events .tribe-events-header__title h3.tribe-events-header__title-text, .tribe-events .tribe-events-header__title h4.tribe-events-header__title-text, .tribe-events .tribe-events-header__title h5.tribe-events-header__title-text, .tribe-events .tribe-events-header__title h6.tribe-events-header__title-text, .tribe-common .tribe-common-h5, .tribe-common .tribe-common-h6, .tribe-common .tribe-common-h2, .tribe-common .tribe-common-h4',
            ),
        ),
        'priority' => 2
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_header_font_weight',
        'label'    => esc_html__('Header Font Weight', 'grandconference' ),
        'section'  => 'general_typography',
        'default'  => 700,
        'choices' => array( 'min' => 100, 'max' => 900, 'step' => 100 ),
        'output' => array(
	        array(
	            'element'  => 'h1, h2, h3, h4, h5, h6, h7, #autocomplete li strong',
	            'property' => 'font-weight',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 2,
	    'js_vars'   => array(
			array(
				'element'  => 'h1, h2, h3, h4, h5, h6, h7, #autocomplete li strong',
				'function' => 'css',
				'property' => 'font-weight',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_header_font_spacing',
        'label'    => esc_html__('H1, H2, H3, H4, H5, H6 Font Spacing', 'grandconference' ),
        'section'  => 'general_typography',
        'default'  => 0,
        'choices' => array( 'min' => -2, 'max' => 5, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h1, h2, h3, h4, h5, h6, h7, #autocomplete li strong',
	            'property' => 'letter-spacing',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 2,
	    'js_vars'   => array(
			array(
				'element'  => 'h1, h2, h3, h4, h5, h6, h7, #autocomplete li strong',
				'function' => 'css',
				'property' => 'letter-spacing',
				'units'    => 'px',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_h1_size',
        'label'    => esc_html__('H1 Font Size', 'grandconference' ),
        'section'  => 'general_typography',
        'default'  => 34,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h1',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'priority' => 3,
	    'js_vars'   => array(
			array(
				'element'  => 'h1',
				'function' => 'css',
				'property' => 'font-size',
				'units'    => 'px',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_h2_size',
        'label'    => esc_html__('H2 Font Size', 'grandconference' ),
        'section'  => 'general_typography',
        'default'  => 28,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h2',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'priority' => 4,
	    'js_vars'   => array(
			array(
				'element'  => 'h2',
				'function' => 'css',
				'property' => 'font-size',
				'units'    => 'px',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_h3_size',
        'label'    => esc_html__('H3 Font Size', 'grandconference' ),
        'section'  => 'general_typography',
        'default'  => 24,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h3',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'priority' => 5,
	    'js_vars'   => array(
			array(
				'element'  => 'h3',
				'function' => 'css',
				'property' => 'font-size',
				'units'    => 'px',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_h4_size',
        'label'    => esc_html__('H4 Font Size', 'grandconference' ),
        'section'  => 'general_typography',
        'default'  => 20,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h4',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'priority' => 6,
	    'js_vars'   => array(
			array(
				'element'  => 'h4',
				'function' => 'css',
				'property' => 'font-size',
				'units'    => 'px',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_h5_size',
        'label'    => esc_html__('H5 Font Size', 'grandconference' ),
        'section'  => 'general_typography',
        'default'  => 18,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h5',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'priority' => 7,
	    'js_vars'   => array(
			array(
				'element'  => 'h5',
				'function' => 'css',
				'property' => 'font-size',
				'units'    => 'px',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_h6_size',
        'label'    => esc_html__('H6 Font Size', 'grandconference' ),
        'section'  => 'general_typography',
        'default'  => 16,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h6',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'priority' => 8,
	    'js_vars'   => array(
			array(
				'element'  => 'h6',
				'function' => 'css',
				'property' => 'font-size',
				'units'    => 'px',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_post_typography_title',
        'label'    => esc_html__('Custom Post Settings', 'grandconference' ),
        'section'  => 'general_typography',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_speaker_title_font_size',
        'label'    => esc_html__('Speaker Font Size', 'grandconference' ),
        'section'  => 'general_typography',
        'default'  => 20,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption h1, .ppb_title, .post_caption h1, .ppb_speaker_grid .speaker_info_wrapper h3, .ppb_speaker_grid .speaker_info_wrapper h4, .ppb_speaker_classic .speaker_info_wrapper h3, .ppb_speaker_classic .speaker_info_wrapper h4',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'priority' => 9,
	    'js_vars'   => array(
			array(
				'element'  => '#page_caption h1, .ppb_title, .post_caption h1, .ppb_speaker_grid .speaker_info_wrapper h3, .ppb_speaker_grid .speaker_info_wrapper h4, .ppb_speaker_classic .speaker_info_wrapper h3, .ppb_speaker_classic .speaker_info_wrapper h4',
				'function' => 'css',
				'property' => 'font-size',
				'units'    => 'px',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_general_bg_color_title',
        'label'    => esc_html__('General Colors Settings', 'grandconference' ),
        'section'  => 'general_color',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_content_bg_color',
        'label'    => esc_html__('Main Content Background Color', 'grandconference' ),
        'section'  => 'general_color',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => 'body, #wrapper, #page_content_wrapper.fixed, #gallery_lightbox h2, .slider_wrapper .gallery_image_caption h2, #body_loading_screen, h3#reply-title span, .overlay_gallery_wrapper, .pricing_wrapper_border, .pagination a, .pagination span, #captcha-wrap .text-box input, .flex-direction-nav a, .blog_promo_title h6, #supersized li, #gallery_caption .tg_caption, #horizontal_gallery_wrapper .image_caption, .scheduleday_wrapper li .expandable, .scheduleday_wrapper li .session_content_wrapper',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
	    'js_vars'   => array(
			array(
				'element'  => 'body, #wrapper, #page_content_wrapper.fixed, #gallery_lightbox h2, .slider_wrapper .gallery_image_caption h2, #body_loading_screen, h3#reply-title span, .overlay_gallery_wrapper, .pricing_wrapper_border, .pagination a, .pagination span, #captcha-wrap .text-box input, .flex-direction-nav a, .blog_promo_title h6, #supersized li, #gallery_caption .tg_caption, #horizontal_gallery_wrapper .image_caption, .scheduleday_wrapper li .expandable, .scheduleday_wrapper li .session_content_wrapper',
				'function' => 'css',
				'property' => 'background-color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_font_color',
        'label'    => esc_html__('Page Content Font Color', 'grandconference' ),
        'section'  => 'general_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => 'body, .pagination a, #gallery_lightbox h2, .slider_wrapper .gallery_image_caption h2, .post_info a, #page_content_wrapper.split #copyright, .page_content_wrapper.split #copyright, .ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited, .readmore, .woocommerce-MyAccount-navigation ul a',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '::selection',
	            'property' => 'background-color',
	        ),
	        array(
	            'element'  => '::-webkit-input-placeholder',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '::-moz-placeholder',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => ':-ms-input-placeholder',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 11,
	    'js_vars'   => array(
			array(
				'element'  => 'body, .pagination a, #gallery_lightbox h2, .slider_wrapper .gallery_image_caption h2, .post_info a, #page_content_wrapper.split #copyright, .page_content_wrapper.split #copyright, .ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited, .readmore, .woocommerce-MyAccount-navigation ul a',
				'function' => 'css',
				'property' => 'color',
			),
			array(
				'element'  => '::selection',
				'function' => 'css',
				'property' => 'background-color',
			),
			array(
				'element'  => '::-webkit-input-placeholder',
				'function' => 'css',
				'property' => 'background-color',
			),
			array(
				'element'  => '::-moz-placeholder',
				'function' => 'css',
				'property' => 'background-color',
			),
			array(
				'element'  => ':-ms-input-placeholder',
				'function' => 'css',
				'property' => 'background-color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_link_color',
        'label'    => esc_html__('Page Content Link Color', 'grandconference' ),
        'section'  => 'general_color',
        'default'  => '#FF2D55',
        'output' => array(
	        array(
	            'element'  => 'a, .skin_color',
	            'property' => 'color',
	        ),
	         array(
	            'element'  => '.flex-control-paging li a.flex-active',
	            'property' => 'background-color',
	        ),
	         array(
	            'element'  => '.flex-control-paging li a.flex-active',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 12,
	    'js_vars'   => array(
			array(
	            'element'  => 'a, .skin_color',
	            'property' => 'color',
	        ),
	         array(
	            'element'  => '.flex-control-paging li a.flex-active',
	            'property' => 'background-color',
	        ),
	         array(
	            'element'  => '.flex-control-paging li a.flex-active',
	            'property' => 'border-color',
	        ),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_hover_link_color',
        'label'    => esc_html__('Page Content Hover Link Color', 'grandconference' ),
        'section'  => 'general_color',
        'default'  => '#FF2D55',
        'output' => array(
	        array(
	            'element'  => 'a:hover, a:active, .post_info_comment a i, ',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '.post_excerpt.post_tag a:hover, input[type=button]:hover, input[type=submit]:hover, a.button:hover, .button:hover, .button.submit, a.button.white:hover, .button.white:hover, a.button.white:active, .button.white:active',
	            'property' => 'background',
	        ),
	        array(
	            'element'  => '.post_excerpt.post_tag a:hover, input[type=button]:hover, input[type=submit]:hover, a.button:hover, .button:hover, .button.submit, a.button.white:hover, .button.white:hover, a.button.white:active, .button.white:active',
	            'property' => 'border-color',
	        ),
	    ),
	    'js_vars'   => array(
			array(
	            'element'  => 'a:hover, a:active, .post_info_comment a i',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '.post_excerpt.post_tag a:hover, input[type=button]:hover, input[type=submit]:hover, a.button:hover, .button:hover, .button.submit, a.button.white:hover, .button.white:hover, a.button.white:active, .button.white:active',
	            'property' => 'background',
	        ),
	        array(
	            'element'  => '.post_excerpt.post_tag a:hover, input[type=button]:hover, input[type=submit]:hover, a.button:hover, .button:hover, .button.submit, a.button.white:hover, .button.white:hover, a.button.white:active, .button.white:active',
	            'property' => 'border-color',
	        ),
		),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_h1_font_color',
        'label'    => esc_html__('H1, H2, H3, H4, H5, H6 Font Color', 'grandconference' ),
        'section'  => 'general_color',
        'default'  => '#000000',
        'output' => array(
	        array(
	            'element'  => 'h1, h2, h3, h4, h5, h6, h7, pre, code, tt, blockquote, .post_header h5 a, .post_header h3 a, .post_header.grid h6 a, .post_header.fullwidth h4 a, .post_header h5 a, blockquote, .site_loading_logo_item i, .ppb_subtitle, .woocommerce .woocommerce-ordering select, .woocommerce #page_content_wrapper a.button, .woocommerce.columns-4 ul.products li.product a.add_to_cart_button, .woocommerce.columns-4 ul.products li.product a.add_to_cart_button:hover, .ui-accordion .ui-accordion-header a, .tabs .ui-state-active a, body.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .post_header h5 a, .post_header h6 a, .flex-direction-nav a:before, .social_share_button_wrapper .social_post_view .view_number, .social_share_button_wrapper .social_post_share_count .share_number, .portfolio_post_previous a, .portfolio_post_next a, #filter_selected, #autocomplete li strong, .post_detail.single_post a, .post_detail.single_post a:hover,.post_detail.single_post a:active, .ticket_wrapper li.price_row, .themelink',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => 'body.page.page-template-gallery-archive-split-screen-php #fp-nav li .active span, body.tax-gallerycat #fp-nav li .active span, body.page.page-template-portfolio-fullscreen-split-screen-php #fp-nav li .active span, body.page.tax-portfolioset #fp-nav li .active span, body.page.page-template-gallery-archive-split-screen-php #fp-nav ul li a span, body.tax-gallerycat #fp-nav ul li a span, body.page.page-template-portfolio-fullscreen-split-screen-php #fp-nav ul li a span, body.page.tax-portfolioset #fp-nav ul li a span',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 14,
	    'js_vars'   => array(
			array(
				'element'  => 'h1, h2, h3, h4, h5, h6, h7, pre, code, tt, blockquote, .post_header h5 a, .post_header h3 a, .post_header.grid h6 a, .post_header.fullwidth h4 a, .post_header h5 a, blockquote, .site_loading_logo_item i, .ppb_subtitle, .woocommerce .woocommerce-ordering select, .woocommerce #page_content_wrapper a.button, .woocommerce.columns-4 ul.products li.product a.add_to_cart_button, .woocommerce.columns-4 ul.products li.product a.add_to_cart_button:hover, .ui-accordion .ui-accordion-header a, .tabs .ui-state-active a, body.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .post_header h5 a, .post_header h6 a, .flex-direction-nav a:before, .social_share_button_wrapper .social_post_view .view_number, .social_share_button_wrapper .social_post_share_count .share_number, .portfolio_post_previous a, .portfolio_post_next a, #filter_selected, #autocomplete li strong, .post_detail.single_post a, .post_detail.single_post a:hover,.post_detail.single_post a:active, .ticket_wrapper li.price_row, .themelink',
				'function' => 'css',
				'property' => 'color',
			),
			array(
				'element'  => 'body.page.page-template-gallery-archive-split-screen-php #fp-nav li .active span, body.tax-gallerycat #fp-nav li .active span, body.page.page-template-portfolio-fullscreen-split-screen-php #fp-nav li .active span, body.page.tax-portfolioset #fp-nav li .active span, body.page.page-template-gallery-archive-split-screen-php #fp-nav ul li a span, body.tax-gallerycat #fp-nav ul li a span, body.page.page-template-portfolio-fullscreen-split-screen-php #fp-nav ul li a span, body.page.tax-portfolioset #fp-nav ul li a span',
				'function' => 'css',
				'property' => 'background-color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_hr_color',
        'label'    => esc_html__('Horizontal Line Color', 'grandconference' ),
        'section'  => 'general_color',
        'default'  => '#dce0e0',
        'output' => array(
	        array(
	            'element'  => '#social_share_wrapper, hr, #social_share_wrapper, .post.type-post, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle, .comment .right, .widget_tag_cloud div a, .meta-tags a, .tag_cloud a, #footer, #post_more_wrapper, .woocommerce ul.products li.product, .woocommerce-page ul.products li.product, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, #page_content_wrapper .inner .sidebar_content, #page_content_wrapper .inner .sidebar_content.left_sidebar, .ajax_close, .ajax_next, .ajax_prev, .portfolio_next, .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_next, .separated, .blog_next_prev_wrapper, #post_more_wrapper h5, #ajax_portfolio_wrapper.hidding, #ajax_portfolio_wrapper.visible, .tabs.vertical .ui-tabs-panel, .ui-tabs.vertical.right .ui-tabs-nav li, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs .panel, .woocommerce-page div.product .woocommerce-tabs .panel, .woocommerce #content div.product .woocommerce-tabs .panel, .woocommerce-page #content div.product .woocommerce-tabs .panel, .woocommerce table.shop_table, .woocommerce-page table.shop_table, table tr td, .woocommerce .cart-collaterals .cart_totals, .woocommerce-page .cart-collaterals .cart_totals, .woocommerce .cart-collaterals .shipping_calculator, .woocommerce-page .cart-collaterals .shipping_calculator, .woocommerce .cart-collaterals .cart_totals tr td, .woocommerce .cart-collaterals .cart_totals tr th, .woocommerce-page .cart-collaterals .cart_totals tr td, .woocommerce-page .cart-collaterals .cart_totals tr th, table tr th, .woocommerce #payment, .woocommerce-page #payment, .woocommerce #payment ul.payment_methods li, .woocommerce-page #payment ul.payment_methods li, .woocommerce #payment div.form-row, .woocommerce-page #payment div.form-row, .ui-tabs li:first-child, .ui-tabs .ui-tabs-nav li, .ui-tabs.vertical .ui-tabs-nav li, .ui-tabs.vertical.right .ui-tabs-nav li.ui-state-active, .ui-tabs.vertical .ui-tabs-nav li:last-child, #page_content_wrapper .inner .sidebar_wrapper ul.sidebar_widget li.widget_nav_menu ul.menu li.current-menu-item a, .page_content_wrapper .inner .sidebar_wrapper ul.sidebar_widget li.widget_nav_menu ul.menu li.current-menu-item a, .pricing_wrapper, .pricing_wrapper li, .ui-accordion .ui-accordion-header, .ui-accordion .ui-accordion-content, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle:before, h2.widgettitle:before, #autocomplete, .ppb_blog_minimal .one_third_bg, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.event_title, .tabs .ui-tabs-panel, .ui-tabs .ui-tabs-nav li, .ui-tabs li:first-child, .ui-tabs.vertical .ui-tabs-nav li:last-child, .woocommerce .woocommerce-ordering select, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page table.cart th, table.shop_table thead tr th, hr.title_break, .overlay_gallery_border, #page_content_wrapper.split #copyright, .page_content_wrapper.split #copyright, .post.type-post, .events.type-events, h5.event_title, .post_header h5.event_title, .client_archive_wrapper, #page_content_wrapper .sidebar .content .sidebar_widget li.widget, .page_content_wrapper .sidebar .content .sidebar_widget li.widget, hr.title_break.bold, blockquote, .social_share_button_wrapper, .social_share_button_wrapper, body:not(.single) .post_wrapper, .themeborder, .scheduleday_wrapper li, .tribe-events-meta-group, .tribe-common--breakpoint-medium.tribe-events .tribe-events-c-events-bar--border, .event-tickets .tribe-tickets__rsvp-wrapper',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 15,
	    'js_vars'   => array(
			array(
				'element'  => '#social_share_wrapper, hr, #social_share_wrapper, .post.type-post, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle, .comment .right, .widget_tag_cloud div a, .meta-tags a, .tag_cloud a, #footer, #post_more_wrapper, .woocommerce ul.products li.product, .woocommerce-page ul.products li.product, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, #page_content_wrapper .inner .sidebar_content, #page_content_wrapper .inner .sidebar_content.left_sidebar, .ajax_close, .ajax_next, .ajax_prev, .portfolio_next, .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_next, .separated, .blog_next_prev_wrapper, #post_more_wrapper h5, #ajax_portfolio_wrapper.hidding, #ajax_portfolio_wrapper.visible, .tabs.vertical .ui-tabs-panel, .ui-tabs.vertical.right .ui-tabs-nav li, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs .panel, .woocommerce-page div.product .woocommerce-tabs .panel, .woocommerce #content div.product .woocommerce-tabs .panel, .woocommerce-page #content div.product .woocommerce-tabs .panel, .woocommerce table.shop_table, .woocommerce-page table.shop_table, table tr td, .woocommerce .cart-collaterals .cart_totals, .woocommerce-page .cart-collaterals .cart_totals, .woocommerce .cart-collaterals .shipping_calculator, .woocommerce-page .cart-collaterals .shipping_calculator, .woocommerce .cart-collaterals .cart_totals tr td, .woocommerce .cart-collaterals .cart_totals tr th, .woocommerce-page .cart-collaterals .cart_totals tr td, .woocommerce-page .cart-collaterals .cart_totals tr th, table tr th, .woocommerce #payment, .woocommerce-page #payment, .woocommerce #payment ul.payment_methods li, .woocommerce-page #payment ul.payment_methods li, .woocommerce #payment div.form-row, .woocommerce-page #payment div.form-row, .ui-tabs li:first-child, .ui-tabs .ui-tabs-nav li, .ui-tabs.vertical .ui-tabs-nav li, .ui-tabs.vertical.right .ui-tabs-nav li.ui-state-active, .ui-tabs.vertical .ui-tabs-nav li:last-child, #page_content_wrapper .inner .sidebar_wrapper ul.sidebar_widget li.widget_nav_menu ul.menu li.current-menu-item a, .page_content_wrapper .inner .sidebar_wrapper ul.sidebar_widget li.widget_nav_menu ul.menu li.current-menu-item a, .pricing_wrapper, .pricing_wrapper li, .ui-accordion .ui-accordion-header, .ui-accordion .ui-accordion-content, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle:before, h2.widgettitle:before, #autocomplete, .ppb_blog_minimal .one_third_bg, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.event_title, .tabs .ui-tabs-panel, .ui-tabs .ui-tabs-nav li, .ui-tabs li:first-child, .ui-tabs.vertical .ui-tabs-nav li:last-child, .woocommerce .woocommerce-ordering select, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page table.cart th, table.shop_table thead tr th, hr.title_break, .overlay_gallery_border, #page_content_wrapper.split #copyright, .page_content_wrapper.split #copyright, .post.type-post, .events.type-events, h5.event_title, .post_header h5.event_title, .client_archive_wrapper, #page_content_wrapper .sidebar .content .sidebar_widget li.widget, .page_content_wrapper .sidebar .content .sidebar_widget li.widget, hr.title_break.bold, blockquote, .social_share_button_wrapper, .social_share_button_wrapper, body:not(.single) .post_wrapper, .themeborder, .scheduleday_wrapper li, .tribe-common--breakpoint-medium.tribe-events .tribe-events-c-events-bar--border, .event-tickets .tribe-tickets__rsvp-wrapper',
				'function' => 'css',
				'property' => 'border-color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_session_color_title',
        'label'    => esc_html__('Sessions Colors Settings', 'grandconference' ),
        'section'  => 'general_color',
	    'priority' => 16,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_session_tab_bg_color',
        'label'    => esc_html__('Session Tab Default Background Color', 'grandconference' ),
        'section'  => 'general_color',
        'default'  => '#007bff',
        'output' => array(
	        array(
	            'element'  => '.scheduleday_wrapper li.scheduleday_title, .scheduleday_wrapper.tab',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 16,
	    'js_vars'   => array(
			array(
				'element'  => '.scheduleday_wrapper li.scheduleday_title, .scheduleday_wrapper.tab',
				'function' => 'css',
				'property' => 'background',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_session_tab_active_bg_color',
        'label'    => esc_html__('Session Tab Active Background Color', 'grandconference' ),
        'section'  => 'general_color',
        'default'  => '#FF2D55',
        'output' => array(
	        array(
	            'element'  => '.scheduleday_wrapper.tab li.scheduleday_title.active',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 16,
	    'js_vars'   => array(
			array(
				'element'  => '.scheduleday_wrapper.tab li.scheduleday_title.active',
				'function' => 'css',
				'property' => 'background',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_label_title',
        'label'    => esc_html__('Label Settings', 'grandconference' ),
        'section'  => 'general_input',
        'priority' => 13,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_label_typography',
        'label'    => esc_html__('Label Typography', 'grandconference' ),
        'section'  => 'general_input',
        'default'  => 'Poppins',
        'default'  => array(
            'font-family'    => 'Poppins',
            'variant'        => '600',
            'font-size'      => '14px',
            'line-height'    => '1.8',
            'letter-spacing' => '0',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => 'label',
            ),
        ),
        'priority' => 14,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_label_font_color',
        'label'    => __( 'Label Font Color', 'grandconference' ),
        'section'  => 'general_input',
        'default'  => '#222222',
        'output' => array(
            array(
                'element'  => 'label',
                'property' => 'color',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 14,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_input_title',
        'label'    => esc_html__('Input and Textarea Settings', 'grandconference' ),
        'section'  => 'general_input',
	    'priority' => 16,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_input_typography',
        'label'    => esc_html__('Input and Textarea Typography', 'grandconference' ),
        'section'  => 'general_input',
        'default'  => array(
            'font-family'    => 'Poppins',
            'variant'        => '500',
            'font-size'      => '15px',
            'line-height'    => '1.6',
            'letter-spacing' => '0',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=date], textarea, select, .tribe-common--breakpoint-medium.tribe-common .tribe-common-form-control-text__input, .tribe-common .tribe-common-form-control-text__input',
            ),
        ),
        'priority' => 16,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_input_border_radius',
        'label'    => esc_html__('Input and Textarea Border Radius (px)', 'grandconference' ),
        'section'  => 'general_input',
        'default'  => 5,
        'choices' => array( 'min' => 0, 'max' => 25, 'step' => 1 ),
        'output' => array(
            array(
                'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=date], textarea, .widget_search form, select, .woocommerce div.product form.cart .variations select',
                'property' => 'border-radius',
                'units'    => 'px',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 16,
        'js_vars'   => array(
            array(
                'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=date], textarea, select',
                'function' => 'css',
                'property' => 'border-radius',
                'units'    => 'px',
            ),
        )
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_input_bg_color',
        'label'    => esc_html__('Input and Textarea Background Color', 'grandconference' ),
        'section'  => 'general_input',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=date], textarea, select',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 16,
	    'js_vars'   => array(
			array(
				'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=date], textarea, select',
				'function' => 'css',
				'property' => 'background-color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_input_font_color',
        'label'    => esc_html__('Input and Textarea Font Color', 'grandconference' ),
        'section'  => 'general_input',
        'default'  => '#555555',
        'output' => array(
	        array(
	            'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=date], textarea, select',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 17,
	    'js_vars'   => array(
			array(
				'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=date], textarea, select',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_input_border_color',
        'label'    => esc_html__('Input and Textarea Border Color', 'grandconference' ),
        'section'  => 'general_input',
        'default'  => '#dce0e0',
        'output' => array(
	        array(
	            'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=date], textarea, select',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 18,
	    'js_vars'   => array(
			array(
				'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=date], textarea, select',
				'function' => 'css',
				'property' => 'border-color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_input_focus_color',
        'label'    => esc_html__('Input and Textarea Focus State Color', 'grandconference' ),
        'section'  => 'general_input',
        'default'  => '#999999',
        'output' => array(
	        array(
	            'element'  => 'input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, input[type=url]:focus, input[type=date]:focus, textarea:focus',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 19,
	    'js_vars'   => array(
			array(
				'element'  => 'input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, input[type=url]:focus, input[type=date]:focus, textarea:focus',
				'function' => 'css',
				'property' => 'border-color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_button_title',
        'label'    => esc_html__('Button Settings', 'grandconference' ),
        'section'  => 'general_input',
	    'priority' => 19,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_button_typography',
        'label'    => esc_html__('Button Typography', 'grandconference' ),
        'section'  => 'general_input',
        'default'  => array(
            'font-family'    => 'Poppins',
            'variant'        => '500',
            'font-size'      => '15px',
            'line-height'    => '1.6',
            'letter-spacing' => '0px',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => 'input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .tribe-common .tribe-common-c-btn, .tribe-common a.tribe-common-c-btn, .tribe-common button.tribe-common-c-btn, .tribe-events .tribe-events-c-search__button:focus, .tribe-events .tribe-events-c-search__button:hover, .tribe-events button.tribe-events-c-search__button:focus, .tribe-events button.tribe-events-c-search__button:hover, .tribe-events .tribe-events-c-view-selector__list-item-text, .tribe-common .tribe-common-c-btn-border-small, .tribe-common a.tribe-common-c-btn-border-small, .tribe-common .tribe-common-h3, .tribe-common .tribe-common-c-btn-border, .tribe-common a.tribe-common-c-btn-border',
            ),
        ),
        'priority' => 19,
    );
    
    $controls[] = array(
        'type'     => 'dimensions',
        'settings'  => 'tg_button_padding',
        'label'    => __( 'Button Padding', 'grandconference' ),
        'section'  => 'general_input',
        'default'     => [
            'padding-top'    => '0.6em',
            'padding-right' => '2.5em',
            'padding-bottom'   => '0.6em',
            'padding-left'  => '2.5em',
        ],
        'choices'     => [
            'labels' => [
                'padding-top'  => esc_html__( 'Padding Top', 'grandconference' ),
                'padding-right'  => esc_html__( 'Padding Right', 'grandconference' ),
                'padding-bottom' => esc_html__( 'Padding Bottom', 'grandconference' ),
                'padding-left' => esc_html__( 'Padding Left', 'grandconference' ),
            ],
        ],
        'output' => array(
            array(
                  'choice'      => 'padding-top',
                  'element'  => 'input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .tribe-common .tribe-common-c-btn, .tribe-common a.tribe-common-c-btn, .tribe-common button.tribe-common-c-btn, .tribe-events .tribe-events-c-search__button:focus, .tribe-events .tribe-events-c-search__button:hover, .tribe-events button.tribe-events-c-search__button:focus, .tribe-events button.tribe-events-c-search__button:hover, .tribe-events .tribe-events-c-view-selector__list-item-text, .tribe-common .tribe-common-c-btn-border-small, .tribe-common a.tribe-common-c-btn-border-small, .tribe-common .tribe-common-h3, .tribe-common .tribe-common-c-btn-border, .tribe-common a.tribe-common-c-btn-border',
                  'property'    => 'padding-top',
            ),
           array(
                 'choice'      => 'padding-right',
                 'element'  => 'input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .tribe-common .tribe-common-c-btn, .tribe-common a.tribe-common-c-btn, .tribe-common button.tribe-common-c-btn, .tribe-events .tribe-events-c-search__button:focus, .tribe-events .tribe-events-c-search__button:hover, .tribe-events button.tribe-events-c-search__button:focus, .tribe-events button.tribe-events-c-search__button:hover, .tribe-events .tribe-events-c-view-selector__list-item-text, .tribe-common .tribe-common-c-btn-border-small, .tribe-common a.tribe-common-c-btn-border-small, .tribe-common .tribe-common-h3, .tribe-common .tribe-common-c-btn-border, .tribe-common a.tribe-common-c-btn-border',
                 'property'    => 'padding-right',
           ),
           array(
                'choice'      => 'padding-bottom',
                'element'  => 'input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .tribe-common .tribe-common-c-btn, .tribe-common a.tribe-common-c-btn, .tribe-common button.tribe-common-c-btn, .tribe-events .tribe-events-c-search__button:focus, .tribe-events .tribe-events-c-search__button:hover, .tribe-events button.tribe-events-c-search__button:focus, .tribe-events button.tribe-events-c-search__button:hover, .tribe-events .tribe-events-c-view-selector__list-item-text, .tribe-common .tribe-common-c-btn-border-small, .tribe-common a.tribe-common-c-btn-border-small, .tribe-common .tribe-common-h3, .tribe-common .tribe-common-c-btn-border, .tribe-common a.tribe-common-c-btn-border',
                'property'    => 'padding-bottom',
            ),
            array(
                'choice'      => 'padding-left',
                'element'  => 'input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .tribe-common .tribe-common-c-btn, .tribe-common a.tribe-common-c-btn, .tribe-common button.tribe-common-c-btn, .tribe-events .tribe-events-c-search__button:focus, .tribe-events .tribe-events-c-search__button:hover, .tribe-events button.tribe-events-c-search__button:focus, .tribe-events button.tribe-events-c-search__button:hover, .tribe-events .tribe-events-c-view-selector__list-item-text, .tribe-common .tribe-common-c-btn-border-small, .tribe-common a.tribe-common-c-btn-border-small, .tribe-common .tribe-common-h3, .tribe-common .tribe-common-c-btn-border, .tribe-common a.tribe-common-c-btn-border',
                'property'    => 'padding-left',
            ),
        ),
        'transport' => 'postMessage',
        'priority' => 20,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_button_border_radius',
        'label'    => esc_html__('Button Border Radius (px)', 'grandconference' ),
        'section'  => 'general_input',
        'default'  => 25,
        'choices' => array( 'min' => 0, 'max' => 50, 'step' => 1 ),
        'output' => array(
            array(
                'element'  => 'input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .tribe-common .tribe-common-c-btn, .tribe-common a.tribe-common-c-btn, .tribe-common button.tribe-common-c-btn, .tribe-events .tribe-events-c-search__button:focus, .tribe-events .tribe-events-c-search__button:hover, .tribe-events button.tribe-events-c-search__button:focus, .tribe-events button.tribe-events-c-search__button:hover, .tribe-common .tribe-common-c-btn-border, .tribe-common a.tribe-common-c-btn-border, .tribe-common .tribe-common-c-btn, .tribe-common .tribe-common-c-btn:focus, .tribe-common .tribe-common-c-btn:hover, .tribe-common a.tribe-common-c-btn, .tribe-common a.tribe-common-c-btn:focus, .tribe-common a.tribe-common-c-btn:hover, .tribe-common button.tribe-common-c-btn, .tribe-common button.tribe-common-c-btn:focus, .tribe-common button.tribe-common-c-btn:hover',
                'property' => 'border-radius',
                'units'    => 'px',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 20,
        'js_vars'   => array(
            array(
                'element'  => 'input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .tribe-common .tribe-common-c-btn, .tribe-common a.tribe-common-c-btn, .tribe-common button.tribe-common-c-btn, .tribe-events .tribe-events-c-search__button:focus, .tribe-events .tribe-events-c-search__button:hover, .tribe-events button.tribe-events-c-search__button:focus, .tribe-events button.tribe-events-c-search__button:hover, .tribe-common .tribe-common-c-btn-border, .tribe-common a.tribe-common-c-btn-border, .tribe-common .tribe-common-c-btn, .tribe-common .tribe-common-c-btn:focus, .tribe-common .tribe-common-c-btn:hover, .tribe-common a.tribe-common-c-btn, .tribe-common a.tribe-common-c-btn:focus, .tribe-common a.tribe-common-c-btn:hover, .tribe-common button.tribe-common-c-btn, .tribe-common button.tribe-common-c-btn:focus, .tribe-common button.tribe-common-c-btn:hover',
                'function' => 'css',
                'property' => 'border-radius',
                'units'    => 'px',
            ),
        )
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_button_bg_color',
        'label'    => esc_html__('Button Background Color', 'grandconference' ),
        'section'  => 'general_input',
        'default'  => '#FF2D55',
        'output' => array(
	        array(
	            'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination span, .pagination a:hover, .woocommerce .footer_bar .button, .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .post_type_icon, .filter li a:hover, .filter li a.active, #portfolio_wall_filters li a.active,  #portfolio_wall_filters li a:hover, .comment_box, .one_half.gallery2 .portfolio_type_wrapper, .one_third.gallery3 .portfolio_type_wrapper, .one_fourth.gallery4 .portfolio_type_wrapper, .one_fifth.gallery5 .portfolio_type_wrapper, .portfolio_type_wrapper, .post_share_text, #close_share, .widget_tag_cloud div a:hover, .ui-accordion .ui-accordion-header .ui-icon, .mobile_menu_wrapper #mobile_menu_close.button, .clock_bg, .session_filters li a.active, .session_filters li a:hover, #toTop, .mobile_menu_wrapper #close_mobile_menu, .tribe-common .tribe-common-c-btn, .tribe-common a.tribe-common-c-btn, .tribe-common button.tribe-common-c-btn',
	            'property' => 'background-color',
	        ),
	        array(
	            'element'  => '.pagination span, .pagination a:hover, .button.ghost, .button.ghost:hover, .button.ghost:active, blockquote:after, .woocommerce-MyAccount-navigation ul li.is-active',
	            'property' => 'border-color',
	        ),
	        array(
	            'element'  => '.comment_box:before, .comment_box:after',
	            'property' => 'border-top-color',
	        ),
	        array(
	            'element'  => '.button.ghost, .button.ghost:hover, .button.ghost:active, .infinite_load_more, blockquote:before, .woocommerce-MyAccount-navigation ul li.is-active a',
	            'property' => 'color',
	        ),
	    ),
	    'js_vars'   => array(
			array(
				'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination span, .pagination a:hover, .woocommerce .footer_bar .button, .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .post_type_icon, .filter li a:hover, .filter li a.active, #portfolio_wall_filters li a.active,  #portfolio_wall_filters li a:hover, .comment_box, .one_half.gallery2 .portfolio_type_wrapper, .one_third.gallery3 .portfolio_type_wrapper, .one_fourth.gallery4 .portfolio_type_wrapper, .one_fifth.gallery5 .portfolio_type_wrapper, .portfolio_type_wrapper, .post_share_text, #close_share, .widget_tag_cloud div a:hover, .ui-accordion .ui-accordion-header .ui-icon, .mobile_menu_wrapper #mobile_menu_close.button, .clock_bg, .session_filters li a.active, .session_filters li a:hover, #toTop, .mobile_menu_wrapper #close_mobile_menu',
				'function' => 'css',
				'property' => 'background-color',
			),
			array(
				'element'  => '.pagination span, .pagination a:hover, .button.ghost, .button.ghost:hover, .button.ghost:active, blockquote:after, .woocommerce-MyAccount-navigation ul li.is-active',
				'function' => 'css',
				'property' => 'border-color',
			),
			array(
				'element'  => '.comment_box:before, .comment_box:after',
				'function' => 'css',
				'property' => 'border-top-color',
			),
			array(
				'element'  => '.button.ghost, .button.ghost:hover, .button.ghost:active, .infinite_load_more, blockquote:before, .woocommerce-MyAccount-navigation ul li.is-active a',
				'function' => 'css',
				'property' => 'color',
			),
		),
	    'transport' 	 => 'postMessage',
	    'priority' => 20,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_button_font_color',
        'label'    => esc_html__('Button Font Color', 'grandconference' ),
        'section'  => 'general_input',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce .footer_bar .button , .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .post_type_icon, .filter li a:hover, .filter li a.active, #portfolio_wall_filters li a.active,  #portfolio_wall_filters li a:hover, .comment_box, .one_half.gallery2 .portfolio_type_wrapper, .one_third.gallery3 .portfolio_type_wrapper, .one_fourth.gallery4 .portfolio_type_wrapper, .one_fifth.gallery5 .portfolio_type_wrapper, .portfolio_type_wrapper, .post_share_text, #close_share, .widget_tag_cloud div a:hover, .ui-accordion .ui-accordion-header .ui-icon, .mobile_menu_wrapper #mobile_menu_close.button, #toTop',
	            'property' => 'color',
	        ),
	    ),
	    'js_vars'   => array(
			array(
				'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination span, .pagination a:hover, .woocommerce .footer_bar .button, .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .post_type_icon, .filter li a:hover, .filter li a.active, #portfolio_wall_filters li a.active,  #portfolio_wall_filters li a:hover, .comment_box, .one_half.gallery2 .portfolio_type_wrapper, .one_third.gallery3 .portfolio_type_wrapper, .one_fourth.gallery4 .portfolio_type_wrapper, .one_fifth.gallery5 .portfolio_type_wrapper, .portfolio_type_wrapper, .post_share_text, #close_share, .widget_tag_cloud div a:hover, .ui-accordion .ui-accordion-header .ui-icon, .mobile_menu_wrapper #mobile_menu_close.button, #toTop',
				'function' => 'css',
				'property' => 'color',
			),
		),
	    'transport' 	 => 'postMessage',
	    'priority' => 21,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_button_border_color',
        'label'    => esc_html__('Button Border Color', 'grandconference' ),
        'section'  => 'general_input',
        'default'  => '#FF2D55',
        'output' => array(
	        array(
	            'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce .footer_bar .button , .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .infinite_load_more, .post_share_text, #close_share, .widget_tag_cloud div a:hover, .mobile_menu_wrapper #close_mobile_menu, .mobile_menu_wrapper #mobile_menu_close.button',
	            'property' => 'border-color',
	        ),
	    ),
	    'js_vars'   => array(
			array(
				'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination span, .pagination a:hover, .woocommerce .footer_bar .button, .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .post_type_icon, .filter li a:hover, .filter li a.active, #portfolio_wall_filters li a.active,  #portfolio_wall_filters li a:hover, .comment_box, .one_half.gallery2 .portfolio_type_wrapper, .one_third.gallery3 .portfolio_type_wrapper, .one_fourth.gallery4 .portfolio_type_wrapper, .one_fifth.gallery5 .portfolio_type_wrapper, .portfolio_type_wrappe, .post_share_text, #close_share, .widget_tag_cloud div a:hover, .mobile_menu_wrapper #close_mobile_menu, .header_cart_wrapper > a, .ui-accordion .ui-accordion-header .ui-icon, .mobile_menu_wrapper #mobile_menu_close.button',
				'function' => 'css',
				'property' => 'border-color',
			),
		),
	    'transport' 	 => 'postMessage',
	    'priority' => 22,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_frame',
        'label'    => esc_html__('Enable Frame', 'grandconference' ),
        'description' => esc_html__('Check this to enable frame for site layout', 'grandconference' ),
        'section'  => 'general_frame',
        'default'  => 0,
	    'priority' => 26,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_frame_color',
        'label'    => esc_html__('Frame Color', 'grandconference' ),
        'section'  => 'general_frame',
        'default'  => '#FF2D55',
        'output' => array(
	        array(
	            'element'  => '.frame_top, .frame_bottom, .frame_left, .frame_right',
	            'property' => 'background',
	        ),
	    ),
	    'transport'  => 'postMessage',
	    'priority' => 27,
	    'js_vars'   => array(
			array(
				'element'  => '.frame_top, .frame_bottom, .frame_left, .frame_right',
				'function' => 'css',
				'property' => 'background',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_boxed',
        'label'    => esc_html__('Enable Boxed Layout', 'grandconference' ),
        'description' => esc_html__('Check this to enable boxed layout for site layout', 'grandconference' ),
        'section'  => 'general_boxed',
        'default'  => 0,
	    'priority' => 28,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_boxed_bg_color',
        'label'    => esc_html__('Background Color', 'grandconference' ),
        'section'  => 'general_boxed',
        'default'  => '#f0f0f0',
        'output' => array(
	        array(
	            'element'  => 'body.tg_boxed',
	            'property' => 'background-color',
	        ),
	    ),
	    'js_vars'   => array(
			array(
				'element'  => 'body.tg_boxed',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	    'transport' 	 => 'postMessage',
	    'priority' => 28,
    );
    $controls[] = array(
        'type'     => 'image',
        'settings'  => 'tg_boxed_bg_image',
        'label'    => esc_html__('Background Image', 'grandconference' ),
        'description' => esc_html__('Upload background image for boxed layout', 'grandconference' ),
        'section'  => 'general_boxed',
	    'default'  => '',
	    'priority' => 28,
    );
    //End General Tab Settings

	//Register Menu Tab Settings
	$controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_header_content_title',
        'label'    => esc_html__('Header Content Settings', 'grandconference' ),
        'section'  => 'menu_general',
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_fixed_menu',
        'label'    => esc_html__('Enable Sticky Menu', 'grandconference' ),
        'description' => esc_html__('Enable this option to display main menu fixed when scrolling', 'grandconference' ),
        'section'  => 'menu_general',
        'default'  => 1,
        'priority' => 1,
    );
    
    /*$controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_smart_fixed_menu',
        'label'    => esc_html__('Enable Smart Sticky Menu', 'grandconference' ),
        'description' => esc_html__('Enable this option to make menu displays when scroll down and hide when scroll up', 'grandconference' ),
        'section'  => 'menu_general',
        'default'  => 1,
        'priority' => 1,
    );*/
    
    $controls[] = array(
        'type'     => 'radio',
        'settings'  => 'tg_header_content',
        'label'    => esc_html__('Display Header Content From', 'grandconference' ),
        'description' => esc_html__('Select how theme get main header & navigation content', 'grandconference' ),
        'section'  => 'menu_general',
        'default'  => 'menu',
        'choices'  => $tg_header_content,
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_default_header_content_title',
        'label'    => esc_html__('Default Header Content Settings', 'grandconference' ),
        'section'  => 'menu_general',
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_header_content_default',
        'label'    => esc_html__('Default Header Content', 'grandconference' ),
        'description' => esc_html__('Select default header content for general pages & posts', 'grandconference' ),
        'section'  => 'menu_general',
        'default'  => '',
        'choices'  => $tg_headers_select,
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_sticky_header_content_default',
        'label'    => esc_html__('Default Sticky Header Content', 'grandconference' ),
        'description' => esc_html__('Select default sticky header content for general pages & posts', 'grandconference' ),
        'section'  => 'menu_general',
        'default'  => '',
        'choices'  => $tg_headers_select,
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_transparent_header_content_default',
        'label'    => esc_html__('Default Transparent Header Content', 'grandconference' ),
        'description' => esc_html__('Select default transparent header content for general pages & posts', 'grandconference' ),
        'section'  => 'menu_general',
        'default'  => '',
        'choices'  => $tg_headers_select,
        'priority' => 1,
    );
    
	$controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_menu_title',
        'label'    => esc_html__('General Menu Settings', 'grandconference' ),
        'section'  => 'menu_general',
	    'priority' => 1,
    );
	
    $controls[] = array(
        'type'     => 'radio',
        'settings'  => 'tg_menu_layout',
        'label'    => esc_html__('Menu Layout', 'grandconference' ),
        'section'  => 'menu_general',
        'default'  => 'leftalign',
        'choices'  => $tg_menu_layout,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_menu_shadow',
        'label'    => esc_html__('Enable Menu Shadow', 'grandconference' ),
        'description' => esc_html__('Enable this option to make menu displays its shadow', 'grandconference' ),
        'section'  => 'menu_general',
        'default'  => 1,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_menu_button_title',
        'label'    => esc_html__('Button Settings', 'grandconference' ),
        'section'  => 'menu_general',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'tg_menu_button_ticket_url',
        'label'    => esc_html__('Get Tickets Link URL (Optional)', 'grandconference' ),
        'description' => esc_html__('Enter URL of buy ticket page so get tickets button display next to main menu items', 'grandconference' ),
        'section'  => 'menu_general',
        'default'  => '#',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_menu_typography',
        'label'    => esc_html__('Menu Font Typography', 'grandconference' ),
        'section'  => 'menu_typography',
        'default'  => array(
            'font-family'    => 'Poppins',
            'variant'        => '500',
            'font-size'      => '13px',
            'line-height'    => '1.6',
            'letter-spacing' => '0px',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_menu_padding',
        'label'    => esc_html__('Menu Padding', 'grandconference' ),
        'section'  => 'menu_typography',
        'default'  => 26,
        'choices' => array( 'min' => 0, 'max' => 150, 'step' => 1 ),
        'output' => array(
            array(
                'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, html[data-menu=centeralogo] #logo_right_button',
                'property' => 'padding-top',
                'units'    => 'px',
            ),
            array(
                'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, html[data-menu=centeralogo] #logo_right_button',
                'property' => 'padding-bottom',
                'units'    => 'px',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 4,
        'js_vars'   => array(
            array(
                'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, html[data-menu=centeralogo] #logo_right_button',
                'function' => 'css',
                'property' => 'padding-top',
                'units'    => 'px',
            ),
            array(
                'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, html[data-menu=centeralogo] #logo_right_button',
                'function' => 'css',
                'property' => 'padding-bottom',
                'units'    => 'px',
            ),
        )
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_bg',
        'label'    => esc_html__('Menu Background', 'grandconference' ),
        'section'  => 'menu_color',
	    'default'     => '#ffffff',
	    'output' => array(
	        array(
	            'element'  => '.top_bar',
	            'property' => 'background-color',
	        ),
	    ),
	    'priority' => 4,
	    'transport' 	 => 'postMessage',
	    'js_vars'   => array(
			array(
				'element'  => '.top_bar',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_font_color',
        'label'    => esc_html__('Menu Font Color', 'grandconference' ),
        'section'  => 'menu_color',
        'default'  => '#000000',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, #mobile_nav_icon, #logo_wrapper .social_wrapper ul li a',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '#mobile_nav_icon',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 5,
	    'js_vars'   => array(
			array(
				'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, #mobile_nav_icon, #logo_wrapper .social_wrapper ul li a',
				'function' => 'css',
				'property' => 'color',
			),
			array(
				'element'  => '#mobile_nav_icon',
				'function' => 'css',
				'property' => 'border-color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_hover_font_color',
        'label'    => esc_html__('Menu Hover State Font Color', 'grandconference' ),
        'section'  => 'menu_color',
        'default'  => '#FF2D55',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover, .header_cart_wrapper a:hover, #page_share:hover, #logo_wrapper .social_wrapper ul li a:hover',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 6,
	    'js_vars'   => array(
			array(
				'element'  => '#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover, .header_cart_wrapper a:hover, #page_share:hover, #logo_wrapper .social_wrapper ul li a:hover',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_active_font_color',
        'label'    => esc_html__('Menu Active State Font Color', 'grandconference' ),
        'section'  => 'menu_color',
        'default'  => '#FF2D55',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent  ul li.current-menu-item a, #logo_wrapper .social_wrapper ul li a:active',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 7,
	    'js_vars'   => array(
			array(
				'element'  => '#menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent  ul li.current-menu-item a, #logo_wrapper .social_wrapper ul li a:active',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_border_color',
        'label'    => esc_html__('Menu Bar Border Color', 'grandconference' ),
        'section'  => 'menu_color',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '.top_bar, #page_caption, #nav_wrapper',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 7,
	    'js_vars'   => array(
			array(
				'element'  => '.top_bar, #page_caption, #nav_wrapper',
				'function' => 'css',
				'property' => 'border-color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_submenu_font_title',
        'label'    => esc_html__('Typography Settings', 'grandconference' ),
        'section'  => 'menu_submenu',
	    'priority' => 9,
    ); 
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_submenu_typography',
        'label'    => esc_html__('Sub Menu Typography', 'grandconference' ),
        'section'  => 'menu_submenu',
        'default'  => array(
            'font-family'    => 'Poppins',
            'variant'        => '500',
            'font-size'      => '13px',
            'letter-spacing' => '0px',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => '#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a',
            ),
        ),
        'priority' => 12,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_submenu_color_title',
        'label'    => esc_html__('Color Settings', 'grandconference' ),
        'section'  => 'menu_submenu',
	    'priority' => 12,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_submenu_font_color',
        'label'    => esc_html__('Sub Menu Font Color', 'grandconference' ),
        'section'  => 'menu_submenu',
        'default'  => '#000000',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li.current-menu-parent ul li.current-menu-item a, #menu_wrapper .nav ul li.megamenu ul li ul li a, #menu_wrapper div .nav li.megamenu ul li ul li a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
	    'js_vars'   => array(
			array(
				'element'  => '#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li.current-menu-parent ul li.current-menu-item a, #menu_wrapper .nav ul li.megamenu ul li ul li a, #menu_wrapper div .nav li.megamenu ul li ul li a',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_submenu_hover_font_color',
        'label'    => esc_html__('Sub Menu Hover State Font Color', 'grandconference' ),
        'section'  => 'menu_submenu',
        'default'  => '#FF2D55',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:hover, #menu_wrapper div .nav li.megamenu ul li ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.current-menu-parent ul li.current-menu-item  a:hover',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 14,
	    'js_vars'   => array(
			array(
				'element'  => '#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:hover, #menu_wrapper div .nav li.megamenu ul li ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.current-menu-parent ul li.current-menu-item  a:hover',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_submenu_hover_bg_color',
        'label'    => esc_html__('Sub Menu Hover State Background Color', 'grandconference' ),
        'section'  => 'menu_submenu',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:hover, #menu_wrapper div .nav li.megamenu ul li ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li ul li a:active',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 15,
	    'js_vars'   => array(
			array(
				'element'  => '#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:hover, #menu_wrapper div .nav li.megamenu ul li ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li ul li a:active',
				'function' => 'css',
				'property' => 'background',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_submenu_bg_color',
        'label'    => esc_html__('Sub Menu Background Color', 'grandconference' ),
        'section'  => 'menu_submenu',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 16,
	    'js_vars'   => array(
			array(
				'element'  => '#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul',
				'function' => 'css',
				'property' => 'background',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_submenu_border_color',
        'label'    => esc_html__('Sub Menu Border Color', 'grandconference' ),
        'section'  => 'menu_submenu',
        'default'  => '#dce0e0',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 17,
	    'js_vars'   => array(
			array(
				'element'  => '#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul',
				'function' => 'css',
				'property' => 'border-color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_megamenu_header_color',
        'label'    => esc_html__('Mega Menu Header Font Color', 'grandconference' ),
        'section'  => 'menu_megamenu',
        'default'  => '#000000',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper div .nav li.megamenu ul li > a, #menu_wrapper div .nav li.megamenu ul li > a:hover, #menu_wrapper div .nav li.megamenu ul li > a:active, #menu_wrapper div .nav li.megamenu ul li.current-menu-item > a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 18,
	    'js_vars'   => array(
			array(
				'element'  => '#menu_wrapper div .nav li.megamenu ul li > a, #menu_wrapper div .nav li.megamenu ul li > a:hover, #menu_wrapper div .nav li.megamenu ul li > a:active, #menu_wrapper div .nav li.megamenu ul li.current-menu-item > a',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_megamenu_border_color',
        'label'    => esc_html__('Mega Menu Border Color', 'grandconference' ),
        'section'  => 'menu_megamenu',
        'default'  => '#dce0e0',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper div .nav li.megamenu ul li',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 20,
	    'js_vars'   => array(
			array(
				'element'  => '#menu_wrapper div .nav li.megamenu ul li',
				'function' => 'css',
				'property' => 'border-color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_topbar',
        'label'    => esc_html__('Display Top Bar', 'grandconference' ),
        'description' => esc_html__('Enable this option to display top bar above main menu', 'grandconference' ),
        'section'  => 'menu_topbar',
        'default'  => 0,
	    'priority' => 21,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_topbar_bg_color',
        'label'    => esc_html__('Top Bar Background Color', 'grandconference' ),
        'section'  => 'menu_topbar',
        'default'  => '#000000',
        'output' => array(
	        array(
	            'element'  => '.above_top_bar',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 22,
	    'js_vars'   => array(
			array(
				'element'  => '.above_top_bar',
				'function' => 'css',
				'property' => 'background',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_topbar_font_color',
        'label'    => esc_html__('Top Bar Menu Font Color', 'grandconference' ),
        'section'  => 'menu_topbar',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '#top_menu li a, .top_contact_info, .top_contact_info i, .top_contact_info a, .top_contact_info a:hover, .top_contact_info a:active',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 23,
	    'js_vars'   => array(
			array(
				'element'  => '#top_menu li a, .top_contact_info, .top_contact_info i, .top_contact_info a, .top_contact_info a:hover, .top_contact_info a:active',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'tg_menu_contact_hours',
        'label'    => esc_html__('Contact Hours (Optional)', 'grandconference' ),
        'description' => esc_html__('Enter your company contact hours.', 'grandconference' ),
        'section'  => 'menu_contact',
        'default'  => 'Mon-Fri 09.00 - 17.00',
        'transport' 	 => 'postMessage',
	    'priority' => 26,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'tg_menu_contact_number',
        'label'    => esc_html__('Contact Phone Number (Optional)', 'grandconference' ),
        'description' => esc_html__('Enter your company contact phone number.', 'grandconference' ),
        'section'  => 'menu_contact',
        'default'  => '1.800.456.6743',
        'transport' => 'postMessage',
	    'priority' => 27,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_topbar_social_link',
        'label'    => esc_html__('Open Top Bar Social Icons link in new window', 'grandconference' ),
        'description' => esc_html__('Check this to open top bar social icons link in new window', 'grandconference' ),
        'section'  => 'menu_contact',
        'default'  => 1,
	    'priority' => 28,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_sidemenu_general_title',
        'label'    => esc_html__('General Settings', 'grandconference' ),
        'section'  => 'menu_sidemenu',
	    'priority' => 31,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_sidemenu',
        'label'    => esc_html__('Enable Side Menu on Desktop', 'grandconference' ),
        'description' => 'Check this option to enable side menu on desktop',
        'section'  => 'menu_sidemenu',
        'default'  => 1,
	    'priority' => 31,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_sidemenu_width',
        'label'    => esc_html__('Side Menu Width', 'grandconference' ),
        'section'  => 'menu_sidemenu',
        'default'  => 360,
        'choices' => array( 'min' => 100, 'max' => 600, 'step' => 10 ),
        'output' => array(
	        array(
	            'element'  => '.mobile_menu_wrapper',
	            'property' => 'width',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 31,
	    'js_vars'   => array(
			array(
				'element'  => '.mobile_menu_wrapper',
				'function' => 'css',
				'property' => 'width',
				'units'    => 'px',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_sidemenu_align',
        'label'    => esc_html__('Side Menu Alignment', 'grandconference' ),
        'section'  => 'menu_sidemenu',
        'default'  => 'right',
        'choices'  => $tg_sidemenu_align,
	    'priority' => 31,
    );
    
    $controls[] = array(
        'type'     => 'radio-buttonset',
        'settings'  => 'tg_sidemenu_overlay_effect',
        'label'    => esc_html__('Side Menu Overlay Effect', 'grandconference' ),
        'section'  => 'menu_sidemenu',
        'default'  => 'blur',
        'choices'  => $tg_sidemenu_overlay_effect,
	    'priority' => 31,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_sidemenu_font_title',
        'label'    => esc_html__('Typography Settings', 'grandconference' ),
        'section'  => 'menu_sidemenu',
	    'priority' => 31,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_sidemenu_typography',
        'label'    => esc_html__('Side Menu Typography', 'grandconference' ),
        'section'  => 'menu_sidemenu',
        'default'  => array(
            'font-family'    => 'Poppins',
            'variant'        => '700',
            'font-size'      => '24px',
            'line-height'    => '2',
            'letter-spacing' => '0px',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => '.mobile_main_nav li a, #sub_menu li a',
            ),
        ),
        'priority' => 35
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_sidemenu_text_align',
        'label'    => esc_html__('Side Menu Text Alignment', 'grandconference' ),
        'section'  => 'menu_sidemenu',
        'default'  => 'left',
        'choices'  => $tg_sidemenu_text_align,
	    'priority' => 35,
	    'output' => array(
	        array(
	            'element'  => '.mobile_menu_wrapper, .mobile_menu_wrapper h2.widgettitle, .mobile_menu_wrapper .sidebar_widget',
	            'property' => 'text-align',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 35,
	    'js_vars'   => array(
			array(
				'element'  => '.mobile_menu_wrapper, .mobile_menu_wrapper h2.widgettitle, .mobile_menu_wrapper .sidebar_widget',
				'function' => 'css',
				'property' => 'text-align',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_sidemenu_bg_title',
        'label'    => esc_html__('Color Settings', 'grandconference' ),
        'section'  => 'menu_sidemenu',
	    'priority' => 36,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidemenu_bg',
        'label'    => esc_html__('Side Menu Background', 'grandconference' ),
        'section'  => 'menu_sidemenu',
	    'default'  => '#ffffff',
	    'output' => array(
	        array(
	            'element'  => '.mobile_menu_wrapper',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'js_vars'   => array(
			array(
	            'element'  => '.mobile_menu_wrapper',
	            'property' => 'background-color',
	        ),
		),
	    'priority' => 36,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_sidemenu_bg_opacity',
        'label'    => esc_html__('Side Menu Background Opacity', 'grandconference' ),
        'section'  => 'menu_sidemenu',
        'default'  => 85,
        'choices' => array( 'min' => 0, 'max' => 100, 'step' => 5 ),
	    'priority' => 37,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidemenu_font_color',
        'label'    => esc_html__('Side Menu Font Color', 'grandconference' ),
        'section'  => 'menu_sidemenu',
        'default'  => '#000000',
        'output' => array(
	        array(
	            'element'  => '.mobile_main_nav li a, #sub_menu li a, .mobile_menu_wrapper .sidebar_wrapper a, .mobile_menu_wrapper .sidebar_wrapper, #close_mobile_menu i, .mobile_menu_wrapper .social_wrapper ul li a, html[data-menu=hammenufull] #copyright',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 37,
	    'js_vars'   => array(
			array(
				'element'  => '.mobile_main_nav li a, #sub_menu li a, .mobile_menu_wrapper .sidebar_wrapper a, .mobile_menu_wrapper .sidebar_wrapper, #close_mobile_menu i, .mobile_menu_wrapper .social_wrapper ul li a, html[data-menu=hammenufull] #copyright',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidemenu_font_hover_color',
        'label'    => esc_html__('Side Menu Hover State Font Color', 'grandconference' ),
        'section'  => 'menu_sidemenu',
        'default'  => '#FF2D55',
        'output' => array(
	        array(
	            'element'  => '.mobile_main_nav li a:hover, .mobile_main_nav li a:active, #sub_menu li a:hover, #sub_menu li a:active, .mobile_menu_wrapper .sidebar_wrapper h2.widgettitle, .mobile_menu_wrapper .social_wrapper ul li a:hover',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 38,
	    'js_vars'   => array(
			array(
				'element'  => '.mobile_main_nav li a:hover, .mobile_main_nav li a:active, #sub_menu li a:hover, #sub_menu li a:active, .mobile_menu_wrapper .sidebar_wrapper h2.widgettitle, .mobile_menu_wrapper .social_wrapper ul li a:hover',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_fullmenu_default',
        'label'    => esc_html__('Default Fullscreen Menu (Optional)', 'grandconference' ),
        'description' => esc_html__('Select default fullscreen menu for all pages', 'grandconference' ),
        'section'  => 'menu_fullmenu',
        'default'  => '',
        'choices'  => $tg_fullmenu_select,
        'priority' => 38,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_menu_search_title',
        'label'    => esc_html__('Search Settings', 'grandconference' ),
        'section'  => 'menu_sidemenu',
	    'priority' => 39,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_menu_search',
        'label'    => esc_html__('Enable Search', 'grandconference' ),
        'description' => esc_html__('Select to display search form in header of side menu', 'grandconference' ),
        'section'  => 'menu_sidemenu',
        'default'  => 0,
	    'priority' => 40,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_search_input_color',
        'label'    => esc_html__('Search Input Background Color', 'grandconference' ),
        'section'  => 'menu_sidemenu',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '.mobile_menu_wrapper #searchform input[type=text]',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 42,
	    'js_vars'   => array(
			array(
				'element'  => '.mobile_menu_wrapper #searchform input[type=text]',
				'function' => 'css',
				'property' => 'background',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_search_font_color',
        'label'    => esc_html__('Search Input Font Color', 'grandconference' ),
        'section'  => 'menu_sidemenu',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '.mobile_menu_wrapper #searchform input[type=text], .mobile_menu_wrapper #searchform button i',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '.mobile_menu_wrapper #searchform ::-webkit-input-placeholder',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '.mobile_menu_wrapper #searchform ::-moz-placeholder',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '.mobile_menu_wrapper #searchform :-ms-input-placeholder',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 43,
	    'js_vars'   => array(
			array(
				'element'  => '.mobile_menu_wrapper #searchform input[type=text], .mobile_menu_wrapper #searchform button i',
				'function' => 'css',
				'property' => 'color',
			),
			array(
				'element'  => '.mobile_menu_wrapper #searchform ::-webkit-input-placeholder',
				'function' => 'css',
				'property' => 'color',
			),
			array(
				'element'  => '.mobile_menu_wrapper #searchform ::-moz-placeholder',
				'function' => 'css',
				'property' => 'color',
			),
			array(
				'element'  => '.mobile_menu_wrapper #searchform :-ms-input-placeholder',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    //End Menu Tab Settings
    
    //Register Header Tab Settings
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_page_header_bg_title',
        'label'    => esc_html__('Background Image Settings', 'grandconference' ),
        'section'  => 'header_background',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_page_title_bg_height',
        'label'    => esc_html__('Page Title Background Image Height (in pixels)', 'grandconference' ),
        'section'  => 'header_background',
        'default'  => 550,
        'choices' => array( 'min' => 150, 'max' => 1500, 'step' => 10 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption.hasbg',
	            'property' => 'height',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 1,
	    'js_vars'   => array(
			array(
				'element'  => '#page_caption.hasbg',
				'function' => 'css',
				'property' => 'height',
				'units'    => 'px',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_page_header_bg_parallax',
        'label'    => esc_html__('Add Parallax Effect When Scroll', 'grandconference' ),
        'description' => esc_html__('Enable this option to add parallax effect to header background image when scrolling pass it', 'grandconference' ),
        'section'  => 'header_background',
        'default'  => '1',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_page_header_bgcolor_title',
        'label'    => esc_html__('Background Color Settings', 'grandconference' ),
        'section'  => 'header_background',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_page_header_bg_color',
        'label'    => esc_html__('Page Header Background Color', 'grandconference' ),
        'section'  => 'header_background',
        'default'  => '#f9f9f9',
        'output' => array(
	        array(
	            'element'  => '#page_caption',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 2,
	    'js_vars'   => array(
			array(
				'element'  => '#page_caption',
				'function' => 'css',
				'property' => 'background-color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_page_header_padding_top',
        'label'    => esc_html__('Page Header Padding Top', 'grandconference' ),
        'section'  => 'header_title',
        'default'  => 80,
        'choices' => array( 'min' => 0, 'max' => 200, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption, .tribe-common--breakpoint-medium.tribe-events .tribe-events-l-container',
	            'property' => 'padding-top',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 3,
	    'js_vars'   => array(
			array(
				'element'  => '#page_caption, .tribe-common--breakpoint-medium.tribe-events .tribe-events-l-container',
				'function' => 'css',
				'property' => 'padding-top',
				'units'    => 'px',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_page_header_padding_bottom',
        'label'    => esc_html__('Page Header Padding Bottom', 'grandconference' ),
        'section'  => 'header_title',
        'default'  => 80,
        'choices' => array( 'min' => 0, 'max' => 200, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption, .tribe-common--breakpoint-medium.tribe-events .tribe-events-l-container',
	            'property' => 'padding-bottom',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 4,
	    'js_vars'   => array(
			array(
				'element'  => '#page_caption, .tribe-common--breakpoint-medium.tribe-events .tribe-events-l-container',
				'function' => 'css',
				'property' => 'padding-bottom',
				'units'    => 'px',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_page_title_typography',
        'label'    => esc_html__('Page Title Typography', 'grandconference' ),
        'section'  => 'header_title',
        'default'  => array(
            'font-family'    => 'Poppins',
            'variant'        => '700',
            'font-size'      => '70px',
            'line-height'    => '1',
            'letter-spacing' => '0px',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => '#page_caption h1, .post_caption h1, .tribe-events-single-event-title',
            ),
        ),
        'priority' => 8
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_page_title_alignment',
        'label'    => esc_html__('Page Title Text Alignment', 'grandconference' ),
        'section'  => 'header_title',
        'default'  => 'left',
        'choices'  => $tg_text_alignment,
        'output' => array(
	        array(
	            'element'  => '#page_caption h1, .ppb_title, .post_caption h1, .page_tagline',
	            'property' => 'text-align',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 8,
	    'js_vars'   => array(
			array(
				'element'  => '#page_caption h1, .ppb_title, .post_caption h1, .page_tagline',
				'function' => 'css',
				'property' => 'text-align',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'radio-buttonset',
        'settings'  => 'tg_page_title_vertical_alignment',
        'label'    => esc_html__('Page Title Text Vertical Alignment', 'grandconference' ),
        'section'  => 'header_title',
        'default'  => 'baseline',
        'choices'  => $tg_text_vertical_alignment
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_page_title_font_color',
        'label'    => esc_html__('Page Title Font Color', 'grandconference' ),
        'section'  => 'header_title',
        'default'  => '#FF2D55',
        'output' => array(
	        array(
	            'element'  => '#page_caption h1, .ppb_title, .post_caption h1, .ppb_speaker_grid .speaker_info_wrapper h3, .ppb_speaker_grid .speaker_info_wrapper h4, .ppb_speaker_classic .speaker_info_wrapper h3, .ppb_speaker_classic .speaker_info_wrapper h4',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
	    'js_vars'   => array(
			array(
				'element'  => '#page_caption h1, .ppb_title, .post_caption h1, .ppb_speaker_grid .speaker_info_wrapper h3, .ppb_speaker_grid .speaker_info_wrapper h4, .ppb_speaker_classic .speaker_info_wrapper h3, .ppb_speaker_classic .speaker_info_wrapper h4',
				'function' => 'css',
				'property' => 'color',
			),
		),
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_header_builder_typography',
        'label'    => esc_html__('Content Builder Header Typography', 'grandconference' ),
        'section'  => 'header_title',
        'default'  => array(
            'font-family'    => 'Poppins',
            'variant'        => '700',
            'font-size'      => '36px',
            'line-height'    => '1.2',
            'letter-spacing' => '0px',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => 'h2.ppb_title',
            ),
        ),
        'priority' => 9
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_page_tagline_font_color',
        'label'    => esc_html__('Page Tagline Font Color', 'grandconference' ),
        'section'  => 'header_tagline',
        'default'  => '#000000',
        'output' => array(
	        array(
	            'element'  => '.page_tagline, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company, .post_detail.single_post, #gallery_caption .tg_caption .tg_desc',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
	    'js_vars'   => array(
			array(
				'element'  => '.page_tagline, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company, .post_detail.single_post, #gallery_caption .tg_caption .tg_desc',
				'function' => 'css',
				'property' => 'color',
			),
		),
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_page_tagline_typography',
        'label'    => esc_html__('Page Tagline Typography', 'grandconference' ),
        'section'  => 'header_tagline',
        'default'  => array(
            'font-family'    => 'Work Sans',
            'variant'        => '400',
            'font-size'      => '15px',
            'line-height'    => '1.7',
            'letter-spacing' => '0px',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => '.page_tagline, .post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company, .tribe-events-schedule h2',
            ),
        ),
        'priority' => 13
    );
    //End Header Tab Settings
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_sidebar_sticky',
        'label'    => esc_html__('Enable Sticky Sidebar', 'grandconference' ),
        'description' => esc_html__('Check this to displays sidebar fixed when scrolling.', 'grandconference' ),
        'section'  => 'sidebar_general',
        'default'  => 1,
	    'priority' => 11,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_sidebar_title_typography',
        'label'    => esc_html__('Widget Title Typography', 'grandconference' ),
        'section'  => 'sidebar_typography',
        'default'  => array(
            'font-family'    => 'Poppins',
            'variant'        => '700',
            'font-size'      => '18px',
            'line-height'    => '1.7',
            'letter-spacing' => '0px',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => '#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle',
            ),
        ),
        'priority' => 5
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_sidebar_title_border_width',
        'label'    => esc_html__('Widget Title Border Width', 'grandconference' ),
        'section'  => 'sidebar_typography',
        'default'  => 1,
        'choices' => array( 'min' => 0, 'max' => 4, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle',
	            'property' => 'border-width',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 6,
	    'js_vars'   => array(
			array(
				'element'  => '#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle',
				'function' => 'css',
				'property' => 'border-width',
				'units'    => 'px',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidebar_font_color',
        'label'    => esc_html__('Sidebar Font Color', 'grandconference' ),
        'section'  => 'sidebar_color',
        'default'  => '#555555',
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .inner .sidebar_wrapper .sidebar .content, .page_content_wrapper .inner .sidebar_wrapper .sidebar .content',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 6,
	    'js_vars'   => array(
			array(
				'element'  => '#page_content_wrapper .inner .sidebar_wrapper .sidebar .content, .page_content_wrapper .inner .sidebar_wrapper .sidebar .content',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidebar_link_color',
        'label'    => esc_html__('Sidebar Link Color', 'grandconference' ),
        'section'  => 'sidebar_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .inner .sidebar_wrapper:not(.session-content) a:not(.button), .page_content_wrapper .inner .sidebar_wrapper:not(.session-content) a:not(.button)',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 7,
	    'js_vars'   => array(
			array(
				'element'  => '#page_content_wrapper .inner .sidebar_wrapper:not(.session-content) a:not(.button), .page_content_wrapper .inner .sidebar_wrapper:not(.session-content) a:not(.button)',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidebar_hover_link_color',
        'label'    => esc_html__('Sidebar Hover Link Color', 'grandconference' ),
        'section'  => 'sidebar_color',
        'default'  => '#FF2D55',
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .inner .sidebar_wrapper:not(.session-content) a:hover:not(.button), #page_content_wrapper .inner .sidebar_wrapper:not(.session-content) a:active:not(.button), .page_content_wrapper .inner .sidebar_wrapper:not(.session-content) a:hover:not(.button), .page_content_wrapper .inner .sidebar_wrapper:not(.session-content) a:active:not(.button)',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 8,
	    'js_vars'   => array(
			array(
				'element'  => '#page_content_wrapper .inner .sidebar_wrapper:not(.session-content) a:hover:not(.button), #page_content_wrapper .inner .sidebar_wrapper:not(.session-content) a:active:not(.button), .page_content_wrapper .inner .sidebar_wrapper:not(.session-content) a:hover:not(.button), .page_content_wrapper .inner .sidebar_wrapper:not(.session-content) a:active:not(.button)',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidebar_title_color',
        'label'    => esc_html__('Sidebar Widget Title Font Color', 'grandconference' ),
        'section'  => 'sidebar_color',
        'default'  => '#000000',
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
	    'js_vars'   => array(
			array(
				'element'  => '#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle',
				'function' => 'css',
				'property' => 'color',
			),
		)
    );
    //End Sidebar Tab Settings
    
    //Register Footer Tab Settings
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_footer_content_title',
        'label'    => esc_html__('Footer Content Settings', 'grandconference' ),
        'section'  => 'footer_general',
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'radio',
        'settings'  => 'tg_footer_content',
        'label'    => esc_html__('Display Footer Content From', 'grandconference' ),
        'description' => esc_html__('Select how theme get main footer content', 'grandconference' ),
        'section'  => 'footer_general',
        'default'  => 'hide',
        'choices'  => $tg_footer_content,
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_footer_content_default',
        'label'    => esc_html__('Default Footer Content', 'grandconference' ),
        'description' => esc_html__('Select default footer content for general pages & posts', 'grandconference' ),
        'section'  => 'footer_general',
        'default'  => '',
        'choices'  => $tg_footers_select,
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_footer_sidebar_title',
        'label'    => esc_html__('Footer Sidebar Settings', 'grandconference' ),
        'section'  => 'footer_general',
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'radio',
        'settings'  => 'tg_footer_sidebar',
        'label'    => esc_html__('Footer Sidebar Columns', 'grandconference' ),
        'section'  => 'footer_general',
        'default'  => '3',
        'choices'  => $tg_copyright_column,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_footer_social_link',
        'label'    => esc_html__('Open Footer Social Icons link in new window', 'grandconference' ),
        'description' => esc_html__('Check this to open footer social icons link in new window', 'grandconference' ),
        'section'  => 'footer_general',
        'default'  => 1,
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_bg',
        'label'    => esc_html__('Footer Background', 'grandconference' ),
        'section'  => 'footer_color',
	    'priority' => 1,
	    'default'  => '#000000',
	    'output' => array(
	        array(
	            'element'  => '.footer_bar, #footer',
	            'property' => 'background-color',
	        ),
	    ),
	    'js_vars'   => array(
			array(
				'element'  => '.footer_bar, #footer',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_font_color',
        'label'    => esc_html__('Footer Font Color', 'grandconference' ),
        'section'  => 'footer_color',
        'default'  => '#cccccc',
        'output' => array(
	        array(
	            'element'  => '#footer, #copyright, #footer_menu li a, #footer_menu li a:hover, #footer_menu li a:active',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 10,
	    'js_vars'   => array(
			array(
				'element'  => '#footer, #copyright, #footer_menu li a, #footer_menu li a:hover, #footer_menu li a:active',
				'function' => 'css',
				'property' => 'color',
			),
		),
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_link_color',
        'label'    => esc_html__('Footer Link Color', 'grandconference' ),
        'section'  => 'footer_color',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '#copyright a, #copyright a:active, #footer a:not(.button, .elementor-button), #footer a:active, #footer .sidebar_widget li h2.widgettitle',
	            'property' => 'color',
	        ),
	    ),
	    'js_vars'   => array(
			array(
				'element'  => '#copyright a, #copyright a:active, #footer a:not(.button, .elementor-button), #footer a:active, #footer .sidebar_widget li h2.widgettitle',
				'function' => 'css',
				'property' => 'color',
			),
		),
	    'transport' 	 => 'postMessage',
	    'priority' => 11,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_hover_link_color',
        'label'    => esc_html__('Footer Hover Link Color', 'grandconference' ),
        'section'  => 'footer_color',
        'default'  => '#FF2D55',
        'output' => array(
	        array(
	            'element'  => '#copyright a:hover, #footer a:not(.button):hover, .social_wrapper ul li a:hover',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 12,
	    'js_vars'   => array(
			array(
				'element'  => '#copyright a:hover, #footer a:not(.button):hover, .social_wrapper ul li a:hover',
				'function' => 'css',
				'property' => 'color',
			),
		),
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_border_color',
        'label'    => esc_html__('Footer Border Color', 'grandconference' ),
        'section'  => 'footer_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '.footer_bar_wrapper, .footer_bar',
	            'property' => 'border-color',
	        ),
	    ),
	    'js_vars'   => array(
			array(
				'element'  => '.footer_bar_wrapper, .footer_bar',
				'function' => 'css',
				'property' => 'border-color',
			),
		),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_social_color',
        'label'    => esc_html__('Footer Social Icon Color', 'grandconference' ),
        'section'  => 'footer_color',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '.footer_bar_wrapper .social_wrapper ul li a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
	    'js_vars'   => array(
			array(
				'element'  => '.footer_bar_wrapper .social_wrapper ul li a',
				'function' => 'css',
				'property' => 'color',
			),
		),
    );
    
    $controls[] = array(
        'type'     => 'textarea',
        'settings'  => 'tg_footer_copyright_text',
        'label'    => esc_html__('Copyright Text', 'grandconference' ),
        'description' => esc_html__('Enter your copyright text.', 'grandconference' ),
        'section'  => 'footer_copyright',
        'default'  => '© Copyright Grand Conference Theme Demo - Theme by ThemeGoods',
        'transport' 	 => 'postMessage',
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_footer_copyright_right_area',
        'label'    => esc_html__('Copyright Right Area Content', 'grandconference' ),
        'section'  => 'footer_copyright',
        'default'  => 'menu',
        'choices'  => $tg_copyright_content,
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_footer_copyright_totop',
        'label'    => esc_html__('Go To Top Button', 'grandconference' ),
        'description' => 'Check this option to enable go to top button at the bottom of page when scrolling',
        'section'  => 'footer_copyright',
        'default'  => 1,
	    'priority' => 7,
    );
    //End Footer Tab Settings
    
    
    //Begin Gallery Tab Settings
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_gallery_global_title',
        'label'    => esc_html__('Global Settings', 'grandconference' ),
        'section'  => 'gallery_general',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'radio',
        'settings'  => 'tg_gallery_sort',
        'label'    => esc_html__('Gallery Images Sorting', 'grandconference' ),
        'description' => 'Select gallery images sorting options',
        'section'  => 'gallery_general',
        'default'  => 'drag',
        'choices'  => $tg_gallery_sort,
	    'priority' => 1,
    );
            
    $controls[] = array(
        'type'     => 'radio-buttonset',
        'settings'  => 'tg_lightbox_skin',
        'label'    => esc_html__('Select lightbox skin color', 'grandconference' ),
        'description' => esc_html__('Select which skin you want to use for lightbox', 'grandconference' ),
        'section'  => 'gallery_lightbox',
        'default'  => 'metro-black',
        'choices'  => $tg_lightbox_skin,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_lightbox_enable_caption',
        'label'    => esc_html__('Display image caption in lightbox', 'grandconference' ),
        'description' => esc_html__('Check if you want to display image caption under the image in lightbox mode', 'grandconference' ),
        'section'  => 'gallery_lightbox',
        'default'  => 1,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'radio-buttonset',
        'settings'  => 'tg_lightbox_thumbnails',
        'label'    => esc_html__('Select lightbox thumbnails alignment', 'grandconference' ),
        'description' => esc_html__('Select which alignment you want to use for lightbox thumbnails', 'grandconference' ),
        'section'  => 'gallery_lightbox',
        'default'  => 'horizontal',
        'choices'  => $tg_lightbox_thumbnails,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_lightbox_opacity',
        'label'    => esc_html__('Lightbox Overlay Opacity', 'grandconference' ),
        'section'  => 'gallery_lightbox',
        'default'  => 80,
        'choices' => array( 'min' => 0, 'max' => 100, 'step' => 5 ),
	    'priority' => 1,
    );
    
    //End Gallery Tab Settings

    
    //Begin Blog Tab Settings
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_display_full',
        'label'    => esc_html__('Display Full Blog Post Content', 'grandconference' ),
        'description' => esc_html__('Check this option to display post full content in blog page (excerpt blog grid layout)', 'grandconference' ),
        'section'  => 'blog_general',
        'default'  => 0,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'radio',
        'settings'  => 'tg_blog_archive_layout',
        'label'    => esc_html__('Archive Page Layout', 'grandconference' ),
        'description' => esc_html__('Select page layout for displaying archive page', 'grandconference' ),
        'section'  => 'blog_general',
        'default'  => 'blog_r',
        'choices'  => $tg_blog_layout,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'radio',
        'settings'  => 'tg_blog_category_layout',
        'label'    => esc_html__('Category Page Layout', 'grandconference' ),
        'description' => esc_html__('Select page layout for displaying category page', 'grandconference' ),
        'section'  => 'blog_general',
        'default'  => 'blog_r',
        'choices'  => $tg_blog_layout,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'radio',
        'settings'  => 'tg_blog_tag_layout',
        'label'    => esc_html__('Tag Page Layout', 'grandconference' ),
        'description' => esc_html__('Select page layout for displaying tag page', 'grandconference' ),
        'section'  => 'blog_general',
        'default'  => 'blog_r',
        'choices'  => $tg_blog_layout,
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_blog_single_title_typography',
        'label'    => esc_html__('Single Post Title Typography', 'grandconference' ),
        'section'  => 'blog_single',
        'default'  => array(
            'font-family'    => 'Poppins',
            'variant'        => '700',
            'font-size'      => '34px',
            'line-height'    => '1.3',
            'letter-spacing' => '0',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => 'body.single-post .post_content_wrapper h1',
            ),
        ),
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_blog_single_detail_typography',
        'label'    => esc_html__('Single Post Detail Typography', 'grandconference' ),
        'section'  => 'blog_single',
        'default'  => array(
            'font-family'    => 'Poppins',
            'variant'        => '600',
            'font-size'      => '12px',
            'line-height'    => '1.5',
            'letter-spacing' => '2px',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => 'body.single .post_detail.single_post',
            ),
        ),
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_page_title',
        'label'    => esc_html__('Display The Blog Title', 'grandconference' ),
        'description' => esc_html__('Check this to display the blog page title in single post page', 'grandconference' ),
        'section'  => 'blog_single',
        'default'  => 1,
        'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_feat_content',
        'label'    => esc_html__('Display Post Featured Content', 'grandconference' ),
        'description' => esc_html__('Check this to display featured content (image or gallery) in single post page', 'grandconference' ),
        'section'  => 'blog_single',
        'default'  => 1,
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_display_tags',
        'label'    => esc_html__('Display Post Tags', 'grandconference' ),
        'description' => esc_html__('Check this option to display post tags on single post page', 'grandconference' ),
        'section'  => 'blog_single',
        'default'  => 1,
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_display_share',
        'label'    => esc_html__('Display Post Sharing Options', 'grandconference' ),
        'description' => esc_html__('Check this option to display post sharing button on single post page', 'grandconference' ),
        'section'  => 'blog_single',
        'default'  => 1,
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_display_author',
        'label'    => esc_html__('Display About Author', 'grandconference' ),
        'description' => esc_html__('Check this option to display about author on single post page', 'grandconference' ),
        'section'  => 'blog_single',
        'default'  => 1,
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_display_related',
        'label'    => esc_html__('Display Related Posts', 'grandconference' ),
        'description' => esc_html__('Check this option to display related posts on single post page', 'grandconference' ),
        'section'  => 'blog_single',
        'default'  => 1,
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_blog_img_border_radius',
        'label'    => esc_html__('Image Border Radius (px)', 'grandconference' ),
        'section'  => 'blog_single',
        'default'  => 5,
        'choices' => array( 'min' => 0, 'max' => 50, 'step' => 1 ),
        'output' => array(
            array(
                'element'  => 'body.single-post .post_img img',
                'property' => 'border-radius',
                'units'    => 'px',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 9,
        'js_vars'   => array(
            array(
                'element'  => 'body.single-post .post_img img',
                'function' => 'css',
                'property' => 'border-radius',
                'units'    => 'px',
            ),
        )
    );
    //End Blog Tab Settings
    
    
    //Begin Session Tab Settings
    $controls[] = array(
        'type'     => 'radio',
        'settings'  => 'tg_session_sort',
        'label'    => esc_html__('Session Sorting', 'grandconference' ),
        'description' => 'Select session sorting options',
        'section'  => 'session_general',
        'default'  => 'start_time',
        'choices'  => $tg_session_sort,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'radio',
        'settings'  => 'tg_speaker_sort',
        'label'    => esc_html__('Speaker Sorting', 'grandconference' ),
        'description' => 'Select speaker sorting options',
        'section'  => 'session_general',
        'default'  => 'menu_order',
        'choices'  => $tg_speaker_sort,
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'image',
        'settings'  => 'tg_break_icon',
        'label'    => esc_html__('Session Break Icon', 'grandconference' ),
        'description' => esc_html__('Select session break icon to replace theme default image', 'grandconference' ),
        'section'  => 'session_general',
        'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_speaker_multiple_thumbs',
        'label'    => esc_html__('Display Multiple Speaker Thumbnails', 'grandconference' ),
        'description' => esc_html__('Check this to display multiple speakers thumbnails for session', 'grandconference' ),
        'section'  => 'session_general',
        'default'  => 0,
        'priority' => 3,
    );
    //End Session Tab Settings
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_pages_template_404',
        'label'    => esc_html__('Default 404 Page', 'grandconference' ),
        'description' => esc_html__('Select a page template for 404 not found page', 'grandconference' ),
        'section'  => 'pages_templates',
        'default'  => '',
        'choices'  => grandconference_get_published_pages(),
        'priority' => 1,
    );
    
    //Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
		//Begin Shop Tab Settings
		$controls[] = array(
	        'type'     => 'radio-buttonset',
	        'settings'  => 'tg_shop_layout',
	        'label'    => esc_html__('Shop Main Page Layout', 'grandconference' ),
	        'description' => esc_html__('Select page layout for displaying shop\'s products page', 'grandconference' ),
	        'section'  => 'shop_layout',
	        'default'  => 'fullwidth',
	        'choices'  => $tg_shop_layout,
		    'priority' => 1,
	    );
	    
	    $controls[] = array(
	        'type'     => 'slider',
	        'settings'  => 'tg_shop_items',
	        'label'    => esc_html__('Products Page Show At Most', 'grandconference' ),
	        'description' => esc_html__('Select number of product items you want to display per page', 'grandconference' ),
	        'section'  => 'shop_layout',
	        'default'  => 16,
	        'choices' => array( 'min' => 1, 'max' => 100, 'step' => 1 ),
		    'priority' => 2,
	    );
	    
	    $controls[] = array(
	        'type'     => 'color',
	        'settings'  => 'tg_shop_price_font_color',
	        'label'    => esc_html__('Product Price Font Color', 'grandconference' ),
	        'section'  => 'shop_single',
	        'default'  => '#FF2D55',
	        'output' => array(
		        array(
		            'element'  => '.woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, p.price ins span.amount, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price',
		            'property' => 'color',
		        ),
		    ),
		    'transport' 	 => 'postMessage',
		    'priority' => 2,
		    'js_vars'   => array(
				array(
					'element'  => '.woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, p.price ins span.amount, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price',
					'function' => 'css',
					'property' => 'color',
				),
			)
	    );
	    
	    $controls[] = array(
	        'type'     => 'toggle',
	        'settings'  => 'tg_shop_related_products',
	        'label'    => esc_html__('Display Related Products', 'grandconference' ),
	        'description' => esc_html__('Check this option to display related products on single product page', 'grandconference' ),
	        'section'  => 'shop_single',
	        'default'  => 1,
		    'priority' => 3,
	    );
		//End Shop Tab Settings
	}

    return $controls;
}
add_filter( 'kirki/controls', 'grandconference_custom_setting' );


function grandconference_customize_preview()
{
?>
    <script type="text/javascript">
        ( function( $ ) {
        	//Register Logo Tab Settings
        	wp.customize('tg_retina_logo',function( value ) {
                value.bind(function(to) {
                    jQuery('#custom_logo img').attr('src', to );
                });
            });
        	//End Logo Tab Settings
        
			//Register General Tab Settings
            wp.customize('tg_body_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'http://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length===0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('body, input[type=text], input[type=password], input[type=email], input[type=url], input[type=date], input[type=tel], input.wpcf7-text, .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, select, textarea').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_header_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'http://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length===0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('h1, h2, h3, h4, h5, h6, h7, .post_quote_title, label, strong[itemprop="author"], #page_content_wrapper .posts.blog li a, .page_content_wrapper .posts.blog li a, .readmore, .post_detail.single_post, .page_tagline, #gallery_caption .tg_caption .tg_desc, #filter_selected, #autocomplete li strong, .post_detail.single_post a, .post_detail.single_post a:hover,.post_detail.single_post a:active, blockquote,.single_tour_price, .single_tour_departure_wrapper li .single_tour_departure_title, .comment_rating_wrapper .comment_rating_label, .tour_excerpt, .widget_post_views_counter_list_widget, .sidebar_widget li.widget_products, #copyright, #footer_menu li a, #footer ul.sidebar_widget li ul.posts.blog li a, .woocommerce-page table.cart th, table.shop_table thead tr th, .tour_price, p.price span.amount, .woocommerce-page div.product .woocommerce-tabs ul.tabs li a, .woocommerce ul.products li.product .price').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_button_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'http://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length===0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt').css('fontFamily', to );
                });
            });
            //End General Tab Settings
        
        	//Register Menu Tab Settings
        	wp.customize('tg_menu_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'http://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length===0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_menu_contact_hours',function( value ) {
                value.bind(function(to) {
                    jQuery('#top_contact_hours').html('<i class="fa fa-clock-o"></i>'+to);
                });
            });
            
            wp.customize('tg_menu_contact_number',function( value ) {
                value.bind(function(to) {
                    jQuery('#top_contact_number').html('<i class="fa fa-phone"></i>'+to);
                });
            });
            
            wp.customize('tg_sidemenu_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'http://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length===0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('.mobile_main_nav li a, #sub_menu li a').css('fontFamily', to );
                });
            });
            //End Menu Tab Settings
            
        	
        	//Register Sidebar Tab Settings
            wp.customize('tg_sidebar_title_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'http://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length===0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle').css('fontFamily', to );
                });
            });
            //End Sidebar Tab Settings
            
            
            //Register Footer Tab Settings
            wp.customize('tg_footer_copyright_text',function( value ) {
                value.bind(function(to) {
                    jQuery('#copyright').html( to );
                });
            });
            //End Footer Tab Settings
        } )( jQuery )
    </script>
<?php	
}