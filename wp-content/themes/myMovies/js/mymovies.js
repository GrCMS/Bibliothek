(function($) {
    
    var $window = $(window),
      flexslider;
    
    function getGridSize() {
        
        return (window.innerWidth < 600) ? 2 :
           (window.innerWidth < 900) ? 3 : 4;
    }
    
    $window.resize(function() {
    
        var gridSize = getGridSize();
        console.log(gridSize);
        flexslider.vars.minItems = gridSize;
        flexslider.vars.maxItems = gridSize;
    });
    
    
    $(window).load(function() {
        
        $('.flexslider').flexslider({
            animation: "slide",
            animationLoop: false,
            itemWidth: 210,
            itemMargin: 10,
            minItems: getGridSize(),
            maxItems: getGridSize(),
            controlNav: true,
            directionNav: false,
            animationLoop: false,
            prevText: "",
            nextText: ""
        });
    });

})(jQuery);