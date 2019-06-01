<?php
/*
Widget Name: Besocial Divider
Description: Displays a horizontal line
Author: Egemenerd
Author URI: http://www.egemenerd.com
*/

class besclwp_divider_widget extends SiteOrigin_Widget {
	function __construct() {
        $form_options = array(
            'margintop' => array(
				'type' => 'number',
				'label' => esc_html__('Margin Top', 'besclwpcpt'),
				'default' => '40'
            ),
            'marginbottom' => array(
				'type' => 'number',
				'label' => esc_html__('Margin Bottom', 'besclwpcpt'),
				'default' => '40'
            ),
            'bgcolor' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'besclwpcpt' ),
				'default' => '#ffffff'
			),
            'thickness' => array(
				'type' => 'slider',
				'label' => esc_html__( 'Thickness', 'besclwpcpt' ),
				'default' => 1,
				'min' => 0,
				'max' => 10
			),
		);

		parent::__construct(
			'besclwp-divider',
			esc_html__('Besocial Divider', 'besclwpcpt'),
			array(
				'description' => esc_html__('Displays a horizontal line', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-minus'),
            array(),
			$form_options,
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
        return 'besclwp-divider-template';
	}

	function get_style_name($instance) {
        return false;
	}

}
siteorigin_widget_register('besclwp-divider', __FILE__, 'besclwp_divider_widget');