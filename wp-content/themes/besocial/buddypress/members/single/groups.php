<?php
/**
 * BuddyPress - Users Groups
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<h2 class="besocial-bp-page-title"><?php esc_attr_e( 'Groups', 'besocial' ); ?></h2>

<div class="item-list-tabs no-ajax" id="subnav" aria-label="<?php esc_attr_e( 'Member secondary navigation', 'besocial' ); ?>" role="navigation">
	<ul>
		<?php if ( bp_is_my_profile() ) bp_get_options_nav(); ?>
	</ul>
</div><!-- .item-list-tabs -->

<div id="besocial-bp-bar">
<ul id="besocial-bp-bar-right">
<?php if ( !bp_is_current_action( 'invites' ) ) : ?>
    <li id="groups-order-select" class="filter">
        <select id="groups-order-by">
            <option value="active"><?php esc_html_e( 'Last Active', 'besocial' ); ?></option>
			<option value="popular"><?php esc_html_e( 'Most Members', 'besocial' ); ?></option>
			<option value="newest"><?php esc_html_e( 'Newly Created', 'besocial' ); ?></option>
			<option value="alphabetical"><?php esc_html_e( 'Alphabetical', 'besocial' ); ?></option>
            <?php
            /**
            * Fires inside the members group order options select input.
            *
            * @since 1.2.0
            */
			do_action( 'bp_member_group_order_options' ); ?>
        </select>
    </li>
<?php endif; ?>
</ul>
</div> 

<?php

switch ( bp_current_action() ) :

	// Home/My Groups
	case 'my-groups' :

		/**
		 * Fires before the display of member groups content.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_before_member_groups_content' ); ?>

		<?php if ( is_user_logged_in() ) : ?>
			<h2 class="bp-screen-reader-text"><?php
				/* translators: accessibility text */
				_e( 'My groups', 'besocial' );
			?></h2>
		<?php else : ?>
			<h2 class="bp-screen-reader-text"><?php
				/* translators: accessibility text */
				_e( 'Member\'s groups', 'besocial' );
			?></h2>
		<?php endif; ?>

		<div class="groups mygroups">

			<?php bp_get_template_part( 'groups/groups-loop' ); ?>

		</div>

		<?php

		/**
		 * Fires after the display of member groups content.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_after_member_groups_content' );
		break;

	// Group Invitations
	case 'invites' :
		bp_get_template_part( 'members/single/groups/invites' );
		break;

	// Any other
	default :
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;
