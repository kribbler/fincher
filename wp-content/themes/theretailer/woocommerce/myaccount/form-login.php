<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
global $theretailer_theme_options;

?>

<?php wc_print_notices(); ?>

<?php do_action('woocommerce_before_customer_login_form'); ?>


<div class="gbtr_login_register_wrapper">
                    
    <div class="gbtr_login_register_slider">    
              
		<div class='gbtr_login_register_slide_1'>

            <h2><?php _e( 'Login', 'theretailer' ); ?></h2>
    
            <form method="post" class="login">
    
                <?php do_action( 'woocommerce_login_form_start' ); ?>
    
                <p class="form-row form-row-wide">
                    <label for="username"><?php _e( 'Username or email address', 'theretailer' ); ?> <span class="required">*</span></label>
                    <input type="text" class="input-text" name="username" id="username" />
                </p>
                <p class="form-row form-row-wide">
                    <label for="password"><?php _e( 'Password', 'theretailer' ); ?> <span class="required">*</span></label>
                    <input class="input-text" type="password" name="password" id="password" />
                </p>
    
                <?php do_action( 'woocommerce_login_form' ); ?>
    
                <p class="form-row">
                    <?php wp_nonce_field( 'woocommerce-login' ) ?>
                    <input type="submit" class="button" name="login" value="<?php _e( 'Login', 'theretailer' ); ?>" /> 
                    <label for="rememberme" class="inline gbtr_rememberme">
                        <input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'theretailer' ); ?>
                    </label>
                </p>
                <p class="lost_password">
                    <a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'theretailer' ); ?></a>
                </p>
    
                <?php do_action( 'woocommerce_login_form_end' ); ?>
    
            </form>
        
        </div>

		<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>
    
        <div class='gbtr_login_register_slide_2'>

            <h2><?php _e( 'Register', 'theretailer' ); ?></h2>
    
            <form method="post" class="register">
    
                <?php do_action( 'woocommerce_register_form_start' ); ?>
    
                <?php if ( get_option( 'woocommerce_registration_generate_username' ) == 'no' ) : ?>
    
                    <p class="form-row form-row-wide">
                        <label for="reg_username"><?php _e( 'Username', 'theretailer' ); ?> <span class="required">*</span></label>
                        <input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) esc_attr_e($_POST['username']); ?>" />
                    </p>
    
                <?php endif; ?>
    
                <p class="form-row form-row-wide">
                    <label for="reg_email"><?php _e( 'Email address', 'theretailer' ); ?> <span class="required">*</span></label>
                    <input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) esc_attr_e($_POST['email']); ?>" />
                </p>
    
                <p class="form-row form-row-wide">
                    <label for="reg_password"><?php _e( 'Password', 'theretailer' ); ?> <span class="required">*</span></label>
                    <input type="password" class="input-text" name="password" id="reg_password" value="<?php if ( ! empty( $_POST['password'] ) ) esc_attr_e( $_POST['password'] ); ?>" />
                </p>
    
                <!-- Spam Trap -->
                <div style="left:-999em; position:absolute;"><label for="trap"><?php _e( 'Anti-spam', 'theretailer' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
    
                <?php do_action( 'woocommerce_register_form' ); ?>
                <?php do_action( 'register_form' ); ?>
    
                <p class="form-row">
                    <?php wp_nonce_field( 'woocommerce-register', 'register') ?>
                    <input type="submit" class="button" name="register" value="<?php _e( 'Register', 'theretailer' ); ?>" />
                </p>
    
                <?php do_action( 'woocommerce_register_form_end' ); ?>
    
            </form>
        
        </div>
        
        <?php endif; ?>

	</div>

</div>

<div class="gbtr_login_register_switch">
    <div class="gbtr_login_register_label_slider">
        <div class="gbtr_login_register_reg">
        	<h2><?php _e('Register', 'theretailer'); ?></h2>
            <?php echo $theretailer_theme_options['registration_content']; ?>
            <input type="submit" class="button" name="create_account" value="<?php _e('Register', 'theretailer'); ?>">
        </div>
        <div class="gbtr_login_register_log">
        	<h2><?php _e("I'm a Returning Customer", "theretailer"); ?></h2>
            <?php echo $theretailer_theme_options['login_content']; ?>
            <input type="submit" class="button" name="create_account" value="<?php _e('Login', 'theretailer'); ?>">
        </div>
    </div>
</div>

<div class="clr"></div>

<?php do_action('woocommerce_after_customer_login_form'); ?>

<?php if ( isset($_POST["gbtr_login_register_section_name"]) && $_POST["gbtr_login_register_section_name"] == "register") { ?>

<script type="text/javascript">
<!--//--><![CDATA[//><!--
jQuery(document).ready(function($) {
	 $('.gbtr_login_register_slider').animate({
		left: '-500',
	 }, 0, function() {
		// Animation complete.
	 });
	 
	 $('.gbtr_login_register_wrapper').animate({
		height: $('.gbtr_login_register_slide_2').height() + 100
	 }, 0, function() {
		// Animation complete.
	 });
	 
	 $('.gbtr_login_register_label_slider').animate({
		top: '-500',
	 }, 0, function() {
		// Animation complete.
	 });
});
//--><!]]>
</script>

<?php } ?>