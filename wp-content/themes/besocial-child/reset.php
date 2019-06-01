<?php
/**
* Template Name: Reset User Agreement
* // This will be responsibla for removing the flag for the advanced custom field terms_conditions that is stored under wp_usermeta
*
*/
$user = wp_get_current_user();
if ( in_array( 'administrator', (array) $user->roles ) ) {
    echo "<pre>";
    echo "Your user Role is Administrator"; 
    global $wpdb;
    $wpdb->query(
        $wpdb->prepare( 
        "UPDATE wp_usermeta
    	SET meta_value = ''
    	WHERE meta_key LIKE 'terms_conditions'"
    	)
    );
    if (!$wpdb->last_error) {
        echo "<br><br>Success! Redirecting to home page. Or click <a href='https://www.weildco.tech'>here to go back</a> ";
        header( "refresh:5;url=https://www.weildco.tech" );
    }else {
        echo "Due to a system error or scheduled maintenance, we couldn't process your request. Please try again later or contact the system admin";
    }
}else {
    echo "Sorry, but your user Role is NOT Administrator. Only users with the user role 'Administrator' can request this. Please contact the system admin."; 
}

?>
