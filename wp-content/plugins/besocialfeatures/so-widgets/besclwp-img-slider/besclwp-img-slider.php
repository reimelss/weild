<?php
/*
Widget Name: Besocial Image Slider
Description: Displays an image slider
Author: Egemenerd
Author URI: http://www.egemenerd.com
*/

class besclwp_img_slider_widget extends SiteOrigin_Widget {
	function __construct() {
        $form_options = array(
            'a_repeater' => array(
                'type' => 'repeater',
                'label' => esc_html__( 'Slider Images' , 'besclwpcpt' ),
                'item_name'  => esc_html__( 'Slide', 'siteorigin-widgets' ),
                'fields' => array(
                    'title' => array(
                        'type' => 'text',
                        'label' => esc_html__( 'Title', 'besclwpcpt' )
                    ),
                    'titlecolor' => array(
				        'type' => 'color',
				        'label' => esc_html__('Title Color', 'besclwpcpt'),
				        'default' => '#ffffff',
                    ),
                    'titlebgcolor' => array(
				        'type' => 'color',
				        'label' => esc_html__('Title background Color', 'besclwpcpt'),
				        'default' => '#427aa1',
                    ),
                    'subtitle' => array(
                        'type' => 'text',
                        'label' => esc_html__( 'Subtitle', 'besclwpcpt' )
                    ),
                    'subtitlecolor' => array(
				        'type' => 'color',
				        'label' => esc_html__('Subtitle Color', 'besclwpcpt'),
				        'default' => '#ffffff',
                    ),
                    'subtitlebgcolor' => array(
				        'type' => 'color',
				        'label' => esc_html__('Subtitle background Color', 'besclwpcpt'),
				        'default' => '#2c3d55',
                    ),
                    'position' => array(
				        'type' => 'select',
                        'label' => esc_html__( 'Text Position', 'besclwpcpt' ),
				        'default' => 'besclwp-top-right',
				        'options' => array(
                            'besclwp-top-right' => esc_html__( 'Top Right', 'besclwpcpt' ),
                            'besclwp-top-left' => esc_html__( 'Top Left', 'besclwpcpt' ),
                            'besclwp-bottom-right' => esc_html__( 'Bottom Right', 'besclwpcpt' ),
                            'besclwp-bottom-left' => esc_html__( 'Bottom Left', 'besclwpcpt' )
				        )
			         ),
                    'image' => array(
                        'type' => 'media',
                        'label' => esc_html__( 'Image', 'besclwpcpt' ),
                        'choose' => esc_html__( 'Choose image', 'besclwpcpt' ),
                        'update' => esc_html__( 'Set image', 'besclwpcpt' ),
                        'library' => 'image',
                        'fallback' => false
                    ),
                    'url' => array(
                        'type' => 'link',
                        'label' => esc_html__( 'Destionation url', 'besclwpcpt' ),
                        'default' => ''
                    ),
                    'target' => array(
				        'type' => 'checkbox',
				        'label' => esc_html__( 'Open link in a new tab', 'besclwpcpt' ),
				            'default' => false
                    ),
                )
            ),
            'b_section' => array(
                'type' => 'section',
                'label' => esc_html__( 'Slider Settings' , 'besclwpcpt' ),
                'hide' => false,
                'fields' => array(
                    'size' => array(
				        'type' => 'select',
                        'label' => esc_html__( 'Image Size', 'besclwpcpt' ),
				        'default' => 'besclwp-16-9-medium',
				        'options' => array(
                            'besclwp-16-9-medium' => esc_html__( '1024x576px (16:9)', 'besclwpcpt' ),
                            'besclwp-21-9-large' => esc_html__( '1400x600 px (21:9)', 'besclwpcpt' ),
                            'besclwp-rectangle-thumbnail' => esc_html__( '480x360 px (4:3)', 'besclwpcpt' ),
                            'full' => esc_html__( 'Full', 'besclwpcpt' ),
                            'large' => esc_html__( 'Large', 'besclwpcpt' ),
                            'medium' => esc_html__( 'Medium', 'besclwpcpt' )
				        )
                    ),
                    'autoplay' => array(
				        'type' => 'checkbox',
				        'label' => esc_html__( 'Autoplay on', 'besclwpcpt' ),
				            'default' => false
                    ),
                    'duration' => array(
                        'type' => 'number',
                        'label' => esc_html__('Autoplay Duration (Seconds)', 'besclwpcpt'),
                        'default' => '5'
                    ),
                    'fade' => array(
				        'type' => 'checkbox',
				        'label' => esc_html__( 'Fade Animation', 'besclwpcpt' ),
				        'default' => false
                    ),
                    'arrows' => array(
				        'type' => 'checkbox',
				        'label' => esc_html__( 'Display Navigation Arrows', 'besclwpcpt' ),
				        'default' => true
                    )
                )
            )
        );

		parent::__construct(
			'besclwp-img-slider',
			esc_html__('Besocial Image Slider', 'besclwpcpt'),
			array(
				'description' => esc_html__('Displays an slider', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-format-gallery'),
            array(),
			$form_options,
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
        return 'besclwp-img-slider-template';
	}

	function get_style_name($instance) {
        return false;
	}

}
siteorigin_widget_register('besclwp-img-slider', __FILE__, 'besclwp_img_slider_widget');