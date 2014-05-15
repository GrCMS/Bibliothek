var menu = {

    triggers: {

        "search_m" : "#mm-header-search-trigger",
        "account_m" : "#mm-header-account-navigation-mobile-trigger",
        "account" : "#mm-header-account-navigation-trigger",
        "genreSlider" : "#mm-header-genre-slider-trigger",    		
    },
    	
    containers: {

        _all : {

            "search_m" : "#mm-mobile-search-col",
            "account_m" : "#mm-mobile-account-navigation-col",
            "account" : "#mm-account-navigation-wrapper",
            "genreSlider_m" : "#mm-mobile-genre-slider-col",
            "genreSlider" : "#mm-header-genre-slider-wrapper"
    	}
    },

    settings: {

        "isMobile" : false,
        "isMenuOpen" : false,
        "currentMenu" : null,
        "callback" : null
    },
    	
    setup: {

        init : function(f) {

            //console.log("Menu Setup: init() called");
            var _defaultArgs = { 

                complete:function() {}
            };

            menu.settings.callback = jQuery.extend( {}, _defaultArgs, f);
            
            if(typeof isAccount !== 'undefined')
            {
                if(menu.settings.isMobile)
                {
                    menu.functions.open_menu(menu.containers._all.account_m, false);
                }
                else
                {
                    menu.functions.open_menu(menu.containers._all.account, false);
                }
            }

            jQuery.each(menu.triggers, function(i, item) {

                jQuery(item).click(function(e){

                    menu.functions.trigger_clicked(item);
                });
            });
        }
    },

    animations: {

        _in: {

            slideDown : function(m) {

                var h = jQuery(m).height();

                jQuery(m).css('height', '0px');
                jQuery(m).css('display', 'block');

                jQuery(m).animate({

                    height : h

                }, 150, function(){

                    jQuery(m).css('height', 'auto');   
                });
            },

            fadeSlideUp : function(m) {

                var t = jQuery(m).css('top');

                jQuery(m).css('top', '35px');
                jQuery(m).css('opacity', '0');
                jQuery(m).css('display', 'block');

                jQuery(m).animate({

                    top: t,
                    opacity: 1

                }, 150, function(){
                       
                });
            }
        },

        _out: {

            slideUp : function(m) {

                jQuery(m).animate({

                    height: 0

                }, 150, function() {

                    jQuery(m).css('display', 'none');
                    jQuery(m).css('height', 'auto');
                    menu.settings.callback.complete();
                });
            },

            fadeSlideDown : function(m) {

                jQuery(m).animate({

                    top: '35px',
                    opacity: 0

                }, 150, function() {

                    jQuery(m).css('display', 'none');
                    jQuery(m).css('top', '10px');
                    menu.settings.callback.complete();
                });
            }
    	}
    },
    	
    functions: {

        trigger_clicked : function(t) {
    			
            //console.log("Trigger [" + t + "] clicked");
    			
            if(menu.settings.isMenuOpen) 
            {
                //close old menu
                var tmp = menu.settings.currentMenu;
                menu.functions.close_menu(menu.settings.currentMenu, true);

                //if not same menu open new
                if(tmp != menu.functions.getByTrigger(t))
                {	
                    //timeout is used to wait for other animations to finish
                    setTimeout(function() {

                        menu.functions.open_menu(menu.functions.getByTrigger(t), true);

                    }, 200)
                }
            }
            else
            {
                //open menu
                menu.functions.open_menu(menu.functions.getByTrigger(t), true);
            }
        },

        open_menu : function(m, animate) {

            //console.log("Opening menu: [" + m + "]");
            menu.settings.isMenuOpen = true;
            //console.log("Menu Settings changed - isMenuOpen: [" + menu.settings.isMenuOpen + "]");
            menu.settings.currentMenu = m;
            //console.log("Menu Settings changed - currentMenu: [" + menu.settings.currentMenu + "]");
    			
            if(animate == true)
            {
                menu.functions.animateIn(m);
            }
            else
            {
                jQuery(m).show();		
            }
        },

        close_menu : function(m, animate) {
            
            //console.log("Closing menu: [" + m + "]");
            menu.settings.isMenuOpen = false;
            //console.log("Menu Settings changed - isMenuOpen: [" + menu.settings.isMenuOpen + "]");
            menu.settings.currentMenu = null;
            //console.log("Menu Settings changed - currentMenu: [" + menu.settings.currentMenu + "]");

            if(animate == true)
            {
                menu.functions.animateOut(m);
            }
            else
            {
                jQuery(m).hide();
                menu.settings.callback.complete();
            }
        },

        getByTrigger : function(t) {
				
            switch(t)
            {
                case menu.triggers.search_m: { 

                    return menu.containers._all.search_m;
                }

                case menu.triggers.account_m: {

                    return menu.containers._all.account_m;
                }

                case menu.triggers.account: {

                    return menu.containers._all.account;
                }

                case menu.triggers.genreSlider: {

                    if(menu.settings.isMobile)
                    {
                        return menu.containers._all.genreSlider_m;
                    }

                    return menu.containers._all.genreSlider;
                }
            }
        },

        animateIn : function(m) {

            switch(m)
            {
                case menu.containers._all.search_m: {

                    menu.animations._in.slideDown(m);
                    break;
                }

                case menu.containers._all.account_m: {

                    menu.animations._in.slideDown(m);
                    break;
                }

                case menu.containers._all.account: {

                    menu.animations._in.slideDown(m);
                    break;
                }

                case menu.containers._all.genreSlider_m: {

                    menu.animations._in.slideDown(m);
                    break;
                }

                case menu.containers._all.genreSlider: {

                    menu.animations._in.fadeSlideUp(m);
                    break;
                }
            }

        },

        animateOut : function (m) {

            switch(m)
            {
                case menu.containers._all.search_m: {

                    menu.animations._out.slideUp(m);
                    break;
                }

                case menu.containers._all.account_m: {

                    menu.animations._out.slideUp(m);
                    break;
                }

                case menu.containers._all.account: {

                    menu.animations._out.slideUp(m);
                    break;
                }

                case menu.containers._all.genreSlider_m: {

                    menu.animations._out.slideUp(m)
                    break;
                }

                case menu.containers._all.genreSlider: {

                    menu.animations._out.fadeSlideDown(m);
                    break;
                }
            }
        },

        reset_menu : function() {

            //Close every menu and reset
            //console.log("CLOSE OPEN MENUS");
            if(menu.settings.isMenuOpen)
            {
                menu.functions.close_menu(menu.settings.currentMenu, false);
            }
        }
    }
};

jQuery(document).mouseup(function (e)
{
    if(menu.settings.isMenuOpen && !menu.settings.isMobile)
    {
        if(menu.settings.currentMenu == menu.containers._all.genreSlider)
        {
            var container = jQuery(menu.containers._all.genreSlider);
            var trigger = jQuery(menu.triggers.genreSlider)

            if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0 && !trigger.is(e.target)) // ... nor a descendant of the container
            {
                menu.functions.close_menu(menu.containers._all.genreSlider, true);
            }
        }
    }
});

    