<?php
/* Template Name: Account list order*/
get_header(); 
?>
<div id="page_caption" class="">
	<div class="page_title_wrapper">
		<div class="standard_wrapper">
			<div class="page_title_inner">
				<div class="page_title_content">
					<h1 class="text-center">
						<?php 
						    echo get_the_title();
						?>
					</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="page_content_wrapper" class=" ">
	<div class="inner">
		<!-- Begin main content -->
		<div class="inner_wrapper">
			<div class="sidebar_content full_width">
                <?php
                    $current_user = wp_get_current_user();
                ?>
                <div class="wrap-content-sidebar">
                    <div class="sidebar-account">
                        <ul>
                            <li><a href="<?php echo home_url('compte'); ?>">Compte</a></li>
                            <li class="active"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
                        </ul>
                    </div>
                    <div class="wrap-list-order">
						<?php echo do_shortcode('[user_orders]'); ?>
                    </div>
                </div>
			</div>
		</div>
		<!-- End main content -->
	</div> 
</div>
<?php 
echo footer_elementor();
get_footer(); 
?>
