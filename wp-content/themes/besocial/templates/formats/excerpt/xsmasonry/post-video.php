<div <?php post_class(); ?>>
<article class="besclwp-article-box besclwp-xs-article-box"> 
<?php if (has_post_thumbnail()) { ?>     
<?php
$besclwp_thumb_id = get_post_thumbnail_id();
$besclwp_thumb_url_array = wp_get_attachment_image_src($besclwp_thumb_id, 'besclwp-rectangle-thumbnail', true);
$besclwp_thumb_url = $besclwp_thumb_url_array[0];
?>    
    <div class="besclwp-article-img">
        <a href="<?php esc_url(the_permalink()); ?>" class="besclwp-format-icon f-video">   
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
        <h5>
            <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
        </h5>
        <?php $besclwp_remove_author_links = get_option('besclwp_remove_author_links'); ?>    
        <p class="besclwp-post-date">
            <a href="<?php esc_url(the_permalink()); ?>"><i class="fa fa-clock-o"></i> <?php echo the_time(get_option('date_format')); ?></a><?php if($besclwp_remove_author_links != 'true') { ?> <a class="besclwp-post-author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 20 ); ?> <?php the_author(); ?></a><?php } ?>
        </p>
    </div> 
</article> 
</div>