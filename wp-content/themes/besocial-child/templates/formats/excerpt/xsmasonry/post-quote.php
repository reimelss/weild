<?php $besclwp_cite = get_post_meta( get_the_id(), 'besclwp_cmb2_subtitle', true ); ?>
<div <?php post_class(); ?>>
<article class="besclwp-article-box besclwp-xs-article-box"> 
<?php if (has_post_thumbnail()) { ?>     
<?php
$besclwp_thumb_id = get_post_thumbnail_id();
$besclwp_thumb_url_array = wp_get_attachment_image_src($besclwp_thumb_id, 'besclwp-rectangle-thumbnail', true);
$besclwp_thumb_url = $besclwp_thumb_url_array[0];
?>    
    <div class="besclwp-article-img">
        <a href="<?php esc_url(the_permalink()); ?>" class="besclwp-format-icon f-quote">
            <img src="<?php echo esc_url($besclwp_thumb_url); ?>" alt="<?php the_title(); ?>" />
        </a>
    </div>
<?php } ?>    
    <div class="besclwp-article-content">
        <?php if (get_the_category()) { ?>
        <div class="besclwp-post-cat-tags">
            <span><?php echo the_category('</span>, <span>'); ?></span>
        </div>
        <?php } ?>
        <blockquote class="besclwp-format-quote">
            <p>
            <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
            </p>
            <?php if (!empty($besclwp_cite)) { ?>
            <p class="besclwp-cite"><span><?php echo esc_attr($besclwp_cite); ?></span></p>
            <?php } ?>
        </blockquote>
    </div> 
</article> 
</div>