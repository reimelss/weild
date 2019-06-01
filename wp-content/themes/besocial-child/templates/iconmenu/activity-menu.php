<?php $besclwp_activity_icon = get_option('besclwp_activity_icon'); ?>
<?php $besclwp_menu_title = get_option('besclwp_activity_title'); ?>
<!-- ACTIVITY -->
<?php if ( bp_is_active( 'activity' ) ) { ?>
<li id="activity-besocial" class="has-submenu"><a href="#"><i class="fa <?php if (!empty($besclwp_activity_icon)) { echo esc_attr($besclwp_activity_icon); } else { echo 'fa-home'; } ?>"></i></a>
    <ul class="sidemenu-sub">
        <li>
            <h5>
                <?php if (!empty($besclwp_menu_title)) { echo esc_html($besclwp_menu_title); } else { esc_html_e( 'Activity', 'besocial'); } ?>
            </h5>
        </li>
        <?php do_action( 'besocial_before_activity_menu' ); ?>
        <li><a href="<?php echo bp_loggedin_user_domain() . BP_ACTIVITY_SLUG ?>"><?php echo esc_html__( 'Personal', 'besocial'); ?></a></li>
        <li><a href="<?php echo bp_loggedin_user_domain() . BP_ACTIVITY_SLUG ?>/mentions/"><?php echo esc_html__( 'Mentions', 'besocial'); ?></a></li>
        <li><a href="<?php echo bp_loggedin_user_domain() . BP_ACTIVITY_SLUG ?>/favorites/"><?php echo esc_html__( 'Favorites', 'besocial'); ?></a></li>
        <li><a href="<?php echo bp_loggedin_user_domain() . BP_ACTIVITY_SLUG ?>/friends/"><?php echo esc_html__( 'Friends', 'besocial'); ?></a></li>
        <li><a href="<?php echo bp_loggedin_user_domain() . BP_ACTIVITY_SLUG ?>/groups/"><?php echo esc_html__( 'Groups', 'besocial'); ?></a></li>
        <?php do_action( 'besocial_after_activity_menu' ); ?>
    </ul>
</li>
<?php } ?>