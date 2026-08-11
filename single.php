<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package underscores
 */

get_header();
?>


<div class="page_bnr <?php if (has_post_thumbnail()) { ?>bnroverlay<?php } ?>" <?php if (has_post_thumbnail()) { ?>style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>);"<?php } ?>>
    <div class="container">
        <div class="page_title">
            <h1>Blog</h1>
            <div class="inrpg-breadcrumbs">
                <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb(); } ?>
            </div>
        </div>
    </div>
</div>

<div class="page_default">
    <div class="container">
        <div class="page_content">
            <div class="genpg-rite">
                <?php /*<h1 class="single-post-title"><?php the_title(); ?></h1> */ ?>
                <?php if ( has_post_thumbnail()) { ?>
                    <div class="single-post-thumbnail">
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php echo get_the_title(); ?>" />
                    </div>
                <?php } ?>
                <div class="single-post-content">
                    <?php while (have_posts()):
                        the_post();
                        the_content();
                        $nextPost = get_next_post();
                        $prevPost = get_previous_post();
                    endwhile; ?>
                    <div class="page-navi">
                        <?php if($prevPost) {?>
                        <div class="page-navi-block page-navi-pre"> <a class="cmn-btn"
                                href="<?php echo get_permalink($prevPost->ID); ?>">Previous</a> </div>
                        <?php } ?>
                        <?php if($nextPost) { ?>
                        <div class="page-navi-block page-navi-nxt"> <a class="cmn-btn"
                                href="<?php echo get_permalink($nextPost->ID); ?>">Next</a></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="genpg-lft">
                <?php get_template_part( 'template-parts/sidebar-blog' ); ?>
            </div>
        </div>
    </div>
</div>


<?php
get_footer();
