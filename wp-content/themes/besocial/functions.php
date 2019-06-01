<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

require_once ( get_template_directory() . '/includes/functions.php' );
require_once ( get_template_directory() . '/includes/theme-settings.php' );

/* IF CMB2 PLUGIN IS LOADED */
if ( defined( 'CMB2_LOADED' ) ) {
    require_once ( get_template_directory() . '/includes/cmb2-slider-field.php' );
    require_once ( get_template_directory() . '/includes/cmb2-field-sorter.php' );
    require_once ( get_template_directory() . '/includes/custom-fields.php' );
    require_once ( get_template_directory() . '/includes/icon-menu-settings.php' );
    require_once ( get_template_directory() . '/includes/icon-menu-actions.php' );
    require_once ( get_template_directory() . '/includes/social-icons.php' );
}

/* BUDDYPRESS */
if (function_exists('bp_is_active')) {
    require_once ( get_template_directory() . '/includes/bp-functions.php' );
}

/* IF bbPress PLUGIN IS LOADED */
if (class_exists( 'bbPress' )) {
    require_once ( get_template_directory() . '/includes/bbp-functions.php' );
}

/* WOOCOMMERCE */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    require ( get_template_directory() . '/includes/woo-functions.php' );
}
?>