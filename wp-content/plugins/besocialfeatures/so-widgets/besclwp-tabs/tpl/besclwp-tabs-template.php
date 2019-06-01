<?php $besclwp_random_id = rand(); ?>
<div id="tabs-<?php echo esc_attr($besclwp_random_id) ?>">
    <ul class="resp-tabs-list">
<?php 
if ( ! empty( $instance['a_repeater'] ) ) {
    $tab_items = $instance['a_repeater'];
    foreach( $tab_items as $index => $repeater_item ) {
        $tabs_title = $repeater_item['title'];
        $tabs_icon = $repeater_item['icon'];
        echo '<li>' . siteorigin_widget_get_icon($tabs_icon) . ' ' . $tabs_title . '</li>';
    }
?>
    </ul>
    <div class="resp-tabs-container">
<?php       
    foreach( $tab_items as $index => $repeater_item ) {
        $tabs_editor = $repeater_item['text'];
        echo '<div>' . wp_kses_post($tabs_editor) . '</div>';
        }
    }
?>
    </div>
</div>
    <div class="clear"></div>
    <script type="text/javascript">jQuery(document).ready(function() { jQuery("#tabs-<?php echo esc_attr($besclwp_random_id) ?>").easyResponsiveTabs({type: "<?php echo esc_js($instance['mode']); ?>", width: "auto", fit: true,activate: function () { if (jQuery(window).width() > 768) {jQuery("#tabs-<?php echo esc_attr($besclwp_random_id) ?>").find(".resp-tab-content").addClass("animatedfast fadeIn");setTimeout(function () {jQuery("#tabs-<?php echo esc_attr($besclwp_random_id) ?>").find(".resp-tab-content").removeClass("animatedfast fadeIn");}, 400);}}});});</script>