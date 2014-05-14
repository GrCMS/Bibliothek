<!-- start footer.php -->
  
  </div><!-- end of mm-content-container -->

    <div id="mm-footer-container" class="container">

      <!-- no footer styles defined -->
      
    </div><!-- end of mm-footer-container -->

  </div><!-- end of mm-wrapper -->

  <!-- Bootstrap core JavaScript
  ================================================================-->
  <!-- Placed at the end of the document so the pages load faster -->   

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="<?php bloginfo('template_url'); ?>/js/jquery-1.11.1.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="<?php bloginfo('template_url'); ?>/bootstrap/js/bootstrap.min.js"></script>
  <!-- Javascript media queries -->
  <script src="<?php bloginfo('template_url'); ?>/js/enquire.min.js"></script>
  <!-- Toggle navigation container script -->
  <script src="<?php bloginfo('template_url'); ?>/js/mm-toggle-navigation.js"></script>
  <!-- Genre slider script -->
  <script src="<?php bloginfo('template_url'); ?>/js/mm-genre-slider.js"></script>
  
  <!-- Global var holding the template url -->
  <script type="text/javascript">
    
    var templateUrl = "<?php bloginfo('template_url'); ?>";
  
  </script>
  
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
    
    $( document ).ready(function() {
        
        var gs = $('#mm-menu-genre-slider-1').genreSlider("#mm-slider-container", true, 250);
        var gsm = $('#mm-menu-genre-slider-2').genreSlider("#mm-slider-container-mobile", false, 250);
        
        menu.setup.init({complete:function(){
              
            //Callback function always called after any menu is closed
            gs.functions.reset();
            gsm.functions.reset();
        }});  
    });
    
  </script>
  
  </body>
</html>