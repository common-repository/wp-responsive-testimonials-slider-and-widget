<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package wp-responsive-testimonials-slider
 * @since 1.0.0
 */
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
// Action to add menu
add_action('admin_menu', 'rtsw_register_design_page');
/**
 * Register plugin design page in admin menu
 * 
 * @package wp-responsive-testimonials-slider
 * @since 1.0.0
 */
function rtsw_register_design_page() {
	add_submenu_page( 'edit.php?post_type='.RTSW_POST_TYPE, __('How it works, our plugins and offers', 'wp-responsive-testimonials-slider'), __('Help and shortcode Generator', 'wp-responsive-testimonials-slider'), 'manage_options', 'rtsw-designs', 'rtsw_designs_page' );
}
/**
 * Function to display plugin design HTML
 * 
 * @package wp-responsive-testimonials-slider
 * @since 1.0.0
 */
function rtsw_designs_page() {
	$wpoh_admin_tabs = rtsw_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? rtsw_sanitize_clean($_GET['tab']) : 'help-for-you';
?>		
	<div class="wrap rtsw-wrap">
		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpoh_admin_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array( 'post_type' => RTSW_POST_TYPE, 'page' => 'rtsw-designs', 'tab' => $tab_key), admin_url('edit.php') );
			?>
			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>
			<?php } ?>
		</h2>		
		<div class="rtsw-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'help-for-you' ) {
				rtsw_work_page();
			}
			if( isset($active_tab) && $active_tab == 'grid-shortcode' ) {
				rtsw_grid_shortcode();
			}
			if( isset($active_tab) && $active_tab == 'slider-shortcode' ) {
				rtsw_slider_shortcode();
			}
			if( isset($active_tab) && $active_tab == 'hire-wpexpert' ) {
				echo  rtsw_get_plugin_design('hire-wpexpert');
			}			
		?>
		</div><!-- end .rtsw-tab-cnt-wrp -->
	</div><!-- end .rtsw-wrap -->
<?php
}
/**
 * Function to get plugin feed tabs
 *
 * @package wp-responsive-testimonials-slider
 * @since 1.0.0
 */
function rtsw_help_tabs() {
	$wpoh_admin_tabs = array(
						'help-for-you' 	=> array('name' => __('Help For You', 'wp-responsive-testimonials-slider'),),
						'grid-shortcode' 	=> array('name' => __('Grid shortcode Generator', 'wp-responsive-testimonials-slider'),),
		                'slider-shortcode' => array('name' => __('Slider shortcode Generator', 'wp-responsive-testimonials-slider'),),
		                'hire-wpexpert' 	=> array(
													'name'				=> __('For Quick Help ', 'wp-responsive-testimonials-slider'),
													'url'				=> 'https://wponlinehelp.com/wordpress-help/help-offers.php',
													'offer_key'		=> 'wpoh_offers_feed',
													'offer_time'	=> 98400,
												)		
							
					);
	return $wpoh_admin_tabs;
}
/**
 * Function to get 'How It Works' HTML
 *
 * @package wp-responsive-testimonials-slider
 * @since 1.0.0
 */
function rtsw_work_page() { ?>	
	<style type="text/css">
	  	.rtsw-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
	</style>
	<div class="post-box-container">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-1">			
				<!--Help for you HTML -->
				<div id="post-body-content">
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">								
								<h3 class="hndle">
									<span><?php _e( 'Help for you - Display and shortcode', 'wp-responsive-testimonials-slider' ); ?></span>
								</h3>								
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Basic Step', 'wp-responsive-testimonials-slider'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1. Go to "Easy Testimonials --> Add New".', 'wp-responsive-testimonials-slider'); ?></li>
														<li><?php _e('Step-2. Add  Testimonials title, description and images', 'wp-responsive-testimonials-slider'); ?></li>
														<li><?php _e('Step-3. Add Testimonial Details like Client Name, Job Title detials...', 'wp-responsive-testimonials-slider'); ?></li>
														<li><?php _e('Step-4. Once added, press Publish button', 'wp-responsive-testimonials-slider'); ?></li>
													</ul>
												</td>
											</tr>
											<tr>
												<th>
													<label><?php _e('How to used Shortcode', 'wp-responsive-testimonials-slider'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1. Create a page like name with Testimonials.', 'wp-responsive-testimonials-slider'); ?></li>
														<li><?php _e('Step-2. Set shortcode as per your need and put in page text section.', 'wp-responsive-testimonials-slider'); ?></li>
													</ul>
												</td>
											</tr>
											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'wp-responsive-testimonials-slider'); ?>:</label>
												</th>
												<td>
													<span class="rtsw-shortcode-preview">[testimonials_grid]</span> – <?php _e('Display in Grid with four designs template.', 'wp-responsive-testimonials-slider'); ?> <br />
													<span class="rtsw-shortcode-preview">[testimonials_slider]</span> – <?php _e('Display in Slider with four designs template.', 'wp-responsive-testimonials-slider'); ?> <br />													
												</td>
											</tr>
											<tr>
												<th>
													<label><?php _e('Widget', 'wp-responsive-testimonials-slider'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1. Go to Appearance --> Widget.', 'wp-responsive-testimonials-slider'); ?></li>
														<li><?php _e('Step-2. Use WP Testimonials Slider to display Testimonials in widget area with slider.', 'wp-responsive-testimonials-slider'); ?></li>
													</ul>												
												</td>
											</tr>												
											<tr>
												<th>
													<label><?php _e('Need Any Help?', 'wp-responsive-testimonials-slider'); ?></label>
												</th>
												<td>																				
													<a  href="mailto:help@wponlinehelp.com">help@wponlinehelp.com</a><br/> <br/>
													<a class="button button-primary" href="http://demo.wponlinehelp.com/wp-responsive-testimonials-slider-and-widget/" target="_blank"><?php _e('Live Demo', 'wp-responsive-testimonials-slider'); ?></a>
													<a class="button button-primary" href="http://docs.wponlinehelp.com/docs-project/wp-responsive-testimonials-slider-and-widget/" target="_blank"><?php _e('Documentation', 'wp-responsive-testimonials-slider'); ?></a>
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-body-content -->
			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }
/**
 * 'plugin Grid Short code
 *
 * @package wp logo slider with widget responsive
 * @since 1.0
 */
function rtsw_grid_shortcode() { ?>	
	<style type="text/css">
		.shortcode-bg{background-color: #f0f0f0;padding: 10px 5px;display: inline-block;margin: 0 0 5px 0;font-size: 16px;border-radius: 5px;	
		}
		.lswr_shortcode_generator label{font-weight: 700; width: 100%; float: left;}
		.lswr_shortcode_generator select{width: 100%;}
	</style>
	<div id="post-body-content">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div class="postbox">
					<h3 style="font-size: 18px;">
						<?php _e('Create Testimonial Grid Shortcode :-', 'wp-responsive-testimonials-slider') ?>
					</h3>
					<div class="inside">
						<table cellpadding="10" cellspacing="10">
							<tbody><tr><td valign="top">
								<div class="postbox" style="width:300px;">
								<form id="shortcode_generator" style="padding:20px;" class="lswr_shortcode_generator">
										<p><label for="rtsw_grid_design"><?php _e('1) Select Design Template:', 'wp-responsive-testimonials-slider'); ?></label>
										  	<?php $sg_tempalte = rtsw_templates() ?>
										  	<select id="rtsw_grid_design" name="rtsw_grid_design"
										  	onchange="rtsw_grid()">
										  	<option value="default-template">Default Template</option>
										  	<?php  foreach ($sg_tempalte as $k): ?>
										  		<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
										  			<?php _e($k, 'wp-responsive-testimonials-slider') ?>
										  		</option>
										  	<?php endforeach; ?>
										  </select>
										</p>
										<p><label for="rtsw_limit"><?php _e('2) Show Logo Limit:', 'wp-responsive-testimonials-slider'); ?></label>
						                    <input id="rtsw_limit" name="rtsw_limit" type="text" value="-1"
										      onchange="rtsw_grid()">
										     <span class="howto"> <?php _e('( For all "-1" Enter any Numeric No. )', 'wp-responsive-testimonials-slider'); ?></span>
										  </p>
										   <p><label for="rtsw_grids"><?php _e('3) Select Grid:', 'wp-responsive-testimonials-slider'); ?></label>
								 	      <select id="rtsw_grids" name="rtsw_grids" onchange="rtsw_grid()">
								 	      	<option value="default-value">Default Template</option>
										    <option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											</select>
								   </p>
								    	<p>
												<label for="rtsw_grid_order"><?php _e('4) Select Order:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_grid_order = rtsw_asc_desc() ?>
												<select id="rtsw_grid_order" name="rtsw_grid_order" onchange="rtsw_grid()">
													<option value="default-value">No Need</option>
													<?php foreach ($rtsw_grid_order as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
												<span class="howto">( Set  Ascending Order OR  Descending Order. )</span>
											</p>
							         <p>
												<label for="rtsw_grid_orderby"><?php _e('5) Select Order By:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_grid_orderby = rtsw_orderby() ?>
												<select id="rtsw_grid_orderby" name="rtsw_grid_orderby" onchange="rtsw_grid()">
													<option value="default-value">No Need</option>
													<?php foreach ($rtsw_grid_orderby as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
											</p>									
										<p>
											<label for="rtsw_cat">
												<?php _e('6) Select Category:', 'wp-responsive-testimonials-slider') ?></label>
												<?php
												$args = array("post_type"=> "post", "post_status"=> "publish");
												$terms = get_terms(['taxonomy' => RTSW_CAT,$args]);   	      						
												 ?>
												<select id="grid_cat" name="rtsw_cat" onchange="rtsw_grid()">
												   <option value="nocat">All Testimonial</option>
													<?php if ($terms!='') {
													foreach ($terms as $key => $value) { ?>
														<option value="<?php echo $value->term_id; ?>">
															<?php echo $value->name;  ?>
														</option>													
													<?php  } } ?>
												</select>
												<span class="howto"> ( By default All Testimonial. )</span>												
											</p>
                                        <p>							  
												<label for="client_name"><?php _e('7) Display Client Name:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $client_name = rtsw_true_false() ?>
												<select id="client_name" name="client_name" onchange="rtsw_grid()">
													<option value="default-value">No Need</option>
													<?php foreach ($client_name as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_grid_star"><?php _e('8) Display Star Rating:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_grid_star = rtsw_true_false() ?>
												<select id="rtsw_grid_star" name="rtsw_grid_star" onchange="rtsw_grid()">
													<option value="default-value">No Need</option>
													<?php foreach ($rtsw_grid_star as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_grid_img"><?php _e('9) Display Image:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_grid_img = rtsw_true_false() ?>
												<select id="rtsw_grid_img" name="rtsw_grid_img" onchange="rtsw_grid()">
													<option value="default-value">No Need</option>
													<?php foreach ($rtsw_grid_img as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_grid_job"><?php _e('10) Display Job Position:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_grid_job = rtsw_true_false() ?>
												<select id="rtsw_grid_job" name="rtsw_grid_job" onchange="rtsw_grid()">
													<option value="default-value">No Need</option>
													<?php foreach ($rtsw_grid_job as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_grid_company"><?php _e('11) Display Company Name:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_grid_company = rtsw_true_false() ?>
												<select id="rtsw_grid_company" name="rtsw_grid_company" onchange="rtsw_grid()">
													<option value="default-value">No Need</option>
													<?php foreach ($rtsw_grid_company as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_grid_img_style"><?php _e('12) Set Image Style:', 'wp-responsive-testimonials-slider'); ?> 
												</label>												
												<select id="rtsw_grid_img_style" name="rtsw_grid_img_style" onchange="rtsw_grid()">											<option value="default-value">No Need</option>
													<option value="<?php _e('circle', 'wp-responsive-testimonials-slider') ?>">
															<?php _e('circle', 'wp-responsive-testimonials-slider') ?>
													</option>
													<option value="<?php _e('square', 'wp-responsive-testimonials-slider') ?>">
															<?php _e('square', 'wp-responsive-testimonials-slider') ?>
													</option>
													
												</select>
									</p>
									<p><label for="rtsw_img_size"><?php _e('13) Set Image Size:', 'wp-responsive-testimonials-slider'); ?></label>
						                    <input id="rtsw_img_size" name="rtsw_img_size" type="text" value="150px"
										      onchange="rtsw_grid()">
										      <span class="howto"> <?php _e(' ( Set size of image in px. )', 'wp-responsive-testimonials-slider'); ?></span>
										  </p>
										  <p>
												<label for="rtsw_grid_quote"><?php _e('14) Show Double And Single Quotes:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_grid_quote = rtsw_true_false() ?>
												<select id="rtsw_grid_quote" name="rtsw_grid_quote" onchange="rtsw_grid()">
													<option value="default-value">No Need</option>
													<?php foreach ($rtsw_grid_quote as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_grid_video"><?php _e('15) Show Video:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_grid_video = rtsw_true_false() ?>
												<select id="rtsw_grid_video" name="rtsw_grid_video" onchange="rtsw_grid()">
													<option value="default-value">No Need</option>
													<?php foreach ($rtsw_grid_video as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_grid_social"><?php _e('16) Show Social Icon:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_grid_social = rtsw_true_false() ?>
												<select id="rtsw_grid_social" name="rtsw_grid_social" onchange="rtsw_grid()">
													<option value="default-value">No Need</option>
													<?php foreach ($rtsw_grid_social as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
										</form>
									</div>
								</td>
								<td valign="top"><h3><?php _e('Shortcode:', 'wp-responsive-testimonials-slider'); ?></h3> 
									<p style="font-size: 16px;"><?php _e('Use this shortcode to display the Testimonial Grid in your posts or pages! Just copy this piece of text and place it where you want it to display.', 'wp-responsive-testimonials-slider'); ?> </p>
									<div id="rtsw-grid-shortcode" style="margin:20px 0; padding: 10px;
									background: #e7e7e7;font-size: 16px;border-left: 4px solid #13b0c5;" >
								</div>
								<div style="margin:20px 0; padding: 10px;
								background: #e7e7e7;font-size: 16px;border-left: 4px solid #13b0c5;" >
								&lt;?php echo do_shortcode(<span id="rtsw-grid_shortcode_php"></span>); ?&gt;
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div><!-- .inside -->
		<hr>
				</div>
			</div>
		</div>
	</div>			
<?php } 
/**
 * 'plugin Slider Short code Generater
 *
 * @package wp logo slider with widget responsive
 * @since 1.0
 */
function rtsw_slider_shortcode() { ?>	
	<style type="text/css">
		.shortcode-bg{background-color: #f0f0f0;padding: 10px 5px;display: inline-block;margin: 0 0 5px 0;font-size: 16px;border-radius: 5px;}
		.lswr_shortcode_generator label{font-weight: 700; width: 100%; float: left;}
		.lswr_shortcode_generator select{width: 100%;}
	</style>
	<div id="post-body-content">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div class="postbox">
					<h3 style="font-size: 18px;">
						<?php _e('Create Testimonial Slider Shortcode :-', 'wp-responsive-testimonials-slider') ?>
					</h3>
					<div class="inside">
						<table cellpadding="10" cellspacing="10">
							<tbody><tr><td valign="top">
								<div class="postbox" style="width:300px;">
									<form id="shortcode_generator" style="padding:20px;" class="lswr_shortcode_generator">
									 <p><label for="rtsw_slider_design"><?php _e('1) Select Design Template:', 'wp-responsive-testimonials-slider'); ?></label>
										  	<?php $sg_tempalte = rtsw_templates() ?>
										  	<select id="rtsw_slider_design" name="rtsw_slider_design"
										  	onchange="rtsw_slider()">
										  	<option value="default-template">Default Template</option>
										  	<?php  foreach ($sg_tempalte as $k): ?>
										  		<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
										  			<?php _e($k, 'wp-responsive-testimonials-slider') ?>
										  		</option>
										  	<?php endforeach; ?>
										  </select> 
										</p>
										 <p><label for="rtsw_slider_limit"><?php _e('2) Set Slides Limit:', 'wp-responsive-testimonials-slider'); ?></label>
											   	<input id="rtsw_slider_limit" name="rtsw_slider_limit" type="text" value="-1"
											   	onchange="rtsw_slider()">
											   	<span class="howto"> <?php _e('( For all "-1" Enter any Numeric No. ) ', 'wp-responsive-testimonials-slider'); ?></span>
										   </p>
										   <p><label for="rtsw_slider_cell"><?php _e('3) Select Slides Cell:', 'wp-responsive-testimonials-slider'); ?></label>
												<?php $sg_tempalte = rtsw_grid_arr() ?>
												<select id="rtsw_slider_cell" name="rtsw_slider_cellr"
												onchange="rtsw_slider()">
												<option value="default-template">Default Value</option>
												<?php  foreach ($sg_tempalte as $k): ?>
													<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
														<?php _e($k, 'wp-responsive-testimonials-slider') ?>
													</option>
												<?php endforeach; ?>
											</select>
										</p>
										 	<p>
												<label for="rtsw_slider_order"><?php _e('4) Select Order:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_slider_order = rtsw_asc_desc() ?>
												<select id="rtsw_slider_order" name="rtsw_slider_order" 
												     onchange="rtsw_slider()">
													<option value="default-value">No Need</option>
													<?php foreach ($rtsw_slider_order as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
												<span class="howto"> ( Set  Ascending Order OR  Descending Order. )</span>
											</p>
							         <p>
												<label for="rtsw_slider_orderby"><?php _e('5) Select Order By:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_slider_orderby = rtsw_orderby() ?>
												<select id="rtsw_slider_orderby" name="rtsw_slider_orderby" onchange="rtsw_slider()">
													<option value="default-value">No Need</option>
													<?php foreach ($rtsw_slider_orderby as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
											</p>										
										
										<p>
											<label for="rtsw_cat">
												<?php _e('6) Select Category:', 'wp-responsive-testimonials-slider') ?></label>
												<?php
												$args = array("post_type"=> "post", "post_status"=> "publish");
												$terms = get_terms(['taxonomy' => RTSW_CAT,$args]);   	      						
												 ?>
												<select id="grid_cat" name="rtsw_cat" onchange="rtsw_slider()">
												   <option value="nocat">All Testimonial</option>
													<?php if ($terms!='') {
													foreach ($terms as $key => $value) { ?>
														<option value="<?php echo $value->term_id; ?>">
															<?php echo $value->name;  ?>
														</option>													
													<?php  } } ?>
												</select>
												<span class="howto"> ( By default All Testimonial. )</span>												
											</p>
											
										  
										 
							  											
									<p>
												<label for="client_name"><?php _e('7) Display Client Name:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $client_name = rtsw_true_false() ?>
												<select id="client_name" name="client_name" onchange="rtsw_slider()">
													<option value="default-value">Default option</option>
													<?php foreach ($client_name as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_slider_star"><?php _e('8) Display Star Rating:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_slider_star = rtsw_true_false() ?>
												<select id="rtsw_slider_star" name="rtsw_slider_star" onchange="rtsw_slider()">
													<option value="default-value">Default option</option>
													<?php foreach ($rtsw_slider_star as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_slider_img"><?php _e('9) Display Image:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_slider_img = rtsw_true_false() ?>
												<select id="rtsw_slider_img" name="rtsw_slider_img" onchange="rtsw_slider()">
													<option value="default-value">Default option</option>
													<?php foreach ($rtsw_slider_img as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_slider_job"><?php _e('10) Display Job Position:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_slider_job = rtsw_true_false() ?>
												<select id="rtsw_slider_job" name="rtsw_slider_job" onchange="rtsw_slider()">
													<option value="default-value">Default option</option>
													<?php foreach ($rtsw_slider_job as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_slider_company"><?php _e('11) Display Company Name:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_slider_company = rtsw_true_false() ?>
												<select id="rtsw_slider_company" name="rtsw_slider_company" onchange="rtsw_slider()">
													<option value="default-value">Default option</option>
													<?php foreach ($rtsw_slider_company as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_slider_img_style"><?php _e('12) Set Image Style:', 'wp-responsive-testimonials-slider'); ?> 
												</label>												
												<select id="rtsw_slider_img_style" name="rtsw_slider_img_style" onchange="rtsw_slider()">										<option value="default-value">Default option</option>			
													<option value="<?php _e('circle', 'wp-responsive-testimonials-slider') ?>">
															<?php _e('circle', 'wp-responsive-testimonials-slider') ?>
													</option>
													<option value="<?php _e('square', 'wp-responsive-testimonials-slider') ?>">
															<?php _e('square', 'wp-responsive-testimonials-slider') ?>
													</option>
													
												</select>
									</p>
									<p><label for="rtsw_img_size"><?php _e('13) Set Image Size:', 'wp-responsive-testimonials-slider'); ?></label>
						                    <input id="rtsw_img_size" name="rtsw_img_size" type="text" value="150px"
										      onchange="rtsw_slider()">
										      <span class="howto"> <?php _e('( Set size of image in px. )', 'wp-responsive-testimonials-slider'); ?></span>
										  </p>
										  <p>
												<label for="rtsw_slider_quote"><?php _e('14) Show Double And Single Quotes:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_slider_quote = rtsw_true_false() ?>
												<select id="rtsw_slider_quote" name="rtsw_slider_quote" onchange="rtsw_slider()">
													<option value="default-value">Default option</option>
													<?php foreach ($rtsw_slider_quote as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_slider_video"><?php _e('15) Show Video:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_slider_video = rtsw_true_false() ?>
												<select id="rtsw_slider_video" name="rtsw_slider_video" onchange="rtsw_slider()">
													<option value="default-value">Default option</option>
													<?php foreach ($rtsw_slider_video as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p>
												<label for="rtsw_slider_social"><?php _e('16) Show Social Icon:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_slider_social = rtsw_true_false() ?>
												<select id="rtsw_slider_social" name="rtsw_slider_social"
												  onchange="rtsw_slider()">
												  <option value="default-value">Default option</option>
													<?php foreach ($rtsw_slider_social as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									<p><label for="rtsw_cat_limit"><?php _e('17). Move(Scroll) logo for each slide:', 'wp-logo-slider-and-widget'); ?></label>
						                    <input id="lswr_slider_scroll" name="rtsw_slider_scroll" type="text" value="1"
										      onchange="rtsw_slider()">
										      <span class="howto"> <?php _e('( Default value is "1" ).', 'wp-responsive-testimonials-slider'); ?></span>
										  </p>
									  <p>
												<label for="rtsw_slider_dots"><?php _e('18) Show Pagination Bullet:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_slider_dots = rtsw_true_false() ?>
												<select id="rtsw_slider_dots" name="rtsw_slider_dots" onchange="rtsw_slider()">
													<option value="default-value">Default option</option>
													<?php foreach ($rtsw_slider_dots as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									 <p>
												<label for="rtsw_slider_arrows"><?php _e('19) Show and Hide Arrows:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_slider_arrows = rtsw_true_false() ?>
												<select id="rtsw_slider_arrows" name="rtsw_slider_arrows" onchange="rtsw_slider()">
													<option value="default-value">Default option</option>
													<?php foreach ($rtsw_slider_arrows as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									 <p>
												<label for="rtsw_slider_autoplay"><?php _e('20) Set AutoPlay:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_slider_autoplay = rtsw_true_false() ?>
												<select id="rtsw_slider_autoplay" name="rtsw_slider_autoplay" onchange="rtsw_slider()">
													<option value="default-value">Default option</option>
													<?php foreach ($rtsw_slider_autoplay as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
									
									<p><label for="rtsw_slider_speed"><?php _e('21) Slides Moving Speed:', 'wp-responsive-testimonials-slider');?> </label>
						                    <input id="rtsw_slider_speed" name="rtsw_slider_speed" value="300" onchange="rtsw_slider()" type="text">
										      <span class="howto"> ( Set Slides Moving Speed value in Milliseconds. Default value is 300 ).</span>
										</p>
										<p><label for="rtsw_slider_interval"><?php _e('22) Moving Interval between Two Slides:', 'wp-responsive-testimonials-slider'); ?> </label>
						                    <input id="rtsw_slider_interval" name="rtsw_slider_speed" value="3000" onchange="rtsw_slider()" type="text">
										      <span class="howto"> ( Set Slides Moving Speed value in Milliseconds. Default value is 3000 ).</span>
										</p>
										<p>
												<label for="rtsw_slider_autohight"><?php _e('23) Set Auto Set Height:', 'wp-responsive-testimonials-slider'); ?> 
												</label>
												<?php $rtsw_slider_autohight = rtsw_true_false() ?>
												<select id="rtsw_slider_autohight" name="rtsw_slider_autohight" onchange="rtsw_slider()">
													<option value="default-value">Default option</option>
													<?php foreach ($rtsw_slider_autohight as $k): ?>
														<option value="<?php _e($k, 'wp-responsive-testimonials-slider') ?>">
															<?php _e($k, 'wp-responsive-testimonials-slider') ?>
														</option>
													<?php endforeach; ?>
												</select>
									</p>
										
										</form>
									</div>
								</td>
								<td valign="top"><h3><?php _e('Shortcode:', 'wp-responsive-testimonials-slider'); ?></h3> 
									<p style="font-size: 16px;"><?php _e('Use this shortcode to display the Testimonials Slider in your posts or pages! Just copy this piece of text and place it where you want it to display.', 'wp-responsive-testimonials-slider'); ?> </p>
									<div id="rtsw_slider_shortcode" style="margin:20px 0; padding: 10px;
									background: #e7e7e7;font-size: 16px;border-left: 4px solid #3E7CAA;" >
								</div>
								<div style="margin:20px 0; padding: 10px;
								background: #e7e7e7;font-size: 16px;border-left: 4px solid #3E7CAA;" >
								&lt;?php echo do_shortcode(<span id="rtsw_slider_shortcode_php"></span>); ?&gt;
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div><!-- .inside -->
		<hr>
				</div>
			</div>
		</div>
	</div>			
<?php }
/**
 * Gets the plugin design part feed
 *
 * @package Video gallery and Player
 * @since 1.0.0
 */
function rtsw_get_plugin_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? rtsw_sanitize_clean($_GET['tab']) : '';
	
	// If tab is not set then return
	if( empty($active_tab) ) {
		return false;
	}
	// Taking some variables
	$wpoh_admin_tabs = rtsw_help_tabs();
	$offer_key 	= isset($wpoh_admin_tabs[$active_tab]['offer_key']) 	? $wpoh_admin_tabs[$active_tab]['offer_key'] 	: 'wppf_' . $active_tab;
	$url 			= isset($wpoh_admin_tabs[$active_tab]['url']) 			? $wpoh_admin_tabs[$active_tab]['url'] 				: '';
	$offer_time = isset($wpoh_admin_tabs[$active_tab]['offer_time']) ? $wpoh_admin_tabs[$active_tab]['offer_time'] 	: 172800;
    $offercache 			= get_transient( $offer_key );	
	if ($offercache !=" ") {		
		$feed 			= wp_remote_get( rtsw_clean_url($url));
		$response_code 	= wp_remote_retrieve_response_code( $feed );
		if ( ! is_wp_error( $feed ) && $response_code == 200 ) {
			if ( isset( $feed['body'] ) && strlen( $feed['body'] ) > 0 ) {
				$offercache = wp_remote_retrieve_body( $feed );
				set_transient( $offer_key, $offercache, $offer_time );
			}
		} else {
			$offercache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'html5-videogallery-plus-player' ) . '</div>';
		}
	}
	return $offercache;	
}