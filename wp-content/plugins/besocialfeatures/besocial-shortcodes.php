<?php

add_shortcode('besclwpaccordioncontainer', 'besclwpaccordioncontainer');
add_shortcode('besclwpaccordion', 'besclwpaccordion');
add_shortcode('besclwptabgroup', 'besclwpjquery_tab_group');
add_shortcode('besclwpbutton', 'besclwpbutton');
add_shortcode('besclwphighlight', 'besclwphighlight');

add_filter("the_content", "besclwp_content_filter");
add_filter("widget_text", "besclwp_content_filter", 9);

function besclwp_content_filter($content) {
 
	// array of custom shortcodes requiring the fix 
	$block = join("|",array("besclwptabgroup","besclwpaccordioncontainer","besclwpaccordion","besclwpbutton","besclwphighlight","contact-form-7","recaptcha"));
 
	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		
	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
 
	return $rep;
 
}

// Highlighted Text
function besclwphighlight($atts, $content = null) {
    return '<span class="besclwp-highlight">' . esc_html($content) . '</span>';
}

// Button
function besclwpbutton($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => 'url',
        "newtab" => 'newtab',
        "besclwpbuttonstyle" => 'besclwpbuttonstyle'
	), $atts));
    if ($newtab != 'yes') {
        return '<a href="' . esc_url($url) . '" class="besocial-button ' . esc_html($besclwpbuttonstyle) . '">' . esc_html($content) . '</a>';
    }
    else
    {
        return '<a href="' . esc_url($url) . '" target="_blank" class="besocial-button ' . esc_html($besclwpbuttonstyle) . '">' . esc_html($content) . '</a>';
    }
}

// Accordion Container
function besclwpaccordioncontainer($atts, $content = null) {
    return '<div class="besclwp-accordion-container">' . do_shortcode(stripslashes($content)) . '</div>';
}

// Accordion
function besclwpaccordion($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => 'title',
        "icon" => 'icon'
	), $atts));
    if (empty($icon)) {
       return '<div class="besclwp-accordion-header"><strong>' . $title . '</strong></div><div class="besclwp-accordion-content">' . do_shortcode(stripslashes($content)) . '</div>';
    }
    else
    {
       return '<div class="besclwp-accordion-header"><strong><i class="fa fa-' . $icon . '"></i> ' . $title . '</strong></div><div class="besclwp-accordion-content">' . do_shortcode(stripslashes($content)) . '</div>';        
    }
}

// Tabs
function besclwpjquery_tab_group( $atts, $content ){
    extract(shortcode_atts(array(
        "type" => 'type'
	), $atts));
    
$GLOBALS['tab_count'] = 0;
$GLOBALS['tabs'] = array();

do_shortcode( $content );

if( is_array( $GLOBALS['tabs']) ){
$int = '1';
$random = rand();    
foreach( $GLOBALS['tabs'] as $tab ){
$tabs[] = '
    <li>'.$tab['title'].'</li>
';
$panes[] = '
<div>
'.do_shortcode($tab['content']).'

</div>
';
$int++;
}
$return = "\n".'

<div class="besclwp-tabs"><div id="tabs-'.$random.'">'."\n".'
<ul class="resp-tabs-list">'.implode( "\n", $tabs ).'</ul>
<div class="resp-tabs-container">'."\n".' '.implode( "\n", $panes ).'

</div></div><div class="clear"></div></div>
<script type="text/javascript">jQuery(document).ready(function() { jQuery("#tabs-'.$random.'").easyResponsiveTabs({type: "'.$type.'", width: "auto", fit: true,activate: function () { if (jQuery(window).width() > 768) {jQuery("#tabs-'.$random.'").find(".resp-tab-content").addClass("animatedfast fadeIn");setTimeout(function () {jQuery("#tabs-'.$random.'").find(".resp-tab-content").removeClass("animatedfast fadeIn");}, 400);}}});});</script>
'."\n";
}

return $return;
}

add_shortcode( 'besclwptab', 'besclwpjquery_tab' );

function besclwpjquery_tab( $atts, $content ){
extract(shortcode_atts(array(
'title' => 'Tab %d'
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' => $content );

$GLOBALS['tab_count']++;
}
?>