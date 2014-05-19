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
    
    function setSize()
    {
        var width = $('#mm-watchlist').width();
        var padding = 10;
        
        if(width > 768)
        {
          var width_single = (width - (padding * 5 * 2)) / 5;          
        }
        else if(width > 500)
        {
          var width_single = (width - (padding * 3 * 2)) / 3;
        }
        else if(width > 300)
        {
          var width_single = (width - (padding * 2 * 2)) / 2; 
        }
        else
        {
          var width_single = (width - (padding * 2));
        }

        $('.mm-watchlist-image').css('width', width_single);
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
    
    $(window).resize(function(){

        setSize();
    });
    
    $(document).ready(function() {
        
        setSize();
        
        $('.mm-watchlist-item-wrapper').mouseenter(function(){
            
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
