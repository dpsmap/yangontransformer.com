<?php
// Slider
add_action('init', 'jobs_init');
/* SECTION - job_custom_init */
function jobs_init()
{
    // The following is all the names, in our tutorial, we use "Job"
  $labels = array(
    'name' => _x('Jobs', 'post type general name'),
    'singular_name' => _x('Job', 'post type singular name'),
    'add_new' => _x('Add Job', 'New'),
    'add_new_item' => __('Add New Job'),
    'edit_item' => __('Edit Job'),
    'new_item' => __('New Job'),
    'all_items' => __('All Jobs'),
    'view_item' => __('View Jobs'),
    'search_items' => __('Search Jobs'),
    'not_found' =>  __('No jobs found'),
    'not_found_in_trash' => __('No jobs found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Jobs Manager'
  );

  // Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Job post type
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'can_export' => true,
    'has_archive' => 'false',
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    '_builtin' => false,
    'capability_type' => 'page',
    'hierarchical' => true,
    'menu_icon' => 'dashicons-clipboard',
    'menu_position' => null,
    'show_in_nav_menus' => true,
    'rewrite' => array( "slug" => "jobs", 'with_front' => false),
    'supports' => array('title', 'editor','thumbnail', 'excerpt','page-attributes'),
    'taxonomies' => array( 'tf_jobcategory', 'post_tag')
  );

  // We call this function to register the custom post type
  register_post_type('tf_job',$args);
}

function create_jobcategory_taxonomy() {

    $labels = array(
        'name' => _x( 'Job Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Categories' ),
        'popular_items' => __( 'Popular Categories' ),
        'all_items' => __( 'All Categories' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add New Category' ),
        'new_item_name' => __( 'New Category Name' ),
        'separate_items_with_commas' => __( 'Separate categories with commas' ),
        'add_or_remove_items' => __( 'Add or remove categories' ),
        'choose_from_most_used' => __( 'Choose from the most used categories' ),
    );

    register_taxonomy('tf_jobcategory','tf_job', array(
        'label' => __('Job Category'),
        'labels' => $labels,
        'has_archive' => 'jobs',
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'jobs', 'with_front' => false ),
    ));

}

add_action( 'init', 'create_jobcategory_taxonomy');


add_filter ("manage_edit-tf_job_columns", "tf_job_edit_columns");
add_action ("manage_tf_job_posts_custom_column", "tf_job_custom_columns");

function tf_job_edit_columns($columns) {

    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "tf_col_pr_thumb" => "Image",
        "title" => "Title",
        );
    return $columns;
}

function tf_job_custom_columns($column) {

    global $post;
    $custom = get_post_custom($post->ID);
    //$meta_url = get_post_meta(get_the_ID(), 'tf_section_url', true);
    switch ($column)

        {
          case "tf_col_pr_thumb":
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
