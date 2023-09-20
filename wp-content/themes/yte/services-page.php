<?php
/*
Template Name: Services
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
<?php	$loop = new WP_Query( array( 'post_type' => 'tf_services', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1 ) );  if ( $loop && $loop->post_count > 0 ) : ?>
<div class="grid flex">
	<div class="block">

		<div class="col_4">
			<ul class="services-tabs tabs">
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<li><a href="#" title="service-tab-<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>
		</div>

		<div class="col_8">
			<div id="tabcontent">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div id="service-tab-<?php echo get_the_ID(); ?>" class="tabcontents">
					<div class="service-details">
						<h2><?php the_title(); ?></h2>
						<div class="service-image shadow-left-red"><?php the_post_thumbnail( 'large' ); ?></div>
						<?php the_content(); ?>
					</div>
				</div>
			<?php endwhile; ?>
			</div>
		</div>

	</div>
</div>
<?php endif; wp_reset_query(); ?>



<?php get_footer(); ?>
