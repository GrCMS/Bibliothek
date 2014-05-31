<?php 

    get_header();
    
    the_post();
    require("templates/template-movie.php"); 
    
    $args = array(
        
        'post_id' => get_the_ID()
    );
    
    $comments = get_comments( $args );

    echo "<div class='container'>";

    foreach($comments as $comment) {
        if($comment->comment_content) {
            echo "<article>";
            echo "<h5>". $comment->comment_author ."</h5>";
            echo "<div>" .$comment->comment_content . "</div>";
            echo "</article>";
        }
    }
    
    echo "</div>";
 
    get_footer(); 

 ?>