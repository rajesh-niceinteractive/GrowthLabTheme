<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */

get_header();
?>

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
                <?php while (have_posts()):the_post();
                    the_content();
                endwhile; ?>
            </div>
            <div class="genpg-lft">
                <?php get_template_part( 'template-parts/sidebar' ); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
