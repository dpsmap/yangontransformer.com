<?php get_header(); ?>

<?php
	$bgimg = z_taxonomy_image_url();
	$current_term_id = get_queried_object()->term_id;
?>
<!-- Page Header -->
 <div <?php post_class('page-header'); ?> style="background-image:url('<?php echo $bgimg; ?>');">
	<div class="grid flex">
		<div class="block">
      <div class="col_4">
        <h2 class="cat_title entry-title"><strong><span><?php single_cat_title(); ?></span></strong></h2>
			</div>
			<div class="col_8">
				<div class="cat_description"><?php echo category_description(); ?></div>
      </div>
    </div>
  </div>
</div>
<!-- / Page Header -->

<div class="section">
	<div class="grid flex">
		<div class="block">

			<div class="col_3">

				<?php
				$taxonomy = 'tf_productcategory';
				$terms = get_terms([
				    'taxonomy' => $taxonomy,
				    'hide_empty' => false,
				    'hierarchical' => true,
				    'parent' => 0,
				]);
				?>
				<?php if ( $terms && !is_wp_error( $terms ) ) : ?>
				<ul class="products-menu">
					<?php foreach ( $terms as $term ):  ?>
						<li <?php echo $term->term_id == $current_term_id ? 'class="active"' : '' ; ?>><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>

			</div>

			<div class="col_9">
				<div class="products-grid">
				<div class="row">
					<?php
						global $query_string;
						query_posts( $query_string . '&orderby=menu_order&order=ASC' );
					?>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<div class="col_4">
							<div class="product-grid-item">
								<div class="product-thumbnail">
									<?php the_post_thumbnail(); ?>
								</div>
								<div class="product-info">
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								</div>
							</div>

						</div>

					<?php endwhile; endif; ?>
				</div>
				</div>
			</div>

		</div>
	</div>
</div>


<?php get_footer(); ?>
