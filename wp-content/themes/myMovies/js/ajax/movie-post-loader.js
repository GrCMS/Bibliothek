(function($) {

    $(window).scroll(function() {

        //-0 if set to -100 the event will be fired 100px above the end of the document
        if($(window).scrollTop() + $(window).height() == $(document).height() -0) {
            
            var offset = 0;
            $('.a-litte-test').each(function(){
               
                offset++;
            });
            
            $.ajax({
                type : "post",
                dataType : "json",
                url : myAjax.ajaxurl,
         
                data : {
                    
                    action: "mm_movie_post_loader", 
                    offset : offset
                },
                success: function(response) {
                    
                    if(response.posts != null)
                    {
                        $.each(response.posts, function(index){
                       
                            $('#mm-all-movies-posts').append(response.posts[index]);
                        });
                    }
                }
            }); 
        }
        
    });

})(jQuery);


