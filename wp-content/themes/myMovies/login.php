<?php
/*
  Template Name: Login Form
 */
get_header();

$args = array(
    'redirect' => get_permalink(get_page(163)),
    'id_username' => 'id_username',
    'id_password' => 'id_password',
    'form_id' => 'form_id'
);
if (isset($_GET['login']) && $_GET['login'] == 'failed') {
    ?>
    <div id="login-failed">
        <p>Login failed: You have entered an incorrect Username or password, please try again.</p>
    </div>
<?php } ?>

<?php
if (!is_user_logged_in()) {

    if (isset($_GET['action']) && $_GET['action'] == 'register') {
 
        if (isset($GLOBALS['REGISTRATION_ERROR'])) {
            foreach (unserialize($GLOBALS['REGISTRATION_ERROR']) as $error) {
                echo "<div class=\"error\">{$error}</div>";
            }
            unset($GLOBALS['REGISTRATION_ERROR']);
        }
        // errors here, if any

        elseif (isset($GLOBALS['REGISTERED_A_USER'])) {
            echo 'a email has been sent to ' . $GLOBALS['REGISTERED_A_USER'];
            unset($GLOBALS['REGISTERED_A_USER']);
        }
        ?>
        <div id="login-form">
            <form role="form" action="<?php echo add_query_arg('action', 'register', home_url('/login')); ?>" method="post">
                <h1>Register</h1>
                <span>Sign Up with us and Enjoy!</span>
                <div class="form-group">
                    <label class="sr-only" for="user_login">Username</label>
                    <input autocomplete="off" placeholder="Username" class="form-control" type="text" name="user_login" id="user_login" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" />
                </div>
                <div class="form-group">
                    <label class="sr-only" for="pwd">E-Mail</label>
                    <input placeholder="E-Mail" class="form-control" type="text" name="user_email" id="user_email" />
                </div>
        <?php do_action('register_form'); ?>
                <hr />
                <p>A password will be e-mailed to you.</p>
                <input class="btn btn-default" id="register" type="submit" name="submit" value="Register" class="button" />
            </form>
        </div>
    <?php } else { ?>

        <div id="login-form">
            <form role="form" action="<?php echo wp_login_url(get_permalink(get_page(163))); ?>" method="post">
                <h1>Login</h1>
                <div class="form-group">
                    <label class="sr-only" for="log">User</label>
                    <input autocomplete="off" placeholder="User" class="form-control" type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" />
                </div>
                <div class="form-group">
                    <label class="sr-only" for="pwd">Password</label>
                    <input placeholder="Password" class="form-control" type="password" name="pwd" id="pwd" />
                </div>
                <div class="form-group">
                    <div class="checkbox text-left">
                        <label>
                            <input name="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me
                        </label>
                    </div>
                </div>
                <a href="<?php echo site_url() . '/login?action=register'; ?>">Register</a>

                <input class="btn btn-default" type="submit" name="submit" value="Login" class="button" />
            </form>
        </div>
        <?php
    }
}
get_footer();
?>