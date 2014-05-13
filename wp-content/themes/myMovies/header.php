<!DOCTYPE html>
<html lang="en">
  <head>
    
    <!-- PAGE META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <title><?php bloginfo('name'); ?></title>

    <!-- BOOTSTRAP & CSS -->
    <link href="<?php bloginfo('template_url'); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/fonts/icomoon/style.css" rel="stylesheet">
    <link href="<?php bloginfo('stylesheet_directory'); ?>/stars.css" rel="stylesheet">
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">

  </head>
  <body>

  <!-- Get current user -->
  <?php 

    $is_registered = false;

    //WP_USER (object) => https://codex.wordpress.org/Function_Reference/wp_get_current_user
    $current_user = null;

    //Find out if user has an Account and is logged in
    if ( is_user_logged_in() ) 
    {
        $is_registered = true;
        $current_user = wp_get_current_user();
    }

  ?>

  <div id="mm-page-wrapper" class="container-fluid">

    <header id="mm-header-wrapper" class="container-fluid">

      <div id="mm-header-container" class="container">

        <div id="mm-header-row" class="row">
            
          <div id="mm-header-brand-col" class="col-xs-12 col-sm-5">
              
              <a href="<?php echo bloginfo('url'); ?>"><img class="logo" src="<?php bloginfo('template_url'); ?>/images/layout/myMovies-logo.svg" /></a>

          </div><!-- end of mm-header-brand-col -->

          <div id="mm-header-genre-slider-col" class="col-xs-4 col-sm-1 col-sm-push-3 text-center">
              
            <!-- needed in order to center the 'mm-header-genre-slider-wrapper' div -->
            <div id="mm-header-genre-slider-anchor">

              <!-- triggers (show/hide) genre slider -->
              <span id="mm-header-genre-slider-trigger" class="icon-menu2"></span>

              <!-- wrapper for genre slider on sm, md and lg -->
              <div id="mm-header-genre-slider-wrapper">
                
                if(

              </div>
                
            </div><!-- end of mm-header-genre-slider-anchor -->

          </div><!-- end of mm-header-genre-slider-col -->

          <div id="mm-header-search-col" class="col-xs-4 col-sm-3 col-sm-pull-2 text-center">
              
            <div class="visible-sm visible-md visible-lg">

              <!-- Include wp-search (desktop) -->
              <?php get_search_form(); ?>
                
            </div>

            <div class="visible-xs">
          
              <span id="mm-header-search-trigger" class="icon-search"></span>
                    
            </div>

          </div><!-- end of mm-header-search-col -->

          <div id="mm-header-account-navigation-col" class="col-xs-4 col-sm-3 text-center">
            
            <?php if(is_user_logged_in()): ?>
            
              <!-- if user is logged in => show account navigation trigger -->
              <!-- account navigation trigger (desktop/mobile) -->
              <div id="mm-header-account-wrapper">
                
                <!-- sm, md, lg: account navigation trigger -->
                <div id="mm-header-account-navigation-trigger">

                  <div class="visible-sm visible-md visible-lg">    

                    <span id="mm-header-account-image">
                    
                      <img src="<?php bloginfo('template_url'); ?>/images/layout/user_blank.png" />

                    </span>
                    
                    <span id="mm-header-account-name">Jesus</span>
                    <span id="mm-header-account-dropdown-icon"></span>

                  </div>
                  
                </div>

                <!-- xs: mobile account navigation trigger-->
                <div class="visible-xs">
              
                  <span id="mm-header-account-navigation-mobile-trigger" class="icon-user3"></span>

                </div>

              </div><!-- end of mm-header-account-wrapper -->

            <?php else: ?>

              <!-- login form, if user is not logged in -->
              <div id="mm-header-account-login">
                
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mm-login-modal">
                  Login
                </button>
                <!-- open in modal/overlay -->
                <!-- Login button => triggers modal dialog -->
                <div class="modal fade" id="mm-login-modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form role="form" action="<?php echo wp_login_url( get_permalink() ); ?>" method="post">
                                <div class="modal-header text-left">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Login</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="sr-only" for="log">User</label>
                                        <input placeholder="User" class="form-control" type="text" name="log" id="log" value="<?php echo wp_specialchars( stripslashes($user_login), 1 ) ?>"/> 
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
                                    <input class="btn btn-default" type="submit" name="submit" value="Send" class="button" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- end of mm-header-account-login -->

            <?php endif; ?>

          </div><!-- end of mm-header-account-navigation-col -->

        </div><!-- end of mm-header-row -->
            
      </div><!-- end of mm-header-container -->
        
    </header><!-- end of mm-header-wrapper -->

    <!-- (show/hide) account navigation (sm, md, lg) below header -->
    <div id="mm-account-navigation-wrapper" class="container-fluid">

      <div class="container">
        
        <div class="row">

          <div id="mm-account-navigation-col" class="col-xs-12">
            
            WP_MENU => ACCOUNT NAVIGATION

          </div>
        
        </div>

      </div>
      
    </div><!-- end of mm-account-navigation-wrapper -->

    <div id="mm-mobile-navigation-wrapper" class="container-fluid">

      <div class="container">

        <div id="mm-mobile-search-col" class="col-xs-12">
          
          <?php get_search_form(); ?>

        </div>

        <div id="mm-mobile-account-navigation-col" class="col-xs-12">
          WP_MENU => ACCOUNT NAVITION
        </div>

        <div id="mm-mobile-genre-slider-col" class="col-xs-12">
          MOBILE
          WP_MENU => GENRE SLIDER
        </div>
        
      </div>

    </div><!-- end of mm-mobile-navigation-wrapper -->

    <div id="mm-content-container" class="container">

    <!-- end of header.php -->



  