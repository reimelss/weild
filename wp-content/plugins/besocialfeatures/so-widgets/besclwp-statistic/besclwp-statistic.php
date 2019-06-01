<?php
/*
Widget Name: Besocial Single Statistic
Description: Displays a site statistic
Author: Egemenerd
Author URI: http://www.egemenerd.com
*/

class besclwp_statistic_widget extends SiteOrigin_Widget {
	function __construct() {
        $form_options = array(
            'a_section' => array(
                'type' => 'section',
                'label' => esc_html__( 'Text' , 'besclwpcpt' ),
                'hide' => false,
                    'fields' => array( 
                        'title' => array(
                            'type' => 'text',
                            'label' => esc_html__('Title', 'besclwpcpt'),
                            'default' => ''
                        ),
                        'fontsize' => array(
				            'type' => 'number',
				            'label' => esc_html__('Font Size (px)', 'besclwpcpt'),
				            'default' => '16'
                        ),
                        'fontcolor' => array(
				            'type' => 'color',
				            'label' => esc_html__( 'Font Color', 'besclwpcpt' ),
				            'default' => '#6b717e'
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
                        )
                    )
            ),
            'b_section' => array(
                'type' => 'section',
                'label' => esc_html__( 'Icon' , 'besclwpcpt' ),
                'hide' => true,
                'fields' => array(
                    'icon' => array(
                        'type' => 'icon',
                        'label' => esc_html__('Select an icon', 'besclwpcpt'),
                    ),
                    'iconcolor' => array(
				        'type' => 'color',
				        'label' => esc_html__( 'Icon Color', 'besclwpcpt' ),
				        'default' => '#ffffff'
                    ),
                    'iconbgcolor' => array(
				        'type' => 'color',
				        'label' => esc_html__( 'Icon Background Color', 'besclwpcpt' ),
				        'default' => '#427aa1'
                    ),
                    'iconfontsize' => array(
				        'type' => 'number',
				        'label' => esc_html__('Icon Font Size (px)', 'besclwpcpt'),
				        'default' => '22'
                    ),
                    'iconcontainersize' => array(
				        'type' => 'number',
				        'label' => esc_html__('Icon Container Size (px)', 'besclwpcpt'),
				        'default' => '44'
                    )
                )
            )
        );

		parent::__construct(
			'besclwp-statistic',
			esc_html__('Besocial Single Statistic', 'besclwpcpt'),
			array(
				'description' => esc_html__('Displays a site statistic', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-chart-area woo-color'),
            array(),
			$form_options,
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
        return 'besclwp-statistic-template';
	}

	function get_style_name($instance) {
        return false;
	}

}
siteorigin_widget_register('besclwp-statistic', __FILE__, 'besclwp_statistic_widget');