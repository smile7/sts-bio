// Commont script for jkreativ
// License: GNU General Public License v2.0
// License URI: http://www.gnu.org/licenses/gpl-2.0.html
// Copyright (c) 2014 by Baliniz
// version: 1.0.1

(function($) {
    "use strict";

    /** reduced element **/
    $.jreducedtop = function() {
        var reducedelement = ['.headermenu', '.responsiveheader', '.topnavigation'];
        var ofset = 0;

        $(reducedelement).each(function() {
            var ele = $(this);
            if ($(ele).is(":visible")) {
                ofset -= $(ele).height();
            }
        });

        return ofset;
    };

    /** accordion page **/
    $.fn.jaccordionpage = function() {
        var element = $(this);
        var firstelement = $(".halfpagepanel", element).get(0);

        var initialize = function() {
            $(firstelement).addClass('active');
            $(".halfpagepanel-body").stop().slideUp("fast", function() {
                $(window).trigger('resize');
            });
            $(".halfpagepanel-body", firstelement).stop().slideDown("fast");
        };

        var collapseme = function(e) {
            var target = e.target;
            var targetelement = $(target).parent(".halfpagepanel");

            var slidetargetelement = function(target) {
                $(".halfpagepanel", element).removeClass('active');
                $(".halfpagepanel-body", element).stop().slideUp("fast");
                $(".halfpagepanel-body", target).stop().slideDown("fast");
                $(target).addClass('active');
            };

            if ($(targetelement).hasClass('active')) {
                var target = $(targetelement).next().length > 0 ? $(targetelement).next() : $(targetelement).prev();
                slidetargetelement(target);
            } else {
                slidetargetelement(targetelement);
            }
        };

        initialize();
        $(".halfpagepanel-header", element).bind('click', collapseme);
    };

    /** remove active header **/
    $.removeactiveheader = function(element) {
        if (element !== 'search') $("body").removeClass("opensearch");
        if (element !== 'topcart') $(".topcart").removeClass("active");
        if (element !== 'portfoliofilter') $(".portfoliofilter").removeClass('active');
        if (element !== 'blogfilter') $(".blogfilter").removeClass('active');
        if (element !== 'myaccount') $(".topaccount").removeClass('active');
    };


    /**** fullscreen ****/
    $.fn.fsfullheight = function(topelements) {
        var element = this;
        var calculateheight = function() {
            var wh = $(window).height();

            $(topelements).each(function() {
                var ele = $(this);
                if ($(ele).is(":visible")) {
                    wh -= $(ele).height();
                }
            });

            $(element).css({
                'height': wh
            });
        };

        $(window).bind('resize ready load', calculateheight);
    };

    /**** share function ****/

    $.youtube_parser = function(url) {
        var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
        var match = url.match(regExp);

        if (match && match[7].length == 11) {
            return match[7];
        } else {
            alert("Url Incorrect");
        }
    };

    $.vimeo_parser = function(url) {
        var regExp = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
        var match = url.match(regExp);

        if (match) {
            return match[2];
        } else {
            alert("not a vimeo url");
        }
    };

    $.type_video_youtube = function(ele, autoplay) {
        var youtube_id = $.youtube_parser($(ele).attr('data-src'));
        var autoplaystring = (autoplay === true) ? "autoplay=1&" : "";
        var iframe = '<iframe width="700" height="500" src="http://www.youtube.com/embed/' + youtube_id + '?' + autoplaystring + 'showinfo=0&theme=light&autohide=1&rel=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>';
        $('.video-container', ele).append(iframe);
    };

    $.type_video_vimeo = function(ele, autoplay) {
        var vimeo_id = $.vimeo_parser($(ele).attr('data-src'));
        var iframe = '<iframe src="http://player.vimeo.com/video/' + vimeo_id + '?title=0&byline=0&portrait=0" width="700" height="500" frameborder="0"></iframe>';
        $('.video-container', ele).append(iframe);
    };

    $.type_soundcloud = function(ele, autoplay) {
        var soundcloudurl = $(ele).attr('data-src');
        var iframe = '<iframe src="https://w.soundcloud.com/player/?url=' + encodeURIComponent(soundcloudurl) + '" width="700" height="500" frameborder="0"></iframe>';
        $('.video-container', ele).append(iframe);
    };

    $.get_image_container_size = function(img, container, nocrop) {
        var nh, nw, nt, nl;

        // clear image style first
        $(img).attr('style', '');
        var h = $(img).height();
        var w = $(img).width();

        if (h == 0) {
            h = img.height;
            w = img.width;
        }

        var r = (h / w).toFixed(2);
        var wh = $(container).height();
        var ww = $(container).width();
        var wr = wh / ww.toFixed(2);

        var resizeWidth = function() {
            nw = ww;
            nh = ww * r;
            nl = (ww - nw) / 2;
            nt = (wh - nh) / 2;

            return new Array(nh, nw, nl, nt);
        };

        var resizeHeight = function() {
            nw = wh / r;
            nh = wh;
            nl = (ww - nw) / 2;
            nt = (wh - nh) / 2;
            return new Array(nh, nw, nl, nt);
        };

        if (nocrop) {
            if (wr > r) {
                return (0 && r <= 1) ? resizeHeight() : resizeWidth();
            } else {
                return (0 && r > 1) ? resizeWidth() : resizeHeight();
            }
        } else {
            if (wr > r) {
                return (0 && r <= 1) ? resizeWidth() : resizeHeight();
            } else {
                return (0 && r > 1) ? resizeHeight() : resizeWidth();
            }
        }
    };


    $.portfolio_popup = function() {
        $(".ppopup li a").hoverIntent({
            over: function() {
                var parent = $(this).parent();
                var element = $(parent).find('.portfoliopopup');
                var offset = $(parent).position();
                var h = $(parent).height();
                var w = $(parent).width();

                $(element).css({
                    'display': 'block',
                    'left': offset.left - $(element).width() + (w / 2) - 2,
                    'top': h + 30
                }).animate({
                    'opacity': 1,
                    'top': h
                }, 300);
            },
            out: function() {
                var parent = $(this).parent();
                var element = $(parent).find('.portfoliopopup');
                var h = $(parent).height();
                $(element).animate({
                    'top': h + 30,
                    'opacity': 0
                }, 300, function() {
                    $(element).css({
                        'display': 'none',
                        'top': 0,
                        'left': 0,
                        'opacity': 0
                    });
                });
            },
            timeout: 250
        });

        if ($(".portfoliobottomnav").length) {
            $(".portfoliobottomnav  > div").hoverIntent({
                over: function() {
                    var element = $(this).find('.portfoliopopup');
                    var offset = $(this).position();
                    var h = $(this).height();
                    var w = $(this).width();

                    if ($(element).hasClass('leftpopup')) {
                        $(element).css({
                            'display': 'block',
                            'left': offset.left + 2,
                            'top': (h * -1) - 30
                        }).animate({
                            'opacity': 1,
                            'top': (h * -1)
                        }, 300);
                    } else {
                        $(element).css({
                            'display': 'block',
                            'left': offset.left - $(element).width() + (w / 2) - 2,
                            'top': (h * -1) - 30
                        }).animate({
                            'opacity': 1,
                            'top': (h * -1)
                        }, 300);
                    }
                },
                out: function() {
                    var element = $(this).find('.portfoliopopup');
                    var h = $(this).height();

                    $(element).animate({
                        'top': (h * -1) - 30,
                        'opacity': 0
                    }, 300, function() {
                        $(element).css({
                            'display': 'none',
                            'top': 0,
                            'left': 0,
                            'opacity': 0
                        });
                    });
                },
                timeout: 250
            });
        }
    };

    $.open_in_new_tab = function(url) {
        var win = window.open(url, '_blank');
        win.focus();
    };

    $.setuptop = function(animarr) {
        // setup item
        $(animarr).each(function(i) {
            var $item = $(this),
                t = parseInt($item.css('top'), 10) + ($item.height() / 2);
            $item.css({
                top: t + 'px',
                opacity: 0
            });
        });
    };


    $.shuffleitem = function(animarr) {
        var array = new Array();
        $(animarr).each(function(i) {
            array[i] = $(this);
        });

        // shuffle
        var copy = [],
            n = array.length,
            i;
        while (n) {
            i = Math.floor(Math.random() * array.length);
            if (i in array) {
                copy.push(array[i]);
                delete array[i];
                n--;
            }
        }

        return copy;
    };

    $.animate_hide = function(animation, container, animarr, callback) {
        var animationtimeout = 0;

        if (animation == "fade" || animation == "normal") {
            $(animarr).each(function() {
                $(this).animate({
                    "opacity": 0
                }, 800);
            });
            animationtimeout = 1000;
        } else if (animation == "seqfade" || animation == "upfade" || animation == "sequpfade") {
            $($(animarr).get().reverse()).each(function(i) {
                var element = $(this);
                setTimeout(function() {
                    $(element).show().animate({
                        "opacity": 0
                    }, 800);
                }, 100 + i * 50);
            });
            animationtimeout = 1000 + $(animarr).length * 50;
        } else if (animation == "randomfade" || animation == "randomupfade") {
            var shufflearray = $.shuffleitem(animarr);
            $(shufflearray).each(function(i) {
                var element = $(this);
                setTimeout(function() {
                    $(element).show().animate({
                        "opacity": 0
                    }, 800);
                }, 100 + i * 50);
            });
            animationtimeout = 1000 + $(animarr).length * 50;
        }

        setTimeout(function() {
            $(animarr).each(function() {
                $(this).remove();
            });
            callback.call();
        }, animationtimeout);
    };

    $.animate_load = function(animation, container, animarr, callback) {
        var animationtimeout = 0;

        // hide all element that not yet loaded
        $(animarr).each(function() {
            $(this).css({
                "opacity": 0
            });
        });

        if (animation == "normal") {
            $(animarr).each(function() {
                $(this).css({
                    "opacity": 1
                });
            });
            animationtimeout = 1000;
        } else if (animation == "fade") {
            $(animarr).each(function() {
                $(this).animate({
                    "opacity": 1
                }, 1000);
            });
            animationtimeout = 1000;
        } else if (animation == "seqfade") {
            $(animarr).each(function(i) {
                var element = $(this);
                setTimeout(function() {
                    $(element).show().animate({
                        "opacity": 1
                    }, 1000);
                }, 100 + i * 50);
            });
            animationtimeout = 500 + ($(animarr).length * 50);
        } else if (animation == "upfade") {
            $.setuptop(animarr);
            $(animarr).each(function(i) {
                var element = $(this);
                $(element).animate({
                    top: parseInt($(element).css('top'), 10) - ($(element).height() / 2),
                    opacity: 1
                }, 1500);
            });
            animationtimeout = 2000;
        } else if (animation == "sequpfade") {
            $.setuptop(animarr);
            $(animarr).each(function(i) {
                var element = $(this);
                setTimeout(function() {
                    $(element).animate({
                        top: parseInt($(element).css('top'), 10) - ($(element).height() / 2),
                        opacity: 1
                    }, 1000);
                }, 100 + i * 50);
            });
            animationtimeout = 500 + ($(animarr).length * 50);
        } else if (animation == "randomfade") {
            var shufflearray = $.shuffleitem(animarr);
            for (var i = 0; i < shufflearray.length; i++) {
                setTimeout(function() {
                    var element = shufflearray.pop();
                    $(element).animate({
                        "opacity": 1
                    }, 1000);
                }, 75 + i * 50);
            }
            animationtimeout = 500 + ($(animarr).length * 50);
        } else if (animation == "randomupfade") {
            var shufflearray = $.shuffleitem(animarr);
            $.setuptop();
            for (var i = 0; i < shufflearray.length; i++) {
                setTimeout(function() {
                    var element = shufflearray.pop();
                    $(element).animate({
                        top: parseInt($(element).css('top'), 10) - ($(element).height() / 2),
                        opacity: 1
                    }, 1000);
                }, 75 + i * 50);
            }
            animationtimeout = 500 + ($(animarr).length * 50);
        }

        setTimeout(function() {
            callback.call();
        }, (animationtimeout + 1000));
    };


    $.bindComment = function() {
        $(".replycomment").click(function() {
            var i = $(this).parents(".coment-box").parent();
            var f = $("#respond");
            var x = $("<div id='comment-box-reply'></div>");
            var t = $("<div id='temp-comment-holder' style='display:none;'></div>");
            var p = $("#comment_parent");
            var c = "data-comment-id";

            $(".closecommentform").removeClass('liststyle');
            $(".replycomment").show();
            $("#comment-box-reply").remove();

            if (!$("#temp-comment-holder").length) {
                t.insertBefore(f);
            }

            x.insertAfter($(i).find('.coment-box-inner')).append(f);
            p.val($(this).attr(c));

            $(this).hide();

            $(i).find(".closecommentform").addClass('liststyle').click(function() {
                f.insertAfter($("#temp-comment-holder"));
                $("#temp-comment-holder").remove();
                $("#comment-box-reply").remove();
                $(this).removeClass('liststyle');
                $(i).find('.replycomment').show();
                $("#comment_parent").val(0);
            });
        });
    };

    $.fn.jsharefollow = function(options) {

        options = $.extend({
            topmargin: 0
        }, options);

        return $(this).each(function() {
            var element = this;
            var parent = $(element).parents(".article-inner-wrapper");
            var posmeta = {};
            var addmargin = 15;

            var updateposmeta = function() {
                posmeta = {
                    scrollbegin: parent.offset().top - options.topmargin,
                    scrollstop: parent.offset().top - options.topmargin + parent.height() - $(element).outerHeight(true)
                };
            };

            var updateposition = function() {
                var scrollpos = $(window).scrollTop();
                if (scrollpos > posmeta.scrollbegin - addmargin && scrollpos < posmeta.scrollstop) {
                    var topposition = scrollpos - posmeta.scrollbegin + addmargin;
                    $(element).css({
                        'top': topposition
                    });
                } else if (scrollpos < posmeta.scrollbegin - addmargin) {
                    $(element).css({
                        'top': 0
                    });
                } else if (scrollpos > posmeta.scrollstop) {
                    $(element).css({
                        'top': parent.height() - $(element).outerHeight(true)
                    });
                }

            };

            updateposmeta();
            $(window).bind('scroll', updateposition);
            $(window).bind('resize', function() {
                updateposmeta();
                updateposition();
            });
        });
    };

    $.fn.jrmap = function() {
        return $(this).each(function() {
            var element = this;
            var content = $(element).find('.contenthidden').html();
            var options = {
                lat: $(element).data('lat'),
                lng: $(element).data('lng'),
                zoom: $(element).data('zoom'),
                ratio: $(element).data('ratio'),
                showpopup: $(element).data('showpopup'),
                title: $(element).data('title')
            };

            var mapresize = function() {
                var elewidth = $(element).width();
                $(element).height(elewidth * options.ratio);
            };

            var createmap = function() {

                var eleid = $(element).attr('id');
                var mapOptions = {
                    zoom: parseInt(options.zoom, 10),
                    center: new google.maps.LatLng(parseFloat(options.lat), parseFloat(options.lng)),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    zoomControl: false,
                    scaleControl: false,
                    panControl: false,
                    scrollwheel: false
                };
                var map = new google.maps.Map(document.getElementById(eleid), mapOptions);
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(parseFloat(options.lat), parseFloat(options.lng)),
                    map: map,
                    zIndex: 10,
                    title: options.title
                });


                if (options.showpopup === true) {

                    var contentString = '<div id="mapcontent">' +
                        '<h3>' + options.title + '</h3>' +
                        '<div id="bodyContent">' +
                        content +
                        '</div>' +
                        '</div>';

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString,
                        maxWidth: 300
                    });

                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map, marker);
                    });

                    setTimeout(function() {
                        infowindow.open(map, marker);
                    }, 5000);
                }

            };

            $(window).bind('resize', mapresize);
            mapresize();
            google.maps.event.addDomListener(window, 'load', createmap);
        });
    };

    $.fn.jskill = function() {
        return $(this).each(function() {
            var element = $(this);

            setTimeout(function() {
                element.waypoint(function(direction) {
                    var grapwrap = $(this).find('.graphwrap');

                    $(grapwrap).each(function(i) {
                        var ele = $(this);

                        setTimeout(function() {
                            var width = $(ele).find('.grapholder').attr('data-width') + '%';
                            $(ele).find('.grapholder').css('width', width);
                            $(ele).find('strong').css('opacity', 1);
                        }, 200 * i);
                    });
                }, {
                    offset: '80%',
                    triggerOnce: true,
                    context: window
                });
            }, 1000);
        });
    };


    $.fn.jfsvideo = function() {
        return $(this).each(function() {
            var element = this;

            if ($(element).data('type') === 'youtube') {
                $.type_video_youtube($("[data-type='youtube']"));
            }

            if ($("[data-type='vimeo']").length) {
                $.type_video_vimeo($("[data-type='vimeo']"));
            }

            if ($("[data-type='soundcloud']").length) {
                $.type_soundcloud($("[data-type='soundcloud']"));
            }
        });
    };

    $(document).ready(function(){
        /** Full screen **/
        if($(".fs-container").length) {
            $(".fs-container").fsfullheight(['.headermenu', '.responsiveheader', '.topnavigation', '.footercontent']);
        }
    });

})(jQuery);