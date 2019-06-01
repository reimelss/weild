<?php
/**
 * Fires at the top of the members directory template file.
 *
 * @since 1.0.0
 */
do_action('bp_before_directory_members_page');

if ($atts['use_compat']) {
    echo '<div id="buddypress">';
}


/**
 * Fires before the display of the members.
 *
 * @since 1.0.0
 */
do_action('bp_before_directory_members');
?>

<?php
/**
 * Fires before the display of the members content.
 *
 * @since 1.0.0
 */
do_action('bp_before_directory_members_content');
?>

<?php /* Backward compatibility for inline search form. Use template part instead. */ ?>
<?php
require_once plugin_dir_path(dirname(__FILE__)) . 'members/search.php';
?>
<?php
/**
 * Fires before the display of the members list tabs.
 *
 * @since 1.0.0
 */
do_action('bp_before_directory_members_tabs');
?>

<form action="" method="post" id="members-directory-form" class="dir-form">

    <div class="item-list-tabs" id="subnav" aria-label="<?php esc_attr_e('Members directory secondary navigation', 'buddypress'); ?>" role="navigation">
        <div class="bpsh-order-select">
            <?php
            /**
             * Fires inside the members directory member sub-types.
             *
             * @since 1.0.0
             */
            do_action('bp_members_directory_member_sub_types');
            ?>

            <div id="bpsh-members-order-select" class="last bpsh-filter bpsh-dropdown">
                <label for="members-order-by"><?php _e('Order By:', 'buddypress'); ?></label>
                <select id="members-order-by">
                    <option value="active"><?php _e('Last Active', 'buddypress'); ?></option>
                    <option value="newest"><?php _e('Newest Registered', 'buddypress'); ?></option>

                    <?php if (bp_is_active('xprofile')) : ?>
                        <option value="alphabetical"><?php _e('Alphabetical', 'buddypress'); ?></option>
                    <?php endif; ?>

                    <?php
                    /**
                     * Fires inside the members directory member order options.
                     *
                     * @since 1.0.0
                     */
                    do_action('bp_members_directory_order_options');
                    ?>
                </select>
            </div>
        </div>
    </div>

    <h2 class="bp-screen-reader-text"><?php
        /* translators: accessibility text */
        _e('Members directory', 'buddypress');
        ?></h2>
    <div id="members-dir-list" class="members dir-list">
        <?php
        add_filter('bp_ajax_querystring', function($qs) {
            return $qs .= get_option('bpsh_queryargs');
        });
        bp_get_template_part('members/members-loop');
        ?>
    </div><!-- #members-dir-list -->


    <?php
    /**
     * Fires and displays the members content.
     *
     * @since 1.0.0
     */
    do_action('bp_directory_members_content');
    ?>

    <?php wp_nonce_field('directory_members', '_wpnonce-member-filter'); ?>

    <?php
    /**
     * Fires after the display of the members content.
     *
     * @since 1.0.0
     */
    do_action('bp_after_directory_members_content');
    ?>

</form><!-- #members-directory-form -->

<?php
/**
 * Fires after the display of the members.
 *
 * @since 1.0.0
 */
do_action('bp_after_directory_members');


if ($atts['use_compat']) {
    echo '</div>';
}

/**
 * Fires at the bottom of the members directory template file.
 *
 * @since 1.0.0
 */
do_action('bp_after_directory_members_page');
