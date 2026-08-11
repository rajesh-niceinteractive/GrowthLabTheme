<?php
/**
 * The template for displaying 404 pages.
 *
 * @package OceanWP WordPress theme
 */

 get_header(); ?>
<div class="page_bnr <?php if (has_post_thumbnail()) { ?>bnroverlay<?php } ?>" <?php if (has_post_thumbnail()) { ?>style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>);"<?php } ?>>
    <div class="container">
        <div class="page_title">
            <h1>Page Not Found</h1>
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
                 <p>It looks like the page you’re looking for is missing. This page may have moved.</p>
                 <p>The following are other pages you may find helpful:</p>
                 <?php wp_nav_menu([ 'theme_location' => 'notfound', 'menu_class' => 'notfoundmenu',  ]); ?>
             </div>
             <div class="genpg-lft"><?php get_template_part( 'template-parts/sidebar' ); ?></div>
         </div>
     </div>
 </div>
 <?php get_footer();