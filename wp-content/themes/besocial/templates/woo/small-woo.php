<?php global $post, $product; ?>
<div <?php post_class(); ?>>
<div class="besclwp-article-box besclwp-xs-article-box besclwp-woo-box"> 
<?php if (has_post_thumbnail()) { ?>    
<?php
$besclwp_thumb_id = get_post_thumbnail_id();
$besclwp_thumb_url_array = wp_get_attachment_image_src($besclwp_thumb_id, 'besclwp-rectangle-thumbnail', true);
$besclwp_thumb_url = $besclwp_thumb_url_array[0]; 
?>  
    <div class="besclwp-article-img besclwp-woo-img">
        <?php 
            if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
                echo wc_get_rating_html( $product->get_average_rating() );
            }
        ?>
        <?php if ( $product->is_on_sale() ) {
                echo apply_filters( 'woocommerce_sale_flash', '<div class="woocommerce"><span class="onsale">' . esc_html__( 'Sale!', 'besocial' ) . '</span></div>', $post, $product );
            }
        ?>
        <a href="<?php esc_url(the_permalink()); ?>">
        <img src="<?php echo esc_url($besclwp_thumb_url); ?>" alt="<?php the_title(); ?>" />
        </a>
    </div>
<?php } ?>    
    <div class="besclwp-article-content">
        <h5>
            <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
        </h5>   
        <p class="besclwp-woo-carousel-price">
            <?php echo $product->get_price_html(); ?>
        </p>
    </div>  
</div> 
</div>