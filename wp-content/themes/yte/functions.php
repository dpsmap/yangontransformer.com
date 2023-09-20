<?php

  require get_template_directory() . '/inc/slider.php';
  require get_template_directory() . '/inc/products.php';
  require get_template_directory() . '/inc/projects.php';
  require get_template_directory() . '/inc/services.php';
  require get_template_directory() . '/inc/jobs.php';
  //require get_template_directory() . '/inc/testimonials.php';


  /* Hide Admin Bar */
  add_filter('show_admin_bar', '__return_false');

  //add_filter( 'use_default_gallery_style', '__return_false' );
  add_filter( 'use_default_gallery_style', '__return_false' );

  /* Disable Emojis & Extra Scripts */
  function disable_wp_emojicons()
  {
      // all actions related to emojis
    remove_action('admin_print_styles', 'print_emoji_styles');
      remove_action('wp_head', 'print_emoji_detection_script', 7);
      remove_action('admin_print_scripts', 'print_emoji_detection_script');
      remove_action('wp_print_styles', 'print_emoji_styles');
      remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
      remove_filter('the_content_feed', 'wp_staticize_emoji');
      remove_filter('comment_text_rss', 'wp_staticize_emoji');
  }
  add_action('init', 'disable_wp_emojicons');


// Active highlighting
// ----------------------------------------
function custom_menu_item_classes($classes = array(), $menu_item = false){


  // use this format for adding highlighting
  if((is_singular('tf_product') || is_post_type_archive('tf_productcategory') || is_tax('tf_productcategory')) && $menu_item->title == 'Products')
  {
		$classes[] = 'current-menu-item';
	}

	// use this format for adding highlighting
  if((is_singular('tf_project') || is_post_type_archive('tf_projectcategory') || is_tax('tf_projectcategory')) && $menu_item->title == 'Projects')
  {
		$classes[] = 'current-menu-item';
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'custom_menu_item_classes', 10, 2 );



  add_action('after_setup_theme', 'yte_setup');
  function yte_setup()
  {
      add_theme_support('title-tag');
      add_theme_support('automatic-feed-links');
      add_theme_support('post-thumbnails');

      add_image_size('post-thumb', 450, 300, true);
      add_image_size('user-thumb', 245, 245, true);
      add_image_size('product-thumb', 600, 400, true);

      add_theme_support('custom-logo', array(
      'height'      => 70,
      'width'       => 245,
      'flex-height' => true,
    ));

      register_nav_menus(
      array( 'main-menu' => __('Main Menu', 'cms'),
             'meta-menu' => __('Meta Menu', 'cms'),
             'footer-menu' => __('Footer Menu', 'cms'),
             'social-menu' => __('Social Links', 'cms') )
      );

    /* De-Register Embed Script */
    function my_deregister_scripts()
    {
        wp_deregister_script('wp-embed');
    }
      add_action('wp_footer', 'my_deregister_scripts');


    /* Define Excerpt Length */
    function custom_excerpt_length($length)
    {
        return 50;
    }
    add_filter('excerpt_length', 'custom_excerpt_length', 999);

    function has_gallery($post_id = false) {

      if(!empty($post))
      {
        if (!$post_id) {
          global $post;
        } else {
          $post = get_post($post_id);
        }
        return (strpos($post->post_content,'[gallery') !== false);
        //return get_post_gallery($post_id);

      }
      else {
        return false;
      }

    }



    add_action('wp_enqueue_scripts', 'yte_load_scripts');
    function yte_load_scripts()
    {
          global $post;
          wp_enqueue_style('yte-style', get_stylesheet_uri());
          wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array( 'jquery' ), '20160816', true);
          wp_enqueue_script('smoothscroll', get_template_directory_uri() . '/assets/js/smoothscroll.js', array( 'jquery' ), '20160816', true);

          if (is_front_page()):
            wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), '20160816', true);
            wp_enqueue_style('slick-css', get_template_directory_uri() . '/assets/css/slick.css');
          endif;

          if ($post && strpos($post->post_content,'[gallery') != false):
            wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), '20160816', true);
            wp_enqueue_style('popup-css', get_template_directory_uri() . '/assets/css/magnific-popup.css');

          endif;
          wp_enqueue_script('application-script', get_template_directory_uri() . '/assets/js/application.js', array( 'jquery' ), '20160816', true);
      }

    /* Logo Selection */
    if (! function_exists('yte_the_custom_logo')) {
        function yte_the_custom_logo()
        {
            if (function_exists('the_custom_logo')) {
                the_custom_logo();
            }
        }
    }

    /* Title Formatting */
    add_filter('document_title_separator', 'cms_document_title_separator');
      function cms_document_title_separator($sep)
      {
          $sep = "|";
          return $sep;
      }
      add_filter('the_title', 'yte_title');
      function yte_title($title)
      {
          if ($title == '') {
              return '&rarr;';
          } else {
              return $title;
          }
      }
    /* End Title Formatting */

    /* Widgets Settings */
    add_action('widgets_init', 'yte_widgets_init');
      function yte_widgets_init()
      {
          register_sidebar(array(
        'name' => __('Sidebar Widget Area', 'yte'),
        'id' => 'primary-widget-area',
        'before_widget' => '<div class="widget-block">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        ));

          register_sidebar(array(
          'name' => __('Custom Sidebar Area', 'yte'),
          'id' => 'custom-widget-area',
          'before_widget' => '<div id="%1$s" class="widget-container home-widget %2$s">',
          'after_widget' => "</div>",
          'before_title' => '<h3 class="widget-title">',
          'after_title' => '</h3>',
          ));

          register_sidebar(array(
          'name' => __('Footer Logos', 'yte'),
          'id' => 'footer-col',
          'before_widget' => '',
          'after_widget' => "",
          'before_title' => '',
          'after_title' => '',
      ));
      }
    /* End Widget Settings */
  }

  vc_map(array(
        'name'     => esc_html__('Product Box', 'yte'),
        'base'     => 'yte_product_box',
        'category' => __('YTE Elements', 'yte'),
        'params'   => array(
            array(
                'type'       => 'textfield',
                'holder'     => 'div',
                'heading'    => esc_html__('Title', 'yte'),
                'param_name' => 'title',
            ),
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text', 'yte'),
                'param_name' => 'content',
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Class', 'yte'),
                'param_name' => 'class'
            ),
      array(
                'type'       => 'vc_link',
                'heading'    => esc_html__('URL Link', 'yte'),
                'param_name' => 'url'
            ),
      array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Product Image', 'yte'),
                'param_name' => 'productimg'
            ),
        )
    ));

  add_shortcode('yte_product_box', 'yte_product_box_func');
  function yte_product_box_func($atts, $content)
  {
      extract($atts);

    //$content = wpb_js_remove_wpautop($content, true);

    $link = vc_build_link($url);
      $prodimg = wp_get_attachment_image_src($productimg, 'product-thumb');

      $html = '
      <div class="product-box-wrapper">
        <div class="product-box">
          <div class="product-thumb">
            <a href="'.$link['url'].'"><img src="'.urldecode($prodimg[0]).'"></a>
          </div>
          <h4><a href="'.$link['url'].'">'.$title.'</a></h4>
        </div>
      </div>';


      return $html;

   //return "<div style='color:{$color};'>foo = {$foo}</div>";
  }



  vc_map(array(
        'name'     => esc_html__('Feature Box', 'yte'),
        'base'     => 'yte_feature_box',
        'category' => __('YTE Elements', 'yte'),
        'params'   => array(
            array(
                'type'       => 'textfield',
                'holder'     => 'div',
                'heading'    => esc_html__('Title', 'yte'),
                'param_name' => 'title',
            ),
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text', 'yte'),
                'param_name' => 'content',
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Custom Class', 'yte'),
                'param_name' => 'class'
            ),
      array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Select Icon', 'yte'),
                'param_name' => 'icon'
            ),
        )
    ));

  add_shortcode('yte_feature_box', 'yte_feature_box_func');
  function yte_feature_box_func($atts, $content)
  {
      extract($atts);
      $imageSrc = wp_get_attachment_image_src($icon);
      $html ='
    <div class="feature">
      <div class="feature-icon">
        <img src="'.$imageSrc[0].'">
      </div>
      <div class="feature-info">
        <h4>'.$title.'</h4>
        <p>'.$content.'</p>
      </div>
    </div>';


      return $html;

   //return "<div style='color:{$color};'>foo = {$foo}</div>";
  }


  vc_map(array(
        'name'     => esc_html__('Page Header', 'yte'),
        'base'     => 'yte_page_header',
        'category' => __('YTE Elements', 'yte'),
        'params'   => array(
            array(
                'type'       => 'textfield',
                'holder'     => 'div',
                'heading'    => esc_html__('Sub Title', 'yte'),
                'param_name' => 'subtitle',
            ),
      array(
                'type'       => 'textfield',
                'holder'     => 'div',
                'heading'    => esc_html__('Title', 'yte'),
                'param_name' => 'title',
            ),
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text', 'yte'),
                'param_name' => 'content',
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Custom Class', 'yte'),
                'param_name' => 'class'
            ),
      array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Background Image', 'yte'),
                'param_name' => 'bgimg'
            ),
        )
    ));

  add_shortcode('yte_page_header', 'yte_page_header_func');
  function yte_page_header_func($atts, $content)
  {
      extract($atts);
      $imageSrc2 = wp_get_attachment_image_src($bgimg, 'full');
      $html ='
    <div class="page-header" style="background-image:url('.urldecode($imageSrc2[0]).');">
      <div class="grid flex">
        <div class="block">
          <div class="col_12">
            <div class="col_4">
            <h1>';

      isset($subtitle) && $subtitle != "" ?  $subtitle2 = '<em>'.$subtitle.'</em>' : $subtitle2="";
      $html.=
              $subtitle2.'
              <strong><span>'.$title.'</span></strong>
            </h1>
            </div>
            <div class="col_8">
              <p>'.$content.'</p>
            </div>


          </div>
        </div>
      </div>
    </div>';


      return $html;

   //return "<div style='color:{$color};'>foo = {$foo}</div>";
  }

  vc_map(array(
  'name'     => __('YTE Heading'),
  'base'     => 'yte_heading',
  'category' => __('YTE Elements', 'yte'),
  'params'   => array(
    array(
      'type'       => 'textfield',
      'holder'     => 'div',
      'heading'    => esc_html__('Heading Text', 'yte'),
      'param_name' => 'title',
    ),
    array(
      'type'       => 'textfield',
      'holder'     => 'div',
      'heading'    => esc_html__('Sub Title', 'yte'),
      'param_name' => 'subtitle',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => __('Select Heading Style'),
      'param_name'  => 'heading_style',
      'admin_label' => true,
      'value'       => array(
        'Please Select ' => '',
        'Line Through 1'  => 'heading-line-through',
        'Center Heading '  => 'heading-center',
        'Line Through 2'  => 'heading-line-through2',
        'Advance Heading'  => 'advance-heading'
      ),
      'description' => __('The description')
      )
    )
  )
);

add_shortcode('yte_heading', 'yte_heading_func');
function yte_heading_func($atts)
{
    extract($atts);

    if (!isset($subtitle)) {
        $html ='
      <h2 class="'.$heading_style.'"><span>'.$title.'</span></h2>';
    } else {
        $html ='
      <h2 class="'.$heading_style.'"><span>'.$subtitle.'</span>'.$title.'</h2>';
    }


    return $html;

 //return "<div style='color:{$color};'>foo = {$foo}</div>";
}

vc_map(array(
'name'     => __('YTE Projects Slider'),
'base'     => 'yte_projects_slider',
'category' => __('YTE Elements', 'yte'),
'params'   => array(
  array(
    'type'       => 'textfield',
    'holder'     => 'div',
    'heading'    => esc_html__('Heading Text', 'yte'),
    'param_name' => 'title',
  ),
  )
)
);

add_shortcode('yte_projects_slider', 'yte_projects_slider_func');
function yte_projects_slider_func($atts)
{
    //extract( $atts );

  $html = '
  	     <div class="past-projects-wrapper">
  		     <div class="past-projects-slider">';

    $loop = new WP_Query(array( 'post_type' => 'tf_project', 'posts_per_page' => 5 ));
    if ($loop && $loop->post_count > 0) :
  while ($loop->have_posts()) : $loop->the_post();
    $imgsrc=wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
    $html .='<div class="project-slide" style="background-image: url('.$imgsrc[0].');">
                  <div class="grid flex">
                    <div class="block ntm nbm">
                      <div class="col_5 push_7 ntm nbm">
                        <div class="project-text-overlay">

                          <h3><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h3>'.
                          nl2br(get_the_excerpt()) .'
                          <span class="prev-project"><i class="fa fa-angle-left"></i></span>
                          <span class="next-project"><i class="fa fa-angle-right"></i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>';
    endwhile;

    $html .='</div>
          </div>';
    endif;
    wp_reset_query();


    return $html;

 //return "<div style='color:{$color};'>foo = {$foo}</div>";
}


vc_map(array(
      'name'     => esc_html__('Slick Slider', 'yte'),
      'base'     => 'yte_slickslider_box',
      'category' => __('YTE Elements', 'yte'),
      'params'   => array(
          array(
              'type'       => 'textfield',
              'holder'     => 'div',
              'heading'    => esc_html__('Widget Title', 'limecom'),
              'param_name' => 'title',
          ),
          array(
              'type'       => 'attach_images',
              'heading'    => esc_html__('Select Images', 'limecom'),
              'param_name' => 'slides'
          ),
      )
  ));

add_shortcode('yte_slickslider_box', 'yte_slickslider_box_func');
function yte_slickslider_box_func($atts, $content)
{
    extract($atts);

    $slides = explode(',', $slides);
    $images = array();
    wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), '20160816', true);
    wp_enqueue_style('slick-css', get_template_directory_uri() . '/assets/css/slick.css');

    $html = '<ul class="yte-slick-slider">';
    foreach ($slides as $slide) {
        $images[] = wp_get_attachment_image_src($slide, 'full');
    }

    foreach ($images as $image) {
        $html .= '<li><img src="'.urldecode($image[0]).'"></li>';
    }
    $html.= '</ul>';

    //return print_r($images);

    return $html;

    //return print_r($images);

 //return "<div style='color:{$color};'>foo = {$foo}</div>";
}

function cf7_add_post_id()
{
    global $post;
    $post_id= $post->ID;
    return get_the_title($post_id);
}
add_shortcode('CF7_ADD_POST_ID', 'cf7_add_post_id');

/* PolyLang Custom Strings */
function custom_strings(){
	pll_register_string('Search Placeholder', 'Search...');
	pll_register_string('No Jobs', 'No jobs found');
	pll_register_string('Job Openings', 'Job Openings');
	pll_register_string('Apply Now', 'Apply Now');
}

add_action('init', 'custom_strings');





require get_template_directory() . '/inc/custom-code.php';
