<?php 

function myMovies_theme_setup()
{
	//Register main menu for current theme
	register_nav_menu('main', 'Main Navigation');

	//Allows post thumbnails
	add_theme_support('post-thumbnails');

}

add_action( 'after_setup_theme', 'myMovies_theme_setup' );


?>