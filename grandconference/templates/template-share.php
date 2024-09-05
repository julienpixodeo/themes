<?php
    $pin_thumb = wp_get_attachment_image_src($post->ID, 'grandconference-gallery-grid', true);
    if(!isset($pin_thumb[0]))
    {
	    $pin_thumb[0] = '';
    }
?>
<h2><?php echo esc_html_e( 'Share', 'grandconference' ); ?></h2>
<div class="page_tagline"><?php the_title(); ?></div>
<div id="social_share_wrapper">
	<ul>
		<li><a class="facebook" title="<?php esc_html_e( 'Share On Facebook', 'grandconference' ); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>"><span class="ti-facebook"></span></a></li>
		<li><a class="twitter" title="<?php esc_html_e( 'Share On Twitter', 'grandconference' ); ?>" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo get_permalink(); ?>&url=<?php echo get_permalink(); ?>"><span class="ti-twitter"></span></a></li>
		<li><a class="pinterest" title="<?php esc_html_e( 'Share On Pinterest', 'grandconference' ); ?>" target="_blank" href="https://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo urlencode($pin_thumb[0]); ?>"><span class="ti-pinterest"></span></a></li>
		<li><a class="mail" title="<?php esc_html_e('Share by Email', 'grandconference' ); ?>" href="mailto:someone@example.com?Subject=<?php echo rawurlencode($post->post_title); ?>&amp;Body=<?php echo rawurlencode(get_permalink($post->ID)); ?>"><span class="ti-email"></span></a></li>
	</ul>
</div>