<?php

/**
 * Add ajax bookmark hook and handle requests
 */

add_filter('wp_ajax_mm_bookmark', 'mm_bookmark');
        
function mm_bookmark()
{
    $current_user = wp_get_current_user();
    $option = get_user_option('bookmarks', $current_user->ID);
    $post_id = $_REQUEST["post_id"];

    if($option == false)
    {
        $result['type'] = "bool";
        $result['option'] = $option;
        $result['post_id'] = $post_id;
        $result['current_user'] = $current_user->display_name;
    }
    else
    {
        $result['type'] = "value";
        $result['option'] = $option;
        $result['post_id'] = $post_id;
        $result['current_user'] = $current_user->display_name;
    }

    $result = json_encode($result);
    echo $result;
	
    die();
}
