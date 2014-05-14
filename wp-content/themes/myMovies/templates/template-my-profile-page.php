<?php
/*
 * Template Name: Profile
 * Description: A page template to show the users profile
 */

?>

<?php 

get_header(); //gets header.php

?>

<script>

    var isAccount = true;

</script>

<!-- BODY START -->

<h1>Profile</h1>

<?php

echo "current user: " . $current_user->display_name;

?>

<!-- BODY END -->

<?php 

get_footer(); //gets footer.php

?>