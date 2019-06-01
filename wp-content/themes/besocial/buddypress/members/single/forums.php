<?php
/**
 * BuddyPress - Users Forums
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<h2 class="besocial-bp-page-title"><?php esc_attr_e( 'Forums', 'besocial' ); ?></h2>

<div class="item-list-tabs no-ajax" id="subnav" aria-label="<?php esc_attr_e( 'Member secondary navigation', 'besocial' ); ?>" role="navigation">
	<ul>
		<?php bp_get_options_nav(); ?>
	</ul>
</div><!-- .item-list-tabs -->

<div id="besocial-bp-bar">
<ul id="besocial-bp-bar-right">
    <li id="forums-order-select" class="filter">
        <select id="forums-order-by">
            <option value="active"><?php esc_html_e( 'Last Active', 'besocial' ); ?></option>
            <option value="popular"><?php esc_html_e( 'Most Posts', 'besocial' ); ?></option>
            <option value="unreplied"><?php esc_html_e( 'Unreplied', 'besocial' ); ?></option>
            <?php
            /**
            * Fires inside the members forums order options select input.
            *
            * @since 1.2.0
            */
            do_action( 'bp_forums_directory_order_options' ); ?>
        </select>
    </li>
</ul>
</div>  

<?php

if ( bp_is_current_action( 'favorites' ) ) :
	bp_get_template_part( 'members/single/forums/topics' );

else :

	/**
	 * Fires before the display of member forums content.
	 *
	 * @since 1.5.0
	 */
	do_action( 'bp_before_member_forums_content' ); ?>

	<div class="forums myforums">

		<?php bp_get_template_part( 'forums/forums-loop' ) ?>

	</div>

	<?php

	/**
	 * Fires after the display of member forums content.
	 *
	 * @since 1.5.0
	 */
	do_action( 'bp_after_member_forums_content' ); ?>

<?php endif; ?>
