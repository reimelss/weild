<?php
if ( !defined('ABSPATH')) exit;


if ( ! function_exists( 'besclwp_theme_setup' ) ) {
    function besclwp_theme_setup() {
        
        /* Translations */
        load_theme_textdomain( 'besocial', get_template_directory() .'/languages' );
        $besclwp_locale = get_locale();
        $besclwp_locale_file = get_template_directory() ."/languages/$besclwp_locale.php";
        if ( is_readable($besclwp_locale_file) ) {
	       require_once($besclwp_locale_file);
        }
        
        /* Add theme support */
        add_theme_support( 'menus' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'woocommerce' );
        add_theme_support('buddypress-use-legacy');
        $besclwp_bg = array(
            'default-color' => 'f1f1f1'
        );
        add_theme_support( 'custom-background', $besclwp_bg );
        add_theme_support( 'post-formats', array('gallery', 'link', 'image', 'quote', 'video', 'audio'));
        
        /* Add tinymce editor style */
        add_editor_style();
        
        /* Register Menus */
        register_nav_menus(
            array(
                'besclwp-main-menu' => esc_html__( 'Main Menu for Logged-in users', 'besocial' ),
                'besclwp-sub-menu' => esc_html__( 'Main Menu for Logged-out users', 'besocial' )
            )
        );
        
    }
}
add_action( 'after_setup_theme', 'besclwp_theme_setup' );

/*---------------------------------------------------
Content Width
----------------------------------------------------*/
if ( ! isset( $content_width ) ) {
    $content_width = 1320;
}

/*---------------------------------------------------
Add a body class
----------------------------------------------------*/

if ( ! function_exists( 'besclwp_body_classes' ) ) {
function besclwp_body_classes( $classes ) {
    $classes[] = 'besocial';    
    return $classes;    
}
}
add_filter( 'body_class','besclwp_body_classes' );

/*---------------------------------------------------
Wrap category widget post count in a span
----------------------------------------------------*/
if ( ! function_exists( 'besclwp_cat_count_span' ) ) {
function besclwp_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span>', $links);
  $links = str_replace(')', '</span>', $links);
  return $links;
}
}
add_filter('wp_list_categories', 'besclwp_cat_count_span');

/*---------------------------------------------------
Create a wrapper and add provider name to the class
----------------------------------------------------*/
if ( ! function_exists( 'besclwp_oembed_wrapper' ) ) {
function besclwp_oembed_wrapper($return, $data, $url) {
    $return = str_replace( array('frameborder="0"', 'webkitallowfullscreen', 'mozallowfullscreen'),'', $return );
    return "<div class='besclwp-iframe-outer'><div class='besclwp-iframe $data->provider_name'>{$return}</div></div>";
}
}
add_filter('oembed_dataparse','besclwp_oembed_wrapper',10,3);

/*---------------------------------------------------
Custom image sizes
----------------------------------------------------*/
if ( ! function_exists( 'besclwp_image_sizes' ) ) {
    add_image_size( 'besclwp-rectangle-thumbnail', 480, 360, true);   
    function besclwp_image_sizes($besclwpsizes) {
        $besclwpaddsizes = array(
            "besclwp-rectangle-thumbnail" => esc_html__( 'Rectangle Thumbnail', 'besocial')
        );
        $besclwpnewsizes = array_merge($besclwpsizes, $besclwpaddsizes);
        return $besclwpnewsizes;
}    
}
add_filter('image_size_names_choose', 'besclwp_image_sizes');

/*---------------------------------------------------
Custom category field (Select Layout)
----------------------------------------------------*/

// Category list

function besclwp_category_column( $columns )
{
	$columns['besclwpcatlayout'] = esc_html__('Layout', 'besocial');

	return $columns;
}
add_filter('manage_edit-category_columns' , 'besclwp_category_column');

function besclwp_category_column_content( $content, $column_name, $term_id )
{
    if ( 'besclwpcatlayout' == $column_name ) {
        $term_meta = get_option( "category_besclwpcatlayout_$term_id" );
        if (!empty($term_meta)) {
            $content = '<img class="besclwp-cat-img" src="' . get_template_directory_uri() . '/images/' . $term_meta . '.png" />';
        }
        else {
            $content = '<img class="besclwp-cat-img" src="' . get_template_directory_uri() . '/images/twocolumnssidebar.png" />';
        }
    }
	return $content;
}
add_filter( 'manage_category_custom_column', 'besclwp_category_column_content', 10, 3 );

// Edit category

add_action( 'category_edit_form_fields', 'besclwp_category_edit_fields', 10, 2 );

function besclwp_category_edit_fields($tag) {
    $t_id = $tag->term_id;
    $term_meta = get_option( "category_besclwpcatlayout_$t_id" );
?>  
   
<tr class="form-field">
    <th scope="row"> 
        <label for="besclwpcatlayout_id"><?php esc_html_e('Layout', 'besocial'); ?></label>  
    </th>
    <td>
        <select name="besclwpcatlayout" id="besclwpcatlayout">
            <option value="twocolumnssidebar" <?php if (($term_meta == 'twocolumnssidebar') || (empty($term_meta))) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Two Columns + Sidebar', 'besocial'); ?></option>
            <option value="twocolumns" <?php if ($term_meta == 'twocolumns') { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Two Columns', 'besocial'); ?></option>
            <option value="threecolumns" <?php if ($term_meta == 'threecolumns') { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Three Columns', 'besocial'); ?></option>
            <option value="fourcolumns" <?php if ($term_meta == 'fourcolumns') { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Four Columns', 'besocial'); ?></option>
        </select>
    </td>
</tr>  
   
<?php                
}

// Add category

add_action( 'category_add_form_fields', 'besclwp_category_add_fields', 10, 2 );

function besclwp_category_add_fields($tag) {
    $t_id = isset($tag->term_id); 
    $term_meta = get_option( "category_besclwpcatlayout_$t_id" );
?>  
   
<div class="form-field">
    <label><?php esc_html_e('Layout', 'besocial'); ?></label>
    <select name="besclwpcatlayout" id="besclwpcatlayout">
        <option value="twocolumnssidebar" <?php if (($term_meta == 'twocolumnssidebar') || (empty($term_meta))) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Two Columns + Sidebar', 'besocial'); ?></option>
        <option value="twocolumns" <?php if ($term_meta == 'twocolumns') { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Two Columns', 'besocial'); ?></option>
        <option value="threecolumns" <?php if ($term_meta == 'threecolumns') { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Three Columns', 'besocial'); ?></option>
        <option value="fourcolumns" <?php if ($term_meta == 'fourcolumns') { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Four Columns', 'besocial'); ?></option>
    </select>
</div>
   
<?php  
}  

// Save Custom Field Of Category Form
add_action( 'created_category', 'besclwp_category_save', 10, 2 );   
add_action( 'edited_category', 'besclwp_category_save', 10, 2 );
  
function besclwp_category_save( $term_id ) {
  
    if ( isset( $_POST['besclwpcatlayout'] ) ) {            
        $besclwp_cat_option_name = 'category_besclwpcatlayout_' . $term_id;
        update_option( $besclwp_cat_option_name, $_POST['besclwpcatlayout'] );
    }
}

// Hide admin bar on login page template.
function besclwp_hide_admin_bar($bool) {
    if ( is_page_template( 'custom_login_page.php' ) ) {
        return false;
    } else {
        return $bool;
    }
}
add_filter('show_admin_bar', 'besclwp_hide_admin_bar');

/*---------------------------------------------------
Stylesheets
----------------------------------------------------*/

if ( ! function_exists( 'besclwp_theme_styles' ) ) {
function besclwp_theme_styles()  
{  
    $besclwp_sharing_css_check = get_option('besclwp_remove_sharing');
    $besclwp_lightbox_css_check = get_option('besclwp_lightbox');
    $besclwp_post_format_css_check = get_post_format();
    
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css', true, '1.0');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', false, '4.6.3');
    wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick.css', false, '4.6.3');
    if (empty($besclwp_sharing_css_check) && ($besclwp_sharing_css_check != 'true') && is_single()) {
        wp_enqueue_style('rrssb', get_template_directory_uri() . '/css/rrssb.css', false, '4.6.3');
    }
    if (empty($besclwp_lightbox_css_check) && ($besclwp_lightbox_css_check != 'true') && ($besclwp_post_format_css_check == 'gallery')) {
        wp_enqueue_style('featherlight', get_template_directory_uri() . '/css/featherlight.css', false, '1.5.0');
    }
    wp_enqueue_style('selectric', get_template_directory_uri() . '/css/selectric.css', false, '1.11.0');
    wp_enqueue_style('besclwp-style', get_stylesheet_directory_uri() . '/style.css', false, '1.0');
}
}
add_action('wp_enqueue_scripts', 'besclwp_theme_styles', 0);

/*---------------------------------------------------
javascript files
----------------------------------------------------*/

if ( ! function_exists( 'besclwp_script_register' ) ) {
function besclwp_script_register() {
    $besclwp_sticky_sidebar_check = get_option('besclwp_sticky');
    $besclwp_post_format_check = get_post_format();
    $besclwp_related_check = get_option('besclwp_activate_related');
    $besclwp_lightbox_js_check = get_option('besclwp_lightbox');
    $besclwp_sharing_js_check = get_option('besclwp_remove_sharing');
    $besclwp_fb_check = get_option('besclwp_activate_fb_comments');
    $besclwp_enable_live_notification = get_option('besclwp_enable_live_notification');
    
    wp_enqueue_script('html5shiv', get_template_directory_uri() . '/js/html5.js', '', '3.7.0', false );
    wp_script_add_data('html5shiv', 'conditional', 'lt IE 9' );
    if (is_single() && ($besclwp_fb_check == 'true')) {
        wp_enqueue_script('besclwp-fb-comments', get_template_directory_uri() . '/js/facebook-comments.js', '', '1.0.0', false );
        $besclwp_fb_id = esc_js(get_option('besclwp_fb_id'));
        $besclwp_fb_language = get_locale();       
        $besclwp_fb_param = array(
            "besclwp_fb_id" => !empty($besclwp_fb_id) ? $besclwp_fb_id : '',
            "besclwp_fb_language" => !empty($besclwp_fb_language) ? $besclwp_fb_language : 'en_US'
        );
        wp_localize_script('besclwp-fb-comments', 'besclwp_fb_vars', $besclwp_fb_param);
    }
    wp_enqueue_script('salvattore', get_template_directory_uri() . '/js/salvattore.min.js', array( 'jquery' ), '1.0.9', true );
    if (empty($besclwp_sticky_sidebar_check) && ($besclwp_sticky_sidebar_check != 'true')) {
        wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script('besclwp-custom-sticky', get_template_directory_uri() . '/js/theia-custom.js', array( 'jquery' ), '1.0.0', true );
        
        $besclwp_sticky_breakpoint = esc_js(get_option('besclwp_sticky_breakpoint'));
        $besclwp_sticky_top = esc_js(get_option('besclwp_sticky_top'));
        $besclwp_sticky_bottom = esc_js(get_option('besclwp_sticky_bottom'));
        $besclwp_sticky_behavior = esc_js(get_option('besclwp_sticky_behavior'));
        $besclwp_sticky_masonry_behavior = esc_js(get_option('besclwp_sticky_masonry_behavior'));
        $besclwp_sticky_builder_behavior = esc_js(get_option('besclwp_sticky_builder_behavior'));
        
        $besclwp_sticky_param = array(
            "besclwp_sticky_breakpoint" => !empty($besclwp_sticky_breakpoint) ? $besclwp_sticky_breakpoint : '0',
            "besclwp_sticky_top" => !empty($besclwp_sticky_top) ? $besclwp_sticky_top : '40',
            "besclwp_sticky_bottom" => !empty($besclwp_sticky_bottom) ? $besclwp_sticky_bottom : '0',
            "besclwp_sticky_behavior" => !empty($besclwp_sticky_behavior) ? $besclwp_sticky_behavior : 'stick-to-top'
        );
        wp_localize_script('besclwp-custom-sticky', 'besclwp_sticky_vars', $besclwp_sticky_param);
    }
    wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick/slick.min.js', array( 'jquery' ), '1.0.9', true );
    
    if (empty($besclwp_sharing_js_check) && ($besclwp_sharing_js_check != 'true') && is_single()) {
        wp_enqueue_script('rrssb', get_template_directory_uri() . '/js/rrssb.min.js', array( 'jquery' ), '1.0.9', true );
    }
    
    if ( $besclwp_post_format_check == 'gallery' ) {
        if(!is_rtl()) {
            wp_enqueue_script('besclwp-format-gallery', get_template_directory_uri() . '/js/slick/format-gallery.js', array( 'jquery' ), '1.0', true );
        }
        else {
            wp_enqueue_script('besclwp-format-gallery-rtl', get_template_directory_uri() . '/js/slick/format-gallery-rtl.js', array( 'jquery' ), '1.0', true );
        }
    }
    
    if ( (is_single()) && ($besclwp_related_check == 'true') ) {
        if(!is_rtl()) {
            wp_enqueue_script('besclwp-related-posts', get_template_directory_uri() . '/js/slick/related-posts.js', array( 'jquery' ), '1.0', true );
        }
        else {
            wp_enqueue_script('besclwp-related-posts-rtl', get_template_directory_uri() . '/js/slick/related-posts-rtl.js', array( 'jquery' ), '1.0', true );
        }
    }
    
    if(!is_rtl()) {
        wp_enqueue_script('besclwp-gallery-carousel', get_template_directory_uri() . '/js/slick/gallery-carousel.js', array( 'jquery' ), '1.0', true );
    }
    else {
        wp_enqueue_script('besclwp-gallery-carousel-rtl', get_template_directory_uri() . '/js/slick/gallery-carousel-rtl.js', array( 'jquery' ), '1.0', true );
    }
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( "comment-reply" );
    }
    
    if (empty($besclwp_lightbox_js_check) && ($besclwp_lightbox_js_check != 'true') && ($besclwp_post_format_check == 'gallery')) {
        wp_enqueue_script('featherlight', get_template_directory_uri() . '/js/featherlight.js', array( 'jquery' ), '1.5.0', true );
    }
    
    wp_enqueue_script('selectric', get_template_directory_uri() . '/js/selectric.js', array( 'jquery' ), '1.0.0', true );
    
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        if ((is_cart()) || (is_checkout())) {
            wp_dequeue_script('selectric');
        }
        else {
            wp_dequeue_style( 'select2' );
            wp_deregister_style( 'select2' );
            wp_dequeue_script( 'select2');
            wp_deregister_script('select2');
        }
    }
    
    if (!empty($besclwp_enable_live_notification) && ($besclwp_enable_live_notification == 'true')) {
        wp_enqueue_script( 'heartbeat' );
        wp_enqueue_script('besocial-live-notifications', get_template_directory_uri() . '/js/live-notifications.js', array( 'heartbeat' ), '1.0.0', true );
    }
    
    wp_enqueue_script('besclwp-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0.0', true );
}
}
add_action( 'wp_enqueue_scripts', 'besclwp_script_register' );

/*---------------------------------------------------
Admin files
----------------------------------------------------*/

if ( ! function_exists( 'besclwp_theme_admin_scripts' ) ) {
function besclwp_theme_admin_scripts(){
    wp_enqueue_style('besclwp_theme_admin_style', get_template_directory_uri() . '/includes/css/admin-general.css', false, '1.0');
    wp_enqueue_script('besclwp_theme_admin_script', get_template_directory_uri() . '/includes/js/admin-general.js', array( 'jquery' ), '1.0', true );
}
}
add_action( 'admin_enqueue_scripts', 'besclwp_theme_admin_scripts' );

/*---------------------------------------------------
Custom styles - Theme Settings
----------------------------------------------------*/

if ( ! function_exists( 'besclwp_print_styles' ) ) {
    function besclwp_print_styles()
    {
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            if(!is_rtl()) {
                wp_enqueue_style('besclwp-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', false, '1.0');
            } else {
                wp_enqueue_style('besclwp-woocommerce', get_template_directory_uri() . '/css/woocommerce-rtl.css', false, '1.0');
            }
        }
        wp_enqueue_style('besclwp-custom', get_stylesheet_directory_uri() . '/css/custom.css', false, '1.0'); 
        
        $besclwp_fontfamily = str_replace("'", '', get_option('besclwp_fontfamily'));
        $besclwp_fontfamily_important = str_replace(";", ' !important;', $besclwp_fontfamily);
        $besclwp_h1size = esc_attr(get_option('besclwp_h1'));
        $besclwp_h2size = esc_attr(get_option('besclwp_h2'));
        $besclwp_h3size = esc_attr(get_option('besclwp_h3'));
        $besclwp_h4size = esc_attr(get_option('besclwp_h4'));
        $besclwp_h5size = esc_attr(get_option('besclwp_h5'));
        $besclwp_h6size = esc_attr(get_option('besclwp_h6'));
        $besclwp_psize = esc_attr(get_option('besclwp_p'));
        $besclwp_smallsize = esc_attr(get_option('besclwp_small'));
        $besclwp_xsmallsize = esc_attr(get_option('besclwp_xsmall'));       
        $besclwp_1_color = esc_attr(get_option('besclwp_1_color'));
        $besclwp_2_color = esc_attr(get_option('besclwp_2_color'));
        $besclwp_3_color = esc_attr(get_option('besclwp_3_color'));
        $besclwp_4_color = esc_attr(get_option('besclwp_4_color'));
        $besclwp_5_color = esc_attr(get_option('besclwp_5_color'));
        $besclwp_6_color = esc_attr(get_option('besclwp_6_color'));
        $besclwp_7_color = esc_attr(get_option('besclwp_7_color')); 
        $besclwp_8_color = esc_attr(get_option('besclwp_8_color')); 
        $besclwp_custom_css = esc_attr(get_option( 'besclwp_customcode' ));
        $besclwp_custom_loading = esc_url(get_option( 'besclwp_custom_loading' ));
        $besclwp_mf_loading = esc_url(get_option( 'besclwp_mfloader' ));
        $besclwp_loading_bg_color = esc_attr(get_option( 'besclwp_loading_bg_color' ));
        $besclwp_spinner_color = esc_attr(get_option( 'besclwp_spinner_color' ));
        $besclwp_dropdown_size = esc_attr(get_option('besclwp_dropdown_size'));
        $besclwp_inline_style = '';
    
    if ( is_admin_bar_showing() ) {
        $besclwp_inline_style .= '#besocial-header-fixed,#besocial-icon-menu,#besocial-sidemenu > li .sidemenu-sub {top: 32px;}#besocial-icon-menu,#besocial-sidemenu > li .sidemenu-sub > li.pull-down > a {padding-bottom:32px;}@media screen and (max-width: 782px){#besocial-header-fixed,#besocial-icon-menu,#besocial-sidemenu > li .sidemenu-sub {top: 46px;}}@media screen and (max-width: 600px){#besocial-header-fixed {top: 0px;position:absolute;}#besocial-icon-menu,#besocial-sidemenu > li .sidemenu-sub {top: 0px;}}';
        
        if ((!empty($besclwp_3_color)) && ($besclwp_3_color != '#3e6990')) {
            $besclwp_inline_style .= '#wpadminbar,#wpadminbar .ab-sub-wrapper{background: ' . $besclwp_3_color . ' !important;}';
        }
        
        if ((!empty($besclwp_1_color)) && ($besclwp_1_color != '#2c3d55')) {
            $besclwp_inline_style .= '#wpadminbar .ab-sub-wrapper,#wpadminbar .ab-item:hover{background: ' . $besclwp_1_color . ' !important;}';
        }
        
        if ((!empty($besclwp_2_color)) && ($besclwp_2_color != '#324661')) {
            $besclwp_inline_style .= '#wpadminbar .quicklinks .menupop ul.ab-sub-secondary, #wpadminbar .quicklinks .menupop ul.ab-sub-secondary .ab-submenu,.mejs-container, .mejs-container .mejs-controls, .mejs-embed, .mejs-embed body {background: ' . $besclwp_2_color . ' !important;}';
        }
        
        if ((!empty($besclwp_7_color)) && ($besclwp_7_color != '#ffffff')) {
            $besclwp_inline_style .= '#wpadminbar .ab-item,#wpadminbar .ab-item:before,#wpadminbar .ab-icon:before,#wpadminbar .ab-label,#wpadminbar .ab-icon,#wpadminbar .quicklinks li#wp-admin-bar-bp-notifications #ab-pending-notifications {color:' . $besclwp_7_color . ' !important;}';
        }
        
        if ((!empty($besclwp_4_color)) && ($besclwp_4_color != '#427aa1')) {
            $besclwp_inline_style .= '#wpadminbar .quicklinks li#wp-admin-bar-bp-notifications #ab-pending-notifications, #wpadminbar .quicklinks li#wp-admin-bar-my-account a span.count, #wpadminbar .quicklinks li#wp-admin-bar-my-account-with-avatar a span.count,#wpadminbar .quicklinks li#wp-admin-bar-bp-notifications #ab-pending-notifications.alert {background:' . $besclwp_4_color . ' !important;}';
        }
    }
        
    if (!empty($besclwp_custom_loading)) {
        $besclwp_inline_style .= '#besocial-loading-overlay { background-image: url("' . $besclwp_custom_loading . '"); }';
    }
        
    if ((!empty($besclwp_loading_bg_color)) && ($besclwp_loading_bg_color != '#f1f1f1')) {
        $besclwp_inline_style .= '#besocial-loading-overlay { background-color:' . $besclwp_loading_bg_color . '; }';
    } 
        
    if ((!empty($besclwp_spinner_color)) && ($besclwp_spinner_color != '#427aa1')) {
        $besclwp_inline_style .= '#besocial-loading-animation .spinner > div { background-color:' . $besclwp_spinner_color . '; }';
    } 
        
    if (!empty($besclwp_mf_loading)) {
        $besclwp_inline_style .= 'body.besocial .bmf-spinner { background-image: url("' . $besclwp_mf_loading . '"); }';
    }
        
    if (!empty($besclwp_fontfamily)) {
        $besclwp_inline_style .= 'body,p { ' . stripslashes(esc_attr($besclwp_fontfamily)) . ' }';
        $besclwp_inline_style .= '#wpadminbar *:not([class="ab-icon"]) { ' . stripslashes(esc_attr($besclwp_fontfamily_important)) . ' }';
    }   
        
    if ((!empty($besclwp_psize)) && ($besclwp_psize != '16')) {
        $besclwp_inline_style .= 'body,p,#header-menu .besclwp-nav,.besclwp-page-title.besclwp-page-quote-title .besclwp-subtitle span,.tab-with-posts h6 a { font-size:' . $besclwp_psize . 'px; }@media only screen and (max-width: 480px) {body,p,#header-menu .besclwp-nav,.besclwp-page-title.besclwp-page-quote-title .besclwp-subtitle span,.tab-with-posts h6 a {font-size: ' . ($besclwp_psize - 2) . 'px;}}';
    } 
        
    if ((!empty($besclwp_smallsize)) && ($besclwp_smallsize != '14')) {
        $besclwp_inline_style .= '.besclwp-page-title .besclwp-post-cat-tags span,.besclwp-single-post-tags,.besclwp-format-quote p.besclwp-cite,.besclwp_comment_links a,.besclwp_comment_links,.widget_rss ul li .rssSummary,#wp-calendar tbody td,.footer-credits,.besclwp-post-slider-tags span,.besclwp_comments_rss,.tribe-events-loop .tribe-events-event-meta,.single-tribe_events a.tribe-events-ical,.single-tribe_events a.tribe-events-ical:hover,.single-tribe_events a.tribe-events-gcal,.single-tribe_events a.tribe-events-gcal:hover,.single-tribe_events .tribe-events-event-meta,.tribe-events-tooltip p.entry-summary { font-size:' . $besclwp_smallsize . 'px; }@media only screen and (max-width: 480px) {.besclwp-page-title .besclwp-post-cat-tags span,.besclwp-single-post-tags,.besclwp-format-quote p.besclwp-cite,.besclwp_comment_links a,.besclwp_comment_links,.widget_rss ul li .rssSummary,#wp-calendar tbody td,.footer-credits,.besclwp-post-slider-tags span,.besclwp_comments_rss,.tribe-events-loop .tribe-events-event-meta,.single-tribe_events a.tribe-events-ical,.single-tribe_events a.tribe-events-ical:hover,.single-tribe_events a.tribe-events-gcal,.single-tribe_events a.tribe-events-gcal:hover,.single-tribe_events .tribe-events-event-meta,.tribe-events-tooltip p.entry-summary { font-size:' . ($besclwp_smallsize - 2) . 'px; }}';
    }
        
    if ((!empty($besclwp_xsmallsize)) && ($besclwp_xsmallsize != '12')) {
        $besclwp_inline_style .= '.besclwp-post-cat-tags span,.besclwp-article-box .besclwp-post-date,.besclwp-article-list-right .besclwp-post-date a,.besclwp-xs-article-box .besclwp-format-quote p.besclwp-cite,.widget_recent_entries ul li span.post-date,.widget_categories ul li span,#wp-calendar caption,#wp-calendar thead,#wp-calendar tfoot #next,#wp-calendar tfoot #prev,.tribe-events-tooltip .tribe-events-event-body { font-size:' . $besclwp_xsmallsize . 'px; }';
    }        
        
    if ((!empty($besclwp_h1size)) && ($besclwp_h1size != '32')) {
        $besclwp_inline_style .= 'h1,#besocial-header-left span,#buddypress div#item-header-cover-image .user-nicename a, #buddypress div#item-header-cover-image .user-nicename,.besclwp-slider-title span,.single-tribe_events h1.tribe-events-single-event-title { font-size:' . $besclwp_h1size . 'px; }@media only screen and (max-width: 480px) {h1,#besocial-header-left span,#buddypress div#item-header-cover-image .user-nicename a, #buddypress div#item-header-cover-image .user-nicename,.besclwp-slider-title span,.single-tribe_events h1.tribe-events-single-event-title { font-size:' . ($besclwp_h1size - 6) . 'px; }}';
    } 
        
    if ((!empty($besclwp_h2size)) && ($besclwp_h2size != '28')) {
        $besclwp_inline_style .= 'h2,#header-menu .besclwp-toggle-menu,h2.tribe-events-page-title,#tribe-geo-results h2.tribe-events-page-title,.tribe-events-list-separator-year,.single-tribe_events h2.tribe-events-single-event-title,.tribe-events-list .type-tribe_events h2 { font-size:' . $besclwp_h2size . 'px; }@media only screen and (max-width: 480px) {h2,#header-menu .besclwp-toggle-menu,h2.tribe-events-page-title,#tribe-geo-results h2.tribe-events-page-title,.tribe-events-list-separator-year,.single-tribe_events h2.tribe-events-single-event-title,.tribe-events-list .type-tribe_events h2 { font-size:' . ($besclwp_h2size - 4) . 'px; }}';
    } 
        
    if ((!empty($besclwp_h3size)) && ($besclwp_h3size != '24')) {
        $besclwp_inline_style .= 'h3,.besclwp-subtitle,.besclwp-format-quote p,.besclwp-slider-subtitle span,.tribe-events-list-separator-month,.sow-features-feature h5,#buddypress .bboss-results-wrap h2.results-group-title { font-size:' . $besclwp_h3size . 'px; }@media only screen and (max-width: 480px) {h3,.besclwp-subtitle,.besclwp-format-quote p,.tribe-events-list-separator-month,.sow-features-feature h5,#buddypress .bboss-results-wrap h2.results-group-title { font-size:' . ($besclwp_h3size - 2) . 'px; }}';
    } 
        
    if ((!empty($besclwp_h4size)) && ($besclwp_h4size != '22')) {
        $besclwp_inline_style .= 'h4,.tribe-events-day .tribe-events-day-time-slot h5,.besclwp-post-carousel-overlay p { font-size:' . $besclwp_h4size . 'px; }@media only screen and (max-width: 480px) {h4,.tribe-events-day .tribe-events-day-time-slot h5,.besclwp-post-carousel-overlay p { font-size:' . ($besclwp_h4size - 2) . 'px; }}';
    } 
        
    if ((!empty($besclwp_h5size)) && ($besclwp_h5size != '20')) {
        $besclwp_inline_style .= 'h5,blockquote p,.besocial-topbar-searchbox input[type="text"].besocial-topbar-searchtext,.besclwp-404-container p,.besclwp-xs-article-box .besclwp-format-quote p,.resp-tabs-list li,.besocial-car-img span { font-size:' . $besclwp_h5size . 'px; }@media only screen and (max-width: 480px) {h5,blockquote p,.besocial-topbar-searchbox input[type="text"].besocial-topbar-searchtext,.besclwp-404-container p,.besclwp-xs-article-box .besclwp-format-quote p,.resp-tabs-list li,.besocial-car-img span,.besclwp-post-carousel-overlay p,.besclwp-slider-subtitle span { font-size:' . ($besclwp_h5size - 2) . 'px; }}';
    } 
        
    if ((!empty($besclwp_h6size)) && ($besclwp_h6size != '18')) {
        $besclwp_inline_style .= 'h6,.single-tribe_events .tribe-events-schedule h3,.tribe-events-meta-group .tribe-events-single-section-title,#tribe-events-content .tribe-events-tooltip h4,span.tribe-event-date-start,span.tribe-event-date-end,.besclwp-testimonial-center p,.single-tribe_events .tribe-events-schedule h2 { font-size:' . $besclwp_h6size . 'px; }@media only screen and (max-width: 480px) {h6,.single-tribe_events .tribe-events-schedule h3,.tribe-events-meta-group .tribe-events-single-section-title,#tribe-events-content .tribe-events-tooltip h4,span.tribe-event-date-start,span.tribe-event-date-end,.besclwp-testimonial-center p,.single-tribe_events .tribe-events-schedule h2 { font-size:' . ($besclwp_h6size - 2) . 'px; }}';
    }   
        
    if ((!empty($besclwp_dropdown_size)) && ($besclwp_dropdown_size != '15')) {
        $besclwp_inline_style .= '#header-menu .besclwp-nav ul { width:' . $besclwp_dropdown_size . 'em; }';
    }   
        
    if ((!empty($besclwp_1_color)) && ($besclwp_1_color != '#2c3d55')) {
        $besclwp_inline_style .= 'h1,h2,h3,h4,h5,h6,.besclwp-single-post-date,a,.slick-dots li button:before,.resp-tabs-list li,#bbpress-forums fieldset.bbp-form legend,.besocial-p-dislike.besocial-p-dislike-active,.besocial-p-dislike:hover,.besocial-p-dislike-comment.besocial-p-dislike-active-comment,.besocial-p-dislike-comment:hover,input[type="text"]:focus,input[type="search"]:focus,input[type="email"]:focus,input[type="number"]:focus,input[type="date"]:focus,input[type="password"]:focus,input[type="url"]:focus,textarea:focus,input[type="tel"]:focus,.besocial-button.besclwp-light,.besocial-button.besclwp-light:hover,#tribe-events-content .tribe-events-tooltip h4,#tribe_events_filters_wrapper .tribe_events_slider_val,.single-tribe_events a.tribe-events-ical,.single-tribe_events a.tribe-events-gcal { color:' . $besclwp_1_color . '; }';
        $besclwp_inline_style .= '#besocial-icon-menu,#header-menu .besclwp-nav li ul,#header-menu .besclwp-nav > li:hover,#header-menu .besclwp-nav > li:focus,#header-menu .besclwp-nav > li:active,#footer-info-fullwidth,#footer .tagcloud a,#footer a[class^="tag"],#footer .besclwp-accordion-header, #footer .besclwp-accordion-content,#footer .slick-dots,#footer .resp-tabs-list li:hover,#footer .resp-tabs-list li.resp-tab-active,#footer .resp-tabs-container,#footer .resp-tab-active,#footer .resp-vtabs .resp-tabs-list li:hover,#footer .resp-vtabs .resp-tabs-list li.resp-tab-active,#footer .besclwp-article-list-img,#footer .besclwp-article-list-right,#footer .widget_mc4wp_form_widget,.besclwp-post-slider-tags span.besclwp-post-slider-date,#footer .selectric { background-color:' . $besclwp_1_color . '; }@media only screen and (max-width: 700px) {.besclwp-footer-icon a:hover:before { background:' . $besclwp_1_color . '; }}';
        $besclwp_inline_style .= '#footer .selectric {border-color:' . $besclwp_1_color . ';}';
    }
        
    if ((!empty($besclwp_2_color)) && ($besclwp_2_color != '#324661')) {
        $besclwp_inline_style .= '#besocial-sidemenu > li:hover,#besocial-sidemenu > li.active,#besocial-sidemenu > li .sidemenu-sub,#footer,.besclwp-footer-icon a:hover:before,#bbpress-forums #bbp-your-profile fieldset span.description { background-color:' . $besclwp_2_color . '; }';
        $besclwp_inline_style .= '#besocial-sidemenu > li > a { box-shadow: inset 0 -1px 0 ' . $besclwp_2_color . '; }';
        $besclwp_inline_style .= '.besclwp-footer-icon a,.footer-credits { box-shadow: inset -1px 0 0 ' . $besclwp_2_color . '; }';
        $besclwp_inline_style .= '@media only screen and (max-width: 700px) {.footer-credits {border-bottom:1px solid ' . $besclwp_2_color . ';}}';
    }
        
    if ((!empty($besclwp_3_color)) && ($besclwp_3_color != '#3e6990')) {
        $besclwp_inline_style .= 'input[type="submit"]:hover,.besocial-button:hover,button[type="submit"]:hover,input[type="button"]:hover,#besocial-sidemenu > li:first-child,#besocial-header-right,.besocial-topbar-searchbox input[type="submit"],.besocial-topbar-searchbox input[type="text"].besocial-topbar-searchtext,#bbpress-forums div.bbp-forum-header,#bbpress-forums div.bbp-topic-header,.selectric-items li.highlighted,.selectric-items li:hover,.selectric-items li.selected,.besocial-car-img:after,.tribe-events-read-more:hover,.tribe-events-button:hover,#tribe-bar-form .tribe-bar-submit input[type=submit]:hover,#tribe_events_filters_wrapper input[type=submit]:hover,.tribe-events-button.tribe-active:hover,.tribe-events-calendar thead th,.besclwp-view-more a:hover { background:' . $besclwp_3_color . '; }';
        $besclwp_inline_style .= '#besocial-icon-menu-toggle {border:5px solid ' . $besclwp_3_color . ';}';
    }
        
    if ((!empty($besclwp_4_color)) && ($besclwp_4_color != '#427aa1')) {
        $besclwp_inline_style .= 'a:hover,.besclwp-highlight,#besocial-sidemenu > li > a,.besclwp-post-cat-tags span a:hover,.besclwp-post-date a:hover,.widget_recent_entries ul li a:hover,.widget_categories ul li a:hover,.widget_recent_comments ul li a:hover,.widget_pages ul li a:hover,.widget_meta ul li a:hover,.widget_archive ul li a:hover,.widget_archives ul li a:hover,.widget_recent-posts ul li a:hover,.widget_rss ul li a:hover,.widget_nav_menu div ul > li a:hover,.recentcomments a:hover,.besclwp-footer-icon a:before,.bbp-header #subscription-toggle a,#subscription-toggle,.widget_display_forums ul li a:hover,.widget_display_views ul li a:hover,.widget_display_stats ul li a:hover,.widget_display_replies ul li a:hover,.widget_display_topics ul li a:hover,.besocial-p-like.besocial-p-like-active,.besocial-p-like:hover,.besocial-p-like-comment:hover,.besocial-p-like-comment.besocial-p-like-active-comment,.widget_mc4wp_form_widget:after,code,pre { color:' . $besclwp_4_color . '; }';
        $besclwp_inline_style .= 'input[type="submit"],.besocial-button,button[type="submit"],input[type="button"],#header-menu .besclwp-nav > li,.besclwp-format-img-box,.widget_categories ul li span,.besclwp-post-slider-tags span,#bbpress-forums li.bbp-header,#subscription-toggle,.widget_display_stats ul li strong,#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a,.selectric-items,.tb-close-icon,.besclwp-statistics-icon-inner,.besclwp-faq-cat-title span,.besocial-faq-menu ul li.besocial-faq-title,.besocial-faq-menu li a span,span.besclwp-page-title-count,.tribe-events-read-more,.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"],.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"] > a,#tribe_events_filters_wrapper input[type=submit],.tribe-events-button,#tribe-events .tribe-events-button,.tribe-events-button.tribe-inactive,#tribe-bar-form .tribe-bar-submit input[type=submit],#tribe-events .tribe-events-button:hover,.tribe-events-button.tribe-active:hover,.tribe-events-day .tribe-events-day-time-slot h5,#besocial-icon-menu-toggle,.single-tribe_events .tribe-events-schedule .tribe-events-cost,.besclwp-view-more a { background:' . $besclwp_4_color . '; }';
        $besclwp_inline_style .= '#besocial-sidemenu > li[data-count="0"] > a > .icon-count,#besocial-sidemenu > li[data-count="0"] .icon-count-list,#besocial-sidemenu > li .icon-count-list.default-blue,#besocial-sidemenu > li .sidemenu-sub h5 span,#besocial-header-outer,.besclwp-format-icon:after,.slick-arrow,.slick-arrow:hover,.slick-arrow:active,.slick-arrow:focus,.featherlight .featherlight-close-icon,.besclwp-lightbox-icon,.bbp-row-actions #favorite-toggle a:hover,.bbp-row-actions #favorite-toggle span.is-favorite a,.bbp-row-actions #favorite-toggle span.is-favorite a:hover,.bbp-row-actions #subscription-toggle a,.bbp-row-actions #subscription-toggle a:hover,.bbp-row-actions #favorite-toggle a,.bbp-row-actions #subscription-toggle a,.besclwp_comments_block h3 span,.besocial-car-img { background-color:' . $besclwp_4_color . '; }';
        $besclwp_inline_style .= '.besclwp-page-title { border-left:7px solid ' . $besclwp_4_color . '; }';
        $besclwp_inline_style .= '.besclwp-widget-title { border-left:5px solid ' . $besclwp_4_color . '; }';
        $besclwp_inline_style .= 'div.bbp-template-notice,div.indicator-hint,div.bbp-template-notice.info,#besclwp-no-results-message,.besocial-faq-menu ul li.besocial-faq-title,.tribe-events-notices { border-left:3px solid ' . $besclwp_4_color . '; }';
        $besclwp_inline_style .= '.featherlight-loading .featherlight-content {border-left-color:' . $besclwp_4_color . ';}';
        $besclwp_inline_style .= '.selectric-focus .selectric,.selectric-open .selectric,div.wpcf7-mail-sent-ok, div.wpcf7-mail-sent-ng, div.wpcf7-spam-blocked, div.wpcf7-validation-errors {border-color: ' . $besclwp_4_color . ';}';
        $besclwp_inline_style .= '.selectric-hover .selectric .button:after {border-top-color: ' . $besclwp_4_color . ';}';
        $besclwp_inline_style .= '@media only screen and (max-width: 1170px) { #header-menu .besclwp-nav > li:hover,#header-menu .besclwp-nav > li:focus,#header-menu .besclwp-nav > li:active {background-color:' . $besclwp_4_color . ';}}';
        $besclwp_inline_style .= '#tribe-bar-form input[type=text]:focus{border-bottom:1px solid ' . $besclwp_4_color . '}';  
        $besclwp_inline_style .= '.post.sticky { border-top:5px solid ' . $besclwp_4_color . '; }';
    }    
        
    if ((!empty($besclwp_5_color)) && ($besclwp_5_color != '#6b717e')) {
        $besclwp_inline_style .= 'body,p,.tagcloud a,a[class^="tag"],.besclwp_comment_links a,.besclwp_comment_links,.besclwp-post-cat-tags span a,.besclwp-post-date a,.besclwp-subtitle,.widget_recent_entries ul li a,.widget_categories ul li a,.widget_recent_comments ul li a,.widget_pages ul li a,.widget_meta ul li a,.widget_archive ul li a,.widget_archives ul li a,.widget_recent-posts ul li a,.widget_rss ul li a,.widget_nav_menu div ul > li a,.recentcomments a,.widget_display_forums ul li a,.widget_display_views ul li a,.widget_display_stats ul li a,.widget_display_replies ul li a,.widget_display_topics ul li a,.besocial-p-like,.besocial-p-dislike,.besocial-p-like-comment,.besocial-p-dislike-comment,#bbpress-forums div.bbp-meta a,input[type="text"],input[type="email"],input[type="number"],input[type="date"],input[type="password"],input[type="url"],input[type="tel"],input[type="search"],textarea,.tribe-events-calendar div[id*="tribe-events-daynum-"],.tribe-events-calendar div[id*="tribe-events-daynum-"] a,.tribe-events-calendar div[id*="tribe-events-daynum-"] a:hover,.tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"],.tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"] > a,.tab-with-posts h6 a,body.besocial .bboss_ajax_search_item .item .item-desc { color:' . $besclwp_5_color . '; }';
    } 
        
    if ((!empty($besclwp_6_color)) && ($besclwp_6_color != '#f1f1f1')) {
        $besclwp_inline_style .= 'body,code,pre,.tagcloud a,a[class^="tag"],#wp-calendar tbody td,.besclwp-post-content .besclwp-accordion-header,.besclwp-post-content .besclwp-accordion-content,.besclwp-post-content .besclwp-article-box .besclwp-article-content,.besclwp-post-content .resp-tabs-list li:hover,.besclwp-post-content .resp-tabs-list li.resp-tab-active,.besclwp-post-content .resp-tabs-container,.besclwp-post-content .resp-tab-active,.besclwp-post-content .resp-vtabs .resp-tabs-list li:hover,.besclwp-post-content .resp-vtabs .resp-tabs-list li.resp-tab-active,#bbpress-forums div.bbp-the-content-wrapper input,#bbpress-forums #bbp-single-user-details #bbp-user-navigation a,hr,#tribe-bar-form,#tribe-bar-collapse-toggle,.tribe-events-notices,.single-tribe_events .tribe-events-event-meta,.tribe-events-calendar div[id*="tribe-events-daynum-"],.tribe-events-calendar div[id*="tribe-events-daynum-"] a,.tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"],.tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"] > a,div.wpcf7-mail-sent-ok,div.wpcf7-mail-sent-ng,div.wpcf7-spam-blocked,div.wpcf7-validation-errors,div.besocial-p-like,div.besocial-p-like-comment,div.besocial-p-dislike,div.besocial-p-dislike-comment,.besclwp-page-links { background-color:' . $besclwp_6_color . '; }';
        $besclwp_inline_style .= 'body.besocial .bb-global-search-ac li.bbls-category,body.besocial .bb-global-search-ac.ui-menu .ui-menu-item:last-child,body.besocial .bb-global-search-ac.ui-menu .ui-menu-item.ui-state-hover:last-child,body.besocial .bb-global-search-ac.ui-menu .ui-menu-item.ui-state-focus:last-child { background:' . $besclwp_6_color . ' !important; }';
        $besclwp_inline_style .= 'blockquote {border-left:5px solid ' . $besclwp_6_color . ';}';
        $besclwp_inline_style .= '.widget_nav_menu div ul ul {border-left:3px solid ' . $besclwp_6_color . ';}';
        $besclwp_inline_style .= '#bbpress-forums li.bbp-body ul.forum,#bbpress-forums li.bbp-body ul.topic,.single-tribe_events #tribe-events-footer,.tribe-events-day #tribe-events-footer,.events-list #tribe-events-footer,.tribe-events-map #tribe-events-footer,.tribe-events-photo #tribe-events-footer {border-top:1px solid ' . $besclwp_6_color . ';}';
        $besclwp_inline_style .= '#bbpress-forums .bbp-user-section {border-top:5px solid ' . $besclwp_6_color . ';}';
        $besclwp_inline_style .= '#bbpress-forums #bbp-single-user-details #bbp-user-avatar img.avatar {border:5px solid ' . $besclwp_6_color . ';}';
        $besclwp_inline_style .= '#bbp-user-body ul.bbp-lead-topic,#bbp-user-body ul.bbp-topics,#bbp-user-body ul.bbp-forums,#bbp-user-body ul.bbp-replies,#bbp-user-body ul.bbp-search-results,#tribe-events-content .tribe-events-calendar td,.bboss_search_results_wrapper .besclwp-article-list,.bboss_search_page .besclwp_comment,.besocial-global-search-box {border:1px solid ' . $besclwp_6_color . ';}';
        $besclwp_inline_style .= 'input[type="text"],input[type="email"],input[type="number"],input[type="date"],input[type="password"],input[type="url"],input[type="tel"],input[type="search"],textarea,.selectric {border:3px solid ' . $besclwp_6_color . ';}';
        $besclwp_inline_style .= '.widget_recent_entries ul li,.widget_categories ul li,.widget_recent_comments ul li,.widget_pages ul li,.widget_meta ul li,.widget_archive ul li,.widget_archives ul li,.widget_recent-posts ul li,.widget_rss ul li,.widget_nav_menu div ul > li,.recentcomments,.widget_display_forums ul li,.widget_display_views ul li,.widget_display_stats ul li,.widget_display_replies ul li,.widget_display_topics ul li,.besclwp-statistics,.besclwp-post-top-bar,.besclwp-testimonial,body.besocial .tribe-events-list .type-tribe_events,.tribe-events-list-separator-month:after,#tribe-events-content table.tribe-events-calendar,body.besocial .bb-global-search-ac li:not(.bbls-category) .bboss_ajax_search_item {border-bottom:1px solid ' . $besclwp_6_color . ';}';
        $besclwp_inline_style .= '.besclwp-share-buttons {border-top:3px solid ' . $besclwp_6_color . ';}';
        $besclwp_inline_style .= '.besclwp-testimonial.testimonial-left .besclwp-testimonial-left img {border-bottom: 15px solid ' . $besclwp_6_color . ';border-right: 15px solid ' . $besclwp_6_color . ';}';
        $besclwp_inline_style .= '.besclwp-testimonial.testimonial-right .besclwp-testimonial-left img {border-bottom: 15px solid ' . $besclwp_6_color . ';border-left: 15px solid ' . $besclwp_6_color . ';}';
    }
        
    if ((!empty($besclwp_7_color)) && ($besclwp_7_color != '#ffffff')) {
        $besclwp_inline_style .= 'input[type="submit"],.besocial-button,button[type="submit"],input[type="button"],.besocial-button:hover,button[type="submit"]:hover,input[type="button"]:hover,#besocial-sidemenu > li > a:hover,#besocial-sidemenu > li.active > a,#besocial-sidemenu > li:first-child > a,#besocial-sidemenu > li:first-child > a,#besocial-sidemenu > li .icon-count,#besocial-sidemenu .icon-count-list,#besocial-sidemenu > li .sidemenu-sub h5 span,#besocial-sidemenu > li .sidemenu-sub > li > a:hover,#besocial-sidemenu > li .sidemenu-sub h5,#besocial-header-left span,#besocial-header-left a,#besocial-header-right,.besocial-topbar-searchbox input[type="submit"],.besocial-topbar-searchbox input[type="text"].besocial-topbar-searchtext,#header-menu .besclwp-toggle-menu,#header-menu .besclwp-toggle-menu,#header-menu .besclwp-toggle-menu:hover,#header-menu .besclwp-nav a,#header-menu .besclwp-nav > .activelink > a,#header-menu .besclwp-nav li a:hover,#header-menu .besclwp-nav li li .parent:after,#header-menu .besclwp-nav li .parent:after,.besclwp-format-icon:after,.besclwp-format-img-content h3,.widget_categories ul li span,#footer h1,#footer h2,#footer h3,#footer h4,#footer h5,#footer a:hover,.besclwp-footer-icon a:hover:before,.slick-arrow,.slick-arrow:hover,.slick-arrow:active,.slick-arrow:focus,.featherlight .featherlight-close-icon,.besclwp-lightbox-icon,.besclwp-post-slider-tags span,.besclwp-post-slider-tags span a,#footer .resp-tabs-list li,#bbpress-forums li.bbp-header,#bbpress-forums li.bbp-header a,#bbpress-forums div.bbp-forum-title h3,#bbpress-forums div.bbp-forum-title h3 a,#bbpress-forums div.bbp-topic-title h3,#bbpress-forums div.bbp-topic-title h3 a,#bbpress-forums div.bbp-reply-title h3,#bbpress-forums div.bbp-reply-title h3 a,#bbpress-forums li.bbp-header a,#subscription-toggle a,#subscription-toggle,.bbp-row-actions #favorite-toggle a,.bbp-row-actions #subscription-toggle a,.bbp-row-actions #favorite-toggle a:hover,.bbp-row-actions #favorite-toggle span.is-favorite a,.bbp-row-actions #favorite-toggle span.is-favorite a:hover,.bbp-row-actions #subscription-toggle a,.bbp-row-actions #subscription-toggle a:hover,#bbpress-forums #bbp-your-profile fieldset span.description,.widget_display_stats ul li strong,#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a,.selectric-items li,.besclwp-statistics-icon span,.besclwp_comments_block h3 span,.wp-social-login-provider,.wp-social-login-provider:hover,#besocial-header-login-profile,#besocial-header-login-profile a,.besocial-car-img span,.besclwp-faq-cat-title span,.besocial-faq-menu li a span,.besocial-faq-menu ul li.besocial-faq-title,span.besclwp-page-title-count,.tribe-events-read-more,.tribe-events-read-more:hover,.tribe-events-button.tribe-inactive,.tribe-events-button:hover,#tribe-events .tribe-events-button:hover,.tribe-events-button.tribe-active:hover,.tribe-events-day .tribe-events-day-time-slot h5,.tribe-events-calendar thead th,#footer a.besocial-button,#besocial-icon-menu-toggle,.single-tribe_events .tribe-events-schedule .tribe-events-cost,.besclwp-view-more a { color:' . $besclwp_7_color . '; }';
        $besclwp_inline_style .= '.tb-close-icon,.tb-close-icon:before,#buddypress .bboss_search_page div.item-list-tabs ul li.active a { color:' . $besclwp_7_color . ' !important; }';
        $besclwp_inline_style .= 'input[type="text"],input[type="email"],input[type="number"],input[type="tel"],input[type="date"],input[type="password"],input[type="url"],input[type="search"],textarea,.besclwp-article-content,.besclwp-page-title,.besclwp-pager,.besclwp-accordion-header,.besclwp-accordion-content,.slick-dots,.besclwp-article-list-row,.besclwp-article-list-img,.besclwp-widget-title,div.bbp-breadcrumb,#bbpress-forums div.bbp-topic-tags p,.bbp-pagination-links a,.bbp-pagination-links span.current,div.bbp-template-notice,div.indicator-hint,.selectric,.besocial-button.besclwp-light,.besocial-button.besclwp-light:hover,#breadcrumbs,.besclwp-faq-cat-title,#besclwp-no-results-message,.besocial-faq-menu li,#buddypress #whats-new-form #message p { background:' . $besclwp_7_color . '; }';
        $besclwp_inline_style .= '.besclwp-post-content,.besclwp_comment_form,.besclwp-format-video-wrapper,.besclwp-sidebar-box,.besclwp-single-post-nav,.besclwp_comments_block,.besclwp-author-box,.besclwp-post-slider,.slick-dots.besclwp-gallery-dots,.slick-dots.besclwp-slider-dots,.besclwp-post-format-gallery,#besclwp-gallery-slider,.besclwp-format-gallery-carousel,.besclwp-post-slider,.featherlight .featherlight-content,.resp-tabs-list li:hover,.resp-tabs-list li.resp-tab-active,.resp-tabs-container,.resp-tab-active,.resp-vtabs .resp-tabs-list li:hover,.resp-vtabs .resp-tabs-list li.resp-tab-active,#bbpress-forums div.even,#bbpress-forums div.odd,#bbpress-forums ul.even,#bbpress-forums ul.odd,body.topic-edit .bbp-topic-form div.avatar img,body.reply-edit .bbp-reply-form div.avatar img,body.single-forum .bbp-topic-form div.avatar img,body.single-reply .bbp-reply-form div.avatar img,#bbpress-forums div.bbp-the-content-wrapper div.quicktags-toolbar,#besclwp-facebook-comments,.widget_mc4wp_form_widget,.tribe-events-list-separator-month span,.tribe-events-calendar .tribe-events-tooltip,.tribe-events-week .tribe-events-tooltip,.tribe-events-shortcode.view-week .tribe-events-tooltip,.recurring-info-tooltip,body.besocial .bb-global-search-ac.ui-autocomplete { background-color:' . $besclwp_7_color . '; }';
        $besclwp_inline_style .= '.besclwp-sidebar-box.widget_search.widget_search .besocial-searchbox input[type="text"].besocial-searchtext,#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content { border: 3px solid ' . $besclwp_7_color . '; }';
        $besclwp_inline_style .= '.besocial-faq-menu li {border-left: 3px solid ' . $besclwp_7_color . '; }';
        $besclwp_inline_style .= '.tagcloud .besclwp-tag-count { border-left: 1px solid ' . $besclwp_7_color . '; }';
        $besclwp_inline_style .= '#bbpress-forums #bbp-single-user-details #bbp-user-navigation a,#tribe-bar-form input[type=text] { border-bottom: 1px solid ' . $besclwp_7_color . '; }';
        $besclwp_inline_style .= '#wp-calendar tbody td {border: 1px solid ' . $besclwp_7_color . ';}';
        $besclwp_inline_style .= '.bbp-topic-form,.bbp-reply-form,.bbp-topic-tag-form {border-top: 1px solid ' . $besclwp_7_color . ';}';
        $besclwp_inline_style .= '.featherlight-loading .featherlight-content {border-top-color: ' . $besclwp_7_color . ';border-bottom-color: ' . $besclwp_7_color . ';border-right-color: ' . $besclwp_7_color . ';}';
    }    
        
    if ((!empty($besclwp_8_color)) && ($besclwp_8_color != '#bfbdc1')) {
        $besclwp_inline_style .= '#besocial-sidemenu > li .sidemenu-sub > li > a,#header-menu .besclwp-nav ul a,#footer,#footer a,#footer p,#footer .slick-dots li button:before,#besocial-sidemenu > li .sidemenu-sub > li > p { color:' . $besclwp_8_color . '; }';
    }    

    if (!empty($besclwp_custom_css)) {
        $besclwp_inline_style .= $besclwp_custom_css;
    }
        wp_add_inline_style( 'besclwp-custom', $besclwp_inline_style );
}
}
add_action('wp_enqueue_scripts', 'besclwp_print_styles', 99);

/*---------------------------------------------------
Register Sidebars
----------------------------------------------------*/

if ( ! function_exists( 'besclwp_sidebars_widgets_init' ) ) {
function besclwp_sidebars_widgets_init() {
    register_sidebar( array(
        'name' => esc_html__( 'Main Sidebar', 'besocial'),
        'id' => 'besclwpsidebar',
        'description' => esc_html__( 'Main Sidebar Widget Field.', 'besocial' ),
        'before_widget' => '<div id="%1$s" class="%2$s besclwp-sidebar-box">',
        'after_widget' => "</div>",
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    register_sidebar( array(
        'name' => esc_html__( 'Woocommerce Sidebar', 'besocial'),
        'id' => 'besclwpwoosidebar',
        'description' => esc_html__( 'Woocommerce Sidebar Widget Field.', 'besocial' ),
        'before_widget' => '<div id="%1$s" class="%2$s besclwp-sidebar-box">',
        'after_widget' => "</div>",
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    )); 
    register_sidebar( array(
        'name' => esc_html__( 'Footer', 'besocial'),
        'id' => 'besclwpfooterwidgets',
        'description' => esc_html__( 'You can use SiteOrigin Layout Builder Widget to create columns for your widgets.', 'besocial' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    
    register_sidebar( array(
        'name' => esc_html__( 'User Profile', 'besocial'),
        'id' => 'besclwpuserprofile',
        'description' => esc_html__( 'User Profile Sidebar Widget Field', 'besocial' ),
        'before_widget' => '<div id="%1$s" class="%2$s besclwp-sidebar-box-2">',
        'after_widget' => "</div>",
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    
    register_sidebar( array(
        'name' => esc_html__( 'User Profile (Mobile View)', 'besocial'),
        'id' => 'besclwpusermobile',
        'description' => esc_html__( 'You can use SiteOrigin Layout Builder Widget to create columns for your widgets.', 'besocial' ),
        'before_widget' => '<div id="%1$s" class="%2$s besclwp-sidebar-box-2">',
        'after_widget' => "</div>",
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    
    register_sidebar( array(
        'name' => esc_html__( 'Single Group', 'besocial'),
        'id' => 'besclwpgroupwidgets',
        'description' => esc_html__( 'User Profile Sidebar Widget Field', 'besocial' ),
        'before_widget' => '<div id="%1$s" class="%2$s besclwp-sidebar-box-2">',
        'after_widget' => "</div>",
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    
    register_sidebar( array(
        'name' => esc_html__( 'Single Group (Mobile View)', 'besocial'),
        'id' => 'besclwpgroupmobile',
        'description' => esc_html__( 'You can use SiteOrigin Layout Builder Widget to create columns for your widgets.', 'besocial' ),
        'before_widget' => '<div id="%1$s" class="%2$s besclwp-sidebar-box-2">',
        'after_widget' => "</div>",
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
}
add_action( 'widgets_init', 'besclwp_sidebars_widgets_init' );

/*---------------------------------------------------
custom excerpt dots
----------------------------------------------------*/

if ( ! function_exists( 'besclwp_excerpt_read_more' ) ) {
function besclwp_excerpt_read_more( $more ) {
	return '...';
}
}
add_filter('excerpt_more', 'besclwp_excerpt_read_more');

/*---------------------------------------------------
custom tag cloud
----------------------------------------------------*/
if ( ! function_exists( 'besclwp_wp_generate_tag_cloud' ) ) {
function besclwp_wp_generate_tag_cloud($content, $tags, $args)
{ 
    if ( ! is_admin() ) {
        $count=0;
        $output=preg_replace_callback('(</a\s*>)', function($match) use ($tags, &$count) {
            return "<span class=\"besclwp-tag-count\">".$tags[$count++]->count."</span></a>";  
        }, $content);
    } else {
        $output = $content;
    }
  return $output;    
}
}
add_filter('wp_generate_tag_cloud','besclwp_wp_generate_tag_cloud', 10, 3);

if ( ! function_exists( 'besclwp_tag_cloud_args' ) ) {
    function besclwp_tag_cloud_args($args) {
        $besclwp_args = array('smallest' => 14, 'largest' => 14, 'orderby' => 'count','unit' => 'px','order' => 'DESC');
        $args = wp_parse_args( $args, $besclwp_args );
        return $args;
    }
}
add_filter('widget_tag_cloud_args','besclwp_tag_cloud_args');

/*---------------------------------------------------
Custom comments
----------------------------------------------------*/
if ( ! function_exists( 'besclwp_comment' ) ) {
function besclwp_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">      
    <div id="comment-<?php comment_ID(); ?>" class="besclwp_comments"> 
        <?php if ($comment->comment_approved == '0') : ?>
        <em><?php echo esc_attr('Your comment is awaiting moderation.', 'besocial'); ?></em>
        <br />
        <?php endif; ?> 
        <div class="besclwp_comment">
            <div class="besclwp_comment_inner">
                <div class="besclwp_comment_left">
                    <?php echo get_avatar( $comment, 60 ); ?> 
                </div>
                <div class="besclwp_comment_right">
                    <div class="besclwp_comment_right_inner">
                    <cite class="besclwp_fn"><?php printf(esc_attr('%s'), get_comment_author_link()) ?></cite>
                    <div class="besclwp_comment_text">
                        <?php comment_text(); ?>
                        <?php
    if ( function_exists( 'besocial_render_for_comments' ) ) {
        besocial_render_for_comments(); 
    }
                        ?>
                    </div>
                    <div class="besclwp_comment_links">
                        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><i class="fa fa-clock-o"></i> <?php printf(esc_html__('%1$s at %2$s', 'besocial'), get_comment_date(),  get_comment_time()) ?></a> - <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?><?php edit_comment_link(esc_html__('(Edit)', 'besocial'),'  ','') ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}          
}

/* ---------------------------------------------------------
WSL plugin FontAwesome icons
----------------------------------------------------------- */
function besclwp_wsl_use_fontawesome_icons( $provider_id, $provider_name, $authenticate_url )
{
?>
<a rel="nofollow" href="<?php echo esc_url($authenticate_url); ?>" data-provider="<?php echo esc_attr($provider_id); ?>" class="wp-social-login-provider wp-social-login-provider-<?php echo strtolower( esc_attr($provider_id) ); ?>">
    <span>
        <i class="fa fa-<?php echo strtolower( esc_attr($provider_id) ); ?>"></i><?php echo esc_attr($provider_name); ?>
    </span>
</a>
<?php
}
  
add_filter( 'wsl_render_auth_widget_alter_provider_icon_markup', 'besclwp_wsl_use_fontawesome_icons', 10, 3 );

/* ---------------------------------------------------------
Pagination
----------------------------------------------------------- */

if ( ! function_exists( 'besocial_pagination' ) ) {
function besocial_pagination() { ?>
    <div class="besclwp-pager"> 
    <?php 
    global $wp_query;
    $big = 999999999; // This needs to be an unlikely integer
    $besocial_paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'prev_next' => true,
        'prev_text' => '<i class="fa fa-chevron-left"></i>',
        'next_text' => '<i class="fa fa-chevron-right"></i>',
        'type' => 'list'
    ));    
    echo wp_kses_post($besocial_paginate_links);    
?>
</div>
<?php }
}

if ( ! function_exists( 'besocial_custom_pagination' ) ) {
function besocial_custom_pagination($besocial_custom_query) { ?>
    <div class="besclwp-pager"> 
    <?php 
    global $wp_query;
    $big = 999999999; // This needs to be an unlikely integer
    $besocial_paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
        'current' => max( 1, get_query_var('paged') ),
        'total' => $besocial_custom_query->max_num_pages,
        'prev_next' => true,
        'prev_text' => '<i class="fa fa-chevron-left"></i>',
        'next_text' => '<i class="fa fa-chevron-right"></i>',
        'type' => 'list'
    ));    
    echo wp_kses_post($besocial_paginate_links);    
?>
</div>
<?php }
}

/* ---------------------------------------------------------
Count pending posts
----------------------------------------------------------- */

if ( ! function_exists( 'besocial_count_pending_posts' ) ) {
function besocial_count_pending_posts( $userid ) 
{
    $args = array(
        'numberposts'   => -1,
        'post_type'     => 'post',
        'post_status'   => 'pending',
        'author'        => $userid
    );
    $count_posts = count( get_posts( $args ) ); 
    return $count_posts;
}
}

/* ---------------------------------------------------------
Add class to Mailchimp for WordPress form
----------------------------------------------------------- */
add_filter( 'mc4wp_form_css_classes', function( $classes ) { 
	$classes[] = 'besclwp-mailchimp';
	return $classes;
});

/* ---------------------------------------------------------
TGM Activation Class
----------------------------------------------------------- */

require_once(get_template_directory() . '/includes/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'besclwp_register_required_plugins' );

function besclwp_register_required_plugins() {
	$besclwp_plugins = array(
		array(
			'name'     				=> esc_html__( 'Besocial Features', 'besocial'),
			'slug'     				=> 'besocialfeatures',
			'source'   				=> get_template_directory_uri() . '/plugins/besocialfeatures.zip',
			'required' 				=> true,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),
        array(
			'name'     				=> esc_html__( 'Besocial Rating System', 'besocial'),
			'slug'     				=> 'besocial-rating-system',
			'source'   				=> get_template_directory_uri() . '/plugins/besocial-rating-system.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),
        array(
			'name'     				=> esc_html__( 'Theme My Login', 'besocial'),
			'slug'     				=> 'theme-my-login',
			'source'   				=> get_template_directory_uri() . '/plugins/theme-my-login.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),
        array(
			'name'     				=> esc_html__( 'Classic Editor', 'besocial'),
			'slug'     				=> 'classic-editor',
			'required' 				=> true,
		),
        array(
			'name'     				=> esc_html__( 'CMB2', 'besocial'),
			'slug'     				=> 'cmb2',
			'required' 				=> true,
		),
        array(
			'name'     				=> esc_html__( 'BuddyPress', 'besocial'),
			'slug'     				=> 'buddypress',
			'required' 				=> true,
		),
        array(
			'name'     				=> esc_html__( 'bbPress', 'besocial'),
			'slug'     				=> 'bbpress',
			'required' 				=> true,
		),
        array(
			'name'     				=> esc_html__( 'Siteorigin Panels', 'besocial'),
			'slug'     				=> 'siteorigin-panels',
			'required' 				=> true,
		),
        array(
			'name'     				=> esc_html__( 'SiteOrigin Widgets Bundle', 'besocial'),
			'slug'     				=> 'so-widgets-bundle',
			'required' 				=> true,
		),
        array(
			'name'     				=> esc_html__( 'BP Profile Search', 'besocial'),
			'slug'     				=> 'bp-profile-search',
			'required' 				=> true,
		),
        array(
			'name'     				=> esc_html__( 'BuddyPress Global Search', 'besocial'),
			'slug'     				=> 'buddypress-global-search',
			'required' 				=> false,
		),
        array(
			'name'     				=> esc_html__( 'Contact Form 7', 'besocial'),
			'slug'     				=> 'contact-form-7',
			'required' 				=> false,
		)
	);

	$besclwp_config = array(
        'id'           => 'besocial',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $besclwp_plugins, $besclwp_config );

}

function besocial_tml_remove_update_notifications( $value ) {

    if ( isset( $value ) && is_object( $value ) ) {
        unset( $value->response[ 'theme-my-login/theme-my-login.php' ] );
    }

    return $value;
}
add_filter( 'site_transient_update_plugins', 'besocial_tml_remove_update_notifications' );
?>