<?php
/*
Widget Name: Besocial Member List
Description: Displays a Member List
Author: Egemenerd
Author URI: http://www.egemenerd.com
*/

class besclwp_member_list_widget extends SiteOrigin_Widget {
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
                        'label' => esc_html__( 'Members' , 'besclwpcpt' ),
                        'hide' => false,
                        'fields' => array(
                            'featured' => array(
				                'type' => 'checkbox',
				                'label' => esc_html__( 'Display only featured members', 'besclwpcpt' ),
				                'default' => false
                            ),
                            'type' => array(
				                'type' => 'select',
				                'label' => esc_html__( 'Type', 'besclwpcpt' ),
				                'default' => 'active',
				                'options' => array(
                                    'active' => esc_html__( 'Active', 'besclwpcpt' ),
                                    'newest' => esc_html__( 'Newest', 'besclwpcpt' ),
                                    'popular' => esc_html__( 'Popular', 'besclwpcpt' ),
                                    'alphabetical' => esc_html__( 'Alphabetical', 'besclwpcpt' ),
                                    'random' => esc_html__( 'Random', 'besclwpcpt' )
				                )
                            ),
                            'max' => array(
                                'type' => 'number',
                                'label' => esc_html__('The total number of users to return.', 'besclwpcpt'),
                                'default' => '99'
                            ),
                            'per_page' => array(
                                'type' => 'number',
                                'label' => esc_html__('The number of users to display on a page before they are paginated to the next page.', 'besclwpcpt'),
                                'default' => '20'
                            ),
                            'include' => array(
                                'type' => 'text',
                                'label' => esc_html__('Pass a user id or string of comma separated user ids to return on these users.', 'besclwpcpt'),
                                'default' => ''
                            ),
                            'exclude' => array(
                                'type' => 'text',
                                'label' => esc_html__('Pass a user id or string of comma separated user ids to exclude those users in the return.', 'besclwpcpt'),
                                'default' => ''
                            ),
                            'avatars' => array(
				                'type' => 'checkbox',
				                'label' => esc_html__( 'Display avatars', 'besclwpcpt' ),
				                'default' => true
			                 ),
                            'buttons' => array(
				                'type' => 'checkbox',
				                'label' => esc_html__( 'Display action buttons', 'besclwpcpt' ),
				                'default' => true
			                 ),
                            'counter' => array(
				                'type' => 'checkbox',
				                'label' => esc_html__( 'Display pagination', 'besclwpcpt' ),
				                'default' => false
			                 ),
                        )
                    )
        );
        
		parent::__construct(
			'besclwp-member-list',
			esc_html__('Besocial Member List', 'besclwpcpt'),
			array(
				'description' => esc_html__('Displays a member list', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-admin-users'),
            array(),
			$form_options,
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
        return 'besclwp-member-list-template';
	}

	function get_style_name($instance) {
        return false;
	}

}
siteorigin_widget_register('besclwp-member-list', __FILE__, 'besclwp_member_list_widget');