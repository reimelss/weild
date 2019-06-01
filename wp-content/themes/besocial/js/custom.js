(function ($) {
    "use strict";
    /* ICON MENU */
    $(function () {
        var $has_submenu, $no_submenu, $sidemenu, hide;
        $sidemenu = $('#besocial-sidemenu');
        $sidemenu.find('.has-submenu').each(function () {
            if ($(this).children("ul").length === 0) {
                $(this).removeClass("has-submenu");
            }
        });
        $has_submenu = $sidemenu.find('> li.has-submenu');
        $no_submenu = $sidemenu.find('> li:not(.has-submenu)');
        $has_submenu.find('> a').on('click', function (e) {
            e.preventDefault();
        });
        $has_submenu.hover(function () {
            var $t;
            $t = $(this);
            $has_submenu.removeClass('active');
            $t.addClass('active');
        }, function () {
            var $t;
            $t = $(this);
            $t.removeClass('active');
        });
        hide = function () {
            return $has_submenu.removeClass('active');
        };
        return $no_submenu.hover(hide);
    });
    
    /* BUDDYPRESS MOBILE ICON MENU */
    
    var adjustIconMenu = function () {
        var ww = document.body.clientWidth;
        $('#besocial-icon-menu-toggle').removeClass("active");
        if (ww <= 700) {
            $('#besocial-icon-menu').hide(); 
            
        } else if (ww > 700) {
            $('#besocial-icon-menu').show();
        }
    };

    /* MAIN MENU */

    var mobileMenu = function () {
        $('#header-menu').find(".besclwp-nav li a").each(function () {
            if ($(this).next().length > 0) {
                $(this).addClass("parent");
            }
        });
        $('#header-menu').find(".besclwp-toggle-menu").on('click', function (e) {
            e.preventDefault();
            $(this).toggleClass("active");
            $('#header-menu').find(".besclwp-nav").toggle();
        });
        $('#besocial-icon-menu-toggle').on('click', function (e) {
            e.preventDefault();
            $(this).toggleClass("active");
            $('#besocial-icon-menu').toggle();
        });
    };

    var adjustMenu = function () {
        var ww = document.body.clientWidth;
        if (ww <= 1170) {
            $('#header-menu').find(".besclwp-toggle-menu").css("display", "block");
            if (!$('#header-menu').find(".besclwp-toggle-menu").hasClass("active")) {
                $('#header-menu').find(".besclwp-nav").css("display", "none");
            } else {
                $('#header-menu').find(".besclwp-nav").css("display", "inline-block");
            }
            $('#header-menu').find(".besclwp-nav li").unbind('mouseenter mouseleave');
            $('#header-menu').find(".besclwp-nav li a.parent").unbind('click').on('click', function (e) {
                e.preventDefault();
                $(this).parent("li").toggleClass("hover");
            });
        } else if (ww > 1170) {
            $('#header-menu').find(".besclwp-toggle-menu").css("display", "none");
            $('#header-menu').find(".besclwp-nav").css("display", "inline-block");
            $('#header-menu').find(".besclwp-nav li").removeClass("hover");
            $('#header-menu').find(".besclwp-nav li a").unbind('click');
            $('#header-menu').find(".besclwp-nav li").unbind('mouseenter mouseleave').on('mouseenter mouseleave', function () {
                $(this).toggleClass('hover');
                $(this).toggleClass('activelink');
                $(this).find("ul").toggleClass('menudown');
            });
            $('#header-menu').find(".besclwp-nav ul").unbind('mouseenter mouseleave').on('mouseenter mouseleave', function () {
                $(this).toggleClass('hover');
                $(this).find("ul").toggleClass('menudown');
            });
        }
    };

    /* CUSTOM MENU WIDGET */
    $('#besocial-wrap').find(".widget_nav_menu > div > ul > li > a").on('click', function () {
        var nxt = $(this).next();
        if ((nxt.is('ul')) && (nxt.is(':visible'))) {
            nxt.slideUp(300);
            $(this).removeClass("besclwp-dropdown2").addClass("besclwp-dropdown");
        }
        if ((nxt.is('ul')) && (!nxt.is(':visible'))) {
            $('body').find('.widget_nav_menu > div ul ul:visible').slideUp(300);
            nxt.slideDown(100);
            $('body').find('.widget_nav_menu > div > ul > li:has(ul) > a').removeClass("besclwp-dropdown2").addClass("besclwp-dropdown");
            $(this).addClass("besclwp-dropdown2");
        }
        if (nxt.is('ul')) {
            return false;
        } else {
            return true;
        }
    });

    /* BUDDYPRESS SUB MENU */

    $("#besocial-bdpress-mobile").on('click', function (e) {
        "use strict";
        e.preventDefault();
        $("#besocial-submenu").find('li').not('#besocial-bdpress-mobile').slideToggle(200);
    });
    
    var adjustBdpressMenu = function () {
        var ww = document.body.clientWidth;
        if (ww <= 1170) {
          $("#besocial-submenu").find('li').not('#besocial-bdpress-mobile').hide();  
            
        } else if (ww > 1170) {
            $("#besocial-submenu").find('li').not('#besocial-bdpress-mobile').show();           
        }
    };
    
    /* BUDDYPRESS ID VALIDATION FIX */
    $(document).ready(function(){
        "use strict";
        $("body.besocial").find(".buddypress-holder").attr('id', 'buddypress');
    });

    /* SEARCH BAR */

    $('#besocial-header-right').on('click', function () {
        $('#besocial-search-bar').toggleClass("show-search-bar");
        $('#besocial-header-right').toggleClass("scroll-search-icon");
    });

    /* GO TO TOP */
    $('#besclwp-back-to-top-button').click(function (e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 500);
    });

    /* GO TO COMMENTS LINK */
    $("#besclwp-gotocomments").on('click', function (event) {
        event.preventDefault();
        $('body,html').animate({
            scrollTop: $("#besclwp_comments_block").offset().top - 20
        }, 500);
        return false;
    });
    $("#besclwp-gotoreply").on('click', function (event) {
        event.preventDefault();
        $('body,html').animate({
            scrollTop: $("#besclwp_comment_form").offset().top - 20
        }, 500);
        return false;
    });

    /* EVENTS */
    $(window).on('load', function () {
        $('#header-menu').css('pointer-events', 'auto');
        $('#besocial-content').find('.besclwp-format-gallery-carousel').removeClass('hide-on-load');
        if (location.hash == '#comments') {
            $("#besclwp-gotocomments").trigger("click");
        }
        if (location.hash == '#reply') {
            $("#besclwp-gotoreply").trigger("click");
        }
    });

    $(document).ready(function () {
        var besocial_loading = $('#besocial-loading-overlay');
        besocial_loading.addClass('transitionends');
        besocial_loading.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
            $('#besocial-loading-overlay').hide();
        });
        mobileMenu();
        adjustMenu();
        $('#besocial-content-inner').css('min-height', $(window).height() - 252);
        $('#besocial-wrap').find('.widget_nav_menu > div > ul > li:has(ul) > a').addClass("besclwp-dropdown");
        /* PAGE BACKGROUND IMAGE */
        if (document.getElementById('besocial-img-holder')) {
            var besocialbgimg = $("#besocial-img-holder").data('img');
            var besocialbgposition = $("#besocial-img-holder").data('position');
            $("body.besocial").addClass('has-bg-img'); 
            $("body.besocial").css('background-image', 'url("' + besocialbgimg + '")');
            $("body.besocial").css('background-position', besocialbgposition);
        }
    });

    $(window).on('resize orientationchange', function () {
        $('#besocial-content-inner').css('min-height', $(window).height() - 252);
        adjustMenu();
        adjustBdpressMenu();
        adjustIconMenu();
    });

})(jQuery);