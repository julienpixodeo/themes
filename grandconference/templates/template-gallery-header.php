<?php
$grandconference_page_content_class = grandconference_get_page_content_class();
$grandconference_topbar = grandconference_get_topbar();
?>
<div id="page_caption" class="<?php if(!empty($grandconference_topbar)) { ?>withtopbar<?php } ?> <?php if(!empty($grandconference_page_content_class)) { echo esc_attr($grandconference_page_content_class); } ?>">
	
	<div class="page_title_wrapper">
		<div class="standard_wrapper">
			<div class="page_title_inner">
				<h1 <?php if(!empty($grandconference_topbar)) { ?>class ="withtopbar"<?php } ?>><?php the_title(); ?></h1>
				<?php
					$gallery_excerpt = get_the_excerpt();
	
			    	if(!empty($gallery_excerpt))
			    	{
			    ?>
			    	<div class="page_tagline">
			    		<?php echo nl2br($gallery_excerpt); ?>
			    	</div>
			    <?php
			    	}
			    ?>
			</div>
		</div>
	</div>
</div>
<!-- Begin content -->

<div id="page_content_wrapper" class="<?php if(!empty($grandconference_page_content_class)) { echo esc_attr($grandconference_page_content_class); } ?>">