<?php
/*
 * Template Name: Profile
 * Description: A page template to show the users profile
 */

/* Get user info. */
global $current_user, $wp_roles;
get_currentuserinfo();

/* Load the registration file. */
require_once( ABSPATH . WPINC . '/registration.php' );
$error = array();

/* If profile was saved, update profile. */
if('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == 'update-user') {
    /* Check if nonce is verified */
    if(isset($_POST['user-nonce']) && wp_verify_nonce($_POST['user-nonce'], 'update-user')) {
        /* Update user password. */
        if (!empty($_POST['pass1']) && !empty($_POST['pass2'])) {
            if ($_POST['pass1'] == $_POST['pass2'])
                wp_update_user(array('ID' => $current_user->ID, 'user_pass' => esc_attr($_POST['pass1'])));
            else
                $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'myMovies');
        }

        /* Update user information. */
        if (!empty($_POST['url']))
            update_user_meta($current_user->ID, 'user_url', esc_url($_POST['url']));
        if (!empty($_POST['email'])) {
            if (!is_email(esc_attr($_POST['email'])))
                $error[] = __('The Email you entered is not valid.  please try again.', 'myMovies');
            elseif (email_exists(esc_attr($_POST['email'])) != $current_user->id)
                $error[] = __('This email is already used by another user.  try a different one.', 'myMovies');
            else {
                wp_update_user(array('ID' => $current_user->ID, 'user_email' => esc_attr($_POST['email'])));
            }
        }
        if (!empty($_POST['first-name']))
            update_user_meta($current_user->ID, 'first_name', esc_attr($_POST['first-name']));
        if (!empty($_POST['last-name']))
            update_user_meta($current_user->ID, 'last_name', esc_attr($_POST['last-name']));
        if (!empty($_POST['description']))
            update_user_meta($current_user->ID, 'description', esc_attr($_POST['description']));

        /* Redirect so the page will show updated info. */
        /* I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
        if (count($error) == 0) {
            //action hook for plugins and extra fields saving
            do_action('edit_user_profile_update', $current_user->ID);
            wp_redirect(get_permalink());
            exit;
        }
    } else {
        $error[] = __('Request does not come from this site. No updates were made', 'myMovies');
    }   
} 

get_header();
?>

<!-- BODY START -->
<div class="container">
<h1><?php echo __('Profile', 'myMovies'); ?></h1>
    <?php
    if (have_posts()) : while (have_posts()) : the_post();
            ?>
            <div id="post-<?php the_ID(); ?>">
                <div class="entry-content entry user-profile">
                    <?php
                    the_content();
                    if (!is_user_logged_in()) :
                        ?>
                        <p class="warning">
                            <?php echo __('You must be logged in to edit your profile.', 'myMovies'); ?>
                        </p><!-- .warning -->
                        <?php
                    else :
                        if (count($error) > 0)
                            echo '<p class="error">' . implode("<br />", $error) . '</p>';
                        ?>
                        <form role="form" method="post" id="adduser" action="<?php the_permalink(); ?>">
                            <div class="form-group">
                                <label for="first-name"><?php echo __('First Name', 'myMovies'); ?></label>
                                <input class="form-control" name="first-name" type="text" id="first-name" value="<?php the_author_meta('first_name', $current_user->ID); ?>" />
                            </div><!-- .form-username -->
                            <div class="form-group">
                                <label for="last-name"><?php echo __('Last Name', 'myMovies'); ?></label>
                                <input class="form-control" name="last-name" type="text" id="last-name" value="<?php the_author_meta('last_name', $current_user->ID); ?>" />
                            </div><!-- .form-username -->
                            <div class="form-group">
                                <label for="email"><?php echo __('E-mail *', 'myMovies'); ?></label>
                                <input class="form-control" name="email" type="text" id="email" value="<?php the_author_meta('user_email', $current_user->ID); ?>" />
                            </div><!-- .form-email -->
                            <div class="form-group">
                                <label for="url"><?php echo __('Website', 'myMovies'); ?></label>
                                <input class="form-control" name="url" type="text" id="url" value="<?php the_author_meta('user_url', $current_user->ID); ?>" />
                            </div><!-- .form-url -->
                            <div class="form-group">
                                <label for="pass1"><?php echo __('Password *', 'myMovies'); ?> </label>
                                <input class="form-control" name="pass1" type="password" id="pass1" />
                            </div><!-- .form-password -->
                            <div class="form-group">
                                <label for="pass2"><?php echo __('Repeat Password *', 'myMovies'); ?></label>
                                <input class="form-control" name="pass2" type="password" id="pass2" />
                            </div><!-- .form-password -->
                            <div class="form-group">
                                <label for="description"><?php echo __('Biographical Information', 'myMovies') ?></label>
                                <textarea class="form-control" name="description" id="description" rows="3" cols="50"><?php the_author_meta('description', $current_user->ID); ?></textarea>
                            </div><!-- .form-textarea -->

                            <?php
                            //action hook for plugin and extra fields
                            do_action('edit_user_profile', $current_user);
                            ?>
                            <div class="form-group">
                                <?php echo $referer; ?>
                                <button name="updateuser" type="submit" id="updateuser" class="btn btn-default"><?php echo __('Update', 'myMovies'); ?></button>
                                <?php wp_nonce_field('update-user','user-nonce') ?>
                                <input name="action" type="hidden" id="action" value="update-user" />
                            </div><!-- .form-submit -->
                        </form><!-- #adduser -->
                    <?php endif; ?>
                </div><!-- .entry-content -->
            </div><!-- .hentry .post -->
        <?php endwhile; ?>
    <?php else: ?>
        <p class="no-data">
            <?php echo __('Sorry, no page matched your criteria.', 'myMovies'); ?>
        </p><!-- .no-data -->
    <?php endif; ?>

</div>

<?php
// BODY END -->
get_footer(); //gets footer.php
?>