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
class Rating {
    
    static $user;
    function __construct() {
        $this->user = wp_get_current_user();
    }
    function get_public_movie_rating($movie_id) {
        $all_ratings = $GLOBALS['wpdb']->get_results(''
            . 'SELECT * '
            . 'FROM wp_ratings '
            . 'WHERE movie = '.$movie_id, OBJECT);
        
        $votes = 0;
        $sum_ratings = 0;
        if(!empty($all_ratings)) {
            foreach($all_ratings as $rate) {
                ++$votes;
                $sum_ratings += $rate->rating;
            }
        }
        $global_rating = $votes > 0 ? round($sum_ratings/$votes, 1) : '';
        
        return $global_rating;
    }
    
    function get_user_movie_rating($movie_id) {
        $user_ratings = $GLOBALS['wpdb']->get_results(''
            . 'SELECT * '
            . 'FROM wp_ratings '
            . 'WHERE movie = '.$movie_id
                . ' AND user = '.$this->user->ID, OBJECT);
        
        if(!empty($user_ratings) && count($user_ratings == 1)) {
            $rating = $user_ratings[0]->rating;
        }
        
        return $rating;
    }
    
    function set_user_movie_rating($movie_id, $rating) {
        $data = array(
            'user' => $this->user->ID,
            'movie' => $movie_id,
            'rating' => $rating
        );
        
        $alreadyVoted = $GLOBALS['wpdb']->get_results(''
            . 'SELECT * '
            . 'FROM wp_ratings '
            . 'WHERE user = '.$this->user->ID
            . ' AND movie = '.$movie_id);

        if(empty($alreadyVoted)) {
            $GLOBALS['wpdb']->insert('wp_ratings', $data);
        } else {
            $GLOBALS['wpdb']->update('wp_ratings', $data, array('user' => $this->user->ID, 'movie' => $movie_id));
        }
    }
}


add_filter('wp_ajax_mm_rating', 'mm_rating');
        
function mm_rating()
{
    $Rate = new Rating();
    $data = $_REQUEST;
    
    $Rate->set_user_movie_rating($data['movie'], $data['rating']);
    $global_rating = $Rate->get_public_movie_rating($data['movie']);

    $returnArray = array(
        'result' => true,
        'user_id' => $Rate->user->ID,
        'movie_id' => $data['movie'],
        'global_rating' => $global_rating,
        'rating' => $data['rating']
    );
    
    echo json_encode($returnArray);
    die();
}