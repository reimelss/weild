<?php
/* Add column to Users Table called "Featured" */
function besocial_add_users_column( $column ) {
    $column['user_id'] =  esc_html__( 'User ID', 'besclwpcpt');
    $column['besocial_featured_user'] = '<img src="' . plugin_dir_url( __FILE__ ) . 'images/featured.png" />';
    return apply_filters('besocial_featured_col_name',$column);
}
add_filter( 'manage_users_columns', 'besocial_add_users_column', 99 );

/* Add the row value for Featured column */
function besocial_add_featured_user_row( $val, $column_name, $user_id ) {    
    $user = get_userdata( $user_id );
	if ( 'user_id' == $column_name ) {
		return $user_id;
    }
    switch ( $column_name ) {
        case 'besocial_featured_user' :
            $is_featured_user = sanitize_text_field(get_user_meta( $user_id , 'besocial_featured_user' ,true ));

            if( $is_featured_user ) {
            	return '<img src="'. apply_filters('besocial_featured_user_img',
            		plugins_url( 'images/active_user.png', __FILE__ )) .'" class="besocial_featured_user" featured="yes" user-id="'. $user_id .'" >';
            }
            else {
            	return '<img src="'. apply_filters('besocial_not_featured_user_img',
            		plugins_url( 'images/inactive_user.png', __FILE__ )).'" class="besocial_featured_user" featured="no" user-id="'. $user_id .'" >';
            }            
            break;
        default:
    }
    
    return; 
}
add_action('manage_users_custom_column',  'besocial_add_featured_user_row', 10, 3);

/* user status description */
function besocial_toggle_featured_user_status() {
    if ( !current_user_can( 'edit_user', $user_id ) ) return false;

    check_ajax_referer( 'besocial_js_script_ajax_nonce', 'besocial_js_script_ajax_nonce' );

	$is_featured_user = sanitize_text_field($_POST["featured"]);
	$user_id = intval($_POST["user_id"]);

	if( $is_featured_user == 'yes' )
    {
		update_user_meta( $user_id, 'besocial_featured_user' , 'yes' );
	} 
	else {
		delete_user_meta( $user_id, 'besocial_featured_user' );
	}

	echo esc_attr__( 'User Featured Status Is Changed', 'besclwpcpt');
   
}
add_action( 'wp_ajax_besocial_toggle_featured_user_status', 'besocial_toggle_featured_user_status' );

/* Add checkbox option user edit page */
function besocial_add_featured_checkBox_userEditPage( $user ){    
    $user_id = $user->ID;               
    $is_featured_user  = sanitize_text_field(get_user_meta( $user_id, "besocial_featured_user", true ));               
    ?> 
    <table class="form-table">
    	<hr><h3><?php esc_attr_e( 'Featured Members Setting', 'besclwpcpt'); ?></h3>
	    <tr class="user-admin-bar-front-wrap">
			<th scope="row">Featured User</th>
			<td><fieldset><legend class="screen-reader-text"><span><?php esc_attr_e( 'Featured User Setting', 'besclwpcpt'); ?></span></legend>
				<label for="besocial_featured_user">
				<input name="besocial_featured_user" type="checkbox" id="besocial_featured_user" value="yes" <?php if ( $is_featured_user == 'yes' ){ ?> checked="checked"<?php } ?> >
				<?php esc_attr_e( 'Feature this user', 'besclwpcpt'); ?></label><br>
				</fieldset>
			</td>
		</tr>		
	</table>   
    <?php    
} 
add_action( 'edit_user_profile', 'besocial_add_featured_checkBox_userEditPage',999 );

/* Save the featured option in the user edit page */
function besocial_save_featured_checkBox_userEditPage( $user_id ){ 	        
	if ( !current_user_can( 'edit_user', $user_id ) ) return false;

	// update this users meta
	if ( isset( $_POST['besocial_featured_user'] ) && sanitize_text_field($_POST['besocial_featured_user']) == "yes" )
    {                     
    	update_user_meta( $user_id, 'besocial_featured_user' , 'yes' );
    }
	else {
	    delete_user_meta( $user_id, 'besocial_featured_user' );
	}                           
} 
add_action( 'edit_user_profile_update', 'besocial_save_featured_checkBox_userEditPage');
?>