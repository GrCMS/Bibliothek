<?php
/*
  Template Name: Login Form
 */
get_header();

if (isset($_GET['login']) && $_GET['login'] == 'failed') {
    ?>
    <div id="login-failed">
        <p>Login failed: You have entered an incorrect Username or password, please try again.</p>
    </div>
<?php } ?>

<?php
if (!is_user_logged_in()) {

    if (isset($_GET['do']) && $_GET['do'] == 'register' || isset($_GET['action']) && $_GET['action'] == 'register') {
        $register = true;

        if (defined('REGISTRATION_ERROR'))
            foreach (unserialize(REGISTRATION_ERROR) as $error)
                echo "<div class=\"register-error\">{$error}</div>";

        elseif (defined('REGISTERED_A_USER')) {
            echo "<div class=\"register-success\">a email has been sent to '" . REGISTERED_A_USER . "</div>";
            $register = false;
        }

        if ($register) {
            ?>
            <div id="login-form">
                <form role="form" action="<?php echo add_query_arg('do', 'register', home_url('/login')); ?>" method="post">
                    <h1>Register</h1>
                    <div class="form-group">
                        <label class="sr-only" for="user">Username</label>
                        <input autocomplete="off" placeholder="Username" class="form-control" type="text" name="user" id="user" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" />
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="email">E-Mail</label>
                        <input placeholder="E-Mail" class="form-control" type="text" name="email" id="user_email" />
                    </div>
            <?php do_action('register_form'); ?>
                    <hr />
                    <p>A password will be e-mailed to you.</p>
                    <input class="btn btn-default" id="register" type="submit" name="submit" value="Register" class="button" />
                    <?php wp_nonce_field('register-user','register-nonce') ?>
                </form>
            </div>
        <?php }
    } else { ?>

        <div id="login-form">
            <form role="form" action="<?php echo wp_login_url(get_permalink()); ?>" method="post">
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
                <?php wp_nonce_field('login-user','login-nonce') ?>
            </form>
        </div>
        <?php
    }
}
get_footer();
?>