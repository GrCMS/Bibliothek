<?php

get_header();
    
    the_post();
    get_template_part( 'templates/template', 'post' );
        
get_footer(); 

