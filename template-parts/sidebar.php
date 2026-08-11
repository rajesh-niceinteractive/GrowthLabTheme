<?php
   /**
   * The template for displaying Sidebar for pages
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
   *
   * @package WordPress
   * @since 1.0.0
   */
   ?>

<?php
$menu_id    = get_field('sidebar_menu_list');
$menu_title = get_field('sidebar_menu_title');

if (!empty($menu_id)) :

    $menu = wp_get_nav_menu_object($menu_id);

    if ($menu) : ?>

        <section id="nav_menu-2" class="widget_nav_menu">
            <div class="widget">
                <span class="widget-title">
                    <?php echo esc_html(!empty($menu_title) ? $menu_title : 'Related Links'); ?>
                </span>

                <?php
                wp_nav_menu([
                    'menu'       => $menu->term_id,
                    'container'  => false,
                    'menu_class' => 'menu-practice-areas',
                ]);
                ?>
            </div>
        </section>

    <?php endif; ?>

<?php endif; ?>


<?php
$secondary_menu_id    = get_field('secondary_sidebar_menu');
$secondary_menu_title = get_field('secondary_menu_title');

// Default Practice Areas menu
if (empty($secondary_menu_id)) {
    $secondary_menu_id = 7;
}

$secondary_menu = wp_get_nav_menu_object($secondary_menu_id);

if ($secondary_menu) : ?>

    <section class="widget_nav_menu secondary-sidebar-menu">
        <div class="widget">
            <span class="widget-title">
                <?php echo esc_html(!empty($secondary_menu_title) ? $secondary_menu_title : 'Practice Areas'); ?>
            </span>

            <?php
            wp_nav_menu([
                'menu'       => $secondary_menu->term_id,
                'container'  => false,
                'menu_class' => 'menu-practice-areas',
            ]);
            ?>
        </div>
    </section>

<?php endif; ?>

  <?php dynamic_sidebar('table_of_content_sdbar'); ?>

<section class="widget sd-testi">
    <div class="widget-title">Testimonials</div>
    <div class="sidebar-testi owl-carousel">
        <?php $testimonial = new WP_Query( array(
            'post_type' => 'review',
            'posts_per_page' => -1,
            'order_by' => 'date',
            'order' => 'DESC',
        ));
        if($testimonial->have_posts()) :
            while ($testimonial->have_posts()) :
			 $testimonial->the_post(); ?>
                <div class="testi-item">            
                    <div class="star-rat"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sdb-testi-star-rat-img.webp" alt="Star Rat image" width="156" height="30"></div>
                    <div class="showcontent"><?php the_content(); ?></div>
                    <div class="sd-testi-item-btn"> <span>Read more</span></div>
                    <div class="sidebar-testi-title">- <?php echo get_the_title(); ?></div>
                </div>
            <?php endwhile; wp_reset_postdata();
        endif; ?>
    </div>
</section>
<?php dynamic_sidebar('ocs-location-sidebar'); ?>