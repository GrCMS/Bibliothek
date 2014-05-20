<?php

/**
 *  Hook called on 'init' to register custom menus
 */
add_action('init', 'register_menus');

/**
 * Register nav menus: 'genre slider', 'account navigation' and 'page navigation'
 */
function register_menus() {
    register_nav_menus(array(
        'slider' => 'Genre Slider',
        'account' => 'Account Navigation',
        'page' => 'Page Navigation'
    ));
}

