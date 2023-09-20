<?php 
require_once vc_path_dir('SHORTCODES_DIR', 'vc-column.php');
class WPBakeryShortCode_multiple_map_list extends WPBakeryShortCode_VC_Column {
	protected $controls_css_settings = 'tc vc_control-container';

	protected $controls_list = array('add', 'edit', 'clone', 'delete');
	public function __construct( $settings ) {
		parent::__construct( $settings );
	}


	public function mainHtmlBlockParams( $width, $i ) {
		return 'data-element_type="' . $this->settings["base"] . '" class="wpb_' . $this->settings['base'] . ' wpb_sortable wpb_content_holder wpb_content_element"' . $this->customAdminBlockParams();
	}

	public function containerHtmlBlockParams( $width, $i ) {
		return 'class="wpb_column_container vc_container_for_children"';
	}

	public function getColumnControls( $controls, $extended_css = '' ) {
		return $this->getColumnControlsModular($extended_css);
	}
}	

add_image_size( 'icon-map', 32, 32, false );

	/*---------------------------------------------------------------*/
	/* Creating Shortcode for Google Map.
	/*---------------------------------------------------------------*/

class WPBakeryShortCode_multiple_map_location extends WPBakeryShortCodesContainer {	
	protected function content($atts, $content = null) {
		 extract(shortcode_atts(array(
					  'el_class' => '',
					  'width' => '100%',
					  'height' => '400px',
					  'multiple_location_zoom'=> 11,
					  'single_location_zoom' =>10,
					  'lat' => 13.0432306,
					  'longi' => 80.1694868,
					  'infobox' => 'info',
					  'infobox_title' => '',
					  'map_type' => 'ROADMAP',
					  'streetview' => 'false',
					  'maptypecontrol' => 'false',
					  'scalecontrol' => 'false'	,
					  'show_all' => 'false',
					  'images' => '',
					  'location_column' => 4,
					  'hide_list_in_bottom' => 'block'
				   ), $atts));
			if($images !== ' '){
				$mapimg		=	wp_get_attachment_image_src($images,'icon-map');				
				$mapicon	=	$mapimg[0];				
			}else{
				$mapicon	=	'';
			}
			$el_class = $this->getExtraClass($el_class);
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $el_class, $this->settings['base'], $atts );
			$output = '<div class="googlemap '.$css_class.'"><div id="googleMap" style="width:'.$width.';height:'.$height.';"></div>';
			$output .= '<span style="display:'.$hide_list_in_bottom.'" class="all_location" onclick="initialize()">Show all</span>';
			$output .= '<input type="hidden" value="'.$mapicon.'" id="mapicon">';
			$output .= '<div class="location_list" style="display:'.$hide_list_in_bottom.'">';
			$output .= '<div class="add1 wpb_column vc_column_container sss_location">';
			$output .='<span class="address">'.$infobox.'</span></div>';	
			$output .= do_shortcode($content);
			$output .= '</div>';
			$output .= '<input type="hidden" value="'.$show_all.'" id="show_all">';
			$output .= '<input type="hidden" class="location_column" value="'.$location_column.'" >';
			$info_valu = wpautop($infobox); 
			$output .= '<input type="hidden" class="pinfobox" value="'.$info_valu.'" >';
			$output .= '</div>';		
			$output .= '<script>					jQuery.noConflict();	
					jQuery(document).ready(function(){
						if((jQuery(".add").html()=="")){
							jQuery(".all_location").css("display","none");
						}
						var pinfobox = "<div><b>"+ jQuery(".pinfobox").val()+"</b></div>";
						var location_column = jQuery(".location_column").val();
						jQuery(".sss_location").addClass("vc_col-sm-"+location_column);
						var show_all = jQuery("#show_all").val();
						if(show_all == "false"){
						initialize2('.$lat.' , '.$longi.', pinfobox);
						}
						else{
							initialize();
						}
						jQuery(".add1").click(function(){
						var lati = '.$lat.';
						var longi = '.$longi.';	
						var infobox = pinfobox;
						initialize2(lati , longi, pinfobox);
						});
						jQuery(".add").click(function(){
						var lati = jQuery(this).find(".mlatitude").val();
						var longi = jQuery(this).find(".mlongitude").val();	
						var infobox = "<div><b>"+jQuery(this).find(".minfobox").val()+"</b></div>";
						initialize2(lati , longi, infobox);
						});
					});					
					
					function initialize2(lati , longi, infobox)
					{
						var googlezoom = jQuery(".googlezoom").val();
						var myCenter=new google.maps.LatLng(lati,longi);
						var mapProp = {
						center:myCenter,
						zoom:'.$single_location_zoom.',
						mapTypeId:google.maps.MapTypeId.'.$map_type.',
						streetViewControl:'.$streetview.',
						mapTypeControl:'.$maptypecontrol.',
						scaleControl:'.$scalecontrol.',
						};
						var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
						var iconBase = jQuery("#mapicon").val();
						var marker=new google.maps.Marker({
						  position:myCenter,
						  icon: iconBase
						  });

						marker.setMap(map);
						var infowindow = new google.maps.InfoWindow({
						content:infobox
						});
						google.maps.event.addListener(marker, "mouseover", function() {
						infowindow.open(map,marker);
						});
						
					}
					
					geocoder = new google.maps.Geocoder();
					
					function initialize() {           
							var pinfobox = "<div><b>"+ jQuery(".pinfobox").val()+"</b></div>";
							var Options = {
								zoom:'.$multiple_location_zoom.',
								center: latlng_pos,
								mapTypeId:google.maps.MapTypeId.'.$map_type.',
								streetViewControl:'.$streetview.',
								mapTypeControl:'.$maptypecontrol.',
								scaleControl:'.$scalecontrol.',
							};
							var map = new google.maps.Map(document.getElementById("googleMap"),Options);
							
							var infoWindow = new google.maps.InfoWindow;
							var latlng_pos=[];
							var j=1;
							var marker , content;
							
							marker = new google.maps.Marker({
									position: new google.maps.LatLng('.$lat.' , '.$longi.'),
									map: map,
									icon: "'.$mapicon.'",
									draggable: false
								});
							var infowindow = new google.maps.InfoWindow({
							content:"pinfobox"
							});
							google.maps.event.addListener(marker, "mouseover", (function(marker, content) {
								return function() {
									infoWindow.setContent(pinfobox);
									infoWindow.open(map, marker);
								}
							})(marker, content));
							
							 jQuery( ".add" ).each(function( index ) {
								 latlng_pos[0]=new google.maps.LatLng('.$lat.','.$longi.');
								latlng_pos[j]=new google.maps.LatLng(jQuery(this).find(".mlatitude").val(),jQuery(this).find(".mlongitude").val());
								j++;
								var addr = jQuery(this).find(".minfobox").val();
								var heading = jQuery(this).find(".map_title").val()
								var content = "<div><b>"+jQuery(this).find(".minfobox").val()+"</b></br>"+jQuery(this).find(".map_title").val()+"</div>";
								var icons = "'.$mapicon.'";
								marker = new google.maps.Marker({
									position: new google.maps.LatLng(jQuery(this).find(".mlatitude").val(),jQuery(this).find(".mlongitude").val()),
									map: map,
									icon: icons,
									draggable: false
								});
								google.maps.event.addListener(marker, "mouseover", (function(marker, content) {
								return function() {
									infoWindow.setContent(content);
									infoWindow.open(map, marker);
								}
							})(marker, content));
							}
							);
								
							
							// map: an instance of google.maps.Map object
							// latlng: an array of google.maps.LatLng objects
							var latlngbounds = new google.maps.LatLngBounds( );
							for ( var i = 0; i < latlng_pos.length; i++ ) {
								
						

							// add the double-click event listener
							google.maps.event.addListener(marker, "click", function(event){
								map = marker.getMap();

								map.setCenter(overlay.getPosition()); // set map center to marker position
								smoothZoom(map,'.$multiple_location_zoom.' , map.getZoom()); // call smoothZoom, parameters map, final zoomLevel, and starting zoom level
							})


							// the smooth zoom function
							function smoothZoom (map, max, cnt) {
								if (cnt >= max) {
										return;
									}
								else {
									y = google.maps.event.addListener(map, "zoom_changed", function(event){
										google.maps.event.removeListener(y);
										
										self.smoothZoom(map, max, cnt + 1);
									});
									setTimeout(function(){map.setZoom(cnt)}, 80);
								}
							}

					latlngbounds.extend( latlng_pos[ i ] );
							}
							
							map.fitBounds( latlngbounds );
							
					}
				</script>';
			return $output;
	}
}

	/*---------------------------------------------------------------*/
	/* Creating shortcode for map location list.
	/*---------------------------------------------------------------*/

class WPBakeryShortCode_multiple_map_location_list extends WPBakeryShortCode {
	protected function content($atts, $content = null) {
		 extract(shortcode_atts(array(
					  'latitude' => 51.17934297928927,
					  'longitude' => 6.591796875,
					  'address'  => 'Enter the address',
					  'el_class' => ''
 				   ), $atts));
				   $el_class = $this->getExtraClass($el_class);
				$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $el_class, $this->settings['base'], $atts );
				  
		$output = '<div class="add wpb_column vc_column_container sss_location '.$css_class.'">';
								$output .='<span class="address">'.$address.'</span>';
								$output .='<input type="hidden" class="mlatitude" value="'.$latitude.'" >';
								$output .='<input type="hidden" class="mlongitude" value="'.$longitude.'" >';	
								$output .='<input type="hidden" class="minfobox" value="'.$address.'" >';	
								$output .='<input type="hidden" class="map_title" value="" >';
								$output .= wpb_js_remove_wpautop($content, true);  // remove unwanted tags in html
							$output .='</div>';	
			return $output;

	}
}

	/*---------------------------------------------------------------*/
	/* register shortcode in visual composer.
	/*---------------------------------------------------------------*/

//Google map
vc_map( array(
   "name" => __('Multiple map location', 'js_composer'),
   "base" => "multiple_map_location",
    "class" => "multiple_map_location",
	"icon" => "vc_multiple_map_location",
   "category" => __('Google Map'),
    "as_parent" => array('only' => 'multiple_map_location_list'),
	"description" => __('Multiple map location', 'js_composer'),
   "content_element" => true,
	"show_settings_on_create" => true,
	"admin_enqueue_css" => array( VCMM_PLUGIN_URL . 'assets/style.css'),
   "params" => array(
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __('Map width', 'js_composer'),
         "param_name" => "width",
         "value" => __(""),
         "description" => __("Default value is 100%", 'js_composer'),
      ),
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __('Map Height', 'js_composer'),
         "param_name" => "height",
         "value" => __(""),
         "description" => __("Default value is 400px", 'js_composer'),
      ),
	  array(
        "type" => "attach_images",
        "heading" => __("Marker image:", "js_composer"),
        "param_name" => "images",
        "value" => "",
        "description" => __("Select images from media library (Size:32x32).", "js_composer"),
		"group" => 'Map style'
      ),
	  array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __('Show address list', 'js_composer'),
         "param_name" => "hide_list_in_bottom",
         "value" => array(__("Yes", "js_composer") => "block", __("No", "js_composer") => "none"),
		 "group" => 'Map style'
      ),
	  array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __('Show all locations', 'js_composer'),
         "param_name" => "show_all",
         "value" => array(__("No", "js_composer") => "false",__("Yes", "js_composer") => "true"),
		 "group" => 'Map style'
      ),
	   array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __('Number of column for location names', 'js_composer'),
         "param_name" => "location_column",
         "value" => array(__("One", "js_composer") => 12, __("Two", "js_composer") => 6, __("Three", "js_composer") => 4, __("Four", "js_composer") => 3, __("Six", "js_composer") => 2),
		 "group" => 'Map style'
      ),
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __('Multiple location Zoom', 'js_composer'),
         "param_name" => "multiple_location_zoom",
         "value" => __(""),
         "description" => __("Default value is 11", 'js_composer'),
		 "group" => 'Map style'
      ),
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __('Single location zoom', 'js_composer'),
         "param_name" => "single_location_zoom",
         "value" => __(""),
         "description" => __("Default value is 10", 'js_composer'),
		 "group" => 'Map style'
      ),
	  array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Map type", "js_composer"),
		"param_name" => "map_type",
		"admin_label" => true,
		"value" => array(__("Roadmap", "js_composer") => "ROADMAP", __("Satellite", "js_composer") => "SATELLITE", __("Hybrid", "js_composer") => "HYBRID", __("Terrain", "js_composer") => "TERRAIN"),
		"group" => "Map style"
		),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Street view control", "js_composer"),
		"param_name" => "streetview",
		"value" => array(__("Disable", "js_composer") => "false", __("Enable", "js_composer") => "true"),
		"group" => "Map style"
		),
	array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __('scaleControl', 'js_composer'),
         "param_name" => "scalecontrol",
         "value" => array(__("Disable", "js_composer") => "false", __("Enable", "js_composer") => "true"),
		 "group" => 'Map style'
      ),
	  array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __('mapTypeControl', 'js_composer'),
         "param_name" => "maptypecontrol",
         "value" => array(__("Disable", "js_composer") => "false", __("Enable", "js_composer") => "true"),
		 "group" => 'Map style'
      ),
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __('Latitude', 'js_composer'),
         "param_name" => "lat",
         "value" => __(""),
         "description" => __("Enter the latitude", 'js_composer'),
		 "group" => 'Primary address'
      ),
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __('Longitude', 'js_composer'),
         "param_name" => "longi",
         "value" => __(""),
         "description" => __("Enter the longitude", 'js_composer'),
		 "group" => 'Primary address'
      ),
	  array(
         "type" => "textarea",
         "class" => "",
         "heading" => __('Infobox', 'js_composer'),
         "param_name" => "infobox",
         "value" => __(""),
         "description" => __("Enter the address", 'js_composer'),
		 "group" => 'Primary address'
      ),	  
	  array(
				"type" => "textfield",
				"heading" => __( 'Extra class name', 'js_composer' ),
				"param_name" => "el_class",
				"description" => __( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'js_composer' )
			),
	  ),
	  "js_view" => 'VcColumnView'
) );

//Location list
vc_map( array(
	"name" => __('Multiple map location list', 'js_composer'),
	"base" => "multiple_map_location_list",
	"class" => "multiple_map_location_list",
	"icon" => "vc_multiple_map_location_plus",
	"category" => __('Google Map'),
	"content_element" => true,
    "as_child" => array('only' => 'multiple_map_location'),
	"is_container"    => false,
	"params" => array(
      array(
         "type" => "textfield",
		 "holder" => "div",
         "class" => "",
         "heading" => __('Latitude', 'js_composer'),
         "param_name" => "latitude",
         "value" => __("51.17934297928927"),
         "description" => __("Enter latitude distance.", 'js_composer'),
		 "group" => 'Coordinates'
      ),
	  array(
         "type" => "textfield",
		 "holder" => "div",
         "class" => "",
         "heading" => __("Longitude", 'js_composer'),
         "param_name" => "longitude",
         "value" => __("6.591796875"),
         "description" => __("Enter Longitude distance", 'js_composer'),
		 "group" => 'Coordinates'
      ),
	   array(
         "type" => "textarea",
         "class" => "",
         "heading" => __("Address", 'js_composer'),
         "param_name" => "address",
         "value" => __("Address......."),
         "description" => __("Enter the address", 'js_composer'),
		 "group" => 'Coordinates'
      ),
	   array(
				"type" => "textfield",
				"heading" => __( 'Extra class name', 'js_composer' ),
				"param_name" => "el_class",
				"description" => __( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'js_composer' )
			),
    )
) ); 
