<?php
/**
 * BuddyPress - Members Profile Loop
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action( 'bp_before_profile_loop_content' ); ?>


<?php if ( bp_has_profile() ) : ?>

	<?php while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

		<?php if ( bp_profile_group_has_fields() ) : ?>

			<?php

			/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
			
			do_action( 'bp_before_profile_field_content' ); ?>

			<div class="bp-widget <?php bp_the_profile_group_slug(); ?>">

				<h3><?php 
				ob_start(); // Start output buffering

                bp_the_profile_group_name();                
                
                $group_name = ob_get_contents(); // Store buffer in variable
                
                ob_end_clean(); // End buffering and clean up
                
                echo $group_name; // will contain the contents

				
				 ?></h3>

				<table class="profile-fields">

					<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

						<?php if ( bp_field_has_data() ) : 	
    						  //  if () {
    						        $fields = bp_get_the_profile_field_value();
    						      //  echo "<pre>";
    						      //  print_r(explode(',', $fields, -1));
    						      //var_dump($fields);
    						      ///home/weildco/public_html/wp-content/plugins/buddypress/bp-xprofile/bp-xprofile-template.php 
    						      //find -> function bp_unserialize_profile_field( $value ) 
    						      //line 918 $field_value = implode( '////', $field_value );
    						      // Fix for the "," issue 


    						        $fields = explode('////', $fields);
    
    						  //  }	
    						?>

							<tr<?php bp_field_css_class();  ?> >
							
								<td class="label">
								<?php 
                				ob_start(); // Start output buffering
                                bp_the_profile_field_name();                
                                $title_name = ob_get_contents(); // Store buffer in variable
                                ob_end_clean(); // End buffering and clean up
                                echo $title_name; // will contain the contents
                				 
								
								?></td>
								<td class="data"><?php
							    if ($group_name != 'Affiliate Information' && $group_name != 'Biographies' ) {
							        $i = 0;
							        foreach((array) $fields as $name ) {
							            if($title_name == "Other" || $title_name == "All Other") {
						                    $name = explode(',', $name);
						                    foreach( $name as $lang ) {
        							            $lang = strip_tags($lang);
        						                $size = strlen($lang);


        						                $url = $lang;
                                                if ($url != "Asset-Backed" || $url != "Follow-on")
        						                    $url = str_replace("-","",$url);
        					                    if ($url != "Asset-Backed" || $url != "Follow-on")
        						                    $url = str_replace("–","",$url);
                                                $url = str_replace("amp","",$url);
                                                $url = str_replace(" ","+",$url);
                                                $url = str_replace("++","+",$url);
        						              //  var_dump($url);
        
                                                $url = substr($url, 0, 10);
        						                $url = "https://www.weildco.tech/affiliates/?members_search=" . $url;
        							            echo "<a href='" . $url . "' class='normalmouse n$i $size'>" . $lang . "</a>";
						                    }
							                
							            }else {
							            $name = strip_tags($name);
						                $size = strlen($name);
						                $url = $name;
                                        if ($url != "Asset-Backed" || $url != "Follow-on")
						                    $url = str_replace("-","",$url);
					                    if ($url != "Asset-Backed" || $url != "Follow-on")
						                    $url = str_replace("–","",$url);
                                        $url = str_replace("amp","",$url);
                                        $url = str_replace(" ","+",$url);
                                        $url = str_replace("++","+",$url);
						              //  var_dump($url);

                                        $url = substr($url, 0, 10);
						                $url = "https://www.weildco.tech/affiliates/?members_search=" . $url;
							            echo "<a href='" . $url . "' class='normalmouse n$i $size'>" . $name . "</a>";
							            $i++;
							                
							            }
							        }
							    }else {
							        
                                echo bp_get_the_profile_field_value();
							    }
                                ?>
								
								
								</td>

							</tr>

						<?php endif; ?>

						<?php

						/**
						 * Fires after the display of a field table row for profile data.
						 *
						 * @since 1.1.0
						 */
						do_action( 'bp_profile_field_item' ); ?>

					<?php endwhile; ?>

				</table>
			</div>

			<?php

			/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
			do_action( 'bp_after_profile_field_content' ); ?>

		<?php endif; ?>

	<?php endwhile; ?>

	<?php

	/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
	do_action( 'bp_profile_field_buttons' ); ?>

<?php endif; ?>


<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action( 'bp_after_profile_loop_content' ); ?>
