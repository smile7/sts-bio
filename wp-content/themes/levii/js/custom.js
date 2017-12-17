/**
 * Levii Theme Custom Functionality
 *
 */
( function( $ ) {
    
    jQuery( document ).ready( function() {
        
        // Search Show / Hide
        $(".search-block").toggle(function(){
            $(".site-header-search").show().animate( { right: '+=5' }, 200 );
            $(".site-header-search .search-field").focus();
        },function(){
            $(".site-header-search").animate( { right: '-=5' }, 200 ).hide();
        });
        
        // Scroll To Top Button Functionality
        $(".scroll-to-top").bind("click", function() {
            $('html, body').animate( { scrollTop: 0 }, 800 );
        });
        $(window).scroll(function(){
            if ($(this).scrollTop() > 400) {
                $('.scroll-to-top').fadeIn();
            } else {
                $('.scroll-to-top').fadeOut();
            }
        });
		
    });
    
    $(window).resize(function () {
        
        
        
    }).resize();
    
    $(window).load(function() {
        
        levii_blog_list_carousel();
        
    });
    
    function levii_blog_list_carousel() {
        $(".post-loop-images-carousel-wrapper").each(function(c) {
            var this_blog_carousel = $(this);
            var this_blog_carousel_id = 'post-loop-images-carousel-id-'+c;
            this_blog_carousel.attr('id', this_blog_carousel_id);
            $('#'+this_blog_carousel_id+' .post-loop-images-carousel').carouFredSel({
                responsive: true,
                circular: false,
                width: 580,
                height: "variable",
                items: {
                    visible: 1,
                    width: 580,
                    height: 'variable'
                },
                onCreate: function(items) {
                    $('#'+this_blog_carousel_id).removeClass('post-loop-images-carousel-wrapper-remove');
                    $('#'+this_blog_carousel_id+' .post-loop-images-carousel').removeClass('post-loop-images-carousel-remove');
                },
                scroll: 500,
                auto: false,
                prev: '#'+this_blog_carousel_id+' .post-loop-images-prev',
                next: '#'+this_blog_carousel_id+' .post-loop-images-next'
            });
        });
    }
} )( jQuery );