<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package underscores
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/homepage.css">
    <?php if(!is_front_page()) { ?>
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/inner-pages.css">
    <?php } ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="wrapper">
    <div class="mobinav">
        <button type="button" class="menuClose" onclick="toggleMenu();">&times;</button>
        <?php wp_nav_menu([ 'theme_location' => 'main-menu', 'menu_class' => 'main-menu-class',  ]); ?>
        <?php echo do_shortcode( '[phonenumber]'); ?>
    </div>
    <header class="header-sec">
        <div class="logo-menu">
            <div class="container">
                <div class="logo-container">
                    <div class="logo">
                        <?php /*<?php the_custom_logo(); ?>*/ ?>
						
				<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/growthlab_logo.webp" alt="<?php bloginfo('name'); ?>" width="232" height="25"></a>
                            <a class="tab-call" href="tel:<?php echo do_shortcode( '[justnumber]'); ?>">
                                <span class="svg-icon">
                                    <svg xmlns="//www.w3.org/2000/svg" fill="#fff" viewBox="0 0 24 24">
                                        <path d="M21.384,17.752a2.108,2.108,0,0,1-.522,3.359,7.543,7.543,0,0,1-5.476.642C10.5,20.523,3.477,13.5,2.247,8.614a7.543,7.543,0,0,1,.642-5.476,2.108,2.108,0,0,1,3.359-.522L8.333,4.7a2.094,2.094,0,0,1,.445,2.328A3.877,3.877,0,0,1,8,8.2c-2.384,2.384,5.417,10.185,7.8,7.8a3.877,3.877,0,0,1,1.173-.781,2.092,2.092,0,0,1,2.328.445Z"/>
                                    </svg>
                                </span>
                                <span class="text">Call</span>
                            </a>
                            <button type="button" class="showhide" onclick="toggleMenu();">
                            <span class="menuBar menuBar-1"></span>
                            <span class="menuBar menuBar-2"></span>
                            <span class="menuBar menuBar-3"></span>
                            </button>
                    </div>
                    <div class="top-menu"><?php wp_nav_menu([ 'theme_location' => 'main-menu', 'menu_class' => 'main-menu-class',  ]); ?></div>
                    <div class="top-rit"><?php dynamic_sidebar('hm_top_rit'); ?></div>
                </div>
            </div>
        </div>
        <div class="mobile-menu-button-container">
            <button class="mobileMenuToggle" onclick="toggleMenu();">
                <span class="svg-icon">
                    <svg xmlns="//www.w3.org/2000/svg" fill="#fff" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 351.67">
                        <path fill-rule="nonzero" d="M0 0h512v23.91H0V0zm0 327.76h512v23.91H0v-23.91zm0-163.88h512v23.91H0v-23.91z"/>
                    </svg>
                </span>
                <span class="menu-text">Menu</span>
            </button>
            <a class="mobi-call" href="tel:<?php echo do_shortcode( '[justnumber]'); ?>">
                <span class="svg-icon">
                    <svg xmlns="//www.w3.org/2000/svg" fill="#fff" viewBox="0 0 24 24">
                        <path d="M21.384,17.752a2.108,2.108,0,0,1-.522,3.359,7.543,7.543,0,0,1-5.476.642C10.5,20.523,3.477,13.5,2.247,8.614a7.543,7.543,0,0,1,.642-5.476,2.108,2.108,0,0,1,3.359-.522L8.333,4.7a2.094,2.094,0,0,1,.445,2.328A3.877,3.877,0,0,1,8,8.2c-2.384,2.384,5.417,10.185,7.8,7.8a3.877,3.877,0,0,1,1.173-.781,2.092,2.092,0,0,1,2.328.445Z"/>
                    </svg>
                </span>
                <span class="button-text">Call</span>
            </a>
        </div>
    </header>

