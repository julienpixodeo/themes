<?php
/* Template Name: Register */
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
                <form id="register-client" action="register-client" method="post">
					<input type="hidden" class="url-comple" value="<?php echo home_url('compte'); ?>">
					<div class="box-field">
						<label for="">Prénom</label>
						<input id="first_name" type="text" name="first_name" placeholder="Prénom" autocomplete="off" required>
					</div>
					<div class="box-field">
						<label for="">Nom</label>
						<input id="last_name" type="text" name="last_name" placeholder="Nom" autocomplete="off" required>
					</div>
                    <div class="box-field">
                        <label for="">Adresse Email</label>
                        <input id="email" type="email" name="email" placeholder="Adresse Email" autocomplete="off" required>
                    </div>
                    <div class="box-field">
                        <label for="">Mot de passe</label>
                        <input id="password" type="password" name="password" placeholder="Mot de passe" autocomplete="off" required>
                    </div>
                    <div class="box-field">
                        <label for="">Confirmez votre mot de passe</label>
                        <input id="password_confirm" type="password" name="password_confirm" placeholder="Confirmez votre mot de passe" autocomplete="off" required>
                    </div>
                    <div class="message"></div>
                    <input class="submit_button" type="submit" value="S'inscrire" name="submit">
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
