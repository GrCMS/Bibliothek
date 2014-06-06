<?php
/*
  Template Name: Login Form
 */
get_header();

if (isset($_GET['login']) && $_GET['login'] == 'failed') {
    ?>
    <div id="login-failed">
        <p><?php __('Login failed: You have entered an incorrect Username or password, please try again.', 'myMovies'); ?></p>
    </div>
<?php } 


if (!is_user_logged_in()) {

    if (isset($_GET['do']) && $_GET['do'] == 'register' || isset($_GET['action']) && $_GET['action'] == 'register') {
        $register = true;

        if (defined('REGISTRATION_ERROR'))
            foreach (unserialize(REGISTRATION_ERROR) as $error)
                echo "<div class=\"register-error\">{$error}</div>";

        elseif (defined('REGISTERED_A_USER')) {
            echo '<div class="register-success">'.__('a email has been sent to ', 'myMovies') . REGISTERED_A_USER . '</div>';
            $register = false; 
        }

        if ($register) {
            ?>
            <div id="login-form">
                <form role="form" action="<?php echo add_query_arg('do', 'register', home_url('/login')); ?>" method="post">
                    <h1>Register</h1>
                    <div class="form-group">
                        <label class="sr-only" for="user"><?php __('Username', 'myMovies'); ?></label>
                        <input autocomplete="off" placeholder="Username" class="form-control" type="text" name="user" id="user" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" />
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="email"><?php __('E-Mail','myMovies'); ?></label>
                        <input placeholder="E-Mail" class="form-control" type="text" name="email" id="user_email" />
                    </div>
            <?php do_action('register_form'); ?>
                    <hr />
                    <p><?php __('A password will be e-mailed to you.','myMovies'); ?></p>
                    <input class="btn btn-default" id="register" type="submit" name="submit" value="<?php __('Register','myMovies'); ?>" class="button" />
                    <?php wp_nonce_field('register-user','register-nonce') ?>
                </form>
            </div>
        <?php }
    } else { ?>

        <div id="login-form">
            <form role="form" action="<?php echo wp_login_url(get_permalink()); ?>" method="post">
                <h1>Login</h1>
                <div class="form-group">
                    <label class="sr-only" for="log"><?php __('Username', 'myMovies'); ?></label>
                    <input autocomplete="off" placeholder="User" class="form-control" type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" />
                </div>
                <div class="form-group">
                    <label class="sr-only" for="pwd"><?php __('Password', 'myMovies'); ?></label>
                    <input placeholder="<?php __('Password', 'myMovies'); ?>" class="form-control" type="password" name="pwd" id="pwd" />
                </div>
                <div class="form-group">
                    <div class="checkbox text-left">
                        <label>
                            <input name="rememberme" type="checkbox" checked="checked" value="forever" /><?php __('Remember me', 'myMovies'); ?>
                        </label>
                    </div>
                </div>
                <a href="<?php echo site_url() . '/login?action=register'; ?>"><?php __('Register', 'myMovies'); ?></a>
                <input class="btn btn-default" type="submit" name="submit" value="<?php __('Login', 'myMovies'); ?>" class="button" />
                <?php wp_nonce_field('login-user','login-nonce') ?>
            </form>
        </div>
        <?php
    }
}
get_footer();
?>