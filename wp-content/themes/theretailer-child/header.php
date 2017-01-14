<?php
if ($_SERVER['REMOTE_ADDR'] == '83.103.200.163' && 1==2) {
	$args = array( 
		'post_type' => 'product', 
		'posts_per_page' => 4000, 
		'post_status' => 'any',
		'orderby' => 'title', 
		'order' => 'ASC', 
		//'product_cat' => 'sedler'
	);
	$loop = new WP_Query( $args );
	$k = 0;
	while ( $loop->have_posts() ) : 
		$loop->the_post(); 
		global $product, $post; $k++;
		echo "<pre>";
		var_dump($product->id); var_dump($post->post_name);
		$categories = get_the_terms( $product->id, 'product_cat' );
		//var_dump($categories);
		foreach ($categories as $category) {
			$product_cat_id = $category->term_id;
			$product_parent_categories_all_hierachy = get_ancestors( $product_cat_id, 'product_cat' );  
			$last_parent_cat = array_slice($product_parent_categories_all_hierachy, -1, 1, true);
    		foreach($last_parent_cat as $last_parent_cat_value){
		        //echo '<strong>' . $last_parent_cat_value . '</strong>';
		        $product_master_category = get_term_by('id', $last_parent_cat_value, 'product_cat', ARRAY_A);
		        echo 'master cat';var_dump($product_master_category['name']);
		        if ($product_master_category['name'] == 'Mynter' || $product_master_category['name'] == 'Sedler'){
		        	echo 'hereeeee';
		        	$product->set_stock(0);
		        }
			}
		}

		//$stock = $product->get_stock_quantity();
		//$product->set_stock(1);
		//var_dump($stock);
	endwhile; 
	wp_reset_query(); 
	var_dump($k);
	die('i should be removed from header.php, dear daniel');
}
if ($_SERVER['REMOTE_ADDR'] == '83.103.200.163' && 1==2){
	$args = array( 'post_type' => 'product', 'posts_per_page' => 3000, 'orderby' => 'ID', 'order' => 'ASC');
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : 
		$loop->the_post(); 
		global $product; 
		//echo "<pre>";var_dump($product->id);
		
		wp_set_object_terms( $product->id, 'Postkort', 'product_shipping_class' , false);
		
		//$sc = $product->get_shipping_class();
		//$modell = woocommerce_get_product_terms($product->id, "product_shipping_class");
		//var_dump($sc);
		//var_dump($modell);
		
		//die();
	endwhile; 
	wp_reset_query(); 
	
	die();
}

global $woo_options;
global $woocommerce;
global $theretailer_theme_options;

$header_style = "";

if (isset($_GET["header_style"])) { $header_style = $_GET["header_style"]; }

if ($header_style == "default") {
    $theretailer_theme_options['gb_header_style'] = 0;
} elseif ($header_style == "centered") {
    $theretailer_theme_options['gb_header_style'] = 1;
} elseif ($header_style == "under") {
    $theretailer_theme_options['gb_header_style'] = 2;
}

?>

<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]--><head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- ******************************************************************** -->
<!-- ************************ Custom Favicon **************************** -->
<!-- ******************************************************************** -->

<?php
if ( !$theretailer_theme_options['favicon_image'] ) {
	
	if (is_ssl()) {
		$favicon_image_img = str_replace("http://", "https://", get_template_directory_uri() . "/favicon.ico");		
	} else {
		$favicon_image_img = get_template_directory_uri() . "/favicon.ico";	
	}
	
} else {
	
	if (is_ssl()) {
		$favicon_image_img = str_replace("http://", "https://", $theretailer_theme_options['favicon_image']);		
	} else {
		$favicon_image_img = $theretailer_theme_options['favicon_image'];
	}
}
?>

<link rel="shortcut icon" href="<?php echo $favicon_image_img; ?>" />

<!-- ******************************************************************** -->
<!-- *********************** Custom Javascript ************************** -->
<!-- ******************************************************************** -->

<?php if ( (isset($theretailer_theme_options['custom_js_header'])) && ($theretailer_theme_options['custom_js_header'] != "") ) : ?>
	<?php echo $theretailer_theme_options['custom_js_header']; ?>
<?php endif; ?>

<!-- ******************************************************************** -->
<!-- *********************** WordPress wp_head() ************************ -->
<!-- ******************************************************************** -->
	
<?php wp_head(); ?>
</head>

<!-- *********************************************************************** -->
<!-- ********************* EVERYTHING STARTS HERE ************************** -->
<!-- *********************************************************************** -->

<body <?php body_class(); ?>>
    
    <div id="global_wrapper">
    
    <?php if (file_exists(get_template_directory().'/_demo_top_message.php')) include_once('_demo_top_message.php'); ?>
  
    <?php if ( (!$theretailer_theme_options['hide_topbar']) || ($theretailer_theme_options['hide_topbar'] == 0) ) { ?>
    	<?php include_once('header_topbar.php'); ?>    
    <?php } ?>
    
    <?php if ((!$theretailer_theme_options['gb_header_style']) || ($theretailer_theme_options['gb_header_style'] == "0")) { ?>
    	<?php include_once('header_style_default.php'); ?>
	<?php } else if (($theretailer_theme_options['gb_header_style'] == "1")) { ?>
    	<?php include_once('header_style_centered.php'); ?>
    <?php } else if (($theretailer_theme_options['gb_header_style'] == "2")) { ?>
    	<?php include_once('header_style_menu_under.php'); ?>
    <?php } ?>