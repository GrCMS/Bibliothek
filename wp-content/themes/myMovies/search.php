<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

get_header();

?>


<h1 class="page-title container"><?php printf( __( 'Search Results for: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>
        
        <div class="movie-divider"></div>
        <?php get_template_part( 'templates/template', 'movie' ); ?>

    <?php endwhile; ?>


<?php else : ?>

    <div class="container">No results</div>;

<?php endif; ?>

<?php 

get_footer();

?>
    
    