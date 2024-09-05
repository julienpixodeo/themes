<?php

function grandconference_get_site_domain()
{
	$site_url = site_url();
	$parse = parse_url($site_url);
	
	if(isset($parse['host']) && !empty($parse['host'])) {
		return $parse['host'];
	}
	else {
		return false;
	}
}

/**
* Setup blog pagination function
**/
function grandconference_pagination($pages = '', $range = 4)
{
	 $showitems = ($range * 2)+1;
	 
	 $paged = grandconference_get_paged();
	 if(empty($paged)) $paged = 1;
	 
	 if($pages == '')
	 {
	 $wp_query = grandconference_get_wp_query();
	 $pages = $wp_query->max_num_pages;
	 if(!$pages)
	 {
	 $pages = 1;
	 }
	 }
	 
	 if(1 != $pages)
	 {
	 echo "<div class=\"pagination\">";
	 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
	 if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
	 
	 for ($i=1; $i <= $pages; $i++)
	 {
	 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
	 {
	 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
	 }
	 }
	 
	 if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
	 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
	 echo "</div>";
	 }
}

function grandconference_get_review($post_id = '', $rating_field = '')
{
	$rating_arr = array();
	if(!empty($post_id) && !empty($rating_field))
	{
		$args = array(
			'status' => 'approve',
			'post_id' => $post_id, // use post_id, not post_ID
		);
		$comments = get_comments($args);
		$count_comments = count($comments);
		$rating_avg = 0;
		$rating_points = 0;
		
		if(!empty($comments) && is_array($comments))
		{
			foreach($comments as $comment)
			{
				$rating = get_comment_meta( $comment->comment_ID, $rating_field, true );
				$rating_points += $rating;
			}
			
			$rating_avg = $rating_points/$count_comments;
		}
		
		$rating_arr = array(
			'average'	=> $rating_avg,
			'points'	=> $rating_points,
			'count'		=> $count_comments,
		);
		
		return $rating_arr;
	}
	else
	{
		return $rating_arr = array(
			'average'	=> 0,
			'points'	=> 0,
			'count'		=> 0,
		);
	}
}
    
/**
*	Setup comment style
**/
function grandconference_comment($comment, $args, $depth) 
{
	$GLOBALS['comment'] = $comment; 
?>
   
	<div class="comment" id="comment-<?php comment_ID() ?>">
		<?php
		$has_avatar = get_avatar($comment,$size='60',$default='' );
		
		if($has_avatar != '')
		{
		?>
		<div class="gravatar">
         	<?php echo get_avatar($comment,$size='60',$default='' ); ?>
      	</div>
      	<?php
      	}
      	?>
      
      	<div class="right <?php if($has_avatar == '') { ?>fullwidth<?php } ?>">
			<?php if ($comment->comment_approved == '0') : ?>
         		<em><?php echo esc_html_e('(Your comment is awaiting moderation.)', 'grandconference') ?></em>
         		<br />
      		<?php endif; ?>
			
			<?php
				if(!empty($comment->comment_author_url))
				{
			?>
					<a href="<?php echo esc_url($comment->comment_author_url); ?>"><h7><?php echo esc_html($comment->comment_author); ?></h7></a>
			<?php
				}
				else
				{
			?>
					<h7><?php echo esc_html($comment->comment_author); ?></h7>
			<?php
				}
			?>
			
			<div class="comment_date"><?php echo date_i18n(GRANDCONFERENCE_THEMEDATEFORMAT, strtotime($comment->comment_date)); ?> <?php echo esc_html_e('at', 'grandconference') ?> <?php echo date_i18n(GRANDCONFERENCE_THEMETIMEFORMAT, strtotime($comment->comment_date)); ?></div>
			<?php 
      			if($depth < 3)
      			{
      		?>
      			<?php comment_reply_link(array_merge( $args, array('depth' => $depth,
'reply_text' =>  __('Reply', 'grandconference'), 'login_text' => __('Login to Reply', 'grandconference'), 'max_depth' => $args['max_depth']))) ?>
			<?php
				}
			?>
			<div class="comment_text"/>
      			<?php ' '.comment_text() ?>
	  		</div>
      	</div>
    </div>
    <?php 
        if($depth == 1)
        {
    ?>
    <br class="clear"/>
    <?php
    	}
    ?>
<?php
}

// Substring without losing word meaning and
// tiny words (length 3 by default) are included on the result.
// "..." is added if result do not reach original string length

function grandconference_substr($str, $length, $minword = 3)
{
    $sub = '';
    $len = 0;
    
    foreach (explode(' ', $str) as $word)
    {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);
        
        if (strlen($word) > $minword && strlen($sub) >= $length)
        {
            break;
        }
    }
    
    return $sub . (($len < strlen($str)) ? '...' : '');
}


/**
*	Setup recent posts widget
**/
function grandconference_posts($sort = 'recent', $items = 3, $echo = TRUE, $show_thumb = TRUE) 
{
	$return_html = '';
	
	if($sort == 'recent')
	{
		$args = array(
			'numberposts' => $items,
			'order' => 'DESC',
			'orderby' => 'date',
			'post_type' => 'post',
			'post_status' => 'publish',
			'suppress_filters' => 0,
		);
		$posts = get_posts($args);
		$title = esc_html__('Recent Posts', 'grandconference');
	}
	
	if(!empty($posts))
	{
		$return_html.= '<h2 class="widgettitle"><span>'.$title.'</span></h2>';
		$return_html.= '<ul class="posts blog ';
		
		if($show_thumb)
		{
			$return_html.= 'withthumb ';
		}
		
		$return_html.= '">';
		
		$count_post = count($posts);

			foreach($posts as $post)
			{
				$image_thumb = get_post_meta($post->ID, 'blog_thumb_image_url', true);
				$return_html.= '<li>';
				
				if(!empty($show_thumb) && has_post_thumbnail($post->ID, 'thumbnail'))
				{
					$image_id = get_post_thumbnail_id($post->ID);
					$image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
					
					$return_html.= '<div class="post_circle_thumb"><a href="'.get_permalink($post->ID).'"><img src="'.$image_url[0].'" alt="" /></a></div>';
				}
				
				$return_html.= '<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a><div class="post_attribute">'.date_i18n(GRANDCONFERENCE_THEMEDATEFORMAT, get_the_time('U', $post->ID)).'</div>';
				$return_html.= '</li>';

			}	

		$return_html.= '</ul>';

	}
	
	if($echo)
	{
		echo stripslashes($return_html);
	}
	else
	{
		return $return_html;
	}
}

function grandconference_cat_posts($cat_id = '', $items = 5, $echo = TRUE, $show_thumb = TRUE) 
{
	$return_html = '';
	$posts = get_posts('numberposts='.$items.'&order=DESC&orderby=date&category='.$cat_id);
	$title = get_cat_name($cat_id);
	$category_link = get_category_link($cat_id);
	$count_post = count($posts);
	
	if(!empty($posts))
	{

		$return_html.= '<h2 class="widgettitle"><span>'.$title.'</span></h2>';
		$return_html.= '<ul class="posts blog ';
		
		if($show_thumb)
		{
			$return_html.= 'withthumb ';
		}
		
		$return_html.= '">';

			foreach($posts as $key => $post)
			{
				$return_html.= '<li>';
			
				if(!empty($show_thumb) && has_post_thumbnail($post->ID, 'thumbnail'))
				{
					$image_id = get_post_thumbnail_id($post->ID);
					$image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
					
					$return_html.= '<div class="post_circle_thumb"><a href="'.get_permalink($post->ID).'"><img class="alignleft frame post_thumb" src="'.$image_url[0].'" alt="" /></a></div>';
				}
				
				$return_html.= '<a href="'.get_permalink($post->ID).'">'.grandconference_substr($post->post_title, 50).'</a><div class="post_attribute">'.date_i18n(GRANDCONFERENCE_THEMEDATEFORMAT, get_the_time('U', $post->ID)).'</div>';
				$return_html.= '</li>';
			}	

		$return_html.= '</ul>';

	}
	
	if($echo)
	{
		echo stripslashes($return_html);
	}
	else
	{
		return $return_html;
	}
}

function grandconference_image_from_description($data) {
    preg_match_all('/<img src="([^"]*)"([^>]*)>/i', $data, $matches);
    return $matches[1][0];
}


function grandconference_select_image($img, $size) {
    $img = explode('/', $img);
    $filename = array_pop($img);

    // The sizes listed here are the ones Flickr provides by default.  Pass the array index in the

    // 0 for square, 1 for thumb, 2 for small, etc.
    $s = array(
        '_s.', // square
        '_q.', // thumb
        '_m.', // small
        '.',   // medium
        '_b.'  // large
    );

    $img[] = preg_replace('/(_(s|t|m|b))?\./i', $s[$size], $filename);
    return implode('/', $img);
}

function grandconference_get_flickr($settings) 
{
	if (!function_exists('MagpieRSS')) {
	    // Check if another plugin is using RSS, may not work
	    require_once ABSPATH . WPINC . '/class-simplepie.php';
	}
	
	if(!isset($settings['items']) || empty($settings['items']))
	{
		$settings['items'] = 9;
	}
	
	// get the feeds
	if ($settings['type'] == "user") { $rss_url = 'https://api.flickr.com/services/feeds/photos_public.gne?id=' . $settings['id'] . '&per_page='.$settings['items'].'&format=rss_200'; }
	elseif ($settings['type'] == "favorite") { $rss_url = 'https://api.flickr.com/services/feeds/photos_faves.gne?id=' . $settings['id'] . '&format=rss_200'; }
	elseif ($settings['type'] == "set") { $rss_url = 'https://api.flickr.com/services/feeds/photoset.gne?set=' . $settings['set'] . '&nsid=' . $settings['id'] . '&format=rss_200'; }
	elseif ($settings['type'] == "group") { $rss_url = 'https://api.flickr.com/services/feeds/groups_pool.gne?id=' . $settings['id'] . '&format=rss_200'; }
	elseif ($settings['type'] == "public" || $settings['type'] == "community") { $rss_url = 'https://api.flickr.com/services/feeds/photos_public.gne?tags=' . $settings['tags'] . '&format=rss_200'; }
	else {
	    print '<strong>No "type" parameter has been setup. Check your settings, or provide the parameter as an argument.</strong>';
	    die();
	}
	
	$flickr_cache_path = GRANDCONFERENCE_GRANDCONFERENCE_THEMEUPLOAD.'/flickr_'.$settings['id'].'_'.$settings['items'].'.cache';
		
	if(file_exists($flickr_cache_path))
	{
	    $flickr_cache_timer = intval((time()-filemtime($flickr_cache_path))/60);
	}
	else
	{
	    $flickr_cache_timer = 0;
	}
	
	$photos_arr = array();
	
	if(!file_exists($flickr_cache_path) OR $flickr_cache_timer > 15)
	{
		# get rss file
		$feed = new SimplePie();
		$feed->set_feed_url($rss_url);
		$feed->enable_cache(FALSE);
		$feed->init();
		$feed->handle_content_type();
		
		foreach ($feed->get_items() as $key => $item)
		{
			$enclosure = $item->get_enclosure();
			$img = grandconference_image_from_description($item->get_description()); 
			$thumb_url = grandconference_select_image($img, 1);
			$large_url = grandconference_select_image($img, 4);
			
			$photos_arr[] = array(
				'title' => $enclosure->get_title(),
				'thumb_url' => $thumb_url,
				'url' => $large_url,
				'link' => $item->get_link(),
			);
			
			$current = intval($key+1);
			
			if($current == $settings['items'])
			{
				break;
			}
		} 
		
		if(!empty($photos_arr))
		{
			if(file_exists($flickr_cache_path))
			{
			    unlink($flickr_cache_path);
			}
			
			//Writing cache file
			$wp_filesystem = grandconference_get_wp_filesystem();
			$wp_filesystem->put_contents(
			  $flickr_cache_path,
			  serialize($photos_arr)
			);
		}
	}
	else
	{
		$wp_filesystem = grandconference_get_wp_filesystem();
		$file = $wp_filesystem->get_contents($flickr_cache_path);
					
		if(!empty($file))
		{
		    $photos_arr = unserialize($file);			
		}
	}

	return $photos_arr;
}

function grandconference_get_instagram_response_without_token_from_json( $user ) {

    $user = trim( $user );
    $url  = 'https://instagram.com/' .$user.'/?__a=1';

    $request = wp_remote_get( $url );

    if (is_wp_error($request) || 200 != wp_remote_retrieve_response_code($request)) {
        return new WP_Error('instagram error', $request);
    }

    $result = json_decode( wp_remote_retrieve_body( $request ) );

    if ( empty( $result ) ) {
        return new WP_Error('instagram error', 'empty result');
    }

    return $result;
}

function grandconference_get_instagram_response_without_token( $user ) {
	
	$user = trim( $user );
    $url  = 'https://instagram.com/' .$user;

    $request = wp_remote_get( $url );

    if (is_wp_error($request) || 200 != wp_remote_retrieve_response_code($request)) {
        return new WP_Error('instagram error', $request);
    }
    
	$body = wp_remote_retrieve_body( $request );

    $doc = new DOMDocument();

    @$doc->loadHTML( $body );

    $script_tags = $doc->getElementsByTagName( 'script' );

    $json = '';

    foreach ( $script_tags as $script_tag ) {
        if ( strpos( $script_tag->nodeValue, 'window._sharedData = ' ) !== false ) {
            $json = $script_tag->nodeValue;
            break;
        }
    }

    $json   = str_replace( array( 'window._sharedData = ', '};' ), array( '', '}' ), $json );
    $result = json_decode( $json );

    if ( empty( $result ) ) {
        return new WP_Error('instagram error', 'empty result');
    }

    return $result;
}

function grandconference_get_instagram($username, $access_token, $items = 8)
{   
    $wp_filesystem = grandconference_get_wp_filesystem();
	
	$photos_arr = array();

    if(!empty($username))
    {
	    $instagram_cache_path = GRANDCONFERENCE_THEMEUPLOAD.'/instagram_'.$username.'_'.$items.'.cache';
		
		if(file_exists($instagram_cache_path))
		{
		    $instagram_cache_timer = intval((time()-filemtime($instagram_cache_path))/60);
		}
		else
		{
		    $instagram_cache_timer = 0;
		}
		
		$photos_arr = array();
		
		//Check if already update Instagram cache to new API
		$pp_is_update_instagram_grandconference = get_option('pp_is_update_instagram_grandconference');
		
		if(!file_exists($instagram_cache_path) OR $instagram_cache_timer > 300 OR empty($pp_is_update_instagram_grandconference))
		{
			$result = grandconference_get_instagram_response_without_token_from_json($username);
		    $result_photos = $result->graphql->user->edge_owner_to_timeline_media->edges;
		
			if(is_array($result_photos) && !empty($result_photos))
			{
				foreach ($result_photos as $key => $item)
				{
					$small_thumb_url = $item->node->thumbnail_resources[0]->src;
					$thumb_url = $item->node->thumbnail_resources[3]->src;
					$large_url = $item->node->thumbnail_resources[4]->src;
					
					$photos_arr[] = array(
						'thumb_url' => $thumb_url,
						'url' => $large_url,
						'link' => 'https://instagram.com/p/'.$item->node->shortcode,
					);
					
					if(($key+1) == $items)
					{
						break;
					}
				} 
			}
			
			if(!empty($photos_arr))
			{
				if(file_exists($instagram_cache_path))
				{
				    unlink($instagram_cache_path);
				}
				
				if(grandconference_connect_fs())
				{
					//Writing cache file
					$wp_filesystem->put_contents(
					  $instagram_cache_path,
					  serialize($photos_arr)
					);
				}
				else
				{
					file_put_contents($instagram_cache_path, serialize($photos_arr));
				}
				
				if(empty($pp_is_update_instagram_grandconference))
				{
					//updated Instagram cache to new API
					update_option('pp_is_update_instagram_grandconference', 1);
				}
			}
			else
			{
				if(grandconference_connect_fs())
				{
					$file = $wp_filesystem->get_contents($instagram_cache_path);
				}
				else
				{
					$file = file_get_contents($instagram_cache_path);
				}
					
				if(!empty($file))
				{
				    $photos_arr = unserialize($file);			
				}
			}
		}
		else
		{
			if(grandconference_connect_fs())
			{
				$file = $wp_filesystem->get_contents($instagram_cache_path);
			}
			else
			{
				$file = file_get_contents($instagram_cache_path);
			}
		
			if(!empty($file))
			{
			    $photos_arr = unserialize($file);
			}
		}
    } 
    else 
    {
    	echo 'Invalid username and access token';
    }
    
    return $photos_arr;
}

function grandconference_connect_fs()
{
  $wp_filesystem = grandconference_get_wp_filesystem();

  if( false === ($credentials = request_filesystem_credentials('')) ) 
  {
    return false;
  }

  //check if credentials are correct or not.
  if(!WP_Filesystem($credentials)) 
  { 
    request_filesystem_credentials('');
    return false;
  }

  return true;
}

function grandconference_get_browser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    }
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    }
    else
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    }
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    
    // see how many we have
    if(isset($matches['browser']))
    {
    	$i = count($matches['browser']);
    }
    else
    {
	    $i = 0;
	    $matches['version'] = 1;
    }
    if ($i != 1) {
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        elseif(isset($matches['version'][1])) {
            $version= $matches['version'][1];
        }
        else
        {
	        $version = 11;
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}

function grandconference_auto_link_twitter($tweet)
{
    //Convert urls to <a> links
	$tweet = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $tweet);

	//Convert hashtags to twitter searches in <a> links
	$tweet = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a target=\"_new\" href=\"http://twitter.com/search?q=$1\">#$1</a>", $tweet);

	//Convert attags to twitter profiles in <a> links
	$tweet = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a href=\"http://www.twitter.com/$1\">@$1</a>", $tweet);

	return $tweet;
}

if(!function_exists('grandconference_resort_gallery_img'))
{
	function grandconference_resort_gallery_img($all_photo_arr)
	{
		$sorted_all_photo_arr = array();
		$tg_gallery_sort = get_theme_mod('tg_gallery_sort', 'drag');
	
		if(!empty($tg_gallery_sort) && !empty($all_photo_arr))
		{
			switch($tg_gallery_sort)
			{
				case 'drag':
				default:
					foreach($all_photo_arr as $key => $gallery_img)
					{
						$sorted_all_photo_arr[$key] = $gallery_img;
					}
				break;
				case 'post_date':
					foreach($all_photo_arr as $key => $gallery_img)
					{
						$gallery_img_meta = get_post($gallery_img);
						$gallery_img_date = strtotime($gallery_img_meta->post_date);
						
						$sorted_all_photo_arr[$gallery_img_date] = $gallery_img;
						krsort($sorted_all_photo_arr);
					}
				break;
				
				case 'post_date_old':
					foreach($all_photo_arr as $key => $gallery_img)
					{
						$gallery_img_meta = get_post($gallery_img);
						$gallery_img_date = strtotime($gallery_img_meta->post_date);
						
						$sorted_all_photo_arr[$gallery_img_date] = $gallery_img;
						ksort($sorted_all_photo_arr);
					}
				break;
				
				case 'rand':
					shuffle($all_photo_arr);
					$sorted_all_photo_arr = $all_photo_arr;
				break;
				
				case 'title':
					foreach($all_photo_arr as $key => $gallery_img)
					{
						$gallery_img_meta = get_post($gallery_img);
						$gallery_img_title = $gallery_img_meta->post_title;
						if(empty($gallery_img_title) OR is_null($gallery_img_title))
						{
							$gallery_img_title = $gallery_img_meta->ID;
						}
						
						if(!isset($sorted_all_photo_arr[$gallery_img_title]))
						{
							$sorted_all_photo_arr[$gallery_img_title] = $gallery_img;	
						}
						else
						{
							$sorted_all_photo_arr[$gallery_img_title.$gallery_img_meta->ID] = $gallery_img;
						}
						
						ksort($sorted_all_photo_arr);
					}
				break;
			}
			
			return $sorted_all_photo_arr;
		}
		else
		{
			return array();
		}
	}
}

function grandconference_apply_content($pp_content) {
	$pp_content = apply_filters('the_content', $pp_content);
    $pp_content = str_replace(']]>', ']]>', $pp_content);
    
    return $pp_content;
}

function grandconference_apply_builder($page_id, $post_type = 'page', $print = TRUE) 
{
	$ppb_form_data_order = get_post_meta($page_id, 'ppb_form_data_order');
	$ppb_page_content = '';
	
	if(isset($ppb_form_data_order[0]))
	{
	    $ppb_form_item_arr = explode(',', $ppb_form_data_order[0]);
	}
	
	$ppb_shortcodes = array();
	
	require_once get_template_directory() . "/lib/contentbuilder.shortcode.lib.php";
	
	if(isset($ppb_form_item_arr[0]) && !empty($ppb_form_item_arr[0]))
	{
	    $ppb_shortcode_code = '';
	
	    foreach($ppb_form_item_arr as $key => $ppb_form_item)
	    {
	    	$ppb_form_item_data = get_post_meta($page_id, $ppb_form_item.'_data');
	    	$ppb_form_item_size = get_post_meta($page_id, $ppb_form_item.'_size');
	    	$ppb_form_item_data_obj = json_decode($ppb_form_item_data[0]);
	    	$ppb_shortcode_content_name = $ppb_form_item_data_obj->shortcode.'_content';
	    	
	    	if(isset($ppb_form_item_data_obj->$ppb_shortcode_content_name))
	    	{
	    		$ppb_shortcode_code = '['.$ppb_form_item_data_obj->shortcode.' size="'.$ppb_form_item_size[0].'" ';
	    		
	    		//Get shortcode title
	    		$ppb_shortcode_title_name = $ppb_form_item_data_obj->shortcode.'_title';
	    		if(isset($ppb_form_item_data_obj->$ppb_shortcode_title_name))
	    		{
	    			$ppb_shortcode_code.= 'title="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_title_name), ENT_QUOTES, "UTF-8").'" ';
	    		}
	    		
	    		//Get shortcode attributes
	    		if(isset($ppb_shortcodes[$ppb_form_item_data_obj->shortcode]))
	    		{
		    		$ppb_shortcode_arr = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode];
		    		
		    		foreach($ppb_shortcode_arr['attr'] as $attr_name => $attr_item)
		    		{
		    			$ppb_shortcode_attr_name = $ppb_form_item_data_obj->shortcode.'_'.$attr_name;
		    			
		    			if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_name))
		    			{
		    				if(!is_array($ppb_form_item_data_obj->$ppb_shortcode_attr_name))
		    				{
		    					$ppb_shortcode_code.= $attr_name.'="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_name)).'" ';
		    				}
		    				else
		    				{
		    					$shortcode_attr_val_str = '';
		    					$i = 0;
		    					$len = count($ppb_form_item_data_obj->$ppb_shortcode_attr_name);
		    					
			    				foreach($ppb_form_item_data_obj->$ppb_shortcode_attr_name as $key => $shortcode_attr_val)
			    				{
				    				$shortcode_attr_val_str.= $shortcode_attr_val;
				    				
				    				if ($i != $len - 1) 
				    				{
				    					$shortcode_attr_val_str.= ',';
				    				}
				    				
				    				$i++;
			    				}
			    				
			    				$ppb_shortcode_code.= $attr_name.'="'.esc_attr(rawurldecode($shortcode_attr_val_str)).'" ';
		    				}
		    			}
		    			elseif($attr_name == 'margin')
		    			{
		    				$ppb_shortcode_attr_margin_top = $ppb_form_item_data_obj->shortcode.'_'.$attr_name.'_top';
		    				
		    				if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_top))
							{
			    				$ppb_shortcode_code.= $attr_name.'_top="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_top)).'" ';
			    			}
			    			
			    			$ppb_shortcode_attr_margin_right = $ppb_form_item_data_obj->shortcode.'_'.$attr_name.'_right';
			    			
			    			if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_right))
							{
			    				$ppb_shortcode_code.= $attr_name.'_right="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_right)).'" ';
			    			}
			    			
			    			$ppb_shortcode_attr_margin_bottom = $ppb_form_item_data_obj->shortcode.'_'.$attr_name.'_bottom';
			    			
			    			if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_bottom))
							{
			    				$ppb_shortcode_code.= $attr_name.'_bottom="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_bottom)).'" ';
			    			}
			    			
			    			$ppb_shortcode_attr_margin_left = $ppb_form_item_data_obj->shortcode.'_'.$attr_name.'_left';
			    			
			    			if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_left))
							{
			    				$ppb_shortcode_code.= $attr_name.'_left="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_left)).'" ';
			    			}
		    			}
		    		}
		    	}

	    		$ppb_shortcode_code.= ']'.rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_content_name).'[/'.$ppb_form_item_data_obj->shortcode.']';
	    	}
	    	else if(isset($ppb_shortcodes[$ppb_form_item_data_obj->shortcode]))
	    	{
	    		$ppb_shortcode_code = '['.$ppb_form_item_data_obj->shortcode.' size="'.$ppb_form_item_size[0].'" ';
	    		
	    		//Get shortcode title
	    		$ppb_shortcode_title_name = $ppb_form_item_data_obj->shortcode.'_title';
	    		if(isset($ppb_form_item_data_obj->$ppb_shortcode_title_name))
	    		{
	    			$ppb_shortcode_code.= 'title="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_title_name), ENT_QUOTES, "UTF-8").'" ';
	    		}
	    		
	    		//Get shortcode attributes
	    		if(isset($ppb_shortcodes[$ppb_form_item_data_obj->shortcode]))
	    		{
		    		$ppb_shortcode_arr = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode];
		    		
		    		foreach($ppb_shortcode_arr['attr'] as $attr_name => $attr_item)
		    		{
		    			$ppb_shortcode_attr_name = $ppb_form_item_data_obj->shortcode.'_'.$attr_name;
		    			
		    			if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_name))
		    			{
		    				if(!is_array($ppb_form_item_data_obj->$ppb_shortcode_attr_name))
		    				{
		    					$ppb_shortcode_code.= $attr_name.'="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_name)).'" ';
		    				}
		    				else
		    				{
		    					$shortcode_attr_val_str = '';
		    					$i = 0;
		    					$len = count($ppb_form_item_data_obj->$ppb_shortcode_attr_name);
		    					
			    				foreach($ppb_form_item_data_obj->$ppb_shortcode_attr_name as $key => $shortcode_attr_val)
			    				{
				    				$shortcode_attr_val_str.= $shortcode_attr_val;
				    				
				    				if ($i != $len - 1) 
				    				{
				    					$shortcode_attr_val_str.= ',';
				    				}
				    				
				    				$i++;
			    				}
			    				
			    				$ppb_shortcode_code.= $attr_name.'="'.esc_attr(rawurldecode($shortcode_attr_val_str)).'" ';
		    				}
		    			}
		    			elseif($attr_name == 'margin')
		    			{
		    				$ppb_shortcode_attr_margin_top = $ppb_form_item_data_obj->shortcode.'_'.$attr_name.'_top';
		    				
		    				if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_top))
							{
			    				$ppb_shortcode_code.= $attr_name.'_top="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_top)).'" ';
			    			}
			    			
			    			$ppb_shortcode_attr_margin_right = $ppb_form_item_data_obj->shortcode.'_'.$attr_name.'_right';
			    			
			    			if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_right))
							{
			    				$ppb_shortcode_code.= $attr_name.'_right="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_right)).'" ';
			    			}
			    			
			    			$ppb_shortcode_attr_margin_bottom = $ppb_form_item_data_obj->shortcode.'_'.$attr_name.'_bottom';
			    			
			    			if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_bottom))
							{
			    				$ppb_shortcode_code.= $attr_name.'_bottom="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_bottom)).'" ';
			    			}
			    			
			    			$ppb_shortcode_attr_margin_left = $ppb_form_item_data_obj->shortcode.'_'.$attr_name.'_left';
			    			
			    			if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_left))
							{
			    				$ppb_shortcode_code.= $attr_name.'_left="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_margin_left)).'" ';
			    			}
		    			}
		    		}
		    	}
	    		
	    		$ppb_shortcode_code.= ']';
	    	}
	    	
	    	if($print)
	    	{
	    		echo grandconference_apply_content($ppb_shortcode_code);
	    	}
	    	else
	    	{
		    	$ppb_page_content.= grandconference_apply_content($ppb_shortcode_code);
	    	}
        }
    }

    if(!$print)
    {
    	return $ppb_page_content;
    }
    	
}

function grandconference_get_excerpt_by_id($post_id)
{
	$the_post = get_post($post_id); //Gets post ID
	if(!empty($the_post->post_excerpt))
	{
		$the_excerpt = $the_post->post_excerpt;
	}
	else
	{
		$the_excerpt = $the_post->post_content;
	}
	
	$excerpt_length = 35; //Sets excerpt length by word count
	$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
	$words = explode(' ', $the_excerpt, $excerpt_length + 1);
	if(count($words) > $excerpt_length) :
	array_pop($words);
	array_push($words, '…');
	$the_excerpt = implode(' ', $words);
	endif;
	$the_excerpt = '<p>' . $the_excerpt . '</p>';
	return $the_excerpt;
}

if(!function_exists('grandconference_get_image_id'))
{
	function grandconference_get_image_id($url) 
	{
		$attachment_id = attachment_url_to_postid($url);
		
		if(!empty($attachment_id))
		{
			return $attachment_id;
		}
		else
		{
			return $url;
		}
	}
}

function grandconference_aasort(&$array, $key) 
{
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}

if(!function_exists('get_dynamic_sidebar'))
{
	function get_dynamic_sidebar($index = 1)
	{
		$sidebar_contents = "";
		ob_start();
		dynamic_sidebar($index);
		$sidebar_contents = ob_get_clean();
		return $sidebar_contents;
	}
}

function grandconference_update_urls($options,$oldurl,$newurl)
{	
	$wpdb = grandconference_get_wpdb();
	$results = array();
	$queries = array(
	'content' =>		array("UPDATE $wpdb->posts SET post_content = replace(post_content, %s, %s)",  esc_html__('Content Items (Posts, Pages, Custom Post Types, Revisions)','grandconference') ),
	'excerpts' =>		array("UPDATE $wpdb->posts SET post_excerpt = replace(post_excerpt, %s, %s)", esc_html__('Excerpts','grandconference') ),
	'attachments' =>	array("UPDATE $wpdb->posts SET guid = replace(guid, %s, %s) WHERE post_type = 'attachment'",  esc_html__('Attachments','grandconference') ),
	'links' =>			array("UPDATE $wpdb->links SET link_url = replace(link_url, %s, %s)", esc_html__('Links','grandconference') ),
	'custom' =>			array("UPDATE $wpdb->postmeta SET meta_value = replace(meta_value, %s, %s)",  esc_html__('Custom Fields','grandconference') ),
	'guids' =>			array("UPDATE $wpdb->posts SET guid = replace(guid, %s, %s)",  esc_html__('GUIDs','grandconference') )
	);

	foreach($options as $option){
	    if( $option == 'custom' ){
	    	$n = 0;
	    	$row_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->postmeta" );
	    	$page_size = 10000;
	    	$pages = ceil( $row_count / $page_size );
	    	
	    	for( $page = 0; $page < $pages; $page++ ) {
	    		$current_row = 0;
	    		$start = $page * $page_size;
	    		$end = $start + $page_size;
	    		$pmquery = "SELECT * FROM $wpdb->postmeta WHERE meta_value <> ''";
	    		$items = $wpdb->get_results( $pmquery );
	    		foreach( $items as $item ){
	    		$value = $item->meta_value;
	    		if( trim($value) == '' )
	    			continue;
	    		
	    			$edited = grandconference_unserialize_replace( $oldurl, $newurl, $value );
	    		
	    			if( $edited != $value ){
	    				$fix = $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_value = %s WHERE meta_id = %s", $edited, $item->meta_id) );
	    				if( $fix )
	    					$n++;
	    			}
	    		}
	    	}
	    	$results[$option] = array($n, $queries[$option][1]);
	    }
	    else{
	    	$result = $wpdb->query( $wpdb->prepare( $queries[$option][0], $oldurl, $newurl) );
	    	$results[$option] = array($result, $queries[$option][1]);
	    }
	}
	return $results;			
}


function grandconference_unserialize_replace( $from = '', $to = '', $data = '', $serialised = false ) 
{
    try {
    	if ( is_string( $data ) && ( $unserialized = @unserialize( $data ) ) !== false ) {
    		$data = grandconference_unserialize_replace( $from, $to, $unserialized, true );
    	}
    	elseif ( is_array( $data ) ) {
    		$_tmp = array( );
    		foreach ( $data as $key => $value ) {
    			$_tmp[ $key ] = grandconference_unserialize_replace( $from, $to, $value, false );
    		}
    		$data = $_tmp;
    		unset( $_tmp );
    	}
    	else {
    		if ( is_string( $data ) )
    			$data = str_replace( $from, $to, $data );
    	}
    	if ( $serialised )
    		return serialize( $data );
    } catch( Exception $error ) {
    }
    return $data;
}

function grandconference_get_first_title_word($title) {
	return $title;
}

function grandconference_menu_layout() {
	$tg_menu_layout = get_theme_mod('tg_menu_layout', 'leftalign');
	if(GRANDCONFERENCE_THEMEDEMO && isset($_GET['menulayout']) && !empty($_GET['menulayout']))
	{
		$tg_menu_layout = $_GET['menulayout'];
	}
	
	return $tg_menu_layout;
}

/**
* grandconference_is_woocommerce_page - Returns true if on a page which uses WooCommerce templates (cart and checkout are standard pages with shortcodes and which are also included)
*
* @access public
* @return bool
*/
function grandconference_is_woocommerce_page() 
{
	if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
	        return true;
	}
	$woocommerce_keys   =   array ( "woocommerce_shop_page_id") ;
	foreach ( $woocommerce_keys as $wc_page_id ) {
	        if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
	                return true ;
	        }
	}
	return false;
}

function grandconference_check_system()
{
	$has_error = 0;
	$return_html = '<div class="tg_system_status_wrapper">';
	
	$return_html.= '<h4>System Status</h4><br/>';

	//Get max_execution_time
	$max_execution_time = ini_get('max_execution_time');
	$max_execution_time_class = '';
	$max_execution_time_text = '';
	if($max_execution_time < 180)
	{
		$max_execution_time_class = 'tg_error';
		$has_error = 1;
		$max_execution_time_text = '*RECOMMENDED 180';
	}
	$return_html.= '<div class="'.$max_execution_time_class.'">max_execution_time: '.$max_execution_time.' '.$max_execution_time_text.'</div>';
	
	//Get memory_limit
	$memory_limit = ini_get('memory_limit');
	$memory_limit_class = '';
	$memory_limit_text = '';
	if(intval($memory_limit) < 128)
	{
		$memory_limit_class = 'tg_error';
		$has_error = 1;
		$memory_limit_text = '*RECOMMENDED 128M';
	}
	$return_html.= '<div class="'.$memory_limit_class.'">memory_limit: '.$memory_limit.' '.$memory_limit_text.'</div>';
	
	//Get post_max_size
	$post_max_size = ini_get('post_max_size');
	$post_max_size_class = '';
	$post_max_size_text = '';
	if(intval($post_max_size) < 32)
	{
		$post_max_size_class = 'tg_error';
		$has_error = 1;
		$post_max_size_text = '*RECOMMENDED 32M';
	}
	$return_html.= '<div class="'.$post_max_size_class.'">post_max_size: '.$post_max_size.' '.$post_max_size_text.'</div>';
	
	//Get upload_max_filesize
	$upload_max_filesize = ini_get('upload_max_filesize');
	$upload_max_filesize_class = '';
	$upload_max_filesize_text = '';
	if(intval($upload_max_filesize) < 32)
	{
		$upload_max_filesize_class = 'tg_error';
		$has_error = 1;
		$upload_max_filesize_text = '*RECOMMENDED 32M';
	}
	$return_html.= '<div class="'.$upload_max_filesize_class.'">upload_max_filesize: '.$upload_max_filesize.' '.$upload_max_filesize_text.'</div>';
	
	//Get max_input_vars
	$max_input_vars = ini_get('max_input_vars');
	$max_input_vars_class = '';
	$max_input_vars_text = '';
	if(intval($max_input_vars) < 2000)
	{
		$max_input_vars_class = 'tg_error';
		$has_error = 1;
		$max_input_vars_text = '*RECOMMENDED 2000';
	}
	$return_html.= '<div class="'.$max_input_vars_class.'">max_input_vars: '.$max_input_vars.' '.$max_input_vars_text.'</div>';
	
	if(!empty($has_error))
	{
		$return_html.= '<br/><hr/>We are sorry, the demo data could not import properly. It most likely due to PHP configurations on your server. Please fix configuration in System Status which are reported in <span class="tg_error">RED</span>';
	}
	
	$return_html.= '</div>' ;
	
	return $return_html;
}

function grandconference_hex_darker($rgb, $darker=2)
{
    $hash = (strpos($rgb, '#') !== false) ? '#' : '';
    $rgb = (strlen($rgb) == 7) ? str_replace('#', '', $rgb) : ((strlen($rgb) == 6) ? $rgb : false);
    if(strlen($rgb) != 6) return $hash.'000000';
    $darker = ($darker > 1) ? $darker : 1;

    list($R16,$G16,$B16) = str_split($rgb,2);

    $R = sprintf("%02X", floor(hexdec($R16)/$darker));
    $G = sprintf("%02X", floor(hexdec($G16)/$darker));
    $B = sprintf("%02X", floor(hexdec($B16)/$darker));

    return $hash.$R.$G.$B;     
}

function grandconference_get_dynamic_sidebar($index = 1)
{
    $sidebar_contents = "";
    ob_start();
    dynamic_sidebar($index);
    $sidebar_contents = ob_get_clean();
    return $sidebar_contents;
}

function grandconference_hex_to_rgb($hex) 
{
	$hex = str_replace("#", "", $hex);
	$color = array();
	
	if(strlen($hex) == 3) {
	    $color['r'] = hexdec(substr($hex, 0, 1) . $r);
	    $color['g'] = hexdec(substr($hex, 1, 1) . $g);
	    $color['b'] = hexdec(substr($hex, 2, 1) . $b);
	}
	else if(strlen($hex) == 6) {
	    $color['r'] = hexdec(substr($hex, 0, 2));
	    $color['g'] = hexdec(substr($hex, 2, 2));
	    $color['b'] = hexdec(substr($hex, 4, 2));
	}
	
	return $color;
}

function grandconference_available_widgets() 
{
	$wp_registered_widget_controls = grandconference_get_registered_widget_controls();

	$widget_controls = $wp_registered_widget_controls;

	$available_widgets = array();

	foreach ( $widget_controls as $widget ) {

		if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes

			$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
			$available_widgets[$widget['id_base']]['name'] = $widget['name'];

		}

	}

	return $available_widgets;
}

function grandconference_import_data( $data ) 
{
	$wp_registered_sidebars = grandconference_get_registered_sidebars();

	// Have valid data?
	// If no data or could not decode
	if ( empty( $data ) || ! is_object( $data ) ) {
		wp_die(
			esc_html__('Import data could not be read. Please try a different file.', 'grandconference' ),
			'',
			array( 'back_link' => true )
		);
	}

	// Get all available widgets site supports
	$available_widgets = grandconference_available_widgets();

	// Get all existing widget instances
	$widget_instances = array();
	foreach ( $available_widgets as $widget_data ) {
		$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
	}

	// Begin results
	$results = array();

	// Loop import data's sidebars
	foreach ( $data as $sidebar_id => $widgets ) {

		// Skip inactive widgets
		// (should not be in export file)
		if ( 'wp_inactive_widgets' == $sidebar_id ) {
			continue;
		}

		// Check if sidebar is available on this site
		// Otherwise add widgets to inactive, and say so
		if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
			$sidebar_available = true;
			$use_sidebar_id = $sidebar_id;
			$sidebar_message_type = 'success';
			$sidebar_message = '';
		} else {
			$sidebar_available = false;
			$use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
			$sidebar_message_type = 'error';
			$sidebar_message = esc_html__('Sidebar does not exist in theme (using Inactive)', 'grandconference' );
		}

		// Result for sidebar
		$results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
		$results[$sidebar_id]['message_type'] = $sidebar_message_type;
		$results[$sidebar_id]['message'] = $sidebar_message;
		$results[$sidebar_id]['widgets'] = array();

		// Loop widgets
		foreach ( $widgets as $widget_instance_id => $widget ) {

			$fail = false;

			// Get id_base (remove -# from end) and instance ID number
			$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
			$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

			// Does site support this widget?
			if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
				$fail = true;
				$widget_message_type = 'error';
				$widget_message = esc_html__('Site does not support widget', 'grandconference' ); // explain why widget not imported
			}

			// Filter to modify settings object before conversion to array and import
			// Leave this filter here for backwards compatibility with manipulating objects (before conversion to array below)
			// Ideally the newer wie_widget_settings_array below will be used instead of this
			$widget = apply_filters( 'wie_widget_settings', $widget ); // object

			// Convert multidimensional objects to multidimensional arrays
			// Some plugins like Jetpack Widget Visibility store settings as multidimensional arrays
			// Without this, they are imported as objects and cause fatal error on Widgets page
			// If this creates problems for plugins that do actually intend settings in objects then may need to consider other approach: https://wordpress.org/support/topic/problem-with-array-of-arrays
			// It is probably much more likely that arrays are used than objects, however
			$widget = json_decode( json_encode( $widget ), true );

			// Does widget with identical settings already exist in same sidebar?
			if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

				// Get existing widgets in this sidebar
				$sidebars_widgets = get_option( 'sidebars_widgets' );
				$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

				// Loop widgets with ID base
				$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
				foreach ( $single_widget_instances as $check_id => $check_widget ) {

					// Is widget in same sidebar and has identical settings?
					if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {

						$fail = true;
						$widget_message_type = 'warning';
						$widget_message = esc_html__('Widget already exists', 'grandconference' ); // explain why widget not imported

						break;

					}

				}

			}

			// No failure
			if ( ! $fail ) {

				// Add widget instance
				$single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
				$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
				$single_widget_instances[] = $widget; // add it

					// Get the key it was given
					end( $single_widget_instances );
					$new_instance_id_number = key( $single_widget_instances );

					// If key is 0, make it 1
					// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
					if ( '0' === strval( $new_instance_id_number ) ) {
						$new_instance_id_number = 1;
						$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
						unset( $single_widget_instances[0] );
					}

					// Move _multiwidget to end of array for uniformity
					if ( isset( $single_widget_instances['_multiwidget'] ) ) {
						$multiwidget = $single_widget_instances['_multiwidget'];
						unset( $single_widget_instances['_multiwidget'] );
						$single_widget_instances['_multiwidget'] = $multiwidget;
					}

					// Update option with new widget
					update_option( 'widget_' . $id_base, $single_widget_instances );

				// Assign widget instance to sidebar
				$sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
				$new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
				$sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
				update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

				// Success message
				if ( $sidebar_available ) {
					$widget_message_type = 'success';
					$widget_message = esc_html__('Imported', 'grandconference' );
				} else {
					$widget_message_type = 'warning';
					$widget_message = esc_html__('Imported to Inactive', 'grandconference' );
				}

			}

			// Result for widget instance
			$results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
			$results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = ! empty( $widget['title'] ) ? $widget['title'] : esc_html__('No Title', 'grandconference' ); // show "No Title" if widget instance is untitled
			$results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
			$results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;

		}

	}

	// Return results
	return $results;
}

function grandconference_count_client_images($client_id = '')
{
	if(!empty($client_id))
	{
		$images_counter = 0;
		$client_galleries = get_post_meta($client_id, 'client_galleries', true);
		
		if(is_array($client_galleries) && !empty($client_galleries))
		{
			foreach($client_galleries as $gallery_id)
			{
				$all_photo_arr = get_post_meta($gallery_id, 'wpsimplegallery_gallery', true);
				$images_counter += intval(count($all_photo_arr));
			}
		}
		
		return intval($images_counter);
	}
	else
	{
		return 0;
	}
}

function grandconference_set_map_api()
{
	//Get Google Map API Key
	$pp_googlemap_api_key = get_option('pp_googlemap_api_key');
	
	if(empty($pp_googlemap_api_key))
	{
		wp_enqueue_script("google_maps", "https://maps.googleapis.com/maps/api/js", false, GRANDCONFERENCE_THEMEVERSION, true);
	}
	else
	{
		wp_enqueue_script("google_maps", "https://maps.googleapis.com/maps/api/js?key=".$pp_googlemap_api_key, false, GRANDCONFERENCE_THEMEVERSION, true);
	}
}

function grandconference_live_builder_begin_wrapper($item_id = '', $item_type = '')
{
	//Check if live content builder mode
	if(isset($_GET['ppb_live']) && !empty($item_id))
	{
		$return_html = '<div id="live_'.esc_attr($item_id).'" class="ppb_live_edit_wrapper '.esc_attr($item_type).'">';
		$return_html.= '<div class="ppb_live_action">';
		
		if(empty($item_type) OR $item_type != 'ppb_divider')
		{
			$return_html.= '<a href="javascript:;" class="ppb_add_after" data-builder-id="'.esc_attr($item_id).'" title="'.esc_html__('Add Content After This', 'grandconference' ).'"><i class="fa fa-plus"></i></a>';
		
			$return_html.= '<a href="javascript:;" class="ppb_edit" data-builder-id="'.esc_attr($item_id).'" title="'.esc_html__('Edit', 'grandconference' ).'"><i class="fa fa-edit"></i></a>';
			
			$return_html.= '<a href="javascript:;" class="ppb_duplicate" data-builder-id="'.esc_attr($item_id).'" title="'.esc_html__('Duplicate', 'grandconference' ).'"><i class="fa fa-copy"></i></a>';
		}
		
		$return_html.= '<a href="javascript:;" class="ppb_remove" data-builder-id="'.esc_attr($item_id).'" title="'.esc_html__('Remove', 'grandconference' ).'"><i class="fa fa-trash"></i></a>';
		
		$return_html.= '</div>';
		
	    return $return_html;
	}
	else
	{
		return '';
	}
}

function grandconference_live_builder_end_wrapper($item_id = '')
{
	//Check if live content builder mode
	if(isset($_GET['ppb_live']) && !empty($item_id))
	{
	    return '</div>';
	}
	else
	{
		return '';
	}
}

function grandconference_get_post_view($post_id = '', $raw = false)
{
	if(!empty($post_id) && function_exists('pvc_get_post_views'))
	{
		if($raw)
		{
			if(GRANDCONFERENCE_THEMEDEMO)
			{
				$number_view_format = 544;
			}
			else
			{
				$number_view_format = pvc_get_post_views($post_id);
			}
			
			return $number_view_format;
		}
		else
		{
			if(GRANDCONFERENCE_THEMEDEMO)
			{
				$number_view_format = '3K';
			}
			else
			{
				$number_view = pvc_get_post_views($post_id);
				
				$precision = 1;
				if ($number_view >= 1000 && $number_view < 1000000) 
				{
				    $number_view_format = number_format($number_view/1000,$precision).'K';
				} 
				else if ($number_view >= 1000000) 
				{
				    $number_view_format = number_format($number_view/1000000,$precision).'M';
				}
				else
				{
				    $number_view_format = $number_view;
				}
			}
		}
		
		return $number_view_format;
	}
	else
	{
		return 0;
	}
}

function grandconference_get_post_share($post_id = '', $raw = false)
{
	if($raw)
	{
		if(function_exists('pssc_all'))
		{
		    if(GRANDCONFERENCE_THEMEDEMO)
		    {
		    	$number_share_format = 1200;
		    }
		    else
		    {
		    	$number_share_format = pssc_all($post_id);
		    }
		}
		else
		{
			$number_share_format = 0;
		}
	    
	    return $number_share_format;
	}
	else
	{
		if(GRANDCONFERENCE_THEMEDEMO)
		{
			$number_share = 1200;
			$precision = 1;
			
			if ($number_share >= 1000 && $number_share < 1000000) 
			{
			    $number_share_format = number_format($number_share/1000,$precision).'K';
			} 
			else if ($number_share >= 1000000) 
			{
			    $number_share_format = number_format($number_share/1000000,$precision).'M';
			}
			return $number_share_format;
		}
		else
		{	
			if(!empty($post_id) && function_exists('pssc_all'))
			{
				$number_share = pssc_all($post_id);
				$precision = 1;
				
				if ($number_share >= 1000 && $number_share < 1000000) 
				{
			    	$number_share_format = number_format($number_share/1000,$precision).'K';
			    } 
			    else if ($number_share >= 1000000) 
			    {
			    	$number_share_format = number_format($number_share/1000000,$precision).'M';
			    }
			    else
			    {
				    $number_share_format = $number_share;
			    }
			    return $number_share_format;
			}
			else
			{
				return 0;
			}
		}
	}
}

function grandconference_get_demo_url($domain = 'grandconference', $path = '')
{
	$demo_url = 'https://'.$domain.'.themegoods.com/'.$path;
	return $demo_url;
}

function grandconference_themegoods_action() 
{
	if(defined('THEMEGOODS') && THEMEGOODS)
	{
		update_option("pp_verified_envato_grandconference", true);
		update_option("pp_envato_personal_token", '[ThemeGoods Activation]');
	}
}

if(!function_exists('grandconference_is_registered'))
{
	function grandconference_is_registered() {
		$grandconference_is_registered = get_option("envato_purchase_code_".ENVATOITEMID);
		
		if(!empty($grandconference_is_registered)) {
			return $grandconference_is_registered;
		}
		else {
			return false;
		}
	}
}

function grandconference_register_theme($purchase_code = '') {
	if(!empty($purchase_code)) {
		$update_result = update_option("envato_purchase_code_".ENVATOITEMID, $purchase_code);
		
		//If register successfully
		if($update_result) {
			$admin_email = get_option('admin_email');
			$to = $admin_email;
			$subject = '[ThemeGoods] your purchase code '.$purchase_code.' is registered';
			$message = 'Purchase Code: '.$purchase_code.'<br/>';
			
			if(!empty($registered_domain)) {
				$message.= 'Domain: '.$registered_domain.'<br/><br/>';
				$message.= 'In case you want to remove/change registered domain. Please register your account here https://license.themegoods.com/manager/
				<br/><br/>
				Then you will be able to manage/remove your purchase code registration\'s domain from there.';
			}
			
			$headers = array('Content-Type: text/html; charset=UTF-8');
			$mail_result = wp_mail($to, $subject, $message, $headers);
			
			delete_option("envato_purchase_code_".ENVATOITEMID."_removed", true);
		}
		
		return $update_result;
	}
	else {
		return false;
	}
}

function grandconference_unregister_theme() {
	$result = delete_option("envato_purchase_code_".ENVATOITEMID);
	
	//Flag option to display unregister notice message
	update_option("envato_purchase_code_".ENVATOITEMID."_removed", true);
	
	return $result;
}

function grandconference_starts_with($haystack, $needle) 
{
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

function grandconference_check_instagram_authorization() {
	
	//Check if Instagram plugin is installed	
	$instagram_widget_settings_notice = '';
	$meks_easy_instagram_widget = 'meks-easy-instagram-widget/meks-easy-instagram-widget.php';
	$meks_easy_instagram_widget_activated = is_plugin_active($meks_easy_instagram_widget);
	
	if(!$meks_easy_instagram_widget_activated)
	{
		$instagram_widget_settings_notice = 'Required plugin "Meks Easy Photo Feed Widget" is required. <a href="'.admin_url("themes.php?page=install-required-plugins").'">Please install the plugin here</a>. or read more detailed instruction about <a href="https://themes.themegoods.com/grandconference/doc/instagram-api-setup/" target="_blank">How to setup the plugin here</a>';
	}
	else
	{
		//Verify Instagram API aurthorization
		$instagram_widget_settings = get_option('meks_instagram_settings');
		
		if(empty($instagram_widget_settings))
		{
			$instagram_widget_settings_notice = 'Please authorize with your Instagram account <a href="'.admin_url("options-general.php?page=meks-instagram").'">here</a>';
		}
		else
		{
			$instagram_widget_settings_notice = true;
		}
	}
	
	return $instagram_widget_settings_notice;
}

function grandconference_get_instagram_using_plugin($cache_prefix = 'photostream', $limit = 30) {
	
	$photos_arr = array();
	
	//Get Instagram settings from plugin
	$meks_instagram_settings = get_option('meks_instagram_settings');
	
	delete_option('grandconference_'.$cache_prefix.$limit);
	
	//Get Instagram cached data
	$instagram_cache_data = get_option('grandconference_'.$meks_instagram_settings['user_id'].$limit);
	
	/*print '<pre>';
	var_dump($instagram_cache_data['data']);
	print '</pre>';*/
	
	
	$instagram_cache_timer = 300;
	
	if(!empty($instagram_cache_data) && !empty($instagram_cache_data['time']))
	{
		$instagram_cache_timer = time() - $instagram_cache_data['time'];
	}
	
	//var_dump($instagram_cache_timer);

	
	if(!isset($instagram_cache_data['data']) OR empty($instagram_cache_data['data']) OR $instagram_cache_timer > 30000)
	{
		//Get Instagram JSON response from API
		if($meks_instagram_settings['api_type'] == 'business') {
			$response = wp_remote_get( 'https://graph.facebook.com/v7.0/' . $meks_instagram_settings['user_id'] . '/media?fields=media_url,thumbnail_url,media_type,permalink&limit='. $limit .'&access_token=' . $meks_instagram_settings['access_token'] );
		}
		else
		{
			$response = wp_remote_get( 'https://graph.instagram.com/'. $meks_instagram_settings['user_id'] .'/media?fields=media_url,thumbnail_url,media_type,permalink&limit='.$limit.'&access_token='.$meks_instagram_settings['access_token']);
		}
		
		$response_decode = json_decode( wp_remote_retrieve_body( $response ) );
		$result_photos = $response_decode->data;
	
		if(is_array($result_photos) && !empty($result_photos))
		{
			foreach ($result_photos as $key => $item)
			{
				$thumb_url = '';
				if(!empty($item->media_url))
				{
					$thumb_url = $item->media_url;
				}
				else
				{
					$thumb_url = $item->thumbnail_url;
				}
				
				$photos_arr[] = array(
					'thumb_url' => $thumb_url,
					'link' => $item->permalink,
				);
			} 
		}
		
		//var_dump('get from Instagram server');
		
		//Writing cache data
		if(!empty($photos_arr))
		{
			$cache_timestamp_instagram = time();
			
			$instagram_cache_data = array(
				'data' => $photos_arr,
				'time' => $cache_timestamp_instagram,
			);
			
			//Write cache to WordPress option
			update_option('grandconference_'.$meks_instagram_settings['user_id'].$limit, $instagram_cache_data);
			
			//var_dump('Successfully write cache');
		}
	}
	else if(isset($instagram_cache_data['data']) && !empty($instagram_cache_data['data']))
	{
		$photos_arr = $instagram_cache_data['data'];
		
		//var_dump('get from cached option');
		
		/*print '<pre>';
		var_dump($photos_arr);
		print '</pre>';*/
	}
	
	return $photos_arr;
}

function grandconference_get_default_session_sorting()
{
	$tg_session_sort = get_theme_mod('tg_session_sort', 'start_time');
	$session_sorting_arr = array(
		'order' => 'ASC',
		'orderby' => 'meta_value',
	);
	
	switch($tg_session_sort)
	{
		case 'start_time':
		default:
			$session_sorting_arr = array(
				'order' => 'ASC',
				'orderby' => 'meta_value',
			);
		break;
		
		case 'title':
			$session_sorting_arr = array(
			    'orderby' => 'post_title',
			    'order' => 'ASC',
			);
		break;
		
		case 'menu_order':
			$session_sorting_arr = array(
			    'orderby' => 'menu_order',
			    'order' => 'ASC',
			);
		break;
	}
	
	return $session_sorting_arr;
}

function grandconference_get_elementor_content($grandconference_content_default = '')
{
	if (class_exists("\\Elementor\\Plugin")) {
		$pluginElementor = \Elementor\Plugin::instance();
		$contentElementor = $pluginElementor->frontend->get_builder_content($grandconference_content_default);
		return $contentElementor;
	}
	else
	{
		return '';
	}
}

function grandconference_elementor_replace_urls( $from, $to ) {
	$from = trim( $from );
	$to = trim( $to );
	
	$is_valid_urls = ( filter_var( $from, FILTER_VALIDATE_URL ) && filter_var( $to, FILTER_VALIDATE_URL ) );
	
	if ( $from != $to && $is_valid_urls) {
		$wpdb = grandconference_get_wpdb();
	}
	
	$rows_affected = $wpdb->query(
			"UPDATE {$wpdb->postmeta} " .
			"SET `meta_value` = REPLACE(`meta_value`, '" . str_replace( '/', '\\\/', $from ) . "', '" . str_replace( '/', '\\\/', $to ) . "') " .
			"WHERE `meta_key` = '_elementor_data' AND `meta_value` LIKE '[%' ;" );
			
	return $rows_affected;
}

function grandconference_get_published_pages()
{
	// Define the arguments for the query
	$args = array(
		'post_type' => 'page',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'sort_order' => 'asc',
		'sort_column' => 'post_title',
	);
	
	// Run the query to get all published pages
	$pages = get_pages($args);
	
	// Create an empty array to store the pages
	$pages_array = array(
		''	=> esc_html__('No Template', 'grandconference')
	);
	
	// Loop through each page and add it to the array
	if (!empty($pages)) {
		foreach($pages as $page){
			$page_ID = $page->ID;
			$page_title = $page->post_title;
			$pages_array[$page_ID] = $page_title;
		}
	}

	return $pages_array;
}
?>