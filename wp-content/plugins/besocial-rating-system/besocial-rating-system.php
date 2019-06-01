<?php
/**
* Plugin Name: Besocial Rating System
* Plugin URI: http://www.egemenerd.com/
* Description: Like & dislike rating system.
* Version: 1.1
* Author: Egemenerd
* Author URI: http://www.egemenerd.com/
* License: https://themeforest.net/licenses?ref=egemenerd
* Text Domain: besocialrating
* Domain Path: /languages
*/
if ( ! defined( 'ABSPATH' ) ) exit;

function besocial_systen_main_function(){
    load_plugin_textdomain( 'besocialrating', FALSE, basename(plugin_dir_path( __FILE__ )). '/languages' );
    $besocial_like_dislike = get_option("besocial_like_dislike");
    
    /* IF CMB2 PLUGIN IS LOADED */
    if ( defined( 'CMB2_LOADED' ) ) {
        include('rating_system_admin.php');
    }
    
    include('posts-pages.php');
    include('metabox.php');
    include('comments.php');		
}

add_action('plugins_loaded','besocial_systen_main_function');
?>