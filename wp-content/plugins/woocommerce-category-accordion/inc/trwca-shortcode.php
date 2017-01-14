<?php
/**
 * category Accordion Widget
 *
 * @author 		TechieResource
 * @category 	Shortcode
 * @package 	woocommerce-category-accordion/inc
 * @version 	1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
function wc_category_accordion_sc( $atts, $content = null)
{
	ob_start();
	extract(shortcode_atts(array(
        'show_count' => 1,
		'ac_speed' => 300,
		'exclude_cat'=>'',
		'hide_empty'=> 0
	
    ), $atts));
		
		global $wp_query,$post, $product;				

		$instance_categories = get_terms( 'product_cat', 'parent=0&exclude='.$exclude_cat.'');		
			
		if (is_array($instance_categories)) {

			foreach($instance_categories as $categories) {

				 $term_id[]= $categories->term_id;

				$term_name = $categories->name;
			}
		}

		if(!empty($post->ID))
		{
			$terms =get_the_terms( $post->ID, 'product_cat' );
		}
		else {
		
			$terms="";
		}
				
		
	
		if (is_array($terms )) {

			foreach ( $terms as $term) {

				$_cat=$term->term_id;

				break;

			}

		}

		
        /*For current category highlight*/ 
		$current_cat= array();
		
		$cat = $wp_query->get_queried_object();	
			 
		if (!empty($cat->term_id))

		{

			$current_cat = $cat->term_id;

		}
		

         else

         {                
             $_cat_id="1";

             if (isset($term->term_id))

                {
                   $_cat=$term->term_id;

                    if (!empty($_cat))

                    {
                        $_cat_id=$_cat;

                    }

                    else {
                        $_cat_id=1;
                    }

                }
				if (is_shop())

                {

                    $_cat_id="1";
                }
				if (!is_shop()){
					
					if (is_array($terms )) {					
				
				foreach($terms as $term)
 {
	  $myterms[]= $term->term_id; 
 }
?>
<script type="text/javascript">
 var cats_id=<?php  echo end($myterms); ?>
</script>
<style type="text/css">
<?php foreach((get_the_terms($post->ID, 'product_cat')) as $term) {
 $myterms= $term->term_id;
 echo 'ul#outer_ul li.cat-item-'.$myterms.' > a{font-weight:bold;}';
}
}
}
 ?>
</style>
<?php             
}
?>
<ul id="outer_ul" >
<?php 					 $subcat_args = array(

                               'taxonomy' => 'product_cat',
                               'title_li' => '',
                               'show_count' => $show_count,
                               'hide_empty' => $hide_empty,
                               'echo' => false,
                               'exclude'  => $exclude_cat,
                               'show_option_none'   => __('No categories','trwca'),
                               'link_after' => '',

                           );

?>
<?php	    $subcategories = wp_list_categories( $subcat_args );

            $subcategories = str_replace('<ul', '<em id="parent"></em><ul', $subcategories);

            $subcategories = preg_replace('/<\/a> \(([0-9]+)\)/', ' <span class="count">(\\1)</span></a>', $subcategories);

?>
<?php if ( $subcategories ) {
?>
<script type="text/javascript">
	var ac_speed=<?php  echo $ac_speed; ?>
</script> 
<?php echo $subcategories;
}
	
	$output = ob_get_contents();
	ob_end_clean();
	wp_reset_postdata();
	return $output;
?>
</ul>
<?php 
}

add_shortcode('WC-Category-Accordion', 'wc_category_accordion_sc');	
}
?>
