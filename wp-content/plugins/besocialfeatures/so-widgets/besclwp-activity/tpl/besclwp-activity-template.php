<?php do_action( 'bp_before_directory_activity' ); ?>

<div class="buddypress-holder">
    <?php if (!empty($instance['title'])) { ?>
    <h3><?php echo esc_html($instance['title']); ?></h3>
    <?php } ?>

	<?php do_action( 'bp_before_directory_activity_content' ); ?>

	<?php 
    if (( is_user_logged_in() ) && ($instance['postform'] == 'on')) {
        bp_get_template_part( 'activity/post-form' );
    }
    ?>

	<div id="template-notices" role="alert" aria-atomic="true">
		<?php do_action( 'template_notices' ); ?>
	</div>

    <?php if($instance['categories'] == 'on') { ?>
	<div class="item-list-tabs activity-type-tabs" aria-label="<?php esc_attr_e( 'Sitewide activities navigation', 'besclwpcpt' ); ?>" role="navigation">
		<ul>
			<?php do_action( 'bp_before_activity_type_tab_all' ); ?>
            <?php $besclwp_disable_all_members = get_option('besclwp_disable_all_members'); ?>

            <?php if ($besclwp_disable_all_members != 'true') { ?>
			<li class="selected" id="activity-all"><a href="<?php bp_activity_directory_permalink(); ?>"><?php printf( __( 'All Members %s', 'besclwpcpt' ), '<span>' . bp_get_total_member_count() . '</span>' ); ?></a></li>
            <?php } ?>

			<?php if ( is_user_logged_in() ) : ?>

				<?php do_action( 'bp_before_activity_type_tab_friends' ); ?>

				<?php if ( bp_is_active( 'friends' ) ) : ?>

					<?php if ( bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>

						<li <?php if ($besclwp_disable_all_members == 'true') { echo 'class="selected"'; } ?> id="activity-friends"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_friends_slug() . '/'; ?>"><?php printf( __( 'My Friends %s', 'besclwpcpt' ), '<span>' . bp_get_total_friend_count( bp_loggedin_user_id() ) . '</span>' ); ?></a></li>

					<?php endif; ?>

				<?php endif; ?>

				<?php do_action( 'bp_before_activity_type_tab_groups' ); ?>

				<?php if ( bp_is_active( 'groups' ) ) : ?>

					<?php if ( bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) : ?>

						<li id="activity-groups"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_groups_slug() . '/'; ?>"><?php printf( __( 'My Groups %s', 'besclwpcpt' ), '<span>' . bp_get_total_group_count_for_user( bp_loggedin_user_id() ) . '</span>' ); ?></a></li>

					<?php endif; ?>

				<?php endif; ?>

				<?php do_action( 'bp_before_activity_type_tab_favorites' ); ?>

				<?php if ( bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) ) : ?>

					<li id="activity-favorites"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/favorites/'; ?>"><?php printf( __( 'My Favorites %s', 'besclwpcpt' ), '<span>' . bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) . '</span>' ); ?></a></li>

				<?php endif; ?>

				<?php if ( bp_activity_do_mentions() ) : ?>

					<?php do_action( 'bp_before_activity_type_tab_mentions' ); ?>

					<li id="activity-mentions"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/mentions/'; ?>"><?php _e( 'Mentions', 'besclwpcpt' ); ?><?php if ( bp_get_total_mention_count_for_user( bp_loggedin_user_id() ) ) : ?> <strong><span><?php printf( _nx( '%s new', '%s new', bp_get_total_mention_count_for_user( bp_loggedin_user_id() ), 'Number of new activity mentions', 'besclwpcpt' ), bp_get_total_mention_count_for_user( bp_loggedin_user_id() ) ); ?></span></strong><?php endif; ?></a></li>

				<?php endif; ?>

			<?php endif; ?>

			<?php do_action( 'bp_activity_type_tabs' ); ?>
		</ul>
	</div>
    <?php } ?>

    <?php if ($instance['filters'] == 'on') { ?>
    <div id="besocial-bp-bar" class="moremargin">
        <?php if ($instance['rss'] == 'on') { ?>
        <ul id="besocial-bp-bar-left">
            <li><a href="<?php bp_sitewide_activity_feed_link(); ?>" title="<?php esc_attr_e( 'RSS Feed', 'besclwpcpt' ); ?>"><i class="fa fa-rss-square"></i></a></li>
        </ul>
        <?php } ?>
        <ul id="besocial-bp-bar-right">
            <li id="activity-filter-select">
            <select id="activity-filter-by">
                <option value="-1"><?php _e( '&mdash; Show Everything &mdash;', 'besclwpcpt' ); ?></option>
                <?php bp_activity_show_filters(); ?>
                <?php do_action( 'bp_activity_filter_options' ); ?>
            </select>
            </li>
        </ul>
    </div>
    <?php } ?>

	<?php do_action( 'bp_before_directory_activity_list' ); ?>

	<div class="activity" aria-live="polite" aria-atomic="true" aria-relevant="all">
    <?php do_action( 'bp_before_activity_loop' ); ?>
        
    <?php $max_activity = $instance['max']; ?>    

    <?php if ( bp_has_activities( bp_ajax_querystring( 'activity' ).'&max=' . $max_activity ) ) : ?>

	<?php if ( empty( $_POST['page'] ) ) : ?>
        <?php wp_nonce_field( 'new_activity_comment', '_wpnonce_new_activity_comment' ); ?>
		<ul id="activity-stream" class="activity-list item-list">

	<?php endif; ?>
	<?php while ( bp_activities() ) : bp_the_activity(); ?>

		<?php bp_get_template_part( 'activity/entry' ); ?>

	<?php endwhile; ?>

	<?php if ( bp_activity_has_more_items() ) : ?>

		<li class="load-more">
			<a href="<?php bp_activity_load_more_link() ?>"><?php _e( 'Load More', 'besclwpcpt' ); ?></a>
		</li>

	<?php endif; ?>

	<?php if ( empty( $_POST['page'] ) ) : ?>

		</ul>

	<?php endif; ?>

<?php else : ?>

	<div id="message" class="info">
		<p><?php _e( 'Sorry, there was no activity found. Please try a different filter.', 'besclwpcpt' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_activity_loop' ); ?>

<?php if ( empty( $_POST['page'] ) ) : ?>

	<form name="activity-loop-form" id="activity-loop-form" method="post">

		<?php wp_nonce_field( 'activity_filter', '_wpnonce_activity_filter' ); ?>

	</form>

<?php endif; ?>

	</div>

	<?php do_action( 'bp_after_directory_activity_list' ); ?>

	<?php do_action( 'bp_directory_activity_content' ); ?>

	<?php do_action( 'bp_after_directory_activity_content' ); ?>

	<?php do_action( 'bp_after_directory_activity' ); ?>

</div>
