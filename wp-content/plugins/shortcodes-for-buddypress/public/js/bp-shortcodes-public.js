(function (jq) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
    jq(function () {
        /* When the filter select box is changed re-query */
        jq('.bpsh-order-select .bpsh-filter select').change(function () {
            var a, b, c, d, e, f, g, h;
            return a = jq(jq(".item-list-tabs li.selected").length ? ".item-list-tabs li.selected" : this), b = a.attr("id").split("-"), c = b[0], d = b[1], e = jq(this).val(), f = !1, g = null, jq(".dir-search input").length && (f = jq(".dir-search input").val()), h = jq(".groups-members-search input"), h.length && (f = h.val(), c = "members", d = "groups"), "members" === c && "groups" === d && (c = "group_members", g = "groups/single/members"), "friends" === c && (c = "members"), bpsh_filter_request(c, e, d, "div." + c, f, 1, jq.cookie("bp-" + c + "-extras"), null, g), !1
        });

        /* Activity filter select */
        jq('#bpsh-activity-filter-select select').change(function () {
            var selected_tab = jq('div.activity-type-tabs li.selected'),
                    filter = jq(this).val(),
                    scope;

            if (!selected_tab.length) {
                scope = null;
            } else {
                scope = selected_tab.attr('id').substr(9, selected_tab.attr('id').length);
            }

            bpsh_activity_request(scope, filter);

            return false;
        });
    });
    /* Filter the current content list (groups/members/blogs/topics) */
    function bpsh_filter_request(object, filter, scope, target, search_terms, page, extras, caller, template) {
        if ('activity' === object) {
            return false;
        }

        if (null === scope) {
            scope = 'all';
        }

        /* Save the settings we want to remain persistent to a cookie */
        jq.cookie('bp-' + object + '-scope', scope, {
            path: '/',
            secure: ('https:' === window.location.protocol)
        });
        jq.cookie('bp-' + object + '-filter', filter, {
            path: '/',
            secure: ('https:' === window.location.protocol)
        });
        jq.cookie('bp-' + object + '-extras', extras, {
            path: '/',
            secure: ('https:' === window.location.protocol)
        });
        /* Set the correct selected nav and filter */
        jq('.item-list-tabs li').each(function () {
            jq(this).removeClass('selected');
        });
        jq('#' + object + '-' + scope + ', #object-nav li.current').addClass('selected');
        jq('.item-list-tabs li.selected').addClass('loading');
        jq('.item-list-tabs select option[value="' + filter + '"]').prop('selected', true);
        if ('friends' === object || 'group_members' === object) {
            object = 'members';
        }

        if (bp_ajax_request) {
            bp_ajax_request.abort();
        }
        var data = {
            action: 'bpsh_' + object + '_filter',
            'cookie': bp_get_cookies(),
            'object': object,
            'filter': filter,
            'search_terms': search_terms,
            'scope': scope,
            'page': page,
            'extras': extras,
            'template': template
        };

        bp_ajax_request = jq.post(bpsh_ajax_obj.ajaxurl, data, function (response)
        {

            /* animate to top if called from bottom pagination */
            if (caller === 'pag-bottom' && jq('#subnav').length) {
                var top = jq('#subnav').parent();
                jq('html,body').animate({scrollTop: top.offset().top}, 'slow', function () {
                    jq(target).fadeOut(100, function () {
                        jq(this).html(response);
                        jq(this).fadeIn(100);
                    });
                });
            } else {
                jq(target).fadeOut(100, function () {
                    jq(this).html(response);
                    jq(this).fadeIn(100);
                });
            }

            jq('.item-list-tabs li.selected').removeClass('loading');
        });
    }
    /* Activity Loop Requesting */
    function bpsh_activity_request(scope, filter) {
        /* Save the type and filter to a session cookie */
        if (null !== scope) {
            jq.cookie('bp-activity-scope', scope, {
                path: '/',
                secure: ('https:' === window.location.protocol)
            });
        }
        if (null !== filter) {
            jq.cookie('bp-activity-filter', filter, {
                path: '/',
                secure: ('https:' === window.location.protocol)
            });
        }
        jq.cookie('bp-activity-oldestpage', 1, {
            path: '/',
            secure: ('https:' === window.location.protocol)
        });

        /* Remove selected and loading classes from tabs */
        jq('.item-list-tabs li').each(function () {
            jq(this).removeClass('selected loading');
        });
        /* Set the correct selected nav and filter */
        jq('#activity-' + scope + ', .item-list-tabs li.current').addClass('selected');
        jq('#object-nav.item-list-tabs li.selected, div.activity-type-tabs li.selected').addClass('loading');
        jq('#bpsh-activity-filter-select select option[value="' + filter + '"]').prop('selected', true);

        /* Reload the activity stream based on the selection */
        jq('.widget_bp_activity_widget h2 span.ajax-loader').show();

        if (bp_ajax_request) {
            bp_ajax_request.abort();
        }

        bp_ajax_request = jq.post(bpsh_ajax_obj.ajaxurl, {
            action: 'bpsh_activity_widget_filter',
            'cookie': bp_get_cookies(),
            '_wpnonce_activity_filter': jq('#_wpnonce_activity_filter').val(),
            'scope': scope,
            'filter': filter
        },
        function (response)
        {
            jq('.widget_bp_activity_widget h2 span.ajax-loader').hide();

            jq('div.activity').fadeOut(100, function () {
                jq(this).html(response.contents);
                jq(this).fadeIn(100);

                /* Selectively hide comments */
                bp_legacy_theme_hide_comments();
            });

            /* Update the feed link */
            if (undefined !== response.feed_url) {
                jq('.directory #subnav li.feed a, .home-page #subnav li.feed a').attr('href', response.feed_url);
            }

            jq('.item-list-tabs li.selected').removeClass('loading');

        }, 'json');
    }
})(jQuery);
