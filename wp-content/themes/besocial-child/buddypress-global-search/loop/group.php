<?php $besclwp_default_cover = get_option('besclwp_buddypress_group_cover'); ?>
<?php $besclwp_group_preview = get_option('besclwp_user_preview'); ?>
<?php $besclwp_cover_check = bp_get_option( 'bp-disable-group-avatar-uploads' ); ?>
<?php $besclwp_group_preview_bio = get_option('besclwp_user_preview_bio'); ?>
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
				<div class="besocial-group-title"><a href="<?php bp_group_permalink(); ?>"><?php bp_group_name(); ?></a><span class="bbpress-divider">|</span><?php bp_group_type(); ?></div>
				<div class="besocial-group-meta"><i class="fa fa-users"></i> <?php bp_group_member_count(); ?><span class="bbpress-divider">|</span><i class="fa fa-clock-o"></i> <span class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_group_last_active( 0, array( 'relative' => false ) ) ); ?>"><?php printf( __( 'active %s', 'besocial' ), bp_get_group_last_active() ); ?></span></div>

				<div class="besocial-group-desc"><?php bp_group_description_excerpt(); ?></div>
                <div class="besocial-group-action">

				<?php

				/**
				 * Fires inside the action section of an individual group listing item.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_directory_groups_actions' ); ?>

			</div>

				<?php

				/**
				 * Fires inside the listing of an individual group listing item.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_directory_groups_item' ); ?>

			</div>
		</div>
        </div>
	</div>