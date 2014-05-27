<?php
/*
 * Template Name: Rentals
 * Description: A page template to show the users current rented movies
 */

?>

<?php 

get_header(); //gets header.php

?>

<script>

    var isAccount = true;

</script>

<style>
    
    #mm-rentals {

      list-style-type: none;
      margin: 0px;
      padding: 0px;
    }

    #mm-rentals li {

      float:left;
      position: relative;
      text-align: center;
      padding: 10px;
    }

    .mm-rentals-item-wrapper {

      position: relative;
    }

    .mm-rentals-image {

      position: relative;
      z-index: 9;
    }
    
    .mm-rentals-overlay {

      background-color: rgba(0,0,0,0.75);
      height: 100px;
      width: 100%;
      position: absolute;
      z-index: 10;
      bottom: 0px;
      left: 0px;
    }

    .mm-rentals-overlay span {

      color: #fff;
      line-height: 50px;
      display: block;
    }

    .mm-rentals-overlay span > span {

      color: #77b5b4;
      line-height: 50px;
      display: inline-block;
    }

    .mm-rentals-overlay button {

      width: 90%;
    }
    
</style>

<!-- BODY START -->
<div class="container">

    <h1>Rentals</h1>

    <?php

        $current_rentals = new movie_rentals();
        $count = $current_rentals->getCount();
        
        echo "<div id='rentals_counter'> Rentals: (<span>$count</span>) </div><br/>";
        echo "<ul id='mm-rentals'>";

        foreach($current_rentals->getRentedMovies() as $movie) {
            
            $movieimagepath = wp_get_attachment_image_src(get_post_thumbnail_id($movie->ID), 'movie_poster', false);
            $movieimagepath = $movieimagepath[0];
            $permalink = get_permalink( $movie->ID );
            
            echo "<li><div class='mm-rentals-item-wrapper'>";
            echo "<a href='" . $permalink . "'>";
            echo "<img class='mm-rentals-image' src='" . $movieimagepath . "' />";
            echo "</a>";
            
            $return_date = new DateTime($movie->return_date);
                        
            echo "<div class='mm-rentals-overlay text-center'>";
            echo "<span>Retrun on: <span>" . $return_date->format('d-m-Y') ."</span></span>";
            echo "<button class='btn btn-primary mm-return-movie' data-post_id='" . $movie->ID . "'>Return</button>";
            echo "</div>";
        }
        
        echo "</ul><span class='clearfix'></span>";
        echo "<br/>";

    ?>
    
    <h3>History (count)</h3>
    
    <?php

    //show history

    ?>

</div>
<!-- BODY END -->

<?php 

get_footer(); //gets footer.php

?>