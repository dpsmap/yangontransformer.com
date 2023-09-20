<?php

function table_div_start($atts, $content=null){
	//return '<div class="table-section">';
  $output='';
  $output='<div class="table-section">'.do_shortcode($content).'</div>';
  return $output;
}
add_shortcode( 'tbl', 'table_div_start' );


function table_cell_div($atts, $content=null){

  extract(shortcode_atts(array(
    "class" => 'table-cell'
  ), $atts));

  $output='';
  $output='<div class="table-cell '.$class.'">'.do_shortcode(shortcode_unautop($content)).'</div>';
  return $output;
}
add_shortcode( 'tcell', 'table_cell_div' );

function row_start($atts, $content=null){
	  $output='';
  $output='<div class="row">'.do_shortcode($content).'</div>';
  return $output;
}
add_shortcode( 'row', 'row_start' );

function out_column($atts, $content=null){

  extract(shortcode_atts(array(
    "class" => '6'
  ), $atts));

  $output='';
  $output='<div class="col_'.$class.'">'.do_shortcode($content).'</div>';
  return $output;
}
add_shortcode( 'column', 'out_column' );

function contact_icon_output($atts, $content=null){

  extract(shortcode_atts(array(
    "class" => 'ti-'
  ), $atts));

  $output='';
  $output='<i class="ti-'.$class.'">'.$content.'</i>';
  return $output;
}
add_shortcode( 'contact_icon', 'contact_icon_output' );


function web_mockup($atts, $content=null){
  $output='';
  $output='<div class="web-mockup animated fadeIn">'.$content.'</div>';
  return $output;
}
add_shortcode( 'browser', 'web_mockup' );


//move wpautop filter to AFTER shortcode is processed
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 99);
add_filter( 'the_content', 'shortcode_unautop',100 );
