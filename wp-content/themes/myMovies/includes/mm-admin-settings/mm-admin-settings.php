<?php

include_once('mm-admin-customValue.php');

add_action("admin_enqueue_scripts", "mm_admin_settings_script_registration");

function mm_admin_settings_script_registration() {
    
    wp_register_style('mm-admin-settings-style', get_template_directory_uri() . '/includes/mm-admin-settings/admin-settings.css', array(), '1.0', false);
    wp_register_style('tablesorter-bootstrap-style', get_template_directory_uri() . '/css/tablesorter/theme.default.css', array(), '1.0', false);
    wp_register_style('ion-tabs-style', get_template_directory_uri() . '/css/ion.tabs.css', array(), '1.0', false);
    wp_register_style('ion-tabs-skin-flat-style', get_template_directory_uri() . '/css/ion.tabs.skinFlat.css', array(), '1.0', false);
    wp_register_style('ion-tabs-skin-bordered-style', get_template_directory_uri() . '/css/ion.tabs.skinBordered.css', array(), '1.0', false);
        
    wp_register_script('jquery-metadata-js', get_template_directory_uri() . '/js/jquery.metadata.js', array('jquery'), '1.0', true);
    wp_register_script('jquery-tablesorter-js', get_template_directory_uri() . '/js/jquery.tablesorter.min.js', array('jquery'), '1.0', true);
    wp_register_script('ion-tabs-js', get_template_directory_uri() . '/js/ion.tabs.min.js', array('jquery'), '1.0', true);
        
    wp_enqueue_style('mm-admin-settings-style');
    wp_enqueue_style('tablesorter-bootstrap-style');
    wp_enqueue_style('ion-tabs-style');
    //wp_enqueue_style('ion-tabs-skin-flat-style');
    wp_enqueue_style('ion-tabs-skin-bordered-style');
    wp_enqueue_script('jquery-metadata-js');
    wp_enqueue_script('jquery-tablesorter-js');
    wp_enqueue_script('ion-tabs-js');
}

add_action("admin_menu", "setup_theme_mm_admin_settings_menu");

function setup_theme_mm_admin_settings_menu() {
    
    //create top level menu page
    add_menu_page('MM Settings', 'MM Settings', 'edit_themes', 
        'mm_top_level_admin_menu', 'mm_top_level_settings_page');
    
    //create sub menu page "Front Page"
    add_submenu_page('mm_top_level_admin_menu', 'Front Page', 'Front Page', 
            'edit_themes', 'mm_admin_menu_front_page','mm_admin_page_front_page_settings');
    
    //create sub menu page "Rentals"
    add_submenu_page('mm_top_level_admin_menu', 'Rentals Overview', 'Rentals Overview', 
            'edit_themes', 'mm_admin_menu_rentals_overview', 'mm_admin_page_rentals_overview');

    //create sub menu page "Theme Settings"
    add_submenu_page('mm_top_level_admin_menu', 'Theme Settings', 'Theme Settings', 
            'edit_themes', 'mm_admin_menu_theme_settings', 'mm_admin_page_theme_settings');
}

function mm_top_level_settings_page() {
    
    if (!current_user_can('edit_themes')) {
        
        wp_die('You do not have sufficient permissions to access this page.');
    }
    
    include_once('mm-admin-top-level-settings-page.php');
}

function mm_admin_page_front_page_settings() {
    
    if (!current_user_can('edit_themes')) {
        
        wp_die('You do not have sufficient permissions to access this page.');
    }
    
    include_once('mm-admin-front-page-settings-page.php');
}

function mm_admin_page_rentals_overview() {
    
    if (!current_user_can('edit_themes')) {
        
        wp_die('You do not have sufficient permissions to access this page.');
    }
    
    include_once('mm-admin-rentals-overview-page.php');
}

function mm_admin_page_theme_settings() {
    
    if (!current_user_can('edit_themes')) {
        
        wp_die('You do not have sufficient permissions to access this page.');
    }
    
    include_once('mm-admin-theme-settings-page.php');
}







