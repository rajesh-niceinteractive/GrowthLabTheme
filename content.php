<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */

?>

<div class="post-item">
    <div class="post-img">
        <?php $img_url = (has_post_thumbnail()) ? get_the_post_thumbnail_url(get_the_ID(), 'blog_img') : get_stylesheet_directory_uri().'/images/default-img.webp'; ?>
        <div class="blog-post-img"><a href="<?php the_permalink(); ?>"><img src="<?php echo $img_url; ?>" alt="<?php echo get_the_title(); ?>"></a></div>
    </div>
    <div class="post-cnt">
		<div class="post-meta">
            <div class="post-dt"><?php echo get_the_date('M d, Y'); ?></div>
            <div class="post-category"><?php the_category(','); ?></div>
        </div>
        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <p><?php echo wp_trim_words(get_the_content(), 45); ?></p>
            <div class="post-btn"><a href="<?php the_permalink(); ?>" class="blg-btn">Read More</a></div>
        </div>
    </div>