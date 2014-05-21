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
                    <h4 class="modal-title" id="myModalLabel">Login</h4>
                </div>
                
                <div class="modal-body">
                
                    <div class="form-group">
                        <label class="sr-only" for="log">User</label>
                        <input placeholder="User" class="form-control" type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>"/> 
                    </div>
                    
                    <div class="form-group">
                        <label class="sr-only" for="pwd">Password</label>
                        <input placeholder="Password" class="form-control" type="password" name="pwd" id="pwd" size="22" /> 
                    </div>
                    
                    <div class="form-group">
                        <div class="checkbox text-left">
                            <label>
                                <input name="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me
                            </label>
                        </div>
                    </div>
                    
                </div>
                
                <div class="modal-footer">
                    
                    <input class="btn btn-primary" type="submit" name="submit" value="Send" class="button" /><br>
                    <p class="padding-top-15">Not a member yet? <a href="<?php echo site_url() . '/login?action=register&source=modal'; ?>">Sign up now!</a></p>
                </div>
        
            </form>
        
        </div>
    
    </div>

  </div><!-- end of mm-login-modal -->
  
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