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

<style>
    
    #mm-watchlist {

      list-style-type: none;
      margin: 0px auto;
      padding: 0px;
    }

    #mm-watchlist li {

      float:left;
      position: relative;
      text-align: center;
      padding: 10px;
    }

    .mm-watchlist-item-wrapper {

      position: relative;
    }

    .mm-watchlist-image {

      position: relative;
      z-index: 9;
    }

    .mm-watchlist-icon-close {

      position: absolute;
      z-index: 11;
      color: #fff;
      top: 10px;
      right: 10px;
      cursor: pointer;
      font-size: 18px;
    }

    .mm-watchlist-overlay {

      height: 0px;
      display: none;
      width: 100%;
      position: absolute;
      z-index: 10;
      bottom: 0px;
      left: 0px;
      opacity: 0;
      background-color: #000;
    }

    .mm-watchlist-overlay span {

      display: block;
      line-height: 50px;
    }

    .mm-watchlist-overlay span a {

      color:#77b5b4;
      font-size: 16px;
    }
    
</style>

<!-- BODY START -->
<div class="container">
    
    <h1>Bookmarks</h1>

    <?php

        $current_bookmarks = new bookmarks();
        $count = $current_bookmarks->count();
        
        echo "<div id='bookmark_counter'> Bookmarks: (<span>$count</span>) </div><br/>";
        echo "<ul id='mm-watchlist'>";
    
        foreach($current_bookmarks->get_bookmarks() as $bookmark_id)
        {
            $movieimagepath = wp_get_attachment_image_src(get_post_thumbnail_id($bookmark_id), 'movie_poster', false);
            $movieimagepath = $movieimagepath[0];
            $permalink = get_permalink( $bookmark_id );
            
            echo "<li><div class='mm-watchlist-item-wrapper'>";
            echo "<a href='" . $permalink . "'>";
            echo "<img class='mm-watchlist-image' src='" . $movieimagepath . "' />";
            echo "</a>";
            
            echo "<span class='mm-watchlist-icon-close ion-ios7-close-outline mm_user_bookmark' data-post_id='" . $bookmark_id . "' ></span>";
            echo "<div class='mm-watchlist-overlay text-center'>";
            echo "<span><a href=''>Rating</a></span>"; //GET RATING
            echo "<span><a href=''>Rent</a></span>";//AJAX CALL RENT MOVIE
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