<?php $besclwp_messages_icon = get_option('besclwp_messages_icon'); ?>
<?php $besclwp_menu_title = get_option('besclwp_messages_title'); ?>
<!-- MESSAGES -->
<?php if ( bp_is_active( 'messages' ) ) { ?>
<li id="messages-besocial" class="has-submenu" data-count="<?php echo messages_get_unread_count(bp_loggedin_user_id()); ?>">
    <a href="#">
        <div class="icon-count"><?php echo messages_get_unread_count(bp_loggedin_user_id()); ?></div><i class="fa <?php if (!empty($besclwp_messages_icon)) { echo esc_attr($besclwp_messages_icon); } else { echo 'fa-envelope'; } ?>"></i>
    </a>
    <ul class="sidemenu-sub">
        <li>
            <h5>
                <?php if (!empty($besclwp_menu_title)) { echo esc_html($besclwp_menu_title); } else { esc_html_e( 'Messages', 'besocial'); } ?>
            </h5>
        </li>
        <?php do_action( 'besocial_before_messages_menu' ); ?>
        <li id="inbox-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_MESSAGES_SLUG ?>"><?php echo esc_html__( 'Inbox', 'besocial'); ?><span class="icon-count-list"><?php echo messages_get_unread_count(bp_loggedin_user_id()); ?></span></a></li>
        <li id="starred-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_MESSAGES_SLUG ?>/starred/"><?php echo esc_html__( 'Starred', 'besocial'); ?></a></li>
        <li id="sentbox-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_MESSAGES_SLUG ?>/sentbox/"><?php echo esc_html__( 'Sent', 'besocial'); ?></a></li>
        <li id="compose-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_MESSAGES_SLUG ?>/compose/"><?php echo esc_html__( 'Compose', 'besocial'); ?></a></li>
        <?php if( current_user_can('administrator')) { ?>
        <li id="notices-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_MESSAGES_SLUG ?>/notices/"><?php echo esc_html__( 'Notices', 'besocial'); ?></a></li>
        <?php } ?>
        <?php do_action( 'besocial_after_messages_menu' ); ?>
    </ul>
</li>
<?php } ?>