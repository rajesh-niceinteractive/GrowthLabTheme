<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package OceanWP WordPress theme
 */

get_header(); ?>
<div class="page_bnr <?php if (has_post_thumbnail()) { ?>bnroverlay<?php } ?>" <?php if (has_post_thumbnail()) { ?>style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>);"<?php } ?>>
    <div class="container">
        <div class="page_title">
            <h1>
    <?php 
    if ( is_search() ) { 
        echo 'Search results for: ' . get_search_query(); 
    } else {
        the_title();
    }
    ?>
</h1>
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
                    else : ?>
						<div class="no-search-resultes w100p">
							<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'oceanwp' ); ?></p>
							<?php echo get_search_form(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="genpg-lft">
				<?php get_template_part( 'template-parts/sidebar', 'blog' ); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>