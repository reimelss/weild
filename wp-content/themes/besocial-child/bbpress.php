<?php
/*
*
* The template for displaying all bbPress pages
*
* This is the template that displays all bbPress pages by default.
* Please note that this is the template of all bbPress pages
* and that other 'pages' on your WordPress site will use a
* different template.
*
* @package WordPress
* @subpackage Theme
*/
 
?>
<?php get_header(); ?>
<?php $besclwp_bbpress_layout = esc_attr(get_option('besclwp_bbpress_layout')); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php if($besclwp_bbpress_layout != 'fullwidth') { ?><div class="besclwp-page-left"><?php } ?>
<?php if(get_the_title()) { ?>
<div class="besclwp-page-title">
<?php the_title('<h1>','</h1>'); ?>
</div>
<?php } ?>    
<div class="besclwp-builder-content">    
<?php the_content(); ?>   
</div>
<?php if($besclwp_bbpress_layout != 'fullwidth') { ?></div><?php } ?>
<?php endwhile; ?>
<?php if($besclwp_bbpress_layout != 'fullwidth') { ?>    
<aside class="besclwp-page-right">
    <div class="theiaStickySidebar">
<?php if ( is_active_sidebar( 'besclwpsidebar' ) ) { dynamic_sidebar( 'besclwpsidebar' ); } ?>
    </div>
</aside>
<?php } ?>    
<div class="clear"></div>
<?php get_footer(); ?>