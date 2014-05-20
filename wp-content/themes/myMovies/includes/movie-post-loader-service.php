<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Add ajax bookmark hook and handle requests
 */

add_filter('wp_ajax_mm_movie_post_loader', 'mm_movie_post_loader');
        
function mm_movie_post_loader()
{
    //$post_id = $_REQUEST["post_id"];            
    $args = array( 'posts_per_page' => 6, 'offset'=> 12, 'post_type' => 'movies' );
    $myposts = get_posts( $args );
    $titels = array();
    
    foreach($myposts as $post)
    {
        $titles[] = $post->post_title;
    }
       
    $result['p'] = $titles;
        
    $result = json_encode($result);
    echo $result;
	
    die();
}

