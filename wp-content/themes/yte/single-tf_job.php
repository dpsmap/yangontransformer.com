<?php
		global $post;
		get_header();
	?>
	<div class="page-header" style="background-image:url(<?php echo get_template_directory_uri() . '/assets/images/header-bg.jpg'; ?>);">
	  <div class="grid flex">
	    <div class="block">
	      <div class="col_12">
	        <div class="col_4">
	          <h1><strong>Careers</strong></h1>
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
          <div class="col_9">
						<div class="single-product-details">
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<?php echo the_content(); ?>

							<div class="col_10">
								<?php echo do_shortcode('[contact-form-7 id="265" title="Job Application Form"]'); ?>
							</div>
						</div>
          </div>
        <?php endwhile; endif; ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
