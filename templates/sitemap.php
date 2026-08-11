<?php
/**
 * Template Name: Site Map Template
 *
 * @package underscores
 */

get_header(); ?>

<div class="page_bnr <?php if (has_post_thumbnail()) { ?>bnroverlay<?php } ?>" <?php if (has_post_thumbnail()) { ?>style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>);"<?php } ?>>
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
                <main id="main" class="site-main" role="main">
                    <h2><span>Pages</span></h2>
                    <ul class="list sitemap">
                        <?php wp_list_pages( 'title_li=' ); ?>
                    </ul>
                </main><!-- #main -->
            </div>
            <div class="genpg-lft">
            <?php get_template_part( 'template-parts/sidebar' ); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer();