<?php

/** 
 * Theme fallback if there is no taxonomy-$taxonomy-$term.php
 */

?>

<?php get_header(); ?>

<h1>Genres</h1>
<?php

$args = array(
    'post_type' => 'movies',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'caller_get_posts' => 1
);
$my_query = null;
$my_query = new WP_Query($args);
if ($my_query->have_posts()) {
    while ($my_query->have_posts()) : $my_query->the_post();
        echo '<div class="movie-divider"></div>';
        require("templates/movie-template.php");

    endwhile;
}?>

<?php get_footer(); ?>