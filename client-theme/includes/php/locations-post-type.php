<?php

// ************ CREATE FLOOR PLANS POST TYPE **************** //

add_theme_support('post-thumbnails');
add_post_type_support( 'locations', 'thumbnail' );

add_action('init', 'create_locations_post_type');

function create_locations_post_type() {

  $labels = array(
    'name' => __('Locations'),
    'singular_name' => __('Locations'),
    'all_items' => __('All Locations'),
    'add_new' => _x('Add New Location', 'Location'),
    'add_new_item' => __('Add new Location'),
    'edit_item' => __('Edit Location'),
    'new_item' => __('New Location'),
    'view_item' => __('View Location'),
    'search_items' => __('Search in Locations'),
    'not_found' =>  __('No Location found'),
    'not_found_in_trash' => __('No Location found in trash'),
    'parent_item_colon' => ''
  );
  $args = array (
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-location',
    'rewrite' => array('slug' => '/locations'),
    'taxonomies' => array( /*'category',*/ 'locations'),
    'query_var' => true,
    'menu_position' => 22,
    'supports'=> array('thumbnail' , /*'custom-fields',*/ 'title', 'editor', 'excerpt'),
    'show_in_rest'       => true,
    'rest_base'          => 'locations',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
  );
  register_post_type('locations', $args);
}

// ************ GIVE FLOOR PLANS ITS OWN CATEGORIES **************** //

function my_taxonomies_locations() {
  $labels = array(
    'name'              => _x( 'Location Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Location Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Floor Locations' ),
    'all_items'         => __( 'All Location Categories' ),
    'parent_item'       => __( 'Parent Location Category' ),
    'parent_item_colon' => __( 'Parent Location Category:' ),
    'edit_item'         => __( 'Edit Location Category' ),
    'update_item'       => __( 'Update Location Category' ),
    'add_new_item'      => __( 'Add New Location Category' ),
    'new_item_name'     => __( 'New Location Category' ),
    'menu_name'         => __( 'Location Categories' ),
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
  register_taxonomy( 'locations_category', 'locations', $args );
}
add_action( 'init', 'my_taxonomies_locations', 0 );

add_action( 'admin_head', 'replace_default_featured_image_meta_box', 100 );
function replace_default_featured_image_meta_box() {
    remove_meta_box( 'postimagediv', 'locations', 'side' );
    add_meta_box('postimagediv', __('Location Thumbnail'), 'post_thumbnail_meta_box', 'locations', 'side', 'high');
}

add_filter( 'admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction( $content ) {
    return $content .= '<p>Image Size: 800 X 600</p>';
}

?>
