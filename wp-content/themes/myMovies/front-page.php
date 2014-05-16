<?php
get_header(); //gets header.php
?>

<!-- BODY START -->
<h2 class="container moviesection-header"> Neuerscheinungen</h2>
<?php
$type = 'movies';
$args = array(
    'post_type' => $type,
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'caller_get_posts' => 1
);
$my_query = null;
$my_query = new WP_Query($args);
if ($my_query->have_posts()) {

    echo '<div class="flexslider">';
    echo '<ul class="slides">';

    while ($my_query->have_posts()) : $my_query->the_post();

        $movieimagepath = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'movie_poster', false);
        $movieimagepath = $movieimagepath[0];

        echo "<li><img src='$movieimagepath' /></li>";

    endwhile;
    echo '</ul>';
    echo '</div>';
}

wp_reset_query();  // Restore global post data stomped by the_post().
?>
<div class="movie-divider"></div>
<div class="container">
    <h2 class="color-primary">MyMovies</h2>	
    <h3>Some random Subheadline</h3>
    <? the_post(); ?>
    <div class="multicol-2">
        <? the_content(); ?>
    </div>
    <a class="btn btn-primary btn-lg">Jetzt anmelden!</a>
</div>


<!-- BODY END -->

<?php
get_footer(); //gets footer.php
?>
