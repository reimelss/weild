<?php
function besocial_system_add_dislike_class_buddypress($id){
    if(is_user_logged_in()){
        $current_user_id = get_current_user_id();
        $user_key = 'besocial_system_user_'.$current_user_id;
        $user_data = array(
            'liked'    => 'liked',
            'disliked' => 'disliked'
        );
        if(get_post_meta($id,$user_key,true) == ''){
            add_post_meta($id, $user_key, $user_data,true);
        }	
        $current_user = get_post_meta($id,$user_key,true);
        $current_user_disliked = $current_user['disliked'];
        if($current_user_disliked === 'nodisliked'){
            return 'besocial-p-dislike-active';
        } elseif($current_user_disliked !== 'disliked'){
            return 'besocial-p-dislike-active';
		}
    }
}

function besocial_system_get_total_dislikes_buddypress($id){
    $dislikes = get_post_meta($id,'besocial_system_dislikes',true);
    if(empty($dislikes)){
        return 0;
    } elseif(!$dislikes == ''){
        return $dislikes = get_post_meta($id,'besocial_system_dislikes',true);
    }
}

function besocial_system_dislike_counter_buddypress($id){
    if (besocial_system_add_dislike_class_buddypress($id) == 'besocial-p-dislike-active'){
        return '<span class="besocial-p-dislike-counter '.$id. '">'. besocial_system_get_total_dislikes_buddypress($id).'</span>';
    } elseif(is_user_logged_in()){
        return '<span class="besocial-p-dislike-counter '.$id. '">'. besocial_system_get_total_dislikes_buddypress($id).'</span>';
    }
}

function besocial_system_render_dislike_button_buddypress($id){
    return	'<div class="besocial-container-dislike"><input type="hidden" value="'.$id.'" /><div class="besocial-p-dislike '.$id.' '. besocial_system_add_dislike_class_buddypress($id) .' '.besocial_system_get_dislike_icon().'">'.besocial_system_dislike_counter_buddypress($id).'</div></div>';
}

function besocial_system_add_like_class_buddypress($id){
    if(is_user_logged_in()){
        $current_user_id = get_current_user_id();
        $user_key = 'besocial_system_user_'.$current_user_id;
        $user_data = array(
            'liked'    => 'liked',
            'disliked' => 'disliked'
        );
        if(get_post_meta($id,$user_key,true) == ''){
            add_post_meta($id, $user_key, $user_data,true);
        }
        $current_user = get_post_meta($id,$user_key,true);
        $current_user_liked = $current_user['liked'];
        if($current_user_liked === 'noliked'){
            return 'besocial-p-like-active';
        }elseif($current_user_liked !== 'liked'){
            return 'besocial-p-like-active';
        }
    }
}

function besocial_system_get_total_likes_buddypress($id){
    $likes = get_post_meta($id,'besocial_system_likes',true);
    if(empty($likes)){
        return 0;
    } elseif(!$likes == ''){
        return $dislikes = get_post_meta($id,'besocial_system_likes',true);
    }
}

function besocial_system_like_counter_buddypress($id){
	if (besocial_system_add_like_class_buddypress($id) == 'besocial-p-like-active'){
        if(is_user_logged_in()){
            return 	'<span  class="besocial-p-like-counter '. $id.'">'.besocial_system_get_total_likes_buddypress($id).'</span>';
        }
    }
    elseif(is_user_logged_in()){
        return 	'<span  class="besocial-p-like-counter '. $id.'">'.besocial_system_get_total_likes_buddypress($id).'</span>';
    }
}

function besocial_buddypress_render($id){
	$besocial_like_dislike = get_option("besocial_like_dislike");
    if($besocial_like_dislike['v-switch-dislike'] != 'off'){
        $buttons = '<div class="besocial-container-vote"><div class="besocial-container-like"><input type="hidden" value="'.$id.'" /><div class="besocial-p-like '.$id.' '.besocial_system_add_like_class_buddypress($id).' '.besocial_system_get_like_icon().'">'.besocial_system_like_counter_buddypress($id).'</div></div>'.besocial_system_render_dislike_button_buddypress($id).'</div>';
        echo $buttons;
    } else {
        $buttons = '<div class="besocial-container-vote"><div class="besocial-container-like"><input type="hidden" value="'.$id.'" /><div class="besocial-p-like '.$id.' '.besocial_system_add_like_class_buddypress($id).' '.besocial_system_get_like_icon().'">'.besocial_system_like_counter_buddypress($id).'</div></div></div>';
        echo $buttons;
    }
}

function besocial_buddypress_after(){
    besocial_buddypress_render(bp_get_activity_id());
}
add_action('bp_activity_entry_meta', 'besocial_buddypress_after', 999);
?>