<?php

include_once(dirname(__FILE__) .'/includes/mm-admin-settings/mm-admin-frontpage-customvalues.php');
add_action( 'admin_menu', 'register_mm_admin_settings_menu' );
add_action( 'admin_menu', 'register_mm_admin_frontpage_customvalues_menu' );
register_css();

function register_mm_admin_settings_menu(){
                 //$page_title,    $menu_title,   $capability,     $menu_slug,                        $function, $icon_url, $position
    add_menu_page( 'MM Settings', 'MM Settings', 'edit_themes', 'mm_admin_menu', '', '', 30 );
}

function register_mm_admin_frontpage_customvalues_menu(){
    //$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function
    add_submenu_page( 'mm_admin_menu', 'Custom values', 'Custom values', 'edit_themes', '/includes/mm-admin-settings/mm-admin-frontpage-setvalues.php', '', '');
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
    wp_register_style('mm-admin-settings-style', get_template_directory_uri() . '/includes/mm-admin-settings/admin-settings.css', array(), '1.0.0', 'all');
     
    /** Enqueue */
    wp_enqueue_style('mm-admin-settings-style');
}
