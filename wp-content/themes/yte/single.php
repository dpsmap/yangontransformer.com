<?php get_header(); ?>

<div class="section">
  <div class="grid flex">
    <div class="block">

      <div class="col_8">
        <div class="blog-post">

          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <?php get_template_part( 'entry' ); ?>
          <?php if ( ! post_password_required() ) comments_template( '', true ); ?>
          <?php endwhile; endif; ?>

        </div>
      </div>

      <div class="col_4">
        <div class="blog-sidebar">
          asdf asdfsadfsdf
        </div>
      </div>

    </div>
  </div>
</div>
<?php get_footer(); ?>
