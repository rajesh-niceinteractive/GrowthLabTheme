jQuery(document).ready(function($) {
	jQuery('.testi-blk').owlCarousel({
        loop: true,
        touchDrag: true,
        mouseDrag: true,
        nav: true,
        dots: false,
        items: 2,
        margin: 0,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            1024: {
                items: 2
            },
        }
    });
});

jQuery(document).ready(function() {
    mobilesliders();
    jQuery(window).resize(mobilesliders);
 
    function mobilesliders() {
        if (jQuery(window).width() <= 1024) {
            jQuery('.hm-blog-blk').addClass('owl-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                touchDrag: false,
                items: 1,
                mouseDrag: false,
                nav: true,
                dots: false,
                margin: 20,
                autoHeight: true
            });
        } else {
            jQuery('.hm-blog-blk').trigger('destroy.owl.carousel').removeClass('owl-carousel');
        }
    }
});