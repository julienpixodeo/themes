<?php
/**
 * The main template file for display error page.
 *
 * @package WordPress
*/


get_header(); 

//Check if has custom 404 not found page
$tg_pages_template_404 = get_theme_mod('tg_pages_template_404');
if(!empty($tg_pages_template_404)) {
	//Add Polylang plugin support
	if (function_exists('pll_get_post')) {
		$tg_pages_template_404 = pll_get_post($tg_pages_template_404);
	}
	
	//Add WPML plugin support
	if (function_exists('icl_object_id')) {
		$tg_pages_template_404 = icl_object_id($tg_pages_template_404, 'page', false, ICL_LANGUAGE_CODE);
	}
	
	if (class_exists("\\Elementor\\Plugin")) {
		echo grandconference_get_elementor_content($tg_pages_template_404);
	}
}
//Display default 404 page template
else 
{
?>

<!-- Begin content -->
<div id="page_caption">
	<div class="page_title_wrapper">
		<div class="standard_wrapper">
			<div class="page_title_inner">
			    <h1><?php esc_html_e('404 Not Found!', 'grandconference' ); ?></h1>
			    <div class="page_tagline">
			        <?php esc_html_e( "We're sorry, the page you have looked for does not exist in our content!", 'grandconference' ); ?>
			    </div>
			</div>
		</div>
	</div>
</div>

<div id="page_content_wrapper">

    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
	    	<div class="search_form_wrapper">
		    	<?php esc_html_e( "Perhaps you would like to go to our homepage or try searching below.", 'grandconference' ); ?><br/>
		    	
	    		<form class="searchform" method="get" action="<?php echo esc_url(home_url('/')); ?>">
			    	<input style="width:100%" type="text" class="field searchform-s" name="s" value="<?php the_search_query(); ?>" placeholder="<?php esc_html_e('Type to search and hit enter...', 'grandconference' ); ?>">
			    </form>
    		</div>
	    	
	    	<br/>
	    	
	    	<h5><?php esc_html_e('Or try to browse our latest posts instead?', 'grandconference' ); ?></h5><br/>
	    		
	    		<div id="blog_grid_wrapper" class="sidebar_content full_width">
	    		<?php
				
				$query_string ="items=6&post_type=post&paged=$paged";
				query_posts($query_string);
				$key = 0;
				
				if (have_posts()) : while (have_posts()) : the_post();
					
					$animate_layer = $key+7;
					$current_order = $key+1;
					$image_thumb = '';
												
					if(has_post_thumbnail(get_the_ID(), 'large'))
					{
					    $image_id = get_post_thumbnail_id(get_the_ID());
					    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
					}
					
					if($current_order%3 == 0)
					{
						$post_class[] = 'last';
					}
				?>
				
				<!-- Begin each blog post -->
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<div class="post_wrapper grid_layout">
					
						<?php
						    //Get post featured content
						    $post_ft_type = get_post_meta(get_the_ID(), 'post_ft_type', true);
						    
						    switch($post_ft_type)
						    {
						    	case 'Image':
						    	default:
						        	if(!empty($image_thumb))
						        	{
						        		$small_image_url = wp_get_attachment_image_src($image_id, 'grandconference-blog', true);
						?>
						
						    	    <div class="post_img small static">
						    	    	<a href="<?php the_permalink(); ?>">
						    	    		<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="" />
						                </a>
						    	    </div>
						
						<?php
						    		}
						    	break;
						    	
						    	case 'Vimeo Video':
						    		$post_ft_vimeo = get_post_meta(get_the_ID(), 'post_ft_vimeo', true);
						?>
						    		<?php echo do_shortcode('[tg_vimeo video_id="'.esc_attr($post_ft_vimeo).'" width="670" height="377"]'); ?>
						    		<br/>
						<?php
						    	break;
						    	
						    	case 'Youtube Video':
						    		$post_ft_youtube = get_post_meta(get_the_ID(), 'post_ft_youtube', true);
						?>
						    		<?php echo do_shortcode('[tg_youtube video_id="'.esc_attr($post_ft_youtube).'" width="670" height="377"]'); ?>
						    		<br/>
						<?php
						    	break;
						    	
						    } //End switch
						?>
					    
					    <div class="post_header_wrapper">
							<div class="post_header grid">
								<div class="post_detail single_post">
								    <span class="post_info_date">
								    	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo date_i18n(GRANDCONFERENCE_THEMEDATEFORMAT, get_the_time('U')); ?></a>
								    </span>
								</div>
							    <h6><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
							</div>
							
							<?php
							    echo grandconference_substr(get_the_excerpt(), 80);
							?>
							
							<div class="post_button_wrapper">
							    <a class="readmore" href="<?php the_permalink(); ?>"><?php echo esc_html_e('Read More', 'grandconference' ); ?><span class="ti-angle-right"></span></a>
							</div>
					    </div>
					    
					</div>
				
				</div>
				<!-- End each blog post -->
				
				<?php $key++; ?>
				<?php 
					endwhile; endif; 
					wp_reset_postdata();
				?>
	    		</div>
    		</div>
    	</div>
    	
</div>
<br class="clear"/><br/>
<?php 
} //End display default 404 not found templates

get_footer(); 
?>