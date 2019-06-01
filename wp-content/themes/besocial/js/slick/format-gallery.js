(function ($) {
$(document).ready(function () {
    "use strict";
    $('#besclwp-gallery-slider').slick({
        slidesToShow: 1,
        adaptiveHeight: true,
        slidesToScroll: 1,
        arrows: true,
        dots: true,
        appendDots: $('#besclwp-gallery-dots-container'),
        dotsClass: 'slick-dots besclwp-gallery-dots',
        fade: true,
        customPaging: function (slider, i) {
            var thumbnail = $(slider.$slides[i]).data('thumbnail');
            return '<a><img src="' + thumbnail + '" alt=""></a>';
        }
    });
    $('#besclwp-gallery-slider').fadeIn(200);
});
})(jQuery);    