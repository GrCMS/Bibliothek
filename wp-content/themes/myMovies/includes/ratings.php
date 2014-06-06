<?php

class Rating {

    static $user;
    static $prefix;

    function __construct() {
        $this->user = wp_get_current_user();
        global $wpdb;
        $this->prefix = $wpdb->prefix;
    }

    function get_public_movie_rating($movie_id) {
        $global_rating = $GLOBALS['wpdb']->get_results(''
                . 'SELECT comment_post_ID as movie, round(avg(meta_value),1) as rating '
                . 'FROM '.$this->prefix.'commentmeta '
                . 'JOIN '.$this->prefix.'comments ON ('.$this->prefix.'commentmeta.comment_id = '.$this->prefix.'comments.comment_ID) '              
                . 'WHERE comment_post_ID = '. $movie_id .' '
                . 'GROUP BY movie', ARRAY_A);

        return $global_rating;
    }
    
    function get_top_rated_movies($movie_count){
        $top_rated = $GLOBALS['wpdb']->get_results(''
                . 'SELECT comment_post_ID as movie, round(avg(meta_value),1) as rating '
                . 'FROM '.$this->prefix.'commentmeta '
                . 'JOIN '.$this->prefix.'comments ON ('.$this->prefix.'commentmeta.comment_id = '.$this->prefix.'comments.comment_ID) '              
                . 'WHERE 1 '
                . 'GROUP BY movie '
                . 'ORDER BY rating DESC '
                . 'LIMIT ' . $movie_count, ARRAY_A);
        
        return $top_rated;
    }

}
