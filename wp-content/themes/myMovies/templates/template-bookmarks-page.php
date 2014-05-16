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
        
    echo "<div id='bookmark_counter'> Bookmarks: (<span>$count</span>) </div><br/>";
    echo "<ul id='mm-bookmark-list'>";
    
    foreach($current_bookmarks->get_bookmarks() as $bookmark_id)
    {
        $movieimagepath = wp_get_attachment_image_src(get_post_thumbnail_id($bookmark_id), 'movie_poster', false);
        $movieimagepath = $movieimagepath[0];
        $img = '<img src="' . $movieimagepath . '" />';
        echo '<li class="mm_user_bookmark removeable" data-post_id="' . $bookmark_id . '">' . $img . '</li>';
    }
    
    echo "</ul>";
?>

<!-- BODY END -->

<?php 

get_footer(); //gets footer.php

?>