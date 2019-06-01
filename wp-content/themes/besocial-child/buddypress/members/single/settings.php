<?php
/**
 * BuddyPress - Users Settings
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<h2 class="besocial-bp-page-title"><?php esc_attr_e( 'Profile Privacy', 'besocial' ); ?></h2>

<div class="item-list-tabs no-ajax" id="subnav" aria-label="<?php esc_attr_e( 'Member secondary navigation', 'besocial' ); ?>" role="navigation">
	<ul>
		<?php if ( bp_core_can_edit_settings() ) : ?>
		<li id="profile_view-personal-li"><a id="notifications" href="<?php echo bp_loggedin_user_domain();  ?>">My Profile</a></li>
			<?php  bp_get_options_nav(); ?>

		<?php endif; ?>
	</ul>
</div>

<?php

switch ( bp_current_action() ) :
	// case 'notifications'  :
	// 	bp_get_template_part( 'members/single/settings/notifications'  );
	// 	break;
	// case 'capabilities'   :
	// 	bp_get_template_part( 'members/single/settings/capabilities'   );
	// 	break;
	// case 'delete-account' :
	// 	bp_get_template_part( 'members/single/settings/delete-account' );
	// 	break;
	case 'general'        :
		bp_get_template_part( 'members/single/settings/general'        );
		break;
	case 'profile'        :
		bp_get_template_part( 'members/single/settings/profile'        );
		break;
	default:
		bp_get_template_part( 'members/single/plugins'                 );
		break;
endswitch;

?>
<style>
.bppv-visibility-settings-block {
    display:none;
}

.bppv-visibility-settings-block:first-child {
    display:block;
}
</style>
<script>
// This is for hidding the List in members directory? field and List in member search?
// So when the user chooses Only Me or Everyone, all fields are Consolidate
(function ($) {
$(window).on('load', function() {
    if (document.querySelector('#item-body > form > div:nth-child(1) > div > div.selectric-items > div > ul > li:nth-child(1)')){
        
    document.querySelector('#item-body > form > div:nth-child(1) > div > div.selectric-items > div > ul > li:nth-child(1)').classList.add("first");
    document.querySelector('#item-body > form > div:nth-child(1) > div > div.selectric-items > div > ul > li:nth-child(2)').classList.add("second");
    }
});


$(document).ready(function() {
    
    

    $('#item-body > form > div:nth-child(1) > div > div.selectric-items > div > ul').addClass('first');
    // console.log($('#item-body > form > div:nth-child(1) > div > div.selectric-items > div > ul > li:first-child'));
    
    $('.fisrt').on('click', function(event){
        console.log("first");
    	$('#item-body > form > div:nth-child(2) > div > label:nth-child(1) > input[type="radio"]').attr("checked", "checked");
    	$('#item-body > form > div:nth-child(3) > div > label:nth-child(1) > input[type="radio"]').attr("checked", "checked");

    });


    $('html').on('click', function(event){
        console.log("pi");

        if ($('.second').hasClass("selected")){
            console.log("oi1");
        	$('#item-body > form > div:nth-child(2) > div > label:nth-child(2) > input[type="radio"]').attr("checked", "checked");
        	$('#item-body > form > div:nth-child(3) > div > label:nth-child(2) > input[type="radio"]').attr("checked", "checked");

        }
        if ($('#item-body > form > div:nth-child(1) > div > div.selectric-items > div > ul > li:nth-child(1)').hasClass("selected")){
            console.log("oi2");
        	$('#item-body > form > div:nth-child(2) > div > label:nth-child(1) > input[type="radio"]').attr("checked", "checked");
        	$('#item-body > form > div:nth-child(3) > div > label:nth-child(1) > input[type="radio"]').attr("checked", "checked");

        }
        
        

    });

});


})(jQuery);

</script>
