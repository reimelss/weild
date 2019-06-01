<?php
/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php

/**
 * Fires before the display of a member's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_member_header' ); ?>

<div id="item-header-avatar" class="besocial-no-cover-avatar">
	<a href="<?php bp_displayed_user_link(); ?>">

		<?php bp_displayed_user_avatar( 'type=full' ); ?>

	</a>
</div>
<?php $besclwp_member_id = bp_displayed_user_id(); ?>
<div id="item-header-content" class="<?php besclwp_featured_check($besclwp_member_id); ?>">
    <div class="besocial-no-cover-container">
        <h2 class="user-nicename"><?php bp_displayed_user_fullname(); ?></h2>
	   <?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) : ?>
		<span class="besocial-mentionname">@<?php bp_displayed_user_mentionname(); ?></span>
	   <?php endif; ?>
        <p class="besocial-member-since"><?php echo esc_html__( 'Affiliate since', 'besocial'); ?> <?php echo besclwp_get_member_since(); ?></p>    
        <span class="activity"><?php echo esc_html__( 'was active', 'besocial'); ?></span> <span class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_user_last_activity( bp_displayed_user_id() ) ); ?>"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>

	<?php

	/**
	 * Fires before the display of the member's header meta.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_before_member_header_meta' ); ?>

	<div id="item-meta">

		<?php if ( bp_is_active( 'activity' ) ) : ?>

			<div id="latest-update">

				<?php bp_activity_latest_update( bp_displayed_user_id() ); ?>

			</div>

		<?php endif; ?>
        </div>

		<?php

		 /**
		  * Fires after the group header actions section.
		  *
		  * If you'd like to show specific profile fields here use:
		  * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
		  *
		  * @since 1.2.0
		  */
		 do_action( 'bp_profile_header_meta' );

		 ?>

	</div><!-- #item-meta -->

</div><!-- #item-header-content -->
<div class="clear"></div>
<div id="item-buttons" class="besocial-no-cover">
<?php
/**
* Fires in the member header actions section.
*
* @since 1.2.6
*/
do_action( 'bp_member_header_actions' ); ?>
</div><!-- #item-buttons -->

<?php

/**
 * Fires after the display of a member's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_member_header' ); ?>