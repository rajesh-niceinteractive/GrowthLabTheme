<?php

add_action( 'init', 'reviews_init' );
function reviews_init() {
    $labels = array(
        'name' => 'Reviews',
        'singular_name' =>'Review',
        'add_new' => 'Add New', 'mythings',
        'add_new_item' => 'Add New Review',
        'edit_item' => 'Edit Review',
        'new_item' => 'New Review',
        'view_item' => 'View Review',
        'search_items' => 'Search Review',
        'not_found' => 'No Reviews found',
        'not_found_in_trash' => 'No Reviews found in Trash',
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => false,       
        'has_archive' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => array( 'slug' => 'review' ),
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'revisions' ),
    );
    register_post_type( 'review', $args );
}
