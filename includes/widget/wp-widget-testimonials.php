<?php
if ( ! defined( 'ABSPATH' )) exit;
/**
 * Function to handle the `vpg_slider` shortcode
 * 
 * @package testimonial slider and widget 
 * @since 1.0.0
 */
class Rtsw_Testimonials_Widget extends WP_Widget {
    function __construct() {
        $widget_ops = array( 'classname' => 'widget_sp_testimonials', 'description' => __( 'Display testimonials on your site.', 'wp-responsive-testimonials-slider' ) );
        $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'sp_testimonials' );
        parent::__construct( 'sp_testimonials', __( 'WP Testimonials Slider', 'wp-responsive-testimonials-slider' ), $widget_ops, $control_ops );
    }
    function widget( $args, $instance ) {
        $instance = (array) $instance;
        extract( $args, EXTR_SKIP );
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $args = array();
        if ( $title ) {
            $args['title'] = $title;
        }
        if ( isset( $instance['limit'] ) && ( empty( $instance['limit'] ) ) ) { $args['limit'] = intval( $instance['limit'] ); }
        if ( isset( $instance['category'] ) && is_numeric( $instance['category'] ) ) $args['category'] = intval( $instance['category'] );
        if ( isset( $instance['dots'] ) && in_array( $instance['dots'], array_keys( $this->get_other_options() ) ) ) { $args['dots'] = $instance['dots']; }
        if ( isset( $instance['arrows'] ) && in_array( $instance['arrows'], array_keys( $this->get_other_options() ) ) ) { $args['arrows'] = $instance['arrows']; }
        if ( isset( $instance['video'] ) && in_array( $instance['video'], array_keys( $this->get_other_options() ) ) ) { $args['video'] = $instance['video']; }
        if ( isset( $instance['social'] ) && in_array( $instance['social'], array_keys( $this->get_other_options() ) ) ) { $args['social'] = $instance['social']; }
        if ( isset( $instance['autoplay'] ) && in_array( $instance['autoplay'], array_keys( $this->get_other_options() ) ) ) { $args['autoplay'] = $instance['autoplay']; }
		if ( isset( $instance['adaptive_height'] ) && in_array( $instance['adaptive_height'], array_keys( $this->get_other_options() ) ) ) { $args['adaptive_height'] = $instance['adaptive_height']; }
        if ( isset( $instance['autoplayInterval'] ) && ( empty( $instance['autoplayInterval'] ) ) ) { $args['autoplayInterval'] = intval( $instance['autoplayInterval'] ); }
		if ( isset( $instance['grid'] ) && ( empty( $instance['grid'] ) ) ) { $args['grid'] = intval( $instance['grid'] ); }
		if ( isset( $instance['slides_scroll'] ) && ( empty( $instance['slides_scroll'] ) ) ) { $args['slides_scroll'] = intval( $instance['slides_scroll'] ); }
        if ( isset( $instance['speed'] ) && ( empty( $instance['speed'] ) ) ) { $args['speed'] = intval( $instance['speed'] ); }
        if ( isset( $instance['show_client'] ) && ( 1 == $instance['show_client'] ) ) { $args['show_client'] = true; } else { $args['show_client'] = false; }
        if ( isset( $instance['show_img'] ) && ( 1 == $instance['show_img'] ) ) { $args['show_img'] = true; } else { $args['show_img'] = false; }
        if ( isset( $instance['show_quotes'] ) && empty($instance['show_quotes']) ) { $args['show_quotes'] = false; } else { $args['show_quotes'] = true; }
        if ( isset( $instance['show_job'] ) && ( 1 == $instance['show_job'] ) ) { $args['show_job'] = true; } else { $args['show_job'] = false; }
         if ( isset( $instance['show_star'] ) && ( 1 == $instance['show_star'] ) ) { $args['show_star'] = true; } else { $args['show_star'] = false; }
        if ( isset( $instance['show_company'] ) && ( 1 == $instance['show_company'] ) ) { $args['show_company'] = true; } else { $args['show_company'] = false; }
        if ( isset( $instance['image_style'] ) && in_array( $instance['image_style'], array_keys( $this->image_style_options() ) ) ) { $args['image_style'] = $instance['image_style']; }
		if ( isset( $instance['design_template'] ) && in_array( $instance['design_template'], array_keys( $this->design_options() ) ) ) { $args['design_template'] = $instance['design_template']; }
        if ( isset( $instance['orderby'] ) && in_array( $instance['orderby'], array_keys( $this->get_orderby_options() ) ) ) { $args['orderby'] = $instance['orderby']; }
        if ( isset( $instance['order'] ) && in_array( $instance['order'], array_keys( $this->get_order_options() ) ) ) { $args['order'] = $instance['order']; }
    $defaults = apply_filters( 'testimonials_default_args', array(
        'limit'             => -1,
        'orderby'           => 'menu_order',
        'order'             => 'DESC',
        'title'             => '',
        'category'          => 0,
		'grid'     => 1,
        'slides_scroll'     => 1, 
        'show_client'       => true,
        'show_img'          => true,
        'show_quotes'       => true,
        'show_job'          => true,
        'show_star'          => true,
        'show_company'      => true,
        'image_style'       => "circle",
		'design_template'   => "template-1",
        'dots'              => "true",
        'arrows'            => "true",
        'autoplay'          => "true",
		'adaptive_height'   => "false",	
        'autoplayInterval'  => 3000,                
        'speed'             => 300,
        'size'              => 100,
        'video'             => 'true',
		'social'            => 'true',
    ) );
     $args = shortcode_atts( $defaults, $args );
     $unique = rtsw_fix();
	 
	$testimonialsdesign	= rtsw_templates();
	$video_url=$args['video'];
	 $image_style=$args['image_style'];
	$video_yurl = ($video_url == 'true') ? 'true' : 'false';
	
	$popup_conf = compact('video_yurl');
	
	$design = $args['design_template'];
	$design_template = array_key_exists( trim($design)  , $testimonialsdesign ) ? $design : 'template-1';
	
	// Shortcode file
	$testimonials_design_file_path 	= RTSW_DIR . '/view/' . $design_template . '.php';
	$design_file 					= (file_exists($testimonials_design_file_path)) ? $testimonials_design_file_path : '';	
	wp_enqueue_script( 'my-slick-jquery' );	
		
    if ( isset( $args['limit'] ) ) $args['limit'] = intval( $args['limit'] );
    if ( isset( $args['size'] ) &&  ( 0 < intval( $args['size'] ) ) ) $args['size'] = intval( $args['size'] );
    if ( isset( $args['category'] ) && is_numeric( $args['category'] ) ) $args['category'] = intval( $args['category'] );
    if ( isset( $args['arrows'] ) ) $args['arrows'] =  $args['arrows'] ;
    
    if ( isset( $args['video'] ) ) $args['video'] =  $args['video'] ;
    if ( isset( $args['social'] ) ) $args['social'] =  $args['social'] ;
    
    if ( isset( $args['autoplay'] ) ) $args['autoplay'] =  $args['autoplay'] ;
	if ( isset( $args['adaptive_height'] ) ) $args['adaptive_height'] =  $args['adaptive_height'] ;
	if ( isset( $args['slides_scroll'] ) ) $args['slides_scroll'] =  $args['slides_scroll'] ;
	if ( isset( $args['slides_scroll'] ) ) $args['slides_scroll'] =  $args['slides_scroll'] ;
    if ( isset( $args['autoplayInterval'] ) ) $args['autoplayInterval'] = intval( $args['autoplayInterval'] );
    if ( isset( $args['speed'] ) ) $args['speed'] = intval( $args['speed'] );
        foreach ( array( 'show_client', 'show_job','show_company', 'show_img', 'show_quotes','show_star' ) as $k => $v ) {
        if ( isset( $args[$v] ) && ( 'true' == $args[$v] ) ) {
            $args[$v] = true;
        } else {
            $args[$v] = false;
        }
    }
    $query = scan_all_testimonials($args);   
    ?>
    <div class="testimonial-slider-wrp ">
    <div id="rtsw-testimonial-<?php echo $unique; ?>" class="rtsw-video widget widget_testimonials ">
        <?php  if ( '' != $args['title'] ) {
                echo '<h2 class="widget-title">' . esc_html( $args['title'] ) . '</h2>' . "\n";
            }?>
        <div class="rtsw-testimonials-slide-widget-<?php echo $unique; ?> rtsw-testimonial rtsw-testimonials-slide-widget <?php echo $design_template; ?>">
        <?php
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
				if( $design_file ) {
					include( $design_file );
					}
            } ?>
             
             </div>
			   <script type="text/javascript">
			   <?php if($args['grid'] != "" && $args['grid'] != "0"){
					$slidesToShow = $args['grid'];}else{$slidesToShow = 1;}
					if($args['slides_scroll'] != "" && $args['slides_scroll'] != "0"){
					$slidesToScroll = $args['slides_scroll'];} else{$slidesToScroll = 1;}?>
						jQuery(document).ready(function(){
						jQuery('.rtsw-testimonials-slide-widget-<?php echo $unique; ?>').slick({
							dots: <?php echo $instance['dots']; ?>,
							infinite: true,
							arrows: <?php echo $instance['arrows']?>,
							speed: <?php echo $args['speed']; ?>,
							adaptiveHeight: <?php echo $args['adaptive_height']; ?>,
                            prevArrow: "<div class='slick-prev'><i class='fa fa-angle-left'></i></div>",
                            nextArrow: "<div class='slick-next'><i class='fa fa-angle-right'></i></div>",      
							autoplay: <?php echo $args['autoplay']; ?>,                       
							autoplaySpeed: <?php echo $args['autoplayInterval']; ?>,
							slidesToShow: <?php echo $slidesToShow; ?>,
							slidesToScroll: <?php echo $slidesToScroll; ?>
                           
        });
    });
    </script>
             </div>
               <div class="video-popup-conf"><?php  echo htmlspecialchars(json_encode($popup_conf));  ?></div><!-- end of-popup-conf -->
         </div>
             <?php 
    }
    function update ( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']              = strip_tags( $new_instance['title'] );
        $instance['limit']              = intval( $new_instance['limit'] );
        $instance['grid']      = intval( $new_instance['grid'] );
        $instance['slides_scroll']      = intval( $new_instance['slides_scroll'] );
        $instance['category']           = intval( $new_instance['category'] );
        $instance['orderby']            = esc_attr( $new_instance['orderby'] );
        $instance['order']              = esc_attr( $new_instance['order'] );
        $instance['image_style']        = esc_attr( $new_instance['image_style'] );
		$instance['design_template']        		= esc_attr( $new_instance['design_template'] );
        $instance['dots']               = esc_attr( $new_instance['dots'] );
        $instance['arrows']             = esc_attr( $new_instance['arrows'] );
        $instance['video']             = esc_attr( $new_instance['video'] );
        $instance['social']             = esc_attr( $new_instance['social'] );
        $instance['autoplay']           = esc_attr( $new_instance['autoplay'] );
		$instance['adaptive_height']    = esc_attr( $new_instance['adaptive_height'] );
        $instance['autoplayInterval']   = intval( $new_instance['autoplayInterval'] );
        $instance['speed']              = intval( $new_instance['speed'] );
        $instance['show_client']     = (bool) esc_attr( $new_instance['show_client'] );
        $instance['show_img']     = (bool) esc_attr( $new_instance['show_img'] );
        $instance['show_quotes']     = (bool) esc_attr( $new_instance['show_quotes'] );
        $instance['show_job']        = (bool) esc_attr( $new_instance['show_job'] );
        $instance['show_star']        = (bool) esc_attr( $new_instance['show_star'] );
        $instance['show_company']    = (bool) esc_attr( $new_instance['show_company'] );
        return $instance;
    } 
    function form( $instance ) {
        $defaults = array(
        'limit'             => -1,
        'orderby'           => 'menu_order',
        'order'             => 'DESC',
        'title'             => '',
        'grid'     => 1,
        'slides_scroll'     => 1, 
        'category'          => 0,
        'show_client'       => true,
        'show_img'          => true,
        'show_quotes'       => true,
        'show_job'          => true,
        'show_star'          => true,
        'show_company'      => true,
        'image_style'       => 'circle',
		'design_template'	=> 'template-1',
        'dots'              => "true",
        'arrows'            => "true",
        'autoplay'          => "true", 
		'adaptive_height'   => "true",	
        'autoplayInterval'  => 3000,                
        'speed'             => 300,
        'size'              => 100,
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
?>
        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wp-responsive-testimonials-slider' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>"  value="<?php echo $instance['title']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" />
        </p>
        <!-- Widget Limit: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:', 'wp-responsive-testimonials-slider' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'limit' ); ?>"  value="<?php echo $instance['limit']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" />
            <label><?php _e( 'Default -1 for all testimonial:', 'wp-responsive-testimonials-slider' ); ?></label>
        </p>
         <!-- Widget Order: Design Style -->
        <p>
            <label for="<?php echo $this->get_field_id( 'design_template' ); ?>"><?php _e( 'Design:', 'wp-responsive-testimonials-slider' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'design_template' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'design_template' ); ?>">
            <?php foreach ( $this->design_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['design_template'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        <!-- Widget Category: Select Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'wp-responsive-testimonials-slider' ); ?></label>
            <?php
                $dropdown_args = array('hide_empty' => 0,  'taxonomy' => 'testimonial-category', 'class' => 'widefat', 'show_option_all' => __( 'All', 'wp-responsive-testimonials-slider' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>
			 <!-- Widget ID:  col -->
        <p>
            <label for="<?php echo $this->get_field_id( 'grid' ); ?>"><?php _e( 'Slides Column:', 'wp-responsive-testimonials-slider' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'grid' ); ?>"  value="<?php echo $instance['grid']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'grid' ); ?>" />
        </p>
		 <!-- Widget ID:  col to scroll -->
        <p>
            <label for="<?php echo $this->get_field_id( 'slides_scroll' ); ?>"><?php _e( 'Slides to Scroll:', 'wp-responsive-testimonials-slider' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'slides_scroll' ); ?>"  value="<?php echo $instance['slides_scroll']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'slides_scroll' ); ?>" />
        </p>
       
        <!-- Widget Order: Select Dots -->
        <p>
            <label for="<?php echo $this->get_field_id( 'dots' ); ?>"><?php _e( 'Dots:', 'wp-responsive-testimonials-slider' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'dots' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'dots' ); ?>">
            <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['dots'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        <!-- Widget Order: Select Arrows -->
        <p>
            <label for="<?php echo $this->get_field_id( 'arrows' ); ?>"><?php _e( 'Arrows:', 'wp-responsive-testimonials-slider' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'arrows' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'arrows' ); ?>">
            <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['arrows'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'video' ); ?>"><?php _e( 'Video:', 'wp-responsive-testimonials-slider' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'video' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'video' ); ?>">
            <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['video'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'social' ); ?>"><?php _e( 'Social Link:', 'wp-responsive-testimonials-slider' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'social' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'social' ); ?>">
            <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['social'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
         <!-- Widget Order: Select Auto play -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Auto Play:', 'wp-responsive-testimonials-slider' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'autoplay' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>">
            <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['autoplay'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        <!-- Widget ID:  AutoplayInterval -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>"><?php _e( 'Autoplay Interval:', 'wp-responsive-testimonials-slider' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'autoplayInterval' ); ?>"  value="<?php echo $instance['autoplayInterval']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>" />
        </p>
	
        <!-- Widget ID:  Speed -->
        <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'wp-responsive-testimonials-slider' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" />
        </p>
		 <!-- Widget Order: height -->
        <p>
            <label for="<?php echo $this->get_field_id( 'adaptive_height' ); ?>"><?php _e( 'Adaptive Height:', 'wp-responsive-testimonials-slider' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'adaptive_height' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'adaptive_height' ); ?>">
            <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['adaptive_height'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
         <!-- Widget Order: Image Style -->
        <p>
            <label for="<?php echo $this->get_field_id( 'image_style' ); ?>"><?php _e( 'Image Style:', 'wp-responsive-testimonials-slider' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'image_style' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'image_style' ); ?>">
            <?php foreach ( $this->image_style_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['image_style'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        <!-- Widget Display Client Img: Checkbox Input -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_img' ); ?>" name="<?php echo $this->get_field_name( 'show_img' ); ?>" type="checkbox"<?php checked( $instance['show_img'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_img' ); ?>"><?php _e( 'Display Image', 'wp-responsive-testimonials-slider' ); ?></label>
        </p>
        <!-- Widget Display Quotes: Checkbox Input -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_quotes' ); ?>" name="<?php echo $this->get_field_name( 'show_quotes' ); ?>" type="checkbox"<?php checked( $instance['show_quotes'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_quotes' ); ?>"><?php _e( 'Display Quotes', 'wp-responsive-testimonials-slider' ); ?></label>
        </p>
        <!-- Widget Display Client: Checkbox Input -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_client' ); ?>" name="<?php echo $this->get_field_name( 'show_client' ); ?>" type="checkbox"<?php checked( $instance['show_client'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_client' ); ?>"><?php _e( 'Display Client', 'wp-responsive-testimonials-slider' ); ?></label>
        </p>
        
        <!-- Widget Display Job: Checkbox Input -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_job' ); ?>" name="<?php echo $this->get_field_name( 'show_job' ); ?>" type="checkbox"<?php checked( $instance['show_job'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_job' ); ?>"><?php _e( 'Display Job', 'wp-responsive-testimonials-slider' ); ?></label>
        </p>
         <p>
            <input id="<?php echo $this->get_field_id( 'show_star' ); ?>" name="<?php echo $this->get_field_name( 'show_star' ); ?>" type="checkbox"<?php checked( $instance['show_star'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_star' ); ?>"><?php _e( 'Display Star Rating', 'wp-responsive-testimonials-slider' ); ?></label>
        </p>
        <!-- Widget Display Company: Checkbox Input -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_company' ); ?>" name="<?php echo $this->get_field_name( 'show_company' ); ?>" type="checkbox"<?php checked( $instance['show_company'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_company' ); ?>"><?php _e( 'Display Company', 'wp-responsive-testimonials-slider' ); ?></label>
        </p>
        <!-- Widget Order By: Select Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order By:', 'wp-responsive-testimonials-slider' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>">
            <?php foreach ( $this->get_orderby_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['orderby'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        <!-- Widget Order: Select Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order:', 'wp-responsive-testimonials-slider' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'order' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>">
            <?php foreach ( $this->get_order_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['order'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        
<?php
    } // End form()
    function get_orderby_options () {
        $args = array(
                    'none' => __( 'No Order', 'wp-responsive-testimonials-slider' ),
                    'ID' => __( 'ID', 'wp-responsive-testimonials-slider' ),
                    'title' => __( 'Title', 'wp-responsive-testimonials-slider' ),
                    'date' => __( 'Date', 'wp-responsive-testimonials-slider' ),
                    'rand' => __( 'Random', 'wp-responsive-testimonials-slider' )
                    );
        return $args;
    }
    function get_order_options () {
         $args = array(
                    'ASC' => __( 'Ascending', 'wp-responsive-testimonials-slider' ),
                    'DESC' => __( 'Descending', 'wp-responsive-testimonials-slider' )
                    );    
         return $args;
        } 
   function get_other_options () {
         $args = array(
                    'true' => __( 'True', 'wp-responsive-testimonials-slider' ),
                    'false' => __( 'False', 'wp-responsive-testimonials-slider' )
                    );    
         return $args;
        }
    function image_style_options () {
         $args = array(
                    'circle' => __( 'Circle', 'wp-responsive-testimonials-slider' ),
                    'square' => __( 'Square', 'wp-responsive-testimonials-slider' )
                    );    
         return $args;
        }  
	function design_options(){
		 $args = array(
                    'template-1'    => __('template-1', 'wp-responsive-testimonials-slider'),
                    'template-2'    => __('template-2', 'wp-responsive-testimonials-slider'),
                    'template-3'    => __('template-3', 'wp-responsive-testimonials-slider'),
                    'template-4'    => __('Tempalte-4', 'wp-responsive-testimonials-slider'),
                    'template-5'    => __('Tempalte-5', 'wp-responsive-testimonials-slider'),
                    'template-6'    => __('Tempalte-6', 'wp-responsive-testimonials-slider'),
                    'template-7'    => __('Tempalte-7', 'wp-responsive-testimonials-slider'),
                    'template-8'    => __('Tempalte-8', 'wp-responsive-testimonials-slider'),
                    );    
         return $args;
	}
} // End Class
/* Register the widget. */
add_action( 'widgets_init',  function() {
             register_widget("Rtsw_Testimonials_Widget");        
}, 1 );
?>