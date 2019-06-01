<?php $besclwp_activate_fb_comments = get_option('besclwp_activate_fb_comments'); ?>
<?php $besclwp_fb_color_scheme = get_option('besclwp_fb_color_scheme'); ?>
<?php $besclwp_fb_max = get_option('besclwp_fb_max'); ?>
<?php $besclwp_fb_order = get_option('besclwp_fb_order'); ?>
<?php $besclwp_fb_title = get_option('besclwp_fb_title'); ?>
<div id="besclwp-facebook-comments">
    <?php if (!empty($besclwp_fb_title)) { ?>
    <h3><?php echo esc_html($besclwp_fb_title); ?></h3>
    <?php } ?>
    <div id="fb-root"></div>
    <div class="fb-comments" data-href="<?php esc_url(the_permalink()); ?>" data-numposts="<?php echo esc_html($besclwp_fb_max); ?>" data-colorscheme="<?php echo esc_html($besclwp_fb_color_scheme); ?>" data-width="100%" data-order-by="<?php echo esc_html($besclwp_fb_order); ?>"></div>
</div>