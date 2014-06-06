<?php
get_header(); //gets header.php

$customvalues = new customValue();
?>

<!-- BODY START -->

<!-- Slider: new movies -->
<h2 class="container moviesection-header"><?php echo __('New movies', 'myMovies'); ?></h2>
<?php
$args = array(
    'post_type' => 'movies',
    'orderby' => 'post_date',
    'post_status' => 'publish',
    'posts_per_page' => 10,
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
        $permalink = get_permalink($id);

        echo "<li><a href='$permalink'><img src='$movieimagepath' /></li></a>";

    endwhile;
    echo '</ul>';
    echo '</div>';
}

wp_reset_query();  // Restore global post data stomped by the_post().
?>

<?php
if (is_user_logged_in()) {

    if (get_option('mm_show_top_rated_slider') == 'checked') {
        //Slider: best rated movies
        $rated_movies = new Rating();
        $best_rated = $rated_movies->get_top_rated_movies(20);

        if (count($best_rated) > 0) {

            echo '<h2 class="container moviesection-header">' . __('Top rated movies', 'myMovies') . '</h2>';
            echo '<div class="flexslider">';
            echo '<ul class="slides">';

            foreach ($best_rated as $rated) {

                $movieimagepath = wp_get_attachment_image_src(get_post_thumbnail_id($rated['movie']), 'movie_poster', false);
                $movieimagepath = $movieimagepath[0];
                $permalink = get_permalink($rated['movie']);

                echo "<li><a href='$permalink'><img src='$movieimagepath' /></li></a>";
            }

            echo '</ul>';
            echo '</div>';
        }
    }

    if (get_option('mm_show_most_rented_slider') == 'checked') {
        //Slider: most rented movies
        $rentals = new movie_rentals();
        $most_rented = $rentals->getMostRented();

        echo "<h2 class='container moviesection-header'>" . __('Most rented movies', 'myMovies') . "</h2>";
        echo '<div class="flexslider">';
        echo '<ul class="slides">';

        foreach ($most_rented as $rented) {

            $movieimagepath = wp_get_attachment_image_src(get_post_thumbnail_id($rented->movie), 'movie_poster', false);
            $movieimagepath = $movieimagepath[0];
            $permalink = get_permalink($rented->movie);

            echo "<li><a href='$permalink'><img src='$movieimagepath' /></li></a>";
        }

        echo '</ul>';
        echo '</div>';
    }
}

if (!is_user_logged_in()) :
    ?>
    <div class="movie-divider">
        <div class="container">
            <h2 class="color-primary moviesection-header"> <?php echo $customvalues->getValue('Frontpage Headline'); ?></h2>	
            <h3> <?php echo $customvalues->getValue('Frontpage Subheadline'); ?></h3>
            <? the_post(); ?>
            <div class="multicol-2">
    <?php echo $customvalues->getValue('Frontpage Text'); ?>
            </div>
            <a class="btn btn-primary"><?php echo __("Sign up", "myMovies"); ?></a>
        </div>

<?php
endif;

//posts archive: latest 5 posts
echo '<div class="movie-divider"></div>';
echo "<h2 class='container moviesection-header'>" . __('Latest news', 'myMovies') . "</h2>";
$recent_posts_args = array(
    'numberposts' => '5',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post'
);

$recent_posts = wp_get_recent_posts($recent_posts_args, OBJECT);

foreach ($recent_posts as $post) {
    setup_postdata($post);
    get_template_part('templates/template', 'post');
}
?>

    <!-- BODY END -->

    <?php
    get_footer(); //gets footer.php
    ?>