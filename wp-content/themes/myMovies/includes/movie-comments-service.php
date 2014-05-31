<?php

class movie_comments {
    
    private $current_user = null;
    private $ratings_meta_key = 'rating';
        
    function __construct() {
        
        $this->current_user = wp_get_current_user();
    }
    
    private function hasUserComment($post_id) {
        
        if($this->current_user) {
            
            $args = array(

                'post_id' => $post_id,
                'user_id' => $this->current_user->ID,
                'count' => true
            );
            
            if(get_comments($args) > 0) {
                
                return true;
            }  
        } 
            
        return false;
    }
    
    private function addComment($post_id, $comment_rating, $comment_content) {
        
        if($comment_content == null)
        {
            $comment_content = "";
        }
        
        if($comment_rating != null) {
         
            $comment_data = array(
            
                'comment_post_ID' => $post_id,
                'comment_author' => $this->current_user->display_name,
                'comment_author_email' => $this->current_user->user_email,
                'comment_author_url' => $this->current_user->user_url,
                'user_id' => $this->current_user->ID,
                'comment_content' => $comment_content
            );
            
            $comment_id = wp_new_comment($comment_data);
            add_comment_meta($comment_id, $this->ratings_meta_key, $comment_rating);
        }
    }
    
    private function updateComment($comment_id, $comment_rating, $comment_content) {
        
        if($comment_content == null) {
            
            $comment_content = "";
        }
        
        if($comment_rating != null) {
            
            $comment_data = array(
                
                'comment_ID' => $comment_id,
                'comment_content' => $comment_content
            );
            
            wp_update_comment($comment_data);
            update_comment_meta($comment_id, $this->ratings_meta_key, $comment_rating);
        }
    }
    
    public function getUserComment($post_id) {
        
        if($this->hasUserComment($post_id)) {
                            
            $args = array(

                'post_id' => $post_id,
                'user_id' => $this->current_user->ID
            );
            
            $comments = get_comments($args);
            return $comments[0];
        }
        
        return null;
    }
                
    public function updateUserComment($post_id, $comment_id, $comment_content, $comment_rating) {
        
        if($post_id != null) {
        
            $comment = $this->getUserComment($post_id);
                                        
            if($comment != null) {
                
                //there is a comment from current user
                
                if($comment_id != null) {
                    
                    if($comment->comment_ID == $comment_id)
                    {
                        //ensure the right comment is being updated
                        $this->updateComment($comment_id, $comment_rating, $comment_content);
                    }
                                        
                } else {
                    
                    //update $comment
                    $this->updateComment($comment->comment_ID, $comment_rating, $comment_content);
                }
                
            } else {
            
                $this->addComment($post_id, $comment_rating, $comment_content);
            } 
        }
    }
       
    public function getUserRating($post_id, $comment_id) {
        
        if($this->hasUserComment($post_id)) {
            
            $meta_values = get_comment_meta( $comment_id, $this->ratings_meta_key);
            return $meta_values[0];
        }
        
        return null;
    }
        
    public function getCommentCount($post_id) {
       
        $args = array(
            'post_id' => $post_id,
            'count' => true
        );
        
        return get_comments($args);
    }
}

/**
 * Add ajax comment_movie hook and handle requests
 */

add_filter('wp_ajax_mm_comment_movie', 'mm_comment_movie');

function mm_comment_movie() {
    
    $post_id = (isset($_REQUEST['post_id'])) ? $_REQUEST['post_id'] : null;
    $comment_id = (isset($_REQUEST['comment_id'])) ? $_REQUEST['comment_id'] : null;
    $comment_rating = (isset($_REQUEST['comment_rating'])) ? $_REQUEST['comment_rating'] : null;
    $comment_content = (isset($_REQUEST['comment_content'])) ? $_REQUEST['comment_content'] : null;
    
    if($post_id != null && $comment_rating != null) {
        
        $current_comments = new movie_comments();
        $current_comments->updateUserComment($post_id, $comment_id, $comment_content, $comment_rating);
    }
    
    die();
}

/**
 * Add ajax get_comment_movie hook and handle requests
 */

add_filter('wp_ajax_mm_get_comment_movie', 'mm_get_comment_movie');

function mm_get_comment_movie() {
    
    $post_id = (isset($_REQUEST['post_id'])) ? $_REQUEST['post_id'] : null;
        
    if($post_id != null) {
        
        $current_comments = new movie_comments();
        $comment = $current_comments->getUserComment($post_id);
        
        if($comment != null) {
         
            $result['comment_id'] = $comment->comment_ID;
            $result['comment_rating'] = $current_comments->getUserRating($post_id, $comment->comment_ID);
            $result['comment_content'] = $comment->comment_content;
            
        } else {
            
            $result['comment_id'] = null;
            $result['comment_rating'] = null;
            $result['comment_content'] = null;
        }
    }
    
    $result = json_encode($result);
    echo $result;  
    die();
}