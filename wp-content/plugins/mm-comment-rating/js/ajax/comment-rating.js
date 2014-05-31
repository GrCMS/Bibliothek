(function($) {
    		    		
    //helper object to handle the renting process
    var commentMovie = {

        controls: {

            commentSend : "#mm-comment-movie-ajax",
            commentOpen : ".mm-comment-movie",
            modalTitle : "#mm-comment-movie-modal-title",
            modalAlert : "#mm-comment-response-output",
            modal : "#mm-comment-movie-modal",
            commentRating: "#mm-comment-movie-rating",
            commentContent: "#mm-comment-movie-content",
            modalTrigger : null
        },

        vars : {
      
            post_id : null,
            comment_id: null,
            comment_rating: null,
            comment_content: null,
            post_title : null
        },

        resetModal: function() {

            $(commentMovie.controls.modalTitle).text("");
            $(commentMovie.controls.modalAlert).text("").removeClass();
            $(commentMovie.controls.commentRating + ' span').raty({score: 0});
            $(commentMovie.controls.commentContent).val('');
      
            commentMovie.controls.modalTrigger = null;
            commentMovie.vars.post_id = null;
            commentMovie.vars.post_title = null;
            commentMovie.vars.comment_id = null;
            commentMovie.vars.comment_content = null;
        },
        
        setRating: function(rating) {
            
            $(commentMovie.controls.commentRating + ' span').raty({
                score: rating,
                readOnly: false,
                halfShow: true,
                starOff: 'movie-off.png',
                starOn: 'movie-full.png',
                starHalf: 'movie-half.png',
                width: 150
            });
        },
        
        getCommentData: function() {

            //ajax call to get movie comment
            $.ajax({
                type : "POST",
                dataType : "json",
                url : myAjax.ajaxurl,
                data: {
                    
                    action: "mm_get_comment_movie", 
                    post_id : commentMovie.vars.post_id                    
                },

                success: function(data) {
                                        
                    if(data != null)
                    {
                        commentMovie.vars.comment_id = data.comment_id;
                        commentMovie.vars.comment_rating = data.comment_rating;
                        commentMovie.vars.comment_content = data.comment_content;
                    
                        if(commentMovie.vars.comment_id != null)
                        {
                            if(commentMovie.vars.comment_rating != null)
                            {
                                commentMovie.setRating(commentMovie.vars.comment_rating);
                            }
                            
                            if(commentMovie.vars.comment_content != null)
                            {
                                $(commentMovie.controls.commentContent).val(commentMovie.vars.comment_content);
                            }
                            
                        } else {
                         
                            commentMovie.setRating(0);
                        }
                    }
                },

                error: function(data) {

                }

            });
        }
    };

    //event fired when modal dialog is beeing closed
    $(commentMovie.controls.modal).on('hidden.bs.modal', function(){

        //reset vars and fields
        commentMovie.resetModal();
    });

    //ajax call to send movie comments
    $.fn.commentMovieAjax = function() {

        if($.trim($(commentMovie.controls.commentContent).val())) {
            
            commentMovie.vars.comment_content =  $(commentMovie.controls.commentContent).val();
        }
        
        if($(commentMovie.controls.commentRating + ' input[name=score]').val()) {
            
            if($(commentMovie.controls.commentRating + ' input[name=score]').val().length > 0);
            {
                commentMovie.vars.comment_rating = $(commentMovie.controls.commentRating + ' input[name=score]').val();
            }
        }
        
        if(commentMovie.vars.comment_rating != null && commentMovie.vars.post_id != null) {
            
            $.ajax({
                type : "POST",
                dataType : "json",
                url : myAjax.ajaxurl,
                data: {
                    
                    action: "mm_comment_movie", 
                    post_id : commentMovie.vars.post_id,   
                    comment_id: commentMovie.vars.comment_id,
                    comment_rating: commentMovie.vars.comment_rating,
                    comment_content: commentMovie.vars.comment_content
                },

                success: function(data) {
                    
                    $(commentMovie.controls.modalAlert).text("Thank you for rating: " + commentMovie.vars.post_title)
                    .removeClass().addClass('alert alert-success');
                },

                error: function(data) {
                    
                    $(commentMovie.controls.modalAlert).text("error occured.")
                    .removeClass().addClass('alert alert-danger');
                }

            });
            
        } else {
            
            $(commentMovie.controls.modalAlert).text("Please set a rating!")
            .removeClass().addClass('alert alert-danger');
        }
    };

    $(document).ready(function() {
    
        //append click function in order to open a modal dialog
        $(commentMovie.controls.commentOpen).live('click', function() {
            
            //get the event trigger and store it
            commentMovie.controls.modalTrigger = $(this);

            //get the post_id for the movie in order to rent it
            commentMovie.vars.post_id = $(this).attr('data-post_id');

            //get the post_title to show it in the head of the modal dialog
            commentMovie.vars.post_title = $(this).attr('data-post_title');

            //set modal dialog title
            $(commentMovie.controls.modalTitle).text(commentMovie.vars.post_title);

            commentMovie.getCommentData();
      
            //append click event (only if modal trigger was clicked) to send ajax call
            $(commentMovie.controls.commentSend).unbind().removeAttr('disabled').text("Bewerten");
      
            $(commentMovie.controls.commentSend).click(function(){

                //append comment function with ajax call
                $(this).commentMovieAjax();
            });
        });
    });

})(jQuery);