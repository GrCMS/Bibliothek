<?php
/*
 * Template Name: Bookmarks
 * Description: A page template to show the users bookmarks
 */

?>
<?php 

get_header(); //gets header.php

?>

<!-- BODY START -->

<h1>Bookmarks</h1>

<?php

echo "current user: " . $current_user->display_name;

?>

<!-- BODY END -->

<?php 

get_footer(); //gets footer.php

?>