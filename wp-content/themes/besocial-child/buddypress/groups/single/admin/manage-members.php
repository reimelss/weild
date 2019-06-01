<?php
/**
 * BuddyPress - Groups Admin - Manage Members
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<h2 class="bp-screen-reader-text"><?php esc_html_e( 'Manage Affiliates', 'besocial' ); ?></h2>

<?php

/**
 * Fires before the group manage members admin display.
 *
 * @since 1.1.0
 */
do_action( 'bp_before_group_manage_members_admin' ); ?>

<div aria-live="polite" aria-relevant="all" aria-atomic="true">

	<div class="bp-widget group-members-list group-admins-list">
		<h3 class="section-header"><?php esc_html_e( 'Administrators', 'besocial' ); ?></h3>

		<?php if ( bp_group_has_members( array( 'per_page' => 15, 'group_role' => array( 'admin' ), 'page_arg' => 'mlpage-admin' ) ) ) : ?>

			<?php if ( bp_group_member_needs_pagination() ) : ?>

				<div class="pagination no-ajax">

					<div id="member-count" class="pag-count">
						<?php bp_group_member_pagination_count(); ?>
					</div>

					<div id="member-admin-pagination" class="pagination-links">
						<?php bp_group_member_admin_pagination(); ?>
					</div>

				</div>

			<?php endif; ?>

			<div id="admins-list" class="besocial-members-list">
				<?php while ( bp_group_members() ) : bp_group_the_member(); ?>
                <?php $besclwp_member_id = bp_get_member_user_id(); ?>
                <div class="besocial-member-outer <?php besclwp_featured_check($besclwp_member_id); ?>">
                    <div class="besocial-member-inner">
                        <div class="besocial-member-avatar">
				            <a href="<?php bp_member_permalink(); ?>"><?php bp_group_member_avatar_thumb(); ?></a>
			             </div>

						<div class="besocial-member">
                            <div class="besocial-member-title">
                                <?php bp_group_member_link(); ?>
                            </div>
                            
                            <div class="besocial-member-meta joined">
                                <i class="fa fa-clock-o"></i> <?php bp_group_member_joined_since(); ?>
                            </div>
                            
							<?php

							/**
							 * Fires inside the item section of a member admin item in group management area.
							 *
							 * @since 1.1.0
							 * @since 2.7.0 Added $section parameter.
							 *
							 * @param $section Which list contains this item.
							 */
							do_action( 'bp_group_manage_members_admin_item', 'admins-list' ); ?>
						</div>

						<div class="besocial-member-action">
							<?php if ( count( bp_group_admin_ids( false, 'array' ) ) > 1 ) : ?>
								<a class="button confirm admin-demote-to-member" href="<?php bp_group_member_demote_link(); ?>"><?php esc_html_e( 'Demote to Affiliate', 'besocial' ); ?></a>
							<?php endif; ?>

							<?php

							/**
							 * Fires inside the action section of a member admin item in group management area.
							 *
							 * @since 2.7.0
							 *
							 * @param $section Which list contains this item.
							 */
							do_action( 'bp_group_manage_members_admin_actions', 'admins-list' ); ?>
						</div>
                    </div>
                </div>
				<?php endwhile; ?>
			</div>

			<?php if ( bp_group_member_needs_pagination() ) : ?>

				<div class="pagination no-ajax">

					<div id="member-count" class="pag-count">
						<?php bp_group_member_pagination_count(); ?>
					</div>

					<div id="member-admin-pagination" class="pagination-links">
						<?php bp_group_member_admin_pagination(); ?>
					</div>

				</div>

			<?php endif; ?>

		<?php else: ?>

		<div id="message" class="info">
			<p><?php esc_html_e( 'No group administrators were found.', 'besocial' ); ?></p>
		</div>

		<?php endif; ?>
	</div>
    
    <hr/>

	<div class="bp-widget group-members-list group-mods-list">
		<h3 class="section-header"><?php esc_html_e( 'Moderators', 'besocial' ); ?></h3>

		<?php if ( bp_group_has_members( array( 'per_page' => 15, 'group_role' => array( 'mod' ), 'page_arg' => 'mlpage-mod' ) ) ) : ?>

			<?php if ( bp_group_member_needs_pagination() ) : ?>

				<div class="pagination no-ajax">

					<div id="member-count" class="pag-count">
						<?php bp_group_member_pagination_count(); ?>
					</div>

					<div id="member-admin-pagination" class="pagination-links">
						<?php bp_group_member_admin_pagination(); ?>
					</div>

				</div>

			<?php endif; ?>

			<ul id="mods-list" class="item-list">

				<?php while ( bp_group_members() ) : bp_group_the_member(); ?>
					<li>
						<div class="item-avatar">
							<?php bp_group_member_avatar_thumb(); ?>
						</div>

						<div class="item">
							<div class="item-title">
								<?php bp_group_member_link(); ?>
							</div>
							<p class="joined item-meta">
								<?php bp_group_member_joined_since(); ?>
							</p>
							<?php

							/**
							 * Fires inside the item section of a member admin item in group management area.
							 *
							 * @since 1.1.0
							 * @since 2.7.0 Added $section parameter.
							 *
							 * @param $section Which list contains this item.
							 */
							do_action( 'bp_group_manage_members_admin_item', 'admins-list' ); ?>
						</div>

						<div class="action">
							<a href="<?php bp_group_member_promote_admin_link(); ?>" class="button confirm mod-promote-to-admin"><?php esc_html_e( 'Promote to Admin', 'besocial' ); ?></a>
							<a class="button confirm mod-demote-to-member" href="<?php bp_group_member_demote_link(); ?>"><?php esc_html_e( 'Demote to Affiliate', 'besocial' ); ?></a>

							<?php

							/**
							 * Fires inside the action section of a member admin item in group management area.
							 *
							 * @since 2.7.0
							 *
							 * @param $section Which list contains this item.
							 */
							do_action( 'bp_group_manage_members_admin_actions', 'mods-list' ); ?>

						</div>
					</li>
				<?php endwhile; ?>

			</ul>

			<?php if ( bp_group_member_needs_pagination() ) : ?>

				<div class="pagination no-ajax">

					<div id="member-count" class="pag-count">
						<?php bp_group_member_pagination_count(); ?>
					</div>

					<div id="member-admin-pagination" class="pagination-links">
						<?php bp_group_member_admin_pagination(); ?>
					</div>

				</div>

			<?php endif; ?>

		<?php else: ?>

			<div id="message" class="info">
				<p><?php esc_html_e( 'No group moderators were found.', 'besocial' ); ?></p>
			</div>

		<?php endif; ?>
	</div>
    
    <hr/>

	<div class="bp-widget group-members-list">
		<h3 class="section-header"><?php esc_html_e( "Affiliates", 'besocial' ); ?></h3>

		<?php if ( bp_group_has_members( array( 'per_page' => 15, 'exclude_banned' => 0 ) ) ) : ?>

			<?php if ( bp_group_member_needs_pagination() ) : ?>

				<div class="pagination no-ajax">

					<div id="member-count" class="pag-count">
						<?php bp_group_member_pagination_count(); ?>
					</div>

					<div id="member-admin-pagination" class="pagination-links">
						<?php bp_group_member_admin_pagination(); ?>
					</div>

				</div>

			<?php endif; ?>

			<div id="besocial-members-list" aria-live="assertive" aria-relevant="all">
				<?php while ( bp_group_members() ) : bp_group_the_member(); ?>
                <?php $besclwp_member_id = bp_get_member_user_id(); ?>
                <div class="besocial-member-outer <?php besclwp_featured_check($besclwp_member_id); ?>">
                    <div class="besocial-member-inner <?php bp_group_member_css_class(); ?>">
                        <div class="besocial-member-avatar">
                            <a href="<?php bp_member_permalink(); ?>"><?php bp_group_member_avatar_thumb(); ?></a>
                        </div>

						<div class="besocial-member">
                            <div class="besocial-member-title">
					           <?php bp_group_member_link(); ?>
                                <?php
								if ( bp_get_group_member_is_banned() ) {
									echo ' <span class="banned">';
									_e( '(banned)', 'besocial' );
									echo '</span>';
								} ?>
				            </div>
                            
							<div class="besocial-member-meta joined">
                                <i class="fa fa-clock-o"></i> <?php bp_group_member_joined_since(); ?>
                            </div>
							<?php

							/**
							 * Fires inside the item section of a member admin item in group management area.
							 *
							 * @since 1.1.0
							 * @since 2.7.0 Added $section parameter.
							 *
							 * @param $section Which list contains this item.
							 */
							do_action( 'bp_group_manage_members_admin_item', 'admins-list' ); ?>
						</div>

						<div class="besocial-member-action">
							<?php if ( bp_get_group_member_is_banned() ) : ?>

								<a href="<?php bp_group_member_unban_link(); ?>" class="button confirm member-unban" title="<?php esc_attr_e( 'Unban this Affiliate', 'besocial' ); ?>"><?php esc_html_e( 'Remove Ban', 'besocial' ); ?></a>

							<?php else : ?>

								<a href="<?php bp_group_member_ban_link(); ?>" class="button confirm member-ban"><?php esc_html_e( 'Kick &amp; Ban', 'besocial' ); ?></a>
								<a href="<?php bp_group_member_promote_mod_link(); ?>" class="button confirm member-promote-to-mod"><?php esc_html_e( 'Promote to Mod', 'besocial' ); ?></a>
								<a href="<?php bp_group_member_promote_admin_link(); ?>" class="button confirm member-promote-to-admin"><?php esc_html_e( 'Promote to Admin', 'besocial' ); ?></a>

							<?php endif; ?>

							<a href="<?php bp_group_member_remove_link(); ?>" class="button confirm"><?php esc_html_e( 'Remove from group', 'besocial' ); ?></a>

							<?php

							/**
							 * Fires inside the action section of a member admin item in group management area.
							 *
							 * @since 2.7.0
							 *
							 * @param $section Which list contains this item.
							 */
							do_action( 'bp_group_manage_members_admin_actions', 'members-list' ); ?>
						</div>
					</div>
                </div>
				<?php endwhile; ?>
			</div>

			<?php if ( bp_group_member_needs_pagination() ) : ?>

				<div class="pagination no-ajax">

					<div id="member-count" class="pag-count">
						<?php bp_group_member_pagination_count(); ?>
					</div>

					<div id="member-admin-pagination" class="pagination-links">
						<?php bp_group_member_admin_pagination(); ?>
					</div>

				</div>

			<?php endif; ?>

		<?php else: ?>

			<div id="message" class="info">
				<p><?php esc_html_e( 'No group affiliates were found.', 'besocial' ); ?></p>
			</div>

		<?php endif; ?>
	</div>

</div>

<?php

/**
 * Fires after the group manage members admin display.
 *
 * @since 1.1.0
 */
do_action( 'bp_after_group_manage_members_admin' ); ?>
