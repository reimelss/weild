<?php
class besclwpsocial_Admin {
	private $key = 'besclwpsocial_options';
	private $metabox_id = 'besclwpsocial_option_metabox';
	protected $title = '';
	protected $options_page = '';
	public function __construct() {
		// Set our title
		$this->title = esc_html__( 'Footer Icons', 'besocial' );
        $this->menutitle = esc_html__( 'Footer Icons', 'besocial' );
	}

	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'besclwp_add_social_page' ) );
		add_action( 'cmb2_init', array( $this, 'besclwp_add_social_page_metabox' ) );
	}

	public function init() {
		register_setting( $this->key, $this->key );
	}

	public function besclwp_add_social_page() {
		$this->options_page = add_theme_page( $this->title, $this->menutitle, 'manage_options', $this->key, array( $this, 'besclwp_admin_social_display' ), 'dashicons-twitter' );

		// Include CMB CSS in the head to avoid FOUT
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	public function besclwp_admin_social_display() {
		?>
    <div class="wrap cmb2-options-page <?php echo esc_html($this->key); ?>">
        <div id="besclwp-social-wrapper">
            <h1 class="besclwp-social-title"><span><span class="dashicons dashicons-twitter"></span> <?php echo esc_html( get_admin_page_title() ); ?></span></h1>
            <p class="besclwp-social-subitle"><?php esc_html_e( 'These icons will be displayed in the footer.', 'besocial' ); ?></p>
                <?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
            <div id="besclwp-delete-social">
                <form action="admin.php?page=besclwpsocial_options" method="post">
                <input id="isg_delete_icons" name="isg_delete_icons" type="submit" onclick="return confirm('<?php esc_html_e( 'Are you sure you want to delete all icons?', 'besocial') ?>')" class="button" value="<?php esc_html_e( 'Reset', 'besocial') ?>" />
                </form>
                </div>
            <?php
            if (isset($_POST["isg_delete_icons"])) {
                echo "<meta http-equiv='refresh' content='0'>";
                delete_option("besclwpsocial_options");
            }
            ?>
        </div>
    </div>
    <?php
	}

	function besclwp_add_social_page_metabox() {
        $prefix = 'besocial';

		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => true,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
        
        $cmb->add_field(
            array(
            'desc' => esc_attr__( 'Open links in a new tab', 'besocial'),
            'id' => $prefix . 'socialiconstab',
            'type' => 'checkbox'
            )
        );
        
        $cmb->add_field(
            array(
            'id' => $prefix . 'socialicons',
            'type' => 'group',
            'options' => array(
                'group_title'   => esc_html__( 'Icon {#}', 'besocial' ),
                'add_button' => esc_html__( 'Add Another Icon', 'besocial' ),
                'remove_button' => esc_html__( 'Remove Icon', 'besocial' ),
                'sortable' => true,
                'closed'     => true,
            ),
            'fields' => array(
				array(
                    'name' => esc_html__( 'Select Icon:', 'besocial'),
                    'id' => $prefix . 'iconimg',
                    'desc' => esc_html__( 'Select an icon or add a Font Awesome icon name to the following custom icon field', 'besocial'),
                    'type' => 'select',
                    'options' => array(
                        'facebook-f' => esc_html__( 'Facebook', 'besocial' ),
                        'twitter' => esc_html__( 'Twitter', 'besocial' ),
                        'google-plus' => esc_html__( 'Google Plus', 'besocial' ),
                        'google' => esc_html__( 'Google', 'besocial' ),
                        'linkedin' => esc_html__( 'Linkedin', 'besocial' ),
                        'instagram' => esc_html__( 'Instagram', 'besocial' ),
                        'vimeo' => esc_html__( 'Vimeo', 'besocial' ),
                        'youtube' => esc_html__( 'You Tube', 'besocial' ),
                        'apple' => esc_html__( 'Apple', 'besocial' ),
                        'android' => esc_html__( 'Android', 'besocial' ),
                        'dribbble' => esc_html__( 'Dribbble', 'besocial' ),
                        'flickr' => esc_html__( 'Flickr', 'besocial' ),
                        'pinterest' => esc_html__( 'Pinterest', 'besocial' ),
                        'vk' => esc_html__( 'VK', 'besocial' ),
                        'snapchat-ghost' => esc_html__( 'Snapchat', 'besocial' ),
                    ),
                ),   
                array(
                    'name' => esc_html__( 'Custom icon:', 'besocial'),
                    'id' => $prefix . 'iconcustom',
                    'desc' => '<a href="http://fontawesome.io/icons/" target="_blank">' . esc_html__( 'Click to view Font Awesome icon list', 'besocial') . '</a>',
                    'type' => 'text'
                ),
                array(
                    'name' => esc_html__( 'Link:', 'besocial'),
                    'desc' => esc_html__( 'Example; http://www.themeforest.net', 'besocial'),
                    'id' => $prefix . 'iconlink',
                    'type' => 'text'
                ),
            ),
        ));

	}

	public function __get( $field ) {
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

function besclwpsocial_admin() {
	static $object = null;
	if ( is_null( $object ) ) {
		$object = new besclwpsocial_Admin();
		$object->hooks();
	}

	return $object;
}

function besclwpsocial_get_option( $key = '' ) {
	return cmb2_get_option( besclwpsocial_admin()->key, $key );
}

besclwpsocial_admin();
?>