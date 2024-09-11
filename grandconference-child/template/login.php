<?php
/* Template Name: Login */
get_header(); 
if (isset($_SERVER['HTTP_REFERER'])) {
    $referring_url = $_SERVER['HTTP_REFERER'];
} else {
    $referring_url = home_url();
}
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
                <form id="login" action="login" method="post">
                    <input type="hidden" value="<?php echo $referring_url; ?>" class="referring-url">
                    <div class="box-field">
                        <input id="username" type="text" name="username" placeholder="Nom d'utilisateur" autocomplete="off" required>
                    </div>
                    <div class="box-field">
                        <input id="password" type="password" name="password" placeholder="Mot de passe" autocomplete="off" required>
                    </div>
                    <a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Mot de passe oublié ?</a>
                    <div class="message">Nom d'utilisateur ou mot de passe incorrect.</div>
                    <input class="submit_button" type="submit" value="Se connecter" name="submit">
                    <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                </form>
			</div>
		</div>
		<!-- End main content -->
	</div> 
</div>
<?php 
echo footer_elementor();
get_footer(); 
?>
