<?php $besclwp_gallery_images = get_post_meta( get_the_id(), 'besclwp_cmb2_gallery', true ); ?>
<?php $besclwp_max_gallery = get_post_meta( get_the_id(), 'besclwp_cmb2_max_gallery', true ); ?>
<?php $besclwp_display_gallery = get_post_meta( get_the_id(), 'besclwp_cmb2_display_gallery', true ); ?>
<?php $besclwp_thumb_size = get_post_meta( get_the_id(), 'besclwp_cmb2_thumb_size', true ); ?>

<div <?php post_class(); ?>>
<article class="besclwp-article-box">
<?php if ((!empty($besclwp_gallery_images)) && ($besclwp_display_gallery == 'on')) { ?>
    <div class="besclwp-format-gallery-carousel hide-on-load">
<?php 
$i = 1;    
foreach ($besclwp_gallery_images as $image => $link) {
    $besclwp_image = wp_get_attachment_image_src( $image, $besclwp_thumb_size );
    if ($i++ > $besclwp_max_gallery) { break; }
?>        
        <a href="<?php esc_url(the_permalink()); ?>">
            <img src="<?php echo esc_url($besclwp_image['0']); ?>" alt="<?php the_title(); ?>" />
        </a>        
<?php } ?>
    </div>        
<?php } else { ?>    
<?php 
    if (has_post_thumbnail()) { 
        $besclwp_thumb_id = get_post_thumbnail_id();
        $besclwp_thumb_url_array = wp_get_attachment_image_src($besclwp_thumb_id, 'large', true);
        $besclwp_thumb_url = $besclwp_thumb_url_array[0];
?>    
    <div class="besclwp-article-img">
        <a href="<?php esc_url(the_permalink()); ?>" class="besclwp-format-icon f-gallery">
        <img src="<?php echo esc_url($besclwp_thumb_url); ?>" alt="<?php the_title(); ?>" />
        </a>
    </div>
<?php } ?> 
<?php } ?>    
    
    <div class="besclwp-article-content">
        <div class="besclwp-post-cat-tags">
            <?php if (get_the_category()) { ?>
            <span><?php echo the_category('</span>, <span>'); ?></span> 
            <?php } ?>
            <?php $besclwp_num_comments = get_comments_number(); ?>
            <span class="besclwp-post-comments">
            <?php if (comments_open()) { ?>
            <?php if ( $besclwp_num_comments > 1 ) { ?>
                <a href="<?php esc_url(the_permalink()); ?>#comments">
            <?php } else { ?>
                <a href="<?php esc_url(the_permalink()); ?>#reply">
            <?php } ?>
            <i class="fa fa-comments"></i> <?php comments_number( esc_html__( 'add comment', 'besocial'), esc_html__( '1 comment', 'besocial'), esc_html__( '% comments', 'besocial') ); ?>  
                </a>
            <?php } else { ?> 
            <?php if ( $besclwp_num_comments > 1 ) { ?>
                <a href="<?php esc_url(the_permalink()); ?>#comments">
            <?php } ?>   
            <i class="fa fa-comments"></i> <?php comments_number( esc_html__( 'no comments', 'besocial'), esc_html__( '1 comment', 'besocial'), esc_html__( '% comments', 'besocial') ); ?>         
            <?php if ( $besclwp_num_comments > 1 ) { ?>
                </a>
            <?php } ?>        
            <?php } ?>
            </span>
        </div>
        <h3>
            <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
        </h3>
        <?php $besclwp_remove_author_links = get_option('besclwp_remove_author_links'); ?>    
        <div class="besclwp-post-date">
            <a href="<?php esc_url(the_permalink()); ?>"><i class="fa fa-clock-o"></i> <?php echo the_time(get_option('date_format')); ?></a><?php if($besclwp_remove_author_links != 'true') { ?> <a class="besclwp-post-author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 20 ); ?> <?php the_author(); ?></a><?php } ?>
        </div>
        <?php the_excerpt(); ?>
    </div>  
</article> 
</div>    