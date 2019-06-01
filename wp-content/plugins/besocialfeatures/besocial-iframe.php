<?php
/* ----------------------------------------------------------
Iframe widget
------------------------------------------------------------- */

add_action( 'widgets_init', 'besclwp_iframe_widget' );

function besclwp_iframe_widget() {
	register_widget( 'besclwp_iframewidget' );
}

class besclwp_iframewidget extends WP_Widget {

    function __construct() {
		parent::__construct(
			'besclwp-iframe-widget', // Base ID
			esc_attr__('Besocial Iframe', 'besclwpcpt'), // Name
			array( 'description' => esc_attr__('Displays a responsive iframe, object or embed', 'besclwpcpt'),'panels_groups' => array('besclwp'),'panels_icon' => 'dashicons dashicons-editor-code' ) // Args
		);
	}
	
	public function widget( $args, $instance ) {
		extract( $args );
        $code = $instance['code'];
        $besclwp_allowed = array(			
            'iframe' => array(
                'src' => array(),
                'height' => array(),
                'width' => array(),
                'frameborder' => array(),
                'allowfullscreen' => array(),			
            ),
            'object' => array(
                'form' => array(),
                'height' => array(),
                'width' => array(),
                'name' => array(),
                'type' => array(),
                'usemap' => array(),
            ),
            'embed' => array(
                'src' => array(),
                'height' => array(),
                'width' => array(),
                'type' => array(),		
            )
        );

		echo $args['before_widget'];

        echo '<div class="besclwp-iframe">' . $code . '</div>';
		
		echo $args['after_widget'];
	}
	 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
        $instance['code'] = $new_instance['code'];

		return $instance;
	}

	
	public function form( $instance ) {
		$defaults = array( 'code' => '');
        $besclwp_allowed = array(			
            'iframe' => array(
                'src' => array(),
                'height' => array(),
                'width' => array(),
                'frameborder' => array(),
                'allowfullscreen' => array(),			
            ),
            'object' => array(
                'form' => array(),
                'height' => array(),
                'width' => array(),
                'name' => array(),
                'type' => array(),
                'usemap' => array(),
            ),
            'embed' => array(
                'src' => array(),
                'height' => array(),
                'width' => array(),
                'type' => array(),		
            )
        );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'code' )); ?>"><?php esc_attr_e('Embed Code:', 'besclwpcpt'); ?></label>
    <textarea id="<?php echo esc_attr($this->get_field_id( 'code' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'code' )); ?>" class="fwtextarea"><?php if (isset($instance['code'])) { echo $instance['code']; } ?></textarea>
</p>
<?php }} ?>