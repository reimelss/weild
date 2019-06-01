<?php get_header(); ?>
<?php 
$besclwp_remove_author_box = get_option('besclwp_remove_author_box');
$besclwp_activate_related = get_option('besclwp_activate_related');
$besclwp_remove_post_nav = get_option('besclwp_remove_post_nav');
$besclwp_activate_fb_comments = get_option('besclwp_activate_fb_comments');
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post();
$besclwp_sidebar = get_post_meta( get_the_id(), 'besclwp_cmb2_sidebar', true );
$besclwp_format = get_post_format(); 
?> 
<?php $besclwp_bg_image = get_post_meta( get_the_id(), 'besclwp_cmb2_bg_image', true ); ?>
<?php $besclwp_bg_img_position = get_post_meta( get_the_id(), 'besclwp_cmb2_bg_img_position', true ); ?>
<?php if (!empty($besclwp_bg_image)) { ?>    
<div id="besocial-img-holder" data-img="<?php echo esc_url($besclwp_bg_image); ?>" data-position="<?php echo esc_html($besclwp_bg_img_position); ?>"></div>    
<?php } ?>
<?php if($besclwp_sidebar != 'fullwidth') { ?><div class="besclwp-page-left"><?php } ?>    
           
<?php get_template_part( 'templates/formats/content/content', $besclwp_format); ?> 
    
<?php

if ( $besclwp_remove_author_box != 'true' ) {   
    get_template_part( 'templates/authorbox', 'template');
}
 
if ( $besclwp_remove_post_nav != 'true' ) {  
    get_template_part( 'templates/postnav', 'template');
}
 
if ( $besclwp_activate_related == 'true' ) {  
    get_template_part( 'templates/related', 'template');
}  
    
if ( $besclwp_activate_fb_comments == 'true' ) {  
    get_template_part( 'templates/fbcomments', 'template');
}    

comments_template(); 
?>

<?php if($besclwp_sidebar != 'fullwidth') { ?></div><?php } ?>

<?php endwhile; ?>

<?php if($besclwp_sidebar != 'fullwidth') { ?>
<aside class="besclwp-page-right">
    <div class="theiaStickySidebar">
<?php if ( is_active_sidebar( 'besclwpsidebar' ) ) { dynamic_sidebar( 'besclwpsidebar' ); } ?>
    </div>
</aside>
<div class="clear"></div>    
<?php } ?>
<?php get_footer(); ?>