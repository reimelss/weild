<?php
$besclwp_random_id = rand();
if (!empty($instance['b_section']['max'])) {
    $group_max = $instance['b_section']['max'];
}
else {
    $group_max = '99';
}
$group_args_array = array(
    'type' => $instance['b_section']['type'],
    'max' => $group_max,
    'per_page' => $group_max
);
?>
<div class="buddypress-holder">
<?php if (!empty($instance['a_section']['heading'])) { ?>
<div class="besclwp-widget-title-s">
    <<?php echo esc_attr($instance['a_section']['headinglevel']); ?>><?php echo esc_attr($instance['a_section']['heading']); ?></<?php echo esc_attr($instance['a_section']['headinglevel']); ?>>
    <?php if(!empty($instance['a_section']['subtitle'])) { ?>
    <p><?php echo esc_attr($instance['a_section']['subtitle']); ?></p>
    <?php } ?>
</div>
<?php } ?>
<?php if ( ! bp_disable_group_avatar_uploads() ) { ?>    
<?php if ( bp_has_groups($group_args_array) ) : ?>    
<div class="besclwp-carousel-container">
  <?php if ($instance['d_section']['hero'] == 'true') { ?>  
    <div class="besclwp-post-carousel-overlay" style="background:<?php echo esc_html($instance['d_section']['herobgcolor']); ?>;">
        <?php if (!empty($instance['d_section']['herotitle'])) { ?>
        <h1 style="color:<?php echo esc_html($instance['d_section']['herotitlecolor']); ?>;"><?php echo esc_html($instance['d_section']['herotitle']); ?></h1>
        <?php } ?>
        <?php if (!empty($instance['d_section']['herosubtitle'])) { ?>
        <p style="color:<?php echo esc_html($instance['d_section']['herosubtitlecolor']); ?>;"><?php echo esc_html($instance['d_section']['herosubtitle']); ?></p>
        <?php } ?>
        <?php if (!empty($instance['d_section']['herodestination'])) { ?>
        <a href="<?php echo sow_esc_url($instance['d_section']['herodestination']); ?>" class="besocial-button hero-btn <?php echo esc_html($instance['d_section']['herobuttonstyle']); ?>"><?php echo esc_html($instance['d_section']['herobuttontext']); ?></a>
        <?php } ?>
    </div>
    <?php } ?>
    <div id="besclwp-post-carousel-<?php echo esc_attr($besclwp_random_id) ?>" class="besclwp-member-carousel">
        <?php while ( bp_groups() ) : bp_the_group(); ?>
        <div class="besocial-member-car-outer">
            <figure class="besocial-car-img">
                <a href="<?php bp_group_permalink(); ?>"></a>
                <?php bp_group_avatar('type=full'); ?>
                <figcaption>
                    <span><?php bp_group_name(); ?></span>
                </figcaption>
            </figure>
        </div>
        <?php endwhile; ?>        
    </div>
</div>
<?php
    $slidesToScroll = 1;
    $slidesToShow = 1;
    $adaptiveHeight = 'false';
    $responsive = '';
    
    if ($instance['c_section']['columns'] == 'onecolumn') {
        $slidesToShow = 1;
        $adaptiveHeight = 'true';
    } else if ($instance['c_section']['columns'] == 'twocolumns') {
        $slidesToShow = 2;
    } else if ($instance['c_section']['columns'] == 'threecolumns') {
        $slidesToShow = 3;
    } else if ($instance['c_section']['columns'] == 'fourcolumns') {
        $slidesToShow = 4;
    } else if ($instance['c_section']['columns'] == 'fivecolumns') {
        $slidesToShow = 5;
    } else if ($instance['c_section']['columns'] == 'sixcolumns') {
        $slidesToShow = 6;
    } else if ($instance['c_section']['columns'] == 'sevencolumns') {
        $slidesToShow = 7;
    } else if ($instance['c_section']['columns'] == 'eightcolumns') {
        $slidesToShow = 8;
    }
    
    if ($instance['c_section']['single'] == 'true') {
        $slidesToScroll = 1;
        if ($instance['c_section']['columns'] == 'twocolumns') {
            $responsive = '[{breakpoint: 480,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        } else if ($instance['c_section']['columns'] == 'threecolumns') {
            $responsive = '[{breakpoint: 768,settings: {slidesToShow: 2,slidesToScroll: 1}},{breakpoint: 480,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        } else if ($instance['c_section']['columns'] == 'fourcolumns') {
            $responsive = '[{breakpoint: 900,settings: {slidesToShow: 3,slidesToScroll: 1}},{breakpoint: 768,settings: {slidesToShow: 2,slidesToScroll: 1}},{breakpoint: 320,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        } else if ($instance['c_section']['columns'] == 'fivecolumns') {
            $responsive = '[{breakpoint: 1170,settings: {slidesToShow: 4,slidesToScroll: 1}},{breakpoint: 900,settings: {slidesToShow: 3,slidesToScroll: 1}},{breakpoint: 768,settings: {slidesToShow: 2,slidesToScroll: 1}},{breakpoint: 320,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        } else if ($instance['c_section']['columns'] == 'sixcolumns') {
            $responsive = '[{breakpoint: 1370,settings: {slidesToShow: 5,slidesToScroll: 1}},{breakpoint: 1170,settings: {slidesToShow: 4,slidesToScroll: 1}},{breakpoint: 900,settings: {slidesToShow: 3,slidesToScroll: 1}},{breakpoint: 768,settings: {slidesToShow: 2,slidesToScroll: 1}},{breakpoint: 320,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        } else if ($instance['c_section']['columns'] == 'sevencolumns') {
            $responsive = '[{breakpoint: 1370,settings: {slidesToShow: 6,slidesToScroll: 1}},{breakpoint: 1170,settings: {slidesToShow: 5,slidesToScroll: 1}},{breakpoint: 900,settings: {slidesToShow: 4,slidesToScroll: 1}},{breakpoint: 768,settings: {slidesToShow: 3,slidesToScroll: 1}},{breakpoint: 480,settings: {slidesToShow: 2,slidesToScroll: 1}},{breakpoint: 320,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        } else if ($instance['c_section']['columns'] == 'eightcolumns') {
            $responsive = '[{breakpoint: 1370,settings: {slidesToShow: 7,slidesToScroll: 1}},{breakpoint: 1170,settings: {slidesToShow: 6,slidesToScroll: 1}},{breakpoint: 900,settings: {slidesToShow: 5,slidesToScroll: 1}},{breakpoint: 768,settings: {slidesToShow: 4,slidesToScroll: 1}},{breakpoint: 640,settings: {slidesToShow: 3,slidesToScroll: 1}},{breakpoint: 480,settings: {slidesToShow: 2,slidesToScroll: 1}},{breakpoint: 320,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        }
    } else {
        $slidesToScroll = $slidesToShow;
        if ($instance['c_section']['columns'] == 'twocolumns') {
            $responsive = '[{breakpoint: 480,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        } else if ($instance['c_section']['columns'] == 'threecolumns') {
            $responsive = '[{breakpoint: 768,settings: {slidesToShow: 2,slidesToScroll: 2}},{breakpoint: 480,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        } else if ($instance['c_section']['columns'] == 'fourcolumns') {
            $responsive = '[{breakpoint: 900,settings: {slidesToShow: 3,slidesToScroll: 3}},{breakpoint: 768,settings: {slidesToShow: 2,slidesToScroll: 2}},{breakpoint: 320,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        } else if ($instance['c_section']['columns'] == 'fivecolumns') {
            $responsive = '[{breakpoint: 1170,settings: {slidesToShow: 4,slidesToScroll: 4}},{breakpoint: 900,settings: {slidesToShow: 3,slidesToScroll: 3}},{breakpoint: 768,settings: {slidesToShow: 2,slidesToScroll: 2}},{breakpoint: 320,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        } else if ($instance['c_section']['columns'] == 'sixcolumns') {
            $responsive = '[{breakpoint: 1370,settings: {slidesToShow: 5,slidesToScroll: 5}},{breakpoint: 1170,settings: {slidesToShow: 4,slidesToScroll: 4}},{breakpoint: 900,settings: {slidesToShow: 3,slidesToScroll: 3}},{breakpoint: 768,settings: {slidesToShow: 2,slidesToScroll: 2}},{breakpoint: 320,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        } else if ($instance['c_section']['columns'] == 'sevencolumns') {
            $responsive = '[{breakpoint: 1370,settings: {slidesToShow: 6,slidesToScroll: 6}},{breakpoint: 1170,settings: {slidesToShow: 5,slidesToScroll: 5}},{breakpoint: 900,settings: {slidesToShow: 4,slidesToScroll: 4}},{breakpoint: 768,settings: {slidesToShow: 3,slidesToScroll: 3}},{breakpoint: 480,settings: {slidesToShow: 2,slidesToScroll: 2}},{breakpoint: 320,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        } else if ($instance['c_section']['columns'] == 'eightcolumns') {
            $responsive = '[{breakpoint: 1370,settings: {slidesToShow: 7,slidesToScroll: 7}},{breakpoint: 1170,settings: {slidesToShow: 6,slidesToScroll: 6}},{breakpoint: 900,settings: {slidesToShow: 5,slidesToScroll: 5}},{breakpoint: 768,settings: {slidesToShow: 4,slidesToScroll: 4}},{breakpoint: 640,settings: {slidesToShow: 3,slidesToScroll: 3}},{breakpoint: 480,settings: {slidesToShow: 2,slidesToScroll: 2}},{breakpoint: 320,settings: {slidesToShow: 1,slidesToScroll: 1}}]';
        }
    }
?>
<script type="text/javascript">
(function ($) {
"use strict";    
$(document).ready(function () {
    $('#besclwp-post-carousel-<?php echo esc_attr($besclwp_random_id) ?>').slick({
        <?php if ($instance['c_section']['autoplay'] == 'true') { ?>
        autoplay: true,
        autoplaySpeed: <?php if($instance['c_section']['duration'] != '0') { echo esc_js($instance['c_section']['duration'] . '000'); } else { echo '0'; } ?>,
        adaptiveHeight: <?php echo esc_js($adaptiveHeight); ?>,
        infinite: true,
        <?php } else { ?>
        infinite: false,
        <?php } ?>
        <?php if ( is_rtl() ) { ?>
        rtl: true,
        <?php } ?>
        arrows: <?php if ($instance['c_section']['arrows'] == 'true') { ?>true<?php } else { ?>false<?php } ?>,
        dots: <?php if ($instance['c_section']['dots'] == 'true') { ?>true<?php } else { ?>false<?php } ?>,
        slidesToScroll: <?php echo esc_js($slidesToScroll); ?>,
        slidesToShow: <?php echo esc_js($slidesToShow); ?>,      
        <?php if (!empty($responsive)) { ?>
        responsive: <?php echo esc_js($responsive); ?>,
        <?php } ?> 
        rows: <?php echo esc_js($instance['c_section']['rows']); ?>
    });
});
})(jQuery);        
</script>
<?php else: ?>
<div id="message" class="info">
    <p><?php _e( "Sorry, no groups were found.", 'besclwpcpt' ); ?></p>
</div>
<?php endif; ?> 
<?php } else { ?> 
<div id="message" class="info">
    <p><?php _e( "You must enable Group Photo Uploads from BuddyPress settings page.", 'besclwpcpt' ); ?></p>
</div>    
<?php } ?>    
</div>