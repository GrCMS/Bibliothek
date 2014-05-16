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
    
    $all_ratings = $GLOBALS['wpdb']->get_results(''
            . 'SELECT * '
            . 'FROM wp_ratings '
            . 'WHERE movie = '.$data['movie'], OBJECT);
    
    $votes = 0;
    $sum_ratings = 0;
    foreach($all_ratings as $rate) {
        ++$votes;
        $sum_ratings += $rate->rating;
    }
    $global_rating = $votes > 0 ? round($sum_ratings/$votes, 1) : '';
    
    $returnArray = array(
        'result' => true,
        'user_id' => $current_user->ID,
        'movie_id' => $data['movie'],
        'global_rating' => $global_rating,
        'rating' => $data['rating']
    );
    
    echo json_encode($returnArray);
    die();
}