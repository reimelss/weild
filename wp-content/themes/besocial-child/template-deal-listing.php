 <?php
    /*
    Template Name: Deal Listing
    */
    ?>
<?php get_header();
    wp_reset_query();
    $args = array(
    	'posts_per_page'   => -1,
    	'include'          => '',
    	'exclude'          => '',
    	'meta_key'         => 'post_score',
    	'orderby'          => 'meta_value',
    	'order'            => 'DESC',
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
    
    $filters = [
      'Pre-Engagement',
      'Pre-Market',
      'Active',
      'Closed'
    ];

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
    $activeFilters = $filters;
    if($_POST['filter']) {
        $activeFilters = $_POST['filter'];
    }
?>

<div class="besclwp-post-content buddypress">
    <div class="container">
        <div class="row">
            <div class="col-md-12 post-content">
              <form method="post">
                <ul class="checkbox">
                  <input name="filter[]" type="hidden" value="">
                  <?php foreach($filters as $filter) {?>
                    <li class="post-checkbox">
                      <input name="filter[]" type="checkbox" value="<?=$filter?>"
                      onchange='if(this.value != 0) { this.form.submit(); }' <?=in_array($filter, $activeFilters) ? 'checked' : ''?> >
                      <span><?=$filter?></span>
                    </li>
                  <?php } ?>
                </ul>
                </form>
            </div>
        </div>
    </div>

    <div class="buddypress-holder" id="buddypress">
        <div id="members-dir-list" class="members dir-list">
            <div class="clear"></div>
            <?php
                $dealCount = 0;
                foreach($posts_array as $dealKey => $post) {
                    $meta = get_fields($post->ID);
                    $deal_status = $meta["deal_status"];
                    
                if ($meta["deal_status"] != "Canceled"  && empty(array_filter($activeFilters)) || array_intersect($activeFilters,  $deal_status)) {
                if ($meta["confidential_deal"]) { 
                  $dealCount++;
                  ?>
                      <div class="container-fluid">
                        <div class="row border mr-t-15">
                            <div class="col-lg-9 col-md-12 col-sm-12 mr-0">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 logo m-t-5">
                                        <div class="logo-img" style="background-image: url('/wp-content/uploads/confidential-deal.png')"></div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 col-12 agency-name m-t-5">
                                        <h3 class="text-secondary font-weight-bold">
                                            <?=$meta["code_name"]?>
                                        </h3>
                                        <p class="text-secondary">
                                            <?=$meta["confidential_description"]?>
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 manager mt-3">
                                        <p class="text-secondary font-weight-bold">Manager:
                                            <span class="font-weight-normal">
                                            <?php echo xprofile_get_field_data('1', $meta["manager"]["ID"]).' '.xprofile_get_field_data('1384', $meta["manager"]["ID"]); ?>
                                            </span>
                                        </p>
                                        <p class="text-secondary font-weight-bold">Location:
                                            <span class="font-weight-normal">
                                            <?=$meta["location"] ? implode(', ', $meta["location"]): '';?>
                                            </span>
                                        </p>
                                        <p class="text-secondary font-weight-bold">Deal Status:
                                            <span class="font-weight-normal">
                                            <?=$meta["deal_status"] ? implode(', ', $meta["deal_status"]) : '';?>
                                            </span>
                                        </p>
                                        <p class="text-secondary font-weight-bold">Deal Size:
                                            <span class="font-weight-normal">
                                            <?=$meta['deal_size']?>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 agency-detail mt-3">
                                        <div class="row m-b-10">
                                            <div class="col-lg-4">
                                                <p class="text-secondary font-weight-bold">Type of Transaction:</p>
                                            </div>
                                            <div class="col-lg-8">
                                                <p>
                                                    <span class="font-weight-normal">
                                                    <?=$meta["type_of_transaction"] ? implode(', ', $meta["type_of_transaction"]) : '';?>
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
                                                    <?=$meta["industry_sector"] ? implode(', ', $meta["industry_sector"]) : '';?>
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
                                                    <?=$meta["target_investor_type"] ? implode(', ', $meta["target_investor_type"]) : '';?>
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
        													<?php if(count($meta['what_are_you_seeking_assistance_with'])) { ?>
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
                                        href="<?=get_permalink(get_post_meta($post->ID,'forumn_id',true))?>">
                                    Join Deal Discussion
                                    </a>
                                    <button type="button" class="btn btn-primary btn-block font-weight-bold" data-toggle="collapse" data-target="#contact-deal-manager-list-<?=$dealKey?>">
                                    Contact Deal Manager
                                    </button>
                                    <ul class="list-group collapse text-secondary" id="contact-deal-manager-list-<?=$dealKey?>">
                                        <li class="list-group-item">
                                            <span class="font-weight-bold">Office:</span>
                                            <?php echo xprofile_get_field_data('788', $meta["manager"]["ID"]); ?>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="font-weight-bold">Mobile:</span>
                                            <?php echo xprofile_get_field_data('789', $meta["manager"]["ID"]); ?>
                                        </li>
                                        <li class="list-group-item">
        																	<span class="font-weight-bold">Email:</span>
        																	<?php echo xprofile_get_field_data('33', $meta["manager"]["ID"]); ?>
        																</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                if(!$meta["confidential_deal"]) {
                  $dealCount++;
                    ?>
										<div class="container-fluid">
				                <div class="row border mr-t-15">
				                    <div class="col-lg-9 col-md-12 col-sm-12 mr-0">
				                        <div class="row">
				                            <div class="col-lg-4 col-md-4 col-sm-12 logo m-t-5">
				                                <div class="logo-img" style="background-image: url(<?=$meta['logo']?>)"></div>
				                            </div>
				                            <div class="col-lg-8 col-md-8 col-sm-12 col-12 agency-name m-t-5">
				                                <h3 class="text-secondary font-weight-bold">
				                                    <?=$meta["deal_name"]?>
				                                </h3>
				                                <p class="text-secondary">
				                                    <?=$meta["brief_description_of_company"]?>
				                                </p>
				                            </div>
				                            <div class="col-lg-4 col-md-4 col-sm-12 manager mt-3">
				                                <p class="text-secondary font-weight-bold">Manager:
				                                    <span class="font-weight-normal">
				                                    <?php echo xprofile_get_field_data('1', $meta["manager"]["ID"]).' '.xprofile_get_field_data('1384', $meta["manager"]["ID"]); ?>
				                                    </span>
				                                </p>
				                                <p class="text-secondary font-weight-bold">Location:
				                                    <span class="font-weight-normal">
				                                    <?=$meta["location"] ? implode(', ', $meta["location"]) : '';?>
				                                    </span>
				                                </p>
				                                <p class="text-secondary font-weight-bold">Deal Status:
				                                    <span class="font-weight-normal">
				                                    <?=$meta["deal_status"] ? implode(', ', $meta["deal_status"]) : '';?>
				                                    </span>
				                                </p>
				                                <p class="text-secondary font-weight-bold">Deal Size:
				                                    <span class="font-weight-normal">
				                                    <?=$meta['deal_size']?>
				                                    </span>
				                                </p>
				                            </div>
				                            <div class="col-lg-8 col-md-8 col-sm-12 agency-detail mt-3">
				                                <div class="row m-b-10">
				                                    <div class="col-lg-4">
				                                        <p class="text-secondary font-weight-bold">Type of Transaction:</p>
				                                    </div>
				                                    <div class="col-lg-8">
				                                        <p>
				                                            <span class="font-weight-normal">
				                                            <?=$meta["type_of_transaction"] ? implode(', ', $meta["type_of_transaction"]) : '';?>
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
				                                            <?=$meta["industry_sector"] ? implode(', ', $meta["industry_sector"]) : '';?>
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
				                                            <?=$meta["target_investor_type"] ? implode(', ', $meta["target_investor_type"]) : '';?>
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
																	<?php if(count($meta['what_are_you_seeking_assistance_with'])) { ?>
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
				                                href="<?=get_permalink(get_post_meta($post->ID,'forumn_id',true))?>">
				                            Join Deal Discussion
				                            </a>
				                            <button type="button" class="btn btn-primary btn-block font-weight-bold" data-toggle="collapse" data-target="#contact-deal-manager-list-<?=$dealKey?>">
				                            Contact Deal Manager
				                            </button>
				                            <ul class="list-group collapse text-secondary" id="contact-deal-manager-list-<?=$dealKey?>">
				                                <li class="list-group-item">
				                                    <span class="font-weight-bold">Office:</span>
				                                    <?php echo xprofile_get_field_data('788', $meta["manager"]["ID"]); ?>
				                                </li>
				                                <li class="list-group-item">
				                                    <span class="font-weight-bold">Mobile:</span>
				                                    <?php echo xprofile_get_field_data('789', $meta["manager"]["ID"]); ?>
				                                </li>
				                                <li class="list-group-item">
																					<span class="font-weight-bold">Email:</span>
																					<?php echo xprofile_get_field_data('33', $meta["manager"]["ID"]); ?>
																				</li>
				                            </ul>
				                        </div>
				                    </div>
				                </div>
				            </div>
                <!-- #members-dir-list -->
                <?php
                    }
                }
              }
              if (!$dealCount) {
              ?>
              <h3 class="text-center font-weight-bold no-deal-found">
                No Deal Found!
              </h3>
            <?php } ?>
        </div>
    </div>
    <!-- member-cheader -->
</div>
<!-- member-info -->
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
    .checkbox input{
      width: 1em;
      height: 1em;
      margin-right: .4em;
    }
    li.post-checkbox {
      display: inline-block;
    }
    .post-checkbox {
      padding: 1.2em;
      padding-left: 0;
    }
    .post-checkbox span {
      font-size: 18px;
    }
    .post-content {
      margin-left: 0px;
    }
    .post-content {
        padding-left: 0px;
    }
    .no-deal-found {
      margin-top: 30px;
    }
    @media screen and (max-width: 767px) {
	    .logo-img {
	    	background-position: center;
	    }
      .post-checkbox {
          padding: .52em;
          width: 100%;
          padding-left: 13px
      }
      .container {
        padding-left: 0px;
        margin-left: 0px;
      }
    }
</style>
