<?php $besclwp_random_id = rand(); ?>

<?php if (!empty($instance['a_section']['heading'])) { ?>
<div class="besclwp-widget-title">
    <<?php echo esc_attr($instance['a_section']['headinglevel']); ?>><?php echo esc_attr($instance['a_section']['heading']); ?></<?php echo esc_attr($instance['a_section']['headinglevel']); ?>>
    <?php if(!empty($instance['a_section']['subtitle'])) { ?>
    <p><?php echo esc_attr($instance['a_section']['subtitle']); ?></p>
    <?php } ?>
</div>
<?php } ?>

<?php $testimonial_items = $instance['a_repeater']; ?>
<?php if (!empty($testimonial_items)) { ?>
<div class="besclwp-post-slider-container">
    <div id="besclwp-post-slider-<?php echo esc_attr($besclwp_random_id) ?>" class="besclwp-post-slider">
        <?php foreach( $testimonial_items as $index => $repeater_item ) { ?>
        <div> 
            <div class="besclwp-testimonial <?php echo esc_html($instance['b_section']['position']); ?>">
                <?php if ($instance['b_section']['position'] == 'testimonial-right') { ?>
                <div class="besclwp-testimonial-center">
                <?php echo wp_kses_post(wpautop($repeater_item['text'])); ?>
                </div>
                <?php } ?>
                <?php if (!empty($repeater_item['image'])) { ?>
                <div class="besclwp-testimonial-left">
                    <?php if (!empty($repeater_item['url'])) { ?>
                    <a href="<?php echo sow_esc_url($repeater_item['url']); ?>" <?php if (($repeater_item['target']) == 'on') { ?>target="_blank"<?php } ?>>
                    <?php } ?> 
                    <?php 
                    $img_url_array = siteorigin_widgets_get_attachment_image_src($repeater_item['image'], 'thumbnail', true);
                    $img_url = $img_url_array[0];
                    ?>
                    <div class="besclwp-img-holder">
                    <img src="<?php echo esc_url($img_url_array[0]); ?>" alt="<?php echo esc_html($repeater_item['name']); ?>" />
                    </div>
                    <?php if (!empty($repeater_item['url'])) { ?>    
                    </a>
                    <?php } ?>
                    <div class="besclwp-testimonial-cite">
                        <?php if (!empty($repeater_item['url'])) { ?>
                        <a href="<?php echo sow_esc_url($repeater_item['url']); ?>" <?php if (($repeater_item['target']) == 'on') { ?>target="_blank"<?php } ?>>
                        <?php } ?> 
                        <?php echo esc_html($repeater_item['name']); ?>
                        <?php if (!empty($repeater_item['url'])) { ?>    
                        </a>
                        <?php } ?>
                        <?php if (!empty($repeater_item['info'])) { ?>
                        <span><?php echo esc_html($repeater_item['info']); ?></span>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <?php if ($instance['b_section']['position'] == 'testimonial-left') { ?>
                <div class="besclwp-testimonial-center">
                <?php echo wp_kses_post(wpautop($repeater_item['text'])); ?>
                </div>
                <?php } ?>
            </div>
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
        fade: true,
        arrows:false,
        dots: <?php if ($instance['b_section']['dots'] == 'true') { ?>true<?php } else { ?>false<?php } ?>                      
    });
});
})(jQuery);    
</script>
<?php } ?>