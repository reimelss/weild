<?php
/* WP Oembed field */

class besclwp_Wp_Oembed extends SiteOrigin_Widget_Field_Base {
    

	protected function render_field( $value, $instance ) {
    ?>
    <input type="text" id="<?php echo $this->element_id ?>" name="<?php echo $this->element_name ?>"
           value="<?php echo esc_attr( $value ); ?>"/>
    <?php
	}

	protected function sanitize_field_input($value, $instance) {
		$sanitized_value = sanitize_text_field( $value );
		return $sanitized_value;
	}

	protected function add_label_classes( $label_classes ) {
		$label_classes[] = 'besclwp-wp-oembed';
		return $label_classes;
	}

	protected function render_field_label($value, $instance) {
		?>
		<label class="siteorigin-widget-field-label"><?php esc_html_e( 'Enter a Youtube, Vimeo, Dailymotion, Vine, VideoPress or WordPress.tv URL.' , 'besclwpcpt' ); ?></label>
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