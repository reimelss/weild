<?php
/*
Widget Name: Besocial Testimonials
Description: Displays testimonials
Author: Egemenerd
Author URI: http://www.egemenerd.com
*/

class besclwp_testimonials_widget extends SiteOrigin_Widget {
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
            'a_repeater' => array(
                'type' => 'repeater',
                'label' => esc_html__( 'Testimonials' , 'besclwpcpt' ),
                'item_name'  => esc_html__( 'Testimonial', 'siteorigin-widgets' ),
                'fields' => array(
                    'name' => array(
                        'type' => 'text',
                        'label' => esc_html__( 'Name', 'besclwpcpt' )
                    ),
                    'info' => array(
                        'type' => 'text',
                        'label' => esc_html__( 'Info', 'besclwpcpt' )
                    ),
                    'image' => array(
                        'type' => 'media',
                        'label' => esc_html__( 'Thumbnail', 'besclwpcpt' ),
                        'choose' => esc_html__( 'Choose thumbnail', 'besclwpcpt' ),
                        'update' => esc_html__( 'Set thumbnail', 'besclwpcpt' ),
                        'library' => 'image',
                        'fallback' => false
                    ),
                    'url' => array(
                        'type' => 'link',
                        'label' => esc_html__( 'Destionation url (Optional)', 'besclwpcpt' ),
                        'default' => ''
                    ),
                    'target' => array(
				        'type' => 'checkbox',
				        'label' => esc_html__( 'Open link in a new tab', 'besclwpcpt' ),
				            'default' => false
                    ),
                    'text' => array(
				        'type' => 'tinymce',
				        'label' => esc_html__( 'Text', 'besclwpcpt' ),
				        'default' => '',
				        'rows' => 6,
				        'default_editor' => 'tinymce',
				        'button_filters' => array(
					       'mce_buttons' => array( $this, 'filter_mce_buttons' ),
					       'mce_buttons_2' => array( $this, 'filter_mce_buttons_2' ),
					       'mce_buttons_3' => array( $this, 'filter_mce_buttons_3' ),
					       'mce_buttons_4' => array( $this, 'filter_mce_buttons_5' ),
					       'quicktags_settings' => array( $this, 'filter_quicktags_settings' ),
				        ),
			         )
                )
            ),
            'b_section' => array(
                'type' => 'section',
                'label' => esc_html__( 'Carousel Settings' , 'besclwpcpt' ),
                'hide' => false,
                'fields' => array(
                    'position' => array(
				        'type' => 'select',
				        'label' => esc_html__( 'Thumbnail Position', 'besclwpcpt' ),
				        'default' => 'testimonial-left',
				        'options' => array(
                            'testimonial-left' => esc_html__( 'Left', 'besclwpcpt' ),
                            'testimonial-right' => esc_html__( 'Right', 'besclwpcpt' ),
                            'testimonial-center' => esc_html__( 'Center', 'besclwpcpt' )
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
			         )
                )
            )
        );

		parent::__construct(
			'besclwp-testimonials',
			esc_html__('Besocial Testimonials', 'besclwpcpt'),
			array(
				'description' => esc_html__('Displays testimonials', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-format-quote'),
            array(),
			$form_options,
			plugin_dir_path(__FILE__)
		);
    }
	
    function filter_mce_buttons( $buttons, $editor_id ) {
        $remove = array('fullscreen','dfw');
        return array_diff($buttons,$remove);
	}

	function filter_mce_buttons_2( $buttons, $editor_id ) {
		$remove = array('fullscreen','dfw');
        return array_diff($buttons,$remove);
	}

	function filter_mce_buttons_3( $buttons, $editor_id ) {
		$remove = array('fullscreen','dfw');
        return array_diff($buttons,$remove);
	}

	function filter_mce_buttons_4( $buttons, $editor_id ) {
		$remove = array('fullscreen','dfw');
        return array_diff($buttons,$remove);
	}

	public function quicktags_settings( $settings, $editor_id ) {
		$settings['buttons'] = preg_replace( '/,fullscreen/', '', $settings['buttons'] );
		$settings['buttons'] = preg_replace( '/,dfw/', '', $settings['buttons'] );
		return $settings;
	}

	function get_template_name($instance) {
        return 'besclwp-testimonials-template';
	}

	function get_style_name($instance) {
        return false;
	}

}
siteorigin_widget_register('besclwp-testimonials', __FILE__, 'besclwp_testimonials_widget');