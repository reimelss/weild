/* FAQ NAVIGATION */
jQuery("#besocial-content").find(".besocial-faq-menu a").on('click', function (event) {
    "use strict";
    event.preventDefault();
    var searchTerm = jQuery("#besocial-content").find('.besclwp-live-search-box').val().toLowerCase();
    var goto = jQuery(this).data("cat");
    jQuery('body,html').animate({
        scrollTop: jQuery("#" + goto).offset().top - 40
    }, 500);
    return false;
});

/* FAQ LIVE SEARCH */
jQuery("#besocial-content").find('.besclwp-live-search-results').each(function () {
    "use strict";
    jQuery(this).attr('data-search-term', jQuery(this).find(".besclwp-accordion-header").text().toLowerCase());
});

jQuery("#besclwp-live-search-container").find('.besclwp-live-search-icon').on('click', function () {
    "use strict";
    var faqbody = jQuery("#besclwp-faq-cat-container");
    jQuery("#besocial-content").find(".besocial-faq-menu").removeClass("menu-is-disabled");
    jQuery("#besclwp-live-search-container").find(".besclwp-live-search-box").val("");
    jQuery("#besclwp-live-search-container").removeClass("cancel-search");
    faqbody.find(".besclwp-faq-cat-title").show();
    faqbody.find(".besclwp-accordion-container").removeClass("besclwp-no-result");
    jQuery("#besclwp-no-results-message").hide();
    faqbody.find('.besclwp-live-search-results').show();
});

jQuery("#besocial-content").find('.besclwp-live-search-box').on('keyup', function () {
    "use strict";
    jQuery("#besclwp-no-results-message").hide();
    var searchTerm = jQuery(this).val().toLowerCase();
    var faqbody = jQuery("#besclwp-faq-cat-container");
    if ((searchTerm == '') || (searchTerm.length < 1)) {
        jQuery("#besocial-content").find(".besocial-faq-menu").removeClass("menu-is-disabled");
        jQuery("#besclwp-live-search-container").removeClass("cancel-search");
        faqbody.find(".besclwp-faq-cat-title").show();
        faqbody.find(".besclwp-accordion-container").removeClass("besclwp-no-result");
    } else {
        jQuery("#besocial-content").find(".besocial-faq-menu").addClass("menu-is-disabled");
        jQuery("#besclwp-live-search-container").addClass("cancel-search");
        faqbody.find(".besclwp-faq-cat-title").hide();
        faqbody.find(".besclwp-accordion-container").addClass("besclwp-no-result");
    }
    faqbody.find('.besclwp-live-search-results').each(function () {
        if (jQuery(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
            jQuery(this).show();
        } else {
            jQuery(this).hide();
        }
    });
    if (faqbody.find(".besclwp-live-search-results:visible").length === 0) {
        jQuery("#besclwp-no-results-message").show();
    }
});