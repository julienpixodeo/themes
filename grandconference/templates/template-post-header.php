<?php
/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

$grandconference_topbar = grandconference_get_topbar();
$grandconference_screen_class = grandconference_get_screen_class();
$grandconference_page_content_class = grandconference_get_page_content_class();

$tg_blog_page_title = get_theme_mod('tg_blog_page_title' , 1);

if(!empty($tg_blog_page_title))
{
?>

<div id="page_caption" class="<?php if(!empty($grandconference_topbar)) { ?>withtopbar<?php } ?> <?php if(!empty($grandconference_screen_class)) { echo esc_attr($grandconference_screen_class); } ?> <?php if(!empty($grandconference_page_content_class)) { echo esc_attr($grandconference_page_content_class); } ?>">
	<div class="page_title_wrapper">
		<div class="standard_wrapper">
			<div class="page_title_inner">
				<div class="page_title_content">
					<h1><?php esc_html_e('The Blog', 'grandconference' ); ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}
?>

<!-- Begin content -->
<?php
$grandconference_page_content_class = grandconference_get_page_content_class();
?>
<div id="page_content_wrapper" class="<?php if(!empty($pp_page_bg)) { ?>hasbg <?php } ?><?php if(!empty($pp_page_bg) && !empty($grandconference_topbar)) { ?>withtopbar <?php } ?><?php if(!empty($grandconference_page_content_class)) { echo esc_attr($grandconference_page_content_class); } ?>">