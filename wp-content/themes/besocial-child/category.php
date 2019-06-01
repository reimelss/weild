<?php get_header(); ?>
<?php 
$besclwp_category_id = get_query_var('cat');
$besclwp_cat_name = get_category($besclwp_category_id)->name;
$besclwp_cat_desc = get_category($besclwp_category_id)->description;
$besclwp_blog_layout = esc_attr(get_option( "category_besclwpcatlayout_$besclwp_category_id" )); 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$besclwp_cat_query = new WP_Query( 
    array('cat' => $besclwp_category_id,'posts_per_page' => get_option( 'posts_per_page' ), 'paged' => $paged) 
);
?>

<?php if ($besclwp_blog_layout == 'twocolumns') { ?>
<div class="besclwp-page-title">
    <h1><?php echo esc_attr($besclwp_cat_name); ?></h1>
    <?php if (!empty($besclwp_cat_desc)) { ?>
    <p class="besclwp-subtitle"><?php echo stripslashes(esc_attr($besclwp_cat_desc)); ?></p>
    <?php } ?>
</div>    
<div class="besclwp-masonry-grid">
    <div class="besclwp-two-columns" data-columns>
<?php while(have_posts()) : the_post(); ?>
<?php $besclwp_format = get_post_format(); ?>            
<?php get_template_part( 'templates/formats/excerpt/masonry/post', $besclwp_format); ?>
<?php endwhile; ?>
    </div>
</div>
<?php if ( $besclwp_cat_query->max_num_pages > 1 ) : ?>
<?php besocial_custom_pagination($besclwp_cat_query); ?> 
<?php endif; ?>
<?php } else if ($besclwp_blog_layout == 'threecolumns') { ?>
<div class="besclwp-page-title">
    <h1><?php echo esc_attr($besclwp_cat_name); ?></h1>
    <?php if (!empty($besclwp_cat_desc)) { ?>
    <p class="besclwp-subtitle"><?php echo stripslashes(esc_attr($besclwp_cat_desc)); ?></p>
    <?php } ?>
</div>  
<div class="besclwp-masonry-grid">
    <div class="besclwp-three-columns" data-columns>
<?php while(have_posts()) : the_post(); ?>
<?php $besclwp_format = get_post_format(); ?>            
<?php get_template_part( 'templates/formats/excerpt/masonry/post', $besclwp_format); ?>
<?php endwhile; ?>
    </div>
</div>
<?php if ( $besclwp_cat_query->max_num_pages > 1 ) : ?>
<?php besocial_custom_pagination($besclwp_cat_query); ?> 
<?php endif; ?>
<?php } else if ($besclwp_blog_layout == 'fourcolumns') { ?>
<div class="besclwp-page-title">
    <h1><?php echo esc_attr($besclwp_cat_name); ?></h1>
    <?php if (!empty($besclwp_cat_desc)) { ?>
    <p class="besclwp-subtitle"><?php echo stripslashes(esc_attr($besclwp_cat_desc)); ?></p>
    <?php } ?>
</div>
<div class="besclwp-masonry-grid">
    <div class="besclwp-four-columns" data-columns>
<?php while(have_posts()) : the_post(); ?>
<?php $besclwp_format = get_post_format(); ?>            
<?php get_template_part( 'templates/formats/excerpt/xsmasonry/post', $besclwp_format); ?>
<?php endwhile; ?>
    </div>
</div>
<?php if ( $besclwp_cat_query->max_num_pages > 1 ) : ?>
<?php besocial_custom_pagination($besclwp_cat_query); ?> 
<?php endif; ?>
<?php } else { ?>
<div class="besclwp-page-left">
<div class="besclwp-page-title">
    <h1><?php echo esc_attr($besclwp_cat_name); ?></h1>
    <?php if (!empty($besclwp_cat_desc)) { ?>
    <p class="besclwp-subtitle"><?php echo stripslashes(esc_attr($besclwp_cat_desc)); ?></p>
    <?php } ?>
</div>  
<div class="besclwp-masonry-grid">
    <div class="besclwp-two-columns" data-columns>
<?php while(have_posts()) : the_post(); ?>
<?php $besclwp_format = get_post_format(); ?>            
<?php get_template_part( 'templates/formats/excerpt/masonry/post', $besclwp_format); ?>
<?php endwhile; ?>
    </div>
</div>
<?php if ( $besclwp_cat_query->max_num_pages > 1 ) : ?>
<?php besocial_custom_pagination($besclwp_cat_query); ?> 
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