<?php
// Slider
add_action('init', 'news_init');
/* SECTION - project_custom_init */
function news_init()
{

    // The following is all the names, in our tutorial, we use "Project"
  $labels = array(
    'name' => _x('News', 'post type general name'),
    'singular_name' => _x('News', 'post type singular name'),
    'add_new' => _x('Add News', 'News'),
    'add_new_item' => __('Add News'),
    'edit_item' => __('Edit News'),
    'new_item' => __('New'),
    'all_items' => __('All News'),
    'view_item' => __('View News'),
    'search_items' => __('Search News'),
    'not_found' =>  __('No news found'),
    'not_found_in_trash' => __('No news found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Latest News'
  );

  // Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'news' ),
    '_builtin' => false,
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_icon' => 'dashicons-megaphone',
    'menu_position' => null,
    'supports' => array('title', 'editor','thumbnail','post-attributes')
  );

  // We call this function to register the custom post type
  register_post_type('tf_news',$args);
  flush_rewrite_rules();
}

add_filter ("manage_edit-tf_news_columns", "tf_news_edit_columns");
add_action ("manage_posts_custom_column", "tf_news_custom_columns");

function tf_news_edit_columns($columns) {

    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "tf_col_ns_thumb" => "Image",
        "title" => "Title",
        );
    return $columns;
}

function tf_news_custom_columns($column) {

    global $post;
    $custom = get_post_custom($post->ID);
    //$meta_url = get_post_meta(get_the_ID(), 'tf_section_url', true);
    switch ($column)

        {
          case "tf_col_ns_thumb":
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
