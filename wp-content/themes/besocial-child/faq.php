<?php	
/*
Template Name: FAQ
*/
?>
<?php get_header(); ?>
<?php $besclwp_subtitle = get_post_meta( get_queried_object_id(), 'besclwp_cmb2_subtitle', true ); ?>
<?php $besclwp_bg_image = get_post_meta( get_the_id(), 'besclwp_cmb2_bg_image', true ); ?>
<?php $besclwp_bg_img_position = get_post_meta( get_the_id(), 'besclwp_cmb2_bg_img_position', true ); ?>
<?php $besclwp_faq_search = get_option('besclwp_faq_search'); ?>
<?php if (!empty($besclwp_bg_image)) { ?>    
<div id="besocial-img-holder" data-img="<?php echo esc_url($besclwp_bg_image); ?>" data-position="<?php echo esc_html($besclwp_bg_img_position); ?>"></div>    
<?php } ?>
<?php if(get_the_title()) { ?>
<div class="besclwp-page-title">
    <h1>
        <?php the_title(); ?>
        <?php if ( function_exists( 'besclwp_count_all_faq' ) ) { ?>
        <span class="besclwp-page-title-count"><?php besclwp_count_all_faq(); ?></span>
        <?php } ?>
    </h1>
<?php if (!empty($besclwp_subtitle)) { ?>
    <p class="besclwp-subtitle"><?php echo stripslashes(esc_attr($besclwp_subtitle)); ?></p>
    <?php } ?>
</div>
<?php } ?>    
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<aside class="besclwp-faq-left">
    <div class="theiaStickySidebar">
        <?php 
        if ( function_exists( 'besclwp_faq_menu' ) ) {
            besclwp_faq_menu();
        } ?>
    </div>
</aside>  
<div class="besclwp-faq-right">
<?php
if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
}
?>    
<?php if ( function_exists( 'besclwp_faq_content' ) ) {
    if ($besclwp_faq_search != 'true') {
        besclwp_faq_search();
    }
    the_content();
    besclwp_faq_content();
} else { ?> 
<div class="besclwp-post-content"> 
<?php the_content(); ?>   
</div>    
<?php } ?> 
<div class="clear"></div>    
</div>
<?php endwhile; ?>
<?php get_footer(); ?>