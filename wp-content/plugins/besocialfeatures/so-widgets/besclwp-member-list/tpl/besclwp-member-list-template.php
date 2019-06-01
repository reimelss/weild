<?php $besclwp_default_cover = get_option('besclwp_buddypress_profile_cover'); ?>
<?php $besclwp_user_preview = get_option('besclwp_user_preview'); ?>
<?php $besclwp_cover_check = bp_get_option( 'bp-disable-cover-image-uploads' ); ?>
<?php $besclwp_user_preview_bio = get_option('besclwp_user_preview_bio'); ?>
<?php
if ($instance['b_section']['featured'] == 'on') {
    $member_meta_key = 'besocial_featured_user';
    $member_meta_value = 'yes';
}
else {
    $member_meta_key = false;
    $member_meta_value = false;
}
if (!empty($instance['b_section']['max'])) {
    $member_max = $instance['b_section']['max'];
}
else {
    $member_max = '99';
}
if (!empty($instance['b_section']['per_page'])) {
    $member_per_page = $instance['b_section']['per_page'];
}
else {
    $member_per_page = '20';
}
if (!empty($instance['b_section']['include'])) {
    $member_include = $instance['b_section']['include'];
}
else {
    $member_include = false;
}
if (!empty($instance['b_section']['exclude'])) {
    $member_exclude = $instance['b_section']['exclude'];
}
else {
    $member_exclude = false;
}
$member_args_array = array(
    'type' => $instance['b_section']['type'],
    'max' => $member_max,
    'per_page' => $member_per_page,
    'include' => $member_include,
    'exclude' => $member_exclude,
    'meta_key' => $member_meta_key,
    'meta_value' => $member_meta_value
);
?>
<div class="buddypress-holder">
<?php if (!empty($instance['a_section']['heading'])) { ?>
<div class="besclwp-widget-title-s">
    <<?php echo esc_attr($instance['a_section']['headinglevel']); ?>><?php echo esc_attr($instance['a_section']['heading']); ?></<?php echo esc_attr($instance['a_section']['headinglevel']); ?>>
    <?php if(!empty($instance['a_section']['subtitle'])) { ?>
    <p><?php echo esc_attr($instance['a_section']['subtitle']); ?></p>
    <?php } ?>
</div>
<?php } ?>
<?php do_action( 'bp_before_members_loop' ); ?>

<?php if ( bp_get_current_member_type() ) : ?>
	<p class="current-member-type"><?php bp_current_member_type_message() ?></p>
<?php endif; ?>

<?php if ( bp_has_members($member_args_array) ) : ?>

    <?php if ($instance['b_section']['counter'] == 'on') { ?>
	<div class="pagination">
		<div class="pag-count" id="member-dir-count-top">
			<?php bp_members_pagination_count(); ?>
		</div>
		<div class="pagination-links" id="member-dir-pag-top">
			<?php bp_members_pagination_links(); ?>
		</div>
	</div>
    <div class="clear"></div>
    <?php } ?>
    
	<?php do_action( 'bp_before_directory_members_list' ); ?>
    
	<div class="besocial-members-list" aria-live="assertive" aria-relevant="all">
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
            <?php if ($instance['b_section']['avatars'] == 'on') { ?>
			<?php if ($besclwp_user_preview == 'true') { ?>
            <div class="besocial-member-avatar"> 
            <?php } else { ?>
            <div class="besocial-member-avatar besocial-img-tooltip" data-thumb="<?php echo esc_url($besclwp_member_full_avatar); ?>" data-cover="<?php echo esc_url($besclwp_cover_image_url); ?>" data-membername="<?php bp_member_name(); ?>" data-since="<?php besclwp_get_preview_since($besclwp_member_id); ?>" data-count="<?php echo bp_get_total_friend_count($besclwp_member_id); ?> <?php esc_html_e( 'friends', 'besclwpcpt'); ?>" data-featured="<?php besclwp_featured_check($besclwp_member_id); ?>" data-bio="<?php echo wp_trim_words( $besclwp_user_bio, $besclwp_user_preview_bio, '' ); ?>">  
            <?php } ?> 
				<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar(); ?></a>
			</div>
            <?php } ?>         
			<div class="besocial-member <?php if ($instance['b_section']['avatars'] != 'on') { ?>without-avatar<?php } ?>">
				<div class="besocial-member-title">
					<a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>
				</div>
				<div class="besocial-member-meta"><i class="fa fa-clock-o"></i> <span class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_member_last_active( array( 'relative' => false ) ) ); ?>"><?php bp_member_last_active(); ?></span></div>
				<?php do_action( 'bp_directory_members_item' ); ?>
			</div>
            <?php if ($instance['b_section']['buttons'] == 'on') { ?>
			<div class="besocial-member-action">
				<?php do_action( 'bp_directory_members_actions' ); ?>
			</div>
            <?php } ?>
		</div>
        </div>
	<?php endwhile; ?>
</div>
    
<?php do_action( 'bp_after_directory_members_list' ); ?>

<?php bp_member_hidden_fields(); ?>
    <?php if ($instance['b_section']['counter'] == 'on') { ?>
	<div class="pagination">
		<div class="pag-count" id="member-dir-count-bottom">
			<?php bp_members_pagination_count(); ?>
		</div>
		<div class="pagination-links" id="member-dir-pag-bottom">
			<?php bp_members_pagination_links(); ?>
		</div>
	</div>
    <?php } ?>
<?php else: ?>
	<div id="message" class="info">
		<p><?php _e( "Sorry, no members were found.", 'besclwpcpt' ); ?></p>
	</div>
<?php endif; ?>

<?php do_action( 'bp_after_members_loop' ); ?>
</div>