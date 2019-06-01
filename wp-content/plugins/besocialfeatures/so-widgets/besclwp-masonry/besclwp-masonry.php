<?php
/*
Widget Name: Besocial Masonry Grid
Description: Displays a masonry grid
Author: Egemenerd
Author URI: http://www.egemenerd.com
*/

class besclwp_masonry_widget extends SiteOrigin_Widget {
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
                            'columns' => array(
				                'type' => 'select',
				                'label' => esc_html__( 'Columns', 'besclwpcpt' ),
				                'default' => 'besclwp-two-columns',
				                'options' => array(
                                    'besclwp-one-column' => esc_html__( '1 Column', 'besclwpcpt' ),
                                    'besclwp-two-columns' => esc_html__( '2 Columns', 'besclwpcpt' ),
                                    'besclwp-three-columns' => esc_html__( '3 Columns', 'besclwpcpt' ),
                                    'besclwp-four-columns' => esc_html__( '4 Columns', 'besclwpcpt' )
				                )
                            ),
                        )
                    ),
                    'c_section' => array(
                        'type' => 'section',
                        'label' => esc_html__( 'Button Settings' , 'besclwpcpt' ),
                        'hide' => true,
                        'fields' => array(
                            'buttontext' => array(
                                'type' => 'text',
                                'label' => esc_html__('Button Text', 'besclwpcpt'),
                                'default' => esc_html__( 'VIEW ALL', 'besclwpcpt' )
                            ),
                            'viewmore' => array(
                                'type' => 'link',
                                'label' => esc_html__('Destination Url (To disable button, leave it blank)', 'besclwpcpt'),
                                'default' => ''
                            )
                        )
                    )
        );

		parent::__construct(
			'besclwp-masonry',
			esc_html__('Besocial Masonry Grid', 'besclwpcpt'),
			array(
				'description' => esc_html__('Displays a masonry grid', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-admin-post woo-color'),
            array(),
			$form_options,
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
        return 'besclwp-masonry-template';
	}

	function get_style_name($instance) {
        return false;
	}

}
siteorigin_widget_register('besclwp-masonry', __FILE__, 'besclwp_masonry_widget');