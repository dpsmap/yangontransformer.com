<?php
		global $post;
		get_header();

		if ( has_post_thumbnail() ) {
			$bgimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
		}
		else
		{
			$bgimg = get_template_directory_uri() . '/assets/images/header-bg.jpg';
		}
	?>
	<div class="page-header" style="background-image:url(<?php echo $bgimg; ?>);">
	  <div class="grid flex">
	    <div class="block">
	      <div class="col_12">
	        <div class="col_4">
	          <h1><?php the_title(); ?></h1>
	        </div>
	        <div class="col_8">

	        </div>
	      </div>
	    </div>
	  </div>
	</div>

<div id="product-contents" <?php post_class('pagesection'); ?>>
	<div class="grid">
  	<div class="block">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <?php $custom = get_post_custom(); ?>
          <div class="col_3 hide-phone hide-mobile">

						<?php
							$post_terms = wp_get_post_terms(get_the_ID(), 'tf_projectcategory');

							$current_term = !empty($post_terms) ? $post_terms[0]->term_id : 0;
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
						<?php if ( $terms && !is_wp_error( $terms ) ) : ?>
						<ul class="products-menu">
							<?php foreach ( $terms as $term ):  ?>
								<li <?php echo $term->term_id == $current_term ? 'class="active"' : '' ; ?>><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
          </div>

          <div class="col_9">
						<div class="single-product-details">
							<?php echo the_content(); ?>
						</div>
          </div>
        <?php endwhile; endif; ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
