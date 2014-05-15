<!-- start footer.php -->
  
  </div><!-- end of mm-content-container -->

    <div id="mm-footer-container" class="container">

      <!-- no footer styles defined -->
      
    </div><!-- end of mm-footer-container -->

  </div><!-- end of mm-wrapper -->
        
  <!-- Wordpress scripts -->
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