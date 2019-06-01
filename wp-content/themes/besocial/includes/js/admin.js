/* ACCORDION */
jQuery(document).ready(function(){"use strict";jQuery(".egemenerd_input_title h3").click(function(){if(jQuery(this).parent().next(".egemenerd_all_options").css("display")==="none"){jQuery(this).removeClass("inactive");jQuery(this).addClass("active")}else{jQuery(this).removeClass("active");jQuery(this).addClass("inactive")}jQuery(this).parent().next(".egemenerd_all_options").slideToggle(200);return false})});

/* COLORPICKER */
if ( jQuery.isFunction(jQuery.fn.wpColorPicker) ) {
jQuery(document).ready(function(e){e(".egemenerd-color").wpColorPicker()})
}

/* ICONPICKER */
jQuery('#egemenerd_form').find('.egemenerd-icon-picker').iconpicker();

/* SELECT BOX */
jQuery(function(){jQuery('.egemenerd-select').selectric();});

/* JQUERY UI SLIDER */
jQuery(document).ready(function(a){a(".egemenerd-slider-container").each(function(){var b=a(this),c=b.find(".egemenerd-slider-field-value"),d=b.find(".egemenerd-slider-field"),e=b.find(".egemenerd-slider-field-value-text"),f=c.data();d.slider({range:"min",step:f.step,value:f.start,min:f.min,max:f.max,slide:function(a,b){c.val(b.value),e.text(b.value)}}),c.val(d.slider("value")),e.text(d.slider("value"))})});

/* RGBA COLORPICKER */
if ( jQuery.isFunction(jQuery.fn.wpColorPicker) ) {
(function(e,t,n,r){"use strict";if(typeof Color.fn.toString!==r){Color.fn.toString=function(){if(this._alpha<1){return this.toCSS("rgba",this._alpha).replace(/\s+/g,"")}var e=parseInt(this._color,10).toString(16);if(this.error){return""}if(e.length<6){for(var t=6-e.length-1;t>=0;t--){e="0"+e}}return"#"+e}}e.cs_ParseColorValue=function(e){var t=e.replace(/\s+/g,""),n=t.indexOf("rgba")!==-1?parseFloat(t.replace(/^.*,(.+)\)/,"$1")*100):100,r=n<100?true:false;return{value:t,alpha:n,rgba:r}};e.fn.cs_wpColorPicker=function(){return this.each(function(){var t=e(this);if(t.data("rgba")!==false){var n=e.cs_ParseColorValue(t.val());t.wpColorPicker({change:function(e,n){t.closest(".wp-picker-container").find(".egemenerd-alpha-slider-offset").css("background-color",n.color.toString());t.trigger("keyup")},create:function(r,i){var s=t.data("a8cIris"),o=t.closest(".wp-picker-container"),u=e('<div class="egemenerd-alpha-wrap">'+'<div class="egemenerd-alpha-slider"></div>'+'<div class="egemenerd-alpha-slider-offset"></div>'+'<div class="egemenerd-alpha-text"></div>'+"</div>").appendTo(o.find(".wp-picker-holder")),a=u.find(".egemenerd-alpha-slider"),f=u.find(".egemenerd-alpha-text"),l=u.find(".egemenerd-alpha-slider-offset");a.slider({slide:function(e,n){var r=parseFloat(n.value/100);s._color._alpha=r;t.wpColorPicker("color",s._color.toString());f.text(r<1?r:"")},create:function(){var r=parseFloat(n.alpha/100),i=r<1?r:"";f.text(i);l.css("background-color",n.value);o.on("click",".wp-picker-clear",function(){s._color._alpha=1;f.text("");a.slider("option","value",100).trigger("slide")});o.on("click",".wp-picker-default",function(){var n=e.cs_ParseColorValue(t.data("default-color")),r=parseFloat(n.alpha/100),i=r<1?r:"";s._color._alpha=r;f.text(i);a.slider("option","value",n.alpha).trigger("slide")});o.on("click",".wp-color-result",function(){u.toggle()});e("body").on("click.wpcolorpicker",function(){u.hide()})},value:n.alpha,step:1,min:0,max:100})}})}else{t.wpColorPicker({change:function(){t.trigger("keyup")}})}})};e(n).ready(function(){e(".egemenerd-wp-color-picker").cs_wpColorPicker()})})(jQuery,window,document)}