<?php
/*
Widget Name: Besocial Activity
Description: Displays BuddyPress Activity
Author: Egemenerd
Author URI: http://www.egemenerd.com
*/

class besclwp_activity_widget extends SiteOrigin_Widget {
	function __construct() {
        $form_options = array(
            'title' => array(
				'type' => 'text',
				'label' => esc_html__('Title', 'besclwpcpt'),
				'default' => ''
            ),
            'max' => array(
				'type' => 'number',
				'label' => esc_html__('Maximum number of the activity', 'besclwpcpt'),
				'default' => '5'
            ),
            'postform' => array(
				'type' => 'checkbox',
				'label' => esc_html__( 'Show post form to loggedin users', 'besclwpcpt' ),
				'default' => true
            ),
            'categories' => array(
				'type' => 'checkbox',
				'label' => esc_html__( 'Show categories', 'besclwpcpt' ),
				'default' => true
			 ),
            'filters' => array(
				'type' => 'checkbox',
				'label' => esc_html__( 'Show filters', 'besclwpcpt' ),
				'default' => true
			 ),
            'rss' => array(
				'type' => 'checkbox',
				'label' => esc_html__( 'Show RSS feed icon', 'besclwpcpt' ),
				'default' => true
			 ),
		);

		parent::__construct(
			'besclwp-activity',
			esc_html__('Besocial Activity', 'besclwpcpt'),
			array(
				'description' => esc_html__('Displays BuddyPress activity', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-update'),
            array(),
			$form_options,
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
        return 'besclwp-activity-template';
	}

	function get_style_name($instance) {
        return false;
	}
}
siteorigin_widget_register('besclwp-activity', __FILE__, 'besclwp_activity_widget');
add_filter('bpfb_injection_additional_condition', '__return_true');