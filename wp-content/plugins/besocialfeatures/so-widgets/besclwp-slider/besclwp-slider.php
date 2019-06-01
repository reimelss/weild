<?php
/*
Widget Name: Besocial Post Slider
Description: Displays a post slider
Author: Egemenerd
Author URI: http://www.egemenerd.com
*/

class besclwp_post_slider_widget extends SiteOrigin_Widget {
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
                        'label' => esc_html__( 'Post Settings' , 'besclwpcpt' ),
                        'hide' => false,
                        'fields' => array(
                            'posts' => array(
				                'type' => 'posts',
                                'label' => esc_html__('Select Posts', 'besclwpcpt')
			                 ),
                            'date' => array(
				                'type' => 'checkbox',
				                'label' => esc_html__( 'Display Date (Woocommerce Product Price)', 'besclwpcpt' ),
				                'default' => true
			                 ),
                            'category' => array(
				                'type' => 'checkbox',
				                'label' => esc_html__( 'Display Categories (Woocommerce Product Categories)', 'besclwpcpt' ),
				                'default' => true
			                 )
                        )
                    ),
                    'c_section' => array(
                        'type' => 'section',
                        'label' => esc_html__( 'Slider Settings' , 'besclwpcpt' ),
                        'hide' => true,
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
                            'thumbnails' => array(
				                'type' => 'checkbox',
				                'label' => esc_html__( 'Display Thumbnail Navigation', 'besclwpcpt' ),
				                'default' => true
			                 ),
                            'arrows' => array(
				                'type' => 'checkbox',
				                'label' => esc_html__( 'Display Navigation Arrows', 'besclwpcpt' ),
				                'default' => true
			                 )
                        )
                    ),
                    'd_section' => array(
                        'type' => 'section',
                        'label' => esc_html__( 'Text Settings' , 'besclwpcpt' ),
                        'hide' => true,
                        'fields' => array(
                            'excerpt' => array(
				                'type' => 'slider',
				                'label' => esc_html__('Excerpt Length (To remove excerpt, select "0")', 'besclwpcpt'),
				                'default' => '30',
                                'min' => 0,
                                'max' => 55,
                                'integer' => true
                            ),
                            'excerptlevel' => array(
				                'type' => 'select',
				                'label' => esc_html__( 'Heading Level', 'besclwpcpt' ),
				                'default' => 'h3',
				                'options' => array(
                                    'h1' => esc_html__( 'Heading 1', 'besclwpcpt' ),
                                    'h2' => esc_html__( 'Heading 2', 'besclwpcpt' ),
                                    'h3' => esc_html__( 'Heading 3', 'besclwpcpt' ),
                                    'h4' => esc_html__( 'Heading 4', 'besclwpcpt' ),
                                    'h5' => esc_html__( 'Heading 5', 'besclwpcpt' ),
                                    'h6' => esc_html__( 'Heading 6', 'besclwpcpt' )
                                )
                            ),
                            'titlecolor' => array(
				                'type' => 'color',
				                'label' => esc_html__('Heading Color', 'besclwpcpt'),
				                'default' => '#ffffff',
                            ),
                            'textcolor' => array(
				                'type' => 'color',
				                'label' => esc_html__('Text Color', 'besclwpcpt'),
				                'default' => '#ffffff',
                            ),
                            'bgcolor' => array(
				                'type' => 'rgba-colorpicker',
				                'label' => esc_html__('Background Color', 'besclwpcpt'),
				                'default' => 'rgba(66,122,161,0.9)',
                            ),
                            'mobilebgcolor' => array(
				                'type' => 'color',
				                'label' => esc_html__('Background Color (Mobile Mode)', 'besclwpcpt'),
				                'default' => '#3e6990',
                            ),
                        )
                    )
        );

		parent::__construct(
			'besclwp-slider',
			esc_html__('Besocial Post Slider', 'besclwpcpt'),
			array(
				'description' => esc_html__('Displays a post slider', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-admin-post woo-color'),
            array(),
			$form_options,
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
        return 'besclwp-slider-template';
	}

	function get_style_name($instance) {
        return false;
	}

}
siteorigin_widget_register('besclwp-slider', __FILE__, 'besclwp_post_slider_widget');