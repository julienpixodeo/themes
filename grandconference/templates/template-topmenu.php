<?php
//Get page ID
if(is_object($post))
{
    $obj_page = get_page($post->ID);
}
$current_page_id = '';

if(isset($obj_page->ID))
{
    $current_page_id = $obj_page->ID;
}
elseif(is_home())
{
    $current_page_id = get_option('page_on_front');
}
?>

<div class="header_style_wrapper">
<?php
    //Check if display top bar
    $tg_topbar = get_theme_mod('tg_topbar', 0);
    if(GRANDCONFERENCE_THEMEDEMO && isset($_GET['topbar']) && !empty($_GET['topbar']))
	{
	    $tg_topbar = true;
	}
    
    $grandconference_topbar = grandconference_get_topbar();
    grandconference_set_topbar($tg_topbar);
    
    if(!empty($tg_topbar))
    {
?>

<!-- Begin top bar -->
<div class="above_top_bar">
    <div class="page_content_wrapper">
    
    <div class="top_contact_info">
		<?php
		    $tg_menu_contact_hours = get_theme_mod('tg_menu_contact_hours');
		    
		    if(!empty($tg_menu_contact_hours))
		    {	
		?>
		    <span id="top_contact_hours"><i class="fa fa-clock-o"></i><?php echo esc_html($tg_menu_contact_hours); ?></span>
		<?php
		    }
		?>
		<?php
		    //Display top contact info
		    $tg_menu_contact_number = get_theme_mod('tg_menu_contact_number');
		    
		    if(!empty($tg_menu_contact_number))
		    {
		?>
		    <span id="top_contact_number"><a href="tel:<?php echo esc_attr($tg_menu_contact_number); ?>"><i class="fa fa-phone"></i><?php echo esc_html($tg_menu_contact_number); ?></a></span>
		<?php
		    }
		?>
    </div>
    	
    <?php
    	//Display Top Menu
    	if ( has_nav_menu( 'top-menu' ) ) 
		{
		    wp_nav_menu( 
		        	array( 
		        		'menu_id'			=> 'top_menu',
		        		'menu_class'		=> 'top_nav',
		        		'theme_location' 	=> 'top-menu',
		        	) 
		    ); 
		}
    ?>
    <br class="clear"/>
    </div>
</div>
<?php
    }
?>
<!-- End top bar -->

<?php
	//Get Page Menu Transparent Option
	$page_menu_transparent = get_post_meta($current_page_id, 'page_menu_transparent', true);

    $pp_page_bg = '';
    //Get page featured image
    if(has_post_thumbnail($current_page_id, 'full'))
    {
        $image_id = get_post_thumbnail_id($current_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
        $pp_page_bg = $image_thumb[0];
    }
    
   if(!empty($pp_page_bg) && basename($pp_page_bg)=='default.png')
    {
    	$pp_page_bg = '';
    }
	
	//Check if Woocommerce is installed	
	if(class_exists('Woocommerce') && grandconference_is_woocommerce_page())
	{
		$shop_page_id = get_option( 'woocommerce_shop_page_id' );
		$page_menu_transparent = get_post_meta($shop_page_id, 'page_menu_transparent', true);
	}
	
	if(is_single() && !empty($pp_page_bg) && !grandconference_is_woocommerce_page())
	{
	    $post_type = get_post_type();
	    
	    switch($post_type)
	    {
	    	default:
	    		$page_menu_transparent = 0;	
	    	break;
	    }
	}
	else if(is_single() && empty($pp_page_bg) && !grandconference_is_woocommerce_page())
	{
		$page_menu_transparent = 0;	
	}
	
	if(is_search())
	{
	    $page_menu_transparent = 0;
	}
	
	if(is_404())
	{
	    $page_menu_transparent = 0;
	}
	
	$grandconference_homepage_style = grandconference_get_homepage_style();
	if($grandconference_homepage_style == 'fullscreen')
	{
	    $page_menu_transparent = 1;
	}
?>
<div class="top_bar <?php if(!empty($page_menu_transparent)) { ?>hasbg<?php } ?>">
    	
    	<!-- Begin logo -->
    	<div id="logo_wrapper">
    	<?php
    		//Get Soical Icon
			get_template_part("/templates/template-socials");
    	?>
    	
    	<!-- Begin right corner buttons -->
		<div id="logo_right_button">
		   
		   <?php
		    	$tg_menu_button_ticket_url = get_theme_mod('tg_menu_button_ticket_url');
		    	
		    	if(!empty($tg_menu_button_ticket_url))
		    	{
		    ?>
		   	<a href="<?php echo esc_url($tg_menu_button_ticket_url); ?>" id="get_ticket" class="button ghost"><?php esc_html_e('Get Tickets!', 'grandconference' ); ?></a>
		   <?php
		    	}
		    ?>
		   
		   <!-- Begin side menu -->
		   <a href="javascript:;" id="mobile_nav_icon"><span class="ti-menu"></span></a>
		   <!-- End side menu -->
		   
		</div>
		<!-- End right corner buttons -->
    	
    	<?php
    	    //get custom logo
    	    $tg_retina_logo = get_theme_mod('tg_retina_logo', get_template_directory_uri().'/images/logo@2x.png');

    	    if(!empty($tg_retina_logo))
    	    {	
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
    	?>
    	<div id="logo_normal" class="logo_container">
    		<div class="logo_align">
	    	    <a id="custom_logo" class="logo_wrapper <?php if(!empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo esc_url(home_url('/')); ?>">
	    	    	<?php
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
	    	    </a>
    		</div>
    	</div>
    	<?php
    	    }
    	?>
    	
    	<?php
    		//get custom logo transparent
    	    $tg_retina_transparent_logo = get_theme_mod('tg_retina_transparent_logo', get_template_directory_uri().'/images/logo@2x_white.png');

    	    if(!empty($tg_retina_transparent_logo))
    	    {
    	    	//Get image width and height
		    	$image_id = grandconference_get_image_id($tg_retina_transparent_logo);
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
    	?>
    	<div id="logo_transparent" class="logo_container">
    		<div class="logo_align">
	    	    <a id="custom_logo_transparent" class="logo_wrapper <?php if(empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo esc_url(home_url('/')); ?>">
	    	    	<?php
						if($image_width > 0 && $image_height > 0)
						{
					?>
					<img src="<?php echo esc_url($tg_retina_transparent_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>"/>
					<?php
						}
						else
						{
					?>
	    	    	<img src="<?php echo esc_url($tg_retina_transparent_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="158" height ="20"/>
	    	    	<?php 
		    	    	}
		    	    ?>
	    	    </a>
    		</div>
    	</div>
    	<?php
    	    }
    	?>
    	<!-- End logo -->
    	</div>
        
		<?php
			//Check if enable main menu
			$tg_menu_layout = grandconference_menu_layout();
			
			if($tg_menu_layout == 'centeralign')
			{
		?>
        <div id="menu_wrapper">
	        <div id="nav_wrapper">
	        	<div class="nav_wrapper_inner">
	        		<div id="menu_border_wrapper">
	        			<?php 	
	        				//Check if has custom menu
	        				if(is_object($post) && $post->post_type == 'page')
	    					{
	    						$page_menu = get_post_meta($current_page_id, 'page_menu', true);
	    					}
	        			
	        				if(empty($page_menu))
	    					{
	    						if ( has_nav_menu( 'primary-menu' ) ) 
	    						{
	    		    			    wp_nav_menu( 
	    		    			        	array( 
	    		    			        		'menu_id'			=> 'main_menu',
	    		    			        		'menu_class'		=> 'nav',
	    		    			        		'theme_location' 	=> 'primary-menu',
	    		    			        		'walker' => new grandconference_walker(),
	    		    			        	) 
	    		    			    ); 
	    		    			}
	    		    			else
	    		    			{
	    			    			echo '<div class="notice">'.esc_html__('Setup Menu via WordPress Dashboard > Appearance > Menus', 'grandconference' ).'</div>';
	    		    			}
	    	    			}
	    	    			else
	    				    {
	    				     	if( $page_menu && is_nav_menu( $page_menu ) ) {  
	    						    wp_nav_menu( 
	    						        array(
	    						            'menu' => $page_menu,
	    						            'walker' => new grandconference_walker(),
	    						            'menu_id'			=> 'main_menu',
	    		    			        	'menu_class'		=> 'nav',
	    						        )
	    						    );
	    						}
	    				    }
	        			?>
	        		</div>
	        	</div>
	        </div>
	        <!-- End main nav -->
        </div>
        <?php
        	}
        ?>
    </div>
</div>
