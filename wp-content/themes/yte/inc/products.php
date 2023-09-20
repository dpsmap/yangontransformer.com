<?php
// Slider
add_action('init', 'products_init');
/* SECTION - project_custom_init */
function products_init()
{



    // The following is all the names, in our tutorial, we use "Project"
  $labels = array(
    'name' => _x('Products', 'post type general name'),
    'singular_name' => _x('Product', 'post type singular name'),
    'add_new' => _x('Add Product', 'New'),
    'add_new_item' => __('Add New Product'),
    'edit_item' => __('Edit Product'),
    'new_item' => __('New Product'),
    'all_items' => __('All Products'),
    'view_item' => __('View Products'),
    'search_items' => __('Search Products'),
    'not_found' =>  __('No products found'),
    'not_found_in_trash' => __('No products found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Products'
  );

  // Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'can_export' => true,
    'has_archive' =>  false,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    '_builtin' => false,
    'capability_type' => 'page',
    'hierarchical' => true,
    'menu_icon' => 'dashicons-products',
    'menu_position' => null,
    'show_in_nav_menus' => true,
    'rewrite' => array( "slug" => "products/%prod_cat%", 'with_front' => false),
    'supports' => array('title', 'editor','thumbnail', 'excerpt','page-attributes'),
    'taxonomies' => array( 'tf_productcategory', 'post_tag')
  );

  // We call this function to register the custom post type
  register_post_type('tf_product',$args);
}

function create_productcategory_taxonomy() {

    $labels = array(
        'name' => _x( 'Product Categories', 'taxonomy general name' ),
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

    register_taxonomy('tf_productcategory','tf_product', array(
        'label' => __('Product Category'),
        'labels' => $labels,
        'has_archive' => 'products',
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'products', 'with_front' => false ),
    ));

}

add_action( 'init', 'create_productcategory_taxonomy');


add_filter ("manage_edit-tf_product_columns", "tf_product_edit_columns");
add_action ("manage_tf_product_posts_custom_column", "tf_product_custom_columns");

function tf_product_edit_columns($columns) {

    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "tf_col_pr_thumb" => "Image",
        "title" => "Title",
        );
    return $columns;
}

function tf_product_custom_columns($column) {

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

function wpa_show_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'tf_product' ){
        $terms = wp_get_object_terms( $post->ID, 'tf_productcategory' );
        if( $terms ){
            return str_replace( '%prod_cat%' , $terms[0]->slug , $post_link );
        }
    }
    elseif ( is_object( $post ) && $post->post_type == 'tf_project' ){
        $terms = wp_get_object_terms( $post->ID, 'tf_projectcategory' );
        if( $terms ){
            return str_replace( '%prod_cat%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}

add_filter( 'post_type_link', 'wpa_show_permalinks', 1, 3 );

function rewrite_rules($rules) {
  $newRules = array();
  $newRules['products/(.+)/(.+?)$'] = 'index.php?tf_product=$matches[2]';
  $newRules['projects/(.+)/(.+?)$'] = 'index.php?tf_project=$matches[2]';
  return array_merge($newRules, $rules);
}
add_filter('rewrite_rules_array', __NAMESPACE__ . '\\rewrite_rules');

/*
function wpa_course_post_link( $post_link, $id = 0 ){
    $post = get_post($id);
    if ( is_object( $post ) ){
        $terms = wp_get_object_terms( $post->ID, 'tf_product' );
        if( $terms ){
            return str_replace( '%prod_cat%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'wpa_course_post_link', 1, 3 );
*/
