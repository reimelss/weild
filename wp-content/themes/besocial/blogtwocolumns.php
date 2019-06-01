<?php	
/*
Template Name: Blog - Two Columns
*/
?>
<?php get_header(); ?>
<?php
$besclwp_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$besclwp_query = new WP_Query( 
    array('posts_per_page' => get_option( 'posts_per_page' ), 'paged' => $besclwp_paged) 
);
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php $besclwp_subtitle = get_post_meta( get_queried_object_id(), 'besclwp_cmb2_subtitle', true ); ?>
    <?php if(get_the_title()) { ?>
    <div class="besclwp-page-title">
    <?php the_title('<h1>','</h1>'); ?>
        <?php if (!empty($besclwp_subtitle)) { ?>
        <p class="besclwp-subtitle"><?php echo stripslashes(esc_attr($besclwp_subtitle)); ?></p>
        <?php } ?>
        </div>
    <?php } ?>
<?php $besclwp_content = get_the_content(); ?>
<?php if ($besclwp_content) { ?>
<div class="besclwp-post-content besclwp-post-content-margin">
<?php the_content(); ?>   
</div>    
<?php } ?>
<?php endwhile; ?>
    <div class="besclwp-masonry-grid">
        <div class="besclwp-two-columns" data-columns>
<?php while($besclwp_query->have_posts()) : $besclwp_query->the_post(); ?>
<?php $besclwp_format = get_post_format(); ?>            
<?php get_template_part( 'templates/formats/excerpt/masonry/post', $besclwp_format); ?>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>            
        </div>
    </div>
    <?php if ( $besclwp_query->max_num_pages > 1 ) : ?>
    <?php besocial_custom_pagination($besclwp_query); ?> 
    <?php endif; ?>
<?php get_footer(); ?>