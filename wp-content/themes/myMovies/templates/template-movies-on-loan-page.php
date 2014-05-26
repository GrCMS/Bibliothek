<?php
/*
 * Template Name: Movies on loan
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

    <h1>Movies on loan</h1>

    <?php

        $current_rentals = new movie_rentals();
        $count = $current_rentals->getCount();
        echo "Rentals: ($count)";

        foreach($current_rentals->getRentedMovies() as $movie) {

            echo "<h4>$movie->post_title</h4>";
        }

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