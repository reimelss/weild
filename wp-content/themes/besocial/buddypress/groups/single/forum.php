<?php
/**
 * BuddyPress - Groups Single Forum
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the display of a group's forum content.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_group_forum_content' );

if ( bp_is_group_forum_topic_edit() ) :
	bp_get_template_part( 'groups/single/forum/edit' );

elseif ( bp_is_group_forum_topic() ) :
	bp_get_template_part( 'groups/single/forum/topic' );

else : ?>

	<div class="item-list-tabs no-ajax" id="subnav" aria-label="<?php esc_attr_e( 'Group secondary navigation', 'besocial' ); ?>" role="navigation">
		<ul>

			<?php if ( is_user_logged_in() ) : ?>

				<li>
					<a href="#post-new" class="show-hide-new"><?php esc_html_e( 'New Topic', 'besocial' ); ?></a>
				</li>

			<?php endif; ?>

			<?php if ( bp_forums_has_directory() ) : ?>

				<li>
					<a href="<?php bp_forums_directory_permalink(); ?>"><?php esc_html_e( 'Forum Directory', 'besocial' ); ?></a>
				</li>

			<?php endif; ?>

			<?php

			/** This filter is documented in bp-templates/bp-legacy/buddypress/forums/index.php. */
			do_action( 'bp_forums_directory_group_sub_types' ); ?>
		</ul>
	</div>

<div id="besocial-bp-bar">
<ul id="besocial-bp-bar-right">
    <li id="forums-order-select" class="filter">
    <select id="forums-order-by">
        <option value="active"><?php esc_html_e( 'Last Active', 'besocial' ); ?></option>
		<option value="popular"><?php esc_html_e( 'Most Posts', 'besocial' ); ?></option>
		<option value="unreplied"><?php esc_html_e( 'Unreplied', 'besocial' ); ?></option>
        <?php
        /** This filter is documented in bp-templates/bp-legacy/buddypress/forums/index.php. */
		do_action( 'bp_forums_directory_order_options' ); ?>
    </select>
    </li>
</ul>
</div>  

	<div class="forums single-forum">

		<?php bp_get_template_part( 'forums/forums-loop' ) ?>

	</div><!-- .forums.single-forum -->

<?php endif; ?>

<?php

/**
 * Fires after the display of a group's forum content.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_group_forum_content' ); ?>

<?php if ( !bp_is_group_forum_topic_edit() && !bp_is_group_forum_topic() ) : ?>

	<?php if ( !bp_group_is_user_banned() && ( ( is_user_logged_in() && 'public' == bp_get_group_status() ) || bp_group_is_member() ) ) : ?>

		<form  method="post" id="forum-topic-form" class="standard-form">
			<div id="new-topic-post">

				<?php

				/**
				 * Fires before the display of a group forum new post form.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_before_group_forum_post_new' ); ?>

				<?php if ( bp_groups_auto_join() && !bp_group_is_member() ) : ?>
					<p><?php esc_html_e( 'You will auto join this group when you start a new topic.', 'besocial' ); ?></p>
				<?php endif; ?>

				<p id="post-new"></p>
				<h4><?php esc_html_e( 'Post a New Topic:', 'besocial' ); ?></h4>

				<label for="topic_title"><?php esc_html_e( 'Title:', 'besocial' ); ?></label>
				<input type="text" name="topic_title" id="topic_title" value="" maxlength="100" />

				<label for="topic_text"><?php esc_html_e( 'Content:', 'besocial' ); ?></label>
				<textarea name="topic_text" id="topic_text"></textarea>

				<label for="topic_tags"><?php esc_html_e( 'Tags (comma separated):', 'besocial' ); ?></label>
				<input type="text" name="topic_tags" id="topic_tags" value="" />

				<?php

				/**
				 * Fires after the display of a group forum new post form.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_after_group_forum_post_new' ); ?>

				<div class="submit">
					<input type="submit" name="submit_topic" id="submit" value="<?php esc_attr_e( 'Post Topic', 'besocial' ); ?>" />
				</div>

				<?php wp_nonce_field( 'bp_forums_new_topic' ); ?>
			</div><!-- #new-topic-post -->
		</form><!-- #forum-topic-form -->

	<?php endif; ?>

<?php endif; ?>

