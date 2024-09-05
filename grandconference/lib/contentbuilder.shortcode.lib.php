<?php
//Get all galleries
$args = array(
    'numberposts' => -1,
    'post_type' => array('galleries'),
);

//Check if custom post type plugin is installed	
$grandconference_custom_post = ABSPATH . '/wp-content/plugins/grandconference-custom-post/grandconference-custom-post.php';

$grandconference_custom_post_activated = file_exists($grandconference_custom_post);

$galleries_arr = get_posts($args);
$galleries_select = array();
$galleries_select[''] = '';

foreach($galleries_arr as $gallery)
{
    $galleries_select[$gallery->ID] = $gallery->post_title;
}

//Get all categories
$categories_arr = get_categories();
$categories_select = array();
$categories_select[''] = '';

foreach ($categories_arr as $cat) {
	$categories_select[$cat->cat_ID] = $cat->cat_name;
}

//Get all gallery categories
$gallery_cats_select = array();
$gallery_cats_select[''] = '';

if($grandconference_custom_post_activated)
{
	$gallery_cats_arr = get_terms('gallerycat', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
	
	if(!empty($gallery_cats_arr) && is_array($gallery_cats_arr)) {
		foreach ($gallery_cats_arr as $gallery_cat) {
			$gallery_cats_select[$gallery_cat->slug] = $gallery_cat->name;
		}
	}
}

//Get all speaker categories
$speaker_cat_select = array();
$speaker_cat_select[''] = '';

if($grandconference_custom_post_activated)
{
	$speaker_cat_arr = get_terms('speakercat', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
	
	if(!empty($speaker_cat_arr) && is_array($speaker_cat_arr)) {
		foreach ($speaker_cat_arr as $speaker_cat) {
			$speaker_cat_select[$speaker_cat->slug] = $speaker_cat->name;
		}
	}
}

//Get all team categories
$team_cats_select = array();
$team_cats_select[''] = '';

if($grandconference_custom_post_activated)
{
	$team_cats_arr = get_terms('teamcats', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
	
	if(!empty($team_cats_arr) && is_array($team_cats_arr)) {
		foreach ($team_cats_arr as $team_cat) {
			$team_cats_select[$team_cat->slug] = $team_cat->name;
		}
	}
}

//Get all testimonials categories
$testimonial_cats_select = array();
$testimonial_cats_select[''] = '';

if($grandconference_custom_post_activated)
{
	$testimonial_cats_arr = get_terms('testimonialcats', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
	
	if(!empty($testimonial_cats_arr) && is_array($testimonial_cats_arr)) {
		foreach ($testimonial_cats_arr as $testimonial_cat) {
			$testimonial_cats_select[$testimonial_cat->slug] = $testimonial_cat->name;
		}
	}
}

//Get all ticket categories
$ticket_cat_select = array();
$ticket_cat_select[''] = '';

if($grandconference_custom_post_activated)
{
	$ticket_cat_arr = get_terms('ticketcats', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
	
	if(!empty($ticket_cat_arr) && is_array($ticket_cat_arr)) {
		foreach($ticket_cat_arr as $ticket_cat)
		{
		    $ticket_cat_select[$ticket_cat->slug] = $ticket_cat->name;
		}
	}
}

//Get all sidebars
$theme_sidebar = array(
	'' => '',
	'Page Sidebar' => 'Page Sidebar', 
	'Blog Sidebar' => 'Blog Sidebar', 
	'Contact Sidebar' => 'Contact Sidebar', 
	'Single Post Sidebar' => 'Single Post Sidebar',
	'Single Image Page Sidebar' => 'Single Image Page Sidebar',
	'Archive Sidebar' => 'Archive Sidebar',
	'Category Sidebar' => 'Category Sidebar',
	'Search Sidebar' => 'Search Sidebar',
	'Tag Sidebar' => 'Tag Sidebar', 
	'Footer Sidebar' => 'Footer Sidebar',
);
$dynamic_sidebar = get_option('pp_sidebar');

if(!empty($dynamic_sidebar))
{
	foreach($dynamic_sidebar as $sidebar)
	{
		$theme_sidebar[$sidebar] = $sidebar;
	}
}

$theme_sidebar_layout = array(
	'left' 	=> 'Left Sidebar',
	'right'	=> 'Right Sidebar',
);

//Get order options
$order_select = array(
	'default' 	=> 'By Default',
	'newest'	=> 'By Newest',
	'oldest'	=> 'By Oldest',
	'title'		=> 'By Title',
	'random'	=> 'By Random',
);

//Get column options
$column_select = array(
	'1' => '1 Column',
	'2' => '2 Columns',
	'3'	=> '3 Columns',
	'4'	=> '4 Columns',
);

//Get column options
$blog_column_select = array(
	'3'	=> '3 Columns',
	'4'	=> '4 Columns',
	'5' => '5 Columns',
);

//Get column options
$team_column_select = array(
	'2' => '2 Columns',
	'3'	=> '3 Columns',
	'4'	=> '4 Columns',
	'5'	=> '5 Columns',
);

$testimonial_column_select = array(
	'2' => '2 Columns',
	'3'	=> '3 Columns',
	'4'	=> '4 Columns',
);

$gallery_column_select = array(
	'3'	=> '3 Columns',
	'4'	=> '4 Columns',
);

$text_block_layout_select = array(
	'fixedwidth'=> 'Fixed Width',
	'fullwidth'	=> 'Fullwidth',
);

$gallery_layout_select = array(
	'fullwidth'	=> 'Fullwidth',
	'fixedwidth'=> 'Fixed Width',
);

$team_layout_select = array(
	'fullwidth'	=> 'Fullwidth',
	'fixedwidth'=> 'Fixed Width',
);

$ppb_shortcodes = array(
	1 => array(
		'title' => 'Text',
	),
	
    'ppb_divider' => array(
    	'title' =>  'Paragraph Break',
    	'icon' => 'divider.png',
    	'image' => 'divider.jpg',
    	'attr' => array(),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_header' => array(
    	'title' =>  'Header',
    	'icon' => 'header.png',
    	'image' => 'header.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'width' => array(
    			'title' => 'Content Width (%)',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select width in percentage for this content',
    		),
    		'textalign' => array(
    			'title' => 'Text Alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' 	=> 'Left',
    				'center' => 'center',
    				'right'	=> 'Right',
    			),
    			'desc' => 'Select content alignment for this content',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this this block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_header_image' => array(
    	'title' =>  'Header With Background Image',
    	'icon' => 'header_image.png',
    	'image' => 'header_image.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'width' => array(
    			'title' => 'Content Width (%)',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select width in percentage for this content',
    		),
    		'textalign' => array(
    			'title' => 'Text Alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' 	=> 'Left',
    				'center' => 'center',
    				'right'	=> 'Right',
    			),
    			'desc' => 'Select content alignment for this content',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display as background',
    		),
    		'background_position' => array(
    			'title' => 'Background Position (Optional)',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'parallax' => array(
    			'title' => 'Parallax Effect',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable parallax scrolling effect for this background image',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'bgcolor' => array(
    			'title' => 'Overlay Background Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select overlay background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_text' => array(
    	'title' =>  'Text Contained Content',
    	'icon' => 'text.png',
    	'image' => 'text.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'width' => array(
    			'title' => 'Content Width (%)',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select width in percentage for this content',
    		),
    		'textalign' => array(
    			'title' => 'Text Alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' 	=> 'Left',
    				'center' => 'center',
    				'right'	=> 'Right',
    			),
    			'desc' => 'Select content alignment for this content',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    
    'ppb_text_fullwidth' => array(
    	'title' =>  'Text Fullwidth Content',
    	'icon' => 'text.png',
    	'image' => 'text.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    
    'ppb_text_image' => array(
    	'title' =>  'Text With Background Image',
    	'icon' => 'text_image.png',
    	'image' => 'text_image.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'width' => array(
    			'title' => 'Content Width (%)',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select width in percentage for this content',
    		),
    		'textalign' => array(
    			'title' => 'Text Alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' 	=> 'Left',
    				'center' => 'center',
    				'right'	=> 'Right',
    			),
    			'desc' => 'Select content alignment for this content',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display as background',
    		),
    		'background_position' => array(
    			'title' => 'Background Position (Optional)',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'parallax' => array(
    			'title' => 'Parallax Effect',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable parallax scrolling effect for this background image',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'bgcolor' => array(
    			'title' => 'Overlay Background Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select overlay background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_text_sidebar' => array(
    	'title' =>  'Text With Sidebar',
    	'icon' => 'contact_sidebar.png',
    	'image' => 'text_sidebar.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'sidebar' => array(
    			'Title' => 'Content Sidebar',
    			'type' => 'select',
    			'options' => $theme_sidebar,
    			'desc' => 'You can select sidebar to display next to content',
    		),
    		'sidebar_layout' => array(
    			'Title' => 'Sidebar Layout',
    			'type' => 'select',
    			'options' => $theme_sidebar_layout,
    		),
    		'padding' => array(
	    	    'title' => 'Content Padding',
	    	    'type' => 'jslider',
	    	    "std" => "40",
			    "min" => 0,
			    "max" => 200,
			    "step" => 5,
	    	    'desc' => 'Select padding top and bottom value for this header block',
	    	),
	    	'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    
    'ppb_fullwidth_button' => array(
    	'title' =>  'Full Width Button',
    	'icon' => 'fullwidth_button.png',
    	'image' => 'fullwidth_button.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'padding' => array(
    			'title' => 'Button Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this content block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title and subtitle',
    		),
    		'button_text' => array(
    			'title' => 'Button Text (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter text for button',
    		),
    		'link_url' => array(
    			'title' => 'Button Link URL (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter redirected link URL when button is clicked',
    		),
    		'button_bgcolor' => array(
    			'title' => 'Button Background Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select background color for button',
    		),
    		'button_fontcolor' => array(
    			'title' => 'Button Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for button',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    
    2 => array(
		'title' => 'Close',
	),
    
    3 => array(
		'title' => 'Images',
	),
    
    'ppb_image_fullwidth' => array(
    	'title' =>  'Image Fullwidth',
    	'icon' => 'image_full.png',
    	'image' => 'image_full.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in pixel)',
    		),
    		'background_position' => array(
    			'title' => 'Background Position',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_image_parallax' => array(
    	'title' =>  'Image Parallax',
    	'icon' => 'image_parallax.png',
    	'image' => 'image_full.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "80",
				"min" => 10,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in %)',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_image_fixed_width' => array(
    	'title' =>  'Image Fixed Width',
    	'icon' => 'image_fixed.png',
    	'image' => 'image_fixed.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'lightbox' => array(
    			'title' => 'Image Lightbox',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable image lightbox so when user click on image it opens in lightbox mode',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_content_half_bg' => array(
    	'title' =>  'One Half Content with Background',
    	'icon' => 'half_content_bg.png',
    	'image' => 'half_content_bg.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display as background',
    		),
    		'background_position' => array(
    			'title' => 'Background Position (Optional)',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'parallax' => array(
    			'title' => 'Parallax Effect',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable parallax scrolling effect for this background image and content',
    		),
    		'bgcolor' => array(
    			'title' => 'Content Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'align' => array(
    			'title' => 'Content Box alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for content box',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_card_two_cols_with_image' => array(
    	'title' =>  'Parallax Content With Image',
    	'icon' => 'half_content_bg.png',
    	'image' => 'card_two_cols_with_image.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens.',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'image' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image_width' => array(
    			'title' => 'Image Width',
    			'type' => 'jslider',
    			"std" => "65",
				"min" => 10,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select number of width for image (in %)',
    		),
    		'align' => array(
    			'title' => 'Image alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for image',
    		),
    		'content_width' => array(
    			'title' => 'Content Width',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 10,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select number of width for content (in %)',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this content block',
    		),
    		'bgcolor' => array(
    			'title' => 'Content Background Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select background color for this content block',
    		),
    		'bordercolor' => array(
    			'title' => 'Content Border Color',
    			'type' => 'colorpicker',
    			"std" => "",
    			'desc' => 'Select border color for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only)',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_content_center_bg' => array(
    	'title' =>  'Center Content with Background',
    	'icon' => 'header_image.png',
    	'image' => 'center_content_bg.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display as background',
    		),
    		'background_position' => array(
    			'title' => 'Background Position (Optional)',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'parallax' => array(
    			'title' => 'Parallax Effect',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable parallax scrolling effect for this background image and content',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for background image (in pixel)',
    		),
    		'bgcolor' => array(
    			'title' => 'Content Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_image_half_fixed_width' => array(
    	'title' =>  'Image One Half Width',
    	'icon' => 'image_half_fixed.png',
    	'image' => 'image_half_fixed.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'image' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'align' => array(
    			'title' => 'Image alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for image',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_image_half_fullwidth' => array(
    	'title' =>  'Image One Half Fullwidth',
    	'icon' => 'image_half_full.png',
    	'image' => 'image_half_full.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'image' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in pixel)',
    		),
    		'parallax' => array(
    			'title' => 'Parallax Effect',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable parallax scrolling effect for this background image',
    		),
    		'align' => array(
    			'title' => 'Image alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for image',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for subtitle and content',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_image_two_third_fullwidth' => array(
    	'title' =>  'Image Two Third Fullwidth',
    	'icon' => 'image_half_full.png',
    	'image' => 'image_two_third_full.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'image' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in pixel)',
    		),
    		'parallax' => array(
    			'title' => 'Parallax Effect',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable parallax scrolling effect for this background image',
    		),
    		'align' => array(
    			'title' => 'Image alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for image',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title and subtitle',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_two_cols_images' => array(
    	'title' =>  'Images Two Columns',
    	'icon' => 'images_two_cols.png',
    	'image' => 'images_two_cols.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image1' => array(
    			'title' => 'Image 1',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image2' => array(
    			'title' => 'Image 2',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'lightbox' => array(
    			'title' => 'Image Lightbox',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable image lightbox so when user click on image it opens in lightbox mode',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_two_cols_images_no_space' => array(
    	'title' =>  'Images Two Columns No Space',
    	'icon' => 'images_two_cols_no_space.png',
    	'image' => 'images_two_cols_no_space.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens.',
    		),
    		'image1' => array(
    			'title' => 'Image 1',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image2' => array(
    			'title' => 'Image 2',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in pixel)',
    		),
    		'parallax' => array(
    			'title' => 'Parallax Effect',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable parallax scrolling effect for this background image',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_three_cols_images' => array(
    	'title' =>  'Images Three Columns',
    	'icon' => 'images_three_cols.png',
    	'image' => 'images_three_cols.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image1' => array(
    			'title' => 'Image 1',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image2' => array(
    			'title' => 'Image 2',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image3' => array(
    			'title' => 'Image 3',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'lightbox' => array(
    			'title' => 'Image Lightbox',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable image lightbox so when user click on image it opens in lightbox mode',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_three_images_block' => array(
    	'title' =>  'Images Three blocks',
    	'icon' => 'images_three_block.png',
    	'image' => 'images_three_block.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image_portrait' => array(
    			'title' => 'Image Portrait',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content (Portrait image size)',
    		),
    		'image_portrait_align' => array(
    			'title' => 'Image Portrait alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for image portrait size',
    		),
    		'image2' => array(
    			'title' => 'Image 2',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image3' => array(
    			'title' => 'Image 3',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'lightbox' => array(
    			'title' => 'Image Lightbox',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable image lightbox so when user click on image it opens in lightbox mode',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_four_images_block' => array(
    	'title' =>  'Images Four blocks',
    	'icon' => 'images_four_block.png',
    	'image' => 'images_four_block.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image1' => array(
    			'title' => 'Image 1',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image2' => array(
    			'title' => 'Image 2',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image3' => array(
    			'title' => 'Image 3',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image4' => array(
    			'title' => 'Image 4',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'lightbox' => array(
    			'title' => 'Image Lightbox',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable image lightbox so when user click on image it opens in lightbox mode',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_metro' => array(
    	'title' =>  'Images Metro',
    	'icon' => 'images_four_block.png',
    	'image' => 'images_metro.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in pixel)',
    		),
    		'image1' => array(
    			'title' => 'Image 1',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image2' => array(
    			'title' => 'Image 2',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image3' => array(
    			'title' => 'Image 3',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image4' => array(
    			'title' => 'Image 4',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image5' => array(
    			'title' => 'Image 5',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    
    4 => array(
		'title' => 'Close',
	),
	
	5 => array(
		'title' => 'Videos',
	),
	
	'ppb_header_youtube' => array(
    	'title' =>  'Header With Parallax Youtube Video',
    	'icon' => 'header_image.png',
    	'image' => 'header_youtube.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'width' => array(
    			'title' => 'Content Width (%)',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select width in percentage for this content',
    		),
    		'textalign' => array(
    			'title' => 'Text Alignment',
    			'type' => 'select',
    			'options' => array(
    				'center' => 'center',
    				'left' 	=> 'Left',
    				'right'	=> 'Right',
    			),
    			'desc' => 'Select content alignment for this content',
    		),
    		'youtube' => array(
    			'title' => 'Youtube Video URL',
    			'type' => 'text',
    			'desc' => 'Enter Youtube video URL here ex. https://www.youtube.com/watch?v=XE0fU9PCrWE',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'bgcolor' => array(
    			'title' => 'Overlay Background Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select overlay background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    
    'ppb_header_vimeo' => array(
    	'title' =>  'Header With Parallax Vimeo Video',
    	'icon' => 'header_image.png',
    	'image' => 'header_vimeo.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'width' => array(
    			'title' => 'Content Width (%)',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select width in percentage for this content',
    		),
    		'textalign' => array(
    			'title' => 'Text Alignment',
    			'type' => 'select',
    			'options' => array(
    				'center' => 'center',
    				'left' 	=> 'Left',
    				'right'	=> 'Right',
    			),
    			'desc' => 'Select content alignment for this content',
    		),
    		'vimeo' => array(
    			'title' => 'Vimeo Video URL',
    			'type' => 'text',
    			'desc' => 'Enter Vimeo video URL here ex. https://vimeo.com/113111992',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'bgcolor' => array(
    			'title' => 'Overlay Background Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select overlay background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    
    'ppb_youtube_parallax' => array(
    	'title' =>  'Youtube Parallax',
    	'icon' => 'image_parallax.png',
    	'image' => 'youtube_parallax.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'youtube' => array(
    			'title' => 'Youtube Video URL',
    			'type' => 'text',
    			'desc' => 'Enter Youtube video URL here ex. https://www.youtube.com/watch?v=XE0fU9PCrWE',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "50",
				"min" => 10,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in %)',
    		),
    		'display_title' => array(
    			'title' => 'Display title',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    
    'ppb_vimeo_parallax' => array(
    	'title' =>  'Vimeo Parallax',
    	'icon' => 'image_parallax.png',
    	'image' => 'vimeo_parallax.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'vimeo' => array(
    			'title' => 'Vimeo Video URL',
    			'type' => 'text',
    			'desc' => 'Enter Vimeo video URL here ex. https://vimeo.com/113111992',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "50",
				"min" => 10,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in %)',
    		),
    		'display_title' => array(
    			'title' => 'Display title',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
        
    'ppb_content_half_youtube' => array(
    	'title' =>  'One Half Content with Youtube Background',
    	'icon' => 'half_content_bg.png',
    	'image' => 'half_youtube_bg.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'youtube' => array(
    			'title' => 'Youtube Video URL',
    			'type' => 'text',
    			'desc' => 'Enter Youtube video URL here ex. https://www.youtube.com/watch?v=XE0fU9PCrWE',
    		),
    		'bgcolor' => array(
    			'title' => 'Content Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'align' => array(
    			'title' => 'Content Box alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for content box',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    
    'ppb_content_half_vimeo' => array(
    	'title' =>  'One Half Content with Vimeo Background',
    	'icon' => 'half_content_bg.png',
    	'image' => 'half_vimeo_bg.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'vimeo' => array(
    			'title' => 'Vimeo Video URL',
    			'type' => 'text',
    			'desc' => 'Enter Vimeo video URL here ex. https://vimeo.com/113111992',
    		),
    		'bgcolor' => array(
    			'title' => 'Content Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'align' => array(
    			'title' => 'Content Box alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for content box',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    
    'ppb_content_center_youtube' => array(
    	'title' =>  'Center Content with Youtube Background',
    	'icon' => 'header_image.png',
    	'image' => 'center_content_youtube.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'youtube' => array(
    			'title' => 'Youtube Video URL',
    			'type' => 'text',
    			'desc' => 'Enter Youtube video URL here ex. https://www.youtube.com/watch?v=XE0fU9PCrWE',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for background image (in pixel)',
    		),
    		'bgcolor' => array(
    			'title' => 'Content Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    
    'ppb_content_center_vimeo' => array(
    	'title' =>  'Center Content with Vimeo Background',
    	'icon' => 'header_image.png',
    	'image' => 'center_content_vimeo.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'vimeo' => array(
    			'title' => 'Vimeo Video URL',
    			'type' => 'text',
    			'desc' => 'Enter Vimeo video URL here ex. https://vimeo.com/113111992',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for background image (in pixel)',
    		),
    		'bgcolor' => array(
    			'title' => 'Content Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    
    'ppb_youtube_two_third_fullwidth' => array(
    	'title' =>  'Youtube Two Third Fullwidth',
    	'icon' => 'image_half_full.png',
    	'image' => 'youtube_two_third_full.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'youtube' => array(
    			'title' => 'Youtube Video URL',
    			'type' => 'text',
    			'desc' => 'Enter Youtube video URL here ex. https://www.youtube.com/watch?v=XE0fU9PCrWE',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in pixel)',
    		),
    		'align' => array(
    			'title' => 'Video alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for image',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title and subtitle',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    
    'ppb_vimeo_two_third_fullwidth' => array(
    	'title' =>  'Vimeo Two Third Fullwidth',
    	'icon' => 'image_half_full.png',
    	'image' => 'vimeo_two_third_full.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'vimeo' => array(
    			'title' => 'Vimeo Video URL',
    			'type' => 'text',
    			'desc' => 'Enter Vimeo video URL here ex. https://vimeo.com/113111992',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in pixel)',
    		),
    		'align' => array(
    			'title' => 'Video alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for image',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title and subtitle',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
	
	6 => array(
		'title' => 'Close',
	),
    
    7 => array(
		'title' => 'Gallery',
	),
    
    'ppb_gallery_slider' => array(
    	'title' =>  'Gallery Slider Fullwidth',
    	'icon' => 'gallery_slider_full.png',
    	'image' => 'gallery_slider_full.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'gallery' => array(
    			'title' => 'Gallery',
    			'type' => 'select',
    			'options' => $galleries_select,
    			'desc' => 'Select the gallery you want to display',
    		),
    		'autoplay' => array(
    			'title' => 'Auto Play',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => 'Auto play gallery image slider',
    		),
    		'timer' => array(
    			'title' => 'Timer',
    			'type' => 'jslider',
    			"std" => "5",
				"min" => 1,
				"max" => 60,
				"step" => 1,
    			'desc' => 'Select number of seconds for slider timer',
    		),
    		'caption' => array(
    			'title' => 'Display Image Caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => 'Display gallery image caption',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_gallery_slider_fixed_width' => array(
    	'title' =>  'Gallery Slider Fixed Width',
    	'icon' => 'gallery_slider_fixed.png',
    	'image' => 'gallery_slider_fixed.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'gallery' => array(
    			'title' => 'Gallery',
    			'type' => 'select',
    			'options' => $galleries_select,
    			'desc' => 'Select the gallery you want to display',
    		),
    		'autoplay' => array(
    			'title' => 'Auto Play',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => 'Auto play gallery image slider',
    		),
    		'timer' => array(
    			'title' => 'Timer',
    			'type' => 'jslider',
    			"std" => "5",
				"min" => 1,
				"max" => 60,
				"step" => 1,
    			'desc' => 'Select number of seconds for slider timer',
    		),
    		'caption' => array(
    			'title' => 'Display Image Caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => 'Display gallery image caption',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_gallery_grid' => array(
    	'title' =>  'Gallery Grid',
    	'icon' => 'gallery_grid.png',
    	'image' => 'gallery_grid.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'gallery_id' => array(
    			'title' => 'Gallery',
    			'type' => 'select',
    			'options' => $galleries_select,
    			'desc' => 'Select the gallery you want to display',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Columns',
					3 => '3 Columns',
					4 => '4 Columns',
					5 => '5 Columns',
    			),
    			'desc' => 'Select gallery columns',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_animated_gallery_grid' => array(
    	'title' =>  'Animated Gallery Grid',
    	'icon' => 'animated_grid.png',
    	'image' => 'animated_grid.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens.',
    		),
    		'gallery_id' => array(
    			'title' => 'Gallery',
    			'type' => 'select',
    			'options' => $galleries_select,
    			'desc' => 'Select the gallery you want to display',
    		),
    		'rows' => array(
    			'type' => 'jslider',
    			"std" => "3",
				"min" => 1,
				"max" => 20,
				"step" => 1,
    			'desc' => 'Select number of rows to display',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    
    8 => array(
		'title' => 'Close',
	),
    
    9 => array(
		'title' => 'Session & Speaker',
	),
	'ppb_session_filterable' => array(
    	'title' =>  'Session Fullwidth',
    	'icon' => 'images_two_cols.png',
    	'image' => 'filterable_session.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'filterable' => array(
    			'title' => 'Display filterable options',
    			'type' => 'select',
    			'options' => array(
    				'yes' => 'Yes',
					'no' => 'No',
    			),
    			'desc' => 'Select to display filter by sessions title option',
    		),
    		'title_bgcolor' => array(
    			'title' => 'Title Background Color',
    			'type' => 'colorpicker',
    			"std" => "#007AFF",
    			'desc' => 'Select background color for day title header',
    		),
    		'title_fontcolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for day title header',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Columns',
					3 => '3 Columns',
    			),
    			'desc' => 'Select layout columns',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_session_filterable_sidebar' => array(
    	'title' =>  'Session With Sidebar',
    	'icon' => 'contact_sidebar.png',
    	'image' => 'filterable_session_sidebar.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'filterable' => array(
    			'title' => 'Display filterable options',
    			'type' => 'select',
    			'options' => array(
    				'yes' => 'Yes',
					'no' => 'No',
    			),
    			'desc' => 'Select to display filter by sessions title option',
    		),
    		'title_bgcolor' => array(
    			'title' => 'Title Background Color',
    			'type' => 'colorpicker',
    			"std" => "#007AFF",
    			'desc' => 'Select background color for day title header',
    		),
    		'title_fontcolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for day title header',
    		),
    		'sidebar' => array(
    			'Title' => 'Content Sidebar',
    			'type' => 'select',
    			'options' => $theme_sidebar,
    			'desc' => 'You can select sidebar to display next to content',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_session_tab' => array(
    	'title' =>  'Session Tab',
    	'icon' => 'header.png',
    	'image' => 'session_tab.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'filterable' => array(
    			'title' => 'Display filterable options',
    			'type' => 'select',
    			'options' => array(
    				'yes' => 'Yes',
					'no' => 'No',
    			),
    			'desc' => 'Select to display filter by sessions title option',
    		),
    		'width' => array(
    			'title' => 'Content Width (%)',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select width in percentage for this content',
    		),
    		/*'active_title_bgcolor' => array(
    			'title' => 'Active Title Background Color',
    			'type' => 'colorpicker',
    			"std" => "#FF2D55",
    			'desc' => 'Select background color for active day title header',
    		),
    		'title_bgcolor' => array(
    			'title' => 'Title Background Color',
    			'type' => 'colorpicker',
    			"std" => "#007AFF",
    			'desc' => 'Select background color for day title header',
    		),*/
    		'title_fontcolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for day title header',
    		),
    		'bgcolor' => array(
    			'title' => 'background Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select background color for this content block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_speaker_grid' => array(
    	'title' =>  'Speaker Grid',
    	'icon' => 'gallery_grid.png',
    	'image' => 'speaker_grid.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Columns',
					3 => '3 Columns',
					4 => '4 Columns',
					5 => '5 Columns',
    			),
    			'desc' => 'Select layout columns',
    		),
    		'speakercat' => array(
    			'title' => 'Filter by category',
    			'type' => 'select',
    			'options' => $speaker_cat_select,
    			'desc' => 'You can choose to display only some posts from selected category',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "10",
				"min" => 0,
				"max" => 500,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'effect' => array(
    			'title' => 'Effect',
    			'type' => 'select',
    			'options' => array(
    				0 => 'No Effect',
					'bw' => 'Black & White',
    			),
    			'desc' => 'Select layout columns',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_speaker_classic' => array(
    	'title' =>  'Speaker Classic',
    	'icon' => 'portfolio_classic.png',
    	'image' => 'speaker_classic.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Columns',
					3 => '3 Columns',
					4 => '4 Columns',
					5 => '5 Columns',
    			),
    			'desc' => 'Select layout columns',
    		),
    		'speakercat' => array(
    			'title' => 'Filter by category',
    			'type' => 'select',
    			'options' => $speaker_cat_select,
    			'desc' => 'You can choose to display only some posts from selected category',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "10",
				"min" => 0,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    
    10 => array(
		'title' => 'Close',
	),
    
    11 => array(
		'title' => 'Other',
	),
	
	'ppb_blog_grid' => array(
    	'title' =>  'Blog Grid',
    	'icon' => 'blog.png',
    	'image' => 'blog_grid.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'cat' => array(
    			'title' => 'Filter by category',
    			'type' => 'select',
    			'options' => $categories_select,
    			'desc' => 'You can choose to display only some posts from selected category',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "3",
				"min" => 1,
				"max" => 60,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'link_title' => array(
    			'title' => 'Enter button title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter link button to display link to your blog page for example. Read more',
    		),
    		'link_url' => array(
    			'title' => 'Button Link URL (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter redirected link URL when button is clicked',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_team_column' => array(
    	'title' =>  'Team Column Classic',
    	'icon' => 'team_column.png',
    	'image' => 'team_columns_classic.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'cat' => array(
    			'title' => 'Filter by team category',
    			'type' => 'select',
    			'options' => $team_cats_select,
    			'desc' => 'You can choose to display only some team members from selected team category',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => $team_column_select,
    			'desc' => 'Select how many columns you want to display service items in a row',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order team members',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "5",
				"min" => 1,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_sponsor_column' => array(
    	'title' =>  'Sponsor 5 Columns',
    	'icon' => 'images_four_block.png',
    	'image' => 'sponsor_columns.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image1' => array(
    			'title' => 'Sponsor 1',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image2' => array(
    			'title' => 'Sponsor 2',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image3' => array(
    			'title' => 'Sponsor 3',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image4' => array(
    			'title' => 'Sponsor 4',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image5' => array(
    			'title' => 'Sponsor 5',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_testimonial_slider' => array(
    	'title' =>  'Testimonials Slider',
    	'icon' => 'testimonial_slider.png',
    	'image' => 'testimonial_slider.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'cat' => array(
    			'title' => 'Filter by testimonials category',
    			'type' => 'select',
    			'options' => $testimonial_cats_select,
    			'desc' => 'You can choose to display only some testimonials from selected testimonial category',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "3",
				"min" => 1,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'background' => array(
    			'title' => 'Background Image (Optional)',
    			'type' => 'file',
    			'desc' => 'Upload background image you want to display for this content',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_testimonial_column' => array(
    	'title' =>  'Testimonials Column',
    	'icon' => 'testimonial_column.png',
    	'image' => 'testimonial_column.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => $testimonial_column_select,
    			'desc' => 'Select how many columns you want to display service items in a row',
    		),
    		'cat' => array(
    			'title' => 'Filter by testimonials category',
    			'type' => 'select',
    			'options' => $testimonial_cats_select,
    			'desc' => 'You can choose to display only some testimonials from selected testimonial category',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "4",
				"min" => 1,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_venue_column' => array(
    	'title' =>  'Venues 2 Columns',
    	'icon' => 'testimonial_column.png',
    	'image' => 'venue_column.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'venue1_image' => array(
    			'title' => 'Venue 1 Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for Venue first column',
    		),
    		'venue1_title' => array(
    			'title' => 'Venue 1 Title',
    			'type' => 'text',
    			'desc' => 'Venue first column title',
    		),
    		'venue1_subtitle' => array(
    			'title' => 'Venue 1 Sub Title',
    			'type' => 'text',
    			'desc' => 'Venue first column sub title',
    		),
    		'venue1_url' => array(
    			'title' => 'Venue 1 Link URL',
    			'type' => 'text',
    			'desc' => 'Venue first column URL ex. hotel site',
    		),
    		'venue1_rate' => array(
    			'title' => 'Venue 1 Price Rate',
    			'type' => 'text',
    			'desc' => 'Venue first column Pricing ex. $495',
    		),
    		'venue2_image' => array(
    			'title' => 'Venue 2 Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for Venue first column',
    		),
    		'venue2_title' => array(
    			'title' => 'Venue 2 Title',
    			'type' => 'text',
    			'desc' => 'Venue first column title',
    		),
    		'venue2_subtitle' => array(
    			'title' => 'Venue 2 Sub Title',
    			'type' => 'text',
    			'desc' => 'Venue first column sub title',
    		),
    		'venue2_url' => array(
    			'title' => 'Venue 2 Link URL',
    			'type' => 'text',
    			'desc' => 'Venue first column URL ex. hotel site',
    		),
    		'venue2_rate' => array(
    			'title' => 'Venue 2 Price Rate',
    			'type' => 'text',
    			'desc' => 'Venue first column Pricing ex. $495',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_ticket' => array(
		'title' => 'Ticket Table',
		'icon' => 'pricing_table.png',
		'image' => 'ticket_table.jpg',
		'attr' => array(
			'slug' => array(
	    		'title' => 'Slug (Optional)',
	    		'type' => 'text',
	    		'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
	    	),
	    	'columns' => array(
	    		'title' => 'Columns',
	    		'type' => 'select',
	    		'options' => array(
					2 => '2 Columns',
					3 => '3 Columns',
					4 => '4 Columns',
				),
	    		'desc' => 'Select Number of Pricing Columns',
	    	),
	    	'highlightcolor' => array(
	    		'title' => 'Highlight Color',
	    		'type' => 'colorpicker',
	    		"std" => "#001d2c",
	    		'desc' => 'Select hightlight color for this content',
	    	),
	    	'button_bgcolor' => array(
	    		'title' => 'Button Background Color',
	    		'type' => 'colorpicker',
	    		"std" => "#4990E2",
	    		'desc' => 'Select background color for button',
	    	),
	    	'padding' => array(
	    		'title' => 'Content Padding',
	    		'type' => 'jslider',
	    		"std" => "40",
				"min" => 0,
				"max" => 200,
				"step" => 5,
	    		'desc' => 'Select padding top and bottom value for this header block',
	    	),
	    	'margin' => array(
	    		'title' => 'Content Margin',
	    		'type' => 'margin',
	    		"std" => "0",
	    		'desc' => 'Enter margin value for this header block',
	    	),
	    	'custom_css' => array(
	    		'title' => 'Custom Style',
	    		'type' => 'text',
	    		'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
	    	),
	    ),
	    'desc' => array(),
	    'content' => FALSE
	),
	'ppb_countdown_image' => array(
    	'title' =>  'Countdown With Background Image',
    	'icon' => 'header_image.png',
    	'image' => 'countdown_image.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'date' => array(
    			'title' => 'Date',
    			'type' => 'date',
    			'desc' => 'select date for this countdown in format mm/dd/yyyy',
    		),
    		'width' => array(
    			'title' => 'Content Width (%)',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select width in percentage for this content',
    		),
    		'textalign' => array(
    			'title' => 'Text Alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' 	=> 'Left',
    				'center' => 'center',
    				'right'	=> 'Right',
    			),
    			'desc' => 'Select content alignment for this content',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display as background',
    		),
    		'background_position' => array(
    			'title' => 'Background Position (Optional)',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'parallax' => array(
    			'title' => 'Parallax Effect',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable parallax scrolling effect for this background image',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'bgcolor' => array(
    			'title' => 'Overlay Background Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select overlay background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_map' => array(
    	'title' =>  'Fullwidth Map',
    	'icon' => 'googlemap.png',
    	'image' => 'googlemap.jpg',
    	'attr' => array(
    		'slug' => array(
	    	    'title' => 'Slug (Optional)',
	    	    'type' => 'text',
	    	    'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
	    	),
    		'type' => array(
    			'title' => 'Map Type',
    			'type' => 'select',
    			'options' => array(
    				'' => 'Default Style',
					'ROADMAP' => 'Roadmap',
					'SATELLITE' => 'Satellite',
					'HYBRID' => 'Hybrid',
					'TERRAIN' => 'Terrain',
				),
    			'desc' => 'Select google map type',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 10,
				"max" => 1000,
				"step" => 10,
    			'desc' => 'Select map height (in px)',
    		),
    		'lat' => array(
    			'title' => 'Latitude',
    			'type' => 'text',
    			'desc' => 'Map latitude',
    		),
    		'long' => array(
    			'title' => 'Longtitude',
    			'type' => 'text',
    			'desc' => 'Map Longitude',
    		),
    		'zoom' => array(
    			'title' => 'Zoom Level',
    			'type' => 'jslider',
    			"std" => "14",
				"min" => 1,
				"max" => 18,
				"step" => 1,
    			'desc' => 'Enter zoom level',
    		),
    		'popup' => array(
    			'title' => 'Popup Text',
    			'type' => 'text',
    			'desc' => 'Enter text to display as popup above location on map for example. your company name',
    		),
    		'marker' => array(
    			'title' => 'Custom Marker Icon (Optional)',
    			'type' => 'file',
    			'desc' => 'Enter custom marker image URL',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_content_half_map' => array(
    	'title' =>  'One Half Content with Map',
    	'icon' => 'half_content_bg.png',
    	'image' => 'half_content_map.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'type' => array(
    			'title' => 'Map Type',
    			'type' => 'select',
    			'options' => array(
    				'' => 'Default Style',
					'ROADMAP' => 'Roadmap',
					'SATELLITE' => 'Satellite',
					'HYBRID' => 'Hybrid',
					'TERRAIN' => 'Terrain',
				),
    			'desc' => 'Select google map type',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 10,
				"max" => 1000,
				"step" => 10,
    			'desc' => 'Select map height (in px)',
    		),
    		'lat' => array(
    			'title' => 'Latitude',
    			'type' => 'text',
    			'desc' => 'Map latitude',
    		),
    		'long' => array(
    			'title' => 'Longtitude',
    			'type' => 'text',
    			'desc' => 'Map Longitude',
    		),
    		'zoom' => array(
    			'title' => 'Zoom Level',
    			'type' => 'jslider',
    			"std" => "14",
				"min" => 1,
				"max" => 18,
				"step" => 1,
    			'desc' => 'Enter zoom level',
    		),
    		'marker' => array(
    			'title' => 'Custom Marker Icon (Optional)',
    			'type' => 'file',
    			'desc' => 'Enter custom marker image URL',
    		),
    		'bgcolor' => array(
    			'title' => 'Content Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'align' => array(
    			'title' => 'Content Box alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for content box',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
);

//Check if Contact form 7 is installed	
$contact_form_7 =  'contact-form-7/wp-contact-form-7.php';

// Check if the file is available to prevent warnings
$pp_contact_form_7_activated = is_plugin_active($contact_form_7);

if($pp_contact_form_7_activated)
{
	//Get all available contact forms
	$contactform7_arr = array();
	$contactform7_obj_arr = WPCF7_ContactForm::find($args);
	
	if(!empty($contactform7_obj_arr) && is_array($contactform7_obj_arr))
	{
		foreach($contactform7_obj_arr as $contactform7_obj)
		{
			$contactform7_id = $contactform7_obj->id();
			$contactform7_title = $contactform7_obj->title();
			
			$contactform7_arr[$contactform7_id] = $contactform7_title;
		}
	}
	
	$ppb_shortcodes['ppb_contact_map'] = array(
    	'title' =>  'Contact Form With Map',
    	'icon' => 'contact_map.png',
    	'image' => 'contact_map.jpg',
    	'attr' => array(
    		'slug' => array(
	    	    'title' => 'Slug (Optional)',
	    	    'type' => 'text',
	    	    'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
	    	),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'contactform' => array(
    			'title' => 'Contact Form',
    			'type' => 'select',
    			'options' => $contactform7_arr,
    			'desc' => 'Select contact form you want to use',
    		),
    		'type' => array(
    			'title' => 'Map Type',
    			'type' => 'select',
    			'options' => array(
    				'' => 'Default Style',
					'ROADMAP' => 'Roadmap',
					'SATELLITE' => 'Satellite',
					'HYBRID' => 'Hybrid',
					'TERRAIN' => 'Terrain',
				),
    			'desc' => 'Select google map type',
    		),
    		'lat' => array(
    			'title' => 'Latitude',
    			'type' => 'text',
    			'desc' => 'Map latitude',
    		),
    		'long' => array(
    			'title' => 'Longtitude',
    			'type' => 'text',
    			'desc' => 'Map Longitude',
    		),
    		'zoom' => array(
    			'title' => 'Zoom Level',
    			'type' => 'jslider',
    			"std" => "14",
				"min" => 1,
				"max" => 18,
				"step" => 1,
    			'desc' => 'Enter zoom level',
    		),
    		'popup' => array(
    			'title' => 'Popup Text',
    			'type' => 'text',
    			'desc' => 'Enter text to display as popup above location on map for example. your company name',
    		),
    		'marker' => array(
    			'title' => 'Custom Marker Icon (Optional)',
    			'type' => 'file',
    			'desc' => 'Enter custom marker image URL',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    );
    
    $ppb_shortcodes['ppb_contact_sidebar'] = array(
    	'title' =>  'Contact Form With Sidebar',
    	'icon' => 'contact_sidebar.png',
    	'image' => 'contact_sidebar.jpg',
    	'attr' => array(
    		'slug' => array(
	    	    'title' => 'Slug (Optional)',
	    	    'type' => 'text',
	    	    'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
	    	),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'contactform' => array(
    			'title' => 'Contact Form',
    			'type' => 'select',
    			'options' => $contactform7_arr,
    			'desc' => 'Select contact form you want to use',
    		),
    		'sidebar' => array(
    			'Title' => 'Content Sidebar',
    			'type' => 'select',
    			'options' => $theme_sidebar,
    			'desc' => 'You can select sidebar to display next to classic blog content',
    		),
    		'sidebar_layout' => array(
    			'Title' => 'Sidebar Layout',
    			'type' => 'select',
    			'options' => $theme_sidebar_layout,
    			'desc' => 'You can select sidebar layout between left or right sidebar',
    		),
    		'padding' => array(
	    	    'title' => 'Content Padding',
	    	    'type' => 'jslider',
	    	    "std" => "40",
			    "min" => 0,
			    "max" => 200,
			    "step" => 5,
	    	    'desc' => 'Select padding top and bottom value for this header block',
	    	),
	    	'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    );
    
    $ppb_shortcodes['ppb_contact_half_bg'] = array(
    	'title' =>  'One Half Contact Form with Background',
    	'icon' => 'contact_sidebar.png',
    	'image' => 'half_contact_bg.jpg',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'contactform' => array(
    			'title' => 'Contact Form',
    			'type' => 'select',
    			'options' => $contactform7_arr,
    			'desc' => 'Select contact form you want to use',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display as background',
    		),
    		'background_position' => array(
    			'title' => 'Background Position (Optional)',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'parallax' => array(
    			'title' => 'Parallax Effect',
    			'type' => 'select',
    			'options' => array(
    				1 	=> 'Yes',
    				0 => 'No',
    			),
    			'desc' => 'Enable parallax scrolling effect for this background image and content',
    		),
    		'bgcolor' => array(
    			'title' => 'Content Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'align' => array(
    			'title' => 'Content Box alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for content box',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    );
    $ppb_shortcodes['ppb_contact_box'] = array(
    	'title' =>  'Boxed Contact Form',
    	'icon' => 'header.png',
    	'image' => 'contact_box.jpg',
    	'attr' => array(
	    	'titlecolor' => array(
    			'title' => 'Title Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for title',
    		),
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'textarea',
    			'desc' => 'Enter short description for this header',
    		),
    		'contactform' => array(
    			'title' => 'Contact Form',
    			'type' => 'select',
    			'options' => $contactform7_arr,
    			'desc' => 'Select contact form you want to use',
    		),
    		'width' => array(
    			'title' => 'Content Width (%)',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select width in percentage for this content',
    		),
    		'textalign' => array(
    			'title' => 'Text Alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' 	=> 'Left',
    				'center' => 'center',
    				'right'	=> 'Right',
    			),
    			'desc' => 'Select content alignment for this content',
    		),
    		'bgcolor' => array(
    			'title' => 'Content Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'bordercolor' => array(
    			'title' => 'Content Border Color',
    			'type' => 'colorpicker',
    			"std" => "#FF2D55",
    			'desc' => 'Select border color for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'margin' => array(
    			'title' => 'Content Margin',
    			'type' => 'margin',
    			"std" => "0",
    			'desc' => 'Enter margin value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom Style',
    			'type' => 'text',
    			'desc' => 'You can add custom style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    );
}

//Check if Rev slider is installed	
$revslider =  'revslider/revslider.php';

// Check if the file is available to prevent warnings
$pp_revslider_activated = is_plugin_active($revslider);

if($pp_revslider_activated)
{
	// Get Rev Sliders
	require_once ABSPATH . 'wp-admin/includes/plugin.php' ;
	$is_revslider_active = is_plugin_active('revslider/revslider.php');
	$wp_revsliders = array();
	
	if($is_revslider_active)
	{
		$wp_revsliders = array(
			-1		=> "Choose a slide",
		);
		$revslider_objs = new RevSlider();
		$revslider_obj_arr = $revslider_objs->getArrSliders();
		
		foreach($revslider_obj_arr as $revslider_obj)
		{
			$wp_revsliders[$revslider_obj->getAlias()] = $revslider_obj->getTitle();
		}
	}
	
	$ppb_shortcodes['ppb_revslider'] = array(
    	'title' =>  'Revolution Slider',
    	'icon' => 'revslider.png',
    	'image' => 'revslider.jpg',
    	'attr' => array(
    		'slug' => array(
	    	    'title' => 'Slug (Optional)',
	    	    'type' => 'text',
	    	    'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
	    	),
    		'slider_id' => array(
    			'title' => 'Select Slider to display',
    			'type' => 'select',
    			'options' => $wp_revsliders,
    			'desc' => 'Choose which revolution slider to display (if it\'s empty. You need to create a revolution slider first.)',
    		),
    		'display' => array(
    			'title' => 'Slider Display Options',
    			'type' => 'select',
    			'options' => array(
    				'normal' => 'Display Normal Slider',
    				'force' => 'Display Only Slider for this page'
    			),
    			'desc' => 'Select slider display options',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    );
}

$ppb_shortcodes[12] = array(
    'title' => 'Close',
);

//Add demo pages layout to import
require_once get_template_directory() . "/lib/contentbuilder.demo.lib.php";
?>