(function($) {

    $(window).scroll(function() {

        //-0 if set to -100 the event will be fired 100px above the end of the document
        if($(window).scrollTop() + $(window).height() == $(document).height() -0) {
          
            $.ajax({
                type : "post",
                dataType : "json",
                url : myAjax.ajaxurl,
         
                data : {
                    
                    action: "mm_movie_post_loader", 
                    post_id : '10'
                },
                success: function(response) {
            
                    console.log(response.p);
                }
            }); 
        }
        
    });

})(jQuery);


