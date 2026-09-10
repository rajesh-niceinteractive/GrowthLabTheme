<?php
function my_child_theme_enqueue_styles() {

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



add_action('after_setup_theme', 'register_theme_menus');
function register_theme_menus() {
    register_nav_menus([
        'main-menu'   => __('Header Menu'),  // Main menu location
        'footer-menu' => __('Footer Menu'), // Footer menu location
        'footer2menu' => __('Footer2 Menu'), // Footer menu location
        'notfound' => __('Page Not Found Menu'),
    ]);
}

add_action('widgets_init', 'register_theme_sidebars');
function register_theme_sidebars() {}

require_once( get_stylesheet_directory() . '/inc/reviews-cpt.php');
require_once( get_stylesheet_directory() . '/inc/theme-options.php');
require_once get_stylesheet_directory() . '/inc/svg-support.php';

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

function remove_jquery_migrate_script() {

    if ( ! is_admin() ) {
        /* Remove jQuery Migrate */
        wp_dequeue_script( 'jquery-migrate' );
        wp_deregister_script( 'jquery-migrate' );
    }
}
add_action( 'wp_enqueue_scripts', 'remove_jquery_migrate_script', 100 );
/* Remove Gravity Forms Css  */
add_filter( 'gform_disable_css', '__return_true' );
