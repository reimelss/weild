<?php
/**
 * BuddyPress - Group Invites Loop
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

	<div id="invite-list" class="besocial-invite-top">

		<ul>
			<?php bp_new_group_invite_friend_list(); ?>
		</ul>

		<?php wp_nonce_field( 'groups_invite_uninvite_user', '_wpnonce_invite_uninvite_user' ); ?>

	</div>
<div class="clear"></div>


<div class="besocial-invite-bottom">

	<?php

	/**
	 * Fires before the display of the group send invites list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_group_send_invites_list' ); ?>

	<?php if ( bp_group_has_invites( bp_ajax_querystring( 'invite' ) . '&per_page=10' ) ) : ?>

		<div id="pag-top" class="pagination">

			<div class="pag-count" id="group-invite-count-top">

				<?php bp_group_invite_pagination_count(); ?>

			</div>

			<div class="pagination-links" id="group-invite-pag-top">

				<?php bp_group_invite_pagination_links(); ?>

			</div>

		</div>

		<?php /* The ID 'friend-list' is important for AJAX support. */ ?>
		<div id="friend-list" class="besocial-members-list">

		<?php while ( bp_group_invites() ) : bp_group_the_invite(); ?>
        <?php $besclwp_member_id = bp_get_member_user_id(); ?>
        <div class="besocial-member-outer <?php besclwp_featured_check($besclwp_member_id); ?>">
		<div id="<?php bp_group_invite_item_id(); ?>" class="besocial-member-inner">
            <div class="besocial-member-avatar">
				<?php bp_group_invite_user_avatar(); ?>
			</div>
            
            <div class="besocial-member">
				<div class="besocial-member-title">
					<?php bp_group_invite_user_link(); ?>
				</div>

				<div class="besocial-member-meta"><i class="fa fa-clock-o"></i> <span class="activity"><?php bp_group_invite_user_last_active(); ?></span></div>

				<?php

				/**
				 * Fires inside the invite item listing.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_group_send_invites_item' ); ?>
			</div>
            
            <div class="besocial-member-action">
                <a class="button remove" href="<?php bp_group_invite_user_remove_invite_url(); ?>" id="<?php bp_group_invite_item_id(); ?>"><?php esc_html_e( 'Remove Invite', 'besocial' ); ?></a>
				<?php

				/**
				* Fires inside the action area for a send invites item.
				*
				* @since 1.1.0
				*/
				do_action( 'bp_group_send_invites_item_action' ); ?>
			</div>
        </div>
        </div>
		<?php endwhile; ?>

		</div><!-- #friend-list -->

		<div id="pag-bottom" class="pagination">

			<div class="pag-count" id="group-invite-count-bottom">

				<?php bp_group_invite_pagination_count(); ?>

			</div>

			<div class="pagination-links" id="group-invite-pag-bottom">

				<?php bp_group_invite_pagination_links(); ?>

			</div>

		</div>

	<?php else : ?>

		<div id="message" class="info">
			<p><?php esc_html_e( 'Select friends to invite.', 'besocial' ); ?></p>
		</div>

	<?php endif; ?>

<?php

/**
 * Fires after the display of the group send invites list.
 *
 * @since 1.1.0
 */
do_action( 'bp_after_group_send_invites_list' ); ?>

</div><!-- .main-column -->
