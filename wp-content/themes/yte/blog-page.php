<?php
/*
Template Name: Blog
*/

get_header(); ?>

<?php	$loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => -1 ) );  if ( $loop && $loop->post_count > 0 ) : ?>
<!-- Recent Blog Posts -->
	<div class="home-blog-posts">
		<div class="grid flex">
			<div class="block">
				<div class="col_12">

					<div class="blog-grid">
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

							<div class="home-blog-post auto-height">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'post-thumb' ); ?></a>
								<div class="post-meta-date"><?php echo get_the_date('j F Y, H:i');?></div>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</div>

						<?php endwhile; ?>

					</div>


				</div>
			</div>
		</div>
	</div>
<?php endif; wp_reset_query(); ?>
<!-- Recent Blog Posts -->



<?php get_footer(); ?>
