<?php
/**
 * The main template file for display archive page.
 *
 * @package WordPress
*/

//Get archive page layout setting
$tg_blog_archive_layout = get_theme_mod('tg_blog_archive_layout', 'blog_r');

$located = locate_template($tg_blog_archive_layout.'.php');
if (!empty($located))
{
	get_template_part($tg_blog_archive_layout);
}
else
{
	get_template_part('blog_r');
}
?>