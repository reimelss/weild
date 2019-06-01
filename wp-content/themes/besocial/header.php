<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
// Allow only correct Google web font tags
$besclwp_webfontcode = wp_kses(get_option('besclwp_webfontcode'), array('link' => array('href' => array(),'rel' => array(),'type' => array())));

if (!empty($besclwp_webfontcode)) {
    echo str_replace("&amp;", '&', stripslashes($besclwp_webfontcode));
}   
?>    
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php $besocial_loading = get_option('besclwp_loading'); ?>
    <?php $besocial_custom_loading = get_option('besclwp_custom_loading'); ?>
    <?php if ($besocial_loading == 'true') { ?>
    <div id="besocial-loading-overlay">
        <?php if (empty($besocial_custom_loading)) { ?>
        <div id="besocial-loading-animation">
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <?php $besclwp_icon_menu = get_option('besclwp_icon_menu'); ?>
    <div id="besocial-wrap" <?php if (( !is_user_logged_in() ) || (!function_exists('bp_is_active')) || ($besclwp_icon_menu == 'true')) { ?>class="besocial-logout"<?php } ?>>
        <?php
        if ((empty($besclwp_icon_menu)) || ($besclwp_icon_menu != 'true')) {
            if (( is_user_logged_in()) && (function_exists('bp_is_active'))) {
                get_template_part( 'templates/iconmenu/loggedin', 'template');
            }
        }
        ?>
        <?php
        $besclwp_fixed_header = get_option('besclwp_fixed_header');
        if ((empty($besclwp_fixed_header)) || ($besclwp_fixed_header != 'true')) {
            get_template_part( 'templates/headers/fixed', 'template');
        } else {
            get_template_part( 'templates/headers/relative', 'template');
        } ?>
    <main id="besocial-content" class="<?php if ($besclwp_fixed_header == 'true') { echo esc_html('besocial-not-fixed'); } ?> <?php if ($besclwp_icon_menu == 'true') { echo esc_html('besocial-no-icon'); } ?>">
    <div id="besocial-content-inner">