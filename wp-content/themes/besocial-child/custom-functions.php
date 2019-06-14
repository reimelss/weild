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
//create forum after creating new deal
function weild_deal_forum( $post_id ) {
    // Only do it for "custom_post" post type
    if( get_post_type($post_id) != 'deal' ){
        return;
    }  
    // Only do it on the front end
    if( is_admin() ){
        return;
    }
    $post_title = get_the_title($post_id);
    $forum_id = wp_insert_post( array(
                    'post_status' => 'pending',
                    'post_type' => 'forum',
                    'post_title' => 'Forum '.$post_title,
                    'post_content' => $post_title
                ) );
    update_post_meta($post_id,'forumn_id',$forum_id);
}

// run after ACF saves the $_POST['acf'] data
add_action('acf/save_post', 'weild_deal_forum', 99);


function my_pre_save_post($post_id) {

 

  // // check for numerical post_id and check post_type
  // if (!is_numeric($post_id) || get_post_type($post_id) == 'deal') {
  //   return $post_id;
  // }

  if(!$_POST["acf"]["field_5d032303d63f2"]) {
    $post = array(
      'ID' => $post_id,
      'post_status'  => 'draft' ,
      'post_title'   => $_POST["acf"]["field_5cf2ee7943029"]
    );  
  }else {
      $post = array(
        'ID' => $post_id,
        'post_status'  => 'pending' ,
        'post_title'   => $_POST["acf"]["field_5cf2ee7943029"]
      );  
  }
  // echo "<pre>";
  // var_dump($post); 
  // die();

  // update the post
  wp_update_post($post);
  
  return $post_id;
}

add_filter('acf/pre_save_post' , 'my_pre_save_post', 10, 1 );

