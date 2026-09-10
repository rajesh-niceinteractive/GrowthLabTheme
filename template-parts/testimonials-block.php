<h4 class="text-heading">What Our <br>Clients Are Saying</h4>
<div class="testi-blk owl-carousel">
    <?php $testimonial = new WP_Query( array(
        'post_type' => 'review',
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
    if($testimonial->have_posts()) :
        while ($testimonial->have_posts()) :
            $testimonial->the_post(); ?>
            <div class="hm-testi-item">
                <div class="hm-testi-cont">
                    <div class="star-rat"></div>
                    <p class="description"><?php echo wp_trim_words(get_the_content(), 30); ?></p>
                    <div class="author">-<?php echo get_the_title(); ?></div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata();
    endif; ?>
</div>
<div class="testi-btn"><a href="<?php echo esc_url( home_url( '/testimonials/' ) );?>" class="cmn-btn">View All Testimonials</a></div>
