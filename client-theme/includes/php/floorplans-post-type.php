<?php

// ************ CREATE FLOOR PLANS POST TYPE **************** //

add_action('init', 'create_floor_plans_post_type');

function create_floor_plans_post_type() {

  $labels = array(
    'name' => __('Floor Plans'),
    'singular_name' => __('Floor Plan'),
    'all_items' => __('All Floor Plans'),
    'add_new' => _x('Add new Floor Plan', 'Floor Plan'),
    'add_new_item' => __('Add new Floor Plan'),
    'edit_item' => __('Edit Floor Plan'),
    'new_item' => __('New Floor Plan'),
    'view_item' => __('View Floor Plan'),
    'search_items' => __('Search in Floor Plan'),
    'not_found' =>  __('No Floor Plans found'),
    'not_found_in_trash' => __('No Floor Plans found in trash'),
    'parent_item_colon' => ''
  );
  $args = array (
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-category',
    'rewrite' => array('slug' => '/floor-plans'),
    'taxonomies' => array( /*'category',*/ 'floor-plan'),
    'query_var' => true,
    'menu_position' => 22,
    'supports'=> array('thumbnail' , /*'custom-fields',*/ 'title', 'editor', 'excerpt'),
    'show_in_rest'       => true,
    'rest_base'          => 'floorplans',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
  );
  register_post_type('floor-plans', $args);
}

// ************ GIVE FLOOR PLANS ITS OWN CATEGORIES **************** //

function my_taxonomies_floor_plan() {
  $labels = array(
    'name'              => _x( 'Floor Plan Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Floor Plan Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Floor Plan Categories' ),
    'all_items'         => __( 'All Floor Plan Categories' ),
    'parent_item'       => __( 'Parent Floor Plan Category' ),
    'parent_item_colon' => __( 'Parent Floor Plan Category:' ),
    'edit_item'         => __( 'Edit Floor Plan Category' ),
    'update_item'       => __( 'Update Floor Plan Category' ),
    'add_new_item'      => __( 'Add New Floor Plan Category' ),
    'new_item_name'     => __( 'New Floor Plan Category' ),
    'menu_name'         => __( 'Floor Plan Categories' ),
    'show_admin_column' => true
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'show_admin_column' => true,
    'show_in_rest'          => true,
    'rest_base'             => 'genre',
    'rest_controller_class' => 'WP_REST_Terms_Controller'
  );
  register_taxonomy( 'floor-plan_category', 'floor-plans', $args );
}
add_action( 'init', 'my_taxonomies_floor_plan', 0 );

?>
