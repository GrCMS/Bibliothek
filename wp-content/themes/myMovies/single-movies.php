<?php 

    get_header();
    
    the_post();
    get_template_part("templates/template","movie"); 
    
    $args = array(
        
        'post_id' => get_the_ID()
    );
    
    $comments = get_comments( $args );
    
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    $show_rating = is_plugin_active('mm-comment-rating/comment-rating.php');
        
    if($show_rating) {
                
        $current_post_comments = new movie_comments();
        echo "<h3 class='color-primary container text-right'>Bewertungen (" . $current_post_comments->getCommentCount(get_the_ID()) . ")</h3>";
        
    } else {
        
        echo "<h3 class='color-primary container text-right'>Bewertungen</h3>";
    }
    
    echo "<div class='movie-divider'>";
    echo "<div class='container'>";   

    foreach($comments as $comment) {
                              
        echo "<article class='mm-comments-style'>";
        echo "<div class='row'>";
        echo "<div class='col-xs-8'><h5 class='color-primary'> Bewertung von: ". $comment->comment_author ."</h5></div>";
        echo "<div class='col-xs-4'><h5 class='rating text-right'>"; 

        ?>    

            <?php 

            if($show_rating): 

                $rating = $current_post_comments->getCommentRating($comment->comment_ID);

            ?>

            <span class="hidden ratingvalue"><?php echo $rating; ?></span>
            <ul class="color-primary">
                <?php
                for ($i = 1; $i < 6; $i++) {
                    // Setzen der Ratingklassen
                    $starvalue;
                    if ($rating >= $i)
                        $starvalue = "filled";

                    else if ($rating > ($i - 0.7))
                        $starvalue = "half";
                    else
                        $starvalue = "empty";

                    echo('<li class="star star1 stars-' . $starvalue . '"></li>');
                }
                ?>

            </ul>

            <?php endif; ?>

        <?php 

        echo "</h5></div>";
        echo "</div>";
        echo "<div class='row'>";
        
        if($comment->comment_content) {
        
            echo "<div class='col-xs-12'>" .$comment->comment_content . "</div>";
        
        } else {
            
            echo "<div class='col-xs-12'>Der Benutzer hat keinen Kommentar abgegeben.</div>";
        }
        
        echo "</div>";
        echo "</article>";
    }
    
    
    echo "</div>";
 
    get_footer(); 

 ?>