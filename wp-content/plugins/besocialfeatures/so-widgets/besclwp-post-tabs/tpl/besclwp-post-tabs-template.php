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
    <div class="resp-tabs-container tab-with-posts">
<?php       
    foreach( $tab_items as $index => $repeater_item ) {
        $besclwp_selector_pseudo_query = $repeater_item['posts'];
        // Process the post selector pseudo query.
        $besclwp_processed_query = siteorigin_widget_post_selector_process_query( $besclwp_selector_pseudo_query );
        // Use the processed post selector query to find posts.
        $besclwp_query_result = new WP_Query( $besclwp_processed_query );
        
        echo '<div>';
        
        while($besclwp_query_result->have_posts()) : $besclwp_query_result->the_post();
        
        $besclwp_post_type = get_post_type();
        
        if (( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' )))) && ( $besclwp_post_type == 'product' ) ) {
            get_template_part( 'templates/woo/list', 'woo');
        } else { 
            $besclwp_format = get_post_format();
            get_template_part( 'templates/formats/excerpt/list/post', $besclwp_format);
        }
        endwhile;    
        wp_reset_postdata();
        
        echo '</div>';
        }
    }
?>
    </div>
</div>
    <div class="clear"></div>
    <script type="text/javascript">jQuery(document).ready(function() { jQuery("#tabs-<?php echo esc_attr($besclwp_random_id) ?>").easyResponsiveTabs({type: "<?php echo esc_js($instance['mode']); ?>", width: "auto", fit: true,activate: function () { if (jQuery(window).width() > 768) {jQuery("#tabs-<?php echo esc_attr($besclwp_random_id) ?>").find(".resp-tab-content").addClass("animatedfast fadeIn");setTimeout(function () {jQuery("#tabs-<?php echo esc_attr($besclwp_random_id) ?>").find(".resp-tab-content").removeClass("animatedfast fadeIn");}, 400);}}});});</script>