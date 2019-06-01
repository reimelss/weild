<?php
/*
Widget Name: Besocial Statistics
Description: Displays site statistics
Author: Egemenerd
Author URI: http://www.egemenerd.com
*/

class besclwp_statistics_widget extends SiteOrigin_Widget {
	function __construct() {
        $form_options = array(
            'heading' => array(
                'type' => 'text',
                'label' => esc_html__('Widget Title', 'besclwpcpt'),
                'default' => ''
            ),
            'a_repeater' => array(
                'type' => 'repeater',
                'label' => esc_html__( 'Statistics' , 'besclwpcpt' ),
                'item_name'  => esc_html__( 'Item', 'siteorigin-widgets' ),
                'fields' => array(
                    'title' => array(
                        'type' => 'text',
                        'label' => esc_html__( 'Title', 'besclwpcpt' )
                    ),
                    'icon' => array(
                        'type' => 'icon',
                        'label' => esc_html__('Select an icon', 'besclwpcpt'),
                    ),
                    'statistic' => array(
				        'type' => 'select',
				        'label' => esc_html__( 'Statistic', 'besclwpcpt' ),
				        'default' => 'posts',
				        'options' => array(
                            'posts' => esc_html__( 'Posts', 'besclwpcpt' ),
                            'comments' => esc_html__( 'Comments', 'besclwpcpt' ),
                            'activity' => esc_html__( 'Activity (BuddyPress)', 'besclwpcpt' ),
                            'members' => esc_html__( 'Members (BuddyPress)', 'besclwpcpt' ),
                            'groups' => esc_html__( 'Groups (BuddyPress)', 'besclwpcpt' ),
                            'forums' => esc_html__( 'Forums (BbPress)', 'besclwpcpt' ),
                            'topics' => esc_html__( 'Topics (BbPress)', 'besclwpcpt' ),
                            'replies' => esc_html__( 'Replies (BbPress)', 'besclwpcpt' ),
                            'topic_tags' => esc_html__( 'Topic Tags (BbPress)', 'besclwpcpt' ),
                            'likes' => esc_html__( 'Likes', 'besclwpcpt' ),
                            'dislikes' => esc_html__( 'Dislikes', 'besclwpcpt' ),
                            'woo' => esc_html__( 'Products (Woocommerce)', 'besclwpcpt' )
                        )
                    ),
                )
            )
        );

		parent::__construct(
			'besclwp-statistics',
			esc_html__('Besocial Statistics', 'besclwpcpt'),
			array(
				'description' => esc_html__('Displays site statistics', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-chart-area woo-color'),
            array(),
			$form_options,
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
        return 'besclwp-statistics-template';
	}

	function get_style_name($instance) {
        return false;
	}

}
siteorigin_widget_register('besclwp-statistics', __FILE__, 'besclwp_statistics_widget');