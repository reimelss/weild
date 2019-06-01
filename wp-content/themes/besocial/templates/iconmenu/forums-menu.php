<?php $besclwp_forums_icon = get_option('besclwp_forums_icon'); ?>
<?php $besclwp_menu_title = get_option('besclwp_forums_title'); ?>
<!-- FORUMS -->
<?php if ( class_exists( 'bbPress' ) ) { ?>
<li id="forums-besocial" class="has-submenu"><a href="#"><i class="fa <?php if (!empty($besclwp_forums_icon)) { echo esc_attr($besclwp_forums_icon); } else { echo 'fa-comments'; } ?>"></i></a>
    <ul class="sidemenu-sub">
        <li>
            <h5>
                <?php if (!empty($besclwp_menu_title)) { echo esc_html($besclwp_menu_title); } else { esc_html_e( 'Forums', 'besocial'); } ?>
            </h5>
        </li>
        <?php do_action( 'besocial_before_forums_menu' ); ?>
        <li id="topics-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_FORUMS_SLUG ?>"><?php echo esc_html__( 'Topics Started', 'besocial'); ?></a></li>
        <li id="replies-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_FORUMS_SLUG ?>/replies/"><?php echo esc_html__( 'Replies Created', 'besocial'); ?></a></li>
        <li id="favorites-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_FORUMS_SLUG ?>/favorites/"><?php echo esc_html__( 'Favorites', 'besocial'); ?></a></li>
        <li id="subscriptions-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_FORUMS_SLUG ?>/subscriptions/"><?php echo esc_html__( 'Subscriptions', 'besocial'); ?></a></li>
        <?php do_action( 'besocial_after_forums_menu' ); ?>
    </ul>
</li>
<?php } ?>