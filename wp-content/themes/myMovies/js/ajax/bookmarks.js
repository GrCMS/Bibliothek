(function($){

    $.fn.toggleBookmark = function() {

        $(this).click(function(){

            var post_id = $(this).attr("data-post_id");
            var trigger = $(this);

            $.ajax({
                type : "post",
                dataType : "json",
                url : myAjax.ajaxurl,
         
                data : {
         
                    action: "mm_bookmark", 
                    post_id : post_id
                },
         
                success: function(response) {
                            
                    $(trigger).children('i').toggleClass('ion-checkmark').toggleClass('ion-plus');
                    $('#bookmark_counter span').text(response.bookmarks_count);                   
                }
            });
        });   	
    }

    $(document).ready(function() {

        $(".mm_user_bookmark").each(function(){
            
            $(this).toggleBookmark();
        });        
    });

})(jQuery);


