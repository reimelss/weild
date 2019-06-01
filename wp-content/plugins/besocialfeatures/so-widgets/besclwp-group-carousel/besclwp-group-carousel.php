<?php
/*
Widget Name: Besocial Group Carousel
Description: Displays a group carousel
Author: Egemenerd
Author URI: http://www.egemenerd.com
*/

class besclwp_group_carousel_widget extends SiteOrigin_Widget {
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
                        'label' => esc_html__( 'Groups' , 'besclwpcpt' ),
                        'hide' => false,
                        'fields' => array(
                            'type' => array(
				                'type' => 'select',
				                'label' => esc_html__( 'Type', 'besclwpcpt' ),
				                'default' => 'active',
				                'options' => array(
                                    'active' => esc_html__( 'Active', 'besclwpcpt' ),
                                    'newest' => esc_html__( 'Newest', 'besclwpcpt' ),
                                    'popular' => esc_html__( 'Popular', 'besclwpcpt' ),
                                    'alphabetical' => esc_html__( 'Alphabetical', 'besclwpcpt' ),
                                    'random' => esc_html__( 'Random', 'besclwpcpt' ),
                                    'most-forum-topics' => esc_html__( 'Most Forum Topics', 'besclwpcpt' ),
                                    'most-forum-posts' => esc_html__( 'Most Forum Posts', 'besclwpcpt' )
				                )
                            ),
                            'max' => array(
                                'type' => 'number',
                                'label' => esc_html__('The total number of groups to return.', 'besclwpcpt'),
                                'default' => '99'
                            )
                        )
                    ),
                    'c_section' => array(
                        'type' => 'section',
                        'label' => esc_html__( 'Carousel Settings' , 'besclwpcpt' ),
                        'hide' => false,
                        'fields' => array(
                            'columns' => array(
				                'type' => 'select',
				                'label' => esc_html__( 'Columns', 'besclwpcpt' ),
				                'default' => 'fourcolumns',
				                'options' => array(
                                    'onecolumn' => esc_html__( '1 Column', 'besclwpcpt' ),
                                    'twocolumns' => esc_html__( '2 Columns', 'besclwpcpt' ),
                                    'threecolumns' => esc_html__( '3 Columns', 'besclwpcpt' ),
                                    'fourcolumns' => esc_html__( '4 Columns', 'besclwpcpt' ),
                                    'fivecolumns' => esc_html__( '5 Columns', 'besclwpcpt' ),
                                    'sixcolumns' => esc_html__( '6 Columns', 'besclwpcpt' ),
                                    'sevencolumns' => esc_html__( '7 Columns', 'besclwpcpt' ),
                                    'eightcolumns' => esc_html__( '8 Columns', 'besclwpcpt' )
				                )
                            ),
                            'rows' => array(
				                'type' => 'select',
				                'label' => esc_html__( 'Rows', 'besclwpcpt' ),
				                'default' => '1',
				                'options' => array(
                                    '1' => esc_html__( '1 Row', 'besclwpcpt' ),
                                    '2' => esc_html__( '2 Rows', 'besclwpcpt' ),
                                    '3' => esc_html__( '3 Rows', 'besclwpcpt' ),
                                    '4' => esc_html__( '4 Rows', 'besclwpcpt' )
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
                            'dots' => array(
				                'type' => 'checkbox',
				                'label' => esc_html__( 'Display Navigation Dots', 'besclwpcpt' ),
				                'default' => true
			                 ),
                            'arrows' => array(
				                'type' => 'checkbox',
				                'label' => esc_html__( 'Display Navigation Arrows', 'besclwpcpt' ),
				                'default' => false
			                 ),
                            'single' => array(
				                'type' => 'checkbox',
				                'label' => esc_html__( 'Enable Single Row Navigation', 'besclwpcpt' ),
				                'default' => false
			                 )
                        )
                    ),
                    'd_section' => array(
                        'type' => 'section',
                        'label' => esc_html__( 'Hero Mode' , 'besclwpcpt' ),
                        'hide' => true,
                        'fields' => array(
                            'hero' => array(
				                'type' => 'checkbox',
				                'label' => esc_html__( 'Activate hero mode (Use it in large columns)', 'besclwpcpt' ),
				                'default' => false
                            ),
                            'herotitle' => array(
                                'type' => 'text',
                                'label' => esc_html__('Title', 'besclwpcpt'),
                                'default' => ''
                            ),
                            'herosubtitle' => array(
                                'type' => 'text',
                                'label' => esc_html__('Subtitle', 'besclwpcpt'),
                                'default' => ''
                            ),
                            'herobuttontext' => array(
                                'type' => 'text',
                                'label' => esc_html__('Button Text', 'besclwpcpt'),
                                'default' => esc_html__('Click Here', 'besclwpcpt')
                            ),
                            'herodestination' => array(
                                'type' => 'link',
                                'label' => esc_html__('Destination Url (To disable button, leave it blank)', 'besclwpcpt'),
                                'default' => ''
                            ),
                            'herobgcolor' => array(
				                'type' => 'rgba-colorpicker',
				                'label' => esc_html__('Background Color', 'besclwpcpt'),
				                'default' => 'rgba(255, 255, 255, 0.9)',
                            ),
                            'herotitlecolor' => array(
				                'type' => 'color',
				                'label' => esc_html__('Title Color', 'besclwpcpt'),
				                'default' => '#2c3d55',
                            ),
                            'herosubtitlecolor' => array(
				                'type' => 'color',
				                'label' => esc_html__('Subtitle Color', 'besclwpcpt'),
				                'default' => '#6b717e',
                            ),
                            'herobuttonstyle' => array(
				                'type' => 'select',
				                'label' => esc_html__( 'Button Style', 'besclwpcpt' ),
				                'default' => 'besclwp-dark',
				                'options' => array(
                                    'besclwp-dark' => esc_html__( 'Dark', 'besclwpcpt' ),
                                    'besclwp-light' => esc_html__( 'Light', 'besclwpcpt' )
				                )
                            ),
                        )
                    )
        );
        
		parent::__construct(
			'besclwp-group-carousel',
			esc_html__('Besocial Group Carousel', 'besclwpcpt'),
			array(
				'description' => esc_html__('Displays a group carousel', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-groups'),
            array(),
			$form_options,
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
        return 'besclwp-group-carousel-template';
	}

	function get_style_name($instance) {
        return false;
	}

}
siteorigin_widget_register('besclwp-group-carousel', __FILE__, 'besclwp_group_carousel_widget');