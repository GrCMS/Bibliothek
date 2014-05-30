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
      
            commentMovie.controls.modalTrigger = null;
            commentMovie.vars.post_id = null;
            commentMovie.vars.post_title = null;
            commentMovie.vars.comment_id = null;
            commentMovie.vars.comment_content = null;
        },

        getCommentData: function() {

            //ajax call to get movie comment
            console.log("get comment: ");
            console.log("=============");
            console.log("post_id: " +  commentMovie.vars.post_id);
            console.log("comment_id: " + commentMovie.vars.comment_id);
            console.log("Rating: " + commentMovie.vars.comment_rating);
            console.log("Content: " + commentMovie.vars.comment_content);

            //success

            //set data:
            commentMovie.vars.comment_id = null;
            commentMovie.vars.comment_rating = null;
            commentMovie.vars.comment_content = null;

            if(commentMovie.vars.comment_id != null)
            {
                //comment exists
                if(commentMovie.vars.comment_rating != null)
                {
                    $(commentMovie.controls.commentRating).val(commentMovie.vars.comment_rating);
                }

                if(commentMovie.vars.comment_content != null)
                {
                    $(commentMovie.controls.commentContent).val(commentMovie.vars.comment_content);
                }
            }
        }

    };

    //event fired when modal dialog is beeing closed
    $(commentMovie.controls.modal).on('hidden.bs.modal', function(){

        //reset vars and fields
        commentMovie.resetModal();

    });

    //ajax call to send movie comments
    $.fn.commentMovieAjax = function() {

        if($.trim($(commentMovie.controls.commentContent).val()))
        {
            commentMovie.vars.comment_content =  $(commentMovie.controls.commentContent).val();
        }

        //set:
        commentMovie.vars.comment_rating = null;
        $(commentMovie.controls.modalAlert).text("not implemented...")
        .removeClass().addClass('alert alert-danger');
    
        console.log("sending comment: ");
        console.log("=================");
        console.log("Post_id: " + commentMovie.vars.post_id);
        console.log("Comment_id: " + commentMovie.vars.comment_id);
        console.log("Rating: " + commentMovie.vars.comment_rating);
        console.log("Content: " + commentMovie.vars.comment_content);
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