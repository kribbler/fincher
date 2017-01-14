<?php
/**
 * category Accordion Widget
 *
 * @author 		TechieResource
 * @category 	Widgets
 * @package 	woocommerce-category-accordion/inc
 * @version 	1.0
 * @extends 	WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {


class wc_category_accordion extends WP_Widget {

	var $settings = array('title,trwca_count','exclude_tree','hide_empty');
	
	
	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */

    function wc_category_accordion() {
		
		/* Widget settings. */
		$widget_ops = array( 'description' => __('list WooCommerce product categories and subcategories into a toggle accordion.','trwca'));
		
		parent::WP_Widget( false, __( 'WC Category Accordion', 'trwca'), $widget_ops );
			
     }
		
	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
    function widget($args, $instance) {

		extract( $args, EXTR_SKIP );
		
		$instance = $this->woocommerce_category_accordion_defaults( $instance );
		
		extract( $instance, EXTR_SKIP );
		
		echo $before_widget;
		
		echo $before_title;
		
		if ($title) echo $title;
		
		echo $after_title;				
			
		global $wp_query;		
		
		global $post, $product;				

			
		$exclude_tree=esc_attr($exclude_tree );
		
			
		$hide_empty=esc_attr($hide_empty );
		$ac_speed=esc_attr($ac_speed );
		
		$instance_categories = get_terms( 'product_cat', '&parent=0&exclude='.$exclude_tree.'');		
			
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
<div class="block-content">
  <ul id="outer_ul">
    <?php $show_count=esc_attr( $trwca_count );

            $subcat_args = array(

                               'taxonomy' => 'product_cat',
                               'title_li' => '',
                               'show_count' => $show_count,
                               'hide_empty' => $hide_empty,
                               'echo' => false,
                               'exclude'  => $exclude_tree,
                               'show_option_none'   => __('No Categories Found','trwca'),
                               'link_after' => '',

                           );
?>
<?php $subcategories = wp_list_categories( $subcat_args );

      $subcategories = str_replace('<ul', '<em id="parent"></em><ul', $subcategories);

      $subcategories = preg_replace('/<\/a> \(([0-9]+)\)/', ' <span class="count">(\\1)</span></a>', $subcategories);
?>
<?php if ( $subcategories ) {
?>
<script type="text/javascript">
	 var ac_speed=<?php  echo $ac_speed; ?>
</script>
<?php echo $subcategories ?>
<?php
            } 
?>
</ul>
</div>
<?php

        echo $after_widget;
        }

        function update( $new_instance, $old_instance ) {

            $new_instance = $this->woocommerce_category_accordion_defaults( $new_instance );

            return $new_instance;

        }

        function woocommerce_category_accordion_defaults( $instance ) {

            $defaults = $this->wc_cat_accordion_get_settings();

            $instance = wp_parse_args( $instance, $defaults );
            
            $instance['title'] = $instance['title'];

            $instance['trwca_count'] =$instance['trwca_count'];
			
			$instance['ac_speed'] =$instance['ac_speed'];
			

            $instance['exclude_tree'] =$instance['exclude_tree'];

            
            $instance['hide_empty'] =$instance['hide_empty'];           

            if ( $instance['title'] =="" ) {

                $instance['title'] = $defaults['title'];

            }

            if ( $instance['trwca_count'] =="" ) {

                $instance['trwca_count'] = $defaults['trwca_count'];

            }

            if ( $instance['hide_empty'] =="" ) {

                $instance['hide_empty'] = $defaults['hide_empty'];

            }
			 if ( $instance['ac_speed'] =="" ) {

                $instance['ac_speed'] = $defaults['hide_empty'];

            }

            return $instance;

        }

        function wc_cat_accordion_get_settings() {



            // Set the default to a blank string

            $settings = array_fill_keys( $this->settings, '' );

            // Now set the more specific defaults

            $settings['title']  = "Categories";
			
            $settings['trwca_count']  = 1;
			
            $settings['exclude_tree']  = ""; 
			  
            $settings['hide_empty']  = 0;
			
			$settings['ac_speed']  = 300;
			

            return $settings;
        }

        function form($instance) {

            $instance = $this->woocommerce_category_accordion_defaults( $instance );
			
            extract( $instance, EXTR_SKIP );
?>
<p>
  <label for ="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title: ','trwca');
            ?></label>
  <input type="text" class="widefat"id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if(isset($title)) echo esc_attr($title) ?>"/>
</p>
<p>
  <input type="checkbox" name="<?php echo $this->get_field_name('trwca_count'); ?>" <?php if (esc_attr( $trwca_count )) {
                    echo "checked";
                } ?> class=""  size="4"  id="<?php echo $this->get_field_id('trwca_count'); ?>" />
  <label for ="<?php echo $this->get_field_id('trwca_count'); ?>">
    <?php _e('Enable Products Count','trwca_count');
            ?>
  </label>
</p><p>
  <input type="checkbox" name="<?php echo $this->get_field_name('hide_empty'); ?>" <?php if (esc_attr( $hide_empty )) {
                echo "checked";
            } ?> class=""  size="4"  id="<?php echo $this->get_field_id('hide_empty'); ?>" />
  <label for ="<?php echo $this->get_field_id('hide_empty'); ?>">
    <?php _e('Hide If Empty','trwca');
            ?>
  </label>
</p>
<p>
  <label for ="<?php echo $this->get_field_id('exclude_tree'); ?>"><?php echo __('Exclude Category (ID): ','trwca');
            ?></label>
  <input type="text" class="widefat"id="<?php echo $this->get_field_id('exclude_tree'); ?>" name="<?php echo $this->get_field_name('exclude_tree'); ?>" value="<?php if(isset($exclude_tree)) echo esc_attr($exclude_tree) ?>"/>
  <small>category IDs, separated by commas.</small>
</p>
<p>
  <label for ="<?php echo $this->get_field_id('ac_speed'); ?>"><?php echo __('Accodion Speed: ','trwca');
            ?></label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('ac_speed'); ?>" size="5" name="<?php echo $this->get_field_name('ac_speed'); ?>" value="<?php if(isset($ac_speed)) echo esc_attr($ac_speed) ?>"/>
 <small>Accordion speed(slideup / slidedown) in Milliseconds</small>
</p>
<?php
                                                         }

                                         }

add_action('widgets_init', 'wc_category_accordion_fn');

    function wc_category_accordion_fn()

	{
        register_widget('wc_category_accordion');

    }

}
?>