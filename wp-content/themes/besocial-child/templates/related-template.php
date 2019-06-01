<?php
$besclwp_max_related = get_option('besclwp_max_related');
if (empty($besclwp_max_related)) {
    $besclwp_max_related = '6';
}
$besclwp_post_tags = get_the_tags();
$besclwp_post_id = get_the_ID();
if ($besclwp_post_tags) {
    $besclwp_tag_ids = array();
    foreach($besclwp_post_tags as $individual_tag) {
        $besclwp_tag_ids[] = $individual_tag->term_id;
    }
    $besclwp_related_args = array(
        'tag__in' => $besclwp_tag_ids,
        'meta_key' => '_thumbnail_id',
        'post__not_in' => array($besclwp_post_id),
        'posts_per_page'=> $besclwp_max_related,
        'ignore_sticky_posts'=> 1
    );
   
$besclwp_related_query = new WP_Query( $besclwp_related_args );
?>
<div id="besclwp-related-container">
<div id="besclwp-related-posts">
<?php while($besclwp_related_query->have_posts()) : $besclwp_related_query->the_post(); ?>
<?php $besclwp_format = get_post_format(); ?>  
<?php get_template_part( 'templates/formats/excerpt/xsmasonry/post', $besclwp_format); ?> 
<?php endwhile; ?>
<?php wp_reset_postdata(); ?> 
</div> 
</div>    
<?php } ?>