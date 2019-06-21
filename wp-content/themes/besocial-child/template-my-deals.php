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
    <?php 
    if($_GET['edit']) {
        ?>
        <a class="back-button" href="?=return=return">
          <i class="fa fa-arrow-left" aria-hidden="true"></i> Return
        </a> <br><br>
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
                    </div>
                </div>
                <div class="clear"></div>
                <?php 
                foreach($posts_array as $post) {
                    $meta = get_fields( $post->ID);
                ?>
                
                <div class="container-fluid">
                    <div class="row border mr-t-15">
                        <div class="col-lg-9 col-md-12 col-sm-12 mr-0">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 logo m-t-5">
                                    <?php $image = $meta["logo"] ? $meta["logo"] : '/wp-content/uploads/confidential-deal.png' ?>
                                    <div class="logo-img" style="background-image: url(<?=$image?>)"></div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 col-12 agency-name m-t-5">
                                    <h3 class="text-secondary font-weight-bold">
                                        <a href="<?=$post->guid?>"><?=$meta["deal_name"]?></a>
                                    </h3>
                                    <p class="text-secondary">
                                        <?=$meta["brief_description_of_company"]?>
                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 manager mt-3">
                                    <p class="text-secondary font-weight-bold">Status:
                                      <span class="font-weight-normal">
                                        <?=$post->post_status ?>
                                      </span>
                                    </p>
                                    <p class="text-secondary font-weight-bold">Manager:
                                      <span class="font-weight-normal">
                                        <?php echo xprofile_get_field_data('1', $meta["manager"]["ID"]).' '.xprofile_get_field_data('1384', $meta["manager"]["ID"]); ?>														
                                      </span>
                                    </p>
                                    <p class="text-secondary font-weight-bold">Location:
                                      <span class="font-weight-normal">
                                        <?=$meta["location"] ? implode(', ', $meta["location"]) : ''?>
                                      </span>
                                    </p>
                                    <p class="text-secondary font-weight-bold">Confidential Deal:
                                        <span class="font-weight-normal">
                                          <?=($meta["confidential_deal"]) ? "Yes" : "No";?>
                                        </span>
                                    </p>
                                    <?php
                                      if($meta["confidential_deal"]) {
                                    ?>
                                    <p class="text-secondary font-weight-bold">Confidential Description:
                                        <span class="font-weight-normal">
                                          <?=$meta["confidential_description"]?>
                                        </span>
                                    </p>                                    
                                    <?php 
                                      } 
                                    ?>
                                    <p class="text-secondary font-weight-bold">Code Name:
                                        <span class="font-weight-normal">
                                          <?=$meta["code_name"]?>
                                        </span>
                                    </p>
                                    <p class="text-secondary font-weight-bold">Deal Size:
                                        <span class="font-weight-normal">
                                        <?=$meta['deal_size']?>
                                        </span>
                                    </p>
                                    <p class="text-secondary font-weight-bold">Deal Status:
                                        <span class="font-weight-normal">
                                        <?=$meta["deal_status"];?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 agency-detail mt-3">
                                  <?php if($meta["confidential_description"]) {?>
                                  <div class="row m-b-10">
                                      <div class="col-lg-4">
                                          <p class="text-secondary font-weight-bold">Confidential Description:</p>
                                      </div>
                                      <div class="col-lg-8">
                                          <p>
                                              <span class="font-weight-normal">
                                              <?=$meta["confidential_description"]?>
                                              </span>
                                          </p>
                                      </div>
                                  </div>
                                  <?php } ?>
                                    <div class="row m-b-10">
                                        <div class="col-lg-4">
                                            <p class="text-secondary font-weight-bold">Type of Transaction:</p>
                                        </div>
                                        <div class="col-lg-8">
                                            <p>
                                                <span class="font-weight-normal">
                                                <?=($meta["type_of_transaction"]) ? implode(', ', $meta["type_of_transaction"]) : '';?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row m-b-10">
                                        <div class="col-lg-4">
                                            <p class="text-secondary font-weight-bold">Industry Sector:</p>
                                        </div>
                                        <div class="col-lg-8">
                                            <p>
                                                <span class="font-weight-normal">
                                                  <?=($meta["industry_sector"]) ? implode(', ', $meta["industry_sector"]) : '';?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row m-b-10">
                                        <div class="col-lg-4">
                                            <p class="text-secondary font-weight-bold">Target Investor Type:</p>
                                        </div>
                                        <div class="col-lg-8">
                                            <p>
                                                <span class="font-weight-normal">
                                                  <?=($meta["target_investor_type"]) ? implode(', ', $meta["target_investor_type"]) : '';?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <?php if($meta["document_uploads"]) { ?>
                                    <div class="row m-b-10">
                                        <div class="col-lg-4">
                                            <p class="text-secondary font-weight-bold">Documents:</p>
                                        </div>
                                        <div class="col-lg-8">
                                            <p>
                                                <span class="font-weight-normal">
                                                  <?php 
                                                  $count = 1; 
                                                  foreach ($meta["document_uploads"] as $doc) {
                                                      if ($count == 1) {
                                                          echo "<a href='" . $doc["document"] ."'>" .$doc["title"]. " </a>";
                                                      }else {
                                                          echo ", <a href='" . $doc["document"] ."'>" .$doc["title"]. " </a>";
                                                      }
                                                      $count++;
                                                  }
                                                  ?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                  <?php }?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 bg-secondary text-white mr-0 p-b-15">
                            <div class="text-center mr-t-15">
                              <?php if($meta['what_are_you_seeking_assistance_with'] && count($meta['what_are_you_seeking_assistance_with'])) { ?>
                                <div class="seeking-assistance">
                                    <i class="fa fa-search fa-flip-horizontal fa-4x" aria-hidden="true"></i>
                                    <h5 class="font-weight-bold">Seeking Assistance With</h5>
                                    <ul class="pl-4">
                                        <?php 
                                            foreach ($meta['what_are_you_seeking_assistance_with'] as $key => $seeking) {												
                                            ?>
                                        <li class="font-weight-bold"><?=$seeking?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                              <?php } ?>
                                <a class="btn btn-primary btn-block font-weight-bold"
                                    href="?edit=<?= $post->ID ?>">
                                    <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit Deal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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
    .besclwp-post-content ul, .besclwp-post-content ol {
    		margin: 0px;
    }
    .besclwp-post-content ul li, .besclwp-post-content ol li {
    		margin: 1px 0px;
    }
    .p-10 {
    		padding: 10px;
    }
    .m-t-5 {
    		margin-top:5px;
    }
    .mr-0 {
    	margin:0;
    }
    .mr-t-15{
    	margin-top:15px;
    }
    .list-group-item {
    	word-wrap: break-word;
    }
    .logo-img {
	    height: 120px;
	    width: 100%;
	    background-size: contain;
	    background-repeat: no-repeat;
    }
    .bg-secondary {
    		background-color: #686262 !important;
    }
		.bg-secondary .btn-primary.btn-block {
			background: #3396E1 !important;
    	border-color: #3396E1 !important;
		}
		.bg-secondary .btn-primary:focus {
    	box-shadow: none;
		}
    .seeking-assistance {
    		margin-bottom: 20px;
    }
    .seeking-assistance h5 {
    		color: #fff;
				margin-top: 15px;
				font-size: 27px;
    }
    .p-b-15{
    		padding-bottom: 15px;
    }
    .m-b-10{
    		margin-bottom: 10px;
    }
		p.text-secondary.font-weight-bold {
			margin-bottom: 10px;
		}
    .acf-checkbox-list {
        list-style:none;
    }
    .back-button, .back-button:hover {
      background: #000000;
      color: #fff;
      padding: 10px 20px;
      font-weight: bold;
    }
    @media screen and (max-width: 767px) {
	    .logo-img {
	    	background-position: center;
	    }
    }
</style>