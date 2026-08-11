<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
            <h1>Blog</h1>
            <div class="inrpg-breadcrumbs">
                <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb(); } ?>
            </div>
        </div>
    </div>
</div>

	<div class="page_default blog_pg">
  <div class="container">
    <div class="page_content">

        <div class="genpg-rite">
            <div class="blg-cntblk">
			<?php if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'content' );
                        endwhile;
                        /*oceanwp_blog_pagination();*/
                        my_custom_pagination( array( 'prev_text' => '« Previous', 'next_text' => 'Next »', ) );
                    else :
                        get_template_part( 'none' );
                    endif; ?>
            </div>
        </div>

        <div class="genpg-lft">
            <?php get_template_part( 'template-parts/sidebar', 'blog' ); ?>
        </div>

    </div>
</div>

</div>

<?php
get_footer();
