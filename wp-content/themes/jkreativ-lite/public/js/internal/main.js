// License: GNU General Public License v2.0
// License URI: http://www.gnu.org/licenses/gpl-2.0.html
// Copyright (c) 2014 by Baliniz
// version: 1.0.1

(function($) {
    function dispatch() {
        /*************************
         * loading
         *************************/
        if ($("#loading").length) {
            if ($("#loading").data('type') === 'circle') {
                $.jpageload();
            } else {
                $.jpageloadlinear();
            }
        }

        /*************************
         * fix anything
         *************************/
        $(window).bind('load', function() {
            $(window).trigger('resize');
        });

        /**************************
         * header menu fade
         *************************/

        if ($(".headermenu").length) {

            var fadeheadermenu = function() {
                var scrollpos = $(window).scrollTop();
                if (scrollpos > 100) {
                    $(".headermenu").addClass('fademe');
                } else {
                    $(".headermenu").removeClass('fademe');
                }
            };

            $(window).bind('scroll', fadeheadermenu);
        }

        /**************************
         * Collapsible Navigation
         *************************/

        if ($(".sidebarcollapse").length) {
            var showcollapsiblemenu = function(e) {
                if (this == e.target) {
                    $("#leftsidebar").animate({
                        "left": 0
                    });

                    $(".csbwrapper").fadeOut();
                    $(".lefttop, .leftfooter").fadeIn();
                }
            };
            $(".csbwrapper, .csbhicon, .cbsheader").bind('click', showcollapsiblemenu);

            var hidecollapsiblemenu = function() {
                var leftpos = "-210px";
                if ($(window).width() <= 1024) leftpos = "-190px";

                $("#leftsidebar").animate({
                    "left": leftpos
                });
                $(".lefttop, .leftfooter").fadeOut(function() {
                    $(".csbwrapper").fadeIn();
                });
            };

            $(".sidebarcollapse #leftsidebar").hoverIntent({
                over: function() {},
                out: function() {
                    hidecollapsiblemenu();
                },
                timeout: 500
            });

            $(window).bind('resize', hidecollapsiblemenu);
        }

        /**************************
         * search function
         **************************/

        var toogle_search = function(event) {
            event.preventDefault();
            if ($("body").hasClass('opensearch')) {
                $("body").removeClass('opensearch');
            } else {
                $.removeactiveheader('search');
                $("body").addClass('opensearch');
                $(".searchcontent input").focus();
            }
        };

        $(".searchheader, .topnavigationsearch").bind('click', toogle_search);
        $(".closesearch").bind('click', toogle_search);
        $(".searchcontent input").width($("#rightsidecontainer").width() - 70);


        /**************************
         * horizontal menu
         **************************/

        $(".navcontent li").hoverIntent({
            over: function() {
                var parent = $(this);
                var childmenu = $(this).find('> .childmenu');
                if ($(childmenu).length) {
                    $(childmenu).css("margin-left", ($(parent).width() - $(childmenu).width()) / 2);
                    $(parent).addClass("menudown");
                    $(childmenu).slideDown("fast");
                }
            },
            out: function() {
                var parent = $(this);
                var childmenu = $(this).find('> .childmenu');
                if ($(childmenu).length) {
                    $(childmenu).slideUp("fast", function() {
                        $(parent).removeClass("menudown");
                    });
                }
            },
            timeout: 300
        });

        /**************************
         * menu
         **************************/

        $(".mainnav li").bind('click', function(e) {
            var element = $(e.target).parents('li').get(0);

            if (e.currentTarget === element) {
                if ($(element).find("> .childmenu").length) {
                    e.preventDefault();
                    $(element).siblings().each(function() {
                        $(this).removeClass("menudown")
                            .find('> .childmenu')
                            .slideUp("fast");
                    });

                    if ($(element).hasClass("menudown")) {
                        $(element).removeClass("menudown")
                            .find('> .childmenu')
                            .slideUp("fast", function() {
                                $(window).trigger('navchange');
                            });
                    } else {
                        $(element).addClass("menudown")
                            .find('> .childmenu')
                            .slideDown("fast", function() {
                                $(window).trigger('navchange');
                            });
                    }
                } else {
                    return true;
                }
            }
        });


        $(".childmenu").each(function() {
            var element = $(this).prev();
            $(element).append('<span class="arrow"></span>');
        });

        /**************************
         * navigation scroll
         **************************/

        if (!$('body').hasClass('horizontalnav')) {
            $('.lefttop').jScrollPane({
                mouseWheelSpeed: 50,
                contentWidth: '0px'
            });
            var navscrolpane = $('.lefttop').data('jsp');

            var calculate_lefttop = function() {
                var ww = $(window).height();
                var leftfooterheight = $(".leftfooter").height();
                var lefttopheight = ww - leftfooterheight;
                $(".lefttop").height(lefttopheight);
                navscrolpane.reinitialise();
            };

            $(window).bind('resize navchange', calculate_lefttop);
            calculate_lefttop();
        }

        /**************************
         * mobile menu
         **************************/
        var mobilemenu = function(element) {
            var role = "main-mobile-menu";
            $(".mobile-menu-trigger").removeClass('active');

            if ($('body').hasClass('menuopen')) {
                $('body').removeClass('menuopen').attr('role', '');
                $(".contentoverflow").hide();
            } else {
                $(element).addClass('active');
                $('body').addClass('menuopen').attr('role', role);
                $(".contentoverflow").show();
            }
        };

        $(".mobile-menu-trigger").bind('click', function() {
            mobilemenu(this);
        });
        $(".contentoverflow").bind('click', function() {
            mobilemenu(null);
        });

        /**************************
         * mobile search
         **************************/

        $(".mobile-search-trigger").bind('click', function() {
            $(".mobilesearch").show();
            $(".mobilesearch input").focus();
        });
        $(".closemobilesearch").bind('click', function() {
            $(".mobilesearch").hide();
        });


        /**************************
         * Cart Open
         *************************/
        var cartelement = $(".topcart > a");
        var cartclicked = function(event) {
            var cartparent = $(cartelement).parent(".topcart");
            if ($(cartparent).hasClass('active')) {
                $(cartparent).removeClass('active');
            } else {
                $.removeactiveheader('topcart');
                $(cartparent).addClass('active');
            }
        };

        $(cartelement).bind('click', function(e) {
            e.preventDefault();
            if (e.target !== this) return;
            cartclicked(e);
        });

        /**************************
         * My Account Open
         *************************/
        var myaccelement = $(".topaccount > a");
        var myaccclicked = function(event) {
            var myaccparent = $(myaccelement).parent(".topaccount");
            if ($(myaccparent).hasClass('active')) {
                $(myaccparent).removeClass('active');
            } else {
                $.removeactiveheader('myaccount');
                $(myaccparent).addClass('active');
            }
        };

        $(myaccelement).bind('click', function(e) {
            e.preventDefault();
            myaccclicked(e);
        });

        /**************************
         * sidebar follow
         *************************/

        if ($(".mainsidebar-wrapper").length) {
            var sidebar = $(".mainsidebar-wrapper");
            var parentsidebar = $(".mainsidebar");
            var additionalclass = "fixedelement";
            var parentpos, sidebarheight, sidebarwidth, wh, ww, sidebarmode, headermenuheight;
            var margin = 15;
            var bottommargin = 0;
            var enabled = true;
            var resizetimeout = null;

            if ($('body').hasClass('noheadermenu')) {
                headermenuheight = 0;
            } else if ($('body').hasClass('horizontalnav')) {
                headermenuheight = $(".topnavigation").height();
                bottommargin = $(".footercontent").height();
            } else {
                headermenuheight = $(".headermenu").height();
            }

            var setupsidebar = function() {
                parentpos = $(parentsidebar).offset().top;
                sidebarheight = $(sidebar).height();
                sidebarwidth = $(sidebar).attr('style', '').css({
                    'position': 'relative'
                }).width();
                $(sidebar).width(sidebarwidth);

                wh = $(window).height();
                ww = $(window).width();

                if ((sidebarheight + margin + headermenuheight) < wh) {
                    sidebarmode = 'sticktop';
                } else {
                    sidebarmode = 'stickbottom';
                }

                if (sidebarheight > $('.mainpage').height()) {
                    enabled = false;
                }
            };

            var followsidebar = function() {
                if (ww > 1152 && enabled) {
                    var scrolltop = $(window).scrollTop();

                    if (sidebarmode === 'stickbottom') {
                        var sidebarpos = (scrolltop + wh) - sidebarheight - parentpos - bottommargin;

                        if (sidebarpos > 0) {
                            $(sidebar).css({
                                'top': -(sidebarheight + bottommargin - wh),
                                'position': 'fixed'
                            }).addClass('fixedelement');
                        } else {
                            $(sidebar).css({
                                'top': 0,
                                'position': 'relative'
                            }).removeClass('fixedelement');
                        }
                    } else {
                        var sidebarpos = (scrolltop + headermenuheight + margin) - parentpos;

                        if (sidebarpos > 0) {
                            $(sidebar).css({
                                'top': margin + headermenuheight,
                                'position': 'fixed'
                            }).addClass('fixedelement');
                        } else {
                            $(sidebar).css({
                                'top': 0,
                                'position': 'relative'
                            }).removeClass('fixedelement');
                        }
                    }
                } else {
                    $(sidebar).css({
                        'top': 0,
                        'position': 'relative'
                    });
                }
            };

            $(window).bind('load ready', function() {
                setupsidebar();
                followsidebar();
            });

            $(window).bind('resize', function() {
                setupsidebar();
                followsidebar();
            });

            $(window).bind('scroll', followsidebar);
        }
    }


    // document ready to dispatch
    $(document).ready(dispatch);

})(jQuery);