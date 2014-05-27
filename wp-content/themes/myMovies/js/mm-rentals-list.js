(function( $ ) {

    $.fn.isOnlyItem = function() {

        var current_offset = $(this).offset();
        var next_offset = $(this).next().offset();
      	
      	if(next_offset)
      	{
            if(current_offset.top == next_offset.top)
            {
              return false;
            }
            else
            {
              return true;  
            }
        }

        return false;
    }
    
    function setSize() {
        
        var width = $('#mm-rentals').width();
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

        $('.mm-rentals-image').css('width', width_single);
    }
      
    $(window).resize(function(){

        setSize();

    });

    $(document).ready(function() {

        setSize();

    });
  
})(jQuery);