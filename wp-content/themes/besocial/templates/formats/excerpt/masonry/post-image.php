<?php $besclwp_format_img_style = get_post_meta( get_the_id(), 'besclwp_cmb2_format_img_style', true ); ?>
<?php $besclwp_animated_gif = get_post_meta( get_the_id(), 'besclwp_cmb2_animated_gif', true ); ?>

<?php if ((has_post_thumbnail()) && ($besclwp_format_img_style == 'bgimg')) { ?>
<div <?php post_class(); ?>>
<article class="besclwp-article-box besclwp-format-img-box"> 
<?php if (!empty($besclwp_animated_gif)) { ?>
    <img class="besclwp-format-img-img" src="<?php echo esc_url($besclwp_animated_gif); ?>" alt="<?php the_title(); ?>" />
<?php } else { ?>    
<?php
$besclwp_thumb_id = get_post_thumbnail_id();
$besclwp_thumb_url_array = wp_get_attachment_image_src($besclwp_thumb_id, 'large', true);
$besclwp_thumb_url = $besclwp_thumb_url_array[0];
?>    
    <img class="besclwp-format-img-img" src="<?php echo esc_url($besclwp_thumb_url); ?>" alt="<?php the_title(); ?>" />  
<?php } ?>    
    <div class="besclwp-format-img"> 
        <a class="besclwp-format-img-content" href="<?php esc_url(the_permalink()); ?>">
        <h3>
            <?php the_title(); ?>
        </h3>
        </a>
    </div>
</article> 
</div> 
<?php } else if (has_post_thumbnail()) { ?> 
<div <?php post_class(); ?>  id="post-<?php the_ID(); ?>">   
<article class="besclwp-article-box">     
<?php if (!empty($besclwp_animated_gif)) { ?>
    <div class="besclwp-article-img">
        <a href="<?php esc_url(the_permalink()); ?>">
            <img src="<?php echo esc_url($besclwp_animated_gif); ?>" alt="<?php the_title(); ?>" />
        </a>      
    </div> 
<?php    
}
else {
    $besclwp_thumb_id = get_post_thumbnail_id();                                        
    $besclwp_thumb_url_array = wp_get_attachment_image_src($besclwp_thumb_id, 'large', true);
    $besclwp_thumb_url = $besclwp_thumb_url_array[0];
?>
    <div class="besclwp-article-img">
        <a href="<?php esc_url(the_permalink()); ?>" class="besclwp-format-icon f-image">
            <img src="<?php echo esc_url($besclwp_thumb_url); ?>" alt="<?php the_title(); ?>" />
        </a>      
    </div>    
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
<?php } else { ?> 
<div <?php post_class(); ?>  id="post-<?php the_ID(); ?>">   
<article class="besclwp-article-box">
    <div class="besclwp-article-content">
        <?php if (get_the_category()) { ?>
        <div class="besclwp-post-cat-tags">
            <span><?php echo the_category('</span>, <span>'); ?></span>
        </div>
        <?php } ?>
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
<?php } ?>