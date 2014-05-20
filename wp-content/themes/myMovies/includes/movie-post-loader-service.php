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
    $offset = $_REQUEST["offset"];            
    $args = array( 'posts_per_page' => 6, 'offset'=> $offset, 'post_type' => 'movies' );
    $myposts = get_posts( $args );
    $titels = array();
    
    foreach($myposts as $post)
    {
        $titles[] = "<div class='a-litte-test new'><h2>" . $post->post_title . "</h2></div>";
    }
       
    $result['offset'] = $offset;
    $result['posts'] = $titles;
        
    $result = json_encode($result);
    echo $result;
	
    die();
}

