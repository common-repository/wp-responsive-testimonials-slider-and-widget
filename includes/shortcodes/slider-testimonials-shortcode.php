<?php
if ( ! defined( 'ABSPATH' )) exit;
/**
 * Function to handle the `vpg_slider` shortcode
 * 
 * @package testimonial slider and widget 
 * @since 1.0.0
 */ ?>
<?php 
function rtsw_testimonial_slider( $atts, $content = null ){
           ob_start();
     $defaults = apply_filters( 'jd_testimonials_default_args', array(
		'design_template'   => '',
		'limit' 			=> -1,
		'grid'              => 1,
		'order' 			=> 'DESC',
		'orderby' 			=> 'post_date',
		'category' 			=> 0,
		'show_client' 	    => true,
		'show_star'         => true,
		'show_img' 	        => true,		
		'show_job' 		    => true,
		'show_company' 	    => true,
		'image_style'       => 'square',
		'size' 				=> 100,
		'show_quotes'	    => 'true',
		'video'             => 'true',
		'social'            => 'true',
		'slides_scroll'     => 1,
		'dots'     			=> "true",
		'arrows'     		=> "true",				
		'speed'             => 300,	
		'autoplay'     		=> "true",		
		'autoplay_interval' => 3000,				
		'adaptive_height'   => 'true',
		 
 	) );
     $fix_value = rtsw_fix();
     $fix 		= rtsw_fix();
     $args = shortcode_atts( $defaults, $atts );
	$testimonialsdesign	= rtsw_templates();
   $image_style=$args['image_style'];
    $video_url=$args['video'];
	$video_yurl = ($video_url == 'true') ? 'true' : 'false';
	$popup_conf = compact('video_yurl');
	 $design = $args['design_template'];
	$design = array_key_exists( trim($design)  , $testimonialsdesign ) ? $design : 'template-1';
	// Shortcode file
	$testimonials_design_file_url 	= RTSW_DIR . '/view/' . $design . '.php';
	$design_template 				= (file_exists($testimonials_design_file_url)) ? $testimonials_design_file_url : '';	
    wp_enqueue_script('wpoh-slick-js');
    wp_enqueue_script('wpoh-magnific-js');
   if ( isset( $args['limit'] ) ) $args['limit'] = intval( $args['limit'] );
	if ( isset( $args['size'] ) &&  ( 0 < intval( $args['size'] ) ) ) $args['size'] = intval( $args['size'] );
	if ( isset( $args['grid'] ) ) $args['grid'] = intval( $args['grid'] );
	if ( isset( $args['slides_scroll'] ) ) $args['slides_scroll'] = intval( $args['slides_scroll'] );
	if ( isset( $args['category'] ) && is_numeric( $args['category'] ) ) $args['category'] = intval( $args['category'] );
	if ( isset( $args['dots'] ) ) $args['dots'] =  $args['dots'] ;
	if ( isset( $args['adaptive_height'] ) ) $args['adaptive_height'] =  $args['adaptive_height'] ;
	if ( isset( $args['arrows'] ) ) $args['arrows'] =  $args['arrows'] ;	
	if ( isset( $args['autoplay'] ) ) $args['autoplay'] =  $args['autoplay'] ;
	if ( isset( $args['autoplay_interval'] ) ) $args['autoplay_interval'] =  $args['autoplay_interval'] ;
	if ( isset( $args['speed'] ) ) $args['speed'] =  $args['speed'] ;
        foreach ( array( 'show_client', 'show_job','show_company', 'show_img', 'show_quotes', 'show_star' ) as $k => $v ) {
		if ( isset( $args[$v] ) && ( 'true' == $args[$v] ) ) {
			$args[$v] = true;
		} else {
			$args[$v] = false;
		}
	}	     
	$query = scan_all_testimonials($args);
	$class = '';
	?>	<div class="testimonial-slider-wrp">
     	<div class=" rtsw-video rtsw-testimonial-<?php echo $fix_value; ?> rtsw-testimonial rtsw-cleararea <?php echo $design; ?>" id="rtsw-vp-<?php echo $fix; ?>">
     	<?php
		if(!empty($query)){
          $count = 0;
			foreach ( $query as $post ) { 
                                $count++;
                                  $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				$css_class = 'rtsw-quote';	
				// Add a CSS class if no image is available.
				if ( isset( $post->image ) && ( '' == $post->image ) ) {
					$css_class .= ' no-image';
				}				
				// Include shortcode html file
				if( $design_template ) {
					include( $design_template );
					}	
				} 
			} ?>
             </div>
           <div class="video-popup-conf"><?php  echo htmlspecialchars(json_encode($popup_conf));  ?></div>
       </div>
	<script type="text/javascript">
		jQuery(document).ready(function(){
		jQuery('.rtsw-testimonial-<?php echo $fix_value; ?>').slick({
			dots: <?php echo $args['dots']?>,
			infinite: true,
			arrows: <?php echo $args['arrows']?>,
			speed: <?php echo $args['speed']?>,
			autoplay: <?php echo $args['autoplay']?>,
			autoplaySpeed: <?php echo $args['autoplay_interval']?>,
			slidesToShow: <?php echo $args['grid']?>,
			slidesToScroll: <?php echo $args['slides_scroll']?>,
			adaptiveHeight: <?php echo $args['adaptive_height']?>,
     		prevArrow: "<div class='slick-prev'><i class='fa fa-angle-left'></i></div>",
            nextArrow: "<div class='slick-next'><i class='fa fa-angle-right'></i></div>",
			responsive: [
			{
			  breakpoint: 769,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true,
				dots: true
			  }
			},
			{
			  breakpoint: 641,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 481,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
			]
		});
	});
	</script>
             <?php  
             return ob_get_clean();
	}
add_shortcode( 'testimonials_slider', 'rtsw_testimonial_slider' );