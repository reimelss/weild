<?php $besclwp_groups_icon = get_option('besclwp_groups_icon'); ?>
<?php $besclwp_menu_title = get_option('besclwp_groups_title'); ?>
<!-- GROUPS -->
<?php if ( bp_is_active( 'groups' ) ) { ?>
<?php
$groups = groups_get_invites_for_user(bp_loggedin_user_id());
$groupsInviteCount = $groups['total'];
?>
<li id="groups-besocial" class="has-submenu" data-count="<?php echo esc_html($groupsInviteCount); ?>">
    <a href="#">
        <div class="icon-count"><?php echo esc_html($groupsInviteCount); ?></div><i class="fa <?php if (!empty($besclwp_groups_icon)) { echo esc_attr($besclwp_groups_icon); } else { echo 'fa-cubes'; } ?>"></i>
    </a>
    <ul class="sidemenu-sub">
        <li>
            <h5>
                <?php if (!empty($besclwp_menu_title)) { echo esc_html($besclwp_menu_title); } else { esc_html_e( 'Groups', 'besocial'); } ?>
            </h5>
        </li>
        <?php do_action( 'besocial_before_groups_menu' ); ?>
        <li id="groups-my-groups-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_GROUPS_SLUG ?>"><?php echo esc_html__( 'Affiliate Memberships', 'besocial'); ?></a></li>
        <li id="invites-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_GROUPS_SLUG ?>/invites/"><?php echo esc_html__( 'Invitations', 'besocial'); ?><span class="icon-count-list"><?php echo esc_html($groupsInviteCount); ?></span></a></li>
        <li id="create-group-besocial"><a href="<?php echo bp_loggedin_user_domain() . BP_GROUPS_SLUG ?>/create/"><?php echo esc_html__( 'Create a Group', 'besocial'); ?> <i class="fa fa-plus"></i></a></li>
        <?php do_action( 'besocial_after_groups_menu' ); ?>
    </ul>
</li>
<?php } ?>