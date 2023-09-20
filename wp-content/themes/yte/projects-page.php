<?php
/*
Template Name: Projects
*/

get_header(); ?>

<?php
// Start the loop.
while ( have_posts() ) : the_post();
	// Include the page content template.
	the_content();

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

	// End of the loop.
endwhile;
?>

<?php
$taxonomy = 'tf_projectcategory';
$terms = get_terms([
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
    'hierarchical' => true,
    'parent' => 0,
]);
?>
<div class="grid flex">
	<div class="block">
		<?php if ( $terms && !is_wp_error( $terms ) ) : foreach ( $terms as $term ):  ?>
			<div class="col_3">
				<div class="project-category-box">
					<div class="project-category-thumb">
						<?php if (function_exists('z_taxonomy_image_url')): ?>
							<a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><img src="<?php echo z_taxonomy_image_url($term->term_id, 'product-thumb'); ?>"></a>
							<h3><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></h3>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endforeach; endif; ?>
	</div>
</div>



<?php get_footer(); ?>
