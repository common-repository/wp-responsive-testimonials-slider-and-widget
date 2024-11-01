<?php
/**
 * Plugin Name: WP Responsive Testimonials Slider And Widget
 * Plugin URI:https://wponlinehelp.com/plugins/
 * Text Domain: wp-responsive-testimonials-slider
 * Domain Path: /languages/
 * Description: A helpful module for WordPress Developer to add Client Testimonial to WordPress website. with two Layout Grid And Slider. with Many Design Template. 
 * Author: pareshpachani007
 * Author URI: https://wponlinehelp.com
 * Version: 1.5 
 * @package WordPress
  */
define( 'RTSW_VERSION', '1.5' ); 
define( 'RTSW_DIR', dirname( __FILE__ ) );
define( 'RTSW_URL', plugin_dir_url( __FILE__ ) ); 
define( 'RTSW_POST_TYPE', 'easy-testimonial' );
define( 'RTSW_CAT', 'testimonial-category' ); 
add_action('plugins_loaded', 'rtsw_textdomain');
function rtsw_textdomain() {
	load_plugin_textdomain( 'wp-responsive-testimonials-slider', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
 /* Function For Manage Category Shortcode Columns
 * 
 * @package WP Responsive Testimonials Slider And Widget
 * @since 1.0
 */	
add_filter("manage_testimonial-category_custom_column", 'testimonial_teams_columns', 10, 3);
add_filter("manage_edit-testimonial-category_columns", 'testimonial_teams_manage_columns'); 
function testimonial_teams_manage_columns($theme_columns) {
    $new_columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name'),
            'testimonial_shortcode' => __( 'Testimonial Category Shortcode', 'wp-responsive-testimonials-slider' ),
            'slug' => __('Slug'),
            'posts' => __('Posts')
			);
    return $new_columns;
}

function testimonial_teams_columns($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'testimonial-category');
    switch ($column_name) {      

        case 'title':
            echo get_the_title();
        break;
        case 'testimonial_shortcode':
		echo '[testimonials_grid category="' . $theme_id. '"]<br />';
		echo '[testimonials_slider category="' . $theme_id. '"]';
        break;

        default:
            break;
    }
    return $out;   

}	
//Script file
require_once( RTSW_DIR . '/includes/rtsw-script.php' );
// Function file file
require_once( RTSW_DIR . '/includes/testimonials-functions.php' );
// Post Type file
require_once( RTSW_DIR . '/includes/rtsw-post-types.php' );
// Widget file file
require_once( RTSW_DIR . '/includes/widget/wp-widget-testimonials.php' );
// Templates files file file
require_once( RTSW_DIR . '/includes/shortcodes/grid-testimonials-shortcode.php' );
require_once( RTSW_DIR . '/includes/shortcodes/slider-testimonials-shortcode.php' );
// How it work file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( RTSW_DIR . '/includes/admin/rtsw-help.php' );
}