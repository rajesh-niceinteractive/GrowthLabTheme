<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
* @package underscores
 */

get_header(); ?>

<section class="banner-sec">
   <div class="container">
      <?php dynamic_sidebar('hm_bnr_sec'); ?>
   </div>
</section>
<section class="hm-testimonials">
   <div class="container">
      <?php get_template_part( 'template-parts/testimonials', 'block' ); ?>
   </div>
</section>

<section class="hm-blog-sec">
   <div class="container">
      <?php get_template_part( 'template-parts/blog', 'block' ); ?>
   </div>
</section>

<section class="hm-faq-sec">
   <div class="container">
   <?php dynamic_sidebar('hm_faq_sec'); ?>
   </div>
</section>

<section class="tab-section">
   <div class="container">
      <?php dynamic_sidebar('hm_tab_sec'); ?>
   </div>
</section>

<?php get_footer(); ?> <!-- Includes footer.php -->