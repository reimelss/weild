<?php
/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the display of the members loop.
 *
 * @since 1.2.0
 */

do_action( 'bp_before_members_loop' ); ?>


<?php the_widget( 'cs-8' ); ?>
<?php $besclwp_default_cover = get_option('besclwp_buddypress_profile_cover'); ?>
<?php $besclwp_user_preview = get_option('besclwp_user_preview'); ?>
<?php $besclwp_cover_check = bp_get_option( 'bp-disable-cover-image-uploads' ); ?>
<?php $besclwp_user_preview_bio = get_option('besclwp_user_preview_bio'); ?>

<?php if ( bp_get_current_member_type() ) : ?>
	<p class="current-member-type"><?php bp_current_member_type_message() ?></p>
<?php endif; ?>
<?php
// if ( bp_ajax_querystring( 'members' ) ==""){
// $queryString = "type=alphabetical&action=alphabetical&page=1";}
// else {$queryString = bp_ajax_querystring( 'members' );}
?>

<script>
    
    
</script>
<?php if ( bp_has_members(  bp_ajax_querystring( 'members' ) )  ) : ?>

	<div id="pag-top" class="pagination">

		<div class="pag-count" id="member-dir-count-top">

			<?php echo bp_get_members_pagination_countss(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-top">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>
    <div class="clear"></div>



	<?php

	/**
	 * Fires before the display of the members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_members_list' ); ?>

	<div id="besocial-members-list" aria-live="assertive" aria-relevant="all">

	<?php while ( bp_members() ) : bp_the_member(); ?>
    <?php $besclwp_member_id = bp_get_member_user_id(); ?>    
    <?php
        $hidden_fields = bp_xprofile_get_hidden_fields_for_user($besclwp_member_id, bp_loggedin_user_id());
        $field_id = esc_html(get_option('besclwp_profile_field_id'));
        if ((!in_array($field_id, $hidden_fields)) && (!empty($field_id))) {
            $besclwp_user_bio = bp_get_profile_field_data( 'field=' . $field_id . '&user_id=' . $besclwp_member_id );
        }
        else {
            $besclwp_user_bio = '';
        }
    ?>
    <?php $besclwp_member_full_avatar = bp_core_fetch_avatar( array( 'item_id' => $besclwp_member_id, 'html' => false, 'type' => 'full' ) ); ?>
    <?php $besclwp_cover_image_url = bp_attachments_get_attachment( 'url', array( 'item_id' => $besclwp_member_id, 'type' => 'cover-image' ) ); ?>
    <?php 
        if (( empty($besclwp_cover_image_url) ) || ( $besclwp_cover_check )) {
            if ( empty($besclwp_default_cover) ) {
                $besclwp_cover_image_url = get_template_directory_uri() . "/images/buddypress-default-cover.png";
            }
            else {
                $besclwp_cover_image_url = $besclwp_default_cover;
            }
        }
    ?>    
        <div class="besocial-member-outer <?php besclwp_featured_check($besclwp_member_id); ?>">
		<div class="besocial-member-inner">
            <?php if (($besclwp_user_preview != 'true') && (bp_is_active( 'friends' ))) { ?>
            <div class="besocial-member-avatar besocial-img-tooltip" data-thumb="<?php echo esc_url($besclwp_member_full_avatar); ?>" data-cover="<?php echo esc_url($besclwp_cover_image_url); ?>" data-membername="<?php bp_member_name(); ?>" data-since="<?php besclwp_get_preview_since($besclwp_member_id); ?>" data-count="<?php echo bp_get_total_friend_count($besclwp_member_id); ?> <?php esc_html_e( 'friends', 'besocial'); ?>" data-featured="<?php besclwp_featured_check($besclwp_member_id); ?>" data-bio="<?php echo wp_trim_words( $besclwp_user_bio, $besclwp_user_preview_bio, '' ); ?>"> 
            <?php } else { ?>
            <div class="besocial-member-avatar">
            <?php } ?>    
				<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar(); ?></a> 
			</div>

			<div class="besocial-member">
				<div class="besocial-member-title">
					<a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>
				</div>
				<?php
				$wo_email = xprofile_get_field_data('33', bp_get_member_user_id());
				$wp_office = xprofile_get_field_data('788', bp_get_member_user_id());
				$wp_mobile = xprofile_get_field_data('789', bp_get_member_user_id());
				
				?>
				
			  
			  	<div class="right_side hide-on-mobile">
					<div class='member-cheader'><strong class="dropbtn"><?php echo esc_html("Contact Affiliate", 'besocial'); ?></strong>
						<div class="sub-info" >
							<div class='member-cheader'><?php if( $wp_office != false ) ?>
								<a href="tel:<?php echo strip_tags($wp_office); ?>"><b><i class="fa fa-phone"></i></b><strong>Office:</strong> <?php echo strip_tags($wp_office); ?></a>
							</div>
						</div>
						<div class="sub-info" >
							<div class='member-cheader'><?php if( $wp_mobile != false ) ?>
								<a href="tel:<?php echo strip_tags($wp_mobile); ?>"><b><i class="fa fa-mobile"></i></b><strong>Mobile:</strong> <?php echo strip_tags($wp_mobile); ?></a>
							</div>
						</div>
						<div class="sub-info" >
							<div class='member-cheader'><?php if( $wo_email != false ) ?>
								<a href="mailto:<?php echo strip_tags($wo_email); ?>"><b><i class="fa fa-envelope"></i></b> <?php echo strip_tags($wo_email); ?></a></>
							</div>
						</div>
						<div class="sub-info" >
							<div class='member-cheader'><?php echo do_shortcode('[hcardvcards title="" display_vcard=true]'); ?>
							</div>
						</div>
						
					</div>
				</div>

				

				<div class="besocial-member-meta"><i class="fa fa-clock-o"></i> <span class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_member_last_active( array( 'relative' => false ) ) ); ?>"><?php bp_member_last_active(); ?></span></div>

				<?php

				/**
				 * Fires inside the display of a directory member item.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_directory_members_item' ); ?>

				<?php
				 /***
				  * If you want to show specific profile fields here you can,
				  * but it'll add an extra query for each member in the loop
				  * (only one regardless of the number of fields you show):
				  *
				  * bp_member_profile_data( 'field=the field name' );
				  */
				 
				 //$xfield_name = xprofile_get_field('30', bp_get_member_user_id())->name;
				$xfield_data = xprofile_get_field_data('30', bp_get_member_user_id());
				$xfield_data2 = xprofile_get_field_data('31', bp_get_member_user_id());
				$xfield_data3 = xprofile_get_field_data('404', bp_get_member_user_id());
				$xfield_data4 = xprofile_get_field_data('298', bp_get_member_user_id());
				$xfield_data5 = xprofile_get_field_data('184', bp_get_member_user_id());
				$xfield_data6 = xprofile_get_field_data('59', bp_get_member_user_id());
				$xfield_data7 = xprofile_get_field_data('41', bp_get_member_user_id());
				$xfield_data7other = xprofile_get_field_data('3203', bp_get_member_user_id());
				
				
				$xfield_data8 = xprofile_get_field_data('79', bp_get_member_user_id());
				$xfield_data8B = xprofile_get_field_data('2157', bp_get_member_user_id());
				$xfield_data9 = xprofile_get_field_data('405', bp_get_member_user_id());
				$xfield_data10 = xprofile_get_field_data('297', bp_get_member_user_id());
				$xfield_data11 = xprofile_get_field_data('1452', bp_get_member_user_id());
				$wo_email = xprofile_get_field_data('33', bp_get_member_user_id());
				$wp_mobile = xprofile_get_field_data('789', bp_get_member_user_id());
				

				 if( $xfield_data != false )
      				echo '<div class="weild_title"><strong>'.esc_html("Title: ", 'besocial').'</strong>'.$xfield_data.'</div>';
				if( $xfield_data2 != false )
					  echo '<div class="org_name"><strong>'.esc_html("Organization: ", 'besocial').'</strong>'.$xfield_data2.'</div>';
					  ?>
  			  	<div class="right_side hide-on-desktop">
					<div class='member-cheader'><strong class="dropbtn"><?php echo esc_html("Contact Affiliate", 'besocial'); ?></strong>
						<div class="sub-info" >
							<div class='member-cheader'><?php if( $wp_office != false ) ?>
								<a href="tel:<?php echo strip_tags($wp_office); ?>"><b><i class="fa fa-phone"></i></b><strong>Office:</strong> <?php echo strip_tags($wp_office); ?></a>
							</div>
						</div>
						<div class="sub-info" >
							<div class='member-cheader'><?php if( $wp_mobile != false ) ?>
								<a href="tel:<?php echo strip_tags($wp_mobile); ?>"><b><i class="fa fa-mobile"></i></b><strong>Mobile:</strong> <?php echo strip_tags($wp_mobile); ?></a>
							</div>
						</div>
						<div class="sub-info" >
							<div class='member-cheader'><?php if( $wo_email != false ) ?>
								<a href="mailto:<?php echo strip_tags($wo_email); ?>"><b><i class="fa fa-envelope"></i></b> <?php echo strip_tags($wo_email); ?></a></>
							</div>
						</div>
						<div class="sub-info" >
							<div class='member-cheader'><?php echo do_shortcode('[hcardvcards title="" display_vcard=true]'); ?>
							</div>
						</div>
						
					</div>
				</div>

					  <?php
				if( $xfield_data3 != false )
      				echo '<div class="bio">'.$xfield_data3.'</div>';
				?>

				<div id="member-info">
				<?php // print_r(bp_get_member_user_id()); ?>
					<div class='member-cheader'><strong><?php echo esc_html("View Details ", 'besocial'); ?></strong>
						
						<?php if( $xfield_data4 != false ){ ?>
						<div class="sub-info" >
							<div class='member-cheader'><strong><?php echo esc_html("Industry Expertise (GICS Sector & Industry)", 'besocial'); ?></strong>
								<div class="sub-info">
									<?php
									echo '<ul class="industry-expertise">';
									foreach ($xfield_data4 as $mem_list) {
										$wp_checkbox_value = preg_replace("/[^a-zA-Z]/", '', strtolower($mem_list));
										echo '<li class='.$wp_checkbox_value.'>'.$mem_list.'</li>';
									}
									echo "<ul>";
									?>
								</div> <!-- sub-info -->
							</div> <!-- member-cheader -->
						</div> <!-- sub-info -->
						<?php } ?>

						<?php if( $xfield_data5 != false ){ ?>
						<div class="sub-info" >
							<div class='member-cheader'><strong><?php echo esc_html("Geographical / Regional Expertise", 'besocial'); ?></strong>
								<div class="sub-info">
									<?php
									echo "<ul>";
									foreach ($xfield_data5 as $mem_list) {
										$wp_checkbox_value = preg_replace("/[^a-zA-Z]/", '', strtolower($mem_list));
										echo '<li class='.$wp_checkbox_value.'>'.$mem_list.'</li>';
									}
									echo "<ul>";
									?>
								</div> <!-- sub-info -->
							</div> <!-- member-cheader -->
						</div> <!-- sub-info -->
						<?php } ?>

						<?php if( $xfield_data6 != false ){ ?>
						<div class="sub-info" >
							<div class='member-cheader'><strong><?php echo esc_html("Deal Management & Administration", 'besocial'); ?></strong>
								<div class="sub-info">
									<?php
									echo "<ul>";
									foreach ($xfield_data6 as $mem_list) {
										$wp_checkbox_value = preg_replace("/[^a-zA-Z]/", '', strtolower($mem_list));
										echo '<li class='.$wp_checkbox_value.'>'.$mem_list.'</li>';
									}
									echo "<ul>";
									?>
								</div> <!-- sub-info -->
							</div> <!-- member-cheader -->
						</div> <!-- sub-info -->
						<?php } ?>

						<?php if( $xfield_data7 != false ){ ?>
						<div class="sub-info" >
							<div class='member-cheader'><strong><?php echo esc_html("Languages", 'besocial'); ?></strong>
							
								<div class="sub-info">
									<?php
									echo "<ul>";
									foreach ($xfield_data7 as $mem_list) {
										$wp_checkbox_value = preg_replace("/[^a-zA-Z]/", '', strtolower($mem_list));
										echo '<li class='.$wp_checkbox_value.'>'.$mem_list.'</li>';
									}
									if ($xfield_data7other != false) {
				                    $xfield_data7other = explode(',', $xfield_data7other);
				                        foreach( $xfield_data7other as $lang ) {
										    $wp_checkbox_value = preg_replace("/[^a-zA-Z]/", '', strtolower($lang));
										    echo '<li class='.$wp_checkbox_value.'>'.$lang.'</li>';
    				                    }
									}

									echo "<ul>";
									?>
								</div> <!-- sub-info -->
							</div> <!-- member-cheader -->
						</div> <!-- sub-info -->
						<?php } ?>

						<?php if( $xfield_data8 != false ){ ?>
						<div class="sub-info" >
							<div class='member-cheader'><strong><?php echo esc_html("Product Expertise", 'besocial'); ?></strong>
								<div class="sub-info">
									<?php
									echo "<ul class='product-expertise'>";
									foreach ($xfield_data8 as $mem_list) {
										$wp_checkbox_value = preg_replace("/[^a-zA-Z]/", '', strtolower($mem_list));
										echo '<li class='.$wp_checkbox_value.'>'.$mem_list.'</li>';
									}
									
									if ($xfield_data8B != false) {
				                    $xfield_data8B = explode(',', $xfield_data8B);
				                        foreach( $xfield_data8B as $lang ) {
										    $wp_checkbox_value = preg_replace("/[^a-zA-Z]/", '', strtolower($lang));
										    echo '<li class= "m00 '.$wp_checkbox_value.'">'.$lang.'</li>';
    				                    }
									}


									echo "<ul>";
									?>
								</div> <!-- sub-info -->								
							</div> <!-- member-cheader -->
						</div> <!-- sub-info -->
						<?php } ?>
						<?php if( $xfield_data11 != false ){ ?>
						<div class="sub-info" >
							<div class='member-cheader'><strong><?php echo esc_html("Licenses ", 'besocial'); ?></strong>
								<div class="sub-info">
									<?php
									echo "<ul class='product-expertise'>";
									foreach ($xfield_data11 as $mem_list) {
										$wp_checkbox_value = preg_replace("/[^a-zA-Z]/", '', strtolower($mem_list));
										echo '<li class='.$wp_checkbox_value.'>'.$mem_list.'</li>';
									}
									echo "<ul>";
									?>
								</div> <!-- sub-info -->
							</div> <!-- member-cheader -->
						</div> <!-- sub-info -->
						<?php } ?>






					</div> <!-- member-cheader -->
				</div> <!-- member-info -->
				


			</div>

			<!-- <div class="besocial-member-action">

				<?php

				/**
				 * Fires inside the members action HTML markup to display actions.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_directory_members_actions' ); ?>

			</div> -->
		</div>
            </div>
	<?php endwhile; ?>
</div>

<?php

	/**
	 * Fires after the display of the members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_directory_members_list' ); ?>

	<?php bp_member_hidden_fields(); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="member-dir-count-bottom">

			<?php echo bp_get_members_pagination_countss(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php esc_html_e( "Sorry, no affiliates were found.", 'besocial' ); ?></p>
	</div>

<?php endif; ?>

<?php

/**
 * Fires after the display of the members loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_members_loop' ); ?>

<?php 
// var_dump($xfield_data7other);
?>




