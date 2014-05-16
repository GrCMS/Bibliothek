jQuery(document).ready( function() {

   jQuery(".mm_user_bookmark").click( function() {
      
      var post_id = jQuery(this).attr("data-post_id");
      var trigger = jQuery(this);
            
      jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         
         data : {
         
            action: "mm_bookmark", 
            post_id : post_id
         },
         success: function(response) {
            
            jQuery(trigger).toggleClass('bookmarked');
            console.log(response);
         }
      });   

   });

});


