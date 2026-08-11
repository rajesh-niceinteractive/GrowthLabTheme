<?php
/**
 * Template Name: No Banner Template
 *
 * @package underscores
 */

get_header(); ?>

<div class="page_bnr" >
    <div class="container">
        <div class="page_title">
            <h1><?php the_title(); ?></h1>
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
                <?php if (has_post_thumbnail()) { ?>
                    <div class="page-featured-image">
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php echo get_the_title(); ?>" />
                    </div>
                <?php } ?>
                <?php while (have_posts()):
                    the_post();
                    the_content();
                endwhile; ?>
            </div>
            <div class="genpg-lft">
                <?php get_template_part( 'template-parts/sidebar' ); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();