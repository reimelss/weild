var memberPreview = function () {
    "use strict";
    jQuery('body').find(".besocial-img-tooltip").mouseenter(function () {
        var thumbnail = jQuery(this).data('thumb');
        var cover = jQuery(this).data('cover');
        var membername = jQuery(this).data('membername');
        var since = jQuery(this).data('since');
        var featured = jQuery(this).data('featured');
        var bio = jQuery(this).data('bio');
        var count = jQuery(this).data('count');
        jQuery(this).append("<div id='besocial-preview' class='hide-on-load " + featured + "'><div id='besocial-preview-loader-container'><div id='besocial-preview-loader'></div></div><div id='besocial-preview-cover'><img src='" + cover + "' /></div><div id='besocial-preview-info'><div id='besocial-preview-thumb'><img src='" + thumbnail + "' /></div><div id='besocial-preview-name'><h5>" + membername + "</h5><p id='besocial-preview-since'>" + since + "<span id='besocial-preview-count'>" + count + "</span></p><p id='besocial-preview-bio'>" + bio + "</p></div></div></div>");
        jQuery('#besocial-preview-cover').find('img').on('load', function () {
            jQuery('#besocial-preview').find('img').show();
            jQuery('#besocial-preview-loader-container').fadeOut(200);
        });
    }).mousemove(function (event) {
        jQuery("#besocial-preview").position({
            my: "left+20 top",
            of: event,
            collision: "fit flip"
        });
        jQuery("#besocial-preview").removeClass('hide-on-load');
    }).mouseleave(function () {
        jQuery("#besocial-preview").remove();
    });
};
jQuery(document).ready(function () {
    "use strict";
    var ww = document.body.clientWidth;
    if (ww > 782) {
        memberPreview();
    }
});

jQuery(document).ajaxComplete(function() {
    "use strict";
    var ww = document.body.clientWidth;
    if (ww > 782) {
        setTimeout(function(){
            jQuery('body').find(".besocial-img-tooltip").unbind('mouseenter mousemove mouseleave');
            memberPreview();
        }, 1000);
    }
});