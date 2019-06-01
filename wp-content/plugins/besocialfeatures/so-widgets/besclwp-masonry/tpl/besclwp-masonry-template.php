<?php
$besclwp_selector_pseudo_query = $instance['b_section']['posts'];

// Process the post selector pseudo query.
$besclwp_processed_query = siteorigin_widget_post_selector_process_query( $besclwp_selector_pseudo_query );

// Use the processed post selector query to find posts.
$besclwp_query_result = new WP_Query( $besclwp_processed_query );
?>

<?php if (!empty($instance['a_section']['heading'])) { ?>
<div class="besclwp-widget-title">
    <<?php echo esc_attr($instance['a_section']['headinglevel']); ?>><?php echo esc_attr($instance['a_section']['heading']); ?></<?php echo esc_attr($instance['a_section']['headinglevel']); ?>>
    <?php if(!empty($instance['a_section']['subtitle'])) { ?>
    <p><?php echo esc_attr($instance['a_section']['subtitle']); ?></p>
    <?php } ?>
</div>
<?php } ?>

<div class="besclwp-masonry-grid">
    <div class="<?php echo esc_attr($instance['b_section']['columns']); ?>" data-columns>
        <?php while($besclwp_query_result->have_posts()) : $besclwp_query_result->the_post(); ?>
        <?php $besclwp_post_type = get_post_type(); ?>        
        <?php if (( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' )))) && ( $besclwp_post_type == 'product' ) ) { ?>
        <?php 
        if ($instance['b_section']['columns'] == 'besclwp-four-columns') {
            get_template_part( 'templates/woo/small', 'woo');
        }
        else {
            get_template_part( 'templates/woo/large', 'woo');
        }
        ?>
        <?php } else { ?>
        <?php $besclwp_format = get_post_format(); ?> 
        <?php 
        if ($instance['b_section']['columns'] == 'besclwp-four-columns') {
            get_template_part( 'templates/formats/excerpt/xsmasonry/post', $besclwp_format); 
        }
        else {
            get_template_part( 'templates/formats/excerpt/masonry/post', $besclwp_format);
        }
        ?>
        <?php } ?>
        <?php endwhile; ?>       
        <?php wp_reset_postdata(); ?> 
    </div>
</div>

<?php if(!empty($instance['c_section']['viewmore'])) { ?>
<div class="besclwp-view-more">
    <a href="<?php echo sow_esc_url($instance['c_section']['viewmore']); ?>"><?php echo esc_attr($instance['c_section']['buttontext']); ?> <i class="fa fa-long-arrow-right"></i></a>
</div>    
<?php } ?>