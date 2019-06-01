<?php	
/*
Template Name: Page - Sidebar
*/
?>
<?php get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php $besclwp_bg_image = get_post_meta( get_the_id(), 'besclwp_cmb2_bg_image', true ); ?>
<?php $besclwp_bg_img_position = get_post_meta( get_the_id(), 'besclwp_cmb2_bg_img_position', true ); ?>
<?php if (!empty($besclwp_bg_image)) { ?>    
<div id="besocial-img-holder" data-img="<?php echo esc_url($besclwp_bg_image); ?>" data-position="<?php echo esc_html($besclwp_bg_img_position); ?>"></div>    
<?php } ?>    
<div class="besclwp-page-left">
<?php $besclwp_subtitle = get_post_meta( get_queried_object_id(), 'besclwp_cmb2_subtitle', true ); ?>
<?php if(get_the_title()) { ?>
<div class="besclwp-page-title">
<?php the_title('<h1>','</h1>'); ?>
<?php if (!empty($besclwp_subtitle)) { ?>
    <p class="besclwp-subtitle"><?php echo stripslashes(esc_attr($besclwp_subtitle)); ?></p>
    <?php } ?>
</div>
<?php } ?>
<?php
if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
}
?>    
<div class="besclwp-post-content"> 
<?php the_content(); ?>
<?php wp_link_pages( array(
	'before'      => '<div class="besclwp-page-links">' . esc_html__( 'Pages:', 'besocial' ),
	'after'       => '</div>',
    'link_before' => '<span>',
	'link_after'  => '</span>'
	) );
?> 
<div class="clear"></div>    
</div>    
<?php comments_template(); ?>
</div>
<?php endwhile; ?>
<aside class="besclwp-page-right">
    <div class="theiaStickySidebar">
<?php if ( is_active_sidebar( 'besclwpsidebar' ) ) { dynamic_sidebar( 'besclwpsidebar' ); } ?>
    </div>
</aside>
<div class="clear"></div>
<?php get_footer(); ?>