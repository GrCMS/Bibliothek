<?php

/**
 * Hook called on 'wp_nav_menu_items' in order to render a logout and backend link
 */
add_filter('wp_nav_menu_items', 'add_logout_link', 10, 2);

/**
 * Adds the 'logout' and 'backend' link to the account menu
 */
function add_logout_link($items, $args) {
    if ($args->theme_location == 'account') {
        $loginoutlink = wp_loginout('index.php', false);
        if (current_user_can('administrator')) {
            $backendlink = '<a href="' . get_site_url() . '/wp-admin">Backend</a>';
            $items .= '<li>' . $backendlink . '</li>';
        }
        $items .= '<li>' . $loginoutlink . '</li>';
    }
    return $items;
}