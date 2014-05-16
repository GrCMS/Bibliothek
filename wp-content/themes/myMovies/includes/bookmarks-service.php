<?php

/**
 * 
 */
class bookmarks {

    private $key = 'bookmarks';
    private $option = null;
    private $current_user = null;

    function __construct() {

        $this->current_user = wp_get_current_user();

        if($this->current_user)
        {
            //current user is set
            $tmp = get_user_option($this->key, $this->current_user->ID);
                        
            if($tmp == false)
            {   
                //option is false, means the option does not exist
                //create option for current user;
                $this->create_option();
            }
            else
            {
                $this->option = $tmp;
            }
        }
    }

    private function create_option() {

        update_user_option($this->current_user->ID, $this->key, array());
        $this->option = get_user_option($this->key, $this->current_user->ID);
    }
    
    public function get_bookmarks() {

        return $this->option;             
    }

    public function delete_option() {

        delete_user_option($this->current_user->ID, $this->key);
    }
       
    public function toggle_bookmark($b_id) {

        if($this->is_bookmarked($b_id))
        {
            $this->remove_bookmark($b_id);
        }
        else
        {
            $this->add_bookmark($b_id);
        }
    }

    public function is_bookmarked($b_id) {

        if(in_array($b_id, $this->option))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function add_bookmark($b_id) {

        if(settype($b_id, "integer"))
        {
            array_push($this->option, $b_id);
            update_user_option($this->current_user->ID, $this->key, $this->option);
        }        
    }

    public function remove_bookmark($b_id) {
        
        $this->option = array_diff($this->option, array($b_id));
        update_user_option($this->current_user->ID, $this->key, $this->option);        
    }

    public function count() {

        return count($this->option);
    }
}

/**
 * Add ajax bookmark hook and handle requests
 */

add_filter('wp_ajax_mm_bookmark', 'mm_bookmark');
        
function mm_bookmark()
{
    $post_id = $_REQUEST["post_id"];            
        
    $current_bookmarks = new bookmarks();
    $current_bookmarks->toggle_bookmark($post_id);
    
    $result['current_bookmark'] = $post_id;
    $result['bookmarks'] = $current_bookmarks->get_bookmarks();
    $result['bookmarks_count'] = $current_bookmarks->count();
    
    $result = json_encode($result);
    echo $result;
	
    die();
}