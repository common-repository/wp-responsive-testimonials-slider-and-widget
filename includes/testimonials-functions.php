<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Function to get fix number
 * 
 * @package Video gallery and Player
 * @since 2.0.0
 */ 
 function rtsw_fix() {
    static $fix = 0;
    $fix++;
    return $fix;
}
 /* Function to get shortcode design
 * 
 * @package WP Responsive Testimonials Slider And Widget
 * @since 1.0
 */
function rtsw_templates() {
	$design_arr = array(
		'template-1'	=> __('template-1', 'wp-responsive-testimonials-slider'),
		'template-2'	=> __('template-2', 'wp-responsive-testimonials-slider'),
		'template-3'	=> __('template-3', 'wp-responsive-testimonials-slider'),
		'template-4'	=> __('template-4', 'wp-responsive-testimonials-slider'),
		'template-5'	=> __('template-5', 'wp-responsive-testimonials-slider'),
		'template-6'	=> __('template-6', 'wp-responsive-testimonials-slider'),
		'template-7'	=> __('template-7', 'wp-responsive-testimonials-slider'),
		'template-8'	=> __('template-8', 'wp-responsive-testimonials-slider'),	
		);	
	return apply_filters('rtsw_templates', $design_arr );
}
/**
 * Function to get `Grid cell values` shortcode generator
 * 
 * @package WP Responsive Testimonials Slider And Widget
 * @since 1.0
 */
function rtsw_grid_arr() {
    $design_arr[0] = __(1, 'wp-responsive-testimonials-slider');
    $design_arr[1] = __(2, 'wp-responsive-testimonials-slider');
    $design_arr[2] = __(3, 'wp-responsive-testimonials-slider');
    $design_arr[3] = __(4, 'wp-responsive-testimonials-slider');
    $design_arr[4] = __(5, 'wp-responsive-testimonials-slider');
    $design_arr[5] = __(6, 'wp-responsive-testimonials-slider');
    $design_arr[6] = __(7, 'wp-responsive-testimonials-slider');
    $design_arr[7] = __(8, 'wp-responsive-testimonials-slider');
    $design_arr[8] = __(9, 'wp-responsive-testimonials-slider');
    $design_arr[9] = __(10, 'wp-responsive-testimonials-slider');
    $design_arr[10] = __(11, 'wp-responsive-testimonials-slider');
    $design_arr[11] = __(12, 'wp-responsive-testimonials-slider');
    return apply_filters('lswr_grid_arr', $design_arr);
}
function rtsw_true_false() {
    $disp_title_arr = array(
        __('true', 'wp-responsive-testimonials-slider'),
        __('false', 'wp-responsive-testimonials-slider')
    );
    return apply_filters('lswr_designs', $disp_title_arr);
}
function rtsw_asc_desc() {
    $disp_title_arr = array(
        __('ASC', 'wp-responsive-testimonials-slider'),
        __('DESC', 'wp-responsive-testimonials-slider')
    );
    return apply_filters('lswr_designs', $disp_title_arr);
}
function rtsw_orderby() {
    $disp_title_arr = array(
        __('ID', 'wp-responsive-testimonials-slider'),
        __('author', 'wp-responsive-testimonials-slider'),
        __('title', 'wp-responsive-testimonials-slider'),
        __('name', 'wp-responsive-testimonials-slider'),
        __('rand', 'wp-responsive-testimonials-slider'),
        __('date', 'wp-responsive-testimonials-slider'),
    );
    return apply_filters('lswr_designs', $disp_title_arr);
}
 /* Function to register columns
 * 
 * @package WP Responsive Testimonials Slider And Widget
 * @since 1.0
 */
add_filter( 'manage_edit-easy-testimonial_columns',  'rstw_custom_column_headings' );
add_action( 'manage_posts_custom_column',  'rstw_custom_columns' );
function rstw_custom_columns ( $column_name ) {
		global $wpdb, $post;		
		switch ( $column_name ) {
			case 'image':
				$value = '';
				$value = rtsw_image( get_the_ID(), 40 ,'square');
				echo $value;
			break;
			default:
			break;
		}
	}
	function rstw_custom_column_headings ( $defaults ) {
		$new_columns = array( 'image' => __( 'Client Image', 'wp-responsive-testimonials-slider' ) );
		$last_item = '';
		if ( isset( $defaults['date'] ) ) { unset( $defaults['date'] ); }
		if ( count( $defaults ) > 2 ) {
			$last_item = array_slice( $defaults, -1 );
			array_pop( $defaults );
		}
		$defaults = array_merge( $defaults, $new_columns );
		if ( $last_item != '' ) {
			foreach ( $last_item as $k => $v ) {
				$defaults[$k] = $v;
				break;
			}
		}
		return $defaults;
	}
	function rtsw_image ( $id, $size, $style = "" ) {
		global $image_style;
		if($image_style == "circle")
			{
				$image_class= "rtsw-circle";
			} else {
				$image_class= "rtsw-square";
			}
		$response = '';
		if ( has_post_thumbnail( $id ) ) {			
			if ( ( is_int( $size ) || ( 0 < intval( $size ) ) ) && ! is_array( $size ) ) {
				$size = array( intval( $size ), intval( $size ) );
			} elseif ( ! is_string( $size ) && ! is_array( $size ) ) {
				$size = array( 100, 100 );
			}
			$response = get_the_post_thumbnail( intval( $id ), $size, array( 'class' => $image_class ) );
		} else {
			$testimonial_email = get_post_meta( $id, '_testimonial_email', true );
			if ( '' != $testimonial_email && is_email( $testimonial_email ) ) {
				$response = get_avatar( $testimonial_email, $size );
			}
		}
		return $response;
	}
/* Function to Ceate Post Metabox
 * 
 * @package WP Responsive Testimonials Slider And Widget
 * @since 1.0
 */
add_action( 'admin_menu', 'rtsw_meta_box');
	function rtsw_meta_box () {
		add_meta_box( 'testimonial-details', __( 'Testimonial Details', 'wp-responsive-testimonials-slider' ), 'rtsw_meta_box_content' , 'easy-testimonial', 'normal', 'high' );
	}
	function rtsw_meta_box_content () {
		global $post_id;
		$fields = get_post_custom( $post_id );
		$field_data = scan_fields_settings();
		$html = '';
		$html .= wp_nonce_field( 'rtsw_meta_box_save', 'testimonial_noonce' );
		if ( 0 < count( $field_data ) ) {
			$html .= '<table class="form-table">' . "\n";
			$html .= '<tbody>' . "\n";
			foreach ( $field_data as $k => $v ) {
				$data = $v['default'];
				if ( isset( $fields['_' . $k] ) && isset( $fields['_' . $k][0] ) ) {
					$data = $fields['_' . $k][0];
				}
				$html .= '<tr valign="top"><th scope="row"><label for="' . esc_attr( $k ) . '">' . $v['name'] . '</label></th><td><input name="' . esc_attr( $k ) . '" type="text" id="' . esc_attr( $k ) . '" class="regular-text" value="' . esc_attr( $data ) . '" />' . "\n";
				$html .= '<p class="description">' . $v['description'] . '</p>' . "\n";
				$html .= '</td><tr/>' . "\n";
			}
			$html .= '</tbody>' . "\n";
			$html .= '</table>' . "\n";
		}
		echo $html;
	}
/* Function to save Post Metabox
 * 
 * @package WP Responsive Testimonials Slider And Widget
 * @since 1.0
 */
add_action( 'save_post','rtsw_meta_box_save');
	function rtsw_meta_box_save ( $post_id ) {
		global $post, $messages;
		// Verify
		if ( ( get_post_type( $post_id) != 'easy-testimonial' ) ) {
			return $post_id;
		}
		if ( ! isset( $_POST['testimonial_noonce'] ) ) {
		return $post_id;
	}
		if ( ! wp_verify_nonce( $_POST['testimonial_noonce'], 'rtsw_meta_box_save' ) ) {
			return $post_id;
		  }
			if ( 'page' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return $post_id;
				}
			} else {
				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return $post_id;
				}
			}
		$field_data = scan_fields_settings();
		$fields = array_keys( $field_data );
		foreach ( $fields as $f ) {
			${$f} = strip_tags(trim($_POST[$f]));
			
			if ( 'url' == $field_data[$f]['type'] ) {
				${$f} = esc_url( ${$f} );
			}
			if ( get_post_meta( $post_id, '_' . $f ) == '' ) {
				
				add_post_meta( $post_id, '_' . $f, ${$f}, true );
			} elseif( ${$f} != get_post_meta( $post_id, '_' . $f, true ) ) {
				update_post_meta( $post_id, '_' . $f, ${$f} );
			} elseif ( ${$f} == '' ) {
				delete_post_meta( $post_id, '_' . $f, get_post_meta( $post_id, '_' . $f, true ) );
			}
		}
	}
	/* Function to create post field
	 * 
	 * @package WP Responsive Testimonials Slider And Widget
	 * @since 1.0
    */
	function scan_fields_settings () {
		$fields = array();
        
         $fields['ytvideo'] = array(
		    'name' => __( 'Enter YouTube Link', 'wp-responsive-testimonials-slider' ),
		    'description' => __( ' ie https://www.youtube.com/watch?v=6d_uJWFAFro ' ),
		    'type' => 'text',
		    'default' => '',
		    'section' => 'info'
		);		
		$fields['testimonial_star'] = array(
		    'name' => __( 'Client Rating', 'wp-responsive-testimonials-slider' ),
		    'description' => __( 'Give star in numeric like: 1,2,3,4,5' ),
		    'type' => 'text',
		    'default' => '',
		    'section' => 'info'
		);
		$fields['testimonial_client'] = array(
		    'name' => __( 'Client Name', 'wp-responsive-testimonials-slider' ),
		    'description' => __( 'Enter Client Name' ),
		    'type' => 'text',
		    'default' => '',
		    'section' => 'info'
		);		
		$fields['testimonial_job'] = array(
		    'name' => __( 'Job Title', 'wp-responsive-testimonials-slider' ),
		    'description' => __( 'Enter Client Job Title' ),
		    'type' => 'text',
		    'default' => '',
		    'section' => 'info'
		);
		$fields['testimonial_company'] = array(
		    'name' => __( 'Company', 'wp-responsive-testimonials-slider' ),
		    'description' => __( 'Enter Client Company' ),
		    'type' => 'text',
		    'default' => '',
		    'section' => 'info'
		);
		$fields['testimonial_url'] = array(
		    'name' => __( 'Company URL', 'wp-responsive-testimonials-slider' ),
		    'description' => __( 'Enter Client Company website URL' ),
		    'type' => 'text',
		    'default' => '',
		    'section' => 'info'
		);
		$fields['testimonial_fb'] = array(
		    'name' => __( 'Enter Facebook URL', 'wp-responsive-testimonials-slider' ),
		    'description' => __( 'Enter Client Facebook Profile URL' ),
		    'type' => 'text',
		    'default' => '',
		    'section' => 'info'
		);
		$fields['testimonial_ld'] = array(
		    'name' => __( 'Enter Linkdin URL', 'wp-responsive-testimonials-slider' ),
		    'description' => __( 'Enter Client Linkdin Profile URL' ),
		    'type' => 'text',
		    'default' => '',
		    'section' => 'info'
		);
		$fields['testimonial_tw'] = array(
		    'name' => __( 'Enter Tweeter URL', 'wp-responsive-testimonials-slider' ),
		    'description' => __( 'Enter Client Tweeter Profile URL' ),
		    'type' => 'text',
		    'default' => '',
		    'section' => 'info'
		);
		$fields['testimonial_instgram'] = array(
		    'name' => __( 'Enter instagram URL', 'wp-responsive-testimonials-slider' ),
		    'description' => __( 'Enter Client instagram Profile URL' ),
		    'type' => 'text',
		    'default' => '',
		    'section' => 'info'
		);
		return $fields;
	}
	function scan_all_testimonials ( $args = '' ) {	
		$defaults = array(
			'limit' => -1,
			'orderby' => 'menu_order',
			'order' => 'DESC',
			'id' => 0,
			'category' => 0,
		);
		$args = wp_parse_args( $args, $defaults );
		$query_args = array();
		$query_args['post_type'] = 'easy-testimonial';
		$query_args['numberposts'] = $args['limit'];
		$query_args['orderby'] = $args['orderby'];
		$query_args['order'] = $args['order'];
		$query_args['suppress_filters'] = false;
		$ids = explode( ',', $args['id'] );
		if ( 0 < intval( $args['id'] ) && 0 < count( $ids ) ) {
			$ids = array_map( 'intval', $ids );
			if ( 1 == count( $ids ) && is_numeric( $ids[0] ) && ( 0 < intval( $ids[0] ) ) ) {
				$query_args['p'] = intval( $args['id'] );
			} else {
				$query_args['ignore_sticky_posts'] = 1;
				$query_args['post__in'] = $ids;
			}
		}
		// Whitelist checks.
		if ( ! in_array( $query_args['orderby'], array( 'none', 'ID', 'author', 'title', 'date', 'modified', 'parent', 'rand', 'comment_count', 'menu_order', 'meta_value', 'meta_value_num' ) ) ) {
			$query_args['orderby'] = 'date';
		}
		if ( ! in_array( $query_args['order'], array( 'ASC', 'DESC' ) ) ) {
			$query_args['order'] = 'DESC';
		}
		if ( ! in_array( $query_args['post_type'], get_post_types() ) ) {
			$query_args['post_type'] = 'easy-testimonial';
		}
		$tax_field_type = '';
		// If the category ID is specified.
		if ( is_numeric( $args['category'] ) && 0 < intval( $args['category'] ) ) {
			$tax_field_type = 'id';
		}
		// If the category slug is specified.
		if ( ! is_numeric( $args['category'] ) && is_string( $args['category'] ) ) {
			$tax_field_type = 'slug';
		}
		// Setup the taxonomy query.
		if ( '' != $tax_field_type ) {
			$term = $args['category'];
			if ( is_string( $term ) ) { $term = esc_html( $term ); } else { $term = intval( $term ); }
			$query_args['tax_query'] = array( array( 'taxonomy' => 'testimonial-category', 'field' => $tax_field_type, 'terms' => array( $term ) ) );
		}
		// The Query.
		$query = get_posts( $query_args );
		// The Display.
		if ( ! is_wp_error( $query ) && is_array( $query ) && count( $query ) > 0 ) {
			foreach ( $query as $k => $v ) {
				$meta = get_post_custom( $v->ID );
				// Get the image.
				$query[$k]->image = rtsw_image( $v->ID, $args['size'],$args['image_style']);
				foreach ( (array)scan_fields_settings() as $i => $j ) {
					if ( isset( $meta['_' . $i] ) && ( '' != $meta['_' . $i][0] ) ) {
						$query[$k]->$i = $meta['_' . $i][0];
					} else {
						$query[$k]->$i = $j['default'];
					}
				}
			}
		} else {
			$query = false;
		}
		return $query;
	}
/**
 * create Sanitize URL.
 * 
 * @package video player gallery
 * @since 1.0
 */
function rtsw_clean_url( $url ) {
    return esc_url_raw( trim($url) );
}
	
	/**
 * Clean variables using sanitize text field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * 
 * @package Easy Accordion For Faq
 * @since 1.0
 */
function rtsw_sanitize_clean( $var ) {
    if ( is_array( $var ) ) {
        return array_map( 'rtsw_sanitize_clean', $var );
    } else {
        $data = is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
        return wp_unslash($data);
    }
}