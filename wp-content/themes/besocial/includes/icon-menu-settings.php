<?php
class besclwpiconmenu_Admin {
	private $key = 'besclwpiconmenu_options';
	private $metabox_id = 'besclwpiconmenu_option_metabox';
	protected $title = '';
	protected $options_page = '';
	public function __construct() {
		// Set our title
		$this->title = esc_html__( 'Icon Menu', 'besocial' );
        $this->menutitle = esc_html__( 'Icon Menu', 'besocial' );
	}

	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'besclwp_add_iconmenu_page' ) );
		add_action( 'cmb2_init', array( $this, 'besclwp_add_iconmenu_page_metabox' ) );
	}

	public function init() {
		register_setting( $this->key, $this->key );
	}

	public function besclwp_add_iconmenu_page() {
		$this->options_page = add_theme_page( $this->title, $this->menutitle, 'manage_options', $this->key, array( $this, 'besclwp_admin_iconmenu_display' ), 'dashicons-menu' );

		// Include CMB CSS in the head to avoid FOUT
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	public function besclwp_admin_iconmenu_display() {
		?>
    <div class="wrap cmb2-options-page <?php echo esc_html($this->key); ?>">
        <div id="besclwp-iconmenu-wrapper">
            <h1 class="besclwp-social-title"><span><span class="dashicons dashicons-menu"></span> <?php echo esc_html( get_admin_page_title() ); ?></span></h1>
                <?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
            <div id="besclwp-delete-iconmenu">
            <form action="admin.php?page=besclwpiconmenu_options" method="post">
            <input id="isg_delete_icons" name="isg_delete_icons" type="submit" class="button" value="<?php esc_html_e( 'Reset', 'besocial') ?>" />
            </form>
        </div>
        <?php
        if (isset($_POST["isg_delete_icons"])) {
            echo "<meta http-equiv='refresh' content='0'>";
            delete_option("besclwpiconmenu_options");
        }
        ?>
        </div>
    </div>
    <?php
	}

	function besclwp_add_iconmenu_page_metabox() {
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
        
        $cmb->add_field( array(
            'id'      => $prefix . '_icon_menu_title',
            'name' => esc_html__( 'You can drag&drop the icon menu items to change their order and you can enable or disable any of them', 'besocial' ),
            'type' => 'title'
        ) );
        
        $cmb->add_field(array(
        'id'      => $prefix . '_icon_menu_order',
        'desc'    => '',
        'type'    => 'egemenerd_sorter',
        'options' => array(
            'enabled'  => array(
                'activity' => esc_html__( 'Activity', 'besocial' ),
                'profile' => esc_html__( 'Profile', 'besocial' ),
                'notifications' => esc_html__( 'Notifications', 'besocial' ),   
                'messages' => esc_html__( 'Messages', 'besocial' ),
                'friends' => esc_html__( 'Friends', 'besocial' ),
                'groups' => esc_html__( 'Groups', 'besocial' ),
                'forums' => esc_html__( 'Forums', 'besocial' ),
                'settings' => esc_html__( 'Settings', 'besocial' )
            ),
            'disabled' => array(
                'blog' => esc_html__( 'Blog', 'besocial' ),
                'woocommerce'   => esc_html__( 'Woocommerce', 'besocial' ),
                'tml'   => esc_html__( 'TML User Links', 'besocial' )
            )        
        ),
    ));
        
    $cmb->add_field( array(
            'id'      => $prefix . '_icon_menu_title2',
            'name' => esc_html__( 'You can add additional links to the icon menu items', 'besocial' ), 
            'type' => 'title'
        ) );    
        
    $cmb->add_field(
            array(
            'id' => $prefix . '_icon_menu_links',
            'type' => 'group',   
            'options' => array(
                'group_title'   => esc_html__( 'Link {#}', 'besocial' ),
                'add_button' => esc_html__( 'Add Another Link', 'besocial' ),
                'remove_button' => esc_html__( 'Remove Link', 'besocial' ),
                'sortable' => true,
                'closed'     => true,
            ),
            'fields' => array(
				array(
                    'name' => esc_html__( 'Select menu (Required)', 'besocial'),
                    'id' => $prefix . '_icon_menu_link_position',
                    'type' => 'select',
                    'options' => array(
                        '' => esc_html__( 'Select a menu', 'besocial' ),
                        'activity_before' => esc_html__( 'Activity (Before)', 'besocial' ),
                        'activity_after' => esc_html__( 'Activity (After)', 'besocial' ),
                        'profile_before' => esc_html__( 'Profile (Before)', 'besocial' ),
                        'profile_after' => esc_html__( 'Profile (After)', 'besocial' ),
                        'notifications_before' => esc_html__( 'Notifications (Before)', 'besocial' ),
                        'notifications_after' => esc_html__( 'Notifications (After)', 'besocial' ),
                        'messages_before' => esc_html__( 'Messages (Before)', 'besocial' ),
                        'messages_after' => esc_html__( 'Messages (After)', 'besocial' ),
                        'friends_before' => esc_html__( 'Friends (Before)', 'besocial' ),
                        'friends_after' => esc_html__( 'Friends (After)', 'besocial' ),
                        'blog_before' => esc_html__( 'Blog (Before)', 'besocial' ),
                        'blog_after' => esc_html__( 'Blog (After)', 'besocial' ),
                        'groups_before' => esc_html__( 'Groups (Before)', 'besocial' ),
                        'groups_after' => esc_html__( 'Groups (After)', 'besocial' ),
                        'forums_before' => esc_html__( 'Forums (Before)', 'besocial' ),
                        'forums_after' => esc_html__( 'Forums (After)', 'besocial' ),
                        'woocommerce_before' => esc_html__( 'Woocommmerce (Before)', 'besocial' ),
                        'woocommerce_after' => esc_html__( 'Woocommerce (After)', 'besocial' ),
                        'settings_before' => esc_html__( 'Settings (Before)', 'besocial' ),
                        'settings_after' => esc_html__( 'Settings (After)', 'besocial' )
                    ),
                ),
                array(
                    'name' => esc_html__( 'Link text (Required)', 'besocial'),
                    'id' => $prefix . '_icon_menu_text',
                    'type' => 'text'
                ),
                array(
                    'name' => esc_html__( 'Destination Url (Required)', 'besocial'),
                    'desc' => esc_html__( 'Example; http://www.themeforest.net', 'besocial'),
                    'id' => $prefix . '_icon_menu_url',
                    'type' => 'text_url'
                ),
                array(
                    'desc' => esc_attr__( 'Open link in a new tab', 'besocial'),
                    'id' => $prefix . '_icon_menu_target',
                    'type' => 'checkbox'
                )
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

function besclwpiconmenu_admin() {
	static $object = null;
	if ( is_null( $object ) ) {
		$object = new besclwpiconmenu_Admin();
		$object->hooks();
	}

	return $object;
}

function besclwpiconmenu_get_option( $key = '' ) {
	return cmb2_get_option( besclwpiconmenu_admin()->key, $key );
}

besclwpiconmenu_admin();
?>