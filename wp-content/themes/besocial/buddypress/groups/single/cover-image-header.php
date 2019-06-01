<?php
/**
 * BuddyPress - Groups Cover Image Header.
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the display of a group's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_group_header' ); ?>

<div id="item-buttons"><?php do_action( 'bp_group_header_actions' ); ?></div>

<div id="cover-image-container">
	<a id="header-cover-image" href="<?php echo esc_url( bp_get_group_permalink() ); ?>"></a>
	<div id="item-header-cover-image">
        <span class="group-type"><?php bp_group_type(); ?></span>
		<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
			<div id="item-header-avatar">
				<a href="<?php echo esc_url( bp_get_group_permalink() ); ?>" title="<?php echo esc_attr( bp_get_group_name() ); ?>">

					<?php bp_group_avatar('type=full&height=150&width=150'); ?>

				</a>
			</div><!-- #item-header-avatar -->
		<?php endif; ?>

		<div id="item-header-content" class="besocial-group-meta">
            <h1 class="besocial-group-name"><?php bp_current_group_name(); ?></h1>
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
		</div><!-- #item-header-content -->

	</div><!-- #item-header-cover-image -->
</div><!-- #cover-image-container -->

<?php

/**
 * Fires after the display of a group's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_group_header' ); ?>