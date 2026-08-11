<h2 class="text-heading">Latest Blog Posts</h2>
<div class="hm-blog-blk">
    <?php // WP Query to fetch the latest posts
    $args = array(
        'posts_per_page' => 3, // Display 3 latest posts, adjust as needed
        'post_status'    => 'publish', // Only show published posts
    );
    $latest_posts = new WP_Query( $args );
    if ( $latest_posts->have_posts() ) :
        while ( $latest_posts->have_posts() ) :
            $latest_posts->the_post(); ?>
            <div class="hmblg-item">
                <div class="hmblg-item-img">
                    <?php $rimgurl = (has_post_thumbnail()) ? get_the_post_thumbnail_url(get_the_ID(), 'full') :  get_stylesheet_directory_uri().'/images/default-img.webp'; ?>
                    <div class="hmblg-post-img">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo $rimgurl; ?>" alt="<?php echo get_the_title(); ?>" />
                        </a>
                    </div>
                </div>
                <div class="hmblgcnt">
                    <h3><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 12,' [...] ', '' ); ?></a></h3>
                    <p><?php echo wp_trim_words(get_the_content(), 12); ?></p>
                    <div class="dt-rm">
                        <div class="clndr"><?php echo get_the_date('M  m, Y'); ?></div>
                        <div class="hmpost_btn"><a href=" <?php the_permalink(); ?>">Read More</a></div>
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); // Reset post data after the custom query
    else :
        echo '<p>No posts found.</p>';
    endif; ?>
</div>
<div class="hmnews-btn"><a href="<?php echo esc_url( home_url( '/blog/' ) );?>" class="cmn-btn">View More</a></div>