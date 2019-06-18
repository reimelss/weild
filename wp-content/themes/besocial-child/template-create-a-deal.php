<?php	
/*
Template Name: Create a Deal
*/
wp_enqueue_script( 'myscript', get_stylesheet_directory_uri() . '/js/script_create_deal.js', array( 'jquery' ), '1.0.2', true);
?>
<?php
if (!is_user_logged_in() ) {
    wp_redirect( site_url('/login/'));
}

acf_form_head();

get_header(); ?>
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


get_header();

?>
<div id="content">
	
	<?php
	
	acf_form(array(
		'post_id'		=> 'new_post',
		'post_title'	=> false,
		'post_content'	=> false,
		'new_post'		=> array(
			'post_type'		=> 'deal',
		),
		'return' 		=> site_url("/my-deals/")
	));
	
	?>
	
</div>
<style>
.acf-field-5d04504b50e01 {
	display:none;
}
</style>


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

<style>


.acf-field-5cf2efe443032 input{
	margin-left:21px!important;

}
#acf-field_5cf2efe443032-10-Energy,
#acf-field_5cf2efe443032-25-Consumer-Discretionary,
#acf-field_5cf2efe443032-15-Materials,
#acf-field_5cf2efe443032-20-Industrials,
#acf-field_5cf2efe443032-30-Consumer-Staples,
#acf-field_5cf2efe443032-35-Health-Care,
#acf-field_5cf2efe443032-40-Financials,
#acf-field_5cf2efe443032-45-Information-Technology,
#acf-field_5cf2efe443032-50-Communication-Services,
#acf-field_5cf2efe443032-55-Utilities,
#acf-field_5cf2efe443032-60-Real-Estate

{
	 margin-left:0px!important;

}


#field_70 label, #field_77 label, 
#field_79 label, #field_204 label, 
#field_208 label, #field_215 label, 
#field_231 label, #field_245 label, 
#field_253 label, #field_261 label, 
#field_270 label, #field_279 label, 
#field_286 label, #field_293 label, 
#field_298 > label,
/*.acf-field-5cf2efd643031 .acf-input ul li:nth-child(7), */
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(8), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(9), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(10)
 {
    margin-left: 20px!important;
}
#field_70 label:first-child, 
#field_77 label:first-child, 
#field_79 label:first-child, 
#field_204 label:first-child, 
#field_208 label:first-child, 
#field_215 label:first-child, 
#field_231 label:first-child, 
#field_245 label:first-child, 
#field_253 label:first-child, 
#field_261 label:first-child, 
#field_270 label:first-child, 
#field_279 label:first-child, 
#field_286 label:first-child, 
#field_293 label:first-child, 
#field_298 > label:nth-child(1), 
#field_298 > label:nth-child(4),
#field_298 > label:nth-child(10), 
#field_298 > label:nth-child(25), 
#field_298 > label:nth-child(38), 
#field_298 > label:nth-child(45), 
#field_298 > label:nth-child(52), 
#field_298 > label:nth-child(60), 
#field_298 > label:nth-child(68), 
#field_298 > label:nth-child(74), 
#field_298 > label:nth-child(80), 
#field_79 label:last-child,
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(25),
/* .acf-field-5cf2efd643031 .acf-input ul li:nth-child(5), */
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(6),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(7),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(34),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(36),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(37),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(38),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(39),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(40),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(41),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(45)
/*.acf-field-5cf2efd643031 .acf-input ul li:nth-child(22)*/

 {
    margin-left: 0!important;
}
#field_77 > label:nth-child(4), 
#field_77 > label:nth-child(5), 
#field_77 > label:nth-child(6), 
#field_77 > label:nth-child(7), 
#field_77 > label:nth-child(8), 
#field_77 > label:nth-child(9), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(2),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(3),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(4),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(5),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(8),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(9),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(15),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(19),
/*.acf-field-5cf2efd643031 .acf-input ul li:nth-child(10), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(11), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(12), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(13), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(14),*/

/*.acf-field-5cf2efd643031 .acf-input ul li:nth-child(24), */
/*.acf-field-5cf2efd643031 .acf-input ul li:nth-child(25), */
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(26), 

.acf-field-5cf2efd643031 .acf-input ul li:nth-child(34),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(44),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(46),

#field_2347_15
 {
    margin-left: 40px!important;
}



/* 
** Forth Level Product Expertise_Follow-on
*/
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(10),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(11),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(12),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(13),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(14),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(16), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(17), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(18),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(20),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(21),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(22),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(23),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(24),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(27),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(28),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(29),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(35), 

.acf-field-5cf2efd643031 .acf-input ul li:nth-child(36), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(37), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(38), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(39), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(40), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(41), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(42), 
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(43),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(44),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(45)
{
	margin-left: 60px !important;
}

.acf-field-5cf2efd643031 .acf-input ul li:nth-child(30),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(31),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(32),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(33)
/*.acf-field-5cf2efd643031 .acf-input ul li:nth-child(34)*/
{
    margin-left: 80px !important;
}


.acf-field-5cf2efd643031 .acf-input ul li:nth-child(42),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(43),
.acf-field-5cf2efd643031 .acf-input ul li:nth-child(44)
{
    margin-left: 0px!important!important;
    
}



</style>
