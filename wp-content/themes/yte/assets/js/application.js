jQuery(document).ready(function($) {

  $('body').bind('touchstart', function() {});

  $("#nav-mobile").html($(".navbar").html() + $(".metanav ul").html());


  $("#nav-trigger a").click(function(e) {
    e.preventDefault();
    $(this).toggleClass('active');
    $('#nav-mobile').slideToggle();

    $(this).find('i').toggleClass('fa-bars fa-times');



  });

  $("#nav-mobile li a").on('click', function(e) {
    //e.preventDefault();
    //Following events are applied to the subnav itself (moving subnav up and down)
    if ($(this).parent().find("ul").length > 0) {

      e.preventDefault();

      //$(this).parent().find(".dropnav").slideToggle(); //Drop down the subnav on click
      $(this).parent().find("ul").slideToggle(function() {
        $(this).parent('li').toggleClass('active', $(this).parent().find('ul').is(':visible'));
        //alert($(this).parent('li').html());
      });

    }

  });

  if($('.gallery').length > 0)
  {
    $('.gallery').each(function()
    {
      $(this).magnificPopup({
        delegate: '.gallery-item a', // the selector for gallery item
        type: 'image',
        gallery: {
          enabled:true
        },
        callbacks: {
          beforeOpen: function() {
            startWindowScroll = $(window).scrollTop();
          },
          close: function() {
            $(window).trigger('resize');
          }
        }
      });
    });
  }

  if ($('.slider').length > 0) {

    $('.slide').each(function() {
      var imgpath = $(this).data('bgimg');
      $(this).css('background-image', 'url(' + imgpath + ')');
    });

    $('.slider').slick({
      dots: false,
      accessibility: false,
      arrows: true,
      autoplay: true,
      infinite: false,
      speed: 1000,
      cssEase: 'linear',
      lazyLoad: 'ondemand',
      lazyLoadBuffer: 0,
      //vertical: true,
      fade: true,
      pauseOnHover: false,
      draggable: false,
      adaptiveHeight: false,
      autoplaySpeed: 10000,
      slidesToShow: 1,
      slidesToScroll: 1,
      prevArrow: '<i class="fa fa-angle-left slider-arrow prev-arrow"></i>',
      nextArrow: '<i class="fa fa-angle-right slider-arrow next-arrow"></i>'
    });




  }

  if ($('.past-projects-slider').length > 0) {



    $('.past-projects-slider').slick({
      dots: false,
      accessibility: false,
      arrows: false,
      autoplay: false,
      infinite: true,
      speed: 500,
      cssEase: 'linear',
      lazyLoad: 'ondemand',
      lazyLoadBuffer: 0,
      //vertical: true,
      //fade: true,
      pauseOnHover: false,
      draggable: false,
      adaptiveHeight: true,
      autoplaySpeed: 5000,
      slidesToShow: 1,
      slidesToScroll: 1
    });

    $('.next-project').on('click', function(e){
      $('.past-projects-slider').slick('slickNext');
    });

    $('.prev-project').on('click', function(e){
      $('.past-projects-slider').slick('slickPrev');
    });




  }


  if ($('.yte-slick-slider').length > 0) {

    $('.yte-slick-slider').slick({
      dots: true,
      accessibility: false,
      arrows: true,
      autoplay: false,
      infinite: true,
      speed: 500,
      cssEase: 'linear',
      lazyLoad: 'ondemand',
      lazyLoadBuffer: 0,
      //vertical: true,
      //fade: true,
      pauseOnHover: false,
      draggable: false,
      adaptiveHeight: true,
      autoplaySpeed: 5000,
      slidesToShow: 1,
      slidesToScroll: 1,
      prevArrow: '<i class="fa fa-angle-left slick-slider-arrow prev-arrow"></i>',
      nextArrow: '<i class="fa fa-angle-right slick-slider-arrow next-arrow"></i>',
    });
  }

  if ($('.user-slider').length > 0) {

    $('.user-slider').slick({
      dots: false,
      accessibility: false,
      arrows: true,
      autoplay: true,
      infinite: true,
      speed: 500,
      pauseOnHover: true,
      draggable: true,
      centerMode: true,
      focusOnSelect: true,
      adaptiveHeight: false,
      autoplaySpeed: 4000,
      slidesToShow: 5,
      slidesToScroll: 1,
      asNavFor: '.comments-slider',
      prevArrow: '<i class="fa fa-angle-left user-slider-arrow prev-arrow"></i>',
      nextArrow: '<i class="fa fa-angle-right user-slider-arrow next-arrow"></i>',
      responsive: [{
          breakpoint: 1024,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });

    $('.comments-slider').slick({
      dots: false,
      accessibility: false,
      arrows: false,
      draggable: true,
      fade: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      asNavFor: '.user-slider',

    });

  }

  var $animation_elements = $('.animated');
  var $window = $(window);

  function check_if_in_view() {
    var window_height = $window.height();
    var window_top_position = $window.scrollTop();
    var window_bottom_position = (window_top_position + window_height);

    $.each($animation_elements, function() {
      var $element = $(this);
      var element_height = $element.outerHeight();
      var element_top_position = $element.offset().top;
      var element_bottom_position = (element_top_position + element_height);

      //check to see if this current container is within viewport
      if ((element_bottom_position >= window_top_position) &&
        (element_top_position <= window_bottom_position)) {
        $element.addClass('in-view');
      } else {
        $element.removeClass('in-view');
      }
    });
  }

  $window.on('scroll resize', check_if_in_view);
  $window.trigger('scroll');

  // Equal Height Columns
  $(window).load(function() {
   equalheight('.auto-height');
  });

$(window).resize(function(){
 equalheight('.auto-height');
});



  equalheight = function(container){
  var currentTallest = 0,
    currentRowStart = 0,
    rowDivs = new Array(),
    $el,
    topPosition = 0;
  $(container).each(function() {

   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;
   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
       }

     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
   }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
     }
 });
 }

 $("#tabcontent .tabcontents").hide(); // Initially hide all content
 $("ul.tabs li:first").attr("class", "active"); // Activate first tab
 $("#tabcontent div:first").fadeIn('fast'); // Show first tab content
 $('ul.tabs a').click(function(e) {
     e.preventDefault();
     $("#tabcontent .tabcontents").hide(); //Hide all content
     $("ul.tabs li").attr("class", ""); //Reset id's
     $(this).parent().attr("class", "active"); // Activate this
     $('#' + $(this).attr('title')).show(); // Show content for current tab
 });


 jQuery(document).on('click', '.vc_tta-tabs-list a', function() {
   //jQuery(window).trigger('resize');
   var tabcontainer =$(this).attr('href');

   //if(tabcontainer.hasClass('yte-slick-slider'))
   if ($(tabcontainer+'.vc_active .yte-slick-slider').length > 0)
   {
     $('.yte-slick-slider').slick('setPosition');
   }

   //alert('Good');

});


});



/* Target Blank for external links */
jQuery(function() {
  jQuery('a[rel~=external]').attr('target', '_blank');
});
