<?php
//Get category page layout setting
$tg_blog_category_layout = get_theme_mod('tg_blog_category_layout', 'blog_r');

$located = locate_template($tg_blog_category_layout.'.php');
if (!empty($located))
{
	get_template_part($tg_blog_category_layout);
}
else
{
	get_template_part('blog_r');
}

?>