<?php

/**
 * Hook called on 'wp_enqueue_scripts' to register stlyes an scripts
 */
add_action("wp_enqueue_scripts", "mm_enqueue_scripts");

/**
 * Function to enqueue scripts and styles
 * Also needen for ajax script and service localization 
 */
function mm_enqueue_scripts() {
    //Style registration
    wp_register_style('bootstrap-style', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), '3.1.1', false);
    wp_register_style('icomoon', get_template_directory_uri() . '/fonts/icomoon/style.css', array(), '1.0', false);
    wp_register_style('ionicons', get_template_directory_uri() . '/css/ionicons.min.css', array(), '1.0', false);
    wp_register_style('stars', get_template_directory_uri() . '/css/stars.css', array(), '1.0', false);
    wp_register_style('genre-slider-style', get_template_directory_uri() . '/css/genre-slider.css', array(), '1.0', false);
    wp_register_style('flexslider-style', get_template_directory_uri() . '/css/flexslider.css', array(), '1.0', false);
    wp_register_style('style', get_stylesheet_uri());

    //Script registration
    wp_register_script('bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery'), '3.1.1', true);
    wp_register_script('enquire-js', get_template_directory_uri() . '/js/enquire.min.js', array('jquery'), '2.1.0', true);
    wp_register_script('toggle-navigation-js', get_template_directory_uri() . '/js/mm-toggle-navigation.js', array('jquery'), '1.0', true);
    wp_register_script('genre-slider-js', get_template_directory_uri() . '/js/mm-genre-slider.js', array('jquery'), '1.0', true);
    wp_register_script('bookmarks-js', get_template_directory_uri() . '/js/ajax/bookmarks.js', array('jquery'), '1.0', true);
    wp_register_script('ratings-js', get_template_directory_uri() . '/js/ajax/ratings.js', array('jquery'), '1.0', true);
    wp_register_script('raty-js', get_template_directory_uri() . '/js/raty/jquery.raty.min.js', array('jquery'), '2.5.2', true);
    wp_register_script('mymovies-js', get_template_directory_uri() . '/js/mymovies.js', array('jquery'), '1.0', true);
    wp_register_script('flexslider-js', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery'), '1.0', true);
    wp_register_script('mm-bookmark-list-js', get_template_directory_uri() . '/js/mm-bookmark-list.js', array('jquery'), '1.0', true);
    wp_register_script('movie-post-loader-js', get_template_directory_uri() . '/js/ajax/movie-post-loader.js', array('jquery'), '1.0', true);

    //localization for ajax scripts
    wp_localize_script('bookmarks-js', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
    wp_localize_script('ratings-js', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
    wp_localize_script('movie-post-loader-js', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
    
    //Always enqueue jQuery
    wp_enqueue_script('jquery');

    if (!is_admin()) {
        //Only enqueued on frontend (JS)
        wp_enqueue_script('bootstrap-js');
        wp_enqueue_script('enquire-js');
        wp_enqueue_script('toggle-navigation-js');
        wp_enqueue_script('genre-slider-js');
        wp_enqueue_script('raty-js');
        wp_enqueue_script('mm-bookmark-list-js');
        
        //Only enqueued on frontend (AJAX)
        wp_enqueue_script('bookmarks-js');
        wp_enqueue_script('ratings-js');
        
        if(is_post_type_archive('movies'))
        {   
            //Only enqueued on archive-movies.php 
            wp_enqueue_script('movie-post-loader-js');
        }

        //Only enqueued on frontend (CSS)
        wp_enqueue_style('bootstrap-style');
        wp_enqueue_style('icomoon');
        wp_enqueue_style('ionicons');
        wp_enqueue_style('stars');
        wp_enqueue_style('genre-slider-style');
        wp_enqueue_style('style');

        if (is_front_page()) {
            
            //Only enqueued on front page (front-page.php)
            wp_enqueue_style('flexslider-style');
            wp_enqueue_script('flexslider-js');
            wp_enqueue_script('mymovies-js');
        }
    }
}

