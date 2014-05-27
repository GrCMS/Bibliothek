(function($) {
    
    //append click function to return movie
    $('.mm-return-movie').live('click', function(){
            
        var trigger = $(this);
        var toRemove = $(this).closest('li');
        var post_id = $(this).attr('data-post_id');
                   
        $.ajax({
    
            type : "POST",
            dataType : "json",
            url : myAjax.ajaxurl,
            data: {
                    
                action: "mm_return_movie", 
                post_id : post_id
            },

            success: function(data) {
                
                if(data.updated === 1)
                {
                    $(toRemove).animate({

                        opacity: 0

                    }, 250, function() {

                        if($(toRemove).isOnlyItem()) {

                        $(this).animate({

                                height: 0

                            }, 500, function() {

                                $(this).remove();

                            });
                        } else {

                            $(this).animate({

                                width: 0

                            }, 500, function() {

                                $(this).remove();

                            });
                        }
                    });
                }
                                
                $('#rentals_counter span').text(data.rentals_count);
            },

            error: function(data) {
                                        
            }
            
        });
        
    });
    
})(jQuery);