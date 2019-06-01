<?php
$besclwp_selector_pseudo_query = $instance['b_section']['posts'];
$besclwp_random_id = rand();

// Process the post selector pseudo query.
$besclwp_processed_query = siteorigin_widget_post_selector_process_query( $besclwp_selector_pseudo_query . '&meta_key=_thumbnail_id' );

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

<div class="besclwp-post-carousel-container">
    <div id="besclwp-post-carousel-<?php echo esc_attr($besclwp_random_id) ?>" class="besclwp-carousel">
<?php while($besclwp_query_result->have_posts()) : $besclwp_query_result->the_post(); ?>
<?php $besclwp_post_type = get_post_type(); ?>        
<?php if (( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' )))) && ( $besclwp_post_type == 'product' ) ) {  
    get_template_part( 'templates/woo/small', 'woo');
} else {
    $besclwp_format = get_post_format();
    get_template_part( 'templates/formats/excerpt/xsmasonry/post', $besclwp_format);
} ?>        
<?php endwhile; ?>
    </div>
</div>
<script type="text/javascript">
(function ($) {
"use strict";    
$(document).ready(function () {
    $('#besclwp-post-carousel-<?php echo esc_attr($besclwp_random_id) ?>').slick({
        <?php if ($instance['c_section']['autoplay'] == 'true') { ?>
        autoplay: true,
        autoplaySpeed: <?php echo esc_js($instance['c_section']['duration']); ?>000,
        infinite: true,
        <?php } else { ?>
        infinite: false,
        <?php } ?>
        <?php if ( is_rtl() ) { ?>
        rtl: true,
        <?php } ?>
        arrows: <?php if ($instance['c_section']['arrows'] == 'true') { ?>true<?php } else { ?>false<?php } ?>,
        dots : <?php if ($instance['c_section']['dots'] == 'true') { ?>true<?php } else { ?>false<?php } ?>,
        <?php if ($instance['b_section']['columns'] == 'onecolumn') { ?>
        adaptiveHeight: true,
        slidesToScroll: 1,
        slidesToShow: 1
        <?php } else if ($instance['b_section']['columns'] == 'twocolumns') { ?>
        slidesToScroll: 2,
        slidesToShow: 2,
        responsive: [{breakpoint: 480,settings: {slidesToShow: 1,slidesToScroll: 1}}]
        <?php } else if ($instance['b_section']['columns'] == 'threecolumns') { ?>
        slidesToScroll: 3,
        slidesToShow: 3,
        responsive: [{breakpoint: 768,settings: {slidesToShow: 2,slidesToScroll: 2}},{breakpoint: 480,settings: {slidesToShow: 1,slidesToScroll: 1}}]
        <?php } else { ?>
        slidesToScroll: 4,
        slidesToShow: 4,
        responsive: [{breakpoint: 1024,settings: {slidesToShow: 3,slidesToScroll: 3}},{breakpoint: 768,settings: {slidesToShow: 2,slidesToScroll: 2}},{breakpoint: 480,settings: {slidesToShow: 1,slidesToScroll: 1}}]
        <?php } ?>                                                                         
    });
});
})(jQuery);        
</script>
<?php wp_reset_postdata(); ?>

<?php if(!empty($instance['d_section']['viewmore'])) { ?>
<div class="besclwp-view-more">
    <a href="<?php echo sow_esc_url($instance['d_section']['viewmore']); ?>"><?php echo esc_attr($instance['d_section']['buttontext']); ?> <i class="fa fa-long-arrow-right"></i></a>
</div>    
<?php } ?>