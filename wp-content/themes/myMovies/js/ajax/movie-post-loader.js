(function($) {

    $(window).scroll(function() {

        //-0 if set to -100 the event will be fired 100px above the end of the document
        if($(window).scrollTop() + $(window).height() == $(document).height() -0) {
          
          //make ajax call
          console.log("load content...");
          
        }
    });

})(jQuery);


