<?php
/**
 * BuddyPress - Members Profile Change Cover Image
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<h3><?php esc_html_e( 'Change Cover Image', 'besocial' ); ?></h3>

<?php

/**
 * Fires before the display of profile cover image upload content.
 *
 * @since 2.4.0
 */
do_action( 'bp_before_profile_edit_cover_image' ); ?>

<p><?php esc_html_e( 'Your Cover Image will be used to customize the header of your profile.', 'besocial' ); ?></p>

<?php bp_attachments_get_template_part( 'cover-images/index' ); ?>

<?php

/**
 * Fires after the display of profile cover image upload content.
 *
 * @since 2.4.0
 */
do_action( 'bp_after_profile_edit_cover_image' ); ?>
