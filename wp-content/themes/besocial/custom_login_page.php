<?php	
/*
Template Name: Login Page
*/
?>
<?php get_header('login'); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php $besclwp_bg_image = get_post_meta( get_the_id(), 'besclwp_cmb2_bg_image', true ); ?>
<?php $besclwp_bg_img_position = get_post_meta( get_the_id(), 'besclwp_cmb2_bg_img_position', true ); ?>
<?php if (!empty($besclwp_bg_image)) { ?>    
<div id="besocial-img-holder" data-img="<?php echo esc_url($besclwp_bg_image); ?>" data-position="<?php echo esc_html($besclwp_bg_img_position); ?>"></div>    
<?php } ?>
    <div id="besclwp-login-content">
        <?php the_content(); ?>
    </div> 
<?php endwhile; ?>
<?php get_footer('login'); ?>