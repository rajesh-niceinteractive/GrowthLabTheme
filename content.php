<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */

?>
<article class="post-item post-<?php echo get_the_ID(); ?>">
	<div class="post-img">
        <?php $img_url = (has_post_thumbnail()) ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_stylesheet_directory_uri().'/images/default-img.webp';
if (!has_post_thumbnail()) {
            $size = getimagesize(get_stylesheet_directory() . '/images/blog-post-default-img.webp');
            $img[1] = $size[0];
            $img[2] = $size[1];
        } else {
            $size = $img;
            $img[1] = $size[0];
            $img[2] = $size[1];
        } ?>
        <div class="blog-post-img">
			<a href="<?php the_permalink(); ?>">
				<img src="<?php echo esc_url($img[0]); ?>" width="<?php echo $img[1]; ?>" height="<?php echo $img[2]; ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
			</a>
		</div>
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
</article>
