<?php get_header(); ?>
<?php $besclwp_shop_sub_title = get_option('besclwp_shop_subtitle'); ?>
<?php $besclwp_remove_woocommerce_sidebar = get_option('besclwp_remove_woocommerce_sidebar'); ?>
<?php if ( have_posts() ) : ?>
<?php if (($besclwp_remove_woocommerce_sidebar != 'true') && (!is_product())) { ?>
<div class="besclwp-page-left">
<?php } ?>
<?php if(!is_product()) { ?>
<div class="besclwp-page-title">
    <h1>
        <?php woocommerce_page_title(); ?>
    </h1>
    <?php if ((is_product_category()) || (is_product_tag())) { ?>
    <?php $term_object = get_queried_object(); ?>
    <?php $term_desc = $term_object->description; ?>
    <?php if (!empty($term_desc)) { ?>
    <p class="besclwp-subtitle"><?php echo esc_html($term_desc); ?></p>
    <?php } ?>   
    <?php } elseif (!empty($besclwp_shop_sub_title)) { ?>
    <p class="besclwp-subtitle"><?php echo stripslashes(esc_attr($besclwp_shop_sub_title)); ?></p>
    <?php } ?>  
</div>
<?php } ?>
<div class="besclwp-builder-content">
<?php woocommerce_content(); ?>
<div class="clear"></div>
</div>
<?php if (($besclwp_remove_woocommerce_sidebar != 'true') && (!is_product())) { ?>
</div>
<aside class="besclwp-page-right">
    <div class="theiaStickySidebar">
<?php if ( is_active_sidebar( 'besclwpwoosidebar' ) ) { dynamic_sidebar( 'besclwpwoosidebar' ); } ?>
    </div>
</aside>
<div class="clear"></div>
<?php } ?> 

<?php endif; ?>  
<?php get_footer(); ?>