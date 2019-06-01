<?php
/* ---------------------------------------------------------
bbPress enable tinymce
----------------------------------------------------------- */

function besocial_bbp_tinymce_paste_plain_text( $plugins = array() ) {
    $plugins[] = 'paste';
    return $plugins;
}
add_filter( 'bbp_get_tiny_mce_plugins', 'besocial_bbp_tinymce_paste_plain_text' );

function besocial_bbp_visual_editor( $args = array() ) {
    $besocial_bbpress_visual = get_option('besclwp_bbpress_visual');
    $besocial_bbpress_visual_teeny = '';
    $besocial_bbpress_visual_media = get_option('besclwp_bbpress_visual_media');

    if ($besocial_bbpress_visual == 'true') {
        $besocial_bbpress_visual = true;
        $besocial_bbpress_visual_teeny = true;
    } else {
        $besocial_bbpress_visual = false;
        $besocial_bbpress_visual_teeny = false;
    }

    if ($besocial_bbpress_visual_media == 'true') {
        $besocial_bbpress_visual_media = true;
    } else {
        $besocial_bbpress_visual_media = false;
    }
    
    $args['tinymce'] = $besocial_bbpress_visual;
    $args['teeny'] = $besocial_bbpress_visual_teeny;
    $args['media_buttons'] = $besocial_bbpress_visual_media;
    $args['quicktags'] = true;
    return $args;
}
add_filter( 'bbp_after_get_the_content_parse_args', 'besocial_bbp_visual_editor' );

/* ---------------------------------------------------------
bbPress Custom KSES Allowed Tags
----------------------------------------------------------- */

function besocial_bbpress_custom_kses_allowed_tags() {
	return array(
		// Links
		'a'          => array(
			'class'    => true,
			'href'     => true,
			'title'    => true,
			'rel'      => true,
			'class'    => true,
			'target'    => true,
		),
		// Quotes
		'blockquote' => array(
			'cite'     => true,
		),
		
		// Div
		'div' => array(
			'class'     => true,
		),
		
		// Span
		'span'             => array(
			'class'     => true,
		),
		
		// Code
		'code'       => array(),
		'pre'        => array(
			'class'  => true,
		),
		// Formatting
		'em'         => array(),
		'strong'     => array(),
		'del'        => array(
			'datetime' => true,
		),
		// Lists
		'ul'         => array(),
		'ol'         => array(
			'start'    => true,
		),
		'li'         => array(),
		// Images
		'img'        => array(
			'class'    => true,
			'src'      => true,
			'border'   => true,
			'alt'      => true,
			'height'   => true,
			'width'    => true,
		),
		// Tables
		'table'      => array(
			'align'    => true,
			'bgcolor'  => true,
			'border'   => true,
		),
		'tbody'      => array(
			'align'    => true,
			'valign'   => true,
		),
		'td'         => array(
			'align'    => true,
			'valign'   => true,
		),
		'tfoot'      => array(
			'align'    => true,
			'valign'   => true,
		),
		'th'         => array(
			'align'    => true,
			'valign'   => true,
		),
		'thead'      => array(
			'align'    => true,
			'valign'   => true,
		),
		'tr'         => array(
			'align'    => true,
			'valign'   => true,
		)
	);
}

add_filter( 'bbp_kses_allowed_tags', 'besocial_bbpress_custom_kses_allowed_tags' );
?>