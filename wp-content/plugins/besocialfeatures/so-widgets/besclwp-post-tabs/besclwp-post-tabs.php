<?php
/*
Widget Name: Besocial Post Tabs
Description: Displays a post tabs
Author: Egemenerd
Author URI: http://www.egemenerd.com
*/

class besclwp_post_tabs_widget extends SiteOrigin_Widget {
	function __construct() {
        $form_options = array(
            'mode' => array(
				'type' => 'select',
				'label' => esc_html__( 'Tabs Style', 'besclwpcpt' ),
				'default' => 'default',
				'options' => array(
                    'default' => esc_html__( 'Horizontal', 'besclwpcpt' ),
                    'vertical' => esc_html__( 'Vertical', 'besclwpcpt' )
				    )
			     ),
            'a_repeater' => array(
                'type' => 'repeater',
                'label' => esc_html__( 'Tabs' , 'besclwpcpt' ),
                'item_name'  => esc_html__( 'Tab', 'siteorigin-widgets' ),
                'fields' => array(
                    'title' => array(
                        'type' => 'text',
                        'label' => esc_html__( 'Title', 'besclwpcpt' )
                    ),
                    'icon' => array(
                        'type' => 'icon',
                        'label' => esc_html__('Select an icon', 'besclwpcpt'),
                    ),
                    'posts' => array(
				        'type' => 'posts',
                        'label' => esc_html__('Select Posts', 'besclwpcpt')
                    )
                )
            )
        );

		parent::__construct(
			'besclwp-post-tabs',
			esc_html__('Besocial Post Tabs', 'besclwpcpt'),
			array(
				'description' => esc_html__('Displays a post tabs', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-admin-post woo-color'),
            array(),
			$form_options,
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
        return 'besclwp-post-tabs-template';
	}

	function get_style_name($instance) {
        return false;
	}

}
siteorigin_widget_register('besclwp-post-tabs', __FILE__, 'besclwp_post_tabs_widget');