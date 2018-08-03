<?php

// ************ CREATE SITE PLAN RESIDENCES POST TYPE **************** //

add_action('init', 'create_units_post_type');

function create_units_post_type() {

  $labels = array(
    'name' => __('Site Plan'),
    'singular_name' => __('Unit'),
    'all_items' => __('All Units'),
    'add_new' => _x('Add new Unit', 'Unit'),
    'add_new_item' => __('Add new Unit'),
    'edit_item' => __('Edit Unit'),
    'new_item' => __('New Unit'),
    'view_item' => __('View Unit'),
    'search_items' => __('Search in Unit'),
    'not_found' =>  __('No Unit found'),
    'not_found_in_trash' => __('No Units found in trash'),
    'parent_item_colon' => ''
  );
  $args = array (
  'labels' => $labels,
  'public' => true,
  'has_archive' => true,
  'menu_icon' => 'dashicons-admin-multisite',
  'rewrite' => array('slug' => 'units'),
  'taxonomies' => array( /*'category',*/ 'unit'),
  'query_var' => true,
  'menu_position' => 22,
  'supports'=> array('thumbnail' , /*'custom-fields',*/ 'title', 'editor', 'excerpt'),
  'show_in_rest'       => true,
  'rest_base'          => 'units',
  'rest_controller_class' => 'WP_REST_Posts_Controller',
  );
  register_post_type('units', $args);
}

// ************ GIVE RESIDENCES ITS OWN CATEGORIES **************** //

function my_taxonomies_unit() {
  $labels = array(
    'name'              => _x( 'Unit Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Unit Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Unit Categories' ),
    'all_items'         => __( 'All Unit Categories' ),
    'parent_item'       => __( 'Parent Unit Category' ),
    'parent_item_colon' => __( 'Parent Unit Category:' ),
    'edit_item'         => __( 'Edit Unit Category' ),
    'update_item'       => __( 'Update Unit Category' ),
    'add_new_item'      => __( 'Add New Unit Category' ),
    'new_item_name'     => __( 'New Unit Category' ),
    'menu_name'         => __( 'Unit Categories' ),
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
  register_taxonomy( 'unit_category', 'units', $args );
}
add_action( 'init', 'my_taxonomies_unit', 0 );

?>
