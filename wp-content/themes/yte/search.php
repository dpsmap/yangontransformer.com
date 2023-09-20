<?php get_header(); ?>


<div class="page-header" style="background-image:url(<?php echo get_template_directory_uri() . '/assets/images/header-bg.jpg'; ?>);">
  <div class="grid flex">
    <div class="block">
      <div class="col_12">
        <div class="col_4">
          <h1></h1>
        </div>
        <div class="col_8">

        </div>
      </div>
    </div>
  </div>
</div>


<div class="section">
  <div class="grid flex">
    <div class="block">

      <?php if ( have_posts() ) : ?>

        <div class="col_12">
          <h4 class="entry-title"><?php printf( __( 'Search Results for: %s', 'yte' ), get_search_query() ); ?></h4>

          <?php while ( have_posts() ) : the_post(); ?>
            <div class="search-result">
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <?php the_excerpt(); ?>
              <p class="search-url"><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></p>
            </div>
            <?php //get_template_part( 'entry' ); ?>
          <?php endwhile; ?>

        </div>

        <?php get_template_part( 'nav', 'below' ); ?>

      <?php else: ?>
        <h2 class="entry-title"><?php _e( 'Nothing Found', 'yte' ); ?></h2>
        <p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'blankslate' ); ?></p>

      <?php endif; ?>



    </div>
  </div>
</div>

<?php get_footer(); ?>
