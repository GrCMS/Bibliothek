<?php

/**
 * Template called for custom post type 'movies'
 */

get_header();

?>

<style>
    
    .a-litte-test {
        
        height: 350px;
        width: 100%;
        background-color: grey;
    }
    
    
</style>

<div class="container">
    
    <h1>ALL MOVIES TEMPLATE</h1>
            
    <!-- Will only load the latest 6 posts, all other posts will be loaded using ajax -->
    <?php echo $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
    
    <div id="mm-all-movies-posts">
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
        <div class="a-litte-test"></div>
            <?php echo the_title(); ?>
        
        <?php endwhile; else: ?>
            <p><?php _e('Sorry, no movies found.'); ?></p>
        <?php endif; ?>
    </div>
    
</div>

<?php 

get_footer();

?>

