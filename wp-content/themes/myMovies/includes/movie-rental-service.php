<?php

class movie_rentals {}

/**
 * Add ajax bookmark hook and handle requests
 */

add_filter('wp_ajax_mm_movie_rental', 'mm_movie_rental');
        
function mm_movie_rental()
{
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

