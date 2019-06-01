<?php $besclwp_random_id = rand(); ?>

<?php $slider_items = $instance['a_repeater']; ?>
<?php if (!empty($slider_items)) { ?>
<div class="besclwp-post-slider-container">
    <div id="besclwp-post-slider-<?php echo esc_attr($besclwp_random_id) ?>" class="besclwp-post-slider">
        <?php foreach( $slider_items as $index => $repeater_item ) { ?>
        <div>   
            <?php if (!empty($repeater_item['url'])) { ?>
            <a href="<?php echo sow_esc_url($repeater_item['url']); ?>" <?php if (($repeater_item['target']) == 'on') { ?>target="_blank"<?php } ?>></a>
            <?php } ?> 
            <?php 
            $img_url_array = siteorigin_widgets_get_attachment_image_src($repeater_item['image'], $instance['b_section']['size'], true);
            $img_url = $img_url_array[0];
            ?>
            <img src="<?php echo esc_url($img_url_array[0]); ?>" alt="<?php echo esc_html($repeater_item['title']); ?>" />
            <?php if((!empty($repeater_item['title'])) || (!empty($repeater_item['subtitle']))) { ?>
            <div class="besclwp-slider-title-container <?php echo esc_html($repeater_item['position']); ?>">
                <?php if(!empty($repeater_item['title'])) { ?>
                <div class="besclwp-slider-title"><span style="color:<?php echo esc_html($repeater_item['titlecolor']); ?>;background:<?php echo esc_html($repeater_item['titlebgcolor']); ?>;"><?php echo esc_html($repeater_item['title']); ?></span></div>
                <?php } ?>
                <?php if(!empty($repeater_item['subtitle'])) { ?>
                <div class="besclwp-slider-subtitle"><span style="color:<?php echo esc_html($repeater_item['subtitlecolor']); ?>;background:<?php echo esc_html($repeater_item['subtitlebgcolor']); ?>;"><?php echo esc_html($repeater_item['subtitle']); ?></span></div>
                <?php } ?>
            </div>  
            <?php } ?>
        </div>    
        <?php } ?>
    </div>
</div>

<script type="text/javascript">
(function ($) {
"use strict";    
$(document).ready(function () {
    $('#besclwp-post-slider-<?php echo esc_attr($besclwp_random_id) ?>').slick({
        <?php if ($instance['b_section']['autoplay'] == 'true') { ?>
        autoplay: true,
        autoplaySpeed: <?php echo esc_js($instance['b_section']['duration']); ?>000,
        <?php } ?>
        slidesToShow: 1,
        adaptiveHeight: true,
        slidesToScroll: 1,
        <?php if ( is_rtl() ) { ?>
        rtl: true,
        <?php } ?>
        arrows: <?php if ($instance['b_section']['arrows'] == 'true') { ?>true<?php } else { ?>false<?php } ?>,
        fade: <?php if ($instance['b_section']['fade'] == 'true') { ?>true<?php } else { ?>false<?php } ?>,
        dots: false                      
    });
});
})(jQuery);    
</script>
<?php } ?>