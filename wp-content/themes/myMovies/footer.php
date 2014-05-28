<!-- start footer.php -->
  
  </div><!-- end of mm-content-container -->

    <div id="mm-footer-container" class="container">

      <!-- no footer styles defined -->
      
    </div><!-- end of mm-footer-container -->

  </div><!-- end of mm-wrapper -->
  
  
  <!-- MODAL DIALOGS -->
  <!-- MODAL: mm-login-modal (triggerd in header.php) -->
  <div class="modal fade" id="mm-login-modal" tabindex="-1" role="dialog">
        
    <div class="modal-dialog">
      
        <div class="modal-content">
        
            <form role="form" autocomplete="off" action="<?php echo wp_login_url(get_permalink(get_page(163))); ?>" method="post">
            
                <div class="modal-header text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php __("Login", "myMovies"); ?></h4>
                </div>
                
                <div class="modal-body">
                
                    <div class="form-group">
                        <label class="sr-only" for="log"><?php __("User", "myMovies"); ?></label>
                        <input placeholder="User" class="form-control" type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>"/> 
                    </div>
                    
                    <div class="form-group">
                        <label class="sr-only" for="pwd"><?php __("Password", "myMovies"); ?></label>
                        <input placeholder="Password" class="form-control" type="password" name="pwd" id="pwd" size="22" /> 
                    </div>
                    
                    <div class="form-group">
                        <div class="checkbox text-left">
                            <label>
                                <input name="rememberme" type="checkbox" checked="checked" value="forever" /> <?php __("Remember me", "myMovies"); ?>
                            </label>
                        </div>
                    </div>
                    
                </div>
                
                <div class="modal-footer">
                    
                    <input class="btn btn-primary" type="submit" name="submit" value="Send" class="button" /><br>
                    <p class="padding-top-15"><?php __("Not a member yet?", "myMovies"); ?> <a href="<?php echo site_url() . '/login?action=register&source=modal'; ?>"><?php __("Sign up now!", "myMovies"); ?></a></p>
                </div>
        
            </form>
        
        </div>
    
    </div>

  </div><!-- end of mm-login-modal -->
  
  <!-- MODAL: mm-rental-modal (triggerd from rent button) -->
  <div class="modal fade" id="mm-rental-modal" tabindex="-1" role="dialog" aria-labelledby="mm-rental-modal-label" aria-hidden="true">
  		
    <div class="modal-dialog">
    		
        <div class="modal-content">
      			
            <div class="modal-header">
        			
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="mm-rental-modal-label"><?php __("Rent movie:", "myMovies"); ?> <span id="mm-rental-modal-title"></span></h4>
                
            </div>
      			
            <div class="modal-body">

                <div class="row">
            
                    <div class="col-xs-12">
              
                        <div id="mm-rental-response-output"></div>

                    </div>

                </div>

                <div class="row">
      					
                    <div class="col-xs-6">
							     
                        <label><?php __("Rent start:", "myMovies"); ?> </label>
                        <div id="mm-dp-rent-start" class="input-group date">
  								
                            <input type="text" data-date-format="dd.mm.yyyy" class="form-control"><span class="input-group-addon"><i class="ion-calendar"></i></span>
							
                        </div>

                    </div>

                    <div class="col-xs-6">
    							
                        <label><?php __("Duration", "myMovies"); ?></label>
                        <select class="form-control" id="mm-rent-duration-dropdown">
                            <option value="5"><?php __("5 days", "myMovies"); ?></option>
                            <option value="7"><?php __("7 days", "myMovies"); ?></option>
                            <option value="10"><?php __("10 days", "myMovies"); ?></option>
                            <option value="14"><?php __("14 days", "myMovies"); ?></option>
                        </select>

                    </div>

                </div>

                <div class="row">
						
                    <div class="col-xs-12 col-lg-offset-6 col-md-offset-6 col-sm-offset-6" style="line-height: 50px">

                            <label><?php __("Return date:", "myMovies"); ?></label>
                            <span id="mm-rent-return-date">dd.mm.yyyy</span>

                    </div>

                </div>

            </div>
      			
            <div class="modal-footer">
        			
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php __("Close", "myMovies"); ?></button>
                <button type="button" class="btn btn-primary" id="mm-rent-movie-ajax"><?php __("Rent", "myMovies"); ?></button>
      			
            </div>
            
        </div>
        
    </div>

  </div><!-- end of mm-rental-modal -->
  
  <!-- end of modal dialogs -->
        
  <!-- WORDPRESS SCRIPTS (JS) -->
  <?php wp_footer() ?>
  
  <script>

    //Register events fired for normal screens
    enquire.register("screen and (min-width:768px)", {

        match : function() {

            menu.settings.isMobile = false;
            menu.functions.reset_menu();
        }

    });

    //Register events fired for mobile devices
    enquire.register("screen and (max-width:767px)", {

        match : function() {
            menu.settings.isMobile = true;
            menu.functions.reset_menu();
        }

    });
    
    jQuery( document ).ready(function() {
        
        var gs = jQuery('#mm-menu-genre-slider-1').genreSlider("#mm-slider-container", true, 250);
        var gsm = jQuery('#mm-menu-genre-slider-2').genreSlider("#mm-slider-container-mobile", false, 250);
        
        menu.setup.init({complete:function(){
              
            //Callback function always called after any menu is closed
            gs.functions.reset();
            gsm.functions.reset();
        }});  
    });
    
  </script>
  
  </body>
</html>