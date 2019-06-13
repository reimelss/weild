<?php	
/*
Template Name: Create a Deal
*/
?>
<?php get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php if(get_the_title()) { ?>
<div class="besclwp-page-title">
    <?php the_title('<h1>','</h1>'); ?>
    <?php if (!empty($besclwp_subtitle)) { ?>
    <p class="besclwp-subtitle"><?php echo stripslashes(esc_attr($besclwp_subtitle)); ?></p>
    <?php } ?>
</div>
<?php } ?>

<div class="besclwp-post-content buddypress">

<?php 

acf_form_head();

get_header();

?>
<div id="content">
	
	<?php
	
	acf_form(array(
		'post_id'		=> 'new_post',
		'post_title'	=> true,
		'post_content'	=> false,
		'new_post'		=> array(
			'post_type'		=> 'deal',
			'post_status'	=> 'publish'
		)
	));
	
	?>
	
</div>

<?php get_footer(); ?>


</div>
<?php the_content(); ?>
<?php wp_link_pages( array(
	'before'      => '<div class="besclwp-page-links">' . esc_html__( 'Pages:', 'besocial' ),
	'after'       => '</div>',
    'link_before' => '<span>',
	'link_after'  => '</span>'
	) );
?>
<div class="clear"></div>
</div>
<?php comments_template(); ?>
<?php endwhile; ?>
<?php get_footer(); ?>