<?php

/**
 * Template called for custom post type 'movies'
 */

get_header();

?>

<style>
    
    .a-litte-test {
        
        height: 150px;
        width: 100%;
        background-color: grey;
    }
    
    .new {
        
        background-color:red;
    }
    
    
</style>

<div class="container">
    
    <h1>ALL MOVIES TEMPLATE</h1>
            
    <!-- Will only load the latest 6 posts, all other posts will be loaded using ajax -->
    
    <div id="mm-all-movies-posts">
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
        <div class="a-litte-test" data-post_id="<?php the_ID(); ?>">
            <h2><?php echo the_title(); ?></h2>
        </div>
        
        <?php endwhile; else: ?>
            <p><?php _e('Sorry, no movies found.'); ?></p>
        <?php endif; ?>
    </div>
    
</div>

<?php 

get_footer();

?>

