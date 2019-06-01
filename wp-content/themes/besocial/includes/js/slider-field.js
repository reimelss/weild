(function ($) {
    "use strict";
    $(document).ready(function () {

        // Loop through all cmb-type-slider-field instances and instantiate the slider UI
        $('#wpbody-content').find('.cmb-type-egemenerd-slider').each(function () {
            var $this = $(this);
            var $value = $this.find('.egemenerd-cmb2-slider-field-value');
            var $slider = $this.find('.egemenerd-cmb2-slider-field');
            var $text = $this.find('.egemenerd-cmb2-slider-field-value-text');
            var slider_data = $value.data();

            $slider.slider({
                range: 'min',
                step: 1,
                value: slider_data.start,
                min: slider_data.min,
                max: slider_data.max,
                slide: function (event, ui) {
                    $value.val(ui.value);
                    $text.text(ui.value);
                }
            });

            // Initiate the display
            $value.val($slider.slider('value'));
            $text.text($slider.slider('value'));

        });

    });

    $('#wpbody-content').find('.cmb-add-group-row').on('click', function () {
        $('#wpbody-content').find('.cmb-repeat-group-wrap .cmb-type-egemenerd-slider .egemenerd-cmb2-slider-field').slider("destroy");
        setTimeout(function () {
            // Loop through all cmb-type-slider-field instances and instantiate the slider UI
            $('#wpbody-content').find('.cmb-repeat-group-wrap .cmb-type-egemenerd-slider').each(function () {
                var $this = $(this);
                var $value = $this.find('.egemenerd-cmb2-slider-field-value');
                var $slider = $this.find('.egemenerd-cmb2-slider-field');
                var $text = $this.find('.egemenerd-cmb2-slider-field-value-text');
                var slider_data = $value.data();

                $slider.slider({
                    range: 'min',
                    step: 1,
                    value: slider_data.start,
                    min: slider_data.min,
                    max: slider_data.max,
                    slide: function (event, ui) {
                        $value.val(ui.value);
                        $text.text(ui.value);
                    }
                });

                $slider.slider('option', 'value', $text.text());

                // Initiate the display
                $value.val($slider.slider('value'));
                $text.text($slider.slider('value'));

            });

        }, 100);

    });
})(jQuery);