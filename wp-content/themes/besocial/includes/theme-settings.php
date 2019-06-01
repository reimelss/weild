<?php
/*---------------------------------------------------
Add Theme Settings Page
----------------------------------------------------*/

if ( ! function_exists( 'egemenerd_add_settings_page' ) ) {
    function egemenerd_add_settings_page() {
        global $egemenerd_settings_page;
        $egemenerd_settings_page = add_theme_page( esc_html__( 'Theme Settings', 'besocial'), esc_html__( 'Theme Settings', 'besocial'), 'manage_options', 'egemenerd-settings', 'egemenerd_theme_settings_page');
    }
    add_action( 'admin_menu', 'egemenerd_add_settings_page' );    
}

/*---------------------------------------------------
Add theme settings link to the admin bar
----------------------------------------------------*/

function egemenerd_admin_bar_render() {
    if ( current_user_can( 'manage_options' ) ) {
	global $wp_admin_bar;
	$wp_admin_bar->add_node( array(
		'parent' => 'site-name',
		'id' => 'egemenerd-theme-settings',
		'title' => esc_html__( 'Theme Settings', 'besocial'),
		'href' => admin_url( 'themes.php?page=egemenerd-settings'),
		'meta' => false
	));
    }
}
add_action( 'admin_bar_menu', 'egemenerd_admin_bar_render', 999 );

/*---------------------------------------------------
Theme settings scripts
----------------------------------------------------*/

if ( ! function_exists( 'egemenerd_theme_settings_scripts' ) ) {
function egemenerd_theme_settings_scripts($hook){
    global $egemenerd_settings_page;
    if( $hook != $egemenerd_settings_page ) {
		return;
    }
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style('toggles', get_template_directory_uri() . '/includes/css/toggles.css', false, '1.0');
    wp_enqueue_style('selectric', get_template_directory_uri() . '/includes/css/select.css', false, '1.0');
    wp_enqueue_style('egemenerd_ui_slider', get_template_directory_uri() . '/includes/css/ui-slider.css', false, '1.0');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/includes/css/font-awesome.min.css', false, '4.7.0');
    wp_enqueue_style('egemenerd_admin_icon_picker', get_template_directory_uri() . '/includes/css/iconpicker.css', false, '1.0');
    wp_enqueue_style('egemenerd_admin_custom_styles', get_template_directory_uri() . '/includes/css/admin.css', false, '1.0');
    if ( is_rtl() ) {
        wp_enqueue_style('egemenerd_admin_rtl_styles', get_template_directory_uri() . '/includes/css/admin-rtl.css', false, '1.0');
    }
    if ( !is_rtl() ) {
        wp_enqueue_script( 'ace_code_highlighter_js', get_template_directory_uri() . '/ace/ace.js', '', '1.0.0', true );
        wp_enqueue_script( 'ace_mode_js', get_template_directory_uri() . '/ace/mode-css.js', array( 'ace_code_highlighter_js' ), '1.0.0', true );
    }
    wp_enqueue_script('toggles', get_template_directory_uri() . '/includes/js/toggles.js', array( 'jquery' ),'',true);
    wp_enqueue_script('selectric', get_template_directory_uri() . '/includes/js/select.js', array( 'jquery' ),'',true);
    wp_enqueue_script('egemenerd_admin_icon_picker', get_template_directory_uri() . '/includes/js/iconpicker.js', array( 'jquery' ),'',true);
    wp_enqueue_script('egemenerd_admin_custom_scripts', get_template_directory_uri() . '/includes/js/admin.js', array( 'jquery', 'jquery-ui-slider', 'wp-color-picker' ),'',true);
}
add_action( 'admin_enqueue_scripts', 'egemenerd_theme_settings_scripts' );
}

/* ---------------------------------------------------------
Declare theme settings
----------------------------------------------------------- */

$besclwp_theme = "besclwp";
 
$egemenerd_theme_options = array (
 
/* ---------------------------------------------------------
General
----------------------------------------------------------- */
array( "name" => esc_html__( 'General', 'besocial'),
"icon" => "dashicons-admin-generic",  
"type" => "section"),
array( "type" => "open"),

array( "name" => esc_html__( 'Custom CSS', 'besocial'),
"desc" => "",
"id" => $besclwp_theme."_customcode",
"type" => "csseditor",
"std" => ""),    
    
array( "name" => esc_html__( 'Logo', 'besocial'),
"desc" => '',
"id" => $besclwp_theme."_logo",
"type" => "media",
"std" => ""),    
    
array( "name" => esc_html__( 'Disable Fixed Header', 'besocial'),
"desc" => esc_html__( 'To disable fixed header, switch on.', 'besocial'),
"id" => $besclwp_theme."_fixed_header",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_html__( 'Dropdown Menu Width', 'besocial'),
"desc" => esc_html__( 'Dropdown Menu Width (em)', 'besocial'),
"id" => $besclwp_theme."_dropdown_size",
"type" => "uislider",
"step" => 1,      
"min" => 10, 
"max" => 30,      
"std" => 15),
    
array( "name" => esc_html__( 'Remove Search Box', 'besocial'),
"desc" => esc_html__( 'To remove the search box in the top bar, switch on.', 'besocial'),
"id" => $besclwp_theme."_top_search",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_html__( 'Disable Lightbox', 'besocial'),
"desc" => esc_html__( 'To disable lightbox plugin, switch on.', 'besocial'),
"id" => $besclwp_theme."_lightbox",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_html__( 'Disable FAQ Search', 'besocial'),
"desc" => esc_html__( 'To disable FAQ live search, switch on.', 'besocial'),
"id" => $besclwp_theme."_faq_search",
"type" => "checkbox",
"std" => ""),     
    
array( "name" => esc_html__( 'Footer text', 'besocial'),
"desc" => esc_html__( 'If you dont need to add a copyright message to your website, leave this field blank.', 'besocial'),
"id" => $besclwp_theme."_footermessage",
"type" => "text",
"std" => ""),    
    
array( "type" => "close"),
    
/* ---------------------------------------------------------
Loaders
----------------------------------------------------------- */  

array( "name" => esc_html__( 'Loaders', 'besocial'),
"icon" => "dashicons-update",      
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_html__( 'Enable Page Loading Animation', 'besocial'),
"desc" => esc_html__( 'To enable page loading animation, switch on.', 'besocial'),
"id" => $besclwp_theme."_loading",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_html__( 'Page Loading Background Color', 'besocial'),
"desc" => esc_html__( 'Default color code is #f1f1f1', 'besocial'),
"id" => $besclwp_theme."_loading_bg_color",
"type" => "rgbacolorpicker",
"std" => "#f1f1f1"),
    
array( "name" => esc_html__( 'Spinner Color', 'besocial'),
"desc" => esc_html__( 'Default color code is #427aa1', 'besocial'),
"id" => $besclwp_theme."_spinner_color",
"type" => "colorpicker",
"std" => "#427aa1"),    
    
array( "name" => esc_html__( 'Custom Page Loading Image', 'besocial'),
"desc" => '',
"id" => $besclwp_theme."_custom_loading",
"type" => "media",
"std" => ""),    
    
array( "name" => esc_html__( 'Mutual friends loader', 'besocial'),
"desc" => '',
"id" => $besclwp_theme."_mfloader",
"type" => "media",
"std" => get_template_directory_uri() ."/images/loader.gif"),  
    
array( "type" => "close"),   
    
/* ---------------------------------------------------------
Sticky Sidebar
----------------------------------------------------------- */
array( "name" => esc_html__( 'Sticky Sidebar', 'besocial'),
"icon" => "dashicons-align-left",  
"type" => "section"),
array( "type" => "open"),

array( "name" => esc_html__( 'Disable Sticky Sidebar Plugin', 'besocial'),
"desc" => esc_html__( 'To disable sticky sidebar plugin, switch on.', 'besocial'),
"id" => $besclwp_theme."_sticky",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_html__( 'Breakpoint', 'besocial'),
"desc" => esc_html__( 'If screen width is less than breakpoint, the plugin will be disabled.', 'besocial'),
"id" => $besclwp_theme."_sticky_breakpoint",
"type" => "select",
"std" => array('0' => esc_html__( 'No breakpoint', 'besocial'),'1200' => esc_html__( '1200px', 'besocial'),'1024' => esc_html__( '1024px', 'besocial'),'768' => esc_html__( '768px', 'besocial'),'640' => esc_html__( '640px', 'besocial'),'480' => esc_html__( '480px', 'besocial'))),     
    
array( "name" => esc_html__( 'Additional Margin Top', 'besocial'),
"desc" => esc_html__( 'An additional top margin in pixels.', 'besocial'),
"id" => $besclwp_theme."_sticky_top",
"type" => "number",
"std" => "40"),
    
array( "name" => esc_html__( 'Additional Margin Bottom', 'besocial'),
"desc" => esc_html__( 'An additional bottom margin in pixels.', 'besocial'),
"id" => $besclwp_theme."_sticky_bottom",
"type" => "number",
"std" => "40"), 
    
array( "name" => esc_html__( 'Sidebar behavior', 'besocial'),
"desc" => esc_html__( 'Sidebar behavior', 'besocial'),
"id" => $besclwp_theme."_sticky_behavior",
"type" => "select",
"std" => array('stick-to-top' => esc_html__( 'Stick to top', 'besocial'),'stick-to-bottom' => esc_html__( 'Stick to bottom', 'besocial'),'modern' => esc_html__( 'Modern', 'besocial'),'none' => esc_html__( 'None', 'besocial'))),   

array( "type" => "close"),
    
/* ---------------------------------------------------------
BuddyPress
----------------------------------------------------------- */

array( "name" => esc_html__( 'BuddyPress', 'besocial'),
"icon" => "dashicons-groups",      
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_html__( 'Disable All Members Activity', 'besocial'),
"desc" => esc_html__( 'To disable all members activity tab on activity pages, switch on.', 'besocial'),
"id" => $besclwp_theme."_disable_all_members",
"type" => "checkbox",
"std" => ""),  
    
array( 
"name" => esc_html__( 'Cover Images', 'besocial'),
"type" => "title"),     
    
array( "name" => esc_html__( 'BuddyPress default profile cover image (1320x340px)', 'besocial'),
"desc" => '',
"id" => $besclwp_theme."_buddypress_profile_cover",
"type" => "media",
"std" => get_template_directory_uri() ."/images/buddypress-default-cover.png"),

array( "name" => esc_html__( 'Disable profile cover image', 'besocial'),
"desc" => esc_html__( 'To disable profile cover image, switch on.', 'besocial'),
"id" => $besclwp_theme."_disable_p_cover",
"type" => "checkbox",
"std" => ""),    
    
array( "name" => esc_html__( 'BuddyPress default group cover image (1320x340px)', 'besocial'),
"desc" => '',
"id" => $besclwp_theme."_buddypress_group_cover",
"type" => "media",
"std" => get_template_directory_uri() ."/images/buddypress-default-cover.png"),
    
array( "name" => esc_html__( 'Disable group cover image', 'besocial'),
"desc" => esc_html__( 'To disable group cover image, switch on.', 'besocial'),
"id" => $besclwp_theme."_disable_g_cover",
"type" => "checkbox",
"std" => ""),
    
array( 
"name" => esc_html__( 'User Blog', 'besocial'),
"type" => "title"),    
    
array( "name" => esc_html__( 'Enable user blog', 'besocial'),
"desc" => esc_html__( 'To give your members the ability to create blog posts, switch on.', 'besocial'),
"id" => $besclwp_theme."_enable_user_blog",
"type" => "checkbox",
"std" => ""), 
    
array( "name" => esc_html__( 'Allow only featured members', 'besocial'),
"desc" => esc_html__( 'To allow only featured members to create blog posts, switch on ("Enable user blog" option must be enabled).', 'besocial'),
"id" => $besclwp_theme."_enable_featured_blog",
"type" => "checkbox",
"std" => ""), 
    
array( "name" => esc_html__( 'Enable media upload', 'besocial'),
"desc" => esc_html__( 'To allow your members the ability to upload media files to their posts, switch on.', 'besocial'),
"id" => $besclwp_theme."_enable_media_upload",
"type" => "checkbox",
"std" => ""),    
    
array( "name" => esc_html__( 'Maximum number of user posts', 'besocial'),
"desc" => esc_html__( 'Maximum number of user posts (pagination)', 'besocial'),
"id" => $besclwp_theme."_max_user_posts",
"type" => "uislider",
"step" => 1,      
"min" => 1,
"max" => 30,      
"std" => 5),
    
array( "name" => esc_html__( 'Maximum title length', 'besocial'),
"desc" => esc_html__( 'You can limit the title length.', 'besocial'),
"id" => $besclwp_theme."_title_length",
"type" => "number",
"std" => 60),     
    
array( "name" => esc_html__( 'Maximum excerpt length', 'besocial'),
"desc" => esc_html__( 'You can limit the excerpt length.', 'besocial'),
"id" => $besclwp_theme."_excerpt_length",
"type" => "number",
"std" => 55), 
    
array( 
"name" => esc_html__( 'Live Notifications', 'besocial'),
"type" => "title"), 
    
array( "name" => esc_html__( 'Enable live notifications', 'besocial'),
"desc" => esc_html__( 'To enable live notifications, switch on.', 'besocial'),
"id" => $besclwp_theme."_enable_live_notification",
"type" => "checkbox",
"std" => ""),   
    
array( "name" => esc_html__( 'Pulse', 'besocial'),
"desc" => esc_html__( 'By default WordPress checks notifications once every 60 seconds.', 'besocial'),
"id" => $besclwp_theme."_notification_pulse",
"type" => "uislider",
"step" => 1,      
"min" => 15,
"max" => 60,      
"std" => 60), 
    
array( "type" => "close"), 
    
/* ---------------------------------------------------------
bbPress
----------------------------------------------------------- */

array( "name" => esc_html__( 'bbPress', 'besocial'),
"icon" => "dashicons-groups",      
"type" => "section"),
array( "type" => "open"),  
    
array( "name" => esc_html__( 'bbPress layout', 'besocial'),
"desc" => esc_html__( 'Layout of the bbPress pages', 'besocial'),
"id" => $besclwp_theme."_bbpress_layout",
"type" => "select",
"std" => array('sidebar' => esc_html__( 'One Column + Sidebar', 'besocial'),'fullwidth' => esc_html__( 'Fullwidth', 'besocial'))),
    
array( "name" => esc_html__( 'Visual Editor', 'besocial'),
"desc" => esc_html__( 'To enable visual editor for topic replies, switch on.', 'besocial'),
"id" => $besclwp_theme."_bbpress_visual",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_html__( 'Enable Media Upload', 'besocial'),
"desc" => esc_html__( 'To allow your members the ability to upload media files to their replies, switch on.', 'besocial'),
"id" => $besclwp_theme."_bbpress_visual_media",
"type" => "checkbox",
"std" => ""),     
    
array( "type" => "close"),     
    
/* ---------------------------------------------------------
Icon Menu
----------------------------------------------------------- */
array( "name" => esc_html__( 'Icon Menu', 'besocial'),
"icon" => "dashicons-menu",  
"type" => "section"),
array( "type" => "open"), 
    
array( "name" => esc_html__( 'Disable BuddyPress Icon Menu', 'besocial'),
"desc" => esc_html__( 'To disable icon menu, switch on.', 'besocial'),
"id" => $besclwp_theme."_icon_menu",
"type" => "checkbox",
"std" => ""),     
    
array( "name" => esc_html__( 'BuddyPress Activity Icon', 'besocial'),
"desc" => esc_html__( 'Select a FontAwesome icon', 'besocial'),
"id" => $besclwp_theme."_activity_icon",
"type" => "fontawesome",
"std" => "fa-home"), 
    
array( "name" => esc_html__( 'Activity Menu Title', 'besocial'),
"desc" => esc_html__( 'Activity Menu Title', 'besocial'),
"id" => $besclwp_theme."_activity_title",
"type" => "text",
"std" => ""),    
    
array( "name" => esc_html__( 'BuddyPress Profile Icon', 'besocial'),
"desc" => esc_html__( 'Select a FontAwesome icon', 'besocial'),
"id" => $besclwp_theme."_profile_icon",
"type" => "fontawesome",
"std" => "fa-user"),
    
array( "name" => esc_html__( 'Profile Menu Title', 'besocial'),
"desc" => esc_html__( 'Profile Menu Title', 'besocial'),
"id" => $besclwp_theme."_profile_title",
"type" => "text",
"std" => ""),    
    
array( "name" => esc_html__( 'BuddyPress Notifications Icon', 'besocial'),
"desc" => esc_html__( 'Select a FontAwesome icon', 'besocial'),
"id" => $besclwp_theme."_notifications_icon",
"type" => "fontawesome",
"std" => "fa-bell"),
    
array( "name" => esc_html__( 'Notifications Menu Title', 'besocial'),
"desc" => esc_html__( 'Notifications Menu Title', 'besocial'),
"id" => $besclwp_theme."_notifications_title",
"type" => "text",
"std" => ""),    
    
array( "name" => esc_html__( 'BuddyPress Messages Icon', 'besocial'),
"desc" => esc_html__( 'Select a FontAwesome icon', 'besocial'),
"id" => $besclwp_theme."_messages_icon",
"type" => "fontawesome",
"std" => "fa-envelope"),
    
array( "name" => esc_html__( 'Messages Menu Title', 'besocial'),
"desc" => esc_html__( 'Messages Menu Title', 'besocial'),
"id" => $besclwp_theme."_messages_title",
"type" => "text",
"std" => ""),    
    
array( "name" => esc_html__( 'BuddyPress Friends Icon', 'besocial'),
"desc" => esc_html__( 'Select a FontAwesome icon', 'besocial'),
"id" => $besclwp_theme."_friends_icon",
"type" => "fontawesome",
"std" => "fa-users"), 
    
array( "name" => esc_html__( 'Friends Menu Title', 'besocial'),
"desc" => esc_html__( 'Friends Menu Title', 'besocial'),
"id" => $besclwp_theme."_friends_title",
"type" => "text",
"std" => ""),    
    
array( "name" => esc_html__( 'BuddyPress Groups Icon', 'besocial'),
"desc" => esc_html__( 'Select a FontAwesome icon', 'besocial'),
"id" => $besclwp_theme."_groups_icon",
"type" => "fontawesome",
"std" => "fa-cubes"),
    
array( "name" => esc_html__( 'Groups Menu Title', 'besocial'),
"desc" => esc_html__( 'Groups Menu Title', 'besocial'),
"id" => $besclwp_theme."_groups_title",
"type" => "text",
"std" => ""),
    
array( "name" => esc_html__( 'BuddyPress Blog Icon', 'besocial'),
"desc" => esc_html__( 'Select a FontAwesome icon', 'besocial'),
"id" => $besclwp_theme."_blog_icon",
"type" => "fontawesome",
"std" => "fa-pencil"),
    
array( "name" => esc_html__( 'Blog Menu Title', 'besocial'),
"desc" => esc_html__( 'Blog Menu Title', 'besocial'),
"id" => $besclwp_theme."_blog_title",
"type" => "text",
"std" => ""),     
    
array( "name" => esc_html__( 'BbPress Forums Icon', 'besocial'),
"desc" => esc_html__( 'Select a FontAwesome icon', 'besocial'),
"id" => $besclwp_theme."_forums_icon",
"type" => "fontawesome",
"std" => "fa-comments"),
    
array( "name" => esc_html__( 'Forums Menu Title', 'besocial'),
"desc" => esc_html__( 'Forums Menu Title', 'besocial'),
"id" => $besclwp_theme."_forums_title",
"type" => "text",
"std" => ""),    
    
array( "name" => esc_html__( 'BuddyPress Settings Icon', 'besocial'),
"desc" => esc_html__( 'Select a FontAwesome icon', 'besocial'),
"id" => $besclwp_theme."_settings_icon",
"type" => "fontawesome",
"std" => "fa-gears"),
    
array( "name" => esc_html__( 'Settings Menu Title', 'besocial'),
"desc" => esc_html__( 'Settings Menu Title', 'besocial'),
"id" => $besclwp_theme."_settings_title",
"type" => "text",
"std" => ""),    
    
array( "name" => esc_html__( 'Woocommerce Menu Icon', 'besocial'),
"desc" => esc_html__( 'Select a FontAwesome icon', 'besocial'),
"id" => $besclwp_theme."_woocommerce_icon",
"type" => "fontawesome",
"std" => "fa-shopping-cart"),
    
array( "name" => esc_html__( 'Woocommerce Menu Title', 'besocial'),
"desc" => esc_html__( 'Woocommerce Menu Title', 'besocial'),
"id" => $besclwp_theme."_woocommerce_title",
"type" => "text",
"std" => ""),    
    
array( "name" => esc_html__( 'TML Menu Icon', 'besocial'),
"desc" => esc_html__( 'Select a FontAwesome icon', 'besocial'),
"id" => $besclwp_theme."_tml_icon",
"type" => "fontawesome",
"std" => "fa-bars"),
    
array( "name" => esc_html__( 'TML Menu Title', 'besocial'),
"desc" => esc_html__( 'TML Menu Title', 'besocial'),
"id" => $besclwp_theme."_tml_title",
"type" => "text",
"std" => ""),    
    
array( "name" => esc_html__( 'BuddyPress Mobile Menu Icon', 'besocial'),
"desc" => esc_html__( 'Select a FontAwesome icon', 'besocial'),
"id" => $besclwp_theme."_mobile_icon",
"type" => "fontawesome",
"std" => "fa-user"), 
    
array( "name" => esc_html__( 'More Settings', 'besocial'),
"desc" => esc_html__( 'To change the order of the menu items or enable/disable them, click here...', 'besocial'),
"id" => $besclwp_theme."_more_settings",
"type" => "linkbutton",
"std" => admin_url('admin.php?page=besclwpiconmenu_options')),    
    
array( "type" => "close"),     
    
/* ---------------------------------------------------------
Member & Group Cards
----------------------------------------------------------- */

array( "name" => esc_html__( 'Member & Group Cards', 'besocial'),
"icon" => "dashicons-id-alt",      
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_html__( 'Disable', 'besocial'),
"desc" => esc_html__( 'To disable user/group cards, switch on.', 'besocial'),
"id" => $besclwp_theme."_user_preview",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_html__( 'Card Width', 'besocial'),
"desc" => esc_html__( 'Width of the card.', 'besocial'),
"id" => $besclwp_theme."_card_width",
"type" => "uislider",
"step" => 10,      
"min" => 300, 
"max" => 800,      
"std" => 500),  
    
array( "name" => esc_html__( 'Remove Thumbnail', 'besocial'),
"desc" => esc_html__( 'To hide thumbnail in the cards, switch on.', 'besocial'),
"id" => $besclwp_theme."_disable_user_thumb",
"type" => "checkbox",
"std" => ""),    
    
array( "name" => esc_html__( 'User Bio & Group Desc Length', 'besocial'),
"desc" => esc_html__( 'Maximum number of words in user cards. To remove user bios and group descriptions from the cards, select zero.', 'besocial'),
"id" => $besclwp_theme."_user_preview_bio",
"type" => "uislider",
"step" => 1,      
"min" => 0, 
"max" => 100,      
"std" => 30), 
    
array( "name" => esc_html__( 'Extended Profile Field ID', 'besocial'),
"desc" => esc_html__( 'The id of the profile field which will displayed in user cards. For more information,please look at the help documentation.', 'besocial'),
"id" => $besclwp_theme."_profile_field_id",
"type" => "number",
"std" => ""),    
    
array( "type" => "close"),      
    
/* ---------------------------------------------------------
Blog
----------------------------------------------------------- */
array( "name" => esc_html__( 'Blog', 'besocial'),
"icon" => "dashicons-admin-post",  
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_html__( 'Display Featured Image on All Standard Posts', 'besocial'),
"desc" => esc_html__( 'To display featured image on all standard posts, switch on.', 'besocial'),
"id" => $besclwp_theme."_display_featured_imgs",
"type" => "checkbox",
"std" => ""),    
    
array( "name" => esc_html__( 'Blog Subtitle', 'besocial'),
"desc" => esc_html__( 'Subtitle of your archive pages (Optional).', 'besocial'),
"id" => $besclwp_theme."_blog_subtitle",
"type" => "text",
"std" => ""),
    
array( "name" => esc_html__( 'Archive and search page layout', 'besocial'),
"desc" => esc_html__( 'Archive and search page layout', 'besocial'),
"id" => $besclwp_theme."_blog_layout",
"type" => "select",
"std" => array('twocolumnssidebar' => esc_html__( 'Two Columns + Sidebar', 'besocial'),'twocolumns' => esc_html__( 'Two Columns', 'besocial'),'threecolumns' => esc_html__( 'Three Columns', 'besocial'),'fourcolumns' => esc_html__( 'Four Columns', 'besocial'))), 
    
array( "name" => esc_html__( 'Remove Author Links', 'besocial'),
"desc" => esc_html__( 'To remove author links on the posts, switch on.', 'besocial'),
"id" => $besclwp_theme."_remove_author_links",
"type" => "checkbox",
"std" => ""),     
    
array( "name" => esc_html__( 'Remove Author Box', 'besocial'),
"desc" => esc_html__( 'There is an author box at the bottom of the single post pages. To remove it, switch on.', 'besocial'),
"id" => $besclwp_theme."_remove_author_box",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_html__( 'Remove Social Sharing Buttons', 'besocial'),
"desc" => esc_html__( 'There are social sharing buttons at the bottom of the single post pages. To remove them, switch on.', 'besocial'),
"id" => $besclwp_theme."_remove_sharing",
"type" => "checkbox",
"std" => ""),    
    
array( "name" => esc_html__( 'Activate Related Posts', 'besocial'),
"desc" => esc_html__( 'It uses post tags to find related articles. Only posts with featured images will be displayed.', 'besocial'),
"id" => $besclwp_theme."_activate_related",
"type" => "checkbox",
"std" => ""),   
    
array( "name" => esc_html__( 'Maximum number of related posts', 'besocial'),
"desc" => esc_html__( 'Maximum number of related posts', 'besocial'),
"id" => $besclwp_theme."_max_related",
"type" => "uislider",
"step" => 1,      
"min" => 1,
"max" => 30,      
"std" => 6),    
    
array( "type" => "close"),  
    
/* ---------------------------------------------------------
Facebook Comments
----------------------------------------------------------- */

array( "name" => esc_html__( 'Facebook Comments', 'besocial'),
"icon" => "dashicons-facebook-alt",      
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_html__( 'Activate Facebook Comments', 'besocial'),
"desc" => esc_html__( 'To activate Facebook comments on posts, switch on.', 'besocial'),
"id" => $besclwp_theme."_activate_fb_comments",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_html__( 'Facebook APP ID (REQUIRED)', 'besocial'),
"desc" => esc_html__( 'For more information, please read the help documentation.', 'besocial'),
"id" => $besclwp_theme."_fb_id",
"type" => "text",
"std" => ""),
    
array( "name" => esc_html__( 'Title', 'besocial'),
"desc" => esc_html__( 'Title', 'besocial'),
"id" => $besclwp_theme."_fb_title",
"type" => "text",
"std" => ""),    
    
array( "name" => esc_html__( 'Color Scheme', 'besocial'),
"desc" => esc_html__( 'Color Scheme', 'besocial'),
"id" => $besclwp_theme."_fb_color_scheme",
"type" => "select",
"std" => array('light' => esc_html__( 'Light', 'besocial'),'dark' => esc_html__( 'Dark', 'besocial'))),
    
array( "name" => esc_html__( 'Number of the comments', 'besocial'),
"desc" => esc_html__( 'The number of comments to show by default.', 'besocial'),
"id" => $besclwp_theme."_fb_max",
"type" => "number",
"std" => "5"),
    
array( "name" => esc_html__( 'Data Order by', 'besocial'),
"desc" => esc_html__( 'The order to use when displaying comments.', 'besocial'),
"id" => $besclwp_theme."_fb_order",
"type" => "select",
"std" => array('social' => esc_html__( 'Social', 'besocial'),'time' => esc_html__( 'Oldest', 'besocial'),'reverse_time' => esc_html__( 'Newest', 'besocial'))),    
    
array( "type" => "close"),    

/* ---------------------------------------------------------
Fonts
----------------------------------------------------------- */  

array( "name" => esc_html__( 'Fonts', 'besocial'),
"icon" => "dashicons-edit",      
"type" => "section"),
array( "type" => "open"),   
    
array( "name" => esc_html__( 'Google Web Fonts Code', 'besocial'),
"desc" => esc_html__( 'Google Web Fonts Code (For more information please read the HELP DOCUMENTION)', 'besocial'),
"id" => $besclwp_theme."_webfontcode",
"type" => "text",
"std" => ""),

array( "name" => esc_html__( 'Font-Family', 'besocial'),
"desc" => esc_html__( 'Font-Family', 'besocial'),
"id" => $besclwp_theme."_fontfamily",
"type" => "text",
"std" => ""),
    
array( "name" => esc_html__( 'H1', 'besocial'),
"desc" => esc_html__( 'H1 Font Size (px)', 'besocial'),
"id" => $besclwp_theme."_h1",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 90,      
"std" => 32),

array( "name" => esc_html__( 'H2', 'besocial'),
"desc" => esc_html__( 'H2 Font Size (px)', 'besocial'),
"id" => $besclwp_theme."_h2",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 90,      
"std" => 28),

array( "name" => esc_html__( 'H3', 'besocial'),
"desc" => esc_html__( 'H3 Font Size (px)', 'besocial'),
"id" => $besclwp_theme."_h3",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 90,      
"std" => 24), 

array( "name" => esc_html__( 'H4', 'besocial'),
"desc" => esc_html__( 'H4 Font Size (px)', 'besocial'),
"id" => $besclwp_theme."_h4",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 90,      
"std" => 22), 

array( "name" => esc_html__( 'H5', 'besocial'),
"desc" => esc_html__( 'H5 Font Size (px)', 'besocial'),
"id" => $besclwp_theme."_h5",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 90,      
"std" => 20), 

array( "name" => esc_html__( 'H6', 'besocial'),
"desc" => esc_html__( 'H6 Font Size (px)', 'besocial'),
"id" => $besclwp_theme."_h6",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 90,      
"std" => 18), 

array( "name" => esc_html__( 'Regular Font Size', 'besocial'),
"desc" => esc_html__( 'Regular Font Size (px)', 'besocial'),
"id" => $besclwp_theme."_p",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 90,      
"std" => 16),
    
array( "name" => esc_html__( 'Small Font Size', 'besocial'),
"desc" => esc_html__( 'Small Font Size (px)', 'besocial'),
"id" => $besclwp_theme."_small",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 90,      
"std" => 14), 
    
array( "name" => esc_html__( 'X-Small Font Size', 'besocial'),
"desc" => esc_html__( 'X-Small Font Size (px)', 'besocial'),
"id" => $besclwp_theme."_xsmall",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 90,      
"std" => 12),     
    
array( "type" => "close"),
    
/* ---------------------------------------------------------
Color Scheme
----------------------------------------------------------- */

array( "name" => esc_html__( 'Color Scheme', 'besocial'),
"icon" => "dashicons-admin-appearance",      
"type" => "section"),
array( "type" => "open"),  
    
array( "name" => esc_html__( 'Color 1', 'besocial'),
"desc" => esc_html__( 'Default color code is #2c3d55', 'besocial'),
"id" => $besclwp_theme."_1_color",
"type" => "colorpicker",
"std" => "#2c3d55"),
    
array( "name" => esc_html__( 'Color 2', 'besocial'),
"desc" => esc_html__( 'Default color code is #324661', 'besocial'),
"id" => $besclwp_theme."_2_color",
"type" => "colorpicker",
"std" => "#324661"),

array( "name" => esc_html__( 'Color 3', 'besocial'),
"desc" => esc_html__( 'Default color code is #3e6990', 'besocial'),
"id" => $besclwp_theme."_3_color",
"type" => "colorpicker",
"std" => "#3e6990"),
    
array( "name" => esc_html__( 'Color 4', 'besocial'),
"desc" => esc_html__( 'Default color code is #427aa1', 'besocial'),
"id" => $besclwp_theme."_4_color",
"type" => "colorpicker",
"std" => "#427aa1"),
    
array( "name" => esc_html__( 'Color 5', 'besocial'),
"desc" => esc_html__( 'Default color code is #6b717e', 'besocial'),
"id" => $besclwp_theme."_5_color",
"type" => "colorpicker",
"std" => "#6b717e"),
    
array( "name" => esc_html__( 'Color 6', 'besocial'),
"desc" => esc_html__( 'Default color code is #f1f1f1', 'besocial'),
"id" => $besclwp_theme."_6_color",
"type" => "colorpicker",
"std" => "#f1f1f1"),   
    
array( "name" => esc_html__( 'Color 7', 'besocial'),
"desc" => esc_html__( 'Default color code is #ffffff', 'besocial'),
"id" => $besclwp_theme."_7_color",
"type" => "colorpicker",
"std" => "#ffffff"),
    
array( "name" => esc_html__( 'Color 8', 'besocial'),
"desc" => esc_html__( 'Default color code is #bfbdc1', 'besocial'),
"id" => $besclwp_theme."_8_color",
"type" => "colorpicker",
"std" => "#bfbdc1"),    
    
array( "type" => "close"),
    
/* ---------------------------------------------------------
Woocommerce
----------------------------------------------------------- */

array( "name" => esc_html__( 'Woocommerce', 'besocial'),
"icon" => "dashicons-cart",      
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_html__( 'Shop Subtitle', 'besocial'),
"desc" => esc_html__( 'Default Shop Subtitle', 'besocial'),
"id" => $besclwp_theme."_shop_subtitle",
"type" => "text",
"std" => ""),
    
array( "name" => esc_html__( 'Remove Sidebar', 'besocial'),
"desc" => esc_html__( 'To remove sidebar from Woocommerce pages, switch on.', 'besocial'),
"id" => $besclwp_theme."_remove_woocommerce_sidebar",
"type" => "checkbox",
"std" => ""),    
    
array( "name" => esc_html__( 'Product layout', 'besocial'),
"desc" => esc_html__( 'Product layout', 'besocial'),
"id" => $besclwp_theme."_shop_layout",
"type" => "select",
"std" => array('twocolumns' => esc_html__( 'Two Columns', 'besocial'),'threecolumns' => esc_html__( 'Three Columns', 'besocial'),'fourcolumns' => esc_html__( 'Four Columns', 'besocial'))),
    
array( "name" => esc_html__( 'Product Thumbnail Size', 'besocial'),
"desc" => esc_html__( 'Product Thumbnail Size', 'besocial'),
"id" => $besclwp_theme."_product_thumbnail",
"type" => "select",
"std" => array('large' => esc_html__( 'Large', 'besocial'),'full' => esc_html__( 'Full', 'besocial'),'medium' => esc_html__( 'Medium', 'besocial'),'shop_thumbnail' => esc_html__( 'Default', 'besocial'))),
    
array( "name" => esc_html__( 'Single Product Image Size', 'besocial'),
"desc" => esc_html__( 'Single Product Image Size', 'besocial'),
"id" => $besclwp_theme."_product_image",
"type" => "select",
"std" => array('large' => esc_html__( 'Large', 'besocial'),'full' => esc_html__( 'Full', 'besocial'),'medium' => esc_html__( 'Medium', 'besocial'),'shop_single' => esc_html__( 'Default', 'besocial'))),
    
array( "name" => esc_html__( 'Single Product Image Column Size', 'besocial'),
"desc" => esc_html__( 'The width of the image container in percents.', 'besocial'),
"id" => $besclwp_theme."_product_img_size",
"type" => "uislider",
"step" => 1,      
"min" => 30, 
"max" => 60,      
"std" => 45),
    
array( "name" => esc_html__( 'Placeholder Image', 'besocial'),
"desc" => '',
"id" => $besclwp_theme."_woo_placeholder",
"type" => "media",
"std" => get_template_directory_uri() ."/images/woocommerce-placeholder.png"),    
    
array( "name" => esc_html__( 'Shop page show at most', 'besocial'),
"desc" => esc_html__( 'Maximum number of the products', 'besocial'),
"id" => $besclwp_theme."_shop_at_most",
"type" => "number",
"std" => "8"),
    
array( "name" => esc_html__( 'Remove Related Products', 'besocial'),
"desc" => esc_html__( 'To remove related products from single product pages, switch on.', 'besocial'),
"id" => $besclwp_theme."_remove_related",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_html__( 'Remove Social Sharing Buttons', 'besocial'),
"desc" => esc_html__( 'There are social sharing buttons at the bottom of the single product pages. To remove them, switch on.', 'besocial'),
"id" => $besclwp_theme."_remove_product_sharing",
"type" => "checkbox",
"std" => ""),    
    
array( "type" => "close")    
);

/*---------------------------------------------------
Theme Settings Output
----------------------------------------------------*/

if ( ! function_exists( 'egemenerd_theme_settings_page' ) ) {
function egemenerd_theme_settings_page() {
if ( ! did_action( 'wp_enqueue_media' ) ){
    wp_enqueue_media();
}
 
global $egemenerd_theme_options;
$i=0;
$egemenerd_message='';
if ( 'save' == @$_REQUEST['action'] ) {

foreach ($egemenerd_theme_options as $egemenerd_value) {
    update_option( @$egemenerd_value['id'], @$_REQUEST[ $egemenerd_value['id'] ] ); 
}
 
foreach ($egemenerd_theme_options as $egemenerd_value) { 
    if ( !empty( $_REQUEST[ @$egemenerd_value['id'] ] )) {    
        if ( isset( $_REQUEST[ @$egemenerd_value['id'] ] ) ) { 
            update_option( $egemenerd_value['id'], $_REQUEST[ $egemenerd_value['id'] ]  ); 
        } else { 
            delete_option( $egemenerd_value['id'] ); 
        } 
    }
}
$egemenerd_message='saved';
}
else if( 'reset' == @$_REQUEST['action'] ) {
 
foreach ($egemenerd_theme_options as $egemenerd_value) {
    delete_option( @$egemenerd_value['id'] ); 
}
    $egemenerd_message='reset';
}
 
if ( $egemenerd_message=='saved' ) {
?>
    <div id="egemenerd-message" class="updated notice notice-success is-dismissible"><p><strong><?php echo esc_html__( 'Theme settings saved.', 'besocial'); ?></strong> <a href="<?php echo esc_url(site_url()); ?>"><?php echo esc_html__( 'View Site', 'besocial'); ?></a></p></div>
<?php
}
if ( $egemenerd_message=='reset' ) {
?>
    <div id="egemenerd-message" class="updated notice notice-success is-dismissible"><p><strong><?php echo esc_html__( 'Theme settings reset', 'besocial'); ?></strong></p></div>
<?php } ?>
<?php $egemenerd_version = wp_get_theme(); ?> 
<div id="egemenerd-panel-wrapper">
<div id="egemenerd-panel-wrapper-inner">
<div class="egemenerd_options_header">
<div class="egemenerd_options_header_left">
<h1><?php echo esc_attr($egemenerd_version->get( 'Name' )); ?> - <?php echo esc_attr($egemenerd_version->get( 'Version' )); ?></h1>    
</div>
<div class="egemenerd_options_header_right">    
<ul>
<li><a class="egemenerd-link" href="https://themeforest.net/item/besocial-buddypress-social-network-community-wordpress-theme/19514161/support?ref=egemenerd" target="_blank"><?php echo esc_attr( 'Support', 'besocial'); ?></a></li>   
<li><a class="egemenerd-link" href="http://help.wp4life.com/category/themes/besocial-wp/" target="_blank"><?php echo esc_attr( 'Knowledge Base', 'besocial'); ?></a></li>    
<li><a class="egemenerd-link primary" href="http://www.wp4life.com/online/besocial/index.html" target="_blank"><?php echo esc_attr( 'Online Help Documentation', 'besocial'); ?></a></li>
</ul>
</div>
</div>     
<div class="egemenerd_options_wrap"> 
<div>
<form id="egemenerd_form" method="post">
 
<?php foreach ($egemenerd_theme_options as $egemenerd_value) {
 
switch ( $egemenerd_value['type'] ) {
 
case "open":
break;
case "close": 
?>
</div>
</div>

<?php break; 
/*---------------------------------------------------
Title
----------------------------------------------------*/
case 'title': ?>
    <div class="egemenerd-option-title">
        <h5><?php echo esc_attr($egemenerd_value['name']); ?></h5>
    </div>
<?php break;        
/*---------------------------------------------------
CSS Editor
----------------------------------------------------*/
case 'csseditor': ?>
<?php if ( is_rtl() ) { ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($egemenerd_value['id']); ?>"><?php echo esc_attr($egemenerd_value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <textarea name="<?php echo esc_attr($egemenerd_value['id']); ?>" rows="" cols=""><?php if ( get_option( $egemenerd_value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $egemenerd_value['id']))); } else { echo esc_attr($egemenerd_value['std']); } ?></textarea>
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($egemenerd_value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>    
<?php } else { ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($egemenerd_value['id']); ?>"><?php echo esc_attr($egemenerd_value['name']); ?></label>
    </div>
    <div class="egemenerd-option-double">
            <div id="<?php echo esc_attr($egemenerd_value['id']); ?>_custom_css_container" class="egemenerd-css-editor-container">
                <div name="<?php echo esc_attr($egemenerd_value['id']); ?>" id="<?php echo esc_attr($egemenerd_value['id']); ?>" class="egemenerd-css-editor"></div>
            </div>
            <textarea id="<?php echo esc_attr($egemenerd_value['id']); ?>_css_editor" name="<?php echo esc_attr($egemenerd_value['id']); ?>" style="display: none;"><?php if ( get_option( $egemenerd_value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $egemenerd_value['id']))); } else { echo esc_attr($egemenerd_value['std']); } ?></textarea>
<script type="text/javascript">
( function( global, $ ) {
    var editor,
        syncCSS = function() {
            $( '#<?php echo esc_attr($egemenerd_value['id']); ?>_css_editor' ).val( editor.getSession().getValue() );
        },
        loadAce = function() {
            editor = ace.edit( '<?php echo esc_attr($egemenerd_value['id']); ?>' );
            global.safecss_editor = editor;
            editor.getSession().setUseWrapMode( true );
            editor.setShowPrintMargin( false );
            editor.getSession().setValue( $( '#<?php echo esc_attr($egemenerd_value['id']); ?>_css_editor' ).val() );
            editor.getSession().setMode( "ace/mode/css" );
            jQuery.fn.spin&&$( '#<?php echo esc_attr($egemenerd_value['id']); ?>_custom_css_container' ).spin( false );
            $( '#egemenerd_form' ).submit( syncCSS );
        };
    if ( $.browser.msie&&parseInt( $.browser.version, 10 ) <= 7 ) {
        $( '#<?php echo esc_attr($egemenerd_value['id']); ?>_custom_css_container' ).hide();
        $( '#<?php echo esc_attr($egemenerd_value['id']); ?>_css_editor' ).show();
        return false;
    } else {
        $( global ).load( loadAce );
    }
    global.aceSyncCSS = syncCSS;
} )( this, jQuery );    
</script>  
    </div>
    <div class="clearfix"></div>
</div> 
<?php } ?>    
<?php break;   
/*---------------------------------------------------
Link Button Field
----------------------------------------------------*/
case 'linkbutton': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($egemenerd_value['id']); ?>"><?php echo esc_attr($egemenerd_value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <a href="<?php echo esc_attr($egemenerd_value['std']); ?>" target="_blank"><?php echo esc_attr($egemenerd_value['desc']); ?></a>
    </div>
    <div class="egemenerd-option-right">
    </div>
    <div class="clearfix"></div>
</div>
<?php break;        
/*---------------------------------------------------
Text Field
----------------------------------------------------*/
case 'text': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($egemenerd_value['id']); ?>"><?php echo esc_attr($egemenerd_value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <input id="<?php echo esc_attr($egemenerd_value['id']); ?>" type="<?php echo esc_attr($egemenerd_value['type']); ?>" name="<?php echo esc_attr($egemenerd_value['id']); ?>" value="<?php if ( get_option( $egemenerd_value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $egemenerd_value['id']))); } else { echo esc_attr($egemenerd_value['std']); } ?>" />
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($egemenerd_value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
<?php break;
/*---------------------------------------------------
Multiline Text Field
----------------------------------------------------*/ 
case 'textarea': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($egemenerd_value['id']); ?>"><?php echo esc_attr($egemenerd_value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <textarea name="<?php echo esc_attr($egemenerd_value['id']); ?>" rows="" cols=""><?php if ( get_option( $egemenerd_value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $egemenerd_value['id']))); } else { echo esc_attr($egemenerd_value['std']); } ?></textarea>
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($egemenerd_value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
<?php break;        
/*---------------------------------------------------
Select Field
----------------------------------------------------*/    
case 'select': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($egemenerd_value['id']); ?>"><?php echo esc_attr($egemenerd_value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <select class="egemenerd-select" name="<?php echo esc_attr($egemenerd_value['id']); ?>" id="<?php echo esc_attr($egemenerd_value['id']); ?>">
<?php foreach ($egemenerd_value['std'] as $key => $optiontext) { ?>
<option value="<?php echo esc_attr($key); ?>" <?php if (get_option( $egemenerd_value['id'] ) == $key) { ?> selected="selected"<?php } ?>><?php echo esc_attr($optiontext); ?></option>
<?php } ?>
        </select>
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($egemenerd_value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
<?php break;  
/*---------------------------------------------------
Colorpicker Field
----------------------------------------------------*/    
case 'colorpicker': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($egemenerd_value['id']); ?>"><?php echo esc_attr($egemenerd_value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <input id="<?php echo esc_attr($egemenerd_value['id']); ?>" class="egemenerd-color" type="<?php echo esc_attr($egemenerd_value['type']); ?>" name="<?php echo esc_attr($egemenerd_value['id']); ?>" value="<?php if ( get_option( $egemenerd_value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $egemenerd_value['id']))); } else { echo esc_attr($egemenerd_value['std']); } ?>" />
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($egemenerd_value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
<?php break;
/*---------------------------------------------------
Rgba Colorpicker Field
----------------------------------------------------*/    
case 'rgbacolorpicker': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($egemenerd_value['id']); ?>"><?php echo esc_attr($egemenerd_value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <input id="<?php echo esc_attr($egemenerd_value['id']); ?>" class="egemenerd-wp-color-picker" type="<?php echo esc_attr($egemenerd_value['type']); ?>" name="<?php echo esc_attr($egemenerd_value['id']); ?>" value="<?php if ( get_option( $egemenerd_value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $egemenerd_value['id']))); } else { echo esc_attr($egemenerd_value['std']); } ?>" />
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($egemenerd_value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
<?php break;     
/*---------------------------------------------------
Number Field
----------------------------------------------------*/    
case 'number': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($egemenerd_value['id']); ?>"><?php echo esc_attr($egemenerd_value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <input id="<?php echo esc_attr($egemenerd_value['id']); ?>" type="<?php echo esc_attr($egemenerd_value['type']); ?>" onkeypress="return validate(event)" name="<?php echo esc_attr($egemenerd_value['id']); ?>" value="<?php if ( get_option( $egemenerd_value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $egemenerd_value['id']))); } else { echo esc_attr($egemenerd_value['std']); } ?>" />
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($egemenerd_value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
<?php break;
/*---------------------------------------------------
Jquery ui slider field
----------------------------------------------------*/
case 'uislider': ?>
<div class="egemenerd-slider-container">    
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($egemenerd_value['id']); ?>"><?php echo esc_attr($egemenerd_value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <div class="egemenerd-slider-field"></div>      
        <input id="<?php echo esc_attr($egemenerd_value['id']); ?>" class="egemenerd-slider-field-value" type="hidden" name="<?php echo esc_attr($egemenerd_value['id']); ?>" value="<?php if ( get_option( $egemenerd_value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $egemenerd_value['id']))); } else { echo esc_attr($egemenerd_value['std']); } ?>" readonly="readonly" data-step="<?php echo esc_attr($egemenerd_value['step']); ?>" data-start="<?php if ( get_option( $egemenerd_value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $egemenerd_value['id']))); } else { echo esc_attr($egemenerd_value['std']); } ?>" data-min="<?php echo esc_attr($egemenerd_value['min']); ?>" data-max="<?php echo esc_attr($egemenerd_value['max']); ?>" />
        <div class="egemenerd-slider-field-value-display">
            <span class="egemenerd-slider-field-value-text"></span>
        </div>
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($egemenerd_value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
</div>    
<?php break;        
/*---------------------------------------------------
Info Box
----------------------------------------------------*/    
case 'info': ?>
<div class="egemenerd_option_input">
<div class="egemenerd_info_box"><h4><i class="egemenerd-i-icon dashicons-info"></i>&nbsp;<?php echo esc_attr($egemenerd_value['name']); ?></h4></div>
<div class="clearfix"></div>
</div>
<?php break;
/*---------------------------------------------------
Info Box 2
----------------------------------------------------*/        
case 'info2': ?>
<div class="egemenerd_option_input noborder">
<div class="egemenerd_info_box"><h4><i class="egemenerd-i-icon dashicons-info"></i>&nbsp;<?php echo esc_attr($egemenerd_value['name']); ?></h4></div>
<div class="clearfix"></div>
</div>
<?php break;      
/*---------------------------------------------------
Advanced Tinymce Editor
----------------------------------------------------*/ 
case 'editor': ?>
<div class="egemenerd_option_input">
<?php wp_editor( stripslashes(get_option( $egemenerd_value['id'])), $egemenerd_value['id'], array( 'wpautop' => false, 'editor_height' => 300 )); ?> 
<div class="clearfix"></div>
<div class="egemenerd-editor-desc"><?php echo esc_attr($egemenerd_value['desc']); ?></div>
<div class="clearfix"></div>
</div>
<?php break; 
/*---------------------------------------------------
Simple Tinymce Editor
----------------------------------------------------*/    
case 'teenyeditor': ?>
<div class="egemenerd_option_input">
<?php wp_editor( stripslashes(get_option( $egemenerd_value['id'])), $egemenerd_value['id'], array( 'wpautop' => false, 'teeny' => true, 'editor_height' => 200 )); ?> 
<div class="clearfix"></div>
<div class="egemenerd-editor-desc"><?php echo esc_attr($egemenerd_value['desc']); ?></div>
<div class="clearfix"></div>
</div>
<?php break;     
/*---------------------------------------------------
Upload File Field
----------------------------------------------------*/    
case 'media': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($egemenerd_value['id']); ?>"><?php echo esc_attr($egemenerd_value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <input id="<?php echo esc_attr($egemenerd_value['id']); ?>_image" type="text" name="<?php echo esc_attr($egemenerd_value['id']); ?>" value="<?php if ( get_option( $egemenerd_value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $egemenerd_value['id']))); } else { echo esc_attr($egemenerd_value['std']); } ?>" />
        <div id="<?php echo esc_attr($egemenerd_value['id']); ?>_thumb" class="egemenerd-upload-thumb">
            <div id="<?php echo esc_attr($egemenerd_value['id']); ?>_close" class="egemenerd-thumb-close"><i class="egemenerd-i-icon dashicons-dismiss"></i></div>
            <img src="<?php if ( get_option( $egemenerd_value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $egemenerd_value['id']))); } else { echo esc_attr($egemenerd_value['std']); } ?>" alt="" />
        </div>
    </div>
    <div class="egemenerd-option-right">
        <input id="<?php echo esc_js($egemenerd_value['id']); ?>_image_button" class="egemenerd-button uploadbutton" type="button" value="<?php echo esc_js( 'Upload', 'besocial') ?>" />
<script type="text/javascript">
    jQuery("#<?php echo esc_js($egemenerd_value['id']); ?>_image").change(function() { 
        if(jQuery.trim(jQuery("#<?php echo esc_attr($egemenerd_value['id']); ?>_image").val()).length > 0)
        {
            jQuery("#<?php echo esc_js($egemenerd_value['id']); ?>_thumb").show();
            jQuery("#<?php echo esc_js($egemenerd_value['id']); ?>_thumb img").attr('src', jQuery("#<?php echo esc_attr($egemenerd_value['id']); ?>_image").val());
            jQuery("#<?php echo esc_js($egemenerd_value['id']); ?>_thumb img").error(function(){jQuery(this).attr('src', '<?php echo get_template_directory_uri(); ?>/includes/css/error.png');});
        }
        else {
            jQuery("#<?php echo esc_js($egemenerd_value['id']); ?>_thumb").hide();
        }
    });
jQuery(document).ready(function($){ 
    var inp = $("#<?php echo esc_js($egemenerd_value['id']); ?>_image").val();
    if($.trim(inp).length > 0)
    {
        $("#<?php echo esc_js($egemenerd_value['id']); ?>_thumb").show();
    }
    else {
        $("#<?php echo esc_js($egemenerd_value['id']); ?>_thumb").hide();
    }
    var custom_uploader; 
    $('#<?php echo esc_js($egemenerd_value['id']); ?>_image_button').click(function(e) { 
        e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: '<?php echo esc_js( 'Choose Image', 'besocial') ?>',
            button: {
                text: '<?php echo esc_js( 'Choose Image', 'besocial') ?>'
            },
            multiple: false
        });
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#<?php echo esc_js($egemenerd_value['id']); ?>_image').val(attachment.url);
            $("#<?php echo esc_js($egemenerd_value['id']); ?>_thumb img").attr('src', attachment.url);
            $("#<?php echo esc_js($egemenerd_value['id']); ?>_thumb").show();
        });
        custom_uploader.open(); 
    }); 
    $('#<?php echo esc_js($egemenerd_value['id']); ?>_close').click(function(e) {
        $("#<?php echo esc_js($egemenerd_value['id']); ?>_thumb").hide();
        $("#<?php echo esc_js($egemenerd_value['id']); ?>_image").val('');
    });    
});    
</script>
    </div>
<div class="clearfix"></div>
</div>
<?php break;    
/*---------------------------------------------------
Checkbox Field
----------------------------------------------------*/ 
case "checkbox": ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($egemenerd_value['id']); ?>"><?php echo esc_attr($egemenerd_value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <div id="<?php echo esc_attr($egemenerd_value['id']); ?>-toggle" class="egemenerd-toggle toggle-modern" data-toggle-on="<?php if(get_option($egemenerd_value['id'])){ echo esc_attr(get_option($egemenerd_value['id'])); } else { echo esc_attr('false'); } ?>"></div>
        <input id="<?php echo esc_attr($egemenerd_value['id']); ?>" type="checkbox" class="egemenerd-checkbox" name="<?php echo esc_attr($egemenerd_value['id']); ?>" value="true" <?php if(get_option($egemenerd_value['id'])){ ?>checked="checked"<?php } ?> />
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($egemenerd_value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#<?php echo esc_attr($egemenerd_value['id']); ?>-toggle').toggles({
            checkbox: jQuery('#<?php echo esc_attr($egemenerd_value['id']); ?>'),
            text: {
                on: '<?php echo esc_attr( 'ON', 'besocial') ?>',
                off: '<?php echo esc_attr( 'OFF', 'besocial') ?>'
            },
            width: 70,
            height: 30,
            type: 'select'
        });
    });
</script>    
</div>
<?php break;
/*---------------------------------------------------
FontAwesome
----------------------------------------------------*/    
case 'fontawesome': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($egemenerd_value['id']); ?>"><?php echo esc_attr($egemenerd_value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <div class="form-group">
            <div class="input-group">
                <input id="<?php echo esc_attr($egemenerd_value['id']); ?>" data-placement="bottomRight" class="form-control egemenerd-icon-picker" value="<?php if ( get_option( $egemenerd_value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $egemenerd_value['id']))); } else { echo esc_attr($egemenerd_value['std']); } ?>" type="text" name="<?php echo esc_attr($egemenerd_value['id']); ?>" />
                <span class="input-group-addon"></span>
            </div>
        </div>
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($egemenerd_value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>   
</div>
<?php break;          
/*---------------------------------------------------
Container
----------------------------------------------------*/ 
case "section":
$i++; ?>
<div class="egemenerd_input_section">
<div class="egemenerd_input_title">
 
<h3><i class="egemenerd-i-icon <?php echo esc_attr($egemenerd_value['icon']); ?>"></i>&nbsp;<?php echo esc_attr($egemenerd_value['name']); ?></h3>
<span class="submit"><input name="save<?php echo esc_attr($i); ?>" type="submit" value="<?php echo esc_attr( 'Save Changes', 'besocial') ?>" class="egemenerd-button" /></span>
<div class="clearfix"></div>
</div>
<div class="egemenerd_all_options">
<?php break;
 
}
} ?>
<input type="hidden" name="action" value="save" />
</form>
</div>
<div class="egemenerd-footer">
    <div class="egemenerd-footer-left">
        <a href="http://themeforest.net/user/egemenerd?ref=egemenerd" target="_blank" ><img class="egemenerd-logo" src="<?php echo get_template_directory_uri() . '/includes/css/logo.png' ?>" alt="egemenerd" /></a>
    </div>
    <div class="egemenerd-footer-right">
        <form method="post">
            <p class="submit">
                <input name="reset" type="submit" value="<?php echo esc_attr( 'Reset All Settings', 'besocial') ?>" onclick="return confirm('<?php echo esc_attr( 'Are you sure you want to reset all theme settings?', 'besocial') ?>')" class="egemenerd-link" />
                <input type="hidden" name="action" value="reset" />
            </p>
        </form>
    </div>
</div>
</div>
</div>
</div>
<?php
}
}
?>