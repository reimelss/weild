<?php get_header(); ?>
<?php $besclwp_blog_layout = esc_attr(get_option('besclwp_author_layout')); ?>

<?php if ($besclwp_blog_layout == 'twocolumns') { ?>
<?php get_template_part( 'templates/authorpage', 'template'); ?> 
<div class="besclwp-masonry-grid">
    <div class="besclwp-two-columns" data-columns>
<?php while(have_posts()) : the_post(); ?>
<?php $besclwp_format = get_post_format(); ?>            
<?php get_template_part( 'templates/formats/excerpt/masonry/post', $besclwp_format); ?>
<?php endwhile; ?>
    </div>
</div>
<?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
<?php besocial_pagination(); ?>
<?php endif; ?>

<?php } else if ($besclwp_blog_layout == 'threecolumns') { ?>
<?php get_template_part( 'templates/authorpage', 'template'); ?>   
<div class="besclwp-masonry-grid">
    <div class="besclwp-three-columns" data-columns>
<?php while(have_posts()) : the_post(); ?>
<?php $besclwp_format = get_post_format(); ?>            
<?php get_template_part( 'templates/formats/excerpt/masonry/post', $besclwp_format); ?>
<?php endwhile; ?>
    </div>
</div>
<?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
<?php besocial_pagination(); ?>
<?php endif; ?>

<?php } else if ($besclwp_blog_layout == 'fourcolumns') { ?>
<?php get_template_part( 'templates/authorpage', 'template'); ?>
<div class="besclwp-masonry-grid">
    <div class="besclwp-four-columns" data-columns>
<?php while(have_posts()) : the_post(); ?>
<?php $besclwp_format = get_post_format(); ?>            
<?php get_template_part( 'templates/formats/excerpt/xsmasonry/post', $besclwp_format); ?>
<?php endwhile; ?>
    </div>
</div>
<?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
<?php besocial_pagination(); ?>
<?php endif; ?>

<?php } else { ?>
<div class="besclwp-page-left">
<?php get_template_part( 'templates/authorpage', 'template'); ?>    
<div class="besclwp-masonry-grid">
    <div class="besclwp-two-columns" data-columns>
<?php while(have_posts()) : the_post(); ?>
<?php $besclwp_format = get_post_format(); ?>            
<?php get_template_part( 'templates/formats/excerpt/masonry/post', $besclwp_format); ?>
<?php endwhile; ?>
    </div>
</div>
<?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
<?php besocial_pagination(); ?>
<?php endif; ?>
</div>
<aside class="besclwp-page-right">
    <div class="theiaStickySidebar">
<?php if ( is_active_sidebar( 'besclwpsidebar' ) ) { dynamic_sidebar( 'besclwpsidebar' ); } ?>
    </div>
</aside>
<div class="clear"></div>
<?php } ?>
<?php get_footer(); ?>