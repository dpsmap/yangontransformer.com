<?php
/*
Plugin Name: VC Multiple Map Location
Plugin URI: http://themeforest.net/user/shrisaisolutions
Description: Easy multiple map location add-on for Visual Composer.
Version: 1.1.0
Author: Shri sai solutions
Author URI: http://www.shrisaisolutions.com
License: Envato Marketplaces Licence
License URI: Envato Marketplace Item License Certificate
*/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) die;


// Define constantss
define( 'VCMM_PLUGIN_MAIN', __FILE__);
define( 'VCMM_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'VCMM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


// Error notice
function vcmm_extend_error() {
	$plugin_data = get_plugin_data(__FILE__);
	echo '
	<div class="updated">
		<p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'aperture'), $plugin_data['Name']).'</p>
	</div>';
}


// Execute after all plugins loaded
add_action( 'plugins_loaded', 'vcmm_core_extend' );
function vcmm_core_extend() {

	// Display notice if Visual Composer is not installed or activated
	if ( !function_exists( 'vc_map' ) ) {
		add_action('admin_notices', 'vcmm_extend_error');
		return;
	}

	// Enqueue front-end CSS
	add_action('wp_enqueue_scripts', 'vcmm_extend_scripts');
	function vcmm_extend_scripts() {
		wp_register_style( 'vc-multiple-map-location', VCMM_PLUGIN_URL . 'assets/style.css', array('js_composer_front') );
		//wp_register_script( 'index', VCMM_PLUGIN_URL . 'assets/jquery.min.js', array('jquery') );
		wp_register_script( 'google-map-api', 'http://maps.googleapis.com/maps/api/js?key=AIzaSyD1ucxKMsgpzN5x6hC7kdQfdFA8Lc0mhLU', array('jquery') );

		wp_enqueue_style( 'vc-multiple-map-location' );
		wp_enqueue_script( 'jquery.min.js' );
		wp_enqueue_script( 'google-map-api' );
	}

	// Add Multiple Map location shortcode
	require_once ('extend-vc.php');

}
