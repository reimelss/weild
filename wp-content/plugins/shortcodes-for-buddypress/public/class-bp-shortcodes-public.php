<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://wbcomdesigns.com
 * @since      1.0.0
 *
 * @package    Bp_Shortcodes
 * @subpackage Bp_Shortcodes/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bp_Shortcodes
 * @subpackage Bp_Shortcodes/public
 * @author     Wbcom Designs <admin@wbcomdesigns.com>
 */
class Bp_Shortcodes_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Bp_Shortcodes_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Bp_Shortcodes_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/bp-shortcodes-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Bp_Shortcodes_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Bp_Shortcodes_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/bp-shortcodes-public.js', array('jquery'), $this->version, false);
        wp_localize_script($this->plugin_name, 'bpsh_ajax_obj', array('ajaxurl' => admin_url('admin-ajax.php')));
    }

    /**
     * Load the template loop for the current object.
     *
     * @return string Prints template loop for the specified object
     * @since 1.0.0
     */
    public function bpsh_legacy_theme_object_template_loader() {

        // Bail if not a POST action.
        if ('POST' !== strtoupper($_SERVER['REQUEST_METHOD']))
            return;

        // Bail if no object passed.
        if (empty($_POST['object']))
            return;

        // Sanitize the object.
        $object = sanitize_title($_POST['object']);

        if ($object === 'members') {
            setcookie('bp-activity-filter', '', time() - 300);
            setcookie('bp-groups-filter', '', time() - 300);
            setcookie('bp-groups-scope', '', time() - 300);
        }
        if ($object === 'groups') {
            setcookie('bp-activity-filter', '', time() - 300);
            setcookie('bp-members-filter', '', time() - 300);
            setcookie('bp-members-scope', '', time() - 300);
        }
        // Bail if object is not an active component to prevent arbitrary file inclusion.
        if (!bp_is_active($object))
            return;

        /**
         * AJAX requests happen too early to be seen by bp_update_is_directory()
         * so we do it manually here to ensure templates load with the correct
         * context. Without this check, templates will load the 'single' version
         * of themselves rather than the directory version.
         */
        if (!bp_current_action())
            bp_update_is_directory(true, bp_current_component());

        add_filter('bp_ajax_querystring', function($qs) {
            return $qs .= get_option('bpsh_queryargs');
        });

        $template_part = $object . '/' . $object . '-loop';

        // The template part can be overridden by the calling JS function.
        if (!empty($_POST['template'])) {
            $template_part = sanitize_option('upload_path', $_POST['template']);
        }
//        // Locate the object template.
        bp_get_template_part($template_part);

        exit();
    }

    /**
     * Load the activity loop template when activity is requested via AJAX.
     *
     * @return string JSON object containing 'contents' (output of the template loop
     * for the Activity component) and 'feed_url' (URL to the relevant RSS feed).
     *
     * @since 1.2.0
     */
    public function bpsh_activity_widget_filter() {
        // Bail if not a POST action.
        if ('POST' !== strtoupper($_SERVER['REQUEST_METHOD']))
            return;

        $scope = '';
        if (!empty($_POST['scope']))
            $scope = $_POST['scope'];

        // We need to calculate and return the feed URL for each scope.
        switch ($scope) {
            case 'friends':
                $feed_url = bp_loggedin_user_domain() . bp_get_activity_slug() . '/friends/feed/';
                break;
            case 'groups':
                $feed_url = bp_loggedin_user_domain() . bp_get_activity_slug() . '/groups/feed/';
                break;
            case 'favorites':
                $feed_url = bp_loggedin_user_domain() . bp_get_activity_slug() . '/favorites/feed/';
                break;
            case 'mentions':
                $feed_url = bp_loggedin_user_domain() . bp_get_activity_slug() . '/mentions/feed/';
                bp_activity_clear_new_mentions(bp_loggedin_user_id());
                break;
            default:
                $feed_url = home_url(bp_get_activity_root_slug() . '/feed/');
                break;
        }

        setcookie('bp-groups-filter', '', time() - 300);
        setcookie('bp-groups-scope', '', time() - 300);
        setcookie('bp-members-filter', '', time() - 300);
        setcookie('bp-members-scope', '', time() - 300);

        add_filter('bp_ajax_querystring', function($qs) {
            return $qs .= get_option('bpsh_queryargs');
        });
        // Buffer the loop in the template to a var for JS to spit out.
        ob_start();
        bp_get_template_part('activity/activity-loop');
        $result['contents'] = ob_get_contents();

        /**
         * Filters the feed URL for when activity is requested via AJAX.
         *
         * @since 1.7.0
         *
         * @param string $feed_url URL for the feed to be used.
         * @param string $scope    Scope for the activity request.
         */
        $result['feed_url'] = apply_filters('bp_legacy_theme_activity_feed_url', $feed_url, $scope);
        ob_end_clean();

        exit(json_encode($result));
    }

}
