<?php
/*---------------------------------------------------
Remove default layout
----------------------------------------------------*/

if ( ! function_exists( 'besocial_woo_dequeue_styles' ) ) {
    function besocial_woo_dequeue_styles( $enqueue_styles ) {
        unset( $enqueue_styles['woocommerce-layout'] );
        return $enqueue_styles;
    }
}
add_filter( 'woocommerce_enqueue_styles', 'besocial_woo_dequeue_styles' );

/*---------------------------------------------------
Remove page titles and taxonomy description
----------------------------------------------------*/

if ( ! function_exists( 'besocial_woo_hide_page_title' ) ) {
    function besocial_woo_hide_page_title() {	
        return false;	
    }
}

add_filter( 'woocommerce_show_page_title' , 'besocial_woo_hide_page_title' );
remove_action( 'woocommerce_archive_description' , 'woocommerce_taxonomy_archive_description', 10 );

/*---------------------------------------------------
Add Product Share Buttons
----------------------------------------------------*/

if ( ! function_exists( 'besocial_add_product_share' ) ) {
    function besocial_add_product_share() {
        $besclwp_remove_product_sharing = esc_attr(get_option('besclwp_remove_product_sharing'));
        if ($besclwp_remove_product_sharing != 'true') {
            get_template_part( 'templates/share', 'template');
        }
    }
}
add_action( 'woocommerce_share' , 'besocial_add_product_share', 10, 2 );

/*---------------------------------------------------
Change product thumbnail size
----------------------------------------------------*/

if ( ! function_exists( 'besocial_product_thumbnail_size' ) ) {
    function besocial_product_thumbnail_size($size) {	
        $besclwp_product_thumbnail = esc_attr(get_option('besclwp_product_thumbnail'));
        if (!empty($besclwp_product_thumbnail)) {
            $size = $besclwp_product_thumbnail;
        } else {
            $size = 'large';
        }
        return $size;
    }
}

add_filter( 'single_product_archive_thumbnail_size' , 'besocial_product_thumbnail_size' );

/*---------------------------------------------------
Custom placeholder
----------------------------------------------------*/

function besocial_custom_woocommerce_placeholder( $image_url ) {
    $besclwp_woo_placeholder = esc_attr(get_option('besclwp_woo_placeholder'));
    if (!empty($besclwp_woo_placeholder)) {
        $image_url = esc_url($besclwp_woo_placeholder);
    } else {
        $image_url = get_template_directory_uri() ."/images/woocommerce-placeholder.png";
    }
    return $image_url;
}

add_filter( 'woocommerce_placeholder_img_src', 'besocial_custom_woocommerce_placeholder', 10 );

/*---------------------------------------------------
Product per page
----------------------------------------------------*/

if ( ! function_exists( 'besocial_loop_shop_per_page' ) ) {
    function besocial_loop_shop_per_page( $cols ) {
        $besclwp_shop_at_most = esc_attr(get_option('besclwp_shop_at_most'));
        if(!empty($besclwp_shop_at_most)) {
            $cols = esc_attr($besclwp_shop_at_most);
        } else {
            $cols = 8;
        }
        return $cols;
    }
}

add_filter( 'loop_shop_per_page', 'besocial_loop_shop_per_page', 20 );

/*---------------------------------------------------
Remove Related Products (Theme Settings)
----------------------------------------------------*/

$besclwp_remove_related = esc_attr(get_option('besclwp_remove_related'));

if ($besclwp_remove_related == 'true') {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

/*---------------------------------------------------
Cart total
----------------------------------------------------*/
if ( ! function_exists( 'becocial_cart_count' ) ) { 
function becocial_cart_count() {
	?>
    <div class="icon-count besocial-woo-cart-count"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></div>
	<?php		
}
}

/*---------------------------------------------------
Cart content
----------------------------------------------------*/
if ( ! function_exists( 'becocial_cart_content' ) ) { 
function becocial_cart_content() {
	?>
    <p class="besocial-cart-content"><i class="fa fa-shopping-cart"></i> <?php echo sprintf (_n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></p>
    <a href="<?php echo wc_get_cart_url(); ?>"><?php esc_html_e( 'View your shopping cart &rarr;', 'besocial' ); ?></a>
	<?php		
}
}

/*---------------------------------------------------
Ajax show cart total
----------------------------------------------------*/
if ( ! function_exists( 'becocial_cart_count_ajax' ) ) { 
function becocial_cart_count_ajax( $fragments ) {    
    $fragments['div.besocial-woo-cart-count'] = '<div class="icon-count besocial-woo-cart-count">' . WC()->cart->get_cart_contents_count() . '</div>'; 
    $fragments['p.besocial-cart-content'] = '<p class="besocial-cart-content"><i class="fa fa-shopping-cart"></i>  ' . sprintf (_n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ) . ' - ' . WC()->cart->get_cart_total() . '</p>'; 
    return $fragments;   
}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'becocial_cart_count_ajax', 10, 1 );

/*---------------------------------------------------
Custom scripts
----------------------------------------------------*/

if ( ! function_exists( 'besclwp_woo_print_scripts' ) ) {
    function besclwp_woo_print_scripts()
    {
        $besclwp_lightbox_js_check = get_option('besclwp_lightbox');
        
        if ( is_product() ) {
            if(!is_rtl()) {
                wp_enqueue_script('besclwp-format-gallery', get_template_directory_uri() . '/js/slick/format-gallery.js', array( 'jquery' ), '1.0', true );
            }
            else {
                wp_enqueue_script('besclwp-format-gallery-rtl', get_template_directory_uri() . '/js/slick/format-gallery-rtl.js', array( 'jquery' ), '1.0', true );
            }
            if (empty($besclwp_lightbox_js_check) && ($besclwp_lightbox_js_check != 'true')) {
                wp_enqueue_script('featherlight', get_template_directory_uri() . '/js/featherlight.js', array( 'jquery' ), '1.5.0', true );
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'besclwp_woo_print_scripts');

/*---------------------------------------------------
Custom styles
----------------------------------------------------*/

if ( ! function_exists( 'besclwp_woo_print_styles' ) ) {
    function besclwp_woo_print_styles()
    {
        $besclwp_lightbox_css_check = get_option('besclwp_lightbox');
        
        if (empty($besclwp_lightbox_css_check) && ($besclwp_lightbox_css_check != 'true') && (is_product())) {
            wp_enqueue_style('featherlight', get_template_directory_uri() . '/css/featherlight.css', false, '1.5.0');
        }
        
        wp_enqueue_style('besclwp-woo', get_template_directory_uri() . '/css/woocommerce.css', false, '1.0');
        
        if (is_rtl()) {
            wp_enqueue_style('besclwp-woo-rtl', get_template_directory_uri() . '/css/woocommerce-rtl.css', false, '1.0');
        }
        
        $besclwp_product_img_size = esc_attr(get_option('besclwp_product_img_size'));
        $besclwp_h1size = esc_attr(get_option('besclwp_h1'));
        $besclwp_h3size = esc_attr(get_option('besclwp_h3'));
        $besclwp_h5size = esc_attr(get_option('besclwp_h5'));
        $besclwp_1_color = esc_attr(get_option('besclwp_1_color'));
        $besclwp_3_color = esc_attr(get_option('besclwp_3_color'));
        $besclwp_4_color = esc_attr(get_option('besclwp_4_color'));
        $besclwp_6_color = esc_attr(get_option('besclwp_6_color'));
        $besclwp_7_color = esc_attr(get_option('besclwp_7_color'));
        
        $besclwp_woo_inline_style = '';
        
        if ((!empty($besclwp_product_img_size)) && ($besclwp_product_img_size != 45)) {
            $besclwp_woo_inline_style .= '.besclwp-single-product-left {width: ' . $besclwp_product_img_size . '%;}.besclwp-single-product-right {width: ' . (100 - $besclwp_product_img_size) . '%;}';   
        }
        
        if ((!empty($besclwp_h1size)) && ($besclwp_h1size != '32')) {
            $besclwp_woo_inline_style .= '.single-product.woocommerce div.product p.price { font-size:' . $besclwp_h1size . 'px; }@media only screen and (max-width: 480px) {.single-product.woocommerce div.product p.price,.single-product.woocommerce div.product span.price { font-size:' . ($besclwp_h1size - 6) . 'px; }}';
        } 
        if ((!empty($besclwp_h3size)) && ($besclwp_h3size != '24')) {
            $besclwp_woo_inline_style .= '.woocommerce-loop-product__title,.woocommerce-loop-category__title,.woocommerce .besclwp-masonry-grid div.product p.price,.woocommerce .besclwp-masonry-grid div.product span.price,.besclwp-woo-carousel-price { font-size:' . $besclwp_h3size . 'px; }@media only screen and (max-width: 480px) {.woocommerce-loop-product__title,.woocommerce-loop-category__title,.woocommerce .besclwp-masonry-grid div.product p.price,.woocommerce .besclwp-masonry-grid div.product span.price,.besclwp-woo-carousel-price { font-size:' . ($besclwp_h3size - 2) . 'px; }}';
        }
        
        if ((!empty($besclwp_h5size)) && ($besclwp_h5size != '20')) {
            $besclwp_woo_inline_style .= '.besclwp-xs-article-box .besclwp-woo-carousel-price { font-size:' . $besclwp_h5size . 'px; }@media only screen and (max-width: 480px) {.besclwp-xs-article-box .besclwp-woo-carousel-price { font-size:' . ($besclwp_h5size - 2) . 'px; }}';
        } 
        
        if ((!empty($besclwp_1_color)) && ($besclwp_1_color != '#2c3d55')) {
            $besclwp_woo_inline_style .= '.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {background-color: ' . $besclwp_1_color . ';}';
        }
        
        if ((!empty($besclwp_3_color)) && ($besclwp_3_color != '#3e6990')) {
            $besclwp_woo_inline_style .= '.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce nav.woocommerce-pagination ul,.woocommerce nav.woocommerce-pagination ul li a:focus,.woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li span.current {background: ' . $besclwp_3_color . ';}';
        }
        
        if ((!empty($besclwp_4_color)) && ($besclwp_4_color != '#427aa1')) { 
            $besclwp_woo_inline_style .= '.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce #respond input#submit.disabled,.woocommerce #respond input#submit:disabled,.woocommerce #respond input#submit:disabled[disabled],.woocommerce a.button.disabled,.woocommerce a.button:disabled,.woocommerce a.button:disabled[disabled],.woocommerce button.button.disabled,.woocommerce button.button:disabled,.woocommerce button.button:disabled[disabled],.woocommerce input.button.disabled,.woocommerce input.button:disabled,.woocommerce input.button:disabled[disabled],.besclwp-woo-lightbox-icon:before,.woocommerce nav.woocommerce-pagination ul li,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover {background: ' . $besclwp_4_color . ';}';
            $besclwp_woo_inline_style .= '.woocommerce div.product p.price,.woocommerce div.product span.price,.woocommerce-loop-category__title mark,.woocommerce-MyAccount-navigation ul li.is-active a,.woocommerce ul.product_list_widget li.empty:before,.woocommerce .widget_shopping_cart .total .woocommerce-Price-amount,.woocommerce.widget_shopping_cart .total .woocommerce-Price-amount,.widget_shopping_cart:after,.so-panel.widget_shopping_cart:after,.woocommerce.widget_layered_nav ul li a:hover,.woocommerce.widget_layered_nav ul li:hover:after,.besclwp-woo-carousel-price,.besclwp-woo-list-price {color: ' . $besclwp_4_color . ';}';
            $besclwp_woo_inline_style .= '.woocommerce .blockUI.blockOverlay:before,.woocommerce .loader:before {border-top-color: ' . $besclwp_4_color . ';}';
            $besclwp_woo_inline_style .= '.woocommerce .woocommerce-ordering .selectric-focus .selectric,.woocommerce .woocommerce-ordering .selectric-open .selectric {border-color: ' . $besclwp_4_color . ';}';
            if (!is_rtl()) {
                $besclwp_woo_inline_style .= '.widget_product_categories ul li ul {border-left: 3px solid ' . $besclwp_4_color . ';}';
            } else {
                $besclwp_woo_inline_style .= '.widget_product_categories ul li ul {border-right: 3px solid ' . $besclwp_4_color . ';}';
            }
        }    
        
        if ((!empty($besclwp_6_color)) && ($besclwp_6_color != '#f1f1f1')) {
            $besclwp_woo_inline_style .= '.woocommerce-page .woocommerce p.cart-empty {border: 5px dashed ' . $besclwp_6_color . ';}';
            $besclwp_woo_inline_style .= '.woocommerce ul.cart_list li,.woocommerce ul.product_list_widget li,.woocommerce.widget_layered_nav ul li {border-bottom: 1px solid ' . $besclwp_4_color . ';}';
            $besclwp_woo_inline_style .= '.woocommerce .widget_shopping_cart .total,.woocommerce.widget_shopping_cart .total {border-top: 1px solid ' . $besclwp_6_color . ';}';
            $besclwp_woo_inline_style .= '.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,.besclwp-post-content .woocommerce-error, .besclwp-post-content .woocommerce-info, .besclwp-post-content .woocommerce-message{background: ' . $besclwp_6_color . ';}';
        }
        
        if ((!empty($besclwp_7_color)) && ($besclwp_7_color != '#ffffff')) {
            $besclwp_woo_inline_style .= '.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce #respond input#submit.disabled,.woocommerce #respond input#submit:disabled,.woocommerce #respond input#submit:disabled[disabled],.woocommerce a.button.disabled,.woocommerce a.button:disabled,.woocommerce a.button:disabled[disabled],.woocommerce button.button.disabled,.woocommerce button.button:disabled,.woocommerce button.button:disabled[disabled],.woocommerce input.button.disabled,.woocommerce input.button:disabled,.woocommerce input.button:disabled[disabled],.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.besclwp-woo-lightbox-icon:before,.woocommerce nav.woocommerce-pagination ul li a:focus,.woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li span.current {color: ' . $besclwp_7_color . ';}';
            $besclwp_woo_inline_style .= '.woocommerce .woocommerce-result-count,.woocommerce-page .woocommerce-result-count,.woocommerce .besclwp-masonry-grid div.product,.besclwp-single-product-right,.woocommerce div.product .woocommerce-tabs .panel,.woocommerce div.product .woocommerce-tabs ul.tabs li.active::before,.besclwp-article-img.besclwp-woo-img,.woocommerce-error, .woocommerce-info, .woocommerce-message {background: ' . $besclwp_7_color . ';}';
            $besclwp_woo_inline_style .= '.woocommerce .woocommerce-ordering .selectric {border-color: ' . $besclwp_7_color . ';}';
        }
        
        wp_add_inline_style( 'besclwp-woo', $besclwp_woo_inline_style );
    }
}
add_action('wp_enqueue_scripts', 'besclwp_woo_print_styles', 99);
?>