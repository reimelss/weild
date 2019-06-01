<?php
class Egemenerd_Field_Slider {

	public function egemenerd_cmb2_slider_hooks() {
		add_filter( 'cmb2_render_egemenerd_slider',  array( $this, 'egemenerd_slider_field' ), 10, 5 );
	}

	public function egemenerd_slider_field( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {

		// Only enqueue scripts if field is used.
		$this->egemenerd_cmb2_slider_scripts();

		echo '<div class="egemenerd-cmb2-slider-field-container"><div class="egemenerd-cmb2-slider-field"></div>';
        
        echo wp_kses($field_type_object->input( array(
			'type'       => 'hidden',
			'class'      => 'egemenerd-cmb2-slider-field-value',
			'readonly'   => 'readonly',
			'data-start' => $field_escaped_value,
			'data-min'   => $field->min(),
			'data-max'   => $field->max(),
			'desc'       => '',
		) ), array('input' => array('type' => array(),'class' => array(),'name' => array(),'id' => array(),'value' => array(),'readonly' => array(),'data-start' => array(),'data-min' => array(),'data-max' => array())));

		echo '<div class="egemenerd-cmb2-slider-field-value-display"> <span class="egemenerd-cmb2-slider-field-value-text"></span></div></div>';

		$field_type_object->_desc( true, true );
	}

	public function egemenerd_cmb2_slider_scripts( ) {
        wp_enqueue_style('egemenerd_cmb2_field_slider_css', get_template_directory_uri() . '/includes/css/slider-field.css', true, '1.0');
		wp_enqueue_script( 'egemenerd_cmb2_field_slider_js',  get_template_directory_uri() . '/includes/js/slider-field.js', array( 'jquery', 'jquery-ui-slider' ), '1.0' );      
	}
}
$egemenerd_field_slider = new Egemenerd_Field_Slider();
$egemenerd_field_slider->egemenerd_cmb2_slider_hooks();
?>