<?php

/**
 * Template called for custom post type 'movies'
 */

get_header();

?>

<div class="container">
    
    <h1>ALL MOVIES TEMPLATE</h1>
            
    <!-- Will only load the latest 6 posts, all other posts will be loaded using ajax -->
    
    <div id="mm-all-movies-posts">
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
            <?php echo the_title(); ?>
        
        <?php endwhile; else: ?>
            <p><?php _e('Sorry, no movies found.'); ?></p>
        <?php endif; ?>
    </div>
    
</div>

<?php 

get_footer();

?>

