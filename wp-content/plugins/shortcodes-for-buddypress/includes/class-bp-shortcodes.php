<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://wbcomdesigns.com
 * @since      1.0.0
 *
 * @package    Bp_Shortcodes
 * @subpackage Bp_Shortcodes/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Bp_Shortcodes
 * @subpackage Bp_Shortcodes/includes
 * @author     Wbcom Designs <admin@wbcomdesigns.com>
 */
class Bp_Shortcodes {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Bp_Shortcodes_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;
    /**
     * The basename of the plugin
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_basename    The basename of the plugin.
     */
    protected $plugin_basename;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {

        $this->plugin_name = 'bp-shortcodes';
        $this->version = '1.0.0';
        $this->plugin_basename = BPSH_PLUGIN_BASENAME;
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Bp_Shortcodes_Loader. Orchestrates the hooks of the plugin.
     * - Bp_Shortcodes_i18n. Defines internationalization functionality.
     * - Bp_Shortcodes_Admin. Defines all hooks for the admin area.
     * - Bp_Shortcodes_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-bp-shortcodes-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-bp-shortcodes-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-bp-shortcodes-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-bp-shortcodes-public.php';

        $this->loader = new Bp_Shortcodes_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Bp_Shortcodes_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new Bp_Shortcodes_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new Bp_Shortcodes_Admin($this->get_plugin_name(), $this->get_version());
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action("plugin_action_links_$this->plugin_basename", $plugin_admin, 'bpsh_add_settings_link');
        $this->loader->add_action('admin_menu', $plugin_admin, 'bpsh_add_option_page');
        $this->loader->add_shortcode('activity-listing', $plugin_admin, 'bpsh_generate_activity_listing');
        $this->loader->add_shortcode("members-listing", $plugin_admin, "bpsh_generate_members_listing");
        $this->loader->add_shortcode("groups-listing", $plugin_admin, "bpsh_generate_group_listing");
        $this->loader->add_filter('body_class', $plugin_admin, 'bpsh_body_classes');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {
        $plugin_public = new Bp_Shortcodes_Public($this->get_plugin_name(), $this->get_version());
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');      
        $this->loader->add_action('wp_ajax_bpsh_members_filter', $plugin_public, 'bpsh_legacy_theme_object_template_loader');
        $this->loader->add_action('wp_ajax_nopriv_bpsh_members_filter', $plugin_public, 'bpsh_legacy_theme_object_template_loader');
        $this->loader->add_action('wp_ajax_bpsh_groups_filter', $plugin_public, 'bpsh_legacy_theme_object_template_loader');
        $this->loader->add_action('wp_ajax_nopriv_bpsh_groups_filter', $plugin_public, 'bpsh_legacy_theme_object_template_loader');
        $this->loader->add_action('wp_ajax_bpsh_activity_widget_filter', $plugin_public, 'bpsh_activity_widget_filter');
        $this->loader->add_action('wp_ajax_nopriv_bpsh_activity_widget_filter', $plugin_public, 'bpsh_activity_widget_filter');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Bp_Shortcodes_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

}
