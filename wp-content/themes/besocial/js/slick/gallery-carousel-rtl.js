(function ($) {
$(document).ready(function () {
    "use strict";
    $('#besocial-content').find('.besclwp-format-gallery-carousel').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        rtl: true,
        adaptiveHeight: true
    });
});
})(jQuery);