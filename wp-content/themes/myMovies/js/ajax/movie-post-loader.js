(function($) {

    var page = 1;
    var loading = true;
    var $window = $(window);
    var $content = $('#mm-all-movies-posts');
    var $loading_container = $('#mm-all-movies-posts-loading');
    
    var load_posts = function(){
            $.ajax({
                type       : "GET",
                dataType   : "html",
                url        : myAjax.ajaxurl,
                
                data       : {
                                action: "mm_movie_post_loader", 
                                numPosts : 6, 
                                pageNumber: page
                            },
                
                beforeSend : function(){
                    
                },
                
                success    : function(data){
                    
                    $data = $(data);
                    $data.hide();
                    $content.append($data);
                    $data.fadeIn(500, function() {
                        loading = false;
                    });
                },
                
                error     : function(jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
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


