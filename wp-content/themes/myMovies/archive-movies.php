<?php

/**
 * Template called for custom post type 'movies'
 */

get_header();

?>

<div class="container">
    
    <h1>ALL MOVIES TEMPLATE</h1>
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
        <?php echo the_title(); ?>
        <?php echo "<br />"; ?>
    
    <?php endwhile; else: ?>
        <p><?php _e('Sorry, no movies found.'); ?></p>
    <?php endif; ?>
    
</div>

<?php 

get_footer();

?>

