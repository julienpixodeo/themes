<?php
 	$tg_blog_display_tags = get_theme_mod('tg_blog_display_tags', 1);

    if(has_tag() && !empty($tg_blog_display_tags))
    {
?>
    <div class="post_excerpt post_tag">
    	<?php
	    	if( $tags = get_the_tags() ) {
			    foreach( $tags as $tag ) {
			        echo '<a href="' . get_term_link( $tag, $tag->taxonomy ) . '">#' . $tag->name . '</a>';
			    }
			}	
	   	?>
    </div>
<?php
    }
?>

<?php
	$tg_blog_display_share = get_theme_mod('tg_blog_display_share', 1);
	
	if(!empty($tg_blog_display_share))
    {
?>
<div id="post_share_text" class="post_share_text">
	<span class="ti-share"></span>
</div>
<?php
	}
?>
<br class="clear"/>