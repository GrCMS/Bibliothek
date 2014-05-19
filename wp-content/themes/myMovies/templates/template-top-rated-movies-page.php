<?php

/*
  Template Name: Top Rated Movie List
 */

get_header();
?>

<?php

the_post();
$pagetitle = get_the_title();
echo "<h2 class='container'>$pagetitle</h2>";

$Rate = new Rating();
$top_rated = $Rate->get_top_rated_movies(20);

$thePostIdArray = array();
foreach($top_rated as $movie)
{
    array_push($thePostIdArray, $movie[movie]);
    array_reverse($thePostIdArray);
}

$args = array(
    'post_type' => 'movies',
   'post__in' => $thePostIdArray
);

$my_query = null;
$my_query = new WP_Query($args);

usort( $my_query->posts, function ( $a, $b ) use ( $thePostIdArray )
    {
        $apos   = array_search( $a->ID, $thePostIdArray );
        $bpos   = array_search( $b->ID, $thePostIdArray );

        return ( $apos < $bpos ) ? -1 : 1;
    });

if ($my_query->have_posts()) {
    while ($my_query->have_posts()) : $my_query->the_post();
        echo '<div class="movie-divider"></div>';
        require("movie-template.php");

    endwhile;
}


?>

<?php

wp_reset_query();  // Restore global post data stomped by the_post().
?>

<?php get_footer(); ?>