<?php

/** 
 * Theme fallback if there is no taxonomy-$taxonomy-$term.php
 */

?>

<?php get_header(); ?>

<div class="container">
<h4>Genres</h4>
<?php
    $term =	$wp_query->queried_object;
    echo '<h3 class="color-primary large">'.$term->name.'</h3>';
?>
</div>

<?php

$args = array(
    'genres' => $term->name,
    'post_type' => 'movies',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'caller_get_posts' => 1
);
$my_query = null;
$my_query = new WP_Query($args);
$first = true;
if ($my_query->have_posts()) {
    while ($my_query->have_posts()) : $my_query->the_post();
        if(!$first)
            echo '<div class="movie-divider"></div>';
        $first = false;
        require("templates/template-movie.php");

    endwhile;
}?>

<?php get_footer(); ?>