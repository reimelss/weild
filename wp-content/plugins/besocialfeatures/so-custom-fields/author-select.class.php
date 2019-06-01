<?php
/* Author select field */

class besclwp_Author_Select extends SiteOrigin_Widget_Field_Base {
    

	protected function render_field( $value, $instance ) {
        $args = array(
            'show_option_all'         => null, // string
            'show_option_none'        => null, // string
            'hide_if_only_one_author' => null, // string
            'orderby'                 => 'display_name',
            'order'                   => 'ASC',
            'include'                 => null, // string
            'exclude'                 => null, // string
            'multi'                   => false,
            'show'                    => 'display_name',
            'echo'                    => true,
            'selected'                => $value,
            'include_selected'        => false,
            'name'                    => $this->element_name, // string
            'id'                      => $this->element_id, // integer
            'class'                   => null, // string 
            'blog_id'                 => $GLOBALS['blog_id'],
            'who'                     => null // string
        );
        wp_dropdown_users( $args );
	}

	protected function sanitize_field_input($value, $instance) {
		$sanitized_value = sanitize_text_field( $value );
		return $sanitized_value;
	}

	protected function add_label_classes( $label_classes ) {
		$label_classes[] = 'besclwp-author-select';
		return $label_classes;
	}

	protected function render_field_label($value, $instance) {
		?>
		<label class="siteorigin-widget-field-label"><?php esc_html_e( 'Select Author' , 'besclwpcpt' ); ?></label>
		<?php
	}
	protected function render_before_field( $value, $instance ) {
		// This is to keep the default label rendering behaviour.
		parent::render_before_field( $value, $instance );
		// Add custom rendering here.
		$this->render_field_description();
	}

	protected function render_after_field( $value, $instance ) {
		// Leave this blank so that the description is not rendered twice
	}
}
?>