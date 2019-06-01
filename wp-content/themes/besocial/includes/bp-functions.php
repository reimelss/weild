<?php
/* ---------------------------------------------------------
BuddyPress get user notifications
----------------------------------------------------------- */

function besocial_get_user_notifications() {
    $besocial_get_notifications = bp_notifications_get_notifications_for_user( bp_loggedin_user_id(),'string' );
    if ($besocial_get_notifications) {
        $notifications = '';
        foreach ( $besocial_get_notifications as $notification ) {
            $notifications .= $notification;
        }
        return $notifications;
    }  
}

/* ---------------------------------------------------------
Live Notifications
----------------------------------------------------------- */

$besclwp_enable_live_notification = get_option('besclwp_enable_live_notification');

if (!empty($besclwp_enable_live_notification) && ($besclwp_enable_live_notification == 'true')) {    
    
function besocial_heartbeat_settings( $settings ) {
    $besclwp_notification_pulse = get_option('besclwp_notification_pulse');
    if (empty($besclwp_notification_pulse)) {
        $besclwp_notification_pulse = 60;
    }  
    $settings['interval'] = $besclwp_notification_pulse;
    return $settings;
}
add_filter( 'heartbeat_settings', 'besocial_heartbeat_settings' );
 
function besocial_receive_heartbeat( $response, $data ) {
    
    /* Notifications */   
    $besocial_get_notification_count = $data['besocial_get_notification_count'];
    $besocial_notification_count = bp_notifications_get_unread_notification_count( bp_loggedin_user_id() );   
    if ( $besocial_get_notification_count != $besocial_notification_count ) {
        $besocial_notification_class = 1;
    } else {
        $besocial_notification_class = 0;
    }   
    $response['besocial_notification_class'] = $besocial_notification_class;
    $response['besocial_notification_count'] = $besocial_notification_count;
    $response['besocial_notification_content'] = besocial_get_user_notifications();
    
    /* Messages */
    $besocial_get_message_count = $data['besocial_get_message_count'];
    $besocial_message_count = messages_get_unread_count(bp_loggedin_user_id());   
    if ( $besocial_get_message_count != $besocial_message_count ) {
        $besocial_message_class = 1;
    } else {
        $besocial_message_class = 0;
    }   
    $response['besocial_message_class'] = $besocial_message_class;
    $response['besocial_message_count'] = $besocial_message_count;
    
    /* Friendship Requests */
    $besocial_get_friend_count = $data['besocial_get_friend_count'];
    $besocial_friend_count = bp_friend_get_total_requests_count(bp_loggedin_user_id());   
    if ( $besocial_get_friend_count != $besocial_friend_count ) {
        $besocial_friend_class = 1;
    } else {
        $besocial_friend_class = 0;
    }   
    $response['besocial_friend_class'] = $besocial_friend_class;
    $response['besocial_friend_count'] = $besocial_friend_count;
    
    /* Group Invites */
    $besocial_get_group_count = $data['besocial_get_group_count'];
    $besocial_groups = groups_get_invites_for_user(bp_loggedin_user_id());
    $besocial_group_count = $besocial_groups['total'];  
    if ( $besocial_get_group_count != $besocial_group_count ) {
        $besocial_group_class = 1;
    } else {
        $besocial_group_class = 0;
    }   
    $response['besocial_group_class'] = $besocial_group_class;
    $response['besocial_group_count'] = $besocial_group_count;
    
    return $response;
}

add_filter( 'heartbeat_received', 'besocial_receive_heartbeat', 10, 2 );
}

/* ---------------------------------------------------------
BuddyPress user blog
----------------------------------------------------------- */

$besclwp_enable_user_blog = get_option('besclwp_enable_user_blog');

if (!empty($besclwp_enable_user_blog) && ($besclwp_enable_user_blog == 'true')) {

/* Tab Navigation */

function besocial_user_blog_tab() {
	global $bp;
	bp_core_new_nav_item(
        array(
            'name'  =>  wp_kses_post(sprintf( __( 'Blog <span class="%s">%s</span>', 'besocial' ), besocial_class_user_posts(), besocial_count_user_posts() )),
            'slug' => 'user-blog',
            'position' => 70,
            'screen_function' => 'besocial_user_posts',
            'default_subnav_slug' => 'user-blog',
            'parent_url' => $bp->loggedin_user->domain . $bp->slug . '/',
            'parent_slug' => $bp->slug
        )
    );
    bp_core_new_subnav_item(
        array(
            'name' => esc_html__('Published Posts', 'besocial'), 
            'slug' => 'user-blog', 
            'parent_url' => $bp->loggedin_user->domain . $bp->slug . 'user-blog/',
            'parent_slug' => 'user-blog', 
            'screen_function' => 'besocial_user_posts', 
            'position' => 1
        )
    );
    bp_core_new_subnav_item(
        array(
            'name' => esc_html__('Pending Posts', 'besocial'), 
            'slug' => 'pending-posts', 
            'parent_url' => $bp->loggedin_user->domain . $bp->slug . 'user-blog/',
            'parent_slug' => 'user-blog', 
            'screen_function' => 'besocial_pending_posts', 
            'position' => 2,
            'user_has_access' => bp_is_my_profile()
        )
    );
    bp_core_new_subnav_item(
        array(
            'name' => esc_html__('Add New Post', 'besocial'), 
            'slug' => 'add-new-post', 
            'parent_url' => $bp->loggedin_user->domain . $bp->slug . 'user-blog/',
            'parent_slug' => 'user-blog', 
            'screen_function' => 'besocial_add_new_post', 
            'position' => 2,
            'user_has_access' => bp_is_my_profile()
        )
    );
}

add_action( 'bp_setup_nav', 'besocial_user_blog_tab', 50 );
    
/* Admin Bar Navigation */    
    
function besocial_blog_admin_bar() {
    global $wp_admin_bar, $bp;
 
    if ( !bp_use_wp_admin_bar() || defined( 'DOING_AJAX' ) )
        return;
 
    $user_domain = bp_loggedin_user_domain();
    $item_link = trailingslashit( $user_domain . 'user-blog' );
 
    $wp_admin_bar->add_menu( array(
        'parent'  => $bp->my_account_menu_id,
        'id'      => 'user-blog',
        'title'   => esc_html__( 'Blog', 'besocial' ),
        'href'    => trailingslashit( $item_link ),
        'meta'    => array( 'class' => 'menupop' )
    ));   
    
    $wp_admin_bar->add_menu( array(
        'parent' => 'user-blog',
        'id'     => 'user-blog-published',
        'title'  => esc_html__( 'Published Posts', 'besocial' ),
        'href'   => trailingslashit( $item_link )
    ));
 
    $wp_admin_bar->add_menu( array(
        'parent' => 'user-blog',
        'id'     => 'user-blog-pending',
        'title'  => esc_html__( 'Pending Posts', 'besocial' ),
        'href'   => trailingslashit( $item_link ) . 'pending-posts'
    ));
    
    $wp_admin_bar->add_menu( array(
        'parent' => 'user-blog',
        'id'     => 'user-blog-add-new',
        'title'  => esc_html__( 'Add New Post', 'besocial' ),
        'href'   => trailingslashit( $item_link ) . 'add-new-post'
    ));
}
add_action( 'bp_setup_admin_bar', 'besocial_blog_admin_bar', 70 );    

/* Count posts */

function besocial_count_user_posts() {
    return count_user_posts( bp_displayed_user_id() , 'post' );
}

function besocial_class_user_posts() {
    $count_posts = count_user_posts( bp_displayed_user_id() , 'post' );
    if ($count_posts != 0) {
        return 'count';
    } else {
        return 'no-count';
    }
}
    
/* Post Pagination */
    
function besocial_user_blog_query_vars( $qvars ) {
    $qvars[] = 'pgnum';
    return $qvars;
}
add_filter( 'query_vars', 'besocial_user_blog_query_vars' , 10, 1 );    

/* Display published posts */
    
function besocial_user_posts() {
	add_action( 'bp_template_content', 'besocial_user_posts_content' );
	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}    

function besocial_user_posts_content() {
    $besclwp_max_user_posts = get_option('besclwp_max_user_posts');
    if (empty($besclwp_max_user_posts)) {
        $besclwp_max_user_posts = 5;
    }
    $besclwp_query = new WP_Query( 
        array('author' => bp_displayed_user_id(),'post_type' => 'post', 'posts_per_page' => $besclwp_max_user_posts,'post_status' => 'publish', 'paged' => get_query_var('pgnum',1)) 
    );
    if ( $besclwp_query->have_posts() ) {
    while($besclwp_query->have_posts()) : $besclwp_query->the_post(); ?>
    <div class="besocial-group-outer">
        <?php if (current_user_can('delete_posts')) { ?>
        <a class="besocial-delete-post-btn" href="<?php echo esc_url(get_delete_post_link( get_the_ID(), '', true )); ?> "><i class="fa fa-times-circle"></i></a>
        <?php } ?>
		<div class="besocial-group-inner">
            <?php 
            if (has_post_thumbnail()) { 
                $besclwp_thumb_id = get_post_thumbnail_id();
                $besclwp_thumb_url_array = wp_get_attachment_image_src($besclwp_thumb_id, 'thumbnail', true);
                $besclwp_thumb_url = $besclwp_thumb_url_array[0]; 
            ?>
            <div class="besocial-group-avatar">
                <a href="<?php esc_url(the_permalink()); ?>">
                    <img src="<?php echo esc_url($besclwp_thumb_url); ?>" alt="<?php the_title(); ?>" />
                </a>
            </div>
            <?php } ?>
            <div class="besocial-group">
				<div class="besocial-group-title">
                    <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
                </div>
                <div class="besocial-group-meta">
                    <i class="fa fa-clock-o"></i> <?php echo the_time(get_option('date_format')); ?>
                </div>
                <div class="besocial-group-desc">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    <div class="besocial-user-blog-nav">
    <div class="besocial-numeric-pagination">
    <?php echo paginate_links( array(
        'base' =>  @add_query_arg('pgnum','%#%'),
        'format' => '',
        'current' => max( 1, get_query_var('pgnum') ),
        'total' => $besclwp_query->max_num_pages,
        'type' => 'list',
        'prev_text' => '<i class="fa fa-chevron-left"></i>',
        'next_text' => '<i class="fa fa-chevron-right"></i>',
    ));    
    ?>
    </div>
    <div class="besocial-user-blog-btn">
        <a href="<?php echo esc_url(get_author_posts_url(bp_displayed_user_id())); ?>" class="besocial-button"><?php esc_html_e('View All', 'besocial'); ?></a>
    </div>    
    </div>    
    <div class="clear"></div>
    <?php } else { ?>
    <div id="message" class="info">
        <p><?php esc_html_e('There were no posts found.', 'besocial'); ?></p>
    </div>
    <?php }
    wp_reset_postdata();
}
    
/* Display pending posts */
    
function besocial_pending_posts() {
	add_action( 'bp_template_content', 'besocial_pending_posts_content' );
	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}    

function besocial_pending_posts_content() {
    $besclwp_max_user_posts = get_option('besclwp_max_user_posts');
    if (empty($besclwp_max_user_posts)) {
        $besclwp_max_user_posts = 5;
    }
    $besclwp_query = new WP_Query( 
        array('author' => bp_displayed_user_id(),'post_type' => 'post', 'posts_per_page' => $besclwp_max_user_posts,'post_status' => 'pending', 'paged' => get_query_var('pgnum',1)) 
    );
    if ( $besclwp_query->have_posts() ) {
    while($besclwp_query->have_posts()) : $besclwp_query->the_post(); ?>
    <div class="besocial-group-outer">
        <?php if (current_user_can('delete_posts')) { ?>
        <a class="besocial-delete-post-btn" href="<?php echo esc_url(get_delete_post_link( get_the_ID(), '', true )); ?> "><i class="fa fa-times-circle"></i></a>
        <?php } ?>
		<div class="besocial-group-inner">
            <?php 
            if (has_post_thumbnail()) { 
                $besclwp_thumb_id = get_post_thumbnail_id();
                $besclwp_thumb_url_array = wp_get_attachment_image_src($besclwp_thumb_id, 'thumbnail', true);
                $besclwp_thumb_url = $besclwp_thumb_url_array[0]; 
            ?>
            <div class="besocial-group-avatar">
                <img src="<?php echo esc_url($besclwp_thumb_url); ?>" alt="<?php the_title(); ?>" />
            </div>
            <?php } ?>
            <div class="besocial-group">
				<div class="besocial-group-title">
                    <?php the_title(); ?>
                </div>
                <div class="besocial-group-meta">
                    <i class="fa fa-clock-o"></i> <?php echo the_time(get_option('date_format')); ?>
                </div>
                <div class="besocial-group-desc">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    <div class="besocial-user-blog-nav">
    <div class="besocial-numeric-pagination no-view-all">
    <?php echo paginate_links( array(
        'base' =>  @add_query_arg('pgnum','%#%'),
        'format' => '',
        'current' => max( 1, get_query_var('pgnum') ),
        'total' => $besclwp_query->max_num_pages,
        'type' => 'list',
        'prev_text' => '<i class="fa fa-chevron-left"></i>',
        'next_text' => '<i class="fa fa-chevron-right"></i>',
    ));    
    ?>
    </div>   
    </div>    
    <div class="clear"></div>
    <?php } else { ?>
    <div id="message" class="info">
        <p><?php esc_html_e('There were no posts found.', 'besocial'); ?></p>
    </div>
    <?php }
    wp_reset_postdata();
}    
    
/* Display pending posts */
    
function besocial_add_new_post() {
	add_action( 'bp_template_content', 'besocial_add_new_post_content' );
	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}    

function besocial_add_new_post_content() {
    $besclwp_enable_featured_blog = get_option('besclwp_enable_featured_blog');
    if ($besclwp_enable_featured_blog == 'true') {
        $besclwp_featured_blog_user = besclwp_featured_blog_user(bp_displayed_user_id());
        if($besclwp_featured_blog_user == 'besclwp-featured') {
            echo do_shortcode('[besocial_frontend_form]');
        } else { ?>
            <div id="message" class="info">
                <p><?php esc_html_e('You should be a featured member to use this feature...', 'besocial'); ?></p>
            </div>
        <?php }
    } else {
        echo do_shortcode('[besocial_frontend_form]');
    }
}
    
}

/* ---------------------------------------------------------
BuddyPress default avatars
----------------------------------------------------------- */

define ( 'BP_AVATAR_THUMB_WIDTH', 100 );
define ( 'BP_AVATAR_THUMB_HEIGHT', 100 );
define ( 'BP_AVATAR_FULL_WIDTH', 240 );
define ( 'BP_AVATAR_FULL_HEIGHT', 240 );

/* ---------------------------------------------------------
BuddyPress default profile cover images
----------------------------------------------------------- */

if ( ! function_exists( 'besclwp_xprofile_cover_image' ) ) {
function besclwp_xprofile_cover_image( $settings = array() ) {
    $besclwp_buddypress_profile_cover = get_option('besclwp_buddypress_profile_cover');
    $theme_handle = '';
    if(!is_rtl()) {
        $theme_handle = 'bp-parent-css';
    }
    else {
        $theme_handle = 'bp-parent-css-rtl';
    }
    $settings['theme_handle'] = $theme_handle;
    $settings['width']  = 1320;
    $settings['height'] = 340;
    if(!empty($besclwp_buddypress_profile_cover)) {
        $settings['default_cover'] = esc_url($besclwp_buddypress_profile_cover);
    }
    else {
        $settings['default_cover'] = get_template_directory_uri() ."/images/buddypress-default-cover.png";
    }  
    $settings['callback'] = 'bp_legacy_theme_cover_image';

    return $settings;
}
}
add_filter( 'bp_before_xprofile_cover_image_settings_parse_args', 'besclwp_xprofile_cover_image', 10, 1 );

/* ---------------------------------------------------------
BuddyPress default group cover images
----------------------------------------------------------- */

if ( ! function_exists( 'besclwp_groups_cover_image' ) ) {
function besclwp_groups_cover_image( $settings = array() ) {
    $besclwp_buddypress_group_cover = get_option('besclwp_buddypress_group_cover');
    $theme_handle = '';
    if(!is_rtl()) {
        $theme_handle = 'bp-parent-css';
    }
    else {
        $theme_handle = 'bp-parent-css-rtl';
    }
    $settings['theme_handle'] = $theme_handle;
    $settings['width']  = 1320;
    $settings['height'] = 340;
    if(!empty($besclwp_buddypress_group_cover)) {
        $settings['default_cover'] = esc_url($besclwp_buddypress_group_cover);
    }
    else {
        $settings['default_cover'] = get_template_directory_uri() ."/images/buddypress-default-cover.png";
    }  
    $settings['callback'] = 'bp_legacy_theme_cover_image';
    return $settings;
}
}
add_filter( 'bp_before_groups_cover_image_settings_parse_args', 'besclwp_groups_cover_image', 10, 1 );

/* ---------------------------------------------------------
Disable BuddyPress Cover Images (Optional -> Theme Settings)
----------------------------------------------------------- */

$besclwp_disable_p_cover = get_option('besclwp_disable_p_cover');
$besclwp_disable_g_cover = get_option('besclwp_disable_g_cover');

if($besclwp_disable_p_cover == 'true') {
    add_filter( 'bp_is_profile_cover_image_active', '__return_false' );
}

if($besclwp_disable_g_cover == 'true') {
    add_filter( 'bp_is_groups_cover_image_active', '__return_false' );
}

/* ---------------------------------------------------------
Get member registration date
----------------------------------------------------------- */

if ( ! function_exists( 'besclwp_get_member_since' ) ) {
function besclwp_get_member_since() {
	$user_id = bp_displayed_user_id(); 
	$besclwp_date = get_userdata( $user_id );
	$registered = $besclwp_date->user_registered;      
	$joined =  date_i18n( get_option('date_format'), strtotime( $registered ) );
	return $joined;
}
}

if ( ! function_exists( 'besclwp_get_preview_since' ) ) {
function besclwp_get_preview_since($user_id) {
	$besclwp_date = get_userdata( $user_id );
	$registered = $besclwp_date->user_registered;      
	$joined =  date_i18n( get_option('date_format'), strtotime( $registered ) );
	echo esc_html__( 'Member since', 'besocial') . ' ' . $joined;
}
}

/* ---------------------------------------------------------
Check featured member field
----------------------------------------------------------- */

if ( ! function_exists( 'besclwp_featured_check' ) ) {
function besclwp_featured_check($besclwp_member_id) {
    global $bp, $wpdb;   
    $query = $wpdb->get_var( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}usermeta 
					WHERE meta_key = 'besocial_featured_user'
					AND meta_value = 'yes' AND user_id = '%s'", $besclwp_member_id ) );	
    if ($query) {
        echo esc_html('besclwp-featured');
    }
    else {
        echo esc_html('besclwp-not-featured'); 
    }
}
}

if ( ! function_exists( 'besclwp_featured_blog_user' ) ) {
function besclwp_featured_blog_user($besclwp_member_id) {
    global $bp, $wpdb;   
    $query = $wpdb->get_var( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}usermeta 
					WHERE meta_key = 'besocial_featured_user'
					AND meta_value = 'yes' AND user_id = '%s'", $besclwp_member_id ) );	
    if ($query) {
        return 'besclwp-featured';
    }
    else {
        return 'besclwp-not-featured';
    }
}
}

/* ---------------------------------------------------------
Add BuddyPress mentions interface to bbPress forum replies
----------------------------------------------------------- */

function besclwp_bbpress_load_mentions_scripts( $retval = false ) {
    if ( function_exists( 'bbpress' ) && is_bbpress() ) {
        $retval = true;
    }
    return $retval;
}
add_filter( 'bp_activity_maybe_load_mentions_scripts', 'besclwp_bbpress_load_mentions_scripts' );

/* ---------------------------------------------------------
Remove empty action tags from search forms (HTML5 Validation)
----------------------------------------------------------- */

function besocial_form_filter($search_form_html) { 
    return str_replace('action=""', '', $search_form_html);
}

add_filter( 'bp_directory_members_search_form', 'besocial_form_filter' );
add_filter( 'bp_directory_groups_search_form', 'besocial_form_filter' );

/*---------------------------------------------------
Custom BuddyPress Styles - Theme Settings
----------------------------------------------------*/

if ( ! function_exists( 'besclwp_print_bp_styles' ) ) {
    function besclwp_print_bp_styles()
    {
        wp_enqueue_style('besclwp-bp-custom', get_stylesheet_directory_uri() . '/css/bp-custom.css', false, '1.0'); 
        
        $besclwp_card_width = esc_attr(get_option('besclwp_card_width'));
        $besclwp_disable_user_thumb = esc_attr(get_option('besclwp_disable_user_thumb'));
        $besclwp_h3size = esc_attr(get_option('besclwp_h3'));
        $besclwp_h4size = esc_attr(get_option('besclwp_h4'));
        $besclwp_h5size = esc_attr(get_option('besclwp_h5'));
        $besclwp_h6size = esc_attr(get_option('besclwp_h6'));
        $besclwp_psize = esc_attr(get_option('besclwp_p'));
        $besclwp_smallsize = esc_attr(get_option('besclwp_small'));
        $besclwp_xsmallsize = esc_attr(get_option('besclwp_xsmall'));       
        $besclwp_1_color = esc_attr(get_option('besclwp_1_color'));
        $besclwp_3_color = esc_attr(get_option('besclwp_3_color'));
        $besclwp_4_color = esc_attr(get_option('besclwp_4_color'));
        $besclwp_5_color = esc_attr(get_option('besclwp_5_color'));
        $besclwp_6_color = esc_attr(get_option('besclwp_6_color'));
        $besclwp_7_color = esc_attr(get_option('besclwp_7_color'));
        $besclwp_inline_style = '';
        
        if (!is_user_logged_in()) {
            $besclwp_inline_style .= '#besocial-submenu #members-personal-li {display:none !important;}';
        }
        
        if ((!empty($besclwp_card_width)) && ($besclwp_card_width != '500')) {
            $besclwp_inline_style .= '#besocial-preview {width: ' . $besclwp_card_width . 'px;}';
        } 
        
        if ($besclwp_disable_user_thumb == 'true') {
            $besclwp_inline_style .= '#besocial-preview-thumb {display:none !important;}';
        } 
        
        if ((!empty($besclwp_psize)) && ($besclwp_psize != '16')) {
            $besclwp_inline_style .= 'p.drag-drop-buttons input#bp-browse-button { font-size:' . $besclwp_psize . 'px; }@media only screen and (max-width: 480px) {p.drag-drop-buttons input#bp-browse-button {font-size: ' . ($besclwp_psize - 2) . 'px;}}';
        } 
        
        if ((!empty($besclwp_smallsize)) && ($besclwp_smallsize != '14')) {
            $besclwp_inline_style .= '#buddypress #whats-new-submit input,#buddypress .besocial-whats-new-text,body.activity-permalink #buddypress .activity-list li .activity-header span.time-since,#buddypress div.activity-header a.activity-time-since,#buddypress div.activity-comments a.activity-time-since,#buddypress a.activity-time-since,#buddypress #item-header-content span.activity,#buddypress a.bp-primary-action,#buddypress a.bp-secondary-action,#buddypress #reply-title small a,#buddypress .standard-form p.description,#buddypress .standard-form button,#buddypress a.button,#buddypress .generic-button a,#buddypress .comment-reply-link,a.bp-title-button,#buddypress .standard-form #profile-details-section .field-visibility-settings legend,#buddypress .profile .standard-form .field-visibility-settings legend,#buddypress .standard-form .field-visibility-settings-toggle,#buddypress .standard-form .field-visibility-settings-notoggle,#buddypress .field-visibility-settings-toggle,#group-create-body .radio ul li,#buddypress #cover-image-container .group-type,#buddypress .besocial-member-meta,#buddypress .besocial-group-meta,.besocial-member a.mutual-friends,#buddypress #bpfb_add_remote_image,#buddypress #bpfb_cancel_action,#buddypress #bpfb_link_url_preview,#buddypress input.bpfb_primary_button,#buddypress #bpfb_cancel,#buddypress #bpfb_video_url_preview,#buddypress #bpfb_remote_image_preview,#buddypress .bpfb_controls_container .qq-upload-button,.widget.buddypress div.item-options a,.widget_bps_widget #buddypress form .clear-value,#buddypress .message-metadata span.activity,#buddypress table#message-threads tr.unread td .thread-excerpt, #buddypress table#message-threads tr.unread td .activity, #buddypress table#message-threads tr.unread td.thread-options { font-size:' . $besclwp_smallsize . 'px; }@media only screen and (max-width: 480px) {#buddypress #whats-new-submit input,#buddypress .besocial-whats-new-text,body.activity-permalink #buddypress .activity-list li .activity-header span.time-since,#buddypress div.activity-header a.activity-time-since,#buddypress div.activity-comments a.activity-time-since,#buddypress a.activity-time-since,#buddypress #item-header-content span.activity,#buddypress a.bp-primary-action,#buddypress a.bp-secondary-action,#buddypress #reply-title small a,#buddypress .standard-form p.description,#buddypress .standard-form button,#buddypress a.button,#buddypress .generic-button a,#buddypress .comment-reply-link,a.bp-title-button,#buddypress .standard-form #profile-details-section .field-visibility-settings legend,#buddypress .profile .standard-form .field-visibility-settings legend,#buddypress .standard-form .field-visibility-settings-toggle,#buddypress .standard-form .field-visibility-settings-notoggle,#buddypress .field-visibility-settings-toggle,#group-create-body .radio ul li,#buddypress #cover-image-container .group-type,#buddypress .besocial-member-meta,#buddypress .besocial-group-meta,.besocial-member a.mutual-friends,#buddypress #bpfb_add_remote_image,#buddypress #bpfb_cancel_action,#buddypress #bpfb_link_url_preview,#buddypress input.bpfb_primary_button,#buddypress #bpfb_cancel,#buddypress #bpfb_video_url_preview,#buddypress #bpfb_remote_image_preview,#buddypress .bpfb_controls_container .qq-upload-button,.widget.buddypress div.item-options a,.widget_bps_widget #buddypress form .clear-value,#buddypress .message-metadata span.activity,#buddypress table#message-threads tr.unread td .thread-excerpt, #buddypress table#message-threads tr.unread td .activity, #buddypress table#message-threads tr.unread td.thread-options { font-size:' . ($besclwp_smallsize - 2) . 'px; }}';
        }
        
        if ((!empty($besclwp_xsmallsize)) && ($besclwp_xsmallsize != '12')) {
            $besclwp_inline_style .= '#buddypress a.bp-primary-action span,#buddypress #reply-title small a span { font-size:' . $besclwp_xsmallsize . 'px; }';
        }
        
        if ((!empty($besclwp_h6size)) && ($besclwp_h6size != '18')) {
            $besclwp_inline_style .= '#sitewide-notice strong { font-size:' . $besclwp_h6size . 'px; }@media only screen and (max-width: 480px) {#sitewide-notice strong { font-size:' . ($besclwp_h6size - 2) . 'px; }}';
        } 
        
        if ((!empty($besclwp_h3size)) && ($besclwp_h3size != '24')) {
            $besclwp_inline_style .= '.widget_bp_core_sitewide_messages.besclwp-sidebar-box .bp-site-wide-message p strong,.bp-notice-subject p strong { font-size:' . $besclwp_h3size . 'px; }@media only screen and (max-width: 480px) {.widget_bp_core_sitewide_messages.besclwp-sidebar-box .bp-site-wide-message p strong,.bp-notice-subject p strong { font-size:' . ($besclwp_h3size - 2) . 'px; }}';
        } 
        
        if ((!empty($besclwp_h4size)) && ($besclwp_h4size != '22')) {
            $besclwp_inline_style .= '.besocial-mentionname { font-size:' . $besclwp_h4size . 'px; }@media only screen and (max-width: 480px) {.besocial-mentionname { font-size:' . ($besclwp_h4size - 2) . 'px; }}';
        } 
        
        if ((!empty($besclwp_h5size)) && ($besclwp_h5size != '20')) {
            $besclwp_inline_style .= '#besocial-submenu #besocial-bdpress-mobile a{ font-size:' . $besclwp_h5size . 'px; }@media only screen and (max-width: 480px) {#besocial-submenu #besocial-bdpress-mobile a { font-size:' . ($besclwp_h5size - 2) . 'px; }}';
        } 
        
        if ((!empty($besclwp_5_color)) && ($besclwp_5_color != '#6b717e')) {
            $besclwp_inline_style .= '.besocial-member a.mutual-friends,#buddypress div.activity-header a,#buddypress .acomment-meta a,#buddypress #bpfb_video_url.changed,#buddypress #bpfb_link_preview_url.changed,#bpfb_tmp_photo_list,#buddypress .bpfb_preview_container { color:' . $besclwp_5_color . '; }';
        } 
        
        if ((!empty($besclwp_7_color)) && ($besclwp_7_color != '#ffffff')) {
            $besclwp_inline_style .= '#buddypress .activity-list li.load-more a,#buddypress .activity-list li.load-newest a,#buddypress a.bp-primary-action span,#buddypress #reply-title small a span,#buddypress .acomment-options a,#buddypress #pass-strength-result,#buddypress ul.button-nav li a:hover,#buddypress ul.button-nav li.current a,#sitewide-notice #message p,#sitewide-notice #close-notice:before,.widget_bp_core_sitewide_messages.besclwp-sidebar-box .bp-site-wide-message p,.widget_bp_core_sitewide_messages.besclwp-sidebar-box #close-notice:before,#buddypress .standard-form button,#buddypress a.button,#buddypress .generic-button a,#buddypress .comment-reply-link,a.bp-title-button,#buddypress .activity-list li.load-more.loading:after,#buddypress div.item-list-tabs ul li.current a,#buddypress div.item-list-tabs ul li a:hover span,.widget.buddypress div.item-options a,#besocial-submenu #besocial-bdpress-mobile a,#buddypress .bpfb_actions_container.bpfb-theme-new .bpfb_toolbarItem,#buddypress .bpfb_actions_container.bpfb-theme-new .bpfb_toolbarItem:visited,#buddypress .bpfb_actions_container.bpfb-theme-new,#bpfb_addPhotos,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addVideos,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addLinks,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addDocuments,button#rtmedia-add-media-button-post-update { color:' . $besclwp_7_color . '; }';
            $besclwp_inline_style .= '#buddypress div#item-header-cover-image .user-nicename a,#buddypress div#item-header-cover-image .user-nicename,#buddypress div#item-header h1.besocial-group-name,#buddypress li span.unread-count,#buddypress tr.unread span.unread-count,#buddypress div.item-list-tabs ul li.selected a { color:' . $besclwp_7_color . ' !important; }';
            $besclwp_inline_style .= '#buddypress form#whats-new-form textarea,#buddypress .besocial-whats-new-text,#buddypress #whats-new-form #message,#besocial-preview-loader-container,#besocial-preview,#besocial-preview-thumb img { background:' . $besclwp_7_color . '; }';
            $besclwp_inline_style .= '#buddypress div.item-list-tabs ul li.selected a span,#buddypress div.item-list-tabs ul li.current a span,#buddypress #cover-image-container .group-type { background-color:' . $besclwp_7_color . '; }';
            $besclwp_inline_style .= '#buddypress #item-header-cover-image #item-header-avatar img.avatar,body.besocial .bmf-white-popup { background:' . $besclwp_7_color . ' !important; }';          
            $besclwp_inline_style .= '#buddypress .bpfb_preview_photo_item { border: 3px solid ' . $besclwp_7_color . '; }';
            $besclwp_inline_style .= '#buddypress #whats-new-form {border: 10px double ' . $besclwp_7_color . ';}';
            $besclwp_inline_style .= '#buddypress form#whats-new-form textarea,#buddypress form#whats-new-form textarea:focus {border-color:' . $besclwp_7_color . ';}';
            $besclwp_inline_style .= '#buddypress #besocial-preview-thumb img {border: 5px solid ' . $besclwp_7_color . ';}';
        } 
        
        if ((!empty($besclwp_4_color)) && ($besclwp_4_color != '#427aa1')) {
            $besclwp_inline_style .= '#buddypress .item-list-tabs li.feed a:before,#besocial-bp-bar-left a,#buddypress table.notifications tr td a.mark-unread:hover:after,#buddypress table.notifications tr td a.delete:hover:after,#buddypress table.notifications tr td a.mark-read:hover:after,#buddypress table.messages-notices tr td.thread-options a.unread:hover:after,#buddypress table.messages-notices tr td.thread-options a.read:hover:after,#buddypress table.messages-notices tr td.thread-options a.delete:hover:after,.besocial-member a.mutual-friends:hover { color:' . $besclwp_4_color . '; }';
            $besclwp_inline_style .= 'body.besocial .rtm-options.rtm-options:after {border-bottom-color: ' . $besclwp_4_color . '; }';
            $besclwp_inline_style .= '#buddypress .activity-list li.load-more,#buddypress .activity-list li.load-newest,#buddypress .acomment-options a,#sitewide-notice #message p,.widget_bp_core_sitewide_messages.besclwp-sidebar-box .bp-site-wide-message p,#buddypress .standard-form button,#buddypress a.button,#buddypress .generic-button a,#buddypress .comment-reply-link,a.bp-title-button,#buddypress div.item-list-tabs ul li.selected a,#buddypress div.item-list-tabs ul li.current a,#buddypress li span.unread-count,#buddypress tr.unread span.unread-count,.widget.buddypress div.item-options a,#buddypress .bpfb_controls_container .qq-upload-button,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addPhotos.bpfb_toolbarItem,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addVideos.bpfb_toolbarItem,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addLinks.bpfb_toolbarItem,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addDocuments.bpfb_toolbarItem,body.besocial .rtmedia-list-item .rtmedia-album-media-count,body.besocial .rtm-options.rtm-options,#buddypress div.item-list-tabs ul li.active a,button#rtmedia-add-media-button-post-update { background:' . $besclwp_4_color . '; }';
            $besclwp_inline_style .= '#buddypress div#message p,#sitewide-notice p,#buddypress div#message-thread p#message-recipients,#buddypress .besocial-item-list-tabs li.current,#buddypress .besocial-item-list-tabs li.selected,#buddypress .bps_filters,body.besocial .rtmedia-no-media-found { border-left:3px solid ' . $besclwp_4_color . '; }';
            $besclwp_inline_style .= '.besocial-bp-page-title {border-left: 5px solid ' . $besclwp_4_color . ';}';
            $besclwp_inline_style .= '.widget.buddypress div.item-options a {border-right: 1px solid ' . $besclwp_4_color . ';}';
            $besclwp_inline_style .= '#besocial-preview-loader {border-top-color: ' . $besclwp_4_color . ' !important;}';
        } 
        
        if ((!empty($besclwp_1_color)) && ($besclwp_1_color != '#2c3d55')) {
            $besclwp_inline_style .= '#buddypress div.item-list-tabs ul li a,#buddypress div.item-list-tabs ul li span,#buddypress #cover-image-container .group-type,body.besocial .bmf-white-popup header { color:' . $besclwp_1_color . '; }';
            $besclwp_inline_style .= '@media only screen and (max-width: 782px) {#buddypress div#item-header-cover-image .user-nicename a,#buddypress div#item-header-cover-image .user-nicename,#buddypress div#item-header h1.besocial-group-name a,#buddypress div#item-header h1.besocial-group-name { color:' . $besclwp_1_color . ' !important; }}';
            $besclwp_inline_style .= '#buddypress .bpfb_actions_container.bpfb-theme-new .bpfb_toolbarItem:active,#buddypress .bpfb_actions_container.bpfb-theme-new .bpfb_toolbarItem:hover,#buddypress .bpfb_actions_container.bpfb-theme-new .bpfb_toolbarItem.bpfb_active,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addPhotos.bpfb_toolbarItem:active,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addPhotos.bpfb_toolbarItem:hover,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addPhotos.bpfb_active,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addVideos.bpfb_toolbarItem:active,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addVideos.bpfb_toolbarItem:hover,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addVideos.bpfb_active,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addLinks.bpfb_toolbarItem:active,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addLinks.bpfb_toolbarItem:hover,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addLinks.bpfb_active,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addDocuments.bpfb_toolbarItem:active,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addDocuments.bpfb_toolbarItem:hover,#buddypress .bpfb_actions_container.bpfb-theme-new #bpfb_addDocuments.bpfb_active.bpfb_toolbarItem{background:' . $besclwp_1_color . ';}';
        }
        
        if ((!empty($besclwp_3_color)) && ($besclwp_3_color != '#3e6990')) {
            $besclwp_inline_style .= '#buddypress .activity-list li.load-more:hover,#buddypress .activity-list li.load-newest:hover,#buddypress div.activity-meta,#buddypress div.activity-meta a.delete-activity,#buddypress div.activity-meta a.delete-activity-single,#buddypress .acomment-options a.acomment-delete,#buddypress a.bp-primary-action span,#buddypress #reply-title small a span,#buddypress .acomment-options,#buddypress .acomment-options a:hover,#buddypress ul.button-nav li a:hover,#buddypress ul.button-nav li.current a,#buddypress .standard-form button:hover,#buddypress a.button:hover,#buddypress a.button:focus,#buddypress div.generic-button a:hover,#buddypress .comment-reply-link:hover,#buddypress .activity-list li.load-more.loading,.widget.buddypress div.item-options a:hover,.widget.buddypress div.item-options a:focus,#besocial-submenu #besocial-bdpress-mobile,#buddypress input.bpfb_primary_button,#buddypress input.bpfb_primary_button:hover,button#rtmedia-add-media-button-post-update:hover { background:' . $besclwp_3_color . '; }';
            $besclwp_inline_style .= '@media only screen and (max-width: 782px) {#buddypress div#item-header-cover-image .user-nicename a,#buddypress div#item-header-cover-image .user-nicename,#buddypress div#item-header h1.besocial-group-name a,#buddypress div#item-header h1.besocial-group-name { color:' . $besclwp_3_color . ' !important; }}';
        }
        
        if ((!empty($besclwp_6_color)) && ($besclwp_6_color != '#f1f1f1')) {
            $besclwp_inline_style .= '#buddypress #pass-strength-result,#buddypress div.item-list-tabs ul li a,#buddypress div.item-list-tabs ul li span,#buddypress #header-cover-image,#buddypress #item-header { background-color:' . $besclwp_6_color . '; }';
            $besclwp_inline_style .= '#buddypress div.activity-comments form.ac-form,#buddypress #whats-new-form,#buddypress div#message p,#sitewide-notice p,#buddypress p.error,#buddypress p.warning,#buddypress p.updated,#buddypress ul.button-nav li a,#buddypress table.notifications thead tr,#buddypress table.notifications-settings thead tr,#buddypress table.profile-settings thead tr,#buddypress table.profile-fields thead tr,#buddypress table.wp-profile-fields thead tr,#buddypress table.messages-notices thead tr,#buddypress table.forum thead tr,#buddypress div#message-thread p#message-recipients,#buddypress ul.acfb-holder li.friend-tab,#buddypress ul#topic-post-list li.alt,#buddypress .html-active button.switch-html,#buddypress .tmce-active button.switch-tmce,.besocial-bp-page-title,#buddypress .besocial-item-list-tabs li,#buddypress .besocial-invite-top ul,#buddypress .bp-cover-image-status p.warning,#buddypress #bbpress-forums div.bbp-template-notice,#buddypress #bbpress-forums div.indicator-hint,.widget_bps_widget #buddypress form .clear-value,.besocial-numeric-pagination ul li,input[type="file"],body.besocial .media_search.media_search .search_option,body.besocial .rtmedia-item-title,body.besocial .rtm-media-single-comments textarea,body.besocial .rtm-comment-list li,body.besocial .rtmedia-no-media-found { background:' . $besclwp_6_color . '; }';
            $besclwp_inline_style .= '#buddypress #bbpress-forums div.bbp-the-content-wrapper input{ background:' . $besclwp_6_color . ' !important; }';
            $besclwp_inline_style .= '#buddypress table.notifications,#buddypress table.notifications-settings,#buddypress table.profile-settings,#buddypress table.profile-fields,#buddypress table.wp-profile-fields,#buddypress table.messages-notices,#buddypress table.forum,#buddypress table.notifications td,#buddypress table.notifications-settings td,#buddypress table.profile-settings td,#buddypress table.profile-fields tr td,#buddypress table.wp-profile-fields td,#buddypress table.messages-notices td,#buddypress table.forum td,#buddypress div#message-thread div.message-box,#buddypress .wp-editor-container,#besocial-invite-list ul,#buddypress .besocial-member-outer,#buddypress .besocial-group-outer,#buddypress #bbpress-forums li.bbp-body,.besocial-notice-div,#front-end-post-form ul.cmb2-checkbox-list li,,#besocial-bp-widgets .besclwp-article-list,#besocial-bp-widgets-mobile .besclwp-article-list {border:1px solid ' . $besclwp_6_color . ';}';
            $besclwp_inline_style .= '#buddypress #bbpress-forums input,#buddypress #bbpress-forums textarea,body.besocial .media_search.media_search .media_search_input {border:3px solid ' . $besclwp_6_color . ';}';
            $besclwp_inline_style .= 'body.activity-permalink #buddypress .activity-list li .activity-content,#buddypress table.notification-settings,#buddypress ul.item-list li,#buddypress #bbpress-forums #bbp-single-user-details #bbp-user-navigation a,.widget_bps_widget #buddypress form .radio {border-bottom:1px solid ' . $besclwp_6_color . ';}@media only screen and (max-width: 480px) {.bp-notice-buttons {border-bottom: 1px solid ' . $besclwp_6_color . ';}}';
            $besclwp_inline_style .= '#buddypress div.activity-comments ul li,#buddypress ul.item-list,#buddypress .bbp-topic-form,.bbp-reply-form,.bbp-topic-tag-form,.bp-notice-buttons,.widget_bps_widget #buddypress form .radio {border-top:1px solid ' . $besclwp_6_color . ';}';
            $besclwp_inline_style .= '#buddypress .activity-list li.new_forum_post .activity-content .activity-inner,#buddypress .activity-list li.new_forum_topic .activity-content .activity-inner {border-top:2px solid ' . $besclwp_6_color . ';}';
            $besclwp_inline_style .= '#buddypress .besocial-item-list-tabs li {border-left:3px solid ' . $besclwp_6_color . ';}';
    }
        
        wp_add_inline_style( 'besclwp-bp-custom', $besclwp_inline_style );
    }
}
add_action('wp_enqueue_scripts', 'besclwp_print_bp_styles', 99);
?>