<?php
/**
 * BuddyPress - Home
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>
<div class="buddypress-holder">

	<div id="template-notices" role="alert" aria-atomic="true">
		<?php

		/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
		do_action( 'template_notices' ); ?>

	</div>

	<div class="activity no-ajax">
		<?php if ( bp_has_activities( 'display_comments=threaded&show_hidden=true&include=' . bp_current_action() ) ) : ?>
            <?php wp_nonce_field( 'new_activity_comment', '_wpnonce_new_activity_comment' ); ?> 
			<ul id="activity-stream" class="activity-list item-list">      
			<?php while ( bp_activities() ) : bp_the_activity(); ?>

				<?php bp_get_template_part( 'activity/entry' ); ?>

			<?php endwhile; ?>
			</ul>

		<?php endif; ?>
	</div>
</div>
