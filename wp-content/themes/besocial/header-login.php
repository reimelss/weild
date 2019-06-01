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
    <div id="besocial-wrap" class="besocial-landing">
    <?php get_template_part( 'templates/headers/login', 'template'); ?>    
    <main id="besocial-content" class="besocial-not-fixed">
        <div id="besocial-content-inner">