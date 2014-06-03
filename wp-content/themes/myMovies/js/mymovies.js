(function($) {
    
    var flexslider;
                               
    $(window).load(function() {
        
         $('.flexslider').flexslider({
            animation: "slide",
            animationLoop: true,
            itemWidth: 200,
            itemMargin: 10,
            controlNav: true,
            directionNav: false,
            minItems: 1,
            maxItems: 0,
            move: 3,
            slideshowSpeed: 4000,
            start: function(slider) {
                
                flexslider = slider;
            }
        });
    });
    
    $(window).resize(function() {
        
        $('.flexslider').flexslider(0);
    });
                    
})(jQuery);