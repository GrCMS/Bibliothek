<?php
$movieimagepath = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'movie_poster', false);
$movieimagepath = $movieimagepath[0];
$movietitle = get_the_title();
$moviesubtitle = get_post_meta($post->ID, 'subtitle', TRUE);
$moviestudio = get_post_meta($post->ID, 'studio', TRUE);
$movieyear = get_post_meta($post->ID, 'year', TRUE);
$moviedescription = get_the_content();
$userloggedin = is_user_logged_in() ? true : false;

$Rate = new Rating();
$global_rating = $Rate->get_public_movie_rating($post->ID);
$user_rating = $Rate->get_user_movie_rating($post->ID);
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
            <div class="col-sm-7">
<?php
if (isset($movietitle))
    echo "<h2 class='color-primary'>$movietitle</h2>";

if (isset($moviesubtitle))
    echo "<h3>$moviesubtitle</h3>";

echo '<span class="small">';
if (isset($moviestudio))
    echo $moviestudio;

if (isset($movieyear))
    echo ', ' . $movieyear;

echo '</span>';
?>
            </div>
            <div class="col-md-5 col-sm-12 movie-addon-block">
                <div class="row">
                    <div class="rating col-md-12 col-sm-6 padding-bottom-15">
                        Rating<br>
                        <span class="star stars-empty movie-<?php echo $post->ID ?>"><?php echo $global_rating ?></span>
                        <span class="rating-stars" is-user="<?php if ($userloggedin) echo false;
                else echo true; ?>" movie-id="<?php echo $post->ID; ?>" data-score="<?php echo $user_rating; ?>"></span>

                    </div>
                    <div class="buttons col-md-12 col-sm-6">

                        <?php
                        //generate code for bookmark button
                        if ($userloggedin) {
                            
                            $current_bookmarks = new bookmarks();
                                                        
                            if($current_bookmarks->is_bookmarked($post->ID)) {
                                
                                echo '<button '
                                . 'class="mm_user_bookmark btn btn-primary bookmarked"'
                                . 'data-post_id="' . $post->ID . '">'
                                . '<i class="icon ion-checkmark"></i> Watchlist'
                                . '</button>';
                            }
                            else
                            {
                                echo '<button '
                                . 'class="mm_user_bookmark btn btn-primary"'
                                . 'data-post_id="' . $post->ID . '">'
                                . '<i class="icon ion-plus"></i> Watchlist'
                                . '</button>';
                            }
                            
                        } else {
                            echo '<button '
                            . 'class="btn btn-disabled">'
                            . '<i class="icon ion-plus"></i> Watchlist'
                            . '</button>';
                        }
                        ?>

                        <button class="btn <?php if ($userloggedin) echo 'btn-info';
                        else echo 'btn-disabled'; ?>">Rent</button>

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