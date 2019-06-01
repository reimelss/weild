<?php
class Egemenerd_Field_Sorter {

public function egemenerd_cmb2_sorter_hooks() {
    add_filter( 'cmb2_render_egemenerd_sorter',  array( $this, 'egemenerd_sorter_field' ), 10, 5 );
    add_filter( 'cmb2_types_esc_egemenerd_sorter',  array( $this, 'egemenerd_sorter_escape' ), 10, 2 );
    add_filter( 'cmb2_sanitize_egemenerd_sorter',  array( $this, 'egemenerd_sorter_sanitize' ), 10, 2 );
}

public function egemenerd_sorter_field( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
    // Only enqueue scripts if field is used.
    $this->egemenerd_sorter_enqueue(); 

	if($field_escaped_value == ""){
		$sortlists = $field->options();
	} else {
		$sortlists = $field_escaped_value;
	}
		
	if ( $sortlists ) {
		echo '<div class="tb-field-container">';
		echo '<div id="' . $field_type_object->_id() . '" class="tb-sorter-container tb-sorter">';
        echo '<ul id="' . $field_type_object->_id() . '_enabled" class="sortlist_' . $field_type_object->_id() . '" data-id="' . $field_type_object->_id() . '" data-group-id="enabled">';
        echo '<h3>' . esc_html__( 'Enabled', 'besocial' ) . '</h3>';
        
        if(isset($sortlists['enabled'])) {
	        foreach ( $sortlists['enabled'] as $key => $list ) {
	           echo '<li id="sortee-' . $key . '" class="sortee" data-id="'. $key .'">';
	           echo '<input class="position" type="hidden" name="' . $field_type_object->_id() . '[enabled][' . $key . ']' .'" value="' . $list . '">';
	           echo $list;
	           echo '</li>'; 
	        }
        }

        echo '</ul>';     

        echo '<ul id="' . $field_type_object->_id() . '_disabled" class="sortlist_' . $field_type_object->_id() . '" data-id="' . $field_type_object->_id() . '" data-group-id="disabled">';
			echo '<h3>' . esc_html__( 'Disabled', 'besocial' ) . '</h3>';

        if(isset($sortlists['disabled'])) {
	        foreach ( $sortlists['disabled'] as $key => $list ) {
	           echo '<li id="sortee-' . $key . '" class="sortee" data-id="'. $key .'">';
	           echo '<input class="position" type="hidden" name="' . $field_type_object->_id() . '[disabled][' . $key . ']' .'" value="' . $list . '">';
	           echo $list;
	           echo '</li>'; 
	        }
        }

        echo '</ul>';
		echo '</div>';		
		echo '</div>';
		echo '<p class="cmb2-metabox-description">'.$field->args( 'desc' ).'</p>';
	}

}

public function egemenerd_sorter_enqueue() {	
    wp_enqueue_style('egemenerd-sorter-field-mods', get_template_directory_uri() . '/includes/css/sorter.css', true, '1.0');
    wp_enqueue_script( 'egemenerd-sorter-field-init',  get_template_directory_uri() . '/includes/js/sorter-init.js', array( 'jquery', 'jquery-ui-sortable' ), '1.0' );
}   


public function egemenerd_sorter_escape( $check, $meta_value ) {	
    if (is_array($meta_value) || is_object($meta_value))
    {
	   foreach ( $meta_value as $groups => $sortlist ) {
		  $meta_value[ $groups ] = array_map( 'esc_attr', $sortlist );
	   }
    }
	return $meta_value;	

}


public function egemenerd_sorter_sanitize( $check, $meta_value) {	
	if (is_array($meta_value) || is_object($meta_value))
    {
	   foreach ( $meta_value as $groups => $sortlist ) {
           $meta_value[ $groups ] = array_map( 'sanitize_text_field', $sortlist );
	   }
    }
	return $meta_value;
}

}
$egemenerd_field_sorter = new Egemenerd_Field_Sorter();
$egemenerd_field_sorter->egemenerd_cmb2_sorter_hooks();
?>