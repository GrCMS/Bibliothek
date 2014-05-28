<?php

/*
Plugin Name: myMovies Admin Settings
Description: Adds a settings section to the Admin menu wich extends myMovies functionality
*/

include_once(dirname(__FILE__) .'/customvalues.php');
add_action( 'admin_menu', 'register_mymovies_menu' );
add_action( 'admin_menu', 'register_customvalues_menu' );
register_css();

function register_mymovies_menu(){
                 //$page_title,    $menu_title,   $capability,     $menu_slug,                        $function, $icon_url, $position
    add_menu_page( 'MM Settings', 'MM Settings', 'edit_themes', 'mm_admin_menu', '', '', 30 );
}

function register_customvalues_menu(){
    //$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function
    add_submenu_page( 'mm_admin_menu', 'Custom values', 'Custom values', 'edit_themes', 'mm_admin_settings/setvalues.php', '', '');
    create_customvalues_admin_table();
}

/**
 * Creates the custom values table
 */
function create_customvalues_admin_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'mymovies_value_identifiers';

    $sql = "CREATE TABLE $table_name (
            identifier varchar(128) NOT NULL,
            value text NOT NULL,
            PRIMARY KEY(identifier));";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    
}

function register_css() {
    /** Register */
    wp_register_style('mm-admin-settings-style', plugins_url('admin-settings.css', __FILE__), array(), '1.0.0', 'all');
 
    /** Enqueue */
    wp_enqueue_style('mm-admin-settings-style');
}