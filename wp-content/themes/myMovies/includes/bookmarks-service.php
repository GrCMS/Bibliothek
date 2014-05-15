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

add_filter('wp_ajax_mm_bookmark', 'mm_bookmark');
        
function mm_bookmark()
{
    $current_user = wp_get_current_user();
    $option = get_user_option('bookmarks', $current_user->ID);
    $post_id = $_REQUEST["post_id"];
            
    $result['bookmark_id'] = $post_id;
    
    if($option == false)
    {
        //option 'bookmarks' does not exist, create it and store value
        update_user_option($current_user->ID, 'bookmarks', array($post_id));
        $result['action'] = 'created';
    }
    else
    {
        //get all values in form of an array
        $bookmarks_arr = get_user_option('bookmarks', $current_user->ID);
                
        //check if the $post_id is already in the array
        if(in_array($post_id, $bookmarks_arr))
        {
            //if it exists, remove it
            $bookmarks_arr = array_diff($bookmarks_arr, array($post_id));
            $result['action'] = 'removed';
        }
        else
        {   
            //if it does not exist, add it
            $bookmarks_arr[] = $post_id;
            $result['action'] = 'added';
        }
        
        update_user_option($current_user->ID, 'bookmarks', $bookmarks_arr);
    }
    
    $result = json_encode($result);
    echo $result;
	
    die();
}