(function($) {

    var page = 1;
    var loading = true;
    var $window = $(window);
    var $content = $('#mm-movies-posts');
    var $loading_container = $('#mm-movie-ajax-loading');
    var args = $.parseJSON($('#mm_query_args').val());
    
    $loading_container.hide();
    
    var load_posts = function(){
            $.ajax({
                type       : "GET",
                dataType   : "html",
                url        : myAjax.ajaxurl,
                
                data       : {
                                action: "mm_movie_post_loader", 
                                numPosts : 6, 
                                pageNumber: page,
                                args: args
                            },
                
                beforeSend : function(){
                    
                    if(page != 1)
                    {
                        $loading_container.show();
                    }
                },
                
                success    : function(data){
                                                                                
                    $data = $(data);
                    if($data.length) {
                        
                        $data.hide();
                        $content.append($data);
                        $data.fadeIn(500, function() {
                            
                            $loading_container.hide();
                            loading = false;
                            
                            //very unsexy...
                            $('.mm_user_bookmark').each(function(){
                            
                                $(this).unbind();
                                $(this).toggleBookmark();
                            });
                                                    
                        });
                    }
                    else {
                    
                        $loading_container.hide();
                    }
                },
                
                error     : function(jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                    $loading_container.hide();
                }
        });
    }
    
    $window.scroll(function() {
        var content_offset = $content.offset(); 
        if(!loading && ($window.scrollTop() + 
            $window.height()) > ($content.scrollTop() +
            $content.height() + content_offset.top)) {
                loading = true;
                page++;
                load_posts();
        }
    });
            
    load_posts();

})(jQuery);


