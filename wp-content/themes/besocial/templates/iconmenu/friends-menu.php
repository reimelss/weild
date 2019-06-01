<?php $besclwp_friends_icon = get_option('besclwp_friends_icon'); ?>
<?php $besclwp_menu_title = get_option('besclwp_friends_title'); ?>
<!-- FRIENDS -->
<?php if ( bp_is_active( 'friends' ) ) { ?>
<li id="friends-besocial" class="has-submenu" data-count="<?php echo bp_friend_get_total_requests_count(bp_loggedin_user_id()); ?>">
    <a href="#">
        <div class="icon-count"><?php echo bp_friend_get_total_requests_count(bp_loggedin_user_id()); ?></div><i class="fa <?php if (!empty($besclwp_friends_icon)) { echo esc_attr($besclwp_friends_icon); } else { echo 'fa-users'; } ?>"></i>
    </a>
    <ul class="sidemenu-sub">
        <li>
            <h5>
                <?php if (!empty($besclwp_menu_title)) { echo esc_html($besclwp_menu_title); } else { esc_html_e( 'Friends', 'besocial'); } ?>
            </h5>
        </li>
        <?php do_action( 'besocial_before_friends_menu' ); ?>
        <li id="friends-my-friends-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_FRIENDS_SLUG ?>"><?php echo esc_html__( 'Friendships', 'besocial'); ?></a></li>
        <li id="requests-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_FRIENDS_SLUG ?>/requests/"><?php echo esc_html__( 'Requests', 'besocial'); ?><span class="icon-count-list"><?php echo bp_friend_get_total_requests_count(bp_loggedin_user_id()); ?></span></a></li>
        <?php do_action( 'besocial_after_friends_menu' ); ?>
    </ul>
</li>
<?php } ?>