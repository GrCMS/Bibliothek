<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- PAGE META -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <title><?php bloginfo('name'); ?></title>
        <?php comments_popup_script() ?>
        <!-- WORDPRESS STYLES (CSS) -->
        <?php wp_head(); ?>
    </head>
    <body>

        <!-- Get current user -->
        <?php
        $is_registered = false;

        $current_user = null;

        //Find out if user has an Account and is logged in
        if (is_user_logged_in()) {
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

                        <div id="mm-header-genre-slider-col" class="col-xs-4 col-sm-1 col-sm-push-3 text-center divider-vertical">

                            <!-- needed in order to center the 'mm-header-genre-slider-wrapper' div -->
                            <div id="mm-header-genre-slider-anchor">

                                <!-- triggers (show/hide) genre slider -->
                                <span id="mm-header-genre-slider-trigger" class="ion-navicon-round"></span>

                                <!-- wrapper for genre slider on sm, md and lg -->
                                <div id="mm-header-genre-slider-wrapper">

                                    <?php
                                    if (has_nav_menu('slider')) {

                                        wp_nav_menu(array(
                                            'theme_location' => 'slider',
                                            'container' => 'div',
                                            'container_id' => 'mm-slider-container',
                                            'menu_id' => 'mm-menu-genre-slider-1',
                                            'echo' => true,
                                            'depth' => 0,
                                            'walker' => new genre_slider_walker()
                                        ));
                                    }
                                    ?> 

                                </div>

                            </div><!-- end of mm-header-genre-slider-anchor -->

                        </div><!-- end of mm-header-genre-slider-col -->

                        <div id="mm-header-search-col" class="col-xs-4 col-sm-pull-1 col-sm-3 text-center-xs">

                            <div class="visible-sm visible-md visible-lg">

                                <!-- Include wp-search (desktop) -->
                                <?php get_search_form(); ?>

                            </div>

                            <div class="visible-xs">

                                <span id="mm-header-search-trigger" class="ion ion-search"></span>

                            </div>

                        </div><!-- end of mm-header-search-col -->

                        <div id="mm-header-account-navigation-col" class="col-xs-4 col-sm-3 text-center-xs divider-vertical">

                            <?php if (is_user_logged_in()): ?>

                                <!-- if user is logged in => show account navigation trigger -->
                                <!-- account navigation trigger (desktop/mobile) -->
                                <div id="mm-header-account-wrapper">

                                    <!-- sm, md, lg: account navigation trigger -->
                                    <div id="mm-header-account-navigation-trigger">

                                        <div class="text-center visible-sm visible-md visible-lg">    
                                            
                                            <span id="mm-header-account-name"><?php echo $current_user->display_name; ?></span>
                                            <span id="mm-header-account-dropdown-icon"></span>

                                        </div>

                                    </div>

                                    <!-- xs: mobile account navigation trigger-->
                                    <div class="visible-xs text-center-xs">

                                        <span id="mm-header-account-navigation-mobile-trigger" class="ion ion-person"></span>

                                    </div>

                                </div><!-- end of mm-header-account-wrapper -->

                            <?php else: ?>

                                <!-- login form, if user is not logged in -->
                                <div id="mm-header-account-login">

                                    <!-- Login button => triggers modal dialog: mm-login-modal (in footer.php) -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mm-login-modal">
                                        Login
                                    </button>
                                                                                                            
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

                            <?php
                            if (has_nav_menu('account')) {

                                wp_nav_menu(array(
                                    'theme_location' => 'account',
                                    'container' => false,
                                    'menu_id' => 'mm-menu-account',
                                    'echo' => true,
                                    'depth' => 0
                                ));
                            }
                            ?> 

                        </div>

                    </div>

                </div>

            </div><!-- end of mm-account-navigation-wrapper -->

            <div id="mm-mobile-navigation-wrapper" class="container-fluid">

                <div id="mm-mobile-navigation-container" class="container">

                    <div id="mm-mobile-search-col" class="col-xs-12 mobile-menu">

                        <?php get_search_form(); ?>

                    </div>

                    <div id="mm-mobile-account-navigation-col" class="col-xs-12 mobile-menu">

                        <?php
                        if (has_nav_menu('account')) {

                            wp_nav_menu(array(
                                'theme_location' => 'account',
                                'container' => false,
                                'menu_id' => 'mm-menu-account-mobile',
                                'echo' => true,
                                'depth' => 0
                            ));
                        }
                        ?> 

                    </div>

                    <div id="mm-mobile-genre-slider-col" class="col-xs-12 mobile-menu">

                        <?php
                        if (has_nav_menu('slider')) {

                            wp_nav_menu(array(
                                'theme_location' => 'slider',
                                'container' => 'div',
                                'container_id' => 'mm-slider-container-mobile',
                                'menu_id' => 'mm-menu-genre-slider-2',
                                'echo' => true,
                                'depth' => 0,
                                'walker' => new genre_slider_walker()
                            ));
                        }
                        ?> 

                    </div>

                </div>

            </div><!-- end of mm-mobile-navigation-wrapper -->

            <div id="mm-content-container" class="container-fluid">

                <!-- end of header.php -->
