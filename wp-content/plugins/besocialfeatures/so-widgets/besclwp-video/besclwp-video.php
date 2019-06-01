<?php
/*
Widget Name: Besocial Video
Description: Displays a Youtube, Vimeo, Dailymotion, Vine, VideoPress or WordPress.tv video.
Author: Egemenerd
Author URI: http://www.egemenerd.com
*/

class besclwp_video_widget extends SiteOrigin_Widget {
    function __construct() {
        $form_options = array(
            'a_section' => array(
                'type' => 'section',
                'label' => esc_html__( 'Title & Subtitle' , 'besclwpcpt' ),
                'hide' => true,
                    'fields' => array(
                        'heading' => array(
                            'type' => 'text',
                            'label' => esc_html__('Heading', 'besclwpcpt'),
                            'default' => ''
                        ),
                        'headinglevel' => array(
				            'type' => 'select',
				            'label' => esc_html__( 'Heading Level', 'besclwpcpt' ),
				            'default' => 'h1',
				            'options' => array(
                                'h1' => esc_html__( 'Heading 1', 'besclwpcpt' ),
                                'h2' => esc_html__( 'Heading 2', 'besclwpcpt' ),
                                'h3' => esc_html__( 'Heading 3', 'besclwpcpt' ),
                                'h4' => esc_html__( 'Heading 4', 'besclwpcpt' ),
                                'h5' => esc_html__( 'Heading 5', 'besclwpcpt' ),
                                'h6' => esc_html__( 'Heading 6', 'besclwpcpt' )
				                )
			             ),
                        'subtitle' => array(
                            'type' => 'text',
                            'label' => esc_html__('Subtitle', 'besclwpcpt'),
                            'default' => ''
                            )       
                        )
                    ),
                    'b_section' => array(
                        'type' => 'section',
                        'label' => esc_html__( 'Video' , 'besclwpcpt' ),
                        'hide' => false,
                        'fields' => array(
                            'video' => array(
				                'type' => 'wp-oembed',
				                'label' => esc_html__('Video Link', 'besclwpcpt'),
				                'default' => '',
                            )
                        )
                    )
        );
        
		parent::__construct(
			'besclwp-video',
			esc_html__('Besocial Video', 'besclwpcpt'),
			array(
				'description' => esc_html__('Displays a Youtube, Vimeo, Dailymotion, Vine, VideoPress or WordPress.tv video.', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-format-video'),
            array(),
			$form_options,
			plugin_dir_path(__FILE__)
		);
    }

	function get_template_name($instance) {
        return 'besclwp-video-template';
	}

	function get_style_name($instance) {
        return false;
	}

}
siteorigin_widget_register('besclwp-video', __FILE__, 'besclwp_video_widget');