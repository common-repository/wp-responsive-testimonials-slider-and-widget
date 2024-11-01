<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP Responsive Testimonials Slider And Widget
 * @since 1.0
 */
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
class Rtsw_Script {
	
	function __construct() {
		add_action( 'wp_enqueue_scripts', array($this, 'rtsw_front_style') );
		add_action( 'wp_enqueue_scripts', array($this, 'rtsw_front_script') );
		 add_action( 'admin_enqueue_scripts', array($this, 'rtsw_backend_script') );		
	}
	/**
	 * Function to add style
	 * 
	 * @package WP Responsive Testimonials Slider And Widget
	 * @since 1.0
	 */
	function rtsw_front_style() {
		 // Registring font awesome style
		if( !wp_style_is( 'wpoh-fontawesome-css', 'registered' ) ) {
			wp_register_style( 'wpoh-fontawesome-css', RTSW_URL.'assets/css/font-awesome.min.css', array(), RTSW_VERSION);
			wp_enqueue_style( 'wpoh-fontawesome-css');	
		}		
		
			
		// Registring and enqueing slick css
		if( !wp_style_is( 'wpoh-slick-css', 'registered' ) ) {
			wp_register_style( 'wpoh-slick-css', RTSW_URL.'assets/css/slick.css', array(), RTSW_VERSION );
			wp_enqueue_style( 'wpoh-slick-css');		 	}
		
         // Registring and enqueing magnific css
		if( !wp_style_is( 'wpoh-magnific-css', 'registered' ) ) {
			wp_register_style( 'wpoh-magnific-css', RTSW_URL.'assets/css/magnific-popup.css', array(), RTSW_VERSION );
			wp_enqueue_style( 'wpoh-magnific-css');
		}  
		// Registring and enqueing public css
		wp_register_style( 'my-public-css', RTSW_URL.'assets/css/testimonials-style.css', null, RTSW_VERSION );
		wp_enqueue_style( 'my-public-css' );
		wp_register_style( 'my-video-js-css', RTSW_URL.'assets/css/video-js.css', null, RTSW_VERSION );
		wp_enqueue_style( 'my-video-js-css' );      
		
	}	
	/**
	 * Function to add script at front side
	 * 
	 * @package WP Responsive Testimonials Slider And Widget
	 * @since 1.0.0
	 */
	function rtsw_front_script() {		
		// Registring slick slider script
		if( !wp_script_is( 'wpoh-slick-js', 'registered' ) ) {
			wp_register_script( 'wpoh-slick-js', RTSW_URL.'assets/js/slick.min.js', array('jquery'), RTSW_VERSION, true );
		}        
        wp_register_script( 'rtsw-script-video', RTSW_URL.'assets/js/video.js', array('jquery'), RTSW_VERSION, true );
	    wp_enqueue_script('rtsw-script-video');	 
        
        if( !wp_script_is( 'wpoh-magnific-js', 'registered' ) ) {   
	    wp_register_script( 'wpoh-magnific-js', RTSW_URL.'assets/js/magnific-popup.min.js', array('jquery'), RTSW_VERSION, true );
	    wp_enqueue_script('wpoh-magnific-js');
	    }
		
		wp_register_script( 'rtsw-script', RTSW_URL.'assets/js/rtsw-public.js', array('jquery'), RTSW_VERSION, true );
	    wp_enqueue_script('rtsw-script');
		}
	function rtsw_backend_script(){
		wp_register_script( 'rtsw-shortcode', RTSW_URL.'assets/js/rtsw-admin.js', array('jquery'), RTSW_VERSION, true );
	    wp_enqueue_script('rtsw-shortcode');
	     wp_register_style( 'testimonials-admin-css', RTSW_URL.'assets/css/testimonials-admin.css', null, RTSW_VERSION );
		wp_enqueue_style( 'testimonials-admin-css' );
	}
}
$rtsw_script = new Rtsw_Script();