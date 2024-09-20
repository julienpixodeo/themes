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

						<!-- Modal -->
						<div class="modal fade" id="modal-alert-refund" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
								Le montant qui vous sera remboursé est
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
									<button type="button" class="btn btn-primary refund-button-action">Oui</button>
								</div>
								</div>
							</div>
						</div>
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
