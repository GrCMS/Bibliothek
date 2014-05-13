<?php
$movieimagepath = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'movie_poster', false);
$movieimagepath = $movieimagepath[0];
$movietitle = get_the_title();
$moviesubtitle = get_post_meta($post->ID, 'subtitle', TRUE);
$moviestudio = get_post_meta($post->ID, 'studio', TRUE);
$movieyear = get_post_meta($post->ID, 'year', TRUE);
$moviedescription = get_the_content();
$userloggedin = true;
$ratingvotes = get_post_meta($post->ID, 'votes', TRUE);
$ratingsum = get_post_meta($post->ID, 'rating', TRUE);

if ($ratingvotes > 0)
    $rating = round($ratingsum / $ratingvotes, 1);
else
    $rating = 0;
?>
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
                        Rating
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
                        <span class="btn <? if(is_user_logged_in()) echo 'btn-primary'; else echo 'btn-disabled';?>">+ Merkliste</span>
                        <span class="btn <? if(is_user_logged_in()) echo 'btn-info'; else echo 'btn-disabled';?>">+ Leihen</span>
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