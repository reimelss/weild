<?php $besclwp_subtitle = get_post_meta( get_the_id(), 'besclwp_cmb2_subtitle', true ); ?>
<?php $besocial_like_dislike = get_option("besocial_like_dislike"); ?>
<?php $besclwp_num_comments = get_comments_number(); ?>
<?php $besclwp_post_tags = get_the_tags(); ?>
<?php $besclwp_remove_sharing = get_option('besclwp_remove_sharing'); ?>
<?php $besclwp_display_featured_imgs = get_option('besclwp_display_featured_imgs'); ?>
<?php if (get_the_title()) { ?>    
<div class="besclwp-page-title">
<?php if (get_the_category()) { ?>
    <div class="besclwp-post-cat-tags">
        <span><?php echo the_category('</span>, <span>'); ?></span>
    </div>
<?php } ?>    
<?php the_title('<h1>','</h1>'); ?>
<?php if (!empty($besclwp_subtitle)) { ?>
    <p class="besclwp-subtitle"><span><?php echo stripslashes(esc_attr($besclwp_subtitle)); ?></span></p>
<?php } ?>
</div>    
<?php } ?>

<?php
if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
}
?>

<div id="post-<?php the_ID(); ?>" class="besclwp-post-content"> 
<?php 
if ((has_post_thumbnail()) && ($besclwp_display_featured_imgs == 'true')) {
$besclwp_post_img_id = get_post_thumbnail_id();
$besclwp_post_img_array = wp_get_attachment_image_src($besclwp_post_img_id, 'full', true);
$besclwp_post_img = $besclwp_post_img_array[0];
?>     
<div class="besclwp-post-format-img">
    <img src="<?php echo esc_url($besclwp_post_img); ?>" alt="<?php the_title(); ?>" />
</div>
<?php } ?>
    <div class="besclwp-post-top-bar"> 
        <div class="besclwp-post-top-bar-inner">
            <div class="besclwp-single-post-date">
                <i class="fa fa-clock-o"></i> <?php echo the_time(get_option('date_format')); ?>
            </div>
            <div class="besclwp-go-to-comments">
            <?php if (comments_open()) { ?>    
            <?php if ( $besclwp_num_comments > 1 ) { ?>
                <a id="besclwp-gotocomments" href="#">
            <?php } else { ?>
                <a id="besclwp-gotoreply" href="#">
            <?php } ?>
            <i class="fa fa-comments"></i> <?php comments_number( esc_html__( 'add comment', 'besocial'), esc_html__( '1 comment', 'besocial'), esc_html__( '% comments', 'besocial') ); ?>  
                </a>
            <?php } else { ?> 
            <?php if ( $besclwp_num_comments > 1 ) { ?>
                <a id="besclwp-gotocomments" href="#">
            <?php } ?>
            <i class="fa fa-comments"></i> <?php comments_number( esc_html__( 'no comments', 'besocial'), esc_html__( '1 comment', 'besocial'), esc_html__( '% comments', 'besocial') ); ?>  
            <?php if ( $besclwp_num_comments > 1 ) { ?>
                </a>
            <?php } ?>        
            <?php } ?>
            <?php
                if((!empty($besocial_like_dislike)) && ($besocial_like_dislike['v-switch-posts'] != 'off') && (function_exists('besocial_render_for_posts'))) {        
                    echo besocial_render_for_posts(true,true); 
                }
            ?>
            </div>
        </div>
    </div> 
<?php the_content(); ?>
<?php wp_link_pages( array(
	'before'      => '<div class="besclwp-page-links">' . esc_html__( 'Pages:', 'besocial' ),
	'after'       => '</div>',
    'link_before' => '<span>',
	'link_after'  => '</span>'
	) );
?>   
    <div class="besclwp-single-post-tags">
        <?php if ($besclwp_post_tags) { ?>
        <div class="tagcloud">    
<?php 
foreach($besclwp_post_tags as $tag) {
    echo '<a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '<span class="besclwp-tag-count"> 
' . $tag->count . '</span></a>'; 
  }
?>
        </div>
        <?php } ?> 
    <?php
    if((!empty($besocial_like_dislike)) && ($besocial_like_dislike['v-switch-posts'] != 'off') && (function_exists('besocial_render_for_posts'))) {      
        echo besocial_render_for_posts(true,true);
    }
    ?> 
    </div>
<?php 
if ( $besclwp_remove_sharing != 'true' ) {   
    get_template_part( 'templates/share', 'template');
}
?>        
</div>