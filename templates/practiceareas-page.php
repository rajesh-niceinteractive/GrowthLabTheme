<?php
/**
 * Template Name: Practice Areas Page
 *
 * @package underscores
 */
get_header(); ?>
<div class="page_bnr <?php if (has_post_thumbnail()) { ?>bnroverlay<?php } ?>" <?php if (has_post_thumbnail()) { ?>style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'innerpg_banner_full'); ?>);"<?php } ?>>
    <div class="container">
        <div class="page_title">
            <h1><?php the_title(); ?></h1>
            <div class="inrpg-breadcrumbs">
                <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb(); } ?>
            </div>
        </div>
    </div>
</div>
<div class="page_default practic_areas">
<div class="container">
        <div class="page_content">
            <div class="genpg-rite">
                <?php while (have_posts()):the_post();
                    the_content();
                endwhile; ?>
            </div>
     </div>
     </div>
</div>

<?php get_footer();