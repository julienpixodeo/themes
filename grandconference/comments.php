<?php
//Required password to comment
if ( post_password_required() ) { ?>
	<p><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'grandconference' ); ?></p>
<?php
	return;
}
?>
<?php 
//Display Comments
if( have_comments() ) : ?> 

<h3 class="comment_title"><?php comments_number(esc_html__( 'Leave A Reply', 'grandconference' ), esc_html__( '1 Comment', 'grandconference' ), '% '.esc_html__( 'Comments', 'grandconference' )); ?></span></h3>
<div>
	<a name="comments"></a>
	<?php wp_list_comments( array('callback' => 'grandconference_comment', 'avatar_size' => '40') ); ?>
</div>

<!-- End of thread -->  
<div style="height:10px"></div>

<?php endif; ?> 


<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

<div class="pagination"><p><?php previous_comments_link('<'); ?> <?php next_comments_link('>'); ?></p></div><br class="clear"/>

<?php endif; // check for comment navigation ?>


<?php 
//Display Comment Form
if ('open' == $post->comment_status) : ?> 

<?php 
	comment_form(array(
	    'title_reply' => esc_html__( 'Leave A Reply', 'grandconference' )
	));
?>
			
<?php endif; ?>