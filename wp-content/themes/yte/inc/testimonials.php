<?php
// Testimonials
add_action('init', 'testimonials_init');
/* SECTION - project_custom_init */
function testimonials_init()
{

    // The following is all the names, in our tutorial, we use "Project"
  $labels = array(
    'name' => _x('Testimonials', 'post type general name'),
    'singular_name' => _x('Testimonials', 'post type singular name'),
    'add_new' => _x('Add Testimonial', 'Testimoniala'),
    'add_new_item' => __('Add Testimonials'),
    'edit_item' => __('Edit Testimonial'),
    'new_item' => __('New'),
    'all_items' => __('All Testimonials'),
    'view_item' => __('View Testimonials'),
    'search_items' => __('Search Testimonials'),
    'not_found' =>  __('No testimonial found'),
    'not_found_in_trash' => __('No testimonials found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Testimonials'
  );

  // Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => false,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'testimonial', 'with_front'=> false ),
    '_builtin' => false,
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_icon' => 'dashicons-megaphone',
    'menu_position' => null,
    'supports' => array('title', 'editor','thumbnail','post-attributes')
  );

  // We call this function to register the custom post type
  register_post_type('tf_testimonials',$args);
  flush_rewrite_rules();
}

add_filter ("manage_edit-tf_testimonials_columns", "tf_testimonials_edit_columns");
add_action ("manage_posts_custom_column", "tf_testimonials_custom_columns");

function tf_testimonials_edit_columns($columns) {

    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "tf_col_ts_thumb" => "Image",
        "title" => "Title",
        );
    return $columns;
}

function tf_testimonials_custom_columns($column) {

    global $post;
    $custom = get_post_custom($post->ID);
    //$meta_url = get_post_meta(get_the_ID(), 'tf_section_url', true);
    switch ($column)

        {
          case "tf_col_ts_thumb":
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
