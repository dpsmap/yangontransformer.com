<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
  	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  	<?php endif; ?>
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>

    <!-- Header -->
  	<div class="header">
  		<div class="grid flex">
  			<div class="block ntm nbm">

  				<div class="col_12">
            <div class="header-contact-info">
              <ul>
                <li><i class="fa fa-phone"></i> +95 (1) 610613</li>
                <li><i class="fa fa-envelope-open"></i> yte@yangontransformer.com</li>
              </ul>
            </div>

  					<div class="logo  animated fadeInDown">
  						<?php yte_the_custom_logo(); ?>
  					</div>
            <div class="meta-wrapper">

              <div class="header-search">
                <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                  <input type="text" class="search-field" placeholder="<?php echo esc_attr_x( pll_e('Search...'), 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s"  title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>">
                  <button type="submit"><i class="fa fa-search"></i></button>
                </form>
              </div>

  						<div class="metanav animated fadeInRight">
  							<?php wp_nav_menu( array( 'theme_location' => 'meta-menu')); ?>
  						</div>
  					</div>
  				</div>

  				<div class="col_12 ntm nbm">
            <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_id' => 'nav-main', 'menu_class' => 'navbar' ) ); ?>
  				</div>

  			</div>
  		</div>

  		<div id="nav-trigger"><a href="#"><i class="fa fa-bars"></i></a></div>
  		<ul id="nav-mobile"></ul>

  	</div>
  	<!-- / Header -->
