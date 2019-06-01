<?php
/**
 * Plugin Name: Besocial Features
 * Plugin URI: http://themeforest.net/user/egemenerd/portfolio?ref=egemenerd
 * Description: Besocial widgets and shortcodes
 * Version: 3.7
 * Author: Egemenerd
 * Author URI: http://themeforest.net/user/egemenerd?ref=egemenerd
 * License: http://themeforest.net/licenses?ref=egemenerd
 */

/* Language File */

add_action( 'init', 'besclwp_cpt_domain' );

function besclwp_cpt_domain() {
    load_plugin_textdomain( 'besclwpcpt', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

/* Register Scripts and Styles */

function besclwp_cpt_scripts() {  
    $besclwp_preview_check = get_option('besclwp_user_preview');
    wp_enqueue_style('besclwp-cpt-styles', plugin_dir_url( __FILE__ ) . 'css/style.css', true, '1.0'); 
    if ( is_rtl() ) {
        wp_enqueue_style('besclwp-cpt-rtl-styles', plugin_dir_url( __FILE__ ) . 'css/rtl.css', true, '1.0'); 
    }
    if (empty($besclwp_preview_check) && ($besclwp_preview_check != 'true')) {
        if(!is_rtl()) {
            wp_enqueue_script('besclwp-img-tooltip', plugin_dir_url( __FILE__ ) . 'js/img-tooltip.js', array( 'jquery','jquery-ui-position' ), '1.0.0', true );
        } else {
            wp_enqueue_script('besclwp-img-tooltip-rtl', plugin_dir_url( __FILE__ ) . 'js/img-tooltip-rtl.js', array( 'jquery','jquery-ui-position' ), '1.0.0', true );
        }
    }
    wp_enqueue_script('besclwp-tabs', plugin_dir_url( __FILE__ ) . 'js/tabs.js', array( 'jquery' ), '1.0', true );
    
    if ( is_page_template('faq.php') || is_page_template('faq-fullwidth.php') ) {
        wp_enqueue_script('besclwp-faq', plugin_dir_url( __FILE__ ) . 'js/faq.js', array( 'jquery' ), '1.0', true );   
    }    
    wp_enqueue_script('besclwp-cpt-custom', plugin_dir_url( __FILE__ ) . 'js/custom.js', array( 'jquery' ), '1.0', true );
}
add_action('wp_enqueue_scripts','besclwp_cpt_scripts');

/* Register Admin Scripts */

function besclwp_cpt_admin_scripts() {
    $besocial_js_script_ajax_nonce = wp_create_nonce( "besocial_js_script_ajax_nonce" );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style('besclwp_cpt_admin_style', plugins_url('css/admin.css', __FILE__));
    wp_enqueue_script('besclwp_cpt_admin_script', plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), '1.0', true );
    wp_localize_script( 'besclwp_cpt_admin_script', 'besocial_vars', array( 'besocial_ajax_url'   => admin_url( 'admin-ajax.php' ),'besocial_plugin_dir'   => plugins_url('',__FILE__) ,'besocial_js_script_ajax_nonce'=>$besocial_js_script_ajax_nonce)); 
}

add_action('admin_enqueue_scripts', 'besclwp_cpt_admin_scripts');

/*---------------------------------------------------
Custom Image Sizes
----------------------------------------------------*/

add_image_size( 'besclwp-3-4-medium', 600, 800, true);
add_image_size( 'besclwp-16-9-medium', 1024, 576, true);
add_image_size( 'besclwp-21-9-large', 1400, 600, true);
add_filter('image_size_names_choose', 'besclwp_cpt_image_sizes');

function besclwp_cpt_image_sizes($besclwpsizes) {
    $besclwpaddsizes = array(
        "besclwp-3-4-medium" => esc_attr__( 'Besocial 3:4 Medium', 'besclwpcpt'),
        "besclwp-16-9-medium" => esc_attr__( 'Besocial 16:9 Medium', 'besclwpcpt'),
        "besclwp-21-9-large" => esc_attr__( 'Besocial 21:9 Large', 'besclwpcpt')
    );
    $besclwpnewsizes = array_merge($besclwpsizes, $besclwpaddsizes);
    return $besclwpnewsizes;
}

function besclwp_count_faq_in_cat($catid) {
    $besclwp_faq_args = array(
    'post_type' => 'besclwpfaq',
    'tax_query' => array(
		array(
			'taxonomy' => 'besclwpfaqcats',
			'field'    => 'term_id',
            'terms'    => $catid
        ),
    ),
    ); 
    $besclwp_faq_query = new WP_Query( $besclwp_faq_args );
    echo esc_html($besclwp_faq_query->post_count);
    wp_reset_postdata();
}

function besclwp_count_all_faq() {
    $count_posts = wp_count_posts( 'besclwpfaq' )->publish;
    echo esc_html($count_posts);
}

/*---------------------------------------------------
Tinymce custom button
----------------------------------------------------*/

if ( is_admin() ) {
if ( ! function_exists( 'besclwp_shortcodes_add_button' ) ) {
add_action('init', 'besclwp_shortcodes_add_button');  
function besclwp_shortcodes_add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'besclwp_add_plugin', 10);  
     add_filter('mce_buttons', 'besclwp_register_button', 10);  
   }  
} 
}

if ( ! function_exists( 'besclwp_register_button' ) ) {
function besclwp_register_button($buttons) {
    array_push($buttons, "besclwp_mce_button");
    return $buttons;  
}  
}

if ( ! function_exists( 'besclwp_add_plugin' ) ) {
function besclwp_add_plugin($plugin_array) {
    $plugin_array['besclwp_mce_button'] = plugin_dir_url( __FILE__ ) . 'js/shortcodes.js';
    return $plugin_array;  
}
}
}

/* ---------------------------------------------------------
Include required files
----------------------------------------------------------- */
/* Helpers */
include('helpers.php');

/* Custom post type */
include('besocial-faq.php');

function besclwp_faq_content() {
    include('besocial-faq-content.php');
}

function besclwp_faq_menu() {
    include('besocial-faq-menu.php');
}

function besclwp_faq_search() {
    include('besocial-faq-search.php');
}

/* Frontend post form */
include('besocial-post-form.php');

/* Featured Members */
include('featured-members.php');

/* So Widgets */
include('besocial-so-widgets.php');

/* Iframe Widget */
include('besocial-iframe.php');

/* Shortcodes */
include('besocial-shortcodes.php');
?>