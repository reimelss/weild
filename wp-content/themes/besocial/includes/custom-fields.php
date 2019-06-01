<?php
/* ---------------------------------------------------------
Subtitle
----------------------------------------------------------- */

function besclwp_subtitle_cmb2 ( $meta_boxes ) {
    $prefix = 'besclwp_cmb2'; // Prefix for all fields
    $meta_boxes['besclwp_subtitle'] = array(
        'id' => 'besclwp_subtitle',
        'title' => esc_html__( 'Subtitle', 'besocial'),
        'object_types' => array('page','post'), // post type
        'context' => 'normal', // normal or side
        'priority' => 'high', // default or high
        'show_names' => false, // Show field names on the left
        'fields' => array(
            array(
                'name'    => esc_html__( 'Subtitle (Optional)', 'besocial'),
                'desc'    => '',
                'id'      => $prefix . '_subtitle',
                'type'    => 'text'
            )
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'besclwp_subtitle_cmb2' ); 
    
/* ---------------------------------------------------------
Post sidebar
----------------------------------------------------------- */

function besclwp_sidebar_cmb2 ( $meta_boxes ) {
    $prefix = 'besclwp_cmb2'; // Prefix for all fields
    $meta_boxes['besclwp_sidebar'] = array(
        'id' => 'besclwp_sidebar',
        'title' => esc_html__( 'Layout', 'besocial'),
        'object_types' => array('post'), // post type
        'context' => 'side', // normal or side
        'priority' => 'high', // default or high
        'show_names' => false, // Show field names on the left
        'fields' => array(
            array(
                'name'    => esc_html__( 'Post Layout', 'besocial'),
                'desc'    => '',
                'id'      => $prefix . '_sidebar',
                'type'    => 'radio',
                'show_option_none' => false,
                'default'          => 'sidebar',
                'options'          => array(
                    'sidebar' => esc_html__( 'Sidebar', 'besocial' ),
                    'fullwidth'   => esc_html__( 'Fullwidth', 'besocial' )
                ),
            )
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'besclwp_sidebar_cmb2' );

/* ---------------------------------------------------------
Background Image
----------------------------------------------------------- */

function besclwp_bg_image_cmb2 ( $meta_boxes ) {
    $prefix = 'besclwp_cmb2'; // Prefix for all fields
    $meta_boxes['besclwp_bg_image'] = array(
        'id' => 'besclwp_bg_image',
        'title' => esc_html__( 'Background Image', 'besocial'),
        'object_types' => array('post','page'), // post type
        'context' => 'normal', // normal or side
        'priority' => 'default', // default or high
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => esc_html__( 'Background Image', 'besocial'),
                'desc' => esc_html__( 'Recommended image size is 2000x1000 px', 'besocial'),
                'id' => $prefix . '_bg_image',
                'type' => 'file'
            ),
            array(
                'name' => esc_html__( 'Image Position', 'besocial'),
                'desc' => esc_html__( 'Horizontal/Vertical', 'besocial'),
                'id' => $prefix . '_bg_img_position',
                'show_option_none' => false,
                'type' => 'select',
                'default' => 'center center',
				'options' => array(
                    'center center' => esc_html__( 'center center', 'besocial' ),
                    'center top' => esc_html__( 'center top', 'besocial' ),
                    'center bottom' => esc_html__( 'center bottom', 'besocial' ),
                    'left top' => esc_html__( 'left top', 'besocial' ),
                    'left center' => esc_html__( 'left center', 'besocial' ),
                    'left bottom' => esc_html__( 'left bottom', 'besocial' ),
                    'right top' => esc_html__( 'right top', 'besocial' ),
                    'right center' => esc_html__( 'right center', 'besocial' ),
                    'right bottom' => esc_html__( 'right bottom', 'besocial' )
				)
            )
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'besclwp_bg_image_cmb2' );  
    
/* ---------------------------------------------------------
Format: Gallery
----------------------------------------------------------- */

function besclwp_gallery_cmb2 ( $meta_boxes ) {
    $prefix = 'besclwp_cmb2'; // Prefix for all fields
    $meta_boxes['besclwp_gallery'] = array(
        'id' => 'besclwp_gallery',
        'title' => esc_html__( 'Format: Gallery', 'besocial'),
        'object_types' => array('post'), // post type
        'context' => 'normal', // normal or side
        'priority' => 'high', // default or high
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => esc_html__( 'Enable thumbnail carousel', 'besocial'),
                'desc' => esc_html__( 'Display an image carousel on masonry grid pages', 'besocial'),
                'id' => $prefix . '_display_gallery',
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_html__( 'Thumbnail size', 'besocial'),
                'desc' => esc_html__( 'Thumbnail size', 'besocial'),
                'id' => $prefix . '_thumb_size',
                'show_option_none' => false,
                'type' => 'select',
                'default' => 'besclwp-rectangle-thumbnail',
				'options' => array(
                    'besclwp-16-9-medium' => esc_html__( '1024x576px (16:9)', 'besocial' ),
                    'besclwp-16-9-large' => esc_html__( '1360x765 px (16:9)', 'besocial' ),
                    'besclwp-rectangle-thumbnail' => esc_html__( '480x360 px (4:3)', 'besocial' ),
                    'full' => esc_html__( 'Full', 'besocial' ),
                    'large' => esc_html__( 'Large', 'besocial' ),
                    'medium' => esc_html__( 'Medium', 'besocial' ),
                    'besclwp-square-thumbnail' => esc_html__( '240x240px (Square)', 'besocial' )
				)
            ),
            array(
                'name' => esc_html__( 'Maximum number of thumbnails', 'besocial'),
                'desc' => esc_html__( 'Maximum number of thumbnails you want to display on masonry grid pages.', 'besocial'),
                'id' => $prefix . '_max_gallery',
                'type' => 'egemenerd_slider',
                'min' => '1',
                'max' => '10',
                'default' => '3',
                'value_label' => esc_html__( 'Value:', 'besocial'),
            ),
            array(
                'name'    => esc_html__( 'Images', 'besocial'),
                'desc'    => '',
                'id'      => $prefix . '_gallery',
                'type' => 'file_list',
                'preview_size' => array( 80, 80 )
            )
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'besclwp_gallery_cmb2' );     

/* ---------------------------------------------------------
Format: Link
----------------------------------------------------------- */

function besclwp_link_cmb2 ( $meta_boxes ) {
    $prefix = 'besclwp_cmb2'; // Prefix for all fields
    $meta_boxes['besclwp_link'] = array(
        'id' => 'besclwp_link',
        'title' => esc_html__( 'Format: Link', 'besocial'),
        'object_types' => array('post'), // post type
        'context' => 'normal', // normal or side
        'priority' => 'high', // default or high
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name'    => esc_html__( 'Destination url', 'besocial'),
                'desc'    => esc_html__( 'This post will be redirected to this url.', 'besocial'),
                'id'      => $prefix . '_link',
                'type'    => 'text'
            ),
            array(
                'name' => esc_html__( 'Open in a new tab', 'besocial'),
                'desc' => '',
                'id' => $prefix . '_link_new_tab',
                'type' => 'checkbox'
            )
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'besclwp_link_cmb2' ); 
    
/* ---------------------------------------------------------
Format: Video
----------------------------------------------------------- */

function besclwp_video_cmb2 ( $meta_boxes ) {
    $prefix = 'besclwp_cmb2'; // Prefix for all fields
    $meta_boxes['besclwp_video'] = array(
        'id' => 'besclwp_video',
        'title' => esc_html__( 'Format: Video', 'besocial'),
        'object_types' => array('post'), // post type
        'context' => 'normal', // normal or side
        'priority' => 'high', // default or high
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => esc_html__( 'Display in masonry grid', 'besocial'),
                'desc' => '',
                'id' => $prefix . '_display_video',
                'type' => 'checkbox'
            ),
            array(
                'name'    => esc_html__( 'Video url', 'besocial'),
                'desc'    => esc_html__( 'Enter a Youtube, Vimeo, Dailymotion, Vine, VideoPress or WordPress.tv URL.', 'besocial'),
                'id'      => $prefix . '_video',
                'type'    => 'oembed'
            )
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'besclwp_video_cmb2' );  
    
/* ---------------------------------------------------------
Format: Audio
----------------------------------------------------------- */

function besclwp_audio_cmb2 ( $meta_boxes ) {
    $prefix = 'besclwp_cmb2'; // Prefix for all fields
    $meta_boxes['besclwp_audio'] = array(
        'id' => 'besclwp_audio',
        'title' => esc_html__( 'Format: Audio', 'besocial'),
        'object_types' => array('post'), // post type
        'context' => 'normal', // normal or side
        'priority' => 'high', // default or high
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name'    => esc_html__( 'Audio url', 'besocial'),
                'desc'    => esc_html__( 'Enter a Spotify or Soundcloud URL.', 'besocial'),
                'id'      => $prefix . '_audio',
                'type'    => 'oembed'
            )
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'besclwp_audio_cmb2' );     

/* ---------------------------------------------------------
Format: Image
----------------------------------------------------------- */

function besclwp_image_cmb2 ( $meta_boxes ) {
    $prefix = 'besclwp_cmb2'; // Prefix for all fields
    $meta_boxes['besclwp_image'] = array(
        'id' => 'besclwp_image',
        'title' => esc_html__( 'Format: Image', 'besocial'),
        'object_types' => array('post'), // post type
        'context' => 'normal', // normal or side
        'priority' => 'high', // default or high
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name'    => esc_html__( 'Masonry Style', 'besocial'),
                'desc'    => '',
                'id'      => $prefix . '_format_img_style',
                'type'    => 'radio',
                'show_option_none' => false,
                'default'          => 'standard',
                'options'          => array(
                    'standard' => esc_html__( 'Standard', 'besocial' ),
                    'bgimg' => esc_html__( 'Background Image', 'besocial' )
                ),
            ),
            array(
                'name' => esc_html__( 'Animated Gif', 'besocial'),
                'desc' => esc_html__( 'It will be displayed on masonry pages instead of the featured image.', 'besocial'),
                'id' => $prefix . '_animated_gif',
                'type' => 'file'
            ),
            array(
                'name'    => esc_html__( 'Single Post Image', 'besocial'),
                'desc'    => '',
                'id'      => $prefix . '_featured',
                'type'    => 'radio',
                'show_option_none' => true,
                'options'          => array(
                    'standard' => esc_html__( 'Display featured image on the single post page', 'besocial' ),
                    'gif' => esc_html__( 'Display animated gif on the single post page', 'besocial' )
                ),
            )
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'besclwp_image_cmb2' );
?>