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
    <?php 
    if($_GET['edit']) {
        ?>
            <a class="back-button" href="?=return=return"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return</a> <br><br>
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