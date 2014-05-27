<?php

class movie_rentals {
    
    private $db_rentals_table = "rentals";
    private $db_posts_table = "posts";
    private $current_user = null;
        
    function __construct() {
        
        $this->current_user = wp_get_current_user();
    }
    
    private function dbExists() {
        
        global $wpdb;
        $table_rentals = $wpdb->prefix . $this->db_rentals_table;
        
        if($wpdb->get_var("SHOW TABLES LIKE '$table_rentals'") != $table_rentals) {
            
            return false;
        }
                
        return true;
    }
        
    public function isRented($m_id) {
        
        if($this->dbExists())
        {
            global $wpdb;
            $table_rentals = $wpdb->prefix . $this->db_rentals_table;
            $user_id = $this->current_user->ID;
            
            $result = $wpdb->get_var(
                    
                "SELECT COUNT(ID) as 'count' FROM $table_rentals
                WHERE $table_rentals.user = $user_id
                AND $table_rentals.movie = $m_id
                AND $table_rentals.returned =0;"
            );
            
            if($result == 0)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        return false;
    }
    
    public function getHistory() {
        
        if($this->dbExists())
        {
            global $wpdb;
            $table_rentals = $wpdb->prefix . $this->db_rentals_table;
            $table_posts = $wpdb->prefix . $this->db_posts_table;
            $user_id = $this->current_user->ID;
            
            /*
             * SELECT * FROM wp_posts 
             * JOIN wp_rentals 
             * ON wp_rentals.movie = wp_posts.ID 
             * WHERE wp_rentals.user = 'user_id' 
             * AND wp_rentals.returned = 1;
             */
            
            $result = $wpdb->get_results(
                    
                "SELECT * FROM $table_posts
                JOIN $table_rentals ON $table_rentals.movie = $table_posts.ID
                WHERE $table_rentals.user = $user_id
                AND $table_rentals.returned =1;"
            );
                        
            return $result;
        }
    }
    
    public function rentMovie($m_id, $start_date, $return_date) {
              
        if($this->dbExists())
        {
            global $wpdb;
            $table_rentals = $wpdb->prefix . $this->db_rentals_table;
            $user_id = $this->current_user->ID;
            
            $wpdb->insert($table_rentals, array(
                
                    'user'          => $user_id,
                    'movie'         => $m_id,
                    'rental_date'   => $start_date,
                    'return_date'   => $return_date,
                    'returned'      => '0'
                )
            );
        }
    }
    
    public function getRentedMovies() {
        
        if($this->dbExists())
        {
            global $wpdb;
            $table_rentals = $wpdb->prefix . $this->db_rentals_table;
            $table_posts = $wpdb->prefix . $this->db_posts_table;
            $user_id = $this->current_user->ID;
            
            /*
             * SELECT * FROM wp_posts 
             * JOIN wp_rentals 
             * ON wp_rentals.movie = wp_posts.ID 
             * WHERE wp_rentals.user = 'user_id' 
             * AND wp_rentals.returned = 0;
             */
            
            $result = $wpdb->get_results(
                    
                "SELECT * FROM $table_posts
                JOIN $table_rentals ON $table_rentals.movie = $table_posts.ID
                WHERE $table_rentals.user = $user_id
                AND $table_rentals.returned =0;"
            );
                        
            return $result;
        }
    }

    public function returnMovie($m_id) {
        
        if($this->dbExists())
        {
            global $wpdb;
            $table_rentals = $wpdb->prefix . $this->db_rentals_table;
            $user_id = $this->current_user->ID;
            $returned_date = date('Y-m-d');
            
            $result = $wpdb->update($table_rentals, 
                
                //UPDATE VALUE OF COLUMN
                array(
                    
                    'returned' => 1,
                    'returned_date' => $returned_date
                ),
                
                //WHERE
                array(
                    
                    'returned' => 0,
                    'user' => $user_id,
                    'movie' => $m_id
                )
            );
            
            //result is true or false (update successfull equals true)
            return $result;
        }
    }
    
    public function getMoviesToReturn() {
        
        //checks date and gets movies that has to be returned
    }
    
    public function getCount() {
        
        if($this->dbExists())
        {
            global $wpdb;
            $table_rentals = $wpdb->prefix . $this->db_rentals_table;
            $user_id = $this->current_user->ID;
                        
            $result = $wpdb->get_var(
                    
                "SELECT COUNT(ID) as 'count' FROM $table_rentals
                WHERE $table_rentals.user = $user_id
                AND $table_rentals.returned =0;"
            );
                        
            return $result;
        }
    }
    
    public function getCountHistory() {
        
        if($this->dbExists())
        {
            global $wpdb;
            $table_rentals = $wpdb->prefix . $this->db_rentals_table;
            $user_id = $this->current_user->ID;
                        
            $result = $wpdb->get_var(
                    
                "SELECT COUNT(ID) as 'count' FROM $table_rentals
                WHERE $table_rentals.user = $user_id
                AND $table_rentals.returned =1;"
            );
                        
            return $result;
        }
    }
}

/**
 * Add ajax bookmark hook and handle requests
 */

add_filter('wp_ajax_mm_rent_movie', 'mm_rent_movie');
        
function mm_rent_movie() {
    
    $post_id = (isset($_REQUEST['post_id'])) ? $_REQUEST['post_id'] : null;
    $start_date = (isset($_REQUEST['start_date'])) ? $_REQUEST['start_date'] : null;
    $return_date = (isset($_REQUEST['return_date'])) ? $_REQUEST['return_date'] : null;
    
    if($post_id != null && $start_date != null && $return_date != null)
    {
        $current_rentals = new movie_rentals();
        $current_rentals->rentMovie($post_id, $start_date, $return_date);
        
        $result['post_id'] = $post_id;
        $result['start_date'] = $start_date;
        $result['return_date'] = $return_date;
    
        $result = json_encode($result);
        echo $result;
    }
	
    die();
}

add_filter('wp_ajax_mm_return_movie', 'mm_return_movie');

function mm_return_movie() {
    
    $post_id = (isset($_REQUEST['post_id'])) ? $_REQUEST['post_id'] : null;  
    
    if($post_id != null)
    {
        $current_rentals = new movie_rentals();
    
        $result['post_id'] = $post_id;
        $result['updated'] = $current_rentals->returnMovie($post_id);
        $result['rentals_count'] = $current_rentals->getCount();
        $result = json_encode($result);
        echo $result;
    }
    
    die();
}