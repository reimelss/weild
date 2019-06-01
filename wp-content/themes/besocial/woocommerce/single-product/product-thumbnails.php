<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 * EDITED
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$besclwp_lightbox = get_option('besclwp_lightbox');
$besclwp_product_image = esc_attr(get_option('besclwp_product_image'));

if (empty($besclwp_product_image)) {
    $besclwp_product_image = 'large';
}

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();


if ( $attachment_ids && has_post_thumbnail() ) {
	foreach ( $attachment_ids as $attachment_id ) {
		$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
		$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
		$image_title     = get_post_field( 'post_excerpt', $attachment_id );

		$attributes = array(
			'title'                   => $image_title,
			'data-src'                => $full_size_image[0],
			'data-large_image'        => $full_size_image[0],
			'data-large_image_width'  => $full_size_image[1],
			'data-large_image_height' => $full_size_image[2],
		);
        if ($full_size_image) {
        if ($besclwp_lightbox != 'true') {
            $html  = '<div data-thumbnail="' . esc_url( $thumbnail[0] ) . '"><div class="besclwp-woo-lightbox-icon" data-featherlight="' . esc_url( $full_size_image[0] ) . '"></div>';
        } else {
            $html  = '<div data-thumbnail="' . esc_url( $thumbnail[0] ) . '">';
        }
        $html .= '<img src="' . wp_get_attachment_image_url( $attachment_id, $besclwp_product_image, $attributes ) . '" alt="' . get_the_title() . '" />';
 		$html .= '</div>';

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
        }
        
	}
}
?>