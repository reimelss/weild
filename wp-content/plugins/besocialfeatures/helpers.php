<?php
// Post Count
function besocial_post_count() {
    echo esc_html(wp_count_posts()->publish);
}
// Product Count
function besocial_product_count() {
    echo esc_html(wp_count_posts('product')->publish);
}
// Comment Count
function besocial_comment_count() {
    echo esc_html(wp_count_comments()->approved);
}
// Member Count
function besocial_member_count() {
    if ( function_exists( 'bp_core_get_total_member_count' ) ) {
        echo esc_html(bp_core_get_total_member_count());
    }
    else {
        echo '0';
    }
}
// Like Count
function besocial_like_count() {
    if ( function_exists( 'besocial_get_like_count' ) ) {
        echo esc_html(besocial_get_like_count());
    }
    else {
        echo '0';
    }
}
// Dislike Count
function besocial_dislike_count() {
    if ( function_exists( 'besocial_get_dislike_count' ) ) {
        echo esc_html(besocial_get_dislike_count());
    }
    else {
        echo '0';
    }
}
// BuddyPress Group Count
function besocial_bp_group_count() {
    if ( function_exists( 'groups_get_total_group_count' ) ) {
        echo esc_html(groups_get_total_group_count());
    }
    else {
        echo '0';
    }
}
// BuddyPress Activity Count
function besocial_bp_activity_count() {
    if ( bp_is_active( 'activity' ) ) {
    global $bp, $wpdb;
	$item_id = null;
    
    $count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(id) FROM {$wpdb->prefix}bp_activity 
					WHERE type = 'activity_update'
					AND item_id = '%s' ", $item_id ) );	
    echo esc_html($count);
    } else {
        echo '0';
    }
}
// BbPress Forum Count
function besocial_bbpress_forum_count() {
    $stats = bbp_get_statistics();
    if ( function_exists( 'bbp_get_statistics' ) ) {
        echo esc_html( $stats['forum_count'] );
    } else {
        echo '0';
    }
}
// BbPress Topic Count
function besocial_bbpress_topic_count() {
    $stats = bbp_get_statistics();
    if ( function_exists( 'bbp_get_statistics' ) ) {
        echo esc_html( $stats['topic_count'] );
    } else {
        echo '0';
    }
}

// BbPress Reply Count
function besocial_bbpress_reply_count() {
    $stats = bbp_get_statistics();
    if ( function_exists( 'bbp_get_statistics' ) ) {
        echo esc_html( $stats['reply_count'] );
    } else {
        echo '0';
    }
}

// BbPress Topic Tag Count
function besocial_bbpress_topic_tag_count() {
    $stats = bbp_get_statistics();
    if ( function_exists( 'bbp_get_statistics' ) ) {
        echo esc_html( $stats['topic_tag_count'] );
    } else {
        echo '0';
    }
}
?>