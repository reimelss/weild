<?php
/**
 * BuddyPress - Members Single Messages Notice Loop
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the members notices loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_notices_loop' ); ?>

<?php if ( bp_has_message_threads() ) : ?>

	<div class="pagination no-ajax" id="user-pag">

		<div class="pag-count" id="messages-dir-count">
			<?php bp_messages_pagination_count(); ?>
		</div>

		<div class="pagination-links" id="messages-dir-pag">
			<?php bp_messages_pagination(); ?>
		</div>

	</div><!-- .pagination -->

	<?php

	/**
	 * Fires after the members notices pagination display.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_after_notices_pagination' ); ?>
	<?php

	/**
	 * Fires before the members notice items.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_before_notices' ); ?>

		<?php while ( bp_message_threads() ) : bp_message_thread(); ?>
<div class="clear"></div>
			<div id="notice-<?php bp_message_notice_id(); ?>" class="besocial-notice-div">
				<div class="bp-notice-subject">
                    <p>
                        <span class="activity"><i class="fa fa-send"></i> <?php bp_message_notice_post_date(); ?></span>
                        <br/><strong><?php bp_message_notice_subject(); ?></strong>
                    </p>
                    <div>
                        <?php bp_message_notice_text(); ?>
                    </div>
				</div>
                <div class="bp-notice-buttons">
					<a class="button" href="<?php bp_message_activate_deactivate_link(); ?>" class="confirm"><?php bp_message_activate_deactivate_text(); ?></a>
					<a class="button" href="<?php bp_message_notice_delete_link(); ?>" class="confirm" title="<?php esc_attr_e( "Delete Message", 'besocial' ); ?>"><i class="fa fa-close"></i></a>
				</div>
                <div>
				<?php

				/**
				 * Fires inside the display of a member notice list item.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_notices_list_item' ); ?>
                </div>
			</div>
		<?php endwhile; ?>

	<?php

	/**
	 * Fires after the members notice items.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_after_notices' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php esc_html_e( 'Sorry, no notices were found.', 'besocial' ); ?></p>
	</div>

<?php endif;?>

<?php

/**
 * Fires after the members notices loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_notices_loop' ); ?>
