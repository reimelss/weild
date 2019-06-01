<?php $besclwp_profile_icon = get_option('besclwp_profile_icon'); ?>
<?php $besclwp_menu_title = get_option('besclwp_profile_title'); ?>
<!-- PROFILE -->
<?php if ( bp_is_active( 'xprofile' ) ) { ?>
<li id="xprofile-besocial" class="has-submenu"><a href="#"><i class="fa <?php if (!empty($besclwp_profile_icon)) { echo esc_attr($besclwp_profile_icon); } else { echo 'fa-user'; } ?>"></i></a>
    <ul class="sidemenu-sub">
        <li>
            <?php bp_loggedin_user_avatar() ?>
            <h5>
                <?php if (!empty($besclwp_menu_title)) { echo esc_html($besclwp_menu_title); } else { esc_html_e( 'Profile', 'besocial'); } ?>
            </h5>
        </li>
        <?php do_action( 'besocial_before_profile_menu' ); ?>
        <li><a href="<?php echo bp_loggedin_user_domain() . BP_XPROFILE_SLUG ?>"><?php echo esc_html__( 'View Profile', 'besocial'); ?></a></li>
        <li><a href="<?php echo bp_loggedin_user_domain() . BP_XPROFILE_SLUG ?>/edit/"><?php echo esc_html__( 'Edit Profile', 'besocial'); ?></a></li>
        <li><a href="<?php echo bp_loggedin_user_domain() . BP_XPROFILE_SLUG ?>/change-avatar/"><?php echo esc_html__( 'Change Profile Photo', 'besocial'); ?></a></li>
        <?php if (get_option('besclwp_disable_p_cover') != 'true') { ?>
        <li><a href="<?php echo bp_loggedin_user_domain() . BP_XPROFILE_SLUG ?>/change-cover-image/"><?php echo esc_html__( 'Change Cover Image', 'besocial'); ?></a></li>
        <?php } ?>
        <?php if ( bp_is_active( 'blogs' ) ) { ?>
        <li id="mysites-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_BLOGS_SLUG ?>"><?php echo esc_html__( 'My Sites', 'besocial'); ?> <i class="fa fa-globe"></i></a>
        </li>
        <?php } ?>
        <?php do_action( 'besocial_after_profile_menu' ); ?>
    </ul>
</li>
<?php } ?>