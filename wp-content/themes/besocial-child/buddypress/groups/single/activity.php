<?php
/**
 * BuddyPress - Groups Activity
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php

/**
 * Fires before the display of the group activity post form.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_group_activity_post_form' ); ?>

<?php if ( is_user_logged_in() && bp_group_is_member() ) : ?>

	<?php bp_get_template_part( 'activity/post-form' ); ?>

<?php endif; ?>

<div id="besocial-bp-bar" class="marginbottom">
<ul id="besocial-bp-bar-left">
    <li>
    <a href="<?php bp_group_activity_feed_link(); ?>" title="<?php esc_attr_e( 'RSS Feed', 'besocial' ); ?>"><i class="fa fa-rss-square"></i></a>
    </li>
</ul>
<ul id="besocial-bp-bar-right">
    <?php
    /**
    * Fires before the display of the activity syndication options.
    *
    * @since 1.2.0
    */
    do_action( 'bp_activity_syndication_options' ); ?>
    <li id="activity-filter-select" class="last">
	<select id="activity-filter-by">
		<option value="-1"><?php esc_html_e( '&mdash; Everything &mdash;', 'besocial' ); ?></option>

		<?php bp_activity_show_filters( 'group' ); ?>

		<?php

		/**
		* Fires inside the select input for group activity filter options.
		*
		* @since 1.2.0
		*/
		do_action( 'bp_group_activity_filter_options' ); ?>
	</select>
	</li>
</ul>
</div>

<?php

/**
 * Fires after the display of the group activity post form.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_group_activity_post_form' ); ?>
<?php

/**
 * Fires before the display of the group activities list.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_group_activity_content' ); ?>

<div class="activity single-group" aria-live="polite" aria-atomic="true" aria-relevant="all">

	<?php bp_get_template_part( 'activity/activity-loop' ); ?>

</div><!-- .activity.single-group -->

<?php

/**
 * Fires after the display of the group activities list.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_group_activity_content' ); ?>
