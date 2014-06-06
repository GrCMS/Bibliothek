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
<div class="container">
    
    <h1><?php echo __('Watchlist', 'myMovies'); ?></h1>

    <?php

        $current_bookmarks = new bookmarks();
        $count = $current_bookmarks->count();
        
        $Rate = new Rating();
                
        echo "<div id='bookmark_counter'> ".__('My watchlist', 'myMovies')." | <span class='color-primary'>$count</span></div><br/>";
        echo "<ul id='mm-watchlist'>";
    
        foreach($current_bookmarks->get_bookmarks() as $bookmark_id)
        {
            $movieimagepath = wp_get_attachment_image_src(get_post_thumbnail_id($bookmark_id), 'movie_poster', false);
            $movieimagepath = $movieimagepath[0];
            $permalink = get_permalink( $bookmark_id );
            
            $global_rating = $Rate->get_public_movie_rating($bookmark_id);
            $rating = $global_rating[0]['rating'];
            
            echo "<li><div class='mm-watchlist-item-wrapper'>";
            echo "<a href='" . $permalink . "'>";
            echo "<img class='mm-watchlist-image' src='" . $movieimagepath . "' />";
            echo "</a>";
            
            echo "<span class='mm-watchlist-icon-close ion-ios7-close-outline mm_user_bookmark' data-post_id='" . $bookmark_id . "' ></span>";
            echo "<div class='mm-watchlist-overlay text-center'>";
            echo "<span class='text-center'><a href='#'>Rating:</a></span>";
            echo "<span class='rating-in-star'><a href='#'>$rating</a></span>"; 
                                   
            echo "</div>";
            echo "</div></li>";
        }
    
        echo "</ul>";
    ?>
</div>
<!-- BODY END -->

<?php 

get_footer(); //gets footer.php

?>