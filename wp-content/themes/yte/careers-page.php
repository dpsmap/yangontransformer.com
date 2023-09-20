<?php
/*
Template Name: Job Board
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
<?php	$loop = new WP_Query( array( 'post_type' => 'tf_job', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1 ) );  if ( $loop && $loop->post_count > 0 ) : ?>
<div class="grid flex">
	<div class="block">
		<div class="col_8">
			<h3><?php pll_e('Job Openings'); ?></h3>
			<table class="jobs-table">
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<tr>
						<td><h4><?php echo get_the_title(); ?></h4></td>
						<td>
							<?php
								$tags=array();
								$post_tags= get_the_tags();
								foreach($post_tags as $tag)
								{
									$tags[] = $tag->name;
								}
								$tags= implode($tags, ', ');
								print_r($tags);
							?>
						</td>
						<td>
							<?php
								$post_categories=array();
								$cats=array();
								$category_detail=get_the_terms(get_the_ID(),'tf_jobcategory');
								foreach($category_detail as $cat)
								{
									$cats[] = $cat->name;
								}
								$cats= implode($cats, ', ');
								print_r($cats);

							 ?>
						</td>
						<td>
							<a href="<?php the_permalink(get_the_ID()); ?>"><?php pll_e('Apply Now'); ?></a>
						</td>
					</tr>
				<?php endwhile; ?>
			</table>

		</div>

	</div>
</div>
<?php else: ?>
	<div class="grid flex">
		<div class="block">
			<div class="col_12">
				<h2><?php pll_e('Job Openings'); ?></h2>
				<div class="alert alert-warning"><?php pll_e('No jobs found'); ?></div>
			</div>
		</div>
	</div>


<?php endif; wp_reset_query(); ?>



<?php get_footer(); ?>
