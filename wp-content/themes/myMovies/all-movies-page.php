<? 

/*
Template Name: Movie List
*/

get_header(); ?>

<?php
$type = 'movies';
$args=array(
  'post_type' => $type,
  'post_status' => 'publish',
  'posts_per_page' => 5,
  'caller_get_posts'=> 1
);
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
while ($my_query->have_posts()) : $my_query->the_post();

require("movie-template.php");
    
endwhile;
}

wp_reset_query();  // Restore global post data stomped by the_post().
?>

<? get_footer(); ?>