<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

get_header(); 

$grandconference_topbar = grandconference_get_topbar();


/**
*	Get current page id
**/

$current_page_id = $post->ID;

$grandconference_topbar = grandconference_get_topbar();
$grandconference_screen_class = grandconference_get_screen_class();
$grandconference_page_content_class = grandconference_get_page_content_class();
?>
<div id="page_caption" class="<?php if(!empty($grandconference_topbar)) { ?>withtopbar<?php } ?> <?php if(!empty($grandconference_screen_class)) { echo esc_attr($grandconference_screen_class); } ?> <?php if(!empty($grandconference_page_content_class)) { echo esc_attr($grandconference_page_content_class); } ?>">

	<div class="page_title_wrapper">
		<div class="standard_wrapper">
			
			<?php
				//Get speaker thumbnail image
				$image_thumb = '';
								
				if(has_post_thumbnail(get_the_ID(), 'grandconference-gallery-list'))
				{
				    $image_id = get_post_thumbnail_id(get_the_ID());
				    $image_thumb = wp_get_attachment_image_src($image_id, 'grandconference-gallery-list', true);
				}
				
				if(isset($image_thumb[0]) && !empty($image_thumb[0]))
				{
			?>
			<div class="speaker_thumbnail"><img src="<?php echo esc_url($image_thumb[0]); ?>" alt="<?php esc_attr(get_the_title()); ?>"/></div>
			<?php
				}
			?>
			
			<div class="page_title_inner">
				<div class="page_title_content">
					<h1><?php the_title(); ?></h1>
					<?php
						$speaker_desciption = get_post_meta($current_page_id, 'speaker_desciption', true);
						
				    	if(!empty($speaker_desciption))
				    	{
				    ?>
				    	<div class="page_tagline">
				    		<?php echo esc_html($speaker_desciption); ?>
				    	</div>
				    <?php
				    	}
				    ?>
				    
				    <?php
						$speaker_website = get_post_meta($current_page_id, 'speaker_website', true);
						
				    	if(!empty($speaker_website))
				    	{
				    ?>
				    	<div class="speaker_website">
				    		<a href="<?php echo esc_url($speaker_website); ?>"><span class="ti-link"></span>&nbsp;<?php echo esc_html($speaker_website); ?></a>
				    	</div>
				    <?php
				    	}
				    ?>
				</div>
			</div>
			
			<br class="clear"/>
		</div>
	</div>

</div>

<div id="page_content_wrapper">
	 
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

    		<div class="sidebar_content full_width">
					
			<?php
			if (have_posts()) : while (have_posts()) : the_post();
			?>
									
			<!-- Begin each post -->
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<div class="post_wrapper">
				    
				    <div class="post_content_wrapper">
						    
						<?php
						    the_content();
						    wp_link_pages();
						    
						    //Get speaker social
						    $speaker_facebook = get_post_meta($current_page_id, 'speaker_facebook', true);
							$speaker_twitter = get_post_meta($current_page_id, 'speaker_twitter', true);
							$speaker_linkedin = get_post_meta($current_page_id, 'speaker_linkedin', true);
							
							if(!empty($speaker_facebook) OR !empty($speaker_twitter) OR !empty($speaker_google) OR !empty($speaker_linkedin))
							{
						?>
						<div class="speaker_social">
							<h4><?php esc_html_e('Social Profiles', 'grandconference' ); ?></h4>
							<div class="social_wrapper shortcode">
								<ul>
								<?php
									if(!empty($speaker_twitter))
								    {
								?>
								        <li class="twitter"><a title="<?php echo esc_attr(get_the_title()); ?> on Twitter" target="_blank" class="tooltip" href="https://twitter.com/<?php echo esc_attr($speaker_twitter); ?>"><i class="fab fa-twitter"></i></a></li>
								<?php
								    }
						 
								    if(!empty($speaker_facebook))
								    {
								?>
								        <li class="facebook"><a title="<?php echo esc_attr(get_the_title()); ?> on Facebook" target="_blank" class="tooltip" href="https://facebook.com/<?php echo esc_attr($speaker_facebook); ?>"><i class="fab fa-facebook-f"></i></a></li>
								<?php
								    }
								        
								    if(!empty($speaker_linkedin))
								    {
								?>
								        <li class="linkedin"><a title="<?php echo esc_attr(get_the_title()); ?> on Linkedin" target="_blank" class="tooltip" href="<?php echo esc_url($speaker_linkedin); ?>"><i class="fab fa-linkedin"></i></a></li>
								<?php
								    }
								?>	
								</ul>
							</div>
						</div>
						<?php
							}
						?>
						
				    </div>
				    
				</div>
			
			</div>
			<!-- End each post -->
			
			<?php endwhile; endif; ?>

			<?php
				//Get sessions from this speaker
				$args = array(
				    'numberposts' => -1,
				    'post_type' => array('session'),
				    'suppress_filters' => false,
				    'orderby' => 'meta_value',
				    'meta_key' => 'session_start_time',
				    'order' => 'ASC',
				    'meta_query' => array(
					    'key' => 'session_speakers',
				    	'value' => $current_page_id,
				    	'compare' => 'LIKE'
				    ),
				);
				
				$sessions_arr = get_posts($args);
				
				//Get all session days
				$session_days_arr = get_terms('scheduleday', 'hide_empty=0&hierarchical=0&parent=0&orderby=name');
				
				if(!empty($sessions_arr) && is_array($sessions_arr))
				{
				
					if(!empty($session_days_arr))	
					{
						wp_enqueue_script("masonry", get_template_directory_uri()."/js/masonry.pkgd.min.js", false, GRANDCONFERENCE_THEMEVERSION, true);
						//wp_enqueue_script("script-custom-session-masonry".$current_page_id, admin_url('admin-ajax.php')."?action=grandconference_script_custom_session_masonry&id=".$current_page_id.'&filter=yes', false, GRANDCONFERENCE_THEMEVERSION, true);
				?>
					<div class="speaker_session_wrapper themeborder">
						<h4 class="title"><?php esc_html_e('All Sessions by', 'grandconference' ); ?>&nbsp;<?php the_title(); ?></h4>
						<div id="<?php echo esc_attr($current_page_id); ?>">
						<?php
							foreach ($session_days_arr as $key => $session_day) 
							{
								$args_sorting = grandconference_get_default_session_sorting();
								
								//Get sessions from this day
								$args = array(
								    'numberposts' => -1,
								    'post_type' => array('session'),
								    'suppress_filters' => false,
								    'orderby' => $args_sorting['orderby'],
								    'meta_key' => 'session_start_time',
								    'order' => $args_sorting['order'],
								    'scheduleday' => $session_day->slug,
								    'meta_query' => array(
									    'key' => 'session_speakers',
								    	'value' => $current_page_id,
								    	'compare' => 'LIKE'
								    ),
								);
								
								$sessions_arr = get_posts($args);
								
								if(!empty($sessions_arr) && is_array($sessions_arr))
								{
									$last_class = '';
									if(($key+1)%2 == 0)
									{
										$last_class = 'last';
									}
							?>
								<ul class="scheduleday_wrapper themeborder one_half <?php echo esc_attr($last_class); ?>">
									<li class="scheduleday_title">
										<div class="scheduleday_title_icon"><span class="ti-calendar"></span></div>
										<div class="scheduleday_title_content"><h4><?php echo esc_html($session_day->name); ?></h4>
										<?php
											if(!empty($session_day->description))
											{
										?>
											<div class="scheduleday_desc"><?php echo $session_day->description; ?></div>
										<?php
											}
										?>
										</div>
										<br class="clear"/>
									</li>
									
									<?php
										if(!empty($sessions_arr) && is_array($sessions_arr))
										{
											foreach($sessions_arr as $session)
											{
												//Get session info.
												$session_title = $session->post_title;
												$session_start_time = get_post_meta($session->ID, 'session_start_time', true);
												$session_end_time = get_post_meta($session->ID, 'session_end_time', true);
									?>
									<li class="themeborder">
										<div class="session_content_wrapper expandable" data-expandid="excerpt_<?php echo esc_attr($session->ID); ?>">
											<div class="session_content">
											<?php
												if(!empty($session_start_time))
												{
											?>
												<div class="session_start_time"><?php echo esc_html($session_start_time); ?></div>
											<?php
												}
											?>
											
											<?php
												if(!empty($session_title))
												{
											?>
												<div class="session_title"><h6><?php echo esc_html($session_title); ?></h6></div>
											<?php
												}
											?>
											
											</div><br class="clear"/>
										</div>
										
										<div id="excerpt_<?php echo esc_attr($session->ID); ?>" class="session_content_extend hide session_content_wrapper">
											<div class="session_content">
											<?php
												if(!empty($session_start_time))
												{
											?>
												<div class="session_start_time"><?php echo esc_html($session_start_time); ?>
											<?php
													if(!empty($session_end_time))
													{
											?>
												&nbsp;-&nbsp;<?php echo esc_html($session_end_time); ?>
											<?php
													}
											?>		
												</div>
											<?php
												}
												
												$session_excerpt = $session->post_excerpt;
												if(!empty($session_excerpt))
												{
											?>
												<div class="session_excerpt"><?php echo wp_kses_post($session_excerpt); ?></div>
											<?php
												}
												
												//Get session topic
												$session_topic_list = wp_get_post_terms($session->ID, 'sessiontopic', array("fields" => "all"));
												
												if(!empty($session_topic_list))
												{
											?>
												<div class="session_title_list"><span class="ti-bookmark"></span>
											<?php
													foreach($session_topic_list as $session_topic)
													{
											?>
													<div class="session_title_item"><?php echo esc_html($session_topic->name); ?></div>
											<?php	
													}
											?>
												</div>
											<?php
												}
												
												$session_location = get_post_meta($session->ID, 'session_location', true);
												if(!empty($session_location))
												{
											?>
													<div class="session_location themeborder"><div class="session_location_label skin_color"><?php echo esc_html__("Where", 'grandconference'); ?></div>
													
													<div class="session_location_content"><?php echo esc_html($session_location); ?></div>
													</div>
											<?php
												}
											?>
											</div><br class="clear"/>
										</div>
									</li>
									<?php
											}
										}
									?>
								</ul>
						<?php
								}
							}
						?>
						</div>
					</div>
			<?php
					}
				}
			?>
						
    	</div>
    
    </div>
    <!-- End main content -->
   
</div>

<br class="clear"/><br/>
</div>
<?php get_footer(); ?>