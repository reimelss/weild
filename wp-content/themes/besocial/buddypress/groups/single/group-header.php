<?php
/**
 * BuddyPress - Groups Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the display of a group's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_group_header' );

?>

<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
	<div id="item-header-avatar" class="besocial-no-cover-avatar">
		<a href="<?php echo esc_url( bp_get_group_permalink() ); ?>" title="<?php echo esc_attr( bp_get_group_name() ); ?>">

			<?php bp_group_avatar(); ?>

		</a>
	</div><!-- #item-header-avatar -->
<?php endif; ?>

<div id="item-header-content" class="besocial-group-meta-no-cover">
    <div class="besocial-no-cover-container">
	<h1><?php bp_current_group_name(); ?></h1>
        <p class="besocial-member-since"><strong><?php bp_group_type(); ?></strong></p>
    <p class="besocial-member-since"><i class="fa fa-users"></i> <?php echo esc_html__( 'Created', 'besocial'); ?> <?php bp_group_date_created(); ?></p>
    <span class="activity"><?php echo esc_html__( 'Last activity was', 'besocial'); ?></span> <span class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_group_last_active( 0, array( 'relative' => false ) ) ); ?>"><?php printf( __( 'active %s', 'besocial' ), bp_get_group_last_active() ); ?></span>

	<?php

	/**
	 * Fires before the display of the group's header meta.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_before_group_header_meta' ); ?>

	<div id="item-meta">

				<?php

				/**
				 * Fires after the group header actions section.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_group_header_meta' ); ?>

				<?php bp_group_description(); ?>

				<?php bp_group_type_list(); ?>
			</div>
    </div>
</div><!-- #item-header-content -->
<div class="clear"></div>
<div id="item-buttons" class="besocial-no-cover"><?php
/**
* Fires in the group header actions section.
*
* @since 1.2.6
*/
do_action( 'bp_group_header_actions' ); ?></div><!-- #item-buttons -->

<?php

/**
 * Fires after the display of a group's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_group_header' );  ?>