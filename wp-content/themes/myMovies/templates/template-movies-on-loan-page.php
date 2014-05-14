<?php
/*
 * Template Name: Movies on loan
 * Description: A page template to show the users current rented movies
 */

?>

<?php 

get_header(); //gets header.php

?>

<script>

    var isAccount = true;

</script>

<!-- BODY START -->

<h1>Movies on loan</h1>

<?php

echo "current user: " . $current_user->display_name;

?>

<!-- BODY END -->

<?php 

get_footer(); //gets footer.php

?>