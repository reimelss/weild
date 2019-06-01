function like(event) {
    event.preventDefault();
    var has_id = jQuery(this).prev();
    var id = has_id.val();
    like_ajax(id);
}

function like_ajax(id) {
    var like = jQuery('.besocial-p-like-counter.' + id);
    like.text(besocial_login.text);
}


function dislike(event) {
    event.preventDefault();
    var has_id = jQuery(this).prev();
    var id = has_id.val();
    dislike_ajax(id);
}

function dislike_ajax(id) {
    var dislike = jQuery('.besocial-p-dislike-counter.' + id);
    dislike.text(besocial_login.text);
}

jQuery(document).ready(function () {
    jQuery(document.body).off('click.besociallike', '.besocial-p-like').one('click.besociallike', '.besocial-p-like', like);
    jQuery(document.body).off('click.besocialdislike', '.besocial-p-dislike').one('click.besocialdislike', '.besocial-p-dislike', dislike);
});