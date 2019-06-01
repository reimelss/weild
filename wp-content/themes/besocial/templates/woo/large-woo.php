<?php global $post, $product; ?>
<div <?php post_class(); ?>>
<div class="besclwp-article-box besclwp-woo-box woocommerce"> 
<?php if (has_post_thumbnail()) { ?>    
<?php
$besclwp_thumb_id = get_post_thumbnail_id();
$besclwp_thumb_url_array = wp_get_attachment_image_src($besclwp_thumb_id, 'large', true);
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
        <h3>
            <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
        </h3>   
        <p class="besclwp-woo-carousel-price">
            <?php echo $product->get_price_html(); ?>
        </p>
        <?php
        $besocial_woo_ajax = get_option( 'woocommerce_enable_ajax_add_to_cart' , 'yes');
        if ($besocial_woo_ajax) { 
            if ( $product->is_type( 'variable' ) ) {
                echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
		        esc_url( $product->add_to_cart_url() ),
		        esc_attr( isset( $quantity ) ? $quantity : 1 ),
		        esc_attr( $product->get_id() ),
		        esc_attr( $product->get_sku() ),
		        esc_attr( isset( $class ) ? $class : 'button besocial-button add_to_cart_button' ),
		        esc_html( $product->add_to_cart_text() )), $product );
            } else {
                echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
		        esc_url( $product->add_to_cart_url() ),
		        esc_attr( isset( $quantity ) ? $quantity : 1 ),
		        esc_attr( $product->get_id() ),
		        esc_attr( $product->get_sku() ),
		        esc_attr( isset( $class ) ? $class : 'button besocial-button add_to_cart_button ajax_add_to_cart' ),
		        esc_html( $product->add_to_cart_text() )), $product );
            }        
        } else {
            echo apply_filters( 'woocommerce_loop_add_to_cart_link',
            sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
		    esc_url( $product->add_to_cart_url() ),
		    esc_attr( isset( $quantity ) ? $quantity : 1 ),
		    esc_attr( $product->get_id() ),
		    esc_attr( $product->get_sku() ),
		    esc_attr( isset( $class ) ? $class : 'button besocial-button add_to_cart_button' ),
		    esc_html( $product->add_to_cart_text() )), $product );
        }
        ?>
    </div>  
</div> 
</div>