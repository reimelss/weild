<?php $besclwp_post_link = get_post_meta( get_the_id(), 'besclwp_cmb2_link', true ); ?>
<?php $besclwp_post_link_new_tab = get_post_meta( get_the_id(), 'besclwp_cmb2_link_new_tab', true ); ?>
<div <?php post_class(); ?>>
<article class="besclwp-article-box">
<?php 
    if (has_post_thumbnail()) { 
        $besclwp_thumb_id = get_post_thumbnail_id();
        $besclwp_thumb_url_array = wp_get_attachment_image_src($besclwp_thumb_id, 'large', true);
        $besclwp_thumb_url = $besclwp_thumb_url_array[0];
?>    
    <div class="besclwp-article-img">
        <a href="<?php if (!empty($besclwp_post_link)) { echo esc_url($besclwp_post_link); } else { esc_url(the_permalink()); } ?>" <?php if ($besclwp_post_link_new_tab == 'on') { ?>target="_blank"<?php } ?>  class="besclwp-format-icon f-link">
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
        <h3>
            <a href="<?php if (!empty($besclwp_post_link)) { echo esc_url($besclwp_post_link); } else { esc_url(the_permalink()); } ?>" <?php if ($besclwp_post_link_new_tab == 'on') { ?>target="_blank"<?php } ?>><?php the_title(); ?></a>
        </h3>
        <?php $besclwp_remove_author_links = get_option('besclwp_remove_author_links'); ?>    
        <div class="besclwp-post-date">
            <a href="<?php esc_url(the_permalink()); ?>"><i class="fa fa-clock-o"></i> <?php echo the_time(get_option('date_format')); ?></a><?php if($besclwp_remove_author_links != 'true') { ?> <a class="besclwp-post-author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 20 ); ?> <?php the_author(); ?></a><?php } ?>
        </div>
        <?php the_excerpt(); ?>
    </div>  
</article> 
</div>    