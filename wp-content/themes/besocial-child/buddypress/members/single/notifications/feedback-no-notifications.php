<?php
/**
 * BuddyPress - Members Feedback No Notifications
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>
<div id="message" class="info">

	<?php if ( bp_is_current_action( 'unread' ) ) : ?>

		<?php if ( bp_is_my_profile() ) : ?>

			<p><?php esc_html_e( 'You have no unread notifications.', 'besocial' ); ?></p>

		<?php else : ?>

			<p><?php esc_html_e( 'This affiliate has no unread notifications.', 'besocial' ); ?></p>

		<?php endif; ?>

	<?php else : ?>

		<?php if ( bp_is_my_profile() ) : ?>

			<p><?php esc_html_e( 'You have no notifications.', 'besocial' ); ?></p>

		<?php else : ?>

			<p><?php esc_html_e( 'This affiliate has no notifications.', 'besocial' ); ?></p>

		<?php endif; ?>

	<?php endif; ?>

</div>
