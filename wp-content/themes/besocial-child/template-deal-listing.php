<?php	
/*
Template Name: Deal Listing
*/
?>
<?php get_header(); 
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
	'author_name'	   => '',
	'post_status'      => 'publish',
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

<?php 
// var_dump($_POST);
if(!$_POST['filter']) {
    $filter = "Active";
}else{ 
    $filter = $_POST['filter'];
}
?>

<div class="besclwp-post-content buddypress">
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <form method="post">
                <select name='filter' onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option value='Pre-Engagement' <?php if($filter == 'Pre-Engagement') echo "selected" ?>>Pre-Engagement</option>
                    <option value='Pre-Market' <?php if($filter == 'Pre-Market') echo "selected" ?>>Pre-Market</option>
                    <option value='Active' <?php if($filter == 'Active') echo "selected" ?>>Active</option>
                    <option value='Closed' <?php if($filter == 'Closed') echo "selected" ?>>Closed</option>
                </select>
            </form>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>

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
                // var_dump($meta);
                // echo "</pre>";
                if ($meta["confidential_deal"] && $meta["deal_status"] != "Canceled"  && $meta["deal_status"] == $filter ) {

                    ?>
                    <div id="besocial-members-list" aria-live="assertive" aria-relevant="all">
                        <div class="besocial-member-outer besclwp-not-featured">
                            <div class="besocial-member-inner">
                                <div class="besocial-member-avatar">
                                    <a href="#
                                    <?php // $post->guid 
                                    ?>">Confidential Deal <br> </a>
                                </div>
                                <div class="besocial-member">

                                    <div class="right_side hide-on-mobile">
                                    <?php 

                                        $form_id = get_post_meta($post->ID,'forumn_id',true);
                                    ?>
                                        
                                        <div class="member-cheader">
                                        
                                        <a href="<?=get_permalink($form_id)?>">
                                        <strong class="dropbtn">
                                        Contact
                                        </strong>
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
                                        <strong>Code Name: </strong><?=$meta["code_name"]?> <br>]
                                        <?php if($meta["document_uploads"]) {
                                            ?> 

                                        <strong>Document: </strong><a target="_blank" href="<?=$meta["document_uploads"]?>">Click here</a> <br>
                                            <?php
                                        }
                                        ?>
                                        <strong>Deal Size: </strong><?=$meta["deal_size"]?> <br>
                                        <strong>Deal Status: </strong><?=$meta["deal_status"]?>
                                    </div>
                                    <div class="right_side hide-on-desktop">
                                    <?php 

                                    $form_id = get_post_meta($post->ID,'forumn_id',true);
                                    ?>
                                        <div class="member-cheader">
                                        
                                        <a href="<?=get_permalink($form_id)?>">
                                        <strong class="dropbtn">
                                        Contact
                                        </strong>
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
                                    <div class="bio">
                                        <?=$meta["confidential_description"]?>
                                    </div>
                                    <div id="member-info">
                                        <div class="member-cheader"><strong>View Details </strong>
                                            <div class="sub-info" style="display: none;">

                                                <div class="member-cheader"><strong>Manager </strong>
                                                    <div class="sub-info" style="display: none;">
                                                        <ul class="product-expertise">
                                                            <li class="unlicensed"
                                                                style="margin-left: 20px; font-weight: 400; font-size: 17px;">
                                                                <?=$meta["manager"]?></li>
                                                            <ul> </ul>
                                                        </ul>
                                                    </div> <!-- sub-info -->
                                                </div> <!-- member-cheader -->
                                                
                                                <div class="member-cheader"><strong>Type of Transaction </strong>
                                                    <div class="sub-info" style="display: none;">
                                                        <ul class="product-expertise">
                                                            <li class="unlicensed"
                                                                style="margin-left: 20px; font-weight: 400; font-size: 17px;">
                                                                <?=$meta["type_of_transaction"]?></li>
                                                            <ul> </ul>
                                                        </ul>
                                                    </div> <!-- sub-info -->
                                                </div> <!-- member-cheader -->

                                                <div class="member-cheader"><strong>Industry Sector </strong>
                                                    <div class="sub-info" style="display: none;">
                                                        <ul class="product-expertise">
                                                            <li class="unlicensed"
                                                                style="margin-left: 20px; font-weight: 400; font-size: 17px;">
                                                                <?=$meta["industry_sector"]?></li>
                                                            <ul> </ul>
                                                        </ul>
                                                    </div> <!-- sub-info -->
                                                </div> <!-- member-cheader -->

                                                <div class="member-cheader"><strong>Location </strong>
                                                    <div class="sub-info" style="display: none;">
                                                        <ul class="product-expertise">
                                                            <li class="unlicensed"
                                                                style="margin-left: 20px; font-weight: 400; font-size: 17px;">
                                                                <?=$meta["location"]?></li>
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
                if(!$meta["confidential_deal"] && $meta["deal_status"] != "Canceled"  && $meta["deal_status"] == $filter ) {
                    ?>

                    <div id="besocial-members-list" aria-live="assertive" aria-relevant="all">
                        <div class="besocial-member-outer besclwp-not-featured">
                            <div class="besocial-member-inner">
                                <div class="besocial-member-avatar">
                                    <a href="#
                                    <?php //$post->guid?>
                                    "><img
                                            src="<?=$meta["logo"]?>"
                                            class="avatar user-39-avatar avatar-100 photo" width="100" height="100"
                                            alt="Profile picture of David"></a>
                                </div>
                                <div class="besocial-member">
                                    <div class="besocial-member-title">
                                        <a href="#<?php
                                        //$post->guid
                                        ?>"><?=$meta["deal_name"]?></a>
                                    </div>
                                    <div class="right_side hide-on-mobile">
                                        <?php 

                                        $form_id = get_post_meta($post->ID,'forumn_id',true);
                                        
                                        ?>

                                        <div class="member-cheader">
                                        <a href="<?=get_permalink($form_id)?>">
                                        <strong class="dropbtn">
                                        Contact
                                        </strong>
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
                                   
                                    <?php if($meta["document_uploads"]) {
                                            ?> 

                                        <strong>Document: </strong><a target="_blank" href="<?=$meta["document_uploads"]?>">Click here</a> <br>
                                            <?php
                                        }
                                        ?>
                                        <strong>Deal Size: </strong><?=$meta["deal_size"]?> <br>
                                        <strong>Deal Status: </strong><?=$meta["deal_status"]?>
                                    </div>
                                    <div class="right_side hide-on-desktop">
                                        <div class="member-cheader">
                                        <a href="<?=get_permalink($form_id)?>">
                                        <strong class="dropbtn">
                                        Contact
                                        </strong>
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
                                                                <?=$meta["manager"]?></li>
                                                            <ul> </ul>
                                                        </ul>
                                                    </div> <!-- sub-info -->
                                                </div> <!-- member-cheader -->
                                                
                                                <div class="member-cheader"><strong>Type of Transaction </strong>
                                                    <div class="sub-info" style="display: none;">
                                                        <ul class="product-expertise">
                                                            <li class="unlicensed"
                                                                style="margin-left: 20px; font-weight: 400; font-size: 17px;">
                                                                <?=$meta["type_of_transaction"]?></li>
                                                            <ul> </ul>
                                                        </ul>
                                                    </div> <!-- sub-info -->
                                                </div> <!-- member-cheader -->

                                                <div class="member-cheader"><strong>Industry Sector </strong>
                                                    <div class="sub-info" style="display: none;">
                                                        <ul class="product-expertise">
                                                            <li class="unlicensed"
                                                                style="margin-left: 20px; font-weight: 400; font-size: 17px;">
                                                                <?=$meta["industry_sector"]?></li>
                                                            <ul> </ul>
                                                        </ul>
                                                    </div> <!-- sub-info -->
                                                </div> <!-- member-cheader -->

                                                <div class="member-cheader"><strong>Location </strong>
                                                    <div class="sub-info" style="display: none;">
                                                        <ul class="product-expertise">
                                                            <li class="unlicensed"
                                                                style="margin-left: 20px; font-weight: 400; font-size: 17px;">
                                                                <?=$meta["location"]?></li>
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
            }
            ?>
        </div>





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


<?php get_footer(); ?>