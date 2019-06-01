<?php
function besclwp_theme_styles()  
{  
    $besclwp_sharing_css_check = get_option('besclwp_remove_sharing');
    $besclwp_lightbox_css_check = get_option('besclwp_lightbox');
    $besclwp_post_format_css_check = get_post_format();
    
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css', true, '1.0');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', false, '4.6.3');
    wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick.css', false, '4.6.3');
    if (empty($besclwp_sharing_css_check) && ($besclwp_sharing_css_check != 'true') && is_single()) {
        wp_enqueue_style('rrssb', get_template_directory_uri() . '/css/rrssb.css', false, '4.6.3');
    }
    if (empty($besclwp_lightbox_css_check) && ($besclwp_lightbox_css_check != 'true') && ($besclwp_post_format_css_check == 'gallery')) {
        wp_enqueue_style('featherlight', get_template_directory_uri() . '/css/featherlight.css', false, '1.5.0');
    }
    wp_enqueue_style('selectric', get_template_directory_uri() . '/css/selectric.css', false, '1.11.0');
    wp_enqueue_style('besclwp-style', get_template_directory_uri() . '/style.css', false, wp_get_theme()->get('Version'));
    wp_enqueue_style( 'besclwp-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'besclwp-style' ), wp_get_theme()->get('Version'));

      wp_enqueue_script( 'myscript', get_stylesheet_directory_uri() . '/js/myscript.js', array( 'jquery' ), '1.0.2', true);
}

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

/**
* Redirect buddypress pages to registration page ** Imran's Edit **
*/
function besclwp_page_template_redirect()
{
    //if not logged in and on a bp page except registration or activation
    if( ! is_user_logged_in() && ! bp_is_blog_page() && ! bp_is_activation_page() && ! bp_is_register_page() ) {
        wp_redirect( home_url( '/login/' ) );
        exit();
    }
}
add_action( 'template_redirect', 'besclwp_page_template_redirect' );

// END ENQUEUE PARENT ACTION

// define the bp_member_header_actions callback 
function action_bp_member_header_actions(  ) { 
  // make action magic happen here... 
  $wo_email = xprofile_get_field_data('33', bp_get_member_user_id());
  $wp_office = xprofile_get_field_data('788', bp_get_member_user_id());
  $wp_mobile = xprofile_get_field_data('789', bp_get_member_user_id());
  ?>
  

  
  <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Contact Affiliate</button>
  <div id="myDropdown" class="dropdown-content">
  <?php if( $wp_office != false ) ?>
	  <a href="tel:<?php echo strip_tags($wp_office); ?>"><strong><i class="fa fa-phone"></i></strong><strong>Office:</strong> <?php echo strip_tags($wp_office); ?></a>
    
  <?php if( $wp_mobile != false ) ?>
	  <a href="tel:<?php echo strip_tags($wp_mobile); ?>"><strong><i class="fa fa-mobile"></i></strong><strong>Mobile:</strong> <?php echo strip_tags($wp_mobile); ?></a>
  <?php if( $wo_email != false ) ?>
  <a href="mailto:<?php echo strip_tags($wo_email); ?>"><strong><i class="fa fa-envelope"></i></strong> <?php echo strip_tags($wo_email); ?></a>
  
  <?php echo do_shortcode('[hcardvcard title="" display_vcard=true]'); ?>
  </div>
</div>
<script>
function myFunction() {
		document.getElementById("myDropdown").classList.toggle("show");
	  }
	  
	  // Close the dropdown if the user clicks outside of it
	  window.onclick = function(event) {
		if (!event.target.matches('.dropbtn')) {
		  var dropdowns = document.getElementsByClassName("dropdown-content");
		  var i;
		  for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
			  openDropdown.classList.remove('show');
			}
		  }
		}
    }
</script>
  
  
  <?php
  
}; 
         
// add the action 
add_action( 'bp_member_header_actions', 'action_bp_member_header_actions', 10, 0 ); 


// define the bp_member_name callback 
function filter_bp_member_name( $bp_get_member_name ) { 
  // make filter magic happen here... 
  $last_name = xprofile_get_field_data('1384', bp_get_member_user_id());
  return $bp_get_member_name.' '.$last_name; 
}; 
       
// add the filter 
add_filter( 'bp_member_name', 'filter_bp_member_name', 10, 1 ); 

function alphabetize_by_last_name( $bp_user_query ) {
  if ( 'alphabetical' == $bp_user_query->query_vars['type'] )
      $bp_user_query->uid_clauses['orderby'] = "ORDER BY substring_index(u.display_name, ' ', -1)";
}
add_action ( 'bp_pre_user_query', 'alphabetize_by_last_name' );

function boone_remove_blogs_nav() {
  bp_core_remove_nav_item( 'forums' );
  bp_core_remove_nav_item( 'groups' );
  bp_core_remove_nav_item( 'notifications' );
  
  }
  add_action( 'bp_setup_nav', 'boone_remove_blogs_nav', 15 );

  function setup_custom_nav() {
    global $bp;
    if (bp_is_my_profile()) :
    bp_core_new_subnav_item( array(
      'name' => __( 'Account Settings', 'buddypress' ),
      'slug' => 'account-admin-visibility-mode',
      'parent_url' => $bp->loggedin_user->domain . 'settings/',
      'parent_slug' => 'profile',
      'screen_function' => 'ca_screen_function',
      'position' => 30,
    ) );
  endif;
  }
  
  add_action( 'bp_setup_nav', 'setup_custom_nav');
  
  
/*this will add column in user list table*/

function add_column( $column ) {
  $column['text_checkbox'] = 'Aggrement Activation';
  return $column;
}
add_filter( 'manage_users_columns', 'add_column' );

/*this will add column value in user list table*/
function add_column_value( $val, $column_name, $user_id ) {
  switch($column_name) {

      case 'text_checkbox' :
          return get_user_meta($user_id, 'username', $single); ;
          break;

         default:
         
  }
}
add_filter( 'manage_users_custom_column', 'add_column_value', 10, 3 );






//   function my_acf_user_form_func( $atts ) {
 
//     $a = shortcode_atts( array(
//       'field_group' => ''
//     ), $atts );
   
//     $uid = get_current_user_id();
  
//     if ( ! empty ( $a['field_group'] ) && ! empty ( $uid ) ) {
//         $options = array(
//           'post_id' => 'user_'.$uid,
//           'field_groups' => array( intval( $a['field_group'] ) ),
//           'return' => add_query_arg( 'updated', 'true', get_permalink( $current_user->ID) )
//         );
      
        
//         ob_start();
        
//         acf_form( $options );
//         $form = ob_get_contents();
        
//         ob_end_clean();
//       }
    
  
  
    
    
//       return $form;
//   }
   
//   add_shortcode( 'my_acf_user_form', 'my_acf_user_form_func' );
  



// //adding AFC form head
// function add_acf_form_head(){
//     global $post;
    
//   if ( !empty($post) && has_shortcode( $post->post_content, 'my_acf_user_form' ) ) {
//         acf_form_head();
//     }
// }
// add_action( 'wp_head', 'add_acf_form_head', 7 );


function custom_button_example($wp_admin_bar){
$args = array(
'id' => 'custom-button',
'title' => 'Reset User Agreement',
'href' => 'https://www.weildco.tech/user-agreement-reactivate/',
'meta' => array(
'class' => 'custom-button-class'
)
);
$wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'custom_button_example', 50);


// function my_acf_submit_form( $form, $post_id ) {
    
//     // get new value
//     $value = get_field('676', $post_id);
    
    
//     // redirect
//     wp_redirect( 'https://www.weildco.tech' . $value );
// 	exit;
	
// }

// add_action('acf/submit_form', 'my_acf_submit_form', 10, 2);

add_filter( 'bp_get_the_profile_field_value', 'teste', 10 );

function teste($value) {
    // $value = $value . "...";
    return $value;
}
// remove_filter( 'bp_get_the_profile_field_value', 'xprofile_filter_link_profile_data', 9, 2 );



//include custon function file
require get_stylesheet_directory() . '/custom-functions.php';
