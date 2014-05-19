(function( $ ) {

    function isOnlyItem(current) {

      var current_offset = $(current).offset();
      var next_offset = $(current).next().offset();

      if(current_offset.top === next_offset.top)
      {
        return false;
      }
      else
      {
        return true;  
      }
    }

    $('.mm-watchlist-icon-close').click(function() {

        var toRemove = $(this).closest('li');

        $(toRemove).animate({

           opacity: 0

        }, 250, function() {

            if(isOnlyItem(toRemove))
            {
              $(this).animate({
               
               height: 0
               
              }, 500, function() {

                $(this).remove();

              });
            }
            else
            {
              $(this).animate({
               
               width: 0
               
              }, 500, function() {

                $(this).remove();

              });
            }
        });
    });
    
    $(document).ready(function() {

        $('.mm-watchlist-item-wrapper').mouseenter(function(){
            
            console.log("HALLO!!!!");
            var overlay = $(this).children('.mm-watchlist-overlay');
          
            $(overlay).show();
            $(overlay).animate({

                height: 120,
                opacity: 0.75
                
            }, 250);

        });

        $('.mm-watchlist-item-wrapper').mouseleave(function() {

            var overlay = $(this).children('.mm-watchlist-overlay');
          
            $(overlay).animate({

                height: 0,
                opacity: 0

            }, 250, function(){

                $(this).hide();

            });          
        });
    });
      
})(jQuery);
