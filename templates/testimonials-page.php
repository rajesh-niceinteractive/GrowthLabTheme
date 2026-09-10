<?php
/**
 * * Template Name: Testimonials Page
 * *
 * * @package underscores
 * */
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
<div class="page_default testimonials-pg">
    <div class="container">
        <div class="page_content">
            <div class="genpg-rite full-width">
                <div class="testimonials-page">
                    <!-- <div data-bid="128931" data-url="https://app.gatherup.com" ><script src="https://widget.reviewability.com/js/widgetAdv.min.js" async></script></div><script class="json-ld-content" type="application/ld+json"></script> -->
                    <?php $testimonial = new WP_Query( array(
                        'post_type' => 'review',
                        'posts_per_page' => -1,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    ));
                    if($testimonial->have_posts()) :
                        echo '<div class="in-testi-blk">';
                        while ($testimonial->have_posts()) :
                            $testimonial->the_post(); ?>
                            <div class="in-testi-item">
                                <h3 class="title"><?php echo get_the_title(); ?></h3>
                                <?php the_content(); ?>
                                <div class="star-rat"></div>
                            </div>
                        <?php endwhile; wp_reset_postdata();
                        echo '</div>';
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
