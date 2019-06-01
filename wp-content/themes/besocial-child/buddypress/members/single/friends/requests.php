<?php
/**
 * BuddyPress - Members Friends Requests
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the display of member friend requests content.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_member_friend_requests_content' ); ?>

<?php $besclwp_default_cover = get_option('besclwp_buddypress_profile_cover'); ?>
<?php $besclwp_user_preview = get_option('besclwp_user_preview'); ?>
<?php $besclwp_cover_check = bp_get_option( 'bp-disable-cover-image-uploads' ); ?>
<?php $besclwp_user_preview_bio = get_option('besclwp_user_preview_bio'); ?>

<?php if ( bp_has_members( 'type=alphabetical&include=' . bp_get_friendship_requests() ) ) : ?>

	<div id="pag-top" class="pagination no-ajax">

		<div class="pag-count" id="member-dir-count-top">

			<?php echo bp_get_members_pagination_countss(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-top">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>
    <div class="clear"></div>
	<div id="besocial-members-list">
        <?php while ( bp_members() ) : bp_the_member(); ?>
        <?php $besclwp_member_id = bp_get_member_user_id(); ?>
        <?php
        $hidden_fields = bp_xprofile_get_hidden_fields_for_user($besclwp_member_id, bp_loggedin_user_id());
        $field_id = esc_html(get_option('besclwp_profile_field_id'));
        if ((!in_array($field_id, $hidden_fields)) && (!empty($field_id))) {
            $besclwp_user_bio = bp_get_profile_field_data( 'field=' . $field_id . '&user_id=' . $besclwp_member_id );
        }
        else {
            $besclwp_user_bio = '';
        }
        ?>
        <?php $besclwp_member_full_avatar = bp_core_fetch_avatar( array( 'item_id' => $besclwp_member_id, 'html' => false, 'type' => 'full' ) ); ?>
        <?php $besclwp_cover_image_url = bp_attachments_get_attachment( 'url', array( 'item_id' => $besclwp_member_id, 'type' => 'cover-image' ) ); ?>
        <?php 
        if (( empty($besclwp_cover_image_url) ) || ( $besclwp_cover_check )) {
            if ( empty($besclwp_default_cover) ) {
                $besclwp_cover_image_url = get_template_directory_uri() . "/images/buddypress-default-cover.png";
            }
            else {
                $besclwp_cover_image_url = $besclwp_default_cover;
            }
        }
        ?>   
        <div class="besocial-member-outer <?php besclwp_featured_check($besclwp_member_id); ?>">
            <div id="friendship-<?php bp_friend_friendship_id(); ?>" class="besocial-member-inner">
                <?php if ($besclwp_user_preview == 'true') { ?>
            <div class="besocial-member-avatar">
            <?php } else { ?>
            <div class="besocial-member-avatar besocial-img-tooltip" data-thumb="<?php echo esc_url($besclwp_member_full_avatar); ?>" data-cover="<?php echo esc_url($besclwp_cover_image_url); ?>" data-membername="<?php bp_member_name(); ?>" data-since="<?php besclwp_get_preview_since($besclwp_member_id); ?>" data-count="" data-featured="<?php besclwp_featured_check($besclwp_member_id); ?>" data-bio="<?php echo wp_trim_words( $besclwp_user_bio, $besclwp_user_preview_bio, '' ); ?>">  
            <?php } ?> 
                    <a href="<?php bp_member_link(); ?>"><?php bp_member_avatar(); ?></a>
                </div>

				<div class="besocial-member">
                    <div class="besocial-member-title">
                        <a href="<?php bp_member_link(); ?>"><?php bp_member_name(); ?></a>
                    </div>

                    <div class="besocial-member-meta"><i class="fa fa-clock-o"></i> <span class="activity"><?php bp_member_last_active(); ?></span></div>

					<?php
					/**
					 * Fires inside the display of a member friend request item.
					 *
					 * @since 1.1.0
					 */
					do_action( 'bp_friend_requests_item' );
					?>
				</div>

				<div class="besocial-member-action">
                    <div class="friendship-button generic-button">
                        <a class="accept" href="<?php bp_friend_accept_request_link(); ?>"><?php esc_html_e( 'Accept', 'besocial' ); ?></a>
                    </div>
                    <div class="friendship-button generic-button">
                        <a class="reject" href="<?php bp_friend_reject_request_link(); ?>"><?php esc_html_e( 'Reject', 'besocial' ); ?></a>
                    </div>
					<?php

					/**
					 * Fires inside the member friend request actions markup.
					 *
					 * @since 1.1.0
					 */
					do_action( 'bp_friend_requests_item_action' ); ?>
				</div>
            </div>
        </div>
		<?php endwhile; ?>
	</div>

	<?php

	/**
	 * Fires and displays the member friend requests content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_friend_requests_content' ); ?>

	<div id="pag-bottom" class="pagination no-ajax">

		<div class="pag-count" id="member-dir-count-bottom">

			<?php echo bp_get_members_pagination_countss(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php esc_html_e( 'You have no pending friendship requests.', 'besocial' ); ?></p>
	</div>

<?php endif;?>

<?php

/**
 * Fires after the display of member friend requests content.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_member_friend_requests_content' ); ?>
