<?php get_header(); ?>


<div class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="post">
                <h2 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2>
                <div class="entrytext">
            <?php the_content(); ?>
                </div>
            </div>
                <?php endwhile;
            endif; ?> 

</div>
    <?php
    get_footer();
    