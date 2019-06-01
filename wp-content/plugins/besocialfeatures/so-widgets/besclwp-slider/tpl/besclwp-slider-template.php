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

<div class="besclwp-post-slider-container">
    <div id="besclwp-post-slider-<?php echo esc_attr($besclwp_random_id) ?>" class="besclwp-post-slider hide-on-load">
<?php while($besclwp_query_result->have_posts()) : $besclwp_query_result->the_post(); ?>
<?php $besclwp_post_type = get_post_type(); ?> 
<?php $besclwp_format = get_post_format(); ?>   
<?php $besclwp_post_link = get_post_meta( get_the_id(), 'besclwp_cmb2_link', true ); ?>
<?php $besclwp_post_link_new_tab = get_post_meta( get_the_id(), 'besclwp_cmb2_link_new_tab', true ); ?>        
<?php 
    if (has_post_thumbnail()) {     
        $img_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src($img_id, 'thumbnail', true);
        $img_url_array = wp_get_attachment_image_src($img_id, $instance['c_section']['size'], true);
        $thumb_url = $thumb_url_array[0];
        $img_url = $img_url_array[0];
    ?>      
        <?php if (( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' )))) && ( $besclwp_post_type == 'product' ) ) { ?>
        <?php global $post, $product; ?>
        <div data-thumbnail="<?php echo esc_url($thumb_url); ?>" data-alt="<?php the_title(); ?>">
            <a href="<?php the_permalink(); ?>"></a>             
                <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title(); ?>" />
            <?php 
            if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
                echo wc_get_rating_html( $product->get_average_rating() );
            }
            ?>
            <?php if ( $product->is_on_sale() ) {
                echo apply_filters( 'woocommerce_sale_flash', '<div class="woocommerce"><span class="onsale">' . esc_html__( 'Sale!', 'besclwpcpt' ) . '</span></div>', $post, $product );
            }
            ?>
                <div class="besclwp-post-slider-desc" style="background-color:<?php echo esc_attr($instance['d_section']['mobilebgcolor']); ?>;">
                    <div class="besclwp-post-slider-inner" style="background-color:<?php echo esc_attr($instance['d_section']['bgcolor']); ?>;">
                        <<?php echo esc_attr($instance['d_section']['excerptlevel']); ?>>
                        <a href="<?php if (!empty($besclwp_post_link)) { echo esc_url($besclwp_post_link); } else { the_permalink(); } ?>" <?php if ($besclwp_post_link_new_tab == 'on') { ?>target="_blank"<?php } ?> style="color:<?php echo esc_attr($instance['d_section']['titlecolor']); ?>;">
                            <?php the_title(); ?>
                        </a>
                        </<?php echo esc_attr($instance['d_section']['excerptlevel']); ?>>
                        <?php if (($instance['b_section']['date'] == 'true') || ($instance['b_section']['category'] == 'true')) { ?>
                        <p style="color:<?php echo esc_attr($instance['d_section']['titlecolor']); ?>;" class="besclwp-woo-desc">
                        <?php if ((wc_get_product_category_list($product->get_id())) && ($instance['b_section']['category'] == 'true')) { ?>
                        <?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="besclwp-woo-cat">' . _n( '<i class="fa fa-folder-open"></i> ', '<i class="fa fa-folder-open"></i> ', count( $product->get_category_ids() ), 'besclwpcpt' ) . ' ', '</span>' ); ?>
                        <?php } ?>
                        <?php if ($instance['b_section']['date'] == 'true') { ?>
                        <span class="besclwp-woo-price"><?php echo $product->get_price_html(); ?></span>
                        <?php } ?>
                        </p>
                        <?php } ?> 
                        <?php if (!empty($instance['d_section']['excerpt']) && ($instance['d_section']['excerpt'] != '0')) {
                        $content = get_the_excerpt();
                        ?>
                        <p style="color:<?php echo esc_attr($instance['d_section']['textcolor']); ?>;"><?php echo wp_trim_words( $content , $instance['d_section']['excerpt'] , '...' ); ?></p>
                        <?php } ?>
                    </div>
                </div>
        </div>        
<?php } else { ?>
<div data-thumbnail="<?php echo esc_url($thumb_url); ?>" data-alt="<?php the_title(); ?>">
            <a href="<?php if (!empty($besclwp_post_link)) { echo esc_url($besclwp_post_link); } else { the_permalink(); } ?>" <?php if ($besclwp_post_link_new_tab == 'on') { ?>target="_blank"<?php } ?> <?php if($besclwp_format) { echo 'class="besclwp-format-icon f-' . $besclwp_format . '"'; } ?>></a>             
                <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title(); ?>" />
                <?php if (($instance['b_section']['date'] == 'true') || ($instance['b_section']['category'] == 'true')) { ?>
                        <div class="besclwp-post-slider-tags">
                            <?php if ($instance['b_section']['date'] == 'true') { ?>
                            <span class="besclwp-post-slider-date"><i class="fa fa-clock-o"></i> <?php echo the_time(get_option('date_format')); ?></span>
                            <?php } ?>
                            <?php if ((get_the_category()) && ($instance['b_section']['category'] == 'true')) { ?>
                            <span><?php echo the_category('</span><span>'); ?></span>
                            <?php } ?>                        
                            <div class="clear"></div>
                        </div>
                        <?php } ?>
                <div class="besclwp-post-slider-desc" style="background-color:<?php echo esc_attr($instance['d_section']['mobilebgcolor']); ?>;">
                    <div class="besclwp-post-slider-inner" style="background-color:<?php echo esc_attr($instance['d_section']['bgcolor']); ?>;">
                        <<?php echo esc_attr($instance['d_section']['excerptlevel']); ?>><a href="<?php if (!empty($besclwp_post_link)) { echo esc_url($besclwp_post_link); } else { the_permalink(); } ?>" <?php if ($besclwp_post_link_new_tab == 'on') { ?>target="_blank"<?php } ?> style="color:<?php echo esc_attr($instance['d_section']['titlecolor']); ?>;"><?php the_title(); ?></a></<?php echo esc_attr($instance['d_section']['excerptlevel']); ?>>
                        <?php if (!empty($instance['d_section']['excerpt']) && ($instance['d_section']['excerpt'] != '0')) {
                        $content = get_the_excerpt();
                        ?>
                        <p style="color:<?php echo esc_attr($instance['d_section']['textcolor']); ?>;"><?php echo wp_trim_words( $content , $instance['d_section']['excerpt'] , '...' ); ?></p>
                        <?php } ?>
                    </div>
                </div>
        </div>
<?php } ?>


<?php } else { ?>
            <div data-thumbnail="<?php echo plugins_url( 'images/placeholder-thumb.png', __FILE__ ); ?>" data-alt="<?php the_title(); ?>">
                <a href="<?php if (!empty($besclwp_post_link)) { echo esc_url($besclwp_post_link); } else { the_permalink(); } ?>" <?php if ($besclwp_post_link_new_tab == 'on') { ?>target="_blank"<?php } ?> <?php if($besclwp_format) { echo 'class="besclwp-format-icon f-' . $besclwp_format . '"'; } ?>></a>
                <img src="<?php echo plugins_url( 'images/placeholder.png', __FILE__ ); ?>" />
                <?php if (($instance['b_section']['date'] == 'true') || ($instance['b_section']['category'] == 'true')) { ?>
                        <div class="besclwp-post-slider-tags">
                            <?php if ($instance['b_section']['date'] == 'true') { ?>
                            <span class="besclwp-post-slider-date"><i class="fa fa-clock-o"></i> <?php echo the_time(get_option('date_format')); ?></span>
                            <?php } ?>
                            <?php if ((get_the_category()) && ($instance['b_section']['category'] == 'true')) { ?>
                            <span><?php echo the_category('</span><span>'); ?></span>
                            <?php } ?>                        
                            <div class="clear"></div>
                        </div>
                        <?php } ?>
                <div class="besclwp-post-slider-desc" style="background-color:<?php echo esc_attr($instance['d_section']['mobilebgcolor']); ?>;">
                    <div class="besclwp-post-slider-inner" style="background-color:<?php echo esc_attr($instance['d_section']['bgcolor']); ?>;">
                        <<?php echo esc_attr($instance['d_section']['excerptlevel']); ?>><a href="<?php if (!empty($besclwp_post_link)) { echo esc_url($besclwp_post_link); } else { the_permalink(); } ?>" <?php if ($besclwp_post_link_new_tab == 'on') { ?>target="_blank"<?php } ?> style="color:<?php echo esc_attr($instance['d_section']['titlecolor']); ?>;"><?php the_title(); ?></a></<?php echo esc_attr($instance['d_section']['excerptlevel']); ?>>
                        <?php if (!empty($instance['d_section']['excerpt']) && ($instance['d_section']['excerpt'] != '0')) {
                        $content = wp_filter_nohtml_kses(strip_shortcodes(get_the_content()));
                        ?>
                        <p style="color:<?php echo esc_attr($instance['d_section']['textcolor']); ?>;"><?php echo wp_trim_words( $content , $instance['d_section']['excerpt'] , '...' ); ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
<?php } ?>
<?php endwhile; ?>
    </div>
<?php if ($instance['c_section']['thumbnails'] == 'true') { ?>    
    <div id="besclwp-post-slider-thumbnails-<?php echo esc_attr($besclwp_random_id) ?>" class="besclwp-post-slider-thumbnails"></div>
    <div class="clear"></div>
<?php } ?>
</div>
<script type="text/javascript">
(function ($) {
"use strict";    
$(document).ready(function () {
    $('#besclwp-post-slider-<?php echo esc_attr($besclwp_random_id) ?>').slick({
        <?php if ($instance['c_section']['autoplay'] == 'true') { ?>
        autoplay: true,
        autoplaySpeed: <?php echo esc_js($instance['c_section']['duration']); ?>000,
        <?php } ?>
        slidesToShow: 1,
        adaptiveHeight: true,
        slidesToScroll: 1,
        <?php if ( is_rtl() ) { ?>
        rtl: true,
        <?php } ?>
        arrows: <?php if ($instance['c_section']['arrows'] == 'true') { ?>true<?php } else { ?>false<?php } ?>,
        fade: <?php if ($instance['c_section']['fade'] == 'true') { ?>true<?php } else { ?>false<?php } ?>,
        <?php if ($instance['c_section']['thumbnails'] == 'true') { ?>
        dots: true,
        appendDots: $('#besclwp-post-slider-thumbnails-<?php echo esc_attr($besclwp_random_id) ?>'),
        dotsClass: 'slick-dots besclwp-slider-dots',
        customPaging: function (slider, i) {
            var thumbnail = $(slider.$slides[i]).data('thumbnail');
            var alt = $(slider.$slides[i]).data('alt');
            return '<a><img src="' + thumbnail + '" alt="' + alt + '"></a>';
        },
        <?php } else { ?>
        dots: false,
        <?php } ?>
        responsive: [{breakpoint: 700,settings: {dots: true,arrows: false}}]                        
    });
});
$(window).on('load', function () {
    $('#besclwp-post-slider-<?php echo esc_attr($besclwp_random_id) ?>').removeClass('hide-on-load');
});    
})(jQuery);        
</script>
<?php wp_reset_postdata(); ?>