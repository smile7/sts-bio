// Masonry blog script for jkreativ
// License: GNU General Public License v2.0
// License URI: http://www.gnu.org/licenses/gpl-2.0.html
// Copyright (c) 2014 by Baliniz
// version: 1.0.1

(function($) {
    "use strict";
    $.fn.jmasonryblog = function(options) {

        options = $.extend({
            loadAnimation: 'randomfade', // normal | fade | seqfade | upfade | sequpfade | randomfade | randomupfade
        }, options);

        return $(this).each(function() {
            var element = $(this);
            var container = $(this).find('.isotopewrapper');
            var blogform = $(".bloginputfilter form");
            var loader = $('.blogloader');

            var get_blog_column_number = function() {
                var ww = $(window).width();
                if (ww < 640) return 1; // 380
                if (ww < 1100) return 2; // 380
                if (ww < 1500) return 3; // 580
                if (ww < 1700) return 4; // 525
                return 5;
            };

            var blog_resize = function() {
                $(container).addClass('no-transition');

                var elepadding = $(element).css('padding-left').replace("px", "");
                var blognumber = get_blog_column_number();
                var wrapperwidth = $(element).width() - elepadding;
                var itemwidth = Math.floor(wrapperwidth / blognumber) - 1;

                $(".article-masonry-container", container).width(itemwidth);
                $(container).removeClass('no-transition');
            };

            var loadmorerequest = function() {
                $(loader).fadeIn();

                // do ajax request
                $.ajax({
                    url: joption.adminurl,
                    type: "post",
                    dataType: "html",
                    data: $(blogform).serialize(),
                    success: function(data) {
                        $(".isotopewrapper .article-masonry-container", data).each(function(i) {
                            $(container).append(this);
                        });
                        $(".blogpagingwrapper").html($(".blogpagingwrapper", data));
                        $(container).masonry('destroy');

                        setTimeout(function() {
                            initialize_blog($(".pagedot").length);
                        }, 1000);
                    }
                });
            };

            var filterclicked = function(event) {
                var li = $(event.currentTarget);
                var parentul = $(li).parent();


                // active or not active link
                $("li", parentul).removeClass('active');
                $(li).addClass('active');

                $("[name='sort']", blogform).val($(li).data('sortby'));
                $("[name='paged']", blogform).val(1);

                // change name
                var sorttext = '';
                var filtertext = '';
                var sortfiltertext = '';
                var sorttitle = $(".blogsortul").data('title');
                var filtertitle = $(".blogfilterul").data('title');
                var sortactive = $(".blogsortul li.active");
                var filteractive = $(".blogfilterul li.active");

                if ($(sortactive).length > 0) {
                    sortfiltertext = sorttitle + " " + $(sortactive).text();
                }

                if ($(filteractive).length > 0) {
                    if ($(sortactive).length > 0) {
                        sortfiltertext += " & " + filtertitle + " " + $(filteractive).text();
                    } else {
                        sortfiltertext += filtertitle + " " + $(filteractive).text();
                    }
                }

                $(".blogfilterbutton").text(sortfiltertext);

                // 	blog filter width
                var blogfilterwidth = $(blogfilter).width();
                $(".blogfilterlist").css({
                    'min-width': blogfilterwidth
                });

                // hide portfolio paging
                $(".blogpagingwrapper").animate({
                    'opacity': 0
                }, "slow");
                $.animate_hide(options.loadAnimation, container, $(container).find('.article-masonry-container'), function() {
                    loadmorerequest();
                });
            };

            var blog_content_type = function() {

                // gallery
                if ($(".article-image-slider").length) {
                    $(".article-image-slider").fotorama({
                        allowfullscreen: 'native',
                        arrows: false,
                        width: '100%',
                        maxWidth: '100%',
                        aspectRatio: 1
                    });
                    $(".article-image-slider").on('fotorama:fullscreenexit', function() {
                        blog_resize();
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

            var initialize_blog = function(showpaging) {
                blog_resize();
                blog_content_type();

                $(container).imagesLoaded(function() {
                    $(container).masonry({
                        itemSelector: ".article-masonry-container"
                    });

                    $.animate_load(options.loadAnimation, container, $(container).find('.article-masonry-container'), function() {});

                    if (showpaging) {
                        $(".blogpagingwrapper").animate({
                            opacity: 1
                        }).removeClass('hideme');
                    }

                    $(loader).fadeOut();
                });
            };

            $(window).bind("resize", function(event) {
                blog_resize();
            });

            initialize_blog(true);
        });
    };
})(jQuery);

(function($){
    $(document).ready(function(){
        $(".blog-masonry-wrapper").jmasonryblog();
    });
})(jQuery);