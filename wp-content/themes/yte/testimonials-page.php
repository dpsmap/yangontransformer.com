<?php
/*
Template Name: Testimonials
*/

get_header(); ?>

<?php
if(has_post_thumbnail()):
  $imgsrc=wp_get_attachment_image_src(get_post_thumbnail_id(), 'full' );
  ?>
  <div class="page-header" style="background-image: url('<?php echo $imgsrc[0]; ?>');">
    <div class="grid flex">
      <div class="block">
        <div class="col_12">
          <?php echo custom_breadcrumbs(); ?>
          <h1><?php the_title(); ?></h1>
          <div class="header-contents"> <?php echo get_post_meta(get_the_ID(), 'my_meta_box_text', true); ?></div>
        </div>
      </div>
    </div>
  </div>
  <?php
endif;

?>

<!-- Testimonials -->
<?php	$loop = new WP_Query( array( 'post_type' => 'tf_testimonials', 'posts_per_page' => 10 ) );  if ( $loop && $loop->post_count > 0 ) : ?>
<div class="section testimonials">
	<div class="grid">
		<div class="block">
			<div class="col_10 push_1">

        <div class="testimonials-wrapper">

          <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<div class="testimonial">
              <div class="testimonial-thumb">
                <?php the_post_thumbnail( 'user-thumb' ); ?>
              </div>
              <div class="testimonial-data">
                <?php the_content(); ?>
                <h4><?php the_title(); ?></h4>
              </div>
            </div>
					<?php endwhile; ?>

        </div>

		   </div>
		</div>
	</div>
</div>
<!-- / Testimonials -->
<?php endif; wp_reset_query(); ?>



<?php get_footer(); ?>
