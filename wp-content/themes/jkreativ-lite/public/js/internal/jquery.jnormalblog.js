// Normal blog script for jkreativ
// License: GNU General Public License v2.0
// License URI: http://www.gnu.org/licenses/gpl-2.0.html
// Copyright (c) 2014 by Baliniz
// version: 1.0.1

(function($, PhotoSwipe) {
    "use strict";
    $.fn.jnormalblog = function(options) {

        options = $.extend({
            followlike: 0
        }, options);

        return $(this).each(function() {

            var blog_content_type = function() {
                // gallery
                if ($(".article-slider-wrapper").length) {
                    $(".article-slider-wrapper").each(function() {
                        $(".article-slider-wrapper").imagesLoaded(function() {

                            $(".article-slider-wrapper").removeClass('loading');
                            $(".article-image-slider").fadeIn();
                            create_fotorama();

                        });
                    });
                }

                // youtube
                if ($("[data-type='youtube']").length) {
                    $.type_video_youtube($("[data-type='youtube']"));
                }

                // youtube
                if ($("[data-type='vimeo']").length) {
                    $.type_video_vimeo($("[data-type='vimeo']"));
                }

                // sound cloud
                if ($("[data-type='soundcloud']").length) {
                    $.type_soundcloud($("[data-type='soundcloud']"));
                }
            };

            var create_fotorama = function() {
                $(".article-image-slider").fotorama({
                    allowfullscreen: false,
                    arrows: false,
                    width: '100%',
                    maxWidth: '100%'
                });
            };

            var followlike = function() {
                var topmargin = 42;
                if ($(".noheadermenu").length) topmargin = $(".headermenu").height();
                if ($(".horizontalnav").length) topmargin = $(".topnavigation").height();

                $(".article-share").jsharefollow({
                    topmargin: topmargin
                });
            };

            var blog_shortcode = function() {
                if ($("[data-toggle='tooltip']").length) $("[data-toggle='tooltip']").tooltip();
                if ($(".jrmap").length) $(".jrmap").jrmap();
                if ($(".skillgraph").length) $(".skillgraph").jskill();
            };

            var blog_photoswipe = function() {
                if ($(".photoswipe").length) {
                    var photoswipe = $('.photoswipe').photoSwipe({
                        slideshowDelay: 6000,
                        nextPreviousSlideSpeed: 400,
                        slideSpeed: 400,
                        captionAndToolbarOpacity: 1,
                        captionAndToolbarFlipPosition: true,
                        getImageSource: function(obj) {
                            return $(obj).attr('href');
                        },
                        getImageCaption: function(obj) {
                            return $(obj).find('img').attr('alt');
                        }
                    });
                }
            };

            blog_shortcode();
            blog_content_type();
            blog_photoswipe();

            $.bindComment();
            if (options.followlike === 1) {
                $(window).bind('load', followlike);
            }
        });
    };
})(jQuery, window.Code.PhotoSwipe);

(function($) {
    $(document).ready(function() {
        $(".mainpage").jnormalblog();
    });
})(jQuery);