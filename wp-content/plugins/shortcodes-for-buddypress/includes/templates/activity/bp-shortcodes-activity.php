<?php
/**
 * Fires before the activity directory listing.
 *
 * @since 1.0.0
 */
do_action('bp_before_directory_activity');

if ($atts['use_compat']) {
    echo '<div id="buddypress">';
}
/**
 * Fires before the activity directory display content.
 *
 * @since 1.0.0
 */
do_action('bp_before_directory_activity_content');
?>

<?php if ($atts['allow_posting'] && is_user_logged_in()) : ?>
    <?php bp_locate_template(array('activity/post-form.php'), true); ?>
<?php endif; ?>

<div id="template-notices" role="alert" aria-atomic="true">
    <?php
    /**
     * Fires towards the top of template pages for notice display.
     *
     * @since 1.0.0
     */
    do_action('template_notices');
    ?>

</div>

<div class="item-list-tabs no-ajax" id="subnav" aria-label="<?php esc_attr_e('Activity secondary navigation', 'buddypress'); ?>" role="navigation">
    <div>
        <?php
        /**
         * Fires before the display of the activity syndication options.
         *
         * @since 1.0.0
         */
        do_action('bp_activity_syndication_options');
        ?>

        <div id="bpsh-activity-filter-select" class="last bpsh-dropdown bpsh-activity-dropdown-filter">
            <label for="activity-filter-by"><?php _e('Show:', 'buddypress'); ?></label>
            <select id="bpsh-activity-filter-by">
                <option value="-1"><?php _e('&mdash; Everything &mdash;', 'buddypress'); ?></option>

                <?php bp_activity_show_filters(); ?>

                <?php
                /**
                 * Fires inside the select input for activity filter by options.
                 *
                 * @since 1.0.0
                 */
                do_action('bp_activity_filter_options');
                ?>

            </select>
        </div>
    </div>
</div><!-- .item-list-tabs -->

<?php
/**
 * Fires before the display of the activity list.
 *
 * @since 1.0.0
 */
do_action('bp_before_directory_activity_list');
?>
<div id="content">

    <?php
    add_filter('bp_ajax_querystring', function($qs) {
        return $qs .= get_option('bpsh_queryargs');
    });
    bp_get_template_part('activity/activity-loop');
    ?>

</div><!-- .activity -->
<?php
/**
 * Fires after the display of the activity list.
 *
 * @since 1.0.0
 */
do_action('bp_after_directory_activity_list');
?>

<?php
/**
 * Fires inside and displays the activity directory display content.
 */
do_action('bp_directory_activity_content');
?>

<?php
/**
 * Fires after the activity directory display content.
 *
 * @since 1.0.0
 */
do_action('bp_after_directory_activity_content');
?>

<?php
/**
 * Fires after the activity directory listing.
 *
 * @since 1.0.0
 */
do_action('bp_after_directory_activity');

if ($atts['use_compat']) {
    echo '</div>';
}
