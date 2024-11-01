<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Function to create custom post type
 * 
 * @package testimonial slider and widget
 * @since 1.0.0
 */
add_action( 'init','rstw_post_type_testimonials');
function rstw_post_type_testimonials () {
		$labels = array(
			'name' 						=> _x( 'Easy Testimonials', 'post type general name', 'wp-responsive-testimonials-slider' ),
			'singular_name' 			=> _x( 'Testimonial', 'post type singular name', 'wp-responsive-testimonials-slider' ),
			'add_new' 					=> _x( 'Add New', 'testimonial', 'wp-responsive-testimonials-slider' ),
			'add_new_item' 				=> sprintf( __( 'Add New %s', 'wp-responsive-testimonials-slider' ), __( 'Testimonial', 'wp-responsive-testimonials-slider' ) ),
			'edit_item' 				=> sprintf( __( 'Edit %s', 'wp-responsive-testimonials-slider' ), __( 'Testimonial', 'wp-responsive-testimonials-slider' ) ),
			'new_item' 					=> sprintf( __( 'New %s', 'wp-responsive-testimonials-slider' ), __( 'Testimonial', 'wp-responsive-testimonials-slider' ) ),
			'all_items' 				=> sprintf( __( 'All %s', 'wp-responsive-testimonials-slider' ), __( 'Testimonials', 'wp-responsive-testimonials-slider' ) ),
			'view_item' 				=> sprintf( __( 'View %s', 'wp-responsive-testimonials-slider' ), __( 'Testimonial', 'wp-responsive-testimonials-slider' ) ),
			'search_items' 				=> sprintf( __( 'Search %a', 'wp-responsive-testimonials-slider' ), __( 'Testimonials', 'wp-responsive-testimonials-slider' ) ),
			'not_found' 				=>  sprintf( __( 'No %s Found', 'wp-responsive-testimonials-slider' ), __( 'Testimonials', 'wp-responsive-testimonials-slider' ) ),
			'not_found_in_trash'		=> sprintf( __( 'No %s Found In Trash', 'wp-responsive-testimonials-slider' ), __( 'Testimonials', 'wp-responsive-testimonials-slider' ) ),
			'parent_item_colon' 		=> '',
			'menu_name'					=> __( 'Easy Testimonials', 'wp-responsive-testimonials-slider' )
		);
		$single_slug = apply_filters( 'testimonials_single_slug', _x( 'testimonial', 'single post url slug', 'wp-responsive-testimonials-slider' ) );
		$archive_slug = apply_filters( 'testimonials_archive_slug', _x( 'wp_testimonial', 'post archive url slug', 'wp-responsive-testimonials-slider' ) );
		$args = array(
			'labels'				 => $labels,
			'public'		 		 => true,
			'publicly_queryable'	 => true,
			'show_ui' 				 => true,
			'show_in_menu'			 => true,
			'query_var' 			 => true,
			'rewrite' 				 => array( 'slug' => $single_slug, 'with_front' => false ),
			'capability_type'		 => 'post',
			'has_archive'			 => $archive_slug,
			'hierarchical'			 => false,
			'supports' 				 => array( 'title', 'author' ,'editor', 'thumbnail', 'page-attributes', 'publicize', 'wpcom-markdown' ),
			'menu_position' 		 => 5,
			'menu_icon' 			 => 'dashicons-format-quote'
		);
		register_post_type( 'easy-testimonial', apply_filters( 'my_testimonials_post_type_args', $args ) );
	}
add_action( 'init', 'rstw_testimonial_taxonomies');
function rstw_testimonial_taxonomies() {
	$labels = array(
		'name'              => _x( 'Category', 'wp-responsive-testimonials-slider' ),
		'singular_name'     => _x( 'Category', 'wp-responsive-testimonials-slider' ),
		'search_items'      => __( 'Search Category', 'wp-responsive-testimonials-slider' ),
		'all_items'         => __( 'All Category', 'wp-responsive-testimonials-slider' ),
		'parent_item'       => __( 'Parent Category', 'wp-responsive-testimonials-slider' ),
		'parent_item_colon' => __( 'Parent Category', 'wp-responsive-testimonials-slider' ),
		'edit_item'         => __( 'Edit Category', 'wp-responsive-testimonials-slider' ),
		'update_item'       => __( 'Update Category', 'wp-responsive-testimonials-slider' ),
		'add_new_item'      => __( 'Add New Category', 'wp-responsive-testimonials-slider' ),
		'new_item_name'     => __( 'New Category Name', 'wp-responsive-testimonials-slider' ),
		'menu_name'         => __( 'Category', 'wp-responsive-testimonials-slider' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'testimonial-category' ),
	);
	register_taxonomy( 'testimonial-category', array( 'easy-testimonial' ), $args );
}
function rstw_testimonail_flush() {  
		register_post_type_testimonials();  
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'rstw_testimonail_flush' );