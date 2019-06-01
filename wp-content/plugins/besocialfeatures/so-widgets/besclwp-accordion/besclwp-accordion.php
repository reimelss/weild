<?php
/*
Widget Name: Besocial Accordion
Description: Displays an accordion
Author: Egemenerd
Author URI: http://www.egemenerd.com
*/

class besclwp_accordion_widget extends SiteOrigin_Widget {
	function __construct() {
        $form_options = array(
            'a_repeater' => array(
                'type' => 'repeater',
                'label' => esc_html__( 'Accordion' , 'besclwpcpt' ),
                'item_name'  => esc_html__( 'Accordion item', 'siteorigin-widgets' ),
                'fields' => array(
                    'title' => array(
                        'type' => 'text',
                        'label' => esc_html__( 'Title', 'besclwpcpt' )
                    ),
                    'icon' => array(
                        'type' => 'icon',
                        'label' => esc_html__('Select an icon', 'besclwpcpt'),
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
            )
        );

		parent::__construct(
			'besclwp-accordion',
			esc_html__('Besocial Accordion', 'besclwpcpt'),
			array(
				'description' => esc_html__('Displays an accordion', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-editor-justify'),
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
        return 'besclwp-accordion-template';
	}

	function get_style_name($instance) {
        return false;
	}

}
siteorigin_widget_register('besclwp-accordion', __FILE__, 'besclwp_accordion_widget');