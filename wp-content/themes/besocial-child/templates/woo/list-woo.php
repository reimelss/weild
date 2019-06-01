<?php global $product; ?>
<div <?php post_class(); ?>>
    <div class="besclwp-article-list">    
    <div class="besclwp-article-list-row">
        <?php 
    if (has_post_thumbnail()) { 
        $besclwp_thumb_id = get_post_thumbnail_id();
        $besclwp_thumb_url_array = wp_get_attachment_image_src($besclwp_thumb_id, 'thumbnail', true);
        $besclwp_thumb_url = $besclwp_thumb_url_array[0];
?> 
    <div class="besclwp-article-list-img">
        <a href="<?php esc_url(the_permalink()); ?>">
        <img src="<?php echo esc_url($besclwp_thumb_url); ?>" alt="<?php the_title(); ?>" />
        </a>
    </div>
<?php } ?>     
        <div class="besclwp-article-list-right">
        <h6>
            <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
        </h6>
        <p class="besclwp-woo-list-price">
            <?php echo $product->get_price_html(); ?>
        </p>
        </div>    
    </div>  
</div> 
</div>    