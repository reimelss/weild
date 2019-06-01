	function like_comment(event) {
	    event.preventDefault();
	    var has_id = jQuery(this).parent().children('input');
	    var id = has_id.val();
	    like_ajax_comment(id);
	}

	function like_ajax_comment(id) {
	    var like = jQuery('.besocial-p-like-counter-comment.' + id);
	    like.text(besocial_login_comment.text);
	}


	function dislike_comment(event) {
	    event.preventDefault();
	    var has_id = jQuery(this).parent().children('input');
	    var id = has_id.val();
	    dislike_ajax_comment(id);
	}

	function dislike_ajax_comment(id) {
	    var dislike = jQuery('.besocial-p-dislike-counter-comment.' + id);
	    dislike.text(besocial_login_comment.text);
	}

	jQuery(document).ready(function () {
	    jQuery(document.body).off('click.besociallikecomment', '.besocial-p-like-comment').one('click.besociallikecomment', '.besocial-p-like-comment', like_comment);
	    jQuery(document.body).off('click.besocialdislikecomment', '.besocial-p-dislike-comment').one('click.besocialdislikecomment', '.besocial-p-dislike-comment', dislike_comment);
	});