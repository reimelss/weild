<?php

/**
 *
 * @link              http://wbcomdesigns.com
 * @since             1.0.0
 * @package           Bp_Shortcodes
 *
 * @wordpress-plugin
 * Plugin Name:       Shortcodes For BuddyPress
 * Description:       This plugin will add an extended feature to the big name “BuddyPress” that will generate Shortcode for Listing Activity Streams, Members and Groups on any post/page in website.
 * Version:           1.0.1
 * Author:            Wbcom Designs
 * Author URI:        http://wbcomdesigns.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bp-shortcodes
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

function bpsh_plugin_init() {
    // If BuddyPress is NOT active
    if (current_user_can('activate_plugins') && !class_exists('BuddyPress')) {
        add_action('admin_init', 'bpsh_plugin_deactivate');
        add_action('admin_notices', 'bpsh_plugin_admin_notice');

        // Deactivate the bp-shortcodes Plugin
        function bpsh_plugin_deactivate() {
            deactivate_plugins(plugin_basename(__FILE__));
        }

        // Throw an Alert to tell the Admin why it didn't activate
        function bpsh_plugin_admin_notice() {
            $bpsh_plugin = __('BuddyPress Shortcode', 'bp-shortcodes');
            $buddypress_plugin = __('BuddyPress', 'bp-shortcodes');
            echo '<div class="error"><p>'
            . sprintf(__('%1$s requires %2$s to function correctly. Please activate %2$s before activating %1$s. For now, the plugin has been deactivated.', 'bp-shortcodes'), '<strong>' . esc_html($bpsh_plugin) . '</strong>', '<strong>' . esc_html($buddypress_plugin) . '</strong>')
            . '</p></div>';
            if (isset($_GET['activate']))
                unset($_GET['activate']);
        }

    }else {
        if (!defined('BPSH_PLUGIN_BASENAME')) {
            define('BPSH_PLUGIN_BASENAME', plugin_basename(__FILE__));
        }

        /**
         * The core plugin class that is used to define internationalization,
         * admin-specific hooks, and public-facing site hooks.
         */
        require plugin_dir_path(__FILE__) . 'includes/class-bp-shortcodes.php';
        run_bp_shortcodes();
    }
}

add_action('plugins_loaded', 'bpsh_plugin_init');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bp_shortcodes() {
    $plugin = new Bp_Shortcodes();
    $plugin->run();
}
