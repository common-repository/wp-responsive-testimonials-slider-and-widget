<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Function to handle the `vpg_slider` shortcode
 * 
 * @package testimonial slider and widget 
 * @since 1.0.0
 */
function rtsw_scan_testimonial( $atts, $content = null ){
    ob_start();
     $defaults = apply_filters( 'testimonial_default_args', array(
		'design_template'  => '',
		'limit' 		   => -1,		
		'grid' 			   => 1,
		'order' 		   => 'DESC',
		'orderby' 		   => 'post_date',
		'category' 		   => 0,
		'show_client' 	   => true,
		'show_star'        => true,
		'show_img'         => true,
		'show_job' 		   => true,
		'show_company' 	   => true,
		'image_style'      => 'square',
		'size' 			   => 150,
		'show_quotes'	   => 'true',
		'video'            => 'true',
		'social'           => 'true', 
	) );
    $args = shortcode_atts( $defaults, $atts );
	$testimonialsdesign	= rtsw_templates();
    $image_style=$args['image_style'];
	$video_url=$args['video'];
	$video_yurl = ($video_url == 'true') ? 'true' : 'false';
	$popup_conf = compact('video_url');
    $design = $args['design_template'];
    $design = array_key_exists( trim($design)  , $testimonialsdesign ) ? $design : 'template-1';
   // Shortcode file
	$testimonials_design_file_path 	= RTSW_DIR . '/view/' . $design . '.php';
	$design_file 					= (file_exists($testimonials_design_file_path)) ? $testimonials_design_file_path : '';
	if ( isset( $args['limit'] ) ) $args['limit'] = intval( $args['limit'] );
	if ( isset( $args['size'] ) &&  ( 0 < intval( $args['size'] ) ) ) $args['size'] = intval( $args['size'] );
	if ( isset( $args['category'] ) && is_numeric( $args['category'] ) ) $args['category'] = intval( $args['category'] );
       foreach ( array( 'show_client','show_job','show_company', 'show_img', 'show_quotes', 'show_star', 'video_url' ) as $k => $v ) {
		if ( isset( $args[$v] ) && ( 'true' == $args[$v] ) ) {
			$args[$v] = true;
		} else {
			$args[$v] = false;
		}
	}	
	$query = scan_all_testimonials($args);
	$fix 		= rtsw_fix();
    wp_enqueue_script('wpoh-magnific-js');
	?>
	<div class="testimonial-slider-wrp">
     <div class="rtsw-testimonials-list  rtsw-video rtsw-cleararea <?php echo $design; ?> " id="rtsw-vp-<?php echo $fix; ?>">
     	<?php
		if(!empty($query)){
          $count = 0;
          $class = '';
			foreach ( $query as $post ) {
                                $count++;
                                  $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				$css_class = 'rtsw-quote';
				if ( ( is_numeric( $args['grid'] ) && ( $args['grid'] > 0 ) && ( 0 == ( $count - 1 ) % $args['grid'] ) ) || 1 == $count ) { $css_class .= ' rtsw-first'; }
				if ( ( is_numeric( $args['grid'] ) && ( $args['grid'] > 0 ) && ( 0 == $count % $args['grid'] ) ) || count( $query ) == $count ) { $css_class .= ' rtsw-last'; }
				// Add a CSS class if no image is available.
				if ( isset( $post->image ) && ( '' == $post->image ) ) {
					$css_class .= ' no-image';
				}
				if ( is_numeric( $args['grid'] ) ) {
					if($args['grid'] == 1){
						$grid = 12;
					}else if($args['grid'] == 2){
						$grid = 6;
					}
					else if($args['grid'] == 3){
						$grid = 4;	
					}
					else if($args['grid'] == 4){
						$grid = 3;
					}
					 else{
                        $grid = $args['grid'];
                    }
					$class = 'wp-medium-'.$grid.' wpcolumns';
				}
				// Include shortcode html file
				if( $design_file ) {
					include( $design_file );
					}	 ?>
			<?php	} 
			} ?>
     <div class="video-popup-conf"><?php  echo htmlspecialchars(json_encode($popup_conf));  ?></div><!-- end of-popup-conf -->  </div>
             </div>
             <?php  
             return ob_get_clean();
	}
add_shortcode('testimonials_grid','rtsw_scan_testimonial');