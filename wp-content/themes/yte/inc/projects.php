<?php
// Slider
add_action('init', 'projects_init');
/* SECTION - project_custom_init */
function projects_init()
{
    // The following is all the names, in our tutorial, we use "Project"
  $labels = array(
    'name' => _x('Projects', 'post type general name'),
    'singular_name' => _x('Project', 'post type singular name'),
    'add_new' => _x('Add Project', 'New'),
    'add_new_item' => __('Add New Project'),
    'edit_item' => __('Edit Project'),
    'new_item' => __('New Project'),
    'all_items' => __('All Projects'),
    'view_item' => __('View Projects'),
    'search_items' => __('Search Projects'),
    'not_found' =>  __('No projects found'),
    'not_found_in_trash' => __('No projects found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Projects'
  );

  // Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
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
    'menu_icon' => 'dashicons-portfolio',
    'menu_position' => null,
    'show_in_nav_menus' => true,
    'rewrite' => array( "slug" => "projects/%prod_cat%", 'with_front' => false),
    'supports' => array('title', 'editor','thumbnail', 'excerpt','page-attributes'),
    'taxonomies' => array( 'tf_projectcategory', 'post_tag')
  );

  // We call this function to register the custom post type
  register_post_type('tf_project',$args);
}

function create_projectcategory_taxonomy() {

    $labels = array(
        'name' => _x( 'Project Categories', 'taxonomy general name' ),
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

    register_taxonomy('tf_projectcategory','tf_project', array(
        'label' => __('Project Category'),
        'labels' => $labels,
        'has_archive' => 'projects',
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'projects', 'with_front' => false ),
    ));

}

add_action( 'init', 'create_projectcategory_taxonomy');


add_filter ("manage_edit-tf_project_columns", "tf_project_edit_columns");
add_action ("manage_tf_project_posts_custom_column", "tf_project_custom_columns");

function tf_project_edit_columns($columns) {

    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "tf_col_pr_thumb" => "Image",
        "title" => "Title",
        );
    return $columns;
}

function tf_project_custom_columns($column) {

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
