<?php get_header(); ?>
<?php 
$besclwp_blog_layout = esc_attr(get_option('besclwp_blog_layout'));
$besclwp_search_query = get_search_query();
?>

<?php if ( have_posts() ) { ?>
<?php if ($besclwp_blog_layout == 'twocolumns') { ?>
<div class="besclwp-page-title">
    <h1>
    <?php
    global $wp_query;
    $besclwp_post_count = $wp_query->found_posts;
    echo '<span class="besclwp-highlight">' . $besclwp_post_count . ' </span>';
    if ($besclwp_post_count > 1) {
        echo esc_html__( 'Results Found', 'besocial' );
    }
    else {
        echo esc_html__( 'Result Found', 'besocial' );
    }
    ?>
    </h1>
    <?php if (!empty($besclwp_search_query)) { ?>
    <p class="besclwp-subtitle">
    <?php echo esc_html__( 'Search Results for:', 'besocial' ) . ' ' . $besclwp_search_query; ?>    
    </p>
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
<?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
<?php besocial_pagination(); ?>
<?php endif; ?>

<?php } else if ($besclwp_blog_layout == 'threecolumns') { ?>
<div class="besclwp-page-title">
    <h1>
    <?php
    global $wp_query;
    $besclwp_post_count = $wp_query->found_posts;
    echo '<span class="besclwp-highlight">' . $besclwp_post_count . ' </span>';
    if ($besclwp_post_count > 1) {
        echo esc_html__( 'Results Found', 'besocial' );
    }
    else {
        echo esc_html__( 'Result Found', 'besocial' );
    }
    ?>
    </h1>
    <?php if (!empty($besclwp_search_query)) { ?>
    <p class="besclwp-subtitle">
    <?php echo esc_html__( 'Search Results for:', 'besocial' ) . ' ' . $besclwp_search_query; ?>    
    </p>
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
<?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
<?php besocial_pagination(); ?>
<?php endif; ?>

<?php } else if ($besclwp_blog_layout == 'fourcolumns') { ?>
<div class="besclwp-page-title">
    <h1>
    <?php
    global $wp_query;
    $besclwp_post_count = $wp_query->found_posts;
    echo '<span class="besclwp-highlight">' . $besclwp_post_count . ' </span>';
    if ($besclwp_post_count > 1) {
        echo esc_html__( 'Results Found', 'besocial' );
    }
    else {
        echo esc_html__( 'Result Found', 'besocial' );
    }
    ?>
    </h1>
    <?php if (!empty($besclwp_search_query)) { ?>
    <p class="besclwp-subtitle">
    <?php echo esc_html__( 'Search Results for:', 'besocial' ) . ' ' . $besclwp_search_query; ?>    
    </p>
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
<?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
<?php besocial_pagination(); ?>
<?php endif; ?>

<?php } else { ?>
<div class="besclwp-page-left">
<div class="besclwp-page-title">
    <h1>
    <?php
    global $wp_query;
    $besclwp_post_count = $wp_query->found_posts;
    echo '<span class="besclwp-highlight">' . $besclwp_post_count . ' </span>';
    if ($besclwp_post_count > 1) {
        echo esc_html__( 'Results Found', 'besocial' );
    }
    else {
        echo esc_html__( 'Result Found', 'besocial' );
    }
    ?>
    </h1>
    <?php if (!empty($besclwp_search_query)) { ?>
    <p class="besclwp-subtitle">
    <?php echo esc_html__( 'Search Results for:', 'besocial' ) . ' ' . $besclwp_search_query; ?>    
    </p>
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
<?php } else { ?>
<div class="besclwp-post-content besclwp-404-container">
    <h1><?php esc_html_e( 'No Results Found', 'besocial' ); ?></h1>
    <p><?php esc_html_e( 'You can return', 'besocial'); ?> <a href="<?php esc_url( home_url( '/' ) ); ?>/" title="<?php esc_html_e( 'Home', 'besocial' ); ?>"><?php esc_html_e( 'home', 'besocial'); ?></a> <?php esc_html_e( 'or search for the page you were looking for;', 'besocial'); ?></p>
    <div class="besclwp-no-result-form">
    <?php get_search_form(); ?>
    </div>
</div>
<?php } ?>   
<?php get_footer(); ?>