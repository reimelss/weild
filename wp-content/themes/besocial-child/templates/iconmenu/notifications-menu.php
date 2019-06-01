<?php $besclwp_notifications_icon = get_option('besclwp_notifications_icon'); ?>
<!-- NOTIFICATIONS -->
<?php if ( bp_is_active( 'notifications' ) ) { ?>
<li id="notifications-besocial" class="has-submenu" data-count="<?php echo bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ); ?>">
    <a href="#">
        <div class="icon-count"><?php echo bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ); ?></div><i class="fa <?php if (!empty($besclwp_notifications_icon)) { echo esc_attr($besclwp_notifications_icon); } else { echo 'fa-bell'; } ?>"></i>
    </a>
    <ul class="sidemenu-sub">
        <li>
            <h5>
                <?php if (!empty($besclwp_menu_title)) { echo esc_html($besclwp_menu_title); } else { esc_html_e( 'Notifications', 'besocial'); } ?>
            </h5>
        </li>
        <?php do_action( 'besocial_before_notifications_menu' ); ?>
        <li class="notification-content">
            <?php echo besocial_get_user_notifications(); ?>
        </li>
        <li id="notifications-my-notifications-besocial"><a href="<?php echo bp_loggedin_user_domain(); ?>notifications/"><?php echo esc_html__( 'View All', 'besocial'); ?><span class="icon-count-list"><?php echo bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ); ?></span></a></li>
        <?php do_action( 'besocial_after_notifications_menu' ); ?>
    </ul>
</li>
<?php } ?>