jQuery(document).ready( function() {

   jQuery(".mm_user_bookmark").click( function() {
      
      var post_id = jQuery(this).attr("data-post_id");
      var trigger = jQuery(this);
      //var buttonvalue = jQuery(this).text();
            
      jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         
         data : {
         
            action: "mm_bookmark", 
            post_id : post_id
         },
         success: function(response) {
            if(jQuery(".mm_user_bookmark i").length !=0)
                jQuery(".mm_user_bookmark i").toggleClass('ion-checkmark').toggleClass('ion-plus');
            
            jQuery(trigger).toggleClass('bookmarked');
            jQuery('#bookmark_counter span').text(response.bookmarks_count);
                                   
         }
      });   

   });

});


