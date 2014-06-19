<?php
/*
Plugin Name: Rating-Form {not used}
Version: 1.0
Description: A plugin to add ratings to the standard comments
Author: Team GrCMS
*/


/**
 * Remove comment notes and change the label for submit button
 */
add_filter('comment_form_defaults', 'custom_fields');

function custom_fields($default) {

    $default['label_submit'] = 'Rate';
    $default['comment_notes_after'] = '';

    return $default;
}

/**
 * Add rating stars to comment field, when user is logged in
 */
add_action('comment_form_logged_in_after', 'additional_fields');
add_action('comment_form_after_fields', 'additional_fields');

function additional_fields() {
    echo '<div class="form-group">' .
    '<label for="rating">' . __('Rating') . '</label>
  <span class="rating-stars" user="true"></span></div>';

    echo '<input type="text" name="rating" hidden value="" />';
}

/**
 * Save the rating to the meta-data on submit
 */
add_action('comment_post', 'save_comment_meta_data');

function save_comment_meta_data($comment_id) {
    if (( isset($_POST['rating']) ) && ( $_POST['rating'] != ''))
        $rating = wp_filter_nohtml_kses($_POST['rating']);
    add_comment_meta($comment_id, 'rating', $rating);
}


/**
 * Gets called after submit
 * Checks existing comments from the user. The comment will be updated,
 * if the user rated the post already.
 */
add_filter('preprocess_comment', 'verify_comment_meta_data');

function verify_comment_meta_data($commentdata) {
    global $current_user;
    $args = array('user_id' => $current_user->ID);
    $usercomment = get_comments($args);

    $comments = get_approved_comments($_POST['comment_post_ID']);
    $doubleEntry = false;
    foreach ($comments as $comment) {
        if ($current_user->ID == $comment->user_id) {
            $oldCommentID = $comment->comment_ID;
            $doubleEntry = true;
        }
    }

    if (count($usercomment) >= 1 && $doubleEntry) {
        $commentarr = array();
        $commentarr['comment_ID'] = $oldCommentID; // This is the only required array key
        wp_update_comment($commentarr);
        update_comment_meta($commentarr['comment_ID'], 'rating', $_POST['rating']);
        wp_die(__('Comment updated'));
    }
    if ($_POST['rating'] == '')
        wp_die(__('Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.'));

    return $commentdata;
}

//add_filter('comment_form_field_comment', 'my_comment_form_field_comment');
//function my_comment_form_field_comment($default){
//  return false;
//}

//add_action('pre_comment_on_post', 'my_pre_comment_on_post');
//
//function my_pre_comment_on_post($post_id) {
//    if ($_POST['comment'] == '') {
//        $some_random_value = rand(0, 384534);
//        $_POST['comment'] = "Default comment. Some random value to avoid duplicate comment warning: {$some_random_value}";
//    }
//}
