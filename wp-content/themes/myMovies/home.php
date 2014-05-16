<?php

get_header();
?>
<?php

//query_posts("category_name=newsletter&amp;posts_per_page=2&amp;paged=$paged");
?>
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'movies',
    'post_status' => 'publish',
    'posts_per_page' => 5, 
    'caller_get_posts' => 1,
    'paged' => $paged
);
query_posts($args);
if (have_posts()) {
    while (have_posts()) : the_post();

        require("movie-template.php");

    endwhile;
}
//get_next_posts_link('Older Entries',5);
echo my_pagination();

wp_reset_query();  // Restore global post data stomped by the_post().
?>

<?php get_footer(); ?>