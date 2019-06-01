<?php
/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the display of the members loop.
 *
 * @since 1.2.0
 */

do_action( 'bp_before_members_loop' ); ?>


<?php the_widget( 'cs-8' ); ?>
<?php $besclwp_default_cover = get_option('besclwp_buddypress_profile_cover'); ?>
<?php $besclwp_user_preview = get_option('besclwp_user_preview'); ?>
<?php $besclwp_cover_check = bp_get_option( 'bp-disable-cover-image-uploads' ); ?>
<?php $besclwp_user_preview_bio = get_option('besclwp_user_preview_bio'); ?>

<?php if ( bp_get_current_member_type() ) : ?>
	<p class="current-member-type"><?php bp_current_member_type_message() ?></p>
<?php endif; ?>


<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>

	<div id="pag-top" class="pagination">

		<div class="pag-count" id="member-dir-count-top">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-top">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>
    <div class="clear"></div>



	<?php

	/**
	 * Fires before the display of the members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_members_list' ); ?>

	<div id="besocial-members-list" aria-live="assertive" aria-relevant="all">

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
            <?php if (($besclwp_user_preview != 'true') && (bp_is_active( 'friends' ))) { ?>
            <div class="besocial-member-avatar besocial-img-tooltip" data-thumb="<?php echo esc_url($besclwp_member_full_avatar); ?>" data-cover="<?php echo esc_url($besclwp_cover_image_url); ?>" data-membername="<?php bp_member_name(); ?>" data-since="<?php besclwp_get_preview_since($besclwp_member_id); ?>" data-count="<?php echo bp_get_total_friend_count($besclwp_member_id); ?> <?php esc_html_e( 'friends', 'besocial'); ?>" data-featured="<?php besclwp_featured_check($besclwp_member_id); ?>" data-bio="<?php echo wp_trim_words( $besclwp_user_bio, $besclwp_user_preview_bio, '' ); ?>"> 
            <?php } else { ?>
            <div class="besocial-member-avatar">
            <?php } ?>    
				<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar(); ?></a> 
			</div>

			<div class="besocial-member">
				<div class="besocial-member-title">
					<a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>
				</div>

				<div class="besocial-member-meta"><i class="fa fa-clock-o"></i> <span class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_member_last_active( array( 'relative' => false ) ) ); ?>"><?php bp_member_last_active(); ?></span></div>

				<?php

				/**
				 * Fires inside the display of a directory member item.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_directory_members_item' ); ?>

				<?php
				 /***
				  * If you want to show specific profile fields here you can,
				  * but it'll add an extra query for each member in the loop
				  * (only one regardless of the number of fields you show):
				  *
				  * bp_member_profile_data( 'field=the field name' );
				  */
				 
				 //print_r(bp_member_profile_data('field=Select Industry Expertise'));
				 // Array of config parameters. 
				

				$args = array( 
				    'field' => 'Select Industry Expertise' 
				); 
				  
				// NOTICE! Understand what this does before running. 
				$result = bp_get_member_profile_data($args); 
				print_r( xprofile_get_field_data( 'Select Languages' , bp_get_member_user_id() ));



				?>

				

			</div>

			<div class="besocial-member-action">

				<?php

				/**
				 * Fires inside the members action HTML markup to display actions.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_directory_members_actions' ); ?>

			</div>
		</div>
            </div>
	<?php endwhile; ?>
</div>

<?php

	/**
	 * Fires after the display of the members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_directory_members_list' ); ?>

	<?php bp_member_hidden_fields(); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="member-dir-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php esc_html_e( "Sorry, no affiliates were found.", 'besocial' ); ?></p>
	</div>

<?php endif; ?>

<?php

/**
 * Fires after the display of the members loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_members_loop' ); ?>
