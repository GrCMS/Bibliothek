<?php

class movie_rentals {
    
    private $db_table = "";
    private $current_user = null;
    
    function __construct() {
        
        $this->current_user = wp_get_current_user();
    }
    
    private function dbExists() {
        
        return false;
    }
    
    public function isRented($m_id) {
        
        //check if db entry with given id exists for current user
        return false;
    }
    
    public function getHistory() {
        
        //get all flagged for current user
    }
    
    public function rentMovie($m_id, $start_date, $end_date) {
        
        //add db entry
    }
    
    public function getRentedMoives() {
        
        //get all movies that are not flagged for current user
    }

    public function returnMovie($m_id) {
        
        //set flag
    }
    
    public function getMoviesToReturn() {
        
        //checks date and gets movies that has to be returned
    }
}

/**
 * Add ajax bookmark hook and handle requests
 */

add_filter('wp_ajax_mm_rent_movie', 'mm_rent_movie');
        
function mm_rent_movie() {
    
    $post_id = $_REQUEST["post_id"];
    $start_date = $_REQUEST["start_date"];
    $return_date = $_REQUEST["return_date"];
    
    $result['post_id'] = $post_id;
    $result['start_date'] = $start_date;
    $result['return_date'] = $return_date;
    
    $result = json_encode($result);
    echo $result;
	
    die();
}

add_filter('wp_ajax_mm_return_movie', 'mm_return_movie');

function mm_return_movie() {
    
    $post_id = $_REQUEST["post_id"];    
    $result['post_id'] = $post_id;
    $result = json_encode($result);
    echo $result;
	
    die();
}