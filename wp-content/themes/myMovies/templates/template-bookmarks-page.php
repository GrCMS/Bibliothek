<?php
/*
 * Template Name: Bookmarks
 * Description: A page template to show the users bookmarks
 */

?>
<?php 

get_header(); //gets header.php

?>

<script>

    var isAccount = true;

</script>

<!-- BODY START -->

<h1>Bookmarks</h1>
<style>
    
    #mm-bookmark-list {
        
        list-style-type: none;
        width:100%;
    }
    
    #mm-bookmark-list li {
        
        position: relative;
        display: inline-block;
        
    }
    
    #mm-bookmark-list li img {
        
        padding: 10px;
    }
    
</style>

<?php

    $bookmarks_arr = get_user_option('bookmarks', $current_user->ID);
    
    if($bookmarks_arr != false)
    {
        $n = count($bookmarks_arr);
        
        echo "Bookmarks ($n)";
        
        echo '<ul id="mm-bookmark-list">';
        
        foreach($bookmarks_arr as $movie_id)
        {
            $movieimagepath = wp_get_attachment_image_src(get_post_thumbnail_id($movie_id), 'movie_poster', false);
            $movieimagepath = $movieimagepath[0];
            echo "<li class='mm_user_bookmark removeable' data-post_id='$movie_id' ><img src='$movieimagepath' /></li>";
        }
        echo '</ul>';
    }
    else
    {
        echo "no bookmarks...";
    }

?>

<!-- BODY END -->

<?php 

get_footer(); //gets footer.php

?>