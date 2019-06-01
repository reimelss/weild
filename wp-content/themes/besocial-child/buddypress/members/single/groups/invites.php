<?php
/**
 * BuddyPress - Members Single Group Invites
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the display of member group invites content.
 *
 * @since 1.1.0
 */
do_action( 'bp_before_group_invites_content' ); ?>
<?php $besclwp_default_cover = get_option('besclwp_buddypress_group_cover'); ?>
<?php $besclwp_group_preview = get_option('besclwp_user_preview'); ?>
<?php $besclwp_cover_check = bp_get_option( 'bp-disable-group-avatar-uploads' ); ?>
<?php $besclwp_group_preview_bio = get_option('besclwp_user_preview_bio'); ?>
<div class="clear"></div>
<?php if ( bp_has_groups( 'type=invites&user_id=' . bp_loggedin_user_id() ) ) : ?>


	<div id="besocial-groups-list">

<?php while ( bp_groups() ) : bp_the_group(); ?>
    <?php $besclwp_group_id = bp_get_group_id(); ?>
    <?php $besclwp_group_full_avatar = bp_core_fetch_avatar( array( 'item_id' => $besclwp_group_id, 'html' => false, 'type' => 'full', 'object' => 'group' ) ); ?>
    <?php $besclwp_cover_image_url = bp_attachments_get_attachment('url', array(
          'object_dir' => 'groups',
          'item_id' => $besclwp_group_id,
        )); ?>
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

			<div class="besocial-group-outer">
                <div class="besocial-group-inner">
<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
            <?php if ($besclwp_group_preview == 'true') { ?>
            <div class="besocial-group-avatar"> 
            <?php } else { ?>
            <?php $besclwp_group_info = groups_get_group( array( 'group_id' => $besclwp_group_id ) ); ?> 
            <?php $besclwp_group_desc = wp_strip_all_tags($besclwp_group_info->description); ?>     
            <div class="besocial-group-avatar besocial-img-tooltip" data-thumb="<?php echo esc_url($besclwp_group_full_avatar); ?>" data-cover="<?php echo esc_url($besclwp_cover_image_url); ?>" data-membername="<?php bp_group_name(); ?>" data-since="<?php bp_group_type(); ?>" data-count="<?php bp_group_member_count(); ?>" data-featured="" data-bio="<?php echo wp_trim_words( $besclwp_group_desc, $besclwp_group_preview_bio, '' ) ?>">  
            <?php } ?>
                    <a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar(); ?></a>
                </div>
				<?php endif; ?>
                    
                    <div class="besocial-group">
                        <div class="besocial-group-title">
                            <a href="<?php bp_group_permalink(); ?>"><?php bp_group_name(); ?></a>
                        </div>
                        <div class="besocial-group-meta">
                            <i class="fa fa-users"></i> <?php printf( _nx( '%d affiliate', '%d affiliates', bp_get_group_total_members( false ),'Group affiliate count', 'besocial' ), bp_get_group_total_members( false )  ); ?>
                        </div>

                        <div class="besocial-group-desc">
                            <?php bp_group_description_excerpt(); ?>
                            <?php

                            /**
                            * Fires inside the display of a member group invite item.
                            *
                            * @since 1.1.0
                            */
                            do_action( 'bp_group_invites_item' ); ?>
                        </div>
                        <div class="besocial-group-action">
                            <div class="friendship-button generic-button">
                                <a class="accept" href="<?php bp_group_accept_invite_link(); ?>"><?php esc_html_e( 'Accept', 'besocial' ); ?></a>
                            </div>
                            <div class="friendship-button generic-button">
                                <a class="reject" href="<?php bp_group_reject_invite_link(); ?>"><?php esc_html_e( 'Reject', 'besocial' ); ?></a>
                            </div>
                            <?php

                            /**
                            * Fires inside the member group item action markup.
                            *
                            * @since 1.1.0
                            */
                            do_action( 'bp_group_invites_item_action' ); ?>

                        </div>
                    </div>
                </div>
        </div>
		<?php endwhile; ?>
	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php esc_html_e( 'You have no outstanding group invites.', 'besocial' ); ?></p>
	</div>

<?php endif;?>

<?php

/**
 * Fires after the display of member group invites content.
 *
 * @since 1.1.0
 */
do_action( 'bp_after_group_invites_content' ); ?>
