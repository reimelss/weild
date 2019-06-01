<?php
function register_besclwp_faq_posttype() {
    $labels = array(
        'name'              => esc_attr__( 'FAQ', 'besclwpcpt' ),
        'singular_name'     => esc_attr__( 'Question', 'besclwpcpt' ),
        'add_new'           => esc_attr__( 'Add new question', 'besclwpcpt' ),
        'add_new_item'      => esc_attr__( 'Add new question', 'besclwpcpt' ),
        'edit_item'         => esc_attr__( 'Edit question', 'besclwpcpt' ),
        'new_item'          => esc_attr__( 'New question', 'besclwpcpt' ),
        'view_item'         => esc_attr__( 'View question', 'besclwpcpt' ),
        'search_items'      => esc_attr__( 'Search questions', 'besclwpcpt' ),
        'not_found'         => esc_attr__( 'No question found', 'besclwpcpt' ),
        'not_found_in_trash'=> esc_attr__( 'No question found in trash', 'besclwpcpt' ),
        'parent_item_colon' => esc_attr__( 'Parent question:', 'besclwpcpt' ),
        'menu_name'         => esc_attr__( 'FAQ', 'besclwpcpt' )
    );

    $taxonomies = array();
 
    $supports = array('title');
 
    $post_type_args = array(
        'labels'            => $labels,
        'singular_label'    => esc_attr__('FAQ', 'besclwpcpt'),
        'public'            => false,
        'exclude_from_search' => true,
        'show_ui'           => true,
        'show_in_nav_menus' => true,
        'publicly_queryable'=> true,
        'query_var'         => true,
        'capability_type'   => 'post',
        'has_archive'       => false,
        'hierarchical'      => false,
        'rewrite'           => array( 'slug' => 'faq', 'with_front' => false ),
        'supports'          => $supports,
        'menu_position'     => 99,
        'menu_icon'         => 'dashicons-sos',
        'taxonomies'        => $taxonomies
    );
    register_post_type('besclwpfaq',$post_type_args);
}
add_action('init', 'register_besclwp_faq_posttype');

// Register taxonomy

function besclwp_faq_taxonomy() {
    register_taxonomy(
        'besclwpfaqcats',
        'besclwpfaq',
        array(
            'labels' => array(
                'name' => esc_attr__( 'FAQ Categories', 'besclwpcpt' ),
                'add_new_item' => esc_attr__( 'Add new category', 'besclwpcpt' ),
                'new_item_name' => esc_attr__( 'New category', 'besclwpcpt' )
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'hierarchical' => true
        )
    );
}
add_action( 'init', 'besclwp_faq_taxonomy', 0 );

// Answer

function besclwp_answer( $meta_boxes ) {
    $prefix = 'besclwp_cmb2'; // Prefix for all fields
    $meta_boxes['besclwp_answer'] = array(
        'id' => 'besclwp_answer',
        'title' => esc_attr__( 'Answer', 'besclwpcpt'),
        'object_types' => array('besclwpfaq'), // post type
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => false, // Show field names on the left
        'fields' => array(
            array(
                'name'    => $prefix . '_answer',
                'id'      => $prefix . '_answer',
                'type'    => 'wysiwyg',
                'options' => array(
                    'wpautop' => true,
                    'media_buttons' => true,
                    'teeny' => true
                ),
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'besclwp_answer' );
?>