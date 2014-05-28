<?php
$movieimagepath = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'movie_poster', false);
$movieimagepath = $movieimagepath[0];
$movietitle = get_the_title();
$moviesubtitle = get_field('subtitle');
$moviestudio = get_field('studio');
$movieyear = get_field('year');
$moviedescription = get_the_content();
$userloggedin = is_user_logged_in() ? true : false;

$comments = get_approved_comments($post->ID);

$Rate = new Rating();
$global_rating = $Rate->get_public_movie_rating($post->ID);
$user_rating = $Rate->get_user_movie_rating($post->ID);

$rates = array();
$val = 0;
foreach($comments as $comment) {
    $meta = get_comment_meta($comment->comment_ID, 'rating');
    foreach($meta as $met => $rating) {
        array_push($rates, $rating);
        $val += (int)$rating;
    }
    
}
?>
<div class="container">
    <div class="row movie padding-top-15">
        <div class="col-md-3 col-sm-4 col-xs-5">
            <?php
            if (isset($movieimagepath))
                echo "<img src='$movieimagepath' class='img-responsive'>";
            ?>
        </div>
        <div class="col-md-9 col-sm-8 col-xs-7">
            <div class="row border-bottom-white padding-bottom-15">
                <div class="col-md-8">
                    <?php
                    if ($movietitle)
                        echo "<h2 class='color-primary'>$movietitle</h2>";

                    if ($moviesubtitle)
                        echo "<h3>$moviesubtitle</h3>";

                    echo '<p class="small">';
                    if ($moviestudio)
                        echo $moviestudio;

                    if ($movieyear)
                        echo ', ' . $movieyear;

                    echo '</p>';

                    // Show Genres
                    $terms = get_the_terms($post->ID, 'genres');
                    // Loop over each item since it's an array
                    if ($terms != null) {
                        echo '<p class="small">';
                        foreach ($terms as $term) {
                            // Print the name method from $term which is an OBJECT
                            echo '<a href="' . get_term_link($term, 'genres') . '">';
                            print $term->name . "</a> ";

                            // Get rid of the other data stored in the object, since it's not needed
                            unset($term);
                        }
                        echo '</p>';
                    }
                    ?>
                </div>
                <div class="col-md-4 col-sm-12 movie-addon-block">
                    <div class="row">
                        <div class="rating col-md-12 col-sm-6 padding-bottom-15">
                            <?php echo __("Rating", "myMovies"); ?>
                            <span class="hidden ratingvalue"><? echo $rating ?></span>
                            <ul class="color-primary">
                                <?php
                                for ($i = 1; $i < 6; $i++) {
                                    // Setzen der Ratingklassen
                                    $starvalue;
                                    if ($rating >= $i)
                                        $starvalue = "filled";

                                    else if ($rating > ($i - 0.7))
                                        $starvalue = "half";
                                    else
                                        $starvalue = "empty";

                                    echo('<li class="star star1 stars-' . $starvalue . '"></li>');
                                }
                                ?>
                            </ul>

                        </div>
                        <div class="buttons col-md-12 col-sm-6">

                            <?php
                            //generate code for bookmark button
                            if ($userloggedin) {

                                $current_bookmarks = new bookmarks();

                                if ($current_bookmarks->is_bookmarked($post->ID)) {

                                    echo '<button '
                                    . 'class="mm_user_bookmark btn btn-primary"'
                                    . 'data-post_id="' . $post->ID . '">'
                                    . '<i class="icon ion-checkmark"></i> '
                                    . __("Watchlist", "myMovies")
                                    . '</button>';
                                } else {
                                    echo '<button '
                                    . 'class="mm_user_bookmark btn btn-primary"'
                                    . 'data-post_id="' . $post->ID . '">'
                                    . '<i class="icon ion-plus"></i> '
                                    . __("Watchlist", "myMovies")
                                    . '</button>';
                                }
                            } else {
                                echo '<button '
                                . 'class="btn btn-disabled">'
                                . '<i class="icon ion-plus"></i> '
                                . __("Watchlist", "myMovies")
                                . '</button>';
                            }
                            ?>

                            <?php
                            if ($userloggedin) {

                                $current_rentals = new movie_rentals();

                                if ($current_rentals->isRented($post->ID)) {
                                    echo '<button '
                                    . 'class="btn btn-disabled"'
                                    . 'data-post_id="' . $post->ID . '" '
                                    . 'data-post_title="' . $movietitle . '">'
                                    . __("Rented", "myMovies")
                                    . '</button>';
                                } else {

                                    echo '<button '
                                    . 'class="btn btn-info mm-rent-movie"'
                                    . 'data-post_id="' . $post->ID . '" '
                                    . 'data-toggle="modal" '
                                    . 'data-target="#mm-rental-modal" '
                                    . 'data-post_title="' . $movietitle . '">'
                                    . __("Rent", "myMovies")
                                    . '</button>';
                                }
                            } else {

                                echo '<button '
                                . 'class="btn btn-disabled">'
                                . __("Rent", "myMovies")
                                . '</button>';
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row padding-top-15">
                <div class="col-xs-12">
<?php
if (isset($moviedescription))
    echo $moviedescription;
?>
                </div>
            </div>
        </div>
    </div>
</div>
