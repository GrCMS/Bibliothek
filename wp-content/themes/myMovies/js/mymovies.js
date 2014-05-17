(function($) {
$(window).resize(function(){
	refreshSlideControls();
})

$(window).load(function() {
    $('.flexslider').flexslider({
	    animation: "slide",
	    animationLoop: false,
	    itemWidth: 210,
	    itemMargin: 10,
	    minItems: 2,
	    maxItems: 5,
	    controlNav: false,
	    animationLoop: false,
	    prevText: "",
	    nextText: ""
    });
    
});

$(document).ready(function(){
	refreshSlideControls();
});

// Flexslider anpasungen
function refreshSlideControls(){
	var height = $('.flexslider img').height();
	$('.flex-direction-nav a').height(height);
	$('.flex-direction-nav a').css('margin-top', height*(-1));
	
}
})(jQuery);