<?php
/**
 * BuddyPress - Groups Members
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php $besclwp_default_cover = get_option('besclwp_buddypress_profile_cover'); ?>
<?php $besclwp_user_preview = get_option('besclwp_user_preview'); ?>
<?php $besclwp_cover_check = bp_get_option( 'bp-disable-cover-image-uploads' ); ?>
<?php $besclwp_user_preview_bio = get_option('besclwp_user_preview_bio'); ?>

<?php if ( bp_group_has_members( bp_ajax_querystring( 'group_members' ) ) ) : ?>


	<?php

	/**
	 * Fires before the display of the group members content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_group_members_content' ); ?>

	<div id="pag-top" class="pagination">

		<div class="pag-count" id="member-count-top">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-pag-top">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

	<?php

	/**
	 * Fires before the display of the group members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_group_members_list' ); ?>

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
		<div class="besocial-member-inner">
			<?php if ($besclwp_user_preview == 'true') { ?>
            <div class="besocial-member-avatar">
            <?php } else { ?>
            <div class="besocial-member-avatar besocial-img-tooltip" data-thumb="<?php echo esc_url($besclwp_member_full_avatar); ?>" data-cover="<?php echo esc_url($besclwp_cover_image_url); ?>" data-membername="<?php bp_member_name(); ?>" data-since="<?php besclwp_get_preview_since($besclwp_member_id); ?>" data-count="<?php echo bp_get_total_friend_count($besclwp_member_id); ?> <?php esc_html_e( 'friends', 'besocial'); ?>" data-featured="<?php besclwp_featured_check($besclwp_member_id); ?>" data-bio="<?php echo wp_trim_words( $besclwp_user_bio, $besclwp_user_preview_bio, '' ); ?>">  
            <?php } ?> 
                <a href="<?php bp_group_member_domain(); ?>">
					<?php bp_group_member_avatar_thumb(); ?>
				</a>
			</div>

			<div class="besocial-member">
				<div class="besocial-member-title">
					<?php bp_group_member_link(); ?>

				</div>

				<div class="besocial-member-meta">
                    <i class="fa fa-clock-o"></i> <span class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_group_member_joined_since( array( 'relative' => false ) ) ); ?>"><?php bp_group_member_joined_since(); ?></span>
                <?php

				/**
				 * Fires inside the listing of an individual group member listing item.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_group_members_list_item' ); ?>
                </div>
			</div>
            
            <?php if ( bp_is_active( 'friends' ) ) : ?>

					<div class="besocial-member-action">

						<?php bp_add_friend_button( bp_get_group_member_id(), bp_get_group_member_is_friend() ); ?>

						<?php

						/**
						 * Fires inside the action section of an individual group member listing item.
						 *
						 * @since 1.1.0
						 */
						do_action( 'bp_group_members_list_item_action' ); ?>

					</div>

				<?php endif; ?>
		</div>
            </div>
	<?php endwhile; ?>
	</div>

	<?php

	/**
	 * Fires after the display of the group members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_group_members_list' ); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="member-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

	<?php

	/**
	 * Fires after the display of the group members content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_group_members_content' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php esc_html_e( 'No members were found.', 'besocial' ); ?></p>
	</div>

<?php endif; ?>
