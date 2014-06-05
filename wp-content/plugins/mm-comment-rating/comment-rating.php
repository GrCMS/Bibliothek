<?php
/**
 * Plugin Name: Comment Rating
 * Description: Adds rating to wordpress comments (Bootstrap must be installed)
 * Version: 1.0
 * Author: Team GrCMS
 */

include_once('includes/comment-rating-service.php');

/**
 * Hook called on 'wp_enqueue_scripts' to register stlyes an scripts
 */
add_action("wp_enqueue_scripts", "register_comment_rating_scripts");

/**
 * Registers scripts used in this plugin
 */
function register_comment_rating_scripts() {
    
    wp_register_script('comment-rating-js', plugins_url() . '/mm-comment-rating/js/ajax/comment-rating.js', array('jquery'), '1.0', true);
    wp_localize_script('comment-rating-js', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
    wp_enqueue_script('comment-rating-js');
}

/**
 * Hook called on 'wp_footer' to add custom modal dialog for comments
 */
add_action("wp_footer","add_modal_dialog_to_footer");

/**
 * includes custom comments modal to footer
 */
function add_modal_dialog_to_footer() {
    
    include_once('includes/template-comment-modal.php' );
}

/**
 * function to echo the comments link for the given post id and post title
 * can be used to add this plugins comments to the post
 */
function comment_rating_link($post_id, $post_title) {
        
        echo '<a href="javascript:void(0)" class="mm-comment-movie" '
        . 'data-post_id="'. $post_id .'" '
        . 'data-post_title="'. $post_title .'" '
        . 'data-toggle="modal" '
        . 'data-target="#mm-comment-movie-modal">'
        . 'Bewerten'
        . '</a>';
}

/**
 * filter used to override the wordpress default comments link
 */
add_filter('get_comments_link', 'comment_rating_link_no_param');

/**
 * called by 'get_comments_link' filter in order to return and override
 * the wordpress default comments link
 */
function comment_rating_link_no_param() {
    
    $comments_link = '<a href="javascript:void(0)" class="mm-comment-movie" '
        . 'data-post_id="'. get_the_ID() .'" '
        . 'data-post_title="'. get_the_title() .'" '
        . 'data-toggle="modal" '
        . 'data-target="#mm-comment-movie-modal">'
        . 'Bewerten'
        . '</a>';
    
    return $comments_link;
}
