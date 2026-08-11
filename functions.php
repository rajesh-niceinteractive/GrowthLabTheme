<?php
function my_child_theme_enqueue_styles() {
    $parent_style = 'parent-style'; 

    /*wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );*/
    wp_enqueue_style( 'underscores-style', get_stylesheet_directory_uri() . '/style.css', [], '1.0' );
	
	/*wp_enqueue_script('common2', get_stylesheet_directory_uri() . '/js/common.js', array('jquery'), '1.0', true);*/
}
add_action( 'wp_enqueue_scripts', 'my_child_theme_enqueue_styles' );

function remove_cssjs_ver( string $src ): string {
    if ( strpos( $src, '?ver=' ) !== false ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 1 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 1 );

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

/* Header logo preload class */
function custom_logo_class($html) {
    $html = str_replace( 'class="custom-logo"', 'class="wmu-preview-img"', $html );
    return $html;
}
add_filter('get_custom_logo', 'custom_logo_class');

add_action('after_setup_theme', 'register_theme_menus');
function register_theme_menus() {
    register_nav_menus([
        'main-menu'   => __('Header Menu'),  // Main menu location
        'footer-menu' => __('Footer Menu'), // Footer menu location
        'footer2menu' => __('Footer2 Menu'), // Footer menu location
        'notfound' => __('Page Not Found Menu'),
    ]);
}
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    return array_merge($file_types, $new_filetypes);
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

add_action('widgets_init', 'register_theme_sidebars');
function register_theme_sidebars() {
        register_sidebar([
        'name'          => __('Home Top Right'),
        'id'            => 'hm_top_rit',
        'description'   => __('Home Top Right'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ]);
        register_sidebar([
        'name'          => __('Home Banner Section'),
        'id'            => 'hm_bnr_sec',
        'description'   => __('Banner Section'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ]);
    register_sidebar([
        'name'          => __('Home Faq Section'),
        'id'            => 'hm_faq_sec',
        'description'   => __('FAQ Section'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ]);
    register_sidebar([
        'name'          => __('Home Tab Section'),
        'id'            => 'hm_tab_sec',
        'description'   => __('Tab Section'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ]);
    register_sidebar([
        'name'          => __('Home Form Section'),
        'id'            => 'hm_form_sec',
        'description'   => __('Form Section'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ]);

    register_sidebar([
        'name'          => __('Page Sidebar'),
        'id'            => 'page_sidebar',
        'description'   => __('Page Sidebar'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ]);
    register_sidebar([
        'name'          => __('Common Block'),
        'id'            => 'innerpage_cmn_blk',
        'description'   => __('Common Block'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ]);
    register_sidebar([
        'name'          => __('Blog Archives Sidebar'),
        'id'            => 'blog_archives_sidebar',
        'description'   => __('Blog Archives Sidebar'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ]);
    register_sidebar([
        'name'          => __('Blog Sidebar'),
        'id'            => 'blog_sidebar',
        'description'   => __('Blog Sidebar'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ]);
}

require_once( get_stylesheet_directory() . '/inc/reviews-cpt.php');
require_once( get_stylesheet_directory() . '/inc/theme-options.php');



// Common Block Function

add_shortcode( 'CommonBlock', function() {
    ob_start(); ?>
    <div class="innerpage-common-block"><?php dynamic_sidebar('innerpage_cmn_blk'); ?></div>
    <?php return ob_get_clean();
});


if ( ! function_exists( 'my_custom_pagination' ) ) {
    function my_custom_pagination( $args = array() ) {
        global $wp_query;

        // Default settings
        $defaults = array(
            'mid_size'  => 2,
            'end_size'  => 1,
            'prev_text' => '&laquo; Prev',
            'next_text' => 'Next &raquo;',
            'type'      => 'list',
        );

        $args = wp_parse_args( $args, $defaults );

        $links = paginate_links( array(
            'total'     => $wp_query->max_num_pages,
            'current'   => max( 1, get_query_var( 'paged' ) ),
            'mid_size'  => $args['mid_size'],
            'end_size'  => $args['end_size'],
            'prev_text' => $args['prev_text'],
            'next_text' => $args['next_text'],
            'type'      => $args['type'],
        ) );

        if ( $links ) {
            echo '<div class="underscores-pagination clr">' . $links . '</div>';
        }
    }
}


add_filter('gform_validation', function($validation_result) {
    $form = $validation_result['form'];
    foreach ($form['fields'] as &$field) {
        if ($field->label === 'Leave this field blank') {
            $field_value = rgpost("input_{$field->id}");
            if (!empty($field_value)) {
                $validation_result['is_valid'] = false;
            }
        }
    }
    $validation_result['form'] = $form;
    return $validation_result;
});

/*
* Gravity form email validation text change
*/
add_filter( 'gform_field_validation', function( $result, $value, $form, $field ) {

    if ( $field->type == 'email' && ! $result['is_valid'] ) {
        $result['message'] = 'Please enter a valid email address.';
    }

    return $result;

}, 10, 4 );


/*
 * * Custom Menu for practice area pages
 * <div class="all-practice-ares-menu-main">[wp_menu menu="All Practice Areas Menu"]</div>
 */

class Practice_Areas_Walker extends Walker_Nav_Menu {

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

        if ( $depth === 0 && in_array( 'menu-item-has-children', $item->classes ) ) {
            $item->classes[] = 'parent-menu-item';
        }

        parent::start_el( $output, $item, $depth, $args, $id );
    }
}

function wp_menu_shortcode($atts) {
    $atts = shortcode_atts(array(
        'menu'  => '',
        'class' => 'all-practice-areas-menu',
    ), $atts);

    return wp_nav_menu(array(
        'menu'       => $atts['menu'],
        'menu_class' => $atts['class'],
        'container'  => false,
        'echo'       => false,
        'walker'     => new Practice_Areas_Walker(),
    ));
}
add_shortcode('wp_menu', 'wp_menu_shortcode');

function custom_widget_title_tags($params) {
    if (isset($params[0]['before_title']) && isset($params[0]['after_title'])) {
        $params[0]['before_title'] = str_replace('<h4', '<span class="widget-title"', $params[0]['before_title']);
        $params[0]['after_title'] = str_replace('</h4>', '</span>', $params[0]['after_title']);
    }
    return $params;
}
add_filter('dynamic_sidebar_params', 'custom_widget_title_tags');
/*
 * * Custom Menu for practice area pages
 */

/* Add menu list to select box dynamically */

add_filter('acf/load_field/name=sidebar_menu_list', 'my_acf_load_menu_choices');
function my_acf_load_menu_choices( $field ) {
    $menus = wp_get_nav_menus();
    $choices = array();
    if ( !empty($menus) ) {
        $choices[ 7 ] ='Practice Areas';
        foreach ( $menus as $menu ) {
            if ( $menu->name != $main_menu_name ) {
                $choices[ $menu->term_id ] = $menu->name;
            }
        }
    }
    $field['choices'] = $choices;
    return $field;
}

/* Remove jQuery Migrate */
function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];

        if ( $script->deps ) {
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );
/* Remove Gravity Forms Css  */
add_filter( 'gform_disable_css', '__return_true' );