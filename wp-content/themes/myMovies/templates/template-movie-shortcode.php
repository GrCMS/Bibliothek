<?php 

$movieimagepath = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'movie_poster', false);
$movieimagepath = $movieimagepath[0];
$permalink = get_permalink($post->ID);

$Rate = new Rating();
$global_rating = $Rate->get_public_movie_rating($post->ID);
$rating = $global_rating[0]['rating'];

?>

<div id="mm-movie-shortcode-container" class="container">
    
    <div class="row">
    
        <div class="col-xs-12 text-center">
            
            <h4 class='color-primary'><a href="<?php echo $permalink ?>"><?php echo the_title(); ?></a></h4>
            
        </div>
        
    </div>
    
    <div id="mm-movie-shortcode-image" class="row">
        
        <div class="col-xs-12 text-center">
            
            <?php
                if (isset($movieimagepath))
                    echo "<a href='$permalink'><img src='$movieimagepath'></a>";
            ?>
            
        </div>
        
    </div>
    
    <div class="row">
        
        <div class="col-xs-12 text-center color-primary">
            Rating
        </div>
        
    </div>
    
    <div class="row">
        
        <div class="rating col-xs-12 padding-bottom-15 text-center">
            
            <span class="hidden ratingvalue"><?php echo $rating ?></span>
            
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
        
    </div>
    
</div>

