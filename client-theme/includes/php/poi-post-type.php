<?php

  // ************ CREATE POI POST TYPE **************** //

  add_action('init', 'create_pois_post_type');

  function create_pois_post_type() {

    $labels = array(
      'name' => __('POI Map'),
      'singular_name' => __('Poi'),
      'all_items' => __('All Pois'),
      'add_new' => _x('Add new Poi', 'Poi'),
      'add_new_item' => __('Add new Poi'),
      'edit_item' => __('Edit Poi'),
      'new_item' => __('New Poi'),
      'view_item' => __('View Poi'),
      'search_items' => __('Search in Poi'),
      'not_found' =>  __('No Poi found'),
      'not_found_in_trash' => __('No Pois found in trash'),
      'parent_item_colon' => ''
    );
    $args = array (
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-location-alt',
    'rewrite' => array('slug' => 'pois'),
    'taxonomies' => array( /*'category',*/ 'poi'),
      'query_var' => true,
      'menu_position' => 22,
      'supports'=> array('thumbnail' , /*'custom-fields',*/ 'title', 'editor', 'excerpt'),
      'show_in_rest'       => true,
      'rest_base'          => 'pois',
      'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type('pois', $args);
  }

  // ************ GIVE POI ITS OWN CATEGORIES **************** //

  function my_taxonomies_poi() {
    $labels = array(
      'name'              => _x( 'Poi Categories', 'taxonomy general name' ),
      'singular_name'     => _x( 'Poi Category', 'taxonomy singular name' ),
      'search_items'      => __( 'Search Poi Categories' ),
      'all_items'         => __( 'All Poi Categories' ),
      'parent_item'       => __( 'Parent Poi Category' ),
      'parent_item_colon' => __( 'Parent Poi Category:' ),
      'edit_item'         => __( 'Edit Poi Category' ),
      'update_item'       => __( 'Update Poi Category' ),
      'add_new_item'      => __( 'Add New Poi Category' ),
      'new_item_name'     => __( 'New Poi Category' ),
      'menu_name'         => __( 'Poi Categories' ),
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
    register_taxonomy( 'poi_category', 'pois', $args );
  }
  add_action( 'init', 'my_taxonomies_poi', 0 );

?>
