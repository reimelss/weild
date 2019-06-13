<?php
add_action( 'init', 'weild_deal_init' );
/**
 * Register a deal post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function weild_deal_init() {
  $labels = array(
    'name'               => _x( 'Deals', 'post type general name', 'your-plugin-textdomain' ),
    'singular_name'      => _x( 'Deal', 'post type singular name', 'your-plugin-textdomain' ),
    'menu_name'          => _x( 'Deals', 'admin menu', 'your-plugin-textdomain' ),
    'name_admin_bar'     => _x( 'Deal', 'add new on admin bar', 'your-plugin-textdomain' ),
    'add_new'            => _x( 'Add New', 'deal', 'your-plugin-textdomain' ),
    'add_new_item'       => __( 'Add New Deal', 'your-plugin-textdomain' ),
    'new_item'           => __( 'New Deal', 'your-plugin-textdomain' ),
    'edit_item'          => __( 'Edit Deal', 'your-plugin-textdomain' ),
    'view_item'          => __( 'View Deal', 'your-plugin-textdomain' ),
    'all_items'          => __( 'All Deals', 'your-plugin-textdomain' ),
    'search_items'       => __( 'Search Deals', 'your-plugin-textdomain' ),
    'parent_item_colon'  => __( 'Parent Deals:', 'your-plugin-textdomain' ),
    'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
    'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
  );

  $args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'deal' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title', 'author', 'thumbnail', 'excerpt', 'comments' )
  );

  register_post_type( 'deal', $args );
}