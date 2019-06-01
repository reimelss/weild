<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
 * @version     3.3.0
 */
?>
<?php
$besclwp_shop_layout = esc_attr(get_option('besclwp_shop_layout'));
$besclwp_selected_shop_layout = '';

if ($besclwp_shop_layout == 'fourcolumns') { 
    $besclwp_selected_shop_layout = 'besclwp-four-columns';
} elseif ($besclwp_shop_layout == 'threecolumns') { 
    $besclwp_selected_shop_layout = 'besclwp-three-columns';
} else {
    $besclwp_selected_shop_layout = 'besclwp-two-columns';
}

?>
<div class="clear"></div>
<div class="besclwp-masonry-grid">
<div class="<?php echo esc_html($besclwp_selected_shop_layout); ?>" data-columns>
