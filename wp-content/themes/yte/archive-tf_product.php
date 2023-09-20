<?php get_header(); ?>


<?php

$taxonomy = 'tf_productcategory';
$terms = get_terms([
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
    'hierarchical' => true,
    'parent' => 0,
]);

//$terms = get_terms($taxonomy, 'hide_empty' => false); // Get all terms of a taxonomy
if ( $terms && !is_wp_error( $terms ) ) :
?>
    <ul>
        <?php foreach ( $terms as $term ) { ?>
            <li>

							<?php if (function_exists('z_taxonomy_image_url')) echo '<img src="'.z_taxonomy_image_url($term->term_id, 'thumbnail').'">'; ?>
              <a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a>
              <?php
                $subterms = get_terms($taxonomy, array(
                                              'parent'   => $term->term_id,
                                              'hide_empty' => false
                                              ));
                if(!empty($subterms)):
                  echo '<ul>';
                    foreach($subterms as $subterm):
                      ?>
                      <li><a href="<?php echo get_term_link($subterm->slug, $taxonomy); ?>"><?php echo $subterm->name; ?></a></li>
                      <?php
                    endforeach;
                  echo '</ul>';
                endif;
              ?>
            </li>

        <?php } ?>
    </ul>
<?php endif;?>

<?php get_footer(); ?>
