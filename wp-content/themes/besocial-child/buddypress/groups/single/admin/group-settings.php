<?php
/**
 * BuddyPress - Groups Admin - Group Settings
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<h2 class="bp-screen-reader-text"><?php esc_html_e( 'Manage Group Settings', 'besocial' ); ?></h2>

<?php

/**
 * Fires before the group settings admin display.
 *
 * @since 1.1.0
 */
do_action( 'bp_before_group_settings_admin' ); ?>

<?php if ( bp_is_active( 'forums' ) ) : ?>

	<?php if ( bp_forums_is_installed_correctly() ) : ?>

		<div class="checkbox">
			<label for="group-show-forum"><input type="checkbox" name="group-show-forum" id="group-show-forum" value="1"<?php bp_group_show_forum_setting(); ?> /> <?php esc_html_e( 'Enable discussion forum', 'besocial' ); ?></label>
		</div>

		<hr />

	<?php endif; ?>

<?php endif; ?>

<fieldset class="group-create-privacy">

	<legend><?php esc_html_e( 'Privacy Options', 'besocial' ); ?></legend>

	<div class="radio">

		<label for="group-status-public"><input type="radio" name="group-status" id="group-status-public" value="public"<?php if ( 'public' == bp_get_new_group_status() || !bp_get_new_group_status() ) { ?> checked="checked"<?php } ?> aria-describedby="public-group-description" /> <?php esc_html_e( 'This is a public group', 'besocial' ); ?></label>

		<ul id="public-group-description">
			<li><?php esc_html_e( 'Any site affiliate can join this group.', 'besocial' ); ?></li>
			<li><?php esc_html_e( 'This group will be listed in the groups directory and in search results.', 'besocial' ); ?></li>
			<li><?php esc_html_e( 'Group content and activity will be visible to any site affiliate.', 'besocial' ); ?></li>
		</ul>

		<label for="group-status-private"><input type="radio" name="group-status" id="group-status-private" value="private"<?php if ( 'private' == bp_get_new_group_status() ) { ?> checked="checked"<?php } ?> aria-describedby="private-group-description" /> <?php esc_html_e( 'This is a private group', 'besocial' ); ?></label>

		<ul id="private-group-description">
			<li><?php esc_html_e( 'Only users who request affiliate membership and are accepted can join the group.', 'besocial' ); ?></li>
			<li><?php esc_html_e( 'This group will be listed in the groups directory and in search results.', 'besocial' ); ?></li>
			<li><?php esc_html_e( 'Group content and activity will only be visible to affiliates of the group.', 'besocial' ); ?></li>
		</ul>

		<label for="group-status-hidden"><input type="radio" name="group-status" id="group-status-hidden" value="hidden"<?php if ( 'hidden' == bp_get_new_group_status() ) { ?> checked="checked"<?php } ?> aria-describedby="hidden-group-description" /> <?php esc_html_e('This is a hidden group', 'besocial' ); ?></label>

		<ul id="hidden-group-description">
			<li><?php esc_html_e( 'Only users who are invited can join the group.', 'besocial' ); ?></li>
			<li><?php esc_html_e( 'This group will not be listed in the groups directory or search results.', 'besocial' ); ?></li>
			<li><?php esc_html_e( 'Group content and activity will only be visible to affiliates of the group.', 'besocial' ); ?></li>
		</ul>

	</div>

</fieldset>

<?php // Group type selection ?>
<?php if ( $group_types = bp_groups_get_group_types( array( 'show_in_create_screen' => true ), 'objects' ) ): ?>

	<fieldset class="group-create-types">
		<legend><?php esc_html_e( 'Group Types', 'besocial' ); ?></legend>

		<p><?php esc_html_e( 'Select the types this group should be a part of.', 'besocial' ); ?></p>

		<?php foreach ( $group_types as $type ) : ?>
			<div class="checkbox">
				<label for="<?php printf( 'group-type-%s', $type->name ); ?>">
					<input type="checkbox" name="group-types[]" id="<?php printf( 'group-type-%s', $type->name ); ?>" value="<?php echo esc_attr( $type->name ); ?>" <?php checked( bp_groups_has_group_type( bp_get_current_group_id(), $type->name ) ); ?>/> <?php echo esc_html( $type->labels['name'] ); ?>
					<?php
						if ( ! empty( $type->description ) ) {
							printf( __( '&ndash; %s', 'besocial' ), '<span class="bp-group-type-desc">' . esc_html( $type->description ) . '</span>' );
						}
					?>
				</label>
			</div>

		<?php endforeach; ?>

	</fieldset>

<?php endif; ?>

<fieldset class="group-create-invitations">

	<legend><?php esc_html_e( 'Group Invitations', 'besocial' ); ?></legend>

	<p><?php esc_html_e( 'Which affiliates of this group are allowed to invite others?', 'besocial' ); ?></p>

	<div class="radio">

		<label for="group-invite-status-members"><input type="radio" name="group-invite-status" id="group-invite-status-members" value="members"<?php bp_group_show_invite_status_setting( 'members' ); ?> /> <?php esc_html_e( 'All group affiliates', 'besocial' ); ?></label>

		<label for="group-invite-status-mods"><input type="radio" name="group-invite-status" id="group-invite-status-mods" value="mods"<?php bp_group_show_invite_status_setting( 'mods' ); ?> /> <?php esc_html_e( 'Group admins and mods only', 'besocial' ); ?></label>

		<label for="group-invite-status-admins"><input type="radio" name="group-invite-status" id="group-invite-status-admins" value="admins"<?php bp_group_show_invite_status_setting( 'admins' ); ?> /> <?php esc_html_e( 'Group admins only', 'besocial' ); ?></label>

	</div>

</fieldset>

<?php

/**
 * Fires after the group settings admin display.
 *
 * @since 1.1.0
 */
do_action( 'bp_after_group_settings_admin' ); ?>

<p><input type="submit" value="<?php esc_attr_e( 'Save Changes', 'besocial' ); ?>" id="save" name="save" /></p>
<?php wp_nonce_field( 'groups_edit_group_settings' ); ?>
