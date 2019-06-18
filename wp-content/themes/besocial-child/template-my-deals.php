<?php	
/*
Template Name: My Deals
*/
?>
<?php 

if (!is_user_logged_in() ) {
    wp_redirect( site_url('/login/'));
}
acf_form_head();
get_header(); 
wp_reset_query();
$user_id = get_current_user_id();

$args = array(
	'posts_per_page'   => -1,
	// 'offset'           => 0,
	// 'cat'         => '',
	// 'category_name'    => '',
	'orderby'          => 'date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => 'deal',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'author'	       => $user_id,
	'author_name'	   => '',
	'post_status'      => 'any',
	'suppress_filters' => true,
	'fields'           => '',
);
$posts_array = get_posts( $args );

echo "<pre>";
// var_dump($posts_array);
echo "</pre>";


?>


<?php if(get_the_title()) { ?>
<div class="besclwp-page-title">
    <?php the_title('<h1>','</h1>'); ?>
    <?php if (!empty($besclwp_subtitle)) { ?>
    <p class="besclwp-subtitle"><?php echo stripslashes(esc_attr($besclwp_subtitle)); ?></p>
    <?php } ?>
</div>
<?php } ?>


<div class="besclwp-post-content buddypress">
<style>
    .acf-checkbox-list {
        list-style:none;
    }
</style>

    <?php 
    if($_GET['edit']) {
        ?>
            <a href="?=return=return">< Return</a> <br><br>
        <?php 
        acf_form(array(
            'post_id'		=> $_GET['edit'],
            'post_title'	=> false,
            'post_content'	=> false,
            'submit_value' => 'Update',
            'return' => '?=return=return' //Returns to the original post
        ));
            
        
    }else {

?>
        <script>
        jQuery(function($) {
            $(document).ready(function() {
                $(".full-line").click(function() {
                    $(".hide-this").toggle(300);
                });
            });
        })
        </script>

        <div class="buddypress-holder" id="buddypress">
            <div id="members-dir-list" class="members dir-list">
                <div id="pag-top" class="pagination">
                    <div class="pag-count" id="member-dir-count-top">
                        <!-- Viewing 1 - 20 of 38 active affiliates -->
                    </div>
                    <!-- <div class="pagination-links" id="member-dir-pag-top">
                        <span aria-current="page" class="page-numbers current">1</span>
                        <a class="page-numbers" href="?upage=2">2</a>
                        <a class="next page-numbers" href="?upage=2">→</a>
                    </div> -->
                </div>
                <div class="clear"></div>
                <?php 
                foreach($posts_array as $post) {
                    $meta = get_fields( $post->ID);
                    // var_dump($meta["deal_name"]); 
                    // echo "<pre>";
                    // var_dump($meta["manager"]["ID"]);
                    // // var_dump($post);
                    // echo "</pre>";
                    
                ?>
                
                <div id="besocial-members-list" aria-live="assertive" aria-relevant="all">
                    <div class="besocial-member-outer besclwp-not-featured">
                <?php echo "Status: " . $post->post_status ?>
                        <div class="besocial-member-inner">
                            <div class="besocial-member-avatar">
                                <a href="<?=$post->guid?>"><img
                                        src="<?=$meta["logo"]?>"
                                        class="avatar photo" width="100" height="100" ></a>
                            </div>
                            <div class="besocial-member">
                                <div class="besocial-member-title">
                                    <a href="<?=$post->guid?>"><?=$meta["deal_name"]?></a>
                                </div>
                                <div class="right_side hide-on-mobile">
                                    <div class="member-cheader">
                                        <a href="?edit=<?= $post->ID ?>">
                                            <strong class="dropbtn">Edit</strong>
                                        </a>
                                        <!-- <div class="sub-info" style="display: none;">
                                            <div class="member-cheader"> 
                                                <a href="tel:303-895-4475">
                                                    <b>
                                                        <i class="fa fa-mobile"></i>
                                                    </b>
                                                    <strong>Mobile:</strong> 303-895-4475
                                                </a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="weild_title">
                                <strong>Confidential Deal: </strong><?php if ($meta["confidential_deal"]) echo "Yes"; else echo "no";?> <br>
                                <?php
                                if($meta["confidential_deal"]) {
                                    ?>
                                    <strong>Confidential Description: </strong><?=$meta["confidential_description"]?> <br>
                                
                                <?php 
                                } 
                                ?>
                                    <strong>Code Name: </strong><?=$meta["code_name"]?> <br>
                                    <?php if($meta["document_uploads"]) {
                                        ?> 

                                        
                                        <strong>Document: </strong><?php 
                                        $count = 1; 
                                        foreach ($meta["document_uploads"] as $doc) {
                                            if ($count == 1) {
                                                echo "<a href='" . $doc["document"] ."'>" .$doc["title"]. " </a>";
                                            }else {
                                                echo ", <a href='" . $doc["document"] ."'>" .$doc["title"]. " </a>";
                                            }
                                            $count++;
                                        }
                                        
                                        ?> <br>

                                        <?php
                                    }
                                    ?>

                                    <strong>Deal Size: </strong><?=$meta["deal_size"]?> <br>
                                    <strong>Deal Status: </strong><?=$meta["deal_status"]?>
                                </div>
                                <div class="right_side hide-on-desktop">
                                    <div class="member-cheader"><strong class="dropbtn">Contact</strong>
                                        <!-- <div class="sub-info" style="display: none;">
                                            <div class="member-cheader"> 
                                                <a href="tel:303-895-4475">
                                                    <b>
                                                        <i class="fa fa-mobile"></i>
                                                    </b>
                                                    <strong>Mobile:</strong> 303-895-4475
                                                </a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="bio">
                                    <?=$meta["brief_description_of_company"]?>
                                </div>
                                <div id="member-info">
                                    <div class="member-cheader"><strong>View Details </strong>
                                        <div class="sub-info" style="display: none;">

                                            <div class="member-cheader"><strong>Manager </strong>
                                                <div class="sub-info" style="display: none;">
                                                    <ul class="product-expertise">
                                                        <li class="unlicensed"
                                                            style="margin-left: 20px; font-weight: 400; font-size: 17px;">
                                                            <?php echo xprofile_get_field_data('1', $meta["manager"]["ID"]).' '.xprofile_get_field_data('1384', $meta["manager"]["ID"]); ?>
                                                            </li>
                                                        <ul> </ul>
                                                    </ul>
                                                </div> <!-- sub-info -->
                                            </div> <!-- member-cheader -->
                                            <div class="member-cheader"><strong>Type of Transaction </strong>
                                                <div class="sub-info" style="display: none;">
                                                    <ul class="product-expertise">
                                                    <?php 
                                                        foreach($meta["type_of_transaction"] as $value ){

                                                        
                                                    ?>
                                                        <li class="unlicensed"
                                                            style="margin-left: 20px; font-weight: 400; font-size: 17px;">
                                                            <?=$value?>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                        <ul> </ul>
                                                    </ul>
                                                </div> <!-- sub-info -->
                                            </div> <!-- member-cheader -->

                                            <div class="member-cheader"><strong>Industry Sector </strong>
                                                <div class="sub-info" style="display: none;">
                                                    <ul class="product-expertise">

                                                        <?php 
                                                            foreach($meta["industry_sector"] as $value ){

                                                            
                                                        ?>
                                                        <li class="unlicensed"
                                                            style="margin-left: 20px; font-weight: 400; font-size: 17px;">
                                                            <?=$value?>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>

                                                    </ul>
                                                </div> <!-- sub-info -->
                                            </div> <!-- member-cheader -->

                                            <div class="member-cheader"><strong>Location </strong>
                                                <div class="sub-info" style="display: none;">
                                                    <ul class="product-expertise">


                                                        <?php 
                                                            foreach($meta["location"] as $value ){

                                                            
                                                        ?>
                                                        <li class="unlicensed"
                                                            style="margin-left: 20px; font-weight: 400; font-size: 17px;">
                                                            <?=$value?>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                        <ul> </ul>
                                                    </ul>
                                                </div> <!-- sub-info -->
                                            </div> <!-- member-cheader -->
                                            
                                            <div class="member-cheader"><strong>Target Investor Type </strong>
                                                <div class="sub-info" style="display: none;">
                                                    <ul class="product-expertise">

                                                    <?php foreach($meta['target_investor_type'] as $single) {

                                                    ?>
                                                        <li class="unlicensed"
                                                            style="margin-left: 20px; font-weight: 400; font-size: 17px;">
                                                            <?=$single?></li>
                                                            <?php 
                                                    }
                                                    ?>
                                                        <ul> </ul>
                                                    </ul>
                                                </div> <!-- sub-info -->
                                            </div> <!-- member-cheader -->

                                            <div class="member-cheader"><strong>What are you seeking assistance with </strong>
                                                <div class="sub-info" style="display: none;">
                                                    <ul class="product-expertise">

                                                    <?php foreach($meta['what_are_you_seeking_assistance_with'] as $single) {

                                                    ?>
                                                        <li class="unlicensed"
                                                            style="margin-left: 20px; font-weight: 400; font-size: 17px;">
                                                            <?=$single?></li>
                                                            <?php 
                                                    }
                                                    ?>
                                                        <ul> </ul>
                                                    </ul>
                                                </div> <!-- sub-info -->
                                            </div> <!-- member-cheader -->

                                        </div> <!-- sub-info -->
                                    </div> <!-- member-cheader -->
                                </div> <!-- member-info -->
                            </div>
                        </div>
                    </div>
                    <!-- <div id="pag-bottom" class="pagination">
                        <div class="pag-count" id="member-dir-count-bottom">
                            Viewing 1 - 20 of 38 active affiliates
                        </div>
                        <div class="pagination-links" id="member-dir-pag-bottom">
                            <span aria-current="page" class="page-numbers current">1</span>
                            <a class="page-numbers" href="?upage=2">2</a>
                            <a class="next page-numbers" href="?upage=2">→</a>
                        </div>
                    </div> -->
                </div><!-- #members-dir-list -->
                <?php 
                }
                ?>
            </div>
    <?php 
    } ?>





    </div> <!-- member-cheader -->
</div> <!-- member-info -->




<?php the_content(); ?>
<?php wp_link_pages( array(
	'before'      => '<div class="besclwp-page-links">' . esc_html__( 'Pages:', 'besocial' ),
	'after'       => '</div>',
    'link_before' => '<span>',
	'link_after'  => '</span>'
	) );
?>
<div class="clear"></div>


<?php get_footer(); 

wp_enqueue_script( 'myscript', get_stylesheet_directory_uri() . '/js/script_create_deal.js', array( 'jquery' ), '1.0.2', true);

?>


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
