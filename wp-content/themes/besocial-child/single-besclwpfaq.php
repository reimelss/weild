<?php get_header(); ?>
<?php $besclwp_answer = get_post_meta( get_the_id(), 'besclwp_cmb2_answer', true ); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php if(get_the_title()) { ?>
<div class="besclwp-page-title">
<?php the_title('<h1>','</h1>'); ?>
</div>
<?php } ?>
<?php
if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
}
?>
<div class="besclwp-post-content">
<?php echo wp_kses_post(wpautop($besclwp_answer)); ?> 
    <div class="clear"></div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>