<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
// Allow only correct Google web font tags
$besclwp_webfontcode = wp_kses(get_option('besclwp_webfontcode'), array('link' => array('href' => array(),'rel' => array(),'type' => array())));

if (!empty($besclwp_webfontcode)) {
    echo str_replace("&amp;", '&', stripslashes($besclwp_webfontcode));
}   
?>    
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
<?php
// var_dump($_POST["acf"]["field_5ca333ec2680f"][0]);
// if ($_POST["acf"]["field_5ca333ec2680f"][0] == "yes"){
//     // echo "bananas";
//     wp_redirect( 'https://www.weildco.tech/affiliates/me/' );
//     echo "<a href='https://www.weildco.tech/affiliates/me/'>Please click here if you are not redirected.</a>";
//     exit;
//     die();
// }
$author_id = get_current_user_id();
$abc = get_field('terms_conditions', 'user_'. $author_id);
if ($abc[0] != "yes" && is_user_logged_in()) {
    echo "Loading...";

  ?>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    	<!-- Modal content-->
    	<div class="modal-content">
        	<div class="modal-body">
        		<p>
        		<?php acf_form_head();
        		   $args = array(
                          'post_id' =>'user_'.get_current_user_id(),
                          'form_attributes' => array(
                          'class' => 'new-campaign-form',
                          'id'=>'modalAjaxTrying'
        
                          ),
                          'field_groups' => array(676), //field group id
        				  'submit_value' => __("I Agree", 'acf'),
        				  'updated_message' => 'Thank you for subscribe!',
        				  'return' => false
                        );
            		acf_form( $args );  
        		?>
    			<?php // echo do_shortcode('[my_acf_user_form field_group="676"]'); ?>
        		</p>
        		
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	</div>
    	</div>
    
    </div>
</div>

<script type="text/javascript">




</script>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" type="text/css"/>
<script type="text/javascript">
(function ($) {
    "use strict";
    $(window).load(function(){        
    	$('#myModal').modal('show');
	});
	if($('#acf-field_5ca333ec2680f-yes[type=checkbox]')) {
	   $( ".modal-footer" ).hide();
	}

	if($('#acf-field_5ca333ec2680f-yes[type=checkbox]').attr('checked')) {
	   // location.reload(true); 
	   window.location.href = "<?=site_url("/affiliates/me/")?>";
	}
})(jQuery);
		
</script>

	

  
  <?php
 

} 
  ?>
    <?php $besocial_loading = get_option('besclwp_loading'); ?>
    <?php $besocial_custom_loading = get_option('besclwp_custom_loading'); ?>
    <?php if ($besocial_loading == 'true') { ?>
    <div id="besocial-loading-overlay">
        <?php if (empty($besocial_custom_loading)) { ?>
        <div id="besocial-loading-animation">
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <?php $besclwp_icon_menu = get_option('besclwp_icon_menu'); ?>
    <div id="besocial-wrap" <?php if (( !is_user_logged_in() ) || (!function_exists('bp_is_active')) || ($besclwp_icon_menu == 'true')) { ?>class="besocial-logout"<?php } ?>>
        <?php
        if ((empty($besclwp_icon_menu)) || ($besclwp_icon_menu != 'true')) {
            if (( is_user_logged_in()) && (function_exists('bp_is_active'))) {
                get_template_part( 'templates/iconmenu/loggedin', 'template');
            }
        }
        ?>
        <?php
        $besclwp_fixed_header = get_option('besclwp_fixed_header');
        if ((empty($besclwp_fixed_header)) || ($besclwp_fixed_header != 'true')) {
            get_template_part( 'templates/headers/fixed', 'template');
        } else {
            get_template_part( 'templates/headers/relative', 'template');
        } ?>
    <main id="besocial-content" class="<?php if ($besclwp_fixed_header == 'true') { echo esc_html('besocial-not-fixed'); } ?> <?php if ($besclwp_icon_menu == 'true') { echo esc_html('besocial-no-icon'); } ?>">
    <div id="besocial-content-inner">