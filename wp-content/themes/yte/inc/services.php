<?php
// Services
add_action('init', 'services_init');
/* SECTION - project_custom_init */
function services_init()
{

    // The following is all the names, in our tutorial, we use "Project"
  $labels = array(
    'name' => _x('Services', 'post type general name'),
    'singular_name' => _x('Service', 'post type singular name'),
    'add_new' => _x('Add Service', 'News'),
    'add_new_item' => __('Add New Service'),
    'edit_item' => __('Edit Service'),
    'new_item' => __('New'),
    'all_items' => __('All Services'),
    'view_item' => __('View Services'),
    'search_items' => __('Search Services'),
    'not_found' =>  __('No services found'),
    'not_found_in_trash' => __('No slies found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Services'
  );

  // Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    '_builtin' => false,
    'capability_type' => 'page',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_icon' => 'dashicons-lightbulb',
    'menu_position' => null,
    'supports' => array('title', 'editor','thumbnail','page-attributes')
  );

  // We call this function to register the custom post type
  register_post_type('tf_services',$args);
}
