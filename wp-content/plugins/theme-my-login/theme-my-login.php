<?php
/*
Plugin Name: Theme My Login
Plugin URI: https://themeforest.net/user/egemenerd/portfolio
Description: Custom version of TML plugin
Version: 1.0
Author: Egemenerd
Author URI: http://www.egemenerd.com
Text Domain: theme-my-login
Domain Path: /languages
*/

function besocial_remove_update_notifications($value) {

    if ( isset( $value ) && is_object( $value ) ) {
        unset( $value->response[ plugin_basename(__FILE__) ] );
    }

    return $value;
}
add_filter( 'site_transient_update_plugins', 'besocial_remove_update_notifications' );

// Allow custom functions file
if ( file_exists( WP_PLUGIN_DIR . '/theme-my-login-custom.php' ) )
	include_once( WP_PLUGIN_DIR . '/theme-my-login-custom.php' );

if ( ! defined( 'THEME_MY_LOGIN_PATH' ) ) {
	define( 'THEME_MY_LOGIN_PATH', dirname( __FILE__ ) );
}

// Require a few needed files
require_once( THEME_MY_LOGIN_PATH . '/includes/class-theme-my-login-common.php' );
require_once( THEME_MY_LOGIN_PATH . '/includes/class-theme-my-login-abstract.php' );
require_once( THEME_MY_LOGIN_PATH . '/includes/class-theme-my-login.php' );
require_once( THEME_MY_LOGIN_PATH . '/includes/class-theme-my-login-template.php' );
require_once( THEME_MY_LOGIN_PATH . '/includes/class-theme-my-login-widget.php' );

// Instantiate Theme_My_Login singleton
Theme_My_Login::get_object();

if ( is_admin() ) {
	require_once( THEME_MY_LOGIN_PATH . '/admin/class-theme-my-login-admin.php' );

	// Instantiate Theme_My_Login_Admin singleton
	Theme_My_Login_Admin::get_object();
}

if ( is_multisite() ) {
	require_once( THEME_MY_LOGIN_PATH . '/includes/class-theme-my-login-ms-signup.php' );

	// Instantiate Theme_My_Login_MS_Signup singleton
	Theme_My_Login_MS_Signup::get_object();
}

if ( ! function_exists( 'theme_my_login' ) ) :
/**
 * Displays a TML instance
 *
 * @see Theme_My_Login::shortcode() for $args parameters
 * @since 6.0
 *
 * @param string|array $args Template tag arguments
 */
function theme_my_login( $args = '' ) {
	echo Theme_My_Login::get_object()->shortcode( wp_parse_args( $args ) );
}
endif;

?>
