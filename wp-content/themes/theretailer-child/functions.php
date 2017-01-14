<?php
//var_dump(get_bloginfo('language'));
add_action('widgets_init', 'woocommerce_register_widgets_CUSTOM', 11);

function woocommerce_register_widgets_CUSTOM() {
	include_once( 'widgets/fincher-product-categories.php' );
	register_widget( 'Fincher_WC_Widget_Product_Categories' );
}
	
add_action( 'after_setup_theme', 'my_child_theme_setup' );
function my_child_theme_setup() {
    load_child_theme_textdomain( 'theretailer', get_stylesheet_directory() . '/languages' );
}
//load_child_theme_textdomain( 'theretailer', get_template_directory() . '/languages' );

add_filter( 'woocommerce_thankyou_bacs', 'special_bacs' );
function special_bacs($content){
	//echo 'da';
	//var_dump($content);
	//return NULL;
}