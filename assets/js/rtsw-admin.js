rtsw_grid();
rtsw_slider();
function rtsw_grid() {   
    var sg_main = "[testimonials_grid  "; 
    var grid_cat = jQuery('#grid_cat').val();
    var rtsw_grids = jQuery('#rtsw_grids').val();
    var rtsw_limit = jQuery('#rtsw_limit').val();
    var rtsw_grid_design = jQuery('#rtsw_grid_design').val(); 
    var rtsw_grid_orderby = jQuery('#rtsw_grid_orderby').val(); 
    var rtsw_grid_order = jQuery('#rtsw_grid_order').val();
    var client_name = jQuery('#client_name').val();
    var rtsw_grid_star = jQuery('#rtsw_grid_star').val();
    var rtsw_grid_img = jQuery('#rtsw_grid_img').val(); 
    var rtsw_grid_job = jQuery('#rtsw_grid_job').val();  
    var rtsw_grid_company = jQuery('#rtsw_grid_company').val();
    var rtsw_grid_img_style = jQuery('#rtsw_grid_img_style').val();
    var rtsw_img_size = jQuery('#rtsw_img_size').val();
    var rtsw_grid_quote = jQuery('#rtsw_grid_quote').val();
    var rtsw_grid_video = jQuery('#rtsw_grid_video').val();
    var rtsw_grid_social = jQuery('#rtsw_grid_social').val();
if (rtsw_grid_design == 'default-template') {} else { sg_main = sg_main + ' design_template="' + rtsw_grid_design + '"';}
if (rtsw_limit == '-1') {} else { sg_main = sg_main + ' limit="' + rtsw_limit + '"';}
if (rtsw_grids == 'default-value') {} else { sg_main = sg_main + ' grid="' + rtsw_grids + '"';}
if (rtsw_grid_order == 'default-value') {} else { sg_main = sg_main + ' order="' + rtsw_grid_order + '"' ;} 
if (rtsw_grid_orderby == 'default-value') {} else { sg_main = sg_main + ' orderby="' + rtsw_grid_orderby + '"' ;}
if (grid_cat == 'nocat') {} else { sg_main = sg_main + ' category="' + grid_cat + '"';}
if (client_name == 'default-value') {} else { sg_main = sg_main + ' show_client="' + client_name + '"' ;}
if (rtsw_grid_star == 'default-value') {} else { sg_main = sg_main + ' show_star="' + rtsw_grid_star + '"' ;}
if (rtsw_grid_img == 'default-value') {} else { sg_main = sg_main + ' show_img="' + rtsw_grid_img + '"' ;} 
if (rtsw_grid_job == 'default-value') {} else { sg_main = sg_main + ' show_job="' + rtsw_grid_job + '"' ;}
if (rtsw_grid_company == 'default-value') {} else { sg_main = sg_main + ' show_company="' + rtsw_grid_company + '"' ;}
if (rtsw_grid_img_style == 'default-value') {} else { sg_main = sg_main + ' image_style="' + rtsw_grid_img_style + '"' ;}
if (rtsw_img_size == '150px') {} else { sg_main = sg_main + ' size="' + rtsw_img_size + '"';}
if (rtsw_grid_quote == 'default-value') {} else { sg_main = sg_main + ' show_quotes="' + rtsw_grid_quote + '"' ;}
if (rtsw_grid_video == 'default-value') {} else { sg_main = sg_main + ' video="' + rtsw_grid_video + '"' ;}  
if (rtsw_grid_social == 'default-value') {} else { sg_main = sg_main + ' social="' + rtsw_grid_social + '"' ;}  
    sg_main = sg_main + ']';
    jQuery("#rtsw-grid-shortcode").text(sg_main);
    jQuery("#rtsw-grid_shortcode_php").text("'"+sg_main+"'");
}
function rtsw_slider() {   
    var sg_main = "[testimonials_slider  ";  
    var grid_cat = jQuery('#grid_cat').val();
    var rtsw_slider_cell = jQuery('#rtsw_slider_cell').val();
    var rtsw_slider_limit = jQuery('#rtsw_slider_limit').val();
    var rtsw_slider_design = jQuery('#rtsw_slider_design').val(); 
    var rtsw_slider_orderby = jQuery('#rtsw_slider_orderby').val(); 
    var rtsw_slider_order = jQuery('#rtsw_slider_order').val();
    var client_name = jQuery('#client_name').val();
    var rtsw_slider_star = jQuery('#rtsw_slider_star').val();
    var rtsw_slider_img = jQuery('#rtsw_slider_img').val(); 
    var rtsw_slider_job = jQuery('#rtsw_slider_job').val();  
    var rtsw_slider_company = jQuery('#rtsw_slider_company').val();
    var rtsw_slider_img_style = jQuery('#rtsw_slider_img_style').val();
    var rtsw_img_size = jQuery('#rtsw_img_size').val(); 
    var rtsw_slider_quote = jQuery('#rtsw_slider_quote').val();
    var rtsw_slider_dots = jQuery('#rtsw_slider_dots').val(); 
    var rtsw_slider_arrows = jQuery('#rtsw_slider_arrows').val(); 
    var rtsw_slider_autoplay = jQuery('#rtsw_slider_autoplay').val();
    var rtsw_slider_autohight = jQuery('#rtsw_slider_autohight').val(); 
    var rtsw_slider_speed = jQuery('#rtsw_slider_speed').val();
    var lswr_slider_scroll = jQuery('#lswr_slider_scroll').val(); 
    var rtsw_slider_interval = jQuery('#rtsw_slider_interval').val();
    var rtsw_slider_video = jQuery('#rtsw_slider_video').val();
    var rtsw_slider_social = jQuery('#rtsw_slider_social').val();

 if (rtsw_slider_design == 'default-template') {} else { sg_main = sg_main + ' design_template="' + rtsw_slider_design + '"';}
 if (rtsw_slider_limit == '-1') {} else { sg_main = sg_main + ' limit="' + rtsw_slider_limit + '"';}
 if (rtsw_slider_cell == 'default-template') {} else { sg_main = sg_main + ' grid="' + rtsw_slider_cell + '"';}
 if (rtsw_slider_order == 'default-value') {} else { sg_main = sg_main + ' order="' + rtsw_slider_order + '"' ;}    
 if (rtsw_slider_orderby == 'default-value') {} else { sg_main = sg_main + ' orderby="' + rtsw_slider_orderby + '"' ;}
 if (grid_cat == 'nocat') {} else { sg_main = sg_main + ' category="' + grid_cat + '"';}
 if (client_name == 'default-value') {} else { sg_main = sg_main + ' show_client="' + client_name + '"' ;}
 if (rtsw_slider_star == 'default-value') {} else { sg_main = sg_main + ' show_star="' + rtsw_slider_star + '"' ;}
 if (rtsw_slider_img == 'default-value') {} else { sg_main = sg_main + ' show_img="' + rtsw_slider_img + '"' ;}
 if (rtsw_slider_job == 'default-value') {} else { sg_main = sg_main + ' show_job="' + rtsw_slider_job + '"' ;}
 if (rtsw_slider_company == 'default-value') {} else { sg_main = sg_main + ' show_company="' + rtsw_slider_company + '"' ;}
 if (rtsw_slider_img_style == 'default-value') {} else { sg_main = sg_main + ' image_style="' + rtsw_slider_img_style + '"' ;}
 if (rtsw_img_size == '150px') {} else { sg_main = sg_main + ' size="' + rtsw_img_size + '"';}
 if (rtsw_slider_quote == 'default-value') {} else { sg_main = sg_main + ' show_quotes="' + rtsw_slider_quote + '"' ;}
 if (rtsw_slider_video == 'default-value') {} else { sg_main = sg_main + ' video="' + rtsw_slider_video + '"' ;}
 if (rtsw_slider_social == 'default-value') {} else { sg_main = sg_main + ' social="' + rtsw_slider_social + '"' ;}
 if (lswr_slider_scroll == '1') {} else { sg_main = sg_main + ' slides_scroll="' + lswr_slider_scroll + '"' ;}
 if (rtsw_slider_dots == 'default-value') {} else { sg_main = sg_main + ' dots="' + rtsw_slider_dots + '"' ;}
 if (rtsw_slider_arrows == 'default-value') {} else { sg_main = sg_main + ' arrows="' + rtsw_slider_arrows + '"' ;}
 if (rtsw_slider_speed == '300') {} else { sg_main = sg_main + ' speed="' + rtsw_slider_speed + '"' ;}
 if (rtsw_slider_autoplay == 'default-value') {} else { sg_main = sg_main + ' autoplay="' + rtsw_slider_autoplay + '"' ;}
 if (rtsw_slider_interval == '3000') {} else { sg_main = sg_main + ' autoplay_interval="' + rtsw_slider_interval + '"' ;}
 if (rtsw_slider_autohight == 'default-value') {} else { sg_main = sg_main + ' adaptive_height="' + rtsw_slider_autohight + '"' ;}
    sg_main = sg_main + ']';
    jQuery("#rtsw_slider_shortcode").text(sg_main);
    jQuery("#rtsw_slider_shortcode_php").text("'"+sg_main+"'");
}