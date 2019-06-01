	function like_comment(event){
		event.preventDefault();
		var has_id = jQuery(this).parent().children('input');
		var id = has_id.val();
		like_ajax_comment(id);
	}
	
	function like_ajax_comment(id){
		jQuery.ajax({
			type: "post",
			url: besocial_ajax_comment.url,
			dataType: "json",
			data:{
				action:'besocial_system_comment_like_button',
				post_id:id,
				nonce: besocial_ajax_comment.nonce
			},
			success: function(response){
				if(response.both == 'no'){
				var like = jQuery('.besocial-p-like-counter-comment.'+id);
				like.text(response.likes);
				var like_toggle = jQuery('.besocial-p-like-comment.'+id);
				like_toggle.toggleClass('besocial-p-like-active-comment');
				}else{
					
				var dislike = jQuery('.besocial-p-dislike-counter-comment.'+id);
				dislike.text(response.dislikes);
				
				var dislike_toggle = jQuery('.besocial-p-dislike-comment.'+id);
				dislike_toggle.toggleClass('besocial-p-dislike-active-comment');
				
				var like = jQuery('.besocial-p-like-counter-comment.'+id);
				like.text(response.likes);
				
				var like_toggle = jQuery('.besocial-p-like-comment.'+id);
				like_toggle.toggleClass('besocial-p-like-active-comment');
				
				}
			},
			complete:function(){
				jQuery(document.body).one('click.besociallikecomment','.besocial-p-like-comment',like_comment);
			}
		});
	}

jQuery(document).ready(function() {
	if(Modernizr.touchevents){
		jQuery(document.body).on('mouseleave touchmove click', '.besocial-p-like-comment', function( event ) {
			if(jQuery(this).hasClass('besocial-p-like-active-comment')){
				jQuery(this).css('color','#3b5998');
			}else{
				jQuery(this).removeAttr('style');
			};
		});
	}
	jQuery(document.body).off('click.besociallikecomment','.besocial-p-like-comment').one('click.besociallikecomment','.besocial-p-like-comment',like_comment);
});