<?php $besclwp_woocommerce_icon = get_option('besclwp_woocommerce_icon'); ?>
<?php $besclwp_menu_title = get_option('besclwp_woocommerce_title'); ?>
<!-- WOOCOMMERCE -->
<?php if (( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) )))) { ?>
<li id="woocommerce-besocial" class="has-submenu" data-count="<?php echo esc_html(WC()->cart->get_cart_contents_count()); ?>"><a href="#"><?php becocial_cart_count(); ?><i class="fa <?php if (!empty($besclwp_woocommerce_icon)) { echo esc_attr($besclwp_woocommerce_icon); } else { echo 'fa-shopping-cart'; } ?>"></i></a>
    <ul class="sidemenu-sub">
        <li>
            <h5><?php echo esc_html__( 'Shopping Cart', 'besocial'); ?></h5>
        </li>
        <li>
            <?php becocial_cart_content(); ?>
        </li>
        <li>
            <h5>
                <?php if (!empty($besclwp_menu_title)) { echo esc_html($besclwp_menu_title); } else { esc_html_e( 'My Account', 'besocial'); } ?>
            </h5>
        </li>
        <?php do_action( 'besocial_before_woocommerce_menu' ); ?>
        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
        <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
            <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?> <i class="fa woo-icon <?php echo $endpoint; ?>"></i></a>
        </li>
        <?php endforeach; ?>
        <?php do_action( 'besocial_after_woocommerce_menu' ); ?>
    </ul>
</li>
<?php } ?>