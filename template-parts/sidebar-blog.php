<?php
/**
* The template for displaying Sidebar for posts
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package WordPress
* @since 1.0.0
*/
?>
<?php dynamic_sidebar('blog_sidebar'); ?>
<div class="blog-archives">
<?php dynamic_sidebar('blog_archives_sidebar'); ?>
</div>