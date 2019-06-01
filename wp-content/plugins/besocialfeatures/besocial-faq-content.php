<div id="besclwp-faq-cat-container">
<?php
$besclwp_categories = get_terms("besclwpfaqcats");

foreach($besclwp_categories as $category) { 
    $catid = $category->term_id;
?>
<?php 
$besclwp_faq_args = array(
    'post_type' => 'besclwpfaq',
    'posts_per_page' => 99,
    'tax_query' => array(
		array(
			'taxonomy' => 'besclwpfaqcats',
			'field'    => 'slug',
            'terms'    => $category->slug
		),
	),
); 
$besclwp_faq_query = new WP_Query( $besclwp_faq_args );
$besclwp_cat_count = $besclwp_faq_query->post_count;  
?>
<h4 id="besclwp-cat-<?php echo esc_html($category->term_id); ?>" class="besclwp-faq-cat-title"><?php echo esc_html($category->name); ?><span><?php esc_html_e($besclwp_cat_count); ?></span></h4>
<div class="besclwp-accordion-container">
<?php while($besclwp_faq_query->have_posts()) : $besclwp_faq_query->the_post(); ?>
<?php $besclwp_answer = get_post_meta( get_the_id(), 'besclwp_cmb2_answer', true ); ?>
    <div class="besclwp-live-search-results">
        <div class="besclwp-accordion-header"><?php the_title('<strong>', '</strong>'); ?></div>
        <div class="besclwp-accordion-content"><?php echo wp_kses_post(wpautop($besclwp_answer)); ?></div>
    </div>
<?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>
<?php } ?>
</div>