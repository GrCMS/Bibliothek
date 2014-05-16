<?php
/*
 * Template Name: Bookmarks
 * Description: A page template to show the users bookmarks
 */

?>
<?php 

get_header(); //gets header.php

?>

<script>

    var isAccount = true;

</script>

<!-- BODY START -->

<h1>Bookmarks</h1>

<?php

    $current_bookmarks = new bookmarks();
    $count = $current_bookmarks->count();
        
    echo "Bookmarks: ($count) <br/>";
    echo "<ul id='mm-bookmark-list'>";
    
    foreach($current_bookmarks->get_bookmarks() as $bookmark_id)
    {
        echo '<li class="mm_user_bookmark" data-post_id="' . $bookmark_id . '">' . $bookmark_id . '</li>';
    }
    
    echo "</ul>";
?>

<!-- BODY END -->

<?php 

get_footer(); //gets footer.php

?>