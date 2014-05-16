<?php

/**
 * Add bookmark class
 * + int count;
 * + bool empty;
 * + delete option function(name);
 * + create option function(name);
 * + isBookmarked function(id);
 * + add bookmark function(id);
 * + remove bookmark function(id); 
 */

/**
 * Add ajax bookmark hook and handle requests
 */

add_filter('wp_ajax_mm_rating', 'mm_rating');
        
function mm_rating()
{
    $current_user = wp_get_current_user();
    $data = $_REQUEST;
    $data['user'] = $current_user->ID;
    
    $alreadyVoted = $GLOBALS['wpdb']->get_results(''
            . 'SELECT * '
            . 'FROM wp_ratings '
            . 'WHERE user = '.$current_user->ID
            . ' AND movie = '.$data['movie']);

    
    unset($data['action']);

    if(empty($alreadyVoted)) {
        $GLOBALS['wpdb']->insert('wp_ratings', $data);
    } else {
        $GLOBALS['wpdb']->update('wp_ratings', $data, array('user' => $current_user->ID, 'movie' => $data['movie']));
    }
    
    $returnArray = array(
        'result' => true,
        'user_id' => $current_user->ID,
        'movie_id' => $data['movie'],
        'rating' => $data['rating']
    );
    
    echo json_encode($returnArray);
    die();
}