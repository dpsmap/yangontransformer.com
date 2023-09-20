<?php
// Slider
add_action('init', 'slider_init');
/* SECTION - project_custom_init */
function slider_init()
{

    // The following is all the names, in our tutorial, we use "Project"
  $labels = array(
    'name' => _x('Slider', 'post type general name'),
    'singular_name' => _x('Slide', 'post type singular name'),
    'add_new' => _x('Add Slide', 'News'),
    'add_new_item' => __('Add New Slide'),
    'edit_item' => __('Edit Slide'),
    'new_item' => __('New'),
    'all_items' => __('All Slides'),
    'view_item' => __('View Slides'),
    'search_items' => __('Search Slides'),
    'not_found' =>  __('No slides found'),
    'not_found_in_trash' => __('No slies found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Slider'
  );

  // Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    '_builtin' => false,
    'capability_type' => 'page',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_icon' => 'dashicons-images-alt2',
    'menu_position' => null,
    'supports' => array('title', 'editor','thumbnail','page-attributes')
  );

  // We call this function to register the custom post type
  register_post_type('tf_slides',$args);
}

add_filter ("manage_edit-tf_slides_columns", "tf_slides_edit_columns");
add_action ("manage_posts_custom_column", "tf_slides_custom_columns");

function tf_slides_edit_columns($columns) {

    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "tf_col_sc_thumb" => "Image",
        "title" => "Title",
        );
    return $columns;
}

function tf_slides_custom_columns($column) {

    global $post;
    $custom = get_post_custom($post->ID);
    //$meta_url = get_post_meta(get_the_ID(), 'tf_section_url', true);
    switch ($column)

        {
          case "tf_col_sc_thumb":
              // - show thumb -
              $post_image_id = get_post_thumbnail_id(get_the_ID());
              if ($post_image_id) {
                  $thumbnail = wp_get_attachment_image_src( $post_image_id, 'post-thumbnail', false);
                  if ($thumbnail) (string)$thumbnail = $thumbnail[0];
                  echo '<img src="';
                  echo $thumbnail;
                  echo '" width="100" alt="" />';
              }
          break;

        }
}
