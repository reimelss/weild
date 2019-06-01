<?php
/* ----------------------------------------------------------
Add Widget Collection
------------------------------------------------------------- */
function add_besclwp_widgets_collection($folders){
	$folders[] = plugin_dir_path(__FILE__).'so-widgets/';
	return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'add_besclwp_widgets_collection');

/* ----------------------------------------------------------
Activate Widgets
------------------------------------------------------------- */
function besclwp_filter_active_widgets($active){
    $active['besclwp-slider'] = true;
    $active['besclwp-masonry'] = true;
    $active['besclwp-list'] = true;
    $active['besclwp-carousel'] = true;
    $active['besclwp-list-carousel'] = true;
    $active['besclwp-accordion'] = true;
    $active['besclwp-tabs'] = true;
    $active['besclwp-post-tabs'] = true;
    $active['besclwp-video'] = true;
    $active['besclwp-member-carousel'] = true;
    $active['besclwp-divider'] = true;
    $active['besclwp-statistics'] = true;
    $active['besclwp-statistic'] = true;
    $active['besclwp-activity'] = true;
    $active['besclwp-member-list'] = true;
    $active['besclwp-group-list'] = true;
    $active['besclwp-group-carousel'] = true;
    $active['besclwp-img-slider'] = true;
    $active['besclwp-testimonials'] = true;
    return $active;
}
add_filter('siteorigin_widgets_active_widgets', 'besclwp_filter_active_widgets');

/* ----------------------------------------------------------
Widget Groups
------------------------------------------------------------- */
function besclwp_add_widget_tabs($tabs) {
    $tabs[] = array(
        'title' => esc_html__('Besocial Widgets', 'besclwpcpt'),
        'filter' => array(
            'groups' => array('besclwp')
        )
    );
    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'besclwp_add_widget_tabs', 20);

/* ----------------------------------------------------------
Custom Class Prefix
------------------------------------------------------------- */
function besclwp_fields_class_prefixes( $class_prefixes ) {
    $class_prefixes[] = 'besclwp_';
    return $class_prefixes;
}
add_filter( 'siteorigin_widgets_field_class_prefixes', 'besclwp_fields_class_prefixes' );

/* ----------------------------------------------------------
Custom Class Path
------------------------------------------------------------- */
function besclwp_fields_class_paths( $class_paths ) {
    $class_paths[] = plugin_dir_path( __FILE__ ) . 'so-custom-fields/';
    return $class_paths;
}
add_filter( 'siteorigin_widgets_field_class_paths', 'besclwp_fields_class_paths' );
?>