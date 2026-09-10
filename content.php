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
        <?php $img = has_post_thumbnail() ? wp_get_attachment_image_src(get_post_thumbnail_id(), 'full') : [get_stylesheet_directory_uri() . '/images/blog-post-default-img.webp'];
        if (!has_post_thumbnail()) {
            $size = getimagesize(get_stylesheet_directory() . '/images/blog-post-default-img.webp');
            $img[1] = $size[0];
            $img[2] = $size[1];
        }
        ?>
        <div class="blog-post-img">
            <a href="<?php the_permalink(); ?>">
                <img 
                    src="<?php echo esc_url($img[0]); ?>" 
                    width="<?php echo $img[1]; ?>" 
                    height="<?php $img[2]; ?>" 
                    alt="<?php echo esc_attr(get_the_title()); ?>">
            </a>
        </div>
    </div>
    <div class="post-cnt">
        <div class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
        <div class="post-btn"><a href="<?php the_permalink(); ?>" class="blg-btn">Read More</a></div>
    </div>
</article>
