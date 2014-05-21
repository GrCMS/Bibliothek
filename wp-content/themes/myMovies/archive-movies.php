<?php

/**
 * Template called for custom post type 'movies'
 */

get_header();

?>

<style>
    
    #mm-all-movie-ajax-loading-icon {
        
        font-size: 30px;
        color: #1c2a2b;
        margin-top:10px;
    }
    
</style>

<div id="mm-all-movies-posts">
    
    <h2 class="container">All movies</h2>
    
</div>

<div id="mm-all-movie-ajax-loading" class="container text-center">
    
    <span>Loading movies...</span><br/>
    <span class="ion-loading-c" id="mm-all-movie-ajax-loading-icon"></span>
    
</div>



    
<?php 

get_footer();

?>

