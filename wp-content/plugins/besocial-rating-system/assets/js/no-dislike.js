	function like(event){
		event.preventDefault();
		var has_id = jQuery(this).prev();
		var id = has_id.val();
		like_ajax(id);
	}
	
	function like_ajax(id){
		jQuery.ajax({
			type: "post",
			url: besocial_ajax_var.url,
			dataType: "json",
			data:{
				action:'besocial_system_like_button',
				post_id:id,
				nonce: besocial_ajax_var.nonce
			},
			success: function(response){
				if(response.likes != "exit"){
					function rating_system_add_new(){
						if(jQuery('#rating-system-limit').length){
							var limit = jQuery('#rating-system-limit').val();
							var avaible = jQuery('.rating-system-list li').length;
							if(avaible == limit){
								return false;
							}else return true;
						}
					}
					
					if(jQuery('.post-like-counter.'+id).length && jQuery('.post-like-text.'+id).length){
						var counter = jQuery('.post-like-counter.'+id);
						counter.text(response.likes);
						if(response.likes == '1'){
							var text = jQuery('.post-like-text.'+id);
						}
						if(response.likes > '1'){
							var text = jQuery('.post-like-text.'+id);
						}
					
					}
					if(response.likes == '0' && jQuery('li.'+id).length){
						jQuery('li.'+id).remove();
					}else if(!jQuery('li.'+id).length && jQuery('.widget_besocial_top_likes').length && !jQuery('.no-like').length  && !jQuery('.post-like-counter.'+id).length && !jQuery('.post-like-text.'+id).length && !response.likes == '0' && rating_system_add_new() ){
						jQuery('.widget_besocial_top_likes > ul').append('<li class="'+response.id+'"><a href="'+response.url+'" title="'+response.title+'">'+response.title+'</a><span class="post-like-counter '+response.id+'">'+" "+''+response.likes);
					}else if(!jQuery('li.'+id).length && jQuery('.widget_besocial_top_likes').length && jQuery('.no-like').length  && !jQuery('.post-like-counter.'+id).length && !jQuery('.post-like-text.'+id).length && !response.likes == '0' && rating_system_add_new()){
						jQuery('.widget_besocial_top_likes > ul').append('<li class="'+response.id+'"><a href="'+response.url+'" title="'+response.title+'">'+response.title+'</a></li>');
					}
					
					
					if(response.both == 'no'){
					var like = jQuery('.besocial-p-like-counter.'+id);
					like.text(response.likes);
					var like_toggle = jQuery('.besocial-p-like.'+id);
					like_toggle.toggleClass('besocial-p-like-active');
					}else{
						
					var dislike = jQuery('.besocial-p-dislike-counter.'+id);
					dislike.text(response.dislikes);
					
					var dislike_toggle = jQuery('.besocial-p-dislike.'+id);
					dislike_toggle.toggleClass('besocial-p-dislike-active');
					
					var like = jQuery('.besocial-p-like-counter.'+id);
					like.text(response.likes);
					
					var like_toggle = jQuery('.besocial-p-like.'+id);
					like_toggle.toggleClass('besocial-p-like-active');
					
					}
				}
			},
			complete:function(){
				jQuery(document.body).one('click.besociallike','.besocial-p-like',like);
			}
		});
	}

jQuery(document).ready(function() {
	if(Modernizr.touchevents){
		jQuery(document.body).on('mouseleave touchmove click', '.besocial-p-like', function( event ) {
			if(jQuery(this).hasClass('besocial-p-like-active')){
				jQuery(this).css('color','#3b5998');
			}else{
				jQuery(this).removeAttr('style');
			};
		});
	}
	jQuery(document.body).off('click.besociallike','.besocial-p-like').one('click.besociallike','.besocial-p-like',like);
});