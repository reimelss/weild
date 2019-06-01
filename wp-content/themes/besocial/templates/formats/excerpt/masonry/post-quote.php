<?php $besclwp_cite = get_post_meta( get_the_id(), 'besclwp_cmb2_subtitle', true ); ?>
<div <?php post_class(); ?>>
<article class="besclwp-article-box">
    <?php 
    if (has_post_thumbnail()) { 
        $besclwp_thumb_id = get_post_thumbnail_id();
        $besclwp_thumb_url_array = wp_get_attachment_image_src($besclwp_thumb_id, 'large', true);
        $besclwp_thumb_url = $besclwp_thumb_url_array[0];
?>    
    <div class="besclwp-article-img">
        <a href="<?php esc_url(the_permalink()); ?>" class="besclwp-format-icon f-quote">
        <img src="<?php echo esc_url($besclwp_thumb_url); ?>" alt="<?php the_title(); ?>" />
        </a>
    </div>
<?php } ?>
    <div class="besclwp-article-content besclwp-format-quote-box">
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