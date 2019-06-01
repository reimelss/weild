<?php $besclwp_settings_icon = get_option('besclwp_settings_icon'); ?>
<?php $besclwp_menu_title = get_option('besclwp_settings_title'); ?>
<!-- SETTINGS -->
<?php if ( bp_is_active( 'settings' ) ) { ?>
<li id="settings-besocial" class="has-submenu"><a href="#"><i class="fa <?php if (!empty($besclwp_settings_icon)) { echo esc_attr($besclwp_settings_icon); } else { echo 'fa-gears'; } ?>"></i></a>
    <ul class="sidemenu-sub">
        <li>
            <h5>
                <?php if (!empty($besclwp_menu_title)) { echo esc_html($besclwp_menu_title); } else { esc_html_e( 'Settings', 'besocial'); } ?>
            </h5>
        </li>
        <?php do_action( 'besocial_before_settings_menu' ); ?>
        <li id="general-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_SETTINGS_SLUG ?>"><?php echo esc_html__( 'General', 'besocial'); ?> <i class="fa fa-gear"></i></a></li>
        <li id="email-notifications-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_SETTINGS_SLUG ?>/notifications/"><?php echo esc_html__( 'Email Notifications', 'besocial'); ?> <i class="fa fa-envelope-o"></i></a></li>
        <li id="profile-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_SETTINGS_SLUG ?>/profile/"><?php echo esc_html__( 'Profile Visibility', 'besocial'); ?> <i class="fa fa-eye"></i></a>
        </li>
        <li id="logout-besocial"><a href="<?php echo wp_logout_url( home_url() ); ?>"><?php echo esc_html__( 'Logout', 'besocial'); ?> <i class="fa fa-sign-out"></i></a>
        </li>
        <?php do_action( 'besocial_after_settings_menu' ); ?>
    </ul>
</li>
<?php } ?>