(function($) {
    		    		
    //helper object to handle the renting process
    var rentMovie = {

        controls: {

            datepicker : "#mm-dp-rent-start.input-group.date",
            duration : "#mm-rent-duration-dropdown",
            rentSend : "#mm-rent-movie-ajax",
            rentOpen : ".mm-rent-movie",
            modalTitle : "#mm-rental-modal-title",
            modalAlert : "#mm-rental-response-output",
            returnDateOutput : "#mm-rent-return-date",
            modal : "#mm-rental-modal",
            modalTrigger : null
        },

        vars : {

            returnDate : null,
            startDate : null,
            post_id : null,
            post_title : null
        },

        resetModal: function() {
            
            $(rentMovie.controls.modalTitle).text("");
            $(rentMovie.controls.modalAlert).text("").removeClass();
            rentMovie.controls.modalTrigger = null;
            
            rentMovie.vars.returnDate = null;
            rentMovie.vars.post_id = null;
            rentMovie.vars.post_title = null;

            //re-init after reset;
            rentMovie.init();

        },

        init : function() {
            
            var currDate = new Date();
            $(rentMovie.controls.datepicker).datepicker('setDate', currDate).datepicker('fill');
            $(rentMovie.controls.datepicker).datepicker('setStartDate', currDate);
            $(rentMovie.controls.duration).val("5");
                  
            //set return date when modal loads
            rentMovie.setReturnDate();
          
        },

        setReturnDate : function() {

            var duration = null;
            var start = $(rentMovie.controls.datepicker).datepicker("getDate");

            //get selected value from duration dropdown
            switch($(rentMovie.controls.duration + ' :selected').val())
            {
                case '5': { 
              
                    duration = 5;
                    break;
                }
              
                case '7': {

                    duration = 7;
                    break;
                }

                case '10': {

                    duration = 10;
                    break;
                }

                case '14': {

                    duration = 14;
                    break;
                }

                default: {
                
                    //default duration value
                    duration = 5;
                    break;
                }
            }

            if(start != "Invalid Date")
            {
                //if start date from datepicker is valid then add duration
                var date = new Date();
                date.setDate(start.getDate() + duration);

                //set valid return date (format: YYYY-MM-DD)
                rentMovie.vars.returnDate = date.getFullYear() + "-" + (date.getMonth() +1) + "-" + date.getDate();
                rentMovie.vars.startDate = start.getFullYear() + "-" + (start.getMonth() +1) + "-" + start.getDate();

                //output the valid return date (format: DD.MM.YYYY)                            
                $(rentMovie.controls.returnDateOutput).text(date.getDate() + "." + (date.getMonth() +1) + "." + date.getFullYear() );
            }
            else
            {
                //start date not valid
                //set return date to null
                rentMovie.vars.returnDate = null;
                rentMovie.vars.startDate = null;
              
                //output default
                $(rentMovie.controls.returnDateOutput).text('dd.mm.yyyy');
            }
        }
};


    //event fired when modal dialog is beeing closed
    $(rentMovie.controls.modal).on('hidden.bs.modal', function(){

        //reset vars and fields
        rentMovie.resetModal();
    });

    //ajax call for movie rentals
    $.fn.rentMovieAjax = function() {

        //check if post_id, trigger and returnDate are correct
        //then make the ajax call to rent the movie with the id set
        //for the current user (current user will be set by service)
        //check return date before sending it
        rentMovie.setReturnDate();
        var rentSendButton = $(this);

        if(rentMovie.vars.post_id != null && 
            rentMovie.controls.modalTrigger != null && 
            rentMovie.vars.returnDate != null &&
            rentMovie.vars.startDate != null)
        {
                    
            $.ajax({
                type : "POST",
                dataType : "json",
                url : myAjax.ajaxurl,
                data: {
                    
                    action: "mm_rent_movie", 
                    post_id : rentMovie.vars.post_id,
                    start_date: rentMovie.vars.startDate,
                    return_date: rentMovie.vars.returnDate 
                },

                success: function(data) {
                    
                    $(rentMovie.controls.modalAlert).text("Thank you for renting: " + rentMovie.vars.post_title)
                    .removeClass().addClass('alert alert-success');
                    $(rentSendButton).text("rented").attr('disabled', 'disabled').unbind();
                    $(rentMovie.controls.modalTrigger).text("rented").attr('disabled', 'disabled').unbind();
                },

                error: function(data) {

                    //set error msg
                    $(rentMovie.controls.modalAlert).text("error occured")
                    .removeClass().addClass('alert alert-danger');

                }

            });
        } 
        else
        {
            $(rentMovie.controls.modalAlert).text("Please check your input!")
            .removeClass().addClass('alert alert-danger');
        }
    };

    $(document).ready(function() {

        //set default date format for datepicker
        $.fn.datepicker.defaults.format = "dd.mm.yyyy";

        //set hover effect for rent button, because css is not working
        $(rentMovie.controls.rentOpen).hover(function() {

            $(this).css('cursor', 'pointer');
            
        }, function() { 

            $(this).css('cursor', 'default');
        });

        //append click function in order to open a modal dialog
        $(rentMovie.controls.rentOpen).live('click', function(){
            
            //get the event trigger and store it
            rentMovie.controls.modalTrigger = $(this);

            //get the post_id for the movie in order to rent it
            rentMovie.vars.post_id = $(this).attr('data-post_id');

            //get the post_title to show it in the head of the modal dialog
            rentMovie.vars.post_title = $(this).attr('data-post_title');

            //set modal dialog title
            $(rentMovie.controls.modalTitle).text(rentMovie.vars.post_title);

            //append click event (only if modal trigger was clicked) to send ajax call
            $(rentMovie.controls.rentSend).unbind().removeAttr('disabled').text("rent");
            $(rentMovie.controls.rentSend).click(function(){
                
                //append rent function with ajax call
                $(this).rentMovieAjax(rentMovie.vars.post_id);
            });
        });
                
        //setup datepicker and add changeDate event
        $(rentMovie.controls.datepicker).datepicker({

            format: "dd.mm.yyyy",
            startDate: "now",
            autoclose: true,
            forceParse: true,
            todayHighlight: true

        }).on('changeDate', function() {

              //changeDate event for datepicker in order to
              //calculate and set the return date
              rentMovie.setReturnDate(); 
        });

        //append change event for duration dropdown in order to
        //calculate and set the return date
        $(rentMovie.controls.duration).change(function() {

            //change function for duration dropdown
            rentMovie.setReturnDate();
        });

        rentMovie.init();

    });

})(jQuery);