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

<!-- BODY START -->
<div class="container">

    <h1><?php echo __('Rentals', 'myMovies'); ?></h1>

    <?php

        $current_rentals = new movie_rentals();
        $count = $current_rentals->getCount();
        
        echo "<div id='rentals_counter'>".__("Current rentals", "myMovies")." | <span class='color-primary'>$count</span> </div><br/>";
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
            echo "<span>". __("Return:", "myMovies") ."<span>" . $return_date->format('d-m-Y') ."</span></span>";
            echo "<button class='btn btn-primary mm-return-movie' data-post_id='" . $movie->ID . "'>". __("Return", "myMovies") ."</button>";
            echo "</div>";
        }
        
        echo "</ul><span class='clearfix'></span>";
        echo "<br/>";

    ?>
        
    <?php

        $history_count = $current_rentals->getCountHistory();
        echo "<div id='rentals_history_counter'> ". __('History', 'myMovies') ." | <span class='color-primary'>$history_count</span> </div><br/>";
        
        echo "<div class='table-responsive'>";
        echo "<table id='mm-rentals-history' class='table table-striped'>";
        echo "<thead><tr><th>". __('Movie', 'myMovies') ."</th><th>". __("Rented", "myMovies") ."</th><th>". __("Returned", "myMovies") ."</th></tr></thead>";
        echo "<tbody>";
                        
        foreach($current_rentals->getHistory() as $movie_rented)
        {
            $permalink = get_permalink( $movie_rented->ID );
            
            echo "<tr>";
            echo "<td><a href='" .$permalink ."'>" . $movie_rented->post_title . "</a></td>";
            
            $rental_date = new DateTime($movie_rented->rental_date);
            echo "<td>" . $rental_date->format('d-m-Y') . "</td>";
            
            $returned_date = new DateTime($movie_rented->returned_date);
            echo "<td>" . $returned_date->format('d-m-Y') . "</td>";
            echo "</tr>";
        }
        
        echo "</tbody>";        
        echo "</table>";
        echo "</div>";

    ?>

</div>
<!-- BODY END -->

<?php 

get_footer(); //gets footer.php

?>