<?php 
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit; ?>
<div id="rtsw-quote-<?php echo $post->ID;?>" class="rtsw-testimonial-box <?php echo $css_class.' '.$class;?>">
	<div class="rtsw-testimonial-inner">
		<div class="rtsw-testimonial_avatar">
		<?php if ( ( $feat_image!= '') && true == $args['show_img']  || true == $args['video_url'] ) { ?>
		<div class="rtsw-avtar-image">
			<?php $video_yurl=$post->ytvideo; if( $video_yurl!="" && $video_url == "true" ){ ?>         
				<a href="<?php echo $post->ytvideo; ?>" class="popup-youtube">
					<img class="rtsw-avtar-image <?php if($image_style == 'circle') {echo 'rtsw-circle';} ?>" src="<?php echo $feat_image; ?>" title="<?php echo $post->post_title?>">
					<span class="video_icon" ></span>
				</a>
			<?php } else { ?>
				<img class="rtsw-avtar-image <?php if($image_style == 'circle') {echo 'rtsw-circle';} ?>" src="<?php echo $feat_image; ?>" title="<?php echo $post->post_title?>">
			<?php }?>
		</div>
	<?php }?>
		</div>		
		<div class="rtsw-testimonial-author">
		<?php if(true == $args['show_client'] && '' !=  $post->testimonial_client || true == $args['show_job'] && '' !=  $post->testimonial_job){?>
			<div class="rtsw-testimonial-client">
			<?php $author = (true == $args['show_client'] && '' !=  $post->testimonial_client) ? '<strong>'.$post->testimonial_client.'</strong>' : "";
				echo $author;
			?>
			</div>
			<?php }?>
			<div class="rtsw-testimonial-cdec">
			<?php 
				$testimonial_job = (true == $args['show_job'] && '' !=  $post->testimonial_job) ? $post->testimonial_job : "";
				$testimonial_job .= (true == $args['show_company'] && '' !=  $post->testimonial_company && true == $args['show_job'] && '' !=  $post->testimonial_job) ? " / ": "";
				if( $args['show_company'] == true && $post->testimonial_company != '' ){
					$testimonial_job .= (!empty($post->testimonial_url)) ? '<a href="'.$post->testimonial_url.'" target="_blank">'.$post->testimonial_company.'</a>' : $post->testimonial_company;
				}
				echo $testimonial_job;
			?>
			</div>
		</div>
		<div class="rtsw-testimonial-rate">
  	                    <?php if(true == $args['show_star'] && '' !=  $post->testimonial_star) { ?>	
			                   <?php  $totalstar = $post->testimonial_star; 
                                for ($i=0; $i<5; $i++) 
                                 {
                                 	 if($i<$totalstar )
                                 	 { echo '<i class="fa fa-star" aria-hidden="true"></i>';}
                                     else
                                     { echo '<i class="fa fa-star-o" aria-hidden="true"></i>'; }
                                 }
             ?>		
		<?php } ?> 
  </div>
			<?php $social = $args['social']; if($social == "true") { ?>
				<div class="rtsw-social">
					<ul> 
						<?php $fb = $post->testimonial_fb; $ld =  $post->testimonial_ld; $tw =  $post->testimonial_tw; $ig = $post->testimonial_instgram;     
						if($fb!= "") { ?> 
							<li><a href="<?php echo $post->testimonial_fb; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<?php }  if($ld!="") { ?>
							<li><a href="<?php echo $post->testimonial_ld; ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></i></a></li>
						<?php } if($tw!="") { ?>
							<li><a href="<?php echo $post->testimonial_tw; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>						
						<?php } if($ig!="") { ?>
							<li><a href="<?php echo $post->testimonial_instgram; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						<?php } ?>
					</ul>
				</div>
  <?php } ?>
		<div class="rtsw-testimonial-content">
			<h4><?php echo $post->post_title?></h4>
				<div class="testimonials-text">
					<p>	<?php if($args['show_quotes'] == true) { ?> <em> <?php } ?>
                      	<?php echo $post->post_content;?>
                     	<?php if($args['show_quotes'] == true) { ?> </em> <?php } ?>
                    </p>
                </div>
         </div>
	</div>
</div>