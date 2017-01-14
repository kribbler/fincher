<?php
/**
 * Plugin Name: WooCommerce Category Accordion.
 * Plugin URI: http://www.techieresource.com
 * Description: List WooCommerce product categories and subcategories into a toggle accordion with expand / collapse.
 * Version: 1.0
 * Author: TechieResource
 * Author URI: http://techieresource.com/woocommerce-category-accordion
 * Text Domain: trwca
 * Domain Path: /languages/
*/

/* Loads Plugin Text Domain */
function trwca_init() {
  load_plugin_textdomain( 'trwca', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );	
}
add_action('init', 'trwca_init');


/*-----------------------------------------------------------------------------------*/
/* Intialize Plugin scrits & styles*/
/*-----------------------------------------------------------------------------------*/

add_action('wp_enqueue_scripts', 'reg_trwca_scripts');
function reg_trwca_scripts(){
	$trwca = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	wp_enqueue_style('trwca_style', $trwca.'assets/css/style.css', array(), '1.0');	
	wp_enqueue_script('trwca_script', $trwca.'assets/js/script.min.js', array('jquery'), '1.0');
}


/*-----------------------------------------------------------------------------------*/
/* INCLUDE FILES: WooCommerce Category Accordion Widget*/
/*-----------------------------------------------------------------------------------*/

	include_once( 'inc/trwca-widget.php' );	
	include_once( 'inc/trwca-shortcode.php' );	
		
?>