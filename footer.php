<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package underscores
 */

?>
<section class="hm-form-sec">
   <div class="container">
      <?php dynamic_sidebar('hm_form_sec'); ?>
   </div>
</section>
<footer class="site-footer">
    <div class="container">
        <div class="ftr-logo">
            <?php
            $image_url = get_stylesheet_directory_uri() . '/images/growthlab_white.webp';
            $dimensions = @getimagesize( $image_url );
            ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" <?php echo $dimensions ? ' width="' . esc_attr( $dimensions[0] ) . '" height="' . esc_attr( $dimensions[1] ) . '"' : ''; ?>>
            </a>
         </div>
        <div class="ftr-menu">
            <?php wp_nav_menu([ 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu-class',  ]); ?>
        </div>
        <div class="ftr-blocks"><?php dynamic_sidebar('ftr_blks'); ?></div>
    </div>
</footer>

<div class="copyrights">
    <div class="container">
        <div class="cpy-inr"><p class="copy-para">&copy; Copyright <?php echo date("Y"); ?> <?php echo get_option( 'blogname' ) ?>. All Rights Reserved.</p></div>
        <div class="ftrlink"><?php wp_nav_menu( array( 'theme_location' => 'footer2menu', 'container_class' => 'copyrightmenu' )); ?></div>
        <div class="growthlab">
            <a href="https://growthlabseo.com/" target="_blank" rel="noindex nofollow">
                <img width="232" height="50" src="<?php echo get_stylesheet_directory_uri(); ?>/images/growthlab_white.webp" alt="Growth Lab Seo" class="wmu-preview-img" rel="noindex nofollow">
            </a>
        </div>
    </div>
</div>
</div>
<?php wp_footer(); ?>
<?php /*
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.min.js"></script>
*/ ?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/owl.carousel.min.js"></script>
<?php /*<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/owlcarousel2-a11ylayer.js"></script>*/ ?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/common.js"></script> 
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/home-scripts.js"></script>
<?php if(!is_front_page()) { ?>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/inner-page-scripts.js"></script>
<?php } ?>

</body>
</html>
