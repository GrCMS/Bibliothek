(function($) {

	$.fn.genreSlider = function(container, animate, d, args) {
	
		var gs = {

			selectors: {

		      "container" : null,
		      "root" : null
		    },

		    templates: {

		    	"back" : "<li class='mm-back'><a href='#'>Back</a></li>",
		    },

		    cs: {
    
		      	"back" : "mm-back",
      			"sub" : "sub",
      			"has" : "has"
    		},

    		settings: {

    			"active" : null,
    			"callbacks" : null,
    			"duration" : null
    		},

    		setup: {

				init : function(container, menu, animate, d, args)
				{
					gs.settings.callbacks = $.extend( {}, _defaultArgs, args);
					gs.settings.active = null;
					gs.settings.duration = d;
					gs.selectors.container = container;
					gs.selectors.root = "#" + $(menu).attr('id');

        			//prepend back button with click funtion to each ul with class 'sub'
        			$(gs.selectors.root + " ." + gs.cs.sub).prepend($(gs.templates.back).click(function(e) {
          
          				//back button click function => show parent menu
          				gs.functions.show_parent(this, animate);
          
          				//stop the event bubbling
          				e.stopPropagation();
          
        			}));

        			//delegate used to bind the click event to multiple items
        			//click event for each li with the class 'has' and its direct children (a-tag and span)
       				$(gs.selectors.root).delegate("li.has, li.has > a, li.has > span", "click", function(e) {

	       				//check target to be sure its not the parent li
	        			if(e.target === this)
	          			{
				        	//THIS: 'li.has', 'li.has a' or 'li.has span'
				        	var li = null;
				        
				        	if($(this).not('li.has').length > 0)
				        	{
				          		li = $(this).parent('li');                  
				        	}
				        	else
				        	{
				          		li = $(this);
				        	}
            	
            				//li with sub menu click function => show sub menu
            				gs.functions.show_sub(li, animate);  
          				}

          				//stop the event bubbling
          				e.stopPropagation();

       				});
				}
			},

			functions: {

				show_sub : function(clicked, animate) {

					//the ul currently shown
        			var currentUl = $(clicked).parent('ul');
        
			        //the sub ul to be shown
			        var childrenUl = $(clicked).children('ul');

        			if(animate)
        			{
	        			//start slideOut animation with duration and wait for completion
	        			gs.animations.slideOut(currentUl, childrenUl, gs.settings.duration, {complete:function() {
				
							//animation completed => hide current menu => show sub menu
							gs.functions._show_sub_helper(currentUl, clicked);
							gs.settings.callbacks.ShowDone();
	        			
	        			}});
	    			}
	    			else
	    			{
	    				//hide current menu => show sub menu
	    				gs.functions._show_sub_helper(currentUl, clicked);
	    				gs.settings.callbacks.ShowDone();
	    			}

        			gs.settings.active = childrenUl;
				},

				_show_sub_helper: function(currentUl, clicked) {

					//loop through every li shown and hide them 
					//except for the li containing the sub menu                                     
    				$(currentUl).children('li').each(function(i, o) {

	    				//if not the li containing the sub menu
	        			if(!$(this).is($(clicked)))
	        			{
	          				$(this).hide();
	        			}
	        			else
	        			{
	        				//li containing sub menu, li must not be hidden
	        				//if this li would be hidden the sub menu would be hidden too
	        				//hide the a-tag instead
	          				$(this).children('a').hide();
	        		
	        				//show sub menu
	          				$(this).children('ul').children('li').each(function(i, o) {

	            				$(this).show();
	          				});
	        			}
      				});
				},

				show_parent : function (clicked, animate) {

					//the ul currently shown
        			var currentUl = $(clicked).parent('ul');
        
        			//the parent li (li with class 'has') containing the hidden a-tag
        			var parentLi = $(clicked).parent('ul').parent('li');
                
        			//the parent ul to be shown
        			var parentUl = $(parentLi).parent('ul');

        			if(animate)
        			{
	        			//start slideIn animation with duration and wait for completion
	        			gs.animations.slideIn(currentUl, parentUl, gs.settings.duration, {complete:function() {

	        				//animation completed => hide current menu => show parent menu
	        				gs.functions._show_parent_helper(currentUl, parentLi, parentUl);
	        				gs.settings.callbacks.ShowDone();

	        			}});
	    			}
	    			else
	    			{
	    				//hide current menu => show parent menu
	    				gs.functions._show_parent_helper(currentUl, parentLi, parentUl);
	    				gs.settings.callbacks.ShowDone();
	    			}

        			gs.settings.active = parentUl;
				},

				_show_parent_helper:function(currentUl, parentLi, parentUl) {

					//loop through every li shown (in sub) and hide them     
	    			$(currentUl).children('li').each(function() {

	       				$(this).hide();
	    			});

	    			//show the a-tag in parent menu
	    			$(parentLi).children('a').show();

    				//show the parents li's 
      				$(parentUl).children('li').each(function() {

        				$(this).show();
      				});
				},

				reset:function() {

					//get currently active sub ul
      				var activeUl = gs.settings.active;
      	
      				//check if not null, is null if user has not clicked anything
      				if(activeUl != null)
      				{
      					//stop recursion if root element is reached
      					//call reset again if root is not reached
      					if(!$(activeUl).is($(gs.selectors.root)))
      					{
							var back = $(activeUl).children('li.mm-back');
							gs.functions.show_parent(back, false);
							gs.functions.reset();
						}
					}
				}
			},

			animations: {

      			slideOut:function(sOut, sIn, d, f) {

        			//create a clone from sOut for animation
        			var outClone = $(sOut).clone();
        			$(outClone).appendTo(gs.selectors.container);
        			$(outClone).css('position', 'absolute');
                                
        			//clone created, hide original
        			//show original again after animation
        			$(sOut).hide();

        			//create a clone from sIn for animation
        			var inClone = $(sIn).clone();
       				 $(inClone).appendTo(gs.selectors.container);

        			//remove 'sub' class from clone in order to show the li's
        			$(inClone).removeClass(gs.cs.sub);

        			//show clone's children for the case that they are hidden
        			$(inClone).children('li').each(function(){

            			$(this).show();
        			});

        			//needs to be hidden while sOut animation is running
        			$(inClone).hide();

        			//sOut animation (left and fade)
        			$(outClone).animate({

         			left: -200,
          			opacity: 0

        			}, {

          				duration:d,
          	
          				complete:function(){

            				//remove the sOut clone from DOM
            				$(outClone).remove();
          				}

        			});

        			//timeout needed in order to start the sIn animation
        			//in the middle of the sOut animation (duration/2)
        			setTimeout(function(){

	        			//set the position from where the clone should slide in
	       				$(inClone).css('left', '200px');
	          	
	          			//set opacity to 0, so that the display none could be removed
	          			$(inClone).css('opacity', '0');
	          	
	          			//remove display none in order to animate the element
	          			//its still hidden due to opacity
	          			$(inClone).show();

          				//sIn animation (right in fade)
          				$(inClone).animate({

            				left: 0,
            				opacity: 1

	          			},{

            				duration:d,

			            	complete:function(){

			              		//remove clone from DOM
			              		$(inClone).remove();
			              
			              		//show original again
			              		$(sOut).show();

			              		//callback function fired => animation completed
			              		f.complete();
			            	}
          				});

        			}, d/2);
      			},

      			slideIn:function(sOut, sIn, d, f) {

        			//create a clone from sOut for animation
			        var outClone = $(sOut).clone();
			        $(outClone).appendTo(gs.selectors.container);
			        $(outClone).css('position', 'absolute');
                                
			        //clone created, hide original
			        //show original again after animation
			        $(sOut).hide();

			        //create a clone from sIn for animation
			        var inClone = $(sIn).clone();
			        $(inClone).appendTo(gs.selectors.container);
			        
			        //remove 'sub' class from clone in order to show the li's
			        $(inClone).removeClass(gs.cs.sub);

			        //show clone's children for the case that they are hidden
			        $(inClone).children('li').each(function(){

			        	//if li has clas 'has' remove display none from a-tag
			        	//in order to show the link in parent list
			            if($(this).has(gs.cs.has))
			            {
			              $(this).children('a').show();
			            }
			            
			            $(this).show();
        			});

        			//needs to be hidden while sOut animation is running
        			$(inClone).hide();

        			//sOut animation (right out and fade) from left:0 to left:200
        			$(outClone).animate({

          				left: 200,
          				opacity: 0

        			}, {

        				duration:d,

          				complete:function(){

            				//remove the sOut clone from DOM
            				$(outClone).remove();
          				}

        			});

        			//timeout needed in order to start the sIn animation
        			//in the middle of the sOut animation (duration/2)
        			setTimeout(function(){

        				//set the position from where the clone should slide in (left in)
          				$(inClone).css('left', '-200px');

          				//set opacity to 0, so that the display none could be removed
          				$(inClone).css('opacity', '0');
          	
						//remove display none in order to animate the element
          				//its still hidden due to opacity
          				$(inClone).show();

          				//sIn animation (left in fade)
          				$(inClone).animate({

            				left: 0,
            				opacity: 1

          				}, {

            				duration:d,
            
            				complete:function(){

              					//remove clone from DOM
              					$(inClone).remove();
              
              					//show original again
              					$(sOut).show();

              					//callback function fired => animation completed
              					f.complete();
            				}
          				});

        			}, d/2);
      			}
    		}
		};

		gs.setup.init(container, this, animate, d, args);
		return gs;
	};
	
	/*

	default arguments objects (default callbacks)
	
	*/

	var _defaultArgs = { 

		ShowDone:function() {}
	};

})(jQuery);




