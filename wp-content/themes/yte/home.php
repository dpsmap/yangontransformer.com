<?php
/*
Template Name: Home Page
*/

get_header(); ?>

<?php $loop = new WP_Query(array('post_type' => 'tf_slides', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1)); if ( $loop && $loop->post_count > 0 ) : ?>

	<div class="slider-wrapper">

		<!-- Slider -->
		<div class="slider">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); $imgsrc=wp_get_attachment_image_src(get_post_thumbnail_id(), 'full' ); ?>
			<!-- Slide -->
			<div class="slide" data-bgimg="<?php echo $imgsrc[0]; ?>">
				<div class="slide-text-overlay">
					<div class="grid">
						<div class="block ntm nbm">

							<div class="col_6">
								<div class="text-wrapper">
									<?php echo the_content(); ?>
								</div>
							</div>



						</div>
					</div>
				</div>
			</div>
			<!-- / Slide -->
			<?php endwhile;  ?>
		</div>
		<!--/ Slider -->
	</div>
<?php endif;  wp_reset_query(); ?>


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





<?php get_footer(); ?>
